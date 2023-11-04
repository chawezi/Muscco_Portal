<?php
	$faq_id = '';
	if(isset($_GET['faq_id'])){
		$faq_id = $_GET['faq_id'];
	}
?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Frequently Asked Questions</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">FAQs</li>
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
                  <i class="ti ti-info-circle me-2 fs-6"></i>
                  <span class="d-none d-md-block">FAQs</span> 
                </button>
              </li>
            </ul>
            <div class="card-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                  <div class="row">
                    <div class="col-12">
                      <div id="faqs_response"></div>                          
                      <div class="table-responsive">
		                      <div id="show_faqs"></div>
	              			</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
      </div>
      <div class="col-md-4">
      	<div class="card">
          <div class="card-body p-4">
          	<?php if(empty($faq_id)){ ?>
            <h4 class="fw-semibold mb-3">Add FAQs</h4>
            <div id="error"></div>
            <form id="add-document" method="post" action="" enctype="multipart/form-data">                          
              <div class="row">
	              
	              <div class="col-md-12">
	                <div class="mb-3">
	                  <label>Question</label>
	                  <textarea class="form-control" rows="3" name="question"></textarea>
	                </div>
	              </div>
	              <div class="col-md-12">
	                <div class="mb-3">
	                  <label>Answer</label>
	                  <textarea class="form-control" rows="4" name="answer"></textarea>
	                </div>
	              </div>
	            </div>
		            <div class="row">		              
		              <div class="col-12">
		              <div class="d-flex align-items-center justify-content-end gap-3">
		                <button type="submit" name="add_faq" id="add_faq"  class="btn btn-primary ">Add FAQ</button>
		              </div>
		            </div>
		              <!--/span-->
		            </div>
	            <!--/row-->
	          </form> 
	          <?php } else{ $faq=$con->getRows('faqs', array('where'=>'faq_id="'.$faq_id.'"','return_type'=>'single')); ?>
	          	<h4 class="fw-semibold mb-3">Edit FAQs <a href="dashboard.php?page=faqs" class="btn btn-sm btn-primary" style="float: right;">Add FAQ</a></h4>
	            <div id="error"></div>
	            <form id="add-document" method="post" action="" enctype="multipart/form-data">                          
	              <div class="row">
		              
		              <div class="col-md-12">
		                <div class="mb-3">
		                  <label>Question</label>
		                  <textarea class="form-control" rows="3" name="question"><?=$faq['question']?></textarea>
		                </div>
		              </div>
		              <div class="col-md-12">
		                <div class="mb-3">
		                  <label>Answer</label>
		                  <textarea class="form-control" rows="4" name="answer"><?=$faq['answer']?></textarea>
		                </div>
		              </div>
		            </div>
			            <div class="row">		              
			              <div class="col-12">
			              <div class="d-flex align-items-center justify-content-end gap-3">
			              	<input type="hidden" name="faq_id" value="<?=$faq['faq_id']?>">
			                <button type="submit" name="update_faq" id="add_faq"  class="btn btn-primary ">Update FAQ</button>
			              </div>
			            </div>
			              <!--/span-->
			            </div>
		            <!--/row-->
		          </form>
	          <?php } ?>           
          </div>

        </div>
      </div>
    </div>

	<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>