<?php


add_action('admin_head', 'css_admin_wp');

function css_admin_wp()
{
?>
	<style type="text/css">
		:root {
			--azul-mst: #1c3775;
			--amarillo-mst: #fbc844;
		}

		.theme-browser .theme .theme-screenshot img {
			height: 100%;
			left: 50%;
			width: auto;
			right: 50%;
			transform: translateX(-50%);
		}

		#wpadminbar {
			background: black;
		}

		#adminmenu,
		#adminmenu .wp-submenu,
		#adminmenuback,
		#adminmenuwrap {
			width: 160px;
			background-color: #000;
		}

		#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head,
		#adminmenu .wp-menu-arrow,
		#adminmenu .wp-menu-arrow div,
		#adminmenu li.current a.menu-top,
		#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu {
			background: #ffc845;
			color: black;
		}

		#adminmenu .current div.wp-menu-image:before,
		#adminmenu .wp-has-current-submenu div.wp-menu-image:before,
		#adminmenu a.current:hover div.wp-menu-image:before,
		#adminmenu a.wp-has-current-submenu:hover div.wp-menu-image:before,
		#adminmenu li.wp-has-current-submenu a:focus div.wp-menu-image:before,
		#adminmenu li.wp-has-current-submenu.opensub div.wp-menu-image:before,
		#adminmenu li.wp-has-current-submenu:hover div.wp-menu-image:before {
			color: black;
		}

		#adminmenu .wp-submenu {
			background-color: var(--azul-mst);
		}

		#adminmenu li.menu-top:hover,
		#adminmenu li.opensub>a.menu-top,
		#adminmenu li>a.menu-top:focus {
			background-color: var(--amarillo-mst);
			color: black;
		}

		#adminmenu li:hover a,
		#adminmenu li:hoverv div.wp-menu-image:before,
		#adminmenu .wp-submenu a:focus,
		#adminmenu .wp-submenu a:hover,
		#adminmenu a:hover,
		#adminmenu li.menu-top>a:focus,
		#adminmenu li a:focus div.wp-menu-image:before,
		#adminmenu li.opensub div.wp-menu-image:before,
		#adminmenu li:hover div.wp-menu-image:before {
			color: black;
		}

		.wp-core-ui .button-primary {
			background: var(--amarillo-mst) !important;
			border-color: var(--amarillo-mst) !important;
			color: black;
			border-radius: 0;
		}

		.wp-core-ui .button-primary.focus,
		.wp-core-ui .button-primary.hover,
		.wp-core-ui .button-primary:focus,
		.wp-core-ui .button-primary:hover {
			background: var(--azul-mst) !important;
			border-color: var(--azul-mst) !important;
		}

		#adminmenu li a:focus div.wp-menu-image:before,
		#adminmenu li.opensub div.wp-menu-image:before,
		#adminmenu li:hover div.wp-menu-image:before {
			color: black;
		}

		#adminmenu .wp-submenu a:focus,
		#adminmenu .wp-submenu a:hover,
		#adminmenu a:hover,
		#adminmenu li.menu-top>a:focus {
			color: black
		}

		#adminmenu li.wp-has-submenu.wp-not-current-submenu.opensub:hover:after,
		#adminmenu li.wp-has-submenu.wp-not-current-submenu:focus-within:after {
			border-right-color: var(--azul-mst);
		}

		#adminmenu .wp-submenu a:focus,
		#adminmenu .wp-submenu a:hover {
			color: var(--amarillo-mst);
		}

		.maserati-welcome_msg {
			background: black;
			color: white;
			padding: 50px;
			margin-top: 15px;
		}

		.maserati-welcome_msg h3 {
			color: white;
			font-size: 30px;
			margin: 15px 0 15px 0 !important;
			line-height: normal;
		}

		.inner-welcome_msg {
			display: flex;
			justify-content: center;
		}

		.maserati-welcome_msg .right-column img {
			max-width: 400px;
		}

		.plugin-update-tr.active td,
		.plugins .active th.check-column {
			border-left: 4px solid var(--azul-mst);
		}

		.wp-core-ui .button,
		.wp-core-ui .button-secondary {
			color: var(--azul-mst);
			border-color: var(--azul-mst);
			background: #f6f7f7;
			border-radius: 0;
		}

		.tablenav .actions select {
			border-radius: 0;
		}

		a {
			color: var(--azul-mst);
		}

		body.login {
			background: black;
		}

		@media screen and (max-width:767px) {
			.maserati-welcome_msg {
				float: left;
				margin-top: 60px;
			}

			.inner-welcome_msg {
				justify-content: center;
				flex-direction: column-reverse;
				text-align: center;
			}

			.maserati-welcome_msg .right-column img {
				max-width: 100%;
			}

			#wpbody {
				padding-top: 0;
			}
		}
	</style>

<?php
}

//Mensaje dashboard

