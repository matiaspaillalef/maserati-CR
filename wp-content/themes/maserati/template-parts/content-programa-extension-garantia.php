<?php get_template_part('parts/part', 'banner-page');
$size = 'full'; ?>


<section class="maserati-presentation-programa">
    <div class="tiny-container">
        <h3 class="maserati-color--navi_blue fw-500 text-center"><?php the_field('titulo_programa'); ?></h3>
        <p class="maserati-color--navi_blue fw-300 text-left"><?php the_field('contenido_programa'); ?></p>
    </div>
    <?php if (have_rows('programa_repeat')) : ?>
        <div class="container">
            <div class="row">
                <?php
                $i = 1;
                while (have_rows('programa_repeat')) : the_row(); ?>
                    <div class="col-md-4 col-sm-12">
                        <div class="accordion" id="accordionWaranty<?php echo $i; ?>">
                            <div class="accordion-item maserati-card-accordion">
                                <button id="heading<?php echo $i; ?>" class="accordion-header accordion-button <?php echo get_sub_field('contenido_pro') ? '' : 'no-accordion-body'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="<?php echo get_sub_field('contenido_pro') ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $i; ?>">
                                    <h5><?php the_sub_field('titulo_pro'); ?></h5>
                                    <p class="fw-500"><?php the_sub_field('descripcion_pro'); ?></p>
                                </button>
                                <?php if (get_sub_field('contenido_pro')) : ?>
                                    <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?php echo $i; ?>" data-bs-parent="#accordionWaranty<?php echo $i; ?>">
                                        <div class="accordion-body">
                                            <?php the_sub_field('contenido_pro'); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php $i++;
                endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
</section>




<?php $banner_intermedio = get_field('banner_intermedio'); ?>
<?php if ($banner_intermedio) : ?>
    <section>
        <div class="fullwidth">
            <?php echo wp_get_attachment_image($banner_intermedio, $size, "", array("class" => "middle-banner-block")); ?>
        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('garantias_repeat')) : ?>
    <section class="maserati-tipos-garantias">
        <div class="container">
            <?php while (have_rows('garantias_repeat')) : the_row(); ?>
                <?php if (wp_is_mobile()) : ?>
                    <div class="card-item-waranty">
                        <h5><?php the_sub_field('titulo_card'); ?></h5>
                        <p><?php the_sub_field('content_card'); ?></p>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
            <div class="row">
                <?php while (have_rows('garantias_repeat')) : the_row(); ?>
                    <div class="col-md-6 col-ms-12">
                        <?php if (!wp_is_mobile()) : ?>
                            <div class="card-item-waranty">
                                <h5><?php the_sub_field('titulo_card'); ?></h5>
                                <p><?php the_sub_field('content_card'); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php $titulo_table = get_sub_field('titulo_tabla'); ?>
                        <?php if (have_rows('tabla_repeat')) : ?>
                            <table class="table-waranty">
                                <thead>
                                    <tr>
                                        <th>
                                            <h3 class="fw-500"><?php echo $titulo_table; ?></h3>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while (have_rows('tabla_repeat')) : the_row(); ?>
                                        <tr>
                                            <td>
                                                <strong><?php the_sub_field('titulo_table'); ?></strong>
                                                <?php the_sub_field('descripcion_table'); ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$imagen_1 = get_field('imagen_1');
$imagen_2 = get_field('imagen_2');
$enlace_mv = get_field('enlace_mv');
?>

<?php if (have_rows('grupo_mejores_vehiculos')) : ?>
    <section class="maserati-mejores-vehiculos maserati-bg--off_white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?php while (have_rows('grupo_mejores_vehiculos')) : the_row(); ?>
                        <h3 class="maserati-color--navi_blue fw-500"> <?php the_sub_field('tiulo_mv'); ?></h3>
                        <?php the_sub_field('contenido_mv'); ?>
                    <?php endwhile; ?>
                    <?php if ($enlace_mv) : ?>
                        <a class="maserati-button maserati-button_large maserati-back--navi_blue mt-5" href="<?php echo esc_url($enlace_mv['url']); ?>" target="<?php echo esc_attr($enlace_mv['target']); ?>"><?php echo esc_html($enlace_mv['title']); ?></a>
                    <?php endif; ?>
                </div>
                <?php if ($imagen_1 || $imagen_2) : ?>
                    <div class="col-md-6 col-sm-12">
                        <?php echo wp_get_attachment_image($imagen_1, $size); ?>
                        <?php echo wp_get_attachment_image($imagen_1, $size, "", array("class" => "mt-5")); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('repeater_block')) : ?>
    <section class="maserati-block-featured">
        <?php while (have_rows('repeater_block')) : the_row();
            $color_back =  the_sub_field('backgorund_block'); ?>
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
                        <?php $imagen_block = get_sub_field('imagen_block'); ?>
                        <?php if ($imagen_block) : ?>
                            <div class="col-md-6 col-sm-12">
                                <?php echo wp_get_attachment_image($imagen_block, $size); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>


















<?php get_template_part('parts/part', 'contacto'); ?>