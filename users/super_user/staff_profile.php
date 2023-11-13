<?php
  $staff_id = '';
  if(isset($_GET['user_id'])){
    $staff_id = $_GET['user_id'];
  }
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Staff Profiles</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Staff Profiles</li>
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
<div class="card overflow-hidden chat-application">
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
    <div class="d-flex w-100">
      <div class="min-width-340">
        <div class="border-end user-chat-box h-100">
          <div class="px-4 pt-9 pb-6 d-none d-lg-block">
            <form class="position-relative">
              <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search" />
              <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
          </div>
          <div class="app-chat">
            <ul class="chat-users" style="height: calc(150vh - 400px)" data-simplebar>
              <?php 
                $users = $con->getRows('muscco_members', array('order_by'=>'first_name'));
                if(!empty($users)){
                  $thumb = 'default.jpg';
                  foreach ($users as $user) {
                    if(!empty($user['thumb'])){
                      $thumb = $user['thumb'];
                    }
                    ?>

                    <li>
                      <a href="dashboard.php?page=staff_profile&user_id=<?=$user['muscco_member_id']?>" class="px-4 py-3 bg-hover-light-black d-flex align-items-center chat-user" id="chat_user_1" data-user-id="1">
                        <span class="position-relative">
                          <img src="../../uploads/profiles/<?=$thumb?>" alt="user-4" width="40" height="40" class="rounded-circle">
                        </span>
                        <div class="ms-6 d-inline-block w-75">
                          <h6 class="mb-1 fw-semibold chat-title" data-username="<?=ucwords($user['first_name'])." ".ucwords($user['last_name'])?>"><?=ucwords($user['first_name'])." ".ucwords($user['last_name'])?></h6>
                          <span class="fs-2 text-body-color d-block"><?=$user['email_address']?></span>
                        </div>
                      </a>
                    </li>
                    
              <?php }
                }
              ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Staff Profile Details</h5>
                
              </div>
              <div class="position-relative overflow-hidden">
                <div class="position-relative">
                  <div class="chat-box p-9" style="height: calc(150vh - 428px)" data-simplebar>
                    <?php
                      $user = '';
                      $thumb = 'default.jpg';
                      //echo $staff_id;
                      if(!empty($staff_id)){
                        $user = $con->getRows('muscco_members a, positions b, branches c', array('where'=>'a.muscco_member_id="'.$staff_id.'" and a.position_id=b.position_id and a.branch=c.branch_id', 'return_type'=>'single'));
                      }else{
                        $user = $con->getRows('muscco_members a, positions b, branches c', array('where'=>'a.position_id=b.position_id and a.branch=c.branch_id','order_by'=>'muscco_id', 'return_type'=>'single'));
                      }

                      if(!empty($user['thumb'])){
                        $thumb = $user['thumb'];
                      }
                    ?>
                    <div class="chat-list chat active-chat" data-user-id="1">
                      <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                          <img src="../../uploads/profiles/<?=$thumb?>" alt="user4" width="72" height="72" class="rounded-circle" />
                          <div>
                            <h6 class="fw-semibold fs-4 mb-0"><?=ucwords($user['first_name'])." ".ucwords($user['last_name'])?></h6>
                            <p class="mb-0"><?=$user['position']?></p>
                            <p class="mb-0">MUSCCO</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4 mb-7">
                          <p class="mb-1 fs-2">Phone number</p>
                          <h6 class="fw-semibold mb-0"><?=$user['phone_number']?></h6>
                        </div>
                        <div class="col-8 mb-7">
                          <p class="mb-1 fs-2">Email address</p>
                          <h6 class="fw-semibold mb-0"><?=$user['email_address']?></h6>
                        </div>
                        <div class="col-4 mb-7">
                          <p class="mb-1 fs-2">Date Joined</p>
                          <h6 class="fw-semibold mb-0"><?=$con->shortDate($user['join_date'])?></h6>
                        </div>
                        <div class="col-8 mb-7">
                          <p class="mb-1 fs-2">Branch</p>
                          <h6 class="fw-semibold mb-0"><?=$user['branch_name']?></h6>
                        </div>
                      </div>
                      <div class="border-bottom pb-7 mb-4">
                        <p class="mb-2 fs-2">Profile Summary</p>
                        <p class="mb-3 text-dark"> 
                          <?=$user['profile']?>
                        </p>
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Contact </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="px-9 pt-4 pb-3">
        <button class="btn btn-primary fw-semibold py-8 w-100">Add New Contact</button>
      </div>
      <ul class="list-group" style="height: calc(100vh - 150px)" data-simplebar>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
            <i class="ti ti-inbox fs-5"></i>All Contacts </a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
            <i class="ti ti-star"></i>Starred </a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
            <i class="ti ti-file-text fs-5"></i>Pening Approval </a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
            <i class="ti ti-alert-circle"></i>Blocked </a>
        </li>
        <li class="border-bottom my-3"></li>
        <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">CATEGORIES</li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
            <i class="ti ti-bookmark fs-5 text-primary"></i>Engineers </a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
            <i class="ti ti-bookmark fs-5 text-warning"></i>Support Staff </a>
        </li>
        <li class="list-group-item border-0 p-0 mx-9">
          <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)">
            <i class="ti ti-bookmark fs-5 text-success"></i>Sales Team </a>
        </li>
      </ul>
    </div>
  </div>
</div>


<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>