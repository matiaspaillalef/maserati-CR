<?php get_template_part('parts/part', 'banner-page');
$size = 'full';
?>
<?php if (get_field('contenido_presentacion')) : ?>
    <section class="presentation-proyecto">
        <div class="medium-container">
            <?php the_field('contenido_presentacion'); ?>
        </div>
    </section>
<?php endif; ?>


<?php if (have_rows('repeater_multimedias')) : ?>
    <section class="maserati-proyecto_multimedia maserati-proyecto-light_multimedia">
        <div class="container">
            <?php while (have_rows('repeater_multimedias')) : the_row(); ?>
                <div class="item-multimedia">
                    <?php $enlace_video = get_sub_field('video_multimedia'); ?>
                    <?php $banner_multimedia = get_sub_field('banner_multimedia'); ?>
                    <?php $poster_multimedia = get_sub_field('poster_multimedia'); ?>
                    <?php if (get_sub_field('cargar_video') == 1) : ?>
                        <video poster="<?php echo wp_get_attachment_image_url($poster_multimedia, $size); ?>" controls data-desktop-asset="<?php echo $enlace_video ?>" data-mobile-asset="<?php echo $enlace_video ?>" preload="none" loop="" playsinline="" src="<?php echo $enlace_video ?>">
                        </video>
                    <?php else : ?>
                        <?php if ($banner_multimedia) : ?>
                            <?php echo wp_get_attachment_image($banner_multimedia, $size); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="medium-container">
                        <?php echo get_sub_field('titulo_multimedia') ? '<h3 class="maserati-color--navi_blue fw-500">' . get_sub_field('titulo_multimedia') . '</h3>' : ''; ?>
                        <?php echo get_sub_field('texto_multimedia') ? '<p>' . get_sub_field('texto_multimedia') . '</p>' : ''; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>


<?php if (have_rows('imagenes_sp')) : ?>
    <section class="maserati-gallery">
        <div class="container">
            <?php
            if (!wp_is_mobile()) :
                $count_img = 1; ?>
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
            <?php else : ?>
                <div class="swiper swiper-light-proyectos-furioserie">
                    <div class="swiper-wrapper">
                        <?php while (have_rows('imagenes_sp')) : the_row(); ?>
                            <?php $Imagen_sp = get_sub_field('Imagen_sp'); ?>
                            <?php $size = 'full'; ?>
                            <?php if ($Imagen_sp) : ?>
                                <div class="swiper-slide">
                                    <?php echo wp_get_attachment_image($Imagen_sp, $size); ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php endif; ?>
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