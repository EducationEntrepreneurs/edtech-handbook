<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19fa5eda5db1"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/functions_2015-05-07-07.php") )  ) ){
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
add_filter('widget_text', 'do_shortcode');
/* Featured Image Support*/
add_theme_support( 'post-thumbnails' );
add_image_size("featured",400,225,true );

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

function time_elapsed($post_id){
    $unix_post_time =get_post_time(true,$post_id);
    $post_time=date("F j, Y",$unix_post_time);
    return $post_time;
}

function get_max_pages($post_count,$first_page_post,$sub_page_post){
    return (ceil(($post_count-$first_page_post)/$sub_page_post)+1);
}



/*Vote Script*/
function vote_counts()
{
    //register_meta('post', 'vote_counts_yes', 'vote_counts_func');
   add_meta_box( 'vote_counts_yes', 'Vote Counts Yes', 'post', 'normal', 'high' );
   add_meta_box( 'vote_counts_no', 'Vote Counts No', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'vote_counts', 10, 2 );

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



function register_vote_script() {
    wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri() . '/js/vote.js');
    wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); // setting ajaxurl
}
add_action('wp_enqueue_scripts', 'register_vote_script');
function vote_count(){
    global $wpdb;
    $postId = $_POST['postId'];
    $ipAddress = $_POST['IP'];
    $vote_status = $_POST['VoteStatus'];
    $ip_array=array();
    $SQLquery = 'select ip_address from '.$wpdb->prefix.'vote_log where post_id = '.$postId; 
    $result = $wpdb->get_results($SQLquery, OBJECT);
    $count = 0;
    $vote_count_yes = intval(get_post_meta($postId, 'vote_count_yes',true)) + 1;
    $vote_count_no = intval(get_post_meta($postId, 'vote_count_no',true)) + 1;
    foreach($result as $k){
        $ip_array = array_merge($ip_array, array_map('trim', explode(",",$k->ip_address)));
    }
    foreach($ip_array as $ip){
        if($ip==$ipAddress){
          $response = "You Have Already Voted!";
          echo $response;
          exit;
        }
        $count++;
    }

    if($count == 0){
        if($vote_status == 1){
            update_post_meta($postId, 'vote_count_yes', $vote_count_yes);    
        }
        else{
            update_post_meta($postId, 'vote_count_no', $vote_count_no);    
        }
        $response = vote_insert($postId, $ipAddress);
    
   }
   else{
        if($vote_status == 1){
            update_post_meta($postId, 'vote_count_yes', $vote_count_yes);     
        }
        else{
            update_post_meta($postId, 'vote_count_no', $vote_count_no);     
        }
        $response = vote_update($result,$postId,$ipAddress);
   }
 
    echo $response;
    exit();
}

function vote_insert($postId, $ipAddress){
    global $wpdb;
    $wpdb->insert($wpdb->prefix. 'vote_log', array('post_id' =>$postId,'ip_address'=> $ipAddress));
    $response = "Thank you for your feedback!";
    return $response;
}
function vote_update($result,$postId,$ipAddress){
    global $wpdb;
    
    foreach($result as $test){
       $newIP =$test->ip_address.','.$ipAddress;
    }
    
    $data = array(
		'post_id' => $postId,
		'ip_address' => $newIP
	);
    $where = array('post_id' => $postId);
    $outputs = $wpdb->update( $wpdb->prefix.'vote_log', $data, $where, '%s', '%d');
    $response = "Thank you for your feedback!";
    return $response;
}
add_action( 'wp_ajax_vote_count', 'vote_count' );
add_action( 'wp_ajax_nopriv_vote_count', 'vote_count' );

function get_ip(){
    return $_SERVER['REMOTE_ADDR'];
}

