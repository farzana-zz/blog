<?php
/**
 * CSS Generator, please never change this is file, if your not sure what are you doing!
 *
 * base 64 used for encode transparent images, don't worry about it
 * 
 * @package WordPress
 * @subpackage Constructor
 */
header('Content-type: text/css');

// debug
//error_reporting(E_ALL);


// load custom theme (using theme switcher)
//if (isset($_GET['theme'])) {
//    $theme = $_GET['theme'];
//    $theme = preg_replace('/[^a-z0-9\-\_]+/i', '', $theme);
//    if (file_exists(dirname(__FILE__) . '/themes/'.$theme.'/config.php')) {
//       $options = include_once dirname(__FILE__) . '/themes/'.$theme.'/config.php';
//       $options['theme'] = $theme;
//    }
//} else {
global $image_uri, $options;

include_once dirname(__FILE__) .'/libs/Constructor/Admin.php';
$Constructor = new Constructor_Admin();

$options = $Constructor->_options;
$theme = $Constructor->_theme;

$image_uri = $Constructor->getThemeUri();
$theme_uri = CONSTRUCTOR_DIRECTORY_URI;
//}

$width    = isset($options['layout']['width'])?$options['layout']['width']:1024;
$sidebar  = isset($options['layout']['sidebar'])?$options['layout']['sidebar']:240;
$extra    = isset($options['layout']['extra'])?$options['layout']['extra']:240;

$color1   = $options['color']['header1'];
$color2   = $options['color']['header2'];
$color3   = $options['color']['header3'];

$color_bg      = $options['color']['bg'];
$color_bg2     = $options['color']['bg2'];
$color_form    = $options['color']['form'];
$color_text    = $options['color']['text'];
$color_text2   = $options['color']['text2'];
$color_border  = $options['color']['border'];
$color_border2 = $options['color']['border2'];
$color_opacity = isset($options['color']['opacity'])?$options['color']['opacity']:'#ffffff';

/*Fonts*/

// detect font-face
$font_face = require dirname(__FILE__) .'/admin/font-face.php';
$include_fonts = array();
if (array_search($options['fonts']['title']['family'], $font_face) !== false) {
    $font = preg_split('/[,]+/', $options['fonts']['title']['family']);
    $font = urlencode(trim($font[0],'"'));
    array_push($include_fonts, $font);
}
if (array_search($options['fonts']['description']['family'], $font_face) !== false) {
    $font = preg_split('/[,]+/', $options['fonts']['description']['family']);
    $font = urlencode(trim($font[0],'"'));
    if (array_search($font, $include_fonts) === false) {
        array_push($include_fonts, $font);
    }
}
if (array_search($options['fonts']['header']['family'], $font_face) !== false) {
    $font = preg_split('/[,]+/', $options['fonts']['header']['family']);
    $font = urlencode(trim($font[0],'"'));
    if (array_search($font, $include_fonts) === false) {
        array_push($include_fonts, $font);
    }
}
if (array_search($options['fonts']['content']['family'], $font_face) !== false) {
    $font = preg_split('/[,]+/', $options['fonts']['content']['family']);
    $font = urlencode(trim($font[0],'"'));
    if (array_search($font, $include_fonts) === false) {
        array_push($include_fonts, $font);
    }
}
if (!empty($include_fonts)) {
    $font_face = '@import url(http://fonts.googleapis.com/css?family='.join('|',$include_fonts).');'."\n";
} else {
    $font_face = '';
}

$title_font = <<<CSS
    font-family:{$options['fonts']['title']['family']};
    font-size:{$options['fonts']['title']['size']}px;
    line-height:{$options['fonts']['title']['size']}px;
    font-weight:{$options['fonts']['title']['weight']};
    color:{$options['fonts']['title']['color']};
    text-transform:{$options['fonts']['title']['transform']};
CSS;

$description_font = <<<CSS
    font-family:{$options['fonts']['description']['family']};
    font-size:{$options['fonts']['description']['size']}px;
    line-height:{$options['fonts']['description']['size']}px;
    font-weight:{$options['fonts']['description']['weight']};
    color:{$options['fonts']['description']['color']};
    text-transform:{$options['fonts']['description']['transform']};
CSS;

$body_font = <<<CSS
    font-family:{$options['fonts']['content']['family']};
CSS;

$header_font = <<<CSS
    font-family:{$options['fonts']['header']['family']};
CSS;

$content_font = <<<CSS
    font-family:{$options['fonts']['content']['family']};
