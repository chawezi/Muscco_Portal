<?php  
 $member = '';
 $member_id = '';
 if($_SESSION['USR_OF'] == 999){
  $member = $con->getRows('des', array('where'=>'de_id="'.$_SESSION['USR_ID'].'"','return_type'=>'single'));
  $member_id = $member['de_id'];
 }
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">My Profile</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">My Profile</li>
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
  <div class="card">
    <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
          <i class="ti ti-user-circle me-2 fs-6"></i>
          <span class="d-none d-md-block">Account Details</span> 
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications2" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
          <i class="ti ti-info-circle me-2 fs-6"></i>
          <span class="d-none d-md-block">Updates</span> 
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
          <i class="ti ti-lock-cog me-2 fs-6"></i>
          <span class="d-none d-md-block">Account Settings</span> 
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
                  <p class="card-subtitle mb-4">To change your personal details, edit and save from here</p>
                  <div id="error"></div>
                  <form id="add-member" name="add-member" method="post" action="">
                      <div>
                        <div class="">
                          <div class="row pt-3">
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="<?=$member['first_name']?>">
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                              <div class="mb-3 has-danger">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="<?=$member['last_name']?>">
                              </div>
                            </div>


                            <div class="col-md-4">
                              <div class="mb-3">
                                <label class="control-label">Location</label>
                                <input type="text" class="form-control" name="location" value="<?=$member['location']?>">
                              </div>
                            </div>
                            <!--/span-->
                          </div>
                          <!--/row-->
                          <div class="row">
                            <!--/span-->
                            <div class="col-md-4">
                              <div class="mb-3 has-success">
                                <label class="control-label">Email Address</label>
                                <input type="text" class="form-control" name="email" value="<?=$member['email_address']?>">
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label class="control-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="<?=$member['phone_number']?>">
                              </div>
                            </div>

                            <div class="col-md-4">
                            <div class="mb-3">
                              <label class="control-label"> Sponsored By</label>
                              <select class="form-control form-select" name="sponsor" tabindex="1">
                                <option value="">Select Sacco that sponsored him/her</option>
                                <?php
                                  $saccos = $con->getRows('sacco', array('order_by'=>'sacco_name'));
                                  if(!empty($saccos)){
                                    foreach ($saccos as $sacco) {
                                      echo'<option value="'.$sacco['sacco_id'].'"'; if($sacco['sacco_id'] == $member['sponsored_by']){ echo "selected";} echo' >'.$sacco['sacco_name'].'</option>';
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="control-label">Year of Graduation</label>
                              <input type="date" class="form-control" name="year" value="<?=$member['graduation_date']?>" wfd-id="id60">
                            </div>
                          </div>
                            <!--/span-->
                          </div>
                          <!--/row-->
                        </div>
                        <div class="col-12">
                          <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                            <input type="hidden" name="id" value="<?=$member_id?>">
                            <button type="submit" class="btn btn-primary px-4" name="update_de" id="update_member">         
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
        <div class="tab-pane fade show active" id="pills-notifications2" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
          <div class="row">
            <div class="col-12">
              <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold">Personal Updates</h5>
                  <p class="card-subtitle mb-4">Update your DEs on what you have been doing</p>
                  <div id="err"></div>
                  <form id="update-ge" name="update_member" method="post" action="">
                      <div>
                        <div class="">
                          <div class="row pt-3">
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="control-label">Briefly what are you currently doing? </label>
                                <textarea class="form-control" name="to_do"><?=$member['current_job']?></textarea>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="control-label">Briefly describe your Dessertation/Project you undertook? </label>
                                <textarea class="form-control" name="project"><?=$member['project']?></textarea>
                              </div>
                            </div>
                          </div>
                          <!--/row-->                          
                          <!--/row-->
                        </div>
                        <div class="col-12">
                          <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                            <input type="hidden" name="id" value="<?=$member_id?>">
                            <button type="submit" class="btn btn-primary px-4" name="update_updates" id="update_member1">         
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
                      <?php $username=$con->getRows('system_users',array('where'=>'member_id="'.$member_id.'"','return_type'=>'single')); ?>
                      <label for="exampleInputPassword1" class="form-label fw-semibold">Username</label>
                      <input type="text" class="form-control" name="username" value="<?=$username['username']?>">
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                      <input type="hidden" name="user_id" value="<?=$member_id?>">
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
                  <h5 class="card-title fw-semibold">Change Password</h5>
                  <p class="card-subtitle mb-4">To change your password please confirm here</p>
                  <div id="password_response"></div>
                  <form id="reset-password" name="reset-password" method="post">
                    <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label fw-semibold">Current Password</label>
                      <input type="password" class="form-control" name="old_password">
                    </div>
                     <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label fw-semibold">New Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="">
                      <label for="exampleInputPassword1" class="form-label fw-semibold">Confirm Password</label>
                      <input type="password" class="form-control" name="re_password">
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                      <input type="hidden" name="user_id" value="<?=$member_id?>">
                        <button type="submit" class="btn btn-primary px-4" name="reset_password_user" id="reset">         
                            Change Password
                        </button>
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