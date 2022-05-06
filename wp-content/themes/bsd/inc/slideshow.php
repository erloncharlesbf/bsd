<?php $loop = new WP_Query( [ 'post_type' => 'slideshows', 'posts_per_page' => 10 ] ); ?>
<div class="container">
    <div id="slideshows">
		<?php
		while ( $loop->have_posts() ) : $loop->the_post();
			$imageDesktop = get_field( 'imagem_desktop' );
			$imageMobile  = get_field( 'imagem_mobile' );
			$link         = get_field( 'link' );
			$newWindow    = get_field( 'abrir_em_nova_aba' );
			$status       = get_field( 'status' );
			?>
            <div>
				<?php if ( $link ) : ?>
                    <a href="<?php
					echo $link; ?>" <?php
					echo $newWindow ? 'target="_blank"' : null ?>>
                        <img class="slideshow-desktop" src="<?php echo $imageDesktop; ?>" alt="<?php echo get_the_title(); ?>">
                        <img class="slideshow-mobile" src="<?php echo $imageMobile; ?>" alt="<?php echo get_the_title(); ?>">
                    </a>
				<?php else: ?>
                    <img class="slideshow-desktop" src="<?php echo $imageDesktop; ?>" alt="<?php echo get_the_title(); ?>">
                    <img class="slideshow-mobile" src="<?php echo $imageMobile; ?>" alt="<?php echo get_the_title(); ?>">
				<?php endif; ?>
            </div>
		<?php endwhile; ?>
    </div>
</div>