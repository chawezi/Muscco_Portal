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
<?php if($action == "get_staff"){ ?>
<table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Department</th>
    <th>Status</th>
    <th>Action</th>
  </thead>
  <tbody>
  	<?php
  		$members = $con->getRows('sacco_members a, positions b, departments c, system_users d', 
  						 array('where'=>'a.position_id=b.position_id and a.department_id=c.department_id and a.sacco_member_id=d.member_id and a.sacco_member_id != "'.$_SESSION['USR_OF'].'" and a.sacco_id = "'.$_SESSION['USR_OF'].'"','order_by'=>'first_name asc'));
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
			              <h6 class="user-name mb-0" data-name="Emma Adams"><?=ucwords($member['first_name'])." ".ucwords($member['last_name'])?></h6>
			              <span class="user-work fs-3" data-occupation="Web Developer"><?=$member['position']?></span>
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
			        <span class="usr-ph-no" ><?=$member['department']?></span>
			      </td>
			      <td>
			        <span class="usr-ph-no" >
			        	<?php 
			        		switch ($member['account_status']) {
			        			case 0:
			        				echo'<span class="mb-1 badge rounded-pill bg-primary">Active</span>';
			        				break;
			        			case 1:
			        				echo'<span class="mb-1 badge rounded-pill bg-success">Active</span>';
			        				break;
			        			case 2:
			        				echo'<span class="mb-1 badge rounded-pill bg-danger">Inactive</span>';
			        				break;
			        			
			        			case 3:
			        				echo'<span class="mb-1 badge rounded-pill bg-warming">Blocked</span>';
			        				break;
			        		}
			        	?>
			        		
			        	</span>
			      </td>
			      <td>
			        <div class="action-btn">
			          <a href="dashboard.php?page=staff_details&staff_id=<?=$member['member_id']?>" class="btn btn-primary btn-sm  ms-2" title="View">
			            <i class="ti ti-eye fs-5"></i>
			          </a>
			          <button class="btn btn-danger btn-sm delete_staff ms-2" data-id3="<?=$member['member_id']?>" title="Delete">
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
<?php } else if(isset($_GET['action']) && $_GET['action']=='get_profile'){ 
		$thumb = "default.jpg";
    $get_thumb = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$_SESSION['USR_ID'].'"', 'return_type'=>'single'));
    if(!empty($get_thumb)){
      $thumb = $get_thumb['thumb'];
    }

	?>
	<?=$thumb?>
	
<?php } ?>