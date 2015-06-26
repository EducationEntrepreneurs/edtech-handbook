<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "b5b36394a2b09f8ef6155ad17086bee788766c1217"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/footer.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/footer_2015-06-04-06.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><footer>
<div class="row">
  <div class="col-md-8"><?php dynamic_sidebar('sidebar-2'); ?></div>
    <div class="col-md-4"><?php wp_nav_menu( array( 'theme_location' => 'footer-menu','menu_class' => 'footer-menu') ); ?></div>
</div>
<?php get_search_form(); ?>
<?php wp_footer(); ?>
</footer>
</div>
</body>
</html>