<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include "./control/db.php";
?>
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class=" container ">
			<div class="row">

				<div class="col-xl-4">
					<!--begin::Stats Widget 30-->
					<div class="card card-custom bg-primary card-stretch gutter-b">
						<!--begin::Body-->
						<div class="card-body">

							<span class="svg-icon svg-icon-2x svg-icon-white">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<?php
							$query = "SELECT COUNT(*) FROM emp_acc";
							$result = $conn->query($query);
							$row = $result->fetch_row();
							?>
							<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block"><?php echo $row[0] ?></span>
							<span class="font-weight-bold text-white font-size-sm">Employed Users</span>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Stats Widget 30-->
				</div>
				<div class="col-xl-4">
					<!--begin::Stats Widget 31-->
					<div class="card card-custom bg-info card-stretch gutter-b">
						<!--begin::Body-->
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
										<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
										<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
										<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<?php
							$query = "SELECT COUNT(*) FROM org_tbl";
							$result = $conn->query($query);
							$course_row = $result->fetch_row();
							?>

							<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block"><?php echo $course_row[0] ?></span>
							<span class="font-weight-bold text-white font-size-sm">KLD Offices</span>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Stats Widget 31-->
				</div>
				<div class="col-xl-4">
					<!--begin::Stats Widget 22-->
					<div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-3.svg)">
						<!--begin::Body-->
						<div class="card-body my-4">
							<a href="#" class="card-title font-weight-bolder text-primary font-size-h6 mb-4 text-hover-state-dark d-block">Activated Accounts</a>
							<div class="font-weight-bold text-muted font-size-sm">
								<?php
								// Get the count of active accounts
								$queryActive = "SELECT COUNT(*) FROM emp_acc WHERE status = 'active'";
								$resultActive = $conn->query($queryActive);
								$rowActive = $resultActive->fetch_row();
								$activeCount = $rowActive[0];

								// Get the total number of accounts
								$queryTotal = "SELECT COUNT(*) FROM emp_acc";
								$resultTotal = $conn->query($queryTotal);
								$rowTotal = $resultTotal->fetch_row();
								$totalCount = $rowTotal[0];

								// Calculate the percentage of active accounts
								$percentage = $totalCount > 0 ? number_format(($activeCount / $totalCount) * 100, 2) : 0;
								?>
								<span class="text-dark-75 font-weight-bolder font-size-h2 mr-2"><?php echo $percentage; ?>%</span> Active Accounts
							</div>
							<div class="progress progress-xs mt-7 bg-primary-o-60">
								<div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>

						<!--end::Body-->
					</div>
					<!--end::Stats Widget 22-->
				</div>
			</div>


			<div class="card card-custom gutter-b">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">KLD Employees
							<span class="d-block text-muted pt-2 font-size-sm">Kolehiyong Lungsod ng Dasmarinas</span>
						</h3>
					</div>
					<div class="card-toolbar">
						<!--begin::Button-->
						<a href="?page=add_std" class="btn btn-primary font-weight-bolder">
							<span class="svg-icon svg-icon-md">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
								<i class="icon la la-user-plus"></i>
								<!--end::Svg Icon-->
							</span>Add Employee</a>
						<!--end::Button-->
					</div>
				</div>
				<div class="card-body">
					<!--begin: Search Form-->
					<!--begin::Search Form-->
					<div class="mb-7">
						<div class="row align-items-center">
							<div class="col-12">
								<div class="row align-items-center">
									<div class="col-md-3 my-2 my-md-0">
										<div class="input-icon">
											<input type="text" class="form-control" placeholder="Search..." id="datatable_search2" />
											<span>
												<i class="flaticon2-search-1 text-muted"></i>
											</span>
										</div>
									</div>
									<div class="col-md-3 my-2 my-md-0">
										<div class="d-flex align-items-center">
											<label class="mr-3 mb-0 d-none d-md-block">Program:</label>
											<select class="form-control" id="kt_datatable_org">
												<option value="">All</option>
												<?php
												include('./control/db.php');
												$try = mysqli_query($conn, "Select * from org_tbl");
												while ($row = $try->fetch_array()) {
													echo '<option value="' . $row['org_id'] . '">' . $row['org_name'] . '</option>';
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end::Search Form-->
					<!--end: Search Form-->
					<!--begin: Selected Rows Group Action Form-->
					<div class="mt-10 mb-5 collapse" id="kt_datatable_group_action_form">
						<div class="d-flex align-items-center">
							<div class="font-weight-bold text-danger mr-3">Selected
								<span id="kt_datatable_selected_records">0</span>records:
							</div>
							<div class="dropdown mr-2">
								<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Update status</button>
								<div class="dropdown-menu dropdown-menu-sm">
									<ul class="nav nav-hover flex-column">
										<li class="nav-item">
											<a href="#" class="nav-link">
												<span class="nav-text">Pending</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link">
												<span class="nav-text">Delivered</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link">
												<span class="nav-text">Canceled</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<button class="btn btn-sm btn-danger mr-2" type="button" id="kt_datatable_delete_all">Delete All</button>
						</div>
					</div>
					<!--end: Selected Rows Group Action Form-->
					<!--begin: Datatable-->
					<div class="datatable datatable-bordered datatable-head-custom" id="my_kt_datatable_emp"></div>
					<!--end: Datatable-->
				</div>
			</div>


			<!--begin::Card-->
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->