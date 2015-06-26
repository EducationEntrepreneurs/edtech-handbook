<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f199cc3fca3d9"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/user.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/user_2015-04-24-10.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
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
    
    $blog = "http://".get_the_author_meta( blog , $user_id );
    $linkedin = "http://".get_the_author_meta( linkedin , $user_id );
    $twitter = "http://".get_the_author_meta( twitter , $user_id );
?>
    <a href="../experts" class="all_experts">All Experts</a>
    <div class="user_container">
        <div class="wrapper_left">
            <div class="user_profile">
                <div class="user_profilepic"><img src="<?php echo $profile_image; ?>" class="expert_dp"></div>
                <div class="user_info">
                    <div class="user_name"><?php echo $user_name; ?></div>
                    <div class="current_pos"><?php echo $current_position; ?></div>
                </div>
            </div>
            <div class="user_experience">
                <h3>Experience</h3>
                <div class="user_company"><img src="<?php echo $company_logo1; ?>" alt="<?php echo $company1; ?>" class="company_logo"/><?php echo $designation1; ?> @ <span><?php echo $company1; ?></span> : <?php echo $rolec1; ?></div>
                <div class="user_company"><img src="<?php echo $company_logo2; ?>" alt="<?php echo $company2; ?>" class="company_logo"/><?php echo $designation2; ?> @ <span><?php echo $company2; ?></span> : <?php echo $rolec2; ?></div>
                <div class="user_company"><img src="<?php echo $company_logo3; ?>" alt="<?php echo $company3; ?>" class="company_logo"/><?php echo $designation3; ?> @ <span><?php echo $company3; ?></span> : <?php echo $rolec3; ?></div>
            </div>
            <div class="user_resources">
                <?php   
                    query_posts(array('author'=>$user_id, 'posts_per_page' => 3));
                        
                    if(have_posts()) :?><h3>Edtech Handbook resources by <?php echo $user->first_name; ?></h3><?php while(have_posts()) : the_post(); 
                    
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
        <div class="wrapper_right">
            <div class="user_social">
                <h3>More about <?php echo $user->first_name; ?></h3>
                <ul>
                    <li><a href="<?php echo $blog; ?>">Blog</a></li>
                    <li><a href="<?php echo $linkedin; ?>">LinkedIn</a></li>
                    <li><a href="<?php echo $twitter; ?>">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php get_footer();
?>