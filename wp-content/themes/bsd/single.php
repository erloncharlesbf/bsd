<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bsd
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content', get_post_type() );
	            ?>

                <?php echo get_the_content() ?>

	            <div>Andar: <?php echo get_field('andar') ?></div>
	            <div>Sala: <?php echo get_field('sala') ?></div>
	            <div>Descrição: <?php echo get_field('descricao') ?></div>

	            <?php  the_post_thumbnail() ?>
	            <div>Horário de funcionamento: <?php echo get_field('horario_de_funcionamento') ?></div>
	            <div>Telefone de contato: <?php echo get_field('telefone_de_contato') ?></div>
	            <div>E-mail: <?php echo get_field('e-mail') ?></div>
	            <div>Instagram: <?php echo get_field('instagram') ?></div>
	            <div>Facebook: <?php echo get_field('facebook') ?></div>
	            <div>Whatsapp: <?php echo get_field('whatsapp') ?></div>
	            <div>Linkedin: <?php echo get_field('linkedin') ?></div>
	            <div>Youtube: <?php echo get_field('youtube') ?></div>
	            <?php
                the_post_navigation(
                    [
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Anterior:', 'bsd' ) . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Próximo:', 'bsd' ) . '</span> <span class="nav-title">%title</span>',
                    ]
                );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
