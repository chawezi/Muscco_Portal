<div class="px-9 pt-4 pb-3">
<a href="dashboard.php?page=request_advance" class="btn btn-primary fw-semibold py-8 w-100">Request Advance</a>
</div>
<ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>  
<li class="list-group-item border-0 p-0 mx-9">
  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
    href="dashboard.php?page=my_advances"><i class="ti ti-clipboard-list fs-5"></i>My Advances</a>
</li> 
 <?php 
 	if(!empty($user_access)){
 			$permission = array();
      foreach ($user_access as $user_a) {
      	$permission[] = $user_a['permission_id'];
      }
      if(in_array(14, $permission)){
        	echo'
        		<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=check_advance"><i class="ti ti-check fs-5"></i>Supervisor Approval</a>
						</li>
        	';
        }
        if(in_array(13, $permission)){
       echo'
				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=verify_advance"><i class="ti ti-checks fs-5"></i>Finance Approval</a>
				 </li>

				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=outstanding_advance"><i class="ti ti-report-money fs-5"></i>Advance Payments</a>
				</li>
				 ';
	     
        }
        
        if(in_array(15, $permission)){
        	echo'
        		<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=approve_advance"><i class="ti ti-file-check fs-5"></i>Final Approval</a>
						</li>
        	';
        }
        
      }
      if(in_array(15, $permission)){
        	echo'
        		<li class="list-group-item border-0 p-0 mx-9">
						  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
						    href="dashboard.php?page=advance_reports"><i class="ti ti-report fs-5"></i> Advance Reports</a>
						</li>

        	';
        }
    ?>
</ul>