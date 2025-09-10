<?php
  $passdata = isset($passdata) ? $passdata : 'none';
  $model = isset($model) ? $model : "";

  $alert = isset($alert) ? $alert : "alert information";
  $heading = isset($heading) ? $heading : "heading";
  $optype = isset($optype) ? $optype : "add";

  $modelfile = __DIR__."/../../models/$model.class.php";

  global $genui;
  global $apiaccesscode;

  if(!file_exists($modelfile)){
    $genui->gen_alert2('the model doesnt seem to exist',"Record creation attempt error");
    exit();
  }

  if(!is_readable($modelfile)){
    $genui->gen_alert2('the model file is unreadable, check its permissions',"Record creation attempt error");
    exit();
  }

  require_once $modelfile;

  if(!class_exists($model)){
    $genui->gen_alert2('invalid class name, check the model code',"Record creation attempt error");
    exit();
  }

  $instance = new $model();
  $instance->getdata();

  $fields = $instance::getviewFields();

  // load navbar
  include __DIR__.'/topnav.php';
  view_nav($model);

  $thedata = $instance->response;
  $itwirked = $thedata['success'];
  $theres = $thedata['result'];

  echo <<<HTML

    <head>
      <title>Vanilla DataTables Replica — Products</title>
    </head>
    <body>
      <div class="content spacy-md">
        <div class="card" style="max-width:1100px;margin:0 auto">
          <h2 style="margin:0 0 12px 0">$model : All records</h2>

          <div class="dt-top">
            <div class="dt-left">
              <label>Show
                <select id="pageLength" aria-label="Show entries">
                  <option>10</option>
                  <option>25</option>
                  <option>50</option>
                  <option>100</option>
                </select>
              entries</label>
            </div>

            <div class="dt-right">
              <label>Search: <input type="search" id="globalSearch" placeholder="Search products..." /></label>
            </div>
          </div>

          <div>
            <table id="dt" aria-describedby="table-info">
              <thead>
                <tr>
                  
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>

          <div class="dt-bottom">
            <div class="info" id="table-info">Showing 0 to 0 of 0 entries</div>
            <div class="pagination" id="pagination"></div>
          </div>
        </div>
      </div>
  HTML;
