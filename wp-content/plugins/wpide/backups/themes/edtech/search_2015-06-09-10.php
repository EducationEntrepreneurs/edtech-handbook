<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19f1e9d237e7"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/search.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/search_2015-06-09-10.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
/**
 * Template Name: Search Page Template
 */
get_header();
?>
<div class="search-icon">
        <div class="search_page">Search</div>
</div>
<?php
    $search = like_escape($_REQUEST['s']);
    $flag=0;
    $counter=0;
    $posts ="";
    $query = 'SELECT DISTINCT ID,post_title FROM ' . $wpdb->posts . '
        WHERE (post_title LIKE \'%' . $search . '%\' AND post_status = \'publish\' AND post_type = \'post\') OR (post_content LIKE \'%' . $search . '%\' AND post_status = \'publish\' AND post_type = \'post\')  ';
    foreach ($wpdb->get_results($query) as $row) {
        $post_title = $row->post_title;
        $id = $row->ID;
        $result_post = get_post($id);
        //$post_cont=do_shortcode($result_post->post_content);
        $post_cont=($result_post->post_content);
        $post_content=wp_trim_excerpt_do_shortcode($post_cont);
        $splitted_content=explode($search,$post_content); 
        foreach ($splitted_content as $key => $value) { 
            $value = $value." <strong>".$search."..</strong> ";
            $splitted_result=explode(" ",$value); 
            $count = count($splitted_result);
            if($count && $counter<4){
                for($i=20;$i>0;$i--)
                {
                    $result = $result." ".$splitted_result[($count-$i)];
                }
                $counter++;
            }
        }

        $category_name=get_the_category( $id );
        $flag++;
        $posts = $posts . '<div class="'.$category_name[0]->name.'"><h5 class="post_category">'.$category_name[0]->name.'</h5><h3>'.$post_title.'</h3>'.$result.'</div>'; 
    }
    
    
    if($flag>0){ ?>
    
        <div class="search_desc">
            <?php 
                if($flag>1){
                    $search_result = $flag." results for '".$search."'";  
                }else{
                    $search_result = $flag." result for '".$search."'";
                }
            ?>
            <p><?php echo $search_result;  ?></p>
        </div>
        <div style="clear:both"></div>
        <div class="search_results"><?php echo $posts; ?></div>
        
    <?php } else{ ?>
        <div class="search_desc">
            <p><?php echo "Oops, we couldn’t ﬁnd any results for "."\"". $search."\"";  ?></p>
        </div>
        <div style="clear:both"></div>
        <div class="search-ideas">
            <h2>Try some of these search ideas:</h2>
            <ul>
                <li>Check your spelling one more time</li>
                <li>Use single words (e.g., <span>teachers, recruiting</span>)</li>
                <li>Be less speciﬁc</li>
                <li>Browse the <span>phases</span> for inspiration</li>
            </ul>
            <div id="search">
                <div class="form-group has-success has-feedback">
        	        <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
        <?php
            $cat_array = array("Explore","Validate","Growth","Build");
            $key = array_rand($cat_array);
            $cat_name_one = $cat_array[$key];
            echo $cat_name_one;    
            $featured_one = search_featured($cat_name_one); 

            $key = array_rand($cat_array);
            $cat_name_two = $cat_array[$key];
            echo $cat_name_two;       
            $featured_two = search_featured($cat_name_two); 
            
            if($featured_one==""){
                if($featured_two==""){
                    for($key = array_rand($cat_array);$featured_two=="";$key = array_rand($cat_array)){
                        $cat_name_two = $cat_array[$key];
                        $featured_two = search_featured($cat_name_two); 
                    }
                    for($key = array_rand($cat_array);$featured_one=="";$key = array_rand($cat_array)){
                        $cat_name_one = $cat_array[$key];
                        $featured_one = search_featured($cat_name_one);
                    }
                }
                else{
                    for($key = array_rand($cat_array);$featured_one=="";$key = array_rand($cat_array)){
                        $cat_name_one = $cat_array[$key];
                        $featured_one = search_featured($cat_name_one);
                    }
                }
            }else if($featured_two==""){
                for($key = array_rand($cat_array);$featured_two=="";$key = array_rand($cat_array)){
                    $cat_name_two = $cat_array[$key];
                    $featured_two = search_featured($cat_name_two); 
                }
            }
        ?>
        <div class="wrapper_left">
            <h2>Featured Resources</h2>
            <div class="search_res">
                <?php
                    echo $featured_one;
                    echo $featured_two;
                    //echo search_featured();
                ?>
            </div>
        </div>
    <?php } ?>
<?php get_footer();?>