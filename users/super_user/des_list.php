<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Development Educators (DEs) List</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Development Educators (DEs)</li>
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
          <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
            <li class="nav-item">
              <h4 class="fw-semibold mb-8">Registered Development Educators (DEs) </h4>
            </li>
            <li class="nav-item ms-auto">
              <a href="dashboard.php?page=add_de" class="btn btn-primary d-flex align-items-center px-3" id="add-notes" title="Add DE">
               <i class="ti ti-user me-0 me-md-1 fs-4"></i>
                <span class="d-none d-md-block font-weight-medium fs-3">Add DE</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="note-full-container" class="note-has-grid row">
              <div class="col-md-12 single-note-item all-category note-social">
                <div class="card card-body">
                  <div class="table-responsive">
                    <div id="err"></div>
                    <table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
                      <thead class="header-item">
                        <th>
                          #
                        </th>
                        <th>DE Name</th>
                        <th>Sponsored By</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                          $saccos = $con->getRows('des a, sacco b', array('where'=>'a.sponsored_by=b.sacco_id','order_by'=>'a.first_name asc'));
                          if(!empty($saccos)){
                            $i=0;
                            foreach($saccos as $sacco){ 
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
                                        <h6 class="user-name mb-0" data-name=""><?=ucwords($sacco['first_name']).' '.ucwords($sacco['last_name'])?></h6>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <span class="usr-email-addr"><?=$sacco['sacco_name']?></span>
                                </td>
                                <td>
                                  <span class="usr-email-addr"><?=$sacco['email_address']?></span>
                                </td>
                                <td>
                                  <span class="usr-location"><?=$sacco['phone_number']?></span>
                                </td>
                                <td>
                                  <span class="usr-ph-no" ><?=$con->shortDate($sacco['date_registered'])?></span>
                                </td>
                                <td>
                                  <div class="action-btn">
                                    <a href="dashboard.php?page=de_details&de_id=<?=$sacco['de_id']?>" class="btn btn-primary btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                                      <i class="ti ti-eye fs-5"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm delete_de ms-2" data-id3="<?=$sacco['de_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete DE">
                                      <i class="ti ti-trash fs-5"></i>
                                    </button>
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
        	function getSacco(){
            let action = "get_sacco";
            $.ajax({
                url:"get_sacco_data.php",
                method:"POST",
                data:{action:action},
                success:function(data){ 
                    $('#show_all_saccos').html(data);
                }
            });
          }
          getSacco();
        </script>