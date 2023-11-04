<div class="px-9 pt-4 pb-3">
<a href="dashboard.php?page=request_petty_cash" class="btn btn-primary fw-semibold py-8 w-100">Petty Cash Requisition</a>
</div>
<ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>  
<li class="list-group-item border-0 p-0 mx-9">
  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
    href="dashboard.php?page=my_petty_cash"><i class="ti ti-clipboard-list fs-5"></i>My Requisitions</a>
</li> 
 <?php 
 	if(!empty($user_access)){
 			$permission = array();
      foreach ($user_access as $user_a) { 
      	$permission[] = $user_a['permission_id'];
        if($user_a['permission_id'] == 12){
        ?>
				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=approve_requisitions"><i class="ti ti-check fs-5"></i>Approve Requisitions</a>
				</li>
				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=approved_requisitions"><i class="ti ti-checks fs-5"></i>Approved Requisitions</a>
				</li>
				<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=declined_requisitions"><i class="ti ti-checks fs-5"></i>Declined Requisitions</a>
				</li>
 <?php     
        }

      }
      if(in_array(19, $permission)){
      	echo'<li class="list-group-item border-0 p-0 mx-9">
				  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
				    href="dashboard.php?page=petty_cash_reports"><i class="ti ti-report fs-5"></i>Petty Cash Reports</a>
				</li>';
      }
    } ?>    




</ul>