<!-- BEGIN MAIN-NAV.PHP -->
<ul>
<!-- To show "current" on the home page -->
<li<?php if (is_home()) { echo " id=\"current\""; } ?>>
<a href="<?php bloginfo('url'); ?>" title="<?php _e('Home Page'); ?>"><span><?php _e('Home'); ?></span></a></li>

<?php 
$pages = $wpdb->get_results("SELECT post_name, post_title, ID FROM $wpdb->posts WHERE post_type='page'");
$getTitle=trim(wp_title(' ', false));
$check=0;
foreach($pages as $page){ ?>
<?php 
$getPageTitle=trim($page->post_title);
if($getTitle==$getPageTitle)
{$check=1;}
else
{$check=0;}
?>
<li>
	<a <?php if($check==1)echo'id="mactive"' ?> href="<?php echo get_settings('home')."/?page_id=".($page->ID); ?>"><span class="mLink"><?php echo $page->post_title; ?></span>
		<span class="m<?php echo $page->post_title; ?>"></span>
	</a>
</li>
<?php } ?>

</ul>
<!-- END MAIN-NAV.PHP -->