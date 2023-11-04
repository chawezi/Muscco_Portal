<?php
session_start();
include_once('../../settings/master-class.php');
$con =new MasterClass;
if(isset($_SESSION['travel_advance_id'])){
?>
<table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Date</th>
    <th>From</th>
    <th>To</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
      $sql = $con->getRows('daily_itinerary', array('where'=>'travel_advance_id="'.$_SESSION['travel_advance_id'].'" and employee_id="'.$_SESSION['USR_ID'].'"','order_by'=>'daily_id asc'));
      if(!empty($sql)){
        $i=0;
        foreach($sql as $row){ 
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
                    <h6 class="user-name mb-0"><?=$row['date']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['place_from']?></h6>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="ms-3">
                  <div class="user-meta-info">
                    <h6 class="user-name mb-0"><?=$row['place_to']?></h6>
                  </div>
                </div>
              </div>
            </td>

                                        
            <td>
              <div class="action-btn">
                <button class="btn btn-danger btn-sm delete_DI ms-2" data-id3="<?=$row['daily_id']?>"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
<?php } ?>