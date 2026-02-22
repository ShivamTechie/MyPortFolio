<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Admin Panel</title>
    
    <!-- Favicon -->
    <link href="<?php echo BASE_URL; ?>/public/assets/images/logo.png" rel="icon" type="image/png">
    <link href="<?php echo BASE_URL; ?>/public/assets/images/logo.png" rel="apple-touch-icon">
    
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="admin-wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                    <img src="<?php echo BASE_URL; ?>/public/assets/images/logo.png" alt="Logo" style="height: 40px; width: 40px;">
                    <h2 style="margin: 0;">Admin</h2>
                </div>
                <p>Welcome, <?php echo Session::get('username'); ?></p>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="<?php echo ADMIN_URL; ?>?page=dashboard" class="<?php echo (!isset($_GET['page']) || $_GET['page'] == 'dashboard') ? 'active' : ''; ?>">
                    <i class="fas fa-home"></i> Dashboard
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=profile" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'profile') ? 'active' : ''; ?>">
                    <i class="fas fa-user"></i> Profile
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=experience" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'experience') ? 'active' : ''; ?>">
                    <i class="fas fa-briefcase"></i> Experience
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=education" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'education') ? 'active' : ''; ?>">
                    <i class="fas fa-graduation-cap"></i> Education
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=skills" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'skills') ? 'active' : ''; ?>">
                    <i class="fas fa-code"></i> Skills
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=projects" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'projects') ? 'active' : ''; ?>">
                    <i class="fas fa-folder"></i> Projects
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=services" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'services') ? 'active' : ''; ?>">
                    <i class="fas fa-tools"></i> Services
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=testimonials" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'testimonials') ? 'active' : ''; ?>">
                    <i class="fas fa-star"></i> Testimonials
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=blog" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'blog') ? 'active' : ''; ?>">
                    <i class="fas fa-blog"></i> Blog Posts
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=messages" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'messages') ? 'active' : ''; ?>">
                    <i class="fas fa-envelope"></i> Messages
                    <?php 
                    require_once APP_PATH . '/models/ContactMessage.php';
                    $msgModel = new ContactMessage();
                    $unread = $msgModel->countUnread();
                    if ($unread > 0): 
                    ?>
                        <span class="badge"><?php echo $unread; ?></span>
                    <?php endif; ?>
                </a></li>
                
                <li><a href="<?php echo BASE_URL; ?>" target="_blank">
                    <i class="fas fa-external-link-alt"></i> View Website
                </a></li>
                
                <li><a href="<?php echo ADMIN_URL; ?>?page=logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a></li>
            </ul>
        </nav>

        <div class="main-content">
            <div class="content-wrapper">
                <?php 
                $flash = Session::flash('success');
                if ($flash): 
                ?>
                <div class="alert alert-<?php echo $flash['type']; ?>">
                    <?php echo htmlspecialchars($flash['message']); ?>
                </div>
                <?php endif; ?>

                <?php 
                $flash = Session::flash('error');
                if ($flash): 
                ?>
                <div class="alert alert-<?php echo $flash['type']; ?>">
                    <?php echo htmlspecialchars($flash['message']); ?>
                </div>
                <?php endif; ?>
