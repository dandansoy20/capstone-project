<?php
// Include the database connection
include('./control/db.php');

// Check if the 'event_id' parameter exists in the URL
if (isset($_GET['event_id'])) {
	$eventId = $_GET['event_id'];

	// Prepare the SQL statement to fetch events for the specific event ID
	$query = "SELECT 
                kld_event.*, 
                org_tbl.org_name, 
				org_tbl.org_pic,
                category_tbl.category_name,
                venue_tbl.venue_name

              FROM 
                kld_event 
			LEFT JOIN 
				venue_tbl ON kld_event.venue_id = venue_tbl.venue_id 
			LEFT JOIN 
				category_tbl ON kld_event.category_id = category_tbl.category_id 
			LEFT JOIN 
				org_tbl ON kld_event.event_org_id = org_tbl.org_id  -- Join to get org_name
			WHERE 
				kld_event.event_id = ?";

	// Prepare the SQL statement
	if ($stmt = $conn->prepare($query)) {
		// Bind the parameter
		$stmt->bind_param("i", $eventId);

		// Execute the statement
		if ($stmt->execute()) {
			// Get the result
			$result = $stmt->get_result();


			// Loop through the results and populate the stakeholders array
			while ($row = $result->fetch_assoc()) {




				// Fetch other values for event details
				$event_title = $row['event_title'];
				$event_start_date = $row['event_start_date'];
				$event_date = date("F d, Y", strtotime($row['event_start_date']));
				$event_time = date("h:i A", strtotime($row['event_start_date']));
				$event_date_created = date("F d, Y", strtotime($row['event_created']));
				$event_desc = $row['event_desc'];
				$org_name = $row['org_name'] ?? "KLD Events";
				$org_profile = isset($row['org_pic']) ? base64_decode($row['org_pic']) : "assets/media/logos/kldlogo.png";
				$category_name = $row['category_name'];
				$venue_name = $row['venue_name'];
				$event_poster = base64_decode($row["event_poster"]) ?? " ";
			}



			// Check if no event found
			if (empty($stakeholders)) {
				echo '';
			}
		} else {
			// Handle execution failure
			die("Execution failed: " . $stmt->error);
		}

		// Close the statement
		$stmt->close();
	} else {
		// Handle preparation failure
		die("Database query preparation failed: " . $conn->error);
	}
} else {
	die("Event ID not provided.");
}
?>






