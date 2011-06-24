<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
require_once 'Abstract.php';

class Constructor_Ajax extends Constructor_Abstract
{
    var $_themes = null;
    var $_custom = null;
    var $_errors = array();

    /**
     * Save "Current" theme as "..."
     * @return void
     */
    function save()
    {
        global $current_user, $template_uri;

        // get theme options
        $constructor = $this->_options;
        $admin       = $this->_admin;

        // get theme name
        $theme = isset($_REQUEST['theme'])?$_REQUEST['theme']:$admin['theme'];
        $theme_new = strtolower($theme);
        $theme_new = preg_replace('/\W/', '-', $theme_new);
        $theme_new = preg_replace('/[-]+/', '-', $theme_new);

        if ($this->isDefaultTheme($theme_new)) {
            $theme_new = $theme_new .'_'. date('His');
        }

        $path_new = CONSTRUCTOR_CUSTOM_THEMES .'/'. $theme_new;
        $path_old = CONSTRUCTOR_CUSTOM_THEMES .'/current';

        $theme_uri   = isset($_REQUEST['theme-uri'])?$_REQUEST['theme-uri']:'';
        $description = stripslashes(isset($_REQUEST['description'])?$_REQUEST['description']:'');
        $version     = isset($_REQUEST['version'])?$_REQUEST['version']:'0.0.1';
        $author      = isset($_REQUEST['author'])?$_REQUEST['author']:'';
        $author_uri  = isset($_REQUEST['author-uri'])?$_REQUEST['author-uri']:$current_user->user_nicename;

        // create new folder for new theme
        if (is_dir($path_new) &&
            !is_writable($path_new)) {
            $this->returnResponse(RESPONSE_KO,  sprintf(__('Directory "%s" is not writable.', 'constructor'), $path_new));
        } else {
            if (!wp_mkdir_p($path_new)) {
                $this->returnResponse(RESPONSE_KO, sprintf(__('Directory "%s" is not writable.', 'constructor'), CONSTRUCTOR_CUSTOM_THEMES .'/'));
            }
        }
        // copy all theme images to new? directory
        foreach ($constructor['images'] as $img => $data) {
            if (!empty($data['src'])) {
                $old_image = $path_old .'/'. $data['src'];
                $new_image = $path_new .'/'. $data['src'];

                if ($old_image != $new_image) {
                    // we are already check directory permissions
                    if (!@copy($old_image, $new_image)) {
                         $this->returnResponse(RESPONSE_KO, sprintf(__('Can\'t copy file "%s".', 'constructor'), $old_image));
                    }
                }
            }
        }

        // copy default screenshot (if not exist)
        if (!file_exists($path_new.'/screenshot.png') &&
             file_exists($path_old.'/screenshot.png')) {
            if (!@copy($path_old.'/screenshot.png', $path_new.'/screenshot.png')) {
                $this->returnResponse(RESPONSE_KO, sprintf(__('Can\'t copy file "%s".', 'constructor'), $path_old.'/screenshot.png'));
            }
        } elseif (!file_exists($path_new.'/screenshot.png')) {
            if (!@copy(CONSTRUCTOR_DIRECTORY.'/admin/images/screenshot.png', $path_new.'/screenshot.png')) {
                $this->returnResponse(RESPONSE_KO, sprintf(__('Can\'t copy file "%s".', 'constructor'), '/admin/images/screenshot.png'));
            }
        }

        require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
	    require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';

        $wp_filesystem_direct = new WP_Filesystem_Direct(null);

        // update style file
        if (file_exists($path_old.'/style.css')) {
            $style = $wp_filesystem_direct->get_contents($path_old.'/style.css');
            // match first comment /* ... */
            $style = preg_replace('|\/\*(.*)\*\/|Umis', '', $style, 1);
        } else {
            $style = '';
        }

        $style = "/*
Theme Name: $theme
Theme URI: $theme_uri
Description: $description
Version: $version
Author: $author
Author URI: $author_uri
*/".$style;

        unset($constructor['theme']);

        $config = "<?php \n".
                  "/* Save on ".date('Y-m-d H:i')." */ \n".
                  "return ".
                  var_export($constructor, true).
                  "\n ?>";

        // update files content
        // style CSS
        if (!$wp_filesystem_direct->put_contents(CONSTRUCTOR_CUSTOM_THEMES .'/'.$theme_new.'/style.css', $style, 0644)) {
            $this->returnResponse(RESPONSE_KO, sprintf(__('Can\'t save file "%s".', 'constructor'), CONSTRUCTOR_CUSTOM_THEMES .'/'.$theme_new.'/style.css'));
        }

        // theme config
        if (!$wp_filesystem_direct->put_contents(CONSTRUCTOR_CUSTOM_THEMES .'/'.$theme_new.'/config.php', $config, 0644)) {
            $this->returnResponse(RESPONSE_KO, sprintf(__('Can\'t save file "%s".', 'constructor'), CONSTRUCTOR_CUSTOM_THEMES .'/'.$theme_new.'/config.php'));
        }

        $this->returnResponse(RESPONSE_OK, __('Theme was saved, please reload page for view changes', 'constructor'));
    }

    /**
     * @return void
     */
    function donate()
    {
        // set donate flag to false
        $constructor_admin = get_option('constructor_admin');
        $constructor_admin['donate'] = false;
        update_option('constructor_admin', $constructor_admin);

        die();
    }

    /**
     * clean
     *
     * @return void
     */
    function clean()
    {
        delete_option('constructor');
        delete_option('constructor_admin');

        if ($this->_clean(CONSTRUCTOR_CUSTOM_CONTENT)) {
            $this->returnResponse(RESPONSE_OK, __('Theme was cleaned', 'constructor'));
        } else {
            $this->returnResponse(RESPONSE_KO, sprintf(__('System can&#39;t remove folder &quot;%s&quot;', 'constructor'), CONSTRUCTOR_CUSTOM_CONTENT));
        }
    }

    /**
     * _clean
     *
     * Used for remove folders in $wp_uploads['basepath'] .'/constructor'
     *
     * @return void
     */
    function _clean($folder)
    {
        if (!is_dir($folder)) {
            // not exists or not dir
            return true;
        }
        $files = scandir($folder);
        $files = array_diff($files, array('.','..'));
        if (!empty($files)) {
            foreach ($files as $file) {
                if (is_dir($folder .'/'. $file)) {
                    if (!$this->_clean($folder .'/'. $file)) {
                        return false;
                    }
                } elseif (!@unlink($folder .'/'. $file)) {
                    return false;
                }
            }
        }
        return @rmdir($folder);
    }

    /**
     * Return simple JSON response
     *
     * @param string $status RESPONSE_OK|RESPONSE_KO
     * @param string $message
     */
    function returnResponse($status = RESPONSE_OK, $message = '')
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $message = addslashes($message);
        echo '{"status":"'.$status.'","message":"'.$message.'"}';
        die();
    }
}
?>