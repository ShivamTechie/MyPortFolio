# Hostinger Deployment Guide

Quick step-by-step guide for deploying your portfolio website on Hostinger.

## Pre-Deployment Checklist

- [ ] Hostinger hosting account ready
- [ ] Domain name configured (optional)
- [ ] FTP/File Manager access
- [ ] cPanel/MySQL access
- [ ] Gmail App Password generated

## Step-by-Step Deployment

### 1. Prepare Your Files (Local)

1. **Update Configuration**:
   ```
   Open: config/config.php
   Update:
   - DB_HOST: 'localhost'
   - DB_NAME: 'your_db_name'
   - DB_USER: 'your_db_user'
   - DB_PASS: 'your_db_password'
   - BASE_URL: 'https://yourdomain.com'
   - SMTP_USERNAME: 'your-email@gmail.com'
   - SMTP_PASSWORD: 'your-app-password'
   - APP_ENV: 'production'
   - APP_DEBUG: false
   ```

2. **Compress Files** (Optional but recommended):
   ```bash
   zip -r portfolio.zip portfolio/ -x "*.git*"
   ```

### 2. Upload to Hostinger

**Option A: File Manager (Recommended for beginners)**

1. Login to Hostinger hPanel
2. Go to File Manager
3. Navigate to `public_html` directory
4. Upload the portfolio folder
5. If uploaded as zip, extract it

**Option B: FTP Client (FileZilla)**

1. Get FTP credentials from Hostinger hPanel
2. Connect via FileZilla
3. Upload entire portfolio folder to `public_html`

**Final Structure on Server**:
```
public_html/
└── portfolio/
    ├── public/
    ├── app/
    ├── admin/
    ├── config/
    └── ...
```

### 3. Create MySQL Database

1. **Login to hPanel**
2. **Go to MySQL Databases**
3. **Create New Database**:
   - Database name: `portfolio_db` (or your choice)
   - Click Create

4. **Create Database User**:
   - Username: Choose secure username
   - Password: Generate strong password
   - Click Create

5. **Grant Privileges**:
   - Select user
   - Select database
   - Grant ALL PRIVILEGES
   - Save

6. **Note Down**:
   - Database name
   - Database username
   - Database password

### 4. Import Database Schema

1. **Access phpMyAdmin**:
   - From hPanel → phpMyAdmin
   - Or direct link from Hostinger

2. **Select Your Database**:
   - Click on database name from left panel

3. **Import SQL File**:
   - Click "Import" tab
   - Click "Choose File"
   - Select: `database/schema.sql` from your local files
   - Click "Go" at bottom

4. **Verify Import**:
   - Check if tables are created
   - Should see 10+ tables

### 5. Update Configuration on Server

1. **Via File Manager**:
   - Navigate to: `public_html/portfolio/config/config.php`
   - Click Edit
   - Update all database credentials
   - Update BASE_URL to your domain
   - Save changes

2. **Important Settings**:
   ```php
   // Production settings
   define('APP_ENV', 'production');
   define('APP_DEBUG', false);
   
   // Your actual domain
   define('BASE_URL', 'https://yourdomain.com/portfolio');
   ```

### 6. Set File Permissions

**Via File Manager**:

1. **Uploads Directory**:
   - Right-click: `public/uploads`
   - Permissions → 755
   - Check "Apply to subdirectories"

2. **Config File**:
   - Right-click: `config/config.php`
   - Permissions → 644

**Via FTP (FileZilla)**:
- Right-click files/folders
- File permissions
- Set appropriate permissions

### 7. Configure SMTP for Contact Form

**Gmail Setup**:

1. **Enable 2FA**:
   - Go to myaccount.google.com
   - Security → 2-Step Verification
   - Enable it

2. **Generate App Password**:
   - Go to: myaccount.google.com/apppasswords
   - Select app: Mail
   - Select device: Other (Custom name)
   - Name it: Portfolio Website
   - Click Generate
   - Copy the 16-character password

3. **Update Config**:
   ```php
   define('SMTP_HOST', 'smtp.gmail.com');
   define('SMTP_PORT', 587);
   define('SMTP_USERNAME', 'your-email@gmail.com');
   define('SMTP_PASSWORD', 'your-16-char-app-password');
   define('SMTP_FROM_EMAIL', 'your-email@gmail.com');
   define('ADMIN_EMAIL', 'shivamkk2001@gmail.com');
   ```

### 8. Update .htaccess Files (If Needed)

**If portfolio is in subdirectory** (e.g., `/portfolio`):

1. **Edit: public/.htaccess**
   - Find: `RewriteBase /`
   - Change to: `RewriteBase /portfolio/`

2. **Edit: admin/.htaccess**
   - Find: `RewriteBase /admin/`
   - Change to: `RewriteBase /portfolio/admin/`

