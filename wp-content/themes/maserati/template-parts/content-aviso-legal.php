<?php get_template_part('parts/part', 'banner-page'); ?>

<div class="entry-content">
    <?php if (have_rows('content_terminos')) : ?>
        <?php while (have_rows('content_terminos')) : the_row(); ?>
            <section id="<?php echo sanitize_title(get_sub_field('titulo_seccion')); ?>">
                <div class="container">
                    <h3 class="fw-500"><?php the_sub_field('titulo_seccion'); ?></h3>
                    <?php the_sub_field('content'); ?>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
</div>