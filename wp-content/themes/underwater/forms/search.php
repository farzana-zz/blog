<?php

// This file is part of the Carrington Text Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2009 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

if (get_option('permalink_structure') != '') {
	$onsubmit = "location.href=this.action+'search/'+encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;";
}
else {
	$onsubmit = '';
}

?>

<form method="get"  action="<?php echo trailingslashit(get_bloginfo('url')); ?>" onsubmit="<?php echo $onsubmit; ?>">
	<input type="text" id="s" name="s" value="search" onfocus="if(this.value == 'search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'search';}"size="15" />

</form>