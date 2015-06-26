<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f1901de0763db"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/category.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/category_2015-05-20-13.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><div id="sorting">
<?php 
get_header();
    foreach((get_the_category()) as $category) {
        $category_name=$category->cat_name; 
    } 
?>

    <div class="<?php echo  $category_name; ?>">
        <div class="category_name">   
            <?php  echo $category_name; ?>
        </div>
    </div>
    <div class="cat_desc">
        <?php echo category_description(); ?>
    </div>
    <?php $paged = $_GET['page']; ?>
    <div class="wrapper_left">
        <div class="cat_sort">
            <span>Sort by</span>
            <?php if($paged !=""){ ?>
                <select onchange="session_select();">
                <option value="featured">Featured</option>
                <option value="recent">Most Recent</option>
                <option value="useful">Most Useful</option>
            </select>
            <?php }else{ ?>
            <!--<select onchange="category_sorting('<?php  echo $category_name; ?>'); session_select();">
                <option value="featured">Featured</option>
                <option value="recent">Most Recent</option>
                <option value="useful">Most Useful</option>
            </select>-->
            <div class="btn-group">
                <button class="btn btn-default btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Large button 
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1">Action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1">Another action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1">Something else here</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1">Separated link</a></li>
                </ul>
            </div>
            <?php } ?>
        </div>
            
            <div class="cat_sort_title">
                <h2>Featured Resources</h2>
            </div>
            <div class="sort" id="sort">
                <?php
                    if($_GET['tab']!=""){
                        $tab=$_GET['tab'];
                    }else{
                        $tab=$_SESSION['selected_value'];
                    }
                    
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

            </div>
        <?php 
                if($_SESSION['selected_value']=="recent"){ ?>
                    <script>
                        jQuery(".featured").fadeOut("slow");
                        jQuery(".useful").fadeOut("slow");
                        jQuery(".cat_sort_title h2").html("Recent Resources");
                        jQuery(".cat_sort select").val('recent');
                        jQuery(".recent").fadeIn("slow");
                    </script>
                <?php }elseif($_SESSION['selected_value']=="useful"){ ?>
                    <script>
                        jQuery(".featured").fadeOut("slow");
                        jQuery(".recent").fadeOut("slow");
                        jQuery(".cat_sort_title h2").html("Useful Resources");
                        jQuery(".cat_sort select").val('useful');
                        jQuery(".useful").fadeIn("slow"); 
                    </script>
                <?php }else if($_SESSION['selected_value']=="featured"){ ?>
                    <script>
                        jQuery(".recent").fadeOut("slow");
                        jQuery(".useful").fadeOut("slow");
                        jQuery(".cat_sort_title h2").html("Featured Resources");
                        jQuery(".cat_sort select").val('featured');
                        jQuery(".featured").fadeIn("slow"); 
                    </script>
                <?php } else{}
                            
                ?>
    </div>
            
    <div class="hr-divider"><hr width="100%" /></div>
    <div class="wrapper_right">
        <div class="experts_info">
            <h3>Experts</h3>
            <?php $authorID=edtech_author($category_name); 
                  foreach($authorID as $author){
                     $author_name=get_the_author_meta('display_name' , $author );
                     $avatar=get_avatar($author,45);
                     $CP = get_cimyFieldValue($author, 'CURRENTPOSITION');
                     $current_position = cimy_uef_sanitize_content($CP);
                     ?><div class="author_info">
                            <div class="author_dp">
                                <?php echo $avatar;  ?>
                            </div>
                            <div class="author">                                
                                <p><a href="../../expert?id=<?php echo $author; ?>"><?php echo $author_name; ?></a></p>
                                <p><?php echo $current_position; ?></p>
                            </div>
                       
                        </div><?php
                 }?>
        </div>
        <div class="suggest">
            <?php dynamic_sidebar('sidebar-3'); ?>
        </div>
    </div>

<?php //session_destroy(); ?>

<?php get_footer(); ?>
</div>