<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-wrapper">
        <input type="search" 
               class="search-field" 
               placeholder="<?php esc_attr_e('Search books or authors...', 'ebook-store'); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               id="ajax-search-input"
               autocomplete="off" />
        <button type="submit" class="search-submit">
            🔍
        </button>
        <div id="ajax-search-results" class="ajax-search-results"></div>
    </div>
    <input type="hidden" name="post_type" value="books" />
</form>