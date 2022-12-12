jQuery( function( $ ) {
    /***** WOOCOMMECE SHOP AJAX *****/
    function shopAjax() {
        // add class in price filter widget
        // $('.widget_price_filter').addClass('yith-wcan-list-price-filter');

        // order by ajax
        $( '.woocommerce-ordering' ).off( 'change', 'select.orderby' ).on( 'change', 'select.orderby', function(e) {
            e.preventDefault();

            var $this = $(this),
                $form = $this.closest('form'),
                href  = '?' + $form.serialize();

            shopAjaxProcess(href);
            return false;
        });

        // view ajax
        $( '.woocommerce-viewing' ).off( 'change', 'select.count' ).on( 'change', 'select.count', function(e) {
            e.preventDefault();

            var $this = $(this),
                $form = $this.closest('form'),
                href  = '?' + $form.serialize();

            shopAjaxProcess(href);
            return false;
        });

        // pagination ajax
        $( '.woocommerce-pagination' ).each(function() {
            $(this).off( 'click', 'a.page-numbers' ).on( 'click', 'a.page-numbers', function(e) {
                e.preventDefault();
                shopAjaxProcess(this.href);
                return false;
            });
        });

        // price filter ajax
        // range filter
        $( '.sidebar-filter .price_slider_wrapper, .sidebar-filter .range_slider_wrapper, .sidebar-filter .attribute-range-filter' ).off( 'click', '.button' ).on( 'click', '.button', function(e) {
            e.preventDefault();

            var $this  = $(this),
                $form  = $this.closest('form'),
                action = $form.attr('action'),
                href   = action + ( -1 === action.indexOf('?') ? '?' : '&' ) + $form.serialize(),
                $count = $('.woocommerce-viewing select.count');

            if ($count.length) {
                var count = $('.woocommerce-viewing select.count').val();
                if (count != $count.find('option:not([disabled]):first').val()) {
                    href += '&count=' + count;
                }
            }

            shopAjaxProcess(href);
        });

        // sidebar filter
        $('.sidebar-filter').off('click', 'a').on('click', 'a', function(e) {
            e.preventDefault();

            var $this  = $(this),
                href   = $this.attr('href'),
                $count = $('.woocommerce-viewing select.count');

            if ($count.length) {
                var count = $('.woocommerce-viewing select.count').val();
                if (count != $count.find('option:not([disabled]):first').val()) {
                    href += '&count=' + count;
                }
            }

            shopAjaxProcess(href);
            return false;
        });

        $('#product-list .load-more').off('click', 'a').on('click', 'a', function(e) {
            e.preventDefault();
            shopAjaxProcess(this.href, true);
            return false;
        });


        $('#product-list .woocommerce-product-search').off('submit').on('submit', function(e) {
            e.preventDefault();

            var $form = $(this),
            //$form = $this.closest('form'),
            href  = '?' + $form.serialize();

            if($form.find('.search-field').val().trim() == ''){
                href = '?'; 
            }

            shopAjaxProcess(href);
            return false;

        });

        /*$('#product-list form.woocommerce-product-search').off('click', 'button').on('click', 'button', function(e) {
            e.preventDefault();
            shopAjaxProcess(this.href, true);
            return false;
        });*/

        /*
        $('.widget_layered_nav select').off('change').on('change', function(e) {
            e.preventDefault();

            var $this = $(this),
                name = $this.closest('form').find('input[type=hidden]').length ? $this.closest('form').find('input[type=hidden]').attr('name').replace('filter_', '') : $this.attr('class').replace('dropdown_layered_nav_', ''),
                slug = $this.val(),
                href,
                $count = $('.woocommerce-viewing select.count');

            href = window.location.href;
            href = href.replace(/\/page\/\d+/, "").replace("&amp;", '&').replace("%2C", ',');

            href = porto_update_url_param( href, 'filtering', '1' );
            href = porto_update_url_param( href, 'filter_' + name, slug );
            if ($count.length) {
                var count = $('.woocommerce-viewing select.count').val();
                if (count != $count.find('option:not([disabled]):first').val()) {
                    href = porto_update_url_param( href, 'count', count );
                }
            }

            shopAjaxProcess(href, name);
            return false;
        });
        */
    };

    function shopAjaxProcess(href) {
        var product_list   = '#product-list',
            sidebar_filter = '.sidebar-filter';

        $.blockUI();

        // $.scroll_to_container( $(product_list) );

        //update browser history (IE doesn't support it)
        if (!navigator.userAgent.match(/msie/i)) {
            window.history.pushState({"state": href, "rand": Math.random()}, "", href);
        }

        $.ajax({
            url: href,
            data: {
                showsidebar: $('#productFilterCollapse').hasClass('show') ? '1' : ''
            },
            type: 'GET',
            headers: {
                'HTTP_X_REQUESTED_WITH': 'XMLHttpRequest'
            },
            success: function (response, textStatus, jqXHR) {
                var $response = $('<div>').append( $.parseHTML( response ) );

                if ( $response.find(product_list).length ) {
                    $( product_list ).html( $response.find(product_list).html() );
                }

                if ( $response.find(sidebar_filter).length ) {
                    $( sidebar_filter ).html( $response.find(sidebar_filter).html() );
                    $( document.body ).trigger( 'init_price_filter' );
                    $( document.body ).trigger( 'init_range_filters' );
                }

                //trigger ready event
                $(document).trigger( 'ajax-filtered' );

                shopAjax();
                $.unblockUI();
            },
            error: function() {
                window.location.reload();
            }
        });
    }

    shopAjax();
    
    var updateShopDelay;
    $(document).on("slide", ".sidebar-filter .price_slider, .sidebar-filter .range_slider", function () {
      clearTimeout(updateShopDelay);
    });
  
    $(document).on("slidechange", ".sidebar-filter .price_slider, .sidebar-filter .range_slider", function () {
      var $self = $(this);
  
      clearTimeout(updateShopDelay);
  
      updateShopDelay = setTimeout(function () {
        $self.closest("form").find("button[type=submit]").click();
      }, 500);
    });
    $(document).on("change", ".sidebar-filter .attribute-range-filter select", function () {
        $(this).closest("form").find("button[type=submit]").click();
      });
});


// Para que al dar "atras" al boton del navegador recargue la pagina en la tienda
window.addEventListener('popstate', function () {
	window.location.reload();
});

// Para que al dar "atras" al boton del navegador recargue la pagina en la tienda
window.addEventListener( 'pageshow', function ( event ) {
	var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
	if ( historyTraversal ) {
	  window.location.reload();
	}
});
