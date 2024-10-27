<?php
// Include the database connection
include('./control/db.php');

// Check if the 'venue_id' parameter exists in the URL
if (isset($_GET['venue_id'])) {
    $venueId = $_GET['venue_id'];

    // Fetch events for the specific venue
    $query = "SELECT 
            kld_event.*, 
            org_tbl.org_name, 
            category_tbl.category_name,
            venue_tbl.venue_name 
          FROM 
            kld_event 
          JOIN 
            venue_tbl ON kld_event.venue_id = venue_tbl.venue_id 
          JOIN 
            org_tbl ON kld_event.event_org_id = org_tbl.org_id 
          JOIN 
            category_tbl ON kld_event.category_id = category_tbl.category_id 
          WHERE 
            kld_event.venue_id = ?"; // Use a placeholder for prepared statement

    // Initialize a statement and prepare the SQL query
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Database query failed: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("i", $venueId);

    // Execute the query
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    // Get the result set
    $result = $stmt->get_result();

    // Check if any events were found
    if ($result->num_rows > 0) {
        // Fetch the venue name from the first event row
        $event_row = $result->fetch_assoc();
        $venuename = $event_row['venue_name'];

        // Move back to the first row for further processing
        $result->data_seek(0);
    } else {
        echo "No events found for this venue.";
        $venuename = ''; // Reset variable in case of no events
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No venue ID provided.";
    $venuename = ''; // Reset variable in case of no venue ID
}
?>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-custom gutter-b card-stretch">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center py-1">
                                <div class="symbol symbol-80 symbol-light-danger mr-5">
                                    <span class="symbol-label">
                                        <img src="assets/media/svg/misc/008-infography.svg" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h5"><?php echo htmlspecialchars($venuename); ?></a>
                                    <span class="text-muted font-weight-bold font-size-lg"></span>
                                </div>
                                <span class="text-dark-50 font-weight-normal font-size-lg mt-6 full-width"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-custom gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Event Details</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Details for selected events</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="?page=add-event" class="btn btn-success font-weight-bolder font-size-sm">Add Event</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                                <tr class="text-uppercase">
                                    <th style="min-width: 250px" class="pl-7"><span class="text-dark-75">KLD Event</span></th>
                                    <th style="min-width: 150px">Start</th>
                                    <th style="min-width: 150px">End</th>
                                    <th style="min-width: 100px">Organizer</th>
                                    <th style="min-width: 130px">Status</th>
                                    <th class="pr-0 text-right" style="min-width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td class="pl-0 py-8">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50 flex-shrink-0 mr-4">
                                                        <div class="symbol-label" style="background-image: url()"></div>
                                                    </div>
                                                    <div>
                                                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo htmlspecialchars($row['event_title']); ?></a>
                                                        <span class="text-muted font-weight-bold d-block"><?= htmlspecialchars($row['category_name']) ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php
                                                $startDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $row['event_start_date']);
                                                $formattedDate = htmlspecialchars($startDateTime->format('F d, Y'));
                                                $formattedTime = htmlspecialchars($startDateTime->format('h:i A')); // Format time as 8:30 PM
                                                ?>
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?php echo $formattedDate; ?></span>
                                                <span class="text-muted font-weight-bold"><?php echo $formattedTime; ?></span>
                                            </td>

                                            <td>
                                                <?php
                                                $endDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $row['event_end_date']);
                                                $formattedEndDate = htmlspecialchars($endDateTime->format('F d, Y'));
                                                $formattedEndTime = htmlspecialchars($endDateTime->format('h:i A'));
                                                ?>
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?php echo $formattedEndDate; ?></span>
                                                <span class="text-muted font-weight-bold"><?php echo $formattedEndTime; ?></span>
                                            </td>

                                            <td><span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?= htmlspecialchars($row['org_name']) ?></span></td>
                                            <td>
                                                <?php
                                                // Determine the class based on the status
                                                $statusClass = '';
                                                switch (strtolower($row['status'])) {
                                                    case 'upcoming':
                                                        $statusClass = 'label-light-info';
                                                        break;
                                                    case 'pending':
                                                        $statusClass = 'label-light-warning';
                                                        break;
                                                    case 'completed':
                                                        $statusClass = 'label-light-success';
                                                        break;
                                                    default:
                                                        $statusClass = 'label-light-secondary'; // Optional: default class for unexpected status
                                                        break;
                                                }
                                                ?>
                                                <span class="label label-lg <?= $statusClass ?> label-inline"><?= strtoupper(htmlspecialchars($row['status'])) ?></span>
                                            </td>

                                            <td class="pr-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Hidden.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M19.2078777,9.84836149 C20.3303823,11.0178941 21,12 21,12 C21,12 16.9090909,18 12,18 C11.6893441,18 11.3879033,17.9864845 11.0955026,17.9607365 L19.2078777,9.84836149 Z" fill="#000000" fill-rule="nonzero" />
                                                                <path d="M14.5051465,6.49485351 L12,9 C10.3431458,9 9,10.3431458 9,12 L5.52661464,15.4733854 C3.75006453,13.8334911 3,12 3,12 C3,12 5.45454545,6 12,6 C12.8665422,6 13.7075911,6.18695134 14.5051465,6.49485351 Z" fill="#000000" fill-rule="nonzero" />
                                                                <rect fill="#000000" opacity="0.3" transform="translate(12.524621, 12.424621) rotate(-45.000000) translate(-12.524621, -12.424621) " x="3.02462111" y="11.4246212" width="19" height="2" />
                                                            </g>
                                                        </svg><!--end::Svg Icon--></span>


                                                    <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No events found for this venue.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->