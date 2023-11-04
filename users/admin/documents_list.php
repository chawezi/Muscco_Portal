<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Document Directory</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Documents</li>
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
    <?php 
      $check_access = $con->getRows('permissions_granted', array('where'=>'permission_id=5 and member_id="'.$_SESSION['USR_ID'].'"','return_type'=>'single'));
      if(empty( $check_access)){ 
    ?>
    <div class="tab-content">
      <div id="note-full-container" class="note-has-grid row">
        <div class="col-md-12 single-note-item all-category note-social">
          <div class="card card-body">
            <div class="table-responsive">
                <table id="zero_config" class="table search-table align-middle dataTable">
                    <thead class="header-item">
                      <th>
                        #
                      </th>
                      <th>Document Title</th>
                      <th>Category</th>
                      <th>Date</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $documents = $con->getRows('documents a, document_categories b', 
                                 array('where'=>'a.category_id=b.category_id and (a.access_rights=1 or a.access_rights=2)','order_by'=>'title asc'));
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
                                        
                                        </span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td><?=$doc['category']?></td>
                              <td><?=$con->shortDate($doc['date_posted'])?></td>
                              
                              <td>
                                <div class="action-btn">
                                  <a href="download-file.php?dir=../../uploads/docs/&file=<?=$doc['document_file']?>" class="btn btn-primary btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download">
                                    <i class="ti ti-download fs-5"></i>
                                    Download
                                  </a>
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

  <?php 
  }else{       
  ?>
    <div class="row">
      <div class="col-md-8">
        
        <div class="card">
            <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
                  <i class="ti ti-file-invoice me-2 fs-6"></i>
                  <span class="d-none d-md-block">Documents</span> 
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
                  <i class="ti ti-file-description me-2 fs-6"></i>
                  <span class="d-none d-md-block">Document Categories</span> 
                </button>
              </li>
            </ul>
            <div class="card-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                  <div class="row">
                    <div class="col-12">
                          <div id="doc_response"></div>
                          <div class="table-responsive">
                            <table id="zero_config" class="table search-table align-middle text-nowrap dataTable">
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
                                          <div class="action-btn">
                                            <a href="../../uploads/docs/<?=$doc['document_file']?>" class="btn btn-primary btn-sm  ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download">
                                              <i class="ti ti-download fs-5"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm delete_document ms-2" data-id3="<?=$doc['document_id']?>" data-doc="<?=$doc['document_file']?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
                <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
                  <div class="row justify-content-center">
                    <div class="col-lg-11">
                      <div class="row">
                        <div class="col-12">
                              <h5 class="card-title fw-semibold">Document Categories</h5>
                              <small>Use the form below to add document categories.</small>
                              <div id="response_cat"></div>
                              <form class="mt-3" id="add-invoice" method="post" enctype="multipart/form-data">
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="mb-4">
                                      <label for="exampleInputPassword1" class="form-label fw-semibold">Category Name</label>
                                      <input type="text" class="form-control" name="category_name">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="d-flex align-items-center justify-content-end mt-4 gap-3">                                      
                                      <button type="submit" name="add_docu_category" id="add_category" class="btn btn-primary">Add Category</button>
                                      
                                    </div>
                                  </div>
                                </div>
                              </form>
                              <hr>
                        </div>
                        <div class="col-lg-12">
                          <div class="table-responsive">
                            <div id="category_msg"></div>
                            <div id="show_doc_categories"></div>
                                
                        </div>
                        </div>
                        
                        
                      </div>
                    </div>
                    
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body p-4">
            <h4 class="fw-semibold mb-3">Upload Document</h4>
            <div id="error"></div>
            <form id="add-document" method="post" action="" enctype="multipart/form-data">                          
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label>Category</label>
                    <select class="form-control form-select" name="category" tabindex="1">
                      <option value="">Select Document Category </option>
                      <?php
                          $document = $con->getRows('document_categories', array('order_by'=>'category asc'));
                          if(!empty($document)){
                            foreach($document as $docu){
                              echo'<option value="'.$docu['category_id'].'">'.$docu['category'].'</option>';
                            }
                          }
                        ?>                                  
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" >
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                  <div class="mb-3">
                    <label>Access Rights</label>
                    <select class="form-control form-select" name="access_rights" tabindex="1">
                      <option value="">Select Who Should Download </option>                                
                      <option value="0">Muscco Staff Only</option>                                
                      <option value="1">Muscco Staff & Sacco Members</option>                                
                      <option value="2">Muscco Staff, Sacco Members & DE's</option>                                
                    </select>
                  </div>
                </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label>Attachment</label>
                    <input type="file" class="form-control" name="file">
                  </div>
                </div>
                <!--/span-->
                
                <div class="col-12">
                <div class="d-flex align-items-center justify-content-end gap-3">
                  <button type="submit" name="add_document" id="add_document"  class="btn btn-primary ">Upload Document</button>
                </div>
              </div>
                <!--/span-->
              </div>
              <!--/row-->
            </form>            
          </div>

        </div>
      </div>
    </div>
  <?php } ?>
  </div>

<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	function getDocCategories(){
  $.ajax({
      url:"get_doc_data.php",
      method:"POST",
      success:function(data){  //alert(data);
          $('#show_doc_categories').html(data);
      }
  });
	}
	getDocCategories();
</script>