<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	include_once('../../settings/master-class.php');
	$con = new MasterClass;
	$action = '';
	if(isset($_POST['action'])){
		$action = $_POST['action'];
	}
?>
<?php if($action == "get_pending_invoices"){ ?>
<h4 class="fw-semibold mb-3">Pending Invoices</h4>
<p>To change the status of the invoice click on  invoice details.</p>
<table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Sacco Name</th>
    <th>Description</th>
    <th>Amount</th>
    <th>Amount Paid</th>
    <th>Date</th>
    <th>Action</th>
  </thead>
  <tbody>
  	<?php
  		$invoices = $con->getRows('invoices a, sacco b', array('where'=>'a.invoice_status=0 and a.sacco_id=b.sacco_id', 'order_by'=>'date_posted desc'));
  		if(!empty($invoices)){
  			$i=0;
  			foreach($invoices as $invoice){ 
  				$i++;
  	?>
  				<tr class="search-items">
			      <td>
			        <?=ucwords($invoice['invoice_number'])?>
			      </td>
			      <td>
			        <div class="d-flex align-items-center">
			          <div class="ms-3">
			            <div class="user-meta-info">
			              <h6 class="user-name mb-0" data-name=""><?=ucwords($invoice['sacco_name'])?></h6>
			            </div>
			          </div>
			        </div>
			      </td>
			      <td>
			        <span class="usr-email-addr"><?=$invoice['description']?></span>
			      </td>
			      <td>
			        <span class="usr-email-addr">K<?=number_format($invoice['amount'],2,'.',',')?></span>
			      </td>
			      <td>
			        <span class="usr-email-addr">K<?=number_format($invoice['amount_paid'],2,'.',',')?></span>
			      </td>
			      <td>
			        <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
			      </td>
			      <td>
			        <div class="action-btn">
			          <a href="dashboard.php?page=invoice_details&invoice_id=<?=$invoice['invoice_id']?>" class="btn btn-primary btn-sm  ms-2"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Invoice Details">
			            <i class="ti ti-eye fs-5"></i>
			          </a>
			          <a href="dashboard.php?page=invoice_details&invoice_id=<?=$invoice['invoice_id']?>" class="btn btn-danger btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancel Invoice">
			            <i class="ti ti-trash fs-5"></i>
			          </a>
			        </div>
			      </td>
			    </tr>
  	<?php	}
  		}
  	?>
  </tbody>
</table>
<?php } else if($action == "get_paid_invoices"){ ?>
<h4 class="fw-semibold mb-3">Paid Invoices</h4>
<p>To change the status of the invoice click on  invoice details.</p>
<table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Sacco Name</th>
    <th>Description</th>
    <th>Amount</th>
    <th>Amount Paid</th>
    <th>Date</th>
    <th>Action</th>
  </thead>
  <tbody>
  	<?php
  		$invoices = $con->getRows('invoices a, sacco b', array('where'=>'a.invoice_status=1 and a.sacco_id=b.sacco_id', 'order_by'=>'date_posted desc'));
  		if(!empty($invoices)){
  			$i=0;
  			foreach($invoices as $invoice){ 
  				$i++;
  	?>
  				<tr class="search-items">
			      <td>
			        <?=ucwords($invoice['invoice_number'])?>
			      </td>
			      <td>
			        <div class="d-flex align-items-center">
			          <div class="ms-3">
			            <div class="user-meta-info">
			              <h6 class="user-name mb-0" data-name=""><?=ucwords($invoice['sacco_name'])?></h6>
			            </div>
			          </div>
			        </div>
			      </td>
			      <td>
			        <span class="usr-email-addr"><?=$invoice['description']?></span>
			      </td>
			      <td>
			        <span class="usr-email-addr">K<?=number_format($invoice['amount'],2,'.',',')?></span>
			      </td>
			      <td>
			        <span class="usr-email-addr">K<?=number_format($invoice['amount_paid'],2,'.',',')?></span>
			      </td>
			      <td>
			        <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
			      </td>
			      <td>
			        <div class="action-btn">
			          <a href="dashboard.php?page=invoice_details&invoice_id=<?=$invoice['invoice_id']?>" class="btn btn-primary btn-sm  ms-2"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Invoice Details">
			            <i class="ti ti-eye fs-5"></i>
			          </a>
			        </div>
			      </td>
			    </tr>
  	<?php	}
  		}
  	?>
  </tbody>
</table>
<?php } ?>