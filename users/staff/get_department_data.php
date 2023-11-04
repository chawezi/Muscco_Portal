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
	<table class="table border table-striped table-bordered table-sm">
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
				        <div class="action-btn">
				          <button class="btn btn-danger btn-sm delete_department ms-2" data-id3="<?=$dept['department_id']?>"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
	<table class="table table-striped table-bordered display table-sm" style="padding: 0px;">
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
<?php } ?>


<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script src="../../dist/js/validation.min.js"></script>

