<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class=" container ">
			<!--begin::Card-->
<div class="card card-custom card-transparent">
    <div class="card-body p-0">
        <!--begin::Wizard-->
        <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
            <!--begin::Wizard Nav-->
            <div class="wizard-nav">
                <div class="wizard-steps">
                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                        <div class="wizard-wrapper">
                            <div class="wizard-number">
                                @
                            </div>
                            <div class="wizard-label">
                                <div class="wizard-title">
                                    Profile
                                </div>
                                <div class="wizard-desc">
                                    User's Personal Information
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                            <h5 class="text-dark font-weight-bold mb-10">User's Profile Details:</h5>
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-left">Avatar</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="image-input image-input-outline" id="kt_user_add_avatar">
        						                        <div class="image-input-wrapper" style="background-image: url(assets/media/users/default.jpg)"></div>

        												<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
        						                            <i class="fa fa-pen icon-sm text-muted"></i>
        						                            <input type="file" id="add_std_profilepic" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
        													<input type="hidden" name="profile_avatar_remove"/>
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
                                                <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg" id="add_std_firstname" name="firstname"placeholder="(Optional)" type="text" value=""/>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg" id="add_std_lastname" name="lastname" placeholder="(Optional)" type="text" value=""/>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Course</label>
                                                <div class="col-lg-9 col-xl-9">
                                                <select class="form-control form-control-solid form-control-lg" name="course" type="text" id="add_std_course">
                                                        <option selected disabled>Select Course</option>
                                                        <?php
                                                        include('./control/db.php');
                                                        $try = mysqli_query($conn, "Select * from course_tbl");
                                                        while($row = $try->fetch_array()){
                                                            echo '<option value="' .$row['course_id'].'">'.$row['course_name'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                              <!--begin::Group-->
                                              <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Year Level</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <select class="form-control form-control-solid form-control-lg" name="yrlvl" type="text" id="add_std_yearlvl">
                                                        <option selected disabled value="null">Select Year Level</option>
                                                        <option value="1">1st Year</option>
                                                        <option value="2">2nd Year</option>
                                                        <option value="3">3rd Year</option>
                                                        <option value="4">4th Year</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Section</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group input-group-solid input-group-lg">
                                                    <select class="form-control form-control-solid form-control-lg" id="add_std_section" name="section"  type="text" disabled>
                                                        <option selected disabled>Select Section</option>
                                                    </select>
                                                    <select hidden id="std_add_section_options" readonly="readonly" disabled="disabled">
                                                        <?php
                                                        include('./control/db.php');
                                                        $try = mysqli_query($conn, "Select * from section_tbl");
                                                        while($row = $try->fetch_array()){
                                                            echo '<option value="' .$row['section_id'].'" data-yrlvl="' .$row['yearlvl'].'">'.$row['section_name'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">KLD ID Number</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group input-group-solid input-group-lg">
                                                        <input type="text" class="form-control form-control-solid form-control-lg" id="add_std_kldnum" placeholder="Enter ID Number" name="idnum" value=""/>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">KLD Email</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group input-group-solid input-group-lg">
                                                        <input type="text" id="add_std_email" class="form-control form-control-solid form-control-lg" placeholder="Enter Email" />
                                                        <div class="input-group-append"><span class="input-group-text">@kld.edu.ph</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                        </div>

                                        <!--begin::Wizard Actions-->
                                        <div class="d-flex justify-content-end border-top pt-10 mt-15">
                                            <div>
                                                <a href="?page=std" id="prev-step" class="btn btn-light-primary font-weight-bolder px-9 py-4">Cancel</a>
                                                <button id="add_std_submit" type="button" class="btn btn-success font-weight-bolder px-9 py-4">Submit</button>
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
<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
<!--end::Entry-->