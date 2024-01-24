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
                  <div class="row">
                      <div class="col-12">
                          <!-- ---------------------
                                  start Scroll - Vertical &amp; Horizontal
                              ---------------- -->
                          <div class="card">
                              <div class="card-body">
                                  <div class="mb-2">
                                      <h5 class="card-title fw-semibold">
                                        Outstanding Advances
                                      </h5>
                                  </div>
                                  <div class="table-responsive">
                                      <table id="zero_config"
                                          class="table border table-striped table-bordered display"
                                          >
                                          <thead>
                                              <th>#</th>
                                              <th>Amount</th>
                                              <th>Paid</th>
                                              <th>Balance</th>
                                              <th>Date Posted</th>
                                              <th>Status</th>
                                              <th>Status</th>
                                          </thead>
                                          <tbody>
                                            <?php
                                              $requisitions = $con->getRows('advance_requests', 
                                                       array('where'=>'requested_by="'.$_SESSION['USR_ID'].'" and (advance_status <5 and advance_status !=2)','order_by'=>'date_posted desc'));
                                              if(!empty($requisitions)){
                                                $i=0;
                                                foreach($requisitions as $row){ 
                                                  $i++;
                                            ?>
                                                  <tr class="search-items">
                                                    <td>
                                                      <?=$i?>
                                                    </td>
                                                    <td>
                                                      <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                          <div class="user-meta-info">
                                                            <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                      MK<?=number_format($row['total_paid'],2,'.',',')?>        
                                                    </td>
                                                    <td>
                                                      MK<?=number_format($row['balance'],2,'.',',')?>        
                                                    </td>
                                                    <td>
                                                      <?=$con->shortDate($row['date_posted'])?>
                                                    </td>
                                                    <td>
                                                      <?php 
                                                        switch ($row['advance_status']) {
                                                          case 0:
                                                            echo'<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                                                            break;
                                                          case 1:
                                                            echo'<span class="mb-1 badge rounded-pill bg-info">Verified</span>';
                                                            break;
                                                          case 2:
                                                            echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                                            break;
                                                          case 3:
                                                            echo'<span class="mb-1 badge rounded-pill bg-warning">Checked</span>';
                                                            break;
                                                          case 4:
                                                            echo'<span class="mb-1 badge rounded-pill bg-success">outstanding</span>';
                                                            break;
                                                          case 5:
                                                            echo'<span class="mb-1 badge rounded-pill bg-success">Paid</span>';
                                                            break;
                                                        }
                                                      ?>
                                                    </td>
                                                    <td>
                                                      <a href="dashboard.php?page=advance_details&advance_id=<?=$row['advance_id']?>" class="btn btn-primary btn-sm" data-bs-placement="top" data-bs-title="View Details">
                                              <i class="ti ti-pencil fs-4"></i>
                                            </a>
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