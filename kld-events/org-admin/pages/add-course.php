<div class="container">
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">
                Add Course
            </h3>

        </div>
        <!--begin::Form-->
        <form class="form">
            <div class="card-body">
                <div class="form-group">
                    <label>Course Name:</label> <span class="text-danger">*</span>
                    <input type="text" id="add_cat_course" class="form-control form-control-solid" placeholder="Enter Course"/>
                    <span class="form-text text-muted">Enter Course Title</span>
                </div>
                <div class="form-group">
                    <label>Course Abbreviation:</label> <span class="text-danger">*</span>
                    <input type="text" id="add_cat_course" class="form-control form-control-solid" placeholder="Enter Abbreviation"/>
                </div>
                <div class="form-group mb-1">
                    <label for="exampleTextarea">Course Description <span class="text-danger">*</span></label>
                    <input type="text" id="add_cat_course" class="form-control form-control-solid" placeholder="Enter Course Description"/>
                </div>


            </div>
            <div class="card-footer">
                <button id="add_cat_submit" type="reset" class="btn btn-primary mr-2">Submit</button>
                <button id="add_cat_cancel" type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>