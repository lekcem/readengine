<?php get_header(); ?>

<h1>Books Archive</h1>

<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        get_template_part('template-parts/content','authors');
    endwhile;
else :
    echo '<p>No authors found</p>';
endif;
?>

<?php get_footer(); ?>