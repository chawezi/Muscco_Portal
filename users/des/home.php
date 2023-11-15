<div class="row">
  <div class="col-12">
    
    <div class="d-flex align-items-center gap-4 mb-4">
      <div class="position-relative">
        <div class="">
          <i class="ti ti-user-circle text-primary" class="rounded-circle m-1" style="font-size: 3em;"></i>
        </div>
        
      </div>
      <div>
        <h3 class="fw-semibold">Hi, <span class="text-dark"><?=$_SESSION['USR_NME']?></span>
        </h3>
        <span>Cheers, and happy activities - <?=date('M d Y')?></span>
      </div>
    </div>    
  </div>
  <div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Follow Your Fellow DEs</h5>
          <p class="card-subtitle">Below is a list of registered DEs</p>
          <div class="overflow-auto mt-4" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: scroll hidden;"><div class="simplebar-content" style="padding: 0px;">
            <div class="hstack gap-9">
              <?php 
                $users = $con->getRows('des', array('order_by'=>'first_name'));
                if(!empty($users)){
                  $thumb = 'default.jpg';
                  foreach ($users as $user) {
                    if(!empty($user['profile_pic'])){
                      $thumb = $user['profile_pic'];
                    }
                    ?>
              <a href="dashboard.php?page=registered_des&user_id=<?=$user['de_id']?>" class="text-center flex-shrink-0 ">
                <div class="border border-2 border-primary rounded-circle hover-img">
                  <img src="../../uploads/profiles/<?=$thumb?>" class="rounded-circle img-fluid m-1"  width="55">
                </div>
                <span class="d-block fs-3 mt-1  text-dark"><?=ucwords($user['first_name'])." ".ucwords($user['last_name'])?></span>
              </a>
              <?php }
                }
              ?>
            </div>
          </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 92px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: visible;"><div class="simplebar-scrollbar" style="width: 46px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div>
        </div>
      </div>           
    </div>
    <!-- music sidebar -->
    <div class="col-xl-4">
      <div class="row">
        <div class="col-sm-6 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <div class="p-2 rounded-2 d-inline-block mb-3">
                <img src="http://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-briefcase.svg" width="50" height="50"  alt="">
              </div>
              
              <h4 class="mb-1 fw-semibold d-flex align-content-center"> <?php $documents = $con->getRows('documents', array('where'=>'access_rights=2','return_type'=>'count')); echo $documents?$documents:0;  ?></h4>
              <p class="mb-0">Documents</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <div class="p-2 rounded-2 d-inline-block mb-3">
               <img src="http://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-favorites.svg" width="50" height="50"  alt="">
              </div>
              
              <h4 class="mb-1 fw-semibold d-flex align-content-center"><?php $events = $con->getRows('events', array('where'=>'event_permision=2 and event_status=0','return_type'=>'count')); echo $events?$events:0;  ?></h4>
              <p class="mb-0">Upcoming Events</p>
            </div>
          </div>
        </div>
      </div>           
    </div>
  </div>
</div>