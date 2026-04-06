<?php
/**
 * Template for single author display
 */

get_header(); ?>

<div class="single-author-container">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="author-header">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="author-photo-large">
                        <?php the_post_thumbnail('author-medium'); ?>
                    </div>
                <?php else : ?>
                    <div class="author-photo-large no-photo">
                        <span>👤</span>
                    </div>
                <?php endif; ?>
                
                <div class="author-info-header">
                    <h1 class="author-name"><?php the_title(); ?></h1>
                    <div class="author-bio-full">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            
            <div class="author-books">
                <h2><?php _e('Books by', 'ebook-store'); ?> <?php the_title(); ?></h2>
                <div class="books-grid">
                    <?php
                    $author_books = new WP_Query(array(
                        'post_type' => 'books',
                        'meta_key' => '_book_author',
                        'meta_value' => get_the_ID(),
                        'posts_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC'
                    ));
                    
                    if ($author_books->have_posts()) :
                        while ($author_books->have_posts()) : $author_books->the_post();
                            get_template_part('template-parts/book-card');
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>' . __('No books found by this author.', 'ebook-store') . '</p>';
                    endif;
                    ?>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>