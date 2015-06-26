<?php
/**
 * Template Name: User Template
 */
 
    if(isset($_GET['id'])){
        get_header();
        $user_id=$_GET['id'];
    }
    else{
        wp_redirect('../experts'); 
        exit;
    }
    $user = get_user_by('id',$user_id);

    $user_name=$user->display_name;
    
    $FN = get_cimyFieldValue($user_id, 'FIRSTNAME');
    $first_name = cimy_uef_sanitize_content($FN);
    
    $DP = get_cimyFieldValue($user_id, 'PROFILEIMAGE');
    $profile_image = cimy_uef_sanitize_content($DP);
    
    $CP = get_cimyFieldValue($user_id, 'CURRENTPOSITION');
    $current_position = cimy_uef_sanitize_content($CP);
                
    $C1 = get_cimyFieldValue($user_id, 'COMP1');
    $company1 = cimy_uef_sanitize_content($C1);
    $CL1 = get_cimyFieldValue($user_id, 'COMPLOGO1');
    $company_logo1 = cimy_uef_sanitize_content($CL1);
    $DESG1 = get_cimyFieldValue($user_id, 'DESIGNATIONC1');
    $designation1 = cimy_uef_sanitize_content($DESG1);
    $RL1 = get_cimyFieldValue($user_id, 'ROLEC1');
    $rolec1 = cimy_uef_sanitize_content($RL1);
                
    $C2 = get_cimyFieldValue($user_id, 'COMP2');
    $company2 = cimy_uef_sanitize_content($C2);
    $CL2 = get_cimyFieldValue($user_id, 'COMPLOGO2');
    $company_logo2 = cimy_uef_sanitize_content($CL2);
    $DESG2 = get_cimyFieldValue($user_id, 'DESIGNATIONC2');
    $designation2 = cimy_uef_sanitize_content($DESG2);
    $RL2 = get_cimyFieldValue($user_id, 'ROLEC2');
    $rolec2 = cimy_uef_sanitize_content($RL2);
                
    $C3 = get_cimyFieldValue($user_id, 'COMP3');
    $company3 = cimy_uef_sanitize_content($C3);
    $CL3 = get_cimyFieldValue($user_id, 'COMPLOGO3');
    $company_logo3 = cimy_uef_sanitize_content($CL3);
    $DESG3 = get_cimyFieldValue($user_id, 'DESIGNATIONC3');
    $designation3 = cimy_uef_sanitize_content($DESG3);
    $RL3 = get_cimyFieldValue($user_id, 'ROLEC3');
    $rolec3 = cimy_uef_sanitize_content($RL3);
    
    $blog = get_the_author_meta( blog , $user_id );
    $linkedin = get_the_author_meta( linkedin , $user_id );
    $twitter = get_the_author_meta( twitter , $user_id );
?>
    <a href="../experts" class="all_experts">All Experts</a>
    <div class="user_container">
        <div class="wrapper">
            <div class="user_profile">
                <div class="user_profilepic"><img src="<?php echo $profile_image; ?>" class="expert_dp"></div>
                <div class="user_info">
                    <div class="user_name"><?php echo $user_name; ?></div>
                    <div class="current_pos"><?php echo $current_position; ?></div>
                    <div class="user_social">
                        <?php if($blog != ""){ ?><span><a href="<?php echo $blog; ?>" target="_BLANK"><i class="fa fa-globe"></i></a></span><?php } ?>
                        <?php if($linkedin != ""){ ?><span><a href="<?php echo $linkedin; ?>" target="_BLANK"><i class="fa fa-linkedin-square"></i></a></span><?php } ?>
                        <?php if($twitter != ""){ ?><span><a href="<?php echo $twitter; ?>" target="_BLANK"><i class="fa fa-twitter"></i></a></span><?php } ?>
                    </div>
                </div>
            </div>
            <div class="user_experience">
                <h3>Experience</h3>
                <?php if($company_logo1 != ""){
                    ?><div class="user_company"><div class="company_image"><img src="<?php echo $company_logo1; ?>" alt="<?php echo $company1; ?>" class="company_logo"/></div><div class="company_desc"><?php echo $designation1; ?> @ <span><?php echo $company1; ?></span> : <?php echo $rolec1; ?></div></div>
                <?php }
                if($company_logo2 != ""){
                    ?><div class="user_company"><div class="company_image"><img src="<?php echo $company_logo2; ?>" alt="<?php echo $company2; ?>" class="company_logo"/></div><div class="company_desc"><?php echo $designation2; ?> @ <span><?php echo $company2; ?></span> : <?php echo $rolec2; ?></div></div>
                <?php }
                if($company_logo3 != ""){    
                    ?><div class="user_company"><div class="company_image"><img src="<?php echo $company_logo3; ?>" alt="<?php echo $company3; ?>" class="company_logo"/></div><div class="company_desc"><?php echo $designation3; ?> @ <span><?php echo $company3; ?></span> : <?php echo $rolec3; ?></div></div>
                <?php } ?>
            </div>
            <div class="user_resources">
                <?php   
                    query_posts(array('author'=>$user_id, 'posts_per_page' => 3));
                        
                    if(have_posts()) :?><h3>Resources by <?php echo $user->first_name; ?></h3><?php while(have_posts()) : the_post(); 
                    
                        $post_categories = wp_get_post_categories( get_the_ID() );
                    
                        foreach($post_categories as $category){
	                        $cat = get_category( $category );
	                        $cats = array( 'name' => $cat->name );
                        }
                ?>
                        <p> <?php if($cats['name']=='Explore') { ?><i class="fa fa-lightbulb-o"></i><?php } 
                            elseif($cats['name']=='Validate') { ?><i class="fa fa-comments"></i><?php } 
                            elseif($cats['name']=='Build') { ?><i class="fa fa-user"></i><?php }
                            elseif($cats['name']=='Grow') { ?><i class="fa fa-leaf"></i><?php }
                            else { ?><i class="fa fa-hand-o-right"></i><?php } ?>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </p>
                <?php   endwhile; endif; wp_reset_query(); ?>
            </div>
        </div>
    </div>
<?php get_footer();
?>