<?php
	$invoice_id = '';
	if(isset($_GET['invoice_id'])){
		$invoice_id = $_GET['invoice_id'];
	}

	$invoice = $con->getRows('invoices a, sacco b', array('where'=>'a.invoice_id="'.$invoice_id.'" and a.sacco_id=b.sacco_id', 'return_type'=>'single'));

?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Invoices</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Invoice Info</li>
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
      <h4 class="fw-semibold mb-8">Invoice Number <b><?=$invoice['invoice_number']?></b> Details</h4>
    </li>
    <li class="nav-item ms-auto">
      <a href="dashboard.php?page=invoice_list" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-file-invoice me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Invoices</span>
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
                  <span class="d-none d-md-block">Invoice Details</span> 
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
                  <i class="ti ti-file-diff me-2 fs-6"></i>
                  <span class="d-none d-md-block">Update Invoice</span> 
                </button>
              </li>
            </ul>
            <div class="card-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                  <div class="row">
                    <div class="col-12">
                          <p class="card-subtitle mb-4">To change Invoice status use the form to the right.</p>
                          <div id="sacco_response"></div>
                          <div class="table-responsive">
			                      <table class="table table-bordered">
			                        <thead class="bg-inverse  text-black">
			                          <!-- start row -->
			                          <tr>
			                            <th>Invoice Number</th>
			                            <th><?=$invoice['invoice_number']?></th>
			                          </tr>
			                          <!-- end row -->
			                        </thead>
			                        <tbody>
			                          <!-- start row -->
			                          <tr>
			                            <td>Sacco Name</td>
			                            <td><?=$invoice['sacco_name']?></td>
			                          </tr>
			                          <!-- end row -->
			                          <!-- start row -->
			                          <tr>
			                            <td>Description</td>
			                            <td><?=$invoice['description']?></td>
			                          </tr>
			                          <!-- end row -->
			                          <!-- start row -->
			                          <tr>
			                            <td>Amount</td>
			                            <td>MK<?=number_format($invoice['amount'],2,'.',',')?></td>
			                          </tr>
			                          <!-- update the balance and the amount paid -->
			                          <?php 
			                          	$update = $con->getRows('invoice_status', array('where'=>'invoice_id="'.$invoice_id.'"','return_type'=>'single'));
			                          	if(empty($update)){ 
			                          ?>

			                          <tr>
			                            <td>Amount Paid</td>
			                            <td>MK<?=number_format($invoice['amount_paid'],2,'.',',')?></td>
			                          </tr>
			                           <tr>
			                            <td>Balance</td>
			                            <td>MK<?php $balance = $invoice['amount'] - $invoice['amount_paid']; echo number_format($balance,2,'.',',')?></td>
			                          </tr>
			                          <!-- end row -->
			                        	<?php }else{ ?>
			                        		<tr>
			                            <td>Amount Paid</td>
			                            <td>
			                            	MK
			                            	<?php 
			                            		$paid = $invoice['amount_paid'] + $update['paid_amount'];  
			                            		echo number_format($paid,2,'.',',');
			                            	?>
			                            			
			                            	</td>
				                          </tr>
				                          <tr>
				                            <td>Balance</td>
				                            <td>
				                            	MK
				                            	<?php 
				                            		$balance = $invoice['amount'] - ($invoice['amount_paid'] + $update['paid_amount']); 
				                            		echo number_format($balance,2,'.',',');
				                            	?>				                            		
				                            	</td>
				                          </tr>
			                        	<?php } ?>
			                          <tr>
			                            <td>Invoice Status</td>
			                            <td><?php
			                            			if($invoice['invoice_status'] == '0'){
			                            				echo '<span class="mb-1 badge rounded-pill bg-info">Pending</span>';
			                            			}else if($invoice['invoice_status'] == '1'){
			                            				echo '<span class="mb-1 badge rounded-pill bg-success">Paid</span>';
			                            			}if($invoice['invoice_status'] == '2'){
			                            				echo '<span class="mb-1 badge rounded-pill bg-danger">Cancelled</span>';
			                            			}
			                            		?></td>
			                          </tr>
			                          <!-- end row -->
			                          <tr>
			                            <td>Posted By</td>
			                            <td><?php
			                            			$user =  $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$invoice['posted_by'].'"','return_type'=>'single'));
			                            			echo ucwords($user['first_name'])." ".ucwords($user['last_name']);
			                            			
			                            		?></td>
			                          </tr>
			                          <!-- end row -->
			                          <tr>
			                            <td>Due Date</td>
			                            <td><?=$con->shortDate($invoice['due_date'])?></td>
			                          </tr>
			                          <tr>
			                            <td>Posted Date</td>
			                            <td><?=$con->shortDate($invoice['date_posted'])?></td>
			                          </tr>
			                          <!-- end row -->
			                          <tr>
			                            <td>Invoice File</td>
			                            <td>
			                            		
			                            		<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
										                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
										                      <a href="download-file.php?dir=../../uploads/invoices/&file=<?=$invoice['invoice_file']?>" target="_blank" class="btn btn-sm btn-secondary">
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
                <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
                  <div class="row justify-content-center">
                    <div class="col-lg-11">
                      <div class="row">
				                <div class="col-12">
				                      <h5 class="card-title fw-semibold">Update Invoice</h5>
				                      <small>Note that you can only update a pending invoice.</small>
				                      <div id="response"></div>
				                      <form class="mt-3" id="add-invoice" method="post" enctype="multipart/form-data">
				                        <div class="row">
				                          <div class="col-lg-6">
				                            <div class="mb-4">
				                              <label for="exampleInputPassword1" class="form-label fw-semibold">Sacco Name</label>
				                              <select class="form-select" name="sacco">
				                                <option value="">Select Sacco</option>
				                                <?php
				                                  $saccos = $con->getRows('sacco', array('order_by'=>'sacco_name asc'));
				                                  if(!empty($saccos)){
				                                    foreach($saccos as $sacco){
				                                      echo'<option value="'.$sacco['sacco_id'].'"'; if($sacco['sacco_id'] == $invoice['sacco_id']){echo "selected";} echo'>'.$sacco['sacco_name'].'</option>';
				                                    }
				                                  }
				                                ?>
				                              </select>
				                            </div>
				                            <div class="mb-4">
				                              <label for="exampleInputPassword1" class="form-label fw-semibold">Description</label>
				                              <input type="text" class="form-control" name="description" value="<?=$invoice['description']?>">
				                            </div>

				                            <div class="mb-4">
				                              <label for="exampleInputPassword1" class="form-label fw-semibold">Update Invoice File</label>
				                              <input type="file" class="form-control" name="invoice_file" >
				                            </div>
				                          </div>
				                          <div class="col-lg-6">
				                            <div class="mb-4">
				                              <label for="exampleInputPassword1" class="form-label fw-semibold">Invoice Number</label>
				                              <input type="text" class="form-control" name="invoice_number" value="<?=$invoice['invoice_number']?>">
				                            </div>
				                            <div class="mb-4">
				                              <label for="exampleInputPassword1" class="form-label fw-semibold">Due Date</label>
				                              <input type="date" class="form-control" name="due_date" value="<?=$invoice['due_date']?>">
				                            </div>
				                            <div class="mb-4">
				                              <label for="exampleInputPassword1" class="form-label fw-semibold">Amount</label>
				                              <input type="number" class="form-control" name="amount" value="<?=$invoice['amount']?>">
				                            </div>
				                            <div class="mb-4">
				                              <label for="exampleInputPassword1" class="form-label fw-semibold">Amount Paid</label>
				                              <input type="number" class="form-control" name="amount_paid" value="<?=$invoice['amount_paid']?>">
				                            </div>
				                          </div>
				                          <div class="col-12">
				                            <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
				                            	<input type="hidden" name="invoice_id" value="<?=$invoice['invoice_id']?>">
				                            	<input type="hidden" name="invoice_attachment" value="<?=$invoice['invoice_file']?>">
				                            	<?php if($invoice['invoice_status'] == 0){ ?>
				                              <button type="submit" name="update_invoice" id="add_invoice" class="btn btn-primary">Update Invoice</button>
				                            	<?php }else{ ?>
				                            		<button disabled type="submit" class="btn btn-primary">Update Invoice</button>
				                            	<?php }?>
				                            </div>
				                          </div>
				                        </div>
				                      </form>
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
      <div class="col-md-5">
      	<div class="card">
      		<?php if($invoice['invoice_status'] == '0'){ ?>
          <div class="card-body p-4">
            <h4 class="fw-semibold mb-3">Change Invoice Status</h4>
            <p class="card-subtitle mb-4">Note that you can not change the status of the cancelled or paid invoice</p>
            <div id="update_response"></div>
            <form id="update-invoice" method="post" action="" enctype="multipart/form-data">                          
              <div class="row">
	              <div class="col-md-12">
	                <div class="mb-3">
	                  <label>Status</label>
	                  <select class="form-control form-select" name="status" tabindex="1">
	                    <option value="">Select Invoice Status </option>
	                    <option value="1">Paid</option>
	                    <option value="2">Cancel</option>	                                
	                  </select>
	                </div>
	              </div>
	              <div class="col-md-12">
	                <div class="mb-3">
	                  <label>Amount Paid</label>
	                  <input type="number" class="form-control" name="amount" >
	                </div>
	              </div>
	              <div class="col-md-12">
	                <div class="mb-3">
	                  <label>Comment</label>
	                  <input type="text" class="form-control" name="comment" >
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="mb-3">
	                  <label>Attachment</label>
	                  <input type="file" class="form-control" name="file">
	                </div>
	              </div>
	              <!--/span-->
	              
	              <div class="col-12">
	              <div class="d-flex align-items-center justify-content-end gap-3">
	              	<input type="hidden" name="invoice_id" value="<?=$invoice_id?>">
	              	<input type="hidden" name="invoice_number" value="<?=$invoice['invoice_number']?>">
	                <button type="submit" name="update_invoice_status" id="update_invoice"  class="btn btn-primary ">Update Invoice</button>
	              </div>
	            </div>
	              <!--/span-->
	            </div>
	            <!--/row-->
	          </form>            
          </div>
        	<?php }else{ 
        			$invoice = $con->getRows('invoice_status', array('where'=>'invoice_id="'.$invoice_id.'"', 'return_type'=>'single'));
        	?>
        		<div class="card-body p-4">
            <h4 class="fw-semibold mb-3">Invoice Status Update</h4>
            <p class="card-subtitle mb-4">Note that you can not change the status of the cancelled or paid invoice</p>
            <div class="table-responsive">
            <table class="table table-bordered" style="width:100%" width="100%">
              <tbody>
                <!-- start row -->
                <tr>
                  <td>Comment</td>
                  <td><?=$invoice['comment']?></td>
                </tr>
                <!-- end row -->

                <!-- start row -->
                <tr>
                  <td>Amount Paid</td>
                  <td>MK<?=number_format($invoice['paid_amount'],2,'.',',')?></td>
                </tr>
                <!-- end row -->
                
                <tr>
                  <td>Update By</td>
                  <td><?php
                  			$user =  $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$invoice['updated_by'].'"','return_type'=>'single'));
                  			echo ucwords($user['first_name'])." ".ucwords($user['last_name']);
                  			
                  		?></td>
                </tr>
                <!-- end row -->
                <tr>
                  <td>Date Updated</td>
                  <td><?=$con->shortDate($invoice['date_updated'])?></td>
                </tr>
                <!-- end row -->
                <tr>
                  <td>Attachment</td>
                  <td>
                  		<?php if(!empty($invoice['attachment'])) { ?>
                  		<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
		                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
		                      <a href="../../uploads/invoices/<?=$invoice['attachment']?>" target="_blank" class="btn btn-sm btn-secondary">
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