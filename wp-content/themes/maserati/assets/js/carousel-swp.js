jQuery(document).ready(function ($) {
  //animación de contadores
  function startCounter() {
    $(".counter").each(function (index) {
      var size = $(this).text().split(".")[1]
        ? $(this).text().split(".")[1].length
        : 0;
      $(this)
        .prop("Counter", 0)
        .animate(
          {
            Counter: $(this).text(),
          },
          {
            duration: 2000,
            easing: "swing",
            step: function (now) {
              $(this).text(parseFloat(now).toFixed(size));
            },
          }
        );
    });
  }

  startCounter();

  //Swiper Home
  const fraction = $("#fraction");
  const slides = $(".main-slider .swiper-slide");
  const slideCount = slides.length;

  textContent = `1 / ${slideCount}`;

  fraction.text(textContent);

  const swiperSingle = new Swiper(".swiper-single_banner", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: true,
    slidesPerView: 1,
    autoplay: true,
    pagination: {
      el: ".swiper-pagination",
      type: "bullets", // 'bullets' | 'fraction' | 'progressbar' | 'custom'
      clickable: true,
    },
    //Para asegurarnos damos damos play al primer video
    on: {
      init: function () {
        var currentVideo = $(
          "[data-swiper-slide-index=" + this.realIndex + "]"
        ).find("video");
        currentVideo.trigger("play");
      },
    },
  });

  var sliderVideos = $(".swiper-slide video");

  swiperSingle.on("slideChange", function () {
    //Buscamos los videos y en el slider que cambiamos detenemos el video
    sliderVideos.each(function (index) {
      this.currentTime = 0;
    });

    var prevVideo = $(
      "[data-swiper-slide-index=" + this.previousIndex + "]"
    ).find("video");
    var currentVideo = $(
      "[data-swiper-slide-index=" + this.realIndex + "]"
    ).find("video");
    prevVideo.trigger("stop");
    currentVideo.trigger("play");
  });

  swiperSingle.on("slideChange", function (e) {
    var indexReal = swiperSingle.realIndex;
    textContent = `${indexReal + 1} / ${slideCount}`;

    fraction.text(textContent);
  });
  //Fin Swiper Home

  //Swiper Mundo Maserati
  const swiperWorld = new Swiper(".swiper-2_5", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: false,
    slidesPerView: 1.2,
    autoplay: false,
    /*pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },*/
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
  //Fin Swiper Mundo Maserati

  //Swiper Modelos Single
  const swiperPaginationsModel = new Swiper(".swiper-name-pagination", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: false,
    slidesPerView: 3.2,
    autoplay: false,
  });

  //Reemplazamos la ficha técnica de la primera versión al cargar la página
  var data_ficha = $(".swiper-single_banner__models_single .swiper-slide").attr(
    "data-ficha"
  );
  $(".maserati-model_colection").find("#data-sheet").attr("href", data_ficha);

  //Actualizamos url botón cotizar al iniciar la página
  var currentSlug = $(
    ".swiper-single_banner__models_single .swiper-slide"
  ).attr("data-value");
  //currentSlug = currentSlug.toLowerCase().replace(/ /g,'-');
  var url = "/cotizador-modelos/?version=" + currentSlug;
  $("#version-quote").attr("href", url);

  const swiperModels = new Swiper(".swiper-single_banner__models_single ", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: false,
    autoHeight: true,
    slidesPerView: 1,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination, .swiper-pagination-name, .pagination-m",
      clickable: true,
      renderBullet: function (index, className) {
        var title = $(this.$el)
          .find(".swiper-slide")
          .eq(index)
          .attr("data-title");
        return (
          '<span class="' +
          className +
          ' pagination-name"><span class="name-bullet">' +
          title +
          "</span></span>"
        );
      },
    },
    on: {
      slideChangeTransitionStart: function (realIndex) {
        if (window.outerWidth > 768) {
          $(".header-model").hide(0);
          $(".body-model").hide(0);
          $(".header-model").removeClass("aos-init").removeClass("aos-animate");
          $(".body-model").removeClass("aos-init").removeClass("aos-animate");
        }
        $(".swiper-slide.swiper-slide-active")
          .find(".model-speed h3 span:first-child")
          .addClass("counter");

        startCounter();
      },
      slideChangeTransitionEnd: function (realIndex) {
        if (window.outerWidth > 768) {
          $(".header-model").show(0);
          $(".body-model").show(0);
          AOS.init({
            one: true,
            disable: "mobile",
          });
        }
        $(".swiper-slide:not(.swiper-slide-active)")
          .find(".model-speed h3 span:first-child")
          .removeClass("counter");

        //Reemplazamos la ficha técnica de cada version al mover swiper
        var data_ficha = $(this.$el)
          .find(".swiper-slide-active")
          .attr("data-ficha");
        $(".maserati-model_colection")
          .find("#data-sheet")
          .attr("href", data_ficha);

        //Actualizamos url boton cotizar
        var currentSlug = $(
          ".swiper-single_banner__models_single .swiper-slide-active"
        ).data("title");
        currentSlug = convertStringToSlug(currentSlug);
        var url = "/cotizador-modelos/?version=" + currentSlug;

        $("#version-quote").attr("href", url);
      },
    },
    breakpoints: {
      640: {
        mousewheel: true,
      },
      768: {
        mousewheel: true,
        allowTouchMove: false,
      },
      1024: {
        allowTouchMove: false,
        mousewheel: false,
      },
    },
    thumbs: {
      swiper: swiperPaginationsModel,
    },
  });

  //Fin Swiper Modelos Single

  //Swiper Modelos Home
  const swiperModelsHome = new Swiper(".swiper-single_banner__models", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: false,
    autoHeight: true,
    slidesPerView: 1,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination, .swiper-pagination-name, .pagination-m",
      clickable: true,
      renderBullet: function (index, className) {
        var title = $(this.$el)
          .find(".swiper-slide")
          .eq(index)
          .attr("data-title");
        return (
          '<span class="' +
          className +
          ' pagination-name"><span class="name-bullet">' +
          title +
          "</span></span>"
        );
      },
    },
    on: {
      slideChangeTransitionStart: function (realIndex) {
        if (window.outerWidth > 768) {
          $(".header-model").hide(0);
          $(".body-model").hide(0);
          $(".header-model").removeClass("aos-init").removeClass("aos-animate");
          $(".body-model").removeClass("aos-init").removeClass("aos-animate");
        }
        $(".swiper-slide.swiper-slide-active")
          .find(".model-speed h3 span:first-child")
          .addClass("counter");

        startCounter();
      },
      slideChangeTransitionEnd: function (realIndex) {
        if (window.outerWidth > 768) {
          $(".header-model").show(0);
          $(".body-model").show(0);
          AOS.init({
            one: true,
            disable: "mobile",
          });
        }
        $(".swiper-slide:not(.swiper-slide-active)")
          .find(".model-speed h3 span:first-child")
          .removeClass("counter");
      },
    },
    breakpoints: {
      640: {
        mousewheel: true,
      },
      768: {
        mousewheel: true,
        allowTouchMove: false,
      },
      1024: {
        allowTouchMove: false,
        mousewheel: false,
      },
    },
  });
  //fin Swiper Modelos Home

  //Swiper Single Modelos
  const swiperSingleModels = new Swiper(".swiper-single-model", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: true,
    autoplay: true,
    slidesPerView: 1,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
  //Fin Swiper Single Modelos

  //Swiper Caracteristicas
  const swiperCaracteristicas = new Swiper(".swiper-1_5", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: false,
    slidesPerView: 1.5,
    autoplay: false,
    navigation: {
      nextEl: ".swiper-button-next-featured", //.swiper-button-next
      prevEl: ".swiper-button-prev-featured", //.swiper-button-prev
    },
    scrollbar: {
      el: ".swiper-scrollbar",
      draggable: true,
    },
  });

  const swiperModalCaracteristicas = new Swiper(".swiper-modal", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: false,
    slidesPerView: 1,
    autoplay: false,
    navigation: {
      nextEl: ".swiper-button-next-featured", //.swiper-button-next
      prevEl: ".swiper-button-prev-featured", //.swiper-button-prev
    },
    pagination: {
      el: ".swiper-pagination",
      type: "fraction", // 'bullets' | 'fraction' | 'progressbar' | 'custom'
      clickable: true,
    },
  });

  /*swiperCaracteristicas.controller.control = swiperModalCaracteristicas;
swiperModalCaracteristicas.controller.control = swiperCaracteristicas;*/
  //Fin Swiper Caracteristicas
});

