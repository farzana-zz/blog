<?php get_header(); ?>

	<div id="main">
		<div id="content">
		
			<small><em>Search result for '<?php echo $_GET["s"]; ?>'</em></small>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<small><?php the_time('F jS, Y') ?></small>
					

					
						<?php the_content('Read the rest of this entry &raquo;'); 
						echo '<div class="clear"></div>';
						
						?>
					
					<div class="readmore">
						<a href="<?php the_permalink(); ?>">Read more</a>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
				
				
				
			<?php endwhile; ?>

			<div class="navigation">
					<div class="alignleft"><?php next_posts_link('Older Entries') ?></div>
					<div class="alignright"><?php previous_posts_link('Newer Entries') ?></div>
					
					<?php global $max; echo $max; ?>
			</div>

		<?php else : ?>

			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>

		<?php endif; ?>
		
		</div>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>

	<div class="greenline"></div>

<div class="clear"></div>
<?php get_footer(); ?>
