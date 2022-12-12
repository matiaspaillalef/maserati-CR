<?php get_template_part('parts/part', 'banner-page');
$size = 'full';
?>

<?php if (have_rows('imagenes_sp')) : ?>
    <section class="maserati-gallery">
        <div class="tiny-container">
            <h3 class="maserati-color--navi_blue text-center fw-500"><?php the_field('titulo_galeria'); ?></h3>
            <p class="maserati-color--navi_blue fw-100"><?php the_field('subtitulo_galeria'); ?></p>
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
                                <a data-bs-toggle="modal" data-bs-target="#modelGalleryGrid" data-current="<?php echo $count_img - 1; ?>">
                                    <?php echo wp_get_attachment_image($Imagen_sp, $size); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php
                        if ($count_img == 3) : ?>
                            <div class="col-md-12 col-sm-12">
                                <a data-bs-toggle="modal" data-bs-target="#modelGalleryGrid" data-current="<?php echo $count_img - 1; ?>">
                                    <?php echo wp_get_attachment_image($Imagen_sp, $size); ?>
                                </a>
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


<section class="maserati-model_galeria">

    <div class="tiny-container">
        <h3 class="text-center fw-500"><?php the_field('titulo_materialidad'); ?></h3>
        <p class="maserati-color--dark_grey"><?php the_field('texto_materialidad'); ?></p>
    </div>

    <?php if (have_rows('repeater_materialidad_galeria')) : ?>
        <div class="fullwidth mt-5">
            <div class="swiper swiper-2_5_gallery_singles card-slider">
                <div class="swiper-wrapper">
                    <?php
                    while (have_rows('repeater_materialidad_galeria')) : the_row();
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

<?php $banner_lg_featured = get_field('banner_lg_featured'); ?>
<?php $banner_sm_featured = get_field('banner_sm_featured'); ?>
<?php if ($banner_lg_featured) : ?>
    <section class="maserati-fuoriserie_featured item-destacado">
        <?php echo !wp_is_mobile() ? wp_get_attachment_image($banner_lg_featured, $size) : ($banner_sm_featured ? wp_get_attachment_image($banner_sm_featured, $size) : wp_get_attachment_image($banner_lg_featured, $size)); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <h3 class="text-white title-border fw-500"><?php the_field('titulo_featured'); ?></h3>
                    <p class="fw-100 text-white"><?php the_field('subtitulo_featured'); ?></p>
                    <?php $enlace_featured = get_field('enlace_featured'); ?>
                    <?php if ($enlace_featured) : ?>
                        <a class="maserati-button maserati-button_large maserati-back--transparent" href="<?php echo esc_url($enlace_featured['url']); ?>" target="<?php echo esc_attr($enlace_featured['target']); ?>"><?php echo esc_html($enlace_featured['title']); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php
$args = array(
    'post_type'      => 'proyectos_fuoriserie',
    'posts_per_page' => -1,
    'order'          => 'DESC',
    'orderby'        => 'menu_order'
);
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="maserati-fuoriserie_proyectos maserati-bg--off_white">
        <div class="container">
            <h3 class="maserati-color--navi_blue fw-500"><?php the_field('titulo_proyectos'); ?></h3>
            <p class="fw-100"><?php the_field('contenido_proyectos'); ?></p>
        </div>
        <div class="container">
            <div class="swiper swiper-all-proyectos-furioserie">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <article class="card-fuoriserie swiper-slide">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            <div class="content-article_fuoriserie--proyecto">
                                <a href="<?php the_permalink(); ?>">
                                    <h5 class=""><?php the_title(); ?></h5>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div id="swiper-button-prev-news-furioserie" class="swiper-button-next"></div>
            <div id="swiper-button-next-news-furioserie" class="swiper-button-prev"></div>
        </div>
    </section>
<?php wp_reset_postdata();
endif; ?>


<?php $proyecto_destacado = get_field('proyecto_destacado', $post->ID); ?>
<?php if ($proyecto_destacado) : ?>
    <section class="maserati-fuoriserie_featured">
        <?php $imagen_destacada_mobile = get_field('imagen_destacada_mobile', $proyecto_destacado); ?>
        <?php echo !wp_is_mobile() ? get_the_post_thumbnail($proyecto_destacado) : ($imagen_destacada_mobile ? wp_get_attachment_image($imagen_destacada_mobile, $size) : get_the_post_thumbnail($proyecto_destacado)); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <h3 class="text-white text-uppercase fw-100"><?php echo get_the_title($proyecto_destacado); ?></h3>
                    <p class="fw-100 text-white"><?php echo get_the_excerpt($proyecto_destacado); ?></p>
                    <a class="maserati-button maserati-button_large maserati-back--transparent" href="<?php echo get_permalink($proyecto_destacado); ?>" title=""><?php echo __('Conocer más', 'maserati') ?></a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>





<?php get_template_part('parts/part', 'contacto-fuoriserie') ?>




<!-- Modal galeria-->
<?php if (have_rows('repeater_materialidad_galeria')) : ?>
    <div class="modal fade" id="modelGallery" tabindex="-1" aria-labelledby="modelGalleryLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <?php if (have_rows('repeater_materialidad_galeria')) : ?>
                        <div class="swiper swiper-2_5_gallery-modal card-slider">
                            <div class="swiper-wrapper">

                                <?php
                                while (have_rows('repeater_materialidad_galeria')) : the_row();
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



<!-- Modal galeria principal-->
<?php if (have_rows('imagenes_sp')) : ?>
    <div class="modal fade" id="modelGalleryGrid" tabindex="-1" aria-labelledby="modelGalleryGridLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">

                    <div class="swiper swiper-2_5_gallery-modal-cf card-slider">
                        <div class="swiper-wrapper">

                            <?php
                            $i = 0;
                            while (have_rows('imagenes_sp')) : the_row();
                                $imagen_galeria = get_sub_field('Imagen_sp');
                            ?>
                                <div class="swiper-slide">
                                    <div class="inner-slide maserati-shadow">
                                        <?php if ($imagen_galeria) : ?>
                                            <?php echo wp_get_attachment_image($imagen_galeria, $size); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php $i++;
                            endwhile; ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>