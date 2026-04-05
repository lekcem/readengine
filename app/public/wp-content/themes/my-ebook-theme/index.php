<?php get_header(); ?>

<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        get_template_part('template-parts/content', get_post_type());
    endwhile;
else :
    echo '<p>No content found</p>';
endif;
?>

<?php get_footer(); ?>