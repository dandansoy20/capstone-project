<!--begin::Main-->

<?php //routing controller

if ($_GET) {

	$route = $_GET['page'] ? 'pages/' . $_GET['page'] : 'partials/_content';
} else {
	$route = 'partials/_content';
}

// Get the current page from the URL, default to an empty string if not set
$current_page = isset($_GET['page']) ? $_GET['page'] : '';
$submenu_pages = ['calendar', 'upcoming-events', 'proposal-events', 'completed-events', 'add-events', 'archived-events'];
$submenu_active = in_array($current_page, $submenu_pages);


?>
<?php
$pageTitles = [
	'calendar' => [
		'title' => 'Event Calendar',
		'breadcrumb' => ['Events', 'Event Calendar']
	],
	'upcoming-events' => [
		'title' => 'Upcoming Events',
		'breadcrumb' => ['Events', 'Upcoming Events']
	],
	'proposal-events' => [
		'title' => 'Proposed Events',
		'breadcrumb' => ['Events', 'Proposed Events']
	],
	'completed-events' => [
		'title' => 'Completed Events',
		'breadcrumb' => ['Events', 'Completed Events']
	],
	'add-events' => [
		'title' => 'Add Event',
		'breadcrumb' => ['Events', 'Add Event']
	],
	'archived-events' => [
		'title' => 'Archives',
		'breadcrumb' => ['Events', 'Archives']
	],
	// Add other pages here
];

// Get current page from the URL or default to a specific page
$current_page = $_GET['page'] ?? 'calendar'; // default page is set to calendar
$pageTitle = $pageTitles[$current_page]['title'] ?? 'Default Title';
$breadcrumb = $pageTitles[$current_page]['breadcrumb'] ?? ['Events', 'Default'];
?>


<?php include("partials/_header-mobile.php"); ?>
<div class="d-flex flex-column flex-root">

	<!--begin::Page-->
	<div class="d-flex flex-row flex-column-fluid page">

		<?php include("partials/_aside.php"); ?>

		<!--begin::Wrapper-->
		<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

			<?php include("partials/_header.php"); ?>

			<?php include("partials/_subheader/subheader-v1.php"); ?>
			<!--begin::Content-->
			<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


				<?php include($route . ".php"); ?>

				<!--Content area here-->
			</div>

			<!--end::Content-->

			<?php include("partials/_footer.php"); ?>
		</div>

		<!--end::Wrapper-->
	</div>

	<!--end::Page-->
</div>

<!--end::Main-->