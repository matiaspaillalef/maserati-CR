<?php

$model_name = $_GET['modelName'];
$model_year = $_GET['modelYear'];

//echo $model_name;
//echo $model_year;


?>
<style>
    body {
        margin: 0;
    }

    #cc_app body,
    #cc_app p,
    #cc_app span {
        font-size: 13px;
        font-family: Univers LT W02_57 Condensed, sans-serif;
    }

    #cc_app .filters-container .btn-group {
        align-items: center;
        justify-content: flex-end;
    }



    #cc_app {
        position: relative;
        padding-bottom: 55px;
        background: whitesmoke;
    }

    #cc_app {
        position: relative;
    }

    #cc_app .cc-header {
        top: 0 !important;
    }


    button[data-linktracking="cta:summary-sidebar:printpdf"] span:last-child {
        font-size: 0 !important;
    }

    button[data-linktracking="cta:summary-sidebar:printpdf"] span:last-child:after {
        content: 'imprimir PDF';
        font-size: 16px;
        color: var(--primary-color) !important;
        vertical-align: middle;
    }

    button[data-linktracking="cta:summary-sidebar:printpdf"] .icon-pdf:before {
        margin-right: 16px;
        background-image: url(/wp-content/uploads/2022/10/FileEarmarkPdf.png);
        content: '';
        width: 25px;
        height: 25px;
        display: inline-block;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }

    #cc_app .main-sidebar .sidebar-container.is-absolute {
        position: inherit;
    }

    #cc_app .main-sidebar .sidebar-container.is-absolute.is_sticky {
        top: 50px;
    }

    #cc_app .main-sidebar .sidebar-container.is_sticky {
        position: fixed;
        top: 20px;
        right: 0;
        bottom: auto;
        left: 75%;
    }

    #cc_app .icon-search:before {
        content: "\e924" !important;
    }

    #cc_app .container {
        max-width: 100%;
        margin: 0 auto;
    }

    #cc_app .optional-card .header button.info .card-title {
        font-size: 16px;
        height: auto;
        line-height: normal;
    }

    #cc_app .accessory-card .header button .card-title span {
        font-size: 16px;
        line-height: normal;
    }

    #cc_app .optional-card .header button.info {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        height: auto;
        padding: 0 0 0 20px;
        margin: 0;
    }

    #cc_app #accessories h2.title,
    #cc_app #main-view h2.title,
    #cc_app #optionals h2.title,
    #cc_app #packs h2.title {
        font-style: normal;
    }

    #cc_app .carousel-image-container {
        height: auto;
    }

    #cc_app .sidebar .cta-group .primary-cta {
        text-transform: initial;
    }

    #cc_app .main-sidebar .sidebar-container {
        display: flex;
        flex-direction: column;
    }

    #cc_app .sidebar .sidebar-header {
        order: 0
    }

    #cc_app .sidebar-container figure {
        order: 1;
    }

    #cc_app .sidebar .icons-group {
        order: 2;
    }

    #cc_app .sidebar .cta-group {
        order: 3;
    }

    #cc_app .sidebar .icons-group .icon {
        text-align: center !important;
        width: fit-content !important;
        margin-right: auto !important;
        margin-bottom: auto !important;
        position: relative !important;
        margin: 0 auto;
    }

    #cc_app .sidebar .icons-group .icon span:first-child {
        left: 0;
    }

    #cc_app #accessories h2.title,
    #cc_app #main-view h2.title,
    #cc_app #optionals h2.title,
    #cc_app #packs h2.title,
    #cc_app #accessories h2.title span,
    #cc_app #main-view h2.title span,
    #cc_app #optionals h2.title span,
    #cc_app #packs h2.title span {
        font-family: Univers LT W02_57 Condensed, sans-serif;
        letter-spacing: 0;
        line-height: 96px;
        font-size: 24px;
        background: #f5f5f5;
        padding: 24px 0 0 20px;
        text-transform: lowercase;
    }

    #cc_app .pack-card .header button.info .card-title,
    #cc_app .pack-card .header button.info .card-title span {
        font-size: 16px;
    }

    button span[role="img"] {
        font-size: 20px !important;
    }

    .optional-card button span[role="img"] {
        font-size: 15px !important;
    }

    #cc_app .pack-card .header .icon-info {
        top: 10px;
    }

    #cc_app .pack-card .header button.info {
        padding-top: 5px;
    }

    .sidebar-container .note {
        display: none;
    }

    h2.model,
    h2.model span {
        font-family: var(--everett-font) !important;
        font-style: normal;
        font-weight: 500 !important;
        font-size: 20px !important;
        line-height: 24px;
        color: var(--primary-color) !important;
    }

    #cc_app .sidebar .icons-group {
        align-items: center;
        justify-content: center;
        margin-top: 50px;
    }

    button[data-linktracking="cta:main-sidebar:open-configuration"],
    button[data-linktracking="cta:main-sidebar:restart-configuration"],
    button[data-linktracking="cta:main-sidebar:change-model"],
    button[data-linktracking="cta:summary-sidebar:friend-share"],
    button[data-linktracking="cta:main-sidebar:save-configuration"] {
        display: none !important;
    }

    .cc-footer {
        opacity: 0 !important;
        visibility: hidden;
    }
