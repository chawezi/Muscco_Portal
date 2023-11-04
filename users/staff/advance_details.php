<?php
$member_id = '';
$request_id ='';
$action = '';
if(isset($_GET['advance_id'])){
  $request_id = $_GET['advance_id'];
}

if(isset($_GET['action'])){
  $action =$_GET['action'];
}
//$member = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$member_id.'"','return_type'=>'single'));
$member = $con->getRows('advance_requests a, muscco_members b',
                  array('where'=>'a.requested_by=b.muscco_member_id and a.advance_id="'.$request_id.'"','return_type'=>'single'));
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Staff Advances</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Advance Details</li>
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
      <?php include_once('../../layout/advances.php') ?>
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Advance Request Details</h5>
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Petty Cash">
                    <a class="btn btn-primary btn-sm" href="../../generate-pdf.php?type=advance_details&advance_id=<?=$request_id?>" target="_blank">
                      <i class="ti ti-download"></i> Download
                    </a>
                  </li>
                </ul>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="row">
                      
                      <?php if($action == 'verify_advance' && $member['advance_status'] == 0){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Supervisor Approval</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="response"></div>
                                  <form id="request-advance" method="post">
                                    <div class="row">
                                      <div class="col-lg-9">
                                        <div class="row">
                                          <div class="col-md-4">
                                            <select class="form-control form-select" name="action" tabindex="1">
                                              <option value="">Select Action...</option>                                
                                              <option value="1">Approve</option>                                
                                              <option value="2">Decline</option>                                
                                            </select>
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" class="form-control" name="comment" placeholder="Enter comments on status of previous advances.">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                          <input type="hidden" name="posted_by" value="<?=$member['requested_by']?>"> 
                                          <button type="submit" name="verify_advance" id="verify_advance" class="btn btn-primary">Submit</button>                           
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php } else if($action == 'check_advance' && $member['advance_status'] == 1){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Finance Approval</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="response"></div>
                                  <form id="request-advance" method="post">
                                    <div class="row">
                                      <div class="col-lg-9">
                                        <div class="row">
                                          <div class="col-md-4">
                                            <select class="form-control form-select" name="action" tabindex="1">
                                              <option value="">Select Action...</option>                                
                                              <option value="3">Approve</option>                                
                                              <option value="2">Decline</option>                                
                                            </select>
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" class="form-control" name="comment" placeholder="Enter comments on status of previous advances.">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                          <input type="hidden" name="posted_by" value="<?=$member['requested_by']?>"> 
                                          <button type="submit" name="check_advance" id="check_advance" class="btn btn-primary">Submit</button>                           
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php } else if($action == 'approve_advance' && $member['advance_status'] == 3){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Final Approval</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="response"></div>
                                  <form id="request-advance" method="post">
                                    <div class="row">
                                      <div class="col-lg-9">
                                        <div class="row">
                                          <div class="col-md-4">
                                            <select class="form-control form-select" name="action" tabindex="1">
                                              <option value="">Select Action...</option>                                
                                              <option value="4">Approve</option>                                
                                              <option value="2">Decline</option>                                
                                            </select>
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" class="form-control" name="comment" placeholder="Enter comments on status the advance.">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                          <input type="hidden" name="posted_by" value="<?=$member['requested_by']?>"> 
                                          <button type="submit" name="approve_advance" id="approve_advance" class="btn btn-primary">Submit</button>                           
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php } else if($action == 'make_payment' && $member['advance_status'] == 4){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Make Advance Payment</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="response"></div>
                                  <form id="request-advance" method="post">
                                    <div class="row">
                                      <div class="col-lg-9">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="paid_date" placeholder="Date">
                                          </div>
                                          <div class="col-md-6">
                                            <label>Advance Paid</label>
                                            <input type="number" class="form-control" name="amount" placeholder="Amount">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                          <input type="hidden" name="posted_by" value="<?=$member['requested_by']?>"> 
                                          <button type="submit" name="make_payment" id="make_payment" class="btn btn-primary mt-4">Make Payment</button>                           
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      

                        <?php } if($member['advance_status'] >= 4){ ?>
                      <div class="row">
                        <!-- Top Performers -->
                        <div class="col-lg-12 d-flex">
                          <div class="card w-100">
                            <div class="card-body">
                              <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                  <h5 class="card-title fw-semibold">Advance Payment Summary</h5>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table border table-striped table-bordered">
                                  <tr>
                                    <th>Advance Amount<br> MK<?=number_format($member['amount'],2,'.',',')?></th>
                                    <th>Advance Paid<br> MK<?=number_format($member['total_paid'],2,'.',',')?></th>
                                    <th>Balance<br> MK<?=number_format($member['balance'],2,'.',',')?></th>
                                    <th>Monthly Instalment<br> MK<?=number_format($member['monthly_installment'],2,'.',',')?></th>
                                  </tr>  
                                </table>

                                <table class="table border table-striped table-bordered">
                                  <tr>
                                    <th>Date</th>
                                    <th>Amount Paid</th>
                                    <th>Recorded By</th>
                                  </tr>
                                  <?php 
                                    $trans = $con->getRows('advance_payments a, muscco_members b', array('where'=>'a.advance_id="'.$member['advance_id'].'" and a.recorded_by=b.muscco_member_id'));
                                    if(!empty($trans)){
                                      foreach ($trans as $tran) {
                                        echo"<tr><td>".$tran['date_paid']."</td><td>MK".number_format($tran['amount_paid'],2,'.',',')."</td><td>".ucwords($tran['first_name'])." ".ucwords($tran['last_name'])."</td></tr>";
                                      }
                                    }
                                  ?>  
                                </table>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="row">
                        
                        <div class="col-lg-12 d-flex">
                          <div class="card w-100">
                            <div class="card-body">
                              <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                  <h5 class="card-title fw-semibold">Advance Request Updates</h5>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table align-middle  mb-0">
                                  <tbody class="border-top">
                                   
                                    
                                    <?php 
                                      $authorizer = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$member['verified_by'].'"','return_type'=>'single'));
                                        if(!empty($authorizer)){
                                    ?>
                                    <tr>
                                      <td colspan="3"><h5 class="card-title fw-semibold">Supervisor Approval</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Approved By</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($authorizer['first_name'])." ".ucwords($authorizer['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Date Approved</h6>
                                        <p class="mb-0 fs-3"><?=$con->shortDate($member['verified_date'])?></p>
                                      </td>
                                      <td colspan="3">
                                        <h6 class="fw-semibold mb-1">Comments</h6>
                                        <span><?=$member['verified_comment']?></span>
                                      </td>
                                    </tr>
                                    <?php }else{
                                      echo'<tr><td colspan="3"><div class="alert alert-success"> Pending approval by the supervisor.</td></tr>';
                                    } ?>

                                    <?php 
                                      if($member['advance_status'] >= 1){
                                      $checker = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$member['supervised_by'].'"','return_type'=>'single'));
                                        if(!empty($checker)){
                                    ?>
                                    <tr>
                                      <td colspan="3"><h5 class="card-title fw-semibold">Finance Approval</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Verified By</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($checker['first_name'])." ".ucwords($checker['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Date Verified</h6>
                                        <p class="mb-0 fs-3"><?=$con->shortDate($member['date_supervised'])?></p>
                                      </td>
                                      <td colspan="3">
                                        <h6 class="fw-semibold mb-1">Comments</h6>
                                        <span><?=$member['supervisor_comment']?></span>
                                      </td>
                                    </tr>
                                    <?php }else{
                                      echo'<tr><td colspan="3"><div class="alert alert-success"> Pending verification by the finance.</td></tr>';
                                    } } ?>

                                    <?php 
                                      if($member['advance_status'] >= 1){
                                      $approver = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$member['approved_by'].'"','return_type'=>'single'));
                                        if(!empty($approver)){
                                    ?>
                                    <tr>
                                      <td colspan="3"><h5 class="card-title fw-semibold">Final Approval</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div>
                                            <h6 class="fw-semibold mb-1">Approved By</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($approver['first_name'])." ".ucwords($approver['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6 class="fw-semibold mb-1">Date Approved</h6>
                                        <p class="mb-0 fs-3"><?=$con->shortDate($member['date_approved'])?></p>
                                      </td>
                                      <td colspan="3">
                                        <h6 class="fw-semibold mb-1">Comments</h6>
                                        <span><?=$member['approval_remark']?></span>
                                      </td>
                                    </tr>
                                    <?php }else{
                                      echo'<tr><td colspan="3"><div class="alert alert-success"> Pending approval by the CE.</td></tr>';
                                    } } ?>
                                    
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
                                <h5 class="card-title fw-semibold">Advance Details</h5>
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
                                  <th>Amount</th>
                                  <td>MK<?=number_format($member['amount'],2,'.',',')?></td>
                                  <th>Monthly Installment</th>
                                  <td>MK<?=number_format($member['monthly_installment'],2,'.',',')?></td>
                                </tr>
                                <tr>
                                  <th>Start Installment</th>
                                  <td><?=$con->monthYear($member['start'])?></td>
                                  <th>End Installment</th>
                                  <td><?=$con->monthYear($member['end'])?></td>
                                </tr>
                                <tr>
                                  <th>Number of Months</th>
                                  <td><?=$member['months']?></td>
                                  <th>Status</th>
                                  <td>
                                    <?php 
                                            switch ($member['advance_status']) {
                                              case 0:
                                                echo'<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                                                break;
                                              case 1:
                                                echo'<span class="mb-1 badge rounded-pill bg-info">Verified</span>';
                                                break;
                                              case 2:
                                                echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                                break;
                                              case 3:
                                                echo'<span class="mb-1 badge rounded-pill bg-warning">Checked</span>';
                                                break;
                                              case 4:
                                                echo'<span class="mb-1 badge rounded-pill bg-success">outstanding</span>';
                                                break;
                                              case 5:
                                                echo'<span class="mb-1 badge rounded-pill bg-success">Paid</span>';
                                                break;
                                            }
                                          ?>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Date Posted</th>
                                  <td><?=$con->shortDate($member['date_posted'])?></td>
                                  <th>Purpose</th>
                                  <td><?=$member['purpose']?></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                            <!-- ---------------------
                                    start Scroll - Vertical &amp; Horizontal
                                ---------------- -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h5 class="card-title fw-semibold">
                                            Advance History
                                            </h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="scroll_ver_hor"
                                            class="table border table-striped table-bordered display"
                                            style="width: 100%">
                                            <thead>
                                                <th>#</th>
                                                <th>Amount</th>
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th>Date Posted</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                              <?php
                                                $requisitions = $con->getRows('advance_requests', 
                                                         array('where'=>'requested_by="'.$member['requested_by'].'"','order_by'=>'date_posted desc'));
                                                if(!empty($requisitions)){
                                                  $i=0;
                                                  foreach($requisitions as $row){ 
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
                                                              <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </td>
                                                      <td>
                                                        MK<?=number_format($row['total_paid'],2,'.',',')?>        
                                                      </td>
                                                      <td>
                                                        MK<?=number_format($row['balance'],2,'.',',')?>        
                                                      </td>
                                                      <td>
                                                        <?=$con->shortDate($row['date_posted'])?>
                                                      </td>
                                                      <td>
                                                        <?php 
                                                          switch ($row['advance_status']) {
                                                            case 0:
                                                              echo'<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                                                              break;
                                                            case 1:
                                                              echo'<span class="mb-1 badge rounded-pill bg-info">Checked</span>';
                                                              break;
                                                            case 2:
                                                              echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                                              break;
                                                            case 3:
                                                              echo'<span class="mb-1 badge rounded-pill bg-warning">Verified</span>';
                                                              break;
                                                            case 4:
                                                              echo'<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
                                                              break;
                                                            case 5:
                                                              echo'<span class="mb-1 badge rounded-pill bg-success">Paid</span>';
                                                              break;
                                                          }
                                                        ?>
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
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Staff Advance Details </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/advances.php'); ?>
    </div>
  </div>
</div>