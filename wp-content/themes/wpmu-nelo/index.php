<?php get_header(); ?>

<div id="post-entry">

<?php if (have_posts()) : ?>

<?php
$breadcrumb_on = get_option('tn_wpmu_breadcrumb_on');
if( $breadcrumb_on == "" || $breadcrumb_on == "enable" ) {
if (class_exists('breadcrumb_navigation_xt')) {
    echo "<div id='page-nav'>";
	// New breadcrumb object
	$mybreadcrumb = new breadcrumb_navigation_xt;
	// Options for breadcrumb_navigation_xt
	$mybreadcrumb->opt['title_blog'] = __('Home', 'nelo');
	$mybreadcrumb->opt['separator'] = ' &raquo; ';
	$mybreadcrumb->opt['singleblogpost_category_display'] = true;
	// Display the breadcrumb
	$mybreadcrumb->display();
echo '</div>';
}
}
?>

<?php locate_template (array('headline.php'), true); ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
</h1>

<div class="post-author">
<?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('edit', TEMPLATE_DOMAIN)); ?>
</div>

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

<?php include ( TEMPLATEPATH . '/social.php'); ?>

</div>

<?php endwhile; ?>

<?php if ( comments_open() ) { ?><?php comments_template('', true); ?><?php } ?>

<?php locate_template ( array('paginate.php'), true ); ?>

<?php else: ?>

<?php locate_template ( array('result.php'), true ); ?>

<?php endif; ?>

</div> <!-- end post-entry -->

<?php get_sidebar(); ?>

<?php locate_template ( array('bottom-content.php'), true ); ?>

<?php get_footer(); ?>