<?php
include_once('../../settings/master-class.php');
$con =new MasterClass;
$action = '';
if(isset($_GET['action'])){
  $action = $_GET['action'];
}
$user_name = '';

if($action == "get_leave_types"){ ?>
  
      <table class="table border table-striped table-bordered display text-nowrap dataTable">
        <thead class="header-item">
          <th>
            #
          </th>
          <th>Leave Type</th>
          <th>Description</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php $types = $con->getRows('leave_types', array('order_by'=>'name'));
          if(!empty($types)){
            $i=0;
            foreach ($types as $type) { $i++; ?>
              <tr>
              <td>
                <?=$i?>
              </td>
              <td>
                <?=$type['name']?>
              </td>
              <td>
                <?=$type['description']?>
              </td>
              <td>
                <div class="action-btn">
                  <button class="btn btn-danger btn-sm delete_leave_type ms-2" data-id3="<?=$type['type_id']?>"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                    <i class="ti ti-trash fs-5"></i> 
                  </button>
                </div>
              </td>
            </tr>
              <?php    }
          }?>
          
          <!-- end row -->
        </tbody>
      </table>

<?php }elseif($action == "get_leave_days"){ ?>
  <table id="zero_config" class="table search-table align-middle dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Name</th>
    <th>Contacts</th>
    <th>Department</th>
    <th>Status</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
      $members = $con->getRows('muscco_members a, positions b, departments c, system_users d', 
               array('where'=>'a.position_id=b.position_id and a.department_id=c.department_id and a.muscco_member_id=d.member_id','order_by'=>'first_name asc'));
      if(!empty($members)){
        $i=0;
        foreach($members as $member){ 
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
                    <h6 class="user-name mb-0" data-name="Emma Adams"><?=ucwords($member['first_name'])." ".ucwords($member['last_name'])?></h6>
                    <span class="user-work fs-3" data-occupation="Web Developer"><?=$member['position']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0" data-name="Emma Adams"><?=$member['email_address']?></h6>
                    <span class="user-work fs-3" data-occupation="Web Developer"><?=$member['phone_number']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <span class="usr-ph-no" ><?=$member['department']?></span>
            </td>
            <td>
              <span class="usr-ph-no" >
                <?php 
                  switch ($member['account_status']) {
                    case 0:
                      echo'<span class="mb-1 badge rounded-pill bg-success">Active</span>';
                      break;
                    case 1:
                      echo'<span class="mb-1 badge rounded-pill bg-success">Active</span>';
                      break;
                    case 2:
                      echo'<span class="mb-1 badge rounded-pill bg-danger">Inactive</span>';
                      break;
                    
                    case 3:
                      echo'<span class="mb-1 badge rounded-pill bg-warming">Blocked</span>';
                      break;
                  }
                ?>
                  
                </span>
            </td>
            <td>
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                  
                  <a href="dashboard.php?page=member_leave_days&member_id=<?=$member['member_id']?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update Leave Days">
                    <i class="ti ti-pencil fs-4"></i>
                  </a>
                  <a href="dashboard.php?page=member_leave_history&member_id=<?=$member['member_id']?>" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Leave History">
                    <i class="ti ti-list fs-4"></i>
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
<?php }elseif($action == "get_days"){ ?>
  <table class="table border table-striped table-bordered display text-nowrap dataTable">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Leave Type</th>
      <th>Days Entitled</th>
    </thead>
    <tbody>
      <?php $types = $con->getRows('leave_types a, leave_entitlement b', array('where'=>'a.type_id=b.type_id and b.member_id="'.$_GET['id'].'"','order_by'=>'a.name'));
      if(!empty($types)){
        $i=0;
        foreach ($types as $type) { $i++; ?>
          <tr>
          <td>
            <?=$i?>
          </td>
          <td>
            <?=$type['name']?>
          </td>
          <td>
            <?=$type['entitlement']?>
          </td>
        </tr>
          <?php    }
      }else{
        echo'<tr><td colspan="3"><div class="alert alert-warning"> There are no records of this employee entitlement. </div></td></tr>';
      }
      ?>
      
      <!-- end row -->
    </tbody>
  </table>
<?php }elseif($action == "get_fy"){ ?>
  <table class="table border table-striped table-bordered display text-nowrap dataTable">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>FY Start</th>
      <th>FY End</th>
    </thead>
    <tbody>
      <?php 
        $fy = $con->getRows('leave_fy', array('where'=>'fy_status=0','order_by'=>'fy_id desc','return_type'=>'single'));
      if(!empty($fy)){?>
          <tr>
          <td>
            1
          </td>
          <td>
            <?=$con->shortDate($fy['fy_start'])?>
          </td>
          <td>
            <?=$con->shortDate($fy['fy_end'])?>
          </td>
        </tr>
          <?php    
      }else{
        echo'<tr><td colspan="3"><div class="alert alert-warning"> There are no records of this employee entitlement. </div></td></tr>';
      }
      ?>
      
      <!-- end row -->
    </tbody>
  </table>
<?php }elseif($action == "get_holidays"){ ?>
  <table class="table border table-striped table-bordered display text-nowrap dataTable">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Holiday</th>
      <th>Date</th>
      <th>Action</th>

    </thead>
    <tbody>
      <?php 
        $holidays = $con->getRows('public_holidays', array('where'=>'fy_id="'.$_GET['id'].'"','order_by'=>'holiday_id desc'));
      if(!empty($holidays)){
        $i = 0;
        foreach ($holidays as $fy) {
         $i++;
        ?>
          <tr>
          <td>
            <?=$i?>
          </td>
          <td>
            <?=$fy['holiday']?>
          </td>
          <td>
            <?=$con->shortDate($fy['date'])?>
          </td>
          <td>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
              <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                
                <button class="btn btn-sm btn-danger btn-sm btn_delete_holidy" data-id3="<?=$fy['holiday_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Holiday">
                  <i class="ti ti-trash fs-4"></i>
                </button>
              </div>
              
            </div>
          </td>
        </tr>
          <?php }   
      }else{
        echo'<tr><td colspan="4"><div class="alert alert-warning"> There are no records of this year\'s public holidays. </div></td></tr>';
      }
      ?>
      
      <!-- end row -->
    </tbody>
  </table>
<?php } ?>