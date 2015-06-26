<?php               
                    //define("WP_USE_THEMES",true);
                    include("../../../wp-blog-header.php");
                    $tab=$_GET['tab'];
                    if($_GET['page']!=""){
                        ?><script>
                            window.location='http://dev.anzum.in/edtech/phases/explore/?page=2';
                        </script>
                        <?php
                    }else{
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
                    }
?>