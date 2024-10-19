<?php
include('./control/db.php');  // Include the database connection

// Array of bootstrap color classes
$colors = ['primary', 'success', 'info', 'warning', 'danger'];

?>

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="row">
            <?php
            $try = mysqli_query($conn, "SELECT * FROM course_tbl");
            $count = 0;  // Initialize a counter to track the number of cards in the row

            while ($row = $try->fetch_array()) {
                // Check if the current column count is divisible by 3, if so close the current row and start a new one
                if ($count % 3 == 0 && $count != 0) {
                    echo '</div><div class="row">';  // Close the previous row and open a new one
                }

                // Calculate the color class based on the count (loop through the colors array)
                $colorClass = $colors[$count % count($colors)];  // Cycle through colors array
            ?>
                <div class="col-xl-4">
                    <!--begin::Stats Widget 13-->
                    <a href="?page=yearlevel" class="card card-custom bg-<?= $colorClass ?> bg-hover-state-<?= $colorClass ?> card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="symbol symbol-light-<?= $colorClass ?> symbol-45">
                                <span class="symbol-label font-weight-bolder font-size-h6"><?= $row['course_acronym'] ?></span>
                            </span>
                            <div class="text-inverse-<?= $colorClass ?> font-weight-bolder font-size-h5 mb-2 mt-5"><?= $row['course_name'] ?></div>
                            <div class="font-weight-bold text-inverse-<?= $colorClass ?> font-size-sm"><?= $row['course_created'] ?></div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Stats Widget 13-->
                </div>
            <?php
                $count++;  // Increment the counter
            } // End of while loop
            ?>
        </div> <!-- Close the last row -->
    </div>
</div>