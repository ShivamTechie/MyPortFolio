<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>Admin Panel</h1>
                <p>Portfolio Management System</p>
            </div>

            <?php 
            $flash = Session::flash('error');
            if ($flash): 
            ?>
            <div class="alert alert-<?php echo $flash['type']; ?>" id="errorAlert">
                <?php echo htmlspecialchars($flash['message']); ?>
            </div>
            <?php endif; ?>

            <div class="alert alert-error" id="clientError" style="display: none;"></div>

            <form action="<?php echo ADMIN_URL; ?>?page=authenticate" method="POST" class="login-form" id="loginForm">
                <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required autofocus>
                    <small class="error-message" id="usernameError"></small>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <small class="error-message" id="passwordError"></small>
                </div>

                <button type="submit" class="btn btn-primary" id="loginBtn">
                    <span id="btnText">Login</span>
                    <span id="btnLoader" style="display: none;">Logging in...</span>
                </button>
            </form>

            <div class="login-footer">
                <p>Default credentials: admin / admin123</p>
                <p>Please change password after first login</p>
            </div>

            <script>
                document.getElementById('loginForm').addEventListener('submit', function(e) {
                    // Clear previous errors
                    document.getElementById('usernameError').textContent = '';
                    document.getElementById('passwordError').textContent = '';
                    document.getElementById('clientError').style.display = 'none';
                    
                    // Get values
                    const username = document.getElementById('username').value.trim();
                    const password = document.getElementById('password').value;
                    
                    // Basic validation
                    let hasError = false;
                    
                    if (!username) {
                        document.getElementById('usernameError').textContent = 'Username is required';
                        hasError = true;
                    }
                    
                    if (!password) {
                        document.getElementById('passwordError').textContent = 'Password is required';
                        hasError = true;
                    }
                    
                    if (hasError) {
                        e.preventDefault();
                        return false;
                    }
                    
                    // Show loading
                    document.getElementById('btnText').style.display = 'none';
                    document.getElementById('btnLoader').style.display = 'inline';
                    document.getElementById('loginBtn').disabled = true;
                });
            </script>
        </div>
    </div>
</body>
</html>
