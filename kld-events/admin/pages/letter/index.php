<?php
// Include the database connection
include('../../control/db.php');

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
            'status' => htmlspecialchars($row['status']) // Assuming 'status' is the column name in stakeholder_tbl
          ];
        }

        // Fetch organization information
        if (!empty($row['org_fname']) && !empty($row['org_lname'])) {
          $stakeholders[] = [
            'role' => $row['org_role'],
            'name' => htmlspecialchars($row['org_fname'] . ' ' . $row['org_lname']),
            'status' => htmlspecialchars($row['status']) // Assuming 'status' is the column name in stakeholder_tbl
          ];
        }
        // Fetch other values for event details
        $event_title = $row['event_title'];
        $event_start_date = $row['event_start_date'];
        $event_date_created = $row['event_created'];
        $org_name = $row['org_name'];
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>KLD Events | Event Letter</title>
  <link rel="stylesheet" href="./A4.css" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" />
  <link rel="shortcut icon" href="../../assets/media/logos/kldlogo.png" />
</head>
<style>
  .page {
    /* This makes the background image cover the entire page */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    /* Ensures the content fits an A4 page layout */
    width: 21cm;
    height: 29.7cm;
  }

  /* Styling for bold and underlined text */
  b {
    font-weight: bold;
  }

  u {
    text-decoration: underline;
  }

  /* Table styling */
  table {
    width: 100%;
    border-collapse: collapse;
    /* Merge borders */
    margin: 20px 0;
    font-size: 16px;
    background-color: #fff;
    /* White background for the table */
  }

  th,
  td {
    border: 1px solid #ddd;
    /* Light gray border */
    padding: 10px;
    /* Spacing inside the cells */
    text-align: left;
    /* Align text to the left */
  }

  th {
    background-color: #f2f2f2;
    /* Light gray background for table headers */
    font-weight: bold;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
    /* Subtle zebra stripe effect */
  }

  tr:hover {
    background-color: #f1f1f1;
    /* Light gray background when hovering over a row */
  }

  /* Unordered list styling */
  ul {
    list-style-type: disc;
    /* Use default bullet points */
    padding-left: 20px;
    /* Space to the left of the list */
    margin: 10px 0;
  }

  li {
    font-size: 16px;
    margin: 5px 0;
    /* Space between list items */
  }

  li u {
    text-decoration: underline;
  }

  /* Additional styling for break lines */
  br {
    line-height: 1.5;
    /* Space between line breaks */
  }
</style>

<body style="--bleeding: 0.5cm; --margin: 1.6cm">
  <div class="page" style="background-image: url('bg.jpg')">
    <!-- Your content here -->
    <br /><br /><br /><br /><br />

    <h4><?php
        // Format the event_start_date
        $formattedDate = date("F d, Y", strtotime($event_date_created));
        echo htmlspecialchars($formattedDate);
        ?></h4>

    <?php
    // Initialize the flag to track if all statuses are approved
    $allApproved = true;

    // Loop through each stakeholder
    foreach ($stakeholders as $stakeholder) {
      if ($stakeholder['status'] !== 'approved') {
        $allApproved = false; // If any status is not approved, set flag to false
        break; // Stop checking further once we find an unapproved status
      }
    }

    // Display the approval status based on the $allApproved flag
    echo $allApproved ? '<p style="font-style: italic; color: #0f6c29">Approved by:</p>' : '<p  style="font-style: italic; color: #ff0000">To be approved by:</p>';

    // Loop again to display each stakeholder’s name and role
    foreach ($stakeholders as $stakeholder) :
    ?>
      <h4>
        <?php echo htmlspecialchars($stakeholder['name']); ?><br />
        <em style="font-weight: normal"><?php echo htmlspecialchars($stakeholder['role']); ?></em>
      </h4>
    <?php endforeach; ?>


    <?php echo $proposal; ?>


    <!-- End of your content -->
  </div>

  <div class="page" style="background-image: url('bg.jpg')">
    <!-- Your content here -->
    <br /><br /><br /><br /><br />

    <p>
      <br />
      <strong>Event Title:</strong> <?php echo htmlspecialchars($event_title); ?>

    </p>
    <?php
    $formattedDate = date("F d, Y", strtotime($event_start_date));

    $formattedTime = date("h:i A", strtotime($event_start_date));
    ?>
    <p><strong>Date:</strong> <?php echo htmlspecialchars($formattedDate); ?></p>
    <p><strong>Time:</strong> <?php echo htmlspecialchars($formattedTime); ?></p>
    <p><strong>Venue:</strong> <?php echo htmlspecialchars($venue_name); ?></p>

    <br />
    <p>Respectfully,</p>
    <h4>

      Julius Dela Cruz<br />
      <em style="font-weight: normal"><?php echo htmlspecialchars($org_name); ?></em>
    </h4>


    <!-- End of your content -->
  </div>





</body>

</html>