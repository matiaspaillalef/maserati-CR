<?php get_template_part('parts/part', 'banner-page'); ?>


<?php if (have_rows('motores_repeater')) : ?>
    <section class="maserati-motors-waranty paddingY-95">
        <div class="tiny-container marginB-45">
            <h3 class="maserati-color--navi_blue fw-500 text-center"> <?php the_field('titulo_seccion_w'); ?></h3>
            <p class="maserati-color--navi_blue fw-300 text-left"><?php the_field('descripcion_seccion'); ?></p>
        </div>
        <div class="container">
            <div class="swiper swiper-waranty-motors">
                <div class="swiper-wrapper">
                    <?php while (have_rows('motores_repeater')) : the_row(); ?>
                        <div class="swiper-slide">
                            <article>
                                <div class=" header-model marginB-45">
                                    <?php $imagen_motor = get_sub_field('imagen_motor'); ?>
                                    <?php if ($imagen_motor) : ?>
                                        <img src=" <?php echo esc_url($imagen_motor['url']); ?>" alt="<?php echo esc_attr($imagen_motor['alt']); ?>" />
                                    <?php endif; ?>
                                    <h3 class="maserati-color--navi_blue fw-500"><?php the_sub_field('nombre_motor'); ?></h2>
                                </div>
                                <div class="body-model">
                                    <div class="version-info">
                                        <?php if (get_sub_field('esquema_motor')) : ?>
                                            <div class="version-info_item">
                                                <h5 class="maserati-color--navi_blue"><span><?php the_sub_field('esquema_motor'); ?></span></h5>
                                                <p><?php echo __('Esquema motor', 'maserati'); ?></p>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('max_power_motor')) : ?>
                                            <div class="version-info_item">
                                                <h5 class="maserati-color--navi_blue"><span><?php the_sub_field('max_power_motor'); ?></span> HP</h5>
                                                <p><?php echo __('Max Power', 'maserati'); ?></p>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('max_speed_motor')) : ?>
                                            <div class="version-info_item">
                                                <h5 class="maserati-color--navi_blue"><span class="counter"><?php the_sub_field('max_speed_motor'); ?></span> km/h</h5>
                                                <p><?php echo __('Max Speed', 'maserati'); ?></p>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('aceleracion_motor')) : ?>
                                            <div class="version-info_item">
                                                <h5 class="maserati-color--navi_blue"><span class="counter"><?php the_sub_field('aceleracion_motor'); ?></span> sec</h5>
                                                <p><?php echo __('Aceleración', 'maserati'); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
<?php endif; ?>



<?php
$sound_motor = get_field('sound_motor');
$url = wp_get_attachment_url($sound_motor);
$background_motor = get_field('background_motor');
$background_motor_mobile = get_field('background_motor_mobile');
$motor_sketch = get_field('motor_sketch');
$motor_render = get_field('motor_render');
$size = 'full';

?>

