<?php
///////////////////////////////////////////////////////////////////////////////////
////custom most commented post widget
///////////////////////////////////////////////////////////////////////////////////
function custom_most_comment($args) {
  extract($args);
  $settings = get_option("widget_custom_most_comment");
  $mc_name = $settings['name'];
//check if xustom name exited///
  if ($mc_name == '') {
    $mc_name = __('Most Commented', TEMPLATE_DOMAIN);
  }
  else {
    $mc_name = $mc_name;
  }
  $mc_number = $settings['number'];
  ?>

  <?php
  global $wpdb, $post;
  $mostcommenteds = $wpdb->get_results("SELECT $wpdb->posts.ID, post_title, post_name, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_total' FROM $wpdb->posts LEFT JOIN $wpdb->comments ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_date_gmt < '" . gmdate("Y-m-d H:i:s") . "' AND post_status = 'publish' AND post_password = '' GROUP BY $wpdb->comments.comment_post_ID ORDER  BY comment_total DESC LIMIT $mc_number");
  echo $before_widget;
  echo $before_title . stripcslashes($mc_name) . $after_title;
  echo "<ul> ";
  foreach ($mostcommenteds as $post) {
    $post_title = htmlspecialchars(stripslashes($post->post_title));
    $comment_total = (int) $post->comment_total;
    echo "<li><a href=\"" . get_permalink() . "\">$post_title&nbsp;<strong>($comment_total)</strong></a></li>";
  }
  echo "</ul> ";
  echo $after_widget;
  ?>

  <?php
}
function custom_most_comment_admin() {
  $settings = get_option("widget_custom_most_comment");
// check if anything's been sent
  if (isset ($_POST['update_custom_most_comment'])) {
    $settings['name'] = strip_tags(stripslashes($_POST['custom_most_comment_id']));
    $settings['number'] = strip_tags(stripslashes($_POST['custom_most_comment_number']));
    update_option("widget_custom_most_comment", $settings);
  }
  ?>
<p>
<label for="custom_most_comment_id"><?php _e('Name for most comment(optional):', TEMPLATE_DOMAIN);?>
<input id="custom_most_comment_id" name="custom_most_comment_id" type="text" class="widefat" value="<?php echo $settings['name'];?>" /></label></p>

<p>
<label for="custom_most_comment_number"><?php _e('Total to show: ', TEMPLATE_DOMAIN);?>
<input id="custom_most_comment_number" name="custom_most_comment_number" type="text" class="widefat" value="<?php echo $settings['number'];?>" /></label></p>
<input type="hidden" id="update_custom_most_comment" name="update_custom_most_comment" value="1" />

  <?php
}
wp_register_sidebar_widget('Custom Most Comment', TEMPLATE_DOMAIN . ' | Most Comment', 'custom_most_comment', array('description' => 'a widget that shows most commented post', TEMPLATE_DOMAIN));
wp_register_widget_control('Custom Most Comment', TEMPLATE_DOMAIN . ' | Most Comment', 'custom_most_comment_admin', 200, 200);



///////////////////////////////////////////////////////////////////////////////////
////wordpress custom recent comment widget
///////////////////////////////////////////////////////////////////////////////////

function custom_recent_comment($args) {
extract($args);
$settings = get_option("widget_custom_recent_comment");
$rc_name = $settings['name'];
if($rc_name == '') {
$rc_name = __('Recent Comments', TEMPLATE_DOMAIN); } else { $rc_name = $rc_name; }

$rc_avatar = $settings['avatar_on'];
$rc_number = $settings['number'];
?>

<?php

global $wpdb;

$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,50) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC LIMIT $rc_number";

$comments = $wpdb->get_results($sql);
$output = $pre_HTML;

echo $before_widget;

echo $before_title . stripcslashes($rc_name) . $after_title;

echo "<ul class='item-list' id='recent-comments'> ";

