<?php
/**
 * Archive template for authors
 */

get_header(); ?>

<div class="archive-authors-container">
    <header class="archive-header">
        <h1 class="archive-title"><?php _e('All Authors', 'ebook-store'); ?></h1>
        <p class="archive-description"><?php _e('Meet our talented authors and discover their amazing books.', 'ebook-store'); ?></p>
    </header>
    
    <div class="authors-grid-home">
        <?php
        $authors = new WP_Query(array(
            'post_type' => 'authors',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        ));
        
        if ($authors->have_posts()) :
            while ($authors->have_posts()) : $authors->the_post();
                ?>
                <div class="author-card-home">
                    <a href="<?php the_permalink(); ?>" class="author-card-link">
                        <div class="author-card-photo">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('author-photo'); ?>
                            <?php else : ?>
                                <div class="no-photo-placeholder">
                                    <span>👤</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="author-card-info">
                            <h3 class="author-card-name"><?php the_title(); ?></h3>
                            <div class="author-card-bio">
                                <?php 
                                $bio = get_the_excerpt();
                                if (empty($bio)) {
                                    $bio = get_post_field('post_content', get_the_ID());
                                }
                                echo wp_trim_words($bio, 20);
                                ?>
                            </div>
                            <?php
                            // Count books by this author
                            $author_id = get_the_ID();
                            $book_count = new WP_Query(array(
                                'post_type' => 'books',
                                'meta_key' => '_book_author',
                                'meta_value' => $author_id,
                                'posts_per_page' => -1
                            ));
                            ?>
                            <div class="author-book-count">
                                📚 <?php echo $book_count->post_count; ?> <?php _e('books', 'ebook-store'); ?>
                            </div>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p class="no-results">' . __('No authors found.', 'ebook-store') . '</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>