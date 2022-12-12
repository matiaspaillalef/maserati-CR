<?php get_template_part('parts/part', 'banner-page');
global $maserati_models;
$size = 'full';
?>

<?php $video_presentacion = get_field('video_presentacion');
$banner_presentacion = get_field('banner_presentacion') ?>
<section class="maserati-presentation-programa">
    <div class="tiny-container">
        <h3 class="maserati-color--navi_blue fw-500 text-center"><?php the_field('titulo_presentacion'); ?></h3>
        <p class="maserati-color--navi_blue"><?php the_field('descripcion_presentacion'); ?></p>
    </div>
    <div class="container">
        <h4 class="maserati-color--feature_grey fw-500 text-center"><?php the_field('titulo_bottom_video'); ?></h4>
        <?php if (get_field('imagen_select') == 0) : ?>
            <video class="videoItem w-100" autoplay muted data-desktop-asset="<?php echo $video_presentacion; ?>" data-mobile-asset="<?php echo $video_presentacion; ?>" preload="auto" loop="" playsinline="" src="<?php echo $video_presentacion; ?>"></video>
        <?php else : ?>
            <?php if ($banner_presentacion) : ?>
                <div class="img-zoom animate__animated animate__zoomIn">
                    <?php echo wp_get_attachment_image($banner_presentacion, $size); ?>
                </div>

            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="tiny-container bottom-section">
        <h4 class="maserati-color--feature_grey text-center"><?php the_field('descripcion_bottom_video'); ?></h4>
        <?php $enlace_presentacion = get_field('enlace_presentacion'); ?>
        <?php if ($enlace_presentacion) : ?>
            <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto mt-5" href="<?php echo esc_url($enlace_presentacion['url']); ?>" target="<?php echo esc_attr($enlace_presentacion['target']); ?>"><?php echo esc_html($enlace_presentacion['title']); ?></a>
        <?php endif; ?>
    </div>
</section>

<?php $background_desktop_proceso = get_field('background_desktop_proceso'); ?>
<?php $background_mobile_proceso = get_field('background_mobile_proceso'); ?>
<section class="maserati-proceso" style="background-image:url(<?php echo !wp_is_mobile() ? wp_get_attachment_image_url($background_desktop_proceso, $size) : ($background_mobile_proceso ? wp_get_attachment_image_url($background_mobile_proceso, $size) : wp_get_attachment_image_url($background_desktop_proceso, $size)); ?>);">
    <div class="container">
        <div class="row">
            <?php if (have_rows('grupo_titulo')) : ?>
                <div class="col-md-6 col-sm-12">
                    <?php while (have_rows('grupo_titulo')) : the_row(); ?>
                        <h3 class="text-white title-border fw-500"><?php the_sub_field('titulo_proceso'); ?></h3>
                        <p class="text-white fw-100"><?php the_sub_field('subtitulo_proceso'); ?></p>

                        <?php if (have_rows('repeat_proceso')) : ?>
                            <div class="iconos-procesos">
                                <?php while (have_rows('repeat_proceso')) : the_row(); ?>
                                    <?php $icono = get_sub_field('icono'); ?>
                                    <?php if ($icono) : ?>
                                        <figure class="mb-0">
                                            <?php echo wp_get_attachment_image($icono, $size); ?>
                                            <p><?php the_sub_field('descripcion'); ?></p>
                                        </figure>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $background_config_lg = get_field('background_config_lg'); ?>
