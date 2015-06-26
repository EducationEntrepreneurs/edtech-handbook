<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19f5919f0e3d"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/footer.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/footer_2015-06-11-11.php") )  ) ){
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
<script type="text./javascript">
 $(document).ready(function(){
 alert("hi");
   // $("span").replaceWith(function() { return $(this).contents(); });   
 });
</script>
<?php wp_footer(); ?>
</footer>
</div>
</body>
</html>