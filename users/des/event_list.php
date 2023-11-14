<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Events</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
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

  <div class="tab-content">
    <div id="note-full-container" class="note-has-grid row">
      <div class="col-md-12 single-note-item all-category note-social">
        <div class="card card-body">
          <div class="table-responsive">
            <table id="zero_config" class="table search-table align-middle dataTable">
            <thead class="header-item">
              <th>
                #
              </th>
              <th>Event Title & Venue</th>
              <th>Description</th>
              <th>From</th>
              <th>To</th>
              <th>Status</th>
              <th>Attachment</th>
            </thead>
            <tbody>
              <?php
                $events = $con->getRows('events', array('where'=>'event_permision=2','order_by'=>'event_status asc'));
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
                        <?php 
                          switch ($event['event_status']) {
                            case 0:
                              echo'<span class="mb-1 badge rounded-pill bg-primary">Upcoming</span>';
                              break;
                            case 1:
                              echo'<span class="mb-1 badge rounded-pill bg-success">Completed</span>';
                              break;
                            case 2:
                              echo'<span class="mb-1 badge rounded-pill bg-danger">Cancelled</span>';
                              break;
                          }
                        ?>
                      </td>
                      <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                            <?php if(!empty($event['event_attachment'])){?>
                            <a href="download-file.php?dir=../../uploads/event/&file=<?=$event['event_attachment']?>"  class="btn btn-primary btn-sm" data-id3="<?=$event['event_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Attachment">
                              <i class="ti ti-download fs-4"></i>
                            </a>
                            <?php }else{ ?>
                            <button  class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="No Attachment">
                              <i class="ti ti-download-off fs-4"></i> 
                            </button>
                            <?php } ?>
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

    	<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript">
        	function getUsers(){
        		let action = "get_staff";
			    $.ajax({
		          url:"get_user_data.php",
		          method:"POST",
		          data:{action:action},
		          success:function(data){ 
		              $('#show_all_users').html(data);
		          }
			    });
        	}
        	getUsers();
        </script>