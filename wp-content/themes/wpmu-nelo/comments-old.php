<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die (__('Please do not load this page directly. Thanks!', 'nelo'));
if (!empty($post->post_password)) { // if there's a password
if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
?>
<h2 id="post-header"><?php _e('This post is password protected. Enter the password to view comments.', 'nelo'); ?></h2>
<?php
return;
}
}

$oddcomment = 'alt';


?>


<div id="commentpost">

<?php
global $bm_comments;
global $bm_trackbacks;
split_comments( $comments );
?>

<?php if ( $comments ) : ?>

<?php
$trackbackcounter = count( $bm_trackbacks );
$commentcounter = count( $bm_comments );
?>

<?php if ('open' == $post->comment_status) { ?>
<h4 id="comments"><?php comments_number(__('No Comments Yet', 'nelo'), __('1 Comment Already', 'nelo'), __('% Comments Already', 'nelo')); ?></h4>
<?php } else { ?>
<h4 id="comments"><?php _e('Sorry, the comment form is closed at this time.', 'nelo'); ?></h4>
<?php } ?>

<ol class="commentlist">

<?php foreach ($bm_comments as $comment) : ?>

<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
<div id="div-comment-<?php comment_ID() ?>">
<div class="comment-author vcard">
<?php if(function_exists("get_avatar")) { ?>
<?php echo get_avatar( $comment, 48 ); ?>
<?php } ?>
<cite class="fn"><?php comment_author_link(); ?></cite> <span class="says"><?php _e('says:', 'nelo'); ?></span>
</div>

<div class="comment-meta commentmetadata"><a href="#comment-<?php comment_ID() ?>"><?php comment_date('F jS, Y') ?></a>&nbsp;&nbsp;
<?php edit_comment_link(__("edit", 'nelo'), ''); ?></div>

<?php if ($comment->comment_approved == '0') : ?>
<strong><?php _e('Your Comment Is Under Moderation', 'nelo'); ?></strong>
<?php else: ?>
<?php comment_text(); ?>
<?php endif; ?>

</div>
</li>

<?php if ('alt' == $oddcomment) $oddcomment = ''; else $oddcomment = 'alt'; ?>
<?php endforeach; ?>

</ol>

<?php if ( count( $bm_trackbacks ) > 0 ) { ?>

<h4><?php echo $trackbackcounter; ?><?php _e('Trackbacks/Pingbacks', 'nelo'); ?></h4>

<ol class="pinglist">

<?php foreach ($bm_trackbacks as $comment) : ?>

<li id="comment-<?php comment_ID() ?>"><?php comment_author_link(); ?></li>

<?php if ('-alt' == $oddcomment) $oddcomment = ''; else $oddcomment = '-alt'; ?>
<?php endforeach; ?>

</ol>

<?php } ?>

<?php endif; ?>







<div id="respond">

<?php if ('open' == $post->comment_status) : ?>

<?php if (get_option('comment_registration') && !$user_ID) : ?>

<label>
<?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'nelo'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?>
</label>

<?php else : ?>

<h4><?php _e('Leave a Reply', 'nelo'); ?></h4>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="cf">

<?php if (!$user_ID) : ?>

<p>
<label for="author"><small><?php _e('Name', 'nelo'); ?> <?php if ($req) _e('(required)', 'nelo'); ?></small></label><br />
<input type="text" class="tf" name="author" id="author" value="<?php echo $comment_author; ?>" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p>
<label for="email"><small><?php _e('Mail (will not be published)', 'nelo');?> <?php if ($req) _e('(required)', 'nelo'); ?></small></label><br />
<input type="text" class="tf" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p>
<label for="url"><small><?php _e('Website', 'nelo'); ?></small></label><br />
<input type="text" class="tf" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
</p>

<?php endif; ?>


<p>
<?php if ( $user_ID ) : ?>

<label>
<?php printf(__('Logged in as %s.', 'nelo'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <?php $mywp_version = get_bloginfo('version'); if ($mywp_version >= '2.7') { ?> <a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>"><?php _e('Log out &raquo;', 'nelo'); ?></a> <?php } else { ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Log out &raquo;', 'nelo'); ?></a> <?php } ?>
</label>

<?php endif; ?>

<textarea name="comment" id="comment" cols="50%" rows="8" class="af"></textarea>

</p>

<p>

<input name="submit" type="submit" value="<?php echo attribute_escape(__('Submit Comment', 'nelo')); ?>" class="st" id="submit" alt="submit" />

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>

</p>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>

</div>