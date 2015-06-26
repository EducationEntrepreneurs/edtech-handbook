<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f192ac6b1a13c"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/search.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/search_2015-06-04-14.php") )  ) ){
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
    $query = 'SELECT ID,post_title FROM ' . $wpdb->posts . '
        WHERE post_title LIKE \'%' . $search . '%\'
        OR post_content LIKE \'%'. $search . '%\'
        AND post_status = \'publish\' ';
    foreach ($wpdb->get_results($query) as $row) {
        $post_title = $row->post_title;
        $id = $row->ID;
        $result_post = get_post($id);
        $post_cont=do_shortcode($result_post->post_content);
        $post_content=wpautop( $post_cont );// apply_filters('the_content', $post_cont->post_content);
        $flag++;
        $posts = $posts . '<div><h4>'.$post_title.'</h4>'.$post_content.'</p></div>'; 
    }
?>    

    <div class="search_desc">
        <?php 
            if($flag>1){
                $search_result = $flag." results for '".$search."'";  
            }else{
                 $search_result = $flag." result for ".$search;
            }
        ?>
        <p><?php echo $search_result;  ?></p>
    </div>
    <div style="clear:both"></div>
    <div><?php echo esc_html($posts); ?></div>

<?php get_footer();?>