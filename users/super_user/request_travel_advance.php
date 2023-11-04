<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Travel Advance Request</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Request Travel Advance</li>
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
      <?php include_once('../../layout/travel-request.php'); ?>      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Request Travel Advance</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card">
                    <div class="card-body p-4">
                      <div id="error"></div>

                      <form id="daily-itinery" action="" method="post">
                        <div class="row">
                          <b>Daily Itinerary</b>
                          <div id="itinerary_response"></div>
                          <div class="col-lg-3">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Date</label>
                            <input type="date" class="form-control" name="date" id="date" required>  
                          </div>
                          <div class="col-lg-3">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">From</label>
                            <input type="text" class="form-control" name="from" id="from" required>  
                          </div>
                          <div class="col-lg-3">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">To</label>
                            <input type="text" class="form-control" name="to" id="to" required>  
                          </div>
                          <div class="col-lg-3">
                            <label for="exampleInputPassword1" class="form-label fw-semibold"></label>
                            <button type="submit" name="add_itinery" id="add_btn"  class="btn btn-primary mt-4">Add</button>
                          </div>
                          <div class="col-lg-12">
                            <hr>
                            
                          </div>
                        </div>
                      </form>
                      <div id="daily_itinery"></div>
                      <br>
                      <form id="vehicle-request" method="post" action="" enctype="multipart/form-data">                            
                        <div class="row">

                          
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Prog/Pillar/Activity</label>
                              <select class="form-control form-select" name="pillar" tabindex="1">
                                <option value="">Select Prog/Pillar/Activity</option>
                                <?php
                                  $pillars = $con->getRows('pillars', array('order_by'=>'pillar'));
                                  if(!empty($pillars)){
                                    foreach ($pillars as $pillar) {
                                      echo'<option value="'.$pillar['pillar_id'].'">'.$pillar['pillar'].'</option>';
                                    }
                                  }
                                ?>
                              </select> 
                            </div>   
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Logistics</label>
                              <select class="form-control form-select" name="logistics" id="logistics" tabindex="1">
                                <option value="">Select Logistics</option>
                                <option value="1">Accomodated</option>
                                <option value="2">Look for own Accomodation</option>
                                <option value="3">One Day Return</option>
                              </select> 
                            </div> 
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Rate Per Night</label>
                              <input type="number" class="form-control" name="rate_night" id="rate_night" disabled>  
                            </div> 
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Mileage</label>
                              <input type="number" class="form-control" name="mileage" id="mileage">  
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Total Fuel(MWK)</label>
                              <input type="number" class="form-control" id="total_fuel" disabled>  
                            </div>
                                                    
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Purpose of the Trip</label>
                              <input type="text" class="form-control" name="purpose">  
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Night(s)</label>
                              <input type="number" min="0" class="form-control" name="nights" id="nights" onChange="sum()">  
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Total Nights Allowance</label>
                              <input type="number" class="form-control" id="total_allowance" disabled>  
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Fuel Type</label>
                              <select class="form-control form-select" name="fuel" id="fuel" tabindex="1">
                                <option value="">Select Fuel Type</option>
                                <?php
                                  $fuels = $con->getRows('fuel_prices', array('order_by'=>'fuel'));
                                  if(!empty($fuels)){
                                    foreach ($fuels as $fuel) {
                                      echo'<option value="'.$fuel['fuel_id'].'">'.$fuel['fuel'].'</option>';
                                    }
                                  }
                                ?>
                              </select>  
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Total Fuel + Allowances(MWK)</label>
                              <input type="number" class="form-control" id="total_budget" disabled>  
                            </div>  
                          </div>
                           <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-3">
                              <input type="hidden" name="user_id" value="<?=$_SESSION['USR_ID']?>">
                              <button type="submit" name="travel_advance_request" id="vehicle_request"  class="btn btn-primary ">Submit Request</button>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Travel Advance Requests </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/travel-request.php'); ?>
      
    </div>
  </div>
</div>

