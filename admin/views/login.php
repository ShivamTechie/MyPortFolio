<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?php echo APP_NAME; ?></title>
    
    <!-- Favicon -->
    <link href="<?php echo BASE_URL; ?>/public/assets/images/logo.png" rel="icon" type="image/png">
    <link href="<?php echo BASE_URL; ?>/public/assets/images/logo.png" rel="apple-touch-icon">
    
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <img src="<?php echo BASE_URL; ?>/public/assets/images/logo.png" alt="Logo" style="height: 60px; width: 60px; margin: 0 auto 20px;">
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

            <form id="loginForm" class="login-form">
                <input type="hidden" id="csrf_token" value="<?php echo $csrfToken; ?>">
                
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
                <p>Login with your credentials</p>
            </div>

            <script>
                document.getElementById('loginForm').addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    // Clear previous errors
                    document.getElementById('usernameError').textContent = '';
                    document.getElementById('passwordError').textContent = '';
                    document.getElementById('clientError').style.display = 'none';
                    
                    // Get values
                    const username = document.getElementById('username').value.trim();
                    const password = document.getElementById('password').value;
                    const csrfToken = document.getElementById('csrf_token').value;
                    
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
                    
                    if (hasError) return;
                    
                    // Show loading
                    document.getElementById('btnText').style.display = 'none';
                    document.getElementById('btnLoader').style.display = 'inline';
                    document.getElementById('loginBtn').disabled = true;
                    
                    // AJAX Login
                    try {
                        const formData = new FormData();
                        formData.append('username', username);
                        formData.append('password', password);
                        formData.append('csrf_token', csrfToken);
                        
                        const response = await fetch('<?php echo ADMIN_URL; ?>/authenticate.php', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            window.location.href = data.redirect;
                        } else {
                            document.getElementById('clientError').textContent = data.message;
                            document.getElementById('clientError').style.display = 'block';
                            document.getElementById('btnText').style.display = 'inline';
                            document.getElementById('btnLoader').style.display = 'none';
                            document.getElementById('loginBtn').disabled = false;
                        }
                    } catch (error) {
                        document.getElementById('clientError').textContent = 'Login failed. Please try again.';
                        document.getElementById('clientError').style.display = 'block';
                        document.getElementById('btnText').style.display = 'inline';
                        document.getElementById('btnLoader').style.display = 'none';
                        document.getElementById('loginBtn').disabled = false;
                    }
                });
            </script>
        </div>
    </div>
</body>
</html>
