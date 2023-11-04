<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Invoices</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Invoice Reports</li>
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
      <?php include_once('../../layout/invoices.php') ?>
      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Invoice Reports</h5>
                <div class="btn-toolbar mb-0 d-flex align-items-center" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                    <button class="btn btn-primary btn-sm invoice_today" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Todays Report">
                      <i class="ti ti-report fs-4"></i> Today
                    </button>
                    <button class="btn btn-sm btn-warning btn-sm invoice_week" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This Week Report">
                      <i class="ti ti-report fs-4"></i> Week
                    </button>
                    <button class="btn btn-sm btn-success btn-sm invoice_month" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This Month Report">
                      <i class="ti ti-report fs-4"></i> Month
                    </button>
                    <button class="btn btn-sm btn-info btn-sm invoice_year" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This Year Report">
                      <i class="ti ti-report fs-4"></i> Year
                    </button>
                  </div>
                  
                </div>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                      <div class="container-fluid note-has-grid mb-8" style="width:100%; padding:2px;">
                          <form class="row g-3" id="advancereport-custom" name="advancereport-custom" method="post" action="">
                            <input type="hidden" name="action" value="advance_custom">
                            <div class="col-md-3">
                                <div class="">
                                    <select class="form-select" name="sacco">
                                        <option value="">Select Sacco</option>
                                        <option value="All">All Saccos</option>
                                        <?php
                                          $officers = $con->getRows('sacco', array('order_by'=>'sacco_name asc'));
                                          if(!empty($officers)){
                                            foreach($officers as $officer){                                      
                                              echo "<option value='".$officer['sacco_id']."'>".$officer['sacco_name']."</option>";
                                            }
                                          }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                <input type="date" class="form-control" name="date_from" placeholder="Date From">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <input type="date" class="form-control" name="date_to" placeholder="Date To">
                                </div>
                            </div>
                            <div class="col-md-3">
                            <div class="text-left">
                            <button type="submit" id="generate_report" name="generate_issued" class="btn btn-primary btn-md"> Generate</button>
                            </div>
                            </div>                        
                        </form>
                        </div>
                        <div id="show_invoice_report"></div>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Invoices</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/invoices.php'); ?>
    </div>
  </div>
</div>