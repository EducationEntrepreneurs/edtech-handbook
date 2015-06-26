<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f193d94a8d34e"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/functions_2015-06-12-05.php") )  ) ){
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
wp_enqueue_script( 'edtech', get_template_directory_uri() . '/js/edtech.js' );
wp_enqueue_script('suggest');
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
    static $link_array= array();
    delete_post_meta($post_id, 'jump_to_section_link');
    array_push($link_array,$section_links);
    $final_link="";
    foreach($link_array as $link){
       $final_link.=$link;
    }
    update_post_meta($post_id,'jump_to_section_link',$final_link);
    if(empty($link_array)){
        delete_post_meta($post_id, 'jump_to_section_link');
    }
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
else{
   $text = search_result($text);
}
return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

function search_result($text){
        $text = do_shortcode( $text ); 
//$text = apply_filters('the_content', $text);
$text = str_replace(']]>', ']]&gt;', $text);
$text = str_replace("<h3>","",$text);
$text = strip_tags($text);
/*$i=0;
$j=0;
$flag=0;
        $length=0;
$val="";
$lastPos = 0;
        $positions = array();
        while (($lastPos = strpos($text, $s, $lastPos))!== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($s);
        }
        $max = count($positions);
        foreach ($positions as $key => &$value) {
                $value=$value+$i*7;
                if($value>30 && $value>$j+30){
                    $length = $value-15;
                    $next=$positions[$key+1];
                    $next=$next-($value-15)+2;
                    $positions[$key+1]=$next;
                    $text = substr_replace($text,'..',$j,$length);
                    $value=$value-($value-15)+2;
                }
                $put="<b>";
                $text = putinplace($text, $put, $value);
                $put="</b>";
                $val=$value+strlen($s)+3;
                $text = putinplace($text, $put, $val);
                $i++;
                $j=$j+$value+$i*7+15;
        }*/
        $excerpt_length = apply_filters('excerpt_length', 100);
$excerpt_more = apply_filters('excerpt_more', ' ' . '...');
$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
if ( count($words) > $excerpt_length ) {
array_pop($words);
$text = implode(' ', $words);
   $text = $text . $excerpt_more;
} else {
$text = implode(' ', $words);
}
return $text;
}

function putinplace($string=NULL, $put=NULL, $position=false)
{
    $d1=$d2=$i=false;
    $d=array(strlen($string), strlen($put));
    if($position > $d[0]) $position=$d[0];
    for($i=$d[0]; $i >= $position; $i--) $string[$i+$d[1]]=$string[$i];
    for($i=0; $i<$d[1]; $i++) $string[$position+$i]=$put[$i];
    return $string;
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

function existing_products($postID){
    $existing = get_post_meta($postID,'Existing');
    $link = get_post_meta($postID,'link_to_external_resource');
    if(!empty($existing)){
        return $existing[0][0].';'.$link[0];    
    }
}


function time_elapsed($post_id){
    $unix_post_time =get_post_time(true,$post_id);
    $post_time=date("F j, Y",$unix_post_time);
    return $post_time;
}

/*Vote Script*/
function vote_counts()
{
    global $post;
    //register_meta('post', 'vote_counts_yes', 'vote_counts_func');
    add_post_meta($post->ID, 'vote_count_yes', '0');
    add_post_meta($post->ID, 'vote_count_no', '0');
    add_meta_box( 'vote_count_yes', 'Vote Count Yes', 'post', 'normal', 'high' );
    add_meta_box( 'vote_count_no', 'Vote Count No', 'post', 'normal', 'high' );
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
add_action('admin_enqueue_scripts', 'register_cat_sort_script');

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


function get_max_pages($post_count,$first_page_post,$sub_page_post){
    return (ceil(($post_count-$first_page_post)/$sub_page_post)+1);
}

function format($img,$current_position,$post_time){
    
    if($img[0]!=""){
        $imagepath = '<div class="post_image"><a href="'.get_post_permalink().'"><img src="'.$img[0].'" /></a></div>';    
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
                            <div class="post_title"><a href="'.get_post_permalink().'"><h3>'.$title.'</h3></a></div>
                            <div class="author_info">
                                <div class="author_dp">
                                     <a href="../../expert?id='.get_the_author_meta( 'ID' ).'">'.get_avatar( get_the_author_meta( 'ID' ), 45 )
                                .'</a></div>
                                <div class="author">                                
                                    <a href="../../expert?id='.get_the_author_meta( 'ID' ).'">
                                        <p>'.get_the_author().'</p>
                                        <p>'.$current_position.'</p>
                                    </a>
                                </div>
                            </div>
                            <div class="post_content"><a href="'.get_post_permalink().'"><p>'.get_the_excerpt().'</p></a></div>
                        </div>';
}


function all_posts($postid_array,$posttype,$page,$category_name,$select){
    
                if($page!="")
                {
                    $posttype ="";
                    
                }
                
                $first_page_post_count = 4;
                $subsequent_pages_post_count = 8;
                $paged=$page;
                if($paged > 1){
                // not first page
               $posts_per_page = $subsequent_pages_post_count;
                        if($paged == 2){
                   // second page
                   $offset = $first_page_post_count;
                   } 
                   else{
                    // subsequent pages
                   $offset = $first_page_post_count + ($subsequent_pages_post_count * ($paged - 2));
                   }
                } 
                else{
               // first page
               $offset = 0;
               $posts_per_page = $first_page_post_count;
                }
                
if($select=="useful"){
$args = array(
'posts_per_page' => $posts_per_page,
'paged' => $paged,
'offset' => $offset,
'category_name' => $category_name,
'meta_key' => 'vote_count_yes',
'orderby'   => 'meta_value_num',
'post__not_in'=>$postid_array
);
}else{
$args = array(
'posts_per_page' => $posts_per_page,
'paged' => $paged,
'offset' => $offset,
'category_name' => $category_name,
'post__not_in'=>$postid_array
);
}
//$post_count = wp_count_posts();
                //$total_posts = $post_count->publish;
                $wp_query = new WP_Query($args);
                $total_posts = $wp_query->found_posts;
                $total_pages = get_max_pages($total_posts,$first_page_post_count,$subsequent_pages_post_count);
             
        $post_matter = "";
        $all_posts_start = '<div class="all_post">';
            
        query_posts($args);
        while ( have_posts() ) : the_post();
            $post_id = get_the_ID();
            $author_id = $post->post_author;
            $post_time=time_elapsed($post_id);
            $CP = get_cimyFieldValue($author_id, 'CURRENTPOSITION');
            $current_position = cimy_uef_sanitize_content($CP);
            $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'thumbnail' );
            $post_time=time_elapsed(get_the_ID());
            
            if($img[0]!=""){
                $imagepath = '<div class="post_image"><a href="'.get_post_permalink().'"><img src="'.$img[0].'" /></a></div>';    
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
            
                    $post_matter = $post_matter.'<div class="cat_posts">
                                            <div class="post_time">'.$post_time.'</div>
                                            <div class="post_title">
                                                <a href="'.get_post_permalink().'"><h3>'.$title.'</h3></a>
                                            </div>
                                            <div class="author_info">
                                                <div style="float:left">
                                                    <div class="author_dp">
                                                        <a href="../../expert?id='.get_the_author_meta( 'ID' ).'">'.get_avatar( get_the_author_meta( 'ID' ), 32 ).'</a>
                                                    </div>
                                                    <div class="author">
                                                        <a href="../../expert?id='.get_the_author_meta( 'ID' ).'">'.get_the_author().'</a>
                                                    </div>
                                                </div>
                                                <div class="useful-vote">
                                                    <i class="fa fa-thumbs-up">Useful:'.intval(get_post_meta(get_the_ID(),'vote_count_yes',true)).' votes</i>
                                                </div>
                                            </div>
                                            <div class="post_data">
                                                    '.$imagepath.'
                                                <div class="post_content">
                                                    <a href="'.get_post_permalink().'"><p>'.get_the_excerpt().'</p></a>
                                                </div>
                                            </div>
                                        </div>';
                
            endwhile;
            $all_posts_end = '</div>';            
            
            $pagination_div_start = '<div class="pagination">
                                    '.paginate_links( array(
                                                'format' => '?page=%#%',
                                           'current' => max( 1, get_query_var('paged') ),
                                           'end_size'=>2,
                                           'mid_size'=>2,
                                           'total' => $total_pages,
                                           ) );
                          
            $pagination_div_end = wp_reset_query().'</div>';
            
           return $posttype.'<div class="hr-divider"><hr width="100%" /></div>'.$all_posts_start.$post_matter.$all_posts_end.$pagination_div_start.$pagination_div_end;
} 

if (!session_id()) {
    session_start();
}
function select_session(){
    $selected_value = $_POST['val'];
    $_SESSION['selected_value']=$selected_value;
    echo $_SESSION['selected_value'];
    // You can use $_SESSION['selected_value']; anywhere in category.php file
    exit;
}
add_action( 'wp_ajax_select_session', 'select_session' );
add_action( 'wp_ajax_nopriv_select_session', 'select_session' );

function cat_sort_recent($catname,$page,$select){
    $args = array(
               'posts_per_page' => 2,
               'category_name' => $catname
                );
    $post_recent = "";
    $variable_post_ID=array();
    query_posts($args);
    while ( have_posts() ) : the_post();
                    global $post;
                    $post_id = get_the_ID();
                    array_push($variable_post_ID,$post_id);
                    $author_id = $post->post_author;
                    $post_time=time_elapsed($post_id);
                    $CP = get_cimyFieldValue($author_id, 'CURRENTPOSITION');
                    $current_position = cimy_uef_sanitize_content($CP);
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ,"featured" );
                    $post_recent = $post_recent . format($img,$current_position,$post_time);
    endwhile;
    wp_reset_query();
    $posts=all_posts($variable_post_ID,$post_recent,$page,$catname,$select);
    return $posts;
}

function cat_sort_useful($catname,$page,$select){
    $args = array(
                'posts_per_page' => -1,
                'category_name' => $catname,
                'meta_key' => 'vote_count_yes',
                'orderby'   => 'meta_value_num'
               
                );
    $post_useful = "";
    query_posts($args);
    $variable_post_ID=array();
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
                            array_push($variable_post_ID,$post_id);
                            $post_useful = $post_useful . format($img,$current_position,$post_time);
                        }
                    }
                    
    endwhile;
    wp_reset_query();
    $posts=all_posts($variable_post_ID,$post_useful,$page,$catname,$select);
    return $posts;
    
}
function cat_sort_featured($catname,$page,$select){
    $args = array(
               'posts_per_page' => -1,
               'category_name' => $catname
                );
    query_posts($args);
    $variable_post_ID=array();
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
        $post_type = featured_posts($post_id);
        if($post_type[0]=='featured' && $flag<2){
            array_push($variable_post_ID,$post_id);
            $post_featured = $post_featured . format($img,$current_position,$post_time);
            $flag++;
        }
    endwhile;
    wp_reset_query();
    $posts=all_posts($variable_post_ID,$post_featured,$page,$catname,$select);
    return $posts;
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
    wp_localize_script( 'search_suggest', 'searchsuggest', array( 'url' => admin_url('admin-ajax.php')  ) );
}
add_action('wp_enqueue_scripts', 'register_search_suggest_scripts');
add_action('admin_enqueue_scripts', 'register_search_suggest_scripts');


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



