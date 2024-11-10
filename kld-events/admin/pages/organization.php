<div class="container">
    <div class="row">
        <?php
        include('./control/db.php');

        // Fetch all organizations
        $try = mysqli_query($conn, "SELECT * FROM org_tbl");

        while ($row = $try->fetch_array()) {
            $org_id = $row["org_id"];
            $org_pic = !empty($row["org_pic"]) ? base64_decode($row["org_pic"]) : 'assets/default.jpg';
            $org_name = $row["org_name"];
            $org_created = $row["org_created"];
        ?>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body text-center pt-4">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <ul class="navi navi-hover py-5">
                                        <li class="navi-item">
                                            <a href="?page=edit-org&id=<?php echo $org_id; ?>" class="navi-link">
                                                <span class="navi-icon"><i class="flaticon2-edit"></i></span>
                                                <span class="navi-text">Edit</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" onclick="editOrganizer(<?php echo $org_id; ?>)" class="navi-link">
                                                <span class="navi-icon"><i class="flaticon2-box"></i></span>
                                                <span class="navi-text">Archive</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::User-->
                        <div class="mt-7">
                            <div class="symbol symbol-circle symbol-lg-90">
                                <img src="<?php echo $org_pic; ?>" alt="image">
                            </div>
                        </div>
                        <!--end::User-->

                        <!--begin::Name-->
                        <div class="my-4">
                            <a href="?page=org-view&org_id=<?php echo $org_id; ?>" class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $org_name; ?></a>
                        </div>
                        <!--end::Name-->

                        <div class="my-4 text-center">
                            <div class="d-inline-flex flex-column mb-7">
                                <span class="font-weight-bolder mb-4">Members</span>
                                <div class="symbol-group symbol-hover justify-content-center">
                                    <?php
                                    // Fetch all members associated with this organization
                                    $members_query = mysqli_query($conn, "SELECT * FROM org_acc WHERE org_id = '$org_id'");
                                    // Check if there are any members
                                    if ($members_query->num_rows > 0) {
                                        // Loop through all members and display their profile pictures
                                        while ($member = $members_query->fetch_array()) {
                                            $org_profile = !empty($member["org_profile"]) ? ($member["org_profile"]) : "assets/default.jpg";
                                    ?>
                                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="<?php echo $member['org_fname'] . ' ' . $member['org_lname']; ?>">
                                                <img alt="Pic" src="<?php echo $org_profile; ?>">
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo '<span>No members yet.</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
        <?php
        }
        ?>
    </div>


</div>