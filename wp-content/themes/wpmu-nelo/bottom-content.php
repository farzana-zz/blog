<div id="bottom-content">
<?php include (TEMPLATEPATH . '/options.php'); ?>


<div class="itembox" id="box1">
<div class="custom-bottom-image">
<a href="<?php echo stripslashes($tn_wpmu_box1_imgurl); ?>">
<?php
if(file_exists($upload_path . 'box_cat_left_normal.jpg')) {?>
<img src="<?php echo "$ttpl_path/box_cat_left_normal.jpg"; ?>" alt="box_cat_left" />
<?php } else if (file_exists($upload_path . 'box_cat_left_crop.jpg')) {?>
<img src="<?php echo "$ttpl_path/box_cat_left_crop.jpg"; ?>" alt="box_cat_left" />
<?php } else { ?>
<img src="<?php bloginfo('template_directory'); ?>/images/subimage.gif" alt="box_cat_left" />
<?php } ?>
</a>
</div>

<h2>
<?php if($tn_wpmu_box1_header == '') { ?>
<?php _e('This is box left header'); ?>
<?php } else { ?>
<?php echo stripslashes($tn_wpmu_box1_header); ?>
<?php } ?>
</h2>
<p>
<?php if($tn_wpmu_box1_text == '') { ?>
<?php _e('All you need to do is to visit your <a href="wp-admin/themes.php?page=custom-homepage.php">Custom Homepage Images</a> tab and upload new images (you can crop them after uploading) and enter text and links to replace this text.', 'nelo'); ?>
<?php } else { ?>
<?php echo stripslashes($tn_wpmu_box1_text); ?>
<?php } ?>
</p>

<ul class="list">

<?php if(($tn_wpmu_box1_cat == "Choose a category") || ($tn_wpmu_box1_cat == '')) { ?>

<?php } else { $category_id = get_cat_ID($tn_wpmu_box1_cat); ?>

<li id="cat-<?php echo $tn_wpmu_box1_cat; ?>">
<h3><?php echo refine_cat_name(stripslashes($tn_wpmu_box1_cat)); ?></h3>
<ul>
<?php $my_query = new WP_Query('cat='. $category_id . '&' . 'showposts=' . 10);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID; ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>
</li>

<?php } ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Home Box Left', TEMPLATE_DOMAIN)) ) : ?>
<?php endif; ?>

</ul>

</div>







<div class="itembox" id="box2">
<div class="custom-bottom-image">
<a href="<?php echo stripslashes($tn_wpmu_box2_imgurl); ?>">
<?php if(file_exists($upload_path . 'box_cat_center_normal.jpg')) {?>
<img src="<?php echo "$ttpl_path/box_cat_center_normal.jpg"; ?>" alt="box_cat_center" />
<?php } else if (file_exists($upload_path . 'box_cat_center_crop.jpg')) {?>
<img src="<?php echo "$ttpl_path/box_cat_center_crop.jpg"; ?>" alt="box_cat_center" />
<?php } else { ?>
<img src="<?php bloginfo('template_directory'); ?>/images/subimage.gif" alt="box_cat_center" />
<?php } ?>
</a>
</div>



<h2>
<?php if($tn_wpmu_box2_header == '') { ?>
<?php _e('This is box center header'); ?>
<?php } else { ?>
<?php echo stripslashes($tn_wpmu_box2_header); ?>
<?php } ?>
</h2>
<p>
<?php if($tn_wpmu_box2_text == '') { ?>
<?php _e('All you need to do is to visit your <a href="wp-admin/themes.php?page=custom-homepage.php">Custom Homepage Images</a> tab and upload new images (you can crop them after uploading) and enter text and links to replace this text.', 'nelo'); ?>
<?php } else { ?>
<?php echo stripslashes($tn_wpmu_box2_text); ?>
<?php } ?>
</p>

<ul class="list">

<?php if(($tn_wpmu_box2_cat == "Choose a category") || ($tn_wpmu_box2_cat == '')) { ?>

<?php } else { $category_id = get_cat_ID($tn_wpmu_box2_cat); ?>
<li id="cat-<?php echo $tn_wpmu_box2_cat; ?>">
<h3><?php echo stripslashes($tn_wpmu_box2_cat); ?></h3>
<ul>
<?php $my_query = new WP_Query('cat='. $category_id . '&' . 'showposts=' . 10);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID; ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>
</li>
<?php } ?>


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Home Box Center', TEMPLATE_DOMAIN)) ) : ?>

<?php endif; ?>
</ul>

</div>







<div class="itembox" id="box3">

<div class="custom-bottom-image">
<a href="<?php echo stripslashes($tn_wpmu_box3_imgurl); ?>">
<?php if(file_exists($upload_path . 'box_cat_right_normal.jpg')) {?>
<img src="<?php echo "$ttpl_path/box_cat_right_normal.jpg"; ?>" alt="box_cat_right" />
<?php } else if (file_exists($upload_path . 'box_cat_right_crop.jpg')) {?>
<img src="<?php echo "$ttpl_path/box_cat_right_crop.jpg"; ?>" alt="box_cat_right" />
<?php } else { ?>
<img src="<?php bloginfo('template_directory'); ?>/images/subimage.gif" alt="box_cat_right" />
<?php } ?>
</a>
</div>



<h2>
<?php if($tn_wpmu_box3_header == '') { ?>
<?php _e('This is box right header'); ?>
<?php } else { ?>
<?php echo stripslashes($tn_wpmu_box3_header); ?>
<?php } ?>
</h2>
<p>
<?php if($tn_wpmu_box3_text == '') { ?>
<?php _e('All you need to do is to visit your <a href="wp-admin/themes.php?page=custom-homepage.php">Custom Homepage Images</a> tab and upload new images (you can crop them after uploading) and enter text and links to replace this text.', 'nelo'); ?>
<?php } else { ?>
<?php echo stripslashes($tn_wpmu_box3_text); ?>
<?php } ?>
</p>



<ul class="list">

<?php if(($tn_wpmu_box3_cat == "Choose a category") || ($tn_wpmu_box3_cat == '')) { ?>
<?php } else { $category_id = get_cat_ID($tn_wpmu_box3_cat); ?>
<li id="cat-<?php echo $tn_wpmu_box3_cat; ?>">
<h3><?php echo stripslashes($tn_wpmu_box3_cat); ?></h3>
<ul>
<?php $my_query = new WP_Query('cat='. $category_id . '&' . 'showposts=' . 10);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID; ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>
</li>
<?php } ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Home Box Right', TEMPLATE_DOMAIN)) ) : ?>
<?php endif; ?>

</ul>

</div>

</div>