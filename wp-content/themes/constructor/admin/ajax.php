<?php
/**
 * All AJAX actions control from this is file
 * 
 * @package WordPress
 * @subpackage Constructor
 */

/**
 * Definition of response OK/KO
 *
 * @var string
 */
define('RESPONSE_OK', 'ok');
define('RESPONSE_KO', 'ko');

require_once CONSTRUCTOR_DIRECTORY .'/libs/Constructor/Ajax.php';

$ajax = new Constructor_Ajax();

add_action('wp_ajax_constructor_admin_save', array($ajax, 'save'));
add_action('wp_ajax_constructor_admin_clean', array($ajax, 'clean'));
add_action('wp_ajax_constructor_admin_donate', array($ajax, 'donate'));

?>