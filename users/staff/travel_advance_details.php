<?php
$member_id = '';
$request_id ='';
$action = '';
if(isset($_GET['request_id'])){
  $request_id = $_GET['request_id'];
}

if(isset($_GET['action'])){
  $action =$_GET['action'];
}
//$member = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$member_id.'"','return_type'=>'single'));
$member = $con->getRows('travel_advance_request a, pillars c, muscco_members b',
                        array('where'=>'a.travel_advance_id="'.$request_id.'" and a.employee_id=b.muscco_member_id and a.pillar=c.pillar_id', 'return_type'=>'single'));

  
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Travel Advance Request</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Request Details</li>
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
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                  <h5 class="text-dark mb-0 fw-semibold">Travel Advance Request Details</h5>
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Petty Cash">
                    <a class="btn btn-primary btn-sm" href="../../generate-pdf.php?type=travel_advance_details&request_id=<?=$request_id?>" target="_blank">
                      <i class="ti ti-download"></i> Download
                    </a>
                  </li>
                </ul>
              </div>
              <?php if(!empty($member)){ ?>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="row">
                      
                      <?php  if($action == 'check_request'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Check Travel Advance Request</h5>

                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="authorize_response"></div>
                                  <form id="assign-vehicle" method="post">
                                    <div class="row">
                                      <div class="col-lg-10">
                                        <div class="row">
                                          <div class="col-md-4">
                                            <select class="form-control form-select" name="action">
                                              <option value="">Select Action</option>
                                              <option value="1">Approve</option>
                                              <option value="99">Decline</option>
                                            </select>
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" class="form-control" name="remarks" placeholder="Enter any remark if there is any">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-2">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                          <input type="hidden" name="posted_by" value="<?=$member['employee_id']?>">
                                          <?php if($member['request_status'] != 1){ ?>   
                                          <button type="submit" name="check_travel_request" id="check_request" class="btn btn-primary">Check</button>  
                                          <?php } else{ ?>
                                            <button type="submit" name="" id="" class="btn btn-primary" disabled>Check</button>  
                                          <?php } ?>                            
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php  }else if($action == 'approve_request'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Approve Travel Advance Request</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="authorize_response"></div>
                                  <form id="assign-vehicle" method="post">
                                    <div class="row">
                                      <div class="col-lg-10">
                                        <div class="row">
                                          <div class="col-md-4">
                                            <select class="form-control form-select" name="action">
                                              <option value="">Select Action</option>
                                              <option value="2">Approve</option>
                                              <option value="99">Decline</option>
                                            </select>
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" class="form-control" name="remarks" placeholder="Enter any remark if there is any">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-2">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                          <input type="hidden" name="posted_by" value="<?=$member['employee_id']?>"> 
                                          <?php if($member['request_status'] == 1){ ?>   
                                          <button type="submit" name="approve_travel_request" id="approve_request" class="btn btn-primary">Approve</button>  
                                          <?php } else{ ?>
                                            <button type="submit" name="" id="" class="btn btn-primary" disabled>Approve</button>  
                                          <?php } ?>                            
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php  } 
                      ?>
                      <div class="row">
                        <!-- Top Performers -->
                        <div class="col-lg-12 d-flex">
                          <div class="card w-100">
                            <div class="card-body">
                              <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                  <h5 class="card-title fw-semibold">Travel Advance Request Update</h5>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table align-middle  mb-0">
                                  <thead>
                                    <tr class="text-muted fw-semibold">
                                      <th scope="col" class="ps-0" colspan="5">Checked By</th>
                                    </tr>
                                  </thead>
                                  <tbody class="border-top">
                                    <?php 
                                      $checker = $con->getRows('travel_advance_request a, muscco_members b',
                        array('where'=>'a.travel_advance_id="'.$request_id.'" and a.checked_by=b.muscco_member_id', 'return_type'=>'single'));
                                        if(!empty($checker)){
                                    ?>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Checked By</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($checker['first_name'])." ".ucwords($checker['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Date Checked</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=$con->shortDate($checker['date_checked'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Checker Remarks</h6>
                                        <p class="mb-0 fs-3"><?=$checker['checker_note']?></p>
                                      </td>
                                      
                                    </tr>
                                    <?php }else{
                                      echo "<tr><td>Waiting to be checked by the supervisor</td></tr>";
                                    } ?>
                                    
                                    <?php 
                                      $authorizer = $con->getRows('travel_advance_request a, muscco_members b',
                        array('where'=>'a.travel_advance_id="'.$request_id.'" and a.approved_by=b.muscco_member_id', 'return_type'=>'single'));
                                        if(!empty($authorizer)){
                                    ?>
                                    <tr class="text-muted fw-semibold">
                                      <th scope="col" class="ps-0" colspan="5">Vehicle Authorization</th>
                                    </tr>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Authorized By</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($authorizer['first_name'])." ".ucwords($authorizer['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Date Authorized</h6>
                                        <p class="mb-0 fs-3"><?=$con->shortDate($authorizer['date_approved'])?></p>
                                      </td>
                                      <td colspan="3">
                                        <h6 class="fw-semibold mb-1">Remarks</h6>
                                        <span><?=$authorizer['approver_note']?></span>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                    
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-lg-12 ">
                        <div class="card w-100">
                          <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                              <div>
                                <h5 class="card-title fw-semibold">Travel Advance Request Details</h5>
                              </div>
                            </div>
                            <div class="card shadow-none mt-3 mb-0">

                              <table class="table border table-striped table-bordered">
                                <tr>                                  
                                  <th>Requested By</th>
                                  <td><?=ucwords($member['first_name'])." ".ucwords($member['last_name'])?></td>
                                  <th>Date Posted</th>
                                  <td><?=$con->shortDate($member['date_posted'])?></td>
                                </tr>  
                                <tr>
                                  <th>Pillar</th>
                                  <td><?=$member['pillar']?></td>
                                  <th>Purpose</th>
                                  <td><?=$member['purpose']?></td>
                                </tr>
                                <tr>
                                  <th>Daily Itinerary </th>
                                  <td>
                                    <?php
                                      $daily = $con->getRows('daily_itinerary', array('where'=>'travel_advance_id="'.$request_id.'"','order_by'=>'daily_id asc'));
                                      if(!empty($daily)){
                                        foreach($daily as $row){
                                          echo $con->shortDate($row['date'])." ".$row['place_from']."-".$row['place_to']."<br/>";
                                        }
                                      }
                                    ?>
                                  </td>
                                  <th>Status</th>
                                  <td>
                                    <?php 
                                    switch ($member['request_status']) {
                                      case 0:
                                        echo'<span class="mb-1 badge rounded-pill bg-primary">Pending Checking</span>';
                                        break;
                                      case 1:
                                        echo'<span class="mb-1 badge rounded-pill bg-warning">Pending Approval</span>';
                                        break;
                                      case 2:
                                        echo'<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
                                        break;

                                      case 99:
                                        echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                        break;
                                    }
                                  ?>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Logistics</th>
                                  <td>
                                    <?php
                                            if($member['logistics'] == 1){
                                              echo "Accomodated";
                                            }else if($member['logistics'] == 2){
                                              echo "Look for own Accomodation";
                                            }else if($member['logistics'] == 3){
                                              echo "One Day Return";
                                            }else if($member['logistics'] == 4){
                                              echo "Accomodated / Own Accomodation";
                                            }
                                          ?>
                                  </td>
                                  <th>Night(s)</th>
                                  <td>
                                    <?php
                                      if($member['logistics'] == 4){
                                        $days = $member['nights'] + $member['own_days'];
                                        echo $days.' ('.$member['nights'].' <small>Accomodated</small><br/>'.$member['own_days'].' <small>Own Accomodation</small>)';
                                      }else{
                                        echo $member['nights'];
                                      }

                                      $allowances = ($member['rate']*$member['nights']) + $member['day_meal'] + ($member['own_days']*$member['own_rate']);
                                      
                                    ?>
                                      
                                    </td>
                                </tr>
                                <tr>
                                  <th>Rate Per Night</th>
                                  
                                  <td>
                                    <?php 
                                        if($member['logistics'] == 4){
                                            echo 'MK'.number_format($member['rate'], 2, '.',',').' <small>Accomodated</small><br/>MK'.number_format($member['own_rate'], 2, '.',',').' <small>Own Accomodation</small>';
                                        }else{
                                          echo 'MK'.number_format($member['rate'], 2, '.',',');
                                        }
                                        
                                    ?>
                                      
                                  </td>
                                  <th>Day Meal</th>
                                  <td>MK<?=number_format($member['day_meal'], 2, '.',',')?></td>
                                </tr>
                                <tr>
                                  <th>Total Allowance</th>
                                  
                                  <td>MK<?=number_format($allowances, 2, '.',',')?></td>
                                  <th>Tollgate Fees</th>
                                  <td>MK<?=number_format($member['tollgate_fees'], 2, '.',',')?></td>
                                  
                                </tr>
                                <tr>
                                  <th>Mileage</th>
                                  <td><?=$member['mileage']?>KMs</td>
                                  <th>Fuel Type</th>
                                  
                                  <td>
                                    <?php
                                      $fuel = $con->getRows('fuel_prices', 
                                                      array('where'=>'fuel_id="'.$member['fuel'].'"','return_type'=>'single')); 
                                      if(!empty($fuel)){
                                        echo $fuel['fuel'];
                                      }else{
                                        echo "-";
                                      }
                                    ?></td>
                                  
                                </tr>
                                <tr>
                                  <th>Fuel Price / Litre</th>
                                  <td>MK<?=number_format($member['fuel_price'], 2, '.',',')?></td>
                                  
                                  <th>Total Fuel(Litres)</th>
                                  <td><?=$member['mileage']/10?> Litres</td>
                                </tr>
                                <tr>
                                  <th>Total Fuel(MWK)</th>
                                  
                                  <td>MK<?=number_format($member['total_fuel'], 2, '.',',')?></td>
                                  <th>Total Budget</th>
                                  
                                  <td>MK<?=number_format($member['total_budget'], 2, '.',',')?></td>
                                  
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <?php }else{
                echo'<div class="alert alert-warning" style="width:98%; margin:1%;"> The selected request details can not be found.</div>';
              } ?>
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
