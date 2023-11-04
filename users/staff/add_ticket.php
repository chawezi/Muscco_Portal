<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Help Desk</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Help Desk</li>
          </ol>
        </nav>
      </div>
      <div class="col-3">
        <div class="text-center mb-n5">  
            <img src="../../dist/images/breadcrumb/emailSv.png" alt="" class="img-fluid mb-n4">
          </div>
      </div>
    </div>
  </div>
</div>
<div class="card chat-application">
  <div class="d-flex align-items-center justify-content-between gap-3 m-3 d-lg-none">
      <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
        <i class="ti ti-menu-2 fs-5"></i>
      </button>
      <form class="position-relative w-100">
        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact">
        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
      </form>
    </div>
  <div class="d-flex w-100">
    <div class="left-part border-end w-20 flex-shrink-0 d-none d-lg-block">
      <?php include_once('../../layout/tickets.php'); ?>      
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">Add New TICKET</li>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                    <div class="card">
                    <div class="card-body p-4">
                      <h4 class="fw-semibold mb-3">Add Ticket</h4>
                      <div id="error"></div>
                      <form id="add-ticket" method="post" action="" enctype="multipart/form-data">                            
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Ticket Title</label>
                              <input type="text" class="form-control" name="title" placeholder="Example: Member Account Opening">
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Category</label>
                              <select class="form-control form-select" name="category" tabindex="1">
                                <option value="">Select Ticket Category</option>
                                <?php
                                  $categorys = $con->getRows('ticket_categories', array('order_by'=>'ticket_category'));
                                  if(!empty($categorys)){
                                    foreach ($categorys as $category) {
                                      echo'<option value="'.$category['ticket_category_id'].'">'.$category['ticket_category'].'</option>';
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Attachment</label>
                              <input type="file" class="form-control" name="file">
                              <small id="name" class="form-text text-muted">If possible please attach a screenshot of the issue/error</small>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Product</label>
                              <select class="form-control form-select" name="product" tabindex="1">
                                <option value="">Select Product</option>
                                <?php
                                  $products = $con->getRows('products', array('order_by'=>'product'));
                                  if(!empty($products)){
                                    foreach ($products as $prod) {
                                      echo'<option value="'.$prod['product_id'].'">'.$prod['product'].'</option>';
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Priority</label>
                              <select class="form-control form-select" name="priority" tabindex="1">
                                <option value="">Select Issue Priority</option>
                                <option value="1">Priority 1</option>
                                <option value="2">Priority 2</option>
                                <option value="3">Priority 3</option>
                                <option value="4">Priority 4</option>
                                <option value="5">Priority 5</option>
                                
                              </select>
                            </div>

                            <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Ticket Description</label>
                              <textarea class="form-control" rows="3" name="description" placeholder=""></textarea>
                              <small id="name" class="form-text text-muted">Try to describe your issue in a way that we can understand it.</small>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-3">
                              <button type="submit" name="add_ticket" id="add_ticket"  class="btn btn-primary ">Add Ticket</button>
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
        </div>
      </div>
    </div>


    <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Help Desk </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <?php include('../../layout/tickets-bottom.php'); ?>
      
    </div>
  </div>
</div>