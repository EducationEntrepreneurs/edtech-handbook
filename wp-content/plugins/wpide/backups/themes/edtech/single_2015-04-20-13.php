<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19588509a9b7"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/single.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/single_2015-04-20-13.php") )  ) ){
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
        <? $post_id=get_the_ID();
           $post_ID=array($post_id);
        ?>
        <div class="post-content">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
            <?php echo get_the_author(); ?> 
            <div class="featured-img"><?php if ( has_post_thumbnail() ){	the_post_thumbnail(); } ?></div>
            <?php  the_content(); ?>
            <?php
                    $post_categories = wp_get_post_categories( get_the_ID() );
                    foreach($post_categories as $category){
	                    $cat = get_category( $category );
	                    $cats = array( 'name' => $cat->name );
                   }
            ?>
            <div class="vote">
                <div class="vote_question">Was this article useful?</div>
                <div class="vote_answer"> 
                    <input type="button" name="Yes" Value="Yes" onclick='.<?php vote_count($post_id); ?>.'>
                    <input type="button" name="No" Value="No" onclick='.<?php vote_count($post_id); ?>.'>
                </div>
            </div>
    <?php endwhile; ?>
            <div class="further">
            <?php query_posts(array('category_name'=>$cats['name'], 'posts_per_page' => 2, 'post__not_in'=>$post_ID));?>
            <?php if ( have_posts() ) :?><h3>Further reading</h3> <?php  while ( have_posts() ) : the_post(); ?>
                <p> <?php if($cats['name']=='Explore') { ?><i class="fa fa-lightbulb-o"></i><?php } 
                            elseif($cats['name']=='Validate') { ?><i class="fa fa-comments"></i><?php } 
                            elseif($cats['name']=='Build') { ?><i class="fa fa-user"></i><?php }
                            elseif($cats['name']=='Grow') { ?><i class="fa fa-leaf"></i><?php }
                            else { ?><i class="fa fa-hand-o-right"></i><?php } ?>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </p>

            <?php  endwhile; endif; wp_reset_query(); ?>    
            </div>
        </div>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div class="post-sidebar">
             <h3>Jump to section</h3>
            <ul>
            <?php 
                $on_page_links = get_post_meta( get_the_ID(), 'jump_to_section_link'); 
                foreach($on_page_links as $link)
                    echo $link;
            ?>
            </ul>
        </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>