foreach ($comments as $comment) {

$grav_email = $comment->comment_author_email;
$grav_name = $comment->comment_author_name;
$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($email). "&amp;size=16";

?>
<li>
<?php if($rc_avatar == 'yes') {  ?>
<div class="item-avatar">
<?php echo get_avatar( $grav_email, '50'); ?>
</div>
<?php } ?>
<div class="item">
<span class="activity"><?php echo strip_tags($comment->comment_author); ?> <?php _e("says",TEMPLATE_DOMAIN); ?></span> <br />
<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php _e('on',TEMPLATE_DOMAIN); ?> <?php echo $comment->post_title; ?>">
<?php echo strip_tags($comment->com_excerpt); ?>...
</a>
</div>
</li>
<?php
}
echo "</ul> ";
echo $after_widget;
?>
<?php }

function custom_recent_comment_admin() {
$settings = get_option("widget_custom_recent_comment");
// check if anything's been sent
if (isset($_POST['update_custom_recent_comment'])) {
$settings['name'] = strip_tags(stripslashes($_POST['custom_recent_comment_name']));
$settings['avatar_on'] = strip_tags(stripslashes($_POST['custom_recent_comment_avatar_status']));
$settings['number'] = strip_tags(stripslashes($_POST['custom_recent_comment_number']));
update_option("widget_custom_recent_comment",$settings);
}

?>

<p>
<label for="custom_recent_comment_id"><?php _e('Name for recent comment(optional):', TEMPLATE_DOMAIN); ?>
<input id="custom_recent_comment_name" name="custom_recent_comment_name" type="text" class="widefat" value="<?php echo $settings['name']; ?>" /></label></p>

<p>
<label for="custom_recent_comment_avatar_status"><?php _e('Enable avatar?:', TEMPLATE_DOMAIN); ?>
<select id="custom_recent_comment_avatar_status" name="custom_recent_comment_avatar_status">
<option name="<?php echo $settings['avatar_on']; ?>" value="yes"><?php _e('yes', TEMPLATE_DOMAIN); ?></option>
<option name="<?php echo $settings['avatar_on']; ?>" value="no"><?php _e('no', TEMPLATE_DOMAIN); ?></option>
</select>
</p>

<p>
<label for="custom_recent_comment_number"><?php _e('Total to show:', TEMPLATE_DOMAIN); ?>
<input id="custom_recent_comment_number" name="custom_recent_comment_number" type="text" class="widefat" value="<?php echo $settings['number']; ?>" /></label></p>
<input type="hidden" id="update_custom_recent_comment" name="update_custom_recent_comment" value="1" />
<?php }

wp_register_sidebar_widget('Custom Recent Comments' , TEMPLATE_DOMAIN . ' | Recent Comments', 'custom_recent_comment', array('description' => 'a widget that shows recent comments with gravatar', TEMPLATE_DOMAIN));
wp_register_widget_control('Custom Recent Comments' , TEMPLATE_DOMAIN . ' | Recent Comments', 'custom_recent_comment_admin', 200, 200);



