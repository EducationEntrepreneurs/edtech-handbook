<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "8e90b7f77a28aa29679f586f78763cab0d75201312"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/functions_2015-03-24-11.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/*Stylesheet & Script*/
function edtech_scripts() {
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'edtech_scripts' );

/*Register WordPress Navigation*/
function register_my_menus() {
  register_nav_menus(
    array(
      'top-menu' => __( 'Top Menu' ),
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

/*Register Sidebar*/
add_action( 'widgets_init', 'header_top_widgets_init' );
function header_top_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Header Top Right', 'header-top' ),
        'id' => 'sidebar-1',
        'description' => __( 'Widgets in this area will be shown on header section', 'header-top' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	    'after_widget'  => '</li>',
	    'before_title'  => '<h2 class="widgettitle">',
	    'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Bottom Left', 'footer-bottom' ),
        'id' => 'sidebar-2',
        'description' => __( 'Widgets in this area will be shown on footer bottom left area.', 'footer-bottom' ),
        'before_widget' => '<div id="copyright" class="widget">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widgettitle">',
    	'after_title'   => '</h2>',
    ) );
}
/* Featured Image Support*/
add_theme_support( 'post-thumbnails' );

/*Homepage Block*/
function homeblock_func( $atts ) {
	$blockdata = shortcode_atts(
		array(
			'icon' => 'glyphicon-search', 'title' => 'Lorem Ipsum', 'desc' => 'Lorem ipsum dolor sit amet'
		), $atts, 'icon', 'title', ' desc');
	$icons = $blockdata['icon'];
	$blocktitle = $blockdata['title'];
	$description = $blockdata['desc'];
    $blockdisplay = '<div class="home-block"><a href="#"><i class="fa '.$icons.'"></i><h3>'.$blocktitle.'</h3><div class="description">'.$description.'</div></a></div>';
    return $blockdisplay;
}
add_shortcode( 'homeblock', 'homeblock_func' );

function post_section( $atts ) {
	$section_data = shortcode_atts(
		array(
			'title' => 'Lorem Ipsum', 'desc' => 'Lorem ipsum dolor sit amet'
		), $atts, 'title', 'desc');
	$title = $section_data['title'];
	$description = $section_data['desc'];
    $section_content = '<div class="home-block"><a href="#"><h3>'.$title.'</h3><div class="description">'.$description.'</div></a></div>';
    return $section_content;
}
add_shortcode( 'section', 'post_section' );