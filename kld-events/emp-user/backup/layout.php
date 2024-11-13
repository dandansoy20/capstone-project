
<!--begin::Main-->

<?php //routing controller

	if($_GET){

		$route = $_GET['page'] ? 'pages/' . $_GET['page'] : 'pages/main';
		

	} else {
		$route = 'pages/main';
	}

?>

			<?php include("header.php"); ?>


			<?php include($route . ".php"); ?>

				<!--Content area here-->
			</div>

			<!--end::Content-->

			<?php include("footer.php"); ?>

<!--end::Main-->