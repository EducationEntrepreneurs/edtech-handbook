<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "8e90b7f77a28aa29679f586f78763caba59599b0a7"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/functions_2015-04-02-16.php") )  ) ){
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
			'icon' => 'glyphicon-search', 'title' => 'Lorem Ipsum', 'desc' => 'Lorem ipsum dolor sit amet', 'link' => '#'
		), $atts, 'icon', 'title', ' desc');
	$icons = $blockdata['icon'];
	$blocktitle = $blockdata['title'];
	$description = $blockdata['desc'];
	$links = $blockdata['link'];
    $blockdisplay = '<div class="home-block"><a href="'.$links.'"><div><i class="fa '.$icons.' fa-5x"></i></div><h3>'.$blocktitle.'</h3><div class="description">'.$description.'</div></a></div>';
    return $blockdisplay;
}
add_shortcode( 'homeblock', 'homeblock_func' );

function post_section( $atts ) {
	$section_data = shortcode_atts(
		array(
			'title' => 'This is title of post', 'description' => 'To use section shortcode insert [section title="Your Section Title" descritption="Your Section Descritption"][/section]'
		), $atts, 'title', 'desc');
	$title = $section_data['title'];
	$description = $section_data['description'];
    $section_content = '<h3>'.$title.'</h3><div class="post-description">'.$description.'</div>';
    $section_links = '<li><a href="#'.$title.'">'.$title.'</a></li>';
    $post_id = get_the_ID();
    jump_to_section($section_links,$post_id);
    return '<section id="'.$title.'">'.$section_content.'</section>';
}
add_shortcode( 'section', 'post_section' );

function jump_to_section($section_links,$post_id){
	$link_array= get_post_meta($post_id,'jump_to_section_link');
	$flag = 0;
	foreach($link_array as $link){
        $count = strlen($section_links) - similar_text($section_links,$link);
		 if($count==0)
		     $flag=0;
		 else
		     $flag=1;
	}
	if($flag==1){
	    foreach($link_array as $link)
	        $final_link=$link.$section_links;
	}
	if($flag==1)
		update_post_meta($post_id,'jump_to_section_link',$final_link);

}
add_action( 'add_meta_boxes', 'jump_to_sections' );
function jump_to_sections()
{
    add_meta_box( 'jump_to_section_link', 'Jump To Section', 'post', 'normal', 'high' );
}


/* Load Deafult Content */
add_filter( 'default_content', 'my_editor_content' );
function my_editor_content( $content ) {

	$content = '[section title="Who are the decision-makers?" description="To introduce technology into the classroom, you need to understand who the decision-makers are. Among whale-wise people it has often been argued whether, considering the paramount importance of his life to the success of the voyage, it is right for a whaling captain to jeopardize that life in the active perils of the chase. So Tamerlane\'s soldiers often argued with tears in their eyes, whether that invaluable life of his ought to be carried into the thickest of the fight."][/section]';
	return $content;
}