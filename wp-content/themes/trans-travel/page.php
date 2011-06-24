<?php get_header(); ?>

<!-- Start of Two Column Fixed Body -->
 	<div id="right">	
	<?php get_sidebar(); ?>
	</div><!-- End of Column Left -->
	
	<div id="left">
							<?php
								if (have_posts())
								{
										 while (have_posts()) 
										 {
										 the_post();
							?>		
									<div id="page-<?php echo the_ID();?>" class="<?php echo $alternate;?>">
													<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
													<?php if ( get_post_meta($post->ID, 'heading', true) ) 
													{ 
													?> 
														<h4><?php echo get_post_meta($post->ID, "heading", $single = true); ?></h4>
													<?php 
													}
													?>													
													
													<div class="post-body">
													<?php the_content('Read the rest of this entry &raquo;'); ?>
													</div>
										</div>	 
							<?php
										 }
							?>
							
							<?php			 
								}else{
								// No Post Found
								?>
								
								<div id="errobox" style="padding-left:10px">
									<h2 class="center">404 Not Found</h2>
									<p class="center">Sorry, but you are looking for something that isn't here.</p>
								</div>	
								
								<?php
								}
							?>
	</div><!-- End of Column Right -->
	<div style="clear:both"></div>
<!-- End of Two Column Fixed Body -->

<?php get_footer(); ?>							