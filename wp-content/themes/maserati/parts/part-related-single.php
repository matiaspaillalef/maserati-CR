<?php
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'orderby' => 'rand',
    'post__not_in' => array($post->ID),
);
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="maserati-all-news related-post post-grid">
        <div class="container marginB-65 text-center">
            <h3 class="fw-500"><?php echo __('También te puede interesar', 'maserati'); ?></h3>
        </div>
        <div class="container">
            <div class="swiper swiper-all-news">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <article class="card-post-item">
                                <?php the_post_thumbnail(); ?>
                                <div class="content-post">
                                    <h5 class="maserati-color--navi_blue"><?php echo get_the_title(); ?></h5>
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                    <a href="<?php echo get_the_permalink(); ?>"><?php _e('Leer más', 'maserati'); ?> <i class="icon-arrow-right"></i></a>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="swiper-button-prev swiper-button-prev-news"></div>
            <div class="swiper-button-next swiper-button-next-news"></div>
        </div>
    </section>
<?php
endif;
wp_reset_postdata();
?>