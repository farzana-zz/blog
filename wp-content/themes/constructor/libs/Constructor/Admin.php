<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
require_once 'Abstract.php';

class Constructor_Admin extends Constructor_Abstract
{
    var $_custom = null;
    var $_modules = array();
    var $_donate  = '
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_donations" />
            <input type="hidden" name="business" value="oksanaromaniuk@gmail.com" />
            <input type="hidden" name="lc" value="US" />
            <input type="hidden" name="item_name" value="Wordpress Constructor Theme" />
            <input type="hidden" name="currency_code" value="USD" />
            <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest" />
            <input type="submit" name="Submit" class="button-primary" value="Donate" />
            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
        </form>';

    var $_errors = array();
    /**
     * @var WP_Filesystem_Direct
     */
    var $_wp_filesystem_direct = null;

    /**
     * init all hooks
     */
    function init($modules = array()) 
    {
        $this->_modules = $modules;

        if (!isset($_SESSION)) {
            session_start();
        }

	    require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
	    require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';

        $this->_wp_filesystem_direct = new WP_Filesystem_Direct(null);

        require_once CONSTRUCTOR_DIRECTORY .'/admin/ajax.php';

        // permission check
        if (!$this->permissions()) {
            echo '<div id="errors" class="error fade">'.
                 '<p><strong>'.
                 __('Please check permissions for next directories:', 'constructor').'</strong></p>'.
                 '<ul>'.
                    '<li>'.WP_CONTENT_DIR.'</li>'.
                    '<li>'.WP_CONTENT_DIR.'/constructor</li>'.
                    '<li>'.CONSTRUCTOR_CUSTOM_CONTENT.'</li>'.
                 '</ul>'.
                 '</div>';
        }

        // process request
        $this->request();

        add_action('admin_menu', array($this, 'addMenuItem'));
        
        add_action('switch_theme', array($this, 'disable'));
    }

    /**
     * Check directories and permissions
     * @return void
     */
    function permissions()
    {
        if (!wp_mkdir_p(CONSTRUCTOR_CUSTOM_CONTENT)) {
            return false;
        } else {
            if (!wp_mkdir_p(CONSTRUCTOR_CUSTOM_CACHE))  return false;
            if (!wp_mkdir_p(CONSTRUCTOR_CUSTOM_THEMES)) return false;
            if (!wp_mkdir_p(CONSTRUCTOR_CUSTOM_IMAGES)) return false;
            if (!wp_mkdir_p(CONSTRUCTOR_CUSTOM_THEMES .'/current')) return false;
            return true;
        }
    }

    /**
     * _updateCache
     *
     * Update cache of style file
     *
     * @return  rettype  return
     */
    function _updateCache()
    {
        $css = "/*generated " . date('Y-m-d H:i') . "*/\n\n";

        ob_start();
        include_once CONSTRUCTOR_DIRECTORY . '/css.php';
        $css .= ob_get_contents();
        ob_end_clean();

        $this->writeFile(CONSTRUCTOR_CUSTOM_CACHE . '/style.css', $css);
    }

    /**
     * _updateOptions
     *
     * update constructor options
     *
     * @param   array    $data
     * @return  array
     */
    function _updateOptions($data = array())
    {
        $this->_options = $this->_arrayMerge($this->_default, $data);

        update_option('constructor', $this->_options);

        // need update style cache
        $this->_updateCache();

    }

    /**
     * _updateAdmin
     *
     * update constructor admin options
     *
     * @param   array    $data
     * @return  array
     */
    function _updateAdmin($data = array())
    {
        $this->_admin = $this->_arrayMerge($this->_admin, $data);

        update_option('constructor_admin', $this->_admin);
    }
    
