<?php
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
						'role' => htmlspecialchars($row['organization_name']),
						'name' => htmlspecialchars($row['org_fname'] . ' ' . $row['org_lname']),
						'status' => htmlspecialchars($row['status']), // Assuming 'status' is the column name in stakeholder_tbl
						'profile' => !empty($row['org_profile']) ? $row['org_profile'] : "assets/default.jpg",
						'type' => 'organizer'
					];
				}



				// Fetch other values for event details
				$event_type = $row['event_type'];
				$event_title = $row['event_title'];
				$event_start_date = date('m/d/Y H:i', strtotime($row['event_start_date']));
				$event_end_date = date('m/d/Y H:i', strtotime($row['event_end_date']));

				$event_desc = $row['event_desc'];
				$org_name = $row['organization_name'] ?? "KLD Events";
				$category_id = $row['category_id'];
				$category_name = $row['category_name'];
				$venue_name = $row['venue_name'] ?? "Virtual Event"; // Assign "Virtual Event" if venue_name is null
				$venue_id = $row['venue_id'];
				$proposal = $row["letter_content"] ?? "No Event Proposal Letter";
				$event_poster = base64_decode($row["event_poster"]) ?? " ";
			}



			// Check if no event found
			if (empty($stakeholders)) {
				echo '<h1> walang stakeholder </h1>';
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
		<div class="row">
			<div class="col-xl-12">
				<!--begin::Engage Widget 1-->
				<div class="card card-custom card-stretch gutter-b">
					<div class="card-body d-flex p-0">
						<div class="flex-grow-1 p-8 card-rounded bgi-no-repeat d-flex"
							style="background-color: #FFF; background-position: center bottom; background-size: auto 100%; background-image: url(assets/media/svg/humans/custom-88.png)">
							<div class="row">
								<div class="col-12 col-md-3" style="text-align: center;">
									<img src="<?php echo $event_poster; ?>"
										style="width: 100%; object-fit: cover;" data-toggle="modal" data-target="#imageModal" />
								</div>
								<div class="col-12 col-md-9">
									<a href="#" class="d-flex align-items-center">
										<div class="mr-3 d-flex align-items-center bg-hover-light p-2 rounded">
											<div class="flex-shrink-0 text-center">
												<i class="fas fa-hourglass-half text-warning mr-2"></i>
											</div>
										</div>
										<h1 class="text-primary font-weight-bolder mb-3 text-hover-secondary">
											<?php echo htmlspecialchars($event_title); ?>
										</h1>
									</a>
									<h6 class="text-dark-50 font-weight-bolder m-0"><?php echo htmlspecialchars($org_name); ?></h6>
									<div class="d-flex my-5">
										<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3">
											<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<!-- SVG content -->
											</svg>
										</span>
										<span class="text-dark h4 text-hover-primary"><?php echo htmlspecialchars($category_name); ?></span>
										<a href="#">
											<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
												<!-- SVG icon here -->
											</span>
											<span class="text-dark h4 text-hover-primary">
												<?php echo $venue_name ? htmlspecialchars($venue_name) : 'Virtual Event'; ?>
											</span>
										</a>
									</div>
									<div class="d-flex">
										<span><i class="text-dark flaticon2-calendar mr-3"></i></span>
										<span class="text-dark h4">
											<?php
											// Format the date and time
											$formattedDate = date("F d, Y", strtotime($event_start_date));
											$formattedTime = date("h:i A", strtotime($event_start_date));
											echo $formattedDate . " | " . $formattedTime;
											?>
										</span>
										<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
											<!-- SVG clock icon here -->
										</span>
									</div>


									<p class="text-dark-50 my-5 font-size-xl font-weight-bold">
										<?php echo htmlspecialchars($event_desc); ?>
									</p>
									<a href="?page=pending-view&event_id=<?php echo $eventId ?>" class="btn btn-light-primary font-weight-bold py-2 px-6">Back to Event</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end::Engage Widget 1-->
			</div>
		</div>


		<div class="card card-custom gutter-b">

			<!--begin::Example-->
			<div class="example mb-10">
				<div class="example-preview">
					<ul class="nav nav-pills nav-fill">
						<li class="nav-item">
							<a class="nav-link active" id="stats-tab-4" data-toggle="tab" href="#stats-4">
								<span class="nav-icon">
									<i class="flaticon2-user-1"></i>
								</span>
								<span class="nav-text">Basic Details</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="proposal-tab-4" data-toggle="tab" href="#proposal" aria-controls="proposal">
								<span class="nav-icon">
									<i class="flaticon2-chat-1"></i>
								</span>
								<span class="nav-text">Additional Information</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="feedback-tab-4" data-toggle="tab" href="#feedback-4" aria-controls="feedback-4">
								<span class="nav-icon">
									<i class="flaticon2-sheet"></i>
								</span>
								<span class="nav-text">Feedback Form</span>
							</a>
						</li>
					</ul>

					<div class="tab-content mt-5" id="myTabContent4">

						<div class="tab-pane fade show active" id="stats-4" role="tabpanel" aria-labelledby="stats-tab-4">


							<div class="card card-custom" id="kt_blockui_content">
								<div class="card-body p-0">
									<!--begin::Wizard-->
									<div class="wizard wizard-1" id="kt_wizard_v1" data-wizard-state="step-first"
										data-wizard-clickable="false">
										<!--begin::Wizard Nav-->
										<div class="wizard-nav border-bottom">
											<div class="wizard-steps p-8 p-lg-10">
												<!--begin::Wizard Step 1 Nav-->
												<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
													<div class="wizard-label">
														<i class="wizard-icon flaticon-bus-stop"></i>
														<h3 class="wizard-title">1. Event Basics</h3>
													</div>
													<span
														class="svg-icon svg-icon-xl wizard-arrow"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
															xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
															width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3"
																	transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) "
																	x="11" y="5" width="2" height="14" rx="1" />
																<path
																	d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
																	fill="#000000" fill-rule="nonzero"
																	transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) " />
															</g>
														</svg><!--end::Svg Icon--></span>
												</div>
												<!--end::Wizard Step 1 Nav-->

												<!--begin::Wizard Step 2 Nav-->
												<div class="wizard-step" data-wizard-type="step">
													<div class="wizard-label">
														<i class="wizard-icon flaticon-list"></i>
														<h3 class="wizard-title">2. Enter Event Details</h3>
													</div>
													<span
														class="svg-icon svg-icon-xl wizard-arrow"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
															xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
															width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3"
																	transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) "
																	x="11" y="5" width="2" height="14" rx="1" />
																<path
																	d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
																	fill="#000000" fill-rule="nonzero"
																	transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) " />
															</g>
														</svg><!--end::Svg Icon--></span>
												</div>
												<!--end::Wizard Step 2 Nav-->


												<div class="wizard-step" data-wizard-type="step">
													<div class="wizard-label">
														<i class="wizard-icon flaticon-users"></i>
														<h3 class="wizard-title">3. Attendees</h3>
													</div>
													<span
														class="svg-icon svg-icon-xl wizard-arrow"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
															xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
															width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3"
																	transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) "
																	x="11" y="5" width="2" height="14" rx="1" />
																<path
																	d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
																	fill="#000000" fill-rule="nonzero"
																	transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) " />
															</g>
														</svg><!--end::Svg Icon--></span>
												</div>

												<div class="wizard-step" data-wizard-type="step">
													<div class="wizard-label">
														<i class="wizard-icon flaticon-responsive"></i>
														<h3 class="wizard-title">4. Upload Poster</h3>
													</div>
													<span
														class="svg-icon svg-icon-xl wizard-arrow"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
															xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
															width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3"
																	transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) "
																	x="11" y="5" width="2" height="14" rx="1" />
																<path
																	d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
																	fill="#000000" fill-rule="nonzero"
																	transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) " />
															</g>
														</svg><!--end::Svg Icon--></span>
												</div>

												<div class="wizard-step" data-wizard-type="step">
													<div class="wizard-label">
														<i class="wizard-icon flaticon-mail-1"></i>
														<h3 class="wizard-title">5. Proposal</h3>
													</div>

												</div>

												<!--begin::Wizard Step 3 Nav-->



												<!--end::Wizard Step 5 Nav-->
											</div>
										</div>
										<!--end::Wizard Nav-->

										<!--begin::Wizard Body-->
										<div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
											<div class="col-xl-12 col-xxl-7">
												<!--begin::Wizard Form-->
												<form class="form" id="kt_form">
													<!--begin::Wizard Step 1-->
													<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
														<h3 class="font-weight-bold text-dark">Select Event Type</h3>
														<!--begin::Form-->
														<form class="form">
															<div class="card-body">
																<div class="form-group m-0">
																	<div class="row">
																		<div class="col-lg-6">
																			<label class="option">
																				<span class="option-control">
																					<span class="radio">
																						<input type="radio" name="eventType" id="inPerson_radio" value="inPerson"
																							onclick="toggleForm()"
																							<?php echo ($event_type === 'inPerson' || 'undefined') ? 'checked="checked"' : ''; ?> />
																						<span></span>
																					</span>
																				</span>
																				<span class="option-label">
																					<span class="option-head">
																						<span class="option-title">On-site Event</span>
																					</span>
																					<span class="option-body">A traditional, physical gathering where participants attend a specific location to engage in real-time activities, sessions, or social interactions.</span>
																				</span>
																			</label>
																		</div>
																		<div class="col-lg-6">
																			<label class="option">
																				<span class="option-control">
																					<span class="radio">
																						<input type="radio" name="eventType" id="virtual_radio" value="virtual"
																							onclick="toggleForm()"
																							<?php echo ($event_type === 'virtual') ? 'checked="checked"' : ''; ?> />
																						<span></span>
																					</span>
																				</span>
																				<span class="option-label">
																					<span class="option-head">
																						<span class="option-title">Virtual Event</span>
																					</span>
																					<span class="option-body">An online gathering where participants join from various locations via the internet.</span>
																				</span>
																			</label>
																		</div>
																	</div>

																</div>
																<div class="separator separator-dashed my-8"></div>
															</div>


															<div id="inPersonForm" style="opacity: 1; transition: opacity 0.5s ease-in-out;">
																<h3 class="mb-10 font-weight-bold text-dark">Select Event Venue</h3>
																<!--begin::Select-->
																<div class="form-group">
																	<label>Venue</label>
																	<select name="venue_name" id="venue_name" value="" class="form-control form-control-solid form-control-lg">
																		<option value="<?php echo $venue_id ?>" disabled selected><?php echo $venue_name ?></option>
																		<?php
																		include('./control/db.php');
																		$try = mysqli_query($conn, "SELECT * FROM venue_tbl WHERE venue_id != $venue_id");
																		while ($row = $try->fetch_array()) {
																			echo '<option value="' . $row['venue_id'] . '">' . $row['venue_name'] . '</option>';
																		}
																		?>
																	</select>
																</div>
																<div class="separator separator-dashed my-8"></div>
															</div>

															<h3 class="mb-10 font-weight-bold text-dark">Set Event Date</h3>
															<label>Select Date</label>
															<div class="form-group row">
																<div class="col-lg-12 col-md-9 col-sm-12">
																	<div class="row">
																		<div class="col">
																			<div class="input-group date" id="kt_datetimepicker_7_1" data-target-input="nearest">
																				<input type="text" class="form-control datetimepicker-input" placeholder="Start date" name="event_start_date" id="event_start_date" data-target="#kt_datetimepicker_7_1" />
																				<div class="input-group-append" data-target="#kt_datetimepicker_7_1" data-toggle="datetimepicker">
																					<span class="input-group-text">
																						<i class="ki ki-calendar"></i>
																					</span>
																				</div>
																			</div>
																		</div>
																		<div class="col">
																			<div class="input-group date" id="kt_datetimepicker_7_2" data-target-input="nearest">
																				<input type="text" class="form-control datetimepicker-input" placeholder="End date" name="event_end_date" id="event_end_date" data-target="#kt_datetimepicker_7_2" />
																				<div class="input-group-append" data-target="#kt_datetimepicker_7_2" data-toggle="datetimepicker">
																					<span class="input-group-text">
																						<i class="ki ki-calendar"></i>
																					</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>


														</form>
														<!--end::Form-->

														<script>
															// Existing toggleForm function remains unchanged
															function toggleForm() {
																const inPersonRadio = document.querySelector('input[name="eventType"][value="inPerson"]');
																const inPersonForm = document.getElementById('inPersonForm');

																if (inPersonRadio.checked) {
																	inPersonForm.style.display = 'block';
																} else {
																	inPersonForm.style.display = 'none';
																}
															}

															// Initial call to set the correct form visibility on page load
															toggleForm();
														</script>

													</div>


													<!--end::Wizard Step 1-->

													<!--begin::Wizard Step 2-->
													<div class="pb-5" data-wizard-type="step-content">
														<h4 class="mb-10 font-weight-bold text-dark">Enter the Details of your Event</h4>
														<!--begin::Input-->
														<div class="form-group">
															<label>Event Title</label>
															<input type="text" class="form-control form-control-solid form-control-lg"
																name="event_title" id="event_title" placeholder="Input Title"
																value="<?php echo $event_title ?>" disabled />
														</div>
														<!--end::Input-->

														<!--begin::Input-->
														<div class="form-group">
															<label>Event Description</label>
															<textarea class="form-control" id="event_description" name="event_description"
																rows="3" disabled><?php echo $event_desc ?></textarea>
														</div>


														<div class="form-group">
															<label>Event Host</label>
															<select name="event_organization" id="event_organization"
																class="form-control form-control-solid form-control-lg">
																<option value="" disabled>Select Host</option>
																<option value="0">KLD Events</option>
																<?php
																include('./control/db.php');
																$try = mysqli_query($conn, "Select * from org_tbl");
																while ($row = $try->fetch_array()) {
																	var_dump($row);
																	echo '<option value="' . $row['org_id'] . '">' . $row['org_name'] . '</option>';
																}
																?>
															</select>
														</div>

														<div class="form-group">
															<label>Event Category</label>
															<select name="event_category" id="event_category" class="form-control form-control-solid form-control-lg">
																<option value="<?php echo $category_id; ?>" disabled selected><?php echo $category_name; ?></option>
																<?php
																include('./control/db.php');

																// Correctly embedding the variable in the query string using double quotes
																$try = mysqli_query($conn, "SELECT * FROM category_tbl WHERE category_id != '$category_id'");

																// Check if the query was successful
																if ($try) {
																	while ($row = $try->fetch_array()) {
																		echo '<option value="' . $row['category_id'] . '">' . htmlspecialchars($row['category_name']) . '</option>';
																	}
																} else {
																	// Handle query error
																	echo '<option value="">Error loading categories</option>';
																}
																?>
															</select>

														</div>



														<!--end::Input-->

													</div>
													<!--end::Wizard Step 2-->

													<!--begin::Wizard Step 3-->
													<div class="pb-5" data-wizard-type="step-content">
														<h4 class="mb-10 font-weight-bold text-dark">Select Event Attendees</h4>

														<div class="form-group row">
															<label class="col-4 text-right col-form-label">Select All KLD Members</label>
															<div class="col-8">
																<span class="switch switch-icon">
																	<label>
																		<input type="checkbox" id="toggleForms" name="select" checked="checked" />
																		<span></span>
																	</label>
																</span>
															</div>
														</div>

														<div id="formContainer" style="display: none;">
															<div class="form-group row">
																<label class="col-lg-4 col-form-label text-right col-sm-12">Select Program</label>
																<div class="col-lg-8 col-md-9 col-sm-12">
																	<select class="form-control select2" id="kt_select2_11" multiple="multiple" name="param" style="width: 100%;" data-placeholder="Select programs...">
																		<optgroup label="KLD Courses">
																			<?php
																			include('./control/db.php');
																			$try = mysqli_query($conn, "SELECT * FROM course_tbl");
																			while ($row = $try->fetch_array()) {
																				echo '<option value="' . $row['course_id'] . '" data-acronym="' . $row['course_acronym'] . '">' . $row['course_name'] . '</option>';
																			}
																			?>
																		</optgroup>
																	</select>
																</div>
															</div>

															<div class="form-group row">
																<label class="col-form-label text-right col-lg-4 col-sm-12">Select Year Level</label>
																<div class="col-lg-8 col-md-9 col-sm-12">
																	<select class="form-control selectpicker" multiple="multiple" id="yrlevel">
																		<option value="1">1st year</option>
																		<option value="2">2nd year</option>
																		<option value="3">3rd year</option>
																		<option value="4">4th year</option>
																	</select>
																</div>
															</div>


															<div class="form-group row">
																<label class="col-4 text-right col-form-label">Select All Sections</label>
																<div class="col-8">
																	<span class="switch switch-icon">
																		<label>
																			<input type="checkbox" id="toggleAllSections" name="select" checked="checked" />
																			<span></span>
																		</label>
																	</span>
																</div>
															</div>
															<div class="form-group row" id="select_sections_container" style="display: none">
																<label class="col-form-label text-right col-lg-4 col-sm-12">Select Section</label>
																<div class="col-lg-8 col-md-9 col-sm-12">
																	<select class="form-control select2" id="kt_select2_3" multiple="multiple" name="section" style="width: 100%;" data-placeholder="Select section...">
																	</select>
																</div>
															</div>


															<div class="separator separator-dashed my-8"></div>


															<div class="form-group row">
																<label class="col-4 text-right col-form-label">Select All Organization</label>
																<div class="col-8">
																	<span class="switch switch-icon">
																		<label>
																			<input type="checkbox" id="toggleAllOrganization" name="select" checked="checked" />
																			<span></span>
																		</label>
																	</span>
																</div>
															</div>
															<div class="form-group row" id="select_organization_container" style="display: none">
																<label class="col-form-label text-right col-lg-4 col-sm-12">Select Organization</label>
																<div class="col-lg-8 col-md-9 col-sm-12">
																	<select class="form-control selectpicker" multiple="multiple" id="kt_select_2_4">
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


															<div class="separator separator-dashed my-8"></div>



														</div>
														<div class="form-group row">
															<label class="col-4 text-right col-form-label">Set Event Capacity</label>
															<div class="col-8">
																<span class="switch switch-icon">
																	<label>
																		<input type="checkbox" id="toggleCap" name="select" />
																		<span></span>
																	</label>
																</span>
															</div>
														</div>

														<div class="form-group row" id="formCapacity" style="display: none;">
															<label class="col-4 text-right col-form-label">Number of Attendees</label>
															<div class="col-8">
																<div class="row">
																	<div class="col-4">
																		<input type="text" class="form-control" id="kt_nouislider_1_input" placeholder="Quantity" />
																	</div>
																	<div class="col-8">
																		<div id="kt_nouislider_1" class="nouislider-drag-danger"></div>
																	</div>
																</div>
																<span class="form-text text-muted mt-2">Move slider or input a number</span>
															</div>
														</div>
													</div>


													<div class="pb-5" data-wizard-type="step-content">
														<h4 class="mb-10 font-weight-bold text-dark">Event Poster</h4>
														<!--begin::Select-->
														<div class="form-group">
															<label></label>
															<div class="col-lg-12 col-md-9 col-sm-12">
																<div class="dropzone dropzone-default" id="kt_dropzone_1">
																	<div class="dropzone-msg dz-message needsclick">
																		<h3 class="dropzone-msg-title">Drop files here or click to upload.
																		</h3>
																		<span class="dropzone-msg-desc">Less than 10MB | JPG, PNG JPEG
																			ONLY</span>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<!--begin::Wizard Step 5-->
													<div class="pb-5" data-wizard-type="step-content">

														<h4 class="mb-10 font-weight-bold text-dark">Letter Proposal</h4>
														<div class="form-group row">
															<div class="col-12 pt-4">
																<textarea class="form-control" id="kt_maxlength_5" maxlength="1500" name="proposal_letter"
																	placeholder="Write your purpose" rows="6"></textarea>
																<span class="form-text text-muted">Maximum of 1,500 characters only</span>
															</div>
														</div>
														<h4 class="mb-10 font-weight-bold text-dark">Admin</h4>
														<?php
														if ($_SESSION['login_type'] === "Administrator") {
															echo '
                                            <div class="form-group">
                                                <div data-repeater-item="" class="form-group row align-items-center">
                                                    <div class="col-md-4">
                                                        <label>Name:</label>
                                                        <input id="admin" type="text" class="form-control" value="' . $_SESSION['kld_fname'] . ' ' . $_SESSION['kld_lname'] . '" disabled />
                                                        <input type="hidden" name="admin_id" id="admin_id" value="' . $_SESSION['kld_id'] . '" /> <!-- Hidden input for admin ID -->
                                                        <div class="d-md-none mb-2"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Role:</label>
                                                        <input type="text" class="form-control" value="' . $_SESSION['kld_admin_role'] . '" disabled />
                                                        <div class="d-md-none mb-2"></div>
                                                    </div>
                                                </div>
                                            </div>';
														}
														?>

														<div id="admin_repeater">
															<div class="form-group row ">
																<div data-repeater-list="" class="col-lg-12">
																	<div data-repeater-item="" class="form-group row align-items-center">
																		<div class="col-md-4">
																			<select class="form-control admin-select" placeholder="Enter full name">
																				<option value="" disabled selected>Choose Admin</option>
																				<?php
																				include('./control/db.php');
																				$try = mysqli_query($conn, "SELECT * FROM admin_acc where admin_uname != '" . $_SESSION['kld_username'] . "'");
																				while ($row = $try->fetch_array()) {
																					echo '<option value="' . $row['admin_id'] . '" data-role="' . $row['admin_role'] . '">' . $row['admin_fname'] . ' ' . $row['admin_lname'] . '</option>';
																				}
																				?>
																			</select>
																			<div class="d-md-none mb-2"></div>
																		</div>
																		<div class="col-md-4">
																			<input type="text" class="form-control admin-role" placeholder="Administrator Role" disabled />
																			<div class="d-md-none mb-2"></div>
																		</div>
																		<div class="col-md-2">
																			<a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
																				<i class="la la-trash-o"></i>Delete</a>
																		</div>

																	</div>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-lg-2 col-form-label text-right"></label>
																<div class="col-lg-4">
																	<a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
																		<i class="la la-plus"></i>Add</a>
																</div>
															</div>
														</div>
														<div class="separator separator-dashed my-8"></div>
														<h4 class="mb-10 font-weight-bold text-dark">Organizer</h4>


														<div id="org_repeater">
															<div class="form-group row">
																<div data-repeater-list="another_list" class="col-lg-12">
																	<div data-repeater-item class="form-group row align-items-center">
																		<div class="col-lg-4">
																			<select id="event_organizer" class="form-control another-org-select" placeholder="Choose Another Organizer">
																				<option value="" disabled selected>Choose Organizer</option>
																				<?php
																				// Fetching organizer details including org_name
																				$try = mysqli_query($conn, "SELECT org_acc.org_acc_id, org_acc.org_role, org_acc.org_fname, org_acc.org_lname, org_tbl.org_name 
                                                                        FROM org_acc 
                                                                        JOIN org_tbl ON org_tbl.org_id = org_acc.org_id 
                                                                        WHERE org_role = 'Event Manager'");
																				while ($row = $try->fetch_array()) {
																					echo '<option value="' . $row['org_acc_id'] . '" data-org="' . $row['org_name'] . '">' . $row['org_fname'] . ' ' . $row['org_lname'] . '</option>';
																				}
																				?>
																			</select>

																			<div class="d-md-none mb-2"></div>
																		</div>
																		<div class="col-lg-4">
																			<input type="text" class="form-control another-org-name" placeholder="Organization" disabled />
																			<div class="d-md-none mb-2"></div>
																		</div>

																		<div class="col-md-2">
																			<a href="javascript:;" data-repeater-delete class="btn btn-sm font-weight-bolder btn-light-danger">
																				<i class="la la-trash-o"></i>Delete
																			</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="form-group row">

																<label class="col-lg-2 col-form-label text-right"></label>
																<div class="col-lg-4">
																	<a href="javascript:;" data-repeater-create class="btn btn-sm font-weight-bolder btn-light-primary">
																		<i class="la la-plus"></i> Add
																	</a>
																</div>
															</div>
														</div>
													</div>
													<!--end::Wizard Step 5-->

													<!--end::Wizard Step 3-->


													<!--begin::Wizard Step 5-->
													<!--end::Wizard Step 5-->


													<!--begin::Wizard Actions-->
													<div class="d-flex justify-content-between border-top mt-5 pt-10">
														<div class="mr-2">
															<button type="button"
																class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4"
																data-wizard-type="action-prev">
																Previous
															</button>
														</div>
														<div>
															<a href="?page=letter">
																<button type="button"
																	class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4"
																	data-wizard-type="action-submit">
																	Preview
																</button>
															</a>
															<button type="button" id="event_submit" name="event_submit"
																class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
																data-wizard-type="action-submit">
																Submit
															</button>

															<button type="button" id="event_next_button" name="event_next_button"
																class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
																data-wizard-type="action-next">
																Next
															</button>
														</div>
													</div>
													<!--end::Wizard Actions-->
												</form>
												<!--end::Wizard Form-->
											</div>
										</div>
										<!--end::Wizard Body-->
									</div>
									<!--end::Wizard-->
								</div>
								<!--end::Wizard-->
							</div>


						</div>

						<div class="tab-pane fade" id="proposal" role="tabpanel" aria-labelledby="proposal-tab-4">

							<h5>Pre-Event Information</h5>

							<div class="card card-custom">
								<div class="card-body p-0">
									<!--begin: Wizard-->
									<div class="wizard wizard-2" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
										<!--begin: Wizard Nav-->
										<div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
											<!--begin::Wizard Step 1 Nav-->
											<div class="wizard-steps">
												<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
													<div class="wizard-wrapper">
														<div class="wizard-icon">
															<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Image.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24" />
																		<path d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z" fill="#000000" />
																	</g>
																</svg><!--end::Svg Icon--></span>
															<!--end::Svg Icon-->
															</span>
														</div>
														<div class="wizard-label">
															<h3 class="wizard-title">Event Guidelines</h3>
															<div class="wizard-desc">Policies, FAQs, and other informations</div>
														</div>
													</div>
												</div>
												<!--end::Wizard Step 1 Nav-->
												<!--begin::Wizard Step 2 Nav-->
												<div class="wizard-step" data-wizard-type="step">
													<div class="wizard-wrapper">
														<div class="wizard-icon">
															<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Time-schedule.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<path d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z" fill="#000000" />
																		<path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" fill="#000000" opacity="0.3" />
																	</g>
																</svg><!--end::Svg Icon--></span>
														</div>
														<div class="wizard-label">
															<h3 class="wizard-title">Program Agenda</h3>
															<div class="wizard-desc">Event timeline</div>
														</div>
													</div>
												</div>
												<!--end::Wizard Step 2 Nav-->
												<!--begin::Wizard Step 3 Nav-->
												<div class="wizard-step" data-wizard-type="step">
													<div class="wizard-wrapper">
														<div class="wizard-icon">
															<span class="svg-icon svg-icon-primary svg-icon-2x">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24" />
																		<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<rect fill="#000000" x="6" y="11" width="9" height="2" rx="1" />
																		<rect fill="#000000" x="6" y="15" width="5" height="2" rx="1" />


																	</g>
																</svg><!--end::Svg Icon--></span>
														</div>
														<div class="wizard-label">
															<h3 class="wizard-title">Event Attachments</h3>
															<div class="wizard-desc">Forms, documents, printables, and such.</div>
														</div>
													</div>
												</div>
												<!--end::Wizard Step 3 Nav-->
												<!--begin::Wizard Step 4 Nav-->
												<div class="wizard-step" data-wizard-type="step">
													<div class="wizard-wrapper">
														<div class="wizard-icon">
															<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24" />
																		<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg><!--end::Svg Icon--></span>
														</div>
														<div class="wizard-label">
															<h3 class="wizard-title">Event Checklist</h3>
															<div class="wizard-desc">Keep organizers on top of tasks.</div>
															<div class="wizard-desc"></div>
														</div>
													</div>
												</div>
												<!--end::Wizard Step 4 Nav-->
											</div>
										</div>
										<!--end: Wizard Nav-->
										<!--begin: Wizard Body-->
										<div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
											<!--begin: Wizard Form-->
											<div class="row">
												<div class="offset-xxl-2 col-xxl-8">
													<form class="form" id="kt_form">
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
															<h4 class="mb-10 font-weight-bold text-dark">Event Contents</h4>
															<div id="add_info_content" class="kt-repeater">
																<div data-repeater-list="image_list" class="col-lg-12">
																	<div data-repeater-item class="form-group row align-items-center kt-repeater-item">

																		<!-- Dropzone -->
																		<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
																			<div class="dropzone dropzone-multi dynamic-dropzone" id="kt_dropzone_6">

																				<div class="dropzone-panel mb-lg-0 mb-2">
																					<a class="dropzone-select btn btn-outline-primary btn-lg">
																						<i class="flaticon2-image-file"></i> Upload Image Here
																					</a>
																					<a class="dropzone-upload btn btn-light-primary font-weight-bold btn-sm">Upload All</a>
																					<a class="dropzone-remove-all btn btn-light-primary font-weight-bold btn-sm">Remove All</a>
																				</div>
																				<div class="dropzone-items">
																					<div class="dropzone-item" style="display:none">
																						<div class="dropzone-file">
																							<div class="dropzone-filename" title="some_image_file_name.jpg">
																								<span data-dz-name="">some_image_file_name.jpg</span>
																								<strong>(<span data-dz-size="">340kb</span>)</strong>
																							</div>
																							<div class="dropzone-error" data-dz-errormessage=""></div>
																						</div>
																						<div class="dropzone-progress">
																							<div class="progress">
																								<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
																							</div>
																						</div>
																						<div class="dropzone-toolbar">
																							<span class="dropzone-start">
																								<i class="flaticon2-arrow"></i>
																							</span>
																							<span class="dropzone-cancel" data-dz-remove="" style="display: none;">
																								<i class="flaticon2-cross"></i>
																							</span>
																							<span class="dropzone-delete" data-dz-remove="">
																								<i class="flaticon2-cross"></i>
																							</span>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>

																		<!-- Input Field -->
																		<div class="col-lg-6 col-md-12 col-sm-12 mb-3">
																			<input type="text" class="form-control" placeholder="Insert Title Here" />
																		</div>


																		<!-- Description -->
																		<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
																			<textarea class="form-control" placeholder="Enter short description." rows="3"></textarea>
																		</div>

																		<!-- Delete Button -->
																		<div class="col-lg-4 col-md-6 col-sm-12">
																			<a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
																				<i class="la la-trash-o"></i> Delete
																			</a>
																		</div>
																	</div>
																</div>

																<!-- Add Button -->
																<div class="form-group row">
																	<div class="col-lg-4 col-md-6 col-sm-12">
																		<a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
																			<i class="la la-plus"></i> Add
																		</a>
																	</div>
																</div>
															</div>
														</div>
														<!-- Second Repeater for Event Program -->
														<div class="pb-5" data-wizard-type="step-content">
															<h4 class="mb-10 font-weight-bold text-dark">Set Event Program</h4>
															<div id="add_info_agenda" class="kt-repeater">
																<div data-repeater-list="program_list" class="col-lg-12">
																	<div data-repeater-item class="form-group row align-items-center kt-repeater-item">
																		<!-- Timepicker -->
																		<div class="col-lg-4 col-md-12 col-sm-12 mb-3">
																			<div class="input-group timepicker">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-clock-o"></i>
																					</span>
																				</div>
																				<input class="form-control agenda_tp" id="agenda_tp_1" readonly placeholder="Select time" type="text" />
																			</div>
																		</div>

																		<!-- Title -->
																		<div class="col-lg-6 col-md-12 col-sm-12 mb-3">
																			<input type="text" class="form-control" placeholder="Insert Title Here" />
																		</div>

																		<!-- Delete Button -->
																		<div class="col-lg-2 col-md-12 col-sm-12 mb-3">
																			<a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
																				<i class="la la-trash-o"></i>
																			</a>
																		</div>

																		<!-- Description -->
																		<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
																			<textarea class="form-control" placeholder="Enter short description." rows="3"></textarea>
																		</div>
																	</div>
																</div>

																<!-- Add Button -->
																<div class="form-group row">
																	<div class="col-12 col-md-6 col-sm-12">
																		<a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
																			<i class="la la-plus"></i> Add
																		</a>
																	</div>
																</div>
															</div>
														</div>

														<!--end: Wizard Step 2-->
														<!--begin: Wizard Step 3-->
														<div class="pb-5" data-wizard-type="step-content">
															<h4 class="mb-10 font-weight-bold text-dark">Attachment File(s)</h4>

															<div class="form-group row">
																<div class="col-lg-9 mb-3">
																	<div class="dropzone dropzone-multi" id="kt_dropzone_4">

																		<div class="dropzone-panel mb-lg-0 mb-2">
																			<a class="dropzone-select btn btn-light-primary font-weight-bold btn-sm">Attach files</a>
																			<a class="dropzone-upload btn btn-light-primary font-weight-bold btn-sm">Upload All</a>
																			<a class="dropzone-remove-all btn btn-light-primary font-weight-bold btn-sm">Remove All</a>
																		</div>
																		<div class="dropzone-items">
																			<div class="dropzone-item" style="display:none">
																				<div class="dropzone-file">
																					<div class="dropzone-filename" title="some_image_file_name.jpg">
																						<span data-dz-name="">some_image_file_name.jpg</span>
																						<strong>(
																							<span data-dz-size="">340kb</span>)</strong>
																					</div>
																					<div class="dropzone-error" data-dz-errormessage=""></div>
																				</div>
																				<div class="dropzone-progress">
																					<div class="progress">
																						<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
																					</div>
																				</div>
																				<div class="dropzone-toolbar">
																					<span class="dropzone-start">
																						<i class="flaticon2-arrow"></i>
																					</span>
																					<span class="dropzone-cancel" data-dz-remove="" style="display: none;">
																						<i class="flaticon2-cross"></i>
																					</span>
																					<span class="dropzone-delete" data-dz-remove="">
																						<i class="flaticon2-cross"></i>
																					</span>
																				</div>
																			</div>
																		</div>
																	</div>

																</div>

																<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
																	<textarea class="form-control" placeholder="Enter short description" rows="3"></textarea>
																</div>

															</div>


															<div class="separator separator-solid my-5"></div>


															<h4 class="mb-10 font-weight-bold text-dark">Event Link</h4>




															<div id="kt_repeater_3" class="kt-repeater">
																<div data-repeater-list="attachment" class="col-lg-12">
																	<div data-repeater-item class="form-group row align-items-center kt-repeater-item">
																		<!-- Timepicker -->
																		<div class="form-group row">
																			<div class="col-lg-6 col-md-12 col-sm-12 mb-3">
																				<input type="text" class="form-control" placeholder="Insert Title Here" />
																			</div>
																			<div class="col-lg-3 col-md-12 col-sm-12 mb-3">
																				<a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
																					<i class="la la-trash-o"></i>
																				</a>
																			</div>

																			<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
																				<textarea class="form-control" placeholder="https://kld.edu.ph/kld-events" rows="3"></textarea>
																			</div>


																		</div>
																	</div>

																	<!-- Add Button -->

																</div>
																<div class="form-group row">
																	<div class="col-12 col-md-6 col-sm-12">
																		<a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
																			<i class="la la-plus"></i> Add
																		</a>
																	</div>
																</div>


															</div>
														</div>
														<!--end: Wizard Step 3-->
														<!--begin: Wizard Step 4-->
														<div class="pb-5" data-wizard-type="step-content">
															<h4 class="mb-10 font-weight-bold text-dark">To-Do List</h4>

															<div id="add_info_todo" class="kt-repeater">
																<div data-repeater-list="attachment" class="col-lg-12">
																	<div data-repeater-item class="form-group row align-items-center kt-repeater-item">
																		<!-- Timepicker -->
																		<div class="form-group row">
																			<div class="col-lg-6 col-md-12 col-sm-12 mb-3">
																				<input type="text" class="form-control" placeholder="Insert Title Here" />
																			</div>
																			<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
																				<textarea class="form-control" placeholder="Enter Task Here..." rows="3"></textarea>
																			</div>
																			<label class="col-lg-2 col-form-label text-right">Due Date:</label>
																			<div class="col-lg-8 col-md-12 col-sm-12 mb-3">
																				<div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
																					<input type="text" class="form-control datetimepicker-input" placeholder="Select date & time" data-target="#kt_datetimepicker_1" />
																					<div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
																						<span class="input-group-text">
																							<i class="ki ki-calendar"></i>
																						</span>
																					</div>
																				</div>
																			</div>
																			<div class="col-lg-3 col-md-12 col-sm-12 mb-3">
																				<a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
																					<i class="la la-trash-o"></i>
																				</a>
																			</div>



																		</div>
																	</div>

																	<!-- Add Button -->

																</div>
																<div class="form-group row">
																	<div class="col-12 col-md-6 col-sm-12">
																		<a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
																			<i class="la la-plus"></i> Add
																		</a>
																	</div>
																</div>


															</div>

														</div>
														<!--end: Wizard Step 4-->
														<!--begin: Wizard Actions-->
														<div class="d-flex justify-content-between border-top mt-5 pt-10">
															<div class="mr-2">
																<button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
															</div>
															<div>
																<button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4">Save Changes</button>
																<button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Next</button>
															</div>
														</div>
														<!--end: Wizard Actions-->
													</form>
												</div>
												<!--end: Wizard-->
											</div>
											<!--end: Wizard Form-->
										</div>
										<!--end: Wizard Body-->
									</div>
									<!--end: Wizard-->
								</div>
							</div>

						</div>

						<div class="tab-pane fade" id="feedback-4" role="tabpanel" aria-labelledby="feedback-tab-4">
							<div class="row justify-content-center">
								<div class="kt-repeater feedback-cat col-lg-8"> <!-- Changed ID to class -->
									<div data-repeater-list="feedback">
										<div data-repeater-item class="form-group row align-items-center kt-repeater-item">
											<div class="col-12">
												<!--begin::Card-->
												<div class="card card-custom gutter-b example example-compact">
													<div class="card-header">
														<h3 class="card-title">Feedback Form</h3>
													</div>
													<form class="form">
														<div class="card-body">
															<div class="form-group">
																<label>Category:</label>
																<input type="text" class="form-control" placeholder="Venue Management" />
															</div>

															<label>Questions:</label>
															<div class="kt-repeater feedback-question"> <!-- Changed ID to class -->
																<div data-repeater-list="questions">
																	<div data-repeater-item class="form-group kt-repeater-item">
																		<div class="form-group row">
																			<div class="col-lg-9 col-md-10 col-sm-12 mb-3">
																				<input type="text" class="form-control" placeholder="The answer to the question is quite good." />
																			</div>
																			<div class="col-lg-2 col-md-4 col-sm-12 mb-3">
																				<select class="form-control">
																					<option>Likert Scale</option>
																					<option>Essay Type</option>
																				</select>
																			</div>
																			<div class="col-lg-1 col-md-12 col-sm-12 mb-3">
																				<a href="javascript:;" data-repeater-delete class="btn btn-sm font-weight-bolder btn-light-danger">
																					<i class="la la-trash-o"></i>
																				</a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-12 d-flex mt-3">
																	<a href="javascript:;" data-repeater-create class="btn font-weight-bolder btn-primary">
																		<i class="la la-plus"></i> Add Question
																	</a>
																</div>
															</div>
														</div>
														<div class="card-footer">
															<div class="row">
																<div class="col text-right">
																	<button type="button" data-repeater-delete class="btn btn-danger">Delete</button>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 d-flex justify-content-around mt-3">
										<a href="javascript:;" data-repeater-create class="btn btn-lg font-weight-bolder btn-light-primary">
											<i class="la la-plus"></i> Add Category
										</a>
										<a href="" data-repeater-create class="btn btn-lg font-weight-bolder btn-success">
											<i class="la la-save"></i> Save Changes
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!--end::Example-->
		</div>

		<div class="separator separator-solid separator-border-4"></div>

		<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="row">
					<div class="modal-content">
						<div class="alert alert-info mb-5 p-5" role="alert">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i aria-hidden="true" class="ki ki-close"></i>
							</button>
							<h4 class="alert-heading">Well done!</h4>

							<p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
						</div>
					</div>

					<div class="modal-content">
						<div class="alert alert-info mb-5 p-5" role="alert">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i aria-hidden="true" class="ki ki-close"></i>
							</button>
							<h4 class="alert-heading">Well done!</h4>

							<p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
						</div>
					</div>

				</div>

			</div>
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

		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>