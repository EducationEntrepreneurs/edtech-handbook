<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "8e90b7f77a28aa29679f586f78763caba59599b0a7"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/header.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/header_2015-04-02-16.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><!DOCTYPE html>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<?php wp_head();?>
</head>
<body>
<div class="container">
<header>
<div class="row top-head">
    <div class="col-md-3 col-md-offset-9"><?php wp_nav_menu( array( 'theme_location' => 'top-menu','menu_class' => 'menu-top') ); ?></div>
</div>
<nav>
<div class="row">
    <div id="logo"><a href="http://dev.anzum.in/edtech/"><img src="http://dev.anzum.in/edtech/wp-content/uploads/2015/03/Logo.png"/></a></div>
    <div id="header-menu"><?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_class' => 'main-menu') ); ?></div>
    <div id="mobile-menu"><?php echo do_shortcode('[responsive-menu]'); ?></div>
    <div id="search">
        <div class="form-group has-success has-feedback">
        	<form action="search.php" method="get">
            	<input type="text" class="form-control" id="inputSuccess4" aria-describedby="inputSuccess4Status" placeholder="search" >
			    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
            </form>
        </div>
    </div>
</div>
</nav>
</header>