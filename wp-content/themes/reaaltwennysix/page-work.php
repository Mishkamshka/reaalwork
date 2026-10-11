
<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package reaal_for_reaal
 */
get_header();

?>
<main id="primary" class="site-main">
<div id="work">
    <?php get_template_part( 'template-parts/content', 'portfolio' );?>

</div>
</main><!-- #main -->

<?php
get_footer();
