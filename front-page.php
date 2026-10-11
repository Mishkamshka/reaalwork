<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package reaal_for_reaal
 */

get_header();
?>

<main id="primary" class="site-main">

    <div class="container-fluid">

        <div class="chretch home-holder">

            <div class="home-intro">
                <h6 class="screen-reader-text" aria-label="From the margins, we shape new centres">From the margins, we shape new centres</h6>
                <?php get_template_part('template-parts/content', 'svg'); ?>
            </div>
        </div>
        
        
    </div>
    <?php get_template_part('template-parts/content', 'portfolio'); ?>

</main><!-- #main -->

<?php
get_footer();
