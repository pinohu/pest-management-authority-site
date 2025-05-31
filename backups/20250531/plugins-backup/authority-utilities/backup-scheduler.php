<?php
/*
Plugin Name: Authority Utilities - Backup Scheduler
Description: Schedules daily database and uploads directory backups.
Version: 1.0
Author: Authority Blueprint
*/

if (!wp_next_scheduled('authority_backup_scheduler_daily')) {
    wp_schedule_event(time(), 'daily', 'authority_backup_scheduler_daily');
}
add_action('authority_backup_scheduler_daily', 'authority_run_backup');

function authority_run_backup() {
    $upload_dir = wp_get_upload_dir();
    $backup_dir = WP_CONTENT_DIR . '/backups';
    if (!file_exists($backup_dir)) {
        mkdir($backup_dir, 0755, true);
    }
    // Database backup
    global $wpdb;
    $db_file = $backup_dir . '/db-' . date('Ymd-His') . '.sql';
    $cmd = sprintf('mysqldump -u%s -p%s %s > %s', DB_USER, DB_PASSWORD, DB_NAME, escapeshellarg($db_file));
    @exec($cmd);
    // Uploads backup
    $uploads_backup = $backup_dir . '/uploads-' . date('Ymd-His') . '.zip';
    $zip = new ZipArchive();
    if ($zip->open($uploads_backup, ZipArchive::CREATE) === TRUE) {
        $dir = $upload_dir['basedir'];
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::LEAVES_ONLY);
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($dir) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }
} 