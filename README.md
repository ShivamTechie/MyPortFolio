# Portfolio Website - Shivam Kumar

A professional portfolio website built with custom PHP MVC architecture, featuring a comprehensive admin panel for content management.

## Features

### Public Website
- **Responsive Design**: Mobile-first, modern design
- **Hero Section**: Animated introduction with social links
- **About Section**: Professional bio and contact information
- **Experience Timeline**: Work history with detailed descriptions
- **Education**: Academic background showcase
- **Skills**: Categorized technical skills with proficiency levels
- **Projects Portfolio**: Project showcase with images and links
- **Services**: Freelancing services offered
- **Testimonials**: Client reviews and ratings
- **Blog**: Latest blog posts (optional)
- **Contact Form**: AJAX form with SMTP email integration

### Admin Panel
- **Secure Authentication**: Login system with session management
- **Dashboard**: Quick stats and recent messages
- **Profile Management**: Edit personal information, upload resume
- **Experience CRUD**: Manage work experience entries
- **Education CRUD**: Manage education entries
- **Skills CRUD**: Manage skills with categories
- **Projects CRUD**: Manage portfolio projects with images
- **Services CRUD**: Manage service offerings
- **Testimonials CRUD**: Manage client testimonials
- **Blog CRUD**: Create and publish blog posts
- **Messages**: View and manage contact form submissions

## Technology Stack

- **Backend**: PHP 8+ with MVC Architecture
- **Database**: MySQL 8+
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Email**: PHPMailer with SMTP support
- **Server**: Apache with mod_rewrite

## Project Structure

```
portfolio/
├── public/               # Document root (public_html on Hostinger)
│   ├── index.php        # Main entry point
│   ├── assets/          # CSS, JS, images
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   └── uploads/         # User uploaded files
│       ├── profile/
│       ├── projects/
│       ├── blog/
│       └── resume/
├── app/                 # Application core
│   ├── controllers/     # MVC Controllers
│   ├── models/          # Database models
│   ├── views/           # Frontend templates
│   └── core/            # Core classes
├── admin/               # Admin panel
│   ├── controllers/     # Admin controllers
│   ├── views/           # Admin views
│   └── assets/          # Admin CSS/JS
├── config/              # Configuration files
├── database/            # Database schema
└── vendor/              # Dependencies (PHPMailer)
```

## Installation & Deployment

### Prerequisites
- Hostinger hosting account (or any PHP hosting)
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Apache with mod_rewrite enabled

### Step 1: Upload Files

1. Connect to your Hostinger account via File Manager or FTP
2. Upload all files to your hosting directory
3. If using cPanel, upload to `public_html` directory

### Step 2: Database Setup

1. **Create Database**:
   - Login to Hostinger cPanel
   - Go to MySQL Databases
   - Create a new database (e.g., `portfolio_db`)
   - Create a database user with a strong password
   - Grant all privileges to the user on the database

2. **Import Schema**:
   - Go to phpMyAdmin
   - Select your database
   - Click "Import"
   - Select `database/schema.sql` file
   - Click "Go" to import

3. **Default Admin Credentials**:
   - Username: `admin`
   - Password: `admin123`
   - **IMPORTANT**: Change password immediately after first login!

### Step 3: Configure Application

1. **Update config/config.php**:

```php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_database_user');
define('DB_PASS', 'your_database_password');

// URL Configuration
define('BASE_URL', 'https://yourdomain.com');
define('ADMIN_URL', BASE_URL . '/admin');

// SMTP Configuration
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('ADMIN_EMAIL', 'shivamkk2001@gmail.com');
```

2. **Production Settings**:
   - Set `APP_ENV` to `'production'`
   - Set `APP_DEBUG` to `false`

### Step 4: Set File Permissions

```bash
# Directories: 755
chmod 755 public/uploads
chmod 755 public/uploads/profile
chmod 755 public/uploads/projects
chmod 755 public/uploads/blog
chmod 755 public/uploads/resume

# Files: 644
chmod 644 config/config.php
```

### Step 5: Configure SMTP Email

For Gmail SMTP:

1. Enable 2-Factor Authentication on your Google Account
2. Generate App Password:
   - Go to Google Account → Security
   - App Passwords
   - Generate new password for "Mail"
3. Use the generated password in `SMTP_PASSWORD` config

