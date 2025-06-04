# 🚀 Manual Deployment Guide for 20i.com

## ✅ What You Have Ready

- ✅ **pestmanagementscience-deploy.zip** (2.5MB) - Your complete WordPress site
- ✅ **Database configured**: pestmanagementsite-323038c8c2
- ✅ **Authority Blueprint theme** with pest management styling
- ✅ **All security keys generated** and configured

## 🎯 FASTEST DEPLOYMENT METHOD (5-10 minutes)

### Step 1: Login to 20i.com Control Panel

1. Go to [20i.com](https://20i.com) and login
2. Click on your **pestmanagementscience.com** hosting package

### Step 2: Access File Manager

1. In your hosting control panel, find **"File Manager"** or **"Files"**
2. Click to open it
3. Navigate to **`public_html`** folder (this is your website root)

### Step 3: Clear Existing Files (if any)

1. Delete any existing files in `public_html`
   - Select all files and delete them
   - This ensures a clean installation

### Step 4: Upload Your Site

1. **Upload the ZIP file**:

   - Click "Upload" or drag `pestmanagementscience-deploy.zip` into the file manager
   - Upload it to the `public_html` folder

2. **Extract the ZIP**:
   - Right-click on `pestmanagementscience-deploy.zip`
   - Select "Extract" or "Unzip"
   - Make sure files extract to `public_html` (not a subfolder)

### Step 5: Set Permissions

1. **Set folder permissions to 755**:

   - `wp-content/`
   - `wp-content/themes/`
   - `wp-content/plugins/`

2. **Set file permissions to 644**:
   - `wp-config.php`
   - All `.php` files

### Step 6: Complete WordPress Installation

1. **Visit your site**: https://pestmanagementscience.com
2. **WordPress Setup Wizard will appear**:

   - Site Title: "Pest Management Science Authority"
   - Username: Create your admin username
   - Password: Create a strong password
   - Email: Your email address

3. **Click "Install WordPress"**

## 🎨 What You'll See Live

- **Professional pest management theme** with green/brown colors
- **Hero sections** with modern gradients
- **Beautiful card layouts** with hover effects
- **Responsive design** for all devices
- **Directory structure** ready for pest management professionals

## 🔧 Alternative: Manual File Upload

If ZIP extraction doesn't work, upload these files individually:

### Essential Files to Upload:

```
📁 public_html/
├── 📄 index.php
├── 📄 wp-config.php ⭐ (PRE-CONFIGURED)
├── 📄 wp-login.php
├── 📄 wp-cron.php
├── 📄 wp-load.php
├── 📄 wp-settings.php
├── 📁 wp-admin/ (entire folder)
├── 📁 wp-includes/ (entire folder)
└── 📁 wp-content/
    ├── 📁 themes/
    │   └── 📁 authority-blueprint/ ⭐ (YOUR CUSTOM THEME)
    └── 📁 plugins/
        └── 📁 directorist/ ⭐ (DIRECTORY PLUGIN)
```

## 🚨 IMPORTANT NOTES

### Database is Already Configured ✅

Your `wp-config.php` already contains:

- ✅ Database name: pestmanagementsite-323038c8c2
- ✅ Database user: pestmanagementsite-323038c8c2
- ✅ Database password: 8huilc2drh
- ✅ Database host: sdb-t.hosting.stackcp.net
- ✅ Security keys: Generated and configured
- ✅ SSL settings: Configured for HTTPS

### No Additional Configuration Needed

- WordPress will automatically connect to your database
- SSL is pre-configured
- Memory limits are optimized
- File system permissions are set

## 📞 If You Need Help

### 20i Support Options:

1. **Live Chat**: Available in your control panel
2. **Support Tickets**: Submit through your dashboard
3. **Knowledge Base**: Comprehensive guides available

### Common Issues & Solutions:

**"Internal Server Error"**

- Check file permissions: 644 for files, 755 for folders
- Ensure wp-config.php is properly uploaded

**"Database Connection Error"**

- Database is already configured correctly
- Contact 20i if this appears

**"Site Not Loading"**

- Check domain propagation (can take up to 24 hours)
- Verify files are in `public_html` not a subfolder

## 🎯 Expected Result

Once deployed, **pestmanagementscience.com** will display:

- ✅ Modern, professional pest management website
- ✅ Beautiful green/brown color scheme
- ✅ Responsive design for mobile/tablet/desktop
- ✅ Authority Blueprint theme optimized for expertise
- ✅ Directory functionality for pest management professionals
- ✅ SEO-optimized structure
- ✅ Fast loading times
- ✅ Security hardened

## 🚀 Next Steps After Deployment

1. **Complete WordPress Setup** (5 minutes)
2. **Add your first content** (pest management articles)
3. **Configure directory listings** for professionals
4. **Set up contact forms**
5. **Add Google Analytics** for tracking

Your site will be live and professional-looking within 10 minutes of upload!
