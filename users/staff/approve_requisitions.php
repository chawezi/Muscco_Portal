<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Petty Cash Requisitions</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Approve Petty Cash Requisitions</li>
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
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Approve Petty Cash Requisitions</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                    	<div class="table-responsive">
					                  <table id="zero_config" class="table border table-striped table-bordered display dataTable no-footer">
														  <thead class="header-item">
														    <th>
														      #
														    </th>
														    <th>Officer & Department</th>
														    <th>Subject</th>
														    <th>Amount</th>
														    <th>Sponsor</th>
														    <th>Action</th>
														  </thead>
														  <tbody>
														  	<?php
														  		$requisitions =$con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
														  						 						   array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=0 and a.requested_by !="'.$_SESSION['USR_ID'].'"','order_by'=>'a.date_posted desc'));
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
																	              <h6 class="user-name mb-0"><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
																	              <span class="user-work fs-3">
																	              	<?=$row['department']?>
																	              	</span>
																	            </div>
																	          </div>
																	        </div>
																	      </td>
																	      <td>
																	        <div class="d-flex align-items-center">
																	          <div class="ms-3">
																	            <div class="user-meta-info">
																	              <h6 class="user-name mb-0"><?=$row['subject']?></h6>
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
																	      	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
				                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
				                                      <a href="dashboard.php?page=petty_cash_details&request_id=<?=$row['requisition_id']?>&action=approve_requisition" class="btn btn-primary btn-sm"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Approve Requisition">
				                                        <i class="ti ti-checks fs-4"></i>
				                                      </a>
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
