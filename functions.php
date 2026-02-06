<?php
/**
 * Theme Functions and Definitions
 *
 * @package My_Optimized_Theme
 */

// Security: Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('THEME_VERSION', '1.0.0');
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

// Auto-load classes
spl_autoload_register(function ($class_name) {
    $prefix = 'MyTheme_';
    $base_dir = THEME_DIR . '/inc/';
    
    if (strpos($class_name, $prefix) !== 0) {
        return;
    }
    
    $relative_class = substr($class_name, strlen($prefix));
    $file = $base_dir . 'class-' . str_replace('_', '-', strtolower($relative_class)) . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

// Initialize theme
require_once THEME_DIR . '/inc/helpers.php';
require_once THEME_DIR . '/inc/security.php';

// Setup theme features
$theme_setup = new MyTheme_Theme_Setup();
$theme_setup->init();

// Optimize assets
$assets_optimizer = new MyTheme_Assets_Optimizer();
$assets_optimizer->init();

// Register custom post types
$cpt_manager = new MyTheme_Custom_Post_Types();
$cpt_manager->register_all();

// Theme options
$theme_options = new MyTheme_Theme_Options();
$theme_options->init();
