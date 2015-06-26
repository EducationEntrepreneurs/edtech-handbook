<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "97555ad40172e2ae2acf6e24b6801088695500ee86"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/user.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/user_2015-04-08-10.php") )  ) ){
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
    $username=$user->display_name;
    echo $username;
    
get_footer();
?>