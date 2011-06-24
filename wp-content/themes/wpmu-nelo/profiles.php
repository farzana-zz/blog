<ul class="list">

<?php
  global $user_ID, $user_identity, $user_url, $user_email;
  get_currentuserinfo();
  if (!$user_ID):
?>

<li>
<h3><?php _e('Member Login', TEMPLATE_DOMAIN); ?></h3>
<ul>
<li>
<form name="loginform" id="logs" action="<?php echo get_settings('siteurl'); ?>/wp-login.php" method="post">
<label><?php _e('Username:', TEMPLATE_DOMAIN); ?></label>

<p><input name="log" type="text" class="textf" value="username here" onfocus="if (this.value == '<?php _e("username here",TEMPLATE_DOMAIN); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("username here",TEMPLATE_DOMAIN); ?>';}" /></p>

<label><?php _e('Password:', TEMPLATE_DOMAIN); ?></label>
<p><input name="pwd" type="password" class="textf" value="password" onfocus="if (this.value == 'password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'password';}" /></p>

<p>
<input name="login" type="submit" value="Login" />
<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/></p>
</form>
</li>
<li><small><a href="<?php echo get_settings('siteurl'); ?>/wp-login.php?action=lostpassword"><?php _e('Lost your password?', TEMPLATE_DOMAIN); ?></a>&nbsp;|&nbsp;<?php if(function_exists('get_current_site')) { ?><a href="<?php echo get_settings('siteurl'); ?>/wp-signup.php"><?php } else { ?><a href="<?php echo get_settings('siteurl'); ?>//wp-login.php?action=register"><?php } ?><?php _e('Create a new account', TEMPLATE_DOMAIN); ?> </a></small></li>
</ul>
</li>

<?php else: ?>

<?php
$pathtotheme = get_bloginfo('template_directory');
$md5 = md5($user_email);
$default = urlencode("$pathtotheme/images/mygif.gif");
?>

<li>
<h3><?php _e('Welcome Back', TEMPLATE_DOMAIN); ?>, <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a></h3>
<ul>
<li>
<p id="profile-avatar">

<?php if (function_exists('get_avatar')) { ?>
<?php echo get_avatar( $user_email , 52 ); ?>
<?php } else { ?>
<?php echo "<img src='http://www.gravatar.com/avatar.php?gravatar_id=$md5&size=52&default=$default' alt='$user_identity' />"; ?>
<?php } ?>

<span id="profile-stuff">
<a href="<?php echo $user_url; ?>"><?php _e('Author Homepage', TEMPLATE_DOMAIN); ?></a><br />
<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">Profile</a>&nbsp;|&nbsp;<?php $mywp_version = get_bloginfo('version'); if ($mywp_version >= '2.7') { ?> <a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>"><?php _e('Log out &raquo;', TEMPLATE_DOMAIN); ?></a> <?php } else { ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Log out &raquo;', TEMPLATE_DOMAIN); ?></a> <?php } ?></span>
</p>
</li>
<li><?php echo stripslashes($tn_wpmu_profile_text); ?></li>
</ul>
</li>

<?php endif; ?>

</ul>