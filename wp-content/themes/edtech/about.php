<?php 
/**
 * Template Name: About page Template
 */
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="about_title">
    <h1><?php the_title(); ?></h1>
</div>
<div class="wrapper_left">
    <div class="about_content">
        <?php the_content(); ?>
    </div>
    <div class="about_image">
       <?php the_post_thumbnail('large') ?>
    </div>
</div>
<div class="wrapper_right">
    <div class="suggest">
        <?php dynamic_sidebar('sidebar-3'); ?>
    </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>