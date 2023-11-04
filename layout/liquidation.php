
<ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>  
	<br><br>
	<li class="list-group-item border-0 p-0 mx-9">
	  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
	    href="dashboard.php?page=request_liquidation"><i class="ti ti-file-description fs-5"></i> Un-Liquidated</a>
	</li> 
	<li class="list-group-item border-0 p-0 mx-9">
	  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
	    href="dashboard.php?page=liquidated_requests"><i class="ti ti-file-check fs-5"></i> Liquidated</a>
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
						    href="dashboard.php?page=approve_travel_liquidation"><i class="ti ti-checks fs-5"></i>Approve Liquidations</a>
						</li>
						<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=all_liquidations"><i class="ti ti-list fs-5"></i>All Liquidations</a>
						</li> 
		 			';
      	}
      if(in_array(19, $permission) || in_array(17, $permission) || in_array(18, $permission)){
      	/*echo'
		 				<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=travel_advance_report"><i class="ti ti-report fs-5"></i>Reports</a>
						</li> 
		 			'; */
      }
    } ?>    




</ul>