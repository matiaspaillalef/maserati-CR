<?php get_template_part('parts/part', 'banner-page');
$size = 'full'; ?>


<section class="maserati-presentation-waranty">
    <div class="tiny-container">
        <h3 class="maserati-color--navi_blue fw-500 text-center"> <?php the_field('titulo_seccion_we'); ?></h3>
        <p class="maserati-color--navi_blue fw-300 text-left">
            <?php the_field('descripcion_seccion_we'); ?></p>
        <?php $folleto_seccion_we = get_field('folleto_seccion_we'); ?>
        <?php if ($folleto_seccion_we) : ?>
            <a class="maserati-button maserati-button_large <?php echo !wp_is_mobile() ? 'maserati-back--transparent_navy' : ''; ?> marginX-auto" href="<?php echo esc_url($folleto_seccion_we['url']); ?>"><i class="fa-solid fa-arrow-down"></i> <?php echo __('Folleto electrónico', 'maserati'); ?></a>
        <?php endif; ?>
    </div>
</section>


<?php $imagen_trayecto = get_field('imagen_trayecto'); ?>
<section class="maserati-trayecto-waranty maserati-bg--off_white">
    <div class="container">
        <div class="row">
            <?php if ($imagen_trayecto) : ?>
                <div class="col-md-6 col-sm-12">
                    <?php echo wp_get_attachment_image($imagen_trayecto, $size); ?>
                </div>
            <?php endif; ?>

            <?php if (have_rows('grupo_trayecto')) : ?>
                <div class="col-md-6 col-sm-12">
                    <?php while (have_rows('grupo_trayecto')) : the_row(); ?>
                        <h3 class="maserati-color--navi_blue fw-500"> <?php the_sub_field('tiulo_trayecto'); ?></h3>
                        <p class="maserati-color--navi_blue fw-300"><?php the_sub_field('contenido_trayecto'); ?></p>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php $imagen_destacado = get_field('imagen_destacado'); ?>
<?php if ($imagen_destacado) : ?>
    <section class="maserati-waranty-featured_image">
        <div class="fullwidth">
            <?php echo wp_get_attachment_image($imagen_destacado, $size); ?>
        </div>
    </section>
<?php endif; ?>



<section class="maserati-programa-waranty">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h3 class="maserati-color--navi_blue fw-500"> <?php the_field('titulo_programa'); ?></h3>
                <p class="maserati-color--navi_blue fw-300"><?php the_field('contenido_programa'); ?></p>
            </div>
            <div class="col-md-6 col-sm-12">

                <?php if (have_rows('programa_repeat')) : ?>
                    <div class="items-waranty-year">
                        <?php while (have_rows('programa_repeat')) : the_row(); ?>
                            <figure class="mb-0">
                                <?php $icono_pro = get_sub_field('icono_pro'); ?>
                                <?php if ($icono_pro) : ?>
                                    <?php echo wp_get_attachment_image($icono_pro, $size); ?>
                                <?php endif; ?>
                                <h5><?php the_sub_field('titulo_pro'); ?></h5>
                                <p><?php the_sub_field('descripcion_pro'); ?></p>
                            </figure>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php $enlace_programa = get_field('enlace_programa'); ?>
                <?php if ($enlace_programa) : ?>
                    <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto" href="<?php echo esc_url($enlace_programa['url']); ?>" target="<?php echo esc_attr($enlace_programa['target']); ?>"><?php echo esc_html($enlace_programa['title']); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php $imagen_tranquilidad = get_field('imagen_tranquilidad'); ?>
<?php $imagen_tranquilidad_mobile = get_field('imagen_tranquilidad_mobile'); ?>
<section class="maserati-tranquilidad-waranty maserati-bg--off_white">
    <div class="container">
        <div class="row">
            <?php if ($imagen_tranquilidad || $imagen_tranquilidad_mobile) : ?>
                <div class="col-md-6 col-sm-12">
                    <?php echo wp_is_mobile() ? wp_get_attachment_image($imagen_tranquilidad_mobile, $size) : wp_get_attachment_image($imagen_tranquilidad, $size); ?>
                </div>
            <?php endif; ?>

            <?php if (have_rows('grupo_tranquilidad')) : ?>
                <div class="col-md-6 col-sm-12">
                    <?php while (have_rows('grupo_tranquilidad')) : the_row(); ?>
                        <h3 class="maserati-color--navi_blue fw-500"> <?php the_sub_field('titulo_tranquilidad'); ?></h3>
                        <div class="maserati-color--navi_blue fw-300 content-with-disclamers"><?php the_sub_field('subtitulo_tranquilidad'); ?>
                            <button type="button" class="maserati-disclamers cursor" <?php echo get_sub_field('disclamers_tranquilidad') ? 'data-bs-target="#disclamersModalLegal" data-bs-toggle="modal"' : ''; ?>>
                                <span data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Terminos y Condiciones" data-bs-original-title="" title="">
                                    <i class="fa-solid fa-exclamation"></i>
                                </span>
                            </button>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php
