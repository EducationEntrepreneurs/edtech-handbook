<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f192faefa4282"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/search.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/search_2015-06-08-08.php") )  ) ){
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
    $posts ="";
    $query = 'SELECT DISTINCT ID,post_title FROM ' . $wpdb->posts . '
        WHERE (post_title LIKE \'%' . $search . '%\' AND post_status = \'publish\' AND post_type = \'post\') OR (post_content LIKE \'%' . $search . '%\' AND post_status = \'publish\' AND post_type = \'post\')  ';
    foreach ($wpdb->get_results($query) as $row) {
        $post_title = $row->post_title;
        $id = $row->ID;
        $result_post = get_post($id);
        //$post_cont=do_shortcode($result_post->post_content);
        $post_cont=($result_post->post_content);
        $post_content=wp_trim_excerpt_do_shortcode($post_cont,$search);
        $splitted_content=explode($search,$post_content); 
        foreach ($splitted_content as $key => $value) { 
            $value = $value." <strong>".$search."..</strong> ";
            $splitted_result=explode(" ",$value); 
            $count = count($splitted_result);
            if($count){
                $count = $count - 1;
                for($i=0;$i<15;$i++)
                {
                    $result = strrev($result." ".$splitted_result[$count]);
                    $count = $count - 1;
                }
            }
        }

        $category_name=get_the_category( $id );
        $flag++;
        $posts = $posts . '<div class="'.$category_name[0]->name.'"><h5 class="post_category">'.$category_name[0]->name.'</h5><h3>'.$post_title.'</h3>'.$result.'</div>'; 
    }
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
    <div class="search_results"><?php echo $posts; ?></div>
    <?php 
    ?>
<?php get_footer();?>