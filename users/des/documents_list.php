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
                                 array('where'=>'a.category_id=b.category_id and (a.access_rights=2)','order_by'=>'title asc'));
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