CSS;

/*/Fonts*/

/* Opacity */
// switch statement for $options['opacity']
switch ($options['opacity']) {
    case 'none':
        $opacity = '';
        break;
    case 'color':
        $opacity = <<<CSS
.opacity {
    background-color:{$color_opacity}
}
CSS;
        break;
    case 'darklow':
        $opacity = <<<CSS
.opacity {
    background:url('$theme_uri/images/opacity_black_30.png');
}
CSS;
        break;
    case 'dark':
        $opacity = <<<CSS
.opacity {
    background:url('$theme_uri/images/opacity_black_50.png');
}
CSS;
        break;
    case 'darkhigh':
        $opacity = <<<CSS
.opacity {
    background:url('$theme_uri/images/opacity_black_80.png');
}
CSS;
        break;
    case 'lightlow':
        $opacity = <<<CSS
.opacity {
    background:url('$theme_uri/images/opacity_white_30.png');
}
CSS;
        break;
    case 'lighthigh':
        $opacity = <<<CSS
.opacity {
    background:url('$theme_uri/images/opacity_white_80.png');
}
CSS;
        break;
    case 'light':
    default:
        $opacity = <<<CSS
.opacity {
    background:url('$theme_uri/images/opacity_white_50.png');
}
CSS;
        break;
}
/* Box */
if ($options['design']['box']['flag']) {
    $radius = $options['design']['box']['radius'];
    
    $box = <<<CSS
.box {
    border-color:{$color_border};
    border-style:solid;
    border-width:1px;
    border-radius: {$radius}px;
    -moz-border-radius: {$radius}px;
    -khtml-border-radius: {$radius}px;
    -webkit-border-radius: {$radius}px
}
CSS;
    // switch statement for $options['menu']['pos']
    switch ($options['menu']['pos']) {
        case 'left top':
        case 'right top':
            $box .= <<<CSS
#menu {
    -moz-border-radius: 0 0 {$radius}px {$radius}px;
    -webkit-border-bottom-left-radius: {$radius}px;
    -webkit-border-bottom-right-radius: {$radius}px;
    -khtml-border-bottom-left-radius: {$radius}px;
    -khtml-border-bottom-right-radius: {$radius}px;
    border-bottom-left-radius: {$radius}px;
    border-bottom-right-radius: {$radius}px;
    border-color:{$color_border};
    border-style:solid;
    border-width:1px;
    border-top:0;
}
CSS;
            break;
        default: 
           $box .= <<<CSS
#menu {
    -moz-border-radius: {$radius}px;
    -webkit-border-radius: {$radius}px;
    -khtml-border-radius: {$radius}px;
    border-radius: {$radius}px;
    border:{$color_border} solid 1px;
}
CSS;
            break;
    }

    
} else {
    $box = '';
}
// switch statement for $options['title']['pos']

list($title_halign, $title_valign) = preg_split('/ /', $options['title']['pos']);
$title_align = '';

switch ($title_halign) {
    case 'left':
        $title_align .= 'text-align:left;';
        break;
    case 'center':
        $title_align .= 'text-align:center;';
        break;
    case 'right':
        $title_align .= 'text-align:right;';
        break;
}

switch ($title_valign) {
    case 'bottom':
        $title_align .= 'bottom:0;';
        break;
    case 'top':
    default:
        $title_align .= 'top:0;';
        break;
}

// switch statement for $options['menu']['pos']
$menu_center = round(($options['layout']['header'] - 40) / 2);

$menu = "";
switch ($options['menu']['pos']) {
    case 'right top':
        $menu .="right:0;top:0;";
        break;
    case 'left center':
        $menu .="left:0;top:{$menu_center}px;";
        break;
    case 'right center':
        $menu .="right:0;top:{$menu_center}px;";
        break;
    case 'left bottom':
        $menu .="left:0;bottom:0;margin-bottom: 6px;";
        break;
    case 'right bottom':
        $menu .="right:0;bottom:0;margin-bottom: 6px;";
        break;
    case 'left top':
    default:
        $menu .="left:0;top:0;";
        break;
}

// switch statement for $options['menu']['width']
switch ($options['menu']['width']) {
    case '100%':
        $menu .= "width:{$width}px;";
        break;
    default:
        break;
}

