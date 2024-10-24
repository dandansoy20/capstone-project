<!DOCTYPE html>

<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!--begin::Head-->

<head>
	<base href="">
	<meta charset="utf-8" />
	<title>KLD Events | Student</title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://preview.keenthemes.com/metronic/demo1/index.html" />

	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

	<!--end::Fonts-->

	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />

	<link href="assets/css/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles-->

	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

	<!--end::Global Theme Styles-->

	<!--begin::Layout Themes(used by all pages)-->

	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="assets/media/logos/kldlogo.png" />
</head>

<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed subheader-enabled page-loading">

	<?php include("partials/_page-loader.php"); ?>

	<?php include("layout.php"); ?>

	<?php include("partials/_extras/offcanvas/quick-user.php"); ?>

	<?php include("partials/_extras/offcanvas/quick-panel.php"); ?>

	<?php include("partials/_extras/scrolltop.php"); ?>
	<script>
		var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
	</script>

	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1200
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#0f6c29",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#F3F6F9",
						"dark": "#212121"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1E9FF",
						"secondary": "#ECF0F3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#212121",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#ECF0F3",
					"gray-300": "#E5EAEE",
					"gray-400": "#D6D6E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#80808F",
					"gray-700": "#464E5F",
					"gray-800": "#1B283F",
					"gray-900": "#212121"
				}
			},
			"font-family": "Poppins"
		};
	</script>

	<!--end::Global Config-->

	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>

	<!--end::Global Theme Bundle-->

	<!--begin::Page Vendors(used by this page)-->
	<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>

	<!--end::Page Vendors-->

	<!--begin::Page Scripts(used by this page)-->
	<script src="assets/js/pages/widgets.js"></script>

	<script src="assets/js/pages/custom/wizard/wizard-1.js"></script>
	<script src="assets/js/pages/custom/wizard/wizard-2.js"></script>

	<script src="assets/js/pages/widgets.js"></script>
	<script src="assets/js/pages/custom/profile/profile.js"></script>

	<script src="assets/js/pages/features/calendar/external-events.js"></script>
	<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js"></script>
	<script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
	<script src="assets/js/pages/crud/file-upload/dropzonejs.js"></script>
	<script src="assets/plugins/custom/uppy/uppy.bundle.js"></script>
	<script src="assets/js/pages/crud/file-upload/uppy.js"></script>

	<script src="assets/js/pages/crud/forms/widgets/form-repeater.js"></script>
	<!--end::Page Scripts-->
</body>

<!--end::Body-->

</html>