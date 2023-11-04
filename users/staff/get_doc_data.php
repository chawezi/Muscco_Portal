<?php
include_once('../../settings/master-class.php');
$con =new MasterClass;
?>
<table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Category</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
      $documents = $con->getRows('document_categories', 
               array('order_by'=>'category asc'));
      if(!empty($documents)){
        $i=0;
        foreach($documents as $doc){ 
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
                    <h6 class="user-name mb-0"><?=$doc['category']?></h6>
                  </div>
                </div>
              </div>
            </td>
                                        
            <td>
              <div class="action-btn">
                <button class="btn btn-danger btn-sm delete_category ms-2" data-id3="<?=$doc['category_id']?>"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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