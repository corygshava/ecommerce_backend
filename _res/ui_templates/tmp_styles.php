<?php
	$wanted = isset($wanted) ? $wanted : "dark";

	if($wanted == "dark"){
		echo <<<HTML
			<style>
				:root {
					--primary: #f5f5f5;
					--gold: #d4af37;
					--gold-light: #f4e5a1;
					--dark: #0a0a0a;
					--light: #1a1a1a;
					--gray: #aaa;
					--light-gray: #333;
					--white: #121212;
					--shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
					--shadow-hover: 0 4px 20px rgba(0, 0, 0, 0.8);
				}

				* {
					margin: 0;
					padding: 0;
					box-sizing: border-box;
				}

				body {
					font-family: 'Inter_24pt', sans-serif;
					background-color: var(--light);
					color: var(--primary);
					display: flex;
					min-height: 100vh;
				}

				/* Sidebar */
				.sidebar {
					width: 280px;
					background: var(--white);
					box-shadow: var(--shadow);
					padding: 30px 0;
					position: fixed;
					height: 100vh;
					overflow-y: auto;
					z-index: 1000;
				}

				.sidebar-header {
					padding: 0 30px 30px;
					border-bottom: 1px solid var(--light-gray);
					margin-bottom: 30px;
				}

				.sidebar-header h2 {
					font-size: 24px;
					font-weight: 700;
					color: var(--primary);
					display: flex;
					align-items: center;
					gap: 10px;
				}

				.sidebar-header h2::before {
					content: '';
					width: 30px;
					height: 30px;
					background: linear-gradient(135deg, var(--gold), var(--gold-light));
					border-radius: 8px;
					display: inline-block;
				}

				.sidebar-menu {
					list-style: none;
				}

				.sidebar-menu li {
					margin-bottom: 5px;
				}

				.sidebar-menu a {
					display: flex;
					align-items: center;
					padding: 15px 30px;
					color: var(--gray);
					text-decoration: none;
					transition: all 0.3s ease;
					font-weight: 500;
					gap: 12px;
				}

				.sidebar-menu a:hover,
				.sidebar-menu a.active {
					background: linear-gradient(90deg, rgba(212,175,55,0.2), transparent);
					color: var(--primary);
					border-right: 3px solid var(--gold);
				}

				.sidebar-menu a i {
					width: 20px;
					text-align: center;
				}

				/* Main Content */
				.main-content {
					flex: 1;
					margin-left: 280px;
					background-color: #181818;
					min-height: 100vh;
				}

				/* Navbar */
				.navbar {
					background: var(--white);
					padding: 20px 40px;
					box-shadow: var(--shadow);
					display: flex;
					justify-content: space-between;
					align-items: center;
					position: sticky;
					top: 0;
					z-index: 100;
				}

				.breadcrumb {
					font-size: 14px;
					color: var(--gray);
				}

				.breadcrumb strong {
					color: var(--primary);
					font-weight: 600;
				}

				.user-menu {
					position: relative;
				}

				.user-btn {
					display: flex;
					align-items: center;
					gap: 10px;
					background: none;
					border: none;
					cursor: pointer;
					font-family: 'Poppins', sans-serif;
					color: var(--primary);
					font-weight: 500;
					padding: 10px;
					border-radius: 8px;
					transition: background-color 0.3s ease;
				}

				.user-btn:hover {
					background-color: var(--light-gray);
				}

				.user-avatar {
					width: 40px;
					height: 40px;
					border-radius: 50%;
					background: linear-gradient(135deg, var(--gold), var(--gold-light));
					display: flex;
					align-items: center;
					justify-content: center;
					color: var(--white);
					font-weight: 600;
				}

				.dropdown {
					position: absolute;
					top: 100%;
					right: 0;
					background: var(--white);
					box-shadow: var(--shadow-hover);
					border-radius: 12px;
					padding: 10px 0;
					margin-top: 10px;
					min-width: 180px;
					opacity: 0;
					visibility: hidden;
					transform: translateY(-10px);
					transition: all 0.3s ease;
				}

				.dropdown.show {
					opacity: 1;
					visibility: visible;
					transform: translateY(0);
				}

				.dropdown a {
					display: block;
					padding: 12px 20px;
					color: var(--primary);
					text-decoration: none;
					transition: background-color 0.3s ease;
					font-size: 14px;
				}

				.dropdown a:hover {
					background-color: var(--light-gray);
				}

				.dropdown a i {
					margin-right: 10px;
					width: 16px;
				}

				/* Dashboard Content */
				.dashboard-content {
					padding: 40px;
				}

				.page-title {
					font-size: 32px;
					font-weight: 700;
					margin-bottom: 30px;
					color: var(--primary);
				}

				/* Stats Cards */
				.stats-grid {
					display: grid;
					grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
					gap: 30px;
					margin-bottom: 40px;
				}

				.stat-card {
					background: var(--white);
					padding: 30px;
					border-radius: 16px;
					box-shadow: var(--shadow);
					transition: transform 0.3s ease, box-shadow 0.3s ease;
				}

				.stat-card:hover {
					transform: translateY(-5px);
					box-shadow: var(--shadow-hover);
				}

				.stat-card .header {
					display: flex;
					justify-content: space-between;
					align-items: center;
					margin-bottom: 20px;
				}

				.stat-card .title {
					font-size: 14px;
					color: var(--gray);
					font-weight: 500;
				}

				.stat-card .icon {
					width: 50px;
					height: 50px;
					border-radius: 12px;
					display: flex;
					align-items: center;
					justify-content: center;
					font-size: 24px;
				}

				.stat-card .value {
					font-size: 32px;
					font-weight: 700;
					color: var(--primary);
					margin-bottom: 10px;
				}

				.stat-card .change {
					font-size: 14px;
					display: flex;
					align-items: center;
					gap: 5px;
				}

				.stat-card.positive .change {
					color: #34d399;
				}

				.stat-card.negative .change {
					color: #f87171;
				}

				/* Earnings Card */
				.earnings-card .icon {
					background: linear-gradient(135deg, #10b981, #34d399);
					color: white;
				}

				/* Orders Card */
				.orders-card .icon {
					background: linear-gradient(135deg, #3b82f6, #60a5fa);
					color: white;
				}

				/* Products Card */
				.products-card .icon {
					background: linear-gradient(135deg, var(--gold), var(--gold-light));
					color: white;
				}

				/* Charts */
				.charts-grid {
					display: grid;
					grid-template-columns: 2fr 1fr;
					gap: 30px;
					margin-bottom: 40px;
				}

				.chart-card {
					background: var(--white);
					padding: 30px;
					border-radius: 16px;
					box-shadow: var(--shadow);
				}

				.chart-header {
					display: flex;
					justify-content: space-between;
					align-items: center;
					margin-bottom: 20px;
				}

				.chart-title {
					font-size: 18px;
					font-weight: 600;
					color: var(--primary);
				}

				.chart {
					height: 300px;
					background: var(--light-gray);
					border-radius: 8px;
					display: flex;
					align-items: center;
					justify-content: center;
					color: var(--gray);
					font-size: 14px;
				}

				/* Table */
				.table-card {
					background: var(--white);
					border-radius: 16px;
					box-shadow: var(--shadow);
					overflow: hidden;
				}

				.table-header {
					padding: 30px;
					border-bottom: 1px solid var(--light-gray);
					display: flex;
					justify-content: space-between;
					align-items: center;
				}

				.table-title {
					font-size: 18px;
					font-weight: 600;
					color: var(--primary);
				}

				.view-all-btn {
					background: none;
					border: 1px solid var(--gold);
					color: var(--gold);
					padding: 8px 16px;
					border-radius: 8px;
					font-size: 14px;
					cursor: pointer;
					transition: all 0.3s ease;
				}

				.view-all-btn:hover {
					background: var(--gold);
					color: var(--white);
				}

				table {
					width: 100%;
					border-collapse: collapse;
				}

				th, td {
					padding: 15px 30px;
					text-align: left;
					border-bottom: 1px solid var(--light-gray);
				}

				th {
					font-weight: 600;
					color: var(--primary);
					font-size: 14px;
				}

				td {
					color: var(--gray);
					font-size: 14px;
				}

				.status {
					padding: 4px 12px;
					border-radius: 20px;
					font-size: 12px;
					font-weight: 500;
				}

				.status.completed {
					background: #064e3b;
					color: #a7f3d0;
				}

				.status.processing {
					background: #78350f;
					color: #fde68a;
				}

				.status.pending {
					background: #7f1d1d;
					color: #fecaca;
				}

				/* Responsive */
				@media (max-width: 1024px) {
					.charts-grid {
						grid-template-columns: 1fr;
					}
					
					.sidebar {
						width: 250px;
					}
					
					.main-content {
						margin-left: 250px;
					}
				}

				@media (max-width: 768px) {
					.sidebar {
						transform: translateX(-100%);
						transition: transform 0.3s ease;
					}
					
					.sidebar.active {
						transform: translateX(0);
					}
					
					.main-content {
						margin-left: 0;
					}
					
					.navbar {
						padding: 15px 20px;
					}
					
					.dashboard-content {
						padding: 20px;
					}
					
					.stats-grid {
						grid-template-columns: 1fr;
					}
				}
			</style>
		HTML;
	} else {
		echo <<<HTML
			<style>
				:root {
					--primary: #1a1a1a;
					--gold: #d4af37;
					--gold-light: #f4e5a1;
					--dark: #0a0a0a;
					--light: #fafafa;
					--gray: #666;
					--light-gray: #e5e5e5;
					--white: #ffffff;
					--shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
					--shadow-hover: 0 4px 20px rgba(0, 0, 0, 0.15);
				}

				* {
					margin: 0;
					padding: 0;
					box-sizing: border-box;
				}

				body {
					font-family: 'Poppins', sans-serif;
					background-color: var(--light);
					color: var(--primary);
					display: flex;
					min-height: 100vh;
				}

				/* Sidebar Styles */
				.sidebar {
					width: 280px;
					background: var(--white);
					box-shadow: var(--shadow);
					padding: 30px 0;
					position: fixed;
					height: 100vh;
					overflow-y: auto;
					z-index: 1000;
				}

				.sidebar-header {
					padding: 0 30px 30px;
					border-bottom: 1px solid var(--light-gray);
					margin-bottom: 30px;
				}

				.sidebar-header h2 {
					font-size: 24px;
					font-weight: 700;
					color: var(--primary);
					display: flex;
					align-items: center;
					gap: 10px;
				}

				.sidebar-header h2::before {
					content: '';
					width: 30px;
					height: 30px;
					background: linear-gradient(135deg, var(--gold), var(--gold-light));
					border-radius: 8px;
					display: inline-block;
				}

				.sidebar-menu {
					list-style: none;
				}

				.sidebar-menu li {
					margin-bottom: 5px;
				}

				.sidebar-menu a {
					display: flex;
					align-items: center;
					padding: 15px 30px;
					color: var(--gray);
					text-decoration: none;
					transition: all 0.3s ease;
					font-weight: 500;
					gap: 12px;
				}

				.sidebar-menu a:hover,
				.sidebar-menu a.active {
					background: linear-gradient(90deg, var(--gold-light), transparent);
					color: var(--primary);
					border-right: 3px solid var(--gold);
				}

				.sidebar-menu a i {
					width: 20px;
					text-align: center;
				}

				/* Main Content Styles */
				.main-content {
					flex: 1;
					margin-left: 280px;
					background-color: #f8f9fa;
					min-height: 100vh;
				}

				/* Navbar Styles */
				.navbar {
					background: var(--white);
					padding: 20px 40px;
					box-shadow: var(--shadow);
					display: flex;
					justify-content: space-between;
					align-items: center;
					position: sticky;
					top: 0;
					z-index: 100;
				}

				.breadcrumb {
					font-size: 14px;
					color: var(--gray);
				}

				.breadcrumb strong {
					color: var(--primary);
					font-weight: 600;
				}

				.user-menu {
					position: relative;
				}

				.user-btn {
					display: flex;
					align-items: center;
					gap: 10px;
					background: none;
					border: none;
					cursor: pointer;
					font-family: 'Poppins', sans-serif;
					color: var(--primary);
					font-weight: 500;
					padding: 10px;
					border-radius: 8px;
					transition: background-color 0.3s ease;
				}

				.user-btn:hover {
					background-color: var(--light-gray);
				}

				.user-avatar {
					width: 40px;
					height: 40px;
					border-radius: 50%;
					background: linear-gradient(135deg, var(--gold), var(--gold-light));
					display: flex;
					align-items: center;
					justify-content: center;
					color: var(--white);
					font-weight: 600;
				}

				.dropdown {
					position: absolute;
					top: 100%;
					right: 0;
					background: var(--white);
					box-shadow: var(--shadow-hover);
					border-radius: 12px;
					padding: 10px 0;
					margin-top: 10px;
					min-width: 180px;
					opacity: 0;
					visibility: hidden;
					transform: translateY(-10px);
					transition: all 0.3s ease;
				}

				.dropdown.show {
					opacity: 1;
					visibility: visible;
					transform: translateY(0);
				}

				.dropdown a {
					display: block;
					padding: 12px 20px;
					color: var(--primary);
					text-decoration: none;
					transition: background-color 0.3s ease;
					font-size: 14px;
				}

				.dropdown a:hover {
					background-color: var(--light-gray);
				}

				.dropdown a i {
					margin-right: 10px;
					width: 16px;
				}

				/* Dashboard Content Styles */
				.dashboard-content {
					padding: 40px;
				}

				.page-title {
					font-size: 32px;
					font-weight: 700;
					margin-bottom: 30px;
					color: var(--primary);
				}

				/* Stats Cards */
				.stats-grid {
					display: grid;
					grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
					gap: 30px;
					margin-bottom: 40px;
				}

				.stat-card {
					background: var(--white);
					padding: 30px;
					border-radius: 16px;
					box-shadow: var(--shadow);
					transition: transform 0.3s ease, box-shadow 0.3s ease;
				}

				.stat-card:hover {
					transform: translateY(-5px);
					box-shadow: var(--shadow-hover);
				}

				.stat-card .header {
					display: flex;
					justify-content: space-between;
					align-items: center;
					margin-bottom: 20px;
				}

				.stat-card .title {
					font-size: 14px;
					color: var(--gray);
					font-weight: 500;
				}

				.stat-card .icon {
					width: 50px;
					height: 50px;
					border-radius: 12px;
					display: flex;
					align-items: center;
					justify-content: center;
					font-size: 24px;
				}

				.stat-card .value {
					font-size: 32px;
					font-weight: 700;
					color: var(--primary);
					margin-bottom: 10px;
				}

				.stat-card .change {
					font-size: 14px;
					display: flex;
					align-items: center;
					gap: 5px;
				}

				.stat-card.positive .change {
					color: #10b981;
				}

				.stat-card.negative .change {
					color: #ef4444;
				}

				/* Earnings Card */
				.earnings-card .icon {
					background: linear-gradient(135deg, #10b981, #34d399);
					color: white;
				}

				/* Orders Card */
				.orders-card .icon {
					background: linear-gradient(135deg, #3b82f6, #60a5fa);
					color: white;
				}

				/* Products Card */
				.products-card .icon {
					background: linear-gradient(135deg, var(--gold), var(--gold-light));
					color: white;
				}

				/* Charts Section */
				.charts-grid {
					display: grid;
					grid-template-columns: 2fr 1fr;
					gap: 30px;
					margin-bottom: 40px;
				}

				.chart-card {
					background: var(--white);
					padding: 30px;
					border-radius: 16px;
					box-shadow: var(--shadow);
				}

				.chart-header {
					display: flex;
					justify-content: space-between;
					align-items: center;
					margin-bottom: 20px;
				}

				.chart-title {
					font-size: 18px;
					font-weight: 600;
					color: var(--primary);
				}

				.chart {
					height: 300px;
					background: var(--light-gray);
					border-radius: 8px;
					display: flex;
					align-items: center;
					justify-content: center;
					color: var(--gray);
					font-size: 14px;
				}

				/* Recent Orders Table */
				.table-card {
					background: var(--white);
					border-radius: 16px;
					box-shadow: var(--shadow);
					overflow: hidden;
				}

				.table-header {
					padding: 30px;
					border-bottom: 1px solid var(--light-gray);
					display: flex;
					justify-content: space-between;
					align-items: center;
				}

				.table-title {
					font-size: 18px;
					font-weight: 600;
					color: var(--primary);
				}

				.view-all-btn {
					background: none;
					border: 1px solid var(--gold);
					color: var(--gold);
					padding: 8px 16px;
					border-radius: 8px;
					font-size: 14px;
					cursor: pointer;
					transition: all 0.3s ease;
				}

				.view-all-btn:hover {
					background: var(--gold);
					color: var(--white);
				}

				table {
					width: 100%;
					border-collapse: collapse;
				}

				th, td {
					padding: 15px 30px;
					text-align: left;
					border-bottom: 1px solid var(--light-gray);
				}

				th {
					font-weight: 600;
					color: var(--primary);
					font-size: 14px;
				}

				td {
					color: var(--gray);
					font-size: 14px;
				}

				.status {
					padding: 4px 12px;
					border-radius: 20px;
					font-size: 12px;
					font-weight: 500;
				}

				.status.completed {
					background: #d1fae5;
					color: #065f46;
				}

				.status.processing {
					background: #fef3c7;
					color: #92400e;
				}

				.status.pending {
					background: #fee2e2;
					color: #991b1b;
				}

				/* Responsive Design */
				@media (max-width: 1024px) {
					.charts-grid {
						grid-template-columns: 1fr;
					}
					
					.sidebar {
						width: 250px;
					}
					
					.main-content {
						margin-left: 250px;
					}
				}

				@media (max-width: 768px) {
					.sidebar {
						transform: translateX(-100%);
						transition: transform 0.3s ease;
					}
					
					.sidebar.active {
						transform: translateX(0);
					}
					
					.main-content {
						margin-left: 0;
					}
					
					.navbar {
						padding: 15px 20px;
					}
					
					.dashboard-content {
						padding: 20px;
					}
					
					.stats-grid {
						grid-template-columns: 1fr;
					}
				}
			</style>
		HTML;
	}
?>