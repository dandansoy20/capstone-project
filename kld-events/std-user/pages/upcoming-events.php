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
                    WHERE 
                        (
                            (ei.course_id IS NULL AND ei.yearlvl_id IS NULL AND ei.section_id IS NULL) 
                            OR (ei.course_id = sa.course_id AND ei.yearlvl_id IS NULL AND ei.section_id IS NULL)
                            OR (ei.course_id IS NULL AND ei.yearlvl_id = sa.yearlvl AND ei.section_id IS NULL)
                            OR (ei.course_id = sa.course_id AND ei.yearlvl_id = sa.yearlvl AND ei.section_id = sa.section_id)
                        )
                        AND sa.std_id = '$_SESSION[kld_id]'
                        AND e.status = 'upcoming'
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

                // Handle the case where event_org_id is 0 (display "KLD Events")
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
                        $org_name = ''; // Default to empty if no result found
                    }
                }

                // Now you can use $venue_name, $category_name, and $org_name for each event
            ?>

                <div class="col-xxl-4">
                    <div class="card card-custom gutter-b ">
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
                                    <span class="text-muted font-weight-bold"><?php echo $event_created; ?></span>
                                </div>
                                <!--end::Info-->

                            </div>
                            <!--end::Top-->
                            <!--begin::Text-->
                            <p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">
                                <?php echo $event_desc; ?>
                            </p>
                            <!--begin::Bottom-->
                            <div class="pt-4">
                                <div class="bgi-no-repeat bgi-size-cover rounded min-h-295px" style="background-image: url(<?php echo $event_poster; ?>)" data-toggle="modal" data-target="#imageModal_<?php echo $event_id; ?>"></div>
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
                                        <?php if ($venue_id == 0) {
                                            $type = "Type: ";
                                        ?>
                                            <span class="svg-icon svg-icon-md svg-icon-primary pr-1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Laptop-macbook.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

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
                                            <span class="svg-icon svg-icon-md svg-icon-primary pr-1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

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

                            <!--begin::Editor-->
                            <form class="position-relative">
                                <textarea id="kt_forms_widget_4_input" class="form-control border-0 p-0 pr-10 resize-none" rows="1" placeholder="" style="overflow: hidden; overflow-wrap: break-word; height: 20px;"></textarea>
                                <div class="position-absolute top-0 right-0 mt-n1 mr-n2">
                                    <a href="?page=upcoming-view&event_id=<?php echo $event_id ?>" class="text-primary font-weight-bold">
                                        View Event
                                    </a>
                                </div>
                            </form>
                            <!--edit::Editor-->
                        </div>
                        <!--end::Body-->
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
            <?php } ?>


        </div>

        <?php
        include('./control/db.php');
        $try = mysqli_query(
            $conn,
            "SELECT 
                            venue_tbl.venue_name,
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
                            left join venue_tbl on kld_event.venue_id = venue_tbl.venue_id
                            left join org_tbl on kld_event.event_org_id = org_tbl.org_id
                            left join category_tbl on kld_event.category_id = category_tbl.category_id
                            
                            WHERE kld_event.status = 'upcoming'
                            
                            ORDER BY `kld_event`.`event_start_date` DESC"
        );
        while ($row = $try->fetch_array()) {

            $date_start_time = explode(" ", $row['event_start_date']);
            $date_end_time = explode(" ", $row['event_end_date']);
            echo '
                
                
                
                
                
                
                <div class="row">
                <div class="col-xl-12">

                    <!--begin::Engage Widget 7-->
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex p-0">
                            <div class="flex-grow-1 p-12 card-rounded bgi-no-repeat d-flex flex-column justify-content-center align-items-start"
                                 style="background-color: #FFF; background-position: right bottom; background-size: auto 100%; background-image: ">

                                 <div class="row">
                                    <div class="col-9">
                                <a href="?page=upcoming-event&event_id=' . $row["event_id"] . '">
                                    <h1 class="text-primary font-weight-bolder m-0 text-hover-secondary">' . $row["event_title"] . '</h1>
                                </a>

                                <h6 class="text-dark-50 font-weight-bolder m-0">' . $row["org_name"] . '</h6>
                                <div class="d-flex my-5">
                                <span
                                        class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Stockholm-icons-/-Design-/-Layers" stroke="none" stroke-width="1"
                                           fill="none" fill-rule="evenodd">
                                            <polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
                                            <path
                                                    d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                    id="Shape" fill="#000000" fill-rule="nonzero"></path>
                                            <path
                                                    d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                    id="Path" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg></span> <span class="text-dark h4 text-hover-primary">' . $row["category_name"] . '</span>

                                    <a href="#">
                                    <span
                                            class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                            <svg
                                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Stockholm-icons-/-Map-/-Marker1" stroke="none" stroke-width="1"
                                               fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                        d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z"
                                                        id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg><!--end::Svg Icon--></span> <span
                                                class="text-dark h4 text-hover-primary ">' . $row["venue_name"] . '</span></a>
                                </div>

                                <div class="d-flex">
                                    <span><i class="text-dark flaticon2-calendar mr-3"></i></span> <span
                                            class="text-dark h4">' . date('M d, Y', strtotime($row["event_start_date"])) . '</span>

                                    <span
                                            class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
                                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Stockholm-icons-/-Home-/-Clock" stroke="none" stroke-width="1"
                                               fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                        d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z"
                                                        id="Mask" fill="#000000" opacity="0.3"></path>
                                                <path
                                                        d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                                        id="Path-107" fill="#000000"></path>
                                            </g>
                                        </svg><!--end::Svg Icon--></span> <span
                                            class="text-dark h4 ">' . date('h:iA', strtotime($row["event_start_date"])) . '</span>
                                </div>

                                <p class="text-dark-50 my-5 font-size-xl font-weight-bold">
                                    ' . $row["event_desc"] . '
                                </p>

                                <a href="?page=upcoming-view&event_id=' . $row["event_id"] . '" class="btn btn-primary font-weight-bold py-2 px-6">View Event</a>
                                 </div>
                                <div class="col-3">
                                    <img src="' . base64_decode($row["event_poster"]) . '" style="width: 100%"/>                                   
                                
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Engage Widget 7-->
                    
                </div>
            </div>';
        }
        ?>
    </div>

    <!--end::Entry-->
</div>