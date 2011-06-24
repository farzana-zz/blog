<?php

// This file is part of the Carrington Text Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2009 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$blog_desc = get_bloginfo('description');
(is_home() && !empty($blog_desc)) ? $title_description = ' - '.$blog_desc : $title_description = '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ).$title_description; ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'carrington-text' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'carrington-text' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	
	<link rel="stylesheet" type="text/css" media="screen, print, handheld" href="<?php bloginfo('template_url') ?>/css/carrington-text.css" />
	
	<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->

<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" media="screen, print, handheld" href="<?php bloginfo('template_url') ?>/css/ie6.css" />
<![endif]-->


<?php
	wp_head(); 
?>
</head>

<body>
	<div id="container1">
			<div id="container3">
	<div id="header">
		<div id="top_navigation">
			<ul>
				<?php wp_list_pages('title_li=');Ê?>
				
				<li class="search"><?php cfct_form('search'); ?></li>
				</ul>
			
		</div>
		<div id="header_content">
		<div class="header-title"><h1 id="blog-title"><a href="<?php bloginfo('url') ?>/" title="Home" rel="home"><?php bloginfo('name') ?></a></h1>
		<h2 id="blog-description"><?php bloginfo('description'); ?></h2> </a>
		</div>
		</div>
	</div><!-- #header -->
	<div id="page">
		<div id="inner_page">
