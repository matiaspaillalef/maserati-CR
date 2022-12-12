<?php

if (is_singular('modelo')) {
    $modelo_id =  $post->ID;
    $identificador = get_field('identificador_maserati', $modelo_id);
}


$args = array(
    'post_type'         => 'page',
    'posts_per_page'    => -1,
    'orderby'           => 'date',
    'order'             => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'tipo_de_post',
            'field'    => 'slug',
            'terms'    => 'shopping-tools',
        ),
    ),
);
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <section class="items-personalizables <?php echo is_single('modelo') || is_product() ? '' : 'maserati-bg--light_grey'; ?>">
        <div class="container">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="row g-0">
                    <div class="col-md-6 col-sm-12">
                        <?php echo get_the_post_thumbnail(); ?>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <?php if (get_field('custom_title')) : ?>
                            <h3><?php the_field('custom_title'); ?></h3>
                        <?php else : ?>
                            <h3><?php echo get_the_title(); ?></h3>
                        <?php endif; ?>
                        <p><?php echo get_the_excerpt(); ?></p>
                        <a class="maserati-button maserati-button_large maserati-back--navi_blue" href="<?php echo $post->ID === 243 && $identificador ? 'https://pos-configurator.maserati.com/configurator-v3/?modelName=' . $identificador . '&currentCountry=53&lang=es&version=00' : get_the_permalink(); ?>" target="<?php echo !$identificador ? '_self' : ($post->ID === 243 ? '_blank' : '_self'); ?>"><?php echo $post->ID === 243 ? __('Personalizar', 'maserati') : __('Agendar', 'maserati'); ?></a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php
endif;
wp_reset_postdata();
?>