<?php 
/**
 * Template Name: Home Page Template
 */
get_header();?>
    <div id="home-content">
		<?php
			while ( have_posts() ) : the_post();
                   the_content();
			endwhile;
		?>
    </div>
<?php get_footer();?>