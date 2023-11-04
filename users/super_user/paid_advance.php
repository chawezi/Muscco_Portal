<div class="card bg-light-info shadow-none position-relative ">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Staff Advances</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Paid Advances</li>
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
      <?php include_once('../../layout/advances.php') ?>
      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                <h5 class="text-dark mb-0 fw-semibold">Paid Advances</h5>
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download My Requisitions">
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)">
                      <i class="ti ti-download"></i> Download
                    </a>
                  </li>
                </ul>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="table-responsive" width="100%">
                    	<div class="table-responsive">
					                  <table id="scroll_hor" class="table border table-striped table-bordered display nowrap dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
														  <thead class="header-item">
														    <th>
														      #
														    </th>
														    <th>Officer</th>
														    <th>Amount</th>
														    <th>Amount Paid</th>
														    <th>Balance</th>
														    <th>Date</th>
														    <th>Action</th>
														  </thead>
														  <tbody>
														  	<?php
														  		$requisitions = $con->getRows('advance_requests a, muscco_members b, departments c', 
														  						 array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status=5','order_by'=>'date_posted desc'));
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
				                                        <h6 class="user-name mb-0" data-name=""><?=ucwords($row['first_name'])." ".ucwords($row['last_name'])?></h6>
				                                        <span><?=$row['department']?></span>
				                                      </div>
				                                    </div>
				                                  </div>
				                                </td>
																	      <td>
																	        <div class="d-flex align-items-center">
																	          <div class="ms-3">
																	            <div class="user-meta-info">
																	              <h6 class="user-name mb-0">MK<?=number_format($row['amount'],2,'.',',')?></h6>
																	            </div>
																	          </div>
																	        </div>
																	      </td>
																	      <td>
                                          MK<?=number_format($row['total_paid'],2,'.',',')?>        
                                        </td>
                                        <td>
                                          MK<?=number_format($row['balance'],2,'.',',')?>        
                                        </td>
									                      <td>
									                      	<?=$con->shortDate($row['date_posted'])?>
									                      </td>
																	      <td>
																	      	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
				                                    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">                                   
				                                      <a href="dashboard.php?page=advance_details&advance_id=<?=$row['advance_id']?>&action=make_payment" class="btn btn-primary btn-sm" data-bs-placement="top" data-bs-title="View Details">
				                                        <i class="ti ti-pencil fs-4"></i> Details
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
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Paid Advances</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/advances.php'); ?>
    </div>
  </div>
</div>
