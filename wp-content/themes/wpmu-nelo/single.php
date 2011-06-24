<?php get_header(); ?>

<div id="post-entry">

<?php if (have_posts()) : ?>

<?php locate_template (array('headline.php'), true); ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><?php the_title(); ?></h1>

<div class="post-author"><?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('edit', TEMPLATE_DOMAIN)); ?></div>

<div class="post-content">
<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', TEMPLATE_DOMAIN)); ?>
</div>

<?php include ( TEMPLATEPATH . '/social.php'); ?>

</div>

<?php endwhile; ?>

<?php if ( comments_open() ) { ?>
<?php
$mywp_version = get_bloginfo('version');
if ($mywp_version >= '2.7') {
comments_template('', true);
} else {
comments_template();
} ?>
<?php } ?>

<?php locate_template (array('paginate.php'), true); ?>

<?php else: ?>

<?php locate_template (array('result.php'), true); ?>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php locate_template (array('bottom-content.php'), true); ?>

<?php get_footer(); ?>