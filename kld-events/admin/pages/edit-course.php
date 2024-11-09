<?php
include('./control/db.php');

// Check if the 'id' parameter exists in the URL
if (isset($_GET['course_id'])) {
    $courseId = $_GET['course_id'];
    // Fetch the course details from the database
    $try = mysqli_query($conn, "SELECT * FROM course_tbl WHERE course_id = '$courseId'");

    if ($row = mysqli_fetch_array($try)) {
        // Assign values from the query to variables
        $course_id = $row["course_id"];
        $course_name = $row["course_name"];
        $course_desc = $row["course_desc"];
        $course_acronym = $row["course_acronym"];
    } else {
        // Handle the case where no course is found
        echo "Course not found.";
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
                                                    <h5 class="text-dark font-weight-bold mb-10">Edit Course</h5>
                                                    <!-- Course Name Field -->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Course Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control form-control-solid form-control-lg"
                                                                id="edit_course_name"
                                                                name="edit_course_name"
                                                                placeholder="Course Name"
                                                                type="text"
                                                                value="<?php echo htmlspecialchars($course_name); ?>" />
                                                        </div>
                                                    </div>
                                                    <!-- Course Description Field -->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Course Description</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea class="form-control form-control-solid form-control-lg"
                                                                id="edit_course_description"
                                                                name="edit_course_description"
                                                                placeholder="Description Here..."
                                                                rows="3"><?php echo htmlspecialchars($course_desc); ?></textarea>
                                                            <input type="hidden" value="<?php echo htmlspecialchars($course_id); ?>" name="course_id" id="course_id">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Course Acronym</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control form-control-solid form-control-lg"
                                                                id="edit_course_acronym"
                                                                name="edit_course_acronym"
                                                                placeholder="Course Acronym"
                                                                type="text"
                                                                value="<?php echo htmlspecialchars($course_acronym); ?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--begin::Wizard Actions-->
                                                <div class="d-flex justify-content-end border-top pt-10 mt-15">
                                                    <div>
                                                        <a href="javascript:history.back()" id="prev-step" class="btn btn-light-primary font-weight-bolder px-9 py-4">Back</a>
                                                        <button id="edit_course_submit" type="button" class="btn btn-primary font-weight-bolder px-9 py-4">Submit</button>
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