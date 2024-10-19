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

				<div class="col-xl-3">
					<!--begin::Stats Widget 30-->
					<div class="card card-custom bg-success card-stretch gutter-b">
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
							<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">324</span>
							<span class="font-weight-bold text-white font-size-sm">Student Users</span>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Stats Widget 30-->
				</div>
				<div class="col-xl-3">
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
							<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">43</span>
							<span class="font-weight-bold text-white font-size-sm">Student Events</span>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Stats Widget 31-->
				</div>
				<div class="col-xl-6">
					<!--begin::Stats Widget 22-->
					<div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-3.svg)">
						<!--begin::Body-->
						<div class="card-body my-4">
							<a href="#" class="card-title font-weight-bolder text-primary font-size-h6 mb-4 text-hover-state-dark d-block">Activated Accounts</a>
							<div class="font-weight-bold text-muted font-size-sm">
								<span class="text-dark-75 font-weight-bolder font-size-h2 mr-2">76%</span>Avarage
							</div>
							<div class="progress progress-xs mt-7 bg-primary-o-60">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 76%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Stats Widget 22-->
				</div>
			</div>

			<div class="card card-custom gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0 py-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">All Students</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">Kolehiyo ng Lungsod ng Dasmariñas</span>
					</h3>
					<div class="card-toolbar">
						<a href="?page=add-std" class="btn btn-primary font-weight-bolder font-size-sm">
							<span class="svg-icon svg-icon-md svg-icon-white">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>Add New Student</a>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-0">
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
							<thead>
								<tr class="text-left">
									<th class="pl-0" style="width: 20px">
										<label class="checkbox checkbox-lg checkbox-inline">
											<input type="checkbox" value="1" />
											<span></span>
										</label>
									</th>
									<th class="pr-0" style="width: 50px">Student</th>
									<th style="min-width: 200px"></th>
									<th style="min-width: 150px">Email</th>
									<th style="min-width: 150px">Program</th>
									<th style="min-width: 150px">Section</th>
									<th style="min-width: 150px">Status</th>
									<th class="pr-0 text-right" style="min-width: 150px">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$try = mysqli_query($conn, "SELECT 
									std_acc.*, 
									course_tbl.course_acronym, 
									section_tbl.section_name, 
									yearlvl_tbl.yearlvl_name 
								FROM 
									std_acc 
								JOIN 
									course_tbl ON std_acc.course_id = course_tbl.course_id 
								JOIN 
									section_tbl ON std_acc.section_id = section_tbl.section_id 
								JOIN 
									yearlvl_tbl ON std_acc.yearlvl = yearlvl_tbl.yearlvl_id");
								while ($row = $try->fetch_array()) {


									echo '<td class="pl-0">
									<label class="checkbox checkbox-lg checkbox-inline">
										<input type="checkbox" value="' . $row['std_id'] . '" />
										<span></span>
									</label>
								</td>';

									echo '<td class="pr-0">
									<div class="symbol symbol-50 symbol-light mt-1">
										<span class="symbol-label">
											<img src="' . $row['std_profilepic'] . '" class="h-75 align-self-end" alt="" onerror="this.onerror=null; this.src="assets/default.jpg" />
										</span>
									</div>
								</td>

									';


									echo '<td class="pl-0">

									<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $row['std_fname'] . ' ' . $row['std_lname'] . '</a>
									<span class="text-muted font-weight-bold text-muted d-block">' . $row['std_kld_id'] . '</span>
								</td>

								';

									echo '<td>
									<span class="text-muted font-weight-bold">' . $row['std_kld_email'] . '</span>
								</td>
								';
									echo '<td>
									<span class="text-dark-75 font-weight-bolder d-block font-size-lg">' . $row['course_acronym'] . '</span>
									<span class="text-muted font-weight-bold">' . $row['yearlvl_name'] . '</span>
								</td>

								';

									echo '<td>
									<span class="text-dark-75 font-weight-bolder d-block font-size-lg">' . $row['section_name'] . '</span>
								</td>
								';
									$status = strtoupper($row['status']);
									$label_class = $row['status'] == 'active' ? 'label-light-primary' : 'label-light-danger';
									echo '<td>
									 <span class="label label-lg ' . $label_class . ' label-inline">' . $status . '</span>
								</td>
								';
									echo '<td class="pr-0 text-right">
									<a href="?page=overview-std&id=' . $row['std_id'] . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
										<span class="svg-icon svg-icon-md svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</a>
									<a href="?page=edit-std&id=' . $row['std_id'] . '" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
										<span class="svg-icon svg-icon-md svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
													<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</a>
									<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
										<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Hidden.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<title>Stockholm-icons / General / Hidden</title>
											<desc>Created with Sketch.</desc>
											<defs/>
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M19.2078777,9.84836149 C20.3303823,11.0178941 21,12 21,12 C21,12 16.9090909,18 12,18 C11.6893441,18 11.3879033,17.9864845 11.0955026,17.9607365 L19.2078777,9.84836149 Z" fill="#000000" fill-rule="nonzero"/>
												<path d="M14.5051465,6.49485351 L12,9 C10.3431458,9 9,10.3431458 9,12 L5.52661464,15.4733854 C3.75006453,13.8334911 3,12 3,12 C3,12 5.45454545,6 12,6 C12.8665422,6 13.7075911,6.18695134 14.5051465,6.49485351 Z" fill="#000000" fill-rule="nonzero"/>
												<rect fill="#000000" opacity="0.3" transform="translate(12.524621, 12.424621) rotate(-45.000000) translate(-12.524621, -12.424621) " x="3.02462111" y="11.4246212" width="19" height="2"/>
											</g>
										</svg><!--end::Svg Icon--></span>


											<!--end::Svg Icon-->
										</span>
									</a>
								</td>
								</tr>
								';
								}
								?>
							</tbody>
						</table>
					</div>
					<!--end::Table-->
				</div>
				<!--end::Body-->
			</div>


			<!--begin::Card-->
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->