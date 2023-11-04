<div class="px-9 pt-4 pb-3">
<a href="dashboard.php?page=request_vehicle" class="btn btn-primary fw-semibold py-8 w-100">Request Vehicle</a>
</div>
<ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>  
<li class="list-group-item border-0 p-0 mx-9">
  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
    href="dashboard.php?page=my_request_application"><i class="ti ti-clipboard-list fs-5"></i>My Requests</a>
</li> 
 <?php 
 	if(!empty($user_access)){
 			$permission = '';
      foreach ($user_access as $user_a) { 
      	$permission = $user_a['permission_id'];
        if($user_a['permission_id'] == 10){
        ?>
        <li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=assign_vehicle"><i class="ti ti-truck-delivery fs-5"></i>Assign Vehicle</a>
				</li>
				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=return_vehicle"><i class="ti ti-truck-return fs-5"></i>Return Vehicle</a>
				</li>
 <?php     
        }elseif($user_a['permission_id'] == 11){
        	echo'        		
				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=authorize_vehicle"><i class="ti ti-checks fs-5"></i>Authorize Request</a>
				</li>
        	';
        }
      }
      if($permission == 10 || $permission == 11){
      		echo'
		 				<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=vehicle_requests"><i class="ti ti-truck fs-5"></i>Vehicle Requests</a>
						</li> 
		 			';
      	}
    } ?>    




</ul>