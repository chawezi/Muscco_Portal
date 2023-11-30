<div class="container-fluid">
  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Loans</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item" aria-current="page">Loans</li>
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
              <i class="ti ti-file-dollar me-2 fs-6"></i>
              <span class="d-none d-md-block">Pending Applications</span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
              <i class="ti ti-files me-2 fs-6"></i>
              <span class="d-none d-md-block">Oustanding Loans </span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab" aria-controls="pills-bills" aria-selected="false">
              <i class="ti ti-file-check me-2 fs-6"></i>
              <span class="d-none d-md-block">Paid Loans</span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
              <i class="ti ti-playlist-add me-2 fs-6"></i>
              <span class="d-none d-md-block">Apply Loan</span> 
            </button>
          </li>
        </ul>
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
              <div class="row">
                <div class="table-responsive">
                  <h4 class="fw-semibold mb-3">Pending Applications</h4>
                  <p>To change or update the loan application  click on  loan details.</p>
                  <table id="zero_config" class="table search-table align-middle  dataTable">
                    <thead class="header-item">
                      <th>
                       Loan #
                      </th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Date Posted</th>
                      <th>Posted By</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('loans a, sacco_members b', array('where'=>'a.loan_status=0 and a.posted_by=b.sacco_member_id and a.sacco_id="'.$_SESSION['USR_OF'].'"', 'order_by'=>'date_posted desc'));
                        if(!empty($invoices)){
                          $i=0;
                          $balance = 0;
                          foreach($invoices as $invoice){ 
                            $i++;
                            $balance = $invoice['amount'] - $invoice['amount_paid'];
                      ?>
                            <tr class="search-items">
                              <td>
                                <?=$invoice['loan_id']?>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$invoice['purpose']?></h6>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['amount'],2,'.',',')?></span>
                              </td>
                              
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr"><?=$invoice['first_name'].' '.$invoice['last_name']?></span>
                              </td>
                              <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                                      
                                      <a href="dashboard.php?page=loan_details&loan_id=<?=$invoice['loan_id']?>" class="btn btn-primary btn-sm btn_ticket_cancel" data-id3="<?=$ticket['ticket_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                                        <i class="ti ti-pencil fs-4"></i>
                                      </a>
                                      <button class="btn btn-danger btn-sm btn_ticket_cancel" data-id3="<?=$ticket['ticket_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancel Loan">
                                        <i class="ti ti-trash fs-4"></i>
                                      </button>
                                      
                                    </div>
                                    
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
                  <h4 class="fw-semibold mb-3">Outstanding Loans</h4>
                  <p>These are loans that you are still paying.</p>
                  <table id="multi_col_order" class="table search-table align-middle  dataTable">
                    <thead class="header-item">
                      <th>
                       Loan #
                      </th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Amount Paid</th>
                      <th>Balance</th>
                      <th>Date Posted</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('loans a, sacco_members b', array('where'=>'a.loan_status=1 and a.posted_by=b.sacco_member_id and a.sacco_id="'.$_SESSION['USR_OF'].'"', 'order_by'=>'date_posted desc'));
                        if(!empty($invoices)){
                          $i=0;
                          $balance = 0;
                          foreach($invoices as $invoice){ 
                            $i++;
                            $balance = $invoice['amount'] - $invoice['amount_paid'];
                      ?>
                            <tr class="search-items">
                              <td>
                                <?=$invoice['loan_id']?>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$invoice['purpose']?></h6>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['total_loan'],2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['amount_paid'],2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['loan_balance'],2,'.',',')?></span>
                              </td>
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
                              </td>
                              <td>
                                
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                                      
                                      <a href="dashboard.php?page=loan_details&loan_id=<?=$invoice['loan_id']?>" class="btn btn-primary btn-sm btn_ticket_cancel" data-id3="<?=$ticket['ticket_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details" disabled>
                                        <i class="ti ti-pencil fs-4"></i>
                                      </a>
                                      
                                    </div>
                                    
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
                  
                  <h4 class="fw-semibold mb-3">Paid Loans</h4>
                  <p>These are loans that have been paid.</p>
                  <table id="default_order" class="table search-table align-middle  dataTable">
                    <thead class="header-item">
                      <th>
                       Loan #
                      </th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Date Posted</th>
                      <th>Posted By</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $invoices = $con->getRows('loans a, sacco_members b', array('where'=>'a.loan_status=3 and a.posted_by=b.sacco_member_id and a.sacco_id="'.$_SESSION['USR_OF'].'"', 'order_by'=>'date_posted desc'));
                        if(!empty($invoices)){
                          $i=0;
                          $balance = 0;
                          foreach($invoices as $invoice){ 
                            $i++;
                            $balance = $invoice['amount'] - $invoice['amount_paid'];
                      ?>
                            <tr class="search-items">
                              <td>
                                <?=$invoice['loan_id']?>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$invoice['purpose']?></h6>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr">K<?=number_format($invoice['amount'],2,'.',',')?></span>
                              </td>
                              
                              <td>
                                <span class="usr-ph-no" ><?=$con->shortDate($invoice['date_posted'])?></span>
                              </td>
                              <td>
                                <span class="usr-email-addr"><?=$invoice['first_name'].' '.$invoice['last_name']?></span>
                              </td>
                              <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                                      
                                      <a href="dashboard.php?page=loan_details&loan_id=<?=$invoice['loan_id']?>" class="btn btn-primary btn-sm btn_ticket_cancel" data-id3="<?=$ticket['ticket_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details" disabled>
                                        <i class="ti ti-pencil fs-4"></i>
                                      </a>
                                      <a href="dashboard.php?page=loan_details&loan_id=<?=$invoice['loan_id']?>" class="btn btn-danger btn-sm btn_ticket_cancel" data-id3="<?=$ticket['ticket_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancel Loan" disabled>
                                        <i class="ti ti-trash fs-4"></i>
                                      </a>
                                      
                                    </div>
                                    
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
                      <h5 class="card-title fw-semibold">Apply for a Loan</h5>
                      <small>It is recommended to send your loan application in pdf.</small>
                      <div id="response"></div>
                      <form class="mt-3" id="add-invoice" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="row">
                            <div class="col-lg-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Description</label>
                              <input type="text" class="form-control" name="description">
                            </div>
                            <div class="col-lg-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Amount</label>
                              <input type="number" min="0"  class="form-control" name="amount">
                            </div>
                            <div class="col-lg-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Loan Application Form</label>
                              <input type="file" class="form-control" name="file">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                              <button type="submit" name="apply_loan" id="apply_loan" class="btn btn-primary">Apply Loan</button>
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