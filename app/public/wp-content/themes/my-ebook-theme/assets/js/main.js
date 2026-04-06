jQuery(document).ready(function($) {
    // Mobile Menu Toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.main-navigation').toggleClass('active');
        $(this).toggleClass('active');
    });
    
    // AJAX Search
    let searchTimeout;
    $('#ajax-search-input').on('keyup', function() {
        clearTimeout(searchTimeout);
        let searchTerm = $(this).val();
        
        if (searchTerm.length < 2) {
            $('#ajax-search-results').removeClass('active').empty();
            return;
        }
        
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: ebook_store_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'ebook_store_search',
                    search_term: searchTerm,
                    nonce: ebook_store_ajax.nonce
                },
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        let resultsHtml = '';
                        $.each(response.data, function(index, item) {
                            resultsHtml += `
                                <a href="${item.url}" class="search-result-item">
                                    <div class="search-result-image">
                                        ${item.image ? `<img src="${item.image}" alt="${item.title}">` : '<div class="no-image">📚</div>'}
                                    </div>
                                    <div class="search-result-info">
                                        <h4>${item.title}</h4>
                                        <p>${item.type === 'books' ? 'Book' : 'Author'}</p>
                                    </div>
                                </a>
                            `;
                        });
                        $('#ajax-search-results').html(resultsHtml).addClass('active');
                    } else {
                        $('#ajax-search-results').html('<div class="no-results">No results found</div>').addClass('active');
                    }
                }
            });
        }, 500);
    });
    
    // Close search results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-wrapper').length) {
            $('#ajax-search-results').removeClass('active');
        }
    });
    
    // Filter and Sort functionality (only if filters exist on page)
    if ($('#genre-filter').length) {
        function updateBooks() {
            let genre = $('#genre-filter').val();
            let age = $('#age-filter').val();
            let sort = $('#sort-by').val();
            
            let urlParams = new URLSearchParams(window.location.search);
            if (genre) urlParams.set('genre', genre);
            else urlParams.delete('genre');
            
            if (age) urlParams.set('age', age);
            else urlParams.delete('age');
            
            if (sort) urlParams.set('sort', sort);
            else urlParams.delete('sort');
            
            window.location.search = urlParams.toString();
        }
        
        $('#genre-filter, #age-filter, #sort-by').on('change', function() {
            updateBooks();
        });
    }
    
    // Smooth scroll for anchor links
    $('a[href*="#"]:not([href="#"])').on('click', function() {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            let target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
                return false;
            }
        }
    });
    
    // Lazy loading images
    if ('IntersectionObserver' in window) {
        let lazyImages = document.querySelectorAll('img[data-src]');
        let imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(function(img) {
            imageObserver.observe(img);
        });
    }
});


jQuery(document).ready(function($) {
    // Mobile Menu Toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.main-navigation').toggleClass('active');
        $(this).toggleClass('active');
    });
    
    // User Menu Click Toggle (instead of hover)
    $('#user-greeting').on('click', function(e) {
        e.stopPropagation();
        $('#user-menu').toggleClass('active');
    });
    
    // Close user menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#user-menu').length) {
            $('#user-menu').removeClass('active');
        }
    });
    
    // Prevent dropdown from closing when clicking inside
    $('.user-dropdown').on('click', function(e) {
        e.stopPropagation();
    });
    
    // AJAX Search
    let searchTimeout;
    $('#ajax-search-input').on('keyup', function() {
        clearTimeout(searchTimeout);
        let searchTerm = $(this).val();
        
        if (searchTerm.length < 2) {
            $('#ajax-search-results').removeClass('active').empty();
            return;
        }
        
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: ebook_store_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'ebook_store_search',
                    search_term: searchTerm,
                    nonce: ebook_store_ajax.nonce
                },
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        let resultsHtml = '';
                        $.each(response.data, function(index, item) {
                            resultsHtml += `
                                <a href="${item.url}" class="search-result-item">
                                    <div class="search-result-image">
                                        ${item.image ? `<img src="${item.image}" alt="${item.title}">` : '<div class="no-image">📚</div>'}
                                    </div>
                                    <div class="search-result-info">
                                        <h4>${item.title}</h4>
                                        <p>${item.type === 'books' ? 'Book' : 'Author'}</p>
                                    </div>
                                </a>
                            `;
                        });
                        $('#ajax-search-results').html(resultsHtml).addClass('active');
                    } else {
                        $('#ajax-search-results').html('<div class="no-results">No results found</div>').addClass('active');
                    }
                }
            });
        }, 500);
    });
    
    // Close search results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-wrapper').length) {
            $('#ajax-search-results').removeClass('active');
        }
    });
    
    // Filter and Sort functionality (only if filters exist on page)
    if ($('#genre-filter').length) {
        function updateBooks() {
            let genre = $('#genre-filter').val();
            let age = $('#age-filter').val();
            let sort = $('#sort-by').val();
            
            let urlParams = new URLSearchParams(window.location.search);
            if (genre) urlParams.set('genre', genre);
            else urlParams.delete('genre');
            
            if (age) urlParams.set('age', age);
            else urlParams.delete('age');
            
            if (sort) urlParams.set('sort', sort);
            else urlParams.delete('sort');
            
            window.location.search = urlParams.toString();
        }
        
        $('#genre-filter, #age-filter, #sort-by').on('change', function() {
            updateBooks();
        });
    }
    
    // Smooth scroll for anchor links
    $('a[href*="#"]:not([href="#"])').on('click', function() {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            let target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
                return false;
            }
        }
    });
    
    // Lazy loading images
    if ('IntersectionObserver' in window) {
        let lazyImages = document.querySelectorAll('img[data-src]');
        let imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(function(img) {
            imageObserver.observe(img);
        });
    }
});