<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f199cc3fca3d9"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/single.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/single_2015-04-24-10.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php get_header(); ?>

<div class="single-post">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <?php
                    $post_categories = wp_get_post_categories( get_the_ID() );
                    foreach($post_categories as $category){
	                    $cat = get_category( $category );
	                    $cats = array( 'name' => $cat->name );
                   }
                   $catname=strtolower($cats['name']);
            ?>
        <span class="map"><a class="single_map">Phases</a><a href="../phases/<?php echo $catname;  ?>" class="<?php echo $cats['name']; ?>"><?php echo $cats['name']; ?></a></span>
        <h1><?php the_title(); ?></h1>
        <?php 
            $post_id=get_the_ID();
            $ip = get_ip();
            $post_ID=array($post_id);
            $CP = get_cimyFieldValue(get_the_author_meta( 'ID' ), 'CURRENTPOSITION');
            $current_position = cimy_uef_sanitize_content($CP);
        ?>
        <div class="post-content">
            <div class="author_dp">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 45 );  ?>
            </div>
            <div class="author">                                
                <p><?php echo get_the_author(); ?></a></p>
                <p><?php echo $current_position; ?></p>
            </div>
            <div class="featured-img"><?php if ( has_post_thumbnail() ){	the_post_thumbnail(); } ?></div>
            <?php  the_content(); ?>
            

            <div class="vote">
                <div class="vote_question">Was this article useful?</div>
                <div class="vote_answer"> 
                    <input type="button" name="Yes" Value="Yes" onclick="votecount(<?php echo $post_id; ?>,'<?php echo $ip; ?>' , 1)">
                    <input type="button" name="No" Value="No" onclick="votecount(<?php echo $post_id; ?>,'<?php echo $ip; ?>', 0)">
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
