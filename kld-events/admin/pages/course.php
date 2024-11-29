<?php
include('./control/db.php');  // Include the database connection

// Array of bootstrap color classes
$colors = ['primary', 'success', 'info', 'warning', 'danger', 'dark', 'info'];

?>

<div class="d-flex flex-column-fluid">
    <div class="container">
        <button type="button" onclick="history.go(-1)" class="btn btn-light-primary font-weight-bolder mb-5">
            <i class="ki ki-long-arrow-back icon-sm"></i>Back
        </button>
        <div class="row">

            <?php
            $try = mysqli_query($conn, "SELECT * FROM course_tbl");
            $count = 0;  // Initialize a counter to track the number of cards in the row
            $courses = []; // Array to store course data

            // Fetch all courses and store them in an array
            while ($row = $try->fetch_array()) {
                $courses[] = $row;
                $count++;
            }

            // Loop through the courses and display each one
            foreach ($courses as $index => $row) {
                // Calculate the color class based on the index
                $colorClass = $colors[$index % count($colors)];  // Cycle through colors array
            ?>
                <div class="col-xl-4">
                    <!--begin::Stats Widget 13-->
                    <a href="?page=yearlevel&course_id=<?= $row['course_id'] ?>" class="card card-custom bg-<?= $colorClass ?> bg-hover-state-<?= $colorClass ?> card-stretch gutter-b" data-theme="dark" data-toggle="tooltip" title="<?= $row['course_desc'] ?>">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="symbol symbol-light-<?= $colorClass ?> symbol-45">
                                <span class="symbol-label font-weight-bolder font-size-h6"><?= $row['course_acronym'] ?></span>
                            </span>
                            <div class="text-inverse-<?= $colorClass ?> font-weight-bolder font-size-h5 mb-2 mt-5"><?= $row['course_name'] ?></div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Stats Widget 13-->
                </div>
            <?php
            }

            // Add the "Add Course" card in the last column of the second row
            ?>
            <div class="col-xl-4">
                <!--begin::Stats Widget 13-->
                <a href="?page=add-course" class="card card-custom bg-light bg-hover-state-primary card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <!-- Add "+" icon and "Add Course" text -->
                        <span class="symbol symbol-light-primary symbol-45">
                            <span class="symbol-label font-weight-bolder font-size-h5">
                                <i class="fas fa-plus"></i> <!-- FontAwesome "+" icon -->
                            </span>
                        </span>
                        <div class="text-dark-50 font-weight-bolder font-size-h5 mb-2 mt-5">
                            Add Course
                        </div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Stats Widget 13-->
            </div>
        </div> <!-- End row -->
    </div>
</div>