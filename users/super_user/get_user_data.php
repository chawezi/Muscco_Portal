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
<table id="zero_config" class="table search-table align-middle dataTable">
  <thead class="header-item">
    <th></th>
    <th>Name</th>
    <th>Email/Phone</th>
    <th>Office/Department</th>
    <th>Status</th>
    <th>Action</th>
  </thead>
  <tbody>
  	<?php
  		
  		$members = $con->getRows('muscco_members a, positions b, departments c, system_users d, branches e', 
  						 array('where'=>'a.position_id=b.position_id and a.department_id=c.department_id and a.muscco_member_id=d.member_id and a.branch=e.branch_id','order_by'=>'first_name asc'));
  		if(!empty($members)){
  			$i=0;
  			foreach($members as $member){ 
  				$thumb = $member['thumb'];
  				if(empty($thumb)){
  					$thumb = 'default.jpg';
  				}
  	?>
  				<tr class="search-items">
			      <td>
			        <div class="d-flex align-items-center">
                  <div class="me-2 pe-1">
                    <img src="../../uploads/profiles/<?=$thumb?>" class="rounded-circle" width="40" height="40" alt="">
                  </div>
                </div>
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
			        <div class="d-flex align-items-center">
			          <div class="ms-3">
			            <div class="user-meta-info">
			              <h6 class="user-name mb-0" data-name="Emma Adams"><?=$member['email_address']?></h6>
			              <span class="user-work fs-3" data-occupation="Web Developer"><?=$member['phone_number']?></span>
			            </div>
			          </div>
			        </div>
			      </td>
			      <td>
			        <div class="d-flex align-items-center">
			          <div class="ms-3">
			            <div class="user-meta-info">
			              <h6 class="user-name mb-0" data-name="Emma Adams"><?=ucwords($member['branch_name'])?></h6>
			              <span class="user-work fs-3" data-occupation="Web Developer"><?=$member['department']?></span>
			            </div>
			          </div>
			        </div>
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
			        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                  <a href="dashboard.php?page=staff_details&staff_id=<?=$member['member_id']?>" class="btn btn-primary btn-sm btn_ticket_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Udate Details">
                    <i class="ti ti-pencil fs-4"></i>
                  </a>
                  <button class="btn btn-sm btn-danger btn-sm delete_staff" data-id3="<?=$member['member_id']?>" data-file="<?=$member['thumb']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete User">
                    <i class="ti ti-trash fs-4"></i>
                  </button>
                </div>
              </div>
			      </td>
			    </tr>
  	<?php	}
  		}
  	?>
  </tbody>
</table>
<?php 
	} else if(isset($_GET['action']) && $_GET['action']=='get_profile'){ 
		$thumb = "default.jpg";
    $get_thumb = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$_SESSION['USR_ID'].'"', 'return_type'=>'single'));
    if(!empty($get_thumb)){
      $thumb = $get_thumb['thumb'];
    }

	?>
	<?=$thumb?>
	
<?php } ?>