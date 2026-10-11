<?php
/**
 * The template for displaying sector taxonomy archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package reaal_for_reaal
 */

get_header();
?>

	<main id="primary" class="site-main">
 <div class="container-fluid">
 <div class="row mx-0">

		<?php if ( have_posts() ) : ?>

			<header class="page-header page-top">
				<?php
				echo '<h1 class="page-title">Sector: ' . single_term_title( '', false ) . '</h1>';
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'sector' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
 </div></div>
	</main><!-- #main -->

<?php
get_footer();
