<?php get_header(); ?>

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
            $author_id = $post->post_author;
            $post_id=get_the_ID();
            $ip = get_ip();
            $post_ID=array($post_id);
            $CP = get_cimyFieldValue(get_the_author_meta( 'ID' ), 'CURRENTPOSITION');
            $current_position = cimy_uef_sanitize_content($CP);
            //$content=get_the_content();
            global $post;
            if($post->content==""){
                delete_post_meta($post_id, 'jump_to_section_link');
            }
            $existing_product = existing_products($post_id);
            $exist_array = split(";",$existing_product);
            $existing = $exist_array[0];
            $existing_link = $exist_array[1];
        ?>
        <div class="post-content">
            <div class="author_dp">
                <a href="../expert?id=<?php echo $author_id; ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 45 );  ?></a>
            </div>
            <div class="author">                                
                <p><a href="../expert?id=<?php echo $author_id; ?>"><?php echo get_the_author(); ?></a></p>
                <p><?php echo $current_position; ?></p>
            </div>
            <div class="jump_to_section">
                <h3>Jump to section</h3>
                <ul>
                <?php 
                    $on_page_links = get_post_meta( get_the_ID(), 'jump_to_section_link'); 
                    foreach($on_page_links as $link)
                        echo $link;
                ?>
                </ul>
            </div>
            <div class="featured-img">
                <?php
                    if($existing == "existing"){
                        if ( has_post_thumbnail() ){ ?><a href="<?php echo $existing_link; ?>" target="_blank" ><?php the_post_thumbnail(); ?></a><?php } 
                    }else{
                        if ( has_post_thumbnail() ){  the_post_thumbnail();  } 
                    }
                ?>
            </div>
            <div class="content"><?php  the_content(); ?></div>
            <div class="vote_section">
                <div class="vote">
                    <div class="vote_question">
                    <?php
                        if($existing == "existing"){ ?>
                            Was this resource listing useful?
                        <?php } else { ?>
                            Was this article useful? 
                        <?php }
                    ?>
                    </div>
                    <div class="vote_answer"> 
                        <input type="button" name="Yes" Value="Yes" onclick="votecount(<?php echo $post_id; ?>,'<?php echo $ip; ?>' , 1)">
                        <input type="button" name="No" Value="No" onclick="votecount(<?php echo $post_id; ?>,'<?php echo $ip; ?>', 0)">
                    </div>
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
