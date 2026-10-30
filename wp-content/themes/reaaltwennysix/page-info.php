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

        <section class="info-head">
            <div class="info-head_text">
                <h1><?php echo esc_html(get_field('info_section_title')); ?></h1>
            </div>

            <div class="info-head_body col-md-4 col-lg-3 mx-md-auto">
                <p><?php echo wp_kses_post(get_field('info_section')); ?></p>
            </div>
        </section>


        <section class="stretch-mama service-section">
            <div class="col-md-4 col-lg-3 cyat">
                <img class="illustration" src="<?php echo get_theme_file_uri('/inc/img/cyat.webp') ?>">
            </div>
            <div class="stretch-baby service-header">
                <div class="chretch">
                    <img class="stretched-text" src="<?php echo get_theme_file_uri('/inc/img/craft.svg') ?>">
                </div>
            </div>
            <div class="service-body row">
                <div class="col-md-4 col-lg-3 mx-md-auto">
                    <p><?php echo wp_kses_post(get_field('service_section_text')); ?></p>
                </div>
                    <div class="service-list">
                        <?php
                        $services =  wp_kses_post(get_field('service_section')); // or get_post_meta() if not using ACF

                        if ($services) {
                            // Split by new line
                            $lines = explode("\n", $services);

                            echo '<ul class="services">';
                            foreach ($lines as $line) {
                                $line = trim($line);
                                if (!empty($line)) {
                                    echo '<li><span>' . esc_html($line) . '</span></li>';
                                }
                            }
                            echo '</ul>';
                        }
                        ?>
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
                <div class="flow-body info-text">
                    <div class="col-md-4 col-lg-3 mx-md-auto">
                        <p><?php echo wp_kses_post(get_field('contact_us', 'option')); ?></p>
                    </div>
                    <div class="click-to-copy mx-auto col-12">
                        <a href="<?php echo esc_url('mailto:' . antispambot(get_field('email', 'option'))); ?>"><h1>hello@</h1><br><h1>reaal.studio</h1></a>
                    </div>
                </div>
            </div>
        </section>

    </div>

</main>


<?php
get_footer();
