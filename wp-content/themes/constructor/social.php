<?php
/**
 * @package WordPress
 * @subpackage constructor
 */
$title = urlencode(get_the_title());
$link  = urlencode(get_permalink());
$short = urlencode(wp_get_shortlink());

// need more social links - read http://netler.ru/ikt/share-this-page.htm
?>
<div class="social">
    <?php if (get_constructor_option('content','social','twitter')) : ?>
        <a href="http://twitter.com/home?status=<?php echo $title .'+'. $short ?>" rel="nofollow" class="twitter"><?php _e('Twitter','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','facebook')) : ?>
        <a href="http://www.facebook.com/sharer.php?u=<?php echo $link ?>&t=<?php echo $title ?>" rel="nofollow" class="facebook"><?php _e('Facebook','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','delicious')) : ?>
        <a href="http://delicious.com/save?url=<?php echo $link ?>&title=<?php echo $title ?>" rel="nofollow" class="delicious"><?php _e('Del.icio.us','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','reddit')) : ?>
        <a href="http://www.reddit.com/submit?url=<?php echo $link ?>&title=<?php echo $title ?>" rel="nofollow" class="reddit"><?php _e('Reddit','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','vkontakte')) : ?>
        <a href="http://vkontakte.ru/share.php?url=<?php echo $link ?>&title=<?php echo $title ?>" rel="nofollow" class="vkontakte"><?php _e('VKontakte','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','digg')) : ?>
        <a href="http://www.digg.com/submit?phase=2&url=<?php echo $link ?>&title=<?php echo $title ?>" rel="nofollow" class="digg"><?php _e('Digg','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','mixx')) : ?>
        <a href="http://www.mixx.com/submit?page_url=<?php echo $link ?>" rel="nofollow" class="mixx"><?php _e('Mixx','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','stumbleupon')) : ?>
        <a href="http://www.stumbleupon.com/submit?url=<?php echo $link ?>&title=<?php echo $title ?>" rel="nofollow" class="stumbleupon"><?php _e('StumbleUpon','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','google')) : ?>
        <a href="http://www.google.com/bookmarks/mark?op=add&bkmk=<?php echo $link ?>&title=<?php echo $title ?>" rel="nofollow" class="google"><?php _e('Google','constructor');?></a>
    <?php endif; ?>
    <?php if (get_constructor_option('content','social','memori')) : ?>
        <a href="http://memori.ru/link/?sm=1&u_data[url]=<?php echo $link ?>&&u_data[name]=<?php echo $title ?>" rel="nofollow" class="memori"><?php _e('Memori','constructor');?></a>
    <?php endif; ?>
</div>