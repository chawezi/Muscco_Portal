<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Staff Members</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Add Member</li>
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
              <h4 class="fw-semibold mb-8">Add Staff Member</h4>
            </li>
            <li class="nav-item ms-auto">
              <a href="dashboard.php?page=users_list" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
               <i class="ti ti-users me-0 me-md-1 fs-4"></i>
                <span class="d-none d-md-block font-weight-medium fs-3">Staff Members</span>
              </a>
            </li>
          </ul>
<div class="row">
              <div class="col-lg-12">
                <!-- ---------------------
                                                    start Person Info
                <div id="error"></div>                                ---------------- -->
                <div id="error"></div>
                <div class="card">
                  
                  <form id="add-member" name="add-member" method="post" action="">
                    <div>
                      <div class="card-body">
                        <h5>Personal Info</h5>
                        <div class="row pt-3">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="control-label">First Name</label>
                              <input type="text" class="form-control" name="first_name" wfd-id="id58">
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-6">
                            <div class="mb-3 has-danger">
                              <label class="control-label">Last Name</label>
                              <input type="text" class="form-control" name="last_name" wfd-id="id59">
                            </div>
                          </div>
                          <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                          <!--/span-->
                          <div class="col-md-6">
                            <div class="mb-3 has-success">
                              <label class="control-label">Email Address</label>
                              <input type="text" class="form-control" name="email" wfd-id="id60">
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="control-label">Phone Number</label>
                              <input type="text" class="form-control" name="phone" wfd-id="id60">
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
                                      echo'<option value="'.$dept['department_id'].'">'.$dept['department'].'</option>';
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
                                      echo'<option value="'.$post['position_id'].'">'.$post['position'].'</option>';
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <!--/span-->
                        </div>
                      </div>
                      <hr>
                      <div class="card-body">
                        <!--/row-->
                        <h5 class="mb-4">Login Info</h5>
                        
                        <div class="row">
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Username</label>
                              <input type="text" class="form-control" name="username" wfd-id="id63">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Password</label>
                              <input type="password" class="form-control" name="password" id="password" wfd-id="id64">
                            </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Confirm Password</label>
                              <input type="password" class="form-control" name="re_password" wfd-id="id65">
                            </div>
                          </div>
                          <!--/span-->
                        </div>
                        <!--/row-->
                        
                      </div>
                      <div class="form-actions">
                        <div class="card-body border-top">
                          <button type="submit" class="btn btn-primary px-4" name="save_member" id="save_member">
                              <i class="ti ti-device-floppy me-1 fs-4"></i>
                              Save
                          </button>
                          <button type="reset" class="btn btn-danger px-4 ms-2 text-white">
                            Reset
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- ---------------------
                                                    end Person Info
                                                ---------------- -->
              </div>
            </div>