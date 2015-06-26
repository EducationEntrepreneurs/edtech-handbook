<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "97555ad40172e2ae2acf6e24b6801088501bec4cb3"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/team.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/team_2015-04-08-12.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
/**
 * Template Name: Experts Listing
 */
get_header();?>
    <div id="experts-content">
		<?php
			while ( have_posts() ) : the_post();
		?>
		<div class="expert_title"><?php the_title(); ?></div>
		<?php
                 ?><div class="expert_content"><?php  the_content(); ?></div><?php
			endwhile;
		?>
		<?php
            $args = array(
             'who' => 'all'
            );
             $experts = get_users($args);
             foreach ($experts as $user) {
                $user_name = $user->display_name;
                $user_id = $user->id;
                
                $DP = get_cimyFieldValue($user_id, 'PROFILEIMAGE');
                $profile_image = cimy_uef_sanitize_content($DP);
                
                $CP = get_cimyFieldValue($user_id, 'CURRENTPOSITION');
                $current_position = cimy_uef_sanitize_content($CP);
                
                $C1 = get_cimyFieldValue($user_id, 'COMP1');
                $company1 = cimy_uef_sanitize_content($C1);
                $CL1 = get_cimyFieldValue($user_id, 'COMPLOGO1');
                $company_logo1 = cimy_uef_sanitize_content($CL1);
                
                $C2 = get_cimyFieldValue($user_id, 'COMP2');
                $company2 = cimy_uef_sanitize_content($C2);
                $CL2 = get_cimyFieldValue($user_id, 'COMPLOGO2');
                $company_logo2 = cimy_uef_sanitize_content($CL2);
                
                $C3 = get_cimyFieldValue($user_id, 'COMP3');
                $company3 = cimy_uef_sanitize_content($C3);
                $CL3 = get_cimyFieldValue($user_id, 'COMPLOGO3');
                $company_logo3 = cimy_uef_sanitize_content($CL3);
        ?>
                <div class="expert_container">
                <div style="width:100%;"><a href="edtech/user?id=<?php echo $user_id; ?>" target="_BLANK"><img src="<?php echo $profile_image; ?>" class="expert_dp"/></a>
                <div class="user_name"><?php echo $user_name; ?></div>
                <div class="current_pos"><?php echo $current_position; ?></div>
                <img src="<?php echo $company_logo1; ?>" alt="<?php echo $company1; ?>" class="company_logo"/>
                <img src="<?php echo $company_logo2; ?>" alt="<?php echo $company2; ?>" class="company_logo"/>
                <img src="<?php echo $company_logo3; ?>" alt="<?php echo $company3; ?>" class="company_logo"/>
                </div>
                </div>
        <?php
            }
        ?>
    </div>
<?php get_footer();?>