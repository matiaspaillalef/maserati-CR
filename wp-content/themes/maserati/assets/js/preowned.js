jQuery(document).ready(function ($) {
  //Swiper Galeria Single
  const swiperGalleryPreOwnedThumb = new Swiper(".pre-owned-gallery_thumbs", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 15,
    loop: false,
    slidesPerView: 3,
    autoplay: false,
  });

  const swiperGalleryPreOwned = new Swiper(".pre-owned-gallery", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: false,
    slidesPerView: 1,
    autoplay: false,
    navigation: {
      nextEl: ".swiper-button-next-gallery",
      prevEl: ".swiper-button-prev-gallery",
    },
    thumbs: {
      swiper: swiperGalleryPreOwnedThumb,
    },
    pagination: {
      el: ".swiper-pagination-gallery",
      type: "bullets", // 'bullets' | 'fraction' | 'progressbar' | 'custom'
      clickable: true,
    },
  });
});
