<div class="container-fluid">
  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Invoices</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item" aria-current="page">Invoices</li>
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
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
              <i class="ti ti-file-invoice me-2 fs-6"></i>
              <span class="d-none d-md-block">Pending Invoices</span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
              <i class="ti ti-file-star me-2 fs-6"></i>
              <span class="d-none d-md-block">Paid Invoices</span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab" aria-controls="pills-bills" aria-selected="false">
              <i class="ti ti-file-x me-2 fs-6"></i>
              <span class="d-none d-md-block">Cancelled Invoices</span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
              <i class="ti ti-playlist-add me-2 fs-6"></i>
              <span class="d-none d-md-block">Add Invoice</span> 
            </button>
          </li>
        </ul>
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
              <div class="row">
                <div class="table-responsive">
                  <h4 class="fw-semibold mb-3">Pending Invoices</h4>
                  <p>To change the status of the invoice click on  invoice details.</p>
                  <table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
                    <thead class="header-item">
                      <th>
                       Invoice #
                      </th>
                      <th>Sacco Name & Description</th>
                      <th>Amount</th>
                      <th>Amount Paid</th>
                      <th>Balance</th>
                      <th>Date Posted</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('invoices a, sacco b', array('where'=>'a.invoice_status=0 and a.sacco_id=b.sacco_id', 'order_by'=>'date_posted desc'));
                        if(!empty($invoices)){
                          $i=0;
                          $balance = 0;
                          foreach($invoices as $invoice){ 
                            $i++;
                            $balance = $invoice['amount'] - $invoice['amount_paid'];
                      ?>
                            <tr class="search-items">
                              <td>
                                <?=$invoice['invoice_number']?>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=ucwords($invoice['sacco_name'])?></h6>
                                      <span class="user-work fs-3"><?=$invoice['description']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['amount'],2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['amount_paid'],2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($balance,2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
                              </td>
                              <td>
                                <div class="action-btn">
                                  <a href="dashboard.php?page=invoice_details&invoice_id=<?=$invoice['invoice_id']?>" class="btn btn-primary btn-sm  ms-2"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Invoice Details">
                                    <i class="ti ti-eye fs-5"></i>
                                  </a>
                                  <a href="dashboard.php?page=invoice_details&invoice_id=<?=$invoice['invoice_id']?>" class="btn btn-danger btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancel Invoice">
                                    <i class="ti ti-trash fs-5"></i>
                                  </a>
                                </div>
                              </td>
                            </tr>
                      <?php }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
              <div class="row justify-content-center">
                <div class="row">
                <div class="table-responsive">
                  <h4 class="fw-semibold mb-3">Paid Invoices</h4>
                  <p>Note that you can not change the status of invoices .</p>
                  <table id="default_order" class="table search-table align-middle text-nowrap dataTable">
                    <thead class="header-item">
                      <th>
                        Invoice #
                      </th>
                      <th>Sacco Name & Description</th>
                      <th>Amount</th>
                      <th>Amount Paid</th>
                      <th>Balance</th>
                      <th>Date Posted</th>
                      <th>Date Paid</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('invoices a, sacco b, invoice_status c', array('where'=>'a.invoice_status=1 and a.sacco_id=b.sacco_id and a.invoice_id=c.invoice_id', 'order_by'=>'date_posted desc'));
                        if(!empty($invoices)){
                          $balance = 0;
                          foreach($invoices as $invoice){ 
                            $balance = $invoice['amount'] - ($invoice['amount_paid'] + $invoice['paid_amount']);
                            $paid = $invoice['amount_paid'] + $invoice['paid_amount'];
                      ?>
                            <tr class="search-items">
                              <td>
                                <?=ucwords($invoice['invoice_number'])?>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=ucwords($invoice['sacco_name'])?></h6>
                                      <span class="user-work fs-3"><?=$invoice['description']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['amount'],2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($paid,2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($balance,2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
                              </td>
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_updated'])?></span>
                              </td>
                              <td>
                                <div class="action-btn">
                                  <a href="dashboard.php?page=invoice_details&invoice_id=<?=$invoice['invoice_id']?>" class="btn btn-primary btn-sm  ms-2"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Invoice Details">
                                    <i class="ti ti-eye fs-5"></i>
                                  </a>
                                </div>
                              </td>
                            </tr>
                      <?php }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
              <div class="row justify-content-center">
                <div class="row">
                <div class="table-responsive">
                  
                  <h4 class="fw-semibold mb-3">Cancelled Invoices</h4>
                  <p>Note that you can not change the status of invoices.</p>
                  <table id="multi_col_order" class="table search-table align-middle dataTable">
                    <thead class="header-item">
                      <th>
                        Invoice #
                      </th>
                      <th>Sacco Name & Description</th>
                      <th>Amount</th>
                      <th>Amount Paid</th>
                      <th>Balance</th>
                      <th>Date Posted</th>
                      <th>Date Cancelled</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('invoices a, sacco b, invoice_status c', array('where'=>'a.invoice_status=2 and a.sacco_id=b.sacco_id and a.invoice_id=c.invoice_id', 'order_by'=>'date_posted desc'));
                        if(!empty($invoices)){
                          $i=0;
                          $balance = 0;
                          foreach($invoices as $invoice){ 
                            $i++;
                            $balance = $invoice['amount'] - $invoice['amount_paid'];
                      ?>
                            <tr class="search-items">
                              <td>
                                <?=ucwords($invoice['invoice_number'])?>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=ucwords($invoice['sacco_name'])?></h6>
                                      <span class="user-work fs-3"><?=$invoice['description']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['amount'],2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['amount_paid'],2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($balance,2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
                              </td>
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_updated'])?></span>
                              </td>
                              <td>
                                <div class="action-btn">
                                  <a href="dashboard.php?page=invoice_details&invoice_id=<?=$invoice['invoice_id']?>" class="btn btn-primary btn-sm  ms-2"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Invoice Details">
                                    <i class="ti ti-eye fs-5"></i>
                                  </a>
                                </div>
                              </td>
                            </tr>
                      <?php }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
              <div class="row">
                <div class="col-12">
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