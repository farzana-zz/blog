<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
require_once 'Abstract.php';

class Constructor_Main extends Constructor_Abstract
{
    /**
     * init all hooks
     */
    function init() 
    {
        add_action('wp_head', array($this, 'addThemeScripts'), 2);
        add_action('wp_head', array($this, 'addThemeStyles'),  3);
    }
    
    /**
     * add script by wp_head hook
     *
     * @return  void
     */
    function addThemeScripts() 
    {
        wp_enqueue_script('constructor-theme',     CONSTRUCTOR_DIRECTORY_URI.'/js/ready.js', array('jquery'));
    }
    
    /**
     * add styles by wp_head hook
     *
     * @global $blog_id
     * @return void
     */
    function addThemeStyles() 
    {
        // load style
        if (file_exists(CONSTRUCTOR_CUSTOM_CACHE .'/style.css')) {
            wp_enqueue_style('constructor-style',   CONSTRUCTOR_CUSTOM_CACHE_URI .'/style.css');
        } else {
            wp_enqueue_style('constructor-style', home_url().'/?theme-constructor=css');
        }

        // load constructor subtheme style
        if ($this->isDefaultTheme($this->getTheme())) {
            if (file_exists(CONSTRUCTOR_DEFAULT_THEMES.'/'.$this->getTheme().'/style.css')) {
                wp_enqueue_style( 'constructor-theme', CONSTRUCTOR_DEFAULT_THEMES_URI .'/'.$this->getTheme().'/style.css');
            }
        } else {
            if (file_exists(CONSTRUCTOR_CUSTOM_THEMES.'/'.$this->getTheme().'/style.css')) {
                wp_enqueue_style( 'constructor-theme', CONSTRUCTOR_CUSTOM_THEMES_URI .'/'.$this->getTheme().'/style.css');
            }
        }

    }
    /**
     * getOption
     *
     * @param  string $section
     * @param  string $key1
     * @param  string $key2
     * @return mixed
     */
    function getOption($section, $key1, $key2 = null)
    {
        if ($key2) {
            if (isset($this->_options[$section][$key1][$key2])) {
                return $this->_options[$section][$key1][$key2];
            } else {
                return false;
            }
        }

        if (isset($this->_options[$section][$key1])) {
            return $this->_options[$section][$key1];
        } else {
            return false;
        }
    }

    /**
     * get_constructor_slideshow
     *
     * @access  public
     * @param   boolean  $in In or Out of content container
     * @return  rettype  return
     */
    function getSlideshow($in = false)
    {
        if (!$this->_options['slideshow']['flag']) {
            return false;
        }
        if (is_page()   && !$this->_options['slideshow']['onpage'])    return false;
        if (is_single() && !$this->_options['slideshow']['onsingle'])  return false;
        if (is_archive()&& !$this->_options['slideshow']['onarchive']) return false;

        if ( $in && $this->_options['slideshow']['layout'] == 'over') return false;
        if (!$in && $this->_options['slideshow']['layout'] == 'in')   return false;

        $size = $this->getSlideshowSize();

        
        echo '<div id="slideshow" style="height:'.$size['height'].'px;width:'.$size['width'].'px">';

        // switch statement for true
        switch (true) {
            case (isset($this->_options['slideshow']['id']) && $this->_options['slideshow']['id']!='' && function_exists('nggShowSlideshow')):
                echo nggShowSlideshow((int)$this->_options['slideshow']['id'], $size['width'], $size['height']);
                break;
        
            default:
                $this->getDefaultSlideshow($size['width'], $size['height']);
                break;
        }        
        
        echo '</div>';
    }
    
    /**
     * get_constructor_default_slideshow
     *
     * generate code for embedded slideshow
     *
     * @param   integer $width
     * @param   integer $height
     * @return  string
     */
    function getDefaultSlideshow($width, $height) 
    {
        $options = $this->_options['slideshow']['advanced'];
        $options['slideshow'] = home_url().'/?theme-constructor=slideshow&w='.$width.'&h='.$height;
//        $options['thumbPath'] = CONSTRUCTOR_DIRECTORY_URI."/libs/timthumb.php?src=";
        $options = json_encode($options);
        
        echo '<div class="wp-sl"></div>';
        wp_enqueue_script('constructor-slideshow', CONSTRUCTOR_DIRECTORY_URI.'/js/jquery.wp-slideshow.js');
        wp_print_scripts('constructor-slideshow');
        echo "
        <script type='text/javascript'>
        /* <![CDATA[ */
            var wpSl = $options;
        /* ]]> */
        </script>";
    }
    
