	

      <?php
	if( function_exists('dynamic_sidebar') && dynamic_sidebar('columnLeft') )
	{
	
	}else{ 
	?>
	
       <div class="cat">
		<h3><?php _e('Categories'); ?></h3>
		<ul>
		<?php wp_list_categories('title_li=&hierarchical=0'); ?>
		</ul>
	</div>
	
       <div class="calendar">
	<h3><?php _e('Calendar:'); ?></h3>
	<ul>
		<li id="calendar">
                   <?php get_calendar(true); ?>			
		</li>
	</ul>	
	</div>
	<div class="cat">
		<h3>Archives</h3>
		<ul>
		  <?php wp_get_archives('type=monthly&show_post_count=1'); ?>
		</ul>
	</div>
		
	<?php
	}
	?>
<!-- sidebar -->