**If portfolio is in root** (directly in public_html):
- No changes needed

### 9. Test Your Website

**Frontend Testing**:
1. Visit: `https://yourdomain.com/portfolio`
2. Check all sections load
3. Test navigation
4. Test responsive design (mobile view)
5. Test contact form

**Admin Testing**:
1. Visit: `https://yourdomain.com/portfolio/admin`
2. Login with:
   - Username: `admin`
   - Password: `admin123`
3. **IMMEDIATELY Change Password**
4. Test all CRUD operations

### 10. Post-Deployment Tasks

**Immediate**:
- [ ] Change admin password
- [ ] Update profile information
- [ ] Upload profile image
- [ ] Upload resume
- [ ] Test contact form submission
- [ ] Check email notifications work

**Content**:
- [ ] Add/edit work experience
- [ ] Add/edit education
- [ ] Add/edit skills
- [ ] Add projects with images
- [ ] Edit services
- [ ] Add testimonials (if any)

**Security**:
- [ ] Verify .htaccess files are working
- [ ] Test admin login security
- [ ] Enable HTTPS if not already
- [ ] Set up regular backups

## Common Issues & Solutions

### Issue 1: 500 Internal Server Error

**Solution**:
- Check .htaccess syntax
- Verify mod_rewrite is enabled
- Check error logs in cPanel
- Verify file permissions

### Issue 2: Database Connection Error

**Solution**:
- Verify DB credentials in config.php
- Check database exists
- Verify user has privileges
- Test connection via phpMyAdmin

### Issue 3: Admin Panel 404

**Solution**:
- Check .htaccess in admin folder
- Verify RewriteBase is correct
- Clear browser cache
- Check file permissions

### Issue 4: Images Not Uploading

**Solution**:
- Set uploads folder to 755
- Check PHP upload_max_filesize
- Verify disk space available
- Check folder write permissions

### Issue 5: Email Not Sending

**Solution**:
- Verify SMTP credentials
- Check app password (not regular password)
- Test with simple script first
- Check PHPMailer is uploaded
- Verify no firewall blocking SMTP

### Issue 6: CSS/JS Not Loading

**Solution**:
- Check BASE_URL is correct
- Verify files are uploaded
- Clear browser cache
- Check .htaccess rewrite rules

## Hostinger Specific Notes

1. **Database Host**: Always use `localhost`
2. **File Manager**: Built-in editor for quick edits
3. **Error Logs**: Available in hPanel → Error Logs
4. **PHP Version**: Can be changed in hPanel → PHP Configuration
5. **SSL**: Free SSL available via hPanel

## Performance Tips

1. **Enable Caching**: Already configured in .htaccess
2. **Optimize Images**: Use tools before upload
3. **Enable GZIP**: Already configured
4. **Use CDN**: Consider for heavy traffic
5. **Database Optimization**: Regular cleanup of old data

## Backup Strategy

**What to Backup**:
1. Database (via phpMyAdmin)
2. Uploads folder (`public/uploads/`)
3. Config file (`config/config.php`)

**When to Backup**:
- Before any major changes
- Weekly (automated if possible)
- Before adding bulk content

**How to Backup on Hostinger**:
1. Go to hPanel → Backups
2. Create manual backup
3. Download to local machine

## Monitoring

**Regular Checks**:
- [ ] Website loading speed
- [ ] Contact form working
- [ ] Admin panel accessible
- [ ] New messages received
- [ ] Disk space available
- [ ] SSL certificate valid

**Weekly Tasks**:
- Check contact messages
- Review error logs
- Update content if needed
- Check backup status

## URLs Reference

After deployment, your URLs will be:

- **Frontend**: `https://yourdomain.com/portfolio`
- **Admin Panel**: `https://yourdomain.com/portfolio/admin`
- **Admin Login**: `https://yourdomain.com/portfolio/admin?page=login`

If in root directory:

- **Frontend**: `https://yourdomain.com`
- **Admin Panel**: `https://yourdomain.com/admin`

## Support Contacts

**Hostinger Support**:
- Live Chat: Available 24/7
- Email: support@hostinger.com
- Knowledge Base: support.hostinger.com

**Developer**:
- Email: shivamkk2001@gmail.com
- Phone: +91 7037535354

## Success Checklist

After following this guide, verify:

- [x] Website loads without errors
- [x] All sections display correctly
- [x] Contact form works and sends emails
- [x] Admin panel accessible
- [x] Can login to admin
- [x] All CRUD operations work
- [x] Images upload successfully
- [x] Mobile responsive works
- [x] HTTPS enabled
- [x] Password changed from default

---

**Congratulations!** Your portfolio is now live! 🎉

Keep your content updated and monitor regularly for best results.
