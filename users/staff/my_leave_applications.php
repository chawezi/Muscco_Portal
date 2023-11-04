<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Leave Application</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">My Applications</li>
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
      <?php include_once('../../layout/leave-menu.php') ?>
      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">My Leave Applications</h5>
                
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                    
                    <a href="dashboard.php?page=my_leave_days" class="btn btn-sm btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="My Leave Days">
                      <i class="ti ti-calendar fs-4"></i> My Leave Days
                    </a>
                  </div>
                  
                </div>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                      <div id="err"></div>
                      <table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
                        <thead class="header-item">
                          <th>
                            ID #
                          </th>
                          <th>Leave Type</th>
                          <th>Days</th>
                          <th>Date From - To</th>
                          <th>Status</th>
                          <th>Date Applied</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php
                            $leave = $con->getRows('leave_applications a, leave_fy b, leave_types c',
                                             array('where'=>'a.fy_id=b.fy_id and a.leave_type=c.type_id and a.member_id="'.$_SESSION['USR_ID'].'"', 'order_by'=>'a.date_requested desc'));
                            if(!empty($leave)){
                              $i=0;
                              foreach($leave as $day){ 
                                $i++;
                          ?>
                                <tr class="search-items">
                                  <td>
                                    <?=sprintf('%04d',$day['application_id'])?>

                                  </td>
                                  
                                  <td>
                                    <?=$day['name']?>
                                  </td>                                
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <div class="ms-3">
                                        <div class="user-meta-info">
                                          <h6 class="user-name mb-0" data-name=""><?=$day['leave_days']?></h6>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <div class="ms-3">
                                        <div class="user-meta-info">
                                          <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_start'])?></h6>
                                           <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_end'])?></h6>
                                        </div>
                                      </div>
                                    </div>
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
                                          <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($day['date_requested'])?></h6>
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
                                        <?php if($day['leave_status'] == 0){ ?>
                                        <button class="btn btn-sm btn-danger btn-sm btn_delete_leave" data-id3="<?=$day['application_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                          <i class="ti ti-trash fs-4"></i>
                                        </button>
                                        <?php }else{ ?>
                                        <button class="btn btn-sm btn-danger btn-sm btn_day_delete" data-id3="<?=$day['application_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" disabled>
                                          <i class="ti ti-trash fs-4"></i>
                                        </button>  
                                        <?php } ?>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Leave Application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/leave-menu.php'); ?>
    </div>
  </div>
</div>