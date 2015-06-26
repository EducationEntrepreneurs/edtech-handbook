<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19f5f7ec64b5"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/category.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/category_2015-04-09-12.php") )  ) ){
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

        <div class="<?php echo  $category_name; ?>">
            <div class="category_name">   
                <?php  echo $category_name; ?>
            </div>
        </div>
        <div class="cat_desc">
            <?php echo category_description(); ?>
        </div>

    <?php echo edtech_author($category_name); ?>


<?php while ( have_posts() ) : the_post(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>