//Related Pre-Ownde
const swiperCaracteristicas = new Swiper(".related-pre-owned", {
  direction: "horizontal",
  threshold: 20,
  spaceBetween: 15,
  loop: true,
  slidesPerView: 1.5,
  autoplay: true,
  breakpoints: {
    640: {
      slidesPerView: 1.5,
    },
    768: {
      slidesPerView: 1.5,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 32,
    },
  },
});

//All News

const swiperAllNews = new Swiper(".swiper-all-news", {
  direction: "horizontal",
  threshold: 20,
  spaceBetween: 15,
  loop: true,
  slidesPerView: 1.2,
  autoplay: true,
  navigation: {
    nextEl: "#swiper-button-next-news",
    prevEl: "#swiper-button-prev-news",
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
      slidesPerView: 3,
      spaceBetween: 32,
    },
  },
});

const swiperAllNewsCarreras = new Swiper(".swiper-all-news-carreras", {
  direction: "horizontal",
  threshold: 20,
  spaceBetween: 15,
  loop: true,
  slidesPerView: 1.2,
  autoplay: true,
  navigation: {
    nextEl: "#swiper-button-next-news-carreras",
    prevEl: "#swiper-button-prev-news-carreras",
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
      slidesPerView: 3,
      spaceBetween: 32,
    },
  },
});
const swiperAllNewsPartners = new Swiper(".swiper-all-news-partners", {
  direction: "horizontal",
  threshold: 20,
  spaceBetween: 15,
  loop: true,
  slidesPerView: 1.2,
  autoplay: true,
  navigation: {
    nextEl: "#swiper-button-next-news-partners",
    prevEl: "#swiper-button-prev-news-partners",
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
      slidesPerView: 3,
      spaceBetween: 32,
    },
  },
});

