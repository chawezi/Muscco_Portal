<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Petty Cash Requisitions</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">My Petty Cash Requisitions</li>
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
      <?php include_once('../../layout/petty-cash.php') ?>
      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">My Requisitions</h5>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                    	<div class="table-responsive">
                    		<div id="err"></div>
					                  <table id="zero_config" class="table border table-striped table-bordered display dataTable no-footer">
														  <thead class="header-item">
														    <th>
														      #
														    </th>
														    <th>Subject & Description</th>
														    <th>Amount(MK)</th>
														    <th>Sponsor</th>
														    <th>Status</th>
														    <th>Action</th>
														  </thead>
														  <tbody>
														  	<?php
														  		$requisitions = $con->getRows('petty_cash_requisitions', 
														  						 array('where'=>'requested_by="'.$_SESSION['USR_ID'].'"','order_by'=>'date_posted desc'));
														  		if(!empty($requisitions)){
														  			$i=0;
														  			foreach($requisitions as $row){ 
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
																	              <h6 class="user-name mb-0"><?=$row['subject']?></h6>
																	              <span class="user-work fs-3">
																	              	<?=substr(strip_tags($row['description']), 0, 100)?>...
																	              	</span>
																	            </div>
																	          </div>
																	        </div>
																	      </td>
																	      <td>
																	      	MK<?=number_format($row['amount'],2,'.',',')?>  			
									                      </td>
									                      <td>
									                      	<?=$row['sponsor']?>
									                      </td>
																	      <td>
									                      	<?php 
				                                    switch ($row['requisition_status']) {
				                                      case 0:
				                                        echo'<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
				                                        break;
				                                      case 1:
				                                        echo'<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
				                                        break;
				                                      case 2:
				                                        echo'<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
				                                        break;
				                                    }
				                                  ?>
									                      </td>
																	      <td>
																	      	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
				                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
				                                      <a href="dashboard.php?page=petty_cash_details&request_id=<?=$row['requisition_id']?>" class="btn btn-primary btn-sm btn_day_cancel" data-bs-toggle="tooltip"  data-bs-placement="top" data-bs-title="View Details">
				                                        <i class="ti ti-pencil fs-4"></i>
				                                      </a>
				                                      <?php if($row['requisition_status'] == 0){ ?>
				                                      <button class="btn btn-sm btn-danger btn-sm btn_delete_pettycash" data-id3="<?=$row['requisition_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
				                                        <i class="ti ti-trash fs-4"></i>
				                                      </button>
					                                    <?php } else{ ?>
					                                    <button class="btn btn-sm btn-danger btn-sm btn_delete_request" data-id3="<?=$row['requisition_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" disabled>
				                                        <i class="ti ti-trash fs-4"></i>
				                                      </button>
					                                    <?php } ?>
				                                    </div>
				                                    
				                                  </div>
																	      </td>
																	    </tr>
														  	<?php	}
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
    </div>


    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Petty Cash </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/petty-cash.php'); ?>
    </div>
  </div>
</div>
