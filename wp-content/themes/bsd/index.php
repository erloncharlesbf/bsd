<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bsd
 */

get_header();
?>

    <main id="primary" class="site-main">
		<?php
		$loop = new WP_Query( [ 'post_type' => 'slideshows', 'posts_per_page' => 10 ] ); ?>
        <ul id="slideshows">
			<?php
			while ( $loop->have_posts() ) : $loop->the_post();
				$imageDesktop = get_field( 'imagem_desktop' );
				$imageMobile  = get_field( 'imagem_mobile' );
				$link         = get_field( 'link' );
				$newWindow    = get_field( 'abrir_em_nova_aba' );
				$status       = get_field( 'status' );
				?>
                <li>
					<?php
					if ( $link ) : ?>
                        <a href="<?php
						echo $link; ?>" <?php
						echo $newWindow ? 'target="_blank"' : null ?>>
                            <img class="slideshow-desktop" src="<?php
							echo $imageDesktop; ?>" alt="<?php
							echo get_the_title(); ?>">
                            <img class="slideshow-mobile" src="<?php
							echo $imageMobile; ?>" alt="<?php
							echo get_the_title(); ?>">
                        </a>
					<?php
					else: ?>
                        <img src="<?php
						echo $imageDesktop; ?>" alt="<?php
						echo get_the_title() ?>">
					<?php
					endif; ?>

                </li>
			<?php
			endwhile; ?>
        </ul>

    </main><!-- #main -->

<?php
//get_sidebar();
get_footer();
