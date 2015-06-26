<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "34fd8828ed8a1f8bcdc8fbd371f54857edff84acba"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/single.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/single_2015-03-23-23.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php get_header(); ?>

<div class="single-post">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
                <div class="post-content">
    <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
    <?php 
    $author = get_the_author(); 
    echo $author;
    ?> 
            <div class="featured-img"><?php if ( has_post_thumbnail() ){	the_post_thumbnail(); } ?></div>
            <?php  the_content(); ?>
        </div>
        <div class="post-sidebar">
             <h3>Jump to section</h3>
        </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>
