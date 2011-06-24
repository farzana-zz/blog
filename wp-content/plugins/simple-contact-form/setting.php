<div class="wrap">
  <h2><?php echo wp_specialchars( 'Simple contact form' ); ?></h2>
  <?php
global $wpdb, $wp_version;


$gCF_title = get_option('gCF_title');
$gCF_On_Homepage = get_option('gCF_On_Homepage');
$gCF_On_Posts = get_option('gCF_On_Posts');
$gCF_On_Pages = get_option('gCF_On_Pages');
$gCF_On_Search = get_option('gCF_On_Search');
$gCF_On_Archives = get_option('gCF_On_Archives');
$gCF_On_SendEmail = get_option('gCF_On_SendEmail');
$gCF_On_MyEmail = get_option('gCF_On_MyEmail');
$gCF_On_Subject = get_option('gCF_On_Subject');

if ($_POST['gCF_submit']) 
{
	$gCF_title = stripslashes($_POST['gCF_title']);
	$gCF_On_Homepage = stripslashes($_POST['gCF_On_Homepage']);
	$gCF_On_Posts = stripslashes($_POST['gCF_On_Posts']);
	$gCF_On_Pages = stripslashes($_POST['gCF_On_Pages']);
	$gCF_On_Search = stripslashes($_POST['gCF_On_Search']);
	$gCF_On_Archives = stripslashes($_POST['gCF_On_Archives']);
	$gCF_On_SendEmail = stripslashes($_POST['gCF_On_SendEmail']);
	$gCF_On_MyEmail = stripslashes($_POST['gCF_On_MyEmail']);
	$gCF_On_Subject = stripslashes($_POST['gCF_On_Subject']);
	
	update_option('gCF_title', $gCF_title );
	update_option('gCF_On_Homepage', $gCF_On_Homepage );
	update_option('gCF_On_Posts', $gCF_On_Posts );
	update_option('gCF_On_Pages', $gCF_On_Pages );
	update_option('gCF_On_Search', $gCF_On_Search );
	update_option('gCF_On_Archives', $gCF_On_Archives );
	update_option('gCF_On_SendEmail', $gCF_On_SendEmail );
	update_option('gCF_On_MyEmail', $gCF_On_MyEmail );
	update_option('gCF_On_Subject', $gCF_On_Subject );
}

echo '<table width="100%" border="0" cellspacing="5" cellpadding="0">';
echo '<tr>';
echo '<td align="left">';
echo '<form name="form_gCF" method="post" action="">';
echo '<p>Title:<br><input  style="width: 350px;" type="text" value="';
echo $gCF_title . '" name="gCF_title" id="gCF_title" /></p>';
echo '<p>Display Option:(YES/NO) </p>';
echo '<p>On Homepage:&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Homepage . '" name="gCF_On_Homepage" id="gCF_On_Homepage" />';
echo '&nbsp;On Posts:&nbsp;&nbsp;&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Posts . '" name="gCF_On_Posts" id="gCF_On_Posts" /></p>';
echo '<p>On Pages:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Pages . '" name="gCF_On_Pages" id="gCF_On_Pages" />';
echo '&nbsp;On Search:&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Search . '" name="gCF_On_Search" id="gCF_On_Search" /></p>';
echo '<p>On Archives:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  style="width: 100px;" type="text" value="';
echo $gCF_On_Archives . '" name="gCF_On_Archives" id="gCF_On_Archives" /></p>';
echo '<br><p>Send Email (i.e receive email):<br><input  style="width: 300px;" type="text" value="';
echo $gCF_On_SendEmail . '" name="gCF_On_SendEmail" id="gCF_On_SendEmail" maxlength="3" /> ( YES/NO )</p>';
echo '<p>Enter Email Address:<br><input  style="width: 300px;" type="text" value="';
echo $gCF_On_MyEmail . '" name="gCF_On_MyEmail" id="gCF_On_MyEmail" /> ( Enter your email id to receive emails )</p>';
echo '<p>Enter Email Subject:<br><input  style="width: 300px;" type="text" value="';
echo $gCF_On_Subject . '" name="gCF_On_Subject" id="gCF_On_Subject" /> ( Email subject email subject )</p>';
echo '<input type="submit" id="gCF_submit" name="gCF_submit" lang="publish" class="button-primary" value="Update Setting" value="1" />';
echo '</form>';
echo '</td>';
echo '<td align="center">';

echo '</td>';
echo '</tr>';
echo '</table>';

?>
  <br />
  <h2>Plugin management</h2>
  <table width="100%" style="">
  <tr>
    <td align="left">
    <input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=simple-contact-form/simple-contact-form.php'" value="Go to - View contact details" type="button" />
      <input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=simple-contact-form/setting.php'" value="Go to - Setting Page" type="button" /></td>
  </tr>
</table>
  <h2>Paste the below code to your desired template location.</h2>
  <div style="padding-top:7px;padding-bottom:7px;"> <code style="padding:7px;"> &lt;?php if (function_exists (gCF)) gCF(); ?&gt; </code></div>
   <h2>Plugin shaor code for pages/post</h2>
   <div><a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/simple-contact-form/'>Check this</a> link for plugin updates.</div>
	<h2><?php echo wp_specialchars( 'About plugin!' ); ?></h2>
	Plug-in created by <a target="_blank" href='http://www.gopiplus.com/work/'>Gopi</a>.<br>
	<a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/simple-contact-form/'>Click here</a> to post suggestion or comments or feedback.<br>
	<a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/simple-contact-form/'>Click here</a> to see live demo.<br>
	<a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/simple-contact-form/'>Click here</a> to see more info.<br>
	<a target="_blank" href='http://www.gopiplus.com/work/plugin-list/'>Click here</a> to see my other plugins.<br>
  <br>
</div>
