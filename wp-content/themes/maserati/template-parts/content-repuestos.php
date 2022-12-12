<?php get_template_part('parts/part', 'banner-page');
$size = 'full'; ?>

<?php if (get_field('titulo_presentacion')) : ?>
    <section class="maserati-presentation-programa">
        <div class="tiny-container">
            <h4 class="maserati-color--feature_grey fw-500 text-center"><?php the_field('titulo_presentacion'); ?></h4>
        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('repeat_banner_block')) : ?>
    <section class="maserati-block-banner">
        <?php while (have_rows('repeat_banner_block')) : the_row(); ?>
            <div class="maserati-inner-block-banner">
                <?php $banner_block = get_sub_field('banner_block'); ?>
                <?php if ($banner_block) : ?>
                    <?php echo wp_get_attachment_image($banner_block, $size, "", array("class" => "middle-banner-block")); ?>
                <?php endif; ?>
                <?php if (have_rows('repeater_block')) : ?>
                    <div class="maserati-block-featured">
                        <?php while (have_rows('repeater_block')) : the_row();
                            $color_back =  get_sub_field('backgorund_block'); ?>
                            <div class="fullwidth background-block" style="<?php echo $color_back ? 'background-color:' . $color_back . ';' : ''; ?>">
                                <div class="container">
                                    <div class="row">
                                        <?php if (have_rows('grupo_block')) : ?>
                                            <div class="col-md-6 col-sm-12">
                                                <?php while (have_rows('grupo_block')) : the_row(); ?>
                                                    <?php echo get_sub_field('titulo') ? '<h3 class="maserati-color--navi_blue fw-500">' . get_sub_field('titulo') . '</h3>' : ''; ?>
                                                    <?php echo get_sub_field('subtitulo') ? '<h4>' . get_sub_field('subtitulo') . '</h4>' : ''; ?>
                                                    <?php echo get_sub_field('descripcion') ? '<p>' . get_sub_field('descripcion') . '</p>' : ''; ?>

                                                    <?php if (get_sub_field('archivo_select') == 1) : ?>
                                                        <?php $archivo = get_sub_field('archivo'); ?>
                                                        <?php if ($archivo) : ?>
                                                            <a class="maserati-button maserati-button_large maserati-back--navi_blue mt-5" href="<?php echo esc_url($archivo['url']); ?>"><?php echo esc_html($archivo['filename']); ?></a>
                                                        <?php endif; ?>
                                                    <?php else : ?>

                                                        <?php $enlace = get_sub_field('enlace'); ?>
                                                        <?php if ($enlace) : ?>
                                                            <a class="maserati-button maserati-button_large maserati-back--navi_blue mt-5" href="<?php echo esc_url($enlace['url']); ?>" target="<?php echo esc_attr($enlace['target']); ?>"><?php echo esc_html($enlace['title']); ?></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php $imagen_block = get_sub_field('imagen_block'); ?>
                                        <?php if ($imagen_block) : ?>
                                            <div class="col-md-6 col-sm-12">
                                                <?php echo wp_get_attachment_image($imagen_block, $size); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>
<?php get_template_part('parts/part', 'contacto'); ?>