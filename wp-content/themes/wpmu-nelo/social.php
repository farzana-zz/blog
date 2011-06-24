<div class="post-category"><?php _e('category:&nbsp;', TEMPLATE_DOMAIN); ?><?php the_category(', ') ?></div>
<div class="post-tag"><?php if(function_exists("the_tags")) : ?><?php the_tags(__('tags:&nbsp;', TEMPLATE_DOMAIN), ', ', ''); ?><?php endif; ?></div>


<?php
$get_social = get_option('tn_wpmu_social_status');
if(($get_social == "") || ($get_social == "disable")) { ?>
<?php } else { ?><?php if((is_single()) || (is_page())) { ?>
<div class="post-social">
<?php
$plink = get_permalink();
$plink = urlencode($plink);
$ptitle = get_the_title();
$ptitle = urlencode($ptitle);
?>
<script type="text/javascript">
addthis_url    = '<?php echo "$plink"; ?> ';
addthis_title  = '<?php echo "$ptitle"; ?>';
addthis_pub    = '';
</script>
<script type="text/javascript" src="http://s7.addthis.com/js/addthis_widget.php?v=12" ></script>
</div>
<?php } } ?>



<div class="post-mail">
<ul>
<?php if((is_single()) || (is_page())) { ?>
<?php } else { ?>
<li class="mycomment"><?php comments_popup_link( __('No Comment', TEMPLATE_DOMAIN), __('1 Comment', TEMPLATE_DOMAIN), __('% Comments', TEMPLATE_DOMAIN) ); ?></li>
<?php } ?>
<li class="myemail"><a href="mailto:your@friend.com?subject=check this post - <?php the_title(); ?>&amp;body=<?php the_permalink(); ?> " rel="nofollow">
<?php _e('Email to friend', TEMPLATE_DOMAIN); ?></a></li>
<li class="myblogit"><a href="<?php trackback_url() ?>"><?php _e('Blog it', TEMPLATE_DOMAIN); ?></a></li>
<li class="myupdate"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Stay updated', TEMPLATE_DOMAIN); ?></a></li>
</ul>
</div>