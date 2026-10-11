 <div class="projects container-fluid" id="work">
     <?php
        $loop = new WP_Query(array(
            'post_type' => 'work',
            'posts_per_page' => -1,
        ));
        ?>
     <?php $post_index = 0; while ($loop->have_posts()) : $loop->the_post(); $post_index++; ?>
         <?php $primary_cats = get_the_terms(get_the_ID(), 'sector');
            $primary_slug = ($primary_cats && !is_wp_error($primary_cats)) ? $primary_cats[0]->slug : 'uncategorized';
            $primary_name = ($primary_cats && !is_wp_error($primary_cats)) ? $primary_cats[0]->name : 'Uncategorized'; ?>
         <section class="project-sections og-layout<?php echo post_password_required() ? ' super-locked' : ''; ?>" data-category="<?php echo esc_attr($primary_slug); ?>" data-category-name="<?php echo esc_attr($primary_name); ?>">
             <div class="stretch-baby w-100">
                 <div class="single-project">
                     <div class="project-img">
                         <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                             <div class="project-gradient<?php echo (get_field('video')) ? ' has-video' : ''; ?>">

                                <?php
                                $video = get_field('video');
                                $video_poster =  get_post_thumbnail_id();
                                $size = 'large';

                                if ($video) {
                                    $video_xurl = $video['url'];
                                    $poster_url = $video_poster ? wp_get_attachment_image_url($video_poster, $size) : '';
                                    $is_first   = $post_index === 1;
                                    // Real display size so the box (and the poster) has the video's shape before it loads.
                                    [$video_w, $video_h] = reaaltwennysix_video_size($video['ID']);
                                ?>
                                    <video class="video<?php echo $is_first ? '' : ' lazy-video'; ?>"
                                        width="<?php echo $video_w; ?>" height="<?php echo $video_h; ?>"
                                        preload="<?php echo $is_first ? 'metadata' : 'none'; ?>"
                                        autoplay muted loop playsinline
                                        controlslist="nodownload nofullscreen noremoteplayback"
                                        disablePictureInPicture>
                                        <?php if ($is_first) : ?>
                                            <source src="<?php echo esc_url($video_xurl); ?>#t=0.001" type="video/mp4">
                                        <?php else : ?>
                                            <source data-src="<?php echo esc_url($video_xurl); ?>#t=0.001" type="video/mp4">
                                        <?php endif; ?>
                                        Your browser does not support the video tag.
                                    </video>
                                    <?php if ($poster_url) : ?>
                                        <div class="video-poster" style="background-image:url('<?php echo esc_url($poster_url); ?>')"></div>
                                    <?php endif; ?>
                                <?php } else {
                                    if (has_post_thumbnail()) {
                                        $img_attrs = $post_index === 1
                                            ? ['fetchpriority' => 'high', 'loading' => 'eager']
                                            : ['loading' => 'lazy'];
                                        echo '<div class="without-video">';
                                        the_post_thumbnail('large', $img_attrs);
                                        echo '</div>';
                                    }
                                }
                                ?>

                             </div>
                         </a>
                     </div>


                 </div>


             </div>

                     <div class="project-info">
                         <a href="<?php the_permalink(); ?>">
                             
                             <div class="project-info-cats">
                                    
                                    <p class="project-info-details project-into-title"><?php the_title(); ?></p>
                                    <p class="project-info-details dates"><?php echo esc_html( get_field('year') ); ?></p>
                                 <?php $postCats = get_the_terms(get_the_ID(), 'category');
                                        if ($postCats && ! is_wp_error($postCats)) : $last = end($postCats);
                                            foreach ($postCats as $cat) : ?> <p class="project-cat"><?php echo esc_html($cat->name); ?><?php echo ($cat !== $last) ? '' : ''; ?></p>
                                     <?php endforeach;
                                        endif; ?>

                             </div>
                         </a>
                     </div>
             
         </section>
     <?php endwhile;
        wp_reset_query(); ?>
 </div>
