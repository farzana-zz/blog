<?php
/*
Template Name: News
*/
?>

<?php get_header(); ?>

<div id="post-entry">

<?php locate_template ( array('headline.php'), true ); ?>

<?php $page = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=&showposts=10&paged=$page"); while ( have_posts() ) : the_post() ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

<div class="post-author"><?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('edit', TEMPLATE_DOMAIN)); ?></div>

<div class="post-content">
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?>
<?php the_post_thumbnail(array(200,160), array('class' => 'alignleft')); ?><?php } } ?>
<?php the_excerpt();?>
<p><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php _e('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN); ?></a></p>
</div>
<?php include ( TEMPLATEPATH . '/social.php'); ?>

</div>

<?php endwhile; ?>

<div id="post-navigator-single">       
<div class="alignleft"><?php previous_posts_link(__('&laquo; Newer Entries', TEMPLATE_DOMAIN)); ?></div>
<div class="alignright"><?php next_posts_link(__('Older Entries &raquo;', TEMPLATE_DOMAIN)); ?></div>
</div>

</div>

<?php get_sidebar(); ?>

<?php locate_template ( array('bottom-content.php'), true ); ?>

<?php get_footer(); ?>