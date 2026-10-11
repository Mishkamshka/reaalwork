
<?php
        $loop = new WP_Query(array(
            'post_type' => 'work',
            'posts_per_page' => -1,
        ));
        ?>
         <div class="project-sections col-lg-2 col-md-4 col-sm-6 gx-0 grid">
             <div class="w-100">
                 <div class="single-project">
                     <div class="project-img">
                         <a href="<?php the_permalink(); ?>">
                             <div class="project-gradient<?php echo (get_field('video')) ? ' has-video' : ''; ?>">

                                <?php
                                $video = get_field('video');
                                $video_poster =  get_post_thumbnail_id();
                                $size = 'large';

                                if ($video) {
                                    $video_xurl = $video['url'];
                                    $poster_url = $video_poster ? wp_get_attachment_image_url($video_poster, $size) : '';
                                    // Real display size so the box (and the poster) has the video's shape before it loads.
                                    [$video_w, $video_h] = reaaltwennysix_video_size($video['ID']);
                                ?>
                                    <video class="video lazy-video"
                                        width="<?php echo $video_w; ?>" height="<?php echo $video_h; ?>"
                                        preload="none"
                                        autoplay muted loop playsinline
                                        controlslist="nodownload nofullscreen noremoteplayback"
                                        disablePictureInPicture>
                                        <source data-src="<?php echo esc_url($video_xurl); ?>#t=0.001" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <?php if ($poster_url) : ?>
                                        <div class="video-poster" style="background-image:url('<?php echo esc_url($poster_url); ?>')"></div>
                                    <?php endif; ?>
                                <?php } else {
                                    if (has_post_thumbnail()) {
                                        $img_attrs = ['loading' => 'lazy'];
                                        echo '<div class="without-video">';
                                        the_post_thumbnail('large', $img_attrs);
                                        echo '</div>';
                                    }
                                }
                                ?>

                             </div>
                         </a>
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

                 </div>


             </div>
             
         </div>

         