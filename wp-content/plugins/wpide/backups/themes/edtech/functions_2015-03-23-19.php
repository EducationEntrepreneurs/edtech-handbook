<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "34fd8828ed8a1f8bcdc8fbd371f54857edff84acba"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/functions_2015-03-23-19.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/*Stylesheet & Script*/

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
        'id' => 'sidebar-3',
        'description' => __( 'Widgets in this area will be shown on footer bottom left area.', 'footer-bottom' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}


/*Homepage Block*/
function homeblock_func( $atts ) {
	$blockdata = shortcode_atts(
		array(
			'icon' => 'glyphicon-search', 'title' => 'Lorem Ipsum', 'desc' => 'Lorem ipsum dolor sit amet'
		), $atts, 'icon', 'title', ' desc');
	$icons = $blockdata['icon'];
	$blocktitle = $blockdata['title'];
	$description = $blockdata['desc'];
$blockdisplay = '<div style="text-align:center;"><div class="col-md-3"><i class="fa '.$icons.'" style="font-size:45px;color:#3DDA85;"></i><h3 style="color:#3DDA85;">'.$blocktitle.'</h3><div>'.$description.'</div></div></div>';
return $blockdisplay;
}
add_shortcode( 'homeblock', 'homeblock_func' );

/*Custom Fields*/
add_action( 'add_meta_boxes', 'edtech_meta_box_add' );
function edtech_meta_box_add()
{
    add_meta_box( 'my-meta-box-id', 'Edtech Handbook votes', 'edtech_meta_box_cb', 'post', 'normal', 'high' );
}
function edtech_meta_box_cb(){
$inputval = 'Input vote here : <input type="text" name="my_meta_box_text" id="my_meta_box_text"/>';
echo $inputval;
}
add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{    
    // Make sure your data is set before trying to save it
    if( isset( $_POST['my_meta_box_text'] ) )
        update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );
}