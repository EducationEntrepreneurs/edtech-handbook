<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "34fd8828ed8a1f8bcdc8fbd371f548578d2269a0eb"){
                                        if ( file_put_contents ( "/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/themes/edtech/header.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/anzumin/public_html/dev.anzum.in/edtech/wp-content/plugins/wpide/backups/themes/edtech/header_2015-03-16-14.php") )  ) ){
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
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<?php wp_head();?>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-3 col-md-offset-9"><?php wp_nav_menu( array( 'theme_location' => 'top-menu') ); ?></div>
</div>
<div class="row">
    <div class="col-md-3"><img src="http://dev.anzum.in/edtech/wp-content/uploads/2015/03/logo.jpg"/></div>
    <div class="col-md-5"><?php wp_nav_menu( array( 'theme_location' => 'header-menu') ); ?></div>
    <div class="col-md-4"><?php get_sidebar('header-top'); ?></div>
</div>
