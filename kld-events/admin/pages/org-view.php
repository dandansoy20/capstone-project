<?php
// Include the database connection
include('./control/db.php');

// Check if the 'event_id' parameter exists in the URL
if (isset($_GET['org_id'])) {
    $orgId = $_GET['org_id'];

    $org_query = "SELECT * FROM org_tbl WHERE org_id = ?";
    $stmt = $conn->prepare($org_query);
    $stmt->bind_param("i", $orgId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $org = $result->fetch_assoc();
        $org_name = $org['org_name'];
        $venue_desc = $org['org_desc'];
        $org_pic = base64_decode($org['org_pic']) ? base64_decode($org['org_pic']) : 'assets/media/stock-600x400/img-70.jpg';
    } else {
        $org_name = 'Unknown';
    }
}
?>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Nav Panel Widget 1-->
                    <div class="card card-custom gutter-b ">
                        <!--begin::Body-->
                        <div class="card-body ">
                            <!--begin::Nav Tabs-->
                            <ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                    <a class="nav-link  border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#forms_widget_tab_1">
                                        <span class="nav-icon py-2 w-auto">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Text/Bullet-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <title>Stockholm-icons / Text / Bullet-list</title>
                                                    <desc>Created with Sketch.</desc>
                                                    <defs />
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000" />
                                                        <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span> </span>
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">
                                            Employees
                                        </span>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                    <a class="nav-link active border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#forms_widget_tab_2">
                                        <span class="nav-icon py-2 w-auto">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <title>Stockholm-icons / Map / Marker1</title>
                                                    <desc>Created with Sketch.</desc>
                                                    <defs />
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span> </span>
                                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">
                                            Organizers
                                        </span>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                    <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#forms_widget_tab_3">
                                        <span class="nav-icon py-2 w-auto">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Layout/Layout-top-panel-6.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <title>Stockholm-icons / Layout / Layout-top-panel-6</title>
                                                    <desc>Created with Sketch.</desc>
                                                    <defs />
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                                                        <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span> </span>
                                        <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">
                                            Events Calendar
                                        </span>
                                    </a>
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav Tabs-->

                            <!--begin::Nav Content-->
                            <div class="tab-content mt-5 p-0 ">
                                <div class="tab-pane " id="forms_widget_tab_1" role="tabpanel">

                                    <div class="card card-custom gutter-b">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 py-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label font-weight-bolder text-dark">All Organization Users</span>
                                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Kolehiyo ng Lungsod ng Dasmariñas</span>
                                            </h3>


                                            <div class="card-toolbar">

                                                <a href="?page=add-employee" class="btn btn-success font-weight-bolder font-size-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-white">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>Add New Member</a>

                                            </div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body py-0">
                                            <!--begin::Table-->
                                            <div class="table-responsive">
                                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                                    <thead>
                                                        <tr class="text-left">
                                                            <th class="pl-0" style="width: 20px">
                                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                                    <input type="checkbox" value="1" />
                                                                    <span></span>
                                                                </label>
                                                            </th>
                                                            <th class="pr-0" style="width: 64px">Users</th>
                                                            <th style="min-width: 200px"></th>
                                                            <th style="min-width: 150px">Email</th>
                                                            <th style="min-width: 150px">Role</th>
                                                            <th style="min-width: 150px">Status</th>
                                                            <th class="pr-0 text-right" style="min-width: 150px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    include('./control/db.php');

                                                    // Run the query
                                                    $try = mysqli_query(
                                                        $conn,
                                                        "SELECT * FROM org_acc WHERE org_id = '$orgId'"
                                                    );

                                                    // Check if there are any results
                                                    if ($try && $try->num_rows > 0) {
                                                        // Loop through each row if records are found
                                                        while ($row = $try->fetch_array()) {
                                                            echo '
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pl-0">
                                                                        <label class="checkbox checkbox-lg checkbox-inline">
                                                                            <input type="checkbox" value="' . $row['org_acc_id'] . '" />
                                                                            <span></span>
                                                                        </label>
                                                                    </td>
                                                                    <td class="pr-0">
                                                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                                                            <img src="' . ($row['org_profile'] ? $row['org_profile'] : 'assets/media/users/default.jpg') . '" class="h-75 align-self-end" alt="" />
                                                                        </div>
                                                                    </td>
                                                                    <td class="pl-0">
                                                                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $row['org_fname'] . ' ' . $row['org_lname'] . '</a>
                                                                        <span class="text-muted font-weight-bold text-muted d-block">' . $row['org_kld_id'] . '</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="text-muted font-weight-bold">' . $row['org_email'] . '</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="text-muted font-weight-bold">' . $row['org_role'] . '</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="label label-lg label-inline label-' . ($row['status'] === "ACTIVE" ? "light-success" : "light-danger") . '">' . ($row['status'] === "ACTIVE" ? "Activated" : "Not yet Activated") . '</span>
                                                                    </td>
                                                                    <td class="pr-0 text-right">
                                                                        <a href="?page=overview-organizer&id=' . $row['org_acc_id'] . '" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                                            <!-- SVG icon code here -->
                                                                        </a>
                                                                        <a href="?page=edit-organizer&id=' . $row['org_acc_id'] . '" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                                            <!-- SVG icon code here -->
                                                                        </a>
                                                                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                                            <!-- SVG icon code here -->
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            ';
                                                        }
                                                    } else {
                                                        // If no records are found, output a message
                                                        echo "<p>No records found.</p>";
                                                    }
                                                    ?>

                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Body-->
                                    </div>

                                </div>
                                <div class="tab-pane active " id="forms_widget_tab_2" role="tabpanel">


                                    <!--begin::Engage Widget 14-->
                                    <div class="row">
                                        <?php
                                        include('./control/db.php');

                                        // Fetch organization accounts from the database
                                        $stmt = $conn->prepare("SELECT * FROM org_acc WHERE org_id = ?");
                                        $stmt->bind_param('s', $orgId);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $org_acc_id = $row["org_acc_id"];
                                                $org_fname = $row["org_fname"];
                                                $org_lname = $row["org_lname"];
                                                $org_email = $row["org_email"];
                                                $org_role = $row["org_role"];
                                                $org_kld_id = $row["org_kld_id"];
                                                $org_profile = $row["org_profile"] ? $row["org_profile"] : 'assets/default.jpg';
                                        ?>
                                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6" id="org_acc_container<?php echo $org_acc_id; ?>">
                                                    <div class="card card-custom gutter-b card-stretch">
                                                        <div class="card-body pt-4">
                                                            <!-- Toolbar -->
                                                            <div class="d-flex justify-content-end">
                                                                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="ki ki-bold-more-hor"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                                        <ul class="navi navi-hover py-5">
                                                                            <li class="navi-item">
                                                                                <a href="#" class="navi-link">
                                                                                    <span class="navi-icon"><i class="flaticon2-rocket-1"></i></span>
                                                                                    <span class="navi-text">Archive</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="navi-item">
                                                                                <a href="#" class="navi-link">
                                                                                    <span class="navi-icon"><i class="flaticon2-gear"></i></span>
                                                                                    <span class="navi-text">Edit</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Organization Info -->
                                                            <div class="d-flex align-items-center mb-7">
                                                                <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                                                    <div class="symbol symbol-circle symbol-lg-75">
                                                                        <img style="object-fit: cover;" src="<?php echo $org_profile; ?>" alt="" />
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">
                                                                        <?php echo $org_fname . ' ' . $org_lname; ?>
                                                                    </a>
                                                                    <span class="text-muted font-weight-bold"></span>
                                                                </div>
                                                            </div>

                                                            <!-- Details -->
                                                            <div class="mb-7">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <span class="text-dark-75 font-weight-bolder mr-2">KLD Email:</span>
                                                                    <a href="mailto:<?php echo $org_email; ?>" class="text-muted text-hover-primary"><?php echo $org_email; ?></a>
                                                                </div>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <span class="text-dark-75 font-weight-bolder mr-2">Org Role:</span>
                                                                    <span class="text-muted"><?php echo $org_role; ?></span>
                                                                </div>
                                                                <div class="d-flex justify-content-between align-items-center my-1">
                                                                    <span class="text-dark-75 font-weight-bolder mr-2">KLD ID Number:</span>
                                                                    <span class="text-muted"><?php echo $org_kld_id; ?></span>
                                                                </div>
                                                            </div>

                                                            <!-- View Profile Button -->
                                                            <button class="btn btn-block btn-sm btn-primary font-weight-bold">View Profile</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            // If no data is fetched, display this message
                                            echo "<div class='col-12 text-center font-weight-bold'>No organizer yet</div>";
                                        }
                                        ?>
                                    </div>


                                    <!--end::Engage Widget 14-->

                                </div>
                                <div class="tab-pane" id="forms_widget_tab_3" role="tabpanel">


                                    <div class="card card-custom">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    <?php echo $org_name; ?>
                                                </h3>
                                            </div>
                                            <div class="card-toolbar">
                                                <a href="#" class="btn btn-light-primary font-weight-bold">
                                                    <i class="ki ki-plus "></i> Add Event
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="kt_calendar"></div>
                                        </div>
                                        <input type="hidden" name="org_id" value="<?php echo $orgId; ?>">
                                    </div>




                                </div>

                            </div>
                            <!--end::Nav Content-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--begin::Nav Panel Widget 1-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->