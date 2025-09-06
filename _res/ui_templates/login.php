<?php
    $passdata = isset($passdata) ? $passdata : 'none';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JRM admin panel - Login</title>
    <?php
        require_once '_assets/pieces/head_piece.php'; // init styles
    ?>
</head>
<body>
    <div class="content centroid t2">
        <div class="container formguy w3-animate-zoom" data-shown="1" id="login">
            <div class="hd">
                <span class="h2">My Admin</span>
                <p>
                    enter your details to login
                    <?php
                        echo "...";
                    ?>
                </p>
            </div>

            <form id="loginForm" action="_handlereq/trylogin" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>

                <div class="checkbox-wrapper w3-hide">
                    <input type="checkbox" id="rememberMe" name="rememberMe">
                    <label for="rememberMe">Remember me</label>
                </div>

                <button type="submit" class="in_fullwidth btn multicolor">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div class="forgot-password w3-hide">
                <a href="#" onclick="toggletabs(1)">Forgot your password?</a>
            </div>
        </div>

        <div class="container formguy w3-animate-zoom" data-shown="0" id="forget">
            <div class="hd">
                <span class="h3">Forgot password?</span>
                <p>enter your registered email to get the password reset link</p>
            </div>

            <form id="forgetform">
                <div class="form-group">
                    <label for="username">Email</label>
                    <div class="input-wrapper">
                        <input type="text" id="theemail" name="theemail" class="form-control" placeholder="Enter your email" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <button type="submit" class="in_fullwidth btn multicolor">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div class="forgot-password">
                <a href="#" onclick="toggletabs(0)">login instead</a>
            </div>
        </div>
    </div>

    <script>
        const theform = document.getElementById('loginForm');

        theform.addEventListener('submit', function(e) {
            // e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;
            
            // Here you would normally handle the login logic
            console.log('Login attempt:', { username, password, rememberMe });
            
            // Add loading state
            const btn = document.querySelector('.login.btn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
            btn.disabled = true;
            
            // Simulate login delay
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Success!';
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Login';
                    btn.disabled = false;
                }, 1000);   
            }, 1500);
        });

        // Add focus effects
        const inputs = document.querySelectorAll('.form-control');

        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                // this.parentElement.querySelector('i').style.color = 'var(--primary)';
            });
            
            input.addEventListener('blur', function() {
                // this.parentElement.querySelector('i').style.color = 'var(--gray)';
            });
        });

        function toggletabs(n) {
            let series = '.container';
            let items = document.querySelectorAll(series);

            tabSwitch(n,series,'none','block');

            items.forEach((el,id) => {
                let sh = id == n ? 1 : 0;
                el.dataset.shown = sh;
            });
        }

        <?php
            if($passdata !== "none"){
        ?>
            alert_warning(`<?=$passdata?>`);
        <?php
            }
        ?>
    </script>
</body>
</html>