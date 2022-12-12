<?php

$sep = '<span class="separator">/</span> ';
$shop_id = get_option('woocommerce_shop_page_id'); // Traemos el ID del shop
$archive_id  = get_queried_object();
$maserati_world_id = 356; //ID mundo maserati, puesto manualmente

if (!is_front_page() && !wp_is_mobile()) {

    // Comienza el breadcrumbs llamando al home
    echo '<div class="body-small breadcrumbs ' .  (is_shop() ? 'breadcrumbs-absolute maserati-color--light_grey' : (is_archive() ? 'breadcrumbs-relative maserati-color--navy_blue' : (get_field('header_transparent', $archive_id) == 1  ? 'breadcrumbs-absolute maserati-color--light_grey' : 'breadcrumbs-relative maserati-color--navy_blue'))) . '"><div class="container"><a class="text-decoration-none" href="' . get_option('home') . '"> ' . __('Home', 'maserati') . '</a>' . $sep;

    if ((is_category() || is_single()) && !is_singular('modelo')) {
        $categories = get_the_category();
        echo $categories[0]->name; // Sólo mostramos la primera categoría encontrada
    } elseif (is_shop()) {
        echo __('Todos los modelos', 'maserati') . $sep . get_the_title($shop_id);
    } elseif (is_archive() || is_single()) {
        if (is_day()) {
            printf(__('%s', 'maserati'), get_the_date());
        } elseif (is_month()) {
            printf(__('%s', 'maserati'), get_the_date(_x('F Y', 'monthly archives date format', 'maserati')));
        } elseif (is_year()) {
            printf(__('%s', 'maserati'), get_the_date(_x('Y', 'yearly archives date format', 'maserati')));
        } else {
            if (is_archive('modelo')) {
                _e('Todos los modelos', 'maserati');
            }
        }
    } elseif (is_home()) {
        echo '<a href="' . get_the_permalink($maserati_world_id) . '">' . __('Mundo Maserati', 'maserati') . '</a>' . $sep . get_the_title($archive_id);
    }

    // Segun el tipo de post_type traemos el nombre declarado
    $tipo_modelo = $post->post_type;
    $id_fuoriserie = 506;
    if (is_singular($tipo_modelo) && !is_page()) {
        echo !is_singular('post') ? (is_singular('proyectos_fuoriserie') ? '<a href="' . get_the_permalink($id_fuoriserie) . '">' . get_the_title($id_fuoriserie) . '</a>' . $sep . 'Proyectos' . $sep . get_the_title() : '<a class="text-decoration-none" href="' . get_post_type_archive_link($tipo_modelo) . '">' . __('Todos los modelos', 'maserati') . '</a>' . $sep . get_the_title()) : $sep . get_the_title();
    }

    if (is_page()) {
        $parent = $post->post_parent;
        $custom_breadcrumbs = get_field('custom_breadcrumbs');
        echo $parent ? '<a href="' . get_the_permalink($parent) . '">' . get_the_title($parent) . '</a>' . $sep : '';
        echo '<span class="current-page">' . get_field('activar_fit_banner') === 0 ? ($custom_breadcrumbs ? $custom_breadcrumbs : get_the_title()) : ($custom_breadcrumbs ? $custom_breadcrumbs : (get_field('fit_banner_title') ? get_field('fit_banner_title') : get_the_title())) . '</span>';
    }


    echo '</div></div>';
}
