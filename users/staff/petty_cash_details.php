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
$member = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                  array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_id="'.$request_id.'"','return_type'=>'single'));
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Petty Cash Requsitions</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Petty Cash Requisition Details</li>
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
      <?php include_once('../../layout/petty-cash.php') ?>
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Petty Cash Requisition Details</h5>
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Petty Cash">
                    <a class="btn btn-primary btn-sm" href="../../generate-pdf.php?type=petty_cash_details&requisistion_id=<?=$request_id?>" target="_blank">
                      <i class="ti ti-download"></i> Download
                    </a>
                  </li>
                </ul>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="row">
                      
                      <?php if($action == 'approve_requisition' && $member['requisition_status'] == 0){ ?>
                          <div class="col-lg-12">
                            <div class="card w-100">
                              <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                    <h5 class="card-title fw-semibold">Approve Requisition</h5>
                                  </div>
                                </div>
                                <div class="card shadow-none mb-0 mt-3">
                                  <div id="response"></div>
                                  <form id="petty-cash" method="post">
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
                                            <input type="text" class="form-control" name="remarks" placeholder="Enter any remark if there is any">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex align-items-center justify-content-end gap-3">  
                                          <input type="hidden" name="request_id" value="<?=$request_id?>"> 
                                          <input type="hidden" name="posted_by" value="<?=$member['requested_by']?>"> 
                                          <button type="submit" name="approve_petty_cash" id="approve_petty" class="btn btn-primary">Approve Requisition</button>                           
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php } ?>
                      <div class="row">
                        <!-- Top Performers -->
                        <div class="col-lg-12 d-flex">
                          <div class="card w-100">
                            <div class="card-body">
                              <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                  <h5 class="card-title fw-semibold">Petty Cash Approval</h5>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table align-middle  mb-0">
                                  <tbody class="border-top">
                                   
                                    
                                    <?php 
                                      $authorizer = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$member['approved_by'].'"','return_type'=>'single'));
                                        if(!empty($authorizer)){
                                    ?>
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
                                        <p class="mb-0 fs-3"><?=$member['date_approved']?></p>
                                      </td>
                                      <td colspan="3">
                                        <h6 class="fw-semibold mb-1">Remarks</h6>
                                        <span><?=$member['remarks']?></span>
                                      </td>
                                    </tr>
                                    <?php }else{
                                      echo'<tr><td colspan="3"><div class="alert alert-success"> Pending Approval</td></tr>';
                                    } ?>
                                    
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
                                <h5 class="card-title fw-semibold">Petty Cash Details</h5>
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
                                  <th>Subject</th>
                                  <td><?=$member['subject']?></td>
                                  <th>Amount</th>
                                  <td>MK<?=number_format($member['amount'],2,'.',',')?></td>
                                </tr>
                                <tr>
                                  <th>Sponsor</th>
                                  <td><?=$member['sponsor']?></td>
                                  <th>Status</th>
                                  <td>
                                    <?php 
                                    switch ($member['requisition_status']) {
                                      case 0:
                                        echo'<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                                        break;
                                      case 1:
                                        echo'<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
                                        break;
                                      case 2:
                                        echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                        break;
                                    }
                                  ?>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Date Posted</th>
                                  <td><?=$con->shortDate($member['date_posted'])?></td>
                                  <th>Description</th>
                                  <td><?=$member['description']?></td>
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