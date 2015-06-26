<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19588509a9b7"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/contact.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/contact_2015-04-20-12.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
/**
 * Template Name: Contact Page Template
 */
get_header();?>
<?php if($_GET['p']=="suggest-a-link"){ ?>
    <style type="text/css">
    #wpcf7-f92-p84-o1{
        display:none;
    }
    #wpcf7-f96-p84-o2{
        display:block;
    }
    </style>
<?php } ?>
    <div id="contact-content">
		<?php
			while ( have_posts() ) : the_post();
                   the_content();
             ?> <button id="btnfun1" name="btnfun1" onClick='location.href="?button1=1"'>Update to 1</button><?php
             if($_GET['button1']){}
			endwhile;
		?>
    </div>
<?php get_footer();?>