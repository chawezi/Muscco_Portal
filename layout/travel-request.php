<div class="px-9 pt-4 pb-3">
<a href="dashboard.php?page=request_travel_advance" class="btn btn-primary fw-semibold py-8 w-100">Request Travel Advance</a>
</div>
<ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>  
	<li class="list-group-item border-0 p-0 mx-9">
	  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
	    href="dashboard.php?page=travel_advance_request"><i class="ti ti-clipboard-list fs-5"></i>My Requests</a>
	</li> 
 <?php 
 	if(!empty($user_access)){
 			$permission = array();
      foreach ($user_access as $user_a) { 
      	$permission[] = $user_a['permission_id'];
        
      }
      if(in_array(17, $permission) || in_array(18, $permission)){
      		echo'

						<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=approve_travel_advance"><i class="ti ti-checks fs-5"></i>Approve Request</a>
						</li>
		 				<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=all_travel_advance_requests"><i class="ti ti-list fs-5"></i>All Requests</a>
						</li> 
		 			';
      	}
      if(in_array(19, $permission) || in_array(17, $permission) || in_array(18, $permission)){
      	echo'
		 				<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=travel_advance_report"><i class="ti ti-report fs-5"></i>Reports</a>
						</li> 
		 			';
      }
    } ?>    




</ul>