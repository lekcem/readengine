<?php
/**
 * Template for single book display with Ebook Download Manager
 */

get_header(); ?>

<div class="single-book-container">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="book-header">
                <div class="book-cover-large">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large'); ?>
                    <?php else : ?>
                        <div class="no-cover"><?php _e('No Cover', 'ebook-store'); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="book-info">
                    <h1 class="book-title"><?php the_title(); ?></h1>
                    
                    <?php
                    $author_id = get_post_meta(get_the_ID(), '_book_author', true);
                    if ($author_id) :
                        $author = get_post($author_id);
                        ?>
                        <div class="book-author">
                            <span class="label"><?php _e('By:', 'ebook-store'); ?></span>
                            <a href="<?php echo get_permalink($author_id); ?>">
                                <?php echo esc_html($author->post_title); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="book-meta">
                        <?php
                        $isbn = get_post_meta(get_the_ID(), '_book_isbn', true);
                        if ($isbn) : ?>
                            <div class="book-isbn">
                                <span class="label"><?php _e('ISBN:', 'ebook-store'); ?></span>
                                <span><?php echo esc_html($isbn); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        $pub_date = get_post_meta(get_the_ID(), '_book_publication_date', true);
                        if ($pub_date) : ?>
                            <div class="book-date">
                                <span class="label"><?php _e('Published:', 'ebook-store'); ?></span>
                                <span><?php echo date_i18n(get_option('date_format'), strtotime($pub_date)); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="book-genres">
                        <span class="label"><?php _e('Genres:', 'ebook-store'); ?></span>
                        <?php
                        $genres = get_the_terms(get_the_ID(), 'genre');
                        if ($genres && !is_wp_error($genres)) :
                            $genre_links = array();
                            foreach ($genres as $genre) {
                                $genre_links[] = sprintf(
                                    '<a href="%s">%s</a>',
                                    esc_url(get_term_link($genre)),
                                    esc_html($genre->name)
                                );
                            }
                            echo implode(', ', $genre_links);
                        else :
                            _e('None', 'ebook-store');
                        endif;
                        ?>
                    </div>
                    
                    <div class="book-age-group">
                        <span class="label"><?php _e('Age Group:', 'ebook-store'); ?></span>
                        <?php
                        $age_groups = get_the_terms(get_the_ID(), 'age_group');
                        if ($age_groups && !is_wp_error($age_groups)) :
                            $age_links = array();
                            foreach ($age_groups as $age_group) {
                                $age_links[] = sprintf(
                                    '<a href="%s">%s</a>',
                                    esc_url(get_term_link($age_group)),
                                    esc_html($age_group->name)
                                );
                            }
                            echo implode(', ', $age_links);
                        else :
                            _e('None', 'ebook-store');
                        endif;
                        ?>
                    </div>
                    
                    <?php
                    // Download section - uses plugin if available
                    $has_ebook_file = get_post_meta(get_the_ID(), '_edm_file_url', true);
                    $external_link = get_post_meta(get_the_ID(), '_book_download_link', true);
                    
                    if ($has_ebook_file) {
                        // Use the Ebook Download Manager plugin
                        echo do_shortcode('[download_ebook id="' . get_the_ID() . '" text="Download Ebook" show_size="yes" show_count="yes"]');
                    } elseif ($external_link) {
                        // Fallback to external link
                        $downloads = get_post_meta(get_the_ID(), '_download_count', true) ?: 0;
                        ?>
                        <div class="book-actions">
                            <a href="<?php echo esc_url($external_link); ?>" class="download-button download-count-btn" data-id="<?php echo get_the_ID(); ?>" target="_blank">
                                📥 <?php _e('Purchase / Download', 'ebook-store'); ?> →
                            </a>
                            <div class="download-stats-wrapper">
                                <span class="download-icon">📊</span>
                                <span class="download-count-display"><?php echo $downloads; ?></span>
                                <span class="download-label"><?php _e('downloads', 'ebook-store'); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <div class="book-content">
                <h2><?php _e('About This Book', 'ebook-store'); ?></h2>
                <div class="book-description">
                    <?php the_content(); ?>
                </div>
            </div>
            
            <?php if ($author_id) : ?>
                <div class="author-bio-section">
                    <h2><?php _e('About the Author', 'ebook-store'); ?></h2>
                    <div class="author-bio">
                        <?php if (has_post_thumbnail($author_id)) : ?>
                            <div class="author-photo">
                                <?php echo get_the_post_thumbnail($author_id, 'author-photo'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="author-info">
                            <h3><?php echo esc_html($author->post_title); ?></h3>
                            <div class="author-bio-text">
                                <?php echo wp_trim_words(get_post_field('post_content', $author_id), 100); ?>
                            </div>
                            <a href="<?php echo get_permalink($author_id); ?>" class="read-more">
                                <?php _e('Read More About Author', 'ebook-store'); ?> →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php
            // Related books
            if (!empty($genres) && !is_wp_error($genres)) :
                $genre_ids = wp_list_pluck($genres, 'term_id');
                $related_args = array(
                    'post_type' => 'books',
                    'posts_per_page' => 4,
                    'post__not_in' => array(get_the_ID()),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'genre',
                            'field' => 'term_id',
                            'terms' => $genre_ids,
                        ),
                    ),
                );
                
                $related_books = new WP_Query($related_args);
                if ($related_books->have_posts()) : ?>
                    <div class="related-books">
                        <h2><?php _e('You Might Also Like', 'ebook-store'); ?></h2>
                        <div class="books-grid">
                            <?php while ($related_books->have_posts()) : $related_books->the_post(); ?>
                                <?php get_template_part('template-parts/book-card'); ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php wp_reset_postdata();
                endif;
            endif; ?>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>