<?php $background_config_sm = get_field('background_config_sm'); ?>
<section class="maserati-configurador" style="background-image:url(<?php echo !wp_is_mobile() ? wp_get_attachment_image_url($background_config_lg, $size) : ($background_config_sm ? wp_get_attachment_image_url($background_config_sm, $size) : wp_get_attachment_image_url($background_config_lg, $size)); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <h3 class="text-white fw-500"><?php the_field('titulo_config'); ?></h3>
                <a class="maserati-button maserati-button_large maserati-back--transparent mt-4 cursor" data-bs-toggle="modal" data-bs-target="#modalConfigVersion"><?php echo __('Iniciar', 'maserati'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="maserati-fuoriserie paddingY-95">
    <div class="container text-center mb-5">
        <h3 class="maserati-color--navi_blue fw-500"><?php the_field('titulo_fuoriserie'); ?></h3>
        <h4 class="maserati-color--dark_grey"><?php the_field('subtitulo_fuoriserie'); ?></h4>
    </div>

    <div class="container">
        <?php if (get_field('mostrar_video') == 1) :
            $video_desk = get_field('video_fuoriserie');
            if ($video_desk) : ?>
                <video class="videoItem w-100" autoplay muted data-desktop-asset="<?php echo $video_desk; ?>" data-mobile-asset="<?php echo $video_desk; ?>" preload="auto" loop="" playsinline="" src="<?php echo $video_desk; ?>"></video>
            <?php
            endif;
        else : ?>
            <?php $banner_fuoriserie = get_field('banner_fuoriserie'); ?>
            <?php $size = 'full'; ?>
            <?php if ($banner_fuoriserie) : ?>
                <?php echo wp_get_attachment_image($banner_fuoriserie, $size); ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php
        $enlace_a_fuoriserie = get_field('enlace_a_fuoriserie');
        $texto_fuoriserie = get_field('texto_fuoriserie');

        if ($enlace_a_fuoriserie || $texto_fuoriserie) : ?>
            <div class="foot-fuoriserie text-center">
                <?php echo $texto_fuoriserie ? '<p class="my-5">' . $texto_fuoriserie . '</p>' : ''; ?>

                <?php if ($enlace_a_fuoriserie) : ?>
                    <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto" href="<?php echo esc_url($enlace_a_fuoriserie['url']); ?>" target="<?php echo esc_attr($enlace_a_fuoriserie['target']); ?>"><?php echo esc_html($enlace_a_fuoriserie['title']); ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Modal Configuración-->
<div class="modal fade" id="modalConfigVersion" tabindex="-1" aria-labelledby="modalConfigVersionLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
                <?php
                $banner_modal_config = get_field('banner_modal_config_lg');
                $background_config_sm = get_field('banner_modal_config_sm');

                ?>
                <?php if ($banner_modal_config) : ?>
                    <figure>
                        <?php echo !wp_is_mobile() ? wp_get_attachment_image($banner_modal_config, $size, "", array("class" => "banner-modelo-conf")) : ($background_config_sm ? wp_get_attachment_image($background_config_sm, $size, "", array("class" => "banner-modelo-conf")) : wp_get_attachment_image($banner_modal_config, $size, "", array("class" => "banner-modelo-conf"))); ?>
                        <h3 class="text-center text-white fw-500"><?php echo __('¿Cuál modelo deseas configurar?', 'maserati'); ?></h3>
                    </figure>
                <?php endif; ?>
                <div class="container">
                    <h3 class="maserati-color--navi_blue text-center fw-500"><?php echo __('¿Cuál modelo deseas configurar?', 'maserati'); ?></h3>
                    <div class="accordion" id="accordionModels">
                        <?php foreach ($maserati_models as $maserati_model) : ?>
                            <?php if (have_rows('repeat_verisones', $maserati_model->ID)) :
                                /*while (have_rows('repeat_verisones', $maserati_model->ID)) : the_row();
                                    $codigo_version = get_sub_field('codigo_version'); // Solo variaciones que tengan el código de configuración Maserati ingresado
                                endwhile;*/
                                //if ($codigo_version) :
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingModel<?php echo get_the_title($maserati_model->ID); ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModel<?php echo get_the_title($maserati_model->ID); ?>" aria-expanded="true" aria-controls="collapseModel<?php echo get_the_title($maserati_model->ID); ?>">
                                            <h5 class="maserati-color--navi_blue"><?php echo __('La colección', 'maserati') . ' ' . get_the_title($maserati_model->ID); ?></h5>
                                        </button>
                                    </h2>
                                    <div id="collapseModel<?php echo get_the_title($maserati_model->ID); ?>" class="accordion-collapse show" aria-labelledby="headingModel<?php echo get_the_title($maserati_model->ID); ?>" data-bs-parent="#accordionModels">
                                        <div class="accordion-body">

                                            <?php if (have_rows('grupo_identidad', $maserati_model->ID)) : ?>
                                                <?php while (have_rows('grupo_identidad', $maserati_model->ID)) : the_row(); ?>
                                                    <h6 class="maserati-color--feature_grey"><?php the_sub_field('slogan_modelo'); ?></h6>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <div class="select-version">
                                                <?php while (have_rows('repeat_verisones', $maserati_model->ID)) : the_row();

                                                    $version_titulo = get_sub_field('nombre_version');
                                                    $version_image = get_sub_field('imagen_version');
                                                    $codigo_version = get_sub_field('codigo_version');
                                                ?>
                                                    <?php if ($codigo_version) : ?>
                                                        <div class="mini-card cursor" data-code="<?php echo $codigo_version ?>">
                                                            <?php echo wp_get_attachment_image($version_image, $size); ?>
                                                            <p><?php echo $version_titulo; ?></p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php //endif;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="button-call_to_action" style="display:none;">
        <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto text-uppercase cursor"><?php echo __('Configurar', 'maserati'); ?> <i class="icon-arrow-right"></i></a>
    </div>
</div>