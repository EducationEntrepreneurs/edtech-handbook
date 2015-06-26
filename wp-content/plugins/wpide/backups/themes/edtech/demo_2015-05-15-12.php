<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19f50f6f6fc6"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/demo.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/demo_2015-05-15-12.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php                
                    $tab=$_GET['value'];
                    switch($tab){
                        
                     case 'featured':
                        ?>  <div class="featured">    
                                <?php echo cat_sort_featured($category_name,$paged,'featured'); ?>
                            </div>
                        
                        <?php break;
                        
                     case 'recent':    
                         ?> <div class="recent">
                                <?php echo cat_sort_recent($category_name,$paged,'recent'); ?>
                            </div>
                         <?php break;
                    
                     case 'useful':    
                         ?> <div class="useful">
                                <?php echo cat_sort_useful($category_name,$paged,'useful'); ?>
                            </div>
                         <?php break;
                         
                     default:
                        ?>  <div class="featured">    
                                <?php echo cat_sort_featured($category_name,$paged,'featured'); ?>
                            </div>
                        
                        <?php break; 
                    }
?>