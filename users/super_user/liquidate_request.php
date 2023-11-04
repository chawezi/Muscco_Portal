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
        <h4 class="fw-semibold mb-8">Travel Advance Liquidation</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Liquidation Details</li>
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
      <?php include_once('../../layout/liquidation.php') ?>
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                  <h5 class="text-dark mb-0 fw-semibold">Travel Advance Liquidation</h5>
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
                      <?php  if($action == 'approve_request'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Approve Travel Request Liquidation</h5>
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
                                              <option value="2">Decline</option>
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
                                          <input type="hidden" name="liquid_id" value="<?=$request_id?>"> 
                                          <input type="hidden" name="posted_by" value="<?=$member['employee_id']?>"> 
                                          <?php if($member['request_status'] == 4){ ?>   
                                          <button type="submit" name="approve_travel_liquidation" id="approve_request" class="btn btn-primary">Approve</button>  
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
                      <?php if($member['request_status'] < 4){ ?>
                      <div class="row">
                        <!-- Top Performers -->
                        <div class="col-lg-12 d-flex">
                          <div class="card w-100">
                            <div class="card-body">
                              <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                  <h5 class="card-title fw-semibold">Liquidate Travel Advance </h5>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <div id="error"></div>
                                <form id="vehicle-request" method="post" action="" enctype="multipart/form-data">
                                  <div class="row">
                                    <div class="col-lg-6">                              
                                      <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Logistics</label>
                                        <select class="form-control form-select"  tabindex="1" disabled>
                                          <option value="">Select Logistics</option>
                                          <option value="1" <?php if($member['logistics'] == 1){echo "selected";}?>>Accomodated</option>
                                          <option value="2" <?php if($member['logistics'] == 2){echo "selected";}?>>Look for own Accomodation</option>
                                          <option value="3" <?php if($member['logistics'] == 3){echo "selected";}?>>One Day Return</option>
                                        </select> 
                                        <input type="hidden" name="logistics" value="<?=$member['logistics']?>">
                                      </div> 
                                      <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Mileage</label>
                                        <input type="number" class="form-control" name="mileage" value="<?=$member['mileage']?>">  
                                      </div>
                                      
                                                             
                                       <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Other Expenses Description</label>
                                        <input type="text" class="form-control" name="other_expense" >  
                                      </div> 
                                      <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Day Meal</label>
                                        <input type="number" min="0" class="form-control" name="day_meal" value="<?=$member['day_meal']?>">  
                                      </div>                    
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Night(s)</label>
                                        <input type="number" min="0" class="form-control" name="nights" value="<?=$member['nights']?>">  
                                      </div>
                                      <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Fuel Type</label>
                                        <select class="form-control form-select"  tabindex="1" disabled>
                                          <option value="">Select Fuel Type</option>
                                          <?php
                                            $fuels = $con->getRows('fuel_prices', array('order_by'=>'fuel'));
                                            if(!empty($fuels)){
                                              foreach ($fuels as $fuel) {
                                                echo'<option value="'.$fuel['fuel_id'].'"'; if($fuel['fuel_id']==$member['fuel']){echo "selected";}echo'>'.$fuel['fuel'].'</option>';
                                              }
                                            }
                                          ?>
                                        </select>  
                                        <input type="hidden" name="fuel" value="<?=$member['fuel']?>">
                                      </div> 
                                       <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Other Expenses Amount</label>
                                        <input type="number" class="form-control" name="other_amount" >  
                                      </div>

                                      <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Attachments</label>
                                        <input type="file" class="form-control" name="file" required>  
                                        <small>Please scan and attach all the required receipts.</small>
                                      </div>    
                                    </div>
                                     <div class="col-12">
                                      <div class="d-flex align-items-center justify-content-end gap-3">
                                        <input type="hidden" name="user_id" value="<?=$_SESSION['USR_ID']?>">
                                        <input type="hidden" name="request_id" value="<?=$request_id?>">
                                        <button type="submit" name="liquidate" id="vehicle_request"  class="btn btn-primary ">Liquidate</button>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                        }else{ 
                          $row = $con->getRows('travel_advance_liquidations', array('where'=>'travel_advance_id="'.$request_id.'"', 'return_type'=>'single'));
                          if(!empty($row)){
                            //print_r($row);
                      ?>
                      <div class="col-lg-12 ">
                        <div class="card w-100">
                          <div class="card-body p-4">
                            <div class="card shadow-none mt-3 mb-0">

                              <table class="table border table-striped table-bordered">
                                <tr>
                                  <th   colspan="3">
                                    <h5 class="card-title fw-semibold">Travel Advance Liquidation Details</h5>
                                  </th>
                                  <td>
                                    <a href="../../generate-pdf.php?type=travel_advance_liquidation&request_id=<?=$row['liquidation_id']?>" target="_blank" class="btn btn-primary btn-sm"><i class="ti ti-download"></i> Download</a>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Logistics</th>
                                  <td>
                                    <?php
                                            if($row['liq_logistics'] == 1){
                                              echo "Accomodated";
                                            }else if($row['liq_logistics'] == 2){
                                              echo "Look for own Accomodation";
                                            }else if($row['liq_logistics'] == 3){
                                              echo "One Day Return";
                                            }
                                          ?>
                                  </td>
                                  <th>Night(s)</th>
                                  <td><?=$row['liq_nights']?></td>
                                </tr>
                                <tr>
                                  <th>Accomodation Allowance</th>
                                  
                                  <td>MK<?=number_format($member['rate']*$row['liq_nights'], 2, '.',',')?></td>
                                  <th>Travel Allowance</th>
                                  <td>MK<?=number_format($row['liq_day_meal'], 2, '.',',')?></td>
                                </tr>
                                <tr>
                                  <th>Mileage</th>
                                  <td><?=$row['liq_mileage']?>KMs (<?=$row['liq_mileage']/10?> Litres)</td>
                                  <th>Total Fuel(MWK)</th>
                                  
                                  <td>MK<?=number_format(($row['liq_mileage']/10)*$member['fuel_price'], 2, '.',',')?></td>
                                </tr>
                                <tr>
                                  <th>Other Expenses</th>
                                  <td><?=$row['liq_other']?></td>
                                  <th>Other Payments</th>
                                  
                                  <td>MK<?=number_format($row['liq_other_amount'], 2, '.',',')?></td>
                                </tr>
                                <tr>
                                  <th>Liquidation Date</th>
                                  <td><?=$con->shortDate($row['liq_date'])?></td>
                                  <th>Receipts</th>
                                  
                                  <td>
                                    <a href="download-file.php?dir=../../uploads/receipts/&file=<?=$row['liq_receipts']?>" class="btn btn-primary btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download">
                                    <i class="ti ti-download fs-5"></i>
                                    Download
                                  </a>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Total Budget</th>
                                  
                                  <td>MK<?=number_format($member['total_budget'], 2, '.',',')?></td>
                                  <th>Actual Totals</th>
                                  <td>MK<?=number_format($row['total_liquidation'], 2, '.',',')?></td>
                                </tr>
                                <tr>
                                  <th colspan="2">
                                    Balance due to MUSCCO (+) / Refunds to Employee (-)
                                  </th>
                                  <th>
                                    Cash Return
                                  </th>
                                  <td>
                                    MK<?=number_format($row['balance_overage'], 2, '.',',')?>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } } ?>
                      
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
                                  <th>Employment #</th>
                                  <td><?=$member['employee_id']?></td>
                                  <th>Requested By</th>
                                  <td><?=ucwords($member['first_name'])." ".ucwords($member['last_name'])?></td>
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
                                            }
                                          ?>
                                  </td>
                                  <th>Night(s)</th>
                                  <td><?=$member['nights']?></td>
                                </tr>
                                <tr>
                                  <th>Rate Per Night</th>
                                  
                                  <td>MK<?=number_format($member['rate'], 2, '.',',')?></td>
                                  <th>Day Meal</th>
                                  <td>MK<?=number_format($member['day_meal'], 2, '.',',')?></td>
                                </tr>
                                <tr>
                                  <th>Total Allowance</th>
                                  
                                  <td>MK<?=number_format($member['rate']*$member['nights']+$member['day_meal'], 2, '.',',')?></td>
                                  <th>Mileage</th>
                                  <td><?=$member['mileage']?>KMs</td>
                                </tr>
                                <tr>
                                  <th>Fuel Type</th>
                                  
                                  <td>
                                    <?php
                                      $fuel = $con->getRows('fuel_prices', array('where'=>'fuel_id="'.$member['fuel'].'"','return_type'=>'single')); if(!empty($fuel)){ echo $fuel['fuel'];}else{echo "-";}?></td>
                                  <th>Fuel Price / Litre</th>
                                  <td>MK<?=number_format($member['fuel_price'], 2, '.',',')?></td>
                                </tr>
                                <tr>
                                  <th>Total Fuel(MWK)</th>
                                  
                                  <td>MK<?=number_format($member['total_fuel'], 2, '.',',')?></td>
                                  <th>Total Fuel(Litres)</th>
                                  <td><?=$member['mileage']/10?> Litres</td>
                                </tr>
                                <tr>
                                  <th>Total Budget</th>
                                  
                                  <td>MK<?=number_format($member['total_budget'], 2, '.',',')?></td>
                                  <th>Date Posted</th>
                                  <td><?=$con->shortDate($member['date_posted'])?></td>
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
      <?php include('../../layout/liquidation.php'); ?>
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