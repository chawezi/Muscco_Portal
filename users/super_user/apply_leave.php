<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Leave Application</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Apply Leave</li>
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
      <?php include_once('../../layout/leave-menu.php'); ?>      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Apply Leave</h5>
                
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                    
                    <a href="dashboard.php?page=my_leave_days" class="btn btn-sm btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="My Leave Days">
                      <i class="ti ti-calendar fs-4"></i> My Leave Days
                    </a>
                  </div>
                  
                </div>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card">
                    <div class="card-body p-4">
                      <h4 class="fw-semibold mb-3">Apply Leave</h4>
                      <?php $fy = $con->getRows('leave_fy', array('order_by'=>'fy_id desc','return_type'=>'single')); ?>
                      <p class="card-subtitle mb-4">Your leave days entitled are valid in this current financial year of <?=$fy['fy']?></p>
                      <div id="error"></div>
                      <form id="apply-leave" method="post" action="" enctype="multipart/form-data">                            
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Leave Type</label>
                              <select class="form-control form-select" name="type" tabindex="1">
                                <option value="">Select Leave Type</option>
                                <?php
                                  $categorys = $con->getRows('leave_types', array('order_by'=>'name'));
                                  if(!empty($categorys)){
                                    foreach ($categorys as $category) {
                                      echo'<option value="'.$category['type_id'].'">'.$category['name'].'</option>';
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Leave Taken According Leave Roster?</label>
                              <select class="form-control form-select" name="leave_roaster" tabindex="1">
                                <option value="">Choose...</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                               
                              </select>
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Leave Grant Required</label>
                              <select class="form-control form-select" name="leave_grant" tabindex="1">
                                <option value="">Choose...</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                               
                              </select>
                            </div>
                            
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Date From</label>
                              <input type="date" class="form-control" name="date_from">  
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Date To</label>
                              <input type="date" class="form-control" name="date_to">                              
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Reasons</label>
                              <textarea class="form-control" rows="3" name="reasons" placeholder=""></textarea>                       
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-3">
                              <input type="hidden" name="fy" value="<?=$fy['fy_id']?>">
                              <input type="hidden" name="user_id" value="<?=$_SESSION['USR_ID']?>">
                              <button type="submit" name="apply_leave" id="apply_leave"  class="btn btn-primary ">Apply Leave</button>
                            </div>
                          </div>
                        </div>
                      </form>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Help Desk </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/leave-menu.php'); ?>
      
    </div>
  </div>
</div>