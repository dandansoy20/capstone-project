<?php
// Include the database connection
include('./control/db.php');

// Check if the 'event_id' parameter exists in the URL
if (isset($_GET['event_id']) && isset($_GET['emp_id'])) {
    $eventId = $_GET['event_id'];
    $emp_id = $_GET['emp_id'];


    // Prepare the SQL statement to fetch events for the specific event ID
    $query = "SELECT 
                kld_event.*, 
                org_tbl.org_name, 
				org_tbl.org_pic,
                category_tbl.category_name,
                venue_tbl.*

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
                $event_type = $row['event_type'];
                $event_time = date("h:i A", strtotime($row['event_start_date']));
                $event_date_created = date("F d, Y", strtotime($row['event_created']));
                $event_desc = $row['event_desc'];
                $org_name = $row['org_name'] ?? "KLD Events";
                $org_profile = isset($row['org_pic']) ? base64_decode($row['org_pic']) : "assets/media/logos/kldlogo.png";
                $category_name = $row['category_name'];
                $venue_name = $row['venue_name'] ?? "Virtual Event";
                $event_poster = base64_decode($row["event_poster"]) ?? " ";
                $venue_id = $row['venue_id'];
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

        <div class="d-flex flex-column flex-md-row pt-8">
            <!--begin::Aside-->
            <div class="flex-md-row-auto w-md-275px w-xl-325px">
                <!--begin::Nav Panel Widget 3-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Wrapper-->
                        <div class="d-flex justify-content-between flex-column h-100">
                            <!--begin::Container-->
                            <div class="h-100">
                                <!--begin::Header-->
                                <div class="d-flex flex-column flex-center">
                                    <!--begin::Image-->
                                    <div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url(<?php echo $event_poster ?>)"></div>
                                    <!--end::Image-->

                                    <!--begin::Title-->
                                    <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1"><?php echo $event_title ?></a>
                                    <!--end::Title-->

                                    <!--begin::Text-->
                                    <div class="font-weight-bold text-dark-50 font-size-sm pb-7"><?php echo $event_desc ?></div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="pt-1">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center pb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-2x svg-icon-dark-50"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Location.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path d="M12,2 C8.6862915,2 6,4.6862915 6,8 C6,12.25 12,22 12,22 C12,22 18,12.25 18,8 C18,4.6862915 15.3137085,2 12,2 Z M12,11 C10.3431458,11 9,9.65685425 9,8 C9,6.34314575 10.3431458,5 12,5 C13.6568542,5 15,6.34314575 15,8 C15,9.65685425 13.6568542,11 12,11 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                        </div>
                                        <!--end::Symbol-->

                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"><?php echo $venue_name ?></a>
                                            <span class="text-muted font-weight-bold">Venue</span>
                                        </div>
                                        <!--end::Text-->

                                        <!--begin::label--><!-- 
                                        <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">3.2</span> -->
                                        <!--end::label-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center pb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-2x svg-icon-dark-50"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Layout/Layout-top-panel-6.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Layout / Layout-top-panel-6</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                                                            <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span> </span>
                                        </div>
                                        <!--end::Symbol-->

                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"><?php echo $event_date ?></a>
                                            <span class="text-muted font-weight-bold">Date & Time</span>
                                        </div>
                                        <!--end::Text-->

                                        <!--begin::label--><!-- 
                                        <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">582</span> -->
                                        <!--end::label-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center pb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-2x svg-icon-dark-50"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Globe.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"></path>
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"></circle>
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span> </span>
                                        </div>
                                        <!--end::Symbol-->

                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"><?php echo $category_name ?></a>
                                            <span class="text-muted font-weight-bold">Category</span>
                                        </div>
                                        <!--end::Text-->

                                        <!--begin::label--><!-- 
                                        <span class="font-weight-bolder label label-xl label-light-primary label-inline py-5 min-w-45px">74</span> -->
                                        <!--end::label-->
                                    </div>
                                    <!--end::Item-->

                                </div>
                                <!--end::Body-->
                            </div>
                            <!--eng::Container-->

                            <!--begin::Footer-->
                            <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_2" data-toggle="tooltip" title="" data-placement="right" data-original-title="View Attended Event">
                                <a href="?page=attended-view&event_id=<?php echo $eventId ?>" class="btn btn-light-primary font-weight-bolder font-size-sm py-3 px-14">View Event</a>
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Nav Panel Widget 3-->

            </div>
            <!--end::Aside-->

            <!--begin::Content-->
            <div class="flex-md-row-fluid ml-md-6 ml-lg-8">
                <div class="row">
                    <div class="col-xxl-8">



                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="card-icon">
                                        <i class="flaticon2-line-chart text-primary"></i>
                                    </span>
                                    <h3 class="card-label">
                                        KLD Events Evaluation
                                        <small>Feedback Form</small>
                                    </h3>
                                </div>
                            </div>
                        </div>


                        <!--begin::Forms Widget 4-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--end::Top-->
                                <div class="accordion accordion-light  accordion-toggle-arrow" id="accordionExample5">
                                    <div class="card">
                                        <div class="card-header" id="headingOne5">
                                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne5">
                                                <i class="icon-xl la la-lock"></i> Privacy Statement
                                            </div>
                                        </div>
                                        <div id="collapseOne5" class="collapse show" data-parent="#accordionExample5">
                                            <div class="card-body">
                                                <span class="text-dark-75 text-hover-primary font-size-lg font-weight-bolder">Privacy Statement</span>

                                                <p class="text-dark-75 font-size-lg font-weight-normal mt-2 mb-2 d-flex justify-content-center text-justify">
                                                    We are committed to protecting and respecting your privacy. Any personal information you provide during
                                                    the data collection will be treated with the utmost care and used only for its intended purpose Your data
                                                    remains confidential and will not be shared with any third parties without your explicit consent. We will
                                                    ensure that your data is stored securely and in accordance with any legal and regulatory standards and in
                                                    compliance with the “Data Privacy Act of 2012”. Your participation in this collection is voluntary, and you
                                                    have the right to withdraw your consent at any time. By participating, you acknowledge that you have read
                                                    and understood this data privacy statement.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo5">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo5">
                                                <i class="flaticon2-user"></i> Participant's Profile
                                            </div>
                                        </div>
                                        <div id="collapseTwo5" class="collapse" data-parent="#accordionExample5">
                                            <div class="card-body">
                                                <div class="d-flex pt-4">
                                                    <div class="d-flex align-items-center pr-5">
                                                        <span class="text-dark-50 font-size-lg font-weight-bold pr-1">Full Name:</span> <span class="text-dark font-size-lg font-weight-bold"><?php echo $_SESSION['kld_fname'] . ' ' . $_SESSION['kld_lname']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex pt-4">
                                                    <div class="d-flex align-items-center pr-5">
                                                        <span class="text-dark-50 font-size-lg font-weight-bold pr-1">KLD Email:</span> <span class="text-dark font-size-lg font-weight-bold"><?php echo $_SESSION['kld_email'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex pt-4">
                                                    <div class="d-flex align-items-center pr-5">
                                                        <span class="text-dark-50 font-size-lg font-weight-bold pr-1">KLD ID:</span> <span class="text-dark font-size-lg font-weight-bold"><?php echo $_SESSION['kld_emp_id'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex pt-4">
                                                    <div class="d-flex align-items-center pr-5">
                                                        <span class="text-dark-50 font-size-lg font-weight-bold pr-1">Office / Organization:</span> <span class="text-dark font-size-lg font-weight-bold"><?php echo $_SESSION['kld_org'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex pt-4">
                                                    <div class="d-flex align-items-center pr-5">
                                                        <span class="text-dark-50 font-size-lg font-weight-bold pr-1">Role:</span> <span class="text-dark font-size-lg font-weight-bold"><?php echo $_SESSION['kld_role'] ?></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Forms Widget 4-->

                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="card-icon">
                                        <i class="flaticon-warning-sign text-warning"></i>
                                    </span>
                                    <h3 class="card-label">
                                        Privacy Statement
                                        <small>Feedback Form</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <div class="checkbox-list">
                                            <label class="checkbox">
                                                <input type="checkbox" name="agree_form" id="agree_form" data-gtm-form-interact-field-id="1">
                                                <span></span>
                                                I agree to the data privacy statement
                                            </label>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>

                        <!-- Feedback Forms -->
                        <div id="feedback-forms-emp" class="d-none">

                            <form id="feedback_form_emp">
                                <?php
                                // Include the database connection
                                include('./control/db.php');

                                // Prepare and execute the query
                                $query = "SELECT * FROM question_cat_tbl WHERE event_type='$event_type'";
                                $try = mysqli_query($conn, $query);

                                while ($row = $try->fetch_array()) {
                                    $question_cat_id = $row['question_cat_id'];
                                    $question_cat = $row['question_cat_name'];
                                ?>

                                    <!--begin::Forms Widget 3-->
                                    <div class="card card-custom gutter-b ">
                                        <div class="card-header ribbon ribbon-top ribbon-ver">
                                            <div class="ribbon-target bg-danger" style="top: -2px; right: 20px;">Required</div>

                                            <div class="card-title">
                                                <span class="card-icon">
                                                    <i class="icon text-primary flaticon-questions-circular-button"></i>
                                                </span>
                                                <h3 class="card-label">
                                                    <?php echo htmlspecialchars($question_cat, ENT_QUOTES, 'UTF-8'); ?>

                                                </h3>
                                            </div>
                                        </div>
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin::Header-->
                                            <?php
                                            // Fetch questions related to the category
                                            $query = "SELECT * FROM question_tbl WHERE event_type='$event_type' AND question_cat_id='$question_cat_id'";
                                            $tryQuestions = mysqli_query($conn, $query);

                                            while ($rowQuestion = $tryQuestions->fetch_array()) {
                                                $question_id = $rowQuestion['question_id'];
                                                $question = $rowQuestion['question'];
                                            ?>
                                                <form>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-column flex-grow-1">
                                                            <span class="text-dark-75 text-hover-primary font-size-lg font-weight-bolder"><?php echo htmlspecialchars($question, ENT_QUOTES, 'UTF-8'); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="pt-5 text-center">
                                                            <div class="form-group row justify-content-center">
                                                                <div class="col-12 col-form-label text-center">
                                                                    <div class="radio-inline d-flex justify-content-around align-items-center flex-wrap">
                                                                        <label class="radio radio-danger mx-2">
                                                                            <input type="radio" name="question_<?php echo $question_id; ?>" id="question_<?php echo $question_id; ?>_strongly_disagree" value="Strongly Disagree" />
                                                                            <span></span>
                                                                            Strongly<br>Disagree
                                                                        </label>
                                                                        <label class="radio radio-danger mx-2">
                                                                            <input type="radio" name="question_<?php echo $question_id; ?>" id="question_<?php echo $question_id; ?>_disagree" value="Disagree" />
                                                                            <span></span>
                                                                            Disagree
                                                                        </label>
                                                                        <label class="radio radio-warning mx-2">
                                                                            <input type="radio" name="question_<?php echo $question_id; ?>" id="question_<?php echo $question_id; ?>_neutral" value="Neutral" />
                                                                            <span></span>
                                                                            Neutral
                                                                        </label>
                                                                        <label class="radio radio-primary mx-2">
                                                                            <input type="radio" name="question_<?php echo $question_id; ?>" id="question_<?php echo $question_id; ?>_agree" value="Agree" />
                                                                            <span></span>
                                                                            Agree
                                                                        </label>
                                                                        <label class="radio radio-success mx-2">
                                                                            <input type="radio" name="question_<?php echo $question_id; ?>" id="question_<?php echo $question_id; ?>_strongly_agree" value="Strongly Agree" />
                                                                            <span></span>
                                                                            Strongly<br>Agree
                                                                        </label>

                                                                        <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emp_id ?>">
                                                                        <input type="hidden" name="event_id" id="event_id" value="<?php echo $eventId ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                            <div class="separator separator-solid mt-2 mb-4"></div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </form>

                            <div class="text-center pb-7 pb-xxl-1 mb-10">
                                <div class="form-group">
                                    <button class="btn btn-light-warning font-weight-bolder font-size-sm py-3 px-9" id="">Back</button>
                                    <button class="btn btn-light-primary font-weight-bolder font-size-sm py-3 px-9" id="submit_feedback_emp" type="submit" name="submit_feedback_emp">Submit</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>