/* Shadow */
if ($options['design']['shadow']['flag']) {
    $x_offset = $options['design']['shadow']['x'];
    $y_offset = $options['design']['shadow']['y'];
    $blur     = $options['design']['shadow']['blur'];
    
    $shadow = <<<CSS
.shadow {
    box-shadow: {$x_offset}px {$y_offset}px {$blur}px {$color_border};
    -moz-box-shadow: {$x_offset}px {$y_offset}px {$blur}px {$color_border};
    -webkit-box-shadow: {$x_offset}px {$y_offset}px {$blur}px {$color_border}
}
CSS;
} else {
    $shadow = '';
}

/* Layout */
$layout = "";
$layout_fluid = "";

if ($options['layout']['fluid']['flag']) {
    $layout_fluid = <<<CSS
    width:{$options['layout']['fluid']['width']}%;
    min-width:{$options['layout']['fluid']['min-width']}px;
    max-width:{$options['layout']['fluid']['max-width']}px;
CSS;
} else {
    $layout_fluid = <<<CSS
    width:{$width}px;
CSS;
}


// width changes
$sidebar2 = $sidebar - 4; // 2px - it's borders width
$extra2   = $extra   - 4;

// sidebar layouts CSS
{
$width2 = $width - ($sidebar + 1); // 1 is border width

$layout .= <<<CSS
.layout-left #container {
    width:{$width2}px;
    margin-left:{$sidebar}px;
    border-left:1px dotted {$color_border};
}
.layout-left #sidebar {
    margin-left:-{$width}px !important;
}

CSS;

$width2 = $width - ($sidebar + $extra + 2); // 2 is borders width

$layout .= <<<CSS
.layout-two #container {
    width:{$width2}px;
    margin-left:{$extra}px;
    border-left:1px dotted {$color_border};

    margin-right:{$sidebar}px;
    border-right:1px dotted {$color_border};
}
.layout-two #sidebar {
    margin-left:-{$sidebar}px;
}
.layout-two #extra {
    margin-left:-{$width}px;
}

CSS;
     
$margin = $sidebar + $extra + 2;
$width2 = $width - $margin;

$layout .= <<<CSS
.layout-two-right #container {
    width:{$width2}px;

    margin-right:{$margin}px;
    border-right:1px dotted {$color_border};
}
.layout-two-right #sidebar {
    margin-left:-{$margin}px;
    border-right:1px dotted {$color_border};
}
.layout-two-right #extra {
    margin-left:-{$extra}px;
}

CSS;

$margin2 = $width - $sidebar;

$layout .= <<<CSS
.layout-two-left #container {
    width:{$width2}px;
    margin-left:{$margin}px;
    border-left:1px dotted {$color_border};
}
.layout-two-left #sidebar {
    margin-left:-{$width}px;
    border-right:1px dotted {$color_border};
}
.layout-two-left #extra {
    margin-left:-{$margin2}px;
}

CSS;

$width2  = $width - $sidebar;
$layout .= <<<CSS
.layout-right #container {
    width:{$width2}px;
    margin-right:{$sidebar}px;
    border-right:1px dotted {$color_border};
}
.layout-right #sidebar {
    margin-left:-{$sidebar}px;
}
CSS;
}

{
$layout .= <<<CSS
.layout-none #container {
    border:0;
    margin:0;
    width:{$width}px !important
}
CSS;
}

function constructor_css_bg($section) {
    global $options, $image_uri;
    $css = "";
    if (isset($options['images'][$section]['src']) && !empty($options['images'][$section]['src'])) {
        $css = "background-image: url('{$image_uri}/{$options['images'][$section]['src']}');\n"
             . "background-repeat: {$options['images'][$section]['repeat']};\n"
             . "background-position: {$options['images'][$section]['pos']};\n";
        if (isset($options['images'][$section]['fixed']) && $options['images'][$section]['fixed']) {
            $css .= "background-attachment:fixed;\n";
        }
    }
    
    return $css;
}

/* Background images */
$body_bg = constructor_css_bg('body');
$wrap_bg = constructor_css_bg('wrap');
$wrapper_bg = constructor_css_bg('wrapper');
$header_bg = constructor_css_bg('header');
$sidebar_bg = constructor_css_bg('sidebar');
$extrabar_bg = constructor_css_bg('extrabar');
$footer_bg = constructor_css_bg('footer');

/* Wrappers */
$wrapheader_bg = constructor_css_bg('wrapheader');
$wrapcontent_bg = constructor_css_bg('wrapcontent');
$wrapfooter_bg = constructor_css_bg('wrapfooter');