//add_action( 'welcome_panel', 'maserati-welcome_msg' );
//add_action( 'wp_dashboard_setup', 'maserati-welcome_msg' );
add_action('in_admin_header', 'maserati_welcome_msg');
function maserati_welcome_msg()
{
?>

	<div class="maserati-welcome_msg wrap">
		<div class="inner-welcome_msg">
			<div class="left-column">
				<h3><?php _e('Dashboard de Maserati', 'maserati'); ?></h3>
				<p class="about-description"><?php echo __('Maserati es un ejemplo de prestigio, elegancia y el lujo de la industria automotriz.', 'maserati') . '<br>' . __('Sus modelos encarnan el espíritu deportivo y el estilo italiano.', 'maserati'); ?></p>
				<?php printf('<a href="%s" class="button button-primary">' . __('Visita la web de Maserati') . '</a>', home_url('/')); ?>
			</div>
			<div class="right-column">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/maserati-negativo.png" alt="Logo Maserati">
			</div>
		</div>
	</div>
<?php
}



add_action('admin_head', 'remove_submenu');
function remove_submenu()
{
	global $submenu;
	unset($submenu['themes.php'][5]); //Removemos la pestaña para cambiar de temas en apariencias /wp-admin/themes.php
	unset($submenu['themes.php'][15]); //Removemos la pestaña cabecera en apariencias /wp-admin/customize.php?return=%2Fwp-admin%2Fthemes.php&autofocus%5Bcontrol%5D=header_image
	unset($submenu['themes.php'][20]);	//Fondo
}

add_action('admin_head', 'remove_menu_pages');
function remove_menu_pages()
{


	//Woocommerce

	//remove_menu_page('woocommerce');
	remove_submenu_page('woocommerce', 'wc-admin');
	//remove_submenu_page('woocommerce', 'edit.php?post_type=shop_order');
	//remove_submenu_page('woocommerce', 'wc-admin&path=/customers');
	remove_submenu_page('woocommerce', 'coupons-moved');
	remove_submenu_page('woocommerce', 'wc-reports');
	//remove_submenu_page('woocommerce', 'wc-settings');
	remove_submenu_page('woocommerce', 'wc-status');
	remove_submenu_page('woocommerce', 'wc-addons');

	//Menu Escritorio
	remove_submenu_page('index.php', 'update-core.php'); // /wp-admin/update-core.php

	remove_menu_page('link-manager.php');

	//Menu Aperiencia
	remove_submenu_page('themes.php', 'themes.php'); //Removemos la pestaña para cambiar de temas en apariencias /wp-admin/themes.php
	remove_submenu_page('themes.php', 'theme-editor.php');
	remove_submenu_page('themes.php', 'themes.php?page=custom-background');
	remove_submenu_page('themes.php', 'customize.php?return=%2Fwp-admin%2Fwidgets.php');
	remove_submenu_page('themes.php', 'customize.php?return=%2Fwp-admin%2Fwidgets.php&autofocus%5Bcontrol%5D=header_image');
	remove_submenu_page('themes.php', 'customize.php?return=%2Fwp-admin%2Fwidgets.php&autofocus%5Bcontrol%5D=background_image');

	//Menu Plugins
	remove_submenu_page('plugins.php', 'plugin-editor.php');

	remove_submenu_page('widgets.php', 'theme-editor.php');

	remove_menu_page('edit-comments.php');
}




/* PARA DEPURAR MENU ADMIN **/
/*add_action('admin_init', function () {
	echo '<pre>' . print_r($GLOBALS['menu'], true) . '</pre>';
});*/

/* PARA DEPURAR MENU ADMIN **/

//Style Login
function login_css()
{ ?>
	<style type="text/css">
		:root {
			--azul-mst: #1c3775;
			--amarillo-mst: #fbc844;
		}

		#login h1 a,
		.login h1 a {
			background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/maserati-negativo.png);
			height: 65px;
			width: 320px;
			background-size: 320px 65px;
			background-repeat: no-repeat;
			padding-bottom: 30px;
		}

		body.login {
			background: black;
		}

		.login #backtoblog a,
		.login #nav a {
			color: white !important;
		}

		.login #backtoblog a:hover,
		.login #nav a:hover {
			color: var(--amarillo-mst) !important;
		}

		.wp-core-ui .button-primary {
			background: var(--azul-mst) !important;
			border-color: var(--azul-mst) !important;
			color: black;
			border-radius: 0 !important;
		}

		.wp-core-ui .button-primary.focus,
		.wp-core-ui .button-primary.hover,
		.wp-core-ui .button-primary:focus,
		.wp-core-ui .button-primary:hover {
			background: var(--amarillo-mst) !important;
			border-color: var(--amarillo-mst) !important;
		}

		input[type=color],
		input[type=date],
		input[type=datetime-local],
		input[type=datetime],
		input[type=email],
		input[type=month],
		input[type=number],
		input[type=password],
		input[type=search],
		input[type=tel],
		input[type=text],
		input[type=time],
		input[type=url],
		input[type=week],
		select,
		textarea {
			border-radius: 0 !important;
		}

		.language-switcher label .dashicons {
			color: white !important;
		}

		.login .button.wp-hide-pw .dashicons {
			color: var(--azul-mst) !important;
		}
	</style>
<?php }
add_action('login_enqueue_scripts', 'login_css');
