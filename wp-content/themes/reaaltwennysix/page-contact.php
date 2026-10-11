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

<section class="mobile-contact">
    <div class="click-to-copy">
    <a href="<?php echo esc_url('mailto:' . antispambot(get_field('email', 'option'))); ?>">
<div class="click-to-email-words">
    <img class="click cte" src="<?php echo get_theme_file_uri('/inc/img/click.svg') ?>">
    <img class="to cte" src="<?php echo get_theme_file_uri('/inc/img/to.svg') ?>">
    <img class="illustration call-me" src="<?php echo get_theme_file_uri('/inc/img/phone.webp') ?>">
    <img class="email cte" src="<?php echo get_theme_file_uri('/inc/img/email.svg') ?>">
</div>
<h1>hello@reaal.studio</h1></a>
</div>
</section>


<div class="desktop-contact">
    <section class="stretch-mama">
    <div class="stretch-baby ">
        <div class="chretch">
            <img class="stretched-text" src="<?php echo get_theme_file_uri('/inc/img/email-2.svg') ?>">
        </div>
    </div>

        <div class="info-body">
             <img class="illustration call-me" src="<?php echo get_theme_file_uri('/inc/img/phone.webp') ?>">
                 <div class="z-2 click-to-copy">
                     <a href="<?php echo esc_url('mailto:' . antispambot(get_field('email', 'option'))); ?>"><h1>hello@reaal.studio</h1></a>
                </div>
                <img class="illustration the-key" src="<?php echo get_theme_file_uri('/inc/img/key.webp') ?>">
        </div>    
</section>
<section class="stretch-mama">
    <div class="stretch-baby ">
        <div class="chretch">
            <img class="stretched-text" src="<?php echo get_theme_file_uri('/inc/img/email-2.svg') ?>">
        </div>
    </div>

   
</section>
</div>

</main>
<?php
get_footer();
