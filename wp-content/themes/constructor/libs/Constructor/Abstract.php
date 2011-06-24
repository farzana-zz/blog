<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
class Constructor_Abstract
{
    /**
     * Default options by key "constructor"
     *
     * @var array
     */
    var $_default = array(
        'sidebar' => 'right', // sidebar position
        'layout' => array(
            // layouts styles
            'header' => 140, // header height
            'width' => 1024, // container width
            'sidebar' => 240, // sidebar width
            'extra' => 240, // extrabar  width
            // @TODO: it's really hard for current theme structure
            'fluid' => array(
                'flag' => false,
                'width' => 80, // in %
                'min-width' => 960, // in px
                'max-width' => 1280, // in px
            ),
            'home' => 'default', // deprecated
            'index' => 'default',
            'page' => 'page',
            'single' => 'single',
            'archive' => 'default', // deprecated
            'date' => 'default',
            'category' => 'default',
            'tag' => 'default',
            'search' => 'default',
        ),
        'title' => array(
            // title
            'pos' => 'left top', // - position
            'hidden' => false // - hidden title text
        ),
        'content' => array(
            'date' => 1, // show date
            // content
            'links' => array(
                'author' => 0, // - link to author page
                'category' => 1, // - links to categories
                'tags' => 0, // - links to tags
                'comments' => 1 // - link to comments
             ),
            'widget' => array(
                'flag' => false, // - enable content widget place
                'after' => 1 // - show after N post
            ),
            'social' => array(
                'twitter' => 1,
                'facebook' => 1,
                'delicious' => 1,
                'reddit' => 1,
                'vkontakte' => 0,
                'digg' => 0,
                'mixx' => 0,
                'stumbleupon' => 0,
                'google' => 0,
                'memori' => 0,
            )
        ),
        'comments' => array(
            'avatar' => array(
                'size' => 64, // - avatar size (see comments)
                'pos' => 'right' // - avatarposition
            ),
        ),
        'footer' => array(
            // footer text
            'text' => null,
        ),
        'fonts' => array(
            // fonts
            'title' => array(
                'family' => 'Arial,Helvetica,sans-serif',
                'size' => 48,
                'weight' => 800,
                'color' => '#333',
                'transform' => 'uppercase',

            ),
            'description' => array(
                'family' => 'Arial,Helvetica,sans-serif',
                'size' => 14,
                'weight' => 600,
                'color' => '#777',
                'transform' => 'uppercase'

            ),
            'header' => array(
                'family' => 'Arial,Helvetica,sans-serif'
            ),
            'content' => array(
                'family' => 'Arial,Helvetica,sans-serif'
            ),
        ),
        'menu' => array(
            // menu with links
            'pos' => 'left top', // - position (left|right)+(top|center|bottom)
            'width' => false, // - can be '100%'
            'flag' => false, // - enable/disable
            'home' => false, // - link to home page
            'rss' => false, // - link to RSS
            'search' => false, // - search form
            'pages' => array(
                'depth' => 1, 'exclude' => ''
            ),
            'categories' => array(
                'depth' => 1, 'exclude' => '', 'group' => 1, 'title' => ''
            )
        ),
        'slideshow' => array(
            // Slideshow options
            'flag' => false, // - enable/disable
            'layout' => 'in', // - slideshow 'in' main container or 'over'
            'onpage' => false, // - show slideshow on page
            'onsingle' => false, // - show slideshow on single post
            'onarchive' => false, // - show slideshow on archives
            'showposts' => 10, // - show last N slides
            'id' => null, // - slideshow ID - for NextGenGallery
//                        'thumbnail' => true, // - use thumbnail or full size
            'height' => 200, // - height in px
            'advanced' => array(
                'play' => false,
                'effect' => 'slide',
                'effectTime' => 300,
                'timeout' => 3000
            )
        ),
        'design' => array(
            'box' => array(
                'flag' => true, // create box border radius
                'radius' => 6, // value of it
            ),
            'shadow' => array(
                'flag' => true, // create shadow
                'x' => 0,
                'y' => 0,
                'blur' => 3
            ),
        ),
        'images' => array(
            // background images
            'body' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat', 'fixed' => false
            ),
            'wrap' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat', 'fixed' => false
            ),

