<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php include (TEMPLATEPATH . '/options.php'); ?>

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/nav.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/global.css" type="text/css" media="screen" />
<!-- wp 2.8 comment style -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/wp-comments.css" type="text/css" media="screen" />


<!-- start theme options sync - using php to fetch theme option are deprecated and replace with style sync -->
<?php print "<style type='text/css' media='screen'>"; ?>
<?php include (TEMPLATEPATH . '/fonts.php'); ?>
<?php print "</style>"; ?>
<!-- end theme options sync -->


<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="icon" href="<?php bloginfo('stylesheet_directory');?>/favicon.ico" type="images/x-icon" />

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dropmenu.jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dropmenu.js"></script>

<!--[if IE 6]>
<style type="text/css">
#nav { behavior: url(<?php bloginfo('template_directory'); ?>/js/hover.htc); }
</style>
<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>

<body <?php body_class() ?> id="custom">


<div id="wrapper">
<div id="container">


<div id="header">

<div class="site-title">
<?php
if(($tn_wpmu_header_logo_img != "")){ ?>
<a href="<?php echo bloginfo('url'); ?>">
<img src="<?php echo stripcslashes($tn_wpmu_header_logo_img); ?>" alt="<?php bloginfo('name'); ?>" />
</a>
<?php } else { ?>
<h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></h1>
<p><?php bloginfo('description'); ?></p>
<?php } ?>
</div>


<div class="custom-image-top">
<a href="<?php echo stripslashes($tn_wpmu_top_header_imgurl); ?>">
<?php
if(file_exists($upload_path . 'top_header_normal.jpg')) {?>
<img src="<?php echo "$ttpl_path/top_header_normal.jpg"; ?>" alt="top_header_normal" />
<?php } else if (file_exists($upload_path . 'top_header_crop.jpg')) {?>
<img src="<?php echo "$ttpl_path/top_header_crop.jpg"; ?>" alt="top_header_normal" />
<?php } else { ?>
<img src="<?php bloginfo('template_directory'); ?>/images/cimage.gif" alt="top_header_normal" />
<?php } ?>
</a>
</div>

</div>




<div id="navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php wp_nav_menu( array('theme_location' => 'main-nav', 'menu_id' => '', 'container' => '', 'container_id' => '', 'fallback_cb' => 'revert_wp_menu_page')); ?>
</ul>
<div class="rss-feeds"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS Feed', TEMPLATE_DOMAIN); ?></a></div>
<?php } else { ?>
<ul id="nav">
<li><a href="<?php bloginfo('url'); ?>" title="Home"><?php _e('Home', 'nelo'); ?></a></li>
<?php wp_list_pages('title_li=&depth=0'); ?>
</ul>
<div class="rss-feeds"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS Feed', TEMPLATE_DOMAIN); ?></a></div>
<?php } ?>
</div>



<?php
if(($tn_wpmu_header_on == 'enable') || ($tn_wpmu_header_on  == '')){ ?>
<div id="custom-img-header"><a href="<?php if($tn_wpmu_header_link != "") { echo stripslashes($tn_wpmu_header_link); } else { echo bloginfo('url'); } ?>">
<img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" />
</a>
</div>
<?php } ?>


<div class="content">