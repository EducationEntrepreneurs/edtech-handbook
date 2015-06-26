<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f192ac6b1a13c"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/search.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/search_2015-06-04-13.php") )  ) ){
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
<div class="search_desc">
        4 results for “talking to teachers
</div>
<br/><br/><br/><br/><br/><br/><br/><br/>
<div>
<?php
     $search = like_escape($_REQUEST['s']);

    $query = 'SELECT ID,post_title FROM ' . $wpdb->posts . '
        WHERE post_title LIKE \'%' . $search . '%\'
        AND post_status = \'publish\' ';
    foreach ($wpdb->get_results($query) as $row) {
        $post_title = $row->post_title;
        $id = $row->ID;
        $post_count = $wpdb->get_var("
                SELECT COUNT(*) FROM $wpdb->postmeta
                WHERE post_id = $id
                ");
        echo $post_title . ' (' . $post_count . ')' . "\n";
    //}
         //echo  $post_title."\n";
    }
?>
</div>
<?php get_footer();?>