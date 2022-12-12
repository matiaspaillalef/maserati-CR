<?php get_template_part('parts/part', 'banner-page');
$size = 'full'; ?>

<?php $video_presentacion = get_field('video_presentacion');
$banner_presentacion = get_field('banner_presentacion') ?>
<section class="maserati-presentation-programa">
    <div class="tiny-container">
        <h3 class="maserati-color--navi_blue fw-500 text-center"><?php the_field('titulo_presentacion'); ?></h3>
        <p class="maserati-color--navi_blue"><?php the_field('descripcion_presentacion'); ?></p>
    </div>
    <div class="container">
        <?php if (get_field('imagen_select') == 0) : ?>
            <video class="videoItem w-100" autoplay muted data-desktop-asset="<?php echo $video_presentacion; ?>" data-mobile-asset="<?php echo $video_presentacion; ?>" preload="auto" loop="" playsinline="" src="<?php echo $video_presentacion; ?>"></video>
        <?php else : ?>
            <?php if ($banner_presentacion) : ?>
                <?php echo wp_get_attachment_image($banner_presentacion, $size); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="tiny-container">
        <h3 class="maserati-color--navi_blue fw-500 text-center"><?php the_field('titulo_bottom_video'); ?></h3>
        <p class="maserati-color--navi_blue"><?php the_field('descripcion_bottom_video'); ?></p>
        <?php $enlace_presentacion = get_field('enlace_presentacion'); ?>
        <?php if ($enlace_presentacion) : ?>
            <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto mt-5" href="<?php echo esc_url($enlace_presentacion['url']); ?>" target="<?php echo esc_attr($enlace_presentacion['target']); ?>"><?php echo esc_html($enlace_presentacion['title']); ?></a>
        <?php endif; ?>
    </div>
</section>

<?php $banner_intermedio = get_field('banner_intermedio'); ?>
<?php if ($banner_intermedio) : ?>
    <section>
        <div class="fullwidth">
            <?php echo wp_get_attachment_image($banner_intermedio, $size, "", array("class" => "middle-banner-block")); ?>
        </div>
    </section>
<?php endif; ?>


<?php if (have_rows('imagenes_sp')) : ?>
    <section class="maserati-gallery">
        <div class="tiny-container">
            <h4 class="maserati-color--feature_grey text-center"><?php the_field('titulo_galeria'); ?></h4>
        </div>
        <div class="container">
            <?php $count_img = 1; ?>
            <div class="row g-4">
                <?php while (have_rows('imagenes_sp')) : the_row(); ?>
                    <?php $Imagen_sp = get_sub_field('Imagen_sp'); ?>
                    <?php $size = 'full'; ?>
                    <?php if ($Imagen_sp) : ?>
                        <?php if ($count_img <= 2) : ?>
                            <div class="col">
                                <?php echo wp_get_attachment_image($Imagen_sp, $size); ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        if ($count_img == 3) : ?>
                            <div class="col-md-12 col-sm-12">
                                <?php echo wp_get_attachment_image($Imagen_sp, $size); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php
                    $count_img++;
                endwhile; ?>
            </div>
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
                                    <?php echo get_sub_field('titulo') ? '<h3 class="fw-500 maserati-color--navi_blue">' . get_sub_field('titulo') . '</h3>' : ''; ?>
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