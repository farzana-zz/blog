<?php get_header(); ?>

<!-- Start of Two Column Fixed Body -->
 	<div id="right">	
	<?php get_sidebar(); ?>
	</div><!-- End of Column Left -->
	
	<div id="left">
	<br />
						<?php if (have_posts()) : ?>
						<h4><em>Search Results |</em> "<?php printf(__('\'%s\''), $s) ?>"</h4>        
					
							<?php while (have_posts()) : the_post(); ?>		
				
							<div class="post" id="post-<?php the_ID(); ?>">
							

								
								<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<?php if ( get_post_meta($post->ID, 'heading', true) ) 
								{ 
								?> 
									<h4><?php echo get_post_meta($post->ID, "heading", $single = true); ?></h4>
								<?php 
								}
								?>								

								<p>

								<?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more">Read More
								</a>
								</p>
								<p class="date"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/comment.gif" alt="" /> 
								<a href="<?php comments_link(); ?>" class="entryComment">Comments (<?php comments_number('0', '1', '%'); ?>)</a>
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/timeicon.gif" alt="" /><?php strtoupper(the_time('M d Y')); ?></p>			
														
							</div><!--/post-->
				
						<?php endwhile; ?>
						
						<div class="navigation">
							<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
							<div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
						</div>
						
						<?php else : ?>
				
						<div id="archivebox">
							
								<h2><em>Search Results |</em> None Found!</h2>
								<div class="archivefeed">Sorry! Your search yielded no results. Please search again.</div>				
						
						</div><!--/archivebox-->				
					
					<?php endif; ?>							
	</div><!-- End of Column Right -->
	<div style="clear:both"></div>
<!-- End of Two Column Fixed Body -->

<?php get_footer(); ?>