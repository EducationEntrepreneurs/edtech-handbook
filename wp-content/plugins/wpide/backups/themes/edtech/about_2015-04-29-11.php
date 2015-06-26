<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19e47c853b3c"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/about.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/about_2015-04-29-11.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
/**
 * Template Name: About page Template
 */
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="about_title">
    <h1><?php the_title(); ?></h1>
</div>
<div class="wrapper_left">
    <div class="about_content">
        <?php the_content(); ?>
    </div>
</div>
<div class="wrapper_right">
    <div class="suggest">
        <?php dynamic_sidebar('sidebar-3'); ?>
    </div>
</div>
<div class="about_image">
    <?php the_post_thumbnail('large') ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>