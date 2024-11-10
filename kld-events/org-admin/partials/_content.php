<?php
include('./control/db.php');
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

?>
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class=" container ">

		<!--begin::Dashboard-->
		<!--begin::Row Contents-->

		<div class="row">
			<div class="col-xl-4">

				<!--begin::Engage Widget 2-->
				<div class="card card-custom card-stretch gutter-b">
					<div class="card-body d-flex p-0">
						<div class="flex-grow-1 bg-danger p-8 card-rounded flex-grow-1 bgi-no-repeat" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 70%; background-image: url(assets/media/svg/humans/custom-3.svg)">

							<h4 class="text-inverse-danger mt-2 font-weight-bolder">Good day, Regals!</h4>

							<p class="text-inverse-danger my-6">
								Are you ready to create a new<br>and exciting KLD Events.
							</p>

							<a href="?page=add-events" class="btn btn-warning font-weight-bold py-2 px-6">Create Event</a>
						</div>
					</div>
				</div>
				<!--end::Engage Widget 2-->
			</div>

			<div class="col-xl-4">
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body d-flex align-items-center py-0 mt-8">
						<div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
							<a href="?page=profile&id=<?php echo $_SESSION['kld_id']; ?>"
								class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">Hello, <?php echo $_SESSION['kld_fname'] ?></a>
							<span class="font-weight-bold text-muted  font-size-lg"><?php echo $_SESSION['kld_org_role'] ?></span>

							<span class="font-weight-normal text-muted  font-size-lg"><?php echo $_SESSION['kld_org_name'] ?></span>
						</div>
						<div class="symbol symbol-circle symbol-lg-100">
							<img src="<?php echo !empty($_SESSION['kld_profile']) ? $_SESSION['kld_profile'] : 'assets/default.jpg'; ?>" alt="" />

						</div>
					</div>
					<!--end::Body-->
				</div>
			</div>

			<div class="col-xl-4">
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body d-flex align-items-center py-0 mt-8">
						<div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
							<a href="?page=profile&id=<?php echo $_SESSION['kld_id']; ?>"
								class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">Hello, <?php echo $_SESSION['kld_fname'] ?></a>
							<span class="font-weight-bold text-muted  font-size-lg"><?php echo $_SESSION['kld_org_role'] ?></span>

							<span class="font-weight-normal text-muted  font-size-lg"><?php echo $_SESSION['kld_org_name'] ?></span>
						</div>
						<div class="symbol symbol-circle symbol-lg-100">
							<img src="<?php echo !empty($_SESSION['kld_profile']) ? $_SESSION['kld_profile'] : 'assets/default.jpg'; ?>" alt="" />

						</div>
					</div>
					<!--end::Body-->
				</div>
			</div>
		</div>
		<!--Begin::Row-->
		<div class="row">
			<div class="col-xl-4">
				<!--begin::Stats Widget 13-->
				<a href="?page=upcoming-events" class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						<div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">Upcoming Events</div>
						<div class="font-weight-bold text-inverse-primary font-size-sm">
							<?php
							$try = mysqli_query($conn, "SELECT COUNT(status) FROM `kld_event` where status = 'upcoming' and event_org_id = '{$_SESSION['kld_org']}'");
							while ($row = $try->fetch_array()) {
								echo $row[0];
							}
							?>
						</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 13-->
			</div>
			<div class="col-xl-4">
				<!--begin::Stats Widget 14-->
				<a href="?page=proposal-events&id=<?php echo $_SESSION['kld_id']; ?>" class="card card-custom bg-warning bg-hover-state-warning card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
									<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						<div class="text-inverse-warning font-weight-bolder font-size-h5 mb-2 mt-5">In Process</div>
						<div class="font-weight-bold text-inverse-primary font-size-sm">
							<?php
							$try = mysqli_query($conn, "SELECT COUNT(status) FROM `kld_event` where status = 'pending' and event_org_id = '{$_SESSION['kld_org']}'");
							while ($row = $try->fetch_array()) {
								echo $row[0];
							}
							?>
						</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 14-->
			</div>
			<div class="col-xl-4">
				<!--begin::Stats Widget 15-->
				<a href="?page=completed-events" class="card card-custom bg-success bg-hover-state-success card-stretch gutter-b">
					<!--begin::Body-->
					<div class="card-body">
						<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
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
						<div class="text-inverse-success font-weight-bolder font-size-h5 mb-2 mt-5">Completed Events</div>
						<div class="font-weight-bold text-inverse-success font-size-sm">
							<?php
							$try = mysqli_query($conn, "SELECT COUNT(status) FROM `kld_event` where status = 'completed' and event_org_id = '{$_SESSION['kld_org']}'");
							while ($row = $try->fetch_array()) {
								echo $row[0];
							}
							?>
						</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 15-->
			</div>
		</div>
		<!--End::Row-->
		<!--end::Row-->

		<!--Begin::Row-->
		<div class="row">
			<div class="col-xl-6">
				<!--begin::Base Table Widget 10-->
				<div class="card card-custom gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Upcoming Events</span>
							<span class="text-muted mt-3 font-weight-bold font-size-sm">Next Event is in
								<span class="text-primary">9 days</span></span>
						</h3>
						<div class="card-toolbar">
							<ul class="nav nav-pills nav-pills-sm nav-dark-75">
								<li class="nav-item">
									<a class="nav-link py-2 px-4 font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10_1">Tomorrow</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-2 px-4 active font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10_2">Today</a>
								</li>
							</ul>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->


					<?php
					include('./control/db.php');

					$try = mysqli_query(
						$conn,
						"SELECT 
								stakeholder_tbl.*,
								venue_tbl.venue_name,
								venue_tbl.venue_id,
								venue_tbl.venue_desc,
								kld_event.event_id,
								kld_event.event_title,
								kld_event.event_desc,
								org_tbl.org_name,
								kld_event.event_start_date,
								kld_event.event_end_date,
								kld_event.event_poster,
								category_tbl.category_name,
								category_tbl.category_desc
							FROM `kld_event`
							LEFT JOIN stakeholder_tbl ON kld_event.event_id = stakeholder_tbl.event_id
							LEFT JOIN venue_tbl ON kld_event.venue_id = venue_tbl.venue_id
							LEFT JOIN org_tbl ON kld_event.event_org_id = org_tbl.org_id
							LEFT JOIN category_tbl ON kld_event.category_id = category_tbl.category_id
							WHERE kld_event.status = 'upcoming' and kld_event.event_org_id = '{$_SESSION['kld_org']}'"
					);
					?>

					<div class="card-body pt-2 pb-0 mt-n3">
						<div class="tab-content mt-5" id="myTabTables10">
							<div class="tab-pane fade" id="kt_tab_pane_10_1" role="tabpanel" aria-labelledby="kt_tab_pane_10_1">
								<!--begin::Table-->
								<div class="table-responsive">
									<table class="table table-borderless table-vertical-center">
										<!--begin::Thead-->
										<thead>
											<tr>
												<th class="p-0 w-50px"></th>
												<th class="p-0 w-100 min-w-200px"></th>
												<th class="p-0"></th>
												<th class="p-0 min-w-130px w-100"></th>
											</tr>
										</thead>
										<!--end::Thead-->

										<!--begin::Tbody-->
										<?php
										while ($row = $try->fetch_array()) {

											$event_title = $row['event_title'];
											$org_name = $row['org_name'] ?? 'KLD Events';
											$event_date = $row['event_start_date'];
											$venue_name = $row['venue_name'];
											$event_poster = base64_decode($row["event_poster"]) ?? " ";
											echo '
										<tbody>
											<tr>
												<td class="pl-0 py-5">
													<div class="symbol symbol-45 symbol-light-info mr-2">
														<div class="symbol symbol-70 symbol-2by3 mr-3">
															<div class="symbol-label" style="background-image: url(' . $event_poster . ')"></div>
														</div>
													</div>
												</td>
												<td class="pl-0">
													<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $event_title . '</a>
													<span class="text-muted font-weight-bold d-block">' . $org_name . '</span>
												</td>
												<td></td>
												'; ?>
											<?php
											// Assuming $event_date is in 'YYYY-MM-DD HH:MM:SS' format
											$datetime = new DateTime($event_date);
											$formatted_date = $datetime->format('F d, Y'); // Formats to 'October 02, 2024'
											$formatted_time = $datetime->format('g:i A');  // Formats to '9:34 PM'
											?><?php
												echo '
												<td class="text-left">
													<span class="text-dark-75 font-weight-bolder d-block font-size-lg">' . $formatted_date . '</span>
													<span class="text-muted font-weight-bold d-block font-size-sm">' . $formatted_time . '</span>
												</td>

												<td class="text-right pr-0">
													<a href="?page=upcoming-event&event_id=<?php echo $eventId ?>" class="btn btn-icon btn-light btn-sm">
														<span class="svg-icon svg-icon-md svg-icon-success">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																	<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</a>
												</td>
											</tr>
											
										</tbody>
										';
											}
												?>
											<!--end::Tbody-->
									</table>
								</div>
								<!--end::Table-->
							</div>

							<div class="tab-pane fade show active" id="kt_tab_pane_10_2" role="tabpanel" aria-labelledby="kt_tab_pane_10_2">
								<!--begin::Table-->
								<div class="table-responsive">
									<table class="table table-borderless table-vertical-center">
										<!--begin::Thead-->
										<thead>
											<tr>
												<th class="p-0 w-50px"></th>
												<th class="p-0 w-100 min-w-200px"></th>
												<th class="p-0"></th>
												<th class="p-0 min-w-130px w-100"></th>
											</tr>
										</thead>
										<!--end::Thead-->

										<!--begin::Tbody-->
										<?php
										while ($row = $try->fetch_array()) {

											$event_title = $row['event_title'];
											$org_name = $row['org_name'] ?? 'KLD Events';
											$event_date = $row['event_start_date'];
											$venue_name = $row['venue_name'];
											$event_poster = base64_decode($row["event_poster"]) ?? " ";
											echo '
										<tbody>
											<tr>
												<td class="pl-0 py-5">
													<div class="symbol symbol-45 symbol-light-info mr-2">
														<div class="symbol symbol-70 symbol-2by3 mr-3">
															<div class="symbol-label" style="background-image: url(' . $event_poster . ')"></div>
														</div>
													</div>
												</td>
												<td class="pl-0">
													<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $event_title . '</a>
													<span class="text-muted font-weight-bold d-block">' . $org_name . '</span>
												</td>
												<td></td>
												'; ?>
											<?php
											// Assuming $event_date is in 'YYYY-MM-DD HH:MM:SS' format
											$datetime = new DateTime($event_date);
											$formatted_date = $datetime->format('F d, Y'); // Formats to 'October 02, 2024'
											$formatted_time = $datetime->format('g:i A');  // Formats to '9:34 PM'
											?><?php
												echo '
												<td class="text-left">
													<span class="text-dark-75 font-weight-bolder d-block font-size-lg">' . $formatted_date . '</span>
													<span class="text-muted font-weight-bold d-block font-size-sm">' . $formatted_time . '</span>
												</td>

												<td class="text-right pr-0">
													<a href="?page=upcoming-event&event_id=<?php echo $eventId ?>" class="btn btn-icon btn-light btn-sm">
														<span class="svg-icon svg-icon-md svg-icon-success">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																	<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</a>
												</td>
											</tr>
											
										</tbody>
										';
											}
												?>
											<!--end::Tbody-->
									</table>
								</div>
								<!--end::Table-->
							</div>

							<!--begin::Tap pane-->
							<div class="alert alert-custom alert-primary" role="alert">
								<div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
								<div class="alert-text">No Upcoming Event Today!</div>
							</div>
							<!--end::Tap pane-->
						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Base Table Widget 10-->
			</div>

			<div class="col-xl-6">
				<!--begin::Advance Table Widget 2-->
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Pending Events</span>
							<span class="text-muted mt-3 font-weight-bold font-size-sm">List of pending events</span>
						</h3>
						<div class="card-toolbar">
							<ul class="nav nav-pills nav-pills-sm nav-dark-75">

								<li class="nav-item">
									<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_11_2">Approved</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_11_3">Pending Approval</a>
								</li>
							</ul>
						</div>
					</div>
					<!--end::Header-->

					<!--begin::Body-->
					<div class="card-body pt-2 pb-0 mt-n3">
						<div class="tab-content mt-5" id="myTabTables11">


							<!--begin::Tap pane-->
							<div class="tab-pane fade" id="kt_tab_pane_11_2" role="tabpanel" aria-labelledby="kt_tab_pane_11_2">
								<!--begin::Table-->
								<div class="table-responsive">
									<table class="table table-borderless table-vertical-center">
										<thead>
											<tr>
												<th class="p-0 w-60px"></th>
												<th class="p-0 min-w-250px"></th>
												<th class="p-0 min-w-150px"></th>
											</tr>
										</thead>
										<?php
										include('./control/db.php');
										$adminId = $_SESSION['kld_id'];

										$try = mysqli_query(
											$conn,
											"SELECT 
												stakeholder_tbl.*,
												venue_tbl.venue_name,
												venue_tbl.venue_id,
												venue_tbl.venue_desc,
												kld_event.event_id,
												kld_event.event_title,
												kld_event.event_desc,
												org_tbl.org_name,
												kld_event.event_start_date,
												kld_event.event_end_date,
												kld_event.event_poster,
												category_tbl.category_name,
												category_tbl.category_desc
											FROM `kld_event`
											LEFT JOIN stakeholder_tbl ON kld_event.event_id = stakeholder_tbl.event_id
											LEFT JOIN venue_tbl ON kld_event.venue_id = venue_tbl.venue_id
											LEFT JOIN org_tbl ON kld_event.event_org_id = org_tbl.org_id
											LEFT JOIN category_tbl ON kld_event.category_id = category_tbl.category_id
											WHERE kld_event.status = 'pending' AND stakeholder_tbl.status = 'approved' AND stakeholder_tbl.org_acc_id = $adminId
											ORDER BY `kld_event`.`event_start_date` DESC LIMIT 3"
										);



										while ($row = $try->fetch_array()) {

											$event_title = $row['event_title'];
											$org_name = $row['org_name'] ?? 'KLD Events';
											$event_date = $row['event_start_date'];
											$venue_name = $row['venue_name'];
											$event_poster = base64_decode($row["event_poster"]) ?? " ";

											echo '

										<tbody>
											<tr>
												<td class="pl-0 py-4">
													<div class="symbol symbol-45 symbol-light-info mr-2">
														<div class="symbol symbol-70 symbol-2by3 mr-3">
															<div class="symbol-label" style="background-image: url(' . $event_poster . ')"></div>
														</div>
													</div>
												</td>
												<td class="pl-0">
													<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $event_title . '</a>
													'; ?>
											<?php
											// Assuming $event_date is in 'YYYY-MM-DD HH:MM:SS' format
											$datetime = new DateTime($event_date);
											$formatted_date = $datetime->format('F d, Y'); // Formats to 'October 02, 2024'
											?>
										<?php
											echo '
													<div>
														<span class="font-weight-bolder">Date: </span>
														<a class="text-muted font-weight-bold text-hover-primary" href="#">' . $formatted_date . ' </a>
													</div>

													<div>
														<span class="font-weight-bolder">Venue: </span>
														<a class="text-muted font-weight-bold text-hover-primary" href="#">' . $venue_name . '</a>
													</div>
												</td>
												<td class="text-right pr-0">
													<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
														<span class="svg-icon svg-icon-md svg-icon-primary"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<title>Stockholm-icons / General / Settings-1</title>
																<desc>Created with Sketch.</desc>
																<defs></defs>
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
																	<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
																</g>
															</svg><!--end::Svg Icon--></span> </a>
													<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
														<span class="svg-icon svg-icon-md svg-icon-primary"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Write.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<title>Stockholm-icons / Communication / Write</title>
																<desc>Created with Sketch.</desc>
																<defs></defs>
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
																	<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
																</g>
															</svg><!--end::Svg Icon--></span> </a>

												</td>
											</tr>

										</tbody>
										';
										} ?>
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->


							<!--begin::Tap pane-->
							<div class="tab-pane fade show active" id="kt_tab_pane_11_3" role="tabpanel" aria-labelledby="kt_tab_pane_11_3">
								<!--begin::Table-->
								<div class="table-responsive">
									<table class="table table-borderless table-vertical-center">
										<thead>
											<tr>
												<th class="p-0 w-60px"></th>
												<th class="p-0 min-w-250px"></th>
												<th class="p-0 min-w-150px"></th>
											</tr>
										</thead>
										<?php
										include('./control/db.php');
										$adminId = $_SESSION['kld_id'];

										$try = mysqli_query(
											$conn,
											"SELECT 
												stakeholder_tbl.*,
												venue_tbl.venue_name,
												venue_tbl.venue_id,
												venue_tbl.venue_desc,
												kld_event.event_id,
												kld_event.event_title,
												kld_event.event_desc,
												org_tbl.org_name,
												kld_event.event_start_date,
												kld_event.event_end_date,
												kld_event.event_poster,
												category_tbl.category_name,
												category_tbl.category_desc
											FROM `kld_event`
											LEFT JOIN stakeholder_tbl ON kld_event.event_id = stakeholder_tbl.event_id
											LEFT JOIN venue_tbl ON kld_event.venue_id = venue_tbl.venue_id
											LEFT JOIN org_tbl ON kld_event.event_org_id = org_tbl.org_id
											LEFT JOIN category_tbl ON kld_event.category_id = category_tbl.category_id
											WHERE kld_event.status = 'pending' AND stakeholder_tbl.status = 'pending' AND stakeholder_tbl.org_acc_id = $adminId
											ORDER BY `kld_event`.`event_start_date` DESC LIMIT 3"
										);



										while ($row = $try->fetch_array()) {

											$event_title = $row['event_title'];
											$org_name = $row['org_name'] ?? 'KLD Events';
											$event_date = $row['event_start_date'];
											$venue_name = $row['venue_name'];
											$event_poster = base64_decode($row["event_poster"]) ?? " ";

											echo '

										<tbody>
											<tr>
												<td class="pl-0 py-4">
													<div class="symbol symbol-45 symbol-light-info mr-2">
														<div class="symbol symbol-70 symbol-2by3 mr-3">
															<div class="symbol-label" style="background-image: url(' . $event_poster . ')"></div>
														</div>
													</div>
												</td>
												<td class="pl-0">
													<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $event_title . '</a>
													'; ?>
											<?php
											// Assuming $event_date is in 'YYYY-MM-DD HH:MM:SS' format
											$datetime = new DateTime($event_date);
											$formatted_date = $datetime->format('F d, Y'); // Formats to 'October 02, 2024'
											?>
										<?php
											echo '
													<div>
														<span class="font-weight-bolder">Date: </span>
														<a class="text-muted font-weight-bold text-hover-primary" href="#">' . $formatted_date . ' </a>
													</div>

													<div>
														<span class="font-weight-bolder">Venue: </span>
														<a class="text-muted font-weight-bold text-hover-primary" href="#">' . $venue_name . '</a>
													</div>
												</td>
												<td class="text-right pr-0">
													<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
														<span class="svg-icon svg-icon-md svg-icon-primary"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<title>Stockholm-icons / General / Settings-1</title>
																<desc>Created with Sketch.</desc>
																<defs></defs>
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
																	<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
																</g>
															</svg><!--end::Svg Icon--></span> </a>
													<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
														<span class="svg-icon svg-icon-md svg-icon-primary"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Write.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<title>Stockholm-icons / Communication / Write</title>
																<desc>Created with Sketch.</desc>
																<defs></defs>
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
																	<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
																</g>
															</svg><!--end::Svg Icon--></span> </a>

												</td>
											</tr>

										</tbody>
										';
										} ?>
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Tap pane-->
						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Advance Table Widget 2-->
			</div>



		</div>
		<!--End::Row-->
		<!--end::Dashboard-->
	</div>
	<!--end::Container-->
</div>


<!--end::Entry-->