<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <ul id="primary-menu" class="menu">
                    <li class="menu-item">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            🏠 <?php _e('Home', 'ebook-store'); ?>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo esc_url(get_post_type_archive_link('books')); ?>">
                            📚 <?php _e('Books', 'ebook-store'); ?>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo esc_url(get_post_type_archive_link('authors')); ?>">
                            ✍️ <?php _e('Authors', 'ebook-store'); ?>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Auth Buttons -->
            <div class="header-auth">
                <?php if (is_user_logged_in()) : ?>
                    <div class="user-menu" id="user-menu">
                        <div class="user-greeting" id="user-greeting">
                            👋 <?php echo esc_html(wp_get_current_user()->display_name); ?>
                            <span class="dropdown-arrow">▼</span>
                        </div>
                        <div class="user-dropdown" id="user-dropdown">
                            <?php if (current_user_can('administrator')) : ?>
                                <a href="<?php echo esc_url(admin_url()); ?>" class="auth-buttons">
                                    ⚙️ <?php _e('Admin', 'ebook-store'); ?>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo esc_url(get_post_type_archive_link('books')); ?>" class="auth-buttons">
                                📚 <?php _e('Browse Books', 'ebook-store'); ?>
                            </a>
                            <a href="<?php echo esc_url(get_post_type_archive_link('authors')); ?>" class="auth-buttons">
                                ✍️ <?php _e('Browse Authors', 'ebook-store'); ?>
                            </a>
                            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="auth-buttons logout">
                                🚪 <?php _e('Log Out', 'ebook-store'); ?>
                            </a>
                        </div>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="auth-buttons login-btn">
                        🔑 <?php _e('Login', 'ebook-store'); ?>
                    </a>
                    <a href="<?php echo esc_url(wp_registration_url()); ?>" class="auth-buttons signup-btn">
                        ✨ <?php _e('Sign Up', 'ebook-store'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Search Bar -->
            <div class="header-search">
                <?php get_template_part('template-parts/search-form'); ?>
            </div>

            <button class="mobile-menu-toggle" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <div id="content" class="site-content">