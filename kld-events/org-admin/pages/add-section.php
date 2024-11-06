<div class="container">
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">
                Add Student's Section
            </h3>

        </div>
        <!--begin::Form-->
        <form class="form">
            <div class="card-body">
                
                <div class="form-group">
                    <label>Course</label> <span class="text-danger">*</span>
                    <select class="form-control form-control-solid">
                        <option>BSIS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Year Level</label> <span class="text-danger">*</span>
                    <select class="form-control form-control-solid">
                        <option>1st Year</option>
                        <option>2nd Year</option>
                        <option>3rd Year</option>
                        <option>4th Year</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Section Name</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control form-control-solid" placeholder="Enter Section">
                </div>


            </div>
            <div class="card-footer">
                <button id="add_cat_submit" class="btn btn-primary mr-2">Submit</button>
                <button id="add_cat_cancel" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>