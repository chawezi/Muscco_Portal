<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Admin Settings</h4>
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
<div class="card">
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
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">System Backups</h5>
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download My Requisitions">
                    <a class="btn btn-primary btn-md" href="dashboard.php?page=new_band">
                      <i class="ti ti-plus"></i> Add Band
                    </a>
                  </li>
                </ul>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive">
                      <div id="error"></div>

                    </div>
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="card">
                          <div class="card-body p-4">
                            <h4 class="fw-semibold mb-3">Database Backups History</h4>
                            <div id="show_db"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="card">
                          <div class="card-body p-4">
                            <h5 class="fs-5 fw-semibold mb-0">Take Backup</h5>
                            <small class="mb-3">Remember to take db backup regularly and keep a copy of the backup outside of this system.</small><br>
                            <div id="itinerary_response"></div> 
                                <form class="" id="daily-itinery" name="add-position" method="post" action="">
                                  <div class="row">
                                      <div class="col-lg-12">
                                        <div class="mb-3">
                                          <input type="text" class="form-control" placeholder="Enter Backup Title" name="title">
                                          <input type="hidden" name="save_backup">
                                        </div>
                                      </div>
                                      <div class="col-lg-12">
                                        <div class="d-md-flex align-items-center">
                                          
                                          <div class="mt-3 mt-md-0 ms-auto">
                                            <button type="submit" class="btn btn-primary font-medium px-4" name="save_backup" id="add_db">
                                              <div class="d-flex align-items-center">
                                                Save Backup
                                              </div>
                                            </button>
                                          </div>
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