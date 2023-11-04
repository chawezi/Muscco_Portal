<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">System Notifications</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Notifications</li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          <div class="text-center mb-n5">  
            <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-content">
    <div id="note-full-container" class="note-has-grid row">
      <div class="col-md-12 single-note-item all-category note-social">
        <div class="card card-body">
          <div class="table-responsive">
            <div id="error"></div>
            <table id="zero_config" class="table search-table align-middle dataTable">
              <thead class="header-item">
                <th>
                  #
                </th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                  $notifications = $con->getRows('notifications', array('where'=>'received_by="'.$_SESSION['USR_ID'].'"','order_by'=>'date desc'));
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
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="usr-email-addr"><?=$note['message']?></span>
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
                        <td>
                          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                              <button  class="btn btn-primary btn-sm btn_delete_notification" data-id3="<?=$note['notification_id']?>" >
                                <i class="ti ti-trash fs-4"></i> 
                              </button>
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
