# 20i.com Setup Checklist

## 🔄 CURRENT STATUS
✅ Git repository initialized  
✅ Files uploading to GitHub: https://github.com/pinohu/pest-management-authority-site  
⏳ 20i.com setup needed  

## 📋 20i.COM CONTROL PANEL TASKS

### Step 1: Create Database
1. In 20i Control Panel (should be open) → **"Databases"**
2. Click **"Create New Database"**
3. Database name: `pest_management_wp`
4. Create user with full permissions
5. **Write down these details:**
   - Database name: _______________
   - Username: _______________
   - Password: _______________

### Step 2: Enable GitHub Integration
1. In 20i Control Panel → **"Website"** section
2. Look for **"GitHub Integration"** or **"Git Deploy"**
3. Click **"Connect to GitHub"**
4. Authorize 20i to access your GitHub
5. Select repository: `pest-management-authority-site`
6. Branch: `main`
7. Deploy path: `/` (root)
8. Enable **"Auto-deploy"**

### Step 3: Configure wp-config.php
1. Update `wp-config-20i-template.php` with your database details
2. Rename it to `wp-config.php`
3. Update domain name in the file
4. Push changes to GitHub (auto-deploys to 20i)

## 🎯 WHAT HAPPENS NEXT

Once you complete these steps:
1. Your site will automatically deploy to 20i.com
2. Visit your domain to see WordPress setup
3. Complete WordPress installation
4. Activate "Authority Blueprint" theme
5. 🎉 **See your beautiful theme improvements live!**

## 🎨 WHAT YOU'LL SEE

Your Authority Blueprint theme includes:
✅ Modern gradient hero sections  
✅ Professional card layouts with hover effects  
✅ Pest management green/brown branding  
✅ Responsive mobile-first design  
✅ Smooth animations and transitions  
✅ Directory integration ready for pest management listings  

## 📞 NEED HELP?

- 20i Support: Live chat in control panel
- Full guide: `docs/20i-github-deployment-guide.md`
- GitHub repo: https://github.com/pinohu/pest-management-authority-site 