    /**
     * Process the request
     *
     * @return bool
     */
    function request()
    {
        if (isset($_GET['page']) && ($_GET['page'] == "functions.php" or $_GET['page'] == "admin/admin.php")){
            if (isset($_REQUEST['action']) && 'save' == $_REQUEST['action']) {
                check_admin_referer('constructor');
                if (isset($_REQUEST['constructor'])) {

                    $files = isset($_FILES['constructor'])?$_FILES['constructor']:array();
                    $data  = $_REQUEST['constructor'];

                    if (isset ($data['theme-reload']) && $data['theme-reload'] != 0) {
                        // loading theme and forgot all changes
                        $theme = $data['theme'];
                        $this->load($theme);
                    } else {

                        $theme = $this->_admin['theme'];

                        $this->_admin['theme'] = 'current';

                        if ($files && is_writable(CONSTRUCTOR_CUSTOM_THEMES .'/current/')) {

                            foreach ($files['name']['images'] as $name => $image) {
                                if (isset($image['src']) && is_uploaded_file($files['tmp_name']['images'][$name]['src'])) {

                                    if (!preg_match('/\.(jpe?g|png|gif|tiff)$/i', $image['src'])) {
                                        $this->_errors[] = sprintf(__('File "%s" is not a image (jpeg, png, gif, tiff)','constructor'), $image['src']);
                                        continue;
                                    }

                                    if (move_uploaded_file($files['tmp_name']['images'][$name]['src'], CONSTRUCTOR_CUSTOM_THEMES .'/current/' . $image['src'])) {
                                        $data['images'][$name]['src'] = $image['src'];
                                    } else {
                                        $this->_errors[] = sprintf(__('File "%s" can\'t be move to "/constructor/current/" folder','constructor'), $image['src']);
                                        continue;
                                    }
                                }
                            }
                        }
                        /**
                         * Shadow
                         */
                        if (isset($data['shadow'])) $data['shadow'] = true;

                        /**
                         * CSS changes
                         */
                        if (isset($data['css']) && is_writable(CONSTRUCTOR_CUSTOM_THEMES.'/current/style.css')) {
                            $this->writeFile(CONSTRUCTOR_CUSTOM_THEMES.'/current/style.css', stripslashes($data['css']));
                            unset($data['css']);
                        }

                        /**
                         * Slideshow
                         */
                        $data['slideshow']['id']        = isset($data['slideshow']['id'])?(int)$data['slideshow']['id']:null;
                        $data['slideshow']['showposts'] = isset($data['slideshow']['showposts'])?(int)$data['slideshow']['showposts']:10;

                        /**
                         * Flags changes
                         * @todo Need check follows code
                         */
        				/*
        			    $arr_false = array_keys(array_diff_key($this->_options, $data));
        			    $arr_false = array_fill_keys($arr_false, false);
        			    $data      = array_merge($this->_options, $arr_false);
        				*/

        				$fonts = require CONSTRUCTOR_DIRECTORY . '/admin/fonts.php';
                        $font_face = require CONSTRUCTOR_DIRECTORY . '/admin/font-face.php';
                        $fonts = array_merge($fonts, $font_face);

        				$data['fonts']['title']['family'] = $fonts[$data['fonts']['title']['family']];
        				$data['fonts']['description']['family'] = $fonts[$data['fonts']['description']['family']];
        				$data['fonts']['header']['family'] = $fonts[$data['fonts']['header']['family']];
        				$data['fonts']['content']['family'] = $fonts[$data['fonts']['content']['family']];

                        $data['menu']['flag']   = isset($data['menu']['flag'])?true:false;

                        if ($data['menu']['flag']) {
                            $data['menu']['home']   = isset($data['menu']['home'])?true:false;
                            $data['menu']['rss']    = isset($data['menu']['rss'])?true:false;
                            $data['menu']['search'] = isset($data['menu']['search'])?true:false;

                            $data['menu']['categories']['group'] = isset($data['menu']['categories']['group'])?true:false;
    
                            $data['menu']['pages']['exclude'] = join(',',array_map('intval', split(',', $data['menu']['pages']['exclude'])));
                            $data['menu']['categories']['exclude'] = join(',',array_map('intval', spliti(',', $data['menu']['categories']['exclude'])));
                        }

                        $data['title']['hidden'] = isset($data['title']['hidden'])?true:false;

        				$data['content']['date'] = isset($data['content']['date'])?true:false;
        				$data['content']['links']['author'] = isset($data['content']['links']['author'])?true:false;
        				$data['content']['links']['category'] = isset($data['content']['links']['category'])?true:false;
        				$data['content']['links']['tags'] = isset($data['content']['links']['tags'])?true:false;
        				$data['content']['links']['comments'] = isset($data['content']['links']['comments'])?true:false;

                        $data['design']['box']['flag']    = isset($data['design']['box']['flag'])?true:false;
                        $data['design']['shadow']['flag'] = isset($data['design']['shadow']['flag'])?true:false;

        				$data['images']['body']['fixed'] = isset($data['images']['body']['fixed'])?true:false;
                        $data['images']['wrap']['fixed'] = isset($data['images']['wrap']['fixed'])?true:false;

                        $data['slideshow']['flag']      = isset($data['slideshow']['flag'])?true:false;
                        $data['slideshow']['onpage']    = isset($data['slideshow']['onpage'])?true:false;
        				$data['slideshow']['onsingle']  = isset($data['slideshow']['onsingle'])?true:false;
        				$data['slideshow']['onarchive'] = isset($data['slideshow']['onarchive'])?true:false;

        				$data['slideshow']['advanced']['thumb'] = isset($data['slideshow']['advanced']['thumb'])?true:false;
        				$data['slideshow']['advanced']['play']  = isset($data['slideshow']['advanced']['play'])?true:false;

                        $this->_updateAdmin();
                        $this->_updateOptions($data);

                        $this->save($theme);
                    }

                }

                if (sizeof($this->_errors) > 0) {
                    $_SESSION['errors'] = serialize($this->_errors);
                    wp_redirect("themes.php?page={$_GET['page']}&saved=true&errors=true");
                } else {
                    $_SESSION['errors'] = '';
                    wp_redirect("themes.php?page={$_GET['page']}&saved=true");
                }
                die;
            }
        }
    }

