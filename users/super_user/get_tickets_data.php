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
<?php }elseif($action == 'show_ticket_details'){ 
  //print($_GET['id']);
  $user_name = '';
  $sacco_name = '';
  $ticket = $con->getRows('tickets a, products c, ticket_categories d',
                        array('where'=>'a.ticket_product=c.product_id and a.ticket_id="'.$_GET['id'].'" and a.ticket_category=d.ticket_category_id', 'return_type'=>'single')
                        );
  //print_r($ticket);
  if($ticket['member_of'] == 0){
    $user = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$ticket['posted_by'].'"','return_type'=>'single'));
    $user_name = ucwords($user['first_name'])." ".ucwords($user['last_name']);
    $sacco_name = "MUSCCO";
  }else{
    $user = $con->getRows('sacco_members a, sacco b', array('where'=>'a.sacco_member_id="'.$ticket['posted_by'].'" and a.sacco_id=b.sacco_id','return_type'=>'single'));
    $user_name = ucwords($user['first_name'])." ".ucwords($user['last_name']);
    $sacco_name = $user['sacco_name'];
  }
?>
  <table class="table mb-0">
    <tbody>
        <tr>
            <th scope="col" class="bg-primary text-white">Ticket Number</th>
            <th scope="col"><?=sprintf('%04d',$ticket['ticket_id'])?></th>
        </tr>       
        <tr>
            <th scope="col" class="bg-primary text-white">Ticket Progress</th>
            <td>
              <?php if($ticket['ticket_progress'] !=0){ ?>
              <div class="progress progress-bar bg-danger text-white" style="width: <?=$ticket['ticket_progress']?>%; height: 20%;" role="progressbar"><?=$ticket['ticket_progress']?>%</div>
              <?php }else{echo"0%";} ?>
            </td>
        </tr>        
        <tr>
            <th scope="col" class="bg-primary text-white">Sacco Name</th>
            <td><?=$sacco_name?></td>
        </tr> 
        <tr>
            <th scope="col" class="bg-primary text-white">Date Posted</th>
            <td><?=$ticket['date_opened']?></td>
        </tr>
        <tr>
            <th scope="col" class="bg-primary text-white">Ticket Title</th>
            <td><?=$ticket['ticket_title']?></td>
        </tr>
        <tr>
            <th scope="col" class="bg-primary text-white">Ticket Product</th>
            <td><?=$ticket['product']?></td>
        </tr>
        <tr>
            <th scope="col" class="bg-primary text-white">Ticket Category</th>
            <td><?=$ticket['ticket_category']?></td>
        </tr>
        <tr>
            <th scope="col" class="bg-primary text-white">Ticket Priority</th>
            <td>
              <?php 
                    switch ($ticket['ticket_priority']) {
                      case 1:
                        echo'<span class="mb-1 badge rounded-pill bg-danger">Critical</span>';
                        break;
                      case 2:
                        echo'<span class="mb-1 badge rounded-pill bg-warning">High</span>';
                        break;
                      case 3:
                        echo'<span class="mb-1 badge rounded-pill bg-primary">Intermedian</span>';
                        break;
                      
                      case 4:
                        echo'<span class="mb-1 badge rounded-pill bg-info">Blocked</span>';
                        break;

                      case 4:
                        echo'<span class="mb-1 badge rounded-pill bg-info">Blocked</span>';
                        break;
                    }
                  ?>
            </td>
        </tr>
        <tr>
            <th scope="col" class="bg-primary text-white">Ticket Status</th>
            <td>
              <?php 
                    switch ($ticket['ticket_status']) {
                      case 0:
                        echo'<span class="mb-1 badge rounded-pill bg-primary">Open</span>';
                        break;
                      case 1:
                        echo'<span class="mb-1 badge rounded-pill bg-success">Closed</span>';
                        break;
                    }
                  ?>
            </td>
        </tr>
        <tr>
            <th scope="col" class="bg-primary text-white">Posted By</th>
            <td><?=$user_name?></td>
        </tr>
        <tr>
            <th scope="col" class="bg-primary text-white">Description</th>
            <td><?=$ticket['ticket_description']?></td>
        </tr>
        <?php if($ticket['ticket_status'] == 1){ ?>
        <tr>
            <th scope="col" class="bg-primary text-white">Closing Remarks</th>
            <td><?=$ticket['closing_remarks']?></td>
        </tr>
        <tr>
            <th scope="col" class="bg-primary text-white">Date Closed</th>
            <td><?=$ticket['date_closed']?></td>
        </tr> 
        <?php } ?>
        <tr>
          <td colspan="2">
            <?php if(!empty($ticket['ticket_attachment'])){?>
            <div class="card hover-img overflow-hidden rounded-2">
              <div class="card-body p-0">
                <a href="../../uploads/tickets/<?=$ticket['ticket_attachment']?>" target="_blank">
                  <img src="../../uploads/tickets/<?=$ticket['ticket_attachment']?>" alt="" class="img-fluid w-100 object-fit-cover" style="height: 360px;">
                </a>
                <div class="p-4 d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="fw-semibold mb-0 fs-4">ScreenShot/Attachment</h6>
                  </div>
                </div>
              </div>
            </div>
            <?php }else{
              echo "No ScreenShot /Attachment";
            } ?>
          </td>
        </tr>                      

    </tbody>
  </table>
<?php }if($action == 'get_products'){ ?>
  <table class="table mb-0">
    <tr>
      <th>#</th>
      <th>Product</th>
      <th>Action</th>
    </tr>
    <?php 
      $products = $con->getRows('products', array('order_by'=>'product'));
      if(!empty($products)){
        $i ='';
        foreach ($products as $product) { $i++; ?>
          <tr>
            <td><?=$i?></td>
            <td><?=$product['product']?></td>
            <td>
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                  <button  class="btn btn-primary btn-sm delete_product" data-id3="<?=$product['product_id']?>" >
                    <i class="ti ti-trash fs-4"></i> 
                  </button>
                </div>
                
              </div>
            </td>
          </tr>
    <?php  }
      }
      ?>

    
  </table>
<?php }if($action == 'get_categories'){ ?>
  <table class="table mb-0">
    <tr>
      <th>#</th>
      <th>Product</th>
      <th>Action</th>
    </tr>
    <?php 
      $categories = $con->getRows('ticket_categories', array('order_by'=>'ticket_category'));
      if(!empty($categories)){
        $i ='';
        foreach ($categories as $cat) { $i++; ?>
          <tr>
            <td><?=$i?></td>
            <td><?=$cat['ticket_category']?></td>
            <td>
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                  <button  class="btn btn-primary btn-sm delete_ticket_category" data-id3="<?=$cat['ticket_category_id']?>" >
                    <i class="ti ti-trash fs-4"></i> 
                  </button>
                </div>
                
              </div>
            </td>
          </tr>
    <?php  }
      }
      ?>

    
  </table>
<?php } ?>