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
        <h4 class="fw-semibold mb-8">Registered DEs</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Registered DEs</li>
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
          <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
            <h5 class="text-dark mb-0 fw-semibold">Registered DEs</h5>
            
          </div>
          <div class="app-chat">
            <ul class="chat-users" style="height: calc(150vh - 400px)" data-simplebar>
              <?php 
                $users = $con->getRows('des', array('order_by'=>'first_name'));
                if(!empty($users)){
                  $thumb = 'default.jpg';
                  foreach ($users as $user) {
                    if(!empty($user['profile_pic'])){
                      $thumb = $user['profile_pic'];
                    }
                    ?>

                    <li>
                      <a href="dashboard.php?page=registered_des&user_id=<?=$user['de_id']?>" class="px-4 py-3 bg-hover-light-black d-flex align-items-center chat-user" id="chat_user_1" data-user-id="1">
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
                        $user = $con->getRows('des a, sacco b', array('where'=>'a.sponsored_by=b.sacco_id and de_id="'.$staff_id.'"', 'return_type'=>'single'));
                      }else{
                        $user = $con->getRows('des a, sacco b', array('where'=>'a.sponsored_by=b.sacco_id', 'order_by'=>'first_name', 'return_type'=>'single'));
                      }

                      if(!empty($user['profile_pic'])){
                        $thumb = $user['profile_pic'];
                      }
                    ?>
                    <div class="chat-list chat active-chat" data-user-id="1">
                      <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                          <img src="../../uploads/profiles/<?=$thumb?>" alt="user4" width="72" height="72" class="rounded-circle" />
                          <div>
                            <h6 class="fw-semibold fs-4 mb-0"><?=ucwords($user['first_name'])." ".ucwords($user['last_name'])?></h6>
                            <p class="mb-0"><?=$user['current_job']?></p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4 mb-7">
                          <p class="mb-1 fs-2">Phone number</p>
                          <h6 class="fw-semibold mb-0"><?=$user['phone_number']?></h6>
                        </div>
                        <div class="col-4 mb-7">
                          <p class="mb-1 fs-2">Email address</p>
                          <h6 class="fw-semibold mb-0"><?=$user['email_address']?></h6>
                        </div>
                        <div class="col-4 mb-7">
                          <p class="mb-1 fs-2">Date Graduated</p>
                          <h6 class="fw-semibold mb-0"><?=$con->shortDate($user['graduation_date'])?></h6>
                        </div>
                        <div class="col-4 mb-7">
                          <p class="mb-1 fs-2">Current Location</p>
                          <h6 class="fw-semibold mb-0"><?=$user['location']?></h6>
                        </div>
                        <div class="col-8 mb-7">
                          <p class="mb-1 fs-2">Sponsored By</p>
                          <h6 class="fw-semibold mb-0"><?=$user['sacco_name']?></h6>
                        </div>
                      </div>
                      <div class="border-bottom pb-7 mb-4">
                        <p class="mb-2 fs-2">Project/Research Undertook</p>
                        <p class="mb-3 text-dark"> 
                          <?=$user['project']?>
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
  </div>
</div>


<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>