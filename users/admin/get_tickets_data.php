<?php
include_once('../../settings/master-class.php');
$con =new MasterClass;
$action = '';
if(isset($_GET['action'])){
  $action = $_GET['action'];
}
$user_name = '';

if($action == "show_responses"){
  $responses = $con->getRows('ticket_response', array('where'=>'ticket_id="'.$_GET['id'].'"', 'order_by'=>'date desc'));
  if(!empty($responses)){
    echo'<ul class="chat-users"  data-simplebar>';
    foreach ($responses as $response) { 
     $check_user = $con->getRows('system_users', array('where'=>'member_id="'.$response['member_id'].'"', 'return_type'=>'single'));
      if($check_user['user_role'] == 0){
        //gets the super/muscco admin detailes
        $user_name = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$response['member_id'].'"','return_type'=>'single'));
      }elseif($check_user['user_role'] == 1){
        //gets sacco admin
        $user_name = $con->getRows('sacco_members', array('where'=>'sacco_member_id="'.$response['member_id'].'"','return_type'=>'single'));
      }
  ?>
        <li>
          <a href="javascript:void(0)"
            class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user"
            id="chat_user_4" data-user-id="4">
            <div class="form-check mb-0">
              <span><i class="ti ti-user-circle fs-4 me-2 text-muted"></i></span>
            </div>
            <div class="position-relative w-100 ms-2">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <h6 class="mb-0"><?=ucwords($user_name['first_name'])." ".ucwords($user_name['last_name'])?></h6>
              </div>
              <h6 class="fw-semibold text-dark"><?=$response['response']?></h6>
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <span><i class="ti ti-dots fs-4 me-2 text-muted"></i></span>
                </div>
                <p class="mb-0 fs-2 text-muted"><p class="mb-0 fs-2 text-muted"><?=$response['date']?></p></p>
              </div>
            </div>
          </a>
        </li>
<?php    }
  }else{
    echo'<div class="alert alert-danger"> There are no messages under this ticket.</div>';
  }
?>
</ul>
<?php } ?>