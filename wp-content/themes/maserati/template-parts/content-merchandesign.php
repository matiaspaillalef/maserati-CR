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
        <h4 class="maserati-color--feature_grey fw-500 text-center"><?php the_field('titulo_bottom_video'); ?></h3>
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
        <p class="maserati-color--navi_blue"><?php the_field('descripcion_bottom_video'); ?></p>
        <?php $enlace_presentacion = get_field('enlace_presentacion'); ?>
        <?php if ($enlace_presentacion) : ?>
            <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto mt-5" href="<?php echo esc_url($enlace_presentacion['url']); ?>" target="<?php echo esc_attr($enlace_presentacion['target']); ?>"><?php echo esc_html($enlace_presentacion['title']); ?></a>
        <?php endif; ?>
    </div>
</section>

<?php $banner_intermedio = get_field('banner_intermedio'); ?>
<?php $banner_intermedio_mobile = get_field('banner_intermedio_mb'); ?>
<?php if ($banner_intermedio) : ?>
    <section class="banner-middle">
        <div class="fullwidth">
            <?php echo !wp_is_mobile() ? wp_get_attachment_image($banner_intermedio, $size, "", array("class" => "middle-banner-block", "id" => "imgPin")) : ($banner_intermedio_mobile ? wp_get_attachment_image($banner_intermedio_mobile, $size, "", array("class" => "middle-banner-block")) : wp_get_attachment_image($banner_intermedio, $size, "", array("class" => "middle-banner-block"))); ?>
            <div class="tiny-container">
                <h4 class="text-left text-white"><?php echo get_field('titulo_banner_intermedio'); ?></h4>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php if (have_rows('imagenes_sp')) : ?>
    <section class="maserati-gallery">
        <div class="tiny-container">
            <h4 class="maserati-color--navi_blue text-center"><?php the_field('titulo_galeria'); ?></h4>
        </div>
        <div class="fullwidth">
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

<?php $catalogo_pdf = get_field('catalogo_pdf'); ?>
<?php $productos_catalogo = get_field('productos_catalogo'); ?>
<?php if ($catalogo_pdf || $productos_catalogo) : ?>
    <section class="maserati-merchandesign-catalogo">
        <div class="tiny-container">
            <h3 class="maserati-color--navi_blue text-center fw-500"><?php the_field('titulo_catalogo'); ?></h3>
            <?php if ($catalogo_pdf) : ?>
                <a class="maserati-button aserati-button_large maserati-color--navi_blue" href="<?php echo esc_url($catalogo_pdf['url']); ?>" target="_blank"><i class="fas fa-arrow-down"></i> <?php echo __('Descargar catálogo', 'maserati'); ?></a>
            <?php endif; ?>
            <?php if ($productos_catalogo) : ?>
                <a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto" href="<?php echo esc_url($productos_catalogo['url']); ?>" target="<?php echo esc_attr($productos_catalogo['target']); ?>"><?php echo esc_html($productos_catalogo['title']); ?></a>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>