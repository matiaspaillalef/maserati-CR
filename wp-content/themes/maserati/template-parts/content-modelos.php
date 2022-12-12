<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maserati
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class('card-model'); ?>>
    <?php if (wp_is_mobile()) : ?>
        <div class="header-entry-content">
            <h5 class="maserati-color--navi_blue"><?php echo get_the_title(); ?></h5>
            <?php while (have_rows('grupo_identidad')) : the_row(); ?>
                <h6><?php echo get_sub_field('slogan_modelo'); ?></h6>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php maserati_post_thumbnail(); ?>
    <div class="entry-content">
        <div class="info-model">
            <?php if (!wp_is_mobile()) : ?>
                <h5><?php echo get_the_title(); ?></h5>
                <?php while (have_rows('grupo_identidad')) : the_row(); ?>
                    <h6 class="maserati-color--feature_grey"><?php echo get_sub_field('slogan_modelo'); ?></h6>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php
            $price_model = get_field('precio');
            if ($price_model) : ?>
                <h2 class="price h5 maserati-color--dark_grey fw-500">
                    <span class="until maserati-color--dark_grey fw-100"><?php echo  __('Desde', 'maserati'); ?></span> <?php echo '$' . number_format_i18n($price_model, 0); ?>
                    <button type="button" class="maserati-disclamers cursor" data-bs-target="#disclamersModal" data-bs-toggle="modal">
                        <span data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Legales" data-bs-original-title="" title="">
                            <i class="fa-solid fa-exclamation"></i>
                        </span>
                    </button>
                </h2>
            <?php endif; ?>

            <?php while (have_rows('contenido_presentacion')) : the_row(); ?>
                <?php if (get_sub_field('texto_presentacion') && !wp_is_mobile()) : ?>
                    <p class="maserati-color--dark_grey"><?php the_sub_field('texto_presentacion'); ?></p>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
        <a class="maserati-button maserati-button_large maserati-back--navi_blue" href="<?php echo get_the_permalink(); ?>"><?php echo __('Explorar', 'maserati'); ?></a>

    </div>
</article>


<!-- Disclamer Modal -->
<?php if ($price_model) : ?>
    <div class="modal fade show" id="disclamersModal" tabindex="-1" aria-labelledby="disclamersModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="text-center">Términos y condiciones</h5>
                    <p class="mb-5">*Los precios mostrados incluyen IVA e impuestos de matriculación. </br> El IVA y el Impuesto de Matriculación (IEDMT) se han calculado al tipo general, pudiendo variar estos importes dependiendo de la fecha final de la compraventa así como de los porcentajes aplicables fiscalmente según los impuestos de cada comunidad autónoma o por variaciones en los valores de emisiones debido al equipamiento opcional finalmente elegido.</p>
                    <p class="mb-5"><strong>Para más información no dude en contactar con su concesionario más cercano.</strong></p>
                    <a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" data-bs-dismiss="modal" aria-label="Close">Entendido</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>