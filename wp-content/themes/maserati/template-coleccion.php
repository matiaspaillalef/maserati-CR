<?php
/* Template Name: Colección */

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

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'template-coleccion');


    endwhile; // End of the loop.
    ?>

</main><!-- #main -->


<?php
get_footer();
//get_sidebar();
?>
<script>
    //Swiper Galeria Single
    const swiperGallerySingle = new Swiper(".swiper-2_5_gallery_singles", {
        direction: "horizontal",
        threshold: 20,
        spaceBetween: 0,
        loop: false,
        slidesPerView: 1.2,
        autoplay: false,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 1.2,
            },
            768: {
                slidesPerView: 1.2,
            },
            1024: {
                slidesPerView: 2.5,
            },
        },
    });

    const swiperGallerySingleModal = new Swiper(".swiper-2_5_gallery-modal", {
        direction: "horizontal",
        threshold: 20,
        spaceBetween: 0,
        loop: false,
        slidesPerView: 1,
        autoplay: false,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            type: "fraction", // 'bullets' | 'fraction' | 'progressbar' | 'custom'
            clickable: true,
        },
        thumbs: {
            swiper: swiperGallerySingle,
        },
    });
</script>