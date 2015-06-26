<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "b5b36394a2b09f8ef6155ad17086bee7bbe263e7e9"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/functions_2015-04-21-04.php") )  ) ){
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
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'edtech_scripts' );

function register_ajaxSort_script() {
    wp_register_script(
      'ajaxSort',
       get_stylesheet_directory_uri() . '/js/votee.js',
       array('jquery')
    );
    wp_enqueue_script('ajaxSort');
}
add_action('init', 'register_ajaxSort_script');

function register_vote_script() {
    wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri() . '/js/vote.js');
    wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); // setting ajaxurl
}
add_action('wp_enqueue_scripts', 'register_vote_script');

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
    register_sidebar( array(
        'name' => __( 'Suggest A Link', 'suggest-a-link' ),
        'id' => 'sidebar-3',
        'description' => __( 'Suggest A Link Widget Area.', 'suggest-a-link' ),
        'before_widget' => '<div id="link-suggest" class="widget">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h3 class="widgettitle">',
    	'after_title'   => '</h3>',
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
		 if($count==0){
		     $flag=0;
		  }
		 else
		     $flag=1;
	}
	if($flag==1){
	    foreach($link_array as $link)
	        $final_link=$link.$section_links;
	}
	if($flag==1)
		update_post_meta($post_id,'jump_to_section_link',$final_link);
	if(empty($link_array))
        	update_post_meta($post_id,'jump_to_section_link',$section_links);
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


function modify_user_contact_methods( $user_contact ) {

	// Add user contact methods
	$user_contact['blog']   = __('Blog');
	$user_contact['linkedin'] = __('Linkedin Profile URL');
    $user_contact['twitter'] = __('Twitter User Name');
	
	// Remove user contact methods
	unset( $user_contact['aim']);
	unset( $user_contact['jabber']);
	unset($user_contact['url']);
    unset($user_contact['pre_user_url']);

	return $user_contact;
}
add_filter( 'user_contactmethods', 'modify_user_contact_methods', 10, 1 );

function profile_admin_buffer_start() { ob_start("remove_plain_bio"); }
function profile_admin_buffer_end() { ob_end_flush(); }
add_action('admin_head', 'profile_admin_buffer_start');
add_action('admin_footer', 'profile_admin_buffer_end');
add_action('admin_head','hide_personal_options');
function remove_plain_bio($buffer) {
    $titles = array('#<h3>About Yourself</h3>#','#<h3>About the user</h3>#');
    $buffer=preg_replace($titles,'<h3>Password</h3>',$buffer,1);
    $biotable='#<h3>Password</h3>.+?<table.+?/tr>#s';
    $buffer=preg_replace($biotable,'<h3>Password</h3> <table>',$buffer,1);
    return $buffer;
}
function hide_personal_options(){
    echo '<script type="text/javascript">jQuery(document).ready(function($) { $("form#your-profile > h3:first").hide(); $("form#your-profile > table:first").hide(); $("form#your-profile").show(); });</script>';
}

/* Author Fetch*/
function edtech_author($cat_name){
    $args = array('category_name' => $cat_name,'posts_per_page'   => -1);
    $posts_array = get_posts( $args );
    $author_id = array();
        foreach ( $posts_array as $post ){
	       $id = $post->post_author;
                if (!in_array($id, $author_id)) {
                    array_push($author_id,$id);
                }
        }
     return $author_id;
}


/*to display shortcode excerpt*/
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_trim_excerpt_do_shortcode');

function wp_trim_excerpt_do_shortcode($text) {
$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = do_shortcode( $text );

		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text);
		$excerpt_length = apply_filters('excerpt_length', 20);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '...');
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $excerpt_length ) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

function featured_posts($postID){
    $check = get_post_meta($postID,'featured');
    if(!empty($check)){
        foreach($check as $featured){
                $featured_post=$featured;
        }
        return $featured_post;
    }
}

function time_elapsed($secs){
    $bit = array(
        ' year'        => floor($secs/31556926),
        ' month'        =>floor($secs/2592000),
        ' day'        => floor($secs/86400),
        ' hour'        =>floor($secs/3600),
        ' minute'    =>floor($secs/60),
        ' second'    =>($secs)
        );
        
    foreach($bit as $k => $v){
        if($v > 1){
            $ret[] = $v . $k . 's';
            break;
        }
        if($v == 1){
            $ret[] = $v . $k;
            break;
        }
    }
    $ret[] = 'ago';
    
    return join(' ', $ret);
}


/*Vote Script*/
add_action("after_switch_theme", "vote_activity_log_table");
function vote_activity_log_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "vote_log";
    $charset_collate = $wpdb->get_charset_collate();
    $add_table = "CREATE TABLE $table_name (
		post_id mediumint(9) NOT NULL,
		ip_address longtext NOT NULL
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $add_table );
}

function vote_count(){
  /*  global $wpdb;
    $postId= 185;
    $wpdb->insert($wpdb->prefix. 'vote_log', array('post_id' => 185,'ip_address'=> 1001));
*/
echo '<a href="#ajaxthing" class="myajax">Test</a>';
    exit();
}
add_action( 'wp_ajax_vote_count', 'vote_count' );
add_action( 'wp_ajax_nopriv_vote_count', 'vote_count' ); 