?>

      <script>
        // ===== LOADING OVERLAY =====
        function showLoading(show = true) {
          if (!document.getElementById('loading-overlay')) {
            const overlay = document.createElement('div')
            overlay.id = 'loading-overlay'
            overlay.innerHTML = `
              <div style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,0.8);z-index:9999;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:12px">
                <div style="width:40px;height:40px;border:4px solid #e5e7eb;border-top:4px solid #1f2937;border-radius:50%;animation:spin 1s linear infinite"></div>
                <div style="color:#1f2937;font-size:14px">Loading...</div>
              </div>
              <style>@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}</style>
            `
            document.body.appendChild(overlay)
          }
          document.getElementById('loading-overlay').style.display = show ? 'flex' : 'none'
        }

        // ===== STATE =====
        let state = {
          page: 1,
          pageLength: 10,
          q: '',
          sortKey: null,
          sortDir: 'asc',
          filtered: [],
          fields: [], // from get_fields
          rawData: [] // from get_products
        }

        // ===== ELEMENTS =====
        const tbody = document.querySelector('#dt tbody')
        const info = document.getElementById('table-info')
        const pagination = document.getElementById('pagination')
        const pageLengthSel = document.getElementById('pageLength')
        const searchInput = document.getElementById('globalSearch')
        const headersContainer = document.querySelector('#dt thead tr')
        const refreshBtn = document.createElement('button')

        // Add refresh button to UI
        refreshBtn.textContent = '↻ Refresh'
        refreshBtn.style.marginLeft = '12px'
        refreshBtn.className = 'page-btn'
        refreshBtn.addEventListener('click', fetchData)
        document.querySelector('.dt-right').appendChild(refreshBtn)

        // ===== EVENT LISTENERS =====
        pageLengthSel.value = state.pageLength
        pageLengthSel.addEventListener('change', e => { state.pageLength = Number(e.target.value); state.page = 1; render() })
        searchInput.addEventListener('input', e => { state.q = e.target.value.trim().toLowerCase(); state.page = 1; filterAndRender() })

        // Keyboard shortcut
        document.addEventListener('keydown', e => {
          if (e.key === '/' && document.activeElement !== searchInput) {
            e.preventDefault()
            searchInput.focus()
          }
        })

        // ===== FETCH FIELDS & DATA =====
        async function fetchData() {
          showLoading(true)

          try {
            // Fetch fields first
            const fieldsRes = await fetch('_api/get_fields?module=products')
            if (!fieldsRes.ok) throw new Error('Failed to fetch fields')
            state.fields = await fieldsRes.json()

            // Fetch products
            const productsRes = await fetch('_api/get_products?')
            if (!productsRes.ok) throw new Error('Failed to fetch products')
            const productsData = await productsRes.json()

            if (!productsData.success) throw new Error('API returned error')
            state.rawData = productsData.result || []

            // Rebuild table headers
            buildTableHeaders()

            // Reset state
            state.filtered = [...state.rawData]
            state.page = 1
            state.sortKey = null
            state.sortDir = 'asc'

            // Re-attach sort listeners
            attachSortListeners()

            // Render
            filterAndRender()
          } catch (err) {
            console.error('Fetch error:', err)
            alert('Failed to load data: ' + err.message)
            state.filtered = []
            render()
          } finally {
            showLoading(false)
          }
        }

        // ===== BUILD HEADERS DYNAMICALLY =====
        function buildTableHeaders() {
          // Clear existing
          headersContainer.innerHTML = ''

          // Add ID column manually
          const idTh = document.createElement('th')
          idTh.setAttribute('data-key', 'id')
          idTh.innerHTML = '<div class="colwrap">#<span class="sort">⇅</span></div>'
          headersContainer.appendChild(idTh)

          // Add dynamic columns from fields
          state.fields.forEach(field => {
            const th = document.createElement('th')
            let fcap = field.caption;
            let fname = field.name;

            th.setAttribute('data-key', fname);
            th.innerHTML = '<div class="colwrap">' + fcap + '<span class="sort">⇅</span></div>';
            headersContainer.appendChild(th)
          })

          // Add Actions column
          const actionsTh = document.createElement('th')
          actionsTh.innerHTML = '<div class="colwrap">Actions</div>'
          actionsTh.style.textAlign = 'center'
          headersContainer.appendChild(actionsTh)
        }

        // ===== ATTACH SORT LISTENERS =====
        function attachSortListeners() {
          const headers = document.querySelectorAll('#dt thead th')
          headers.forEach(h => {
            h.removeEventListener('click', handleSortClick) // avoid duplicates
            h.addEventListener('click', handleSortClick)
          })
        }

        function handleSortClick(e) {
          const key = e.currentTarget.getAttribute('data-key')
          if (!key) return // skip actions column

          if (state.sortKey === key) {
            state.sortDir = state.sortDir === 'asc' ? 'desc' : 'asc'
          } else {
            state.sortKey = key
            state.sortDir = 'asc'
          }
          updateSortIndicators()
          filterAndRender()
        }

        // ===== UPDATE SORT INDICATORS =====
        function updateSortIndicators() {
          document.querySelectorAll('#dt thead th .sort').forEach(span => {
            span.textContent = '⇅'
          })
          if (state.sortKey) {
            const th = document.querySelector('#dt thead th[data-key="' + state.sortKey + `"]`);
            if (th) {
              const span = th.querySelector('.sort')
              if (span) span.textContent = state.sortDir === 'asc' ? '▲' : '▼'
            }
          }
        }

        // ===== FILTER & SORT =====
        function filterAndRender() {
          const q = state.q
          state.filtered = state.rawData.filter(row => {
            if (!q) return true
            return Object.values(row).some(v => String(v).toLowerCase().includes(q))
          })

          if (state.sortKey) sortData()
          render()
        }

        function sortData() {
          const k = state.sortKey
          const dir = state.sortDir === 'asc' ? 1 : -1
          state.filtered.sort((a, b) => {
            let va = a[k], vb = b[k]
            if (va == null) va = ''
            if (vb == null) vb = ''

            // numeric
            if (!isNaN(Number(va)) && !isNaN(Number(vb))) {
              return (Number(va) - Number(vb)) * dir
            }

            // date (supports both YYYY-MM-DD and YYYY-MM-DD HH:MM:SS)
            if (typeof va === 'string' && typeof vb === 'string') {
              const dateA = new Date(va)
              const dateB = new Date(vb)
              if (!isNaN(dateA) && !isNaN(dateB)) {
                return (dateA - dateB) * dir
              }
            }

            // string
            return String(va).localeCompare(String(vb)) * dir
          })
        }

        // ===== RENDER TABLE =====
        function render() {
          const total = state.filtered.length
          const start = (state.page - 1) * state.pageLength
          const end = Math.min(start + state.pageLength, total)
          const rows = state.filtered.slice(start, end)

          tbody.innerHTML = rows.map(r => {
            let rowHtml = `<tr><td>${r.id}</td>`

            // Dynamic fields
            state.fields.forEach(field => {
              let value = r[field.name] ?? ''
              if (field.type === 'number') value = Number(value).toLocaleString()
              if (field.type === 'date' && value) {
                // Format date: show only date part if time is 00:00:00, else show full
                const d = new Date(value)
                if (value.includes(' ') && value.split(' ')[1] === '00:00:00') {
                  value = value.split(' ')[0]
                } else {
                  value = new Date(value).toLocaleString()
                }
              }
              rowHtml += `<td>${value}</td>`
            })

            // Actions column
            rowHtml += `
              <td style="text-align:center">
                <div class="flowline left themeround">
                  <button class="w3-btn w3-black editbtn themehover" data-tooltip="edit" data-role="edit_record" data-myid="${r.id}" onclick="recordops(this)">
                    <i class="fa fa-pencil-alt"></i>
                  </button>
                  <button class="w3-btn w3-black editbtn themehover" data-tooltip="delete" data-role="delete_record" data-myid="${r.id}" onclick="recordops(this)">
                    <i class="fa fa-trash"></i>
                  </button>
                  <button class="w3-btn w3-black editbtn themehover" data-tooltip="view" data-role="view_record" data-myid="${r.id}" onclick="recordops(this)">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>
              </td>
            </tr>`
            return rowHtml
          }).join('')

          info.textContent = total === 0 ? 'No entries to show' : `Showing ${start + 1} to ${end} of ${total} entries`
          renderPagination(total)
        }

        // ===== PAGINATION =====
        function renderPagination(total) {
          const pages = Math.max(1, Math.ceil(total / state.pageLength))
          if (state.page > pages) state.page = pages
          const range = paginationRange(state.page, pages, 5)
          pagination.innerHTML = ''

          // Prev
          const prev = mkBtn('Prev', state.page === 1)
          prev.addEventListener('click', () => { if (state.page > 1) { state.page--; render() } })
          pagination.appendChild(prev)

          // Pages
          range.forEach(p => {
            if (p === '...') {
              const span = document.createElement('div')
              span.className = 'page-btn'
              span.textContent = '...'
              span.style.cursor = 'default'
              pagination.appendChild(span)
            } else {
              const btn = mkBtn(p, false, p === state.page)
              btn.addEventListener('click', () => { state.page = p; render() })
              pagination.appendChild(btn)
            }
          })

          // Next
          const next = mkBtn('Next', state.page === pages)
          next.addEventListener('click', () => { if (state.page < pages) { state.page++; render() } })
          pagination.appendChild(next)
        }

        function mkBtn(text, disabled = false, active = false) {
          const b = document.createElement('button')
          b.className = 'page-btn' + (active ? ' active' : '')
          b.textContent = text
          if (disabled) b.disabled = true
          return b
        }

        function paginationRange(current, total, length) {
          const out = []
          if (total <= length) {
            for (let i = 1; i <= total; i++) out.push(i)
            return out
          }
          const left = Math.max(1, current - Math.floor(length / 2))
          const right = Math.min(total, left + length - 1)
          if (left > 1) out.push(1), out.push('...')
          for (let i = left; i <= right; i++) out.push(i)
          if (right < total) out.push('...'), out.push(total)
          return out
        }

        // runtime
        function recordops(who) {
          alert_dark('running op');
        }

        // ===== INIT =====
        fetchData() // Load data on startup
      </script>
