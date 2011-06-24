<?php
	if (have_posts())
	{
	$i=1;
			 while (have_posts()) 
			 {
			 the_post();
			 $alternate=$i%2==0?"postentry1":"postentry2";
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
						<p class="categor"><strong>Posted:</strong> under <?php the_category(', ') ?>.<br />
<?php the_tags('Tags: ', ', ',''); ?><?php edit_post_link('[e]',' | ',''); ?></p>

						<div class="post-body">
						<?php the_content('Read the rest of this entry &raquo;'); ?>
						</div>
						
						<p class="date"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/comment.gif" alt="" /> 
						<a href="<?php comments_link(); ?>" class="entryComment">Comments (<?php comments_number('0', '1', '%'); ?>)</a>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/timeicon.gif" alt="" /><?php strtoupper(the_time('M d Y')) ?></p>			
			</div>	 
<?php
			$i++;		 
			 }
?>

	<?php if($wp_query->max_num_pages > 1)
	{ 
	//Pagination
	?>
				<div class="navigationbottom">
						<div class="leftnav"><?php next_posts_link('&laquo; Older Entries') ?></div>
						<div class="rightnav"><?php previous_posts_link('Newer Entries &raquo;') ?></div>				
						<div style="clear:both"></div>
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