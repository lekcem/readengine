<?php
/**
 * Template part for displaying book cards
 */
?>

<div class="book-card">
    <a href="<?php the_permalink(); ?>" class="book-card-link">
        <div class="book-card-cover">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('book-cover'); ?>
            <?php else : ?>
                <div class="no-cover-placeholder">
                    <span>📚</span>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="book-card-info">
            <h3 class="book-card-title"><?php the_title(); ?></h3>
            
            <?php
            $author_id = get_post_meta(get_the_ID(), '_book_author', true);
            if ($author_id) :
                $author = get_post($author_id);
                ?>
                <div class="book-card-author">
                    <?php _e('by', 'ebook-store'); ?> <?php echo esc_html($author->post_title); ?>
                </div>
            <?php endif; ?>
            
            <div class="book-card-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
            </div>
            
            <?php
            $price = get_post_meta(get_the_ID(), '_book_price', true);
            if ($price) : ?>
                <div class="book-card-price">
                    $<?php echo esc_html($price); ?>
                </div>
            <?php endif; ?>
            
            <div class="book-card-genres">
                <?php
                $genres = get_the_terms(get_the_ID(), 'genre');
                if ($genres && !is_wp_error($genres)) :
                    $genre_names = wp_list_pluck($genres, 'name');
                    echo implode(', ', array_slice($genre_names, 0, 2));
                    if (count($genre_names) > 2) echo '...';
                endif;
                ?>
            </div>
        </div>
    </a>
</div>