///////////////////////////////////////////////////////////////////////////
// Twitter Widget
///////////////////////////////////////////////////////////////////////////
function widget_twitter($args) {
extract($args); // Make before_widget, etc available.
   $options = get_option('widget_twitter');
   $username = htmlspecialchars($options['username'], ENT_QUOTES);
   $twitter_title = htmlspecialchars($options['twitter_title'], ENT_QUOTES);
   $number_of_tweets = htmlspecialchars($options['number_of_tweets'], ENT_QUOTES);
   // Generate HTML

echo $before_widget;
echo $before_title . stripcslashes($twitter_title) . ' - <a style="font-weight: normal; font-size: 11px;" href="http://twitter.com/' . $username . '">' . __("Follow me",TEMPLATE_DOMAIN) .'</a>' . $after_title;
echo "<ul id='mytweet'>"; ?>
<li>
<div id="twitter_update_list">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $number_of_tweets; ?>"></script>
</div><!-- TWITTER END -->
</li>
<?php echo "</ul>";
echo $after_widget;
?>

<?php }
function widget_twitter_control()
{
// Get access to the options array for the plugin
$options = get_option('widget_twitter');
// Set default options if no options are specified yet
if ( !is_array($options) )
$options = array('username'=>'', 'twitter_title'=>'My Tweets');


// Store the options if the form is submitted
if ( $_POST['widget_twitter_submit'] )
{
$options['username'] = strip_tags(stripslashes($_POST['widget_twitter_username']));
update_option('widget_twitter', $options);
$options['twitter_title'] = strip_tags(stripslashes($_POST['widget_twitter_twitter_title']));
update_option('widget_twitter', $options);
$options['number_of_tweets'] = strip_tags(stripslashes($_POST['widget_twitter_number_of_tweets']));
update_option('widget_twitter', $options);
}

// Get the options into variables, escaping html characters on the way
$username = htmlspecialchars($options['username'], ENT_QUOTES);
$twitter_title = htmlspecialchars($options['twitter_title'], ENT_QUOTES);
$number_of_tweets = htmlspecialchars($options['number_of_tweets'], ENT_QUOTES);
// Render the form.
// A <form> tag is not required, WordPress has already done that.
// Note the hidden input at the end, which is used to detect if the form is being submitted
?>

<p>
<label for="widget_twitter_twitter_title">
<?php echo __('Twitter Title:', TEMPLATE_DOMAIN)?>
</label>
<input class="widefat" type="text" id="widget_twitter_twitter_title" name="widget_twitter_twitter_title" value="<?php echo $twitter_title; ?>" />
</p>

<p>
<label for="widget_twitter_username">
<?php echo __('Twitter ID:', TEMPLATE_DOMAIN)?>
</label>
<input class="widefat" type="text" id="widget_twitter_username" name="widget_twitter_username" value="<?php echo $username?>" />
</p>
<p>
<label for="widget_twitter_number_of_tweets">
<?php echo __('Number Of Tweets:', TEMPLATE_DOMAIN)?>
</label>
<input class="widefat" type="text" id="widget_twitter_number_of_tweets" name="widget_twitter_number_of_tweets" value="<?php echo $number_of_tweets?>" />
</p>
<input type="hidden" id="widget_twitter_submit" name="widget_twitter_submit" value="1" />

<?php
}

wp_register_sidebar_widget('custom_widget_twitter', TEMPLATE_DOMAIN . ' | Twitter','widget_twitter',array('description' => __('Displays the last few tweets of your Twitter feed', TEMPLATE_DOMAIN)));
wp_register_widget_control('custom_widget_twitter', TEMPLATE_DOMAIN . ' | Twitter','widget_twitter_control', 200, 200);


//////////////////////////////////////////////////////////////////////////
//custom flikr widget
///////////////////////////////////////////////////////////////////////////
function custom_flickr($args) {
extract($args); // Make before_widget, etc available.
$settings = get_option("widget_custom_flickr");
$id = $settings['id'];
$number = $settings['number'];

echo $before_widget;
echo $before_title . __('My Flickr',TEMPLATE_DOMAIN) . $after_title; ?>
<style>
ul#flickr-widget li img {
  float: left;
  margin-right: 5px;
  margin-bottom: 5px;
  background-color: #fff;
  border: 1px solid #eee;
  padding: 5px;
}
</style>
<ul id="flickr-widget">
<li>
<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>
</li>
<li><a href="http://www.flickr.com/photos/<?php echo "$id"; ?>"><?php _e("view more showcase here",TEMPLATE_DOMAIN); ?></a></li>
</ul>
<?php echo $after_widget; ?>
<?php }

function custom_flickr_control() {
$settings = get_option("widget_custom_flickr");
// check if anything's been sent
if (isset($_POST['update_flickr'])) {
$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));
update_option("widget_custom_flickr",$settings);
}
echo '<p>
<label for="flickr_id">' . __('Flickr ID',TEMPLATE_DOMAIN) . ' (<a target="_blank" href="http://www.idgettr.com">idGettr</a>):
<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
echo '<p>
<label for="flickr_number">' . __('Number of photos:',TEMPLATE_DOMAIN) . '
<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';
}

wp_register_sidebar_widget('custom_flickr_twitter', TEMPLATE_DOMAIN . ' | Flickr','custom_flickr',array('description' => __('Displays the last few pictures of your Flickr feed', TEMPLATE_DOMAIN)));
wp_register_widget_control('custom_flickr_twitter', TEMPLATE_DOMAIN . ' | Flickr','custom_flickr_control', 200, 200);




