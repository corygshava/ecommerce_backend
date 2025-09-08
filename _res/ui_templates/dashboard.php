<?php
    global $genui;
    global $s_userid;
    global $s_username;
    global $s_loggedin;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myAdmin - houseofJRM Dashboard</title>
    
    <?php
        require_once '_assets/pieces/head_piece.php'; // init styles
    ?>

    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> -->
    <?php
        $wanted = "dark";
        // include __DIR__.'/tmp_styles.php';
    ?>
</head>
<body>
    <div class="content t3">
        <!-- Sidebar -->
        <aside class="mysidebar" data-role="nav_sidebar">
            <div class="sidebar-header">
                <div class="title" data-cap="Jrm">
                    <span>
                        myAdmin<br>
                        <b>HouseofJRM</b>
                    </span>
                </div>
            </div>

            <div class="sidebar-menu">
                <?php $genui->gen_sidebar();?>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Navbar -->
            <div class="navbar">
                <div data-role="breadcrumb">
                    <strong>System</strong> / 
                    <span class="node">dashboard</span>
                </div>
                <div class="user-menu">
                    <button class="user-btn" data-toggler="#userDropdown">
                        <div class="user-avatar">
                            <img src="_uploads/portal_images/uid_4.jpg">
                        </div>
                        <span><?=$s_username?> User</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown w3-dropdown-content w3-animate-opacity" id="userDropdown" data-shown="0">
                        <a href="#"><i class="fas fa-user-edit"></i> Edit Details</a>
                        <a href="_dataops/trylogout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>

            <iframe class="in_fullwidth"></iframe>
            <?php // exit();?>
        </main>
    </div>

    <script>
        /*
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
        */
    </script>
</body>
</html>