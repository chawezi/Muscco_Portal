<?php
  $fuel = '';
  if(isset($_GET['fuel_id'])){
    $fuel = $_GET['fuel_id'];
  }
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Admin Settings</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Fuel Types</li>
          </ol>
        </nav>
      </div>
      <div class="col-3">
        <div class="text-center mb-n5">  
            <img src="../../dist/images/breadcrumb/emailSv.png" alt="" class="img-fluid mb-n4">
          </div>
      </div>
    </div>
  </div>
</div>
<div class="card chat-application">
  <div class="d-flex align-items-center justify-content-between gap-3 m-3 d-lg-none">
      <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
        <i class="ti ti-menu-2 fs-5"></i>
      </button>
    </div>
  <div class="d-flex w-100">
    <div class="left-part border-end w-20 flex-shrink-0 d-none d-lg-block">
      <?php include_once('../../layout/admin.php') ?>
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Fuel Types</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card-body p-4">
                      <div id="error"></div>
                      <?php if($fuel == ''){ ?> 
                      <form class="" id="manage-departments" name="manage-departments" method="post" action="">
                        <div class="row">
                            <div class="col-lg-4">
                              <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Enter Fuel Name" name="fuel">
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="mb-3">
                                <input type="number" class="form-control" placeholder="Enter current Fuel Price" name="fuel_price">
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="d-md-flex align-items-center">
                                
                                <div class="mt-3 mt-md-0 ms-auto">
                                  <button type="submit" class="btn btn-primary font-medium px-4" name="add_fuel" id="manage_department">
                                    <div class="d-flex align-items-center">
                                      Save Fuel
                                    </div>
                                  </button>
                                </div>
                              </div>
                            </div>
                        </div>
                      </form>
                      <?php } else{ 
                          $get_fuel = $con->getRows('fuel_prices', array('where'=>'fuel_id="'.$fuel.'"', 'return_type'=>'single'));
                        ?>
                      <form class="" id="manage-departments" name="manage-departments" method="post" action="">
                        <div class="row">
                            <div class="col-lg-4">
                              <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Enter Fuel Name" name="fuel" value="<?=$get_fuel['fuel']?>">
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="mb-3">
                                <input type="number" class="form-control" placeholder="Enter current Fuel Price" name="fuel_price" value="<?=$get_fuel['current_price']?>">
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="d-md-flex align-items-center">
                                
                                <div class="mt-3 mt-md-0 ms-auto">
                                  <input type="hidden" name="id" value="<?=$fuel?>">
                                  <button type="submit" class="btn btn-primary font-medium px-4" name="update_fuel" id="update_department">
                                    <div class="d-flex align-items-center">
                                      Update Fuel
                                    </div>
                                  </button>
                                  <a href="dashboard.php?page=fuel" class="btn btn-primary font-medium px-4" >
                                    <div class="d-flex align-items-center">
                                      Add 
                                    </div>
                                  </a>
                                </div>
                              </div>
                            </div>
                        </div>
                      </form>
                      <?php } ?>
                      <div id="fuel_response"></div>
                      <div id="show_fuels"></div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Admin Settings </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/admin.php'); ?>
      
    </div>
  </div>
</div>

<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
