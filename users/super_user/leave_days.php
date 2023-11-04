<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Leave Application</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Leave Types</li>
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
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Leave Types</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card-body p-4">
                      <div id="product_response"></div>
                      <form id="leave-type" method="post">
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="row">
                              <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Enter Leave Type">
                              </div>
                              <div class="col-md-6">
                                <input type="text" class="form-control" name="desc" placeholder="Enter Description">
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="d-flex align-items-center justify-content-end gap-3">                                      
                              <button type="submit" name="add_leave" id="add_leave" class="btn btn-primary">Add Leave Type</button>                              
                            </div>
                          </div>
                        </div>
                      </form>
                      <div class="table-responsive">
                        <div id="show_leave_types"></div>
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

<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  function getLeave(){
    let action = "get_leave_days";
    $.ajax({
        url:"get_leave_data.php",
        method:"GET",
        data:{action:action},
        success:function(data){ 
            $('#show_leave_types').html(data);
        }
    });
  }
  getLeave();
</script>