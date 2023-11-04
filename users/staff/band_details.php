<?php
  $band_id = '';
  if(isset($_GET['band_id'])){
    $band_id = $_GET['band_id'];
  }
  $band = $con->getRows('band_rates', array('where'=>'band_id="'.$band_id.'"', 'return_type'=>'single'));
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Manage Employees</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Bands & Rates</li>
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
      <form class="position-relative w-100">
        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact">
        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
      </form>
    </div>
  <div class="d-flex w-100">
    <div class="left-part border-end w-20 flex-shrink-0 d-none d-lg-block">
      <?php include_once('../../layout/admin.php'); ?>      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Band & Rates Details</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card">
                    <div class="card-body p-4">
                      <h4 class="fw-semibold mb-3">Update  Band & Rates</h4>
                      <div id="error"></div>
                      <form id="add-ticket" method="post" action="" enctype="multipart/form-data">                            
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Band Title</label>
                              <input type="text" class="form-control" name="band_title" value="<?=$band['band_title']?>">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Lumpsum</label>
                              <input type="number" class="form-control" min="0" name="lumpsum" value="<?=$band['lumpsum']?>">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Without Meals & Accomodation</label>
                              <input type="number" class="form-control" min="0" name="without_meals_acc" value="<?=$band['withoutaccomodation_nomeals']?>">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Accomodation Ceiling</label>
                              <input type="number" class="form-control" min="0" name="acc_ceiling" value="<?=$band['accomodation_ceiling']?>">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Meals With Accomodation</label>
                              <input type="number" class="form-control" min="0" name="meals_acc" value="<?=$band['with_accomodation']?>"> 
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Meals Provided & No Accomodation</label>
                              <input type="number" class="form-control" min="0" name="withmeals_acc" value="<?=$band['withoutaccomodation_withmeals']?>">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-3">
                              <input type="hidden" name="band_id" value="<?=$band_id?>">
                              <button type="submit" name="update_band" id="update_band"  class="btn btn-primary ">Add Band</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Manage Employees</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/admin.php'); ?>
      
    </div>
  </div>
</div>