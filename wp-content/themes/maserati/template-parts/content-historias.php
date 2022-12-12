<?php get_template_part('parts/part', 'banner-page');
$size = 'full';
?>

<section class="maserati-timeline_history">
    <div class="container">
        <h1><?php the_field('titulo'); ?></h1>
        <h4><?php the_field('subtitulo'); ?></h4>
    </div>
    <?php if (have_rows('historias_repeater')) : ?>
        <div class="container">
            <?php while (have_rows('historias_repeater')) : the_row(); ?>
                <?php $imagen = get_sub_field('imagen'); ?>
                <div class="row">
                    <?php if ($imagen) : ?>
                        <div class="col-md-6 col-sm-12">
                            <?php echo wp_get_attachment_image($imagen, $size); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (have_rows('grupo_historias')) : ?>
                        <div class="col-md-6 col-sm-12">
                            <?php while (have_rows('grupo_historias')) : the_row(); ?>
                                <?php echo get_sub_field('year') ? '<h2 class="h1">' . get_sub_field('year') . '</h2>' : ''; ?>
                                <?php the_sub_field('contenido'); ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <?php $imagen_final = get_field('imagen_final'); ?>
    <?php $enlace = get_field('enlace'); ?>
    <div class="container">
        <div class="final-timeline">
            <?php if ($imagen_final) : ?>
                <?php echo wp_get_attachment_image($imagen_final, $size); ?>
            <?php endif; ?>
            <?php if ($enlace) : ?>
                <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" href="<?php echo esc_url($enlace['url']); ?>" target="<?php echo esc_attr($enlace['target']); ?>"><?php echo esc_html($enlace['title']); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>