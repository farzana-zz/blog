<?php __('Content', 'constructor'); // requeried for correct translation ?>

<table class="form-table">
<tr>
    <th rowspan="5" scope="row" valign="top"><?php _e('Meta information', 'constructor'); ?></th>
    <td>
        <input type="checkbox" id="constructor-content-date" name="constructor[content][date]" value="1" <?php if (isset($constructor['content']['date']) && $constructor['content']['date'] == 1) echo 'checked="checked"'; ?> />
        <label for="constructor-content-date"><?php _e('Show post date', 'constructor'); ?></label>
    </td>
    <td rowspan="5" valign="top" class="updated quick-links" width="320px">
    <h3><?php _e('Help', 'constructor'); ?></h3>
        <?php _e('Use this options to control what meta information is shown', 'constructor'); ?>

    </td>
</tr>
<tr>
    <td>
        <input type="checkbox" id="constructor-content-links-author" name="constructor[content][links][author]" value="1" <?php if (isset($constructor['content']['links']['author']) && $constructor['content']['links']['author'] == 1) echo 'checked="checked"'; ?> />
        <label for="constructor-content-links-author"><?php _e('Link to author page', 'constructor'); ?></label>
    </td>
</tr>
<tr>
    <td>
        <input type="checkbox" id="constructor-content-links-category" name="constructor[content][links][category]" value="1" <?php if (isset($constructor['content']['links']['category']) && $constructor['content']['links']['category'] == 1) echo 'checked="checked"'; ?> />
        <label for="constructor-content-links-category"><?php _e('List of categories', 'constructor'); ?></label>
    </td>
</tr>
<tr>
    <td>
        <input type="checkbox" id="constructor-content-links-tags" name="constructor[content][links][tags]" value="1" <?php if (isset($constructor['content']['links']['tags']) && $constructor['content']['links']['tags'] == 1) echo 'checked="checked"'; ?> />
        <label for="constructor-content-links-tags"><?php _e('List of tags', 'constructor'); ?></label>
    </td>
</tr>
<tr>
    <td>
        <input type="checkbox" id="constructor-content-links-comments" name="constructor[content][links][comments]" value="1" <?php if (isset($constructor['content']['links']['comments']) && $constructor['content']['links']['comments'] == 1) echo 'checked="checked"'; ?> />
        <label for="constructor-content-links-comments"><?php _e('Link to comments', 'constructor'); ?></label>
    </td>
</tr>

<tr>
    <th scope="row" valign="top">
        <?php _e('Sharing Icons', 'constructor'); ?><br/>
    </th>
    <td name="constructor-content-social" class="checkbox social">
        <?php
            function constructor_content_social($name, $key) {
                global $constructor;
                ?>
                    <input type="hidden" id="constructor-content-social-<?php echo $key; ?>" name="constructor[content][social][<?php echo $key; ?>]" value="<?php echo $constructor['content']['social'][$key] ?>"/>
                    <a href="#" name="<?php echo $key; ?>" class="<?php echo $key; ?> <?php echo ($constructor['content']['social'][$key]?'checked':'') ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a>

                <?php
            }
        ?>
        <?php constructor_content_social(__('Twitter', 'constructor'), 'twitter'); ?>
        <?php constructor_content_social(__('Facebook', 'constructor'), 'facebook'); ?>
        <?php constructor_content_social(__('Del.icio.us', 'constructor'), 'delicious'); ?>
        <?php constructor_content_social(__('Reddit', 'constructor'), 'reddit'); ?>
        <?php constructor_content_social(__('Google', 'constructor'), 'google'); ?>
        <?php constructor_content_social(__('Digg', 'constructor'), 'digg'); ?>
        <?php constructor_content_social(__('Mixx', 'constructor'), 'mixx'); ?>
        <?php constructor_content_social(__('StumbleUpon', 'constructor'), 'stumbleupon'); ?>
        <?php constructor_content_social(__('VKontakte', 'constructor'), 'vkontakte'); ?>
        <?php constructor_content_social(__('Memori', 'constructor'), 'memori'); ?>

    </td>
    <td valign="top" class="updated quick-links">
    <?php _e('Select which service you would like to use for sharing', 'constructor')?>
    </td>
</tr>

<tr>
    <th scope="row" valign="top">
        <?php _e('Content widgets place', 'constructor'); ?><br/>
        <small><em><?php _e('can configured with <a href="widgets.php">widgets</a>, use "After N Post" sidebar', 'constructor'); ?></em></small>
    </th>
    <td>
		<fieldset>
			<legend>
				<input type="checkbox" id="constructor-content-widget-flag" name="constructor[content][widget][flag]" value="1" <?php if ($constructor['content']['widget']['flag']) echo 'checked="checked"'; ?> />
                <label for="constructor-content-widget-flag"><?php _e('Show widgets place', 'constructor'); ?></label>
			</legend>
			<dl>
				<dt><?php _e('Position', 'constructor'); ?></dt>
				<dd><select name="constructor[content][widget][after]" id="constructor-content-widget-after">
		                <option value="1" <?php if ($constructor['content']['widget']['after'] == 1) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),1); ?></option>
		                <option value="2" <?php if ($constructor['content']['widget']['after'] == 2) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),2); ?></option>
		                <option value="3" <?php if ($constructor['content']['widget']['after'] == 3) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),3); ?></option>
		                <option value="4" <?php if ($constructor['content']['widget']['after'] == 4) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),4); ?></option>
		                <option value="5" <?php if ($constructor['content']['widget']['after'] == 5) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),5); ?></option>
		                <option value="6" <?php if ($constructor['content']['widget']['after'] == 6) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),6); ?></option>
		                <option value="7" <?php if ($constructor['content']['widget']['after'] == 7) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),7); ?></option>
		                <option value="8" <?php if ($constructor['content']['widget']['after'] == 8) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),8); ?></option>
		                <option value="9" <?php if ($constructor['content']['widget']['after'] == 9) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),9); ?></option>
		                <option value="10" <?php if ($constructor['content']['widget']['after'] == 10) echo 'selected="selected"'; ?>><?php printf(__('after %d post', 'constructor'),10); ?></option>
		                       
		            </select></dd>			
			</dl>
		</fieldset>
    </td>
    <td valign="top" class="updated quick-links">
    <?php _e('You can use short code [widgets] in your post, and can configured with <a href="widgets.php">widgets</a> (use "In Posts" sidebar)', 'constructor')?>
    <br />
    <br />
    <?php _e('Available <a href="http://code.google.com/p/wp-constructor/wiki/ConstructorShortcodes" title="Constructor Short Codes">short codes</a>:', 'constructor')?>
    <ul>
        <li>[attachments <em>type=image</em> <em>preview=1</em>]</li>
        <li>[subpages]</li>
        <li>[widgets]</li>
    </ul>

    </td>
</tr>
</table>