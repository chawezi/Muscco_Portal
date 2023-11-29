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
                <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab" aria-controls="pills-bills" aria-selected="false">
                  <i class="ti ti-user-circle me-2 fs-6"></i>
                  <span class="d-none d-md-block">Membership Details</span> 
                </button>
              </li>
            </ul>
            <div class="card-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
                  <div class="row justify-content-center">
                    <div class="col-lg-9">
                      <div class="card">
                        <div class="card-body p-4">
                          <h4 class="fw-semibold mb-3">Membership Information</h4>
                          <div id="member_response"></div>
                          <form id="update-membership" method="post" action="">                            
                            <div class="row">
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Male Membership</label>
	                              <input type="number" class="form-control" name="male" value="<?=$sacco['male_membership']?>">
	                            </div>
	                          </div>
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Female</label>
	                              <input type="number" class="form-control" name="famale"  value="<?=$sacco['female_membership']?>">
	                            </div>
	                          </div>
	                        </div>
	                        <div class="row">
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Youth Membership</label>
	                              <input type="number" class="form-control" name="youth" value="<?=$sacco['youth_membership']?>">
	                            </div>
	                          </div>
	                          <!--/span-->
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Other Membership</label>
	                              <input type="number" class="form-control" name="other_members" value="<?=$sacco['other_membership']?>">
	                            </div>
	                          </div>
	                          <!--/span-->
	                        </div>
	                        <!--/row-->	                        
		                    <div class="col-12">
		                      <div class="d-flex align-items-center justify-content-end gap-3">
		                      	<input type="hidden" name="sacco_id" value="<?=$sacco_id?>">
		                        <button type="submit" name="update_membership" id="update_member" class="btn btn-primary">Update Details</button>
		                      </div>
		                    </div>
	                        <!--/row-->
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