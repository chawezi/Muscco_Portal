<?php
if(!isset($_SESSION)){
  session_start();
}

include_once('../../settings/master-class.php');
$con =new MasterClass;
$action = '';
if(isset($_GET['action'])){
  $action = $_GET['action'];
}

if($action == 'get_my_topics'){
?>
<table id="zero_config" class="table search-table align-middle dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Topic</th>
    <th>Date Posted</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
      $topics = $con->getRows('discussions', array('where'=>'posted_by="'.$_SESSION['USR_ID'].'"','order_by'=>'date_posted desc'));
      if(!empty($topics)){
        $i=0;
        foreach($topics as $note){ 
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
                    <h6 class="user-name mb-0" data-name=""><?=$note['topic']?></h6>
                    <span><?=$note['description']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($note['date_posted'])?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                  <a href="dashboard.php?page=open_topic&topic_id=<?=$note['topic_id']?>" class="btn btn-primary btn-sm">
                    <i class="ti ti-message-chatbot fs-4"></i> 
                  </a>
                  <button  class="btn btn-danger btn-sm delete_topic" data-id3="<?=$note['topic_id']?>" >
                    <i class="ti ti-trash fs-4"></i> 
                  </button>
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
}elseif($action == 'get_comments'){  
  $id = $_GET['id'];
  $username ='';
  $comments = $con->getRows('discussion_replies', array('where'=>'topic_id="'.$id.'"', 'order_by'=>'date_replied desc'));
  if(!empty($comments)){
    foreach ($comments as $comment) {
      // check the user
      if($comment['member_of'] == 0){
        $user = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$comment['replied_by'].'"','return_type'=>'single'));
        $username = ucwords($user['first_name'])." ".ucwords($user['last_name']);
      }elseif($comment['member_of'] == 999){
        $user = $con->getRows('des', array('where'=>'de_id="'.$comment['replied_by'].'"','return_type'=>'single'));
        $username = ucwords($user['first_name'])." ".ucwords($user['last_name']);
      }
      else{
        $user = $con->getRows('sacco_members', array('where'=>'sacco_member_id="'.$comment['replied_by'].'"','return_type'=>'single'));
        $username = ucwords($user['first_name'])." ".ucwords($user['last_name']);
      } ?>
      <div class="p-4 rounded-2 bg-light mb-3">
        <div class="d-flex align-items-center gap-3">
          <i class="ti ti-user-circle fs-4"></i> 
          <h6 class="fw-semibold mb-0 fs-4"><?=$username;?></h6>
          <span class="fs-2"><span class="p-1 bg-muted rounded-circle d-inline-block"></span> <?=$con->DTT($comment['date_replied'])?></span>
        </div>
        <p class="my-3"><?=$comment['reply']?>
        </p>
      </div>
<?php    }
  }else{
    echo'<div class="alert alert-warning"> Currently, there are no comments, be the first one to comment.</div>';
  }
?>
<?php } ?>