    /**
     * @param  $theme
     * @return void
     */
    function load($theme)
    {
        if ($this->isDefaultTheme($theme)) {
            $data = require CONSTRUCTOR_DEFAULT_THEMES .'/'.$theme.'/config.php';
        } else {
            $data = require CONSTRUCTOR_CUSTOM_THEMES .'/'. $theme .'/config.php';
        }

        $this->_admin['theme'] = $theme;

        $this->_updateAdmin();
        $this->_updateOptions($data);
    }

    /**
     * Save theme as current
     * @param  string $theme old theme
     * @return void
     */
    function save($theme)
    {
        global $current_user, $template_uri;
        // setup permissions for save
        $permission = 0777;

        // get theme options
        $constructor = $this->_options;
        $admin       = $this->_admin;

        // get theme name
        $path = CONSTRUCTOR_CUSTOM_THEMES .'/current';

        if ($this->isDefaultTheme($theme)) {
            $path_old = CONSTRUCTOR_DEFAULT_THEMES .'/'. $theme;
        } else {
            $path_old = CONSTRUCTOR_CUSTOM_THEMES .'/'. $theme;
        }

        $theme_uri   = home_url();
        $description = get_bloginfo('description');
        $version     = '0.0.1';
        $author      = $current_user->user_nicename;
        $author_uri  = '';

        // create new folder for new theme
        if (is_dir($path) &&
            !is_writable($path)) {
            $this->_errors[] = sprintf(__('Directory "%s" is not writable.', 'constructor'), $path);
            return false;
        } else {
            if (!wp_mkdir_p($path)) {
                $this->_errors[] = sprintf(__('Directory "%s" is not writable.', 'constructor'), CONSTRUCTOR_CUSTOM_THEMES .'/');
                return false;
            }
        }

        // copy all theme images to new? directory
        foreach ($constructor['images'] as $img => $data) {
            if (!empty($data['src'])) {
                $old_image = $path_old .'/'. $data['src'];
                $new_image = $path .'/'. $data['src'];

                if ($old_image != $new_image && file_exists($old_image)) {
                    // we are already check directory permissions
                    if (!@copy($old_image, $new_image)) {
                         $this->_errors[] = sprintf(__('Can\'t copy file "%s" to "%s".', 'constructor'), $old_image, $new_image);
                    }
                }
            }
        }
        // copy default screenshot (if not exist)
        if (!file_exists($path.'/screenshot.png')) {
            if (!@copy(CONSTRUCTOR_DIRECTORY.'/admin/images/screenshot.png', $path.'/screenshot.png')) {

                $this->_errors[] = sprintf(__('Can\'t copy file "%s".', 'constructor'), '/admin/images/screenshot.png');
                return false;
            }
        }

        // update style file
        if (file_exists($path.'/style.css')) {
            $style = $this->readFile($path.'/style.css');
            // match first comment /* ... */
            $style = preg_replace('|\/\*(.*)\*\/|Umis', '', $style, 1);
        } else {
            $style = '';
        }

        $style = "/*
Theme Name: Current
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
        if (!$this->writeFile($path.'/style.css', $style)) {
            $this->_errors[] = sprintf(__('Can\'t save file "%s".', 'constructor'), $path.'/style.css');
            return false;
        }

        if (!$this->writeFile($path.'/config.php', $config)) {
            $this->_errors[] =  sprintf(__('Can\'t save file "%s".', 'constructor'), $path.'/config.php');
            return false;
        }
        return true;
    }

