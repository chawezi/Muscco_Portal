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
        <span class="d-none d-md-block font-weight-medium">All Approved Advance Requests</span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advance_request_all" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
      </a>
    </li>
  </ul>
</div>
<table class="table border table-striped table-bordered">
  <tr>
    <?php
      $amounts = 0;
      $balances = 0;
      $paid = 0;
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4'));
      if(!empty($all)){        
        foreach($all as $count){
          $amounts +=$count['amount'];
          $balances +=$count['balance'];
          $paid +=$count['total_paid'];
        }
      }
    ?>
    <th>Advance Amount<br> MK<?=number_format($amounts,2,'.',',')?></th>
    <th>Advance Paid<br> MK<?=number_format($paid,2,'.',',')?></th>
    <th>Balance<br> MK<?=number_format($balances,2,'.',',')?></th></th>
  </tr>  
</table>  
<table id="scroll_hor" class="table border table-striped table-bordered display nowrap dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer & Department</th>
    <th>Advance Amount</th>
    <th>Advance Paid</th>
    <th>Balance</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4','order_by'=>'date_posted desc'));
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
                    <h6 class="user-name mb-0" data-name=""><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                    <span><?=$row['department']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              MK<?=number_format($row['total_paid'],2,'.',',')?>        
            </td>
            <td>
              MK<?=number_format($row['balance'],2,'.',',')?>        
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
        <span class="d-none d-md-block font-weight-medium"> Approved Advance Requests Today <?=date("d M, Y");?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advance_request_today" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
        $amounts = 0;
        $balances = 0;
        $paid = 0;
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved="'.$date.'"'));
      if(!empty($all)){
        foreach($all as $count){
          $amounts +=$count['amount'];
          $balances +=$count['balance'];
          $paid +=$count['total_paid'];
        }
      }
    ?>
    <th>Advance Amount<br> MK<?=number_format($amounts,2,'.',',')?></th>
    <th>Advance Paid<br> MK<?=number_format($paid,2,'.',',')?></th>
    <th>Balance<br> MK<?=number_format($balances,2,'.',',')?></th></th>
    
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display nowrap dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer & Department</th>
    <th>Advance Amount</th>
    <th>Advance Paid</th>
    <th>Balance</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved="'.$date.'"','order_by'=>'date_posted desc'));
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
                    <h6 class="user-name mb-0" data-name=""><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                    <span><?=$row['department']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              MK<?=number_format($row['total_paid'],2,'.',',')?>        
            </td>
            <td>
              MK<?=number_format($row['balance'],2,'.',',')?>        
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
        <span class="d-none d-md-block font-weight-medium"> Approved Advance Request This Week (<?=$this_week_start;?> to <?=$this_week_end;?>)</span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advance_request_week" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
        $amounts = 0;
        $balances = 0;
        $paid = 0;
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$monday.'" and date_approved <= "'.$saturday.'"'));
      if(!empty($all)){
        foreach($all as $count){
          $amounts +=$count['amount'];
          $balances +=$count['balance'];
          $paid +=$count['total_paid'];
        }
      }
    ?>
    <th>Advance Amount<br> MK<?=number_format($amounts,2,'.',',')?></th>
    <th>Advance Paid<br> MK<?=number_format($paid,2,'.',',')?></th>
    <th>Balance<br> MK<?=number_format($balances,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display nowrap dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer & Department</th>
    <th>Advance Amount</th>
    <th>Advance Paid</th>
    <th>Balance</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and date_approved >="'.$monday.'" and date_approved <= "'.$saturday.'"','order_by'=>'date_posted desc'));
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
                    <h6 class="user-name mb-0" data-name=""><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                    <span><?=$row['department']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              MK<?=number_format($row['total_paid'],2,'.',',')?>        
            </td>
            <td>
              MK<?=number_format($row['balance'],2,'.',',')?>        
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
        <span class="d-none d-md-block font-weight-medium"> Approved Advance Requests This Month Of <?=$newDate;?>, <?=date('Y')?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advance_request_month" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
        $amounts = 0;
        $balances = 0;
        $paid = 0;
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      if(!empty($all)){
        foreach($all as $count){
          $amounts +=$count['amount'];
          $balances +=$count['balance'];
          $paid +=$count['total_paid'];
        }
      }
    ?>
    <th>Advance Amount<br> MK<?=number_format($amounts,2,'.',',')?></th>
    <th>Advance Paid<br> MK<?=number_format($paid,2,'.',',')?></th>
    <th>Balance<br> MK<?=number_format($balances,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display nowrap dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer & Department</th>
    <th>Advance Amount</th>
    <th>Advance Paid</th>
    <th>Balance</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"','order_by'=>'date_posted desc'));
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
                    <h6 class="user-name mb-0" data-name=""><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                    <span><?=$row['department']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              MK<?=number_format($row['total_paid'],2,'.',',')?>        
            </td>
            <td>
              MK<?=number_format($row['balance'],2,'.',',')?>        
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
        <span class="d-none d-md-block font-weight-medium"> Approved Advance Requests This Year Of <?=date('Y')?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advance_request_year" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
        $amounts = 0;
        $balances = 0;
        $paid = 0;
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      if(!empty($all)){
        foreach($all as $count){
          $amounts +=$count['amount'];
          $balances +=$count['balance'];
          $paid +=$count['total_paid'];
        }
      }
    ?>
    <th>Advance Amount<br> MK<?=number_format($amounts,2,'.',',')?></th>
    <th>Advance Paid<br> MK<?=number_format($paid,2,'.',',')?></th>
    <th>Balance<br> MK<?=number_format($balances,2,'.',',')?></th></th>
  </tr>  
</table> 
<table id="scroll_hor" class="table border table-striped table-bordered display nowrap dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer & Department</th>
    <th>Advance Amount</th>
    <th>Advance Paid</th>
    <th>Balance</th>
    <th>Date</th>
  </thead>
  <tbody>
    <?php
      $requisitions = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"','order_by'=>'date_posted desc'));
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
                    <h6 class="user-name mb-0" data-name=""><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                    <span><?=$row['department']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              MK<?=number_format($row['total_paid'],2,'.',',')?>        
            </td>
            <td>
              MK<?=number_format($row['balance'],2,'.',',')?>        
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
  }else if($action == "advance_custom"){ 
    
    $selection = '';
    $first_date = $_GET['date_from'];
    $last_date  = $_GET['date_to'];
    $section = $_GET['officer'];
    if($section == 'All'){
      $selection = "All Officers";
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$first_date.'" 
              and date_approved <= "'.$last_date.'"'));
      $requisitions = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'date_posted desc'));
    }else{
      $off = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$section.'"', 'return_type'=>'single'));
      $selection = ucwords($off['first_name'])." ".ucwords($off['last_name']);
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$first_date.'" 
              and date_approved <= "'.$last_date.'" and requested_by="'.$section.'"'));
      $requisitions = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'" and a.requested_by="'.$section.'"','order_by'=>'date_posted desc'));
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
        <span class="d-none d-md-block font-weight-medium"> Approved Advance Requests for <?=$selection?> From <?=$con->shortDate($first_date)?> To <?=$con->shortDate($last_date)?></span>
      </button>
    </li>
    <li class="nav-item ms-auto">
      <a href="../../generate-lpdf.php?type=advance_request_custom&date_from=<?=$first_date?>&date_to=<?=$last_date?>&officer=<?=$section?>" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
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
       $amounts = 0;
        $balances = 0;
        $paid = 0;
      if(!empty($all)){
        foreach($all as $count){
          $amounts +=$count['amount'];
          $balances +=$count['balance'];
          $paid +=$count['total_paid'];
        }
      }
    ?>
    <th>Advance Amount<br> MK<?=number_format($amounts,2,'.',',')?></th>
    <th>Advance Paid<br> MK<?=number_format($paid,2,'.',',')?></th>
    <th>Balance<br> MK<?=number_format($balances,2,'.',',')?></th></th>
  </tr>  
</table> 


<table id="scroll_hor" class="table border table-striped table-bordered display nowrap dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Officer & Department</th>
    <th>Advance Amount</th>
    <th>Advance Paid</th>
    <th>Balance</th>
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
                    <h6 class="user-name mb-0" data-name=""><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
                    <span><?=$row['department']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              MK<?=number_format($row['total_paid'],2,'.',',')?>        
            </td>
            <td>
              MK<?=number_format($row['balance'],2,'.',',')?>        
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