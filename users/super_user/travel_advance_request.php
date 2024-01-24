<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Travel Advance Request</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Travel Advance Request</li>
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
      <?php include_once('../../layout/travel-request.php') ?>
      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">My Travel Advance Requests</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                      <div id="err"></div>
                    <table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
                      <thead class="header-item">
                        <th>
                          #
                        </th>
                        <th>Pillar/Activity </th>
                        <th>Nights</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                          $leave = $con->getRows('travel_advance_request a, pillars b',
                                           array('where'=>'a.employee_id="'.$_SESSION['USR_ID'].'" and a.pillar=b.pillar_id', 'order_by'=>'a.date_posted desc'));
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
                                        <h6 class="user-name mb-0" data-name=""><?=$day['pillar']?></h6>
                                        <span>
                                          <?php
                                            if($day['logistics'] == 1){
                                              echo "Accomodated";
                                            }else if($day['logistics'] == 2){
                                              echo "Look for own Accomodation";
                                            }else if($day['logistics'] == 3){
                                              echo "One Day Return";
                                            }else if($day['logistics'] == 4){
                                              echo "Accomodated / Look for own Accomodation";
                                            }
                                          ?>                                          
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?php $nights=$day['nights']+$day['own_days']; echo $nights;?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>                               
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name="">MK<?=number_format($day['total_budget'], 2, '.',',')?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                 <td>
                                  <?php 
                                    switch ($day['request_status']) {
                                      case 0:
                                        echo'<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                                        break;
                                      case 1:
                                        echo'<span class="mb-1 badge rounded-pill bg-warning">Pending</span>';
                                        break;
                                      case 2:
                                        echo'<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
                                        break;
                                      case 4:
                                        echo'<span class="mb-1 badge rounded-pill bg-success">Liquidated</span>';
                                        break;
                                      case 5:
                                        echo'<span class="mb-1 badge rounded-pill bg-success">Complete</span>';
                                        break;

                                      case 99:
                                        echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                        break;
                                    }
                                  ?>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_posted'])?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                
                                <td>
                                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                                      <a href="dashboard.php?page=travel_advance_details&request_id=<?=$day['travel_advance_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-bs-placement="top" data-bs-title="View Details">
                                        <i class="ti ti-pencil fs-4"></i>
                                      </a>
                                      <?php if($day['request_status'] == 0){ ?>
                                        <button class="btn btn-sm btn-danger btn-sm btn_delete_advance_request" data-id3="<?=$day['travel_advance_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Request">
                                        <i class="ti ti-trash fs-4"></i>
                                      </button>
                                      <?php }else{ ?>
                                        <button class="btn btn-sm btn-danger btn-sm btn_delete_request" data-id3="<?=$day['travel_advance_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Can Not Delete" disabled>
                                        <i class="ti ti-trash fs-4"></i>
                                      </button>
                                      <?php } ?>
                                      
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Travel Advance Request </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/travel-request.php'); ?>
    </div>
  </div>
</div>