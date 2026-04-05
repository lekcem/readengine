<?php
/**
 * Simple Footer for Pixel Ebook Store
 *
 * @package Pixel Ebook Store
 */
?>

<footer id="colophon" class="site-footer" style="text-align:center; padding:20px; background:#f5f5f5;">
    <div class="site-footer-inner">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        <a href="#" id="return-to-top" style="display:inline-block; margin-top:10px;">
            <i class="fa-solid fa-angles-up"></i> Back to Top
        </a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>