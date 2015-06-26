<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "b5b36394a2b09f8ef6155ad17086bee773aee73871"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/team.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/team_2015-04-08-05.php") )  ) ){
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
		<i class="fa fa-graduation-cap fa-5x"></i><?php the_title(); ?>
		<?php
                   the_content();
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
                <div style="width:30%;float:left;margin-right:2%">
                <div style="width:100%;"><img src="<?php echo $profile_image; ?>"/>
                <div><?php echo $user_name; ?></div>
                <div><?php echo $current_position; ?></div>
                <img src="<?php echo $company_logo1; ?>"/>
                <img src="<?php echo $company_logo2; ?>"/>
                <img src="<?php echo $company_logo3; ?>"/>
                </div>
        <?php
            }
        ?>
    </div>
<?php get_footer();?>