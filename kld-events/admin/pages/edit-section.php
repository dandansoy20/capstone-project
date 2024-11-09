<?php
include('./control/db.php');

// Check if the 'id' parameter exists in the URL
if (isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];
    // Fetch the course details from the database
    $try = mysqli_query($conn, "
        SELECT s.section_id, s.section_name, s.course_id, s.yearlvl, c.course_name, y.yearlvl_name
        FROM section_tbl s
        JOIN course_tbl c ON c.course_id = s.course_id
        JOIN yearlvl_tbl y ON y.yearlvl = s.yearlvl
        WHERE s.section_id = '$section_id'
    ");

    if ($row = mysqli_fetch_array($try)) {
        // Assign values from the query to variables
        $section_id = $row["section_id"];
        $section_name = $row["section_name"];
        $course_id = $row["course_id"];
        $yearlvl = $row["yearlvl"];
        $course_name = $row["course_name"];
        $yearlvl_name = $row["yearlvl_name"];
    } else {
        // Handle the case where no course is found
        echo "Section not found.";
    }
} else {
    // Handle the case where 'id' is not provided
    echo "Invalid request.";
}
?>
<div class="d-flex flex-column-fluid">
    <div class="container">


        <div class="card card-custom card-transparent">
            <div class="card-body p-0">
                <!--begin::Wizard-->
                <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                    <!--begin::Wizard Nav-->

                    <!--end::Wizard Nav-->

                    <!--begin::Card-->
                    <div class="card card-custom card-shadowless rounded-top-0">
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                <div class="col-xl-12 col-xxl-10">
                                    <!--begin::Wizard Form-->
                                    <form class="form" id="kt_form">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-9">
                                                <!--begin::Wizard Step 1-->
                                                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                    <h5 class="text-dark font-weight-bold mb-10">Edit Section</h5>

                                                    <!-- Course Selection -->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Course</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select class="form-control form-control-solid form-control-lg" id="course_id" name="course_id" required>
                                                                <option value="">Select Course</option>
                                                                <option value="<?php echo $course_id; ?>"><?php echo $course_name; ?></option>
                                                                <?php
                                                                $course_query = "SELECT * FROM course_tbl WHERE course_id != $course_id";
                                                                $course_result = mysqli_query($conn, $course_query);
                                                                if (mysqli_num_rows($course_result) > 0) {
                                                                    while ($course = mysqli_fetch_assoc($course_result)) {
                                                                        // Add course_acronym as a data attribute
                                                                        echo '<option value="' . $course['course_id'] . '" data-acronym="' . $course['course_acronym'] . '">' . $course['course_name'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Year Level Selection -->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Year Level</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select class="form-control form-control-solid form-control-lg" id="yearlvl" name="yearlvl" required>
                                                                <option value="">Select Year Level</option>
                                                                <?php
                                                                $year_query = "SELECT * FROM yearlvl_tbl";
                                                                $year_result = mysqli_query($conn, $year_query);
                                                                if (mysqli_num_rows($year_result) > 0) {
                                                                    while ($year = mysqli_fetch_assoc($year_result)) {
                                                                        echo '<option value="' . $year['yearlvl_id'] . '">' . $year['yearlvl_name'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Section Name Input -->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Section Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control form-control-solid form-control-lg"
                                                                id="add_section_name"
                                                                name="add_section_name"
                                                                placeholder=""
                                                                type="text"
                                                                value="" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- JavaScript to Update Section Name -->
                                                <script>
                                                    document.getElementById('course_id').addEventListener('change', function() {
                                                        // Get the selected option
                                                        var selectedOption = this.options[this.selectedIndex];
                                                        // Get the course acronym from the data attribute
                                                        var courseAcronym = selectedOption.getAttribute('data-acronym');
                                                        // Set the value of the Section Name input
                                                        document.getElementById('add_section_name').value = courseAcronym || '';
                                                    });
                                                </script>


                                                <!--begin::Wizard Actions-->
                                                <div class="d-flex justify-content-end border-top pt-10 mt-15">
                                                    <div>
                                                        <a href="" id="prev-step" class="btn btn-light-primary font-weight-bolder px-9 py-4">Cancel</a>
                                                        <button id="add_section_submit" type="button" class="btn btn-primary font-weight-bolder px-9 py-4">Submit</button>
                                                    </div>
                                                </div>
                                                <!--end::Wizard Actions-->
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Wizard Form-->
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Wizard-->
            </div>
        </div>




    </div>
</div>