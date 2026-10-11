<?php

/**
 * Template Name: info
 *
 * @package reaal_for_reaal
 */
get_header();

?>

<main id="primary" class="site-main">

    <div class="container-fluid" id="info-info">
            <section class="stretch-mama info-section">
                <div class=" info-header">
                <div class="stretch-baby ">
                    <div class="chretch">
                        <img class="stretched-text" src="<?php echo get_theme_file_uri('/inc/img/why.svg') ?>">
                    </div>
                </div>
                <div class="horsey">
                    <img class="illustration" src="<?php echo get_theme_file_uri('/inc/img/horsey.webp') ?>">
                </div>
                </div>

                    <div class="info-body info-text col-md-6 ms-auto">
                        <p><?php echo wp_kses_post(get_field('info_section')); ?></p>
                    </div>    
            </section>

            <section class="portoflio-preview row">
                <?php
                $sectors = get_terms(array(
                    'taxonomy'   => 'sector',
                    'hide_empty' => true,
                ));

                if ($sectors && ! is_wp_error($sectors)) :
                    foreach ($sectors as $sector) :
                        $sector_loop = new WP_Query(array(
                            'post_type'      => 'work',
                            'posts_per_page' => 2,
                            'tax_query'      => array(array(
                                'taxonomy' => 'sector',
                                'field'    => 'term_id',
                                'terms'    => $sector->term_id,
                            )),
                        ));

                        if ($sector_loop->have_posts()) : ?>
                                <a href="<?php echo esc_url(get_term_link($sector)); ?>" class="portfolio-preview-group col-md-3 px-0">
                                <h2 class="portfolio-preview-title"><?php echo esc_html($sector->name); ?></h2>
                                <?php while ($sector_loop->have_posts()) : $sector_loop->the_post(); ?>
                                    <div class="portfolio-preview-img col-6">
                                        <?php
                                        $video        = get_field('video');
                                        $video_poster =  get_post_thumbnail_id();

                                        if ($video) :
                                            $poster_url = $video_poster ? wp_get_attachment_image_url($video_poster, 'large') : '';
                                        ?>
                                            <video class="video lazy-video" width="640" height="360" preload="none" autoplay muted loop playsinline controlslist="nodownload nofullscreen noremoteplayback" disablePictureInPicture<?php if ($poster_url) echo ' poster="' . esc_url($poster_url) . '"'; ?>>
                                                <source data-src="<?php echo esc_url($video['url']); ?>#t=0.001" type="video/mp4">
                                            </video>
                                        <?php elseif (has_post_thumbnail()) :
                                            the_post_thumbnail('large', array('loading' => 'lazy'));
                                        endif;
                                        ?>
                                    </div>
                                <?php endwhile; ?>
                        </a>
                        <?php endif;
                        wp_reset_postdata();
                    endforeach;
                endif;
                ?>
            </section>

            <section class="stretch-mama service-section">
                <div class="stretch-baby service-header">
                    <div class="chretch">
                        <img class="stretched-text" src="<?php echo get_theme_file_uri('/inc/img/craft.svg') ?>">
                    </div>
                </div>
                <div class="service-body ">
                    <div class="info-text col-md-6 mx-auto">
                        <?php
                        $services =  wp_kses_post(get_field('service_section')); // or get_post_meta() if not using ACF

                        if ($services) {
                            // Split by new line
                            $lines = explode("\n", $services);

                            echo '<ul class="services">';
                            foreach ($lines as $line) {
                                $line = trim($line);
                                if (!empty($line)) {
                                    echo '<li>' . esc_html($line) . '</li>';
                                }
                            }
                            echo '</ul>';
                        }
                        ?>

                    </div>
                    <div class="col-md-4 cyat">
                        <img class="illustration" src="<?php echo get_theme_file_uri('/inc/img/cyat.webp') ?>">
                    </div>
                </div>


            </section>

            <section class="stretch-mama flow-section">
                <div class="stretch-baby flow-header">
                    <div class="chretch">
                        <img class="stretched-text" src="<?php echo get_theme_file_uri('/inc/img/email-2.svg') ?>">
                    </div>
                </div>
                    <div class="flex">
                    <div class="col-8 col-md-4 ms-md-auto phone">
                        <img class="illustration" src="<?php echo get_theme_file_uri('/inc/img/phone.webp') ?>">
                    </div>
                <div class="flow-body info-text col-md-6 ms-auto">
                    <p><b><?php echo (get_field('footer', 'option')); ?></b></p>
                    <p><?php echo wp_kses_post(get_field('flow_section')); ?></p>
                    <div class="click-to-copy"><a href="<?php echo esc_url( 'mailto:' . antispambot( get_field('email', 'option' ) ) ); ?>"><p>hello@reaal.studio</p></a> </div>

                </div>
                </div>
            </section>

    </div>

</main>


<?php
get_footer();
