<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "34fd8828ed8a1f8bcdc8fbd371f54857edff84acba"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/footer.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/footer_2015-03-23-20.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><div class="row">
  <div class="col-md-8"><?php dynamic_sidebar('sidebar-2'); ?></div>
    <div class="col-md-4"><?php wp_nav_menu( array( 'theme_location' => 'footer-menu','menu_class' => 'footer-menu') ); ?></div>
</div>
<?php wp_footer(); ?>
</div>
</body>
</html>