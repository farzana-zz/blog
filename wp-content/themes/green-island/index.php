<?php get_header(); ?>

	<div id="main">
		<div id="content">
		
		
		<?php
			$aboutPage = new WP_Query();
			$aboutPage->query('page_id=' . gi_get_ID_by_page_name('about'));
			while ($aboutPage->have_posts()) : $aboutPage->the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>

					<div class="entry">
						<?php the_content('Read the rest of this entry &raquo;'); 
						#the_excerpt();
						echo '<div class="clear"></div>';
						
						?>
					</div>
					
					
				</div>
				<div class="clear"></div>
			<?php endwhile; ?>
		
		<h4 class="related_top">Latest posts</h4>
				
				<div class="related posts">
					<ul class="left"><?php
							$boxPosts = new WP_Query();
								$boxPosts->query('showposts=2');
								$i = 0;
								while ($boxPosts->have_posts()) : $boxPosts->the_post();
									if($i<1)
									{
										echo '<li><h1><a href="'.get_permalink().'">' . get_the_title() . '</a></h1>';
										echo '<small>' . get_the_time('Y-m-d') . '</small>';
										the_excerpt();
										
										echo '</li>';
									}
									$i++;
								endwhile;
						?></ul>
				
					
					<table class="right">
								<?php	
								$boxPosts = new WP_Query();
								$boxPosts->query('showposts=11');
								$i = 0;
								$permalink = array();
								while ($boxPosts->have_posts()) : $boxPosts->the_post();
									if( $i >= 1 )
									{ ?>
										<tr>
											<th valign="top"><small><?php the_time('F jS, Y'); ?></small></th>
											<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
										</tr>
									<?php }
									$i++;
								endwhile;
								?>
					</table>
						
					<div class="clear"></div>
					
				</div>
				
				

			
		
		
		<h4 class="related_top">Categories</h4>
				
				<div class="related" style="border-left: 5px solid #92becb">
					<ul>
						<?php wp_list_categories('show_count=1&title_li=&show_count=0'); ?>
						
					</ul>
					
				</div>
				
				<h4 class="related_top">Tags</h4>
				
				<div class="related" style="border-left: 5px solid #92becb">
					<ul>
						
						<li><?php wp_tag_cloud(''); ?></li>
						
					</ul>
					
					
				</div>

		
		</div>
		
		
		
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>

	<div class="greenline"></div>

<div class="clear"></div>
<?php get_footer(); ?>
