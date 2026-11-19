 <div class="next-projects row" id="next-work">
 <div class="col-6 ms-auto">
     <div class="more-projects">
         <h1>More</h1>
     </div>
     <?php
        $all_ids = get_posts(array(
            'post_type'      => 'work',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'fields'         => 'ids',
            // Skip work flagged "Coming soon" (posts saved before the field existed have no meta).
            'meta_query'     => array(
                'relation' => 'OR',
                array('key' => 'coming_soon', 'compare' => 'NOT EXISTS'),
                array('key' => 'coming_soon', 'value' => '1', 'compare' => '!='),
            ),
        ));

        $current_index = array_search(get_the_ID(), $all_ids);
        $total         = count($all_ids);
        $next_ids      = array();

        for ($j = 1; $j <= 4; $j++) {
            $next_ids[] = $all_ids[($current_index + $j) % $total];
        }

        $loop = new WP_Query(array(
            'post_type'      => 'work',
            'posts_per_page' => 3,
            'post__in'       => $next_ids,
            'orderby'        => 'post__in',
        ));
        ?>
     <?php while ($loop->have_posts()) : $loop->the_post(); ?>
     
         <div class="next-project col-md-6">
                 <div class="next-project-title">
                    <a<?php echo reaaltwennysix_work_href(); ?>>
                        <p class="project-into-title"><b><?php the_title(); ?></b></p>
                    </a>
                 </div>

                 <div class="next-project-desc">
                    <a<?php echo reaaltwennysix_work_href(); ?>>
                        <p><?php echo wp_kses_post(get_field('company')); ?></p>
                    </a>
                 </div>
             </div>



     <?php endwhile;
        wp_reset_query(); ?>
 </div>
 </div>