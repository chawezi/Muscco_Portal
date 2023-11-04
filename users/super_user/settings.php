<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Settings</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Settings</li>
          </ol>
        </nav>
      </div>
      <div class="col-3">
        <div class="text-center mb-n5">  
          <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
        <i class="ti ti-theater me-2 fs-6"></i>
        <span class="d-none d-md-block">Departments</span> 
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
        <i class="ti ti-list-details me-2 fs-6"></i>
        <span class="d-none d-md-block">Positions</span> 
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
        <i class="ti ti-archive me-2 fs-6"></i>
        <span class="d-none d-md-block">Backups</span> 
      </button>
    </li>
  </ul>
  <div class="card-body">
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
        <div class="row justify-content-center">
          <div class="col-lg-9 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Departments</h5>
                <div class="table-responsive">
                <div id="error"></div> 
                  <form class="" id="manage-departments" name="manage-departments" method="post" action="">
                    <div class="row">
                        <div class="col-lg-9">
                          <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter Department Name" name="department">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="d-md-flex align-items-center">
                            
                            <div class="mt-3 mt-md-0 ms-auto">
                              <button type="submit" class="btn btn-primary font-medium px-4" name="add_department" id="manage_department">
                                <div class="d-flex align-items-center">
                                  Save Department
                                </div>
                              </button>
                            </div>
                          </div>
                        </div>
                    </div>
                  </form>
                  <div id="department_response"></div>
                  <div id="show_departments"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <div class="card">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Positions</h5>
                <div class="table-responsive">
                  <div id="position_error"></div> 
                  <form class="" id="add-position" name="add-position" method="post" action="">
                    <div class="row">
                        <div class="col-lg-9">
                          <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter Position Name" name="position">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="d-md-flex align-items-center">
                            
                            <div class="mt-3 mt-md-0 ms-auto">
                              <button type="submit" class="btn btn-primary font-medium px-4" name="add_position" id="add_position">
                                <div class="d-flex align-items-center">
                                  Save Position
                                </div>
                              </button>
                            </div>
                          </div>
                        </div>
                    </div>
                  </form>
                  <div id="positions_response"></div>
                  <div id="show_positions"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
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

<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  function getDepartments(){
    let action = "get_departments";
    $.ajax({
        url:"get_department_data.php",
        method:"GET",
        data:{action:action},
        success:function(data){ 
            $('#show_departments').html(data);
        }
    });
  }
  function getPositions(){
    let action = "get_positions";
    $.ajax({
        url:"get_department_data.php",
        method:"GET",
        data:{action:action},
        success:function(data){ 
            $('#show_positions').html(data);
        }
    });
  }

  
  getDepartments();
  getPositions();

</script>