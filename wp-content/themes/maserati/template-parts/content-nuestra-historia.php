<?php get_template_part('parts/part', 'banner-page');
$size = 'full';
?>

<?php $imagen_presentacion = get_field('imagen_presentacion'); ?>
<section class="maserati-history_presentation maserati-bg--dark">
    <div class="tiny-container">
        <h2 class="h1 text-white fw-300 text-center"><?php the_field('titulo_presentacion'); ?></h2>
        <h4 class="text-white text-center"><?php the_field('subtitulo_presentacion'); ?></h4>
        <?php if ($imagen_presentacion) : ?>
            <?php echo wp_get_attachment_image($imagen_presentacion, $size); ?>
        <?php endif; ?>
    </div>
    <?php if (!wp_is_mobile()) : ?>
        <div class="container">
            <?php if (get_field('video_youtube') == 1) : ?>
                <div class="embed-container">
                    <?php the_field('video_yb_presentacion'); ?>
                </div>
            <?php else : ?>
                <?php
                $video_presentacion = get_field('video_presentacion');
                $poster_video = get_field('poster_video');
                ?>
                <video class="videoItem w-100" poster="<?php echo $poster_video; ?>" muted data-desktop-asset="" preload="auto" playsinline="">
                    <source src="<?php echo $video_presentacion; ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if (get_field('titulo_linea_de_tiempo') || get_field('texto_linea_de_tiempo')) : ?>
        <div class="micro-container">
            <h3 class="title-line text-white fw-500"><?php the_field('titulo_linea_de_tiempo'); ?></h3>
            <p class="text-white"><?php the_field('texto_linea_de_tiempo'); ?></p>
            <?php if (wp_is_mobile()) : ?>
                <div class="vide-container">
                    <?php if (get_field('video_youtube') == 1) : ?>
                        <div class="embed-container">
                            <?php the_field('video_yb_presentacion'); ?>
                        </div>
                    <?php else : ?>
                        <?php $video_presentacion = get_field('video_presentacion'); ?>
                        <video class="videoItem w-100" autoplay muted data-desktop-asset="<?php echo $video_presentacion; ?>" data-mobile-asset="<?php echo $video_presentacion; ?>" preload="auto" loop="" playsinline="" src="<?php echo $video_presentacion; ?>"></video>
                    <?php endif; ?>
                </div>
            <?php endif;
            $enlace_linea_de_tiempo = get_field('enlace_linea_de_tiempo');
            ?>

            <?php echo $enlace_linea_de_tiempo ? '<a class="more-action" href="' . $enlace_linea_de_tiempo['url'] . '" target="' . $enlace_linea_de_tiempo['target'] . '"><i class="icon-more"></i></a>' : ''; ?>
        </div>
    <?php endif; ?>
</section>


<?php $banner_intermedio = get_field('banner_intermedio'); ?>
<?php $banner_intermedio_mb = get_field('banner_intermedio_mb'); ?>
<?php if ($banner_intermedio) : ?>
    <section class="maserati-banner-intermedio">
        <div class="fullwidth">
            <?php echo !wp_is_mobile() ? wp_get_attachment_image($banner_intermedio, $size, "", array("class" => "middle-banner-block")) : ($banner_intermedio_mb ? wp_get_attachment_image($banner_intermedio_mb, $size, "", array("class" => "middle-banner-block")) : wp_get_attachment_image($banner_intermedio, $size, "", array("class" => "middle-banner-block"))); ?>
            <h4 class="text-center text-white"><?php the_field('texto_banner_intermedio'); ?></h4>
        </div>
    </section>
<?php endif; ?>