**Note**: The OAuth2 credentials you provided are for Google APIs, not SMTP. You need:
- SMTP Username: Your Gmail address
- SMTP Password: App Password from Google

### Step 6: Update .htaccess (if needed)

If your portfolio is in a subdirectory, update:
- `public/.htaccess` - Line with RewriteBase
- `admin/.htaccess` - Line with RewriteBase

Example for subdirectory `/portfolio`:
```apache
RewriteBase /portfolio/
```

### Step 7: Access Your Website

- **Frontend**: `https://yourdomain.com`
- **Admin Panel**: `https://yourdomain.com/admin`
- **Login**: admin / admin123

## Post-Installation Steps

1. **Change Admin Password**:
   - Login to admin panel
   - Change default password immediately

2. **Update Profile**:
   - Go to Profile section
   - Update your information
   - Upload profile image and resume

3. **Add Content**:
   - Add your work experience
   - Add education entries
   - Add skills
   - Add projects with images
   - Add services you offer

4. **Configure SMTP**:
   - Update SMTP settings in config
   - Test contact form

5. **Test Everything**:
   - Browse all pages
   - Test contact form
   - Test admin panel CRUD operations
   - Test on mobile devices

## Configuration Details

### Database Configuration
- All database credentials are in `config/config.php`
- Schema includes 10 tables with sample data
- Default admin user is pre-created

### Security Features
- Password hashing (bcrypt)
- CSRF protection
- XSS prevention
- SQL injection protection (PDO prepared statements)
- Session security (httponly, secure flags)
- File upload validation
- .htaccess protection for sensitive directories

### Email Configuration
- PHPMailer for SMTP
- Automatic email notifications for contact form
- Messages saved in database even if email fails

### Upload Configuration
- Max file size: 5MB (configurable)
- Allowed image types: JPEG, PNG, GIF, WebP
- Allowed document types: PDF
- Automatic file renaming for security

## Troubleshooting

### Database Connection Error
- Check database credentials in `config/config.php`
- Verify database exists and user has privileges
- Check if MySQL service is running

### Admin Panel 404 Error
- Verify mod_rewrite is enabled
- Check .htaccess files are uploaded
- Verify file permissions

### Contact Form Not Working
- Check SMTP credentials
- Verify PHPMailer is uploaded
- Check error logs for details

### Images Not Uploading
- Check upload directory permissions (755)
- Verify PHP upload settings (upload_max_filesize)
- Check available disk space

### Blank Page/White Screen
- Enable error reporting temporarily
- Check error logs in cPanel
- Verify all files are uploaded correctly

## Support & Maintenance

### Regular Maintenance
- Backup database regularly
- Update admin password periodically
- Monitor contact messages
- Keep content updated

### Backup
Create regular backups of:
- Database (`portfolio_db`)
- Uploaded files (`public/uploads/`)
- Configuration (`config/config.php`)

### Performance Optimization
- Enable GZIP compression (already in .htaccess)
- Optimize images before upload
- Enable browser caching (already in .htaccess)
- Consider CDN for assets

## Default Content

The database comes pre-populated with:
- Your profile information
- 1 work experience entry (Ebizon)
- 2 education entries (MCA, Bachelor's)
- 15 skills across categories
- 6 default services

You can edit or delete these from the admin panel.

## Contact Form SMTP Setup

The contact form requires SMTP configuration to send email notifications. Until SMTP is configured:
- Messages will still be saved in database
- Admin can view messages in admin panel
- Email notifications won't be sent

## Security Recommendations

1. **Change Default Password**: Immediately after installation
2. **Strong Database Password**: Use complex password
3. **HTTPS**: Enable SSL certificate (free with Hostinger)
4. **Regular Updates**: Keep content and credentials updated
5. **File Permissions**: Never set 777 permissions
6. **Backup**: Regular automated backups

## Features to Add (Future)

- Blog with full posts and comments
- Dark mode toggle
- Multi-language support
- Analytics integration
- Resume builder
- Portfolio gallery

## Credits

Developed for: Shivam Kumar
Email: shivamkk2001@gmail.com
Phone: +91 7037535354
Location: Haridwar, Uttarakhand, India

## License

This is a custom-built portfolio website. All rights reserved.

---

**Need Help?** Contact: shivamkk2001@gmail.com
