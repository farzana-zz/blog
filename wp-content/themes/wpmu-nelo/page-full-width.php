<?php
/*
Template Name: Full-Width
*/
?>

<?php get_header(); ?>

<div class="full-width" id="post-entry">

<?php if (have_posts()) : ?>

<?php locate_template ( array('headline.php'), true ); ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="page"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><?php the_title(); ?></h1>

<div class="post-content">
<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', TEMPLATE_DOMAIN)); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<p><?php edit_post_link(__('Edit This Page', TEMPLATE_DOMAIN)); ?></p>
</div>

</div>

<?php endwhile; ?>

<?php if ( comments_open() ) { ?><?php comments_template('', true); ?><?php } ?>

<?php else: ?>

<?php locate_template ( array('result.php'), true ); ?>

<?php endif; ?>

</div>

<?php //locate_template ( array('bottom-content.php'), true ); ?>

<?php get_footer(); ?>