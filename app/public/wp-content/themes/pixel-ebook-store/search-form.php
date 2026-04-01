<?php
/**
 * The layout of the search results page template
 *
 * @package Pixel Ebook Store
 */
?>

<form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label>
	    <span class="screen-reader-text"><?php echo esc_html_x('Search for:', 'label', 'pixel-ebook-store'); ?></span>
	    <input type="search" class="search-field" 
	           placeholder="<?php echo esc_attr_x('Search everything here...', 'placeholder', 'pixel-ebook-store'); ?>" 
	           value="<?php echo esc_attr(get_search_query()); ?>" 
	           name="s" />
	</label>
	<button type="submit" class="search-submit">
	    <?php echo esc_html__('Search', 'pixel-ebook-store'); ?>
	</button>
</form>