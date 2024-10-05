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

            <div class="form-group row">
				<label class="col-xl-3 col-lg-3 col-form-label text-right">Insert Logo</label>
					<div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                            <div class="image-input-wrapper" style="background-image: url(assets/media/users/default.jpg)"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                       <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="profile_avatar_remove"/>
                               </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                        </div>
                    </div>
            </div>


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