<?php if (have_rows('group_pre_owned', 'option')) : ?>
    <section class="maserati-pre_owned" style="<?php echo !wp_is_mobile() ? 'background-image:url(' . get_field('background_pre_owned', 'option') . ');' : 'background-image:url(' . get_field('background_pre_owned_mobile', 'option') . ');'; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <?php while (have_rows('group_pre_owned', 'option')) : the_row(); ?>
                        <div class="header-pre_owned">
                            <h3 class="mb-3"><?php the_sub_field('titulo_pre_owned'); ?></h3>
                            <h4 class="title-border mb-3 fw-400"><?php the_sub_field('subtitulo_pre_owned'); ?></h4>
                        </div>
                        <?php $enlace_pre_owned = get_sub_field('enlace_pre_owned'); ?>
                        <?php if ($enlace_pre_owned) : ?>
                            <a class="maserati-button maserati-button_large maserati-back--transparent" href="<?php echo esc_url($enlace_pre_owned['url']); ?>" target="<?php echo esc_attr($enlace_pre_owned['target']); ?>"><?php echo esc_html($enlace_pre_owned['title']); ?></a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>