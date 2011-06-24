<?php
function gi_get_ID_by_page_name($page_name)
{
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name_id;
}

function wt_get_comments()
{
	global $wpdb;
	$latest_comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' LIMIT 5");
	return $latest_comments;
}

function wt_limit_string($input, $num)
{
	$output = substr ($input, 0, $num);	
	if($output != $input)
	{
		$output .= " [...]";
	}
	return $output;
}

if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'before_widget' => '<div class="sidebox">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

#comment_post_ID
?>