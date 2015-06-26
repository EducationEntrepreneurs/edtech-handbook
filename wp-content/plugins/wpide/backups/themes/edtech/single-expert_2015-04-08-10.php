<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "b5b36394a2b09f8ef6155ad17086bee773aee73871"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/single-expert.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/single-expert_2015-04-08-10.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/*
Single Post Template: [Expert]
*/
get_header(); ?>

<div class="single-post">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>

        <div class="post-content">
            <?php  the_content(); ?>
        </div>

    <?php endwhile; ?>
</div>
<?php get_footer(); ?>