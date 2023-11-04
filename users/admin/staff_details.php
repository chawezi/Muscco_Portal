<?php  
  $member_id = '';
  if(isset($_GET['staff_id'])){
    $member_id = $_GET['staff_id'];
  }

  $member = $con->getRows('sacco_members a, system_users b', array('where'=>'a.sacco_member_id="'.$member_id.'" and a.sacco_member_id=b.member_id','return_type'=>'single'));
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Members</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Member Info</li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          <div class="text-center mb-n5">  
            <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
          </div>
        </div>
      </div>
    </div>
  </div>
  <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
    <li class="nav-item">
      <h4 class="fw-semibold mb-8">Member Information</h4>
    </li>
    <li class="nav-item ms-auto">
      <a href="dashboard.php?page=users_list" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-users me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Members List</span>
      </a>
    </li>
  </ul>
  <div class="card">
    <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
          <i class="ti ti-user-circle me-2 fs-6"></i>
          <span class="d-none d-md-block">Account Details</span> 
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
          <i class="ti ti-lock-cog me-2 fs-6"></i>
          <span class="d-none d-md-block">Account Settings</span> 
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
          <i class="ti ti-lock-access me-2 fs-6"></i>
          <span class="d-none d-md-block">Permision</span> 
        </button>
      </li>
    </ul>
    <div class="card-body">
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
          <div class="row">
            <div class="col-12">
              <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold">Personal Details</h5>
                  <p class="card-subtitle mb-4">To change the members' personal details, edit and save from here</p>
                  <div id="error"></div>
                  <form id="add-member" name="add-member" method="post" action="">
                      <div>
                        <div class="">
                          <div class="row pt-3">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="<?=$member['first_name']?>">
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                              <div class="mb-3 has-danger">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="<?=$member['last_name']?>">
                              </div>
                            </div>
                            <!--/span-->
                          </div>
                          <!--/row-->
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3 has-success">
                                <label class="control-label">Email Address</label>
                                <input type="text" class="form-control" name="email" value="<?=$member['email_address']?>">
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="control-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="<?=$member['phone_number']?>">
                              </div>
                            </div>
                            <!--/span-->
                          </div>
                          <!--/row-->
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="control-label">Department</label>
                                <select class="form-control form-select" name="department" tabindex="1">
                                  <option value="">Select Department</option>
                                  <?php
                                    $departments = $con->getRows('departments', array('where'=>'member_of="'.$_SESSION['USR_OF'].'"', 'order_by'=>'department'));
                                    if(!empty($departments)){
                                      foreach ($departments as $dept) {
                                        echo'<option value="'.$dept['department_id'].'"';if($dept['department_id'] == $member['department_id']){echo "selected";}echo'>'.$dept['department'].'</option>';
                                      }
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="control-label">Position</label>
                                <select class="form-control form-select" name="position" tabindex="1">
                                  <option value="">Select Position</option>
                                  <?php
                                    $positions = $con->getRows('positions', array('where'=>'member_of="'.$_SESSION['USR_OF'].'"', 'order_by'=>'position'));
                                    if(!empty($positions)){
                                      foreach ($positions as $post) {
                                        echo'<option value="'.$post['position_id'].'"';if($post['position_id']==$member['position_id']){echo "selected";}echo'>'.$post['position'].'</option>';
                                      }
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <!--/span-->
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                            <input type="hidden" name="id" value="<?=$member_id?>">
                            <button type="submit" class="btn btn-primary px-4" name="update_staff" id="update_member">         
                                Update Details
                            </button>
                          </div>
                        </div>
                        
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
          <div class="row justify-content-center">
            <div class="col-lg-6 d-flex align-items-stretch">
              <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold">Change Username</h5>
                  <p class="card-subtitle mb-4">To change the username of change and save here </p>
                  <div id="username_response"></div>
                  <form id="change-username" name="change-username" method="post">
                    <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label fw-semibold">Username</label>
                      <input type="text" class="form-control" name="username" value="<?=$member['username']?>">
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                      <input type="hidden" name="user_id" value="<?=$member['member_id']?>">
                        <button type="submit" class="btn btn-primary px-4" name="change_username" id="change_username">         
                            Change Username
                        </button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-stretch">
              <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold">Reset Password</h5>
                  <p class="card-subtitle mb-4">To reset password for the selected member please confirm here</p>
                  <div id="password_response"></div>
                  <form id="reset-password" name="reset-password" method="post">
                    <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label fw-semibold">New Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="">
                      <label for="exampleInputPassword1" class="form-label fw-semibold">Confirm Password</label>
                      <input type="password" class="form-control" name="re_password">
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                      <input type="hidden" name="user_id" value="<?=$member['member_id']?>">
                        <button type="submit" class="btn btn-primary px-4" name="reset_password" id="reset">         
                            Reset Password
                        </button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
          <div class="row">
            <div class="col-lg-8">
              <div id="err"></div>
              <div class="card">                
                <div class="card-body p-4">
                  <?php if($member['account_status'] == 0 || $member['account_status'] == 1 || $member['account_status'] == 3){  ?>
                  <h4 class="fw-semibold mb-3">Is <?=ucwords($member['first_name'])?> no longer with Muscco?</h4>
                  <div class="d-flex align-items-center justify-content-between pb-7">
                    <p class="mb-0">Once a member resigns or leaves Muscco because of any reason, his/her account will be active and they can still access your information, to avoid this deactivate his/her account now.</p>
                    <button class="btn btn-danger deactivate_account" data-id3="<?=$member['member_id']?>">Deactivate</button>
                  </div>
                  <?php }elseif($member['account_status'] == 2){ ?>
                    <h4 class="fw-semibold mb-3">Is <?=ucwords($member['first_name'])?> back with Muscco?</h4>
                    <div class="d-flex align-items-center justify-content-between pb-7">
                      <p class="mb-0">Once an account has been deactivated, it can be reactivated.</p>
                      <button class="btn btn-danger reactivate_account" data-id3="<?=$member['member_id']?>">Reactivate</button>
                    </div>
                  <?php } ?>
                  <?php 
                    $permissions = $con->getRows('permissions', array('where'=>'permission_id=3 or permission_id=9','order_by'=>'permission_id')); 
                    if(!empty($permissions)){
                      foreach ($permissions as $pem) { ?>
                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                          <div>
                            <h5 class="fs-4 fw-semibold mb-0"><?=$pem['permission']?></h5>
                            <p class="mb-0"><?=$pem['description']?></p>
                          </div>
                          <button class="btn btn-primary grant_access" data-id3="<?=$pem['permission_id']?>" data-member="<?=$member_id?>">Grant</button>
                        </div>
                  <?php    }
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body p-4">
                  <h5 class="fs-5 fw-semibold mb-0">Granted Permissions</h5>
                  <p class="mb-3">Below are granted permissions of the selected member.</p>
                  <div id="show_granted_access"></div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript">
    function getUserAccess(){
      let action = "granted_access";
      let id = "<?=$member['member_id']?>";
    $.ajax({
        url:"get_access_rights.php",
        method:"POST",
        data:{action:action,id:id},
        success:function(data){ 
            $('#show_granted_access').html(data);
        }
    });
    }
    getUserAccess();
  </script>