<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package reaal_for_reaal
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
					<div class="lost-cyat">
                        <img class="illustration" src="<?php echo get_theme_file_uri('/inc/img/cyat.webp') ?>">
                    </div>
				<div class="chretch">
                    <img class="stretched-text" src="<?php echo get_theme_file_uri('/inc/img/404.svg') ?>">
                </div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
