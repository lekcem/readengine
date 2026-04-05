<?php get_header(); ?>

<h1>GENRE Archive</h1>

<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        get_template_part('template-parts/content','genre');
    endwhile;
else :
    echo '<p>No genres found</p>';
endif;
?>

<?php get_footer(); ?>