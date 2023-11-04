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
        <span class="d-none d-md-block font-weight-medium">All Approved Petty Cash Requests</span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=pettycash_all" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <?php

      $all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1'));
      if(!empty($all)){
        $total = 0;
        foreach($all as $count){
          $total +=$count['amount'];
        }
      }
    ?>
    <th>Total Petty Cash</th><th> MK<?=number_format($total,2,'.',',')?></th>
  </tr>  
</table> 
<table id="zero_config" class="table border table-striped table-bordered display dataTable no-footer">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer</th>
    <th>Department</th>
    <th>Subject</th>
    <th>Amount(MK)</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions =$con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1','order_by'=>'a.date_posted desc'));
      if(!empty($requisitions)){
        $i=0;
        foreach($requisitions as $row){ 
          $i++;
    ?>
          <tr class="search-items">
            <td>
              <?=$i?>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['department']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['subject']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <?=number_format($row['amount'],2,'.',',')?>        
            </td>
            <td>
              <?=$con->shortDate($row['date_approved'])?>
            </td>
          </tr>
    <?php }
      }
    ?>
  </tbody>
</table>    
<?php }else if($action == "pettycash_today"){ ?>
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
        <span class="d-none d-md-block font-weight-medium"> Approved Petty Cash Requests Today <?=date("d M, Y");?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=pettycash_today" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
      $total = 0;
      $all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved="'.$date.'"'));
      if(!empty($all)){
        foreach($all as $count){
          $total +=$count['amount'];
        }
      }
    ?>
    <th>Total Petty Cash</th><th> MK<?=number_format($total,2,'.',',')?></th>
    
  </tr>  
</table> 
<table id="zero_config" class="table border table-striped table-bordered display dataTable no-footer">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer</th>
    <th>Department</th>
    <th>Subject</th>
    <th>Amount(MK)</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions =$con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved="'.$date.'"','order_by'=>'a.date_posted desc'));
      if(!empty($requisitions)){
        $i=0;
        foreach($requisitions as $row){ 
          $i++;
    ?>
          <tr class="search-items">
            <td>
              <?=$i?>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['department']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['subject']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <?=number_format($row['amount'],2,'.',',')?>        
            </td>
            <td>
              <?=$con->shortDate($row['date_approved'])?>
            </td>
          </tr>
    <?php }
      }
    ?>
  </tbody>
</table>
<?php 
  }else if($action == "pettycash_week"){ 
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
        <span class="d-none d-md-block font-weight-medium"> Approved Petty Cash Requests This Week (<?=$this_week_start;?> to <?=$this_week_end;?>)</span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=pettycash_week" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
      $total = 0;
      $all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved >="'.$monday.'" and date_approved <= "'.$saturday.'"'));
      if(!empty($all)){
        foreach($all as $count){
          $total +=$count['amount'];
        }
      }
    ?>
    <th>Total Petty Cash</th><th> MK<?=number_format($total,2,'.',',')?></th>
  </tr>  
</table> 
<table id="zero_config" class="table border table-striped table-bordered display dataTable no-footer">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer</th>
    <th>Department</th>
    <th>Subject</th>
    <th>Amount(MK)</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions =$con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$monday.'" and a.date_approved <= "'.$saturday.'"','order_by'=>'a.date_posted desc'));
      if(!empty($requisitions)){
        $i=0;
        foreach($requisitions as $row){ 
          $i++;
    ?>
          <tr class="search-items">
            <td>
              <?=$i?>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['department']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['subject']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <?=number_format($row['amount'],2,'.',',')?>        
            </td>
            <td>
              <?=$con->shortDate($row['date_approved'])?>
            </td>
          </tr>
    <?php }
      }
    ?>
  </tbody>
</table>


