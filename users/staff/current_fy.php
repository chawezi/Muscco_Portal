<?php
  $fy = $con->getRows('leave_fy', array('where'=>'fy_status=0','order_by'=>'fy_id desc', 'return_type'=>'single'));
  $current_yr = $fy['fy'];


?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Admin Settings</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Current Financial  Year</li>
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
      <?php include_once('../../layout/admin.php') ?>
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Current Financial Year - <?=$current_yr?></h5>
                
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                    
                    <button class="btn btn-sm btn-primary btn-sm update_fy" data-id3="<?=$current_yr?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Udate FY">
                      <i class="ti ti-calendar-plus fs-4"></i> Update FY
                    </button>
                    <button class="btn btn-sm btn-info btn-sm btn_delete_leave" data-id3="<?=$day['application_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Holidays">
                      <i class="ti ti-download fs-4"></i> Holidays
                    </button>
                  </div>
                  
                </div>
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
                                <input type="text" class="form-control" name="holiday" placeholder="Public Holiday">
                              </div>
                              <div class="col-md-6">
                                <input type="date" class="form-control" name="date" placeholder="Date">
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="d-flex align-items-center justify-content-end gap-3"> 
                              <input type="hidden" name="fy" value="<?=$fy['fy_id']?>">                                     
                              <button type="submit" name="add_holiday" id="add_leave" class="btn btn-primary">Save Holiday</button>                              
                            </div>
                          </div>
                        </div>
                      </form>
                      <div id="show_leave_types"></div>
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

<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  function getHolidays(){
    let action = "get_holidays";
    let id = "<?=$fy['fy_id']?>"
    $.ajax({
        url:"get_leave_data.php",
        method:"GET",
        data:{action:action, id:id},
        success:function(data){ 
            $('#show_leave_types').html(data);
        }
    });
  }
  getHolidays();
</script>