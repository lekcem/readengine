<?php
/**
 * Template Name: Homepage
 * The home page template with book covers
 */

get_header(); ?>

<div class="home-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1><?php _e('Welcome to Our Ebook Store', 'ebook-store'); ?></h1>
            <p><?php _e('Discover amazing books from talented authors', 'ebook-store'); ?></p>
        </div>
    </section>

    <!-- Featured Books Section -->
    <section class="featured-books">
        <div class="container">
            <h2><?php _e('Featured Books', 'ebook-store'); ?></h2>
            <div class="books-grid">
                <?php
                $featured_books = new WP_Query(array(
                    'post_type' => 'books',
                    'posts_per_page' => 12,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($featured_books->have_posts()) :
                    while ($featured_books->have_posts()) : $featured_books->the_post();
                        get_template_part('template-parts/book-card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>' . __('No books found.', 'ebook-store') . '</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Popular Genres Section -->
    <section class="popular-genres">
        <div class="container">
            <h2><?php _e('Popular Genres', 'ebook-store'); ?></h2>
            <div class="genres-grid">
                <?php
                $genres = get_terms(array(
                    'taxonomy' => 'genre',
                    'hide_empty' => false,
                ));
                
                if (!empty($genres) && !is_wp_error($genres)) :
                    foreach ($genres as $genre) :
                        $genre_link = get_term_link($genre);
                        if (!is_wp_error($genre_link)) :
                        ?>
                        <a href="<?php echo esc_url($genre_link); ?>" class="genre-card">
                            <h3><?php echo esc_html($genre->name); ?></h3>
                            <p><?php echo esc_html($genre->count); ?> <?php _e('books', 'ebook-store'); ?></p>
                        </a>
                        <?php
                        endif;
                    endforeach;
                else :
                    echo '<p>' . __('No genres found. Please add some genres.', 'ebook-store') . '</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Age Groups Section -->
    <section class="age-groups">
        <div class="container">
            <h2><?php _e('Browse by Age Group', 'ebook-store'); ?></h2>
            <div class="age-groups-grid">
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
                        <a href="<?php echo esc_url($age_link); ?>" class="age-card">
                            <div class="age-icon">
                                <?php
                                switch($age_group->slug) {
                                    case 'kids':
                                        echo '🧸';
                                        break;
                                    case 'teens':
                                        echo '📚';
                                        break;
                                    case 'adults':
                                        echo '🎓';
                                        break;
                                    default:
                                        echo '📖';
                                }
                                ?>
                            </div>
                            <h3><?php echo esc_html($age_group->name); ?></h3>
                            <p><?php echo esc_html($age_group->count); ?> <?php _e('books', 'ebook-store'); ?></p>
                        </a>
                        <?php
                        endif;
                    endforeach;
                else :
                    echo '<p>' . __('No age groups found. Please add some age groups.', 'ebook-store') . '</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Our Authors Section (NEW) -->
    <section class="our-authors">
        <div class="container">
            <h2><?php _e('Our Authors', 'ebook-store'); ?></h2>
            <div class="authors-grid-home">
                <?php
                $authors = new WP_Query(array(
                    'post_type' => 'authors',
                    'posts_per_page' => 8,
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
                    echo '<p>' . __('No authors found. Please add some authors.', 'ebook-store') . '</p>';
                endif;
                ?>
            </div>
            <div class="view-all-link">
                <a href="<?php echo get_post_type_archive_link('authors'); ?>" class="view-all-button">
                    <?php _e('View All Authors', 'ebook-store'); ?> →
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <h2><?php _e('Ready to Start Reading?', 'ebook-store'); ?></h2>
            <p><?php _e('Browse our collection of amazing ebooks and find your next favorite read.', 'ebook-store'); ?></p>
            <a href="<?php echo get_post_type_archive_link('books'); ?>" class="cta-button">
                <?php _e('Browse All Books', 'ebook-store'); ?> →
            </a>
        </div>
    </section>
</div>

<?php get_footer(); ?>