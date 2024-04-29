<div class="container">
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">
                Add Event Organization
            </h3>

        </div>
        <!--begin::Form-->
        <form class="form">
            <div class="card-body">
                <div class="form-group">
                    <label>Organization Name:</label> <span class="text-danger">*</span>
                    <input type="text" id="add_org_organization" class="form-control form-control-solid" placeholder="Enter organization"/>
                    <span class="form-text text-muted">Enter Organization Title</span>
                </div>
                <div class="form-group mb-1">
                    <label for="exampleTextarea">Organization Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="add_org_description" rows="3"></textarea>
                </div>


            </div>
            <div class="card-footer">
                <button id="add_org_submit" type="reset" class="btn btn-primary mr-2">Submit</button>
                <button id="add_org_cancel" type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>