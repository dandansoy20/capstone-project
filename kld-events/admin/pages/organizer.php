<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">

        
                        <div class="card card-custom gutter-b">
									<!--begin::Header-->
									<div class="card-header border-0 py-5">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bolder text-dark">All Organization Users</span>
											<span class="text-muted mt-3 font-weight-bold font-size-sm">Kolehiyo ng Lungsod ng Dasmariñas</span>
										</h3>

                                        
										<div class="card-toolbar">
													<div class="dropdown dropdown-inline pr-5">
														<a href="#" class="btn btn-light-primary btn-sm font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter</a>
														<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
															<!--begin::Navigation-->
															<ul class="navi navi-hover">
																<li class="navi-header pb-1">
																	<span class="text-primary text-uppercase font-weight-bold font-size-sm">Filter</span>
																</li>
																<li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-shopping-cart-1"></i>
																		</span>
																		<span class="navi-text">Roles</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-calendar-8"></i>
																		</span>
																		<span class="navi-text">Status</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-graph-1"></i>
																		</span>
																		<span class="navi-text">Organization</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-rocket-1"></i>
																		</span>
																		<span class="navi-text">Edit</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-writing"></i>
																		</span>
																		<span class="navi-text">Archive</span>
																	</a>
																</li>
															</ul>
															<!--end::Navigation-->
														</div>
													</div>
												
											<a href="?page=add-org-user" class="btn btn-success font-weight-bolder font-size-sm">
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
														<th class="pr-0" style="width: 50px">Users</th>
														<th style="min-width: 200px"></th>
														<th style="min-width: 150px">Email</th>
														<th style="min-width: 150px">Organization</th>
														<th style="min-width: 150px">Status</th>
														<th class="pr-0 text-right" style="min-width: 150px">Action</th>
													</tr>
												</thead>
                                                <?php
                                                    include('./control/db.php');
                                                    $try = mysqli_query($conn, 
                                                        "Select * from org_acc  
                                                        left join org_tbl
                                                        on org_acc.org_id = org_tbl.org_id
                                                        where org_acc.status != 'INACTIVE' ");
                                                    while($row = $try->fetch_array()){
                                                        echo '
												<tbody>
													<tr>
														<td class="pl-0">
															<label class="checkbox checkbox-lg checkbox-inline">
																<input type="checkbox" value="'.$row['org_acc_id'].'" />
																<span></span>
															</label>
														</td>
														<td class="pr-0">
															<div class="symbol symbol-50 symbol-light mt-1">
																<span class="symbol-label">
																	<img src="'.( $row['org_profile'] ? $row['org_profile'] : 'assets/media/users/default.jpg').'" class="h-75 align-self-end" alt="" />
																</span>
															</div>
														</td>
														<td class="pl-0">
															<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">'.$row['org_fname'].' '.$row['org_lname'].'</a>
															<span class="text-muted font-weight-bold text-muted d-block">'.$row['org_kld_id'].'</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">'.$row['org_email'].'</span>
														</td>
														<td>
															<span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$row['org_name'].'</span>
															<span class="text-muted font-weight-bold">'.$row['org_role'].'</span>
														</td>
														<td>
                                                            <span class="label label-lg label-inline label-'.($row['status'] === "ACTIVE" ? "light-success" : "light-danger").'">'.($row['status'] === "ACTIVE" ? "Activated" : "Not yet Activated").'</span>
														</td>
														<td class="pr-0 text-right">
															<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
																<span class="svg-icon svg-icon-md svg-icon-primary">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
																			<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</a>
															<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
																<span class="svg-icon svg-icon-md svg-icon-primary">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
																			<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</a>
															<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
																<span class="svg-icon svg-icon-md svg-icon-primary">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
																			<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</a>
														</td>
													</tr>
												</tbody>
                                                ';
                    } ?>
											</table>
										</div>
										<!--end::Table-->
									</div>
									<!--end::Body-->
								</div>
                                 
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
                                                <img style="object-fit: cover;" src="'.( $row['org_profile'] ? $row['org_profile'] : 'assets/media/users/default.jpg').'" alt="" />
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