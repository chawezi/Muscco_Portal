<?php
	$loan_id = '';
	if(isset($_GET['loan_id'])){
		$loan_id = $_GET['loan_id'];
	}

	$loan = $con->getRows('loans a, sacco b', array('where'=>'a.loan_id="'.$loan_id.'" and a.sacco_id=b.sacco_id', 'return_type'=>'single'));

?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Loans</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Loan Info</li>
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
      <h4 class="fw-semibold mb-8">Loan Details</h4>
    </li>
    <li class="nav-item ms-auto">
      <a href="dashboard.php?page=sacco_loans" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-file-invoice me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Loans</span>
      </a>
    </li>
  </ul>
    <div class="row">
      <div class="col-md-7">
        <div id="error"></div>
        <div class="card">
            <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
                  <i class="ti ti-file-invoice me-2 fs-6"></i>
                  <span class="d-none d-md-block">Loan Details</span> 
                </button>
              </li>
            </ul>
            <div class="card-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                  <div class="row">
                    <div class="col-12">
                          <div id="sacco_response"></div>
                          <div class="table-responsive">
			                      <table class="table table-bordered">
			                        <thead class="bg-inverse  text-black">
			                          <!-- start row -->
			                          <tr>
			                            <th>Loan Number</th>
			                            <th><?=sprintf('%04d',$loan['loan_id'])?></th>
			                          </tr>
			                          <!-- end row -->
			                        </thead>
			                        <tbody>
			                          <!-- start row -->
			                          <tr>
			                            <td>Sacco Name</td>
			                            <td><?=$loan['sacco_name']?></td>
			                          </tr>
			                          <!-- end row -->
                                <!-- end row -->
                                <tr>
                                  <td>Posted By</td>
                                  <td><?php
                                        $user =  $con->getRows('sacco_members', array('where'=>'sacco_member_id="'.$loan['posted_by'].'"','return_type'=>'single'));
                                        echo ucwords($user['first_name'])." ".ucwords($user['last_name']);
                                        
                                      ?></td>
                                </tr>
                                <!-- end row -->
			                          <!-- start row -->
			                          <tr>
			                            <td>Description</td>
			                            <td><?=$loan['purpose']?></td>
			                          </tr>
			                          <!-- end row -->
			                          <!-- start row -->
			                          <tr>
			                            <td>Amount</td>
			                            <td>MK<?=number_format($loan['amount'],2,'.',',')?></td>
			                          </tr>
			                          <tr>
			                            <td>Loan Status</td>
			                            <td><?php
			                            			if($loan['loan_status'] == '0'){
			                            				echo '<span class="mb-1 badge rounded-pill bg-info">Pending</span>';
			                            			}else if($loan['loan_status'] == '1'){
			                            				echo '<span class="mb-1 badge rounded-pill bg-success">Paid</span>';
			                            			}if($loan['loan_status'] == '2'){
			                            				echo '<span class="mb-1 badge rounded-pill bg-danger">Cancelled</span>';
			                            			}
			                            		?></td>
			                          </tr>
			                          <!-- end row -->
			                          <tr>
			                            <td>Posted Date</td>
			                            <td><?=$con->shortDate($loan['date_posted'])?></td>
			                          </tr>
			                          <!-- end row -->
			                          <tr>
			                            <td>Loan File</td>
			                            <td>
			                            		
			                            		<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
										                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
										                      <a href="download-file.php?dir=../../uploads/loans/&file=<?=$loan['application_form']?>" target="_blank" class="btn btn-sm btn-secondary">
										                        <i class="ti ti-download fs-4"></i> Click To Download
										                      </a>										                    
										                  </div>
			                            		</td>
			                          </tr>
			                          <!-- end row -->
			                        </tbody>
			                      </table>
			                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
      </div>
      <div class="col-md-5">
      	<div class="card">
      		<?php if($loan['loan_status'] == '0'){ ?>
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold">Update Loan Status</h5>
            <small>Note that you can only update a pending loan application.</small>
            <div id="response"></div>
            <form class="mt-3" id="add-invoice" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label fw-semibold">Status</label>
                    <select class="form-control form-select" name="status" tabindex="1">
                      <option value="">Select Loan Application Status </option>
                      <option value="1">Approved</option>
                      <option value="2">Declined</option>                                 
                    </select>
                  </div>	
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label fw-semibold">Comment</label>
                    <input type="text" class="form-control" name="comment">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label fw-semibold">Attachment</label>
                    <input type="file" class="form-control" name="file" >
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                  	<input type="hidden" name="loan_id" value="<?=$loan['loan_id']?>">
                    <input type="hidden" name="posted_by" value="<?=$loan['posted_by']?>">
                  	<?php if($loan['loan_status'] == 0){ ?>
                    <button type="submit" name="change_loan_status" id="change_status" class="btn btn-primary">Update Status</button>
                  	<?php }else{ ?>
                  		<button disabled type="submit" class="btn btn-primary">Update Status</button>
                  	<?php }?>
                  </div>
                </div>
              </div>
            </form>        
          </div>
        	<?php }else{?>
            <?php if($loan['loan_status'] == '89dssds'){ ?>
              <div class="card-body p-4">
            <h5 class="card-title fw-semibold">Make Payment</h5>
            <div id="response"></div>
            <form class="mt-3" id="add-invoice" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-12">                                  
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label fw-semibold">Amount</label>
                    <input type="number" min="0" class="form-control" name="amount">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label fw-semibold">Date</label>
                    <input type="date" min="0" class="form-control" name="date">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label fw-semibold">Attachment</label>
                    <input type="file" class="form-control" name="file" >
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                    <input type="hidden" name="loan_id" value="<?=$loan['loan_id']?>">
                    <input type="hidden" name="posted_by" value="<?=$loan['posted_by']?>">
                    <button type="submit" name="change_loan_status" id="change_status" class="btn btn-primary">Update Status</button>
                  </div>
                </div>
              </div>
            </form>  
            <hr>      
          </div>
            <?php } ?>
            
        		<div class="card-body p-4">
              <h4 class="fw-semibold mb-3">Loan Status Update</h4>
              <div class="table-responsive">
              <table class="table table-bordered" style="width:100%" width="100%">
                <tbody>
                  <!-- start row -->
                  <tr>
                    <td>Comment</td>
                    <td><?=$loan['loan_remarks']?></td>
                  </tr>
                  <!-- end row -->
                  
                  <tr>
                    <td>Update By</td>
                    <td><?php
                          $user =  $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$loan['updated_by'].'"','return_type'=>'single'));
                          echo ucwords($user['first_name'])." ".ucwords($user['last_name']);
                          
                        ?></td>
                  </tr>
                  <!-- end row -->
                  <tr>
                    <td>Date Updated</td>
                    <td><?=$con->shortDate($loan['date_updated'])?></td>
                  </tr>
                  <!-- end row -->
                  <tr>
                    <td>Attachment</td>
                    <td>
                        <?php if(!empty($loan['muscco_form'])) { ?>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                            <a href="download-file.php?dir=../../uploads/loans/&file=<?=$loan['muscco_form']?>" target="_blank" class="btn btn-sm btn-secondary">
                              <i class="ti ti-download fs-4"></i> Click To Download
                            </a>                                        
                        </div>
                        <?php }else{ ?>
                          <span class="mb-1 badge rounded-pill bg-primary">Not Available</span>
                        <?php } ?>
                    </td>
                  </tr>
                  <!-- end row -->
                </tbody>
              </table>     
              </div>      
            </div>
        	<?php } ?>

        </div>
      </div>
    </div>