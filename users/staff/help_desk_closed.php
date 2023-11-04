<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Help Desk</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Help Desk</li>
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
      <?php include_once('../../layout/tickets.php'); ?>      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Closed TICKETS</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                      <div id="err"></div>
                    <table id="scroll_hor" class="table border table-striped table-bordered display nowrap dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
                      <thead class="header-item">
                        <th>
                          #
                        </th>
                        <th>Title & Product</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Date Opened</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                          $tickets = $con->getRows('tickets a, products b', array('where'=>'a.ticket_product=b.product_id and a.member_of="'.$_SESSION['USR_OF'].'" and a.ticket_status=1','order_by'=>'date_opened desc'));
                          if(!empty($tickets)){
                            $i=0;
                            foreach($tickets as $ticket){ 
                              $i++;
                        ?>
                              <tr class="search-items">
                                <td>
                                  <?=sprintf('%04d',$ticket['ticket_id'])?>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?=ucwords($ticket['ticket_title'])?></h6>
                                        <span class="user-work fs-3" data-occupation=""><?=$ticket['product']?></span>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <?php 
                                    switch ($ticket['ticket_priority']) {
                                      case 1:
                                        echo'<span class="mb-1 badge rounded-pill bg-danger">Critical</span>';
                                        break;
                                      case 2:
                                        echo'<span class="mb-1 badge rounded-pill bg-warning">High</span>';
                                        break;
                                      case 3:
                                        echo'<span class="mb-1 badge rounded-pill bg-primary">Intermedian</span>';
                                        break;
                                      
                                      case 4:
                                        echo'<span class="mb-1 badge rounded-pill bg-info">Blocked</span>';
                                        break;

                                      case 4:
                                        echo'<span class="mb-1 badge rounded-pill bg-info">Blocked</span>';
                                        break;
                                    }
                                  ?>
                                </td>
                                <td>
                                  <?php 
                                    switch ($ticket['ticket_status']) {
                                      case 0:
                                        echo'<span class="mb-1 badge rounded-pill bg-primary">Open</span>';
                                        break;
                                      case 1:
                                        echo'<span class="mb-1 badge rounded-pill bg-success">Closed</span>';
                                        break;
                                    }
                                  ?>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                      <div class="user-meta-info">
                                        <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($ticket['date_opened'])?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                
                                <td>
                                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
                                      <a href="dashboard.php?page=help_desk_details&ticket_id=<?=$ticket['ticket_id']?>" class="btn btn-primary btn-sm btn_ticket_cancel" data-id3="<?=$ticket['ticket_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details" disabled>
                                        <i class="ti ti-pencil fs-4"></i>
                                      </a>
                                      <button class="btn btn-sm btn-danger btn-sm btn_ticket_delete" data-id3="<?=$ticket['ticket_id']?>" data-file="<?=$ticket['ticket_attachment']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
      </div>
    </div>

    
    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Help Desk </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/tickets.php'); ?>
      
    </div>
  </div>
</div>