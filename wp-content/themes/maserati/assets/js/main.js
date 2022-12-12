jQuery(document).ready(function ($) {
  // Menu responsive
  $(document).on("click", ".hamburger-menu", function () {
    $(".bar").toggleClass("animate");
  });

  // Ver menu
  $(document).on("click", "header .hamburger-menu", function () {
    $(this).closest("body").find(".sidebar-overlay").toggleClass("active");
    $(this).closest("body").toggleClass("sidebar-opened");
  });

  $(document).on("click", ".side-menu .hamburger-menu", function () {
    $(".sidebar-overlay").toggleClass("active");
    $("body").toggleClass("sidebar-opened");
  });

  $(document).on("click", ".sidebar-overlay", function () {
    $(this).toggleClass("active");
    $(this)
      .closest("body")
      .removeClass("sidebar-opened aside-opened open-info-map");
    $(".bar").removeClass("animate");
    $(this)
      .closest("body")
      .find(".shopping-tools")
      .toggleClass("moveBack move");
  });

  $(document).on("click", ".accordion-header", function () {
    $(this).find(".plusminus").toggleClass("active");
  });

  $(document).on("click", ".maserati-box-information .icon-close", function () {
    $(this).closest("body").removeClass("open-info-map"); // modal información map mobile
    $(this).closest("body").find(".sidebar-overlay").toggleClass("active");
  });

  $(document).on("click", "#product-list .maserati-filter-toggle", function () {
    $(this).closest("body").addClass("open-filter");
    $(this).closest("body").find(".sidebar-overlay").toggleClass("active");
  });

  var count_filter = $("#tags-filter li").length;
  if (count_filter !== 0) {
    $(".maserati-filter-toggle span").append(
      "<span>(" + count_filter + ")</span>"
    );
  }

  $(document).on("click", ".mobile-sidebar .icon-close", function (e) {
    e.preventDefault();
    $(this).closest("body").removeClass("open-filter");
    $(this).closest("body").find(".sidebar-overlay").toggleClass("active");

    var count_filter = $("#tags-filter li").length;

    $(".maserati-filter-toggle span span").remove();
    $(".maserati-filter-toggle span").append(
      "<span>(" + count_filter + ")</span>"
    );

    if (count_filter == 0) {
      $(".maserati-filter-toggle span span").remove();
    }
  });

  $(document).on("click", ".mobile-sidebar .filter-button", function (e) {
    $(this).closest("body").removeClass("open-filter");
    $(this).closest("body").find(".sidebar-overlay").toggleClass("active");

    var count_filter = $("#tags-filter li").length;

    $(".maserati-filter-toggle span span").remove();
    $(".maserati-filter-toggle span").append(
      "<span>(" + count_filter + ")</span>"
    );

    if (count_filter == 0) {
      $(".maserati-filter-toggle span span").remove();
    }
  });

  //Inicialización de AOS
  AOS.init({
    disable: "mobile",
  });

  //Animación de numerales
  // $(".counter").countimator();

  //Acticiones click video modal home
  $(".modalvideo").on("hide.bs.modal", function (e) {
    var video = $(this).find("video")[0];
    video.pause();
    video.currentTime = 0;
  });

  $(".modalvideo").on("show.bs.modal", function (e) {
    var video = $(this).find("video")[0];
    video.play();
  });

  //al terminar video cierra los modal de videos
  $(".modalvideo video").on("ended", function () {
    $(".modalvideo").modal("toggle");
  });

  //Galeria modelo guardamos y reemplazamos la imagen del modal con la que hicimos click
  /*$('.maserati-model_galeria .swiper-slide a').on('click', function(){
        var url = $(this).find('img').attr('src');
        $('#modelGallery').find('img').attr('src', url);
        $('#modelGallery').modal('show');
        
    });

    $('#modelGallery').on('hide.bs.modal', function (e) {
        $(this).find('img').removeAttr('src');
    })*/

  $(document).on("click", ".inner-right button", function () {
    $(this)
      .closest("body")
      .find(".shopping-tools")
      .toggleClass("moveBack move");
    //$(this).closest("body").find(".sidebar-overlay").toggleClass("active");
    $(this).closest("body").toggleClass("aside-opened");

    icon = $(this).find("i");
    if (icon.hasClass("icon-arrow-down")) {
      icon.addClass("icon-close").removeClass("icon-arrow-down");
    } else {
      icon.addClass("icon-arrow-down").removeClass("icon-close");
    }
  });

  $(
    ".mobile-sidebar aside section ul, .mobile-sidebar aside section form"
  ).hide();

  /*if($('.mobile-sidebar .widget-title').hasClass('hide-filter')){
            $('.mobile-sidebar .hide-filter').siblings().slideDown();
        }*/

  $(document).on("click", ".mobile-sidebar .widget-title", function () {
    $(this).toggleClass("show-filter hide-filter");
    $(this).siblings().slideToggle();
  });

  var updateSearchDelay;
  $(document).on(
    "keyup",
    "#product-list .woocommerce-product-search .search-field",
    function (e) {
      var $this = $(this);

      clearTimeout(updateSearchDelay);
      updateSearchDelay = setTimeout(function () {
        $this.closest("form").submit();
      }, 1000);
    }
  );

  $(document).on(
    "search",
    "#product-list .woocommerce-product-search .search-field",
    function (e) {
      var $this = $(this);
      $this.closest("form").submit();
    }
  );

  function swapImgMotor($container) {
    var $image = $container.find("img:visible");
    var $image2 = $image.siblings();
    $image.stop().fadeOut(function () {
      $image2.stop().fadeIn();
    });
  }

  /*$(document).on(
    "mouseover",
    ".masertai-motor-sketch",
    function () {
      swapImgMotor($(this));
    },
    function () {
      swapImgMotor($(this));
    }
  );*/

  $(document).on("click", ".maserati-disclamers", function (e) {
    var $this = $(this);
    var $data = $this.data("disclamer");
    $("#disclamersModal").find(".modal-body p").text($data);
  });

  /*var audio_url = $(".listen-motor audio").data("audio");

  try {
    wave = new CircularAudioWave(document.getElementById("sound-chart"));
    wave.loadAudio(audio_url);
  } catch (error) {
    wave = null;
  }

$(document).on("click", ".listen-motor .icon-on-off", function () {
    if (wave.playing) {
      wave.stop();
    } else {
      wave.play();
      //$('.pulse-on_off p').fadeOut();
    }
  });*/

  $(document).on("click", ".pulse-on_off .icon-on-off", function () {
    var visualizer = $(this).data("visualizer");

    $(this).closest(".pulse-on_off").find("p").fadeToggle();

    if (!visualizer) {
      visualizer = AUDIO.VISUALIZER.getInstance({
        autoplay: true,
        loop: false,
        audio: "myAudio",
        canvas: "myCanvas",
        style: "lounge",
        barWidth: 2,
        barHeight: 2,
        barSpacing: 7,
        barColor: "#ffffff",
        shadowBlur: 20,
        shadowColor: "#ffffff",
        font: ["0px", "Helvetica"],
      });

      $(this).data("visualizer", visualizer);
    } else {
      if (visualizer.isPlaying == false) {
        visualizer.playSound();

        $(this).closest(".pulse-on_off").find(".-canvas").fadeIn();
        $(this).closest(".pulse-on_off").find("p").fadeOut();
      } else {
        visualizer.pauseSound();

        $(this).closest(".pulse-on_off").find(".-canvas").fadeOut();
        $(this).closest(".pulse-on_off").find("p").fadeIn();
      }
    }
  });
  //
  //Hacemos que la primera opción del selector sea solo de lectura
  var $option = $(".maserati-form select option:first-child");
  $option.attr("disabled", true);

  /*$(window).scroll(function () {
          if($('.cc-header').hasClass('fixed')){
            $('#main-view').find('.sidebar.main-sidebar aside').addClass('is_sticky');
          }else{
            $('#main-view').find('.sidebar.main-sidebar aside').removeClass('is_sticky');
          }
          });*/

  // Calculamos y definimos altura de contenedor header configurador
  var height = $(".maserati-fit-banner").outerHeight();
  var header = $("#masthead").outerHeight();
  $("#maserati_menu_2018.new-menu, .sticky-wrapper.new-menu").css(
    "height",
    height
  );
  $("#cc_app .cc-header").css("top", height);

  $(window).on("resize", function () {
    var height = $(".maserati-fit-banner").outerHeight();
    var header = $("#masthead").outerHeight();
    $("#maserati_menu_2018.new-menu, .sticky-wrapper.new-menu").css(
      "height",
      height
    );
    $("#cc_app .cc-header").css("top", height);
  });

  // Calculamos y definimos altura de slider mobile
  if (window.outerWidth < 767) {
    var buttonFixed = $(".buttons-fix.dropup ").outerHeight();
    var header = $("#masthead").outerHeight();

    $(".main-slider .swiper-slide").css(
      "height",
      "calc(100vh - (" + buttonFixed + "px + " + header + "px))"
    );

    $(window).on("resize", function () {
      var buttonFixed = $(".buttons-fix.dropup ").outerHeight();
      var header = $("#masthead").outerHeight();

      $(".main-slider .swiper-slide").css(
        "height",
        "calc(100vh - (" + buttonFixed + "px + " + header + "px))"
      );
    });
  }

  //Apertura de tabnav segun hash url
  const hash = window.location.hash;

  $(".maserati-tabnav .nav button").each(function () {
    var hashButton = $(this).attr("id");
    hashButton = "#" + hashButton;
    //console.log('#' + hashButton);
    if (hashButton == hash) {
      $(this).tab("show");
    }
  });

  $(document).on("mouseover", ".menu-desktop .nav-item", function (e) {
    e.preventDefault();
    $(this).addClass("item-active").siblings("li").removeClass("item-active");

    $(this)
      .closest(".menu-desktop")
      .find(".menu-right")
      .css("background-image", "none");

    var leftMenu = $(this).data("menu");

    $(this)
      .parents(".menu-desktop")
      .find(".menu-right nav")
      .each(function () {
        var rightMenu = $(this).data("menu");
        if (leftMenu == rightMenu) {
          $(this).fadeIn(100);
        } else {
          $(this).fadeOut(0);
        }
      });
  });

  $(document).on("click", ".maserati-proyecto_multimedia video", function (e) {
    $(this).trigger("play");
  });

  $(document).on(
    "mouseover",
    ".menu-desktop .menu-right ul .item-parent",
    function (e) {
      e.preventDefault();
      $(this)
        .addClass("link-active")
        .siblings(".item-parent")
        .removeClass("link-active");

      $(this)
        .closest(".accordion")
        .siblings(".accordion")
        .find("li")
        .removeClass("link-active");
    }
  );

  //Modal Configurador Single
  $("#modalConfigVersion #accordionModels .mini-card").on(
    "click",
    function (e) {
      var data_code = $(this).data("code");
      var data_url = "/configurador/?modelName=" + data_code;
      $(this)
        .parents(".modal")
        .find(".button-call_to_action a")
        .attr("href", data_url);
      $(this).parents(".modal").find(".button-call_to_action").fadeIn();

      if ($(this).hasClass("selected-version")) {
        $(this)
          .parents(".modal")
          .find(".button-call_to_action a")
          .attr("href", "");
        $(this).parents(".modal").find(".button-call_to_action").fadeOut();
      }
    }
  );

  $("#modalConfigVersion .btn-close, .selected-version").on(
    "click",
    function (e) {
      $(this)
        .parents(".modal")
        .find(".mini-card")
        .removeClass("selected-version");
      $(this)
        .parents(".modal")
        .find(".button-call_to_action a")
        .attr("href", "");
      $(this).parents(".modal").find(".button-call_to_action").fadeOut();
    }
  );

  $(document).on("click", "#accordionModels .mini-card", function () {
    $(this)
      .toggleClass("selected-version")
      .siblings()
      .removeClass("selected-version");
    $(this)
      .parents(".accordion-item")
      .siblings()
      .find(".mini-card")
      .removeClass("selected-version");

    //window.setTimeout(function() {
    //$('#modalAllVersion').modal('hide');
    //}, 5000);

    if ($(this).hasClass("selected-version")) {
      var selected = $(this);
      var year = selected.data("year");
      var esquema = selected.data("esquema");
      var cilindrada = selected.data("cilindrada");
      var aceleracion = selected.data("aceleracion");
      var velocidad = selected.data("velocidad");
      var potencia = selected.data("potencia");
      var traccion = selected.data("traccion");
      var price = selected.data("price");
      var ficha = selected.data("ficha");

      var title = selected.find("p").text();
      var img = selected.find("img").attr("src");

      $(".body-comparador .row .col-md-6.empty-table").each(function (index) {
        $(this)
          .first()
          .find("table.empty thead")
          .removeClass("not-found")
          .addClass("found");
        $(this).first().find("table.empty thead").removeAttr("data-bs-toggle");
        $(this).first().find("table.empty thead").removeAttr("data-bs-target");
        $(this).first().find("table.empty").addClass("in");
        $(this)
          .first()
          .find("table.empty .model-image")
          .html('<img src="" alt="">');

        $(this)
          .first()
          .find("table.empty")
          .find(".model-image img")
          .attr("src", img);
        $(this).first().find("table.empty").find(".model-title p").text(title);
        $(this).first().find("table.empty").find(".model-year p").text(year);
        $(this)
          .first()
          .find("table.empty")
          .find(".model-potencia p")
          .text(potencia);
        $(this)
          .first()
          .find("table.empty")
          .find(".model-velocidad p")
          .text(velocidad);
        $(this)
          .first()
          .find("table.empty")
          .find(".model-aceleracion p")
          .text(aceleracion);
        $(this)
          .first()
          .find("table.empty")
          .find(".model-esquema p")
          .text(esquema);
        $(this)
          .first()
          .find("table.empty")
          .find(".model-traccion p")
          .text(traccion);
        $(this)
          .first()
          .find("table.empty")
          .find(".model-cilindrada p")
          .text(cilindrada);
        $(this).first().find("table.empty").find(".model-precio p").text(price);
        $(this)
          .first()
          .find("table.empty")
          .find(".ficha-comparador")
          .attr("href", ficha);

        var url_cotizador = "/cotizador-modelos/?version=";
        url_cotizador = url_cotizador + slugify(title);
        $(this)
          .first()
          .find("table.empty")
          .find(".button-cotizador")
          .attr("href", url_cotizador);

        $(this).first().find("table").before('<i class="icon-close"></i>');
        $(this).siblings().find("i.icon-close").removeClass("d-none");

        $(this).first().removeClass("empty-table").addClass("full-table");
        $(this).first().find("table.empty").toggleClass("full empty");

        return false;
      });

      $(this).parents(".modal").find(".button-call_to_action").fadeIn();
    } else {
      $(".body-comparador .row").each(function (index) {
        $(this)
          .children()
          .last()
          .find("table.full")
          .find("thead")
          .removeClass("found")
          .addClass("not-found");
        $(this)
          .children()
          .last()
          .find("table.full")
          .find("thead")
          .attr("data-bs-toggle", "modal");
        $(this)
          .children()
          .last()
          .find("table.full")
          .find("thead")
          .attr("data-bs-target", "#modalAllVersion");
        $(this).children().last().find("table.full").removeClass("in");
        $(this)
          .children()
          .last()
          .find("table.full")
          .find(".model-image")
          .html('<i class="icon-plus"></i>');
        $(this).children().last().find("table.full").find("tbody p").html("-");
        $(this)
          .children()
          .last()
          .find("table.full")
          .find("thead p")
          .html("Agregar Modelo");

        $(this).children().last().find("table.full").toggleClass("full empty");
        $(this)
          .children()
          .last()
          .removeClass("full-table")
          .addClass("empty-table");

        $(this)
          .children()
          .last()
          .closest(".body-comparador")
          .find("table")
          .siblings(".icon-close")
          .remove();

        //return false;
      });

      $(this).parents(".modal").find(".button-call_to_action").fadeOut();
    }
  });

  $(document).on("click", ".body-comparador .icon-close", function () {
    var ts = $(this);

    if ($("#accordionModels .mini-card").hasClass("selected-version")) {
      $("#accordionModels .mini-card").removeClass("selected-version");
    }

    ts.find("thead").removeClass("found").addClass("not-found");
    ts.siblings("table").find("thead").attr("data-bs-toggle", "modal");
    ts.siblings("table")
      .find("thead")
      .attr("data-bs-target", "#modalAllVersion");
    ts.siblings("table").find(".model-image").html('<i class="icon-plus"></i>');

    ts.siblings("table").find(".model-title").html("<p>Agregar Modelo</p>");
    ts.siblings("table").find("tbody p").html("-");

    ts.siblings("table").removeClass("in");

    $(this).siblings("table").toggleClass("empty full");
    $(this)
      .closest(".col-md-6")
      .removeClass("full-table")
      .addClass("empty-table");

    ts.remove();
  });

  //Preloader

  //$("body").toggleClass("loading-page");

  preloaderFadeOutTime = 500;

  function hidePreloader() {
    var preloader = $(".preload-maserati");

    preloader.fadeOut(preloaderFadeOutTime, function () {
      $("body").toggleClass("loading-page");
    });
  }
  hidePreloader();

  $(document).on("change", ".dropdown-maserati select", function () {
    $(this).closest("form").submit();
  });
});

