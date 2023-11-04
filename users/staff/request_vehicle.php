<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Vehicle Request</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Request A vehicle</li>
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
      <?php include_once('../../layout/vehicle-request.php'); ?>      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Request a Vehicle</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card">
                    <div class="card-body p-4">
                      <h4 class="fw-semibold mb-3">Request a Vehicle</h4>
                      
                      <p class="card-subtitle mb-4">Remember to request 2 days before the trip. </p>
                      <div id="error"></div>
                      <form id="vehicle-request" method="post" action="" enctype="multipart/form-data">                            
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Name of Driver</label>
                              <input type="text" class="form-control" name="driver"> 
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">From</label>
                              <input type="text" class="form-control" name="from"> 
                            </div>   
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">To</label>
                              <input type="text" class="form-control" name="to"> 
                            </div>                           
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Name of Activity</label>
                              <input type="text" class="form-control" name="activity">  
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Departure Date</label>
                              <input type="date" class="form-control" name="date_from">                              
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Arrival Date</label>
                              <input type="date" class="form-control" name="date_to">                              
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-3">
                              <input type="hidden" name="user_id" value="<?=$_SESSION['USR_ID']?>">
                              <button type="submit" name="vehicle_request" id="vehicle_request"  class="btn btn-primary ">Submit Request</button>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Help Desk </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/vehicle-request.php'); ?>
      
    </div>
  </div>
</div>