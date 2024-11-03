<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-1">
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-1 mr-5"><?php echo htmlspecialchars($pageTitle); ?></h5>
				<!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<?php foreach ($breadcrumb as $crumb): ?>
						<li class="breadcrumb-item">
							<a href="" class="text-muted"><?php echo htmlspecialchars($crumb); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
				<!--end::Breadcrumb-->
			</div>

			<!--end::Page Heading-->
		</div>
		<!--end::Info-->
		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">
			<!--begin::Actions-->
			<a href="javascript:history.back()" class="btn btn-light-primary font-weight-bolder btn-sm">Back</a>
			<!--end::Actions-->
		</div>
		<!--end::Toolbar-->
	</div>
</div>