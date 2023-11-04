<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Sacco List</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Saccos</li>
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
              <h4 class="fw-semibold mb-8">Registered Sacco </h4>
            </li>
            <li class="nav-item ms-auto">
              <a href="dashboard.php?page=add_sacco" class="btn btn-primary d-flex align-items-center px-3" id="add-notes" title="Add Sacco">
               <i class="ti ti-archive me-0 me-md-1 fs-4"></i>
                <span class="d-none d-md-block font-weight-medium fs-3">Add Sacco</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="note-full-container" class="note-has-grid row">
              <div class="col-md-12 single-note-item all-category note-social">
                <div class="card card-body">
                  <div class="table-responsive">
                    <div id="response"></div>
                    <table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Sacco Name</th>
    <th>Sacco President</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Date</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
      $saccos = $con->getRows('sacco', array('order_by'=>'sacco_name asc'));
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
                    <h6 class="user-name mb-0" data-name=""><?=ucwords($sacco['sacco_name'])?></h6>
                    <span class="user-work fs-3" data-occupation=""><?=$sacco['location']?></span>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <span class="usr-email-addr"><?=ucwords($sacco['sacco_president'])?></span>
            </td>
            <td>
              <span class="usr-email-addr"><?=$sacco['email_address']?></span>
            </td>
            <td>
              <span class="usr-location"><?=$sacco['phone_number']?></span>
            </td>
            <td>
              <span class="usr-ph-no" ><?=$con->shortDate($sacco['registered_date'])?></span>
            </td>
            <td>
              <div class="action-btn">
                <a href="dashboard.php?page=sacco_details&sacco_id=<?=$sacco['sacco_id']?>" class="btn btn-primary btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                  <i class="ti ti-eye fs-5"></i>
                </a>
                <button class="btn btn-danger btn-sm delete_sacco ms-2" data-id3="<?=$sacco['sacco_id']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Sacco">
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