/* Comments */
switch ($options['comments']['avatar']['pos']) {
    case 'left':
        $avatar_pos = "float: left;\n    margin: 0 10px 10px 0;";
        $avatar_author = "float: right !important;\n    margin: 0 0 10px 10px !important;";
        break;
    case 'right':
    default:
        $avatar_pos = "float: right;\n    margin: 0 0 10px 10px;";
        $avatar_author = "float: left !important;\n    margin: 0 10px 10px 0 !important;";
        break;
}

/* Header */
if ($options['title']['hidden']) {
    $title = <<<CSS
#name a, #description {
    font-size:0px;
    text-indent:-9000px;
}
#name a {
    display:block;
    height:100%;
}
CSS;
} else {
    $title = '';
}


/* Output CSS */
echo <<<CSS
{$font_face}
body {
    background-color:{$color_bg};
{$content_font}
{$body_bg}
}

body,
a { color:{$color_text} }

hr { background-color: {$color1} }

h1,h2,h3,h4,h5,h6 {{$header_font}}

h1,
h2 { color:{$color1} }
h3,
h4 { color:{$color2} }
h5,
h6 { color:{$color3} }

pre {{$content_font}}

a:hover { color:{$color1} }
table {
    border-color:{$color_border};
}
table caption {
    color:{$color1};
}
th {
    color:{$color1};
}
tr td {
    border-top-color:{$color_border};
}
tr.odd td {
	background: {$color_bg2};
}


/*Colors*/
/* text colors */
.color0 { color:{$color_opacity} }

.color1 { color:{$color1} }
.color2 { color:{$color2} }
.color3 { color:{$color3} }

.color4 { color:{$color_text} }
.color5 { color:{$color_text2} }

.color6 { color:{$color_bg}  }
.color7 { color:{$color_bg2} }

.color8 { color:{$color_border}  }
.color9 { color:{$color_border2} }

/* borders colors */
.bcolor0 { border-color:{$color_opacity} }

.bcolor1 { border-color:{$color1} }
.bcolor2 { border-color:{$color2} }
.bcolor3 { border-color:{$color3} }

.bcolor4 { border-color:{$color_text} }
.bcolor5 { border-color:{$color_text2} }

.bcolor6 { border-color:{$color_bg}  }
.bcolor7 { border-color:{$color_bg2} }

.bcolor8 { border-color:{$color_border}  }
.bcolor9 { border-color:{$color_border2} }

/* background colors */
.bgcolor0 { background-color:{$color_opacity} }

.bgcolor1 { background-color:{$color1} }
.bgcolor2 { background-color:{$color2} }
.bgcolor3 { background-color:{$color3} }

.bgcolor4 { background-color:{$color_text} }
.bgcolor5 { background-color:{$color_text2} }

.bgcolor6 { background-color:{$color_bg}  }
.bgcolor7 { background-color:{$color_bg2} }

.bgcolor8 { background-color:{$color_border}  }
.bgcolor9 { background-color:{$color_border2} }
/*/Colors*/

/*Form*/
input, select, textarea {
    color:{$color_text};
    border-color: {$color_border};
    background-color:{$color_form}
}

input:active, select:active, textarea:active {
    border-color:{$color3};
    background-color:{$color_bg2}
}

input:focus, select:focus, textarea:focus {
    border-color:{$color3};
    background-color:{$color_bg2}
}

fieldset{
    border-color: {$color_border}
}
/*/Form*/
/*CSS3*/
::selection {
    background: {$color1};
    color:{$color_bg}
}
::-moz-selection {
    background: {$color1};
    color:{$color_bg}
}
{$opacity}
{$shadow}
{$box}
/*/CSS3*/
/*Layout*/
#body {
    {$wrap_bg}
}
#wrapheader {
    {$wrapheader_bg}
}
    #header {
        {$header_bg}
    }

#wrapcontent {
    {$wrapcontent_bg}
}
    #content {
        {$wrapper_bg}
    }

#header,#content,#footer{
    {$layout_fluid}
}

{$layout}

#sidebar{
    width:{$sidebar2}px;
    {$sidebar_bg}
}
#extra {
    width:{$extra2}px;
    {$extrabar_bg}
}

#wrapfooter{
    {$wrapfooter_bg}
}
    #footer{
        width:{$width}px;
        {$footer_bg}
    }