$banner_waranty_model = get_field('banner_waranty_model');
?>
<?php if (have_rows('repeater_waranty_model')) : ?>
    <section class="maserati-waranty-model maserati-bg--off_white">
        <?php if ($banner_waranty_model) : ?>
            <div class="fullwidth">
                <?php echo wp_get_attachment_image($banner_waranty_model, $size); ?>
            </div>
        <?php endif; ?>

        <?php
        $i = 1;
        while (have_rows('repeater_waranty_model')) : the_row(); ?>
            <?php $back_color = get_sub_field('backgorund_waranty_model'); ?>
            <div class="fullwidth" style="<?php echo $back_color && !wp_is_mobile() ? 'background-color:' . $back_color . ';' : 'background-color:#ffffff;'; ?>">
                <div class="container">
                    <div class="row">
                        <?php
                        $imagen_waranty_model = get_sub_field('imagen_waranty_model');
                        if ($imagen_waranty_model) : ?>
                            <div class="col-md-6 col-sm-12 maserati-object-cover">
                                <?php echo wp_get_attachment_image($imagen_waranty_model, $size); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (have_rows('grupo_waranty_model')) : ?>
                            <div class="col-md-6 col-sm-12">
                                <?php while (have_rows('grupo_waranty_model')) : the_row(); ?>
                                    <h3 class="maserati-color--navi_blue fw-500"><?php the_sub_field('titulo'); ?></h3>
                                    <h4><?php the_sub_field('subtitulo'); ?></h4>
                                    <div class="maserati-color--navi_blue fw-300 content-with-disclamers">
                                        <?php the_sub_field('descripcion'); ?>
                                        <a class="maserati-disclamers" data-bs-toggle="modal" data-bs-target="#disclamersModal" data-disclamer="<?php the_sub_field('disclamers'); ?>"><?php echo $i ?></a>
                                    </div>

                                    <?php if (get_sub_field('archivo_select') == 1) : ?>
                                        <?php $archivo = get_sub_field('archivo'); ?>
                                        <?php if ($archivo) : ?>
                                            <a class="maserati-button maserati-button_large maserati-back--transparent_navy mt-5 <?php echo wp_is_mobile() ? 'marginX-auto' : ''; ?>" target="_blank" href="<?php echo esc_url($archivo['url']); ?>"><i class="fa-solid fa-arrow-down"></i> <?php echo __('Folleto electrónico', 'maserati'); ?></a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php
                                        $enlace_waranty_model = get_sub_field('enlace');
                                        if ($enlace_waranty_model) : ?>
                                            <a class="maserati-button maserati-button_large maserati-back--navi_blue mt-5 <?php echo wp_is_mobile() ? 'marginX-auto' : ''; ?>" href="<?php echo esc_url($enlace_waranty_model['url']); ?>" target="<?php echo esc_attr($enlace_waranty_model['target']); ?>"><?php echo esc_html($enlace_waranty_model['title']); ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php $i++;
        endwhile; ?>

    </section>
<?php endif; ?>


<?php /* Modal disclamers */ ?>
<div class="modal fade" id="disclamersModal" tabindex="-1" aria-labelledby="disclamersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <p></p>
                <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" data-bs-dismiss="modal" aria-label="Close"><?php echo __('Entendido', 'maserati'); ?></a>
            </div>
        </div>
    </div>
</div>


<!-- Disclamer Modal Legal -->
<?php if (have_rows('grupo_tranquilidad')) :
    while (have_rows('grupo_tranquilidad')) : the_row();
        $disclamers = get_sub_field('disclamers_tranquilidad');
        if ($disclamers) : ?>
            <div class="modal fade show" id="disclamersModalLegal" tabindex="-1" aria-labelledby="disclamersModalLabel" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <?php echo $disclamers; ?>
                            <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" data-bs-dismiss="modal" aria-label="Close">Entendido</a>
                        </div>
                    </div>
                </div>
            </div>
<?php endif;
    endwhile;
endif; ?>
<?php get_template_part('parts/part', 'contacto'); ?>