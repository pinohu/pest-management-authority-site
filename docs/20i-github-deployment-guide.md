# 20i.com GitHub Deployment Guide

## Deploy Your Authority Blueprint WordPress Site

### 🚀 Quick Overview

Deploy your improved WordPress site with the beautiful Authority Blueprint theme to 20i.com using their integrated GitHub functionality.

## 📋 Prerequisites

- 20i.com hosting account
- GitHub account
- Git installed locally (or GitHub Desktop)

---

## Step 1: Initialize Git Repository

```bash
# In your WordPress Blog directory
git init
git add .
git commit -m "Initial commit: Authority Blueprint WordPress site with theme improvements"
```

## Step 2: Create GitHub Repository

1. Go to [GitHub.com](https://github.com)
2. Click **"New Repository"**
3. Repository name: `pest-management-authority-site`
4. Description: `Professional pest management science authority website with WordPress and Authority Blueprint theme`
5. Set to **Public** (or Private if you prefer)
6. **Don't** initialize with README (we already have content)
7. Click **"Create Repository"**

## Step 3: Connect Local Repository to GitHub

```bash
# Replace YOUR_USERNAME with your GitHub username
git remote add origin https://github.com/YOUR_USERNAME/pest-management-authority-site.git
git branch -M main
git push -u origin main
```

---

## Step 4: Set Up 20i.com GitHub Integration

### 4.1 Access 20i.com Control Panel

1. Log into your 20i.com account
2. Navigate to your hosting package
3. Go to **"Website"** section

### 4.2 Enable GitHub Integration

1. Find **"GitHub Integration"** or **"Git Deploy"**
2. Click **"Connect to GitHub"**
3. Authorize 20i to access your GitHub account
4. Select your repository: `pest-management-authority-site`
5. Choose branch: `main`
6. Set deploy path: `/` (root directory)

### 4.3 Configure Deployment Settings

- **Auto-deploy**: Enable (deploys on every push)
- **Deploy files**: All files
- **Exclude**: Uses your `.gitignore` file automatically

---

## Step 5: WordPress Database Setup on 20i

### 5.1 Create Database

1. In 20i Control Panel → **"Databases"**
2. Click **"Create New Database"**
3. Database name: `pest_management_wp`
4. Create database user with full permissions

### 5.2 Create wp-config.php for 20i

Create this file in your local project root:

```php
<?php
// 20i.com WordPress Configuration

// Database settings (update with your 20i database details)
define('DB_NAME', 'your_20i_database_name');
define('DB_USER', 'your_20i_database_user');
define('DB_PASSWORD', 'your_20i_database_password');
define('DB_HOST', 'localhost'); // Usually localhost on 20i

// WordPress Database Table prefix
$table_prefix = 'wp_';

// WordPress Salts (generate new ones at: https://api.wordpress.org/secret-key/1.1/salt/)
define('AUTH_KEY',         'your-unique-auth-key');
define('SECURE_AUTH_KEY',  'your-unique-secure-auth-key');
define('LOGGED_IN_KEY',    'your-unique-logged-in-key');
define('NONCE_KEY',        'your-unique-nonce-key');
define('AUTH_SALT',        'your-unique-auth-salt');
define('SECURE_AUTH_SALT', 'your-unique-secure-auth-salt');
define('LOGGED_IN_SALT',   'your-unique-logged-in-salt');
define('NONCE_SALT',       'your-unique-nonce-salt');

// WordPress debugging (disable in production)
define('WP_DEBUG', false);

// WordPress URLs
define('WP_HOME','https://yourdomain.com');
define('WP_SITEURL','https://yourdomain.com');

// File permissions
define('FS_METHOD', 'direct');

// That's all, stop editing!
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
?>
```

---

## Step 6: Deploy to 20i

### 6.1 Update .gitignore

Temporarily remove `wp-config.php` from `.gitignore` so it gets deployed:

```bash
# Comment out this line in .gitignore
# wp-config.php
```

### 6.2 Commit and Push

```bash
git add .
git commit -m "Add 20i.com configuration and deploy setup"
git push origin main
```

### 6.3 Monitor Deployment

1. Check 20i Control Panel → **"GitHub Integration"**
2. Watch deployment status
3. Should complete in 1-2 minutes

---

## Step 7: Complete WordPress Setup

### 7.1 Visit Your Site

1. Go to your 20i domain: `https://yourdomain.com`
2. WordPress setup wizard should appear

### 7.2 WordPress Installation

- **Site Title**: `Pest Management Science Authority`
- **Username**: `admin` (or your preferred username)
- **Password**: Strong password
- **Email**: Your email address

### 7.3 Activate Authority Blueprint Theme

1. Login to WordPress admin: `https://yourdomain.com/wp-admin`
2. Go to **Appearance → Themes**
3. Activate **"Authority Blueprint"**
4. 🎉 **See your beautiful theme improvements live!**

---

## 🎨 What You'll See Live

### Theme Improvements Now Live:

✅ **Modern Hero Section** - Gradient green background  
✅ **Professional Cards** - Hover effects and shadows  
✅ **Pest Management Branding** - Green/brown color scheme  
✅ **Responsive Design** - Perfect on all devices  
✅ **Smooth Animations** - Professional transitions  
✅ **Typography Enhancement** - Gradient text effects  
✅ **Directory Integration** - Ready for pest management listings

---

## 🔄 Future Updates

### Automatic Deployment

Every time you push to GitHub:

```bash
git add .
git commit -m "Update website content"
git push origin main
```

Your site automatically updates on 20i.com!

### Manual Deployment Trigger

- 20i Control Panel → GitHub Integration → **"Deploy Now"**

---

## 🛟 Troubleshooting

### Common Issues:

**Database Connection Error:**

- Check database credentials in wp-config.php
- Ensure database exists in 20i Control Panel

**File Permissions:**

- 20i handles most permissions automatically
- Contact 20i support if needed

**Theme Not Appearing:**

- Ensure all theme files deployed
- Check file paths are correct
- Clear any caching

### 20i Support:

- 24/7 UK-based support
- Live chat available
- Email: support@20i.com

---

## 📞 Need Help?

1. **20i Documentation**: https://www.20i.com/support
2. **GitHub Issues**: Create issue in your repository
3. **WordPress Codex**: https://codex.wordpress.org/

## 🎯 Next Steps After Deployment

1. **SSL Certificate** - 20i provides free SSL
2. **Custom Domain** - Point your domain to 20i
3. **Email Setup** - Configure professional email
4. **Backup Setup** - 20i includes automated backups
5. **Performance Optimization** - Enable 20i's caching

Your professional pest management authority website will be live and beautiful! 🌟
