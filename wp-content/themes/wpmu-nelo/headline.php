<?php if (is_category()) { ?>

<h2 id="post-header"><?php _e('Archives for', TEMPLATE_DOMAIN); ?> <?php single_cat_title(); ?></h2>

<?php } else if (is_tag()) { ?>

<h2 id="post-header"><?php _e('Tag archives for', TEMPLATE_DOMAIN); ?> <?php single_cat_title(); ?></h2>

<?php } else if (is_date()) { ?>

<h2 id="post-header">
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_day()) { ?>
<?php _e('Archives for', TEMPLATE_DOMAIN); ?> <?php the_time('F jS, Y'); ?>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<?php _e('Archives for', TEMPLATE_DOMAIN); ?> <?php the_time('F, Y'); ?>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<?php _e('Archives for', TEMPLATE_DOMAIN); ?> <?php the_time('Y'); ?>
<?php } ?>
</h2>

<?php } else if (is_single()) { ?>

<?php } else if (is_author()) { ?>

<?php
if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif;
?>
<div id="author-bio" class="post-content">
<div class="avatar alignleft"><?php echo get_avatar($curauth->user_email, '128', $avatar); ?></div>

<div id="author-profile">
<h1><?php echo $curauth->display_name; ?></h1>
<p>
<?php if($curauth->user_description<>''): echo $curauth->user_description; else: _e("This user hasn't shared any biographical information", TEMPLATE_DOMAIN); endif; ?>
</p>

<?php
if(($curauth->user_url<>'http://') && ($curauth->user_url<>'')) echo '<p class="im">'.__('Homepage:',TEMPLATE_DOMAIN).' <a href="'.$curauth->user_url.'">'.$curauth->user_url.'</a></p>';
if($curauth->yim<>'') echo '<p class="im">'.__('Yahoo Messenger:',TEMPLATE_DOMAIN).' <a class="im_yahoo" href="ymsgr:sendIM?'.$curauth->yim.'">'.$curauth->yim.'</a></p>';
if($curauth->jabber<>'') echo '<p class="im">'.__('Jabber/GTalk:',TEMPLATE_DOMAIN).' <a class="im_jabber" href="gtalk:chat?jid='.$curauth->jabber.'">'.$curauth->jabber.'</a></p>';
if($curauth->aim<>'') echo '<p class="im">'.__('AIM:',TEMPLATE_DOMAIN).' <a class="im_aim" href="aim:goIM?screenname='.$curauth->aim.'">'.$curauth->aim.'</a></p>';
?>
</div>
</div>

<?php } else if (is_search()) { ?>

<h2 id="post-header"><?php _e('Search result for', TEMPLATE_DOMAIN); ?> &quot; <?php the_search_query(); ?> &quot;</h2>

<?php } ?>