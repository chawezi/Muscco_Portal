<?php
include_once('../../settings/master-class.php');
$con =new MasterClass;
$action = '';
if(isset($_GET['action'])){
  $action = $_GET['action'];
}

if($action == 'get_categories'){
?>
<table id="zero_config" class="table search-table align-middle dataTable">
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
<?php } else if($action == 'get_docs'){ ?>
<table id="zero_config" class="table search-table align-middle dataTable">
    <thead class="header-item">
      <th>
        #
      </th>
      <th>Document Title</th>
      <th>Uploaded By</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
        $documents = $con->getRows('documents a, document_categories b', 
                 array('where'=>'a.category_id=b.category_id','order_by'=>'title asc'));
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
                      <h6 class="user-name mb-0"><?=$doc['title']?></h6>
                      <span class="user-work fs-3">
                        <?=$doc['category']?>
                          (<?php
                            if($doc['access_rights'] == '0'){
                              echo 'Muscco Only';
                            }else if($doc['access_rights'] == '1'){
                              echo 'Muscco & Sacco';
                            }if($doc['access_rights'] == '2'){
                              echo 'All Members';
                            }
                          ?>)
                        </span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <?php
                            $user =  $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$doc['posted_by'].'"','return_type'=>'single'));
                            echo ucwords($user['first_name'])." ".ucwords($user['last_name']);
                            
                          ?>
                          
                         </td>
              
              <td>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                    <a href="download-file.php?dir=../../uploads/docs/&file=<?=$doc['document_file']?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Document">
                      <i class="ti ti-download fs-4"></i>
                    </a>
                    <button class="btn btn-sm btn-danger btn-sm delete_document" data-id3="<?=$doc['document_id']?>" data-doc="<?=$doc['document_file']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Document">
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
<?php } ?>