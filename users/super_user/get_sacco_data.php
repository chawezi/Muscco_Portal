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
<?php if($action == "get_sacco"){ ?>
<table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Sacco Name</th>
    <th>Sacco President</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Date</th>
    <th>Action</th>
  </thead>
  <tbody>
  	<?php
  		$saccos = $con->getRows('sacco', array('order_by'=>'sacco_name asc'));
  		if(!empty($saccos)){
  			$i=0;
  			foreach($saccos as $sacco){ 
  				$i++;
  	?>
  				<tr class="search-items">
			      <td>
			        <?=$i?>
			      </td>
			      <td>
			        <div class="d-flex align-items-center">
			          <div class="ms-3">
			            <div class="user-meta-info">
			              <h6 class="user-name mb-0" data-name=""><?=ucwords($sacco['sacco_name'])?></h6>
			              <span class="user-work fs-3" data-occupation=""><?=$sacco['location']?></span>
			            </div>
			          </div>
			        </div>
			      </td>
			      <td>
			        <span class="usr-email-addr"><?=ucwords($sacco['sacco_president'])?></span>
			      </td>
			      <td>
			        <span class="usr-email-addr"><?=$sacco['email_address']?></span>
			      </td>
			      <td>
			        <span class="usr-location"><?=$sacco['phone_number']?></span>
			      </td>
			      <td>
			        <span class="usr-ph-no" ><?=$con->shortDate($sacco['registered_date'])?></span>
			      </td>
			      <td>
			        <div class="action-btn">
			          <a href="dashboard.php?page=sacco_details&sacco_id=<?=$sacco['sacco_id']?>" class="btn btn-primary btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
			            <i class="ti ti-eye fs-5"></i>
			          </a>
			          <button class="btn btn-danger btn-sm delete_sacco ms-2" data-id3="<?=$sacco['sacco_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Sacco">
			            <i class="ti ti-trash fs-5"></i>
			          </button>
			        </div>
			      </td>
			    </tr>
  	<?php	}
  		}
  	?>
  </tbody>
</table>
<?php } else if($action == "get_sacco_members"){ ?>
<table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Sacco Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Action</th>
  </thead>
  <tbody>
  	<?php
  		$members = $con->getRows('sacco_members', array('where'=>'sacco_id="'.$_POST['id'].'"','order_by'=>'first_name asc'));
  		if(!empty($members)){
  			$i=0;
  			foreach($members as $member){ 
  				$i++;
  	?>
  				<tr class="search-items">
			      <td>
			        <?=$i?>
			      </td>
			      <td>
			        <div class="d-flex align-items-center">
			          <div class="ms-3">
			            <div class="user-meta-info">
			              <h6 class="user-name mb-0" data-name=""><?=ucwords($member['first_name'])." ".ucwords($member['last_name'])?></h6>
			            </div>
			          </div>
			        </div>
			      </td>
			      <td>
			        <span class="usr-email-addr"><?=$member['email_address']?></span>
			      </td>
			      <td>
			        <span class="usr-location"><?=$member['phone_number']?></span>
			      </td>
			      <td>
			        
			      </td>
			    </tr>
  	<?php	}
  		}
  	?>
  </tbody>
</table>
<?php } ?>