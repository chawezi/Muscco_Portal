<?php 
  session_start();
  include_once('../../settings/check-user.php');
  include_once('../../settings/master-class.php');
  $con = new MasterClass;

  $my_info = '';
  $position = '';

  //get current user url
  $url = $con->curPageURL();

  if(isset($_SESSION['USR_OF']) && $_SESSION['USR_OF'] == 0){
    $my_info = $con->getRows('muscco_members a, positions b', 
                  array('where'=>'a.muscco_member_id="'.$_SESSION['USR_ID'].'" and a.position_id=b.position_id', 'return_type'=>'single'));
    if(!empty($my_info)){
      $position = $my_info['position'];
    }
    //echo $position;
  }elseif(isset($_SESSION['USR_OF']) && $_SESSION['USR_OF'] == 999){
    $my_info = $con->getRows('des', 
                  array('where'=>'de_id="'.$_SESSION['USR_ID'].'"', 'return_type'=>'single'));
    $position = 'DES';
  }
  else{
    $my_info = $con->getRows('sacco_members', 
                  array('where'=>'sacco_member_id="'.$_SESSION['USR_ID'].'"', 'return_type'=>'single'));
  }

  //gets user permissions
  $user_access = $con->getRows('permissions_granted', array('where'=>'member_id="'.$_SESSION['USR_ID'].'"','order_by'=>'permission_id asc'));

  //checks the user session
  if($_SESSION['USR_SESS'] == 'USER_LOCKED'){
    header('Location: ../../lock_account.php?url='.$url);
  }else if($_SESSION['USR_SESS'] != 'VAL'){
    header('Location:../../sign-out.php');
  }

  //print_r("Hello there".$_SESSION['USR_OF']);
  
  
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <!--  Title -->
    <title>MUSCCO - Member Portal</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../dist/images/favicon.png" />
    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="../../dist/css/style.min.css" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../../dist/libs/owl.carousel/dist/assets/owl.carousel.min.css">

    <!-- --------------------------------------------------- -->
    <!-- Datatable -->
    <!-- --------------------------------------------------- -->
    <link rel="stylesheet" href="../../dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">

    <link  id="themeColors"  rel="stylesheet" href="../../dist/css/custom.css" />

    <script type="text/javascript">
      var t;

      window.onload = resetTimer;
      document.onmousemove = resetTimer;
      document.onkeypress = resetTimer;
      document.onscroll = resetTimer;
      window.onunload = resetTimer;
      window.onresize = resetTimer;

      function logout() {
          //alert('Your account has been locked due to inactivity');
          window.location.href = '../../lock_account.php?url=<?=$url?>';
      }

      function resetTimer() {
          clearTimeout(t);
          t = setTimeout(logout, 900000); // 300,000 milliseconds equals 5 minutes
      }

    </script>

</head>
  <body>
    <!-- Preloader -->
    <div class="preloader">
      <img src="../../dist/images/icon.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
      <img src="../../dist/images/icon.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">