<section class="maserati-garantia_motor" <?php echo !wp_is_mobile() ? 'style="background-image:url(' . wp_get_attachment_image_url($background_motor, $size) . ');"' : ($background_motor_mobile ? 'style="background-image:url(' . wp_get_attachment_image_url($background_motor_mobile, $size) . ');"' : 'style="background-image:url(' . wp_get_attachment_image_url($background_motor, $size) . ');"'); ?>>


    <?php if (wp_is_mobile() && have_rows('info_noticia_w')) : ?>
        <div class="container text-center mb-5">
            <?php while (have_rows('info_noticia_w')) : the_row(); ?>
                <h3 class="fw-500 text-white"><?php the_sub_field('titulo_noticia_w'); ?></h3>
                <p class="text-white"><?php the_sub_field('descripcion_noticia_w'); ?></p>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="inner-container">
            <?php echo wp_is_mobile() ? '<div class="title-group">' : ''; ?>
            <h4 class="title-line text-white"><?php the_field('tiulo_motor'); ?></h4>
            <?php echo wp_is_mobile() ? '<p class="text-white">' . __('Haz click para escuchar el sonido del motor', 'maserati') . '</p> </div>' : ''; ?>
            <?php if (!wp_is_mobile() && ($motor_sketch || $motor_render)) : ?>
                <div class="masertai-motor-sketch">
                    <?php echo wp_get_attachment_image($motor_sketch, $size, "", array("class" => "img-sketch")); ?>
                    <?php echo wp_get_attachment_image($motor_render, $size, "", array("class" => "img-render")); ?>
                </div>
            <?php else : ?>
                <div class="masertai-motor-sketch">
                    <?php echo wp_get_attachment_image($motor_render, $size, "", array("class" => "img-render")); ?>
                </div>
            <?php endif; ?>

            <?php if ($sound_motor) : ?>

                <div class="pulse-on_off">
                    <div class="listen-motor">
                        <i class="icon-on-off"></i>
                        <div class="pulse-sound"></div>
                        <div class="vz-wrapper">
                            <audio id="myAudio" src="<?php echo esc_url($url); ?>" data-author="Beethoven" data-title="Allegro"></audio>
                            <div class="vz-wrapper -canvas">
                                <canvas id="myCanvas" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>




                    <?php if (!wp_is_mobile()) : ?>
                        <p><?php echo __('Haz click para escuchar el sonido del motor', 'maserati'); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (wp_is_mobile() && have_rows('info_noticia_w')) : ?>
        <div class="container">
            <?php while (have_rows('info_noticia_w')) : the_row(); ?>
                <?php $enlace_noticia_w = get_sub_field('enlace_noticia_w'); ?>
                <?php if ($enlace_noticia_w) : ?>
                    <a class="maserati-button maserati-button_large maserati-back--transparent marginX-auto" href="<?php echo esc_url($enlace_noticia_w['url']); ?>" target="<?php echo esc_attr($enlace_noticia_w['target']); ?>"><?php echo esc_html($enlace_noticia_w['title']); ?></a>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>


<?php $imagen_noticia_w = get_field('imagen_noticia_w'); ?>
<?php if (!wp_is_mobile() && have_rows('info_noticia_w')) : ?>
    <section class="maserati-news-featured maserati-bg--off_white paddingY-95">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?php while (have_rows('info_noticia_w')) : the_row(); ?>
                        <h3 class="fw-500"><?php the_sub_field('titulo_noticia_w'); ?></h3>
                        <p><?php the_sub_field('descripcion_noticia_w'); ?></p>

                        <?php $enlace_noticia_w = get_sub_field('enlace_noticia_w'); ?>
                        <?php if ($enlace_noticia_w) : ?>
                            <a class="maserati-button maserati-button_large maserati-back--navi_blue" href="<?php echo esc_url($enlace_noticia_w['url']); ?>" target="<?php echo esc_attr($enlace_noticia_w['target']); ?>"><?php echo esc_html($enlace_noticia_w['title']); ?></a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <?php if ($imagen_noticia_w) : ?>
                    <div class="col-md-6 col-sm-12">
                        <?php echo wp_get_attachment_image($imagen_noticia_w, $size); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php if (have_rows('galeria_repeat') || get_field('titulo_details') || get_field('subtitulo_details')) : ?>
    <section class="maserati-details-motors paddingY-95">
        <div class="tiny-container">
            <h4 class="maserati-color--navi_blue fw-500 text-center"><?php the_field('titulo_details'); ?></h4>
            <p class="maserati-color--navi_blue fw-300"><?php the_field('subtitulo_details'); ?></p>
        </div>
        <?php if (have_rows('galeria_repeat')) : ?>
            <div class="container">
                <div class="row">
                    <?php while (have_rows('galeria_repeat')) : the_row(); ?>
                        <?php $imagen_details = get_sub_field('imagen_details'); ?>
                        <div class="col-md-6 col-sm-12">
                            <?php if ($imagen_details) : ?>
                                <?php echo wp_get_attachment_image($imagen_details, $size); ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>


<?php
$video_lab = get_field('video_lab');
$imagen_lab = get_field('imagen_lab');
?>
<section class="maserati-lab-waranty marginB-95">
    <div class="tiny-container">
        <h3 class="maserati-color--navi_blue fw-500 text-center"><?php the_field('titulo_lab'); ?></h3>
        <p class="maserati-color--navi_blue fw-300"><?php the_field('subtitulo_lab'); ?></p>
    </div>
    <div class="container">
        <?php if (get_field('video_lab_tf') == 1) : ?>
            <video class="videoItem w-100" autoplay muted data-desktop-asset="<?php echo $video_lab; ?>" data-mobile-asset="<?php echo $video_lab; ?>" preload="auto" loop="" playsinline="" src="<?php echo $video_lab; ?>"></video>
        <?php else : ?>
            <?php if ($imagen_lab) : ?>
                <?php echo wp_get_attachment_image($imagen_lab, $size); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>



