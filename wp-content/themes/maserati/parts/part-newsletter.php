<?php
$background_newsletter = get_field('background_newsletter', 'option');
$background_sm_newsletter = get_field('background_sm_newsletter', 'option');
$size = 'full';
?>

<section class="maserati-newsletter" <?php echo wp_is_mobile() ? 'style="background-image:url(' . wp_get_attachment_image_url($background_sm_newsletter, $size) . ');"' : 'style="background-image:url(' . wp_get_attachment_image_url($background_newsletter, $size) . ');"'; ?>>
    <div class="container">
        <div class="col-md-4 col-sm-12">
            <h3 class="text-white"><?php the_field('titulo_newsletter', 'option'); ?></h3>
            <?php echo wp_is_mobile() ? '<p class="text-white">' . get_field('subtitulo_newsletter', 'option') . '</p>' : ''; ?>
            <?php the_field('elegir_formulario', 'option'); ?>
        </div>
    </div>
</section>