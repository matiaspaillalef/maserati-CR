<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maserati
 */

?>
<div class="entry-content">

    <?php get_template_part('parts/part', 'banner-page') ?>

    <?php
    $args = array(
        'post_type'         => 'modelo',
        'posts_per_page'    => -1,
        'orderby'           => 'date',
        'order'             => 'ASC',
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) : ?>
        <section class="maserati-explore paddingY-95">
            <div class="container marginB-65">
                <?php echo get_field('titulo_colecciones') ? '<h3 class="text-white fw-500">' . get_field('titulo_colecciones') . '</h3>' : ''; ?>
                <?php echo get_field('subtitulo_colecciones') ? '<h4 class="maserati-color--light_grey">' . get_field('subtitulo_colecciones') . '</h4>' : ''; ?>
            </div>
            <div class="container">
                <div class="swiper swiper-single_banner__models">
                    <?php if (!wp_is_mobile()) : ?>
                        <div class="swiper-pagination swiper-pagination-name"></div>
                    <?php endif; ?>
                    <div class="swiper-wrapper">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="swiper-slide" data-title="<?php echo get_the_title(); ?>">
                                <article>
                                    <div class="header-model" <?php echo wp_is_mobile() ? '' : 'data-aos="fade-left"'; ?>>
                                        <?php if (wp_is_mobile()) : ?>
                                            <h3 class="title-large"><?php echo get_the_title(); ?></h3>
                                            <p class="body-medium">No eres como todos los demás</p>
                                        <?php endif; ?>
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <?php the_post_thumbnail(); ?>
                                        </a>
                                    </div>
                                    <?php if (!wp_is_mobile()) : ?>
                                        <div class="body-model" <?php echo wp_is_mobile() ? '' : 'data-aos="fade-up"'; ?>>
                                            <div class="inner-body_model">
                                                <div class="model-slogan">
                                                    <?php while (have_rows('grupo_identidad')) : the_row(); ?>
                                                        <?php echo !wp_is_mobile() ? '<h6>' . get_sub_field('slogan_modelo') . '</h6>' : ''; ?>
                                                    <?php endwhile; ?>

                                                </div>


                                                <?php
                                                if (have_rows('Informacion_modelo')) :
                                                    while (have_rows('Informacion_modelo')) : the_row();

                                                        $potencia_maxima_general  = get_sub_field('potencia_maxima_general');
                                                        $velocidad_maxima_general = get_sub_field('velocidad_maxima_general');
                                                        $aceleracion_general      = get_sub_field('aceleracion_general');

                                                ?>
                                                        <div class="model-info">
                                                            <div class="model-speed">
                                                                <p class="title-medium">Top Speed Acceleration</p>
                                                                <h3><span class="counter"><?php echo  $velocidad_maxima_general; ?></span> <span>km/h</span></h3>
                                                                <h3><span class="counter"><?php echo  $aceleracion_general; ?></span> <span>sec</span></h3>
                                                            </div>
                                                            <div class="model-power">
                                                                <p class="title-medium">Power</p>
                                                                <h3><span class="counter"><?php echo  $potencia_maxima_general; ?></span> <span>HP</span></h3>
                                                            </div>
                                                            <div class="model-access">
                                                                <a class="maserati-button maserati-button_large maserati-back--white" href="<?php echo get_the_permalink(); ?>"><?php echo __('Explorar', 'maserati') . ' ' . get_the_title(); ?></a>
                                                            </div>
                                                        </div>
                                                    <?php endwhile;
                                                else : ?>
                                                    <?php
                                                    $i = 1;
                                                    while (have_rows('repeat_verisones')) : the_row();

                                                        if ($i == 1) :
                                                            while (have_rows('group_information')) : the_row();
                                                                $version_potencia = get_sub_field('potencia_maxima');
                                                                $version_velocidad = get_sub_field('velocidad_maxima');
                                                                $version_aceleracion = get_sub_field('aceleracion');
                                                    ?>
                                                                <div class="model-info">
                                                                    <div class="model-speed">
                                                                        <p class="title-medium">Top Speed Acceleration</p>
                                                                        <h3><span class="counter"><?php echo  $version_velocidad; ?></span> <span>km/h</span></h3>
                                                                        <h3><span class="counter"><?php echo  $version_aceleracion; ?></span> <span>sec</span></h3>
                                                                    </div>
                                                                    <div class="model-power">
                                                                        <p class="title-medium">Power</p>
                                                                        <h3><span class="counter"><?php echo  $version_potencia; ?></span> <span>HP</span></h3>
                                                                    </div>
                                                                    <div class="model-access">
                                                                        <a class="maserati-button maserati-button_large maserati-back--white" href="<?php echo get_the_permalink(); ?>"><?php echo __('Explorar', 'maserati') . ' ' . get_the_title(); ?></a>
                                                                    </div>
                                                                </div>
                                                    <?php
                                                            endwhile;
                                                            break;
                                                        endif;
                                                    endwhile; ?>
                                                <?php endif; ?>
                                            </div>

                                        <?php endif; ?>
                                        <?php if (wp_is_mobile()) : ?>
                                            <a class="maserati-button maserati-button_large <?php echo wp_is_mobile() ? 'maserati-back--navi_blue' : 'maserati-back--transparent_navy'; ?> marginX-auto" href="<?php echo get_the_permalink(); ?>">
                                                <?php echo __('Explora ', 'maserati') . get_the_title(); ?>
                                            </a>
                                        <?php endif; ?>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php if (wp_is_mobile()) : ?>
                        <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto mt-3" href="/modelos/"><?php _e('Ver todos los modelos', 'maserati'); ?></a>
                    <?php endif; ?>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="container">
                <?php if (!wp_is_mobile()) : ?>
                    <a class="maserati-button maserati-button_large maserati-back--transparent marginX-auto" href="/modelos/"><?php _e('Ver todos los modelos', 'maserati'); ?></a>
                <?php endif; ?>
            </div>
        </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php get_template_part('parts/part', 'pre-owned') ?>

    <?php if (have_rows('repeater_world', 'option')) : ?>
        <section class="maserati-world paddingY-95">
            <div class="container">
                <h4 class="maserati-color--navi_blue"><?php the_field('titulo_mundo'); ?></h4>
            </div>
            <div class="fullwidth">
                <div class="swiper swiper-2_5 card-slider">
                    <div class="swiper-wrapper">
                        <?php
                        while (have_rows('repeater_world', 'option')) : the_row();
                            $imagen_referencial = get_sub_field('imagen_referencial');
                            $enlace_a_seccion = get_sub_field('enlace_a_seccion');
                        ?>
                            <div class="swiper-slide">
                                <?php echo $enlace_a_seccion ? '<a class="inner-slide maserati-shadow" href="' . esc_url($enlace_a_seccion['url']) . '" target="' . esc_attr($enlace_a_seccion['target']) . '">'  : '<div class="inner-slide maserati-shadow">'; ?>
                                <?php if ($imagen_referencial) : ?>
                                    <?php echo wp_get_attachment_image($imagen_referencial, 'full'); ?>
                                <?php endif; ?>
                                <h5><?php the_sub_field('nombre_seccion'); ?></h5>
                                <?php echo $enlace_a_seccion ? '</a>'  : '</div>'; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <?php $enlace_mundo = get_field('enlace_mundo'); ?>
            <?php if ($enlace_mundo) : ?>
                <div class="container">
                    <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto" href="<?php echo esc_url($enlace_mundo['url']); ?>" target="<?php echo esc_attr($enlace_mundo['target']); ?>"><?php echo esc_html($enlace_mundo['title']); ?></a>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <section id="puntos-de-venta" class="maserati-distribuidor paddingY-95">
        <div class="container marginB-65">
            <h3>Encuentra tu distribuidor Maserati</h3>
            <h4>Más cercano en Costa Rica</h4>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="maserati-box-information">
                        <?php echo wp_is_mobile() ? '<i class="icon-close"></i>' : ''; ?>
                        <div class="inner-box">
                            <div class="header-box info-block">
                                <h5 class="maserati-color--navi_blue"><?php the_field('nombre_sucursal', 'option'); ?></h5>
                                <p class="title-small maserati-color--feature_grey"><?php the_field('giro_sucursal', 'option'); ?></p>
                            </div>
                            <div class="body-box info-block">
                                <div class="information-sucursal">
                                    <i class="icon-pin"></i>
                                    <?php the_field('direccion', 'option'); ?>
                                </div>

                                <div class="information-sucursal">
                                    <i class="icon-clock"></i>
                                    <div class="horarios">
                                        <?php if (have_rows('lunes_viernes', 'option')) : ?>
                                            <div class="week">
                                                <p><strong><?php _e('Lunes - Viernes', 'maserati'); ?></strong></p>
                                                <?php while (have_rows('lunes_viernes', 'option')) : the_row(); ?>
                                                    <p><span><?php the_sub_field('apertura_hrs'); ?></span> - <span><?php the_sub_field('cierre_hrs'); ?></span></p>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (have_rows('sabado_hrs', 'option')) : ?>
                                            <div class="weekend">
                                                <p><strong><?php echo get_field('domingo_cerrado', 'option') == 1 ? __('Sábado', 'maserati') : __('Sábado - Domigo', 'maserati'); ?></strong></p>
                                                <?php while (have_rows('sabado_hrs', 'option')) : the_row(); ?>
                                                    <p><span><?php the_sub_field('apertura_hrs'); ?></span> - <span><?php the_sub_field('cierre_hrs'); ?></span></p>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (get_field('domingo_cerrado', 'option') == 1) : ?>
                                            <div class="weekend-closed">
                                                <p><strong><?php echo __('Domingo', 'maserati'); ?></strong></p>
                                                <p><span><?php echo __('Cerrado', 'Maserati'); ?></span></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="foot-box info-block">
                                <?php $contacto_sucursal = get_field('contacto_sucursal', 'option'); ?>
                                <?php if ($contacto_sucursal) : ?>
                                    <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto" href="<?php echo esc_url($contacto_sucursal['url']); ?>" target="<?php echo esc_attr($contacto_sucursal['target']); ?>"><?php echo esc_html($contacto_sucursal['title']); ?></a>
                                <?php endif; ?>

                                <?php if (get_field('latitud', 'option') && get_field('longitud', 'option')) : ?>
                                    <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" href="https://www.google.com/maps/dir/?api=1&destination=<?php the_field('latitud', 'option'); ?>%2C<?php the_field('longitud', 'option'); ?>&travelmode" target="_blank"><i class="fa-brands fa-google"></i> <?php echo __('Abrir en google maps', 'Maserati'); ?></a>
                                <?php endif; ?>

                                <?php if ((get_field('latitud', 'option') && get_field('longitud', 'option')) && wp_is_mobile()) : ?>
                                    <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" href="https://waze.com/ul?ll=<?php the_field('latitud', 'option'); ?>,<?php the_field('longitud', 'option'); ?>&navigate=yes&zoom=17" target="_blank"><i class="fa-brands fa-waze"></i> <?php echo __('Abrir en waze', 'Maserati'); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div id="map" data-lat="<?php echo esc_attr(get_field('latitud', 'option')); ?>" data-long="<?php echo esc_attr(get_field('longitud', 'option')); ?>"></div>
                </div>
            </div>
        </div>
    </section>

</div>