<section class="maserati-gallery-waranty marginB-95">
    <div class="tiny-container">
        <h4 class="maserati-color--navi_blue fw-500 text-center"><?php the_field('titulo_details'); ?></h4>
        <p class="maserati-color--navi_blue fw-300"><?php the_field('subtitulo_details'); ?></p>
    </div>

    <?php if (have_rows('repeater_modelo_galeria')) : ?>
        <div class="fullwidth mt-5">
            <div class="swiper  swiper-2_5_gallery swiper-2_5_gallery_waranty card-slider">
                <div class="swiper-wrapper">
                    <?php
                    while (have_rows('repeater_modelo_galeria')) : the_row();
                        $imagen_galeria = get_sub_field('imagen_galeria');
                    ?>
                        <div class="swiper-slide">
                            <a class="inner-slide maserati-shadow" data-bs-toggle="modal" data-bs-target="#modelGallery">
                                <?php if ($imagen_galeria) : ?>
                                    <?php echo wp_get_attachment_image($imagen_galeria, $size); ?>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php $imagen_proceso = get_field('imagen_proceso'); ?>
<?php if ($imagen_proceso) : ?>
    <section class="maserati-proceso-waranty marginB-95">
        <div class="container">
            <?php echo wp_get_attachment_image($imagen_proceso, $size); ?>
        </div>
    </section>
<?php endif; ?>



<?php
$background_waranty = get_field('background_waranty');
$background_sm_waranty = get_field('background_sm_waranty');
$enlace_waranty = get_field('enlace_waranty');
?>



<section class="maserati-extended-waranty" <?php echo !wp_is_mobile() ?  'style="background-image:url(' . wp_get_attachment_image_url($background_waranty, $size) . ');"' : ($background_sm_waranty ? 'style="background-image:url(' . wp_get_attachment_image_url($background_sm_waranty, $size) . ');"' :  'style="background-image:url(' . wp_get_attachment_image_url($background_waranty, $size) . ');"'); ?>>
    <div class="container">
        <div class="col-md-4 col-sm-12">
            <h3 class="text-white title-line fw-500"><?php the_field('titulo_waranty'); ?></h3>
            <p class="text-white mb-4"><?php echo get_field('subtitulo_waranty'); ?></p>
            <?php if ($enlace_waranty) : ?>
                <a class="maserati-button maserati-button_large maserati-back--transparent" href="<?php echo esc_url($enlace_waranty['url']); ?>" target="<?php echo esc_attr($enlace_waranty['target']); ?>"><?php echo esc_html($enlace_waranty['title']); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- Modal galeria-->
<?php if (have_rows('repeater_modelo_galeria')) : ?>
    <div class="modal fade" id="modelGallery" tabindex="-1" aria-labelledby="modelGalleryLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <?php if (have_rows('grupo_identidad')) : ?>
                        <div class="container">
                            <?php while (have_rows('grupo_identidad')) : the_row(); ?>
                                <?php $emblema_modelo = get_sub_field('emblema_modelo'); ?>
                                <?php if ($emblema_modelo) : ?>
                                    <?php echo wp_get_attachment_image($emblema_modelo, $size, '', array('class' => 'emblema-absolute')); ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (have_rows('repeater_modelo_galeria')) : ?>
                        <div class="swiper swiper-2_5_gallery-modal-waranty card-slider">
                            <div class="swiper-wrapper">

                                <?php
                                while (have_rows('repeater_modelo_galeria')) : the_row();
                                    $imagen_galeria = get_sub_field('imagen_galeria');
                                ?>
                                    <div class="swiper-slide">
                                        <div class="inner-slide maserati-shadow">
                                            <?php if ($imagen_galeria) : ?>
                                                <?php echo wp_get_attachment_image($imagen_galeria, $size); ?>
                                            <?php endif; ?>
                                            <?php $exterior_interior_selected_option = get_sub_field('exterior_interior'); ?>
                                            <?php if ($exterior_interior_selected_option) : ?>
                                                <h5 class="text-center text-white"><?php echo esc_html($exterior_interior_selected_option['label']); ?></h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>