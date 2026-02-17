# Quick Start Guide

Get your portfolio website up and running in minutes!

## Local Development Setup

### 1. Prerequisites
- PHP 8.0+ installed
- MySQL 8.0+ installed
- Apache server with mod_rewrite
- XAMPP/WAMP/MAMP (optional but recommended)

### 2. Quick Setup

```bash
# 1. Clone/Download project
# Already done if you're reading this!

# 2. Create database
mysql -u root -p
CREATE DATABASE portfolio_db;
exit;

# 3. Import schema
mysql -u root -p portfolio_db < database/schema.sql

# 4. Update configuration
# Edit: config/config.php
# Update DB credentials and BASE_URL

# 5. Start server (if using built-in)
php -S localhost:8000 -t public/

# Or use XAMPP/WAMP
# Place project in htdocs/ folder
# Access: http://localhost/portfolio
```

### 3. Access Application

**Frontend**: `http://localhost/portfolio` or `http://localhost:8000`
**Admin**: `http://localhost/portfolio/admin`

**Default Login**:
- Username: `admin`
- Password: `admin123`

## Hostinger Deployment (5-Minute Setup)

### Step 1: Upload Files
1. Login to Hostinger hPanel
2. File Manager → public_html
3. Upload entire `portfolio` folder

### Step 2: Create Database
1. MySQL Databases → Create new
2. Note: database name, username, password
3. phpMyAdmin → Import `database/schema.sql`

### Step 3: Configure
1. Edit `config/config.php` on server
2. Update database credentials
3. Update BASE_URL to your domain

### Step 4: Done!
Visit your website and login to admin panel

## What's Included

### ✅ Complete Features
- Modern responsive portfolio website
- Full admin panel with CRUD operations
- Profile, Experience, Education, Skills
- Projects, Services, Testimonials, Blog
- Contact form with SMTP email
- Secure authentication system
- Image upload functionality
- Database with sample data

### 📁 Project Structure
```
portfolio/
├── public/          → Your website (public facing)
├── admin/           → Admin panel
├── app/             → Application logic
├── config/          → Configuration
├── database/        → SQL schema
└── vendor/          → Dependencies (PHPMailer)
```

### 🎨 Design Features
- Beautiful gradient hero section
- Smooth animations
- Mobile responsive
- Modern card layouts
- Professional typography
- Font Awesome icons

### 🔒 Security Features
- Password hashing (bcrypt)
- CSRF protection
- XSS prevention
- SQL injection protection
- Secure file uploads
- Protected directories

## First Steps After Installation

### 1. Change Admin Password (IMPORTANT!)
- Login to admin panel
- Go to Profile settings
- Change password immediately

### 2. Update Your Information
- Edit profile (name, bio, contact)
- Upload profile picture
- Upload resume (PDF)

### 3. Add Your Content
- Work experience entries
- Education background
- Technical skills
- Portfolio projects
- Services you offer

### 4. Configure Email
- Get Gmail App Password
- Update SMTP settings in config
- Test contact form

### 5. Customize Design (Optional)
- Edit `public/assets/css/style.css` for colors
- Edit `public/assets/js/script.js` for behavior
- Add your own images

## Configuration Overview

### Database (config/config.php)
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'portfolio_db');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### URLs
```php
define('BASE_URL', 'http://localhost/portfolio');
define('ADMIN_URL', BASE_URL . '/admin');
```

### SMTP Email
```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
```

## Admin Panel Pages

After logging in, you'll have access to:

1. **Dashboard** - Overview and recent messages
2. **Profile** - Edit your personal information
3. **Experience** - Manage work history
4. **Education** - Manage academic background
5. **Skills** - Manage technical skills
6. **Projects** - Manage portfolio projects
7. **Services** - Manage service offerings
8. **Testimonials** - Manage client reviews
9. **Blog** - Create and publish posts
10. **Messages** - View contact form submissions

## Customization Tips

### Change Colors
Edit `public/assets/css/style.css`:
```css
:root {
    --primary-color: #667eea;     /* Your color */
    --secondary-color: #764ba2;   /* Your color */
}
```

### Add Social Links
Edit profile in admin panel - there are fields for:
- LinkedIn
- GitHub
- Twitter

### Upload Limits
Edit `.htaccess` or `php.ini`:
```
upload_max_filesize = 10M
post_max_size = 10M
```

## Common URLs

| Purpose | Local | Hostinger |
|---------|-------|-----------|
| Website | localhost/portfolio | yourdomain.com/portfolio |
| Admin | localhost/portfolio/admin | yourdomain.com/portfolio/admin |
| Login | /admin?page=login | /admin?page=login |
| Logout | /admin?page=logout | /admin?page=logout |

## Troubleshooting Quick Fixes

**500 Error**: Check .htaccess syntax
**Database Error**: Verify credentials in config.php
**404 on Admin**: Verify mod_rewrite is enabled
**Images Not Loading**: Check BASE_URL in config
**Email Not Sending**: Verify SMTP credentials

## Need Help?

1. **Read full documentation**: README.md
2. **Deployment guide**: DEPLOYMENT_GUIDE.md
3. **Contact developer**: shivamkk2001@gmail.com

## Your Tech Stack

- **Backend**: Custom PHP MVC
- **Database**: MySQL with 10+ tables
- **Frontend**: HTML5, CSS3, JavaScript
- **Email**: PHPMailer with SMTP
- **Icons**: Font Awesome 6
- **Security**: Industry best practices

## Development vs Production

### Development (Local)
```php
define('APP_ENV', 'development');
define('APP_DEBUG', true);
define('BASE_URL', 'http://localhost/portfolio');
```

### Production (Hostinger)
```php
define('APP_ENV', 'production');
define('APP_DEBUG', false);
define('BASE_URL', 'https://yourdomain.com/portfolio');
```

## Next Steps

1. ✅ Install and setup (You're here!)
2. 🔐 Secure your admin panel
3. 📝 Add your content
4. 🎨 Customize design (optional)
5. 📧 Configure email
6. 🚀 Deploy to Hostinger
7. 🌐 Share your portfolio!

## Important Files

| File | Purpose |
|------|---------|
| `config/config.php` | Main configuration |
| `database/schema.sql` | Database structure |
| `public/index.php` | Website entry point |
| `admin/index.php` | Admin entry point |
| `README.md` | Full documentation |
| `DEPLOYMENT_GUIDE.md` | Hostinger deployment |

---

**Ready?** Start by changing the admin password and adding your content!

Need detailed instructions? See `README.md` and `DEPLOYMENT_GUIDE.md`

**Good luck with your portfolio!** 🚀
