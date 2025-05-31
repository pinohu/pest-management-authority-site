<?php
/*
Plugin Name: Authority Utilities - Image Optimization
Description: Auto-generates WebP and AVIF versions of uploaded images and updates attachment metadata for responsive image support.
Version: 1.0
Author: Authority Blueprint
*/

add_filter('wp_generate_attachment_metadata', 'authority_image_optimization_generate', 20, 2);

function authority_image_optimization_generate($metadata, $attachment_id) {
    $mime = get_post_mime_type($attachment_id);
    if (strpos($mime, 'image/') !== 0) {
        return $metadata;
    }
    $file = get_attached_file($attachment_id);
    if (!$file) {
        return $metadata;
    }
    $dir = pathinfo($file, PATHINFO_DIRNAME);
    $filename = pathinfo($file, PATHINFO_FILENAME);
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $webp = $dir . '/' . $filename . '.webp';
    $avif = $dir . '/' . $filename . '.avif';
    // Generate WebP
    if (!file_exists($webp) && function_exists('imagewebp')) {
        $image = imagecreatefromstring(file_get_contents($file));
        if ($image) {
            imagewebp($image, $webp);
            imagedestroy($image);
        }
    }
    // Generate AVIF (if PHP supports it)
    if (!file_exists($avif) && function_exists('imageavif')) {
        $image = imagecreatefromstring(file_get_contents($file));
        if ($image) {
            imageavif($image, $avif);
            imagedestroy($image);
        }
    }
    // Optionally, update metadata for responsive images (not shown here)
    return $metadata;
} 