<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Admin Settings</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Bands & Rates</li>
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
<div class="card">
  <div class="d-flex align-items-center justify-content-between gap-3 m-3 d-lg-none">
      <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
        <i class="ti ti-menu-2 fs-5"></i>
      </button>
      <form class="position-relative w-100">
        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact">
        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
      </form>
    </div>
  <div class="d-flex w-100">
    <div class="left-part border-end w-20 flex-shrink-0 d-none d-lg-block">
      <?php include_once('../../layout/admin.php'); ?>      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Bands & Rates</h5>
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add New Band">
                    <a class="btn btn-primary btn-md" href="dashboard.php?page=new_band">
                      <i class="ti ti-plus"></i> Add Band & Rates
                    </a>
                  </li>
                </ul>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive">
                      <div id="error"></div>
                      <table id="scroll_hor" class="table border table-striped table-bordered display  dataTable no-footer" aria-describedby="scroll_hor_info">
                        <thead class="header-item">
                          <th>Band</th>
                          <th>Accomm. Ceiling </th>
                          <th>Lumpsum</th>
                          <th>Accomm.& Meals</th>
                          <th>No Accomm.& Meals</th>
                          <th>No Accomm.& With Meals</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php
                            $bands = $con->getRows('band_rates', array('order_by'=>'band_title asc'));
                            if(!empty($bands)){
                              $i=0;
                              foreach($bands as $band){ 
                                $i++;
                          ?>
                                <tr class="search-items">
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <div class="ms-3">
                                        <div class="user-meta-info">
                                          <h6 class="user-name mb-0" data-name="Emma Adams"><?=$band['band_title']?></h6>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <span class="usr-email-addr"><?=number_format($band['accomodation_ceiling'])?></span>
                                  </td>
                                  <td>
                                    <span class="usr-location"><?=number_format($band['lumpsum'])?></span>
                                  </td>
                                  <td>
                                    <span class="usr-ph-no" ><?=number_format($band['with_accomodation'])?></span>
                                  </td> 
                                  <td>
                                    <span class="usr-ph-no" ><?=number_format($band['withoutaccomodation_nomeals'])?></span>
                                  </td>  
                                  <td>
                                    <span class="usr-ph-no" ><?=number_format($band['withoutaccomodation_withmeals'])?></span>
                                  </td>                                 
                                  <td>
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                      <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                    
                                        <a href="dashboard.php?page=band_details&band_id=<?=$band['band_id']?>" class="btn btn-primary btn-sm"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details" >
                                          <i class="ti ti-pencil fs-4"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger btn-sm btn_delete_band" data-id3="<?=$band['band_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Admin Settings </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/admin.php'); ?>
      
    </div>
  </div>
</div>