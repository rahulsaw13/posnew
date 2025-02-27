<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url(); ?>" />
	<title><?php echo $this->config->item('company') ?> | POS </title>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo 'dist/bootswatch/' . (empty($this->config->item('theme')) ? 'flatly' : $this->config->item('theme')) . '/bootstrap.min.css' ?>" />

	<?php if ($this->input->cookie('debug') == 'true' || $this->input->get('debug') == 'true') : ?>
		<!-- bower:css -->
		<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css" />
		<link rel="stylesheet" href="bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css" />
		<link rel="stylesheet" href="bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.css" />
		<link rel="stylesheet" href="bower_components/smalot-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-select/dist/css/bootstrap-select.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-table/dist/bootstrap-table.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" href="bower_components/chartist/dist/chartist.min.css" />
		<link rel="stylesheet" href="bower_components/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css" />
		<!-- endbower -->
		<!-- start css template tags -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.autocomplete.css" />
		<link rel="stylesheet" type="text/css" href="css/invoice.css" />
		<link rel="stylesheet" type="text/css" href="css/ospos_print.css" />
		<link rel="stylesheet" type="text/css" href="css/ospos.css" />
		<link rel="stylesheet" type="text/css" href="css/popupbox.css" />
		<link rel="stylesheet" type="text/css" href="css/receipt.css" />
		<link rel="stylesheet" type="text/css" href="css/register.css" />
		<link rel="stylesheet" type="text/css" href="css/reports.css" />
		<!-- link google fonts  -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+DE+Grund:wght@100..400&display=swap" rel="stylesheet">
		<!-- google font ends  -->
		<!-- end css template tags -->
		<!-- bower:js -->
		<script src="bower_components/jquery/dist/jquery.js"></script>
		<script src="bower_components/jquery-form/src/jquery.form.js"></script>
		<script src="bower_components/jquery-validate/dist/jquery.validate.js"></script>
		<script src="bower_components/jquery-ui/jquery-ui.js"></script>
		<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
		<script src="bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
		<script src="bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.js"></script>
		<script src="bower_components/smalot-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<script src="bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
		<script src="bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.js"></script>
		<script src="bower_components/moment/moment.js"></script>
		<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="bower_components/es6-promise/es6-promise.js"></script>
		<script src="bower_components/file-saver/dist/FileSaver.min.js"></script>
		<script src="bower_components/html2canvas/build/html2canvas.js"></script>
		<script src="bower_components/jspdf/dist/jspdf.debug.js"></script>
		<script src="bower_components/jspdf-autotable/dist/jspdf.plugin.autotable.js"></script>
		<script src="bower_components/tableExport.jquery.plugin/tableExport.js"></script>
		<script src="bower_components/chartist/dist/chartist.min.js"></script>
		<script src="bower_components/chartist-plugin-pointlabels/dist/chartist-plugin-pointlabels.min.js"></script>
		<script src="bower_components/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js"></script>
		<script src="bower_components/chartist-plugin-barlabels/dist/chartist-plugin-barlabels.min.js"></script>
		<script src="bower_components/remarkable-bootstrap-notify/bootstrap-notify.js"></script>
		<script src="bower_components/js-cookie/src/js.cookie.js"></script>
		<script src="bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
		<script src="bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
		<!-- endbower -->
		<!-- start js template tags -->
		<script type="text/javascript" src="js/clipboard.min.js"></script>
		<script type="text/javascript" src="js/imgpreview.full.jquery.js"></script>
		<script type="text/javascript" src="js/manage_tables.js"></script>
		<script type="text/javascript" src="js/nominatim.autocomplete.js"></script>
		<!-- end js template tags -->
	<?php else : ?>
		<!--[if lte IE 8]>
		<link rel="stylesheet" media="print" href="dist/print.css" type="text/css" />
		<![endif]-->
		<!-- start mincss template tags -->
		<link rel="stylesheet" type="text/css" href="dist/jquery-ui/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="dist/opensourcepos.min.css?rel=88e63d8098" />
		<!-- end mincss template tags -->

		<!-- Tweaks to the UI for a particular theme should drop here  -->
		<?php if ($this->config->item('theme') != 'flatly' && file_exists($_SERVER['DOCUMENT_ROOT'] . '/public/css/' . $this->config->item('theme') . '.css')) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo 'css/' . $this->config->item('theme') . '.css' ?>" />
		<?php } ?>

		<!-- start minjs template tags -->
		<script type="text/javascript" src="dist/opensourcepos.min.js?rel=5dfe5e6402"></script>
		<!-- end minjs template tags -->
	<?php endif; ?>

	<?php $this->load->view('partial/header_js'); ?>
	<?php $this->load->view('partial/lang_lines'); ?>

	<style type="text/css">
		html,
		body {
			margin: 0;
			padding: 0;
			height: 20px;
			font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
		}

		#footer {
			margin-top: 0em;
		}

		.topbar {
			font-size: 13px;
			position: fixed;
			width: 100%;
			z-index: 1001;
			background-color: #34495e;
			font-family: "Playwrite DE Grund", cursive;
			padding: 5px;
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.navbar-right-container{
			display: flex;
			align-items: center;
			gap: 20px;
		}
		.toggle-container{
			display: flex;
			align-items: center;
		}

		.navbar-right {
			margin-right: 0px;
			text-align: end;
			a {
				color: #afc0e6;
				text-decoration: none;
			}
		}
		.live-clock-class{
			min-width: 150px;
		}

		.navbar-center {
			font-size: 17px;
			font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
			font-weight: 400;
			letter-spacing: 1px;
			word-spacing: 1px;
			height: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			padding-left: 15%;
		}

		.wrapper {
			display: flex;
			height: 100vh;
			transition: margin-left 0.3s ease;
			position: relative;
			padding-top: 18px;
		}

		.main-sidebar {
			width: 220px;
			background-color: #35556b;
			border-top-right-radius: 20px;
			border-bottom-right-radius: 20px;
			position: fixed;
			left: 0;
			top: 47px;
			bottom: 0;
			transform: translateX(-220px);
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			z-index: 1000;
			overflow-y: auto;
		}

		.main-sidebar.active {
			transform: translateX(0);
		}

		.topbar-hamburger-container {
			cursor: pointer;
			margin-left: 10px;
		}

		.topbar-hamburger-button{
			scale: 3 2;
		}

		.content-wrapper {
			flex: 1;
			padding: 16px 16px 0px 16px;
			margin-left: 0;
			transition: margin-left 0.3s ease;
			box-sizing: border-box;
			overflow-x: hidden;
		}

		.main-sidebar {
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.content-wrapper.sidebar-open {
			margin-left: 220px;
		}

		.sidebar-menu {
			list-style-type: none;
			padding: 0;
			margin: 0;
		}

		.sidebar-menu li {
			margin-bottom: 1px;
			border-radius: 10px;
			overflow: hidden;
		}

		.sidebar-menu li a {
			display: block;
			color: #fff;
			text-decoration: none;
			font-size: 16px;
			padding: 10px;
			transition: all 0.3s ease;
		}

		.sidebar-menu li a:hover {
			background-color: #99bfc2;
		}

		.sidebar-menu li img {
			margin-right: 15px;
			margin-left: 10px;
			width: 20px;
			height: auto;
		}

		.sidebar-menu .active a {
			background-color: #8ca9b7;
			border-radius: 11px;
		}

		.sidebar-menu .tooltip {
			display: none;
		}

		.sidebar-menu .sidebar-item {
			display: flex;
			align-items: center;
		}

		.sidebar-menu .submenu {
			display: none;
			list-style-type: none;
			padding-left: 20px;
		}

		.sidebar-menu .submenu.active {
			display: block;
		}

		.sidebar-menu .submenu li {
			margin-bottom: 5px;
		}

		.sidebar-menu .submenu li a {
			background-color: transparent;
		}

		.sidebar-menu .submenu li a:hover {
			background-color: #99bfc2;
		}

		.sidebar-menu .submenu li a.active {
			background-color: #e0e0e0;
		}

		.sidebar-menu .arrow {
			cursor: pointer;
			font-size: 14px;
			margin-right: 10px;
			display: inline-block;
			transition: transform 0.3s;
			color: white;
		}
		.arrow {
        transition: transform 0.3s ease;
		}

		.arrow.rotate {
			transform: rotate(90deg);
		}

		.sidebar-menu .expanded .arrow .submenu {
			display: block;

		}

		.sidebar-item-container {
			display: flex;
			align-items: center;
		}

		.sidebar-item-container a {
			flex: 1;
			text-decoration: none;
		}

		.sidebar-item-container .arrow {
			margin-right: 10px;
		}

		.not-printable {
			display: block;
		}

		.row {
			padding-top: 15px;
		}

		@media print {
			.not-printable {
            display: none;
        }
        .main-sidebar {
				display: none !important;
			}
			.content-wrapper {
				margin-left: 0 !important;
		}
		.wrapper {display: block;
        }
		}

		.logo>img {
			height: 81px;
			padding-top: 14px;
			margin-top: -18px;

		}

		.ml-3 {
			margin-left: 30px;
		}

		.pl-3 {
			padding-left: 30px;
		}

		/* Custom toggle button */
		.switch {
			position: relative;
			display: inline-block;
			width: 3.4em;
			height: 1.75em;
		}

		.control {
			display: none;
		}

		.slider {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			border-radius: 2.125em;
			background-color: #ccc;
			cursor: pointer;
			transition: .4s;
		}

		.slider::before {
			content: "";
			position: absolute;
			height: 1.3em;
			width: 1.3em;
			left: 0em;
			bottom: 0.1em;
			border-radius: 50%;
			background: #fff;
			transition: .4s;
		}

		.control:checked+.switch .slider {
			background: rgba(128, 255, 128, 1);
		}

		.control:checked+.switch .slider::before {
			transform: translateX(1.625em);
		}
		.items-image-wrapper{
			transition: opacity 0.5s ease, visibility 0.5s ease;
		}
	</style>
<script>

	let slug = url => new URL(url).pathname.match(/[^\/]+/g);
	let slug_list = slug(document.location);
	let toggle = false;

	function toggleHandler(){
		toggle = !toggle;
		let toggleValue = localStorage.getItem("toggle");
		if (toggle && toggleValue == 'false') {
				localStorage.setItem("toggle", "true");
				$('#register_wrapper').css({
					'width': '70%',
					'transition': 'width 0.8s ease'
				});
				$('.footer-container').css({
					'width': '57%',
					'transition': 'width 0.5s ease'
				});
				$('#items-image-wrapper').css({
					'display': 'flex',
					'transition': 'display 0.8s ease'
				});
				$('#footer-comment-container').css({
					'display': 'none',
					'transition': 'display 0.8s ease'
				});
				$('.header-dropdown').css({
					'width': '100px',
					'transition': 'width 0.8s ease'
				});
			} 
		else {
				localStorage.setItem("toggle", "false");
				$('#register_wrapper').css({
					'width': '100%',
					'transition': 'width 0.8s ease'
				});
				$('.footer-container').css({
					'width': '99%',
					'transition': 'width 0.5s ease'
				});
				$('#items-image-wrapper').css({
					'display': 'none',
					'transition': 'display 0.8s ease'
				});
				$('#footer-comment-container').css({
					'display': 'block',
					'transition': 'display 0.8s ease'
				});
				$('.header-dropdown').css({
					'width': '220px',
					'transition': 'width 0.8s ease'
				});
		}
	};

// functions required for triggering sidebar using cookie
function getCookie(name) {
    const cookieArr = document.cookie.split(";");

    for (let i = 0; i < cookieArr.length; i++) {
        const cookiePair = cookieArr[i].trim();
        // Check if the cookie name matches
        if (cookiePair.startsWith(name + "=")) {
            return cookiePair.split("=")[1]; // Return the cookie value
        }
    }
    return false; // Return false if cookie not found
}

function setCookie(name, value, hours) {
    const expires = new Date(Date.now() + hours * 3600 * 1000).toUTCString();
    document.cookie = `${name}=${value}; expires=${expires}; path=/`;
}

function deleteCookie(name) {
    // Set the cookie with the same name and an expiration date in the past
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

$(document).ready(function() {
	if (window.location.pathname.includes("/sales")) {
        let toggleValue = localStorage.getItem("toggle");
		if(toggleValue === 'true'){
			$('#loader').css({
				'display': 'flex'
			})
		}
		setTimeout(() => {
			if(toggleValue === 'true'){
				document.getElementById("control").checked = true;
				$('#register_wrapper').css({
					'width': '58%',
					'transition': 'width 0.8s ease'
				});
				$('.footer-container').css({
					'width': '57%',
					'transition': 'width 0.5s ease'
				});
				$('#items-image-wrapper').css({
					'display': 'flex',
					'transition': 'display 0.8s ease'
				});
				$('#footer-comment-container').css({
					'display': 'none',
					'transition': 'display 0.8s ease'
				});
				$('.header-dropdown').css({
					'width': '100px',
					'transition': 'width 0.8s ease'
				});
				$('#loader').css({
				'display': 'none'
				})
			}
		}, 1000);
    }

	/* Reload Sidebar logic start*/
	if (!window.location.pathname.includes("/sales")) {
		var contentWrapper = $('.content-wrapper');
		contentWrapper.addClass('sidebar-open');
	}
	/* Reload Sidebar logic end*/

	// Toggle sidebar visibility
	$('.topbar-hamburger-button').click(function(event) {
		event.stopPropagation(); // Prevent the event from bubbling up
		var sidebar = $('.main-sidebar');
		var contentWrapper = $('.content-wrapper');

		// set or delete the cookie trigger for sidebar
		const currentCookieValue = getCookie("DDcomSideBarTrigger");
		// Modify the cookie value
		if (currentCookieValue) {
			deleteCookie("DDcomSideBarTrigger");
		} else {
			setCookie("DDcomSideBarTrigger", true, 24); // set the cookie as true to hide
		}
		sidebar.toggleClass('active');
		contentWrapper.toggleClass('sidebar-open', sidebar.hasClass('active'));
	});

	// Prevent automatic closing of sidebar when clicking outside
	$(document).click(function(event) {
		if (!$('.main-sidebar').hasClass('active')) return;
		if ($(event.target).closest('.main-sidebar').length) return;
	});

	// Prevent click events from bubbling up to the document when clicking inside the sidebar
	$('.main-sidebar').click(function(event) {
		event.stopPropagation();
	});

	// Toggle submenu visibility on arrow click
	$('.arrow').click(function(event) {
		event.stopPropagation(); 
		var parentLi = $(this).closest('li');
		parentLi.toggleClass('expanded');
		parentLi.find('.submenu').slideToggle(300); // Slide toggle submenu
		// Rotate the arrow
		$(this).toggleClass('rotate'); // Add this line
	});

	// Prevent module link from expanding submenu
	$('.sidebar-menu > li > a').click(function(event) {
		var parentLi = $(this).closest('li');
		if (parentLi.hasClass('expanded')) {
			parentLi.removeClass('expanded');
			parentLi.find('.submenu').slideUp(300); // Slide up submenu if expanded
		} else {
			$('.sidebar-menu li').removeClass('expanded').find('.submenu').slideUp(300); // Collapse all others
			parentLi.addClass('expanded');
			parentLi.find('.submenu').slideDown(300); // Slide down the current submenu
		}
		event.preventDefault(); 
	});
	// Handle active state for submenu links
	$('.submenu-link').click(function(event) {
		$('.submenu-link').removeClass('active');
		$(this).addClass('active');
	});
	});

	</script>



	<!-- fontAwesome kit  -->
	<script src="https://kit.fontawesome.com/ffc0c5977c.js" crossorigin="anonymous"></script>

</head>

<body>

	<div class="topbar">
		<div class="topbar-hamburger-container">
			<span class="glyphicon glyphicon-menu-hamburger topbar-hamburger-button"></span>
		</div>

		<div class="navbar-center">
			<a href="#">
				<span class="logo">
					<strong><?php echo $this->config->item('company'); ?></strong>
				</span>
			</a>
		</div>

		<div class="navbar-right-container">
			<div class="navbar-right">
				<?php echo anchor('home/change_password/' . $user_info->person_id, $user_info->first_name . ' ' . $user_info->last_name, array('class' => 'modal-dlg', 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('employees_change_password'))); ?>
				<?php echo '  |  ' . ($this->input->get('debug') == 'true' ? $this->session->userdata('session_sha1') . '  |  ' : ''); ?>
				<a href="javascript:void(0);" id="logout"><?php echo $this->lang->line('login_logout'); ?></a>
				<div id="liveclock" class="live-clock-class"><?php echo date($this->config->item('dateformat') . ' ' . $this->config->item('timeformat')) ?></div>
			</div>
			<div class="toggle-container">
				<input id='control' class='control' type="checkbox">
				<label class="switch" for='control' onclick="toggleHandler();" role="button">
				<output class="slider" for='control'></output>
				</label>
			</div>
		</div>
	</div>

	<?php
		$sidebarTrigger = $this->input->cookie('DDcomSideBarTrigger', TRUE);
		// Code Added by kevin 29 Dec 2024 
		$slugs = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
		if(in_array('sales',$slugs) && $slugs[3] == 'sales'){
			$active = '';
		} else {
			$active = 'active';
		}
	?>
	<div class="wrapper">
		<aside class="main-sidebar <?php echo empty($active) ? $active : "active"; ?> not-printable">
		<!-- <aside class="main-sidebar <?php //echo $sidebarTrigger?"":"active";?> not-printable"> -->
			<section class="sidebar">
				<ul class="sidebar-menu">
					<?php foreach ($allowed_modules as $module) : ?>
						<li class="<?php echo $module->module_id == $this->uri->segment(1) ? 'active expanded' : ''; ?>" data-module-id="<?php echo $module->module_id; ?>">
							<div class="sidebar-item-container">
								<!-- Arrow icon for toggling submenu -->
								<a href="<?php echo site_url("$module->module_id"); ?>" title="<?php echo $this->lang->line("module_" . $module->module_id); ?>" class="nav-link">
									<div class="sidebar-item">
										<img src="<?php echo base_url() . 'images/menubar/' . $module->module_id . '.png'; ?>" border="0" alt="Module Icon" />
										<?php echo $this->lang->line("module_" . $module->module_id) ?>
									</div>
								</a>
								<?php if (in_array($module->module_id, ['receivings', 'sales'])) : ?>
									<span class="arrow">&#9654;</span>
								<?php endif; ?>
							</div>
							<?php if ($module->module_id == 'receivings' || $module->module_id == 'sales') : ?>
								<!-- Submenu for modules with submodules -->
								<ul class="submenu">
									<?php if ($module->module_id == 'receivings') : ?>
										<li><a href="reports/detailed_receivings"><span class="pl-3"> <?php echo $this->lang->line("module_detailed_report") ?></span></a></li>
									<?php elseif ($module->module_id == 'sales') : ?>
										<li><a href="reports/detailed_sales"><span class="pl-3"> <?php echo $this->lang->line("module_detailed_report") ?></span></a></li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</section>
		</aside>

		<div class="overlay"></div>

		<div class="content-wrapper <?php echo empty($active) ? $active : "active"; ?> ">
		<!-- <div class="content-wrapper <? //= $sidebarTrigger ? "" : "sidebar-open" ?>"> -->
			<div class="row">