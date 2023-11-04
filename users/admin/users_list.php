<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Staff Members List</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Staff Members</li>
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
          <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
            <li class="nav-item">
              <a href="javascript:void(0)" class="
                      nav-link
                    
                      note-link
                      d-flex
                      align-items-center
                      justify-content-center
                      active
                      px-3 px-md-3
                      me-0 me-md-2 text-body-color
                    " id="all-category">
                <i class="ti ti-users fill-white me-0 me-md-1"></i>
                <span class="d-none d-md-block font-weight-medium">Staff Members</span>
              </a>
            </li>
            
            <li class="nav-item ms-auto">
              <a href="dashboard.php?page=add_user" class="btn btn-primary d-flex align-items-center px-3" id="add-notes">
               <i class="ti ti-user-plus me-0 me-md-1 fs-4"></i>
                <span class="d-none d-md-block font-weight-medium fs-3">Add Staff Member</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="note-full-container" class="note-has-grid row">
              <div class="col-md-12 single-note-item all-category note-social">
                <div class="card card-body">
                  <div class="table-responsive">
                  	<div id="response"></div>
                  	<div id="show_all_users"></div>
	              </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    	<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript">
        	function getUsers(){
        		let action = "get_staff";
			    $.ajax({
		          url:"get_user_data.php",
		          method:"POST",
		          data:{action:action},
		          success:function(data){ 
		              $('#show_all_users').html(data);
		          }
			    });
        	}
        	getUsers();
        </script>