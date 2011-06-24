<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'nelo'));

	if ( post_password_required() ) { ?>
		<h2 id="post-header"><?php _e('This post is password protected. Enter the password to view comments.', 'nelo'); ?></h2>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="commentpost">

<?php if ( have_comments() ) : ?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>

<h4 id="comments"><span><?php comments_number(__('No Comments Yet', 'nelo'), __('1 Comment Already', 'nelo'), __('% Comments Already', 'nelo')); ?></span></h4>

<div id="post-navigator-single">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>


<ol class="commentlist">
<?php wp_list_comments('type=comment'); ?>
</ol>


<div id="post-navigator-single">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

<?php endif; ?>

<?php if ( ! empty($comments_by_type['pings']) ) : ?>
<h4><span><?php _e('Trackbacks/Pingbacks', 'nelo'); ?></span></h4>

<ol class="pinglist">
<?php wp_list_comments('type=pings&callback=list_pings'); ?>
</ol>
<?php endif; ?>


<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' == $post->comment_status) : ?>
 <!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<h2 id="post-header"><?php _e('Sorry, the comment form is closed at this time.', 'nelo'); ?></h2>

<?php endif; ?>

<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h4><span><?php comment_form_title(__('Leave a Reply', 'nelo'), __('Leave a Reply to %s', 'nelo') ); ?></span></h4>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'nelo'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="cf">

<?php if ( $user_ID ) : ?>

<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <?php $mywp_version = get_bloginfo('version'); if ($mywp_version >= '2.7') { ?> <a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>"><?php _e('Log out &raquo;', 'nelo'); ?></a> <?php } else { ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Log out &raquo;', 'nelo'); ?></a> <?php } ?></p>


<?php else : ?>

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
<textarea name="comment" id="comment" cols="50%" rows="8" class="af"></textarea>
</p>

<p>
<input name="submit" type="submit" class="st" value="<?php echo attribute_escape(__('Submit Comment', 'nelo')); ?>" id="submit" alt="submit" />

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>

</p>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>
