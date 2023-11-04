<div class="px-9 pt-4 pb-3">
  <a href="dashboard.php?page=add_ticket" class="btn btn-primary fw-semibold py-8 w-100">New Ticket</a>
</div>
<ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=help_desk"><i class="ti ti-help-circle fs-5"></i>
      All Tickets(<?php $all = $con->getRows('tickets', array('where'=>'member_of="'.$_SESSION['USR_OF'].'"','return_type'=>'count')); echo $all!=0? $all:0; ?>)
    </a>
  </li>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=help_desk_open"><i class="ti ti-file-diff fs-5"></i>Open Tickets(<?php $all = $con->getRows('tickets', array('where'=>'member_of="'.$_SESSION['USR_OF'].'" and ticket_status=0','return_type'=>'count')); echo $all!=0? $all:0; ?>)</a>
  </li>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=help_desk_closed"><i class="ti ti-checklist fs-5"></i>Closed Tickets(<?php $all = $con->getRows('tickets', array('where'=>'member_of="'.$_SESSION['USR_OF'].'" and ticket_status=1','return_type'=>'count')); echo $all!=0? $all:0; ?>)</a>
  </li>
  
</ul>

