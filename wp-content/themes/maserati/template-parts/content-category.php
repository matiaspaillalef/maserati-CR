<?php /*if (have_rows('repeater_slider_mm')) : ?>
    <section class="main-slider">
        <div class="swiper swiper-single_banner">
            <div class="swiper-wrapper">
                <?php $i = 1; ?>
                <?php while (have_rows('repeater_slider_mm')) : the_row(); ?>
                    <div class="swiper-slide" <?php echo get_sub_field('is_video') == 1 ? 'data-swiper-autoplay="' . get_sub_field('duracion_video_slider') * 1000 . '"' : ''; ?>>
                        <div class="<?php echo get_sub_field('is_video') == 1 ? 'inner-video' : 'inner-image'; ?>">
                            <?php if (get_sub_field('is_video') == 1) : ?>
                                <?php $enlace_video = get_sub_field('enlace_video'); ?>
                                <?php echo get_sub_field('modal_video_full') == 1 ? '<a data-bs-toggle="modal" data-bs-target="#modalVideo' . $i . '">' : ($enlace_video ? '<a href="' . esc_url($enlace_video) . '">' : ''); //si existe video completo abre modal 
                                ?>
                                <video class="videoItem w-100" autoplay muted data-desktop-asset="<?php the_sub_field('url_video_desktop'); ?>" data-mobile-asset="<?php the_sub_field('url_video_mobile'); ?>" preload="auto" loop="" playsinline="" src="<?php the_sub_field('url_video_desktop'); ?>">
                                </video>
                                <?php echo get_sub_field('modal_video_full') == 1 ? '</a>' : ($enlace_video ? '</a>' : ''); //si existe video completo abre modal 
                                ?>
                            <?php else : ?>
                                <?php $banner_slider = get_sub_field('banner_slider'); ?>
                                <?php if ($banner_slider) : ?>
                                    <?php echo wp_get_attachment_image($banner_slider, 'full'); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php $enlace_slider = get_sub_field('enlace_slider'); ?>
                            <?php if (get_sub_field('activar_informacion_slider') == 1) : ?>
                                <?php if (have_rows('group_slider')) : ?>
                                    <div class="maserati-content_main__banner">
                                        <div class="container">
                                            <div class="info-left <?php echo $enlace_slider ? '' : 'no-separator'; ?>">
                                                <div class="inner-info-left">
                                                    <?php while (have_rows('group_slider')) : the_row(); ?>
                                                        <h2><?php the_sub_field('titulo_slider'); ?></h2>
                                                        <h6><?php the_sub_field('subtitulo_slider'); ?></h6>
                                                    <?php endwhile; ?>
                                                </div>
                                            </div>
                                            <?php if ($enlace_slider) : ?>
                                                <div class="right">
                                                    <a class="maserati-button maserati-button_large maserati-back--transparent" href="<?php echo esc_url($enlace_slider['url']); ?>" target="<?php echo esc_attr($enlace_slider['target']); ?>"><?php echo esc_html($enlace_slider['title']); ?></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endwhile; ?>
            </div>
            <div class="maserati-paginations">
                <div class="container">
                    <div id="fraction" class="label-medium text-white swiper-fraction"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; */ ?>


<?php get_template_part('template-parts/content', 'card-post'); ?>