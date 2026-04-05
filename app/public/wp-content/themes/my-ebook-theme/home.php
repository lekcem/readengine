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
                    'meta_key' => '_book_publication_date',
                    'orderby' => 'meta_value',
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
                    'hide_empty' => true,
                ));
                
                foreach ($genres as $genre) :
                    $genre_link = get_term_link($genre);
                    ?>
                    <a href="<?php echo esc_url($genre_link); ?>" class="genre-card">
                        <h3><?php echo esc_html($genre->name); ?></h3>
                        <p><?php echo esc_html($genre->count); ?> <?php _e('books', 'ebook-store'); ?></p>
                    </a>
                <?php endforeach; ?>
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
                    'hide_empty' => true,
                ));
                
                foreach ($age_groups as $age_group) :
                    $age_link = get_term_link($age_group);
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
                <?php endforeach; ?>
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