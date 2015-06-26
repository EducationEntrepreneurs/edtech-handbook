<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "b5b36394a2b09f8ef6155ad17086bee7cf653907cb"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/category.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/category_2015-05-13-21.php") )  ) ){
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
    <?php if($_GET['page']==""){ ?>
        <div class="cat_sort">
            <span>Sort by</span>
            <select onchange="cat_sort('<?php echo $category_name; ?>')">
                <option value="featured">Featured</option>
                <option value="recent">Most Recent</option>
                <option value="useful">Most Useful</option>
            </select>
        </div>
    <?php } ?>

        <?php if($_GET['page']==""){ ?>
            <div class="cat_sort_title">
                <h2>Featured Resources</h2>
            </div>
            <div class="sort">
                <?php echo cat_sort_featured($category_name); ?>
            </div>
            <div class="hr-divider"><hr width="100%" /></div>
        <?php } ?>
        <div class="all_post">
        <?php 
               $first_page_post_count 	= 4;
                $subsequent_pages_post_count = 8;
                $paged=$_GET['page'];
                
                if($paged > 1){
                	// not first page
	                $posts_per_page = $subsequent_pages_post_count;
                        if($paged == 2){
		                    // second page
		                    $offset = $first_page_post_count;	
	                    } 
	                    else{
		                     // subsequent pages
		                    $offset = $first_page_post_count + ($subsequent_pages_post_count * ($paged - 2));
	                    }
                } 
                else{
	                // first page
	                $offset = 0;
	                $posts_per_page = $first_page_post_count;
                }
                
                
                $post_count = wp_count_posts();
                $total_posts = $post_count->publish;
                $total_pages = get_max_pages($total_posts,$first_page_post_count,$subsequent_pages_post_count);
                
                $wp_query = new WP_Query();
                $args = array(
	                'posts_per_page' => $posts_per_page,
	                'paged' => $paged,
	                'offset' => $offset,
	                'category_name' => $category_name,
	                'order'   => 'DSC',
	                'meta_key' => 'vote_count_yes',
                    'orderby'   => 'meta_value_num'
                );
             
                query_posts($args);
        ?>   
            <?php  while ( have_posts() ) : the_post(); ?>
                <?php   
                        $post_time=time_elapsed(get_the_ID());
                ?>
                <div class="cat_posts">
                    <div class="post_time"><?php echo $post_time; ?></div>
                    <div class="post_title">
                        <a href="<?php the_permalink(); ?>">
                            <h3>
                                <?php if(strlen(get_the_title())>=60){
                                        echo (substr_replace(trim(substr_replace(get_the_title()," ",59)),"...",59,0)); 
                                    }
                                    else{
                                        the_title();   
                                    }
                                ?>
                            </h3>
                        </a>
                    </div>
                    <div class="author_info">
                        <div style="float:left">
                                <div class="author_dp">
                                    <a href="../../expert?id=<?php echo get_the_author_meta( 'ID' ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></a>
                                </div>
                                <div class="author">
                                    <a href="../../expert?id=<?php echo get_the_author_meta( 'ID' ); ?>"><?php echo get_the_author(); ?></a>
                                </div>
                        </div>
                        <div class="useful-vote">
                            <i class="fa fa-thumbs-up">Useful:<?php echo intval(get_post_meta(get_the_ID(),'vote_count_yes',true));?> votes</i>
                        </div>
                    </div>
                    <div class="post_data">
                        <div class="post_image">
                            <?php   if ( has_post_thumbnail() ){
                                        $post_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ,'thumbnail' );
                                        ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $post_img[0]; ?>" /></a><?php
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
	                    ) );
	            wp_reset_query();
	   ?>
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


<?php get_footer(); ?>