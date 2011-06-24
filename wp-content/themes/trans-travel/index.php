<?php get_header(); ?>

<!-- Start of Two Column Fixed Body -->
 	<div id="right">	
	<?php get_sidebar(); ?>
	</div><!-- End of Column Left -->
	
	<div id="left">
		<?php include(TEMPLATEPATH . '/showposts.php');?>
	</div><!-- End of Column Right -->
	<div style="clear:both"></div>
<!-- End of Two Column Fixed Body -->

<?php get_footer(); ?>