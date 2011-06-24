
<?php

if (function_exists('wp_list_comments')) :
include (TEMPLATEPATH . '/comments-new.php');
else :
include (TEMPLATEPATH . '/comments-old.php');
endif;

?>