<?php
include('./control/db.php');

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id'])) {
    $orgId = $_GET['id'];
}
$try = mysqli_query($conn, "Select * from org_tbl where org_id = '$orgId'");
while ($row = $try->fetch_array()) {


    $org_id = $row["org_id"];
    $org_pic = !empty($row["org_pic"]) ? base64_decode($row["org_pic"]) : 'assets/default.jpg';
    $org_name = $row["org_name"];
    $org_desc = $row["org_desc"];
    $org_created = $row["org_created"];
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
                                                    <h5 class="text-dark font-weight-bold mb-10">Add Organization</h5>
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label text-left">Logo</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="image-input image-input-outline" id="kt_user_add_avatar">
                                                                <div class="image-input-wrapper" style="background-image: url(<?php echo $org_pic; ?>)"></div>

                                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" id="org_pic" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="profile_avatar_remove" />
                                                                </label>

                                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group FNAME-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Organization Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control form-control-solid form-control-lg" id="edit_org_name" name="edit_org_name" placeholder="Institute of ..." type="text" value="<?php echo $org_name; ?>" />
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Organization Description</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea class="form-control form-control-solid form-control-lg" id="edit_org_description" name="edit_org_description" placeholder="Description Here..." type="text" rows="3"><?php echo $org_desc; ?></textarea>
                                                            <input type="hidden" value="<?php echo $org_id; ?>" name="org_id" id="org_id">
                                                            <input type="hidden" value="<?php echo $org_pic; ?>" name="org_pic" id="org_pic">
                                                        </div>
                                                    </div>

                                                </div>

                                                <!--begin::Wizard Actions-->
                                                <div class="d-flex justify-content-end border-top pt-10 mt-15">
                                                    <div>
                                                        <button onclick="history.back()" id="prev-step" class="btn btn-light-primary font-weight-bolder px-9 py-4">Back</button>
                                                        <button id="edit_org_submit" type="button" class="btn btn-primary font-weight-bolder px-9 py-4">Submit</button>
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