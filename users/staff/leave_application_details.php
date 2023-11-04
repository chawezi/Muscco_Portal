<?php
$member_id = '';
$application_id ='';
$action = '';
if(isset($_GET['application_id'])){
  $application_id = $_GET['application_id'];
}

if(isset($_GET['action'])){
  $action =$_GET['action'];
}
//$member = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$member_id.'"','return_type'=>'single'));
$member = $con->getRows('leave_applications a, leave_fy b, leave_types c, muscco_members d, positions e',
                        array('where'=>'a.application_id="'.$application_id.'" and a.member_id=d.muscco_member_id and a.fy_id=b.fy_id and a.leave_type=c.type_id and d.position_id=e.position_id', 'return_type'=>'single'));
?>
<?php
  $fy = $con->getRows('leave_fy', array('where'=>'fy_status=0','order_by'=>'fy_id desc', 'return_type'=>'single'));
  $current_yr = $fy['fy'];

?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Leave Application</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Leave Application Details</li>
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
      <?php include_once('../../layout/leave-menu.php') ?>
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Leave Application Details</h5>
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Petty Cash">
                    <a class="btn btn-primary btn-sm" href="../../generate-pdf.php?type=leave_application_details&request_id=<?=$application_id?>" target="_blank">
                      <i class="ti ti-download"></i> Download
                    </a>
                  </li>
                </ul>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="row">
                      
                      <?php 
                        if($action == 'check_leave'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Change Leave Status</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="product_response"></div>
                                  <form id="leave-type" method="post">
                                    <div class="row">
                                      <div class="col-lg-8">
                                        <div class="row">
                                          <div class="col-md-4">
                                            <select class="form-control form-select" name="action" tabindex="1">
                                              <option value="">Select Action...</option>                                
                                              <option value="1">Approve</option>                                
                                              <option value="4">Decline</option>                                
                                            </select>
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" class="form-control" name="reasons" placeholder="Enter any remark for your action">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="application_id" value="<?=$application_id?>"> 
                                          <input type="hidden" name="name" value="<?=$member['first_name']?>"> 
                                          <input type="hidden" name="user_id" value="<?=$member['member_id']?>"> 
                                          <?php if($member['leave_status'] == 0){ ?>                                
                                          <button type="submit" name="check_leave" id="update_status" class="btn btn-primary" >Check Leave</button> <?php } else{
                                            echo'<button type="submit" name="check_leave" id="update_status" class="btn btn-primary" disabled>Check Leave</button> ';
                                          } ?>                             
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php  }else if($action == 'decline_leave'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Change Leave Status</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="product_response"></div>
                                  <form id="leave-type" method="post">
                                    <div class="row">
                                      <div class="col-lg-8">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <input type="text" class="form-control" name="reasons" placeholder="Enter reasons for your action">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="application_id" value="<?=$application_id?>"> 
                                          <input type="hidden" name="user_id" value="<?=$member['member_id']?>"> 
                                          <input type="hidden" name="name" value="<?=$member['first_name']?>"> 
                                          <?php if($member['leave_status'] != 4){ ?>   
                                          <button type="submit" name="decline_leave" id="update_status" class="btn btn-primary">Decline Leave</button>  
                                          <?php } else{ ?>
                                            <button type="submit" name="decline_leave" id="update_status" class="btn btn-primary" disabled>Decline Leave</button>  
                                          <?php } ?>                            
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php  }else if($action == 'verify_leave'){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Verify Leave Application</h5>
                                    <small>Please verify the number of leave days applied for, make sure you minus the holidays and weekends and update accordingly.</small>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="product_response"></div>
                                  <form id="leave-type" method="post">
                                    <div class="row">
                                      <div class="col-lg-9">
                                        <div class="row">
                                          <div class="col-md-4">
                                            <select class="form-control form-select" name="action" tabindex="1">
                                              <option value="">Select Action...</option>                                
                                              <option value="2">Approve</option>                                
                                              <option value="4">Decline</option>                                
                                            </select>
                                          </div>
                                          <div class="col-md-2">
                                            <input type="number" class="form-control" min="0" name="leave_days" value="<?=$member['leave_days']?>">
                                          </div>
                                          <div class="col-md-6">
                                            <input type="text" class="form-control" name="reasons" placeholder="Enter reasons for your action">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="application_id" value="<?=$application_id?>"> 
                                          <input type="hidden" name="user_id" value="<?=$member['member_id']?>"> 
                                          <input type="hidden" name="name" value="<?=$member['first_name']?>"> 
                                          <?php if($member['leave_status'] == 1){ ?>   
                                          <button type="submit" name="verify_leave" id="update_status" class="btn btn-primary">Verify Leave</button>  
                                          <?php } else{ ?>
                                            <button type="submit" name="verify_leave" id="update_status" class="btn btn-primary" disabled>Verify Leave</button>  
                                          <?php } ?>                            
                                        </div>
                                      </div>
                                    </div>
                                  </form>
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
                                          <div class="col-md-4">
                                            <select class="form-control form-select" name="action" tabindex="1">
                                              <option value="">Select Action...</option>                                
                                              <option value="3">Approve</option>                                
                                              <option value="4">Decline</option>                                
                                            </select>
                                          </div>
                                          <div class="col-md-8">
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
                      <?php  } 
                      ?>
                      <div class="row">
                        <!-- Top Performers -->
                        <div class="col-lg-12 d-flex \">
                          <div class="card w-100">
                            <div class="card-body">
                              <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                  <h5 class="card-title fw-semibold">Leave Status Update</h5>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table align-middle text-nowrap mb-0">
                                  <thead>
                                    <tr class="text-muted fw-semibold">
                                      <th scope="col" class="ps-0">Action</th>
                                      <th scope="col">Reasons</th>
                                      <th scope="col">Dates</th>
                                    </tr>
                                  </thead>
                                  <tbody class="border-top">
                                    <?php 
                                      $checker = $con->getRows('leave_applications a, muscco_members b', array('where'=>'a.checked_by=b.muscco_member_id and a.application_id="'.$application_id.'"','return_type'=>'single'));
                                        if(!empty($checker)){
                                    ?>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div class="me-2 pe-1">
                                            <i class="ti ti-check fs-5" class="rounded-circle" width="40" height="40"></i>
                                          </div>
                                          <div>
                                            <h6 class="fw-semibold mb-1">Application Checked By</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($checker['first_name'])." ".ucwords($checker['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <p class="mb-0 fs-3"><?=$checker['check_reasons']?>-</p>
                                      </td>
                                      <td>
                                        <span><?=$con->shortDate($member['date_checked'])?></span>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                    <?php 
                                      $verify = $con->getRows('leave_applications a, muscco_members b', array('where'=>'a.verified_by=b.muscco_member_id and a.application_id="'.$application_id.'"','return_type'=>'single'));
                                        if(!empty($verify)){
                                    ?>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div class="me-2 pe-1">
                                            <i class="ti ti-checks fs-5" class="rounded-circle" width="40" height="40"></i>
                                          </div>
                                          <div>
                                            <h6 class="fw-semibold mb-1">Application Verified By</h6>
                                            <p class="fs-2 mb-0 text-muted"> <?=ucwords($verify['first_name'])." ".ucwords($verify['last_name'])?> </p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <p class="mb-0 fs-3"><?=$checker['verify_reasons']?></p>
                                      </td>
                                      <td>
                                        <span><?=$con->shortDate($member['date_verified'])?></span>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                    <?php 
                                      $approve = $con->getRows('leave_applications a, muscco_members b', array('where'=>'a.approved_by=b.muscco_member_id and a.application_id="'.$application_id.'"','return_type'=>'single'));
                                        if(!empty($approve)){
                                    ?>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div class="me-2 pe-1">
                                            <i class="ti ti-checklist fs-5" class="rounded-circle" width="40" height="40"></i>
                                          </div>
                                          <div>
                                            <h6 class="fw-semibold mb-1">Application Approved By</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($approve['first_name'])." ".ucwords($approve['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <p class="mb-0 fs-3"><?=$approve['approve_reasons']?></p>
                                      </td>
                                      <td>
                                        <span><?=$con->shortDate($member['date_approved'])?></span>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                    <?php 
                                      $decline = $con->getRows('leave_applications a, muscco_members b', array('where'=>'a.declined_by=b.muscco_member_id and a.application_id="'.$application_id.'"','return_type'=>'single'));
                                        if(!empty($decline)){
                                    ?>
                                    <tr>
                                      <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                          <div class="me-2 pe-1">
                                            <i class="ti ti-file-x fs-5" class="rounded-circle" width="40" height="40"></i>
                                          </div>
                                          <div>
                                            <h6 class="fw-semibold mb-1">Application Declined</h6>
                                            <p class="fs-2 mb-0 text-muted"><?=ucwords($decline['first_name'])." ".ucwords($decline['last_name'])?></p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <p class="mb-0 fs-3"><?=$decline['decline_reason']?></p>
                                      </td>
                                      <td>
                                        <span><?=$con->shortDate($decline['date_declined'])?></span>
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
                                <h5 class="card-title fw-semibold">Leave Application Details</h5>
                              </div>
                            </div>
                            <div class="card shadow-none mt-3 mb-0">

                              <table class="table border table-striped table-bordered">
                                <tr>
                                  <th>Leave #</th>
                                  <td><?=sprintf('%04d',$application_id)?></td>
                                  <th>Status</th>
                                  <td>
                                    <?php 
                                    switch ($member['leave_status']) {
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
                                </tr>
                                <tr>
                                  <th>Employee Name</th>
                                  <td><?=ucwords($member['first_name'])." ".ucwords($member['last_name'])?></td>
                                  <th>Position</th>
                                  <td><?=$member['position']?></td>
                                </tr>  
                                <tr>
                                  <th>Leave Type</th>
                                  <td><?=$member['name']?></td>
                                  <th>Financial Year</th>
                                  <td><?=$member['fy']?></td>
                                </tr>
                                <tr>
                                  <th>Date Start</th>
                                  <td><?=$con->shortDate($member['date_start'])?></td>
                                  <th>Date End</th>
                                  <td><?=$con->shortDate($member['date_end'])?></td>
                                </tr>
                                <tr>
                                  
                                  <th>Leave Days</th>
                                  <td><?=$member['leave_days']?></td>
                                  <th>Leave Grant</th>
                                  <td>
                                    <?=$member['leave_grant']?>
                                  </td>
                                </tr>
                                
                                <tr>
                                  
                                  <th>Date Applied</th>
                                  <td><?=$con->shortDate($member['date_requested'])?></td>

                                  <th>On Roaster?</th>
                                  <td>
                                    <?=$member['leave_roaster']?>
                                  </td>
                                </tr>
                                <tr>
                                  
                                  <th>Reasons</th>
                                  <td colspan="3">
                                    <?=$member['reason']?>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Leave Entitlement</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <table class="table border table-striped table-bordered">
                                    <thead class="header-item">
                                      <th>
                                        #
                                      </th>
                                      <th>Leave Type</th>
                                      <th>Days Entitled</th>
                                      <th>Days Taken</th>
                                      <th>Days Remaining</th>
                                    </thead>
                                    <tbody>
                                      <?php $types = $con->getRows('leave_types a, leave_days b', array('where'=>'a.type_id=b.leave_id and b.user_id="'.$_SESSION['USR_ID'].'" and b.fy_id="'.$fy['fy_id'].'"','order_by'=>'b.record_id'));
                                      if(!empty($types)){
                                        $i=0;
                                        foreach ($types as $type) { $i++; ?>
                                          <tr>
                                          <td>
                                            <?=$i?>
                                          </td>
                                          <td>
                                            <?=$type['name']?>
                                          </td>
                                          <td>
                                            <?=$type['days_entitled']?>
                                          </td>
                                          <td>
                                            <?=$type['days_taken']?>
                                          </td>
                                          <td>
                                            <?=$type['days_remaining']?>
                                          </td>
                                        </tr>
                                          <?php    }
                                      }else{
                                        echo'<tr><td colspan="3"><div class="alert alert-warning"> There are no records of this employee entitlement. </div></td></tr>';
                                      }
                                      ?>
                                      
                                      <!-- end row -->
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


    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Leave Application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/leave-menu.php'); ?>
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