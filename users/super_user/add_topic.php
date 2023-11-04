<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Discussion Area</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Add Topic</li>
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
      <div class="col-md-8">
        <div class="card card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Discussion Topics</h5>
              <p class="card-subtitle mb-0">Topics posted by you</p>
            </div>
          </div>
          <div class="table-responsive">
            <div id="show_my_topics"></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Add Topic</h5>
              <p class="card-subtitle mb-0">Topics posted for discussions, to add your comment click on view button</p>
            </div>
          </div>
          <div id="topic_response"></div>
          <form id="add-topic" method="post" action="" enctype="multipart/form-data">                          
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label>Topic</label>
                    <input type="text" class="form-control" name="title" >
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description" placeholder=""></textarea>
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
                
                <div class="col-12">
                <div class="d-flex align-items-center justify-content-end gap-3">
                  <button type="submit" name="add_topic" id="add_topic"  class="btn btn-primary ">Add Topic</button>
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
  </div>
<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  function getTopics(){
    let action = "get_my_topics";
  $.ajax({
      url:"get_topics_data.php",
      method:"GET",
      data:{action:action},
      success:function(data){ //alert(data);
          $('#show_my_topics').html(data);
      }
  });
  }
  getTopics();
</script>