
body {
font-family: <?php echo $tn_wpmu_body_font; ?>!important;
color: <?php echo $tn_wpmu_body_font_colour; ?>!important;
background: <?php if($tn_wpmu_bg_colour == ""){ ?><?php echo "#E4E4E4"; } else { ?><?php echo $tn_wpmu_bg_colour; ?><?php } ?><?php if($tn_wpmu_bg_image == "") { ?><?php } else { ?> url(<?php echo $tn_wpmu_bg_image; ?>)<?php } ?> <?php echo $tn_wpmu_bg_image_repeat; ?> <?php echo $tn_wpmu_bg_image_attachment; ?> <?php echo $tn_wpmu_bg_image_horizontal; ?> <?php echo $tn_wpmu_bg_image_vertical; ?>!important;
}

h1, h2, h3, h4, h5, h6 {
font-family: <?php echo $tn_wpmu_headline_font; ?>!important;
}

<?php if(($tn_wpmu_font_size == "normal") || ($tn_wpmu_font_size == "")) { ?>
#wrapper { font-size: 0.75em; }
<?php } elseif ($tn_wpmu_font_size == "small") { ?>
#wrapper { font-size: 0.6875em; }
<?php } elseif ($tn_wpmu_font_size == "bigger") { ?>
#wrapper { font-size: 0.85em; }
<?php } elseif ($tn_wpmu_font_size == "largest") { ?>
#wrapper { font-size: 1em; }
<?php } ?>

<?php if($tn_wpmu_content_link_colour != "") { ?>
ol.pinglist li a, h1.post-title a, .post a, .page a, #sidebar a, #cf a, ol.commentlist a, .site-title h1 a, #post-navigator-single a, #top-right-widget a, #top-content a, #bottom-content a, #post-entry #page-nav a {
color: <?php echo $tn_wpmu_content_link_colour; ?>!important;
}
<?php } ?>

<?php if($tn_wpmu_content_link_hover_colour != "") { ?>
ol.pinglist li a:hover, #container h1.post-title a:hover, .post a:hover, .page a:hover, #sidebar a:hover, #cf a:hover, #commentpost a:hover, .site-title h1 a:hover, #post-navigator-single a:hover, #top-right-widget a:hover, #top-content a:hover, #bottom-content a:hover, #post-entry #page-nav a:hover {
color: <?php echo $tn_wpmu_content_link_hover_colour; ?>!important;
}
<?php } ?>



<?php if($tn_wpmu_nv_bg_hover_colour != "") { ?>
#nav li a:hover { background: <?php echo $tn_wpmu_nv_bg_hover_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_nv_link_colour != "") { ?>
#nav li a, #nav ul li a { color: <?php echo $tn_wpmu_nv_link_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_nv_link_hover_colour != "") { ?>
#nav li a:hover, #nav ul li a:hover { color: <?php echo $tn_wpmu_nv_link_hover_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_nv_dropdown_bg_colour != "") { ?>
#nav ul li a { background: <?php echo $tn_wpmu_nv_dropdown_bg_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_nv_dropdown_bg_hover_colour != "") { ?>
#nav ul li a:hover { background: <?php echo $tn_wpmu_nv_dropdown_bg_hover_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_nv_dropdown_line_colour != "") { ?>
#nav ul li a { border-bottom: 1px solid <?php echo $tn_wpmu_nv_dropdown_line_colour; ?>!important; }
<?php } ?>



<?php if($tn_wpmu_content_line_colour != "") { ?>

.introbox {
	border-right: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

.post-content blockquote {
border-left: 5px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

.wp-caption {
background-color: <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

ul.list h3 {
	border-bottom: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

#box2 {
border-left: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
border-right: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

#commentpost h4, ol.pinglist li a {
border-bottom: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

#cf {
background: <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

ol.commentlist li {
	border:  1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
    background: <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

#post-entry {
border-right: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

div.post, div.page {
	border-bottom: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

#bottom-content {
	border-top: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

.com, .com-alt {
	border-bottom: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}

.com-avatar img {
	border: 1px solid <?php echo $tn_wpmu_content_line_colour; ?>!important;
}
<?php } ?>



<?php if($tn_wpmu_container_colour != "") { ?>
#container { background: <?php echo $tn_wpmu_container_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_post_title_link_colour != "") { ?>
#container h1.post-title a {
color: <?php echo $tn_wpmu_post_title_link_colour; ?>!important;
}
<?php } ?>


<?php if($tn_wpmu_nv_footer_colour != "") { ?>
#footer { background: <?php echo $tn_wpmu_nv_footer_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_nv_footer_colour != "") { ?>
#navigation { background: <?php echo $tn_wpmu_nv_footer_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_image_height != "") { ?>
#custom-img-header { height: <?php echo $tn_wpmu_image_height; ?>px!important; }
<?php } ?>