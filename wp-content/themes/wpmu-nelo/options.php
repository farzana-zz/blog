<?php

global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }

global $options1;
foreach ($options1 as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }

global $options2;
foreach ($options2 as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }

global $options3;
foreach ($options3 as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }

global $options4;
foreach ($options4 as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }

global $options5;
foreach ($options5 as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }



//////////////////////////////////////////////
//////check platform/////////////////////////
//////////////////////////////////////////////
if (function_exists("get_current_site")) {
$mu = true;
} else {
$mu = false;
}
if($mu == "true") {
global $blog_id;
define( 'ABSPATH', dirname(__FILE__) . '/' );
$gallery_folder = "thumb";
$upload_path = ABSPATH . 'wp-content/blogs.dir/' . $blog_id . "/" . $gallery_folder . "/";
$ttpl_url = get_bloginfo('wpurl');
$ttpl_path = $ttpl_url . "/" . "wp-content/blogs.dir/" . $blog_id . "/" . $gallery_folder;

} else {

define( 'ABSPATH', dirname(__FILE__) . '/' );
$gallery_folder = "thumb";
$upload_path = ABSPATH . 'wp-content/' . $gallery_folder . "/"; // The path to where the image will be saved
$ttpl_url = get_bloginfo('wpurl');
$ttpl_path = $ttpl_url . "/" . "wp-content/" . $gallery_folder;
}

?>