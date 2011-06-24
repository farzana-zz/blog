<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/options.php'); ?>

<?php if(($tn_wpmu_layout_mode == "") || ($tn_wpmu_layout_mode == "custom homepage")) { ?>

<?php locate_template ( array('custom-homepage.php'), true); ?>

<?php } else if($tn_wpmu_layout_mode == "blog homepage") { ?>

<div id="post-entry">

<?php if (have_posts()) : ?>

<?php locate_template ( array('headline.php'), true); ?> 

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

<div class="post-author">
<?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link('edit', TEMPLATE_DOMAIN); ?></div>

<div class="post-content">
<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?>
<?php the_post_thumbnail(array(200,160), array('class' => 'alignleft')); ?><?php } } ?>
<?php the_excerpt();?>
<p><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php _e('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN); ?></a></p>
<?php } else { ?>
<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', TEMPLATE_DOMAIN)); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php } ?>
</div>

<?php locate_template ( array('social.php'), true); ?>

</div>

<?php endwhile; ?>

<?php locate_template ( array('paginate.php'), true); ?>

<?php else: ?>

<?php locate_template ( array('result.php'), true); ?>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php } ?>

<?php locate_template ( array('bottom-content.php'), true); ?>

<?php get_footer(); ?>