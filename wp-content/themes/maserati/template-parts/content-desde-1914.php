<?php get_template_part('parts/part', 'banner-page');
$size = 'full'; ?>

<section class="maserati-history_since maserati-bg--dark maserati-color--light_grey">
    <div class="medium-container text-center">
        <h1 class="fw-300"><?php the_field('titulo'); ?></h1>
        <h4><?php the_field('subtitulo'); ?></h4>
    </div>
    <div class="tiny-container">
        <?php the_field('contenido'); ?>
        <?php $enlace = get_field('enlace'); ?>
        <?php if ($enlace) : ?>
            <a class="maserati-button maserati-button_large maserati-back--transparent marginX-auto" href="<?php echo esc_url($enlace['url']); ?>" target="<?php echo esc_attr($enlace['target']); ?>"><?php echo esc_html($enlace['title']); ?></a>
        <?php endif; ?>
    </div>
</section>


<?php $banner_intermedio = get_field('banner_desktop'); ?>
<?php $banner_intermedio_mb =  get_field('banner_mobile'); ?>
<?php if ($banner_intermedio) : ?>
    <section class="maserati-banner-intermedio">
        <div class="fullwidth">
            <?php echo !wp_is_mobile() ? wp_get_attachment_image($banner_intermedio, $size, "", array("class" => "middle-banner-block")) : ($banner_intermedio_mb ? wp_get_attachment_image($banner_intermedio_mb, $size, "", array("class" => "middle-banner-block")) : wp_get_attachment_image($banner_intermedio, $size, "", array("class" => "middle-banner-block"))); ?>
        </div>
    </section>
<?php endif; ?>