<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "97555ad40172e2ae2acf6e24b6801088695500ee86"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/user.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/user_2015-04-08-11.php") )  ) ){
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
        wp_redirect('edtech/experts-2'); 
        exit;
    }
    $user = get_user_by('id',$user_id);

    $user_name=$user->display_name;
    
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
?>
    <a href="edtech/experts-2" class="all_experts">All Experts</a>
    <div class="user_profile">
        <div class="user_profilepic"><img src="<?php echo $profile_image; ?>" class="expert_dp"></div>
        <div class="user_info">
            <div class="user_name"><?php echo $user_name; ?></div>
            <div class="current_pos"><?php echo $current_position; ?></div>
        </div>
    </div>
    <div class="user_experience">
        <h3>Experience</h3>
        <div class="user_company"><img src="<?php echo $company_logo1; ?>" alt="<?php echo $company1; ?>" class="company_logo"/><?php echo $designation1; ?> @ <?php echo $company1; ?> : <?php echo $rolec1; ?></div>
        <div class="user_company"><img src="<?php echo $company_logo2; ?>" alt="<?php echo $company2; ?>" class="company_logo"/><?php echo $designation2; ?> @ <?php echo $company2; ?> : <?php echo $rolec2; ?></div>
        <div class="user_company"><img src="<?php echo $company_logo3; ?>" alt="<?php echo $company3; ?>" class="company_logo"/><?php echo $designation3; ?> @ <?php echo $company3; ?> : <?php echo $rolec3; ?></div>
    </div>
<?php get_footer();
?>