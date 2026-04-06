<?php
/**
 * Template for single author display - Enhanced Design
 */

get_header(); ?>

<div class="single-author-container">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('author-article'); ?>>
            
            <!-- Hero Section with Author Info -->
            <div class="author-hero-section">
                <div class="container">
                    <div class="author-hero-content">
                        <div class="author-avatar-wrapper">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('author-medium', array('class' => 'author-avatar')); ?>
                            <?php else : ?>
                                <div class="author-avatar-placeholder">
                                    <span class="placeholder-icon">👤</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php
                            // Get book count
                            $author_id = get_the_ID();
                            $book_count_query = new WP_Query(array(
                                'post_type' => 'books',
                                'meta_key' => '_book_author',
                                'meta_value' => $author_id,
                                'posts_per_page' => -1
                            ));
                            $book_count = $book_count_query->post_count;
                            wp_reset_postdata();
                            ?>
                            
                            <div class="author-stats">
                                <div class="stat">
                                    <span class="stat-number"><?php echo $book_count; ?></span>
                                    <span class="stat-label"><?php _e('Books', 'ebook-store'); ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="author-info-content">
                            <h1 class="author-name"><?php the_title(); ?></h1>
                            
                            <?php
                            // Get author social links (you can add custom fields for these)
                            $author_twitter = get_post_meta(get_the_ID(), '_author_twitter', true);
                            $author_facebook = get_post_meta(get_the_ID(), '_author_facebook', true);
                            $author_website = get_post_meta(get_the_ID(), '_author_website', true);
                            ?>
                            
                            <?php if ($author_twitter || $author_facebook || $author_website) : ?>
                                <div class="author-social-links">
                                    <?php if ($author_website) : ?>
                                        <a href="<?php echo esc_url($author_website); ?>" class="social-link website" target="_blank">
                                            🌐 <?php _e('Website', 'ebook-store'); ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($author_twitter) : ?>
                                        <a href="<?php echo esc_url($author_twitter); ?>" class="social-link twitter" target="_blank">
                                            🐦 Twitter
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($author_facebook) : ?>
                                        <a href="<?php echo esc_url($author_facebook); ?>" class="social-link facebook" target="_blank">
                                            📘 Facebook
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="author-bio-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Books by Author Section -->
            <div class="author-books-section">
                <div class="container">
                    <div class="section-header">
                        <h2 class="section-title">
                            <?php _e('Books by', 'ebook-store'); ?> <?php the_title(); ?>
                        </h2>
                        <div class="section-divider">
                            <span class="divider-line"></span>
                            <span class="divider-icon">📚</span>
                            <span class="divider-line"></span>
                        </div>
                    </div>
                    
                    <div class="books-grid">
                        <?php
                        $author_books = new WP_Query(array(
                            'post_type' => 'books',
                            'meta_key' => '_book_author',
                            'meta_value' => get_the_ID(),
                            'posts_per_page' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        
                        if ($author_books->have_posts()) :
                            while ($author_books->have_posts()) : $author_books->the_post();
                                get_template_part('template-parts/book-card');
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<div class="no-books-message">';
                            echo '<p>' . __('No books published yet. Check back soon!', 'ebook-store') . '</p>';
                            echo '</div>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- Related Authors Section (Optional) -->
            <?php
            // Get other authors in same genres
            $current_author_id = get_the_ID();
            $author_books_query = new WP_Query(array(
                'post_type' => 'books',
                'meta_key' => '_book_author',
                'meta_value' => $current_author_id,
                'posts_per_page' => 5
            ));
            
            $similar_genres = array();
            if ($author_books_query->have_posts()) {
                while ($author_books_query->have_posts()) {
                    $author_books_query->the_post();
                    $genres = get_the_terms(get_the_ID(), 'genre');
                    if ($genres && !is_wp_error($genres)) {
                        foreach ($genres as $genre) {
                            $similar_genres[] = $genre->term_id;
                        }
                    }
                }
                wp_reset_postdata();
            }
            
            if (!empty($similar_genres)) {
                $similar_genres = array_unique($similar_genres);
                $related_authors = new WP_Query(array(
                    'post_type' => 'authors',
                    'posts_per_page' => 4,
                    'post__not_in' => array($current_author_id),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'genre',
                            'field' => 'term_id',
                            'terms' => $similar_genres,
                        ),
                    ),
                ));
                
                if ($related_authors->have_posts()) : ?>
                    <div class="related-authors-section">
                        <div class="container">
                            <div class="section-header">
                                <h2 class="section-title">
                                    <?php _e('You Might Also Like These Authors', 'ebook-store'); ?>
                                </h2>
                                <div class="section-divider">
                                    <span class="divider-line"></span>
                                    <span class="divider-icon">✍️</span>
                                    <span class="divider-line"></span>
                                </div>
                            </div>
                            
                            <div class="authors-grid-home">
                                <?php while ($related_authors->have_posts()) : $related_authors->the_post(); ?>
                                    <div class="author-card-home">
                                        <a href="<?php the_permalink(); ?>" class="author-card-link">
                                            <div class="author-card-photo">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('author-thumb'); ?>
                                                <?php else : ?>
                                                    <div class="no-photo-placeholder">
                                                        <span>👤</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="author-card-info">
                                                <h3 class="author-card-name"><?php the_title(); ?></h3>
                                                <div class="author-card-bio">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <?php wp_reset_postdata();
                endif;
            }
            ?>
            
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>