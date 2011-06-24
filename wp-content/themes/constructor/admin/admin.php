<?php
/**
 * Start admin customization
 *
 * @package WordPress
 * @subpackage Constructor
 */
// only for administrator
if (CONSTRUCTOR_DEBUG || isset($_REQUEST['debug'])) {
    require_once CONSTRUCTOR_DIRECTORY .'/libs/debug.php';
}

// init modules for admin pages
// you can disable any
$constructor_modules = array(
    __('Themes',  'constructor') => 'themes',
    __('Layout',  'constructor') => 'layout',
    __('Templates', 'constructor') => 'templates',
    __('Header',  'constructor') => 'header',
    __('Content', 'constructor') => 'content',
    __('Comments','constructor') => 'comments',
    __('Footer',  'constructor') => 'footer',
    __('Fonts',   'constructor') => 'fonts',
    __('Colors',  'constructor') => 'colors',
    __('Design',  'constructor') => 'design',
    __('CSS',     'constructor') => 'css',
    __('Images',  'constructor') => 'images',
    __('Slideshow', 'constructor') => 'slideshow',
    __('Save',    'constructor') => 'save',
    __('Clean',   'constructor') => 'clean',
    __('Help',    'constructor') => 'help'
);

require_once CONSTRUCTOR_DIRECTORY .'/libs/Constructor/Admin.php';

/**
 * Replace scandir()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @link        http://php.net/function.scandir
 * @author      Aidan Lister <aidan@php.net>
 * @version     $Revision: 1.18 $
 * @since       PHP 5
 * @require     PHP 4.0.0 (user_error)
 */
if (!function_exists('scandir')) {
    function scandir($directory, $sorting_order = 0)
    {
        if (!is_string($directory)) {
            user_error('scandir() expects parameter 1 to be string, ' .
                gettype($directory) . ' given', E_USER_WARNING);
            return;
        }

        if (!is_int($sorting_order) && !is_bool($sorting_order)) {
            user_error('scandir() expects parameter 2 to be long, ' .
                gettype($sorting_order) . ' given', E_USER_WARNING);
            return;
        }

        if (!is_dir($directory) || (false === $fh = @opendir($directory))) {
            user_error('scandir() failed to open dir: Invalid argument', E_USER_WARNING);
            return false;
        }

        $files = array ();
        while (false !== ($filename = readdir($fh))) {
            $files[] = $filename;
        }

        closedir($fh);

        if ($sorting_order == 1) {
            rsort($files);
        } else {
            sort($files);
        }

        return $files;
    }
}


$admin = new Constructor_Admin();
$admin -> init($constructor_modules);
 
