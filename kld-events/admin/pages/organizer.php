<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Row-->
            <div class="row">
                
                <?php
                    include('./control/db.php');
                    $try = mysqli_query($conn, 
                        "Select * from org_acc  
                        left join org_tbl
                        on org_acc.org_id = org_tbl.org_id
                        where org_acc.status != 'INACTIVE' ");
                    while($row = $try->fetch_array()){
                        echo '
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6" id="org_acc_container'.$row['org_acc_id'].'">
                            <div class="card card-custom gutter-b card-stretch">
                                <div class="card-body pt-4">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end">
                                        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions"
                                            data-placement="left">
                                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                <ul class="navi navi-hover py-5">
                                                    <li class="navi-item">
                                                        <a href="#" onclick="hideOrganizer('.$row['org_acc_id'].')" class="navi-link">
                                                            <span class="navi-icon"><i class="flaticon2-rocket-1"></i></span>
                                                            <span class="navi-text">Archive</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" onclick="editOrganizer('.$row['org_acc_id'].')" class="navi-link">
                                                            <span class="navi-icon"><i class="flaticon2-gear"></i></span>
                                                            <span class="navi-text">Edit</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                            <div class="symbol symbol-circle symbol-lg-75">
                                                <img src="assets/media/users/default.jpg" alt="image" />
                                            </div>
                                            <div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
                                                <span class="font-size-h3 font-weight-boldest">JM</span>
                                            </div>
                                        </div>
                                        <!--end::Pic-->
                                        <!--begin::Title-->
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">'.$row['org_fname'].' '.$row['org_lname'].'</a>
                                            <span class="text-muted font-weight-bold">'.$row['org_role'].'</span>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <div class="mb-7">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-dark-75 font-weight-bolder mr-2">Organization</span>
                                            <span class="text-muted font-weight-bold">'.$row['org_name'].'</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-dark-75 font-weight-bolder mr-2">KLD Email:</span>
                                            <a href="#" class="text-muted text-hover-primary">'.$row['org_email'].'</a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-cente my-1">
                                            <span class="text-dark-75 font-weight-bolder mr-2">KLD ID Number:</span>
                                            <a href="#" class="text-muted text-hover-primary">'.$row['org_kld_id'].'</a>
                                        </div>
                                    </div>
                                    <div 
                                        class="btn btn-block disabled btn-sm btn-'.($row['status'] === "ACTIVE" ? "light-success" : "light-danger").' font-weight-bolder text-uppercase py-4" >'.($row['status'] === "ACTIVE" ? "Activated" : "Not yet Activated").'</div>
                                </div>
                            </div>
                        </div>
                        ';
                    } ?>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->