<?php
session_start();
include_once('../../settings/master-class.php');
$con =new MasterClass;
$action = '';
if(isset($_GET['action'])){
  $action = $_GET['action'];
}

if($action == 'all'){
?>
<div class="container-fluid note-has-grid" style="width:100%; padding:2px;">
  <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
    <li class="nav-item">
      <button class="
              nav-link
            
              note-link
              d-flex
              align-items-center
              justify-content-center
              
              px-3 px-md-3
              me-0 me-md-2 text-body-color
            " id="all-category">
        <i class="ti ti-report fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium">All Approved Travel Advance Requests</span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advanced_all" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <?php
      $all = $con->getRows('travel_advance_request', array('where'=>'request_status >=2 and request_status <=5'));
      if(!empty($all)){
        $allowances = 0;
        $fuels = 0;
        $total = 0;
        $tollgate = 0;
        foreach($all as $count){
          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
          $fuels +=$count['total_fuel'];
          $total +=$count['total_budget'];
          $tollgate +=$count['tollgate_fees'];
        }
      }
    ?>
    <th>Total Allowances<br> MK<?=number_format($allowances,2,'.',',')?></th>
    <th>Total Tollgate Fees<br> MK<?=number_format($tollgate,2,'.',',')?></th>
    <th>Total Fuel<br> MK<?=number_format($fuels,2,'.',',')?></th>
    <th>Total<br> MK<?=number_format($total,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Officer / Department</th>
      <th>Pillar / Logistics </th>                        
      <th>Fuel / Mileage</th>
      <th>Allowances / Total Budget</th>
      <th>Date Approved</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
        $leave = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5)', 'order_by'=>'a.date_posted desc'));
        if(!empty($leave)){
          $i=0;
          foreach($leave as $day){ 
            $i++;
            $allowances = ($day['rate']*$day['nights']) + $day['day_meal'] + ($day['own_days']*$day['own_rate']);
      ?>
            <tr class="search-items">
              <td>
                <?=$i?>
              </td>
              
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">
                        <?=ucwords($day['first_name'])." ".ucwords($day['last_name'])?>
                      </h6>
                      <span><?=$day['department']?></span>
                    </div>
                  </div>
                </div>
              </td> 
              <td>
                
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$day['pillar']?></h6>
                      <span>
                        <?php
                          if($day['logistics'] == 1){
                            echo "Accomodated";
                          }else if($day['logistics'] == 2){
                            echo "Look for own Accomodation";
                          }else if($day['logistics'] == 3){
                            echo "One Day Return";
                          }else if($day['logistics'] == 4){
                            echo "Accomodation / Own Accomodation";
                          }
                        ?>                                          
                      </span>
                    </div>
                  </div>
                </div>
              </td>                              
              
               <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($day['total_fuel'], 2, '.',',')?></h6>
                      <span><?=$day['mileage']?> KM(s)</span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=$allowances?></h6>
                      <span>MK<?=number_format($day['total_budget'], 2, '.',',')?></span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_approved'])?></h6>
                    </div>
                  </div>
                </div>
              </td>
              
              <td>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                    <a href="dashboard.php?page=travel_advance_details&request_id=<?=$day['travel_advance_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                      <i class="ti ti-pencil fs-4"></i>
                    </a>
                  </div>
                  
                </div>
              </td>
            </tr>
      <?php }
        }
      ?>
    </tbody>
</table>
<?php }else if($action == "advanced_today"){ ?>
<div class="container-fluid note-has-grid" style="width:100%; padding:2px;">
  <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
    <li class="nav-item">
      <button class="
              nav-link
            
              note-link
              d-flex
              align-items-center
              justify-content-center
              
              px-3 px-md-3
              me-0 me-md-2 text-body-color
            " id="all-category">
        <i class="ti ti-report fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium"> Approved Travel Advance Requests Today <?=date("d M, Y");?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advanced_today" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <?php
      $date = date("Y-m-d");
      $allowances = 0;
      $fuels = 0;
      $total = 0;
      $tollgate = 0;
      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved="'.$date.'"'));
      if(!empty($all)){
        
        foreach($all as $count){
          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
          $fuels +=$count['total_fuel'];
          $total +=$count['total_budget'];
          $tollgate += $count['tollgate_fees'];
        }
      }
    ?>
    <th>Total Allowances<br> MK<?=number_format($allowances,2,'.',',')?></th>
    <th>Total Tollgate Fees<br> MK<?=number_format($tollgate,2,'.',',')?></th>
    <th>Total Fuel<br> MK<?=number_format($fuels,2,'.',',')?></th>
    <th>Total<br> MK<?=number_format($total,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Officer / Department</th>
      <th>Pillar / Logistics </th>                        
      <th>Fuel / Mileage</th>
      <th>Allowances / Total Budget</th>
      <th>Date Approved</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
        
        $leave = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5) and a.date_approved="'.$date.'"', 'order_by'=>'a.date_posted desc'));
        if(!empty($leave)){
          $i=0;
          foreach($leave as $day){ 
            $i++;
            $allowances = ($day['rate']*$day['nights']) + $day['day_meal'] + ($day['own_days']*$day['own_rate']);

      ?>
            <tr class="search-items">
              <td>
                <?=$i?>
              </td>
              
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">
                        <?=ucwords($day['first_name'])." ".ucwords($day['last_name'])?>
                      </h6>
                      <span><?=$day['department']?></span>
                    </div>
                  </div>
                </div>
              </td> 
              <td>
                
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$day['pillar']?></h6>
                      <span>
                        <?php
                          if($day['logistics'] == 1){
                            echo "Accomodated";
                          }else if($day['logistics'] == 2){
                            echo "Look for own Accomodation";
                          }else if($day['logistics'] == 3){
                            echo "One Day Return";
                          }else if($day['logistics'] == 4){
                            echo "Accomodated / Own Accomodation";
                          }
                        ?>                                          
                      </span>
                    </div>
                  </div>
                </div>
              </td>                              
              
               <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($day['total_fuel'], 2, '.',',')?></h6>
                      <span><?=$day['mileage']?> KM(s)</span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($allowances)?></h6>
                      <span>MK<?=number_format($day['total_budget'], 2, '.',',')?></span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_approved'])?></h6>
                    </div>
                  </div>
                </div>
              </td>
              
              <td>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                    <a href="dashboard.php?page=travel_advance_details&request_id=<?=$day['travel_advance_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                      <i class="ti ti-pencil fs-4"></i>
                    </a>
                  </div>
                  
                </div>
              </td>
            </tr>
      <?php }
        }
      ?>
    </tbody>
</table>
<?php 
  }else if($action == "advanced_week"){ 
    $monday = date('Y-m-d', strtotime('monday this week'));
    $saturday = date('Y-m-d', strtotime('sunday this week'));
    $mondays = strtotime("last monday");
    $mondays = date('w', $mondays)==date('w') ? $mondays+7*86400 : $mondays;

    $sunday = strtotime(date("Y-m-d",$mondays)." +6 days");

    $this_week_start = date("d M, Y",$mondays);
    $this_week_end = date("d M, Y",$sunday);

  ?>
<div class="container-fluid note-has-grid" style="width:100%; padding:2px;">
  <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
    <li class="nav-item">
      <button class="
              nav-link
            
              note-link
              d-flex
              align-items-center
              justify-content-center
              
              px-3 px-md-3
              me-0 me-md-2 text-body-color
            " id="all-category">
        <i class="ti ti-report fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium"> Approved Travel Advance Requests This Week (<?=$this_week_start;?> to <?=$this_week_end;?>)</span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advanced_week" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <?php
      $allowances = 0;
      $fuels = 0;
      $total = 0;
      $tollgate = 0;
      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$monday.'" and date_approved <= "'.$saturday.'"'));
      if(!empty($all)){
        
        foreach($all as $count){
          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
          $fuels +=$count['total_fuel'];
          $total +=$count['total_budget'];
          $tollgate +=$count['tollgate_fees'];
        }
      }
    ?>
    <th>Total Allowances<br> MK<?=number_format($allowances,2,'.',',')?></th>
    <th>Total Tollgate Fees<br> MK<?=number_format($tollgate,2,'.',',')?></th>
    <th>Total Fuel<br> MK<?=number_format($fuels,2,'.',',')?></th>
    <th>Total<br> MK<?=number_format($total,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Officer / Department</th>
      <th>Pillar / Logistics </th>                        
      <th>Fuel / Mileage</th>
      <th>Allowances / Total Budget</th>
      <th>Date Approved</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
        $date = date("Y-m-d");
        $leave = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5) and a.date_approved >="'.$monday.'" and a.date_approved <= "'.$saturday.'"', 'order_by'=>'a.date_posted desc'));
        if(!empty($leave)){
          $i=0;
          foreach($leave as $day){ 
            $i++;
            $allowances = ($day['rate']*$day['nights']) + $day['day_meal'] + ($day['own_days']*$day['own_rate']);

      ?>
            <tr class="search-items">
              <td>
                <?=$i?>
              </td>
              
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">
                        <?=ucwords($day['first_name'])." ".ucwords($day['last_name'])?>
                      </h6>
                      <span><?=$day['department']?></span>
                    </div>
                  </div>
                </div>
              </td> 
              <td>
                
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$day['pillar']?></h6>
                      <span>
                        <?php
                          if($day['logistics'] == 1){
                            echo "Accomodated";
                          }else if($day['logistics'] == 2){
                            echo "Look for own Accomodation";
                          }else if($day['logistics'] == 3){
                            echo "One Day Return";
                          }else if($day['logistics'] == 4){
                            echo "Accomodated / Own Accomodation";
                          }
                        ?>                                          
                      </span>
                    </div>
                  </div>
                </div>
              </td>                              
              
               <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($day['total_fuel'], 2, '.',',')?></h6>
                      <span><?=$day['mileage']?> KM(s)</span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($allowances)?></h6>
                      <span>MK<?=number_format($day['total_budget'], 2, '.',',')?></span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_approved'])?></h6>
                    </div>
                  </div>
                </div>
              </td>
              
              <td>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                    <a href="dashboard.php?page=travel_advance_details&request_id=<?=$day['travel_advance_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                      <i class="ti ti-pencil fs-4"></i>
                    </a>
                  </div>
                  
                </div>
              </td>
            </tr>
      <?php }
        }
      ?>
    </tbody>
