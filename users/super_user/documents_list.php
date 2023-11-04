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
                      <div id="sacco_response"></div>
                      <div class="table-responsive">
                      	<div id="show_docs"></div>
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

<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
