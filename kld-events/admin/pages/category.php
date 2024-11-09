<div class="container">
    <div class="row">

        <?php
        include('./control/db.php');
        $try = mysqli_query($conn, "SELECT * FROM category_tbl");
        while ($row = $try->fetch_array()) {

            $category_id = $row["category_id"];
            $category_icon = !empty($row["category_icon"]) ? base64_decode($row["category_icon"]) : 'assets/cat_default.png';
            $category_name = $row["category_name"];
            $category_desc = $row["category_desc"];
            $category_created = $row["category_created"];
        ?>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body text-center pt-4">
                        <!--begin::Toolbar-->
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
                                            <a href="?page=edit-cat&id=<?php echo $category_id; ?>" class="navi-link">
                                                <span class="navi-icon"><i class="flaticon2-rocket-1"></i></span>
                                                <span class="navi-text">Edit</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" onclick="editOrganizer(<?php echo $category_id; ?>)" class="navi-link">
                                                <span class="navi-icon"><i class="flaticon2-gear"></i></span>
                                                <span class="navi-text">Archive</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::User-->
                        <div class="mt-7">
                            <div class="symbol symbol-circle symbol-lg-75">
                                <img src="<?php echo $category_icon; ?>">
                            </div>
                        </div>
                        <!--end::User-->

                        <!--begin::Name-->
                        <div class="my-2">
                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4" data-toggle="modal" data-target="#modal_<?php echo $category_id; ?>" data="<?php echo $category_id; ?>"><?php echo $category_name; ?></a>
                        </div>
                        <span class="text-dark-50 font-weight-normal font-size-lg mt-6" style="width: 100%">
                            <?php echo $category_desc; ?>
                        </span>
                        <!--end::Name-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal_<?php echo $category_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeXl" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $category_name; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0 py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Upcoming and Pending Events</span>
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
                                                    SELECT e.event_id, e.event_title, e.event_start_date, e.status, e.event_poster, v.venue_name
                                                    FROM kld_event e
                                                    JOIN venue_tbl v ON e.venue_id = v.venue_id
                                                    WHERE e.category_id = $category_id
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        <?php } ?>

    </div>
</div>