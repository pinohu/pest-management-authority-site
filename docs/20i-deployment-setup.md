# 20i.com WordPress Deployment Setup Guide

## 🎯 Quick Setup Summary

Your WordPress files are ready to deploy! Here's what you need to do:

## ✅ What's Already Done

- ✅ GitHub repository created: `https://github.com/pinohu/pest-management-authority-site`
- ✅ WordPress files uploaded with Authority Blueprint theme
- ✅ Database created in 20i.com: `pestmanagementsite-323038c8c2`
- ✅ Template files ready for configuration

## 🔧 Final Setup Steps

### Step 1: Setup WordPress Configuration

1. **Copy the template file:**

   - In your 20i.com file manager, copy `wp-config-template.php` to `wp-config.php`

2. **Update database settings in wp-config.php:**
   Replace these placeholders with your actual database details:

   ```php
   define('DB_NAME', 'pestmanagementsite-323038c8c2');
   define('DB_USER', 'pestmanagementsite-323038c8c2');
   define('DB_PASSWORD', '8huilc2drh');
   define('DB_HOST', 'sdb-t.hosting.stackcp.net');
   ```

3. **Generate fresh security keys:**
   - Visit: https://api.wordpress.org/secret-key/1.1/salt/
   - Copy all the generated lines
   - Replace the placeholder security keys in wp-config.php

### Step 2: Setup 20i GitHub Integration

1. **In your 20i control panel:**

   - Go to **Developer Tools** → **Git Integration**
   - Connect your GitHub account
   - Select repository: `pinohu/pest-management-authority-site`
   - Set branch: `main`
   - Set deployment directory: `/public_html/`

2. **Deploy the site:**
   - Click **Deploy Now**
   - Wait for deployment to complete

### Step 3: WordPress Installation

1. **Visit your site:**

   - Go to: https://pestmanagementscience.com
   - You should see the WordPress installation screen

2. **Complete WordPress setup:**

   - Site Title: `Pest Management Science Authority`
   - Username: `admin` (or your preferred username)
   - Password: Use a strong password
   - Email: Your email address

3. **Login and activate theme:**
   - Go to `/wp-admin/`
   - Navigate to **Appearance** → **Themes**
   - Activate **Authority Blueprint** theme

## 🚀 Your Database Details

From your 20i screenshot:

- **Database Name:** `pestmanagementsite-323038c8c2`
- **Database User:** `pestmanagementsite-323038c8c2`
- **Database Password:** `8huilc2drh`
- **Database Host:** `sdb-t.hosting.stackcp.net`

## 🎨 What You'll See

Once deployed, your site will feature:

- **Modern pest management theme** with green/brown professional colors
- **Beautiful gradient hero sections**
- **Card layouts with hover effects**
- **Responsive design** for all devices
- **Directory integration** ready for pest professionals

## 🔐 Security Features

- Fresh WordPress security keys
- SSL/HTTPS enabled
- wp-config.php excluded from public repository
- Direct file system access configured

## 📞 Support

If you encounter any issues:

1. Check 20i.com support documentation
2. Verify database connection details
3. Ensure file permissions are correct (usually 755 for directories, 644 for files)

## 🔄 Making Updates

After initial setup, you can:

1. Push code changes to GitHub
2. Use 20i's Git Integration to auto-deploy
3. Manage content through WordPress admin

---

**Ready to go live!** 🌟 Your professional pest management authority website awaits at https://pestmanagementscience.com
