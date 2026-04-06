<?php
/**
 * Search template
 */

get_header(); ?>

<div class="search-container">
    <div class="container">
        <header class="archive-header">
            <h1 class="archive-title">
                <?php printf(__('Search Results for: "%s"', 'ebook-store'), get_search_query()); ?>
            </h1>
            <p class="search-count">
                <?php
                global $wp_query;
                echo $wp_query->found_posts . ' ' . __('results found', 'ebook-store');
                ?>
            </p>
        </header>
        
        <div class="search-results">
            <?php if (have_posts()) : ?>
                <div class="books-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php if (get_post_type() == 'books') : ?>
                            <?php get_template_part('template-parts/book-card'); ?>
                        <?php elseif (get_post_type() == 'authors') : ?>
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
                                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                        </div>
                                        <div class="author-type"><?php _e('Author', 'ebook-store'); ?></div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'total' => $wp_query->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'prev_text' => __('« Previous', 'ebook-store'),
                        'next_text' => __('Next »', 'ebook-store'),
                    ));
                    ?>
                </div>
                
            <?php else : ?>
                <div class="no-search-results">
                    <div class="no-results-icon">🔍</div>
                    <h2><?php _e('No results found', 'ebook-store'); ?></h2>
                    <p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'ebook-store'); ?></p>
                    <div class="search-suggestions">
                        <h3><?php _e('Search Suggestions:', 'ebook-store'); ?></h3>
                        <ul>
                            <li><?php _e('Check your spelling', 'ebook-store'); ?></li>
                            <li><?php _e('Try using fewer or different keywords', 'ebook-store'); ?></li>
                            <li><?php _e('Browse our books or authors instead', 'ebook-store'); ?></li>
                        </ul>
                    </div>
                    <div class="search-again">
                    </div>
                    <div class="browse-links">
                        <a href="<?php echo get_post_type_archive_link('books'); ?>" class="browse-button">
                            📚 <?php _e('Browse All Books', 'ebook-store'); ?>
                        </a>
                        <a href="<?php echo get_post_type_archive_link('authors'); ?>" class="browse-button">
                            ✍️ <?php _e('Browse All Authors', 'ebook-store'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>