<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>
<?php
if (is_home()) {
	echo bloginfo('name'); echo ": "; echo bloginfo('description');
} elseif (is_404()) {
	echo '404 Not Found';
} elseif (is_category()) {
	echo 'Topics:'; wp_title('');
} elseif (is_search()) {
	echo 'Search Results';
} elseif (is_day() || is_month() || is_year() ) {
	echo 'Archives:'; wp_title('');
} else {
	echo wp_title('');
	$subtitle = get_post_meta($post->ID, 'Subtitle', $single = true);
	if($subtitle !== '') { echo ': ' . $subtitle; }
} ?>
</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="robots" content="all" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta http-equiv="author" content="Oleg" />
<meta http-equiv="contact" content="http://www.metamorphozis.com/contact/" />
<meta name="copyright" content="Copyright (c) 2005-<?php echo date("Y",time()); ?> Metamorphozis. All Rights Reserved." />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php
/***Do not Edit it***/
wp_head(); 
	global $options;
	foreach ($options as $value) 
	{
		if (get_settings( $value['id'] ) === FALSE) 
		{ 
			$$value['id'] = $value['std']; 
		}
		else 
		{ 
			$$value['id'] = get_settings( $value['id'] ); 
		} 
	} 
	
	global $link_privacy,$link_terms;
	$link_privacy=$mt_ice_link_privacy;
	$link_terms=$mt_ice_link_terms;
/*** End of Do not Edit Restriction***/
?>
</head>
<body>
<div id="content">
<!-- header begins -->
<div id="header"> 
	<div id="logo">
		<h1><a href="<?php bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a></h1>
		<h2><?php bloginfo('description'); ?></h2>
	</div>
 </div>
       <div id="main">
        <div id="menu">
	 	<?php include (TEMPLATEPATH . '/main-nav.php'); ?>
	</div>
	
<!-- header ends -->