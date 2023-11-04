<div class="row">
  <div class="col-12">
    
    <div class="d-flex align-items-center gap-4 mb-4">
      <div class="position-relative">
        <div class="">
          <i class="ti ti-user-circle text-primary" class="rounded-circle m-1" style="font-size: 3em;"></i>
        </div>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"> 0 <span class="visually-hidden">unread messages</span>
        </span>
      </div>
      <div>
        <h3 class="fw-semibold">Hi, <span class="text-dark"><?=$_SESSION['USR_NME']?></span>
        </h3>
        <span>Cheers, and happy activities - <?=date('M d Y')?></span>
      </div>
    </div>
    <div class="card w-100 bg-light-info overflow-hidden shadow-none">
      <div class="card-body py-3">
        <div class="row justify-content-between align-items-center">
          <div class="col-sm-7">
            <h5 class="fw-semibold mb-9 fs-5">Hey <?=$_SESSION['USR_NME']?>!</h5>
            <p class="mb-9">
              <?php $sacco  = $con->getRows('sacco', array('where'=>'sacco_id="'.$_SESSION['USR_OF'].'"','return_type'=>'single')); ?>
              You represent <b><?=$sacco['sacco_name']?></b>, if you experience any problem dont hesitate to contact our helpdesk by creating a ticket outlining your issue.
            </p>
            <a href="dashboard.php?page=help_desk" class="btn btn-primary">Contact Helpdesk</a>
          </div>
          <div class="col-sm-5">
            <div class="position-relative mb-n7 text-end">
              <img src="../../dist/images/backgrounds/welcome-bg2.png" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>