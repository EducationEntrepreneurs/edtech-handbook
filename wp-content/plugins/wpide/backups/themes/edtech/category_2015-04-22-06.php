<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "b5b36394a2b09f8ef6155ad17086bee7f736ea6e1f"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/category.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/category_2015-04-22-06.php") )  ) ){
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
        <div class="cat_sort">
            <select onchange="cat_sort()">
                <option value="featured">Featured</option>
                <option value="recent">Most Recent</option>
                <option value="useful">Most Useful</option>
            </select> 
        </div>
        <div class="sort">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php 
                    $author_id = $post->post_author;
                    $unix_post_time =get_post_time(true,get_the_ID());
                    $unix_post_time_diff=time()-$unix_post_time;
                    $post_time='added '.time_elapsed($unix_post_time_diff);
                    $CP = get_cimyFieldValue($author_id, 'CURRENTPOSITION');
                    $current_position = cimy_uef_sanitize_content($CP);
                    $post_id = get_the_ID(); 
                    $post_type = featured_posts($post_id);
                    if($post_type[0]=='featured'){
                ?>
                        <div class="sorted_res">
                            <div class="post_image">
                                <?php   if ( has_post_thumbnail() ){
                                            $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ,'medium' );
                                        }
                                ?>
                                <img src="<?php echo $img[0]; ?>" width="100%" height="231px" />
                            </div>
                            <div class="post_time"><?php echo $post_time; ?></div>
                            <div class="post_title"><h3><?php the_title(); ?></h3></div>
                            <div class="author_info">
                                <div class="author_dp">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); 
                                          
                                    ?>
                                </div>
                                <div class="author">                                
                                    <p><?php echo get_the_author(); ?></p>
                                    <p><?php echo $current_position; ?></p>
                                </div>
                            </div>
                            <div class="post_content"><a href="<?php the_permalink(); ?>"><?php the_excerpt();?></a></div>
                        </div>
            <?php   } 
                endwhile; ?>
        </div>
        <div class="hr-divider"><hr width="100%" /></div>
        <div class="all_post">
        <?php 
                $posts_per_page = 4;
                $paged=$_GET['page'];
                $wp_query = new WP_Query();
                $args = array(
	                'posts_per_page' => $posts_per_page,
	                'paged' => $paged,
	                'category_name' => $category_name
                );
                query_posts($args);
                $total_pages = $wp_query->max_num_pages;
            ?>   
            <?php  while ( have_posts() ) : the_post(); ?>
                <?php   $unix_post_time =get_post_time(true,get_the_ID());
                        $unix_post_time_diff=time()-$unix_post_time;
                        $post_time='added '.time_elapsed($unix_post_time_diff); 
                  
                ?>
                <div class="cat_posts">
                    <div class="post_time"><?php echo $post_time; ?></div>
                    <div class="post_title"><h3><?php the_title(); ?></h3></div>
                    <div class="author_info">
                        <div style="float:left">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                                  echo get_the_author(); 
                            ?>
                        </div>
                        <div style="float:right;color:#ccc">
                            <i class="fa fa-thumbs-up">Useful:</i><?php echo intval(get_post_meta(get_the_ID(),'vote_count_yes',true));?> votes
                        </div>
                    </div>
                    <div class="post_data">
                        <div class="post_image">
                            <?php   if ( has_post_thumbnail() ){
                                        $post_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ,'thumbnail' );
                                        ?><img src="<?php echo $post_img[0]; ?>" /><?php
                                    }
                                    else{
                                            ?><img src="http://dev.anzum.in/edtech/wp-content/uploads/2015/03/header-image.jpg" /><?php
                                    }
                                    ?>
                        </div>
                        <div class="post_content">
                            <a href="<?php the_permalink(); ?>"><?php the_excerpt();?></a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="pagination">
        <?php 
                echo paginate_links( array(
                        'format' => '?page=%#%',
	                    'current' => max( 1, get_query_var('paged') ),
	                    'end_size'=>2,
	                    'mid_size'=>2,
	                    'total' => $total_pages,
	                    ) );wp_reset_query();?>
	    </div>
    </div>
    <div class="hr-divider"><hr width="100%" /></div>
    <div class="wrapper_right">
        <div class="experts_info">
            <h3>Experts</h3>
            <?php $authorID=edtech_author($category_name); 
                  foreach($authorID as $author){
                     $author_name=get_the_author_meta('display_name' , $author );
                     $avatar=get_avatar($author,45);
                     ?><div class="author_info">
                        <?php   echo $avatar;
                        ?><a href="../../expert?id=<?php echo $author; ?>"><?php echo $author_name; ?></a>
                        </div><?php
                 }?>
        </div>
        <div class="suggest">
            <?php dynamic_sidebar('sidebar-3'); ?>
        </div>
    </div>


<?php get_footer(); ?>