<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maserati
 */

if (empty($_GET['modelName']) /*|| empty($_GET['modelYear'])*/) {
    wp_redirect(home_url());
    exit;
}

get_header();

?>

<main id="primary" class="site-main">

    <?php


    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'configurador');


    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
