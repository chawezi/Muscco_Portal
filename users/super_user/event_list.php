<div class="container-fluid">
  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Events</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item" aria-current="page">Events</li>
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

  <div id="err"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
              <i class="ti ti-calendar me-2 fs-6"></i>
              <span class="d-none d-md-block">Upcoming Events</span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
              <i class="ti ti-calendar-check me-2 fs-6"></i>
              <span class="d-none d-md-block">Past Events</span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab" aria-controls="pills-bills" aria-selected="false">
              <i class="ti ti-calendar-cancel me-2 fs-6"></i>
              <span class="d-none d-md-block">Cancelled Events</span> 
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
              <i class="ti ti-calendar-plus me-2 fs-6"></i>
              <span class="d-none d-md-block">Add Event</span> 
            </button>
          </li>
        </ul>
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
              <div class="row">
                <div class="table-responsive" width="100%">
                  <h4 class="fw-semibold mb-3">Upcoming Events</h4>
                  <table id="zero_config" class="table search-table align-middle dataTable">
                    <thead class="header-item">
                      <th>
                        #
                      </th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $events = $con->getRows('events', array('where'=>'event_status=0','order_by'=>'date_posted desc'));
                        if(!empty($events)){
                          $i=0;
                          foreach($events as $event){ 
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
                                      <h6 class="user-name mb-0" data-name=""><?=ucwords($event['event_title'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['venue']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr"><?=ucwords($event['event_description'])?></span>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($event['date_from'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['time_from']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($event['date_to'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['time_to']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                                     <a href="dashboard.php?page=event_details&event_id=<?=$event['event_id']?>"  class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Event Details">
                                      <i class="ti ti-pencil fs-4"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn_event_delete" data-id3="<?=$event['event_id']?>" data-file="<?=$event['event_attachment']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
            <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
              <div class="row justify-content-center">
                <div class="table-responsive" width="100%">
                  <h4 class="fw-semibold mb-3">Past Events</h4>
                  <table id="multi_col_order" class="table search-table align-middle dataTable">
                    <thead class="header-item">
                      <th>
                        #
                      </th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $events = $con->getRows('events', array('where'=>'event_status=1','order_by'=>'date_posted desc'));
                        if(!empty($events)){
                          $i=0;
                          foreach($events as $event){ 
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
                                      <h6 class="user-name mb-0" data-name=""><?=ucwords($event['event_title'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['venue']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr"><?=ucwords($event['event_description'])?></span>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($event['date_from'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['time_from']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($event['date_to'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['time_to']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                                    <button class="btn btn-sm btn-danger btn_event_delete" data-id3="<?=$event['event_id']?>" data-file="<?=$event['event_attachment']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
            <div class="tab-pane fade" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
              <div class="row justify-content-center">
                <div class="table-responsive" width="100%">
                  <h4 class="fw-semibold mb-3">Cancelled Events</h4>
                  <table id="default_order" class="table search-table align-middle dataTable">
                    <thead class="header-item">
                      <th>
                        #
                      </th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $events = $con->getRows('events', array('where'=>'event_status=2','order_by'=>'date_posted desc'));
                        if(!empty($events)){
                          $i=0;
                          foreach($events as $event){ 
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
                                      <h6 class="user-name mb-0" data-name=""><?=ucwords($event['event_title'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['venue']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="usr-email-addr"><?=ucwords($event['event_description'])?></span>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($event['date_from'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['time_from']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($event['date_to'])?></h6>
                                      <span class="user-work fs-3" data-occupation=""><?=$event['time_to']?></span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                                    <button class="btn btn-sm btn-danger btn_event_delete" data-id3="<?=$event['event_id']?>" data-file="<?=$event['event_attachment']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
            <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body p-4">
                      <h4 class="fw-semibold mb-3">Add Event</h4>
                      <div id="error"></div>
                      <form id="add-event" method="post" action="" enctype="multipart/form-data">                            
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Event Title</label>
                              <input type="text" class="form-control" name="title">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Venue</label>
                              <input type="text" class="form-control" name="venue">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Attachment</label>
                              <input type="file" class="form-control" name="file">
                            </div>
                            <div class="mb-4">
                              <label>Access Rights</label>
                              <select class="form-control form-select" name="access_rights" tabindex="1">
                                <option value="">Select who should see this event </option>                                
                                <option value="0">Muscco Staff Only</option>                                
                                <option value="1">Muscco Staff & Sacco Members</option>                                
                                <option value="2">Muscco Staff, Sacco Members & DE's</option>                                
                              </select>
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Description</label>
                              <textarea class="form-control" rows="3" name="description"></textarea>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Date From</label>
                              <input type="date" class="form-control" name="date_from">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Time From</label>
                              <input type="time" class="form-control" name="time_from">
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Date To</label>
                              <input type="date" class="form-control" name="date_to">
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Time To</label>
                              <input type="time" class="form-control" name="time_to">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-3">
                              <button type="submit" name="add_event" id="add_event"  class="btn btn-primary ">Save Event</button>
                            </div>
                          </div>
                        </div>
                      </form>
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
<script type="text/javascript">
  function getPendinginvoices(){
    let action = "get_pending_invoices";
    $.ajax({
        url:"get_invoices_data.php",
        method:"POST",
        data:{action:action},
        success:function(data){ 
            $('#show_pending_invoices').html(data);
        }
    });
  }
  getPendinginvoices();
</script>