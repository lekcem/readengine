    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="footer-container">
            <div class="footer-widgets">
                <!-- Brand Column -->
                <div class="footer-brand">
                    <h3 class="footer-logo">ReadEngine</h3>
                    <p class="footer-tagline"><?php _e('Your premier destination for quality ebooks from talented authors worldwide.', 'ebook-store'); ?></p>
                </div>
                
                <!-- Explore Links -->
                <div class="footer-links">
                    <h4><?php _e('Explore', 'ebook-store'); ?></h4>
                    <ul class="footer-menu">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'ebook-store'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('books')); ?>"><?php _e('All Books', 'ebook-store'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('authors')); ?>"><?php _e('All Authors', 'ebook-store'); ?></a></li>
                    </ul>
                </div>
                
                <!-- Genres Links -->
                <div class="footer-links">
                    <h4><?php _e('Genres', 'ebook-store'); ?></h4>
                    <ul class="footer-menu">
                        <?php
                        $genres = get_terms(array(
                            'taxonomy' => 'genre',
                            'hide_empty' => false,
                            'number' => 8
                        ));
                        
                        if (!empty($genres) && !is_wp_error($genres)) :
                            foreach ($genres as $genre) :
                                ?>
                                <li><a href="<?php echo esc_url(get_term_link($genre)); ?>"><?php echo esc_html($genre->name); ?></a></li>
                                <?php
                            endforeach;
                        else :
                            echo '<li>' . __('No genres found', 'ebook-store') . '</li>';
                        endif;
                        ?>
                    </ul>
                </div>
                
                <!-- Age Groups Links -->
                <div class="footer-links">
                    <h4><?php _e('Age Groups', 'ebook-store'); ?></h4>
                    <ul class="footer-menu">
                        <?php
                        $age_groups = get_terms(array(
                            'taxonomy' => 'age_group',
                            'hide_empty' => false
                        ));
                        
                        if (!empty($age_groups) && !is_wp_error($age_groups)) :
                            foreach ($age_groups as $age_group) :
                                ?>
                                <li><a href="<?php echo esc_url(get_term_link($age_group)); ?>"><?php echo esc_html($age_group->name); ?></a></li>
                                <?php
                            endforeach;
                        else :
                            echo '<li>' . __('No age groups found', 'ebook-store') . '</li>';
                        endif;
                        ?>
                    </ul>
                </div>
                
            
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <strong>ReadEngine</strong>. <?php _e('All rights reserved.', 'ebook-store'); ?></p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>