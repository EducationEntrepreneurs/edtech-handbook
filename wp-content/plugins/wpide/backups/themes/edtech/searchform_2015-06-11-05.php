<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "5e6d9457ea217937a430bd995c5f3f19fc8c8378eb"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/searchform.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/searchform_2015-06-11-05.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"  class="form-control search" id="inputSuccess4 search" aria-describedby="inputSuccess4Status" placeholder="search" />
		<span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
	</div>
</form>