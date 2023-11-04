<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Sacco Report</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Sacco Report</li>
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
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold">Sacco Report</h5>
                      <p class="card-subtitle mb-0">Report on membership showing Assets, Shares, Deposits, Loans, Profits, and Membership (Male, Female, Youth, Others)</p>
                    </div>
                    <div>
                      <a href="../../generate-lpdf.php?type=sacco_report" target="_blank" class="btn btn-primary d-flex align-items-center px-3" id="add-notes" title="Download Report">
                       <i class="ti ti-download me-0 me-md-1 fs-4"></i>
                        <span class="d-none d-md-block font-weight-medium fs-3">Download</span>
                      </a>
                    </div>
                  </div>
                    <table
                        id="complex_head_col"
                        class="table border table-striped table-bordered display"
                        style="width: 100%"
                      >
                        <thead>
                          <!-- start row -->
                          <tr>
                            <th rowspan="2">Sacco Name</th>
                            <th rowspan="2">Assets</th>
                            <th rowspan="2">Shares</th>
                            <th rowspan="2">Deposit</th>
                            <th rowspan="2">Loans</th>
                            <th rowspan="2">Profits</th>
                            <th colspan="4">Membership</th>
                          </tr>
                          <!-- end row -->
                          <!-- start row -->
                          <tr>                            
                            <th>Male</th>
                            <th>Female</th>
                            <th>Youth</th>
                            <th>Other</th>
                          </tr>
                          <!-- end row -->
                        </thead>
                        <tbody>
                          <?php
                            $assets = 0;
                            $shares = 0;
                            $deposits = 0;
                            $loans = 0;
                            $profits = 0;
                            $male = 0;
                            $female = 0;
                            $youth = 0;
                            $other = 0;
                            $saccos = $con->getRows('sacco', array('order_by'=>'sacco_name asc'));
                            if(!empty($saccos)){
                              
                              foreach($saccos as $sacco){ 
                                $assets +=$sacco['assets'];
                                $shares +=$sacco['shares'];
                                $deposits +=$sacco['deposits'];
                                $loans +=$sacco['loans'];
                                $profits +=$sacco['profits'];
                                $male +=$sacco['male_membership'];
                                $female +=$sacco['female_membership'];
                                $youth +=$sacco['youth_membership'];
                                $other +=$sacco['other_membership'];
                          ?>
                          <!-- start row -->
                          <tr>
                            <td><?=ucwords($sacco['sacco_name'])?></td>
                            <td><?=number_format($sacco['assets'],2,'.',',')?></td>
                            <td><?=number_format($sacco['shares'],2,'.',',')?></td>
                            <td><?=number_format($sacco['deposits'],2,'.',',')?></td>
                            <td><?=number_format($sacco['loans'],2,'.',',')?></td>
                            <td><?=number_format($sacco['profits'],2,'.',',')?></td>
                            <td><?=$sacco['male_membership']?></td>
                            <td><?=$sacco['female_membership']?></td>
                            <td><?=$sacco['youth_membership']?></td>
                            <td><?=$sacco['other_membership']?></td>
                          </tr>
                         <?php } } ?>
                        </tbody>
                        <tfoot>
                          <!-- start row -->
                          <tr>
                            <th>Total</th>
                            <th><?=number_format($assets,2,'.',',')?></th>
                            <th><?=number_format($shares,2,'.',',')?></th>
                            <th><?=number_format($deposits,2,'.',',')?></th>
                            <th><?=number_format($loans,2,'.',',')?></th>
                            <th><?=number_format($profits,2,'.',',')?></th>
                            <th><?=$male?></th>
                            <th><?=$female?></th>
                            <th><?=$youth?></th>
                            <th><?=$other?></th>
                          </tr>
                          <!-- end row -->
                        </tfoot>
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