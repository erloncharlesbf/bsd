<div id="salistas">
    <div class="container">
        <div class="search-box">
            <aside id="search" class="widget widget_search"><?php get_search_form(); ?></aside>
        </div>
    </div>
</div>
<div class="container">
	<?php
	$categoriaSalistas = get_terms( 'salista_categories', [ 'hide_empty' => 0, 'parent' => 0 ] );
	foreach ( $categoriaSalistas as $categoria ) :
		?>
        <div class="category-salista">
            <a href="<?php echo get_term_link( $categoria->slug, $categoria->taxonomy ); ?>">
                <img width="150"
                     height="150"
                     src="<?php echo get_field( 'icone', $categoria->taxonomy . '_' . $categoria->term_id ) ?>"
                     alt="<?php echo $categoria->name; ?>">
            </a>
        </div>
	<?php endforeach; ?>
</div>