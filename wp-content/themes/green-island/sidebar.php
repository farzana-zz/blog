	<div id="sidebar">
	
	
	
	<div id="sidebar_main">
		
		
		
		<?php if(is_home() ) { ?>
		
		<div class="sidebox" style="margin-bottom: 0px;">
			<h2>Latest comments</h2>

			<ul>
			<?php

			$latest_comments = wt_get_comments();

			foreach ($latest_comments as $the_comment) { ?>
				<li>
				
				<small style="color: #aaa; font-size: 11px;">
				<?php echo date("F jS, Y", strtotime($the_comment->comment_date)); ?>
				</small>
				<a style="margin-bottom: 3px;" href="<?php echo get_permalink($the_comment->comment_post_ID); ?>#comment-<?php echo $the_comment->comment_ID; ?>">
				
				<?php
				echo wt_limit_string($the_comment->comment_content, 92); 
				?>
				</a></li>
				
			<?php }	?>
			</ul>

			
			
		</div>
		
		<?php } else { ?>
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		
		<div class="sidebox">
			<h2>Latest posts</h2>
				<?php query_posts('showposts=5'); ?>
				<ul>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					<?php endif; ?>
				</ul>
		</div>
		
		
		
		<div class="sidebox">
			<h2>Categories</h2>
			<ul><?php wp_list_categories('show_count=1&title_li=&show_count=0'); ?></ul>
		</div>
		
		<div class="sidebox">
			<h2>Tags</h2>
			<?php wp_tag_cloud(''); ?>
		</div>
		
		<div class="sidebox" style="margin-bottom: 0px;">
			<ul><?php wp_list_bookmarks('show_count=1&title_li=&show_count=0'); ?></ul>
		</div>
		
		<?php endif; ?>
		
		<?php } ?>

		
	</div>
	
	<div id="sidebar_bottom"></div>
	
	
	</div>

