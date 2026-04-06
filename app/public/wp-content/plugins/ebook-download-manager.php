<?php
/**
 * Plugin Name: Ebook Download Manager
 * Description: Upload and manage ebook files (PDF, EPUB, MOBI) for download
 * Version: 2.0.0
 * Author: Your Name
 * Text Domain: ebook-download-manager
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// ============================================
// 1. ADD FILE UPLOAD META BOX
// ============================================

function edm_add_upload_meta_box() {
    add_meta_box(
        'edm_file_upload',
        __('Ebook File Download', 'ebook-download-manager'),
        'edm_file_upload_callback',
        'books',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'edm_add_upload_meta_box');

function edm_file_upload_callback($post) {
    wp_nonce_field('edm_save_file', 'edm_nonce');
    
    $file_url = get_post_meta($post->ID, '_edm_file_url', true);
    $file_size = get_post_meta($post->ID, '_edm_file_size', true);
    $file_type = get_post_meta($post->ID, '_edm_file_type', true);
    ?>
    <div class="edm-upload-container">
        <style>
            .edm-upload-container {
                padding: 20px;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            }
            .edm-file-info {
                background: white;
                padding: 15px;
                margin: 15px 0;
                border-radius: 8px;
                border-left: 4px solid #3498db;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }
            .edm-upload-button {
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 600;
                transition: transform 0.2s ease;
            }
            .edm-upload-button:hover {
                transform: translateY(-2px);
            }
            .edm-remove-button {
                background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                margin-left: 10px;
                font-weight: 600;
                transition: transform 0.2s ease;
            }
            .edm-remove-button:hover {
                transform: translateY(-2px);
            }
        </style>
        
        <div id="edm-file-preview">
            <?php if ($file_url) : ?>
                <div class="edm-file-info">
                    <strong>📄 Current File:</strong><br>
                    <?php echo basename($file_url); ?><br>
                    <span style="font-size: 0.9em; color: #666;">📊 Size: <?php echo $file_size; ?> | 📁 Type: <?php echo strtoupper($file_type); ?></span>
                </div>
            <?php endif; ?>
        </div>
        
        <input type="hidden" id="edm_file_url" name="edm_file_url" value="<?php echo esc_url($file_url); ?>">
        <input type="hidden" id="edm_file_size" name="edm_file_size" value="<?php echo esc_attr($file_size); ?>">
        <input type="hidden" id="edm_file_type" name="edm_file_type" value="<?php echo esc_attr($file_type); ?>">
        
        <button type="button" class="edm-upload-button" id="edm_upload_btn">
            📤 Upload Ebook File
        </button>
        <button type="button" class="edm-remove-button" id="edm_remove_btn" <?php echo !$file_url ? 'style="display:none"' : ''; ?>>
            🗑️ Remove File
        </button>
        
        <p class="description" style="margin-top: 10px; color: #666;">Supported formats: PDF, EPUB, MOBI. Max file size: 50MB</p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        var mediaUploader;
        
        $('#edm_upload_btn').click(function(e) {
            e.preventDefault();
            
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            mediaUploader = wp.media({
                title: 'Upload Ebook File',
                button: {
                    text: 'Use as Downloadable File'
                },
                multiple: false,
                library: {
                    type: ['application/pdf', 'application/epub+zip', 'application/x-mobipocket-ebook']
                }
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                var fileSize = (attachment.filesizeInBytes / 1048576).toFixed(2) + ' MB';
                var fileType = attachment.subtype || attachment.type;
                
                $('#edm_file_url').val(attachment.url);
                $('#edm_file_size').val(fileSize);
                $('#edm_file_type').val(fileType);
                
                $('#edm-file-preview').html(`
                    <div class="edm-file-info">
                        <strong>📄 Current File:</strong><br>
                        ${attachment.filename}<br>
                        <span style="font-size: 0.9em; color: #666;">📊 Size: ${fileSize} | 📁 Type: ${fileType.toUpperCase()}</span>
                    </div>
                `);
                
                $('#edm_remove_btn').show();
            });
            
            mediaUploader.open();
        });
        
        $('#edm_remove_btn').click(function() {
            $('#edm_file_url').val('');
            $('#edm_file_size').val('');
            $('#edm_file_type').val('');
            $('#edm-file-preview').html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}

function edm_save_file_meta($post_id) {
    if (!isset($_POST['edm_nonce']) || !wp_verify_nonce($_POST['edm_nonce'], 'edm_save_file')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['edm_file_url'])) {
        update_post_meta($post_id, '_edm_file_url', esc_url_raw($_POST['edm_file_url']));
        update_post_meta($post_id, '_edm_file_size', sanitize_text_field($_POST['edm_file_size']));
        update_post_meta($post_id, '_edm_file_type', sanitize_text_field($_POST['edm_file_type']));
    }
}
add_action('save_post', 'edm_save_file_meta');

// ============================================
// 2. DOWNLOAD HANDLER
// ============================================

function edm_handle_download() {
    if (!isset($_GET['edm_download']) || !isset($_GET['book_id'])) {
        return;
    }
    
    $book_id = intval($_GET['book_id']);
    $nonce = $_GET['_wpnonce'] ?? '';
    
    if (!wp_verify_nonce($nonce, 'edm_download_' . $book_id)) {
        wp_die('Invalid download request.');
    }
    
    $file_url = get_post_meta($book_id, '_edm_file_url', true);
    
    if (!$file_url) {
        wp_die('File not found.');
    }
    
    // Get file path from URL
    $upload_dir = wp_upload_dir();
    $file_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $file_url);
    
    // Increment download count
    $downloads = get_post_meta($book_id, '_edm_download_count', true) ?: 0;
    $downloads++;
    update_post_meta($book_id, '_edm_download_count', $downloads);
    
    // Force download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
}
add_action('init', 'edm_handle_download');

// ============================================
// 3. DISPLAY DOWNLOAD BUTTON ON FRONTEND
// ============================================

function edm_download_button_shortcode_restricted($atts) {
    $atts = shortcode_atts(array(
        'id' => get_the_ID(),
        'text' => 'Download Ebook',
        'show_size' => 'yes',
        'show_count' => 'yes'
    ), $atts);
    
    $book_id = intval($atts['id']);
    $file_url = get_post_meta($book_id, '_edm_file_url', true);
    $file_size = get_post_meta($book_id, '_edm_file_size', true);
    $file_type = get_post_meta($book_id, '_edm_file_type', true);
    $download_count = get_post_meta($book_id, '_edm_download_count', true) ?: 0;
    
    if (!$file_url) {
        return '<p class="edm-no-file">No downloadable file available for this book.</p>';
    }
    
    // Check if user is logged in
    if (!is_user_logged_in()) {
        // Modern login/register message
        ob_start();
        ?>
        <div class="edm-restricted-wrapper">
            <div class="edm-restricted-card">
                <p>This ebook is available for registered members only.</p>
                <div class="edm-restricted-buttons">
                    <a href="<?php echo esc_url(wp_login_url(get_permalink($book_id))); ?>" class="edm-restricted-login">
                        <span>🔑</span> Login to Your Account
                    </a>
                    <a href="<?php echo esc_url(wp_registration_url()); ?>" class="edm-restricted-register">
                        <span>✨</span> Create Free Account
                    </a>
                </div>
                
            </div>
        </div>
        <style>
            .edm-restricted-wrapper {
                margin: 30px 0;
            }
            .edm-restricted-card {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 20px;
                padding: 40px;
                text-align: center;
                color: white;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                position: relative;
                overflow: hidden;
            }
            .edm-restricted-card::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 1%, transparent 1%);
                background-size: 50px 50px;
                animation: edm-shine 20s linear infinite;
            }
            @keyframes edm-shine {
                0% { transform: translate(0, 0); }
                100% { transform: translate(50px, 50px); }
            }
            .edm-restricted-icon {
                font-size: 4rem;
                margin-bottom: 20px;
                position: relative;
                z-index: 1;
            }
            .edm-restricted-card h3 {
                font-size: 1.8rem;
                margin-bottom: 10px;
                position: relative;
                z-index: 1;
            }
            .edm-restricted-card p {
                font-size: 1rem;
                margin-bottom: 25px;
                opacity: 0.95;
                position: relative;
                z-index: 1;
            }
            .edm-restricted-buttons {
                display: flex;
                gap: 15px;
                justify-content: center;
                flex-wrap: wrap;
                position: relative;
                z-index: 1;
            }
            .edm-restricted-login, .edm-restricted-register {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 12px 28px;
                background: white;
                color: #667eea;
                text-decoration: none;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }
            .edm-restricted-register {
                background: #ffd700;
                color: #333;
            }
            .edm-restricted-login:hover, .edm-restricted-register:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            }
            .edm-restricted-stats {
                margin-top: 25px;
                font-size: 0.85rem;
                opacity: 0.8;
                position: relative;
                z-index: 1;
            }
        </style>
        <?php
        return ob_get_clean();
    }
    
    // User is logged in - show modern download button
    $download_url = add_query_arg(array(
        'edm_download' => '1',
        'book_id' => $book_id,
        '_wpnonce' => wp_create_nonce('edm_download_' . $book_id)
    ), home_url());
    
    ob_start();
    ?>
    <div class="edm-download-modern">
        <div class="edm-download-card">
            <div class="edm-download-header">

            </div>
            <a href="<?php echo esc_url($download_url); ?>" class="edm-download-btn">
                <span class="edm-btn-icon">⬇️</span>
                <?php echo esc_html($atts['text']); ?>
                <span class="edm-btn-arrow">→</span>
            </a>
            <div class="edm-download-footer">
                <?php if ($atts['show_size'] == 'yes' && $file_size) : ?>
                    <span class="edm-footer-item">📊 <?php echo esc_html($file_size); ?></span>
                <?php endif; ?>
                <?php if ($file_type && $atts['show_size'] == 'yes') : ?>
                    <span class="edm-footer-item">📁 <?php echo strtoupper(esc_html($file_type)); ?></span>
                <?php endif; ?>
               
            </div>
        </div>
    </div>
    <style>
        .edm-download-modern {
            margin: 30px 0;
        }
        .edm-download-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            border-radius: 24px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(52,152,219,0.1);
        }
        .edm-download-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .edm-download-header {
            margin-bottom: 25px;
        }
        .edm-download-icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        .edm-download-header h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .edm-download-header p {
            color: #666;
            font-size: 0.9rem;
        }
        .edm-download-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 14px 35px;
            text-decoration: none;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(52,152,219,0.3);
        }
        .edm-download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52,152,219,0.4);
        }
        .edm-btn-icon {
            font-size: 1.2rem;
        }
        .edm-btn-arrow {
            transition: transform 0.3s ease;
        }
        .edm-download-btn:hover .edm-btn-arrow {
            transform: translateX(5px);
        }
        .edm-download-footer {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            padding-top: 15px;
            border-top: 1px solid rgba(0,0,0,0.05);
        }
        .edm-footer-item {
            font-size: 0.8rem;
            color: #888;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .edm-no-file {
            background: #fee;
            color: #e74c3c;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            border-left: 4px solid #e74c3c;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('download_ebook', 'edm_download_button_shortcode_restricted');

// ============================================
// 4. ADD DOWNLOAD COLUMN TO ADMIN
// ============================================

function edm_add_download_column($columns) {
    $columns['edm_downloads'] = 'Downloads';
    return $columns;
}
add_filter('manage_books_posts_columns', 'edm_add_download_column');

function edm_show_download_column($column, $post_id) {
    if ($column == 'edm_downloads') {
        $count = get_post_meta($post_id, '_edm_download_count', true) ?: 0;
        echo '<span style="background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); color: white; padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 13px;">' . $count . '</span>';
    }
}
add_action('manage_books_posts_custom_column', 'edm_show_download_column', 10, 2);

// ============================================
// 5. MOST DOWNLOADED WIDGET
// ============================================

class EDM_Most_Downloaded_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'edm_most_downloaded',
            'Most Downloaded Ebooks',
            array('description' => 'Display books with most downloads')
        );
    }
    
    public function widget($args, $instance) {
        $title = $instance['title'] ?? 'Most Downloaded Ebooks';
        $number = $instance['number'] ?? 5;
        
        $query = new WP_Query(array(
            'post_type' => 'books',
            'posts_per_page' => $number,
            'meta_key' => '_edm_download_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        
        if ($query->have_posts()) {
            echo $args['before_widget'];
            echo $args['before_title'] . $title . $args['after_title'];
            echo '<div class="edm-most-downloaded-grid">';
            
            while ($query->have_posts()) {
                $query->the_post();
                $downloads = get_post_meta(get_the_ID(), '_edm_download_count', true) ?: 0;
                ?>
                <div class="edm-widget-item">
                    <a href="<?php the_permalink(); ?>" class="edm-widget-link">
                        <div class="edm-widget-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('thumbnail'); ?>
                            <?php else : ?>
                                <div class="edm-widget-no-image">📚</div>
                            <?php endif; ?>
                        </div>
                        <div class="edm-widget-info">
                            <span class="edm-widget-title"><?php the_title(); ?></span>
                            <span class="edm-widget-downloads">📥 <?php echo $downloads; ?> downloads</span>
                        </div>
                    </a>
                </div>
                <?php
            }
            echo '</div>';
            echo $args['after_widget'];
            wp_reset_postdata();
        }
    }
    
    public function form($instance) {
        $title = $instance['title'] ?? 'Most Downloaded Ebooks';
        $number = $instance['number'] ?? 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">Number of books:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo esc_attr($number); ?>">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = intval($new_instance['number']);
        return $instance;
    }
}

function edm_register_widget() {
    register_widget('EDM_Most_Downloaded_Widget');
}
add_action('widgets_init', 'edm_register_widget');

// ============================================
// 6. CHECK USER LOGIN BEFORE DOWNLOAD
// ============================================

function edm_check_user_before_download() {
    if (isset($_GET['edm_download']) && isset($_GET['book_id'])) {
        if (!is_user_logged_in()) {
            $book_id = intval($_GET['book_id']);
            $redirect_url = add_query_arg('redirect_to', get_permalink($book_id), wp_login_url());
            wp_redirect($redirect_url);
            exit;
        }
    }
}
add_action('init', 'edm_check_user_before_download', 5);