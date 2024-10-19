<?php //routing controller

if ($_GET) {

	$route = $_GET['page'] ? 'pages/' . $_GET['page'] : 'partials/_content';
} else {
	$route = 'partials/_content';
}

?>
<!--begin::Main-->

<?php include("partials/_header-mobile.php"); ?>
<div class="d-flex flex-column flex-root">
	<!--begin::Page-->
	<div class="d-flex flex-row flex-column-fluid page">
		<!--begin::Wrapper-->
		<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

			<?php include("partials/_header.php"); ?>

			<!--begin::Content-->
			<div class="d-flex flex-row flex-column-fluid container">
				<!--begin::Content Wrapper-->
				<div class="main d-flex flex-column flex-row-fluid">

					<?php include("partials/_subheader.php"); ?>
					<?php include($route . ".php"); ?>
					<!--Content area here-->
				</div>

			</div>

			<!--end::Content-->

			<?php include("partials/_footer/compact.php"); ?>
		</div>

		<!--end::Wrapper-->
	</div>

	<!--end::Page-->
</div>

<!--end::Main-->