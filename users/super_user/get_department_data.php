<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	include_once('../../settings/master-class.php');
	$con = new MasterClass;
	$action = '';
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}
?>

<?php if($action == "get_departments"){ ?>
	<table class="table border table-striped table-bordered display text-nowrap dataTable">
	  <thead class="header-item">
	    <th>
	      #
	    </th>
	    <th>Department</th>
	    <th>Action</th>
	  </thead>
	  <tbody>
	    <!-- start row -->
	    <?php
	    	$departments = $con->getRows('departments', array('where'=>'member_of="'.$_SESSION['USR_OF'].'"','order_by'=>'department'));
	    	if(!empty($departments)){
	    		$i=0;
	    		foreach ($departments as $dept) { 
	    			$i++;
	    	?>
	    			
	    			<tr>
				      <td>
				        <?=$i?>
				      </td>
				      <td>
				      	<?=$dept['department']?>
				      </td>
				      <td>
				        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
	                <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
	                  <a href="dashboard.php?page=departments&department_id=<?=$dept['department_id']?>" class="btn btn-primary btn-sm btn_ticket_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Udate Branch">
	                    <i class="ti ti-pencil fs-4"></i>
	                  </a>
	                  <button class="btn btn-sm btn-danger btn-sm delete_department" data-id3="<?=$dept['department_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Branch">
	                    <i class="ti ti-trash fs-4"></i>
	                  </button>
	                </div>
	              </div>
				      </td>
				    </tr>
	    <?php		}
	    	}
	    ?>
	    
	    <!-- end row -->
	  </tbody>
	</table>
<?php } else if($action == "add_department"){ ?>
	<h5>Departments</h5>
	<div id="error"></div>	
    <p class="card-subtitle mb-3">
      Add new department
    </p>
    <form class="" id="manage-departments" name="manage-departments" method="post" action="">
      <div class="mb-3">
      	<label>Department Name</label>
        <input type="text" class="form-control" placeholder="Enter Department Name" name="department">
      </div>

      <div class="d-md-flex align-items-center">
        
        <div class="mt-3 mt-md-0 ms-auto">
          <button type="submit" class="btn btn-primary font-medium px-4" name="add_department" id="manage_department">
            <div class="d-flex align-items-center">
              Submit
            </div>
          </button>
        </div>
      </div>
    </form>
<?php } else if($action == "edit_department"){ ?>
	<h5>Departments</h5>
    <p class="card-subtitle mb-3">
      Edit department
    </p>
    <form class="">
      <div class="form-control mb-3">
        <input type="text" class="form-control" placeholder="Username">
        <label><i class="ti ti-user me-2 fs-4"></i>Username</label>
      </div>

      <div class="d-md-flex align-items-center">
        
        <div class="mt-3 mt-md-0 ms-auto">
          <button type="submit" class="btn btn-primary font-medium rounded-pill px-4">
            <div class="d-flex align-items-center">
              <i class="ti ti-send me-2 fs-4"></i>
              Submit
            </div>
          </button>
        </div>
      </div>
    </form>
<?php } else if($action == "get_positions"){ ?>
	<table class="table border table-striped table-bordered display text-nowrap dataTable">
	  <thead class="header-item">
	    <th>
	      #
	    </th>
	    <th>Position</th>
	    <th>Action</th>
	  </thead>
	  <tbody>
	    <!-- start row -->
	    <?php
	    	$positions = $con->getRows('positions', array('where'=>'member_of="'.$_SESSION['USR_OF'].'"','order_by'=>'position'));
	    	if(!empty($positions)){
	    		$i=0;
	    		foreach ($positions as $post) { 
	    			$i++;
	    	?>
	    			
	    			<tr>
				      <td>
				        <?=$i?>
				      </td>
				      <td>
				      	<?=$post['position']?>
				      </td>
				      <td>
				        <div class="action-btn">
				          <button class="btn btn-danger btn-sm delete_position ms-2" data-id3="<?=$post['position_id']?>"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
				            <i class="ti ti-trash fs-5"></i> 
				          </button>
				        </div>
				      </td>
				    </tr>
	    <?php		}
	    	}
	    ?>
	    
	    <!-- end row -->
	  </tbody>
	</table>
<?php } else if($action == "get_db"){ ?>
	<table class="table border table-striped table-bordered display text-nowrap dataTable">
	  <thead class="header-item">
	    <th>
	      #
	    </th>
	    <th>Officer/Title</th>
	    <th>Date Taken</th>
	    <th>Action</th>
	  </thead>
	  <tbody>
	    <!-- start row -->
	    <?php
	    	$positions = $con->getRows('db_backups a, muscco_members b', array('where'=>'a.backedup_by=b.muscco_member_id','order_by'=>'a.date desc'));
	    	if(!empty($positions)){
	    		$i=0;
	    		foreach ($positions as $post) { 
	    			$i++;
	    	?>
	    			
	    			<tr>
				      <td>
				        <?=$i?>
				      </td>
				      <td>
				      	<div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0" data-name=""><?=$post['first_name']?></h6>
                    <span><?=$post['file_title']?></span>
                  </div>
                </div>
              </div>
				      	
				      </td>	
				      <td>
				      	<?=$con->DTT($post['date'])?>
				      </td>
				      <td>
				        <div class="action-btn">
				          <a href="download-file.php?dir=../../db/&file=<?=$post['file_name']?>" target="_blank"  class="btn btn-primary btn-sm ms-2" title="Download Backup">
				            <i class="ti ti-download fs-5"></i> 
				          </a>
				          <button class="btn btn-danger btn-sm delete_backups ms-2" data-id3="<?=$post['backup_id']?>" data-file="<?=$post['file_name']?>"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Backup">
				            <i class="ti ti-trash fs-5"></i> 
				          </button>
				        </div>
				      </td>
				    </tr>
	    <?php		}
	    	}
	    ?>
	    
	    <!-- end row -->
	  </tbody>
	</table>
<?php } else if($action == "get_branches"){ ?>
	<table class="table border table-striped table-bordered display text-nowrap dataTable">
	  <thead class="header-item">
	    <th>
	      #
	    </th>
	    <th>Department</th>
	    <th>Action</th>
	  </thead>
	  <tbody>
	    <!-- start row -->
	    <?php
	    	$branches = $con->getRows('branches', array('order_by'=>'branch_name'));
	    	if(!empty($branches)){
	    		$i=0;
	    		foreach ($branches as $branch) { 
	    			$i++;
	    	?>
	    			
	    			<tr>
				      <td>
				        <?=$i?>
				      </td>
				      <td>
				      	<?=$branch['branch_name']?>
				      </td>
				      <td>
				        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
	                <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
	                  <a href="dashboard.php?page=branches&branch_id=<?=$branch['branch_id']?>" class="btn btn-primary btn-sm btn_ticket_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Udate Branch">
	                    <i class="ti ti-pencil fs-4"></i>
	                  </a>
	                  <button class="btn btn-sm btn-danger btn-sm delete_branch" data-id3="<?=$branch['branch_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Branch">
	                    <i class="ti ti-trash fs-4"></i>
	                  </button>
	                </div>
	              </div>
				      </td>
				    </tr>
	    <?php		}
	    	}
	    ?>
	    
	    <!-- end row -->
	  </tbody>
	</table>
<?php } ?>


<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script src="../../dist/js/validation.min.js"></script>

