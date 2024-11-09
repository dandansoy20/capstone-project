<div class="container">
    <div class="row">
        <?php
        include('./control/db.php');
        $try = mysqli_query($conn, "SELECT * FROM venue_tbl");
        while ($row = $try->fetch_array()) {

            $venue_id = $row["venue_id"];
            $venue_img = !empty($row["venue_img"]) ? base64_decode($row["venue_img"]) : 'assets/media/stock-600x400/img-70.jpg';
            $venue_name = $row["venue_name"];
            $venue_desc = $row["venue_desc"];
            $venue_created = $row["venue_created"];
        ?>
            <div class="col-xl-4">
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Wrapper-->
                        <div class="d-flex justify-content-between flex-column h-100">
                            <!--begin::Container-->
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
                                                <a href="?page=edit-venue&id=<?php echo $venue_id; ?>" class="navi-link">
                                                    <span class="navi-icon"><i class="flaticon2-rocket-1"></i></span>
                                                    <span class="navi-text">Edit</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" onclick="editOrganizer(<?php echo $venue_id; ?>)" class="navi-link">
                                                    <span class="navi-icon"><i class="flaticon2-gear"></i></span>
                                                    <span class="navi-text">Archive</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="h-100">
                                <!--begin::Header-->
                                <div class="d-flex flex-column flex-center">
                                    <!--begin::Image-->
                                    <div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url(<?php echo $venue_img; ?>)"></div>
                                    <!--end::Image-->

                                    <!--begin::Title-->
                                    <a href="?page=venue-view&venue_id=<?php echo $venue_id; ?>" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1"><?php echo $venue_name; ?></a>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <div class="font-weight-bold text-dark-50 font-size-sm pb-7"><?php echo $venue_desc; ?></div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->

                                <!--end::Body-->
                            </div>
                            <!--eng::Container-->

                            <!--begin::Footer-->

                            <!--end::Footer-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>

        <?php } ?>
    </div>
    <div class="row">

        <?php
        include('./control/db.php');
        $try = mysqli_query($conn, "SELECT * FROM venue_tbl");
        while ($row = $try->fetch_array()) {
            echo '<div class="col-xl-4">
            <!--begin::Mixed Widget 7-->
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center py-1">
                        <!--begin:Pic-->
                        <div class="symbol symbol-80 symbol-light-danger mr-5">
                            <span class="symbol-label">
                                <img src="assets/media/svg/misc/008-infography.svg" class="h-50 align-self-center" alt="" />
                            </span>
                        </div>
                        <!--end:Pic-->

                        <!--begin:Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a href="?page=venue-view&venue_id=' . htmlspecialchars($row["venue_id"]) . '" class="text-dark font-weight-bolder text-hover-primary font-size-h5">
                                ' . htmlspecialchars($row["venue_name"]) . '
                            </a>

                            <span class="text-muted font-weight-bold font-size-lg">
                                Date Created: ' . date('M d, Y', strtotime($row["venue_created"])) . '
                            </span>
                        </div>
                        <!--end:Title-->
                        
                        <span class="text-dark-50 font-weight-normal font-size-lg mt-6" style="width: 100%">
                            ' . $row["venue_desc"] . '
                        </span>
                        
                    </div>
                </div>

                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 7-->
        </div>';
        }
        ?>
    </div>
</div>