<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Include the database connection
include('./control/db.php');

// Check if the 'event_id' parameter exists in the URL
if (isset($_GET['event_id'])) {
	$eventId = $_GET['event_id'];

	// Prepare the SQL statement to fetch events for the specific event ID
	$query = "SELECT 
                kld_event.*, 
                org_tbl.org_name AS organization_name, 
                category_tbl.category_name,
                venue_tbl.venue_name,
                letter_tbl.letter_content,
                stakeholder_tbl.*,

                admin_acc.admin_profile,
                admin_acc.admin_id,
                admin_acc.admin_fname,
                admin_acc.admin_lname,
                admin_acc.admin_role,

                org_acc.org_profile,
                org_acc.org_id,
                org_acc.org_fname,
                org_acc.org_lname,
                org_acc.org_role
              FROM 
                kld_event 
			LEFT JOIN 
				venue_tbl ON kld_event.venue_id = venue_tbl.venue_id 
			LEFT JOIN 
				category_tbl ON kld_event.category_id = category_tbl.category_id 
			LEFT JOIN 
				letter_tbl ON kld_event.event_id = letter_tbl.event_id 
			LEFT JOIN 
				stakeholder_tbl ON kld_event.event_id = stakeholder_tbl.event_id 
			LEFT JOIN 
				admin_acc ON stakeholder_tbl.admin_id = admin_acc.admin_id
			LEFT JOIN 
				org_acc ON stakeholder_tbl.org_acc_id = org_acc.org_acc_id  -- Join to get org_id
			LEFT JOIN 
				org_tbl ON org_acc.org_id = org_tbl.org_id  -- Join to get org_name
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

			// Initialize an array to hold stakeholder information
			$stakeholders = [];

			// Loop through the results and populate the stakeholders array
			while ($row = $result->fetch_assoc()) {

				if (!empty($row['admin_fname']) && !empty($row['admin_lname'])) {
					$stakeholders[] = [
						'admin_id' => $row['admin_id'],
						'role' => htmlspecialchars($row['admin_role']),
						'name' => htmlspecialchars($row['admin_fname'] . ' ' . $row['admin_lname']),
						'status' => htmlspecialchars($row['status']), // Assuming 'status' is the column name in stakeholder_tbl
						'type' => 'admin',
						'profile' => !empty($row['admin_profile']) ? $row['admin_profile'] : "assets/default.jpg",
					];
				}

				// Fetch organization information
				if (!empty($row['org_fname']) && !empty($row['org_lname'])) {
					$stakeholders[] = [
						'org_acc_id' => $row['org_acc_id'],
						'role' => htmlspecialchars($row['organization_name']),
						'name' => htmlspecialchars($row['org_fname'] . ' ' . $row['org_lname']),
						'status' => htmlspecialchars($row['status']), // Assuming 'status' is the column name in stakeholder_tbl
						'profile' => !empty($row['org_profile']) ? $row['org_profile'] : "assets/default.jpg",
						'type' => 'organizer'
					];
				}



				// Fetch other values for event details
				$event_title = $row['event_title'];
				$event_start_date = $row['event_start_date'];
				$event_date_created = $row['event_created'];
				$event_desc = $row['event_desc'];
				$org_name = $row['organization_name'] ?? "KLD Events";
				$category_name = $row['category_name'];
				$venue_name = $row['venue_name']; // Assign "Virtual Event" if venue_name is null
				$proposal = $row["letter_content"] ?? "No Event Proposal Letter";
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
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class=" container ">
		<!--begin::Row-->





		<!--end::Row-->
		<div class="row">
			<div class="col-xl-12">

				<!--begin::Engage Widget 1-->
				<div class="card card-custom card-stretch gutter-b position-relative">
					<!-- Toolbar for icons -->
					<div class="position-absolute top-0 right-0 p-3">
						<div class="d-flex align-items-center">
							<!-- Edit and Archive icons -->
							<a href="?page=edit-event&event_id=<?php echo $eventId ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" title="Edit">
								<span class="svg-icon svg-icon-md svg-icon-primary"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
										</g>
									</svg><!--end::Svg Icon--></span>
							</a>
							<a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-3" title="Archive">
								<i class="icon-xl fas fa-eye-slash text-danger"></i>

							</a>
						</div>
					</div>

					<!-- Existing Card Body -->
					<div class="card-body d-flex p-0">
						<div class="flex-grow-1 p-8 card-rounded bgi-no-repeat d-flex"
							style="background-color: #FFF; background-position: center bottom; background-size: auto 100%; background-image: url(assets/media/svg/humans/custom-88.png)">
							<!-- Existing content -->
							<div class="row">
								<div class="col-12 col-md-3" style="text-align: center;">
									<img src="<?php echo $event_poster; ?>"
										style="width: 100%; object-fit: cover;" data-toggle="modal" data-target="#imageModal" />
								</div>
								<div class="col-12 col-md-9">
									<!-- Title and details -->
									<a href="#" class="d-flex align-items-center">

										<h1 class="text-primary font-weight-bolder m-0 text-hover-secondary">
											<?php echo htmlspecialchars($event_title); ?>

										</h1>
									</a>
									<?php
									$try = mysqli_query($conn, "SELECT org_tbl.org_name as event_host FROM kld_event JOIN org_tbl ON kld_event.event_org_id = org_tbl.org_id WHERE event_id = '$eventId'");
									$row = $try->fetch_array();
									$event_host = $row['event_host'] ?? "KLD Events";
									?>
									<h6 class="text-dark-50 font-weight-bolder m-0"><?php echo htmlspecialchars($event_host); ?></h6>
									<div class="d-flex my-5">
										<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
												<g id="Stockholm-icons-/-Design-/-Layers" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
													<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero"></path>
													<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
										<span class="text-dark h4 text-hover-primary"><?php echo htmlspecialchars($category_name); ?></span>
										<a href="#">
											<?php
											echo (!empty($venue_name)) ?
												'<a href="?page=venue-view&venue_id="#">
                                                 <span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
															<g id="Stockholm-icons-/-Map-/-Marker1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect id="bound" x="0" y="0" width="24" height="24"></rect>
																<path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
													<span class="text-dark h4 text-hover-primary">' . $venue_name . '</span>
												</a>'
												:
												'<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
													<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Display3.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"/>
															<polygon fill="#000000" opacity="0.3" points="5 7 5 15 19 15 19 7"/>
															<path d="M11,19 L11,16 C11,15.4477153 11.4477153,15 12,15 C12.5522847,15 13,15.4477153 13,16 L13,19 L14.5,19 C14.7761424,19 15,19.2238576 15,19.5 C15,19.7761424 14.7761424,20 14.5,20 L9.5,20 C9.22385763,20 9,19.7761424 9,19.5 C9,19.2238576 9.22385763,19 9.5,19 L11,19 Z" fill="#000000" opacity="0.3"/>
															<path d="M5,7 L5,15 L19,15 L19,7 L5,7 Z M5.25,5 L18.75,5 C19.9926407,5 21,5.8954305 21,7 L21,15 C21,16.1045695 19.9926407,17 18.75,17 L5.25,17 C4.00735931,17 3,16.1045695 3,15 L3,7 C3,5.8954305 4.00735931,5 5.25,5 Z" fill="#000000" fill-rule="nonzero"/>
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
												<span class="text-dark h4">Virtual Event</span>';
											?>
										</a>
									</div>
									<div class="d-flex">
										<span><i class="text-dark flaticon2-calendar mr-3"></i></span>
										<span class="text-dark h4">
											<?php
											// Format the date and time
											$formattedDate = date("F d, Y", strtotime($event_start_date));
											$formattedTime = date("h:i A", strtotime($event_start_date));
											$clockIcon = '<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
												<g id="Stockholm-icons-/-Home-/-Clock" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect id="bound" x="0" y="0" width="24" height="24"></rect>
													<path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" id="Mask" fill="#000000" opacity="0.3"></path>
													<path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" id="Path-107" fill="#000000"></path>
												</g>
											</svg><!--end::Svg Icon--></span>';
											echo $formattedDate . "  " . $clockIcon . "  " . $formattedTime;

											?>
										</span>
										<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
											<!-- SVG clock icon here -->
										</span>
									</div>

									<p class="text-dark-50 my-5 font-size-xl font-weight-bold">
										<?php echo htmlspecialchars($event_desc); ?>
									</p>
									<a href="javascript:history.back()" class="btn btn-light-primary font-weight-bold py-2 px-6">Back to Previous Page</a>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end::Engage Widget 1-->
			</div>
		</div>

		<div class="card card-custom gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 py-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label font-weight-bolder text-dark">Attendees</span>
					<span class="text-muted mt-3 font-weight-bold font-size-sm">Kolehiyo ng Lungsod ng Dasmariñas</span>
				</h3>
			</div>




			<div class="card-body">
				<div class="mb-7">
					<div class="row align-items-center">
						<div class="col-12">
							<div class="row align-items-center">
								<div class="col-md-3 my-2">
									<div class="d-flex align-items-center">
										<label class="mr-3 mb-0 d-none d-md-block">Type:</label>
										<select class="form-control" id="kt_datatable_search_status">
											<?php
											$query = "SELECT *
											FROM event_invitation 
											LEFT JOIN kld_event ON event_invitation.event_id = kld_event.event_id                        
											WHERE kld_event.event_id = '" . $eventId . "'";

											$result = mysqli_query($conn, $query);

											// Initialize the variables as null
											$course_id = $yearlvl_id = $section_id = $org_id = null;

											if (mysqli_num_rows($result) > 0) {
												$row = mysqli_fetch_assoc($result);
												$course_id = $row['course_id'];
												$yearlvl_id = $row['yearlvl_id'];
												$section_id = $row['section_id'];
												$org_id = $row['org_id'];
											}

											// Conditional statements to display options
											if (is_null($course_id) && is_null($yearlvl_id) && is_null($section_id) && is_null($org_id)) {
												// If all values are null, display both options
												echo '<option value="std">Student</option>';
												echo '<option value="emp">Employee</option>';
											} elseif (!is_null($course_id) && is_null($yearlvl_id) && is_null($section_id) && is_null($org_id)) {
												echo '<option value="std">Student</option>';
											} elseif (is_null($course_id) && !is_null($yearlvl_id) && is_null($section_id) && is_null($org_id)) {
												echo '<option value="std">Student</option>';
											} elseif (is_null($course_id) && is_null($yearlvl_id) && is_null($section_id) && !is_null($org_id)) {
												echo '<option value="emp">Employee</option>';
											} elseif (!is_null($course_id) && !is_null($yearlvl_id) && !is_null($section_id) && is_null($org_id)) {
												echo '<option value="std">Student</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div id="student-fields" class="col-md-9 my-2 d-none">
									<div class="row align-items-center">
										<div class="col-md-4 my-2">
											<div class="d-flex align-items-center">
												<label class="mr-3 mb-0 d-none d-md-block">Program:</label>
												<select class="form-control" id="kt_datatable_search_program">
													<?php
													// Query to fetch course acronyms from course_tbl
													$courseQuery = "SELECT * FROM course_tbl";
													$courseResult = mysqli_query($conn, $courseQuery);

													if (mysqli_num_rows($courseResult) > 0) {
														// Loop through each row and display the course acronym as an option
														while ($courseRow = mysqli_fetch_assoc($courseResult)) {
															echo '<option value="' . $courseRow['course_id'] . '">' . $courseRow['course_acronym'] . '</option>';
														}
													} else {
														// If no courses are found, display a default option
														echo '<option value="">No programs available</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-4 my-2">
											<div class="d-flex align-items-center">
												<label class="mr-3 mb-0 d-none d-md-block">Year Level:</label>
												<select class="form-control" id="kt_datatable_search_year">
													<option value="1">1st</option>
													<option value="2">2nd</option>
													<option value="3">3rd</option>
													<option value="4">4th</option>
												</select>
											</div>
										</div>
										<div class="col-md-4 my-2">
											<div class="d-flex align-items-center">
												<label class="mr-3 mb-0 d-none d-md-block">Section:</label>
												<select class="form-control" id="kt_datatable_search_section">
													<?php
													// Query to fetch course acronyms from course_tbl
													$courseQuery = "SELECT * FROM section_tbl";
													$courseResult = mysqli_query($conn, $courseQuery);

													if (mysqli_num_rows($courseResult) > 0) {
														// Loop through each row and display the course acronym as an option
														while ($courseRow = mysqli_fetch_assoc($courseResult)) {
															echo '<option value="' . $courseRow['section_id'] . '">' . $courseRow['section_name'] . '</option>';
														}
													} else {
														// If no courses are found, display a default option
														echo '<option value="">No programs available</option>';
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div id="employee-fields" class="col-md-4 my-2 d-none">
									<div class="d-flex align-items-center">
										<label class="mr-3 mb-0 d-none d-md-block">Organization:</label>
										<select class="form-control" id="kt_datatable_search_org">
											<?php
											// Query to fetch organization names
											$orgQuery = "SELECT * FROM org_tbl";
											$orgResult = mysqli_query($conn, $orgQuery);

											if (mysqli_num_rows($orgResult) > 0) {
												// Loop through each row and display the organization name as an option
												while ($orgRow = mysqli_fetch_assoc($orgResult)) {
													echo '<option value="' . $orgRow['org_id'] . '">' . $orgRow['org_name'] . '</option>';
												}
											} else {
												// If no organizations are found, display a default option
												echo '<option value="">No organizations available</option>';
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="mb-5 collapse" id="kt_datatable_group_action_form">
					<div class="d-flex align-items-center">
						<div class="font-weight-bold text-danger mr-3">Selected <span id="kt_datatable_selected_records">0</span> records:</div>
						<div class="dropdown mr-2">
							<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Update status</button>
							<div class="dropdown-menu dropdown-menu-sm">
								<ul class="nav nav-hover flex-column">
									<li class="nav-item"><a href="#" class="nav-link"><span class="nav-text">Present</span></a></li>
									<li class="nav-item"><a href="#" class="nav-link"><span class="nav-text">Absent</span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card-body py-0 d-none" id="student-table">
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
								<th style="min-width: 150px">Program</th>
								<th style="min-width: 150px">Section</th>
								<th style="min-width: 150px">Date</th>
								<th style="min-width: 150px">Status</th>
								<th class="min-width: 150px" style="min-width: 150px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$try = mysqli_query(
								$conn,
								"SELECT DISTINCT sa.*, 
									course_tbl.course_acronym, 
									section_tbl.section_name, 
									yearlvl_tbl.yearlvl_name,
									at.status, 
									at.attendance_date 
								FROM std_acc sa
								JOIN event_invitation ei 
									ON (sa.course_id = ei.course_id OR ei.course_id IS NULL)
									AND (sa.yearlvl = ei.yearlvl_id OR ei.yearlvl_id IS NULL)
									AND (sa.section_id = ei.section_id OR ei.section_id IS NULL)
								JOIN course_tbl ON sa.course_id = course_tbl.course_id
								JOIN section_tbl ON sa.section_id = section_tbl.section_id
								JOIN yearlvl_tbl ON sa.yearlvl = yearlvl_tbl.yearlvl_id
								LEFT JOIN attendance_tbl at ON sa.std_id = at.std_id AND at.event_id = $eventId
								WHERE ei.event_id = $eventId;
								"
							);

							while ($row = $try->fetch_array()) {
								// Check if the student is registered for the specific event by checking the status in registration_tbl
								$status_result = mysqli_query($conn, "SELECT status, attendance_date FROM attendance_tbl WHERE std_id = '" . $row['std_id'] . "' AND event_id = $eventId");

								// Initialize status and reg_date for each student
								$status = 'INACTIVE';
								$attendance_date = '--.--.----'; // Default date when not registered

								if (mysqli_num_rows($status_result) > 0) {
									$status_row = mysqli_fetch_assoc($status_result);
									$status = strtolower($status_row['status']) == 'attended' ? 'attended' : 'INACTIVE';
									$attendance_date = ($status == 'attended' && !empty($status_row['attendance_date'])) ? date("F d, Y", strtotime($status_row['attendance_date'])) : '--.--.----';
								}

								echo '<tr>';
								echo '<td class="pl-0"><label class="checkbox checkbox-lg checkbox-inline"><input type="checkbox" id="student-id" name="student-id" value="' . $row['std_id'] . '" /><span></span></label></td>';
								echo '<td class="pr-0">
										<div class="symbol symbol-40 symbol-sm flex-shrink-0">';
								if (!empty($row['std_profilepic'])) {
									echo '<img src="' . $row['std_profilepic'] . '" class="h-75 align-self-end" alt=""/>';
								} else {
									echo '<img src="assets/media/users/default.jpg" class="h-75 align-self-end" alt=""/>';
								}
								echo '</div></td>';
								echo '<td class="pl-0"><a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $row['std_fname'] . ' ' . $row['std_lname'] . '</a><span class="text-muted font-weight-bold text-muted d-block">' . $row['std_kld_id'] . '</span></td>';
								echo '<td><span class="text-dark-75 font-weight-bolder d-block font-size-lg">' . $row['course_acronym'] . '</span><span class="text-muted font-weight-bold">' . $row['yearlvl_name'] . '</span></td>';
								echo '<td><span class="text-dark-75 font-weight-bolder d-block font-size-lg">' . $row['section_name'] . '</span></td>';
								echo '<td><span class="text-muted font-weight-bold">' . $attendance_date . '</span></td>';

								// Status
								$status_text = ($status == 'attended') ? 'Present' : 'Absent';
								$label_class = ($status == 'attended') ? 'label-light-primary' : 'label-light-danger';
								echo '<td><span class="label label-lg ' . $label_class . ' label-inline">' . $status_text . '</span></td>';

								// Switch
								$_status = ($status == 'attended') ? 'checked="checked"' : '';
								$_attended = ($status == 'attended') ? 'absent"' : 'attended';
								echo '<td class="pr-0 text-right">
										<form method="post">
											<input type="hidden" id="std_id" name="std_id" value="' . $row['std_id'] . '"/>
											<input type="hidden" id="event_id" name="event_id" value="' . $eventId . '"/>
											<span class="switch switch-outline switch-icon switch-success">
												<label>
													<input type="checkbox" class="attended-checkbox" ' . $_status . ' data-std-id="' . $row['std_id'] . '" data-event-id="' . $eventId . '" />
													<span></span>
												</label>
											</span>
										</form>
									</td>';



								echo '</tr>';
							}
							?>
						</tbody>

					</table>
				</div>
				<!--end::Table-->
			</div>

			<div class="card-body py-0 d-none" id="employee-table">
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
								<th class="pr-0" style="width: 50px">Employee</th>
								<th style="min-width: 200px"></th>
								<th style="min-width: 150px">Email</th>
								<th style="min-width: 150px">Role</th>
								<th style="min-width: 150px">Status</th>
								<th class="min-width: 150px" style="min-width: 150px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$try = mysqli_query($conn, "SELECT org_acc.*, org_tbl.org_name FROM org_acc JOIN org_tbl ON org_acc.org_id = org_tbl.org_id");
							while ($row = $try->fetch_array()) {
								echo '<tr>';
								// Checkbox
								echo '<td class="pl-0"><label class="checkbox checkbox-lg checkbox-inline"><input type="checkbox" value="' . $row['org_acc_id'] . '" /><span></span></label></td>';

								// Profile Image
								echo '<td class="pr-0"><div class="symbol symbol-50 symbol-light mt-1"><span class="symbol-label"><img src="' . ($row['org_profile'] ? $row['org_profile'] : 'assets/media/users/default.jpg') . '" class="h-75 align-self-end" alt=""/></span></div></td>';

								// Name and ID
								echo '<td class="pl-0"><a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $row['org_fname'] . ' ' . $row['org_lname'] . '</a><span class="text-muted font-weight-bold text-muted d-block">' . $row['org_kld_id'] . '</span></td>';

								// Email
								echo '<td><span class="text-muted font-weight-bold">' . $row['org_email'] . '</span></td>';

								// Section
								echo '<td><span class="text-dark-75 font-weight-bolder d-block font-size-lg">' . $row['org_role'] . '</span></td>';

								// Status
								$status = strtoupper($row['status']);
								$status_text = ($status == 'ACTIVE') ? 'Present' : 'Absent';
								$label_class = ($status == 'ACTIVE') ? 'label-light-primary' : 'label-light-danger';
								echo '<td><span class="label label-lg ' . $label_class . ' label-inline">' . $status_text . '</span></td>';

								// Switch
								$_status = ($status == 'ACTIVE') ? 'checked="checked"' : '';
								echo '<td class="pr-0 text-right"><span class="switch switch-outline switch-icon switch-success"><label><input type="checkbox" ' . $_status . ' name="select"/><span></span></label></span></td>';

								echo '</tr>';
							}
							?>
						</tbody>

					</table>
				</div>
				<!--end::Table-->
			</div>



		</div>
		<!--end::Container-->


		<div class="card card-custom gutter-b">
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title">
					<h3 class="card-label">KLD Students
						<span class="d-block text-muted pt-2 font-size-sm">Kolehiyong Lungsod ng Dasmarinas</span>
					</h3>
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
										<input type="text" class="form-control" placeholder="Search..." id="datatable_search" />
										<span>
											<i class="flaticon2-search-1 text-muted"></i>
										</span>
									</div>
								</div>
								<div class="col-md-3 my-2 my-md-0">
									<div class="d-flex align-items-center">
										<label class="mr-3 mb-0 d-none d-md-block">Program:</label>
										<select class="form-control" id="kt_datatable_program">
											<option value="">All</option>
											<?php
											include('./control/db.php');
											$try = mysqli_query($conn, "Select * from course_tbl");
											while ($row = $try->fetch_array()) {
												echo '<option value="' . $row['course_id'] . '">' . $row['course_acronym'] . '</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-3 my-2 my-md-0">
									<div class="d-flex align-items-center">
										<label class="mr-3 mb-0 d-none d-md-block">Year Level:</label>
										<select class="form-control" id="kt_datatable_yearlvl">
											<option value="">All</option>
											<option value="1">1st Year</option>
											<option value="2">2nd Year</option>
											<option value="3">3rd Year</option>
											<option value="4">4th Year</option>
										</select>
									</div>
								</div>
								<div class="col-md-3 my-2 my-md-0">
									<div class="d-flex align-items-center">
										<label class="mr-3 mb-0 d-none d-md-block">Section:</label>
										<select class="form-control" id="kt_datatable_section">
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
				<div class="datatable datatable-bordered datatable-head-custom" id="attendance_std"></div>
				<input type="hidden" name="event_id" id="event_id" value="<?php echo $eventId ?>">
				<!--end: Datatable-->
			</div>
		</div>

	</div>
	<!--end::Entry-->
</div>