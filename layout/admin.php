<ul class="list-group" style="height: calc(150vh - 400px)" data-simplebar>

  <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">System Settings</li>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=system_backup"><i class="ti ti-archive fs-5"></i>System Backup</a>
  </li>
   <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=bands_rates"><i class="ti ti-list fs-5"></i>Bands & Rates</a>
  </li>
  
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=branches"><i class="ti ti-table-filled fs-5"></i>Branches</a>
  </li>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=departments"><i class="ti ti-theater fs-5"></i>Departments</a>
  </li>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=positions"><i class="ti ti-list-details fs-5"></i>Positions</a>
  </li>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=leave_types"><i class="ti ti-calendar fs-5"></i>Leave Types</a>
  </li>
  <?php if($_SESSION['USR_TYP'] != 0){ ?>
  <li class="border-bottom my-3"></li>
  <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">Leave Settings</li>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=leave_types"><i class="ti ti-star fs-5"></i>Leave Types</a>
  </li>
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=leave_days" class="d-block "><i class="ti ti-badge fs-5"></i>Leave Entitlement</a>
  </li>        
  <li class="list-group-item border-0 p-0 mx-9">
    <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
      href="dashboard.php?page=current_fy" class="d-block "><i class="ti ti-calendar fs-5"></i>Current FY</a>
  </li>
  <?php } ?>
  
</ul>

