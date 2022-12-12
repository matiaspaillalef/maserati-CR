<?php
global $post, $product;

if (is_page()) :
    $show_id = $post->ID;
elseif (is_category()) :
    $current_taxonomy = get_category(get_query_var('cat'), false);
    $taxonomy_prefix = $current_taxonomy->taxonomy;
    $term_id = $current_taxonomy->term_id;
    $show_id = $taxonomy_prefix . '_' . $term_id;
elseif (is_home() && !is_front_page()) :
    $show_id  = get_queried_object();
else :
    $show_id = '';
endif;

$fit_banner = get_field('fit_banner', $show_id);
$fit_banner_mobile = get_field('fit_banner_mobile', $show_id);
$size = 'full';
$breadcrumbs_mobile = get_field('breadcrumbs_mobile', $show_id);
//print_r($show_id);

?>

<?php if (get_field('activar_fit_banner', $show_id) == 1) : ?>
    <section class="maserati-fit-banner <?php echo get_field('activar_informacion_fitslider', $show_id) == 1 ? 'information-active' : ''; ?> <?php echo get_field('mini_banner', $show_id) == 1 ? 'mini_banner-active' : ''; ?>">
        <?php echo wp_is_mobile() ? '' : (is_home() ? '' : do_action('breadcrumbs_maserati')); ?>
        <?php if (wp_is_mobile() && $breadcrumbs_mobile) : ?>
            <a class="return in-banner text-decoration-none maserati-color--light_grey" href="<?php echo esc_url($breadcrumbs_mobile['url']); ?>" target="<?php echo esc_attr($breadcrumbs_mobile['target']); ?>"><i class="fa-solid fa-arrow-left"></i> <?php echo esc_html($breadcrumbs_mobile['title']); ?></a>
        <?php endif; ?>
        <?php if ($fit_banner || $fit_banner_mobile) : ?>
            <?php echo !wp_is_mobile() ? wp_get_attachment_image($fit_banner, $size) : ($fit_banner_mobile ? wp_get_attachment_image($fit_banner_mobile, $size) : wp_get_attachment_image($fit_banner, $size)); ?>
            <?php if (get_field('ocultar_titulo') == 0) : ?>
                <?php if (get_field('fit_banner_title', $show_id)) : ?>
                    <h1 class="h3 text-white text-center fw-100"><?php the_field('fit_banner_title', $show_id); ?></h1>
                <?php else : ?>
                    <h1 class="h3 text-white text-center fw-100"><?php the_title(); ?></h1>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (get_field('activar_informacion_fitslider') == 1) : ?>
            <div class="info-left">
                <div class="inner-info-left">
                    <h2 class="h1 text-uppercase text-white fw-100"><?php the_title(); ?></h2>
                    <h6 class="text-white"><?php echo get_the_excerpt(); ?></h6>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php else : ?>
    <?php
    if (have_rows('repeater_slider', $show_id)) :
        $row = count(get_field('repeater_slider', $show_id));
    ?>
        <section class="main-slider <?php echo get_field('mini_banner', $show_id) == 1 ? 'mini_banner-active' : ''; ?>">
            <div class="<?php echo $row != 1 ? 'swiper swiper-single_banner' : 'banner-noswiper'; ?>">
                <?php echo wp_is_mobile() ? '' : (is_home() ? '' : do_action('breadcrumbs_maserati')); ?>
                <?php if (wp_is_mobile() && $breadcrumbs_mobile) : ?>
                    <a class="return in-banner text-decoration-none maserati-color--light_grey" href="<?php echo esc_url($breadcrumbs_mobile['url']); ?>" target="<?php echo esc_attr($breadcrumbs_mobile['target']); ?>"><i class="fa-solid fa-arrow-left"></i> <?php echo esc_html($breadcrumbs_mobile['title']); ?></a>
                <?php endif; ?>
                <div class="swiper-wrapper">
                    <?php $i = 1; ?>
                    <?php while (have_rows('repeater_slider', $show_id)) : the_row(); ?>
                        <div class="swiper-slide" <?php echo get_sub_field('is_video', $show_id) == 1 ? 'data-swiper-autoplay="' . get_sub_field('duracion_video_slider', $show_id) * 1000 . '"' : ''; ?>>
                            <div class="<?php echo get_sub_field('is_video', $show_id) == 1 ? 'inner-video' : 'inner-image'; ?>">
                                <?php if (get_sub_field('is_video') == 1) : ?>
                                    <?php $enlace_video = get_sub_field('enlace_video', $show_id); ?>
                                    <?php echo get_sub_field('modal_video_full', $show_id) == 1 ? '<a data-bs-toggle="modal" data-bs-target="#modalVideo' . $i . '">' : ($enlace_video ? '<a href="' . esc_url($enlace_video) . '">' : ''); //si existe video completo abre modal 
                                    ?>
                                    <video class="videoItem w-100" autoplay="<?php echo !wp_is_mobile() ? 'true' : 'false'; ?>" muted data-desktop-asset="<?php the_sub_field('url_video_desktop'); ?>" data-mobile-asset="<?php the_sub_field('url_video_mobile'); ?>" preload="auto" loop="" playsinline="" src="<?php the_sub_field('url_video_desktop'); ?>">
                                    </video>
                                    <?php echo get_sub_field('modal_video_full') == 1 ? '</a>' : ($enlace_video ? '</a>' : ''); //si existe video completo abre modal 
                                    ?>
                                <?php else :
                                    $banner_slider_lg = get_sub_field('banner_slider', $show_id);
                                    $banner_slider_sm = get_sub_field('banner_slider_sm', $show_id);

                                    echo  !wp_is_mobile() ? wp_get_attachment_image($banner_slider_lg, 'full') : ($banner_slider_sm ? wp_get_attachment_image($banner_slider_sm, 'full') : wp_get_attachment_image($banner_slider_lg, 'full'));
                                endif; ?>

                                <?php $enlace_slider = get_sub_field('enlace_slider', $show_id); ?>
                                <?php if (get_sub_field('activar_informacion_slider', $show_id) == 1) : ?>
                                    <?php if (have_rows('group_slider')) : ?>
                                        <div class="maserati-content_main__banner">
                                            <div class="container">
                                                <div class="info-left <?php echo $enlace_slider ? '' : 'no-link' ?>">
                                                    <div class="inner-info-left">
                                                        <?php while (have_rows('group_slider', $show_id)) : the_row(); ?>
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
                        <?php if ($row != 1) : ?>
                            <div id="fraction" class="label-medium text-white swiper-fraction"></div>
                        <?php endif; ?>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>