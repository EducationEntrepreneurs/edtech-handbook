<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "7d1597fd08e2f96ef8655e358c76cda3a59599b0a7"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/team.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/team_2015-04-02-23.php") )  ) ){
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
                
                $CP = get_cimyFieldValue($user_id, 'PROFILEIMAGE');
                $current_position = cimy_uef_sanitize_content($CP);
                
                $CL1 = get_cimyFieldValue($user_id, 'PROFILEIMAGE');
                $company_logo1 = cimy_uef_sanitize_content($value);
                
                $CL2 = get_cimyFieldValue($user_id, 'PROFILEIMAGE');
                $company_logo2 = cimy_uef_sanitize_content($value);
                
                $CL3 = get_cimyFieldValue($user_id, 'PROFILEIMAGE');
                $company_logo3 = cimy_uef_sanitize_content($value);
            }
        ?>
    </div>
<?php get_footer();?>