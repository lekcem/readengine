<?php
/**
 * Taxonomy template for age groups
 */

get_header(); 

// Get current term
$current_term = get_queried_object();
?>

<div class="taxonomy-container">
    <header class="archive-header">
        <h1 class="archive-title">
            <?php echo esc_html($current_term->name); ?>
        </h1>
        <?php if ($current_term->description) : ?>
            <div class="term-description">
                <?php echo esc_html($current_term->description); ?>
            </div>
        <?php endif; ?>
    </header>
    
    <div class="books-grid">
        <?php
        // Custom query for books in this age group
        $args = array(
            'post_type' => 'books',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'age_group',
                    'field' => 'slug',
                    'terms' => $current_term->slug,
                ),
            ),
        );
        
        $age_books = new WP_Query($args);
        
        if ($age_books->have_posts()) :
            while ($age_books->have_posts()) : $age_books->the_post();
                get_template_part('template-parts/book-card');
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p class="no-results">' . __('No books found for this age group.', 'ebook-store') . '</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>