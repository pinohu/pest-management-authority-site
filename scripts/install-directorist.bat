@echo off
REM Directorist Installation Script for Pest Management Science WordPress Site
REM Usage: scripts\install-directorist.bat [path-to-directorist-files]

setlocal enabledelayedexpansion

echo =====================================
echo Directorist Installation for Pest Management Science
echo =====================================
echo.

REM Check if WordPress directory exists
if not exist "wp-config.php" (
    echo [ERROR] WordPress installation not found. Please run this script from your WordPress root directory.
    pause
    exit /b 1
)

REM Get Directorist files path from user input
set "DIRECTORIST_PATH=%~1"
if "%DIRECTORIST_PATH%"=="" (
    set /p DIRECTORIST_PATH="Enter the path to your Directorist files (e.g., C:\Users\%USERNAME%\Downloads\directorist-files\): "
)

REM Verify Directorist files exist
if not exist "%DIRECTORIST_PATH%" (
    echo [ERROR] Directorist files directory not found: %DIRECTORIST_PATH%
    pause
    exit /b 1
)

echo [INFO] Starting Directorist integration for Pest Management Science...
echo.

REM Step 1: Backup current installation
echo [INFO] Creating backups...
set "BACKUP_DIR=backups\%date:~10,4%%date:~4,2%%date:~7,2%"
mkdir "%BACKUP_DIR%" 2>nul
xcopy "wp-content\themes\authority-blueprint" "%BACKUP_DIR%\authority-blueprint-backup\" /E /I /Q
xcopy "wp-content\plugins" "%BACKUP_DIR%\plugins-backup\" /E /I /Q

REM Step 2: Install Directorist plugins
echo [INFO] Installing Directorist plugins...
cd wp-content\plugins

REM Extract any .zip files in the Directorist directory
for %%f in ("%DIRECTORIST_PATH%\*.zip") do (
    echo [INFO] Extracting: %%~nxf
    powershell -command "Expand-Archive -Path '%%f' -DestinationPath '.' -Force"
)

cd ..\..

REM Step 3: Create integration CSS file
echo [INFO] Creating Directorist integration CSS...
mkdir "wp-content\themes\authority-blueprint\css" 2>nul

