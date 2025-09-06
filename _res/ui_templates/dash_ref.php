<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeVault Admin Dashboard</title>
    <link rel="stylesheet" href="_assets/css/fa-all.css">
    <link rel="stylesheet" href="_assets/css/fonts.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> -->
    <?php
        $wanted = "dark";
        include __DIR__.'/tmp_styles.php';
    ?>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h2>LuxeVault</h2>
        </div>

        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-shopping-bag"></i> Orders</a></li>
            <li><a href="#"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Customers</a></li>
            <li><a href="#"><i class="fas fa-chart-line"></i> Analytics</a></li>
            <li><a href="#"><i class="fas fa-percent"></i> Promotions</a></li>
            <li><a href="#"><i class="fas fa-star"></i> Reviews</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-palette"></i> Appearance</a></li>
            <li><a href="#"><i class="fas fa-credit-card"></i> Payments</a></li>
            <li><a href="#"><i class="fas fa-shipping-fast"></i> Shipping</a></li>
            <li><a href="#"><i class="fas fa-headset"></i> Support</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="breadcrumb">
                <strong>Dashboard</strong> / Overview
            </div>
            <div class="user-menu">
                <button class="user-btn" onclick="toggleDropdown()">
                    <div class="user-avatar">A</div>
                    <span>Admin User</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown" id="userDropdown">
                    <a href="#"><i class="fas fa-user-edit"></i> Edit Details</a>
                    <a href="_dataops/trylogout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </nav>

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
    </main>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');
            
            if (!userMenu.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Add active class to current menu item
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelector('.sidebar-menu a.active').classList.remove('active');
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>