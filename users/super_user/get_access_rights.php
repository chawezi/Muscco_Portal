<?php 
include_once('../../settings/master-class.php');
$con = new MasterClass;
$access_rights = $con->getRows('permissions a, permissions_granted b', array('where'=>'a.permission_id=b.permission_id and b.member_id="'.$_POST['id'].'"'));
if(!empty($access_rights)){ 
  foreach ($access_rights as $right) {
    ?>
  <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div> 
        <h5 class="fs-4 fw-semibold mb-0"><?=$right['permission']?></h5>
        <p class="mb-0"><?=$right['date_assigned']?></p>
      </div>
    </div>
    <button class="btn btn-danger fs-6 d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle revoke_permision" data-id3="<?=$right['granted_id']?>" data-id4="<?=$right['permission_id']?>" data-member="<?=$right['member_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Revoke Permission">
      <i class="ti ti-playstation-x"></i>
    </button>
  </div>
<?php 
  }
}else{
  echo'<div class="alert alert-danger"> The current member does not have any special permissions.</div>';
}
?>