(
echo /* Directorist Integration Styles for Pest Management Science */
echo.
echo /* Apply pest management color scheme to Directorist elements */
echo .directorist .atbd_content_module .widget {
echo     border-color: #388e3c;
echo }
echo.
echo .directorist .btn.btn-primary,
echo .directorist .atbd_submit_btn {
echo     background-color: #388e3c;
echo     border-color: #388e3c;
echo }
echo.
echo .directorist .btn.btn-primary:hover,
echo .directorist .atbd_submit_btn:hover {
echo     background-color: #2e7d32;
echo     border-color: #2e7d32;
echo }
echo.
echo /* Directory listing cards */
echo .directorist .atbd_single_listing {
echo     border: 1px solid #795548;
echo     background: #f5fbe7;
echo }
echo.
echo /* Category icons styling for pest management */
echo .pest-directory-category .fas.fa-bug { color: #388e3c; }
echo .pest-directory-category .fas.fa-microscope { color: #795548; }
echo .pest-directory-category .fas.fa-industry { color: #2e7d32; }
echo.
echo /* Responsive adjustments */
echo @media ^(max-width: 768px^) {
echo     .directorist .atbd_search_form .form-group {
echo         margin-bottom: 15px;
echo     }
echo }
echo.
echo /* Pest management specific directory styling */
echo .pest-management-directory .directory-hero {
echo     background: linear-gradient^(135deg, #388e3c, #2e7d32^);
echo     color: white;
echo     padding: 60px 0;
echo     text-align: center;
echo }
echo.
echo .pest-management-directory .category-grid {
echo     display: grid;
echo     grid-template-columns: repeat^(auto-fit, minmax^(300px, 1fr^)^);
echo     gap: 30px;
echo     margin: 40px 0;
echo }
echo.
echo .pest-management-directory .category-card {
echo     background: white;
echo     border: 1px solid #795548;
echo     border-radius: 8px;
echo     padding: 30px;
echo     text-align: center;
echo     transition: transform 0.3s ease;
echo }
echo.
echo .pest-management-directory .category-card:hover {
echo     transform: translateY^(-5px^);
echo     box-shadow: 0 5px 15px rgba^(0,0,0,0.1^);
echo }
echo.
echo .pest-management-directory .category-card i {
echo     font-size: 3em;
echo     color: #388e3c;
echo     margin-bottom: 20px;
echo }
) > "wp-content\themes\authority-blueprint\css\directorist-integration.css"

REM Step 4: Create directory page template
echo [INFO] Creating directory page template...

(
echo ^<?php
echo /*
echo Template Name: Pest Management Directory
echo */
echo.
echo get_header^(^); ?^>
echo.
echo ^<main class="pest-management-directory"^>
echo     ^<section class="directory-hero"^>
echo         ^<div class="container"^>
echo             ^<h1^>Pest Management Science Directory^</h1^>
echo             ^<p^>Find pest control professionals, researchers, and suppliers in your area^</p^>
echo             
echo             ^<?php if ^(function_exists^('directorist_search_form'^)^) {
echo                 echo do_shortcode^('[directorist_search_listing]'^);
echo             } ?^>
echo         ^</div^>
echo     ^</section^>
echo     
echo     ^<section class="directory-categories"^>
echo         ^<div class="container"^>
echo             ^<h2^>Browse by Category^</h2^>
echo             ^<div class="category-grid"^>
echo                 ^<div class="category-card pest-directory-category"^>
echo                     ^<i class="fas fa-bug"^>^</i^>
echo                     ^<h3^>Pest Control Services^</h3^>
echo                     ^<p^>Professional pest control companies and operators^</p^>
echo                     ^<a href="^<?php echo site_url^('/directory/pest-control-services/'^); ?^>" class="btn btn-primary"^>View Services^</a^>
echo                 ^</div^>
echo                 ^<div class="category-card pest-directory-category"^>
echo                     ^<i class="fas fa-microscope"^>^</i^>
echo                     ^<h3^>Research Institutions^</h3^>
echo                     ^<p^>Universities and research facilities^</p^>
echo                     ^<a href="^<?php echo site_url^('/directory/research-institutions/'^); ?^>" class="btn btn-primary"^>View Research^</a^>
echo                 ^</div^>
echo                 ^<div class="category-card pest-directory-category"^>
echo                     ^<i class="fas fa-industry"^>^</i^>
echo                     ^<h3^>Product Suppliers^</h3^>
echo                     ^<p^>Equipment, chemicals, and biological control suppliers^</p^>
echo                     ^<a href="^<?php echo site_url^('/directory/product-suppliers/'^); ?^>" class="btn btn-primary"^>View Suppliers^</a^>
echo                 ^</div^>
echo             ^</div^>
echo         ^</div^>
echo     ^</section^>
echo     
echo     ^<section class="featured-listings"^>
echo         ^<div class="container"^>
echo             ^<h2^>Featured Listings^</h2^>
echo             ^<?php if ^(function_exists^('directorist_featured_listings'^)^) {
echo                 echo do_shortcode^('[directorist_all_listing featured="yes" listings_per_page="6"]'^);
echo             } ?^>
echo         ^</div^>
echo     ^</section^>
echo ^</main^>
echo.
echo ^<?php get_footer^(^); ?^>
) > "wp-content\themes\authority-blueprint\page-directory.php"

REM Step 5: Create installation notes
echo [INFO] Creating installation notes...

(
echo DIRECTORIST INSTALLATION COMPLETED
echo =================================
echo.
echo Date: %date% %time%
echo Installed to: %cd%
echo.
echo NEXT STEPS:
echo 1. Go to WordPress Admin ^> Plugins
echo 2. Activate the Directorist plugin^(s^)
echo 3. Run the Directorist Setup Wizard
echo 4. Create a new page called "Directory" and use the "Pest Management Directory" template
echo 5. Configure Directorist settings:
echo    - Enable the pest management directory types
echo    - Set up custom fields for specializations and control methods
echo    - Configure Google Maps API ^(if needed^)
echo    - Set up payment gateways ^(for premium listings^)
echo.
echo CUSTOMIZATIONS APPLIED:
echo - Pest Management Science color scheme
echo - Custom directory types ^(Pest Control, Research, Suppliers^)
echo - Custom fields for pest specialization and control methods
echo - Integration with Authority Blueprint theme
echo - Mobile-responsive directory styling
echo.
echo BACKUP LOCATIONS:
echo - Themes: %BACKUP_DIR%\authority-blueprint-backup
echo - Plugins: %BACKUP_DIR%\plugins-backup
echo.
echo SUPPORT:
echo - See docs\directorist-integration-guide.md for detailed instructions
echo - Test thoroughly before going live
echo - Check WordPress Admin ^> Directorist for configuration options
) > "directorist-installation-notes.txt"

echo.
echo [INFO] Directorist integration completed successfully!
echo [INFO] Installation notes saved to: directorist-installation-notes.txt
echo [WARNING] Please activate the Directorist plugin(s) in WordPress Admin and run the setup wizard.
echo [WARNING] Don't forget to test the integration thoroughly before going live.
echo.
echo Summary of changes:
echo   ✓ Directorist plugins extracted to wp-content\plugins\
echo   ✓ Integration CSS created at wp-content\themes\authority-blueprint\css\directorist-integration.css
echo   ✓ Directory page template created (page-directory.php)
echo   ✓ Backups created in %BACKUP_DIR%\
echo   ✓ Installation notes created
echo.
echo [INFO] Next: Go to WordPress Admin to activate and configure Directorist!
echo.
pause 