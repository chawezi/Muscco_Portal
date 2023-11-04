<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Leave Application</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Leave</li>
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
      <form class="position-relative w-100">
        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact">
        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
      </form>
    </div>
  <div class="d-flex w-100">
    <div class="left-part border-end w-20 flex-shrink-0 d-none d-lg-block">
      <?php include_once('../../layout/leave-menu.php') ?>
      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Approved Applications</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                    <table id="zero_config" class="table search-table align-middle dataTable">
                      <thead class="header-item">
                        <th>
                          #
                        </th>
                        <th>Name</th>
                        <th>Leave Type</th>
                        <th>Status</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                          $leave = $con->getRows('leave_applications a, leave_fy b, leave_types c, muscco_members d',
                                                  array('where'=>'a.member_id=d.muscco_member_id and a.fy_id=b.fy_id and a.leave_type=c.type_id and a.leave_status=3', 'order_by'=>'a.date_requested desc'));
                          if(!empty($leave)){
                            $i=0;
                            foreach($leave as $day){ 
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
                                        <h6 class="user-name mb-0" data-name=""><?=ucwords($day['first_name'])." ".ucwords($day['last_name'])?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                
                                <td>
                                  <?=$day['name']?>
                                </td>
                                <td>
                                  <?php 
                                    switch ($day['leave_status']) {
                                      case 0:
                                        echo'<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                                        break;
                                      case 1:
                                        echo'<span class="mb-1 badge rounded-pill bg-info">Checked</span>';
                                        break;
                                      case 2:
                                        echo'<span class="mb-1 badge rounded-pill bg-warning">Verified</span>';
                                        break;
                                      
                                      case 3:
                                        echo'<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
                                        break;

                                      case 4:
                                        echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                        break;
                                    }
                                  ?>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_start'])?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_end'])?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                                      <a href="dashboard.php?page=leave_application_details&application_id=<?=$day['application_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-id3="<?=$day['application_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                                        <i class="ti ti-pencil fs-4"></i>
                                      </a>
                                      <button class="btn btn-sm btn-danger btn-sm btn_day_delete" data-id3="<?=$day['application_id']?>" data-file="<?=$day['event_attachment']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Email </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="px-9 pt-4 pb-3">
        <button class="btn btn-primary fw-semibold py-8 w-100">Compose</button>
      </div>
      <ul class="list-group" style="height: calc(100vh - 150px)" data-simplebar>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-inbox fs-5"></i>Inbox</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-brand-telegram fs-5"></i>Sent</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-file-text fs-5"></i>Draft</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-inbox fs-5"></i>Spam</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-trash fs-5"></i>Trash</a>
        </li>
        <li class="border-bottom my-3"></li>
        <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">IMPORTANT</li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-star fs-5"></i>Starred</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)" class="d-block "><i class="ti ti-badge fs-5"></i>Important</a>
        </li>
        <li class="border-bottom my-3"></li>
        <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">LABELS</li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-bookmark fs-5 text-primary"></i>Promotional</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-bookmark fs-5 text-warning"></i>Social</a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1"
            href="javascript:void(0)"><i class="ti ti-bookmark fs-5 text-success"></i>Health</a>
        </li>
      </ul>
    </div>
  </div>
</div>