</table>

<?php 
  }else if($action == "advanced_month"){ 
    $newDate = date('F');
        $first_date = date('Y-m-d',strtotime('first day of this month'));
        $last_date = date('Y-m-d',strtotime('last day of this month'));

  ?>
<div class="container-fluid note-has-grid" style="width:100%; padding:2px;">
  <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
    <li class="nav-item">
      <button class="
              nav-link
            
              note-link
              d-flex
              align-items-center
              justify-content-center
              
              px-3 px-md-3
              me-0 me-md-2 text-body-color
            " id="all-category">
        <i class="ti ti-report fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium"> Approved Travel Advance Requests This Month Of <?=$newDate;?>, <?=date('Y')?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advanced_month" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <?php
      $allowances = 0;
      $fuels = 0;
      $total = 0;
      $tollgate = 0;
      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      if(!empty($all)){
        
        foreach($all as $count){
          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
          $fuels +=$count['total_fuel'];
          $total +=$count['total_budget'];
          $tollgate +=$count['tollgate_fees'];
        }
      }
    ?>
    <th>Total Allowances<br> MK<?=number_format($allowances,2,'.',',')?></th>
    <th>Total Tollgate Fees<br> MK<?=number_format($tollgate,2,'.',',')?></th>
    <th>Total Fuel<br> MK<?=number_format($fuels,2,'.',',')?></th>
    <th>Total<br> MK<?=number_format($total,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Officer / Department</th>
      <th>Pillar / Logistics </th>                        
      <th>Fuel / Mileage</th>
      <th>Allowances / Total Budget</th>
      <th>Date Approved</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
        $date = date("Y-m-d");
        $leave = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5) and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"', 'order_by'=>'a.date_posted desc'));
        if(!empty($leave)){
          $i=0;
          foreach($leave as $day){ 
            $i++;
            $allowances = ($day['rate']*$day['nights']) + $day['day_meal'] + ($day['own_days']*$day['own_rate']);

      ?>
            <tr class="search-items">
              <td>
                <?=$i?>
              </td>
              
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">
                        <?=ucwords($day['first_name'])." ".ucwords($day['last_name'])?>
                      </h6>
                      <span><?=$day['department']?></span>
                    </div>
                  </div>
                </div>
              </td> 
              <td>
                
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$day['pillar']?></h6>
                      <span>
                        <?php
                          if($day['logistics'] == 1){
                            echo "Accomodated";
                          }else if($day['logistics'] == 2){
                            echo "Look for own Accomodation";
                          }else if($day['logistics'] == 3){
                            echo "One Day Return";
                          }else if($day['logistics'] == 4){
                            echo "Accomodated / Own Accomodation";
                          }
                        ?>                                          
                      </span>
                    </div>
                  </div>
                </div>
              </td>                              
              
               <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($day['total_fuel'], 2, '.',',')?></h6>
                      <span><?=$day['mileage']?> KM(s)</span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($allowances, 2, '.',',')?></h6>
                      <span>MK<?=number_format($day['total_budget'], 2, '.',',')?></span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_approved'])?></h6>
                    </div>
                  </div>
                </div>
              </td>
              
              <td>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                    <a href="dashboard.php?page=travel_advance_details&request_id=<?=$day['travel_advance_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                      <i class="ti ti-pencil fs-4"></i>
                    </a>
                  </div>
                  
                </div>
              </td>
            </tr>
      <?php }
        }
      ?>
    </tbody>
</table>

<?php 
  }else if($action == "advanced_year"){ 
    $newDate = date('Y');
        $first_date =  date('Y-m-d', strtotime('first day of january this year'));
        $last_date =  date('Y-m-d', strtotime('last day of december this year'));

  ?>
<div class="container-fluid note-has-grid" style="width:100%; padding:2px;">
  <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
    <li class="nav-item">
      <button class="
              nav-link
            
              note-link
              d-flex
              align-items-center
              justify-content-center
              
              px-3 px-md-3
              me-0 me-md-2 text-body-color
            " id="all-category">
        <i class="ti ti-report fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium"> Approved Travel Advance Requests This Year Of <?=date('Y')?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advanced_year" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <?php
      $allowances = 0;
      $fuels = 0;
      $total = 0;
      $tollgate = 0;
      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      if(!empty($all)){
        
        foreach($all as $count){
          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
          $fuels +=$count['total_fuel'];
          $total +=$count['total_budget'];
          $tollgate +=$count['tollgate_fees'];
        }
      }
    ?>
    <th>Total Allowances<br> MK<?=number_format($allowances,2,'.',',')?></th>
    <th>Total Tollgate Fees<br> MK<?=number_format($tollgate,2,'.',',')?></th>
    <th>Total Fuel<br> MK<?=number_format($fuels,2,'.',',')?></th>
    <th>Total<br> MK<?=number_format($total,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Officer / Department</th>
      <th>Pillar / Logistics </th>                        
      <th>Fuel / Mileage</th>
      <th>Allowances / Total Budget</th>
      <th>Date Approved</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
        $date = date("Y-m-d");
        $leave = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5) and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"', 'order_by'=>'a.date_posted desc'));
        if(!empty($leave)){
          $i=0;
          foreach($leave as $day){ 
            $i++;
            $allowances = ($day['rate']*$day['nights']) + $day['day_meal'] + ($day['own_days']*$day['own_rate']);

      ?>
            <tr class="search-items">
              <td>
                <?=$i?>
              </td>
              
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">
                        <?=ucwords($day['first_name'])." ".ucwords($day['last_name'])?>
                      </h6>
                      <span><?=$day['department']?></span>
                    </div>
                  </div>
                </div>
              </td> 
              <td>
                
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$day['pillar']?></h6>
                      <span>
                        <?php
                          if($day['logistics'] == 1){
                            echo "Accomodated";
                          }else if($day['logistics'] == 2){
                            echo "Look for own Accomodation";
                          }else if($day['logistics'] == 3){
                            echo "One Day Return";
                          }else if($day['logistics'] == 4){
                            echo "Accomodated / Own Accomodation";
                          }
                        ?>                                          
                      </span>
                    </div>
                  </div>
                </div>
              </td>                              
              
               <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($day['total_fuel'], 2, '.',',')?></h6>
                      <span><?=$day['mileage']?> KM(s)</span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($allowances, 2, '.',',')?></h6>
                      <span>MK<?=number_format($day['total_budget'], 2, '.',',')?></span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_approved'])?></h6>
                    </div>
                  </div>
                </div>
              </td>
              
              <td>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                    <a href="dashboard.php?page=travel_advance_details&request_id=<?=$day['travel_advance_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                      <i class="ti ti-pencil fs-4"></i>
                    </a>
                  </div>
                  
                </div>
              </td>
            </tr>
      <?php }
        }
      ?>
    </tbody>
</table>

<?php 
  }else if($action == "issued_custom"){ 
    $selection = '';
    $first_date = $_GET['date_from'];
    $last_date  = $_GET['date_to'];
    $officer = $_GET['officer'];
    if($officer == 'All'){
      $selection = "All Officers";
      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      $leave = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5) and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"', 'order_by'=>'a.date_posted desc'));
    }else{
      $off = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$officer.'"', 'return_type'=>'single'));
      $selection = ucwords($off['first_name'])." ".ucwords($off['last_name']);
      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'" and employee_id="'.$officer.'"'));
      $leave = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5) and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"  and a.employee_id="'.$officer.'"', 'order_by'=>'a.date_approved desc'));
    }    
  ?>
