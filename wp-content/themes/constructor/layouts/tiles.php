<?php
/**
 * @package WordPress
 * @subpackage constructor
 */
__('Tile', 'constructor'); // required for correct translation
?>
<div id="content" class="box shadow opacity <?php the_constructor_layout_class() ?>">
    <div id="container" >
    <?php get_constructor_slideshow(true) ?>
    <?php if (have_posts()) : ?>
        <div id="posts">
        <?php while (have_posts()) : the_post(); ?>
            <div <?php post_class('tiles'); ?> id="post-<?php the_ID() ?>">
                 <div class="thumbnail">
                   <?php
                        // try to found post thubmnail
                        if (!($thumb = get_the_post_thumbnail(NULL, 'list-post-thumbnail'))) {
                            $thumb = get_constructor_noimage(128,128);
                        } 
                        echo $thumb;    
                    ?>
                </div>
                <div class="announce opacity">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'constructor'), the_title_attribute('echo=0')); ?>">
                        <span class="color4"><?php the_date() ?></span>

                        <?php the_title(); ?>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
            <div class="tiles next">
                <?php next_posts_link('&rarr;') ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
    <?php get_constructor_sidebar(); ?>
</div><!-- id='content' -->