(function ($) {
  $(function () {
    $("#SeeAllEvents").hide();
    var timeoutId;
    $(document).on(
      "mouseover",
      "#NewsStrip",
      function () {
        if (!timeoutId) {
          timeoutId = window.setTimeout(function () {
            timeoutId = null;
            $("#SeeAllEvents").slideDown("slow");
          }, 1000);
        }
      },
      function () {
        if (timeoutId) {
          window.clearTimeout(timeoutId);
          timeoutId = null;
        } else {
          $("#SeeAllEvents").slideUp("slow");
        }
      }
    );
  });

  var $window = $(window);
  var lastScrollTop = 0;
  var header = $("header.sticky-active");
  var headerHeight = header.outerHeight();

  $window.on("scroll", function () {
    var windowTop = $window.scrollTop();

    if (windowTop >= headerHeight) {
      header.addClass("header-sticky");
    } else {
      header.removeClass("header-sticky");
      header.removeClass("sticky-show");
    }

    if (header.hasClass("header-sticky")) {
      if (windowTop < lastScrollTop) {
        header.addClass("sticky-show");
      } else {
        header.removeClass("sticky-show");
      }
    }

    lastScrollTop = windowTop;
  });

  $.extend(true, $.blockUI.defaults, {
    message: '<div class="spinner"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="46" /></svg></div>',
    css: {
      color: "var(--text-color)",
      border: "none",
      backgroundColor: "none",
      cursor: "wait",
    },
    overlayCSS: {
      opacity: 0.2,
      cursor: "wait",
    },
  });

  //Asignamos el data al bton para ir a cotizar el modelo desde single
  $("#version-quote").on("click", function (e) {
    e.preventDefault();

    var currentSlug = $(
      ".swiper-single_banner__models_single .swiper-slide-active"
    ).data("title");
    currentSlug = convertToSlug(currentSlug);
    var url = "/cotizador-modelos/?version=" + currentSlug;

    window.location.assign(url);
  });

  //Asignamos el data al botón para ir a cotizar el modelo desde comparador
  $(".body-comparador tfoot tr:last-child a").on("click", function (e) {
    e.preventDefault();

    var nameModelQuote = $(this).parents("table").find(".model-title p").text();
    nameModelQuote = convertToSlug(nameModelQuote);
    var url = "/cotizador-modelos/?version=" + nameModelQuote;

    window.location.assign(url);
  });

  /*$(document).on('change', 'select[name="modelos"]', function () {

        var optionSelected = $(this).find("option:selected").text(); 
        var optionSelectedSlug = convertToSlug(optionSelected);

        var inputsHidden = $(this).closest('form').find('div').first().find('input');

        $(inputsHidden).each(function() {
            var attr = $(this).attr('name');
            var value = $(this).val();

            if(optionSelectedSlug == attr){
                var slugSave = attr;
                var imgSave = value;

                $(this).closest('form').find('#nameModel').text(optionSelected);
                $(this).closest('form').find('#imgModel').attr('src', imgSave);
            }

        });

    }); */

  $(document).on("click", "#cf7mls-next-btn-cf7mls_step-2", function () {
    var form_select = $(this).closest("form").find('select[name="modelos"]');

    var optionSelected = form_select.find("option:selected").text();
    var optionSelectedSlug = convertToSlug(optionSelected);

    var inputsHidden = $(this)
      .closest("form")
      .find("div")
      .first()
      .find("input");

    $(inputsHidden).each(function () {
      var attr = $(this).attr("name");
      var value = $(this).val();

      if (optionSelectedSlug == attr) {
        var slugSave = attr;
        var imgSave = value;

        //Datos al resumen
        $(this).closest("form").find("#nameModel").text(optionSelected);
        $(this).closest("form").find("#imgModel").attr("src", imgSave);

        //Datos al mail usuario
        $(this).closest("form").find("#nameModelMail").val(optionSelected);
        $(this).closest("form").find("#slugImgMail").val(imgSave);
      }
    });

    var nameUser = $(this).closest("form").find('input[name="nombre"]').val();
    $(this).closest("form").find("#nameUser span").text(nameUser);
  });

  /*$('.wpcf7').on('wpcf7mailsent', function (event) {  
        location = '/';
     }, false);*/

  //Asignamos el data al botón para ir a cotizar el modelo preowned desde single
  $(".entry-summary a#quote-preowned").on("click", function (e) {
    e.preventDefault();

    var namePreOwnedQuote = $(this)
      .parents(".product")
      .find(".product_title.entry-title")
      .text();
    namePreOwnedQuote = convertToSlug(namePreOwnedQuote);
    var url = "/cotizador-pre-owned/?preowned=" + namePreOwnedQuote;

    window.location.assign(url);
  });

  /*$(document).on('change', 'select[name="preowned"]', function () {

        var optionSelected = $(this).find("option:selected").text(); 
        var optionSelectedSlug = convertToSlug(optionSelected);

        var inputsHidden = $(this).closest('form').find('div').first().find('input');

        $(inputsHidden).each(function() {
            var attr = $(this).attr('name');
            var valueJson = $(this).val();

            if(optionSelectedSlug == attr){
                var slugSave = attr;

                var obj = jQuery.parseJSON(valueJson);

                //console.log(obj.image);

                $(this).closest('form').find('#nameModelPO').text(optionSelected);
                $(this).closest('form').find('#subTitlePO').text(obj.subtitulo);
                $(this).closest('form').find('#imgModelPO').attr('src', obj.image);
            }

        });

    }); */

  $(document).on("click", "#cf7mls-next-btn-cf7mls_step-2", function () {
    var form_select = $(this).closest("form").find('select[name="preowned"]');

    var optionSelected = form_select.find("option:selected").text();
    var optionSelectedSlug = convertToSlug(optionSelected);

    var inputsHidden = $(this)
      .closest("form")
      .find("div")
      .first()
      .find("input");

    $(inputsHidden).each(function () {
      var attr = $(this).attr("name");
      var valueJson = $(this).val();

      if (optionSelectedSlug == attr) {
        //var slugSave = attr;
        var obj = jQuery.parseJSON(valueJson);

        //console.log(obj.image);

        //Datos usuario form
        $(this).closest("form").find("#nameModelPO").text(optionSelected);
        //$(this).closest("form").find("#subTitlePO").text(obj.subtitulo); Se removio a pedido del cliente, se se eliminaron etiquetas de contactform 7
        $(this).closest("form").find("#imgModelPO").attr("src", obj.image);
        $(this).closest("form").find("#yearPO span").text(obj.year);
        $(this).closest("form").find("#dataPO span").text(obj.dato);
        $(this)
          .closest("form")
          .find("#kmPO span")
          .text(obj.kilometraje + " kms");

        //Datos mail usuario
        $(this).closest("form").find("#nameModelMail").val(optionSelected);
        $(this).closest("form").find("#subtitleMail").val(obj.subtitulo);
        $(this).closest("form").find("#slugImgMail").val(obj.image);
        $(this).closest("form").find("#yearModelMail").val(obj.year);
        $(this).closest("form").find("#datoModelMail").val(obj.dato);
        $(this).closest("form").find("#kmModelMail").val(obj.kilometraje);
      }
    });

    var nameUser = $(this).closest("form").find('input[name="nombre"]').val();
    $(this).closest("form").find("#nameUserPO span").text(nameUser);
  });

  // funcion para sanitizar texto a url .
  function convertToSlug(text) {
    return text
      .toLowerCase()
      .replace(/ /g, "-")
      .replace(/[^\w-]+/g, "");
  }


  $(document).on("click", "video", function () {
    $video = $(this)[0];
    if ($video.paused == false) {
      $video.controls = false;
      $(this).trigger('pause');
    } else {
      $video.controls = true;
      //$(this).play();
    }

  });




})(jQuery);

var tooltipTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});

window.addEventListener("scroll", function () {
  var element = document.querySelector("footer");
  var position = element.getBoundingClientRect();

  // vista completa
  /*if (position.top >= 0 && position.bottom <= window.innerHeight) {
    console.log("Element is fully visible in screen");
  }*/
  const body = document.body;
  if (position.top < window.innerHeight && position.bottom >= 0) {
    body.classList.add("show-footer");
  } else {
    body.classList.remove("show-footer");
  }
});