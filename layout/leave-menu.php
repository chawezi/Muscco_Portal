<div class="px-9 pt-4 pb-3">
<a href="dashboard.php?page=apply_leave" class="btn btn-primary fw-semibold py-8 w-100">Apply Leave</a>
</div>
<ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>  
<li class="list-group-item border-0 p-0 mx-9">
  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
    href="dashboard.php?page=my_leave_applications"><i class="ti ti-clipboard-list fs-5"></i>My Applications</a>
</li>   
 <?php 
 	if(!empty($user_access)){
 			$permission = array();
      foreach ($user_access as $user_a) { 
      	$permission[] = $user_a['permission_id'];
      }
        if(in_array(6, $permission)){
        ?>
        <li class="list-group-item border-0 p-0 mx-9">
		  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
		    href="dashboard.php?page=check_leave"><i class="ti ti-check fs-5"></i>Check Leave</a>
		</li>
 <?php     
        }
        if(in_array(8, $permission)){
        	echo'   

				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=verify_leave"><i class="ti ti-checks fs-5"></i>Verify Leave</a>
				</li>	
        	';
        }
        if(in_array(7, $permission)){ ?>

						     		
				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=approve_leave"><i class="ti ti-checklist fs-5"></i>Approve Leave</a>
				</li>
        	
<?php        }
      

      if(in_array(8, $permission) || in_array(7, $permission) || in_array(6, $permission)){
      		echo'
		 				<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=leave_application"><i class="ti ti-list fs-5"></i>Leave Applications</a>
						</li> 
		 			';
      	}   	
    } ?>    




</ul>