    /**
     * readFile
     *
     * @param  string file
     * @return string
     */
    function readFile($file)
    {
        return $this->_wp_filesystem_direct->get_contents($file);
    }
    /**
     * writeFile
     *
     * @param  string $file
     * @param  string $content
     * @return string
     */
    function writeFile($file, $content)
    {
        return $this->_wp_filesystem_direct->put_contents($file, $content, 0644);
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
     * unload callback
     *
     * @param string $theme
     */
    function disable($theme)
    {
        // disable autoload
    }
    
    /**
     * remove callback
     */
    function remove()
    {
        // remove theme options
        delete_option('constructor');
        delete_option('constructor_admin');
    }


    /**
     * add scripts by wp_head hook
     *
     * @return  void
     */
    function addThemeScripts() 
    {
        global $wp_version;
        wp_enqueue_script('thickbox');

        wp_enqueue_script('constructor-layout',      CONSTRUCTOR_DIRECTORY_URI .'/admin/js/jquery.layout.js',  array('jquery'));
        wp_enqueue_script('constructor-custom',      CONSTRUCTOR_DIRECTORY_URI .'/admin/js/jquery-ui-custom.js', array('jquery'));
//        wp_enqueue_script('constructor-accordion',   CONSTRUCTOR_DIRECTORY_URI .'/admin/js/jquery.ui.accordion.js', array('jquery','jquery-ui-core'));
//        wp_enqueue_script('constructor-widget',      CONSTRUCTOR_DIRECTORY_URI .'/admin/js/jquery.ui.widget.js', array('jquery','jquery-ui-core'));
//        wp_enqueue_script('constructor-mouse',       CONSTRUCTOR_DIRECTORY_URI .'/admin/js/jquery.ui.mouse.js', array('jquery','jquery-ui-core'));
//        wp_enqueue_script('constructor-slider',      CONSTRUCTOR_DIRECTORY_URI .'/admin/js/jquery.ui.slider.js', array('jquery','jquery-ui-core'));
        wp_enqueue_script('constructor-colorpicker', CONSTRUCTOR_DIRECTORY_URI .'/admin/js/colorpicker.js',  array('jquery'));
        wp_enqueue_script('constructor-settings',    CONSTRUCTOR_DIRECTORY_URI .'/admin/js/settings.js', array('jquery'));
        wp_enqueue_script('constructor-messages',    CONSTRUCTOR_DIRECTORY_URI .'/admin/js/messages.js',  array('jquery'));
        wp_print_scripts();
    }
    
    /**
     * add styles by wp_head hook
     *
     * @return  void
     */
    function addThemeStyles() 
    {
        // basic style
        //add_editor_style('style.css');

        // save current changes to session
        $_SESSION['constructor_width'] = $this->_options['layout']['width'];
        $_SESSION['constructor_color'] = $this->_options['color'];
        $_SESSION['constructor_fonts'] = $this->_options['fonts'];

        // load generated style
        add_editor_style('css-editor.php?theme='.$this->_admin['theme']);


        wp_enqueue_style('thickbox');
        wp_enqueue_style('constructor-admin',       CONSTRUCTOR_DIRECTORY_URI .'/admin/css/admin.css');
        wp_enqueue_style('constructor-colorpicker', CONSTRUCTOR_DIRECTORY_URI .'/admin/css/colorpicker.css');
        wp_enqueue_style('jquery-ui',               CONSTRUCTOR_DIRECTORY_URI .'/admin/css/jquery-ui.css');
        wp_print_styles();
    }

    /**
     * Add configuration page
     */
    function addMenuItem()
    {
        // super admin
        $page = add_theme_page(
            __('Customize Theme', 'constructor'),
            __('Customize', 'constructor'),
            'edit_themes',
            'functions.php',
            array($this, 'getPage')
        )
        or
        // admin for MU blog
        add_theme_page(
            __('Customize Theme', 'constructor'),
            __('Customize', 'constructor'),
            'edit_theme_options',
            'admin/admin.php',
            array($this, 'getPage')
        );
        
        add_action('admin_head-'. $page, array($this, 'addThemeScripts'), 2);
        add_action('admin_head-'. $page, array($this, 'addThemeStyles'),  3);
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontFamily($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;

        $fonts = require CONSTRUCTOR_DIRECTORY . '/admin/fonts.php';
        echo "<select class='constructor-font-family' name='constructor[fonts][".$key."][family]'>";
        echo "<optgroup label='".__('Standart Fonts', 'constructor')."'>";
        foreach ($fonts as $k => $font) :
        ?>
            <option value="<?php echo $k ?>" <?php if ($font == $constructor['fonts'][$key]['family']) echo 'selected="selected"'; ?>><?php echo $font ?></option>
        <?php
        endforeach;
        $k++; // start from this is font
        $font_face = require CONSTRUCTOR_DIRECTORY . '/admin/font-face.php';
        echo "<optgroup label='".__('Google Fonts', 'constructor')."'>";
        foreach ($font_face as $i => $font) :
            if ($font == $constructor['fonts'][$key]['family']) :
                $loadFont = $font;
            ?>
                <option class="webfonts" value="<?php echo $k+$i ?>" selected="selected"><?php echo $font ?></option>
            <?php
            else:
            ?>
                <option class="webfonts" value="<?php echo $k+$i ?>"><?php echo $font ?></option>
            <?php
            endif;
        endforeach;
        echo "</optgroup>";
        echo "</select>";
        if (isset($loadFont)) {
            ?>
                <script type="text/javascript">loadFont('<?php echo $loadFont ?>');</script>
            <?php
        }
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontSize($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;
        $size = (int)$constructor['fonts'][$key]['size'];
        
        
        $font_sizes = array(8,9,10,11,12,14,16,18,20,
                            22,24,26,28,32,36,40,44,48,
                            52,56,60,72,76,80,84,88,92);
         
        if ($size && !in_array($size, $font_sizes)) {
            array_unshift($font_sizes, $size);
        }
        
        echo "<select class='constructor-font-size' name='constructor[fonts][".$key."][size]'>";
        foreach ($font_sizes as $font_size) :
        ?>
            <option value='<?php echo $font_size ?>' <?php if ($size == $font_size) echo 'selected="selected"'; ?>><?php echo $font_size ?>px</option>
        <?php
        endforeach;        
        echo "</select>";
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontTransform($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;
        /*
        none	No capitalization. The text renders as it is. This is default
        capitalize	Transforms the first character of each word to uppercase
        uppercase	Transforms all characters to uppercase
        lowercase	Transforms all characters to lowercase
        */
        $options = array('none',
                         'capitalize',
                         'uppercase',
                         'lowercase',
                          );
       
        echo "<select class='constructor-font-transform' name='constructor[fonts][".$key."][transform]'>";
        foreach ($options as $option) :
        ?>
            <option value='<?php echo $option ?>' <?php if ($constructor['fonts'][$key]['transform'] == $option) echo 'selected="selected"'; ?>><?php echo $option ?></option>
        <?php
        endforeach;        
        echo "</select>";
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontWeight($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;
        /*
        Defines from thin to thick characters. 400 is the same as normal, and 700 is the same as bold
        */
        $options = array(100,200,300,400,500,600,700,800,900);
       
        echo "<select class='constructor-font-weight' name='constructor[fonts][".$key."][weight]'>";
        foreach ($options as $option) :
        ?>
            <option value='<?php echo $option ?>' <?php if ($constructor['fonts'][$key]['weight'] == $option) echo 'selected="selected"'; ?>><?php echo $option ?></option>
        <?php
        endforeach;        
        echo "</select>";
    }
    
    /**
     * getFonts
     *
     * @return  rettype  return
     */
    function getFontColor($key) 
    {
        /*@var $constructor array*/
        $constructor = $this->_options;
        $color = $constructor['fonts'][$key]['color'];
        ?>
        <script type="text/javascript">
        /* <![CDATA[ */
        (function($){
            $(document).ready(function(){            
                initColorPicker('fonts-<?php echo $key?>-color');        
            });
        })(jQuery);
        /* ]]> */
        </script>
        <input type="hidden" id="constructor-fonts-<?php echo $key?>-color" name="constructor[fonts][<?php echo $key?>][color]" value="<?php echo $color?>"/>
        <div id="fonts-<?php echo $key?>-color" class="color"><div style="background-color: <?php echo $color ?>"></div></div>
        <?php
    }
    
    /**
     * getPage
     *
     * render admin page
     *
     * @return  string
     */
    function getPage() 
    {
        global $constructor, $admin, $theme_path, $theme_uri;
        /*@var $constructor array*/
        $constructor = $this->_options;
        
        /*@var $admin array*/
        $admin = $this->_admin;

        /*@var $theme_path string */
        $theme_path = $this->getThemePath();

        /*@var $theme_uri string */
        $theme_uri = $this->getThemeUri();
        ?>
        <div class='wrap'>
           <h2><?php _e('Customize Theme', 'constructor'); ?></h2>
           <?php
               if ( $this->_admin['donate'] ) {
                   echo '<div id="message" class="updated fade donate"><div class="donate-button">'.$this->_donate.'</div><p>'.__('If you like this theme and find it useful, help keep this theme free and actively developed by clicking the donate button (via PayPal or CC)').'</p><a href="'.get_bloginfo('wpurl').'/wp-admin/admin-ajax.php" class="message-close ui-icon ui-icon-close" title=":("><span/></a><br class="clear"/></div>';
               }
               
               if ( isset( $_REQUEST['saved'] ) ) {
                   echo '<div id="message" class="updated fade"><p><strong>'.__('Options saved.').'</strong></p></div>';
               }
               
               if ( isset( $_REQUEST['errors'] ) ) {
                   if (isset($_SESSION['errors']) && $_SESSION['errors'] != '') {
                       $errors = unserialize($_SESSION['errors']);
                       $_SESSION['errors'] = '';
                   }
                   echo '<div id="errors" class="error fade"><p><strong>'.
                            __('Some images can\'t be upload. Please check permissions').'<br/>'.
                            join('<br/>',$errors).
                        '</strong></p></div>';
               }
               ?>
           <div class="constructor">
                <form method="post" id="constructor-form" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
                    <?php wp_nonce_field('constructor'); ?>
                    <input type="hidden" name="action" value="save" />
                    <div id="tabs">
                        <ul>
                            <?php foreach ($this->_modules as $module => $file) : ?>
                            <li><a href="#constr-<?php echo $file ?>" name="<?php echo $file ?>"><?php echo $module ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php foreach ($this->_modules as $module => $file) : ?>
                        <div id="constr-<?php echo $file ?>">
                            <?php require_once CONSTRUCTOR_DIRECTORY ."/admin/settings/$file.php" ?>
                        </div>
                        <?php endforeach; ?>
    
                    </div>
                    <p class="submit">
                        <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes', 'constructor')?>" />
                    </p>
                </form>
           </div>
        </div>
        <?php
    }
}
?>