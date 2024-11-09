<?php
include('./control/db.php');  // Include the database connection

// Array of bootstrap color classes (optional, for customizing colors of other elements if needed)
$colors = ['primary', 'success', 'info', 'warning', 'danger'];

?>

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <?php
            // Query to select all sections based on the course_id and yearlevel
            if (isset($_GET['course_id']) && isset($_GET['yearlevel'])) {
                $courseId = $_GET['course_id'];
                $yearlevel = $_GET['yearlevel'];

                // Prepare the query to select section names based on course_id and yearlevel
                $course_query = "SELECT * FROM section_tbl WHERE course_id = ? AND yearlvl = ?";
                $stmt = $conn->prepare($course_query);
                $stmt->bind_param("ii", $courseId, $yearlevel); // Bind both parameters as integers
                $stmt->execute();
                $result = $stmt->get_result();

                $count = 0;  // Initialize a counter to track the number of cards in the row

                // Loop through the query results and generate the section cards
                while ($row = $result->fetch_assoc()) {
                    // Check if the current column count is divisible by 3, if so close the current row and start a new one
                    if ($count % 3 == 0 && $count != 0) {
                        echo '</div><div class="row">';  // Close the previous row and open a new one
                    }

            ?>
                    <div class="col-md-3 col-lg-2">
                        <!--begin::Stats Widget 13-->
                        <a href="?page=section-view&section_id=<?= urlencode($row['section_id']) ?>" class="card card-custom bg-primary bg-hover-state-light-primary card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <span class="symbol symbol-primary-light symbol-80">
                                    <span class="symbol-label font-weight-bolder font-size-h5"><?= $row['section_name'] ?></span>
                                </span>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 13-->
                    </div>
            <?php
                    $count++;  // Increment the counter
                } // End of while loop
            } else {
                echo 'No sections found for this course and year level.';
            }
            ?>
        </div> <!-- Close the last row -->
    </div>
</div>