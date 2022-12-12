<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maserati
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <div class="container">

        <?php echo wp_is_mobile() ? '<a class="return text-decoration-none" href="' . get_permalink(get_option('page_for_posts')) . '"><i class="fa-solid fa-arrow-left"></i> ' . __('Todas las noticias', 'maserati') . '</a>' : ''; ?>
        <div class="post_title">
            <h1 class="text-center"><?php echo get_the_title(); ?></h1>
        </div>
        <?php echo wp_is_mobile() ? '<p>' . get_the_date('j \d\e F \d\e Y') . '</p>' : ''; ?>
        <?php maserati_post_thumbnail(); ?>
    </div>


    <div class="entry-content">
        <div class="medium-container">
            <?php
            echo !wp_is_mobile() ? '<p>' . get_the_date('j \d\e F \d\e Y') . '</p>' : '';
            the_content();
            ?>
        </div>
        <?php if (have_rows('contenido_sp')) : ?>
            <?php while (have_rows('contenido_sp')) : the_row(); ?>
                <div class="container gallery-content">
                    <?php if (have_rows('imagenes_sp')) : ?>
                        <?php $count_img = 1; ?>
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
                    <?php endif; ?>
                    <?php if (get_sub_field('text_two_colums') == 1) : ?>
                        <div class="medium-container">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <?php the_sub_field('contenido_two_column_1'); ?>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <?php the_sub_field('contenido_two_column_2'); ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="medium-container">
                            <?php the_sub_field('contenido_one_column'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div><!-- .entry-content -->



</article><!-- #post-<?php the_ID(); ?> -->