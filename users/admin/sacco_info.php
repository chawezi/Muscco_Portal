<?php
	$sacco_id = $_SESSION['USR_OF'];
	
	$sacco = $con->getRows('sacco', array('where'=>'sacco_id="'.$sacco_id.'"', 'return_type'=>'single'));

?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Sacco</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Sacco Info</li>
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
  
    <div class="row">
      <div class="col-lg-12">
        <div id="error"></div>
        <div class="card">
            <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
                  <i class="ti ti-archive me-2 fs-6"></i>
                  <span class="d-none d-md-block">Sacco Details</span> 
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
                          <h5 class="card-title fw-semibold">Sacco Details</h5>
                          <p class="card-subtitle mb-4">To change Sacco details, edit and save from here</p>
                          <div id="sacco_response"></div>
                          <form id="update-sacco" method="post">
                            <div class="row">
                              <div class="row pt-3">
		                          <div class="col-md-4">
		                            <div class="mb-3">
		                              <label class="control-label">Sacco Name</label>
		                              <input type="text" class="form-control" name="name" value="<?=$sacco['sacco_name']?>">
		                            </div>
		                          </div>
		                          <div class="col-md-4">
		                            <div class="mb-3">
		                              <label class="control-label">President</label>
		                              <input type="text" class="form-control" name="president" value="<?=$sacco['sacco_president']?>">
		                            </div>
		                          </div>
		                          <!--/span-->
		                          <div class="col-md-4">
		                            <div class="mb-3 has-danger">
		                              <label class="control-label">Date Registered</label>
		                              <input type="date" class="form-control" name="date" value="<?=$sacco['registered_date']?>">
		                            </div>
		                          </div>
		                          <!--/span-->
		                        </div>
	                        <!--/row-->
	                        <div class="row">

	                          <div class="col-md-4">
	                            <div class="mb-3">
	                              <label class="control-label">Location</label>
	                              <input type="text" class="form-control" name="location" value="<?=$sacco['location']?>">
	                            </div>
	                          </div>
	                          <!--/span-->
	                          <div class="col-md-4">
	                            <div class="mb-3 has-success">
	                              <label class="control-label">Email Address</label>
	                              <input type="text" class="form-control" name="email_address" value="<?=$sacco['email_address']?>">
	                            </div>
	                          </div>
	                          <!--/span-->
	                          <div class="col-md-4">
	                            <div class="mb-3">
	                              <label class="control-label">Phone Number</label>
	                              <input type="text" class="form-control" name="phone_number" value="<?=$sacco['phone_number']?>">
	                            </div>
	                          </div>
	                          <!--/span-->
	                        </div>
	                        <!--/row-->
	                        <div class="row">
	                          <div class="col-md-12">
	                            <div class="mb-3">
	                              <label class="control-label">Physical Address</label>
	                              <input type="text" class="form-control" name="address" value="<?=$sacco['physical_address']?>">
	                            </div>
	                          </div>
	                        </div>
                              <div class="col-12">
                              	<input type="hidden" name="sacco_id" value="<?=$sacco_id?>">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                  <button type="submit" name="update_sacco" id="update_sacco"  class="btn btn-primary">Update Sacco</button>
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
    </div>
    <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>