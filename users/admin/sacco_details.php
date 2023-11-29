<?php
	$sacco_id = '';
	if(isset($_GET['sacco_id'])){
		$sacco_id = $_GET['sacco_id'];
	}

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
  <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
    <li class="nav-item">
      <h4 class="fw-semibold mb-8"><?=$sacco['sacco_name']?> Information</h4>
    </li>
    <li class="nav-item ms-auto">
      <a href="dashboard.php?page=sacco_list" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-archive me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Saccos</span>
      </a>
    </li>
  </ul>
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
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
                  <i class="ti ti-briefcase me-2 fs-6"></i>
                  <span class="d-none d-md-block">Asset Details</span> 
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab" aria-controls="pills-bills" aria-selected="false">
                  <i class="ti ti-user-circle me-2 fs-6"></i>
                  <span class="d-none d-md-block">Membership Details</span> 
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
                  <i class="ti ti-users me-2 fs-6"></i>
                  <span class="d-none d-md-block">Sacco Staff Members</span> 
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
                <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
                  <div class="row justify-content-center">
                    <div class="col-lg-9">
                      <div class="card">
                        <div class="card-body p-4">
                          <h4 class="fw-semibold mb-3">Assets Information</h4>
                          <div id="assets_response"></div>
                          <form id="update-assets" method="post">                            
                            <div class="row">
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Assets</label>
	                              <input type="number" class="form-control" name="assets" value="<?=$sacco['assets']?>">
	                            </div>
	                          </div>
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Shares</label>
	                              <input type="number" class="form-control" name="shares" value="<?=$sacco['shares']?>">
	                            </div>
	                          </div>
	                        </div>
	                        <div class="row">
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Deposits</label>
	                              <input type="number" class="form-control" name="deposits" value="<?=$sacco['deposits']?>">
	                            </div>
	                          </div>
	                          <!--/span-->
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Profits</label>
	                              <input type="number" class="form-control" name="profits" value="<?=$sacco['profits']?>">
	                            </div>
	                          </div>
	                          <div class="col-md-6">
	                            <div class="mb-3">
	                              <label>Loans</label>
	                              <input type="number" class="form-control" name="loans" value="<?=$sacco['loans']?>">
	                            </div>
	                          </div>
	                          <div class="col-12">
			                      <div class="d-flex align-items-center justify-content-end gap-3">
			                      	<input type="hidden" name="sacco_id" value="<?=$sacco_id?>">
			                        <button type="submit" name="update_assets" id="update_assets"  class="btn btn-primary">Update Details</button>
			                      </div>
			                    </div>
	                          <!--/span-->
	                        </div>
	                        <!--/row-->
                          
                        </div>
                      </div>
                    </div>
                    
                    </form>
                  </div>
                </div>
                <div class="tab-pane fade" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
                  <div class="row justify-content-center">
                    <div class="col-lg-9">
                      <div class="card">
                        <div class="card-body p-4">
                          <h4 class="fw-semibold mb-3">Membership Information</h4>
                          <div id="member_response"></div>
                          <form id="update-membership">                            
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
                <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
                  <div class="table-responsive">
                    <div id="response"></div>
                    <div id="show_all_saccos"></div>
	                </div>
                </div>
              </div>
            </div>
          </div>
        
      </div>
    </div>
    <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
    	function getSacco(){
        let action = "get_sacco_members";
        let id= "<?=$sacco_id?>";
        $.ajax({
            url:"get_sacco_data.php",
            method:"POST",
            data:{action:action, id:id},
            success:function(data){ 
                $('#show_all_saccos').html(data);
            }
        });
      }
      getSacco();
    </script>