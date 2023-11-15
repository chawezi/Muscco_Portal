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
        <span class="d-none d-md-block font-weight-medium fs-3">Sacco Directoty</span>
      </a>
    </li>
  </ul>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
               <div class="position-relative">
                  <div class="position-relative">
                    <div class="chat-box p-9" style="height: calc(150vh - 428px)" data-simplebar>
                      <div class="chat-list chat active-chat" data-user-id="1">
                        <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-3">
                            <i class="ti ti-archive text-primary" width="72" height="72" class="rounded-circle" style="font-size: 3em;"></i>
                            <div>
                              <h6 class="fw-semibold fs-4 mb-0"><?=$sacco['sacco_name']?></h6>
                              <p class="mb-0"><?=$sacco['sacco_president']?></p>
                              <p class="mb-0"><?=$con->shortDate($sacco['registered_date'])?></p>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Phone number</p>
                            <h6 class="fw-semibold mb-0"><?=$sacco['phone_number']?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Email address</p>
                            <h6 class="fw-semibold mb-0"><?=$sacco['email_address']?></h6>
                          </div>
                          <div class="col-3 mb-9">
                            <p class="mb-1 fs-2">Address</p>
                            <h6 class="fw-semibold mb-0"><?=$sacco['physical_address']?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">City</p>
                            <h6 class="fw-semibold mb-0"><?=$sacco['location']?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Sacco Assets</p>
                            <h6 class="fw-semibold mb-0"><?=number_format($sacco['assets'])?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Sacco Shares</p>
                            <h6 class="fw-semibold mb-0"><?=number_format($sacco['shares'])?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Sacco Deposits</p>
                            <h6 class="fw-semibold mb-0"><?=number_format($sacco['deposits'])?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Sacco Loans</p>
                            <h6 class="fw-semibold mb-0"><?=number_format($sacco['loans'])?></h6>
                          </div>

                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Sacco Membership(Male)</p>
                            <h6 class="fw-semibold mb-0"><?=$sacco['male_membership']?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Sacco Membership(Female)</p>
                            <h6 class="fw-semibold mb-0"><?=$sacco['female_membership']?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Sacco Membership(Youth)</p>
                            <h6 class="fw-semibold mb-0"><?=$sacco['youth_membership']?></h6>
                          </div>
                          <div class="col-3 mb-7">
                            <p class="mb-1 fs-2">Sacco Membership(Other)</p>
                            <h6 class="fw-semibold mb-0"><?=$sacco['other_membership']?></h6>
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