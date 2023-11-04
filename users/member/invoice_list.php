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
        </ul>
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
              <div class="row">
                <div class="table-responsive">
                  <h4 class="fw-semibold mb-3">Pending Invoices</h4>
                  <table id="zero_config" class="table search-table align-middle dataTable">
                    <thead class="header-item">
                      <th>
                       Invoice #
                      </th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Amount Paid</th>
                      <th>Due Date</th>
                      <th>Date Posted</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('invoices', array('where'=>'sacco_id="'.$_SESSION['USR_OF'].'" and invoice_status=0', 'order_by'=>'date_posted desc'));
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
                                <span class="usr-email-addr"><?=$con->shortDate($invoice['due_date'])?></span>
                              </td>
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
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
            <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
              <div class="row justify-content-center">
                <div class="row">
                <div class="table-responsive">
                  <h4 class="fw-semibold mb-3">Paid Invoices</h4>
                  <table id="default_order" class="table search-table align-middle text-nowrap dataTable">
                    <thead class="header-item">
                      <th>
                        Invoice #
                      </th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Amount Paid</th>
                      <th>Balance</th>
                      <th>Date Posted</th>
                      <th>Date Paid</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('invoices a, invoice_status c', array('where'=>'a.invoice_status=1 and a.sacco_id="'.$_SESSION['USR_OF'].'" and a.invoice_id=c.invoice_id', 'order_by'=>'a.date_posted desc'));
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
                  <table id="multi_col_order" class="table search-table align-middle dataTable">
                    <thead class="header-item">
                      <th>
                        Invoice #
                      </th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Amount Paid</th>
                      <th>Balance</th>
                      <th>Date Posted</th>
                      <th>Date Cancelled</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('invoices a, invoice_status c', array('where'=>'a.invoice_status=2 and a.sacco_id="'.$_SESSION['USR_OF'].'" and a.invoice_id=c.invoice_id', 'order_by'=>'a.date_posted desc'));
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
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div> 