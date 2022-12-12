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

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'garantia');


    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();

?>

<script>
    //Swiper Galeria GARANTIA
    const swiperGallerySingleW = new Swiper(".swiper-2_5_gallery_waranty", {
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
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true,
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
    const ModalWaranty = new Swiper(".swiper-2_5_gallery-modal-waranty", {
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
            type: "fraction",
            clickable: true,
        },
        thumbs: {
            swiper: swiperGallerySingleW,
        },
    });
</script>