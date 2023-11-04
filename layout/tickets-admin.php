<ul class="list-group" style="height: calc(150vh - 400px)" data-simplebar>
        <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2 px-9 pt-4">Help Desk TICKETS</li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="dashboard.php?page=help_desk"><i class="ti ti-help-circle fs-5"></i>All Tickets(<?php $all = $con->getRows('tickets', array('return_type'=>'count')); echo $all!=0? $all:0; ?>)</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="dashboard.php?page=help_desk_open"><i class="ti ti-file-diff fs-5"></i>Open Tickets(<?php $all = $con->getRows('tickets', array('where'=>'ticket_status=0','return_type'=>'count')); echo $all!=0? $all:0; ?>)</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="dashboard.php?page=help_desk_closed"><i class="ti ti-checklist fs-5"></i>Closed Tickets(<?php $all = $con->getRows('tickets', array('where'=>'ticket_status=1','return_type'=>'count')); echo $all!=0? $all:0; ?>)</a>
        </li>
        <li class="border-bottom my-3"></li>
        <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">Settings</li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="dashboard.php?page=help_desk_products"><i class="ti ti-star fs-5"></i>Products</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="dashboard.php?page=help_desk_categories" class="d-block "><i class="ti ti-badge fs-5"></i>Categories</a>
        </li>
        
      </ul>