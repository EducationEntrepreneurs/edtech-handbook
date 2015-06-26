<?php 
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
			endwhile;
		?>
    </div>
<?php get_footer();?>