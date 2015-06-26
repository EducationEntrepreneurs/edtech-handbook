<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f1997ec9f3387"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/category.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/category_2015-04-09-13.php") )  ) ){
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
    <div class="wrapper_left">
        <div class="featured">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="featured_res"></div>
            <?php endwhile; ?>
        </div>
        <hr size="3px" width="100%" />
        <div class="all_post">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="cat_posts">
                    <div class="post_title"><h4><?php the_title(); ?></h4></div>
                    <div class="author_info">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                        <?php echo get_the_author(); ?> 
                    </div>
                    <div class="post_data">
                        <div class="post_image">
                            <?php   if ( has_post_thumbnail() ){
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ,'thumbnail' );
                                    }
                            ?>      <img src="<?php echo $image[0]; ?>" width="150px" height="150px" />
                        </div>
                        <div class="post_content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="wrapper_right">
        <div class="experts_info"></div>
        <div class="suggest"></div>
    </div>


<?php get_footer(); ?>