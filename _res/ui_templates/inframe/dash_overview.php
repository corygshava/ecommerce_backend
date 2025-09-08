<style>
    <?php
        include __DIR__.'/tmp_styles.php';
    ?>
</style>

<!-- Dashboard Content -->
<div class="dashboard-content">
    <h1 class="page-title">Dashboard Overview</h1>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card earnings-card positive">
            <div class="header">
                <span class="title">Total Earnings</span>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div class="value">$124,563</div>
            <div class="change">
                <i class="fas fa-arrow-up"></i>
                <span>12.5% from last month</span>
            </div>
        </div>

        <div class="stat-card orders-card positive">
            <div class="header">
                <span class="title">Total Orders</span>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
            <div class="value">1,842</div>
            <div class="change">
                <i class="fas fa-arrow-up"></i>
                <span>8.2% from last month</span>
            </div>
        </div>

        <div class="stat-card products-card">
            <div class="header">
                <span class="title">Products Available</span>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
            </div>
            <div class="value">847</div>
            <div class="change">
                <i class="fas fa-plus"></i>
                <span>23 new this week</span>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Revenue Overview</h3>
                <select style="padding: 5px 10px; border: 1px solid var(--light-gray); border-radius: 5px;">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>Last 90 days</option>
                </select>
            </div>
            <div class="chart">
                <i class="fas fa-chart-line" style="font-size: 48px; color: var(--gold);"></i>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Top Categories</h3>
            </div>
            <div class="chart">
                <i class="fas fa-chart-pie" style="font-size: 48px; color: var(--gold);"></i>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="table-card">
        <div class="table-header">
            <h3 class="table-title">Recent Orders</h3>
            <button class="view-all-btn">View All</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#ORD-001</td>
                    <td>Emma Johnson</td>
                    <td>Louis Vuitton Bag</td>
                    <td>$2,450</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>#ORD-002</td>
                    <td>Michael Chen</td>
                    <td>Rolex Watch</td>
                    <td>$12,800</td>
                    <td><span class="status processing">Processing</span></td>
                </tr>
                <tr>
                    <td>#ORD-003</td>
                    <td>Sarah Williams</td>
                    <td>Chanel Perfume</td>
                    <td>$350</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>#ORD-004</td>
                    <td>James Anderson</td>
                    <td>Gucci Belt</td>
                    <td>$450</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                    <td>#ORD-005</td>
                    <td>Lisa Rodriguez</td>
                    <td>Hermès Scarf</td>
                    <td>$680</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>