<!--begin::Entry-->
<div class="d-flex flex-column-fluid pt-8">
	<!--begin::Container-->
	<div class=" container ">

		<div class="row d-flex justify-content-center">
			<div class="col-xxl-8">

				<div class="card card-custom gutter-b">
					<!--begin::Body-->
					<div class="card-body">

						<!--begin::Top-->
						<div class="d-flex align-items-center">
							<!--begin::Symbol-->
							<div class="symbol symbol-40 symbol-white mr-5">
								<span class="symbol-label">
									<img src="<?php echo $org_profile; ?>" class="h-75" alt="">
								</span>
							</div>
							<!--end::Symbol-->

							<!--begin::Info-->
							<div class="d-flex flex-column flex-grow-1">
								<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"><?php echo $org_name; ?></a>
								<span class="text-muted font-weight-bold"><?php echo $event_date_created; ?></span>
							</div>
							<!--end::Info-->

							<!--begin::Dropdown-->
							<div class="d-flex justify-content-end">
								<div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions"
									data-placement="left">
									<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="ki ki-bold-more-hor"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
										<ul class="navi navi-hover py-5">
											<li class="navi-item">
												<a href="?page=edit-venue&id=<?php echo $venue_id; ?>" class="navi-link">
													<span class="navi-icon"><i class="flaticon2-rocket-1"></i></span>
													<span class="navi-text">Edit</span>
												</a>
											</li>
											<li class="navi-item">
												<a href="#" onclick="editOrganizer(<?php echo $venue_id; ?>)" class="navi-link">
													<span class="navi-icon"><i class="flaticon2-gear"></i></span>
													<span class="navi-text">Archive</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!--end::Dropdown-->
						</div>
						<!--end::Top-->
						<!--begin::Text-->
						<p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">
							<?php echo $event_desc; ?>
						</p>
						<!--begin::Bottom-->
						<div class="pt-4">

							<div class="text-center " data-toggle="modal" data-target="#imageModal">
								<img src="<?php echo $event_poster; ?>" class="img-fluid" alt="Full Preview">
							</div><!-- 
							<div class="bgi-no-repeat bgi-size-cover rounded min-h-295px" style="background-image: url()" data-toggle="modal" data-target="#imageModal"></div> -->
							<!--begin::Image--><!-- 
							<div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url()"></div> -->
							<!--end::Image-->
							<div class="d-flex pt-4">
								<div class="d-flex align-items-center pr-5">
									<span class="svg-icon svg-icon-md svg-icon-primary pr-1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Star.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

											<defs />
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#000000" />
											</g>
										</svg><!--end::Svg Icon--></span><span class="text-dark-50 font-weight-bold pr-1">Event Title:</span> <span class="text-dark font-weight-bold"><?php echo $event_title; ?></span>
								</div>
							</div>
							<div class="d-flex pt-2">
								<div class="d-flex align-items-center pr-5">
									<span class="svg-icon svg-icon-md svg-icon-primary pr-1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

											<defs />
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero" />
											</g>
										</svg><!--end::Svg Icon--></span><span class="text-dark-50 font-weight-bold pr-1">Venue:</span> <span class="text-dark font-weight-bold"><?php echo $venue_name; ?></span>
								</div>
							</div>
							<div class="d-flex pt-2">
								<div class="d-flex align-items-center pr-5">
									<span class="svg-icon svg-icon-md svg-icon-primary pr-1"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-arrange.svg--><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Layout/Layout-top-panel-6.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">


											<defs />
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
												<rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
											</g>
										</svg><!--end::Svg Icon--></span> <span class="text-dark font-weight-bold"><?php echo $event_date; ?></span>
								</div>
								<div class="d-flex align-items-center">
									<span class="svg-icon svg-icon-md svg-icon-primary pr-1"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Clock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<defs></defs>
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"></rect>
												<path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" fill="#000000" opacity="0.3"></path>
												<path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"></path>
											</g>
										</svg><!--end::Svg Icon--></span> <span class="text-dark font-weight-bold"><?php echo $event_time; ?></span>
								</div>
							</div>
							<div class="d-flex pt-2">
								<div class="d-flex align-items-center pr-5">
									<span class="svg-icon svg-icon-md svg-icon-primary pr-1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Bulb1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

											<defs />
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<circle fill="#000000" opacity="0.3" cx="12" cy="9" r="8" />
												<path d="M14.5297296,11 L9.46184488,11 L11.9758349,17.4645458 L14.5297296,11 Z M10.5679953,19.3624463 L6.53815512,9 L17.4702704,9 L13.3744964,19.3674279 L11.9759405,18.814912 L10.5679953,19.3624463 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
												<path d="M10,22 L14,22 L14,22 C14,23.1045695 13.1045695,24 12,24 L12,24 C10.8954305,24 10,23.1045695 10,22 Z" fill="#000000" opacity="0.3" />
												<path d="M9,20 C8.44771525,20 8,19.5522847 8,19 C8,18.4477153 8.44771525,18 9,18 C8.44771525,18 8,17.5522847 8,17 C8,16.4477153 8.44771525,16 9,16 L15,16 C15.5522847,16 16,16.4477153 16,17 C16,17.5522847 15.5522847,18 15,18 C15.5522847,18 16,18.4477153 16,19 C16,19.5522847 15.5522847,20 15,20 C15.5522847,20 16,20.4477153 16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 C8,20.4477153 8.44771525,20 9,20 Z" fill="#000000" />
											</g>
										</svg><!--end::Svg Icon--></span><span class="text-dark-50 font-weight-bold pr-1">Category:</span><span class="text-dark font-weight-bold"><?php echo $category_name; ?></span>
								</div>
							</div>

							<!--end::Action-->
						</div>
						<!--end::Bottom-->

						<!--begin::Separator-->
						<div class="separator separator-solid mt-2 mb-4"></div>
						<!--end::Separator-->

						<div class="d-flex justify-content-end">
							<form method="post"><!-- 
								<button id="cancel-event" name="cancel-event" type="button" disabled class="btn btn-light-warning font-weight-bold py-2 disabled">Evaluate</button> -->
								<button type="button" id="register_event" name="register_event" class="btn btn-primary font-weight-bold py-2 px-6">Register Now!</button>
								<input type="hidden" id="event_id" value="<?php echo htmlspecialchars($eventId); ?>" />
								<input type="hidden" id="std_id" value="<?php echo $_SESSION['kld_id']; ?>" />
							</form>
						</div>
					</div>
					<!--end::Body-->
				</div>
				<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="imageModalLabel"><?php echo htmlspecialchars($event_title); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body text-center">
								<img src="<?php echo $event_poster; ?>" class="img-fluid" alt="Full Preview">
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>


		<div class="row d-flex justify-content-center">

			<div class="col-xl-8">
				<div class="card card-custom gutter-b">

					<!--begin::Example-->
					<div class="example mb-10">
						<div class="example-preview">
							<ul class="nav nav-pills nav-fill">
								<li class="nav-item">
									<a class="nav-link active" id="attendance-tab-4" data-toggle="tab" href="#attendance-4" aria-controls="attendance-4">
										<span class="nav-icon">
											<i class="flaticon-presentation"></i>
										</span>
										<span class="nav-text">Activity Guidelines</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="guide-tab-4" data-toggle="tab" href="#guide-4" aria-controls="guide-4">
										<span class="nav-icon">
											<i class="flaticon2-sheet"></i>
										</span>
										<span class="nav-text">Guidelines</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="gallery-tab-4" data-toggle="tab" href="#gallery-4" aria-controls="gallery-4">
										<span class="nav-icon">
											<i class="flaticon2-image-file"></i>
										</span>
										<span class="nav-text">Gallery</span>
									</a>
								</li>
							</ul>
							<div class="tab-content mt-5" id="myTabContent4">

								<div class="tab-pane fade show active" id="attendance-4" role="tabpanel" aria-labelledby="attendance-tab-4">

									<div class="row">
										<div class="col-xl-6 col-sm-12">
											<!--begin::Forms Widget 4-->
											<div class="card card-custom gutter-b">
												<!--begin::Body-->
												<div class="card-body">

													<p class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"></p>
													<!--begin::Bottom-->
													<div class="pt-4">

														<!--begin::Image-->
														<div class="bgi-no-repeat bgi-size-cover rounded" style="background-image: url(assets/media/acquaintance/1.jpg); width: 100%; padding-bottom: 100%;"></div>
														<!--end::Image-->
														<p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2"></p>

													</div>
													<!--end::Bottom-->
													<!--begin::Separator-->
													<div class="separator separator-solid mt-2 mb-4"></div>
													<!--end::Separator-->

												</div>
												<!--end::Body-->
											</div>
										</div>
										<div class="col-xl-6 col-sm-12">
											<!--begin::Forms Widget 4-->
											<div class="card card-custom gutter-b">
												<!--begin::Body-->
												<div class="card-body">
													<!--begin::Bottom-->
													<div class="pt-4">
														<!--begin::Image-->
														<div class="bgi-no-repeat bgi-size-cover rounded" style="background-image: url(assets/media/acquaintance/2.jpg); width: 100%; padding-bottom: 100%;"></div>
														<!--end::Image-->
													</div>
													<!--end::Bottom-->
													<!--begin::Separator-->
													<div class="separator separator-solid mt-2 mb-4"></div>
													<!--end::Separator-->

												</div>
												<!--end::Body-->
											</div>
										</div>
										<div class="col-xl-6 col-sm-12">
											<!--begin::Forms Widget 4-->
											<div class="card card-custom gutter-b">
												<!--begin::Body-->
												<div class="card-body">
													<!--begin::Bottom-->
													<div class="pt-4">
														<!--begin::Image-->
														<img src="assets/media/acquaintance/3.jpg"
															class="img-fluid rounded" alt="Preview" style="cursor: pointer;"
															data-toggle="modal" data-target="#imageModal" />
														<!--end::Image-->
													</div>
													<!--end::Bottom-->

													<!--begin::Separator-->
													<div class="separator separator-solid mt-2 mb-4"></div>
													<!--end::Separator-->
												</div>
												<!--end::Body-->
											</div>
										</div>
									</div>







								</div>
								<div class="tab-pane fade" id="guide-4" role="tabpanel" aria-labelledby="guide-tab-4">


									<div class="row">
										<div class="col-xl-12">
											<div class="card card-custom gutter-b">
												<div class="card-header">
													<div class="card-title">
														<h3 class="card-label">Program Agenda</h3>

													</div>
												</div>
												<div class="card-body">
													<!--begin::Example-->
													<div class="example example-basic">
														<div class="example-preview">
															<div class="timeline timeline-4">
																<div class="timeline-bar"></div>
																<div class="timeline-items">
																	<div class="timeline-item timeline-item-left">
																		<div class="timeline-badge">
																			<div class="bg-danger"></div>
																		</div>
																		<div class="timeline-label">
																			<span class="text-primary font-weight-bold">11:35 AM</span>
																		</div>
																		<div class="timeline-content">Opening Remarks</div>
																	</div>
																	<div class="timeline-item timeline-item-right">
																		<div class="timeline-badge">
																			<div class="bg-success"></div>
																		</div>
																		<div class="timeline-label text-primary">
																			<span class="text-primary font-weight-bold">11:40 AM</span>
																		</div>
																		<div class="timeline-content">Introduction of the Speaker</div>
																	</div>
																	<div class="timeline-item timeline-item-left">
																		<div class="timeline-badge">
																			<div class="bg-warning"></div>
																		</div>
																		<div class="timeline-label">
																			<span class="text-primary font-weight-bold">11:45 AM</span>
																		</div>
																		<div class="timeline-content">Singing National Anthem, Dasmariñas Hymn, and Kolehiyong Lungsod ng Dasmariñas Hymn</div>
																	</div>
																	<div class="timeline-item timeline-item-right">
																		<div class="timeline-badge">
																			<div class="bg-info"></div>
																		</div>
																		<div class="timeline-label text-primary">
																			<span class="text-primary font-weight-bold">12:00 PM</span>
																		</div>
																		<div class="timeline-content">Presentation of the program</div>
																	</div>
																	<div class="timeline-item timeline-item-left">
																		<div class="timeline-badge">
																			<div class="bg-dark"></div>
																		</div>
																		<div class="timeline-label">
																			<span class="text-primary font-weight-bold">01:00 PM</span>
																		</div>
																		<div class="timeline-content">Question and Answers</div>
																	</div>
																	<div class="timeline-item timeline-item-right">
																		<div class="timeline-badge">
																			<div class="bg-success"></div>
																		</div>
																		<div class="timeline-label text-primary">
																			<span class="text-primary font-weight-bold">1:30 PM</span>
																		</div>
																		<div class="timeline-content">Closing Remarks</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--end::Example-->
												</div>
											</div>
										</div>

										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
											<!--begin::Card-->
											<div class="card card-custom gutter-b ">
												<div class="card-header border-0">
													<h3 class="card-title">Ticket Form
													</h3>
												</div>
												<div class="card-body">
													<div class="d-flex flex-column align-items-center">
														<!--begin: Icon-->
														<img alt="" class="max-h-65px" src="assets/media/svg/files/folders.svg">
														<!--end: Icon-->

														<!--begin: Tite-->
														<div class="d-flex flex-column font-size-sm font-weight-bold pt-5">
															<a href="#" class="d-flex align-items-center text-muted text-hover-primary py-1">
																<span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span> Agreement Samle.pdf
															</a>
															<a href="#" class="d-flex align-items-center text-muted text-hover-primary py-1">
																<span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span> Requirements.docx
															</a>
														</div>
														<!--end: Tite-->
													</div>
												</div>
											</div>
											<!--end:: Card-->
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
											<!--begin::Card-->
											<div class="card card-custom gutter-b ">
												<div class="card-header border-0">
													<h3 class="card-title">Meeting Link
													</h3>
												</div>
												<div class="card-body">
													<div class="d-flex flex-column align-items-center">
														<!--begin: Icon-->
														<img alt="" class="max-h-65px" src="assets/media/svg/files/link.svg">
														<!--end: Icon-->

														<!--begin: Tite-->
														<div class="d-flex flex-column font-size-sm font-weight-bold pt-5">
															<a href="#" class="d-flex align-items-center text-muted text-hover-primary py-1">
																<span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span> Agreement Samle.pdf
															</a>
															<a href="#" class="d-flex align-items-center text-muted text-hover-primary py-1">
																<span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span> Requirements.docx
															</a>
														</div>
														<!--end: Tite-->
													</div>
												</div>
											</div>
											<!--end:: Card-->
										</div>

									</div>

								</div>
								<div class="tab-pane fade" id="gallery-4" role="tabpanel" aria-labelledby="gallery-tab-4">
									gallery
								</div>
							</div>
						</div>

					</div>
					<!--end::Example-->
				</div>
			</div>

		</div>


		<div class="separator separator-solid separator-border-4"></div>



		<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="imageModalLabel"><?php echo htmlspecialchars($event_title); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<img src="<?php echo $event_poster; ?>" class="img-fluid" alt="Full Preview">
					</div>
				</div>
			</div>
		</div>

		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>