//All News
const swiperOneNews = new Swiper(".swiper-one-news", {
  direction: "horizontal",
  threshold: 20,
  spaceBetween: 0,
  loop: true,
  slidesPerView: 1,
  autoplay: true,
  navigation: {
    nextEl: "#swiper-button-next-news-lanzamientos",
    prevEl: "#swiper-button-prev-news-lanzamientos",
  },
  pagination: {
    el: ".swiper-pagination",
    type: "bullets",
    clickable: true,
  },
});

//Swiper Waranty

const swiperWaranty = new Swiper(".swiper-waranty-motors", {
  direction: "horizontal",
  threshold: 20,
  spaceBetween: 0,
  loop: true,
  autoHeight: true,
  slidesPerView: 1,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    type: "bullets",
    clickable: true,
  },
});

//Fin Swiper Modelos Single

//Swiper todos los proyectos fuoriserie
const swiperProyectosFurioserie = new Swiper(
  ".swiper-all-proyectos-furioserie",
  {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 15,
    loop: true,
    slidesPerView: 2.2,
    autoplay: true,
    navigation: {
      nextEl: "#swiper-button-next-news-furioserie",
      prevEl: "#swiper-button-prev-news-furioserie",
    },
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2.2,
      },
      768: {
        slidesPerView: 2.2,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 32,
      },
    },
  }
);

//Swiper gallery proyecto light - sólo mobile
const swiperProyectoLight = new Swiper(".swiper-light-proyectos-furioserie", {
  direction: "horizontal",
  threshold: 20,
  spaceBetween: 15,
  loop: true,
  slidesPerView: 1.5,
  autoplay: true,
  pagination: {
    el: ".swiper-pagination",
    type: "bullets",
    clickable: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 1.5,
    },
    768: {
      slidesPerView: 1.5,
    },
    1024: {
      slidesPerView: 1.5,
    },
  },
});

//Swiper colecciones fluoriserie

//Swiper Galeria Single

var clickSlideCurrent = "";

$(document).on("click", ".maserati-gallery .container a", function () {
  clickSlideCurrent = $(this).data("current");

  const swiperGalleryGalleryCF = new Swiper(".swiper-2_5_gallery-modal-cf", {
    direction: "horizontal",
    threshold: 20,
    spaceBetween: 0,
    loop: false,
    slidesPerView: 1,
    initialSlide: clickSlideCurrent,
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
  });
});

/*const swiperGalleryPreOwned = new Swiper(".related-pre-owned", {
  direction: "horizontal",
  threshold: 20,
  spaceBetween: 30,
  loop: false,
  slidesPerView: 4,
  autoplay: true,
});*/

// funcion para sanitizar texto a url .
function convertStringToSlug(text) {
  return text
    .toLowerCase()
    .replace(/ /g, "-")
    .replace(/[^\w-]+/g, "");
}
