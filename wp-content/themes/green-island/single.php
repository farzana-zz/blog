<?php get_header(); ?>

	<div id="main">
		<div id="content">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<small><?php the_time('F jS, Y') ?></small>

					
						<?php the_content('Read the rest of this entry &raquo;'); 
						#the_excerpt();
						echo '<div class="clear"></div>';
						
						?>
					
					
					
				</div>
				<div class="clear"></div>
				
				<h4 class="related_top">Related</h4>
				
				<div class="related">
					<ul>
						<?php the_tags('<li>Tags: ', ', ', '</li>'); ?>
						<li>Categories: <?php the_category(', ') ?></li>
						<li>Comments: <a href="#comments"><?php comments_number('No Comments', 'One Comment', '% Comments' );?></a></li>
						<?php edit_post_link('Edit post', '<li>Edit: ', '</li>'); ?>
					</ul>
				</div>
			<?php endwhile; ?>

			

		<?php else : ?>

			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>

		<?php endif; ?>
		<div id="comments">
		<?php comments_template(); ?>
		</div>
		</div>
		
		
		
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>

	<div class="greenline"></div>

<div class="clear"></div>
<?php get_footer(); ?>
