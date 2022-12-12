<?php get_template_part('parts/part', 'banner-page');
$size = 'full'; ?>




<?php
$video_presentacion = get_field('video_presentacion');
$titulo_presentacion = get_field('titulo_presentacion');
$contenido_presentacion = get_field('contenido_presentacion'); ?>
<section class="maserati-fuoriserie_presentacion maserati-bg--dark">
    <?php if ($titulo_presentacion || $contenido_presentacion) : ?>
        <div class="tiny-container">
            <?php echo $titulo_presentacion ? '<h4 class="text-white title-border">' . $titulo_presentacion . '</h4>' : ''; ?>
            <?php echo $contenido_presentacion ? '<p class="text-white">' . $contenido_presentacion . '</p>' : ''; ?>
        </div>
    <?php endif; ?>
    <?php if (get_field('video_presentacion')) : ?>
        <div class="container">
            <video id="videoPin" muted autoplay <?php echo $video_presentacion ? 'data-desktop-asset="' . $video_presentacion . '"' : ''; ?> <?php echo $video_presentacion ? 'data-mobile-asset="' . $video_presentacion . '"' : ''; ?> preload="none" loop="" playsinline="" src="<?php echo $video_presentacion ? $video_presentacion : ''; ?>">
            </video>
        </div>
    <?php endif; ?>
</section>


<?php

$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
);

$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="maserati-fuoriserie_coleccion">
        <div class="tiny-container">
            <?php echo get_field('titulo_colecciones') ? '<h3 class="fw-500 text-center maserati-color--navi_blue">' . get_field('titulo_colecciones') . '</h3>' : ''; ?>
            <?php echo get_field('contenido_colecciones') ? '<p class="fw-100">' . get_field('contenido_colecciones') . '</p>' : ''; ?>
        </div>
        <div class="container">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <article id="parent-<?php the_ID(); ?>" class="parent-page">
                    <?php the_post_thumbnail(); ?>
                    <div class="content-article_fuoriserie">
                        <h2 class="h1 text-white"><?php the_title(); ?></h2>
                        <p class="text-white fw-100"><?php echo get_the_excerpt(); ?></p>
                        <a class="maserati-button maserati-button_large maserati-back--transparent" href="<?php the_permalink(); ?>" title=""><?php echo __('Descubre más', 'maserati') ?></a>
                    </div>

                </article>
            <?php endwhile; ?>
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
                    <h3 class="text-white title-border fw-500"><?php echo get_the_title($proyecto_destacado); ?></h3>
                    <p class="fw-100 text-white"><?php echo get_the_excerpt($proyecto_destacado); ?></p>
                    <a class="maserati-button maserati-button_large maserati-back--transparent" href="<?php echo get_permalink($proyecto_destacado); ?>" title=""><?php echo __('Conocer más', 'maserati') ?></a>
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
            <p class="fw-300"><?php the_field('contenido_proyectos'); ?></p>
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

<?php get_template_part('parts/part', 'contacto-fuoriserie')
?>