/*Sort Function*/
function register_cat_sort_script() {
    wp_enqueue_script( 'sort-scripts', get_stylesheet_directory_uri() . '/js/sort.js');
    wp_localize_script( 'sort-scripts', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', 'register_cat_sort_script');

function vote_meta($cat_name){
    $args = array('category_name' => $cat_name,'posts_per_page'   => -1);
    $posts_array = get_posts( $args );
    $vote = array();
        foreach ( $posts_array as $post ){
	        $id = $post->ID;
            $votecount = get_post_meta($id,'vote_count_yes');
            $vote[$id]=$votecount[0];
        }
     arsort($vote);
     return $vote;
}

function format($img,$current_position,$post_time){
    
    if($img[0]!=""){
        $imagepath = '<div class="post_image"><a href="'.get_post_permalink().'" target="_blank"><img src="'.$img[0].'" /></a></div>';    
    }
    else{
        $imagepath = "";
    }
    if(strlen(get_the_title())>=60){
        $title = substr_replace(trim(substr_replace(get_the_title()," ",59)),"...",59,0); 
    }
    else{
        $title = get_the_title();   
    }
    
    return  '<div class="sorted_res">'.$imagepath.'
                            <div class="post_time">'.$post_time.'</div>
                            <div class="post_title"><a href="'.get_post_permalink().'" target="_blank"><h3>'.$title.'</h3></a></div>
                            <div class="author_info">
                                <div class="author_dp">
                                     <a href="../../expert?id='.get_the_author_meta( 'ID' ).'" target="_blank">'.get_avatar( get_the_author_meta( 'ID' ), 45 )
                                .'</a></div>
                                <div class="author">                                
                                    <a href="../../expert?id='.get_the_author_meta( 'ID' ).'" target="_blank">
                                        <p>'.get_the_author().'</p>
                                        <p>'.$current_position.'</p>
                                    </a>
                                </div>
                            </div>
                            <div class="post_content"><a href="'.get_post_permalink().'" target="_blank"><p>'.get_the_excerpt().'</p></a></div>
                        </div>';
}

function cat_sort(){
    $select = $_POST['val'];
    $cat_name = $_POST['catname'];
    if($select == 'recent')
    {
       $response = cat_sort_recent($cat_name);
    }
    else if($select == 'useful')
    {
        $response = cat_sort_useful($cat_name);   
    }
    else
    {
        $response = cat_sort_featured($cat_name);   
    }
    echo $response;
    exit();
}
function cat_sort_recent($catname){
    $args = array(
	                'posts_per_page' => 2,
	                'category_name' => $catname
                );
    $post_recent = "";
    query_posts($args);
    while ( have_posts() ) : the_post();
                    global $post;
                    $author_id = $post->post_author;
                    $post_time=time_elapsed($post_id);
                    $CP = get_cimyFieldValue($author_id, 'CURRENTPOSITION');
                    $current_position = cimy_uef_sanitize_content($CP);
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ,"featured" );
                    $post_recent = $post_recent . format($img,$current_position,$post_time);
    endwhile;
    wp_reset_query();
    return $post_recent;
}

function cat_sort_useful($catname){
    $args = array(
	                'posts_per_page' => -1,
	                'category_name' => $catname
                );
    $post_useful = "";
    query_posts($args);
    $postid=array();
    $post_type = vote_meta($catname);
    $flag=0;
    foreach($post_type as $id=>$value){
        if($flag<2){
            array_push($postid,$id);
            $flag++;
        }
    }
    
    while ( have_posts() ) : the_post();
                    global $post;
                    $post_id = get_the_ID();
                    $author_id = $post->post_author;
                    $post_time=time_elapsed($post_id);
                    $CP = get_cimyFieldValue($author_id, 'CURRENTPOSITION');
                    $current_position = cimy_uef_sanitize_content($CP);
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ,"featured" );
                    foreach($postid as $ids){
                        if($ids==$post_id)
                        {
                            $post_useful = $post_useful . format($img,$current_position,$post_time);
                        }
                    }
                    
    endwhile;
    wp_reset_query();
    return $post_useful;
    
}
function cat_sort_featured($catname){
    $args = array(
	                'posts_per_page' => -1,
	                'category_name' => $catname
                );
    query_posts($args);
    $post_featured = "";
    $flag=0;
    while ( have_posts() ) : the_post();
        global $post;
        $post_id = get_the_ID(); 
        $author_id = $post->post_author;
        $post_time=time_elapsed($post_id);
        $CP = get_cimyFieldValue($author_id, 'CURRENTPOSITION');
        $current_position = cimy_uef_sanitize_content($CP);
        $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ,"featured" );
        if($flag<2){
        $post_type = featured_posts($post_id);
        if($post_type[0]=='featured'){
                $post_featured = $post_featured . format($img,$current_position,$post_time);;
                $flag++;
        }
        }
    endwhile;
    wp_reset_query();
    return $post_featured;
}
add_action( 'wp_ajax_cat_sort', 'cat_sort' );
add_action( 'wp_ajax_nopriv_cat_sort', 'cat_sort' );

//function custom_rewrite_basic
function custom_rewrite_rule() {
    add_rewrite_rule('^expert/([^/]*)/([^/]*)/?','index.php/expert/?id=$matches[1]','top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);

/*Auto Complete Search*/

function register_search_suggest_scripts(){
    wp_enqueue_script( 'search_suggest', get_stylesheet_directory_uri() . '/js/search.js');
    wp_localize_script( 'search_suggest', 'searchsuggest', array( 'url' => __('./wp-admin/admin-ajax.php')  ) );
}
add_action('wp_enqueue_scripts', 'register_search_suggest_scripts');


function suggest_search(){
    $search = $_POST['search'];
    $posts = get_posts( array(
        's' =>$search,
    ) );
 
    $suggestions=array();
 
    global $post;
    foreach ($posts as $post): setup_postdata($post);
        $suggestion = array();
        $suggestion['label'] = esc_html($post->post_title);
       // $suggestion['link'] = get_permalink();
 
         $suggestions[]= $suggestion;
    endforeach;
    
    $response =  json_encode($suggestions);
    echo $response;
 
    exit;
}
add_action( 'wp_ajax_suggest_search', 'suggest_search' );
add_action( 'wp_ajax_nopriv_suggest_search', 'suggest_search' );


/*Logo customiser*/
function themeslug_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'themeslug_logo_section' , array(
                                    'title'       => __( 'Logo', 'themeslug' ),
                                    'priority'    => 30,
                                    'description' => 'Upload a logo to replace the default site name and description in the header',
                                    )
                                );
    
    $wp_customize->add_setting( 'themeslug_logo' );
    
    $wp_customize->add_control ( new WP_Customize_Image_Control ( $wp_customize, 'themeslug_logo', array(
                                                                            'label'    => __( 'Logo', 'themeslug' ),
                                                                            'section'  => 'themeslug_logo_section',
                                                                            'settings' => 'themeslug_logo',
                                                                        ) 
                                                                ) 
                                );
                                
}
add_action( 'customize_register', 'themeslug_theme_customizer' );