jQuery(document).ready(function ($) {
  //Animación video single modelo sólo desktop
  if (window.outerWidth > 992) {
    gsap.registerPlugin(ScrollTrigger);

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: ".maserati-model_video",
        //endTrigger: "#maserati-model_video",
        scrub: 0.5,
        pin: true,
        pinnedContainer: "#videoPin",
        //pinSpacing: false,
        start: "50% 50%",
        end: "+=100%",
      },
    });
    //este es para reducir el contenido, para aumentar es from
    tl.to(".maserati-model_video", {
      scale: 0.6,
    });
  }

  //Comparador
  $(document).on("show.bs.modal", "#modalversion", function (e) {
    var img_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".header-model img")
      .attr("src");
    var title_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".header-model h2")
      .text();
    var price_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".header-model h5")
      .text();
    var year_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".version-info")
      .children()
      .last()
      .data("year");
    var potencia_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".version-info")
      .children()
      .first()
      .find("h5")
      .text();
    var velocidad_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".version-info")
      .children()
      .eq(1)
      .find("h5")
      .text();
    var aceleracion_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".version-info")
      .children()
      .eq(2)
      .find("h5")
      .text();
    var esquema_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".version-info")
      .children()
      .eq(3)
      .find("h5")
      .text();
    var traccion_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".version-info")
      .children()
      .eq(4)
      .find("h5")
      .text();
    var cilindrada_version = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    )
      .find(".version-info")
      .children()
      .eq(5)
      .find("h5")
      .text();
    var ficha_tecnica = $(
      ".single-modelo .swiper-single_banner__models_single .swiper-slide-active"
    ).data("ficha");

    $(".table-left").find(".model-image img").attr("src", img_version);
    $(".table-left").find(".model-title p").text(title_version);
    $(".table-left").find(".model-year p").text(year_version);
    $(".table-left").find(".model-potencia p").text(potencia_version);
    $(".table-left").find(".model-velocidad p").text(velocidad_version);
    $(".table-left").find(".model-aceleracion p").text(aceleracion_version);
    $(".table-left").find(".model-esquema p").text(esquema_version);
    $(".table-left").find(".model-traccion p").text(traccion_version);
    $(".table-left").find(".model-cilindrada p").text(cilindrada_version);
    $(".table-left").find(".model-precio p").text(price_version);
    $(".table-left")
      .find("tfoot .ficha-comparador")
      .attr("href", ficha_tecnica);

    var url_cotizador = "/cotizador-modelos/?version=";
    url_cotizador = url_cotizador + slugify(title_version);

    $(".table-left")
      .find("tfoot .button-cotizador")
      .attr("href", url_cotizador);
  });

  $("#modalAllVersion").on("show.bs.modal", function (e) {
    if ($("#accordionModels .mini-card").hasClass("selected-version")) {
      $("#accordionModels .mini-card").removeClass("selected-version");
    }
  });
  /*
$(document).on('click', '#accordionModels .mini-card', function () {

    $(this).toggleClass('selected-version').siblings().removeClass('selected-version');
    $(this).parents('.accordion-item').siblings().find('.mini-card').removeClass('selected-version');

    //window.setTimeout(function() { 
        //$('#modalAllVersion').modal('hide'); 
    //}, 5000);

        if($(this).hasClass('selected-version')){

            var selected    = $(this);
            var year        = selected.data('year');
            var esquema     = selected.data('esquema');
            var cilindrada  = selected.data('cilindrada');
            var aceleracion = selected.data('aceleracion');
            var velocidad   = selected.data('velocidad');
            var potencia    = selected.data('potencia');
            var traccion    = selected.data('traccion');
            var price       = selected.data('price');
            var ficha       = selected.data('ficha');

            var title       = selected.find('p').text();
            var img         = selected.find('img').attr('src');

            $(".body-comparador .row .col-md-6.empty-table").each(function(index){

                $(this).first().find('table.empty thead').removeClass('not-found').addClass('found');
                $(this).first().find('table.empty thead').removeAttr('data-bs-toggle');
                $(this).first().find('table.empty thead').removeAttr('data-bs-target');
                $(this).first().find('table.empty').addClass('in');
                $(this).first().find('table.empty .model-image').html('<img src="" alt="">');

                $(this).first().find('table.empty').find('.model-image img').attr('src', img);
                $(this).first().find('table.empty').find('.model-title p').text(title);
                $(this).first().find('table.empty').find('.model-year p').text(year);
                $(this).first().find('table.empty').find('.model-potencia p').text(potencia);
                $(this).first().find('table.empty').find('.model-velocidad p').text(velocidad);
                $(this).first().find('table.empty').find('.model-aceleracion p').text(aceleracion);
                $(this).first().find('table.empty').find('.model-esquema p').text(esquema);
                $(this).first().find('table.empty').find('.model-traccion p').text(traccion);
                $(this).first().find('table.empty').find('.model-cilindrada p').text(cilindrada);
                $(this).first().find('table.empty').find('.model-precio p').text(price);  
                $(this).first().find('table.empty').find('.ficha-comparador').attr('href', ficha);  

                var url_cotizador = '/cotizador-modelos/?version=' 
                    url_cotizador = url_cotizador + slugify(title);
                $(this).first().find('table.empty').find('.button-cotizador').attr('href', url_cotizador );  

                $(this).first().find('table').before('<i class="icon-close"></i>');
                $(this).siblings().find('i.icon-close').removeClass('d-none');
                
                $(this).first().removeClass('empty-table').addClass('full-table');
                $(this).first().find('table.empty').toggleClass('full empty');

                return false;
                      
            }); 

            $(this).parents('.modal').find('.button-call_to_action').fadeIn();

        }else{
            $(".body-comparador .row").each(function(index){

                    
                $(this).children().last().find('table.full').find('thead').removeClass('found').addClass('not-found');
                $(this).children().last().find('table.full').find('thead').attr('data-bs-toggle', 'modal');
                $(this).children().last().find('table.full').find('thead').attr('data-bs-target', '#modalAllVersion');
                $(this).children().last().find('table.full').removeClass('in');
                $(this).children().last().find('table.full').find('.model-image').html('<i class="icon-plus"></i>');
                $(this).children().last().find('table.full').find('tbody p').html('-');
                $(this).children().last().find('table.full').find('thead p').html('Agregar Modelo');

                $(this).children().last().find('table.full').toggleClass('full empty');
                $(this).children().last().removeClass('full-table').addClass('empty-table');

                $(this).children().last().closest('.body-comparador').find('table').siblings('.icon-close').remove();


                    //return false;

            });

            $(this).parents('.modal').find('.button-call_to_action').fadeOut();
       	}    

}); */

  $(document).on(
    "click",
    "#modalAllVersion .button-call_to_action",
    function () {
      $("#modalAllVersion").modal("hide");
      $(this).fadeOut();
    }
  );

  /*$(document).on('click', '.body-comparador .icon-close', function () {
    var ts  = $(this);

    if($('#accordionModels .mini-card').hasClass('selected-version')){
        $('#accordionModels .mini-card').removeClass('selected-version');
    }

    ts.find('thead').removeClass('found').addClass('not-found');
    ts.siblings('table').find('thead').attr('data-bs-toggle', 'modal');
    ts.siblings('table').find('thead').attr('data-bs-target', '#modalAllVersion');
    ts.siblings('table').find('.model-image').html('<i class="icon-plus"></i>');

    ts.siblings('table').find('.model-title').html('<p>Agregar Modelo</p>');
    ts.siblings('table').find('tbody p').html('-'); 

    ts.siblings('table').removeClass('in');

    $(this).siblings('table').toggleClass('empty full');
    $(this).closest('.col-md-6').removeClass('full-table').addClass('empty-table');


    ts.remove();
});*/
  //Comparador

  //Asignamos el data al bton para ir a cotizar el modelo desde single
  $("#version-quote").on("click", function (e) {
    e.preventDefault();

    var currentSlug = $(
      ".swiper-single_banner__models_single .swiper-slide-active"
    ).data("title");
    currentSlug = slugify(currentSlug);
    var url = "/cotizador-modelos/?version=" + currentSlug;

    window.location.assign(url);
  });

  //Asignamos el data al botón para ir a cotizar el modelo desde comparador
  $(".body-comparador tfoot tr:last-child a").on("click", function (e) {
    e.preventDefault();

    var nameModelQuote = $(this).parents("table").find(".model-title p").text();
    nameModelQuote = slugify(nameModelQuote);
    var url = "/cotizador-modelos/?version=" + nameModelQuote;

    window.location.assign(url);
  });

  //Swiper Galeria Single
  const swiperGallerySingle = new Swiper(".swiper-2_5_gallery", {
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
});

(function ($) {
  //cuando inicie aos se autoreprodece el video de los single de modelos
  $(document).on("aos:in", ({ detail }) => {
    $(".maserati-model_presentation").find("video").trigger("play");
  });
})(jQuery);

// funcion para sanitizar texto a url .
function slugify(text) {
  return text
    .toString()
    .toLowerCase()
    .replace(/\s+/g, "-") // Replace spaces with -
    .replace(/[^\u0100-\uFFFF\w\-]/g, "-") // Remove all non-word chars ( fix for UTF-8 chars )
    .replace(/\-\-+/g, "-") // Replace multiple - with single -
    .replace(/^-+/, "") // Trim - from start of text
    .replace(/-+$/, ""); // Trim - from end of text
}
