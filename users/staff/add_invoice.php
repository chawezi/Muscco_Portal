<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Invoices</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Post New Invoice</li>
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
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Post New Invoice</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card">
                      <div class="card-body p-4">
                          <h5 class="card-title fw-semibold">Add New Invoice</h5>
                          <small>It is recommended to send your invoice in pdf.</small>
                          <div id="response"></div>
                          <form class="mt-3" id="add-invoice" method="post" enctype="multipart/form-data">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Sacco Name</label>
                                  <select class="form-select" name="sacco">
                                    <option value="">Select Sacco</option>
                                    <?php
                                      $saccos = $con->getRows('sacco', array('order_by'=>'sacco_name asc'));
                                      if(!empty($saccos)){
                                        foreach($saccos as $sacco){
                                          echo'<option value="'.$sacco['sacco_id'].'">'.$sacco['sacco_name'].'</option>';
                                        }
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Description</label>
                                  <input type="text" class="form-control" name="description">
                                </div>

                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Invoice File</label>
                                  <input type="file" class="form-control" name="invoice">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Invoice Number</label>
                                  <input type="text" class="form-control" name="invoice_number">
                                </div>                            
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Due Date</label>
                                  <input type="date" class="form-control" name="due_date">
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Amount</label>
                                  <input type="number" min="0"  class="form-control" name="amount">
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Amount Paid</label>
                                  <input type="number" min="0" class="form-control" name="amount_paid">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                  <button type="submit" name="add_invoice" id="add_invoice" class="btn btn-primary">Save Invoice</button>
                                  <button type="reset" class="btn btn-light-danger text-danger">Cancel</button>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Invoices</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/invoices.php'); ?>
    </div>
  </div>
</div>