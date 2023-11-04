<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Manage Employees</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Employees List</li>
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
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">All MUSCCO EMPLOYEES</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive">
                      <div id="err"></div>
                    <table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
                      <thead class="header-item">
                        <th>
                          #
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                          $members = $con->getRows('muscco_members a, positions b, departments c, system_users d', 
                                   array('where'=>'a.position_id=b.position_id and a.department_id=c.department_id and a.muscco_member_id=d.member_id and d.member_id != "'.$_SESSION['USR_ID'].'"','order_by'=>'first_name asc'));
                          if(!empty($members)){
                            $i=0;
                            foreach($members as $member){ 
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
                                        <h6 class="user-name mb-0" data-name="Emma Adams"><?=ucwords($member['first_name'])." ".ucwords($member['last_name'])?></h6>
                                        <span class="user-work fs-3" data-occupation="Web Developer"><?=$member['position']?></span>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <span class="usr-email-addr"><?=$member['email_address']?></span>
                                </td>
                                <td>
                                  <span class="usr-location"><?=$member['phone_number']?></span>
                                </td>
                                <td>
                                  <span class="usr-ph-no" ><?=$member['department']?></span>
                                </td>
                                <td>
                                  <span class="usr-ph-no" >
                                    <?php 
                                      switch ($member['account_status']) {
                                        case 0:
                                          echo'<span class="mb-1 badge rounded-pill bg-primary">Active</span>';
                                          break;
                                        case 1:
                                          echo'<span class="mb-1 badge rounded-pill bg-success">Active</span>';
                                          break;
                                        case 2:
                                          echo'<span class="mb-1 badge rounded-pill bg-danger">Inactive</span>';
                                          break;
                                        
                                        case 3:
                                          echo'<span class="mb-1 badge rounded-pill bg-warming">Blocked</span>';
                                          break;
                                      }
                                    ?>
                                      
                                    </span>
                                </td>
                                <td>
                                  <div class="action-btn">
                                    <a href="dashboard.php?page=staff_details&staff_id=<?=$member['member_id']?>" class="btn btn-primary btn-sm  ms-2" title="View">
                                      <i class="ti ti-eye fs-5"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm delete_staff ms-2" data-id3="<?=$member['member_id']?>" title="Delete">
                                      <i class="ti ti-trash fs-5"></i>
                                    </button>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Help Desk </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/admin.php'); ?>
      
    </div>
  </div>
</div>