//////////////////////////////////////////////////////////////////////////
//custom recent post from category widget
///////////////////////////////////////////////////////////////////////////
function widget_featured_cat( $args, $widget_args = 1 ) {
extract( $args, EXTR_SKIP );
if ( is_numeric($widget_args) )
$widget_args = array( 'number' => $widget_args );
$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
extract( $widget_args, EXTR_SKIP );
// Data should be stored as array:  array( number => data for that instance of the widget, ... )

$options = get_option('widget_featured_cat');
if ( !isset($options[$number]) )
return;

if($options[$number]['feattitle'] == '') {
$options[$number]['feattitle'] = 'Featured';
}

echo $before_widget;

echo $before_title . stripcslashes($options[$number]['feattitle']) . $after_title;

echo "<ul id=\"recent-postcat\">";
print "<style>"; ?>
ul#recent-postcat li img {
  margin-top: 0px !important;
}
<?php print "</style>";
$my_query = new WP_Query('cat='. $options[$number]['featcatname'] . '&' . 'showposts=' . $options[$number]['feattotal']);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID;
$the_post_ids = get_the_ID();
?>

<li>
<?php if($options[$number]['featthumb'] == 'yes') { ?>
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?>
<?php the_post_thumbnail(array(64,64), array('class' => 'alignleft')); ?><?php } } ?>
<?php } ?>
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><br />
<small><?php _e('by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('F jS Y') ?></small>
</li>
<?php endwhile; ?>
<?php
echo "</ul>";
echo $after_widget;
// end echo result
}

function widget_featured_cat_control( $widget_args = 1 ) {
	global $wp_registered_widgets;
	static $updated = false; // Whether or not we have already updated the data after a POST submit

	if ( is_numeric($widget_args) )
		$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );

	// Data should be stored as array:  array( number => data for that instance of the widget, ... )
	$options = get_option('widget_featured_cat');
	if ( !is_array($options) )
		$options = array();

	// We need to update the data
	if ( !$updated && !empty($_POST['sidebar']) ) {
		// Tells us what sidebar to put the data in
		$sidebar = (string) $_POST['sidebar'];

		$sidebars_widgets = wp_get_sidebars_widgets();
		if ( isset($sidebars_widgets[$sidebar]) )
			$this_sidebar =& $sidebars_widgets[$sidebar];
		else
			$this_sidebar = array();

		foreach ( $this_sidebar as $_widget_id ) {
			// Remove all widgets of this type from the sidebar.  We'll add the new data in a second.  This makes sure we don't get any duplicate data
			// since widget ids aren't necessarily persistent across multiple updates
		if ( 'widget_featured_cat' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
		$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
		if ( !in_array( "featcat-$widget_number", $_POST['widget-id'] ) ) // the widget has been removed. "many-$widget_number" is "{id_base}-{widget_number}
		unset($options[$widget_number]);
		}
		}

		foreach ( (array) $_POST['widget-featcat'] as $widget_number => $widget_featured_cat_instance ) {
		// compile data from $widget_many_instance
		if ( !isset($widget_featured_cat_instance['submit']) && isset($options[$widget_number]) ) // user clicked cancel
		continue;


		$feat_title = wp_specialchars($widget_featured_cat_instance['feattitle'] );
        $feat_name = wp_specialchars($widget_featured_cat_instance['featcatname'] );
        $feat_thumb = wp_specialchars($widget_featured_cat_instance['featthumb'] );
        $feat_total = wp_specialchars($widget_featured_cat_instance['feattotal'] );

		$options[$widget_number] = array(
        'feattitle' => $feat_title,
        'featcatname' => $feat_name,
        'featthumb' => $feat_thumb,
        'feattotal' => $feat_total

        ); // Even simple widgets should store stuff in array, rather than in scalar
		}

		update_option('widget_featured_cat', $options);

		$updated = true; // So that we don't go through this more than once
	}


