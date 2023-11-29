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
                <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
                  <i class="ti ti-briefcase me-2 fs-6"></i>
                  <span class="d-none d-md-block">Asset Details</span> 
                </button>
              </li>
            </ul>
            <div class="card-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
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