<?php
/**
 * Archive template for books
 */

get_header(); ?>

<div class="archive-books-container">
    <header class="archive-header">
        <h1 class="archive-title"><?php _e('All Books', 'ebook-store'); ?></h1>
        
        <div class="archive-filters">
            <div class="filter-group">
                <label for="genre-filter"><?php _e('Filter by Genre:', 'ebook-store'); ?></label>
                <select id="genre-filter" class="filter-select">
                    <option value=""><?php _e('All Genres', 'ebook-store'); ?></option>
                    <?php
                    $genres = get_terms(array('taxonomy' => 'genre', 'hide_empty' => true));
                    foreach ($genres as $genre) :
                        $selected = (isset($_GET['genre']) && $_GET['genre'] == $genre->slug) ? 'selected' : '';
                        echo '<option value="' . esc_attr($genre->slug) . '" ' . $selected . '>' . esc_html($genre->name) . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="age-filter"><?php _e('Filter by Age:', 'ebook-store'); ?></label>
                <select id="age-filter" class="filter-select">
                    <option value=""><?php _e('All Ages', 'ebook-store'); ?></option>
                    <?php
                    $age_groups = get_terms(array('taxonomy' => 'age_group', 'hide_empty' => true));
                    foreach ($age_groups as $age_group) :
                        $selected = (isset($_GET['age']) && $_GET['age'] == $age_group->slug) ? 'selected' : '';
                        echo '<option value="' . esc_attr($age_group->slug) . '" ' . $selected . '>' . esc_html($age_group->name) . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="sort-by"><?php _e('Sort by:', 'ebook-store'); ?></label>
                <select id="sort-by" class="filter-select">
                    <option value="title_asc"><?php _e('Title A-Z', 'ebook-store'); ?></option>
                    <option value="title_desc"><?php _e('Title Z-A', 'ebook-store'); ?></option>
                    <option value="date_desc"><?php _e('Newest First', 'ebook-store'); ?></option>
                    <option value="date_asc"><?php _e('Oldest First', 'ebook-store'); ?></option>
                </select>
            </div>
        </div>
    </header>
    
    <div class="books-grid" id="books-grid">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        $args = array(
            'post_type' => 'books',
            'posts_per_page' => 12,
            'paged' => $paged,
        );
        
        // Apply filters
        if (isset($_GET['genre']) && !empty($_GET['genre'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'genre',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['genre']),
            );
        }
        
        if (isset($_GET['age']) && !empty($_GET['age'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'age_group',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['age']),
            );
        }
        
        // Apply sorting
        if (isset($_GET['sort'])) {
            switch($_GET['sort']) {
                case 'title_asc':
                    $args['orderby'] = 'title';
                    $args['order'] = 'ASC';
                    break;
                case 'title_desc':
                    $args['orderby'] = 'title';
                    $args['order'] = 'DESC';
                    break;
                case 'date_desc':
                    $args['orderby'] = 'date';
                    $args['order'] = 'DESC';
                    break;
                case 'date_asc':
                    $args['orderby'] = 'date';
                    $args['order'] = 'ASC';
                    break;
                default:
                    $args['orderby'] = 'date';
                    $args['order'] = 'DESC';
            }
        }
        
        $books_query = new WP_Query($args);
        
        if ($books_query->have_posts()) :
            while ($books_query->have_posts()) : $books_query->the_post();
                get_template_part('template-parts/book-card');
            endwhile;
        else :
            echo '<p class="no-results">' . __('No books found.', 'ebook-store') . '</p>';
        endif;
        ?>
    </div>
    
    <?php
    echo '<div class="pagination">';
    echo paginate_links(array(
        'total' => $books_query->max_num_pages,
        'current' => $paged,
        'prev_text' => __('« Previous', 'ebook-store'),
        'next_text' => __('Next »', 'ebook-store'),
    ));
    echo '</div>';
    
    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>