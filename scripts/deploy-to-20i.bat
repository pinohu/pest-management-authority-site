@echo off
echo ================================
echo 20i.com GitHub Deployment Setup
echo ================================
echo.
echo This script will help you deploy your Authority Blueprint WordPress site to 20i.com
echo.
echo PREREQUISITES:
echo - 20i.com hosting account
echo - GitHub account
echo.
echo ================================
echo Step 1: Initialize Git Repository
echo ================================
echo.

git init
if %errorlevel% neq 0 (
    echo Error: Failed to initialize git repository
    pause
    exit /b 1
)

git add .
if %errorlevel% neq 0 (
    echo Error: Failed to add files to git
    pause
    exit /b 1
)

git commit -m "Initial commit: Authority Blueprint WordPress site with theme improvements"
if %errorlevel% neq 0 (
    echo Error: Failed to commit files
    pause
    exit /b 1
)

echo.
echo ================================
echo Step 2: GitHub Repository Setup
echo ================================
echo.
echo Please follow these steps:
echo.
echo 1. Go to https://github.com
echo 2. Click "New Repository"
echo 3. Repository name: pest-management-authority-site
echo 4. Description: Professional pest management science authority website
echo 5. Set to Public or Private (your choice)
echo 6. DON'T initialize with README
echo 7. Click "Create Repository"
echo.
echo Press any key to open GitHub in your browser...
pause > nul
start https://github.com/new

echo.
echo ================================
echo Step 3: Connect to GitHub
echo ================================
echo.
set /p github_username="Enter your GitHub username: "
set /p repo_name="Enter repository name (or press Enter for 'pest-management-authority-site'): "

if "%repo_name%"=="" set repo_name=pest-management-authority-site

echo.
echo Connecting to GitHub repository...
git remote add origin https://github.com/%github_username%/%repo_name%.git
git branch -M main
git push -u origin main

if %errorlevel% neq 0 (
    echo.
    echo Error: Failed to push to GitHub
    echo Make sure:
    echo 1. Repository exists on GitHub
    echo 2. Username is correct
    echo 3. You're logged into Git (run: git config --global user.name "Your Name")
    echo.
    pause
    exit /b 1
)

echo.
echo ================================
echo SUCCESS! 🎉
echo ================================
echo.
echo Your WordPress site is now on GitHub!
echo.
echo NEXT STEPS:
echo 1. Log into your 20i.com control panel
echo 2. Go to Website section
echo 3. Find "GitHub Integration" or "Git Deploy"
echo 4. Connect to GitHub and select your repository
echo 5. Enable auto-deploy from main branch
echo.
echo THEN:
echo 1. Create database in 20i control panel
echo 2. Update wp-config.php with 20i database details
echo 3. Push changes and watch your site deploy!
echo.
echo See full guide: docs/20i-github-deployment-guide.md
echo.
echo Press any key to open 20i control panel...
pause > nul
start https://my.20i.com/

echo.
echo Deployment setup complete!
echo Your beautiful Authority Blueprint theme will be live soon! 🌟
pause 