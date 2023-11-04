<?php
  $fy = $con->getRows('leave_fy', array('where'=>'fy_status=0','order_by'=>'fy_id desc', 'return_type'=>'single'));
  $current_yr = $fy['fy'];

?>

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Leave Application</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Leave Entitlement</li>
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
                <h5 class="text-dark mb-0 fw-semibold">Leave Entitlement - <?=$current_yr?></h5>
                
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="row">
                      <div class="card shadow-none mb-0 mt-3">
                        <table class="table border table-striped table-bordered">
                          <thead class="header-item">
                            <th>
                              #
                            </th>
                            <th>Leave Type</th>
                            <th>Days Entitled</th>
                            <th>Days Taken</th>
                            <th>Days Remaining</th>
                          </thead>
                          <tbody>
                            <?php $types = $con->getRows('leave_types a, leave_days b', array('where'=>'a.type_id=b.leave_id and b.user_id="'.$_SESSION['USR_ID'].'" and b.fy_id="'.$fy['fy_id'].'"','order_by'=>'b.record_id'));
                            if(!empty($types)){
                              $i=0;
                              foreach ($types as $type) { $i++; ?>
                                <tr>
                                <td>
                                  <?=$i?>
                                </td>
                                <td>
                                  <?=$type['name']?>
                                </td>
                                <td>
                                  <?=$type['days_entitled']?>
                                </td>
                                <td>
                                  <?=$type['days_taken']?>
                                </td>
                                <td>
                                  <?=$type['days_remaining']?>
                                </td>
                              </tr>
                                <?php    }
                            }else{
                              echo'<tr><td colspan="3"><div class="alert alert-warning"> There are no records of this employee entitlement. </div></td></tr>';
                            }
                            ?>
                            
                            <!-- end row -->
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

<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  function getDays(){
    let action = "get_days";
    let id = "<?=$member_id?>";
    $.ajax({
        url:"get_leave_data.php",
        method:"GET",
        data:{action:action, id:id},
        success:function(data){ 
            $('#show_leave_types').html(data);
        }
    });
  }
  getDays();
</script>