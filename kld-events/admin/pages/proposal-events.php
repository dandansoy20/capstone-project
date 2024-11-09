<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container ">
        <!--begin::Row-->
        <?php
        include('./control/db.php');
        if (isset($_GET['id'])) {
            $adminId = $_GET['id'];
        }
        $try = mysqli_query(
            $conn,
            "SELECT 
                 stakeholder_tbl.*,
                 venue_tbl.venue_name,
                 venue_tbl.venue_id,
                 venue_tbl.venue_desc,
                 kld_event.event_id,
                 kld_event.event_title,
                 kld_event.event_desc,
                 org_tbl.org_name,
                 kld_event.event_start_date,
                 kld_event.event_end_date,
                 kld_event.event_poster,
                 category_tbl.category_name,
                 category_tbl.category_desc
             FROM `kld_event`
             LEFT JOIN stakeholder_tbl ON kld_event.event_id = stakeholder_tbl.event_id
             LEFT JOIN venue_tbl ON kld_event.venue_id = venue_tbl.venue_id
             LEFT JOIN org_tbl ON kld_event.event_org_id = org_tbl.org_id
             LEFT JOIN category_tbl ON kld_event.category_id = category_tbl.category_id
             WHERE kld_event.status = 'pending' AND stakeholder_tbl.status = 'pending' AND stakeholder_tbl.admin_id = $adminId
             ORDER BY `kld_event`.`event_start_date` DESC"
        );



        while ($row = $try->fetch_array()) {

            $date_start_time = explode(" ", $row['event_start_date']);
            $date_end_time = explode(" ", $row['event_end_date']);
            echo '
                 
                 
                 
                 
                 
                 
                 <div class="row">
                 <div class="col-xl-12">
         
                     <!--begin::Engage Widget 7-->
                     <div class="card card-custom card-stretch gutter-b">
                         <div class="card-body d-flex p-0">
                         
                             <div class="flex-grow-1 p-12 card-rounded bgi-no-repeat d-flex flex-column justify-content-center align-items-start"
                                  style="background-color: #FFF; background-position: right bottom; background-size: auto 100%; background-image: url(assets/media/svg/humans/custom-88.png)">
         
                                  <div class="row">
                                     <div class="col-9">
         
                                         <a href="?page=pending-view&event_id=' . $row["event_id"] . '">
                                             <div class="d-flex align-items-center">
                                                 <h1 class="text-primary font-weight-bolder m-0 text-hover-secondary">' . $row["event_title"] . '</h1>
                                                 <span class="label label-warning label-inline ml-2">In Process</span>
                                             </div>
                                         </a>
         
                                 <h6 class="text-dark-50 font-weight-bolder m-0">' . $row["org_name"] . '</h6>
                                 <div class="d-flex my-5">
                                     <span
                                         class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
                                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                         <g id="Stockholm-icons-/-Design-/-Layers" stroke="none" stroke-width="1"
                                            fill="none" fill-rule="evenodd">
                                             <polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
                                             <path
                                                     d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                     id="Shape" fill="#000000" fill-rule="nonzero"></path>
                                             <path
                                                     d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                     id="Path" fill="#000000" opacity="0.3"></path>
                                         </g>
                                     </svg></span> <span class="text-dark h4 text-hover-primary">' . $row["category_name"] . '</span> '; ?>
            <?php
            echo (!empty($row["venue_id"])) ?
                '<a href="?page=venue-view&venue_id=' . $row["venue_id"] . '">
                                                 <span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
                                                                         <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                                         <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                             <g id="Stockholm-icons-/-Map-/-Marker1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                 <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                                 <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
                                                                             </g>
                                                                         </svg>
                                                                         <!--end::Svg Icon-->
                                                                     </span>
                                                                     <span class="text-dark h4 text-hover-primary">' . $row["venue_name"] . '</span>
                                                                 </a>'
                :
                '<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
                                                                     <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Display3.svg-->
                                                                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                             <rect x="0" y="0" width="24" height="24"/>
                                                                             <polygon fill="#000000" opacity="0.3" points="5 7 5 15 19 15 19 7"/>
                                                                             <path d="M11,19 L11,16 C11,15.4477153 11.4477153,15 12,15 C12.5522847,15 13,15.4477153 13,16 L13,19 L14.5,19 C14.7761424,19 15,19.2238576 15,19.5 C15,19.7761424 14.7761424,20 14.5,20 L9.5,20 C9.22385763,20 9,19.7761424 9,19.5 C9,19.2238576 9.22385763,19 9.5,19 L11,19 Z" fill="#000000" opacity="0.3"/>
                                                                             <path d="M5,7 L5,15 L19,15 L19,7 L5,7 Z M5.25,5 L18.75,5 C19.9926407,5 21,5.8954305 21,7 L21,15 C21,16.1045695 19.9926407,17 18.75,17 L5.25,17 C4.00735931,17 3,16.1045695 3,15 L3,7 C3,5.8954305 4.00735931,5 5.25,5 Z" fill="#000000" fill-rule="nonzero"/>
                                                                         </g>
                                                                     </svg>
                                                                     <!--end::Svg Icon-->
                                                                 </span>
                                                                 <span class="text-dark h4">Virtual Event</span>';
            ?><?php
                echo '
                         </div>
         
                         <div class="d-flex">
                             <span><i class="text-dark flaticon2-calendar mr-3"></i></span> <span
                                     class="text-dark h4">' . date('M d, Y', strtotime($row["event_start_date"])) . '</span>
         
                             <span
                                     class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink">
                                     <g id="Stockholm-icons-/-Home-/-Clock" stroke="none" stroke-width="1"
                                        fill="none" fill-rule="evenodd">
                                         <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                         <path
                                                 d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z"
                                                 id="Mask" fill="#000000" opacity="0.3"></path>
                                         <path
                                                 d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                                 id="Path-107" fill="#000000"></path>
                                     </g>
                                 </svg><!--end::Svg Icon--></span> <span
                                     class="text-dark h4 ">' . date('h:iA', strtotime($row["event_start_date"])) . '</span>
                         </div>
         
                         <p class="text-dark-50 my-5 font-size-xl font-weight-bold">
                             ' . $row["event_desc"] . '
                         </p>
         
                         <a href="?page=pending-view&event_id=' . $row["event_id"] . '" class="btn btn-primary font-weight-bold py-2 px-6">View Event</a>
                         </div>
                         <div class="col-3">
                             <img src="' . base64_decode($row["event_poster"]) . '" style="width: 100%"/>                                   
                         
                         </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!--end::Engage Widget 7-->
             
         </div>
         </div>';
            }
                ?>



            <?php
            include('./control/db.php');
            if (isset($_GET['id'])) {
                $adminId = $_GET['id'];
            }
            $try = mysqli_query(
                $conn,
                "SELECT 
             stakeholder_tbl.*,
             venue_tbl.venue_name,
             venue_tbl.venue_id,
             venue_tbl.venue_desc,
             kld_event.event_id,
             kld_event.event_title,
             kld_event.event_desc,
             org_tbl.org_name,
             kld_event.event_start_date,
             kld_event.event_end_date,
             kld_event.event_poster,
             category_tbl.category_name,
             category_tbl.category_desc
         FROM `kld_event`
         LEFT JOIN stakeholder_tbl ON kld_event.event_id = stakeholder_tbl.event_id
         LEFT JOIN venue_tbl ON kld_event.venue_id = venue_tbl.venue_id
         LEFT JOIN org_tbl ON kld_event.event_org_id = org_tbl.org_id
         LEFT JOIN category_tbl ON kld_event.category_id = category_tbl.category_id
         WHERE kld_event.status = 'pending' AND stakeholder_tbl.status = 'approved' AND stakeholder_tbl.admin_id = $adminId
         ORDER BY `kld_event`.`event_start_date` DESC"
            );



            while ($row = $try->fetch_array()) {

                echo '
         <div class="row">
         <div class="col-xl-12">
         
             <!--begin::Engage Widget 7-->
             <div class="card card-custom card-stretch gutter-b">
                 <div class="card-body d-flex p-0">
                 
                     <div class="flex-grow-1 p-12 card-rounded bgi-no-repeat d-flex flex-column justify-content-center align-items-start"
                          style="background-color: #FFF; background-position: right bottom; background-size: auto 100%; background-image: url(assets/media/svg/humans/custom-88.png)">
         
                          <div class="row">
                             <div class="col-9">
         
                                 <a href="?page=pending-view&event_id=' . $row["event_id"] . '">
                                     <div class="d-flex align-items-center">
                                         <h1 class="text-primary font-weight-bolder m-0 text-hover-secondary">' . $row["event_title"] . '</h1>
                                         <span class="label label-success label-inline ml-2">Approved</span>
                                     </div>
                                 </a>
         
                         <h6 class="text-dark-50 font-weight-bolder m-0">' . $row["org_name"] . '</h6>
                         <div class="d-flex my-5">
                             <span
                                 class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <g id="Stockholm-icons-/-Design-/-Layers" stroke="none" stroke-width="1"
                                    fill="none" fill-rule="evenodd">
                                     <polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
                                     <path
                                             d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                             id="Shape" fill="#000000" fill-rule="nonzero"></path>
                                     <path
                                             d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                             id="Path" fill="#000000" opacity="0.3"></path>
                                 </g>
                             </svg></span> <span class="text-dark h4 text-hover-primary">' . $row["category_name"] . '</span> '; ?>
                <?php
                echo (!empty($row["venue_id"])) ?
                    '<a href="?page=venue-view&venue_id=' . $row["venue_id"] . '">
                                                                                                 <span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
                                                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                                 <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                     <g id="Stockholm-icons-/-Map-/-Marker1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                         <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                         <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
                                                                     </g>
                                                                 </svg>
                                                                 <!--end::Svg Icon-->
                                                             </span>
                                                             <span class="text-dark h4 text-hover-primary">' . $row["venue_name"] . '</span>
                                                         </a>'
                    :
                    '<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
                                                             <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Display3.svg-->
                                                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                     <rect x="0" y="0" width="24" height="24"/>
                                                                     <polygon fill="#000000" opacity="0.3" points="5 7 5 15 19 15 19 7"/>
                                                                     <path d="M11,19 L11,16 C11,15.4477153 11.4477153,15 12,15 C12.5522847,15 13,15.4477153 13,16 L13,19 L14.5,19 C14.7761424,19 15,19.2238576 15,19.5 C15,19.7761424 14.7761424,20 14.5,20 L9.5,20 C9.22385763,20 9,19.7761424 9,19.5 C9,19.2238576 9.22385763,19 9.5,19 L11,19 Z" fill="#000000" opacity="0.3"/>
                                                                     <path d="M5,7 L5,15 L19,15 L19,7 L5,7 Z M5.25,5 L18.75,5 C19.9926407,5 21,5.8954305 21,7 L21,15 C21,16.1045695 19.9926407,17 18.75,17 L5.25,17 C4.00735931,17 3,16.1045695 3,15 L3,7 C3,5.8954305 4.00735931,5 5.25,5 Z" fill="#000000" fill-rule="nonzero"/>
                                                                 </g>
                                                             </svg>
                                                             <!--end::Svg Icon-->
                                                         </span>
                                                         <span class="text-dark h4">Virtual Event</span>';
                ?><?php
                    echo '
                     </div>
         
                     <div class="d-flex">
                         <span><i class="text-dark flaticon2-calendar mr-3"></i></span> <span
                                 class="text-dark h4">' . date('M d, Y', strtotime($row["event_start_date"])) . '</span>
         
                         <span
                                 class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <g id="Stockholm-icons-/-Home-/-Clock" stroke="none" stroke-width="1"
                                    fill="none" fill-rule="evenodd">
                                     <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                     <path
                                             d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z"
                                             id="Mask" fill="#000000" opacity="0.3"></path>
                                     <path
                                             d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                             id="Path-107" fill="#000000"></path>
                                 </g>
                             </svg><!--end::Svg Icon--></span> <span
                                 class="text-dark h4 ">' . date('h:iA', strtotime($row["event_start_date"])) . '</span>
                     </div>
         
                     <p class="text-dark-50 my-5 font-size-xl font-weight-bold">
                         ' . $row["event_desc"] . '
                     </p>
         
                     <a href="?page=pending-view&event_id=' . $row["event_id"] . '" class="btn btn-primary font-weight-bold py-2 px-6">View Event</a>
                     </div>
                     <div class="col-3">
                         <img src="' . base64_decode($row["event_poster"]) . '" style="width: 100%"/>                                   
                     
                     </div>
                     </div>
                 </div>
             </div>
         </div>
         <!--end::Engage Widget 7-->
         
         </div>
         </div>';
                }




                    ?>



                <?php
                include('./control/db.php');
                if (isset($_GET['id'])) {
                    $adminId = $_GET['id'];
                }
                $try = mysqli_query(
                    $conn,
                    "SELECT 
             stakeholder_tbl.*,
             venue_tbl.venue_name,
             venue_tbl.venue_id,
             venue_tbl.venue_desc,
             kld_event.event_id,
             kld_event.event_title,
             kld_event.event_desc,
             org_tbl.org_name,
             kld_event.event_start_date,
             kld_event.event_end_date,
             kld_event.event_poster,
             category_tbl.category_name,
             category_tbl.category_desc
         FROM `kld_event`
         LEFT JOIN stakeholder_tbl ON kld_event.event_id = stakeholder_tbl.event_id
         LEFT JOIN venue_tbl ON kld_event.venue_id = venue_tbl.venue_id
         LEFT JOIN org_tbl ON kld_event.event_org_id = org_tbl.org_id
         LEFT JOIN category_tbl ON kld_event.category_id = category_tbl.category_id
         WHERE kld_event.status = 'pending' AND stakeholder_tbl.status = 'rejected' AND stakeholder_tbl.admin_id = $adminId
         ORDER BY `kld_event`.`event_start_date` DESC"
                );



                while ($row = $try->fetch_array()) {

                    echo '
         <div class="row">
         <div class="col-xl-12">
         
             <!--begin::Engage Widget 7-->
             <div class="card card-custom card-stretch gutter-b">
                 <div class="card-body d-flex p-0">
                 
                     <div class="flex-grow-1 p-12 card-rounded bgi-no-repeat d-flex flex-column justify-content-center align-items-start"
                          style="background-color: #FFF; background-position: right bottom; background-size: auto 100%; background-image: url(assets/media/svg/humans/custom-88.png)">
         
                          <div class="row">
                             <div class="col-9">
         
                                 <a href="?page=pending-view&event_id=' . $row["event_id"] . '">
                                     <div class="d-flex align-items-center">
                                         <h1 class="text-primary font-weight-bolder m-0 text-hover-secondary">' . $row["event_title"] . '</h1>
                                         <span class="label label-danger label-inline ml-2">Rejected</span>
                                     </div>
                                 </a>
         
                         <h6 class="text-dark-50 font-weight-bolder m-0">' . $row["org_name"] . '</h6>
                         <div class="d-flex my-5">
                             <span
                                 class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <g id="Stockholm-icons-/-Design-/-Layers" stroke="none" stroke-width="1"
                                    fill="none" fill-rule="evenodd">
                                     <polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
                                     <path
                                             d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                             id="Shape" fill="#000000" fill-rule="nonzero"></path>
                                     <path
                                             d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                             id="Path" fill="#000000" opacity="0.3"></path>
                                 </g>
                             </svg></span> <span class="text-dark h4 text-hover-primary">' . $row["category_name"] . '</span> '; ?>
                    <?php
                    echo (!empty($row["venue_id"])) ?
                        '<a href="?page=venue-view&venue_id=' . $row["venue_id"] . '">
                                                                                                 <span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
                                                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                                 <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                     <g id="Stockholm-icons-/-Map-/-Marker1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                         <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                         <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
                                                                     </g>
                                                                 </svg>
                                                                 <!--end::Svg Icon-->
                                                             </span>
                                                             <span class="text-dark h4 text-hover-primary">' . $row["venue_name"] . '</span>
                                                         </a>'
                        :
                        '<span class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3">
                                                             <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Display3.svg-->
                                                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                     <rect x="0" y="0" width="24" height="24"/>
                                                                     <polygon fill="#000000" opacity="0.3" points="5 7 5 15 19 15 19 7"/>
                                                                     <path d="M11,19 L11,16 C11,15.4477153 11.4477153,15 12,15 C12.5522847,15 13,15.4477153 13,16 L13,19 L14.5,19 C14.7761424,19 15,19.2238576 15,19.5 C15,19.7761424 14.7761424,20 14.5,20 L9.5,20 C9.22385763,20 9,19.7761424 9,19.5 C9,19.2238576 9.22385763,19 9.5,19 L11,19 Z" fill="#000000" opacity="0.3"/>
                                                                     <path d="M5,7 L5,15 L19,15 L19,7 L5,7 Z M5.25,5 L18.75,5 C19.9926407,5 21,5.8954305 21,7 L21,15 C21,16.1045695 19.9926407,17 18.75,17 L5.25,17 C4.00735931,17 3,16.1045695 3,15 L3,7 C3,5.8954305 4.00735931,5 5.25,5 Z" fill="#000000" fill-rule="nonzero"/>
                                                                 </g>
                                                             </svg>
                                                             <!--end::Svg Icon-->
                                                         </span>
                                                         <span class="text-dark h4">Virtual Event</span>';
                    ?><?php
                        echo '
                     </div>
         
                     <div class="d-flex">
                         <span><i class="text-dark flaticon2-calendar mr-3"></i></span> <span
                                 class="text-dark h4">' . date('M d, Y', strtotime($row["event_start_date"])) . '</span>
         
                         <span
                                 class="svg-icon svg-icon-md svg-icon-dark flex-shrink-0 mr-3 ml-3"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg--><svg
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <g id="Stockholm-icons-/-Home-/-Clock" stroke="none" stroke-width="1"
                                    fill="none" fill-rule="evenodd">
                                     <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                     <path
                                             d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z"
                                             id="Mask" fill="#000000" opacity="0.3"></path>
                                     <path
                                             d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                             id="Path-107" fill="#000000"></path>
                                 </g>
                             </svg><!--end::Svg Icon--></span> <span
                                 class="text-dark h4 ">' . date('h:iA', strtotime($row["event_start_date"])) . '</span>
                     </div>
         
                     <p class="text-dark-50 my-5 font-size-xl font-weight-bold">
                         ' . $row["event_desc"] . '
                     </p>
         
                     <a href="?page=pending-view&event_id=' . $row["event_id"] . '" class="btn btn-primary font-weight-bold py-2 px-6">View Event</a>
                     </div>
                     <div class="col-3">
                         <img src="' . base64_decode($row["event_poster"]) . '" style="width: 100%"/>                                   
                     
                     </div>
                     </div>
                 </div>
             </div>
         </div>
         <!--end::Engage Widget 7-->
         
         </div>
         </div>';
                    }




                        ?>

    </div>
    <!--end::Entry-->
</div>