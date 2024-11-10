<?php
// Include the database connection
include('./control/db.php');

// Check if the 'event_id' parameter exists in the URL
if (isset($_GET['venue_id'])) {
    $venueId = $_GET['venue_id'];

    $venue_query = "SELECT * FROM venue_tbl WHERE venue_id = ?";
    $stmt = $conn->prepare($venue_query);
    $stmt->bind_param("i", $venueId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $venue = $result->fetch_assoc();
        $venue_name = $venue['venue_name'];
        $venue_desc = $venue['venue_desc'];
        $venue_img = base64_decode($venue['venue_img']) ? base64_decode($venue['venue_img']) : 'assets/media/stock-600x400/img-70.jpg';
        $venue_created = $venue['venue_created'];
    } else {
        $venue_name = 'Unknown';
    }
}
?>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Nav Panel Widget 1-->
                    <div class="card card-custom gutter-b ">
                        <!--begin::Body-->
                        <div class="card-body ">
                            <!--begin::Nav Tabs-->
                            <ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                    <a class="nav-link  border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#forms_widget_tab_1">
                                        <span class="nav-icon py-2 w-auto">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Text/Bullet-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <title>Stockholm-icons / Text / Bullet-list</title>
                                                    <desc>Created with Sketch.</desc>
                                                    <defs />
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000" />
                                                        <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span> </span>
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">
                                            Event List
                                        </span>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                    <a class="nav-link active border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#forms_widget_tab_2">
                                        <span class="nav-icon py-2 w-auto">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <title>Stockholm-icons / Map / Marker1</title>
                                                    <desc>Created with Sketch.</desc>
                                                    <defs />
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span> </span>
                                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">
                                            Venue
                                        </span>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                    <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#forms_widget_tab_3">
                                        <span class="nav-icon py-2 w-auto">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Layout/Layout-top-panel-6.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <title>Stockholm-icons / Layout / Layout-top-panel-6</title>
                                                    <desc>Created with Sketch.</desc>
                                                    <defs />
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                                                        <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span> </span>
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">
                                            Venue Calendar
                                        </span>
                                    </a>
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav Tabs-->

                            <!--begin::Nav Content-->
                            <div class="tab-content mt-5 p-0 ">
                                <div class="tab-pane " id="forms_widget_tab_1" role="tabpanel">

                                    <div class="card card-custom gutter-b">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 py-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label font-weight-bolder text-dark">Events</span>
                                            </h3>
                                            <div class="card-toolbar">
                                                <a href="?page=add-event" class="btn btn-success font-weight-bolder font-size-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-white">
                                                        <i class="icon-xl far fa-calendar-plus"></i>
                                                    </span>Add Event</a>
                                            </div>
                                        </div>
                                        <!--end::Header-->

                                        <!--begin::Body-->
                                        <div class="card-body pt-0 pb-3">
                                            <!--begin::Table-->
                                            <div class="table-responsive">
                                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                                    <thead>
                                                        <tr class="text-uppercase">
                                                            <th style="min-width: 250px" class="pl-7"><span class="text-dark-75">Event Name</span></th>
                                                            <th style="min-width: 120px">Date</th>
                                                            <th style="min-width: 100px">Status</th>
                                                            <th style="min-width: 120px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Fetch events for the current category
                                                        /*************  ✨ Codeium Command 🌟  *************/
                                                        $events_query = "
                                                            SELECT * FROM kld_event
                                                            WHERE venue_id = $venueId AND (status = 'pending' OR status = 'upcoming')
                                                            ORDER BY event_start_date ASC
                                                        ";

                                                        /******  a91c3e8c-59dd-49fe-9fe0-ee0c60b1457e  *******/
                                                        $events_result = mysqli_query($conn, $events_query);

                                                        while ($event = mysqli_fetch_assoc($events_result)) {
                                                            $event_id = $event['event_id'];
                                                            $event_title = $event['event_title'];
                                                            $event_poster = base64_decode($event["event_poster"]);
                                                            $event_start_date = date("F d, Y", strtotime($event['event_start_date']));

                                                            $status = $event['status'];

                                                        ?>
                                                            <tr>
                                                                <td class="pl-0 py-8">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="symbol symbol-45 symbol-light-info mr-2">
                                                                            <div class="symbol symbol-70 symbol-2by3 mr-3">
                                                                                <div class="symbol-label" style="background-image: url(<?php echo $event_poster; ?>)"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $event_title; ?></a>
                                                                            <span class="text-muted font-weight-bold d-block">Event Host</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                                        <?php echo $event_start_date; ?>
                                                                    </span>
                                                                    <span class="text-muted font-weight-bold">
                                                                        <?php echo date("h:i A", strtotime($event['event_start_date'])); ?>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    // Convert status to uppercase and set the appropriate class
                                                                    $status_class = '';
                                                                    $status_text = strtoupper($status); // Convert status to uppercase

                                                                    if ($status == 'pending') {
                                                                        $status_class = 'label-light-warning'; // Class for 'pending' status
                                                                        $status_text = 'PENDING';
                                                                        $status_link = "?page=pending-view&event_id=" . $event_id; // Link for pending status
                                                                    } elseif ($status == 'completed') {
                                                                        $status_class = 'label-light-success'; // Class for 'completed' status
                                                                        $status_text = 'COMPLETED';
                                                                        $status_link = "?page=completed-view&event_id=" . $event_id; // Link for completed status
                                                                    } elseif ($status == 'upcoming') {
                                                                        $status_class = 'label-light-info'; // Class for 'upcoming' status
                                                                        $status_text = 'UPCOMING';
                                                                        $status_link = "?page=upcoming-view&event_id=" . $event_id; // Link for upcoming status
                                                                    }
                                                                    ?>
                                                                    <span class="label label-lg <?php echo $status_class; ?> label-inline"><?php echo $status_text; ?></span>
                                                                </td>
                                                                <td class="text-right pr-0">
                                                                    <a href="<?php echo $status_link; ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                                                                    <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </a>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!--end::Body-->
                                    </div>

                                </div>
                                <div class="tab-pane active " id="forms_widget_tab_2" role="tabpanel">
                                    <center>
                                        <div class="col-md-7 col-lg-12 col-xxl-7">

                                            <!--begin::Engage Widget 14-->
                                            <div class="card card-custom gutter-b">
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <!--begin::Top-->
                                                    <div class="d-flex align-items-center">


                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-column flex-grow-1">
                                                            <span class="text-dark-75 mb-1 font-size-lg font-weight-bolder"><?php echo $venue_name; ?></span>
                                                            <span class="text-muted font-weight-bold">Venue Created: <?php echo date('F j, Y', strtotime($venue_created)); ?></span>
                                                        </div>
                                                        <!--end::Info-->

                                                    </div>
                                                    <!--end::Top-->

                                                    <!--begin::Bottom-->
                                                    <div class="pt-4">
                                                        <!--begin::Image-->
                                                        <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url(<?php echo $venue_img; ?>)"></div>
                                                        <!--end::Image-->

                                                        <!--begin::Text-->
                                                        <p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">
                                                            <?php echo $venue_desc; ?>
                                                        </p>
                                                        <!--end::Text-->


                                                        <!--end::Action-->
                                                    </div>
                                                    <!--end::Bottom-->

                                                    <!--begin::Separator-->
                                                    <div class="separator separator-solid mt-2 mb-4"></div>
                                                    <!--end::Separator-->

                                                    <!--begin::Editor-->

                                                    <!--edit::Editor-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Engage Widget 14-->
                                        </div>

                                </div>
                                <div class="tab-pane" id="forms_widget_tab_3" role="tabpanel">


                                    <div class="card card-custom">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    <?php echo $venue_name; ?>
                                                </h3>
                                            </div>
                                            <div class="card-toolbar">
                                                <a href="#" class="btn btn-light-primary font-weight-bold">
                                                    <i class="ki ki-plus "></i> Add Event
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="kt_calendar"></div>
                                        </div>
                                        <input type="hidden" name="venue_id" value="<?php echo $venueId; ?>">
                                    </div>




                                </div>

                            </div>
                            <!--end::Nav Content-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--begin::Nav Panel Widget 1-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->