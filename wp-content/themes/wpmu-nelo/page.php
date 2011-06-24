<?php get_header(); ?>

<div id="post-entry">

<?php if (have_posts()) : ?>

<?php include (TEMPLATEPATH . '/headline.php'); ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="page"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><?php the_title(); ?></h1>

<div class="post-content">
<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', 'nelo')); ?>
<p><?php edit_post_link(__('Edit This Page', 'nelo')); ?></p>
</div>



</div>

<?php endwhile; ?>

<?php /* comments_template(); */ ?>

<?php include (TEMPLATEPATH . '/paginate.php'); ?>

<?php else: ?>

<?php include (TEMPLATEPATH . '/result.php'); ?>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php include (TEMPLATEPATH . '/bottom-content.php'); ?> 

<?php get_footer(); ?>