<div class="container">
    <div class="row">
        <?php
        include('./control/db.php');
        $try = mysqli_query($conn, "Select * from org_tbl");
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
                                <img src="assets/media/svg/misc/008-infography.svg" class="h-50 align-self-center"
                                     alt="" />
                            </span>
                        </div>
                        <!--end:Pic-->

                        <!--begin:Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h5">
                                ' . $row["org_name"] . '
                            </a>
                            <span class="text-muted font-weight-bold font-size-lg">
                                Date Created: ' . date('M d, Y', strtotime($row["org_created"])) . '
                            </span>
                        </div>
                        <!--end:Title-->
                        
                        
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