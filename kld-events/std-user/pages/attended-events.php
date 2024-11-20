<!--begin::Entry-->
<div class="d-flex flex-column-fluid pt-10">
    <!--begin::Container-->
    <div class=" container ">

        <!--begin::Row-->

        <div class="row">
            <?php
            include('./control/db.php');
            $events_query = "
            SELECT DISTINCT e.*
            FROM kld_event e
            JOIN event_invitation ei ON e.event_id = ei.event_id
            JOIN std_acc sa ON 
                (ei.course_id IS NULL OR ei.course_id = sa.course_id)
                AND (ei.yearlvl_id IS NULL OR ei.yearlvl_id = sa.yearlvl)
                AND (ei.section_id IS NULL OR ei.section_id = sa.section_id)
            JOIN attendance_tbl at ON e.event_id = at.event_id AND at.std_id = sa.std_id
            WHERE 
                (
                    (ei.course_id IS NULL AND ei.yearlvl_id IS NULL AND ei.section_id IS NULL) 
                    OR (ei.course_id = sa.course_id AND ei.yearlvl_id IS NULL AND ei.section_id IS NULL)
                    OR (ei.course_id IS NULL AND ei.yearlvl_id = sa.yearlvl AND ei.section_id IS NULL)
                    OR (ei.course_id = sa.course_id AND ei.yearlvl_id = sa.yearlvl AND ei.section_id = sa.section_id)
                )
                AND sa.std_id = '$_SESSION[kld_id]'
                AND e.status = 'completed'
            ORDER BY e.event_created DESC;
        ";

            $events_result = mysqli_query($conn, $events_query);

            while ($event = mysqli_fetch_assoc($events_result)) {

                $event_id = $event['event_id'];
                $event_title = $event['event_title'];
                $event_poster = base64_decode($event["event_poster"]);
                $event_created = date("F d, Y g:i A", strtotime($event['event_created']));
                $event_date = date("F d, Y", strtotime($event['event_start_date']));
                $event_time = date("h:i A", strtotime($event['event_start_date']));
                $venue_id = $event['venue_id'];
                $category_id = $event['category_id'];
                $org_id = $event['event_org_id'];
                $event_desc = $event['event_desc'];
                $status = $event['status'];

                // Fetch venue name from venue_tbl
                $venue_query = "SELECT venue_name FROM venue_tbl WHERE venue_id = '$venue_id'";
                $venue_result = mysqli_query($conn, $venue_query);
                $venue_row = mysqli_fetch_assoc($venue_result);
                $venue_name = (isset($venue_row['venue_name']) && $venue_row['venue_name'] !== '') ? $venue_row['venue_name'] : 'Virtual Event';
                // Fetch category name from category_tbl
                $category_query = "SELECT category_name FROM category_tbl WHERE category_id = '$category_id'";
                $category_result = mysqli_query($conn, $category_query);
                $category_name = mysqli_fetch_assoc($category_result)['category_name'];

                if ($org_id == 0) {
                    $org_name = 'KLD Events';
                    $org_profile = 'assets/media/logos/kldlogo.png';
                } else {
                    // Fetch org name from org_tbl
                    $org_query = "SELECT org_name, org_pic FROM org_tbl WHERE org_id = '$org_id'";
                    $org_result = mysqli_query($conn, $org_query);
                    $org_row = mysqli_fetch_assoc($org_result);
                    if ($org_row) {
                        $org_name = $org_row['org_name'];
                        $org_profile = base64_decode($org_row['org_pic']);
                    } else {
                        $org_name = '';
                    }
                }

            ?>

                <div class="col-xxl-6">
                    <div class="card card-custom gutter-b card-stretch ">
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
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"><?php echo $org_name; ?>

                                        <?php
                                        include('./control/db.php');

                                        // Check if the student is registered for the event
                                        $try = mysqli_query($conn, "SELECT * FROM feedback_tbl WHERE event_id = '$event_id' AND std_id = '$_SESSION[kld_id]'");

                                        // If there's at least one row returned, it means the student is registered
                                        if (mysqli_num_rows($try) > 0) {
                                            echo '<span class="label label-warning label-inline ml-2">Evaluated</span>';
                                        }
                                        ?>

                                    </a>
                                    <span class="text-muted font-weight-bold"><?php echo $event_created; ?></span>
                                </div>
                            </div>
                            <p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">
                                <?php echo $event_desc; ?>
                            </p>
                            <div class="pt-4">
                                <div class="bgi-no-repeat bgi-size-cover rounded min-h-295px" style="background-image: url(<?php echo $event_poster; ?>)" data-toggle="modal" data-target="#imageModal_<?php echo $event_id; ?>"></div>

                                <div class="d-flex pt-4">
                                    <div class="d-flex align-items-center pr-5">
                                        <span class="svg-icon svg-icon-md svg-icon-primary pr-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

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
                                        <?php if ($venue_id == 0) {
                                            $type = "Type: ";
                                        ?>
                                            <span class="svg-icon svg-icon-md svg-icon-primary pr-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                    <defs />
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,6 L19,6 C19.5522847,6 20,6.44771525 20,7 L20,17 L4,17 L4,7 C4,6.44771525 4.44771525,6 5,6 Z" fill="#000000" />
                                                        <rect fill="#000000" opacity="0.3" x="1" y="18" width="22" height="1" rx="0.5" />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                        <?php } else {
                                            $type = "Venue: "
                                        ?>
                                            <span class="svg-icon svg-icon-md svg-icon-primary pr-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                    <defs />
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                        <?php } ?>
                                        <span class="text-dark-50 font-weight-bold pr-1"><?php echo $type; ?></span> <span class="text-dark font-weight-bold"><?php echo  $venue_name; ?></span>
                                    </div>
                                </div>
                                <div class="d-flex pt-2">
                                    <div class="d-flex align-items-center pr-5">
                                        <span class="svg-icon svg-icon-md svg-icon-primary pr-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">


                                                <defs />
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                                                    <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
                                                </g>
                                            </svg><!--end::Svg Icon--></span> <span class="text-dark font-weight-bold"><?php echo $event_date; ?></span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-md svg-icon-primary pr-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                        <span class="svg-icon svg-icon-md svg-icon-primary pr-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

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
                            </div>
                            <div class="separator separator-solid mt-2 mb-4"></div>

                            <form class="position-relative">
                                <textarea id="kt_forms_widget_4_input" class="form-control border-0 p-0 pr-10 resize-none" rows="1" placeholder="" style="overflow: hidden; overflow-wrap: break-word; height: 20px;"></textarea>
                                <div class="position-absolute top-0 right-0 mt-n1 mr-n2">

                                    <a href="?page=attended-view&event_id=<?php echo $event_id; ?>" class="btn btn-primary font-weight-bold py-2 px-6">View Event</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade" id="imageModal_<?php echo $event_id; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
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
            <?php
            } ?>

        </div>

    </div>

    <!--end::Entry-->
</div>