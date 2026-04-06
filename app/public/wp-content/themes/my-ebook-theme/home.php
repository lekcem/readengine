<?php
/**
 * Template Name: Homepage
 * The home page template with book covers
 */

get_header(); ?>

<div class="home-page">
    
    <!-- Hero Section with Search -->
    <section class="hero-section-modern">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Discover Your Next<br><span class="highlight">Great Read</span></h1>
                <p class="hero-description">Explore thousands of ebooks from talented authors worldwide. Find your perfect book today.</p>
                <div class="hero-search">
                    <?php get_template_part('template-parts/search-form'); ?>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo wp_count_posts('books')->publish; ?></span>
                        <span class="stat-label">Books</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo wp_count_terms(array('taxonomy' => 'genre', 'hide_empty' => false)); ?></span>
                        <span class="stat-label">Genres</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo wp_count_posts('authors')->publish; ?></span>
                        <span class="stat-label">Authors</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Books Section -->
    <section class="featured-books-modern">
        <div class="container">
            <div class="section-header-modern">
                <h2>Featured Books</h2>
                <p>Discover our most popular and recently added books</p>
            </div>
            <div class="books-grid">
                <?php
                $featured_books = new WP_Query(array(
                    'post_type' => 'books',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($featured_books->have_posts()) :
                    while ($featured_books->have_posts()) : $featured_books->the_post();
                        get_template_part('template-parts/book-card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p class="no-results">' . __('No books found.', 'ebook-store') . '</p>';
                endif;
                ?>
            </div>
            <div class="view-all">
                <a href="<?php echo get_post_type_archive_link('books'); ?>" class="view-all-link-modern">Browse All Books →</a>
            </div>
        </div>
    </section>

    <!-- Categories Section - Genres & Age Groups Combined -->
    <section class="categories-section">
        <div class="container">
            <div class="section-header-modern">
                <h2>Browse by Category</h2>
                <p>Find books that match your interests</p>
            </div>
            
            <!-- Popular Genres -->
            <div class="category-group">
                <h3>Popular Genres</h3>
                <div class="genres-grid-modern">
                    <?php
                    $genres = get_terms(array(
                        'taxonomy' => 'genre',
                        'hide_empty' => false,
                        'number' => 6
                    ));
                    
                    if (!empty($genres) && !is_wp_error($genres)) :
                        foreach ($genres as $genre) :
                            $genre_link = get_term_link($genre);
                            if (!is_wp_error($genre_link)) :
                            ?>
                            <a href="<?php echo esc_url($genre_link); ?>" class="category-card">
                                <div class="category-icon">📖</div>
                                <h4><?php echo esc_html($genre->name); ?></h4>
                                <p><?php echo esc_html($genre->count); ?> books</p>
                            </a>
                            <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            
            <!-- Age Groups -->
            <div class="category-group">
                <h3>Age Groups</h3>
                <div class="age-groups-grid-modern">
                    <?php
                    $age_groups = get_terms(array(
                        'taxonomy' => 'age_group',
                        'hide_empty' => false,
                    ));
                    
                    if (!empty($age_groups) && !is_wp_error($age_groups)) :
                        foreach ($age_groups as $age_group) :
                            $age_link = get_term_link($age_group);
                            if (!is_wp_error($age_link)) :
                            ?>
                            <a href="<?php echo esc_url($age_link); ?>" class="age-card-modern">
                                <div class="age-icon-modern">
                                    <?php
                                    switch($age_group->slug) {
                                        case 'kids':
                                            echo '🧸';
                                            break;
                                        case 'teens':
                                            echo '🌟';
                                            break;
                                        case 'adults':
                                            echo '🎯';
                                            break;
                                        default:
                                            echo '📚';
                                    }
                                    ?>
                                </div>
                                <h4><?php echo esc_html($age_group->name); ?></h4>
                                <p><?php echo esc_html($age_group->count); ?> books</p>
                            </a>
                            <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Authors Section -->
    <section class="our-authors-modern">
        <div class="container">
            <div class="section-header-modern">
                <h2>Meet Our Authors</h2>
                <p>Discover talented writers from around the world</p>
            </div>
            <div class="authors-grid-home">
                <?php
                $authors = new WP_Query(array(
                    'post_type' => 'authors',
                    'posts_per_page' => 6,
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
                                        <?php 
                                        $bio = get_the_excerpt();
                                        if (empty($bio)) {
                                            $bio = get_post_field('post_content', get_the_ID());
                                        }
                                        echo wp_trim_words($bio, 15);
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
                                        📚 <?php echo $book_count->post_count; ?> books
                                    </div>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>' . __('No authors found. Please add some authors.', 'ebook-store') . '</p>';
                endif;
                ?>
            </div>
            <div class="view-all">
                <a href="<?php echo get_post_type_archive_link('authors'); ?>" class="view-all-link-modern">View All Authors →</a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section-modern">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Start Reading?</h2>
                <p>Join thousands of readers who have discovered their next favorite book with us.</p>
                <a href="<?php echo get_post_type_archive_link('books'); ?>" class="cta-button-modern">
                    Start Exploring Now →
                </a>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>