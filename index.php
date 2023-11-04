<?php
  session_start();
  /*if($_SESSION['USR_SESS'] == 'USER_LOCKED' || $_SESSION['USR_SESS'] == 'VAL'){
    header('Location: lock_account.php');
  }*/
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Jun 2023 10:03:25 GMT -->
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
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
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
            <div class="col-md-6 col-lg-4 col-xxl-3">
              <div class="card mb-0">
                <div class="card-body">
                  <a href="" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                    <img src="dist/images/logo.png" alt="">
                  </a>
                  <div class="position-relative text-center my-4">
                    <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">sign into your account</p>
                    <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                  </div>
                  <div id="error"></div>
                  <form id="signin-form" name="signin-form" method="post" action="">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Username</label>
                      <input type="text" class="form-control" name="username">
                    </div>
                    <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                      <div class="form-check">
                        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label text-dark" for="flexCheckChecked">
                          Remeber this Device
                        </label>
                      </div>
                      <a class="text-primary fw-medium" href="forgot-password.php">Forgot Password ?</a>
                    </div>
                    <button class="btn btn-primary w-100 py-8 mb-4 rounded-2" id="signin_btn" name="signin">Sign In</button>
                    <div class="d-flex align-items-center justify-content-center">
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

</html>