    /**
     * get_constructor_layout
     *
     * @param  string $where
     * @return string
     */
    function getLayout($where = 'index')
    {
        if (!isset($this->_options['layout'][$where])) {
            return include_once CONSTRUCTOR_DIRECTORY .'/layouts/default.php';
        }
        
        $layout = $this->_options['layout'][$where];
        
        if (is_file(CONSTRUCTOR_DIRECTORY .'/layouts/'.$layout.'.php')) {
            include_once CONSTRUCTOR_DIRECTORY .'/layouts/'.$layout.'.php';
        } else {
            include_once CONSTRUCTOR_DIRECTORY .'/layouts/default.php';
        }
        return true;
    }

    /**
     * get_constructor_class
     *
     * @param  string $rewrite
     * @return string
     */
    function getLayoutClass($rewrite = null)
    {
        if ($rewrite) {
            switch ($rewrite) {
                case 'left':
                case 'right':
                case 'two':
                case 'two-left':
                case 'two-right':
                case 'none':
                    $sidebar = $rewrite;
                    break;
                default:
                    $sidebar = 'right';
                    break;
            }
        } else {
            $sidebar = $this->_options['sidebar'];
        }
        return 'layout-'.$sidebar;
    }
    
    /**
     * get_constructor_menu
     *
     * @param  string $before
     * @param  string $after
     * @return string
     */
    function getMenu($before = '', $after = '')
    {
        if (!isset($this->_options['menu']['flag']) or !$this->_options['menu']['flag']) return false;

        echo '<div id="menu" class="opacity shadow">';
        echo '<ul class="menu">';
        
        // before items
        if (!empty($before)) {
            echo '<li class="before-item">';
            if (is_array($before)) {
                echo join('</li><li class="before-item">', $before);
            } else {
                echo $before;
            }
            echo '</li>';
        }
        
        // navigation menu - WP3
        if (function_exists('wp_nav_menu')
            && has_nav_menu('header')
        ) {
            $nav_menu = wp_nav_menu( array( 
                                            'sort_column' => 'menu_order',
                                            'container'   => '',
                                            'echo' => 0, 'depth' => 0,
                                            'theme_location' => 'header',
                                            'menu_class'  => '' ) );
            $nav_menu = preg_replace('/<ul(?:.*?)>(.*)<\/ul>/s', '\1', $nav_menu);
            
            echo $nav_menu;
        }
        // maybe "else" or not? 
        {
            
            // show link to homepage
            if ($this->_options['menu']['home']) {
                echo '<li id="home"><a href="'.home_url().'/" title="'.get_bloginfo('name').'">'.__('Home', 'constructor').'</a></li>';
            }
            
            // show pages drop-down menu (or as is)
            if ($this->_options['menu']['pages']['depth']) {
                $arg = array('title_li'=>'',
                             'exclude' => $this->_options['menu']['pages']['exclude'],
                             'depth'   => $this->_options['menu']['pages']['depth']
                             );
                wp_list_pages($arg);
            }
            
            // dynamic sidebar "header"
            if ( function_exists('dynamic_sidebar')) {
                dynamic_sidebar('header');
            }
            
            // show categories drop-down menu (or as is)
            if ($this->_options['menu']['categories']['depth']) {  
                $arg = array('title_li'=>'',
                     'exclude' => $this->_options['menu']['categories']['exclude'],
                     'depth'   => $this->_options['menu']['categories']['depth']
                     );
    
                if (isset($this->_options['menu']['categories']['group']) && $this->_options['menu']['categories']['group']) {
                    $cat_title = !empty($this->_options['menu']['categories']['title'])?$this->_options['menu']['categories']['title']:__('Categories','constructor');
                    echo '<li><a href="#" title="'.$cat_title.'">'.$cat_title.'</a><ul>';
                    wp_list_categories($arg);
                    echo '</ul></li>';
                } else {
                    wp_list_categories($arg);
                }
            }
            
            // show search bar
            if ($this->_options['menu']['search'])  {
                $value = esc_attr(apply_filters('the_search_query', get_search_query()));
                $class = "s";
                if (empty($value)) {
                    $value = __('Search...', 'constructor');
                    $class = "s default";
                }
                echo '<li id="menusearchform">
                          <form method="get" action="' . home_url() . '/" >
                          <input class="'.$class.'" type="text" value="' . $value . '" name="s" '
                               .'onfocus="javascript:if(this.value==\''.$value.'\') {this.value=\'\';this.className=\'s\'}"'
                               .'onblur="javascript:if(this.value==\'\') {this.value=\''.$value.'\';this.className=\'s default\'}"/>
                          
                          </form>
                      </li>';
            }
            
            // show link to RSS
            if ($this->_options['menu']['rss'])  {
                echo '<li id="rss"><a href="'.get_bloginfo('rss2_url').'"  title="'.__('RSS Feed', 'constructor').'">'. __('RSS Feed', 'constructor').'</a></li>';
            }
            
        }
        // after items
        if (!empty($after)) {            
            echo '<li class="after-item">';
            if (is_array($after)) {
                echo join('</li><li class="after-item">', $after);
            } else {
                echo $after;
            }
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    
    /**
     * get constructor content widget
     * 
     * @param integer $i post counter
     * @return 
     */
    function getContentWidget($i)
    {
        // widget is not enabled
        if (!$this->_options['content']['widget']['flag']) return false;
        
        // wrong position
        if ($this->_options['content']['widget']['after'] != $i) return false;
        echo "<div id=\"content-widget\" class=\"box\">\n";
        dynamic_sidebar('content');
        echo "</div>";
    }

    /**
     * get_constructor_author
     *
     * @param  string $before
     * @param  string $after
     * @return string
     */
    function getAuthor($before = '', $after = '')
    {
        if ($this->_options['content']['author'])
            echo $before; the_author_posts_link(); echo $after;
    }
    
    /**
     * get_constructor_author
     *
     * @param  string $before
     * @param  string $after
     * @return string
     */
    function getAvatarSize($size = 32)
    {
        if (isset($this->_options['comments']['avatar']['size'])) {
            return (int)$this->_options['comments']['avatar']['size'];
        } else {
            return $size;
        }
    }
    
    /**
     * get_constructor_sidebar
     *
     * @access  public
     * @return  string
     */
    function getSidebar()
    {
        // switch statement for $this->_options['sidebar']
        switch ($this->_options['sidebar']) {
            case 'left':
            case 'right':
                get_sidebar();
                break;
            case 'left':
            case 'right':
                get_sidebar();
                break;
            case 'two':
            case 'two-right':
            case 'two-left':
                get_sidebar();
                get_sidebar('extra');
                break;
            case 'none':
            default:
                // nothing
                break;
        }
    }
    
    /**
     * get_constructor_social
     *
     * @access  public
     * @return  string
     */
    function getSocial()
    {
        if (
            $this->_options['content']['social']['twitter'] or
            $this->_options['content']['social']['facebook'] or
            $this->_options['content']['social']['delicious'] or
            $this->_options['content']['social']['reddit'] or
            $this->_options['content']['social']['vkontakte'] or
            $this->_options['content']['social']['digg'] or
            $this->_options['content']['social']['mixx'] or
            $this->_options['content']['social']['stumbleupon'] or
            $this->_options['content']['social']['google'] or
            $this->_options['content']['social']['memori']
        ) {
            include_once CONSTRUCTOR_DIRECTORY . '/social.php';
        }

    }

    /**
     * get_constructor_navigation
     *
     * @access  public
     * @return  string
     */
    function getNavigation()
    {
        include_once CONSTRUCTOR_DIRECTORY . '/navigation.php';
    }
    
    /**
     * get_constructor_footer
     *
     * @access public
     * @return string
     */
    function getFooter()
    {
        if ($this->_options['footer']['text']) {
            echo stripslashes($this->_options['footer']['text']);
        } else {
            echo '&copy; '.date('Y') .' '. sprintf(__('%1$s is proudly powered by %2$s', 'constructor'), get_bloginfo('name'), '<a href="http://wordpress.org/">WordPress</a>') .
                 ' | <a href="http://anton.shevchuk.name/">'. __('Constructor Theme', 'constructor') .'</a><br />'.
                 sprintf(__('%1$s and %2$s.', 'constructor'), '<a href="' . get_bloginfo('rss2_url') . '">' . __('Entries (RSS)', 'constructor') . '</a>', '<a href="' . get_bloginfo('comments_rss2_url') . '">' . __('Comments (RSS)', 'constructor') . '</a>');
        }

        if (defined('WP_DEBUG') && WP_DEBUG) {
            printf(__('%d queries. %s seconds.', 'constructor'), get_num_queries(), timer_stop(0, 3));
        }
    }
    
    /**
     * get constructor category
     * 
     * @return string
     */
    function getCategory()
    {
        global $wp_query;

        $category = array();
        
        if (is_single()) {
            $cat = get_the_category($wp_query->post->ID);
            if ($cat) {
                $category = preg_split('/\//', rtrim(get_category_parents($cat[0], false, '/', true), '/'));
            }
        } elseif (is_page()) {
            $category = get_post_custom_values('category_name', $wp_query->post->ID);
        } elseif (is_category()) {
            $cat = get_category(get_query_var('cat'));
            if ($cat) {
                $category = preg_split('/\//', rtrim(get_category_parents($cat, false, '/', true), '/'));
            }
        }
        return $category;
    }
    
    /**
     * get constructor category classname
     * 
     * @return string
     */
    function getCategoryClass()
    {
        global $category_class;
        
        if ($category_class) {
            // nothing
        } elseif ($category = get_constructor_category()) {
            if (sizeof($category) > 0)
                $category_class =  'category-' .join(' category-', $category);
        } else {
            $category_class = '';
        }
        
        return $category_class;
    }
}
?>