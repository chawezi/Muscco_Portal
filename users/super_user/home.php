<div class="row">
  <div class="col-12">
    
    <div class="d-flex align-items-center gap-4 mb-4">
      <div class="position-relative">
        <div class="">
          <i class="ti ti-user-circle text-primary" class="rounded-circle m-1" style="font-size: 3em;"></i>
        </div>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"> <?php $notifications = $con->getRows('notifications', array('where'=>'received_by="'.$_SESSION['USR_ID'].'"','return_type'=>'count')); echo $notifications?$notifications:0;  ?> <span class="visually-hidden">unread messages</span>
        </span>
      </div>
      <div>
        <h3 class="fw-semibold">Hi, <span class="text-dark"><?=$_SESSION['USR_NME']?></span>
        </h3>
        <span>Cheers, and happy activities - <?=date('M d Y')?></span>
      </div>
    </div>
    <div class="owl-carousel counter-carousel owl-theme">
            <div class="item">
              <div class="card border-0 zoom-in bg-light-primary shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <i class="ti ti-archive text-primary fs-6"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> SACCOs </p>
                    <h5 class="fw-semibold text-primary mb-0">
                      <?php $saccos = $con->getRows('sacco', array('return_type'=>'count')); echo $saccos?$saccos:0;  ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <i class="ti ti-file-invoice text-warning fs-6"></i>
                    <p class="fw-semibold fs-3 text-warning mb-1">Invoices</p>
                    <h5 class="fw-semibold text-warning mb-0">
                      <?php $invoices = $con->getRows('invoices', array('return_type'=>'count')); echo $invoices?$invoices:0;  ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <i class="ti ti-calendar text-info fs-6"></i>
                    <p class="fw-semibold fs-3 text-info mb-1">Events</p>
                    <h5 class="fw-semibold text-info mb-0">
                      <?php $events = $con->getRows('events', array('return_type'=>'count')); echo $events?$events:0;  ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-danger shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <i class="ti ti-info-circle text-danger fs-6"></i>
                    <p class="fw-semibold fs-3 text-danger mb-1">FAQs</p>
                    <h5 class="fw-semibold text-danger mb-0">
                      <?php $faqs = $con->getRows('faqs', array('return_type'=>'count')); echo $faqs?$faqs:0;  ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-success shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <i class="ti ti-bell-ringing text-success fs-6"></i>
                    <p class="fw-semibold fs-3 text-success mb-1">Notifications</p>
                    <h5 class="fw-semibold text-success mb-0">
                      <?php $notifications = $con->getRows('notifications', array('return_type'=>'count')); echo $notifications?$notifications:0;  ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <i class="ti ti-download text-info fs-6"></i>
                    <p class="fw-semibold fs-3 text-info mb-1">Documents</p>
                    <h5 class="fw-semibold text-info mb-0">
                      <?php $documents = $con->getRows('documents', array('return_type'=>'count')); echo $documents?$documents:0;  ?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
  </div>
  <div class="card w-100 bg-light-info overflow-hidden shadow-none">
      <div class="card-body py-3">
        <div class="row justify-content-between align-items-center">
          <div class="col-sm-7">
            <p class="mb-9">
              As the system administrator, keep on checking for new helpdesk tickets.
            </p>
            <a href="dashboard.php?page=help_desk" class="btn btn-primary">Check Helpdesk</a>
          </div>
          <div class="col-sm-5">
            <div class="position-relative mb-n7 text-end">
              <img src="../../dist/images/backgrounds/welcome-bg2.png" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="col-lg-5">
    <div class="card w-100">
      <div class="card-body">
        <h5 class="card-title fw-semibold">Discussion Topics</h5>
        <p class="card-subtitle">Recent topics posted for discussions.</p>
        <?php 
          $discussions = $con->getRows('discussions', array('order_by'=>'date_posted desc', 'limit'=>'3')); 
          if(!empty($discussions)){
            foreach ($discussions as $dis) { ?>
              <div class="mt-4 pb-3 border-bottom">
                <div class="d-flex align-items-center">
                  <span class="fs-3 ms-auto"><?=$con->shortDate($dis['date_posted'])?></span>
                </div>
                <h6 class="mt-3"><?=$dis['topic']?></h6>
                <span class="fs-3 lh-sm"><?=$dis['description']?></span>
                <div class="hstack gap-3 mt-3">
                  <a href="dashboard.php?page=open_topic&topic_id=<?=$dis['topic_id']?>" class="fs-3 text-bodycolor d-flex align-items-center">
                    <i class="ti ti-message-dots fs-6 text-primary me-2 d-flex"></i> 
                    <?php $replies = $con->getRows('discussion_replies', array('where'=>'topic_id="'.$dis['topic_id'].'"','return_type'=>'count')); echo $replies?$replies:0;  ?> Commets </a>
                </div>
              </div>
        <?php }
          }
        ?>
        

      </div>
    </div>
  </div>
  <div class="col-lg-7 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">System Notifications</h5>
            <p class="card-subtitle mb-0">Notifications generated by the system</p>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
              <thead class="header-item">
                <th>
                  #
                </th>
                <th>Subject & Message</th>
                <th>Date</th>
              </thead>
              <tbody>
                <?php
                  $notifications = $con->getRows('notifications', array('where'=>'received_by="'.$_SESSION['USR_ID'].'"','order_by'=>'date desc', 'limit'=>'5'));
                  if(!empty($notifications)){
                    $i=0;
                    foreach($notifications as $note){ 
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
                                <h6 class="user-name mb-0" data-name=""><?=$note['subject']?></h6>
                                <span class="usr-email-addr"><?=$note['message']?></span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($note['date'])?></h6>
                              </div>
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