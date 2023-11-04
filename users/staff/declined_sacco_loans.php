<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Sacco Loans</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Declined Sacco Loans</li>
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
      <?php include_once('../../layout/loans.php') ?>
      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Declined Loans</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                      <div id="err"></div>

                      <table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
                        <thead class="header-item">
                          <th>
                            Loan #
                          </th>
                          <th>Sacco Name</th>
                          <th>Amount</th>
                          <th>Declined On</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php
                            $loans = $con->getRows('loans a, sacco b', array('where'=>'a.loan_status=2 and a.sacco_id=b.sacco_id', 'order_by'=>'date_posted desc'));
                            if(!empty($loans)){
                              $balance = 0;
                              foreach($loans as $loan){ 
                          ?>
                                <tr class="search-items">
                                  <td>
                                    <?=sprintf('%04d',$loan['loan_id'])?>
                                  </td>
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <div class="ms-3">
                                        <div class="user-meta-info">
                                          <h6 class="user-name mb-0" data-name=""><?=ucwords($loan['sacco_name'])?></h6>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>                                
                                    <div class="d-flex align-items-center">
                                      <div class="ms-3">
                                        <div class="user-meta-info">
                                          <h6 class="user-name mb-0" data-name=""><span class="usr-email-addr">K<?=number_format($loan['amount'],2,'.',',')?></span></h6>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  
                                  <td>
                                    <span class="usr-ph-no" ><?=$con->shortDate($loan['date_updated'])?></span>
                                  </td>
                                  <td>
                                    <div class="action-btn">
                                      <a href="dashboard.php?page=loan_details&loan_id=<?=$loan['loan_id']?>" class="btn btn-primary btn-sm  ms-2"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Invoice Details">
                                        <i class="ti ti-edit fs-5"></i>
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


    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Sacco Loans</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/loans.php'); ?>
    </div>
  </div>
</div>