function se_wp_head() {
?>
    <script type="text/javascript">
        var se_ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';

        jQuery(document).ready(function() {
            jQuery('.search').suggest(se_ajax_url + '?action=se_lookup', {
                onSelect: function() {
                    jQuery(this).focus();
                }
            });
        });

    </script>
<?php
}
add_action('wp_head', 'se_wp_head');
  
function se_lookup() {
    global $wpdb, $wp_query;

    $search = like_escape($_REQUEST['q']);

    $query = 'SELECT DISTINCT ID,post_title FROM ' . $wpdb->posts . '
        WHERE (post_title LIKE \'%' . $search . '%\' AND post_status = \'publish\' AND post_type = \'post\') OR (post_content LIKE \'%' . $search . '%\' AND post_status = \'publish\' AND post_type = \'post\') ';
    foreach ($wpdb->get_results($query) as $row) {
        $post_title = $row->post_title;
        $id = $row->ID;
        echo $post_title."\n";
       
    }
    die();
}
add_action('wp_ajax_se_lookup', 'se_lookup');
add_action('wp_ajax_nopriv_se_lookup', 'se_lookup');

function search_format($img,$current_position,$category_name){
    
    if($img[0]!=""){
        $imagepath = '<div class="post_image"><a href="'.get_post_permalink().'"><img src="'.$img[0].'" /></a></div>';    
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
                            <div class="'.$category_name.'"><h5 class="post_category">'.$category_name.'</h5></div>
                            <div class="post_title"><a href="'.get_post_permalink().'"><h3>'.$title.'</h3></a></div>
                            <div class="author_info">
                                <div class="author_dp">
                                     <a href="../../expert?id='.get_the_author_meta( 'ID' ).'">'.get_avatar( get_the_author_meta( 'ID' ), 45 )
                                .'</a></div>
                                <div class="author">                                
                                    <a href="../../expert?id='.get_the_author_meta( 'ID' ).'">
                                        <p>'.get_the_author().'</p>
                                        <p>'.$current_position.'</p>
                                    </a>
                                </div>
                            </div>
                            <div class="post_content"><a href="'.get_post_permalink().'"><p>'.get_the_excerpt().'</p></a></div>
                        </div>';
}

function search_featured($catname){
    static $variable_post_ID=array();
    $args = array(
	                'posts_per_page' => -1,
	                'category_name' => $catname,
	                'post__not_in'=>$variable_post_ID
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
        $post_type = featured_posts($post_id);
        if($post_type[0]=='featured' && $flag<1){
            array_push($variable_post_ID,$post_id);
            $post_featured = $post_featured . search_format($img,$current_position,$catname);
            $flag++;
        }
    endwhile;
    wp_reset_query();
    return $post_featured;
}

function test($text,$s){
        $lastPos = 0;
        $length=0;
        $positions = array();
        $j=0;
        while (($lastPos = strpos($text, $s, $lastPos))!== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($s);
        }
        $max = count($positions);
        foreach ($positions as $key => &$value) {
                    $length = ($value - 20) - $j;
                    if($key==$max){
                        $text = substr_replace($text,'...',$j,-1);
                    }else{
                        $text = substr_replace($text,'..',$j,$length);
                    }
                    
                    //$positions[$key]=($value-$length)  + 2;
                    for($i=($key);$i<=$max;$i++){
                        $next=$positions[$i];
                        $next=$next-$length+2;
                        $positions[$i]=$next;
                    }
                    $j=$value +  strlen($s) + 10;
        }
        return $text;
        array_pop($positions);       
        $i=0;
        foreach ($positions as $value){
                /*$value=$value+$i*7;
                $put="<b>";
                $text = putinplace($text, $put, $value);
                $put="</b>";
                $val=$value+strlen($s)+3;
                $text = putinplace($text, $put, $val);
                $i++; */
                echo $value;
        }
        //return $text;
}