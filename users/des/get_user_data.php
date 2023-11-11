<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	include_once('../../settings/master-class.php');
	$con = new MasterClass;
	$action = '';
	if(isset($_POST['action'])){
		$action = $_POST['action'];
	}
?>

<?php if(isset($_GET['action']) && $_GET['action']=='get_profile'){ 
		$thumb = "default.jpg";
    $get_thumb = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$_SESSION['USR_ID'].'"', 'return_type'=>'single'));
    if(!empty($get_thumb)){
      $thumb = $get_thumb['thumb'];
    }

	?>
	<?=$thumb?>
	
<?php } ?>