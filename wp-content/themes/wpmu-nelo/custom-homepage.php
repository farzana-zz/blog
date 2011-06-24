<div id="top-content">

<?php include (TEMPLATEPATH . '/options.php'); ?>

<div class="introbox">

<?php if($tn_wpmu_latest_post == "recent post") { ?>

<?php $my_query = new WP_Query('category_name=&showposts=5');
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID;
$the_post_ids = $post->ID;
$latest_post == 0;
?>

<?php if ($latest_post < 1) { ?>

<a href="<?php echo stripslashes($tn_wpmu_intro_header_imgurl); ?>">
<?php if(file_exists($upload_path . 'intro_normal.jpg')) {?>
<img src="<?php echo "$ttpl_path/intro_normal.jpg"; ?>" alt="intro" />
<?php } else if(file_exists($upload_path . 'intro_crop.jpg')) {?>
<img src="<?php echo "$ttpl_path/intro_crop.jpg"; ?>" alt="intro" />
<?php } else { ?>
<img src="<?php bloginfo('template_directory'); ?>/images/cimage-intro.gif" alt="intro" />
<?php } ?>
</a>
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<p><?php the_excerpt_feature($excerpt_length=200); ?></p>

<div id="frontpost" class="post">
<h3><?php _e('Other News &raquo;', 'nelo'); ?></h3>

<?php } else { ?>

<div class="post-content">
<?php custom_get_post_img ($the_post_id=$the_post_ids, $width='180', $height='150', $size='medium'); ?>
<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<p><?php the_excerpt_feature($excerpt_length=60); ?></p>
</div>


<?php } ?>

<?php $latest_post++; ?>

<?php endwhile;?>


</div>

<?php } elseif ($tn_wpmu_latest_post == "custom post") { ?>

<a href="<?php echo stripslashes($tn_wpmu_intro_header_imgurl); ?>">
<?php if(file_exists($upload_path . 'intro_normal.jpg')) { ?>
<img src="<?php echo "$ttpl_path/intro_normal.jpg"; ?>" alt="intro" />
<?php } else if(file_exists($upload_path . 'intro_crop.jpg')) {?>
<img src="<?php echo "$ttpl_path/intro_crop.jpg"; ?>" alt="intro" />
<?php } else { ?>
<img src="<?php bloginfo('template_directory'); ?>/images/cimage-intro.gif" alt="intro" />
<?php } ?>
</a>
<h2>
<?php if($tn_wpmu_intro_header == '') { ?>
This is intro header
<?php } else { ?>
<a href="<?php echo stripslashes( $tn_wpmu_intro_header_imgurl ); ?>"><?php echo stripslashes( $tn_wpmu_intro_header ); ?></a>
<?php } ?>
</h2>
<?php if($tn_wpmu_intro_text == '') { ?>
<?php _e('You can replace ever area on this page with a new text in <a href="wp-admin/themes.php?page=custom-homepage.php">your theme options</a> or <a href="wp-admin/themes.php?page=custom-homepage.php">upload and crop new images</a> to replace the ones you can see here already.', 'nelo'); ?>
<?php } else { ?>
<p><?php echo stripslashes( $tn_wpmu_intro_text ); ?></p>
<?php } ?>


<?php } elseif ($tn_wpmu_latest_post == "custom post with recent post") { ?>


<a href="<?php echo stripslashes($tn_wpmu_intro_header_imgurl); ?>">
<?php if(file_exists($upload_path . 'intro_normal.jpg')) {?>
<img src="<?php echo "$ttpl_path/intro_normal.jpg"; ?>" alt="intro" />
<?php } else if(file_exists($upload_path . 'intro_crop.jpg')) {?>
<img src="<?php echo "$ttpl_path/intro_crop.jpg"; ?>" alt="intro" />
<?php } else { ?>
<img src="<?php bloginfo('template_directory'); ?>/images/cimage-intro.gif" alt="intro" />
<?php } ?>
</a>
<h2>
<?php if($tn_wpmu_intro_header == '') { ?>
This is intro header
<?php } else { ?>
<a href="<?php echo stripslashes($tn_wpmu_intro_header_imgurl); ?>"><?php echo stripslashes($tn_wpmu_intro_header); ?></a>
<?php } ?>
</h2>
<?php if($tn_wpmu_intro_text == '') { ?>
<?php _e('You can replace ever area on this page with a new text in <a href="wp-admin/themes.php?page=custom-homepage.php">your theme options</a> or <a href="wp-admin/themes.php?page=custom-homepage.php">upload and crop new images</a> to replace the ones you can see here already.', 'nelo'); ?>

<?php } else { ?>

<p><?php echo stripslashes( $tn_wpmu_intro_text ); ?></p>

<?php } ?>

<div id="frontpost">
<h3><?php _e('Latest News &raquo;', TEMPLATE_DOMAIN); ?></h3>

<?php $my_query = new WP_Query('category_name=&showposts=5');
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID;
$the_post_ids = $post->ID;
?>

<div class="post-content">
<?php custom_get_post_img ($the_post_id=$the_post_ids, $width='180', $height='150', $size='medium'); ?>
<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<p><?php the_excerpt_feature($excerpt_length=60); ?></p>
</div>

<?php endwhile;?>

</div>

<?php } ?>

</div>


<div id="top-right-widget">
<ul class="list">
<?php if($tn_wpmu_show_profile == "yes"){ ?>
<?php locate_template ( array('profiles.php'), true ); ?>
<?php } ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Home Top Right', TEMPLATE_DOMAIN)) ) : ?>
<li>
<h3><?php _e('Top Right Widget', 'nelo'); ?></h3>
<ul>
<li><?php _e('All you need to do is to visit your <a href="wp-admin/widgets.php">widget</a> tab replace this with your widget', 'nelo'); ?></li>
</ul>
</li>
<?php endif; ?>

</ul>
</div>
</div>