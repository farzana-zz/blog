<?php
if ( function_exists('register_sidebar') ) 
{
	register_sidebar(array(
		'name'=>'columnLeft',
		'before_widget' => '<h2 id="%1$s" class="widget %2$s">', // Removes <li>
		'after_widget' => '</h2><br />', // Removes </li>
		'before_title' => '<h3 class="menu-header">', // Replaces <h2>
		'after_title' => '</h3>', // Replaces </h2>
	));
}

// THEME OPTIONS - DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING
$themename = "metamorph_orchids";
$shortname = "mt_orchids";

$options = array 
			(
					array("name" => "Privacy Page ID",
						"id" => $shortname."_link_privacy",
						"std" => "",
						"type" => "text"),
					array("name" => "Terms of Use Page ID",
						"id" => $shortname."_link_terms",
						"std" => "",
						"type" => "text")
			);

function theme_add_admin() 
{ 
global $themename, $shortname, $options; 
if ( $_GET['page'] == basename(__FILE__) ) 
{ 
	if ( 'save' == $_REQUEST['action'] ) 
	{ 
	foreach ($options as $value) 
	{ 
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
	} 
	
	foreach ($options as $value) 
	{ 
		if( isset( $_REQUEST[ $value['id'] ] ) ) 
		{ 
		update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
		} else { 
		delete_option( $value['id'] ); 
		} 
	} 
	header("Location: themes.php?page=functions.php&saved=true"); 
	die; 
} else if( 'reset' == $_REQUEST['action'] ) 
{ 
	foreach ($options as $value) 
	{ 
		delete_option( $value['id'] ); 
	} 
	header("Location: themes.php?page=functions.php&reset=true"); 
	die; 
	} 
}  

	add_theme_page($themename." Options", "metamorph_orchids Options", 'edit_themes', basename(__FILE__), 'theme_admin'); 
} 

function theme_admin() 
{ 
global $themename, $shortname, $options; 
if ( $_REQUEST['saved'] ) 
echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>'; 

if ( $_REQUEST['reset'] ) 
echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>
<div class="wrap">
	<h2><?php echo $themename; ?> settings</h2>
	<form method="post">
			<table class="optiontable">
				<?php 
					foreach ($options as $value) 
					{ 
						if ($value['type'] == "text") 
						{ 
				?>
								<tr valign="top">
								<th scope="row"><?php echo $value['name']; ?>:</th>
								<td><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
								</tr>
						<?php 
						} 
						elseif ($value['type'] == "select") 
						{ 
						?>
								<tr valign="top">
								<th scope="row"><?php echo $value['name']; ?>:<br /><small><?php echo $value['desc']; ?></small></th>
								<td><select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td></tr>
								<?php } 
						} 
						?>
						</table>
						<p class="submit"><input name="save" type="submit" value="Save changes" /><input type="hidden" name="action" value="save" /></p></form><form method="post"><p class="submit"><input name="reset" type="submit" value="Reset" /><input type="hidden" name="action" value="reset" /></p></form><?php } function theme_wp_head() { ?> <?php } add_action('wp_head', 'theme_wp_head'); add_action('admin_menu', 'theme_add_admin'); ?>
