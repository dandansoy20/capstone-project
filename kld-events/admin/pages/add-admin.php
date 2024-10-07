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
                                                <div class="my-5 step" data-wizard-type="step-content"
                                                    data-wizard-state="current">
                                                    <h5 class="text-dark font-weight-bold mb-10">User's Profile Details:
                                                    </h5>
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-xl-3 col-lg-3 col-form-label text-left">Avatar</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="image-input image-input-outline"
                                                                id="kt_user_add_avatar">
                                                                <div class="image-input-wrapper"
                                                                    style="background-image: url(assets/media/users/default.jpg)">
                                                                </div>

                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="Change avatar">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="profile_avatar"
                                                                        accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="profile_avatar_remove" />
                                                                </label>

                                                                <span
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="cancel" data-toggle="tooltip"
                                                                    title="Cancel avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group FNAME-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">First
                                                            Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control form-control-solid form-control-lg"
                                                                name="firstname" placeholder="Juan" type="text" value="" />
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Last
                                                            Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control form-control-solid form-control-lg"
                                                                name="lastname" placeholder="Dela Cruz" type="text" value="" />
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-xl-3 col-lg-3 col-form-label">Roles/Positions</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select class="form-control form-control-solid form-control-lg" id="add_org_organization" name="course" type="text" value="">
                                                                <option selected disabled>Select Role</option>
                                                                <option>College Administrator</option>
                                                                <option>VP Administrative Affairs</option>
                                                                <option>Academic Institue Dean</option>
                                                                <option>Head of Student Activity</option>
                                                                <option>Head of Equipments and Venue</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">KLD ID
                                                            Number</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group input-group-solid input-group-lg">
                                                                <input type="text"
                                                                    class="form-control form-control-solid form-control-lg"
                                                                    placeholder="Enter ID Number" name="idnum"
                                                                    value="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">KLD
                                                            Email</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group input-group-solid input-group-lg">
                                                                <input type="text"
                                                                    class="form-control form-control-solid form-control-lg"
                                                                    name="email" placeholder="Enter Email" value="" />
                                                                <div class="input-group-append"><span
                                                                        class="input-group-text">@kld.edu.ph</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                        <div class="mr-2">
                                                        </div>
                                                        <div>
                                                            <button type="button"
                                                                class="btn btn-success font-weight-bolder px-9 py-4"
                                                                data-wizard-type="action-submit">
                                                                Add
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Wizard Step 1-->


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