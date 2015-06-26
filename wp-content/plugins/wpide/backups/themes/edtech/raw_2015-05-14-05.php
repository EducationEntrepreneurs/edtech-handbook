<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19e88604f605"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/raw.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/raw_2015-05-14-05.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?>               $args = array(
	                'posts_per_page' => $posts_per_page,
	                'paged' => $paged,
	                'offset' => $offset,
	                'category_name' => $category_name,
	                'meta_query' => array(
                                        array(
                                            'order'   => 'ASC',
                                            'key'     => 'vote_count_yes',
                                            'value'   => serialize(strval('featured')),
                                            'compare' => 'LIKE',
                                        ),
                                    )
                );
                
                
                
                                $args = array(
	                'posts_per_page' => $posts_per_page,
	                'paged' => $paged,
	                'offset' => $offset,
	                'category_name' => $category_name,
	                'order'   => 'DSC',
	                'meta_key' => 'vote_count_yes',
                    'orderby'   => 'meta_value_num'
                );