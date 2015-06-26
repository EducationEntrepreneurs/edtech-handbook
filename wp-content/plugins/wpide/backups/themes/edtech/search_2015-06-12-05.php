<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f193d94a8d34e"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/search.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/search_2015-06-12-05.php") )  ) ){
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
    $posts = array();
    $query = 'SELECT DISTINCT ID,post_title FROM ' . $wpdb->posts . '
        WHERE (post_title LIKE \'%' . $search . '%\' AND post_status = \'publish\' AND post_type = \'post\') OR (post_content LIKE \'%' . $search . '%\' AND post_status = \'publish\' AND post_type = \'post\')  ';
    foreach ($wpdb->get_results($query) as $row) {
        $post_title = $row->post_title;
        $id = $row->ID;
        $permalink = get_permalink( $id );
        $result_post = get_post($id);
        //$post_cont=do_shortcode($result_post->post_content);
        $post_cont=($result_post->post_content);
        $post_content=wp_trim_excerpt_do_shortcode($post_cont);
        $splitted_content=explode($search,$post_content,-1); 
        if(empty($splitted_content)){
            $result = $post_content;
           /* $splitted_result=explode(" ",$post_content); 
            $count = count($splitted_result);
            if($count && $counter<4){
                for($i=20;$i>0;$i--)
                {
                    $result = $result." ".$splitted_result[($count-$i)];
                }
                $counter++;
            }*/
        }else{
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
    
        }
        
        $category_name=get_the_category( $id );
        $flag++;
        $search_items = '<a href="'.$permalink.'"><div class="'.$category_name[0]->name.'"><h5 class="post_category">'.$category_name[0]->name.'</h5><h3>'.$post_title.'</h3><p>'.$result.'</p></div></a>'; 
        array_push($posts,$search_items);
    }
    
    
    if($flag>0){ ?>
        <?php 
            $page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
            $total = count( $posts ); //total items in array    
            $limit = 4; //per page    
            $totalPages = ceil( $total/ $limit ); //calculate total pages
            $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
            $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
            $offset = ($page - 1) * $limit;
            if( $offset < 0 ){
                $offset = 0;  
            } 
            $posts = array_slice( $posts, $offset, $limit );
            
        ?>
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
        <div class="wrapper_left">
            <div class="search_results">
                <?php   foreach($posts as $post){ echo $post; }  ?>
            </div>
            <div style="clear:both"></div>
        <?php
            $link = './?s='.$search.'&page=%d';
            $prev_link = './?s='.$search;
            $pages_link = './?s='.$search.'&page=';
            $pagerContainer = '<div class="pagination">';   
            if( $totalPages != 0 ) 
            {
                if( $page == 1 ) 
                {   
                    
                    $counter=1;
                    for($i=$page;$i<$totalPages;$i++){
                        if($counter<= 2 || $i>($totalPages-3)){   
                            $pages_link=$pages_link.($i+1);
                            $next_pages.='<a class="page-numbers" href="'.$pages_link.'">'.($i+1).'</a>&nbsp;';
                            $pages_link = './?s='.$search.'&page=';
                        }elseif($counter == 3){
                            $pages_link= '<span class="page-numbers dots">…</span>';
                            $next_pages.=$pages_link.'&nbsp;';
                            $pages_link = './?s='.$search.'&page=';
                        }
                        $counter++;
                    }
                    $pagerContainer .= sprintf('<span class="page-numbers current">'.$page.'</span>&nbsp;'.$next_pages ); 
                }
                else if($page==2){
                    $counter=1;
                    
                    for($i=$page;$i<$totalPages;$i++){
                        if($counter<= 2 || $i>($totalPages-3)){
                            $pages_link=$pages_link.($i+1);
                            $next_pages.='<a class="page-numbers" href="'.$pages_link.'">'.($i+1).'</a>&nbsp;';
                            $pages_link = './?s='.$search.'&page=';
                        }elseif($counter == 3){
                            $pages_link= '<span class="page-numbers dots">…</span>';
                            $next_pages.=$pages_link.'&nbsp;';
                            $pages_link = './?s='.$search.'&page=';
                        }
                        $counter++;
                    }
                    $prev_pages='<a class="page-numbers" href="'.$prev_link.'">1</a>&nbsp;';
                    $pagerContainer .= sprintf( '<a class="prev page-numbers" href="'.$prev_link.'">« Previous</a>&nbsp;',$page - 1);
                    $pagerContainer .=sprintf( $prev_pages.'<span class="page-numbers current">'.$page.'</span>&nbsp;'.$next_pages);
                }
                else 
                { 
                    $counter=1;
                    for($i=$page;$i<$totalPages;$i++){
                        if( ($counter<=2) || ($i>($totalPages-3)) ){
                            $pages_link=$pages_link.($i+1);
                            $next_pages.='<a class="page-numbers" href="'.$pages_link.'">'.($i+1).'</a>&nbsp;';
                            $pages_link = './?s='.$search.'&page=';
                        }elseif($counter == 3){
                            $pages_link= '<span class="page-numbers dots">…</span>';
                            $next_pages.=$pages_link.'&nbsp;';
                            $pages_link = './?s='.$search.'&page=';
                        }
                        $counter++;
                    }
                    $counter=1;
                    for($j=1;$j<$page;$j++){
                        if( ($counter<=2) || ($counter>($page-3)) ){
                            if($j==1){
                                $prev_pages .='<a class="page-numbers" href="'.$prev_link.'">'.$j.'</a>&nbsp;';
                            }else{
                                $pages_link=$pages_link.$j;
                                $prev_pages .='<a class="page-numbers" href="'.$pages_link.'">'.$j.'</a>&nbsp;';
                                $pages_link = './?s='.$search.'&page=';
                            }
                        }elseif($counter==($page-3)){
                                $pages_link= '<span class="page-numbers dots">…</span>';
                                $prev_pages.=$pages_link.'&nbsp;';
                                $pages_link = './?s='.$search.'&page=';
                        }
                        $counter++;
                    }
                    $pagerContainer .= sprintf( '<a class="prev page-numbers" href="'.$link.'">« Previous</a>&nbsp;',$page - 1);
                    $pagerContainer .=sprintf( $prev_pages.'<span class="page-numbers current">'.$page.'</span>&nbsp;'.$next_pages);
                }
                if( $page == $totalPages ) 
                { 
                    
                    $pagerContainer .= ''; 
                }
                else 
                { 
                    $pagerContainer .= sprintf( '<a class="prev page-numbers" href="'.$link.'">Next »</a>', $page + 1 ); 
                }           
            }                   
           
            echo $pagerContainer;
        ?>
        </div>
    <?php } else{ ?>
        <div class="search_desc">
            <p><?php echo "Oops, we couldn’t find any results for "."\"". $search."\"";  ?></p>
        </div>
        <div style="clear:both"></div>
        <div class="wrapper_left">
            <div class="search-ideas">
                <h2>Try some of these search ideas:</h2>
                <ul>
                    <li>Check your spelling one more time</li>
                    <li>Use single words (e.g., <span>teachers, recruiting</span>)</li>
                    <li>Be less specific</li>
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
            /*$key = array_rand($cat_array);
            $cat_name_one = $cat_array[$key];
        
            $featured_one = search_featured($cat_name_one); 

            $key = array_rand($cat_array);
            $cat_name_two = $cat_array[$key];
            
            $featured_two = search_featured($cat_name_two); */
            
            for($key = array_rand($cat_array);$featured_two=="";$key = array_rand($cat_array)){
                $cat_name_two = $cat_array[$key];
                $featured_two = search_featured($cat_name_two); 
            }
            for($key = array_rand($cat_array);$featured_one=="";$key = array_rand($cat_array)){
                $cat_name_one = $cat_array[$key];
                $featured_one = search_featured($cat_name_one);
            }
            
           /* if($featured_one==""){
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
            }*/
        ?>
        
            <h2>Featured Resources</h2>
            <div class="search_res">
                <?php
                    echo $featured_one;
                    echo $featured_two;
                ?>
            </div>
        </div>
    <?php } ?>
    <?php 
        $text = "Lorem ipsum dolor sit amet lorem iipsum jaadu dolor ipsum lorem dolor amet lorem ipsum dolor sit amet dolor sit ipsum amet lorem lorem dolor ipsum jaadu dolor ipsum lorem dolor amet lorem ipsum dolor sit amet dolor sit ipsum amet lorem lorem dolor ipsum dolor sit ipsum amet lorem lorem dolor ipsum jaadu  dolor sit ipsum amet lorem lorem dolor ipsum";
        $s="jaadu";
        //echo test($text,$s);
    ?>
<?php get_footer();?>