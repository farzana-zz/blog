<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>
			<p>This post is password protected. Enter the password to view comments.</p>
			<?php
			return;
		}
	}
?>

<?php if ($comments) : ?>
	<h4 class="related_top">Replys</h4>
	
	<ol id="the_comments">
	
	<?php
		$count_comments = sizeof($comments);
		$i = 1;
		foreach ($comments as $comment) : ?>
			<li class="comment">
				<div class="comment_inside">
					<div class="image"><?php echo '<a href="http://en.gravatar.com/site/signup">' . get_avatar( $comment, 48 ) . '</a>'; ?></div>
					<div class="comment_text">
						<div class="comment_title">
							<?php comment_author_link() ?> - <span style="color: #71ad43; font-size: 11px;"><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></span>
						</div>
						<?php comment_text(); ?>
						<?php if ($comment->comment_approved == '0') : ?>
						<p><em>Your comment is awaiting moderation.</em></p>
						<?php endif; ?>
					</div>
					<div class="clear"></div>
					
					<?php if ($i < $count_comments) { ?>
						<div class="line"></div>
					<?php } ?>
					
					<small><?php edit_comment_link('Edit','',''); ?></small>
				</div>
			</li>
		<?php
		$i ++;
		endforeach; ?>
	
	</ol>
	
	 <?php else : ?>
		<?php if ('open' == $post->comment_status) : ?>
		 <?php else : ?>
			<p>Comments are closed.</p>
		<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
	<h4 class="related_top">Leave a Reply</h4>
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
		<?php else : ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<div id="comment-form">
				<?php if ( $user_ID ) : ?>
					<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out</a></p>
				<?php else : ?>
					<p><input value="Name" type="text" name="author" id="author" tabindex="1" onclick="formActive('author');" onblur="formInActive('author');" /></p>
					<p><input value="E-mail" type="text" name="email" id="email" tabindex="2" onclick="formActive('email');" onblur="formInActive('email');" /></p>
					<p><input value="Homepage" type="text" name="url" id="url" tabindex="3" onclick="formActive('url');" onblur="formInActive('url');" /></p>
				<?php endif; ?>
				<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" onclick="formActive('comment');" onblur="formInActive('comment');">Leave a message...</textarea>
				<input name="submit" type="submit" class="submit" id="submit" tabindex="5" value="Send Comment" />
				<div class="clear"></div>
			</div>
			<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			<?php do_action('comment_form', $post->ID); ?>
		</form>
	<?php endif; ?>
<?php endif; ?>
