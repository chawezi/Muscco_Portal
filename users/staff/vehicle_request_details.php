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
$member = $con->getRows('vehicle_requests a, muscco_members b',
                        array('where'=>'a.request_id="'.$request_id.'" and a.requested_by=b.muscco_member_id', 'return_type'=>'single'));
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Vehicle Request</h4>
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
      <?php include_once('../../layout/vehicle-request.php') ?>
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Vehicle Request Details</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="row">
                      
                      <?php 
                        if($action == 'assign_vehicle'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Assign Vehicle</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="assign_response"></div>
                                  <?php if($member['request_status'] == 1){ ?> 
                                  <form id="assign-vehicle" method="post">
                                    <div class="row">
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">
                                              Vehicle Registration Number
                                            </label>
                                            <input type="text" class="form-control" name="reg_number" placeholder="Registration Number">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">
                                              Opening Mileage
                                            </label>
                                            <input type="text" class="form-control" name="mileage" placeholder="Opening Mileage">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">
                                              Date of Request
                                            </label>
                                            <input type="text" class="form-control" name="date" value="<?=date('d/m/Y')?>" disabled>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-12 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <h6 class="card-title fw-semibold">Vehicle Condition</h6>
                                            <small>Check and verify vehicle condition</small>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">Fuel Level</label>
                                            <select class="form-control form-select" name="fuel" tabindex="1">
                                              <option value="">Select fuel level</option>
                                              <option value="Empty">Empty</option>
                                              <option value="1/4">1/4</option>
                                              <option value="1/2">1/2</option>
                                              <option value="Full">Full</option>
                                              
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-3">Dents</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="dent"  value="1">
                                              <label class="form-check-label" for="success-check">1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="dent"  value="Several">
                                              <label class="form-check-label" for="success2-check">Several</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="dent"  value="N/A">
                                              <label class="form-check-label" for="success2-check">N/A</label>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-3">Cleanliness</label>
                                            <br>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="clean"  value="Very Clean">
                                                  <label class="form-check-label" for="success-check">Very Clean</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="clean"  value="Not Clean">
                                                  <label class="form-check-label" for="success2-check">Not Clean</label>
                                                </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-8 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-3">Tools Included</label>
                                               <br>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="tools[]"  value="Jack">
                                                  <label class="form-check-label" for="success-check">Jack</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="tools[]"  value="Triangle Plates">
                                                  <label class="form-check-label" for="success2-check">Triangle Plates</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="tools[]" value="Ropes" >
                                                  <label class="form-check-label" for="success3-check">Ropes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="tools[]" value="Mats" >
                                                  <label class="form-check-label" for="success3-check">Mats</label>
                                                </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-3">Spare Tyre</label>
                                               <br>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="spare"  value="Available">
                                                  <label class="form-check-label" for="success-check">Available</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="spare"  value="N/A">
                                                  <label class="form-check-label" for="success2-check">N/A</label>
                                                </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                                                         
                                          <button type="submit" name="assign_vehicle" id="assign_vehicle" class="btn btn-primary" >Assign Vehicle</button> 

                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                  <?php } else{
                                      echo'<div class="alert alert-success"> A vehicle has been assigned </div>';
                                    } ?> 
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php  }else if($action == 'authorize_vehicle'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Authorize Vehicle</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="authorize_response"></div>
                                  <form id="assign-vehicle" method="post">
                                    <div class="row">
                                      <div class="col-lg-9">
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
                                      <div class="col-3">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                          <?php if($member['request_status'] != 1){ ?>   
                                          <button type="submit" name="authorize_vehicle" id="authorize_vehicle" class="btn btn-primary">Authorize Vehicle</button>  
                                          <?php } else{ ?>
                                            <button type="submit" name="" id="" class="btn btn-primary" disabled>Authorize Vehicle</button>  
                                          <?php } ?>                            
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php  }else if($action == 'return_vehicle'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Return Vehicle(<?=$member['vehicle_assigned']?>)</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="assign_response"></div>
                                  <?php if($member['request_status'] == 3){ ?>
                                  <form id="assign-vehicle" method="post">
                                    <div class="row">
                                      <div class="col-lg-3 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">
                                              Closing Mileage
                                            </label>
                                            <input type="text" class="form-control" name="mileage" placeholder="Closing Mileage">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-3 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">
                                             Distance Covered
                                            </label>
                                            <input type="text" class="form-control" name="distance" placeholder="Distance Covered">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-3 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">
                                             Fuel used in MK
                                            </label>
                                            <input type="text" class="form-control" name="fuel_used" placeholder="Fuel Used In MWK">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-3 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">
                                              Date of Returned
                                            </label>
                                            <input type="date" class="form-control" name="date">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-12 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <h6 class="card-title fw-semibold">Vehicle Condition</h6>
                                            <small>Check and verify vehicle condition</small>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold">Fuel Level</label>
                                            <select class="form-control form-select" name="fuel" tabindex="1">
                                              <option value="">Select fuel level</option>
                                              <option value="Empty">Empty</option>
                                              <option value="1/4">1/4</option>
                                              <option value="1/2">1/2</option>
                                              <option value="Full">Full</option>
                                              
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-3">Dents</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="dent"  value="1">
                                              <label class="form-check-label" for="success-check">1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="dent"  value="Several">
                                              <label class="form-check-label" for="success2-check">Several</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="dent"  value="N/A">
                                              <label class="form-check-label" for="success2-check">N/A</label>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-3">Cleanliness</label>
                                            <br>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="clean"  value="Very Clean">
                                                  <label class="form-check-label" for="success-check">Very Clean</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="clean"  value="Not Clean">
                                                  <label class="form-check-label" for="success2-check">Not Clean</label>
                                                </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-8 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-3">Tools Included</label>
                                               <br>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="tools[]"  value="Jack">
                                                  <label class="form-check-label" for="success-check">Jack</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="tools[]"  value="Triangle Plates">
                                                  <label class="form-check-label" for="success2-check">Triangle Plates</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="tools[]" value="Ropes" >
                                                  <label class="form-check-label" for="success3-check">Ropes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="tools[]" value="Mats" >
                                                  <label class="form-check-label" for="success3-check">Mats</label>
                                                </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 mb-3">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-3">Spare Tyre</label>
                                               <br>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="spare"  value="Available">
                                                  <label class="form-check-label" for="success-check">Available</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="spare"  value="N/A">
                                                  <label class="form-check-label" for="success2-check">N/A</label>
                                                </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                                                         
                                          <button type="submit" name="return_vehicle" id="assign_vehicle" class="btn btn-primary" >Return Vehicle</button> 

                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                  <?php } else{
                                      echo'<div class="alert alert-success"> A vehicle has been Returned </div>';
                                    } ?> 
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php  }else if($action == 'approve_leave'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Approve Leave Application</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="product_response"></div>
                                  <form id="leave-type" method="post">
                                    <div class="row">
                                      <div class="col-lg-9">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <input type="text" class="form-control" name="reasons" placeholder="Enter reasons for your action">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="application_id" value="<?=$application_id?>">
                                          <input type="hidden" name="user_id" value="<?=$member['member_id']?>"> 
                                          <input type="hidden" name="name" value="<?=$member['first_name']?>"> 
                                          <?php if($member['leave_status'] == 2){ ?>   
                                          <button type="submit" name="approve_leave" id="update_status" class="btn btn-primary">Approve Leave</button>  
                                          <?php } else{ ?>
                                            <button type="submit" name="approve_leave" id="update_status" class="btn btn-primary" disabled>Approve Leave</button>  
                                          <?php } ?>                            
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php  } if($member['requested_by'] == $_SESSION['USR_ID'] && $member['request_status'] == 2){ ?>
                        <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Receive Vehicle</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="authorize_response"></div>
                                  <form id="assign-vehicle" method="post">
                                    <div class="row">
                                      <div class="col-lg-8">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <p>Acknowledge receipt of the requested vehicle by clicking on the button to the right.</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>">   
                                          <button type="submit" name="received_vehicle" id="receive_vehicle" class="btn btn-primary">Received Vehicle</button>                             
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php } 
                      ?>
                      <div class="row">
                        <!-- Top Performers -->
                        <div class="col-lg-12 d-flex">
                          <div class="card w-100">
                            <div class="card-body">
                              <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                  <h5 class="card-title fw-semibold">Vehicle Request Update</h5>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table align-middle  mb-0">
                                  <thead>
                                    <tr class="text-muted fw-semibold">
                                      <th scope="col" class="ps-0" colspan="5">Vehicle Assigned</th>
                                    </tr>
                                  </thead>
                                  <tbody class="border-top">
                                    <?php 
                                      $checker = $con->getRows('vehicle_requests a, muscco_members b', array('where'=>'a.checked_by=b.muscco_member_id and a.request_id="'.$request_id.'"','return_type'=>'single'));
                                        if(!empty($checker)){
                                    ?>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Assigned By</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($checker['first_name'])." ".ucwords($checker['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Date Assigned</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=$con->shortDate($checker['date_checked'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Vehicle Assigned</h6>
                                        <p class="mb-0 fs-3"><?=$checker['vehicle_assigned']?></p>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Opening Mileage</h6>
                                        <span><?=$member['open_mileage']?></span>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Fuel Level</h6>
                                        <span><?=$member['fuel_level']?></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Dents</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=$checker['dents']?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Cleanliness</h6>
                                        <p class="mb-0 fs-3"><?=$checker['cleanliness']?></p>
                                      </td>
                                      <td colspan="2">
                                        <h6 class="fw-semibold mb-1">Tools Included</h6>
                                        <span><?=$member['tools']?></span>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Spare Tyre</h6>
                                        <span><?=$member['spare_tyre']?></span>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                    
                                    <?php 
                                      $authorizer = $con->getRows('vehicle_requests a, muscco_members b', array('where'=>'a.authorized_by=b.muscco_member_id and a.request_id="'.$request_id.'"','return_type'=>'single'));
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
                                        <p class="mb-0 fs-3"><?=$authorizer['date_authorized']?></p>
                                      </td>
                                      <td colspan="3">
                                        <h6 class="fw-semibold mb-1">Remarks</h6>
                                        <span><?=$authorizer['authorize_remarks']?></span>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                    
                                    <?php 
                                      $checker = $con->getRows('vehicle_requests a, muscco_members b', array('where'=>'a.checked_by=b.muscco_member_id and a.request_id="'.$request_id.'" and a.request_status >=4','return_type'=>'single'));
                                        if(!empty($checker)){
                                    ?>
                                    <tr class="text-muted fw-semibold">
                                      <th scope="col" class="ps-0" colspan="5">Vehicle Return Information</th>
                                    </tr>
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
                                            <h6 class="fw-semibold mb-1">Date Returned</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=$con->shortDate($checker['date_returned'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Closing Mileage</h6>
                                        <span><?=$member['close_mileage']?></span>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Distance Covered</h6>
                                        <span><?=$member['distance_covered']?></span>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Fuel Used</h6>
                                        <span>MK<?=number_format($member['fuel_used'])?></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Fuel Leve</h6>
                                        <span>MK<?=$member['return_fuel_level']?></span>
                                      </td>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Dents</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=$checker['return_dents']?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Cleanliness</h6>
                                        <p class="mb-0 fs-3"><?=$checker['return_cleanliness']?></p>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Tools Included</h6>
                                        <span><?=$member['return_tools']?></span>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Spare Tyre</h6>
                                        <span><?=$member['return_spare_tyre']?></span>
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
                                <h5 class="card-title fw-semibold">Vehicle Request Details</h5>
                              </div>
                            </div>
                            <div class="card shadow-none mt-3 mb-0">

                              <table class="table border table-striped table-bordered">
                                <tr>
                                  <th>Employment #</th>
                                  <td><?=$member['employee_id']?></td>
                                  <th>Requested By</th>
                                  <td><?=ucwords($member['first_name'])." ".ucwords($member['last_name'])?></td>
                                </tr>  
                                <tr>
                                  <th>Driver Name</th>
                                  <td><?=$member['driver_name']?></td>
                                  <th>Activity Name</th>
                                  <td><?=$member['destination']?></td>
                                </tr>
                                <tr>
                                  <th>Status</th>
                                  <td>
                                    <?php 
                                    switch ($member['request_status']) {
                                      case 0:
                                        echo'<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                                        break;
                                      case 1:
                                        echo'<span class="mb-1 badge rounded-pill bg-info">Checked</span>';
                                        break;
                                      case 2:
                                        echo'<span class="mb-1 badge rounded-pill bg-warning">Verified</span>';
                                        break;
                                      
                                      case 3:
                                        echo'<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
                                        break;

                                      case 4:
                                        echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                        break;
                                    }
                                  ?>
                                  </td>
                                  <th>Activity Name</th>
                                  <td><?=$member['activity_name']?></td>
                                </tr>
                                <tr>
                                  <th>Departure Date</th>
                                  <td><?=$member['date_from']?></td>
                                  <th>Arrival Date</th>
                                  <td><?=$member['date_to']?></td>
                                </tr>
                                <tr>
                                  <th>Days</th>
                                  
                                  <td><?=$member['days']?></td>
                                  <th>Date Requested</th>
                                  <td><?=$member['date_requested']?></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
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

<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  function getDays(){
    let action = "get_days";
    let id = "<?=$member_id?>";
    $.ajax({
        url:"get_leave_data.php",
        method:"GET",
        data:{action:action, id:id},
        success:function(data){ 
            $('#show_leave_types').html(data);
        }
    });
  }
  getDays();
</script>