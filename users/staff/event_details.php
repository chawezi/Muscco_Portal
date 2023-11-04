<?php
  $event_id = '';
  $event_status = '';
  if(isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];
  }

  $event = $con->getRows('events', array('where'=>'event_id="'.$event_id.'"', 'return_type'=>'single'));
  if($event['event_status'] == 0){
    $event_status = $event['event_status'];
  }
?>
<div class="container-fluid">
  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Events</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item" aria-current="page">Event Details</li>
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
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab- show active fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
              <div class="row">
                <div class="col-12">
                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                      <?php if($event_status == 0){ ?>
                      <button class="btn btn-success btn_event_complete" data-id3="<?=$event['event_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Completed">
                        <i class="ti ti-circle-check fs-4"></i> Complete
                      </button>
                      <button  class="btn btn-primary btn_event_cancel" data-id3="<?=$event['event_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancelled">
                        <i class="ti ti-circle-x fs-4"></i> Cancel Event
                      </button>
                      <?php } ?>
                      <button class="btn btn-sm btn-danger btn_event_delete" data-id3="<?=$event['event_id']?>" data-file="<?=$event['event_attachment']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                        <i class="ti ti-trash fs-4"></i> Delete Event
                      </button>
                      <?php if(!empty($event['event_attachment'])){ ?>
                      <a href="../../uploads/event/<?=$event['event_attachment']?>" target="_blank"  class="btn btn-primary btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancelled">
                        <i class="ti ti-download fs-4"></i> Download Attachment
                      </a> 
                      <?php } ?>
                    </div>
                    
                  </div>
                  <div class="card">
                    <div class="card-body p-4">

                      <h4 class="fw-semibold mb-3">Update Event</h4>
                      <div id="error"></div>
                      <?php if(!empty($event)){ ?>
                      <form id="add-event" method="post" action="" enctype="multipart/form-data">                            
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Event Title</label>
                              <input type="text" class="form-control" name="title" value="<?=$event['event_title'];?>">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Venue</label>
                              <input type="text" class="form-control" name="venue" value="<?=$event['venue'];?>">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Attachment</label>
                              <input type="file" class="form-control" name="file">
                            </div>
                            <div class="mb-4">
                              <label>Access Rights</label>
                              <select class="form-control form-select" name="access_rights" tabindex="1">
                                <option value="">Select who should see this event </option>                                
                                <option value="0" <?php if($event['event_permision'] == '0'){echo "selected";}?>>Muscco Staff Only</option>                                
                                <option value="1" <?php if($event['event_permision'] == '1'){echo "selected";}?>>Muscco Staff & Sacco Members</option>                                
                                <option value="2" <?php if($event['event_permision'] == '2'){echo "selected";}?>>Muscco Staff, Sacco Members & DE's</option>                                
                              </select>
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Description</label>
                              <textarea class="form-control" rows="3" name="description"><?=$event['event_description']?></textarea>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Date From</label>
                              <input type="date" class="form-control" name="date_from" value="<?=$event['date_from']?>">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Time From</label>
                              <input type="time" class="form-control" name="time_from" value="<?=$event['time_from']?>">
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Date To</label>
                              <input type="date" class="form-control" name="date_to" value="<?=$event['date_to']?>">
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Time To</label>
                              <input type="time" class="form-control" name="time_to" value="<?=$event['time_to']?>">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-3">
                              <input type="hidden" name="event_id" value="<?=$event_id?>">
                              <input type="hidden" name="attachment" value="<?=$event['event_attachment']?>">
                              <button type="submit" name="update_event" id="add_event"  class="btn btn-primary">Save Event</button>
                            </div>
                          </div>
                        </div>
                      </form>
                      <?php }else{ ?>
                      <div class="alert alert-danger"> Sorry, the event details can not be found in the database.</div>
                      <?php } ?>
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