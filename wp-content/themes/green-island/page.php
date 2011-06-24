<?php get_header(); ?>

	<div id="main">
		<div id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<small><?php the_time('F jS, Y') ?></small>
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					<div class="clear"></div>
					
					
				</div>
				
				
						<?php edit_post_link('Edit post', '<h4 class="related_top">Related</h4><div class="related"><ul><li>Edit: ', '</li></ul></div>'); ?>
				
			<?php endwhile; ?>

			<?php else : ?>

			<h1>Page content missing!</h1>
			<p>Sorry, but you are looking for something that isn't here.</p>
			

		<?php endif; ?>
		
		</div>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>

	<div class="greenline"></div>

<div class="clear"></div>
<?php get_footer(); ?>