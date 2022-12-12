<?php get_template_part('parts/part', 'banner-page'); ?>


<?php
$args = array(
    'post_type'         => 'post',
    'posts_per_page'    => -1,
    'orderby'           => 'date',
    'order'             => 'ASC',
);
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="maserati-all-news post-grid">
        <div class="container marginB-65 text-center">
            <h3 class="maserati-color--navi_blue fw-500"><?php the_field('titulo_news'); ?></h3>
            <h4 class="maserati-color--feature_grey text-center marginX-auto"><?php the_field('subtitulo_news'); ?></h4>
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

<?php $enlace_a_noticias = get_field('enlace_a_noticias'); ?>
<?php if ($enlace_a_noticias) : ?>
    <section class="maserati-all-news-button">
        <div class="container">
            <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto" href="<?php echo esc_url($enlace_a_noticias['url']); ?>" target="<?php echo esc_attr($enlace_a_noticias['target']); ?>"><?php echo esc_html($enlace_a_noticias['title']); ?></a>
        </div>
    </section>
<?php endif; ?>



<?php if (have_rows('repeater_block')) : ?>
    <section class="maserati-block-featured">
        <?php while (have_rows('repeater_block')) : the_row();
            $color_back =  get_sub_field('backgorund_block'); ?>
            <div class="fullwidth background-block" style="<?php echo $color_back ? 'background-color:' . $color_back . ';' : ''; ?>">
                <div class="container">
                    <div class="row">
                        <?php if (have_rows('grupo_block')) : ?>
                            <div class="col-md-6 col-sm-12">
                                <?php while (have_rows('grupo_block')) : the_row(); ?>
                                    <?php echo get_sub_field('titulo') ? '<h3 class="fw-500">' . get_sub_field('titulo') . '</h3>' : ''; ?>
                                    <?php echo get_sub_field('subtitulo') ? '<h4>' . get_sub_field('subtitulo') . '</h4>' : ''; ?>
                                    <?php echo get_sub_field('descripcion') ? '<p>' . get_sub_field('descripcion') . '</p>' : ''; ?>

                                    <?php if (get_sub_field('archivo_select') == 1) : ?>
                                        <?php $archivo = get_sub_field('archivo'); ?>
                                        <?php if ($archivo) : ?>
                                            <a class="maserati-button maserati-button_large maserati-back--navi_blue mt-5" href="<?php echo esc_url($archivo['url']); ?>"><?php echo esc_html($archivo['filename']); ?></a>
                                        <?php endif; ?>
                                    <?php else : ?>

                                        <?php $enlace = get_sub_field('enlace'); ?>
                                        <?php if ($enlace) : ?>
                                            <a class="maserati-button maserati-button_large maserati-back--navi_blue mt-5" href="<?php echo esc_url($enlace['url']); ?>" target="<?php echo esc_attr($enlace['target']); ?>"><?php echo esc_html($enlace['title']); ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        $imagen_block = get_sub_field('imagen_block');
                        $imagen_block_sm = get_sub_field('imagen_block_sm');
                        ?>
                        <?php if ($imagen_block) : ?>
                            <div class="col-md-6 col-sm-12">
                                <?php echo !wp_is_mobile() ? wp_get_attachment_image($imagen_block, $size) : ($imagen_block_sm ? wp_get_attachment_image($imagen_block_sm, $size) : wp_get_attachment_image($imagen_block, $size)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>

<?php
/*get_template_part('parts/part', 'accesos-news');*/
//get_template_part('parts/part', 'newsletter');
?>