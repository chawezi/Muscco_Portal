<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Vehicle Request</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Authorize Vehicle</li>
          </ol>
        </nav>
      </div>
      <div class="col-3">
        <div class="text-center mb-n5">  
            <img src="../../dist/images/breadcrumb/emailSv.png" alt="" class="img-fluid mb-n4">
          </div>
      </div>
    </div>
  </div>
</div>
<div class="card chat-application">
  <div class="d-flex align-items-center justify-content-between gap-3 m-3 d-lg-none">
      <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
        <i class="ti ti-menu-2 fs-5"></i>
      </button>
    </div>
  <div class="d-flex w-100">
    <div class="left-part border-end w-20 flex-shrink-0 d-none d-lg-block">
      <?php include_once('../../layout/vehicle-request.php') ?>
      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Authorize Vehicle</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                    <table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
                      <thead class="header-item">
                        <th>
                          #
                        </th>
                        <th>Officer & Position </th>
                        <th>Driver </th>
                        <th>Destination & Activity</th>
                        <th>Date From-To</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                          $leave = $con->getRows('vehicle_requests a, muscco_members b, positions c',
                                           array('where'=>'a.requested_by=b.muscco_member_id and b.position_id=c.position_id and a.request_status=0', 'order_by'=>'date_requested desc'));
                          if(!empty($leave)){
                            $i=0;
                            foreach($leave as $day){ 
                              $i++;
                        ?>
                              <tr class="search-items">
                                <td>
                                  <?=$i?>
                                </td>
                                
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?=ucwords($day['first_name'])." ".ucwords($day['last_name'])?></h6>
                                        <span class="user-work fs-3" data-occupation=""><?=$day['position']?></span>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td><?=$day['driver_name']?></td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?=ucwords($day['departure_from'])."-".ucwords($day['destination'])?></h6>
                                        <span class="user-work fs-3" data-occupation=""><?=$day['activity_name']?></span>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_from'])?></h6>
                                        <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_to'])?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                
                                <td>
                                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                                      <a href="dashboard.php?page=vehicle_request_details&request_id=<?=$day['request_id']?>&action=authorize_vehicle" class="btn btn-primary btn-sm btn_day_cancel" data-bs-placement="top" data-bs-title="View Details">
                                        <i class="ti ti-pencil fs-4"></i>
                                      </a>
                                      <button class="btn btn-sm btn-danger btn-sm btn_delete_request" data-id3="<?=$day['request_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                        <i class="ti ti-trash fs-4"></i>
                                      </button>
                                    </div>
                                    
                                  </div>
                                </td>
                              </tr>
                        <?php }
                          }
                        ?>
                    </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Vehicle Request </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/vehicle-request.php'); ?>
    </div>
  </div>
</div>