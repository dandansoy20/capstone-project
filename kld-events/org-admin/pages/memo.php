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
                org_tbl.org_name, 
                category_tbl.category_name,
                venue_tbl.venue_name,
                letter_tbl.letter_content,
                stakeholder_tbl.*,

                admin_acc.admin_id,
                admin_acc.admin_fname,
                admin_acc.admin_lname,
                admin_acc.admin_role,

                org_acc.org_id,
                org_acc.org_fname,
                org_acc.org_lname,
                org_acc.org_role
              FROM 
                kld_event 
              LEFT JOIN 
                venue_tbl ON kld_event.venue_id = venue_tbl.venue_id 
              LEFT JOIN 
                org_tbl ON kld_event.event_org_id = org_tbl.org_id 
              LEFT JOIN 
                category_tbl ON kld_event.category_id = category_tbl.category_id 
              LEFT JOIN 
                letter_tbl ON kld_event.event_id = letter_tbl.event_id 
              LEFT JOIN 
                stakeholder_tbl ON kld_event.event_id = stakeholder_tbl.event_id 
              LEFT JOIN 
                admin_acc ON stakeholder_tbl.admin_id = admin_acc.admin_id
              LEFT JOIN 
                org_acc ON stakeholder_tbl.org_acc_id = org_acc.org_acc_id
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
                        'role' => $row['admin_role'],
                        'name' => htmlspecialchars($row['admin_fname'] . ' ' . $row['admin_lname']),
                        'status' => htmlspecialchars($row['status']), // Assuming 'status' is the column name in stakeholder_tbl
                        'date_approved' => htmlspecialchars($row['date_approved']) // Assuming 'status' is the column name in stakeholder_tbl
                    ];
                }

                // Fetch organization information
                if (!empty($row['org_fname']) && !empty($row['org_lname'])) {
                    $stakeholders[] = [
                        'role' => $row['org_role'],
                        'name' => htmlspecialchars($row['org_fname'] . ' ' . $row['org_lname']),
                        'status' => htmlspecialchars($row['status']),
                        'date_approved' => htmlspecialchars($row['date_approved'])
                    ];
                }
                // Fetch other values for event details
                $event_title = $row['event_title'];
                $event_start_date = $row['event_start_date'];
                $event_date_created = $row['event_created'];
                $org_name = $row['org_name'] ?? "KLD Events";
                $category_name = $row['category_name'];
                $venue_name = $row['venue_name'] ?? "Virtual Event"; // Assign "Virtual Event" if venue_name is null
                $proposal = $row["letter_content"] ?? "No Event Proposal Letter";
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
        <!-- begin::Card-->
        <div class="card card-custom overflow-hidden">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0"
                    style="background-image: url(assets/media/bg/bg-6.jpg);">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-4 text-white font-weight-boldest mb-10"><?php echo htmlspecialchars($event_title); ?></h1>

                            <div class="d-flex flex-column align-items-md-end px-0">
                                <!--begin::Logo-->
                                <a href="#" class="mb-5"><img src="assets/media/logos/kldlogo.png" alt="" class="h-50px" />

                                </a>
                                <!--end::Logo-->
                                <span class="text-white d-flex flex-column align-items-md-end opacity-70 font-weight-bolder mb-2">Event Venue
                                    <span class="font-weight-lighter opacity-70"><?php echo htmlspecialchars($venue_name); ?></span>
                                </span>
                            </div>
                        </div>
                        <div class="border-bottom w-100 opacity-20"></div>
                        <div class="d-flex justify-content-between text-white pt-6">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">Date & Time</span>
                                <span class="opacity-70">
                                    <?php
                                    // Format the event_start_date
                                    $formattedDate = date("F d, Y", strtotime($event_start_date));
                                    $formattedTime = date("h:i A", strtotime($event_start_date));
                                    echo htmlspecialchars($formattedDate . " | " . $formattedTime);
                                    ?>
                                </span>
                            </div>

                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">Event Category</span>
                                <span class="opacity-70"><?php echo htmlspecialchars($category_name); ?></span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">Organizer</span>
                                <span class="opacity-70"><?php echo htmlspecialchars($org_name); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->

                <!-- begin: Invoice body-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <h4><?php
                            // Format the event_start_date
                            $formattedDate = date("F d, Y", strtotime($event_date_created));
                            echo htmlspecialchars($formattedDate);
                            ?></h4><br>
                        <?php echo $proposal; ?>
                    </div>
                </div>
                <!-- end: Invoice body-->

                <!-- begin: Invoice footer-->
                <div class=" row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between flex-column flex-md-row font-size-lg">
                            <div class="d-flex flex-column mb-10 mb-md-0">
                                <div class="font-weight-bolder font-size-lg mb-3">Proposed to:</div>

                                <?php
                                $allApproved = true; // Flag to track if all statuses are approved

                                foreach ($stakeholders as $stakeholder):
                                    // Determine if the status is pending or approved$statusClass = 'text-warning'; // Default to warning for pending status

                                    $statusClass = 'text-warning'; // Default to warning for pending status

                                    if ($stakeholder['status'] === 'approved') {
                                        $statusClass = 'text-success';
                                    } elseif ($stakeholder['status'] === 'rejected') {
                                        $statusClass = 'text-danger';
                                    }
                                    // No need for else if for pending, as it's already set to warning above

                                    // No need for else if for pending, as it's already set to warning above

                                    if ($stakeholder['status'] !== 'approved') {
                                        $allApproved = false; // If any status is not approved, set flag to false
                                    }
                                ?>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="font-weight-bold"><?php echo htmlspecialchars($stakeholder['role']); ?>: </span>
                                        <span class="ml-5 text-left"><?php echo htmlspecialchars($stakeholder['name']); ?></span>

                                        <?php if ($stakeholder['status'] === 'approved' || $stakeholder['status'] === 'rejected'): ?>
                                            <span class="<?php echo $statusClass; ?> ml-5 text-uppercase">
                                                <?php
                                                // Format the date to show only the date part (YYYY-MM-DD)
                                                echo htmlspecialchars(date("Y-m-d", strtotime($stakeholder['date_approved'])));
                                                ?>
                                            </span>
                                        <?php endif; ?>

                                        <span class="<?php echo $statusClass; ?> ml-5 text-uppercase"><?php echo htmlspecialchars($stakeholder['status']); ?></span>
                                    </div>


                                <?php endforeach; ?>

                            </div>

                            <div class="d-flex flex-column text-md-right">
                                <span class="font-size-lg font-weight-bolder mb-1">Overall Status</span>
                                <span class="font-size-h2 font-weight-boldest <?php echo $allApproved ? 'text-success' : 'text-warning'; ?> mb-1">
                                    <?php echo $allApproved ? 'Approved' : 'Pending'; ?>
                                </span>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end: Invoice footer-->


                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-end">
                            <a href="pages/letter/?event_id=<?php echo $eventId ?>">
                                <button type="button" class="btn btn-light-primary font-weight-bold mr-5">View Letter</button></a>
                            <button type="button" class="btn btn-light-warning font-weight-bold mr-5" data-toggle="modal" data-target="#kt_maxlength_modal">Comment</button>
                            <?php
                            include('./control/db.php');
                            // Query to select status based on event_id and admin_id
                            $try = mysqli_query($conn, "SELECT status FROM `stakeholder_tbl` WHERE event_id = $eventId AND org_acc_id = {$_SESSION['kld_id']}");

                            // Fetch the status
                            $status = 'pending'; // Default status if none found
                            if ($row = $try->fetch_array()) {
                                $status = $row['status']; // Get the actual status
                            }
                            ?>

                            <form method="post">
                                <input type="hidden" id="session_id" value="<?php echo htmlspecialchars($_SESSION['kld_id']); ?>" />
                                <input type="hidden" id="event_id" value="<?php echo htmlspecialchars($eventId); ?>" />
                                <button type="button" id="admin_reject_btn" name="admin_reject" class="btn btn-light-danger font-weight-bold mr-5 " <?php echo ($status === 'rejected') ? 'disabled data-theme="dark" data-toggle="tooltip" title="Rejected Already"' : ''; ?>>Reject</button>
                                <button type="button" id="admin_approve_btn" name="admin_approve" class="btn btn-primary font-weight-bold" <?php echo ($status === 'approved') ? 'disabled data-theme="dark" data-toggle="tooltip" title="Approved Already"' : ''; ?>>Approve</button>
                            </form>
                        </div>
                    </div>
                </div>

                <form id="commentForm">
                    <div class="modal fade" id="kt_maxlength_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <textarea class="form-control" id="kt_maxlength_5" maxlength="150" placeholder="Type here..." rows="6" style="width: 100%;"></textarea>
                                            <span class="form-text text-muted">This message will return to the organizer</span>
                                        </div>
                                    </div>
                                    <!-- Hidden Inputs -->
                                    <input type="hidden" id="event_id" value="<?php echo $eventId; ?>" />
                                    <input type="hidden" id="session_id" value="<?php echo $_SESSION['kld_id']; ?>" />
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary font-weight-bold" id="sendCommentBtn">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>




                <!-- end: Invoice action-->

                <!-- end: Invoice-->
            </div>
        </div>
        <!-- end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->