<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bsd
 */

?>
    </div><!-- #page -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="logo">
                <img width="100" height="100" src="<?php echo get_theme_file_uri()?>/image/bspar.png" alt="BSPAR" />
            </div>
            <div class="site-info">
                <a href=""><img src="" alt="instagram"></a>
                <a href=""><img src="" alt="facebook"></a>
                <a href=""><img src="" alt="whatsapp"></a>
                <a href=""><img src="" alt="linkedin"></a>
                <a href=""><img src="" alt="youtube"></a>
            </div><!-- .site-info -->
        </div>
    </footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>

<!-- JavaScript -->
<script src="<?php echo get_theme_file_uri()?>/js/flickity.pkgd.min.js"></script>
<script src="<?php echo get_theme_file_uri()?>/js/custom.js"></script>
</html>
