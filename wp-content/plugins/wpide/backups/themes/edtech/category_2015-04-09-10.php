<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "97555ad40172e2ae2acf6e24b6801088f5f7ec64b5"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/category.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/category_2015-04-09-10.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
get_header();
    foreach((get_the_category()) as $category) {
        $category_name=$category->cat_name; 
    } 
?>
    <div class="category_name">
     <div class="cat <?php echo  $category_name; ?>">   <?php   if($category_name=='Explore') { ?><i class="fa fa-lightbulb-o fa-2x"></i><?php } 
                elseif($category_name=='Validate') { ?><i class="fa fa-comments fa-2x"></i><?php } 
                elseif($category_name=='Build') { ?><i class="fa fa-user fa-2x"></i><?php }
                elseif($category_name=='Grow') { ?><i class="fa fa-leaf fa-2x"></i><?php }
                else { ?><i class="fa fa-hand-o-right fa-2x"></i><?php }
            echo $category_name;
        ?>
        </div>
    </div>
   
<?php while ( have_posts() ) : the_post(); ?>

<?php endwhile; ?>
<?php get_footer(); ?>