// Here we echo out the form

  if ( -1 == $number ) { // We echo out a template for a form which can be converted to a specific form later via JS
  $feat_title = '';
  $feat_name = '';
  $feat_total = '5';
  $number = '%i%';
  } else {
  $feat_title = attribute_escape($options[$number]['feattitle']);
  $feat_name = attribute_escape($options[$number]['featcatname']);
  $feat_total = attribute_escape($options[$number]['feattotal']);
  $feat_thumb = attribute_escape($options[$number]['featthumb']);
  }

  // The form has inputs with names like widget-many[$number][something] so that all data for that instance of
  // the widget are stored in one $_POST variable: $_POST['widget-many'][$number]
?>

<p><?php _e("Title:",TEMPLATE_DOMAIN); ?> <em><?php _e("*required",TEMPLATE_DOMAIN); ?></em><br />
<input class="widefat" id="widget-featcat-feattitle-<?php echo $number; ?>" name="widget-featcat[<?php echo $number; ?>][feattitle]" type="text" value="<?php echo $feat_title; ?>" />
</p>

<p><?php _e("Category ID:",TEMPLATE_DOMAIN); ?><br /><em><?php _e("*separate by commas [,]",TEMPLATE_DOMAIN); ?></em><br />
<input type="text" class="widefat" id="widget-featcat-featcatname-<?php echo $number; ?>" name="widget-featcat[<?php echo $number; ?>][featcatname]" value="<?php echo $feat_name; ?>" />
</p>

<p>
<?php _e('Enable Thumbnails?:<br /><em>*post featured images</em>', TEMPLATE_DOMAIN); ?>
<select class="widefat" id="widget-featcat-featthumb-<?php echo $number; ?>" name="widget-featcat[<?php echo $number; ?>][featthumb]">
<option name="<?php echo $settings['featthumb']; ?>" value="yes"><?php _e('yes', TEMPLATE_DOMAIN); ?></option>
<option name="<?php echo $settings['featthumb']; ?>" value="no"><?php _e('no', TEMPLATE_DOMAIN); ?></option>
</select>
</p>

<p><?php _e("Total:",TEMPLATE_DOMAIN); ?><br />
<input class="widefat" id="widget-featcat-feattotal-<?php echo $number; ?>" name="widget-featcat[<?php echo $number; ?>][feattotal]" type="text" value="<?php echo $feat_total; ?>" />
</p>

<p>
<input type="hidden" id="widget-featcat-submit-<?php echo $number; ?>" name="widget-featcat[<?php echo $number; ?>][submit]" value="1" />
</p>
<?php
}

/**
 * Registers each instance of our widget on startup.
 */


function widget_featured_cat_register() {
	if ( !$options = get_option('widget_featured_cat') )
	$options = array();
	$widget_ops = array('classname' => 'widget_featured_cat', 'description' => __('Widget which allows multiple featured category', TEMPLATE_DOMAIN));
	$control_ops = array('width' => 200, 'height' => 200, 'id_base' => 'featcat');



	$name = __('Featured', TEMPLATE_DOMAIN);

	$registered = false;
	foreach ( array_keys($options) as $o ) {
	// Old widgets can have null values for some reason
	if ( !isset($options[$o]['feattitle']) )
    // we used 'something' above in our exampple.  Replace with with whatever your real data are.
	continue;

	// $id should look like {$id_base}-{$o}
	$id = "featcat-$o"; // Never never never translate an id
    $registered = true;
	wp_register_sidebar_widget( $id, $name, 'widget_featured_cat', $widget_ops, array( 'number' => $o ) );
	wp_register_widget_control( $id, $name, 'widget_featured_cat_control', $control_ops, array( 'number' => $o ) );
	}
	// If there are none, we register the widget's existance with a generic template
	if ( !$registered ) {
	wp_register_sidebar_widget( 'featcat-1', TEMPLATE_DOMAIN . ' | '.$name, 'widget_featured_cat', $widget_ops, array( 'number' => -1 ) );
	wp_register_widget_control( 'featcat-1', TEMPLATE_DOMAIN . ' | '.$name, 'widget_featured_cat_control', $control_ops, array( 'number' => -1 ) );
	}
    }
// This is important
add_action( 'widgets_init', 'widget_featured_cat_register' );







?>