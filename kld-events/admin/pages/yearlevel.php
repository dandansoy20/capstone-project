<?php
// Include the database connection
include('./control/db.php');

// Check if the 'event_id' parameter exists in the URL
if (isset($_GET['course_id'])) {
    $courseId = $_GET['course_id'];

    $course_query = "SELECT * FROM course_tbl WHERE course_id = ?";
    $stmt = $conn->prepare($course_query);
    $stmt->bind_param("i", $courseId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
        $course_name = $course['course_name'];
        $course_acronym = $course['course_acronym'];
        $course_desc = $course['course_desc'];
    } else {
        $course_name = 'Unknown';
    }
}
?>
<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="alert alert-custom alert-light alert-shadow fade show gutter-b justify-content-between" role="alert">
            <h4 class="text text-center"><?php echo $course_name ?></h4>
            <div class="d-flex align-items-center">
                <a href="?page=edit-course&course_id=<?php echo $courseId ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <i class="fas fa-edit"></i>
                    </span>
                </a>
                <a href="?page=archive-course&course_id=<?php echo $courseId ?>" class="btn btn-icon btn-light btn-hover-danger btn-sm">
                    <span class="svg-icon svg-icon-danger svg-icon-2x">
                        <i class="fas fa-archive"></i>
                    </span>
                </a>
            </div>

        </div>

        <div class="row">

            <div class="col-xl-3">
                <!--begin::Stats Widget 13-->
                <a href="?page=sections&course_id=<?php echo $courseId; ?>&yearlevel=1" class="card card-custom bg-info bg-hover-state-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">

                        <span class="symbol symbol-light-info symbol-45">
                            <span class="symbol-label font-weight-bolder font-size-h6">1st</span>
                        </span>
                        <div class="text-inverse-info font-weight-bolder font-size-h5 mb-2 mt-5">First Year</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Stats Widget 13-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 13-->
                <a href="?page=sections&course_id=<?php echo $courseId; ?>&yearlevel=2" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">

                        <span class="symbol symbol-dark-light symbol-45">
                            <span class="symbol-label font-weight-bolder font-size-h6">2nd</span>
                        </span>
                        <div class="text-inverse-light font-weight-bolder font-size-h5 mb-2 mt-5">Second Year</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Stats Widget 13-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 13-->
                <a href="?page=sections&course_id=<?php echo $courseId; ?>&yearlevel=3" class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">

                        <span class="symbol symbol-danger-light symbol-45">
                            <span class="symbol-label font-weight-bolder font-size-h6">3rd</span>
                        </span>
                        <div class="text-inverse-danger font-weight-bolder font-size-h5 mb-2 mt-5">Third Year</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Stats Widget 13-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 13-->
                <a href="?page=sections&course_id=<?php echo $courseId; ?>&yearlevel=4" class="card card-custom bg-warning bg-hover-state-warning card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">

                        <span class="symbol symbol-warning-light symbol-45">
                            <span class="symbol-label font-weight-bolder font-size-h6">4th</span>
                        </span>
                        <div class="text-inverse-warning font-weight-bolder font-size-h5 mb-2 mt-5">Fourth Year</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Stats Widget 13-->
            </div>
        </div>

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
                                <th style="min-width: 120px">Venue</th>
                                <th style="min-width: 100px">Status</th>
                                <th style="min-width: 120px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch events for the current category
                            $events_query = "
                                SELECT DISTINCT kld_event.event_id, kld_event.*, venue_tbl.venue_name
                                FROM kld_event
                                JOIN event_invitation ON kld_event.event_id = event_invitation.event_id
                                JOIN venue_tbl ON kld_event.venue_id = venue_tbl.venue_id
                                WHERE event_invitation.course_id = $courseId 
                                OR (event_invitation.course_id IS NULL 
                                    AND (event_invitation.yearlvl_id IS NOT NULL
                                        OR event_invitation.section_id IS NULL));
                            ";

                            $events_result = mysqli_query($conn, $events_query);

                            while ($event = mysqli_fetch_assoc($events_result)) {
                                $event_id = $event['event_id'];
                                $event_title = $event['event_title'];
                                $event_poster = base64_decode($event["event_poster"]);
                                $event_start_date = date("F d, Y", strtotime($event['event_start_date']));
                                $venue_name = $event['venue_name'];
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
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                            <?php echo $venue_name; ?>
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
</div>