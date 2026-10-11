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

    <div class="container-fluid">

        <?php if (post_password_required()) : ?>

            <section class="password-holder work-page-top">
                <div class="password-holder-inner">
                    <?php echo get_the_password_form(); ?>
                    <div class="locked">
                        <img class="locked-key" src="<?php echo get_theme_file_uri('/inc/img/key.webp') ?>">
                    </div>
                </div>
            </section>

        <?php else : ?>

            <section class="stretch-mama ">
                <div class="work-page-top">
                <div class="top-info">
                    <h1><?php echo get_the_title(); ?></h1>
                        <div class="about-text-holder col-md-6">
                            <div class="about-text">
                                <?php $cats = get_the_terms(get_the_ID(), 'category');
                                if ($cats && ! is_wp_error($cats)) : $last = end($cats); ?>
                                    <div class="col-md-2">
                                        <p><span>Category</span></p>
                                    </div>
                                    <?php foreach ($cats as $cat) : ?><p class="about-text-p"><a href="<?php echo esc_url(get_term_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a><?php echo ($cat !== $last) ? ', ' : ''; ?></p><?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div class="about-text">
                                <?php $cats = get_the_terms(get_the_ID(), 'sector');
                                if ($cats && ! is_wp_error($cats)) : $last = end($cats); ?>
                                    <div class="col-md-2">
                                        <p><span>Sector</span></p>
                                    </div>
                                    <?php foreach ($cats as $cat) : ?><p class="about-text-p"><a href="<?php echo esc_url(get_term_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a><?php echo ($cat !== $last) ? ', ' : ''; ?></p><?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <?php if (get_field('year')) : ?>
                                <div class="about-text">
                                    <div class="col-md-2">
                                        <p><span>Year</span></p>
                                    </div>
                                    <p class="about-text-p"><?php echo esc_html(get_field('year')); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (get_field('live')) : ?>
                                <div class="about-text">
                                    <div class="col-md-2">
                                        <p><span>Link</span></p>
                                    </div>
                                    <a href="<?php echo esc_url(get_field('live')); ?>" target="_blank" rel="noopener noreferrer">
                                        <p class="about-text-p">↳ <?php echo esc_html(rtrim(preg_replace('#^https?://#', '', get_field('live')), '/')); ?></p>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                </div>


                    <div class="col-md-6">
                        <?php if (get_field('problem')) : ?>
                            <div class="bottom-problem">
                                <p><span><?php echo wp_kses_post(get_field('problem')); ?></span></p>
                                <p><?php echo wp_kses_post(get_field('solution')); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </section>

            <div class="work-gallery">
                <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'reaal-nice'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post(get_the_title())
                    )
                );
                ?>

            </div>


            <?php get_template_part('template-parts/content', 'portfolio-next'); ?>
        <?php endif; ?>

    </div>

</main><!-- #main -->

<?php
get_footer();
