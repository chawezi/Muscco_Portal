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
            </ul>
            <div class="card-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                  <div class="row">
                    <div class="col-12">
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
              </div>
            </div>
          </div>
        
      </div>
      <div class="col-md-5">
      	<div class="card">
      		<?php if($invoice['invoice_status'] == '0'){ ?>
          
          <div class="card-body p-4">
	            <h4 class="fw-semibold mb-3">Invoice Status Update</h4>
	            <div class="table-responsive">  
	            <div class="alert alert-warning"> There is no invoice update!</div>  
	            </div>      
	          </div>
        	<?php }else{ 
        			$invoice = $con->getRows('invoice_status', array('where'=>'invoice_id="'.$invoice_id.'"', 'return_type'=>'single'));
        	?>
        		<div class="card-body p-4">
	            <h4 class="fw-semibold mb-3">Invoice Status Update</h4>
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
			                      <a href="download-file.php?dir=../../uploads/invoices/&file=<?=$invoice['attachment']?>" target="_blank" class="btn btn-sm btn-secondary">
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