/*/Layout*/
/*Header*/
#header {
	height: {$options['layout']['header']}px;
	text-align: {$options['title']['pos']}
}
#header #name a {
{$title_font}
}
#header #description {
{$description_font}
}
{$title}
#header #title {
    {$title_align}
}

#menu { {$menu} }
    #menu ul ul { border: 1px solid {$color_border};}
    #menu li li { background-color:{$color_bg}  }
    #menu li:hover { background-color:{$color_bg2} }
    
    #menu .current_page_item a,
    #menu .current-cat a{
        color:{$color1}
    }
    #menu .current_page_item li a,
    #menu .current-cat li a {
        color: {$color_text}
    }
#menusearchform .s {
   background-color:{$color_bg2}
}
#menusearchform .default {
   color:{$color_text2};
   background-color:{$color_bg}
}
/*/Header*/
/*Slideshow*/
.wp-sl img{
    border-color: {$color_border};
}
#content .wp-sl {
    border-width:0 0 1px 0;
    border-style:solid;
    border-color:{$color_border};
}
/*/Slideshow*/
/*Images*/
.wp-caption {
   color:{$color_text};
   border-color: {$color_border};
   /*background-color: {$color_border};*/
}
.wp-caption-text {
   color:{$color_text};
}
.gallery .gallery-caption {
   color:{$color_text2};
}
.gallery img {
   border-color: {$color_border};
}
/*/Images*/
/*Calendar*/
#wp-calendar th {
    border-bottom:1px solid {$color_border2}
}
#wp-calendar tbody {
   color:{$color_text2};
   border-bottom:1px solid {$color_border2}
}
#wp-calendar tbody a {
   color:{$color_text};
}
#wp-calendar tbody a:hover {
   background-color: {$color_bg};
}
#wp-calendar #today {    
   color:{$color1};
   background-color: {$color_bg2};
}
/*/Calendar*/
/*Post*/
.hentry .entry .crop,
.hentry .entry img {
    border-color:{$color_border}
}
.simple .title {
   border-color:{$color_border};
}
.list .title {
   border-color:{$color_border};
   background-color: {$color3};
}
.list .title h2 a{
   color: {$color_bg};
}
.list .title h2 a:hover{
   color: {$color_bg2};
}
.list .title .date{
   color: {$color_bg2};
}

.tiles .announce{
    background-color: {$color_bg};
}
.tiles.next a:hover{
    background-color: {$color_bg};
}
/*/Post*/
/*Author*/
.author dt, .author dd {
    border-color:{$color_bg2}
}
/*/Author*/
/*Archive*/
#posts .archive table td{
    color:{$color_text2}
}
#posts .archive table a{
    padding:4px;
    color:{$color_text}
}
#posts .archive table a:hover{
    background-color: {$color2};
}
/*/Archive*/
/*Sidebar*/    
.sidebar .current_page_item a,
.sidebar .current-cat a{
    font-weight:900;
    border-color:{$color_text}
}
.sidebar .current_page_item li a,
.sidebar .current-cat li a{
    font-weight:500;
    border-color:{$color_border}
}
/*/Sidebar*/
/*Widgets*/
.widget_rss li .rsswidget {
    color:{$color1}
}
/*/Widgets*/
/*Content Widgets*/
#content-widget {
    background-color: {$color_bg2};
}
/*/Content Widgets*/
/*Comments*/
.thread-even, .even {
    background-color: {$color_bg};
    border: 1px solid {$color_border}
}
.alt {
    background-color: {$color_bg};
}
.thread-odd, .odd {
    background-color: {$color_bg2};
    border: 1px solid {$color_border2}
}
/*
.depth-2, .depth-4 {
    border-left:3px dotted {$color_border}
}
*/
.commentlist li .avatar {
    {$avatar_pos};
    border-color: {$color_border2};
}
.comment-meta a{
    color:{$color_text2}
}
.bypostauthor .avatar{
    {$avatar_author}
}
/*/Comments*/
/*Footer*/
#footer .copy{
    color:{$color_text2}
}
/*/Footer*/
/*Buttons*/
.button, .button:visited {
    background-color: {$color1};
    color: {$color_bg};
}
.button:hover { 
    background-color: {$color2};
    color: {$color_bg2};
}
/*/Buttons*/
/*Plugins:wp-pagenavi*/
.wp-pagenavi a, .wp-pagenavi span {
    border:1px solid {$color_border} !important;
}
.wp-pagenavi a:hover, .wp-pagenavi span.current {
    border-color:{$color_border2} !important;
}
CSS;
?>