<?php 
  }else if($action == "pettycash_month"){ 
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
        <span class="d-none d-md-block font-weight-medium"> Approved Petty Cash Requests This Month Of <?=$newDate;?>, <?=date('Y')?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=pettycash_month" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <tr>
    <?php
      $date = date("Y-m-d");
      $total = 0;
      $all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      if(!empty($all)){
        foreach($all as $count){
          $total +=$count['amount'];
        }
      }
    ?>
    <th>Total Petty Cash</th><th> MK<?=number_format($total,2,'.',',')?></th>
  </tr>  
</table> 
<table id="zero_config" class="table border table-striped table-bordered display dataTable no-footer">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer</th>
    <th>Department</th>
    <th>Subject</th>
    <th>Amount(MK)</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions =$con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'a.date_posted desc'));
      if(!empty($requisitions)){
        $i=0;
        foreach($requisitions as $row){ 
          $i++;
    ?>
          <tr class="search-items">
            <td>
              <?=$i?>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['department']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['subject']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <?=number_format($row['amount'],2,'.',',')?>        
            </td>
            <td>
              <?=$con->shortDate($row['date_approved'])?>
            </td>
          </tr>
    <?php }
      }
    ?>
  </tbody>
</table>

<?php 
  }else if($action == "pettycash_year"){ 
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
        <span class="d-none d-md-block font-weight-medium"> Approved Petty Cash Requests This Year Of <?=date('Y')?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=pettycash_year" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
      $total = 0;
      $all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      if(!empty($all)){
        foreach($all as $count){
          $total +=$count['amount'];
        }
      }
    ?>
    <th>Total Petty Cash</th><th> MK<?=number_format($total,2,'.',',')?></th>
  </tr>  
</table> 
<table id="zero_config" class="table border table-striped table-bordered display dataTable no-footer">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer</th>
    <th>Department</th>
    <th>Subject</th>
    <th>Amount(MK)</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions =$con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'a.date_posted desc'));
      if(!empty($requisitions)){
        $i=0;
        foreach($requisitions as $row){ 
          $i++;
    ?>
          <tr class="search-items">
            <td>
              <?=$i?>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['department']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['subject']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <?=number_format($row['amount'],2,'.',',')?>        
            </td>
            <td>
              <?=$con->shortDate($row['date_approved'])?>
            </td>
          </tr>
    <?php }
      }
    ?>
  </tbody>
</table>


<?php 
  }else if($action == "pettycash_custom"){ 
    /*
      Gear up with our durable industrial garmets. Let us make personalized industrial garmets tailored for your project or business, email us on mbangwefactory@gmail.com 
    */ 
    $selection = '';
    $first_date = $_GET['date_from'];
    $last_date  = $_GET['date_to'];
    $section = $_GET['section'];
    if($section == 'All'){
      $selection = "All Departments";
      $all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      $requisitions = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'a.date_posted desc'));
    }else{
      $off = $con->getRows('departments', array('where'=>'department_id="'.$section.'"', 'return_type'=>'single'));
      $selection = $off['department'];
      $all = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c', 
                          array('where'=>'a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'" and a.requested_by=b.muscco_member_id and b.department_id=c.department_id and c.department_id="'.$section.'"'));
      $requisitions = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'" and c.department_id="'.$section.'"','order_by'=>'a.date_posted desc'));
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
        <span class="d-none d-md-block font-weight-medium"> Approved Petty Casy Requests for <?=$selection?> From <?=$con->shortDate($first_date)?> To <?=$con->shortDate($last_date)?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=pettycash_custom&date_from=<?=$first_date?>&date_to=<?=$last_date?>&section=<?=$section?>" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
      $total = 0;
      if(!empty($all)){
        foreach($all as $count){
          $total +=$count['amount'];
        }
      }
    ?>
    <th>Total Petty Cash</th><th> MK<?=number_format($total,2,'.',',')?></th>
  </tr>  
</table> 


<table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer</th>
    <th>Department</th>
    <th>Subject</th>
    <th>Amount(MK)</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      if(!empty($requisitions)){
        $i=0;
        foreach($requisitions as $row){ 
          $i++;
    ?>
          <tr class="search-items">
            <td>
              <?=$i?>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['department']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['subject']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <?=number_format($row['amount'],2,'.',',')?>        
            </td>
            <td>
              <?=$con->shortDate($row['date_approved'])?>
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