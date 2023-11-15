<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Sacco List</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Sacco Directory</li>
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
  <div class="tab-content">
    <div id="note-full-container" class="note-has-grid row">
      <div class="col-md-12 single-note-item all-category note-social">
        <div class="card card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Sacco Directory</h5>
              <p class="card-subtitle mb-0">Registered Sacco with Muscco</p>
            </div>
            <div>
              <div class="btn-group mb-2">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  Export Sacco
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                  <li><a class="dropdown-item" href="../../generate-lpdf.php?type=sacco_list" target="_blank">PDF</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <div id="response"></div>
            <table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
              <thead class="header-item">
                <th>
                  #
                </th>
                <th>Sacco Name</th>
                <th>Sacco President</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Reg. Date </th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                  $saccos = $con->getRows('sacco', array('order_by'=>'sacco_name asc'));
                  if(!empty($saccos)){
                    $i=0;
                    foreach($saccos as $sacco){ 
                      $logo = $sacco['logo'];
                      if(empty($logo)){
                        $logo = 'default.jpg';
                      }
                ?>
                      <tr class="search-items">
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="me-2 pe-1">
                              <img src="../../uploads/logos/<?=$logo?>" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0" data-name=""><?=ucwords($sacco['sacco_name'])?></h6>
                                <span class="user-work fs-3" data-occupation=""><?=$sacco['location']?></span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="usr-email-addr"><?=ucwords($sacco['sacco_president'])?></span>
                        </td>
                        <td>
                          <span class="usr-email-addr"><?=$sacco['email_address']?></span>
                        </td>
                        <td>
                          <span class="usr-location"><?=$sacco['phone_number']?></span>
                        </td>
                        <td>
                          <span class="usr-ph-no" ><?=$con->shortDate($sacco['registered_date'])?></span>
                        </td>
                        <td>
                          <div class="action-btn">
                            <a href="dashboard.php?page=sacco_details&sacco_id=<?=$sacco['sacco_id']?>" class="btn btn-primary btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                               Details 
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
