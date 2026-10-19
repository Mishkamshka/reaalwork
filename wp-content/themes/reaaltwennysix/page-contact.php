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
<p>email us. plz!!! hello@reaal.studio</p></a>
</div>
</section>


<div class="desktop-contact">
        <section class="stretch-mama ">
            <div class="flex">
                <div class="flow-body contact-text">
                    <div class="col-md-12">
                        <p><?php echo wp_kses_post(get_field('contact_us', 'option')); ?></p>
                    </div>
                    <div class="click-to-copy mx-auto col-12">
                        <a href="<?php echo esc_url('mailto:' . antispambot(get_field('email', 'option'))); ?>"><h1>hello</h1><br><h1>@</h1><br><h1>reaal.studio</h1></a>
                    </div>
                        <img class="illustration call-me" src="<?php echo get_theme_file_uri('/inc/img/phone.webp') ?>">

                </div>
            </div>
        </section>

</div>

</main>
<?php
get_footer();
