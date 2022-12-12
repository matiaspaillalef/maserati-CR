<?php get_template_part('parts/part', 'banner-page'); ?>


<?php
$enlace_a_noticias = get_field('enlace_a_noticias');
$args = array(
    'post_type'         => 'post',
    'posts_per_page'    => 12,
    'orderby'           => 'date',
    'order'             => 'ASC',
);
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="maserati-all-news post-grid">
        <div class="container marginB-65 text-center">
            <h3 class="fw-500 text-center maserati-color--navi_blue"><?php echo __('Últimas noticias', 'maserati'); ?></h3>
        </div>
        <div class="container">
            <div class="swiper swiper-all-news">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <?php get_template_part('template-parts/content', 'card-post'); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div id="swiper-button-prev-news" class="swiper-button-prev-news"></div>
            <div id="swiper-button-next-news" class="swiper-button-next-news"></div>
        </div>
        <?php if ($enlace_a_noticias) : ?>
            <div class="container mt-4">
                <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" href="<?php echo esc_url($enlace_a_noticias['url']); ?>" target="<?php echo esc_attr($enlace_a_noticias['target']); ?>"><?php echo esc_html($enlace_a_noticias['title']); ?></a>
            </div>
        <?php endif; ?>
    </section>
<?php
endif;
wp_reset_postdata();
?>


<?php
$enlace_a_carreras = get_field('enlace_a_noticias_cat_carreras');
$args = array(
    'post_type'         => 'post',
    'posts_per_page'    => 12,
    'orderby'           => 'date',
    'order'             => 'ASC',
    'tax_query'         => array(
        array(
            'taxonomy'  => 'category',
            'field'     => 'slug',
            'terms'     => 'carreras',
        ),
    ),
);
//print_r($args[tax_query][0][terms]);
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="maserati-category-carreras post-grid maserati-bg--off_white paddingY-95">
        <div class="container marginB-65">
            <h3 class="fw-500 maserati-color--navi_blue"><?php echo __('Sobre carreras', 'maserati'); ?></h3>
        </div>
        <div class="container">
            <div class="swiper swiper-all-news-carreras">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <?php get_template_part('template-parts/content', 'card-post'); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div id="swiper-button-prev-news-carreras" class="swiper-button-prev-news"></div>
            <div id="swiper-button-next-news-carreras" class="swiper-button-next-news"></div>

        </div>
        <?php if ($enlace_a_carreras) : ?>
            <div class="container mt-4">
                <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" href="<?php echo esc_url($enlace_a_carreras['url']); ?>" target="<?php echo esc_attr($enlace_a_carreras['target']); ?>"><?php echo esc_html($enlace_a_carreras['title']); ?></a>
            </div>
        <?php endif; ?>
    </section>
<?php
endif;
wp_reset_postdata();
?>


<?php
$enlace_a_lanzamientos = get_field('enlace_a_noticias_cat_lanzamientos');
$args = array(
    'post_type'         => 'post',
    'posts_per_page'    => 3,
    'orderby'           => 'date',
    'order'             => 'ASC',
    'tax_query'         => array(
        array(
            'taxonomy'  => 'category',
            'field'     => 'slug',
            'terms'     => 'lanzamientos',
        ),
    ),
);
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="maserati-category-lanzamientos post-grid paddingY-95">
        <div class="container marginB-65">
            <h3 class="fw-500 maserati-color--navi_blue"><?php echo __('Últimos lanzamientos', 'maserati'); ?></h3>
        </div>
        <div class="container">
            <div class="swiper swiper-one-news">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <?php get_template_part('template-parts/content', 'card-post'); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div id="swiper-button-prev-news-lanzamientos" class="swiper-button-prev-news"></div>
            <div id="swiper-button-next-news-lanzamientos" class="swiper-button-next-news"></div>
        </div>
        <?php if ($enlace_a_lanzamientos) : ?>
            <div class="container mt-4">
                <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" href="<?php echo esc_url($enlace_a_lanzamientos['url']); ?>" target="<?php echo esc_attr($enlace_a_lanzamientos['target']); ?>"><?php echo esc_html($enlace_a_lanzamientos['title']); ?></a>
            </div>
        <?php endif; ?>
    </section>
<?php
endif;
wp_reset_postdata();
?>



<?php
$enlace_a_partners = get_field('enlace_a_noticias_cat_partners');
$args = array(
    'post_type'         => 'post',
    'posts_per_page'    => 12,
    'orderby'           => 'date',
    'order'             => 'ASC',
    'tax_query'         => array(
        array(
            'taxonomy'  => 'category',
            'field'     => 'slug',
            'terms'     => 'partners',
        ),
    ),
);
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="maserati-category-partners post-grid maserati-bg--off_white paddingY-95">
        <div class="container marginB-65">
            <h3 class="fw-500 maserati-color--navi_blue"><?php echo __('Nuestros partners', 'maserati'); ?></h3>
            <h4 class="maserati-color--feature_grey"><?php echo __('Los mejores materiales y tecnología seleccionados', 'maserati'); ?></h4>
        </div>
        <div class="container">
            <div class="swiper swiper-all-news-partners">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <?php get_template_part('template-parts/content', 'card-post'); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div id="swiper-button-prev-news-partners" class="swiper-button-prev-news"></div>
            <div id="swiper-button-next-news-partners" class="swiper-button-next-news"></div>
        </div>
        <?php if ($enlace_a_partners) : ?>
            <div class="container mt-4">
                <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" href="<?php echo esc_url($enlace_a_partners['url']); ?>" target="<?php echo esc_attr($enlace_a_partners['target']); ?>"><?php echo esc_html($enlace_a_partners['title']); ?></a>
            </div>
        <?php endif; ?>
    </section>
<?php
endif;
wp_reset_postdata();
?>



<section class="maserati-fuoriserie paddingY-95">
    <div class="container text-center mb-5">
        <h3 class="fw-500 maserati-color--navi_blue"><?php the_field('titulo_fuoriserie'); ?></h3>
        <h4 class="maserati-color--feature_grey"><?php the_field('subtitulo_fuoriserie'); ?></h4>
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



<?php get_template_part('parts/part', 'newsletter'); ?>