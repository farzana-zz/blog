<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php the_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/comment-form.js"></script>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
</head>
<body>
<div id="page">
	<div id="header">
		<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<div class="description"><?php bloginfo('description'); ?></div>
	</div>

	<div id="topmenu">
		<ul>
			<li <?php if(is_home()) { echo ' class="current_page_item"'; } ?>><a href="<?php bloginfo('siteurl'); ?>">Home</a></li>
			<?php wp_list_pages('title_li=&depth=1'); ?><li class="topmenu_line">&nbsp;</li>
		</ul>
		
		<div id="search">
			<div id="search_top"></div>
			<div id="search_main">
				<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
					<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
					<input type="submit" id="searchsubmit" class="submit" value="" />
				</form>
			</div>
			<div id="search_bottom"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div id="topmenu_bottom"></div>