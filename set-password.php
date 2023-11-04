<?php 
  session_start(); 
  if(!isset($_SESSION['USR_SESS']) && !isset($_SESSION['USR_ID']) && $_SESSION['USR_SESS'] != "SET_PASS"){
    header('Location: index.php');
  } 
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
    <link rel="shortcut icon" type="image/png" href="dist/images/favicon.png" />
    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="dist/css/style.min.css" />
    <link  id="themeColors"  rel="stylesheet" href="dist/css/custom.css" />
  </head>
  <body style="background-color: #fddfbb;">
    <!-- Preloader -->
    <div class="preloader">
      <img src="dist/images/icon.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
      <img src="dist/images/icon.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
          <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
              <div class="card mb-0">
                <div class="card-body pt-5">
                  <a href="index.html" class="text-nowrap logo-img text-center d-block mb-4">
                    <img src="dist/images/logo.png" width="180" alt="">
                  </a>
                  <div class="mb-5 text-center">
                    <p class="mb-0 ">   
                      Hello <b><?=$_SESSION['USR_NME']?></b>, please set a memorable password for your account, make sure that your password is a combination of letters, characters and numbers.                
                    </p>
                  </div>
                  <div id="error"></div>
                  <form id="set-password" name="set-password" method="post">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">New Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                      <input type="password" class="form-control" name="re_password">
                    </div>                    
                    <button class="btn btn-primary w-100 py-8 mb-3" name="set_password" id="signin_btn">Set Password</button>
                    <div class="d-flex align-items-center justify-content-center mt-1">
                      <small class="copyright" style="text-align:center;">© 2023 Copyright <strong><span>MUSCCO</span></strong> <br> For inquiries contact info@muscco.org</small>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!--  Import Js Files -->
    <script src="dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--  core files -->
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/app.init.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    
    <script src="dist/js/custom.js"></script>
    <script src="dist/js/validation.min.js"></script>
    <script src="dist/js/custom-scripts.js"></script>
  </body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-forgot-password2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Jun 2023 10:03:25 GMT -->
</html>