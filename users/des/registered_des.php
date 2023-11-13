<?php  
 $member = '';
 $member_id = '';
 if($_SESSION['USR_OF'] == 0){
  $member = $con->getRows('muscco_members a, positions b, branches c', array('where'=>'a.muscco_member_id="'.$_SESSION['USR_ID'].'" and b.position_id=b.position_id and a.branch=c.branch_id','return_type'=>'single'));
  $member_id = $member['muscco_member_id'];
 }else{
  $member = $con->getRows('sacco_members', array('where'=>'sacco_member_id="'.$_SESSION['USR_ID'].'"','return_type'=>'single'));
  $member_id = $member['sacco_member_id'];
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

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-4">
          <div class="card shadow-none border">
            <div class="card-body">
              <h4 class="fw-semibold mb-3">My Profile</h4>
              <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-briefcase text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0"><?=$member['position']?>   </h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-mail text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0"><?=$member['email_address']?></h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-phone text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0"><?=$member['phone_number']?></h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-2">
                  <i class="ti ti-map-pin text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0"><?=$member['branch_name']?></h6>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card shadow-none border">
            <div class="card-body">
              <div id="state_error"></div>
              <form name="add-statement" id="add-statement" method="post" action="">
                <div class="mb-3">
                  <textarea class="form-control" placeholder="Enter your profile statement" style="height: 137px" name="statement"><?=$member['profile']?></textarea>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <input type="hidden" name="id" value="<?=$member_id?>">
                  <button type="submit" class="btn btn-primary ms-auto" name="add_statement" id="add_statement">Update Statement</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section>
    <!-- Row -->
    <div class="row">
      <div class="col-12">
        <!-- ---------------------
                            start Employee Profile
                        ---------------- -->
        <div class="card">
          <div class="card-body">
            <h5>Profile Picture</h5>
            <p class="card-subtitle mb-0">
              Change your profile picture from here, allowed JPG, GIF or PNG. Max size of 800K
            </p>
          </div>
          <form class="mb-4 mt-5" name="add-picture" id="add-picture" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
              <div id="msg" style="width:90%"></div>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="file" class="form-control js--animations mr-1" name="file">
                  <span class="input-group-btn" style="margin-left: 5px;">
                    <input type="hidden" name="id" value="<?=$member_id?>">
                    <button class="btn btn-primary js--triggerAnimation" type="submit" name="update_profile_picture" id="update_profile">
                      Upload
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </form>
          <!-- / Form -->
          <!-- div -->
          <div class="row justify-content-center">
            <div class="text-center col-lg-4 col-md-6">
              <span id="animationSandbox" style="display: block">
                <div id="show_profile_picture"></div>
              </span>
            </div>
          </div>
          <br><br>
        </div>
        <!-- ---------------------
                            end Employee Profile
                        ---------------- -->
      </div>
    </div>
    <!-- End Row -->
    <!-- Row -->
    <div class="row">
      <div class="col-12">
        <!-- ---------------------
                            start personal details 
                        ---------------- -->
        <div class="card">
          <div class="card-body">
            <h5>Personal Details</h5>
            <p class="card-subtitle mb-0">
              To change your personal details, edit and save from here
            </p>
          <div id="error"></div>          
          </div>
          <form class="form-horizontal r-separator" id="add-member" name="add-member" method="post" action="">
            <div  class="card-body">
              <div class="">
                <div class="row pt-3">
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="control-label">Employment Number</label>
                      <input type="text" class="form-control" name="emp_number" value="<?=$member['employee_id']?>">
                    </div>
                  </div>
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
                  <!--/span-->
                </div>
                <!--/row-->
                <div class="row">

                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="control-label">Date of Birth</label>
                      <input type="date" class="form-control" name="dob" value="<?=$member['dob']?>">
                    </div>
                  </div>
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
                  <!--/span-->
                </div>
                <!--/row-->
                <div class="row">
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="control-label">Start Date</label>
                      <input type="date" class="form-control" name="dos" value="<?=$member['join_date']?>">
                    </div>
                  </div>
                  <div class="col-md-4">
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
                  <div class="col-md-4">
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
        <!-- ---------------------
                            end personal
                        ---------------- -->
      </div>
    </div>
    <!-- End Row -->
    
    <!-- Row -->
    <div class="row">
      <div class="col-12">
        <!-- ---------------------
                            start Employee Timing
                        ---------------- -->
        <div class="card">
          <div class="card-body">
            <h5>Account Settings</h5>
            <p class="card-subtitle mb-0">
              To change your login name and your password edit and save from here
            </p>
          </div>
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-lg-6 align-items-stretch">
                  <div class="card w-100 position-relative overflow-hidden">
                    <div class="card-body p-4">
                      <h5 class="card-title fw-semibold">Change Username</h5>
                      <p class="card-subtitle mb-4">To update your username change and save here </p>
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
        <!-- ---------------------
                            end Employee Timing
                        ---------------- -->
      </div>
    </div>
    <!-- End Row -->
  </section>
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