<?php $background_timeline = get_field('background_timeline'); ?>
<?php if (have_rows('nav_timeline')) : ?>
    <section id="maserati-timeline" class="maserati-timeline" style="<?php echo $background_timeline ? 'background-image:url(' . wp_get_attachment_image_url($background_timeline, $size) . ');' : ''; ?>">
        <div class="container">
            <?php if (!wp_is_mobile()) : ?>
                <div class="d-flex align-items-center maserati-tabnav">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php $i = 1;
                        while (have_rows('nav_timeline')) : the_row();
                            $titulo = get_sub_field('titulo_seccion'); ?>
                            <button class="nav-link <?php echo $i == 1 ? 'active' : ''; ?>" id="<?php echo  sanitize_title($titulo); ?>" data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo  sanitize_title($titulo); ?>" type="button" role="tab" aria-controls="v-pills-<?php echo  sanitize_title($titulo); ?>" aria-selected="<?php echo $i == 1 ? 'true' : 'false'; ?>"><?php echo  $titulo; ?></button>
                        <?php $i++;
                        endwhile; ?>
                    </div>
                    <div class="tab-content text-center" id="v-pills-tabContent">
                        <?php $i = 1;
                        while (have_rows('nav_timeline')) : the_row();
                            $titulo = get_sub_field('titulo_seccion'); ?>
                            <div class="tab-pane fade <?php echo $i == 1 ? 'show active' : ''; ?>" id="v-pills-<?php echo  sanitize_title($titulo); ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo  sanitize_title($titulo); ?>-tab" tabindex="0">
                                <?php if (have_rows('group_body')) : ?>
                                    <?php while (have_rows('group_body')) : the_row(); ?>
                                        <?php $imagen_group = get_sub_field('imagen_group'); ?>
                                        <?php if ($imagen_group) : ?>
                                            <?php echo wp_get_attachment_image($imagen_group, $size); ?>
                                        <?php endif; ?>
                                        <?php echo get_sub_field('ocultar_titulo') == 1 ? '' : '<h2>' . $titulo . '</h2>'; ?>
                                        <h4><?php the_sub_field('subtitulo_group'); ?></h4>
                                        <?php $enlace_group = get_sub_field('enlace_group'); ?>
                                        <?php if ($enlace_group) : ?>
                                            <a class="maserati-button aserati-button_large maserati-color--navi_blue" href="<?php echo esc_url($enlace_group['url']); ?>" target="<?php echo esc_attr($enlace_group['target']); ?>"><span><?php echo esc_html($enlace_group['title']); ?></span> <i class="fa-solid fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        <?php $i++;
                        endwhile; ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="maserati-linetime-sm">
                    <?php $i = 1;
                    while (have_rows('nav_timeline')) : the_row();
                        $titulo = get_sub_field('titulo_seccion'); ?>
                        <div class="item-linetime" id="v-pills-<?php echo  sanitize_title($titulo); ?>">
                            <?php if (have_rows('group_body')) : ?>
                                <?php while (have_rows('group_body')) : the_row(); ?>
                                    <?php $imagen_group = get_sub_field('imagen_group'); ?>
                                    <?php if ($imagen_group) : ?>
                                        <?php echo wp_get_attachment_image($imagen_group, $size); ?>
                                    <?php endif; ?>
                                    <?php echo get_sub_field('ocultar_titulo') == 1 ? '' : '<h2>' . $titulo . '</h2>'; ?>
                                    <h4><?php the_sub_field('subtitulo_group'); ?></h4>
                                    <?php $enlace_group = get_sub_field('enlace_group'); ?>
                                    <?php if ($enlace_group) : ?>
                                        <a class="more-action" href="<?php echo esc_url($enlace_group['url']); ?>" target="<?php echo esc_attr($enlace_group['target']); ?>"><i class="icon-more"></i></a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    <?php $i++;
                    endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
$background_actualidad_lg = get_field('background_actualidad_lg');
$background_actualidad_sm = get_field('background_actualidad_sm');
$contenido_actualidad     = get_field('contenido_actualidad');

if ($contenido_actualidad) : ?>
    <section class="maserati-actualidad" style="background-image: url(<?php echo !wp_is_mobile() ? wp_get_attachment_image_url($background_actualidad_lg, $size) : ($background_actualidad_sm ? wp_get_attachment_image_url($background_actualidad_sm, $size) : wp_get_attachment_image_url($background_actualidad_lg, $size)); ?>)">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?php echo $contenido_actualidad ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>