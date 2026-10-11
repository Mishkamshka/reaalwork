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

    <div class="container-fluid" id="why-oh-why">

            <section id="why-we-exist-header">
                <div class="svg-xyz">
                    <div class="stretch-baby skewme">
                    <div class=" chretch">
						<h1 class="stretched-text">Exist</h1>
					</div>
                    </div>
                </div>
            </section>
            
            <section id="exist">
                <section class="why">
                    <div class="why-inside">
                        <div class="why-we-exist-2 col-md-6 col-lg-6 ms-auto">
                                <h2><?php echo wp_kses_post(get_field('why_1')); ?></h2>
                        </div>
                        </div>
                </section>

                <section class="why">
                    <div class="why-inside">
                        <div class="why-we-exist-3 note">
                            <div class="">
                                <p><?php echo wp_kses_post(get_field('why_2')); ?></p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="why">
                    <div class="why-inside">
                        <div class="why-we-exist-4 col-md-12 col-lg-9 mx-auto">
                            <h2>As a Black-owned,</h2>
                            <h2>Woman-led studio</h2>
                        </div>
                    </div>
                </section>

                <section class="why">
                    <div class="why-inside">
                        <div class="why-we-exist-5 note">
                            <div class="">
                                <p><?php echo wp_kses_post(get_field('why_3')); ?></p>
                            </div>
                        </div>
                    </div>
                </section>


                <section class="why">
                    <div class="why-inside">
                        <div class="why-we-exist-6 col-md-12">
                            <h1>Our name—Recognising Everything As A Lesson—reflects how we exist.</h1>
                        </div>
                    </div>
                </section>

                <section class="why">
                    <div class="why-inside">
                        <div class="why-we-exist-7 note">
                            <div class="why-4">
                                <p><?php echo wp_kses_post(get_field('why_4')); ?></p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="why last">
                    <div class="why-inside">
                    <div class="why-we-exist-8">
                        <a class="big-button wide pink" href="<?php echo esc_url( 'mailto:' . antispambot( get_field('email', 'option' ) ) ); ?>"><h3>hello@reaal.studio</h3></a> 
                    </div>
                    </div>
                </section>

            </section>



    </div>

</main>


<?php
get_footer();
