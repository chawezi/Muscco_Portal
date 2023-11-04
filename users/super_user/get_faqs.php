<?php
include_once('../../settings/master-class.php');
$con =new MasterClass;
?>
<table id="scroll_hor" class="table border table-striped table-bordered display dataTable no-footer" style="width: 100%;" aria-describedby="scroll_hor_info">
  <thead class="header-item">
    <th>
      #
    </th>
    <th>Question & Answer</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
      $faqs = $con->getRows('faqs', 
               array('order_by'=>'faq_id'));
      if(!empty($faqs)){
        $i=0;
        foreach($faqs as $doc){ 
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
                    <h6 class="user-name mb-0"><?=$doc['question']?></h6>
                    <span class="user-work fs-3">
                      <?=$doc['answer']?>
                      </span>
                  </div>
                </div>
              </div>
            </td>
            
            <td>
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
          
          <a href="dashboard.php?page=faqs&faq_id=<?=$doc['faq_id']?>"  class="btn btn-primary btn-sm" data-id3="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
            <i class="ti ti-pencil fs-4"></i>
          </a>
          <button class="btn btn-sm btn-danger btn_faq_delete" data-id3="<?=$doc['faq_id']?>"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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

                          