<div class="container-fluid note-has-grid" style="width:100%; padding:2px;">
  <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
    <li class="nav-item">
      <button class="
              nav-link
            
              note-link
              d-flex
              align-items-center
              justify-content-center
              
              px-3 px-md-3
              me-0 me-md-2 text-body-color
            " id="all-category">
        <i class="ti ti-report fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium"> Approved Travel Advance Requests for <?=$selection?> From <?=$con->shortDate($first_date)?> To <?=$con->shortDate($last_date)?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advanced_custom&date_from=<?=$first_date?>&date_to=<?=$last_date?>&officer=<?=$officer?>" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <?php
      $allowances = 0;
      $fuels = 0;
      $total = 0;
      $tollgate = 0;
      if(!empty($all)){
        
        foreach($all as $count){
          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
          $fuels +=$count['total_fuel'];
          $total +=$count['total_budget'];
          $tollgate += $count['tollgate_fees']; 
        }
      }
    ?>
    <th>Total Allowances<br> MK<?=number_format($allowances,2,'.',',')?></th>
    <th>Total Tollgate Fees<br> MK<?=number_format($tollgate,2,'.',',')?></th>
    <th>Total Fuel<br> MK<?=number_format($fuels,2,'.',',')?></th>
    <th>Total<br> MK<?=number_format($total,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Officer / Department</th>
      <th>Pillar / Logistics </th>                        
      <th>Fuel / Mileage</th>
      <th>Allowances / Total Budget</th>
      <th>Date Approved</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
        $date = date("Y-m-d");
        
        if(!empty($leave)){
          $i=0;
          foreach($leave as $day){ 
            $i++;
            $allowances = ($day['rate']*$day['nights']) + $day['day_meal'] + ($day['own_days']*$day['own_rate']);

      ?>
            <tr class="search-items">
              <td>
                <?=$i?>
              </td>
              
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">
                        <?=ucwords($day['first_name'])." ".ucwords($day['last_name'])?>
                      </h6>
                      <span><?=$day['department']?></span>
                    </div>
                  </div>
                </div>
              </td> 
              <td>
                
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$day['pillar']?></h6>
                      <span>
                        <?php
                          if($day['logistics'] == 1){
                            echo "Accomodated";
                          }else if($day['logistics'] == 2){
                            echo "Look for own Accomodation";
                          }else if($day['logistics'] == 3){
                            echo "One Day Return";
                          }else if($day['logistics'] == 4){
                            echo "Accomodated / Own Accomodation";
                          }
                        ?>                                          
                      </span>
                    </div>
                  </div>
                </div>
              </td>                              
              
               <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($day['total_fuel'], 2, '.',',')?></h6>
                      <span><?=$day['mileage']?> KM(s)</span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name="">MK<?=number_format($allowances, 2, '.',',')?></h6>
                      <span>MK<?=number_format($day['total_budget'], 2, '.',',')?></span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                    <div class="user-meta-info">
                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_approved'])?></h6>
                    </div>
                  </div>
                </div>
              </td>
              
              <td>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                    <a href="dashboard.php?page=travel_advance_details&request_id=<?=$day['travel_advance_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                      <i class="ti ti-pencil fs-4"></i>
                    </a>
                  </div>
                  
                </div>
              </td>
            </tr>
      <?php }
        }
      ?>
    </tbody>
</table>
<?php } ?>
<script src="../../dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../dist/js/datatable/datatable-basic.init.js"></script> 