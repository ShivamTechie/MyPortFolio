<div class="content-section">
    <h1>Change Password</h1>
    
    <div style="max-width: 500px;">
        <div class="alert alert-info" style="background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <i class="fas fa-info-circle"></i> 
            <strong>Security Tip:</strong> Use a strong password with at least 6 characters, including letters and numbers.
        </div>

        <form action="<?php echo ADMIN_URL; ?>?page=change-password" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
            
            <div class="form-group">
                <label for="current_password">Current Password *</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required autofocus>
            </div>

            <div class="form-group">
                <label for="new_password">New Password *</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required minlength="6">
                <small style="color: #666; font-size: 12px;">Minimum 6 characters</small>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password *</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required minlength="6">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-key"></i> Change Password
                </button>
                <a href="<?php echo ADMIN_URL; ?>?page=dashboard" class="btn">Cancel</a>
            </div>
        </form>

        <div style="margin-top: 30px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 5px;">
            <strong>⚠️ Important:</strong> After changing your password, you will be logged out and need to login again with your new password.
        </div>
    </div>
</div>

<script>
// Client-side password match validation
document.querySelector('form').addEventListener('submit', function(e) {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (newPassword !== confirmPassword) {
        e.preventDefault();
        alert('New passwords do not match!');
        return false;
    }
});
</script>
