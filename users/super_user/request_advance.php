<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Staff Advances</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Request An Advance</li>
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
      <?php include_once('../../layout/advances.php'); ?>      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Request an Advance</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card">
                    <div class="card-body p-4">
                      <h4 class="fw-semibold mb-3">Request an Advance</h4>
                      <p>Note that an advance is deducted/paid directly from your salary in 1-3 installments</p>
                      <div id="response"></div>
                      <form id="request-advance" method="post" action="">                          
                        <div class="row">
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Amount</label>
                              <input type="number" min="0" class="form-control" name="amount" >
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>First Installment</label>
                              <input type="month" class="form-control" name="start" >
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Last Installment</label>
                              <input type="month" class="form-control" name="end" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label>Purpose of Advance</label>
                              <textarea class="form-control" rows="2" name="reasons" placeholder=""></textarea>
                            </div>
                          </div>
                          <!--/span-->
                          
                          <div class="col-12">
                          <div class="d-flex align-items-center justify-content-end gap-3">
                            <button type="submit" name="request_advance" id="request_advance"  class="btn btn-primary ">Advance Request</button>
                          </div>
                        </div>
                          <!--/span-->
                        </div>
                        <!--/row-->
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Advances </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/advances.php'); ?>
      
    </div>
  </div>
</div>