</style>


<!-- <link href="https://www-aemprod.maserati.com/etc.clientlibs/maserati/clientlibs/clientlib-site.css?4.0.21" rel="stylesheet" type="text/css"> -->
<link href="https://pos-configurator.maserati.com/configurator-v3/stylesheets/desktop.min.css?4.0.21" rel="stylesheet">


<section data-regionid="body" class="maserati-configurator shoppingtool">
    <div class="sticky-wrapper new-menu not-sticky">
        <?php //get_template_part('parts/part', 'banner-page'); 
        ?>
        <nav id="maserati_menu_2018" data-regionid="main-nav" class="new-menu not-sticky">
            <?php //get_header();
            get_template_part('parts/part', 'banner-page');
            ?>
        </nav>
    </div>

    <!-- TODO verify if is possible to include as bundled libs-->
    <script src="https://pos-configurator.maserati.com/configurator-v3/js/libs/jquery/dist/jquery.min.js?4.0.21"></script>
    <script src="https://pos-configurator.maserati.com/configurator-v3/js/libs/js-cookie/src/js.cookie.js?4.0.21"></script>
    <script src="https://pos-configurator.maserati.com/configurator-v3/js/libs/lodash/lodash.min.js?4.0.21"></script>
    <script src="https://pos-configurator.maserati.com/configurator-v3/js/libs/urijs/src/URI.js?4.0.21"></script>
    <script src="https://pos-configurator.maserati.com/configurator-v3/js/libs/accounting/accounting.min.js?4.0.21"></script>
    <script src="https://pos-configurator.maserati.com/configurator-v3/js/libs/lite-log/logger.js?4.0.21"></script>
    <script>
        // TODO avoid to specify the endpoint
        window.CC_EnvPropServiceEndpoint = "https://pos-configurator.maserati.com/configurator-v3/environmentProp.json";

        // This logic will be replaced by spring controller in real Magnolia context
        var uri = new URI(window.location.href.replace(/\/$/, "")); //removing trailing slash
        var parameters = uri.search(true);

        window.CC_InitData = {
            AlertLevel: 0,
            ContextMagnolia: false,
            ModelName: '<?php echo $model_name; ?>' || parameters['modelName'],
            Language: 'es',
            Country: '53',
            ConfigID: '',
            InitialConfiguration: '',
            ModelFamily: '',
            ModelCode: '',
            DealerCode: '',
            DealerMode: 'false',
            StDealerCode: '',
            DealerSiteMode: 'false',
            DebugMode: false,
            ModelYear: '',
            isMobile: <?php echo wp_is_mobile() ? "true" : "false"; ?>,
            isDesktop: <?php echo !wp_is_mobile() ? "true" : "false"; ?>,
            cta: parameters['cta']
        };
    </script>
    <div id="cc_app" class="v3 loader-container">
        <div class="loader active">
            <div class="double-pulse"></div>
            <div class="double-pulse"></div>
        </div>
    </div>

    <!-- Luego del #cc_app puede haber lo que sea ya que no afecta a la app -->
    <?php $terminos_y_condiciones = get_field('terminos_y_condiciones'); ?>
    <?php if ($terminos_y_condiciones) : ?>
        <section class="maserati-config-terms maserati-bg--off_white">
            <a class="maserati-button aserati-button_large maserati-color--feature_grey" href="<?php echo esc_url($terminos_y_condiciones['url']); ?>" target="<?php echo esc_attr($terminos_y_condiciones['target']); ?>"><?php echo esc_html($terminos_y_condiciones['title']); ?></a>
        </section>
    <?php endif; ?>

    <script src="https://pos-configurator.maserati.com/configurator-v3/js/libs/taffydb/taffy-min.js?=4.0.21"></script>
    <script src="https://pos-configurator.maserati.com/configurator-v3/js/libs/engine-module/dist/js/engine.min.js?=4.0.21"></script>
    <script src="https://pos-configurator.maserati.com/configurator-v3/js/desktop.min.js?=4.0.21"></script>