            'header' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat'
            ),
            'wrapper' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat'
            ),
            'sidebar' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat'
            ),
            'extrabar' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat'
            ),
            'footer' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat'
            ),

            'wrapheader' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat'
            ),
            'wrapcontent' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat'
            ),
            'wrapfooter' => array(
                'src' => '', 'pos' => 'left top', 'repeat' => 'no-repeat'
            ),
        ),
        'opacity' => 'light', // type of opacity
        'color' => array(
            // theme colors
            'bg' => '#fff',
            'bg2' => '#eee',
            'opacity' => '#fff',
            'title' => '#333',
            'title2' => '#555',
            'text' => '#333',
            'text2' => '#aaa',
            'border' => '#aaa',
            'border2' => '#999',
            'form' => '#fff',

            'header1' => '#ff6600',
            'header2' => '#ff8833',
            'header3' => '#ffaa66',
        ),
    );

    /**
     * Options by key "constructor"
     *
     * @var array
     */
    var $_options = array();

    /**
     * Options by key "constructor_admin"
     *
     * @var array
     */
    var $_admin = array(
        'theme' => 'default',
        'donate' => true
    );

    var $_theme = 'default';
    var $_themes = null;

    /**
     * Nix_Abstract
     *
     * @access  public
     */
    function Constructor_Abstract()
    {
        $this->__construct();
    }

    /**
     * Constructor of Nix_Abstract
     *
     * @access  public
     */
    function __construct()
    {
        $options = get_option('constructor');
        $admin = get_option('constructor_admin');

        if (!$options) {
            $options = require CONSTRUCTOR_DEFAULT_THEMES . '/default/config.php';
        }

        if (!$admin) {
            $admin = array();
        }

        $this->_options = $this->_arrayMerge($this->_default, $options);
        $this->_admin = $this->_arrayMerge($this->_admin, $admin);

        $this->_theme = $this->_admin['theme'];

        if (function_exists('add_image_size')) {
            $size = $this->getSlideshowSize();
	        add_image_size('slideshow-thumbnail', $size['width'], $size['height'], true);
        }
    }


    /**
     * array merge
     *
     * @param array $a
     * @param array $b
     * @return array
     */
    function _arrayMerge($a, $b)
    {
        foreach ($b as $k => $v) {
            if (is_array($v)) {
                if (!isset($a[$k])) {
                    $a[$k] = $v;
                } else {
                    $a[$k] = $this->_arrayMerge($a[$k], $v);
                }
            } else {
                $a[$k] = $v;
            }
        }
        return $a;
    }

    /**
     * getTheme
     *
     * return theme name
     *
     * @return  string
     */
    function getTheme()
    {
        return $this->_admin['theme'];
    }

    /**
     * @param  $theme
     * @return bool
     */
    function isDefaultTheme($theme)
    {
        return in_array($theme, $this->getDefaultThemes());
    }

    /**
     * @return string
     */
    function getThemePath()
    {
        return ($this->isDefaultTheme($this->_theme)
                 ? CONSTRUCTOR_DEFAULT_THEMES.'/'.$this->_theme
                 : CONSTRUCTOR_CUSTOM_THEMES.'/'.$this->_theme);
    }

    /**
     * @return string
     */
    function getThemeUri()
    {
        return ($this->isDefaultTheme($this->_theme)
                 ? CONSTRUCTOR_DEFAULT_THEMES_URI.'/'.$this->_theme
                 : CONSTRUCTOR_CUSTOM_THEMES_URI.'/'.$this->_theme);
    }

    /**
     * @return array
     */
    function getCustomThemes()
    {
        if ($this->_custom === null) {
            $themes = scandir(CONSTRUCTOR_CUSTOM_THEMES);
            $this->_custom = array_diff($themes, array('.', '..', '.svn', '.htaccess', 'readme.txt'));
        }
        return $this->_custom;
    }

    /**
     * @return array
     */
    function getDefaultThemes()
    {
        if ($this->_themes === null) {
            $themes = scandir(CONSTRUCTOR_DEFAULT_THEMES);
            $this->_themes = array_diff($themes, array('.', '..', '.svn', '.htaccess', 'readme.txt'));
        }
        return $this->_themes;
    }

    /**
     * getContentWidth
     *
     * @return integer
     */
    function getContentWidth()
    {
        // switch statement for $this->_options['sidebar']
        switch ($this->_options['sidebar']) {
            case 'none':
                return (int)($this->_options['layout']['width'] - 4);
                break;
            case 'two':
            case 'two-right':
            case 'two-left':
                return (int)($this->_options['layout']['width'] - $this->_options['layout']['sidebar'] - $this->_options['layout']['extra'] - 6);
                break;
            default:
                return (int)($this->_options['layout']['width'] - $this->_options['layout']['sidebar'] - 4);
                break;
        }
    }

    /**
     * getSlideshowSize
     *
     * @return array
     */
    function getSlideshowSize()
    {
        $return = array(
        );
        // height from configuration
        $return['height'] = (int)$this->_options['slideshow']['height'];

        // calculate slideshow width
        if ($this->_options['slideshow']['layout'] == 'over') {
            $return['width'] = (int)($this->_options['layout']['width'] - 2);
        } else {
            $return['width'] = $this->getContentWidth();
        }
        return $return;
    }
}

?>