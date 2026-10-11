 <div class="next-projects row" id="next-work">
 <div class="col-md-6 ms-md-auto">
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
     <a href="<?php the_permalink(); ?>">
         <div class="next-project">
                 <div class="next-project-title col-md-3">
                     <p class="project-into-title"><?php the_title(); ?></p>
                 </div>

                 <div class="next-project-desc col-md-6">
                     <p><?php echo wp_kses_post(get_field('company')); ?></p>
                 </div>
             </div>
         </a>



     <?php endwhile;
        wp_reset_query(); ?>
 </div>
 </div>