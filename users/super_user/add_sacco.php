<?php
  if(!isset($_SESSION)){
    session_start();
  }
  
  include_once('../../settings/master-class.php');
  $con = new MasterClass;
  $action = '';
  if(isset($_GET['action'])){
    $action = $_GET['action'];
  }
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Sacco</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Add Sacco</li>
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
      <h4 class="fw-semibold mb-8">Add Sacco</h4>
    </li>
    <li class="nav-item ms-auto">
      <a href="dashboard.php?page=sacco_list" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-archive me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">View Sacco</span>
      </a>
    </li>
  </ul>
<div class="row">
  <div class="col-lg-12">
    <!-- ---------------------
                                        start Person Info
    <div id="error"></div>                                ---------------- -->
    <div id="sacco_response"></div>
    
    <div class="card">
      
      <form id="add-sacco" name="add-sacco" method="post" action="" enctype="multipart/form-data">
        <div>
          <div class="card-body">
            <h5>Sacco Info</h5>
            <div class="row pt-3">
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="control-label">Sacco Name</label>
                  <input type="text" class="form-control" name="name" wfd-id="id58">
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="control-label">President</label>
                  <input type="text" class="form-control" name="president" wfd-id="id58">
                </div>
              </div>
              <!--/span-->
              <div class="col-md-4">
                <div class="mb-3 has-danger">
                  <label class="control-label">Date Registered</label>
                  <input type="date" class="form-control" name="date" wfd-id="id59">
                </div>
              </div>
              <!--/span-->
            </div>
            <!--/row-->
            <div class="row">

              <div class="col-md-4">
                <div class="mb-3">
                  <label class="control-label">Location</label>
                  <input type="text" class="form-control" name="location" wfd-id="id60">
                </div>
              </div>
              <!--/span-->
              <div class="col-md-4">
                <div class="mb-3 has-success">
                  <label class="control-label">Email Address</label>
                  <input type="text" class="form-control" name="email_address" wfd-id="id60">
                </div>
              </div>
              <!--/span-->
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="control-label">Phone Number</label>
                  <input type="text" class="form-control" name="phone_number" wfd-id="id60">
                </div>
              </div>
              <!--/span-->
            </div>
            <!--/row-->
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="control-label">Sacco Logo</label>
                  <input type="file" class="form-control" name="file" wfd-id="id60">
                </div>
              </div>
              <div class="col-md-8">
                <div class="mb-3">
                  <label class="control-label">Physical Address</label>
                  <input type="text" class="form-control" name="address" wfd-id="id60">
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="card-body">
            <!--/row-->
            <h5 class="mb-4">Assets Info</h5>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label>Assets</label>
                  <input type="number" class="form-control" name="assets" wfd-id="id63">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label>Shares</label>
                  <input type="number" class="form-control" name="shares" wfd-id="id64">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label>Profits</label>
                  <input type="number" class="form-control" name="profits" wfd-id="id64">
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label>Deposits</label>
                  <input type="number" class="form-control" name="deposits" wfd-id="id64">
                </div>
              </div>
              <!--/span-->
              <div class="col-md-4">
                <div class="mb-3">
                  <label>Loans</label>
                  <input type="number" class="form-control" name="loans" wfd-id="id65">
                </div>
              </div>
              <!--/span-->
            </div>
            <!--/row-->
            
          </div>
          <hr>
          <div class="card-body">
            <!--/row-->
            <h5 class="mb-4">Membership Info</h5>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label>Male Membership</label>
                  <input type="number" class="form-control" name="male" wfd-id="id63">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label>Female</label>
                  <input type="number" class="form-control" name="famale"  wfd-id="id64">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label>Youth Membership</label>
                  <input type="number" class="form-control" name="youth" wfd-id="id64">
                </div>
              </div>
              <!--/span-->
              <div class="col-md-6">
                <div class="mb-3">
                  <label>Other Membership</label>
                  <input type="number" class="form-control" name="other_members" wfd-id="id65">
                </div>
              </div>
              <!--/span-->
            </div>
            <!--/row-->
            
          </div>
          <hr>
          <div class="card-body">
            <!--/row-->
            <h5 class="mb-4">Sacco Admin Info</h5>
            <div class="row">
              <div class="col-md-3">
                <div class="mb-3">
                  <label>First Name</label>
                  <input type="text" class="form-control" name="first_name" wfd-id="id63">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label>Last Name</label>
                  <input type="text" class="form-control" name="last_name"  wfd-id="id64">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label>Email Address</label>
                  <input type="text" class="form-control" name="email" wfd-id="id64">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label>Phone</label>
                  <input type="text" class="form-control" name="phone" wfd-id="id65">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" wfd-id="id64">
                </div>
              </div>
              <!--/span-->
              <div class="col-md-4">
                <div class="mb-3">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" id="password" wfd-id="id65">
                </div>
              </div>
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
              <button type="submit" class="btn btn-primary px-4" name="save_sacco" id="save_sacco">
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