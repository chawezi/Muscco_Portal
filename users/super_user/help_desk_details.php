<?php
$ticket_id = '';
if(isset($_GET['ticket_id'])){
  $ticket_id = $_GET['ticket_id'];
}
$user_name = '';
$ticket = $con->getRows('tickets',array('where'=>'ticket_id="'.$ticket_id.'"', 'return_type'=>'single'));

?>
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
      <?php include_once('../../layout/tickets-admin.php'); ?>      
    </div>
    <div class="min-width-340">
      <div class="border-end user-chat-box h-100">
        <div class="px-4 pt-9 pb-6 d-none d-lg-block">
          <ul class="list-unstyled mb-0 d-flex align-items-center">
            <li class="fw-semibold text-dark text-uppercase  fs-2">TICKET # <?=sprintf('%04d',$ticket_id)?> Replies</li>
          </ul>
        </div>
        <div class="app-chat">
          <div id="show_responses"></div>
          
        </div>
        <div class="card-body p-4">
            <div id="response"></div>
            <form id="add-response" method="post">
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-4">
                    <textarea class="form-control" rows="3" name="response" placeholder="Enter your response, a comment or anything related to this ticket..."></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-flex align-items-center justify-content-end gap-3"> 
                    <input type="hidden" name="id" id="id" value="<?=$ticket_id?>"> 
                    <?php if($ticket['ticket_status'] == 0){ ?>                                    
                    <button type="submit" name="add_response" id="add_response" class="btn btn-primary">
                      Send Message
                    </button> 
                    <?php }else{
                      echo'
                        <button type="submit" name="" id="add_response" class="btn btn-primary" disabled>
                          Send Message
                        </button> 
                      ';
                    }?>                             
                  </div>
                </div>
              </div>
            </form>
            
          </div>
      </div>
    </div>
    <div class="d-flex w-100">
      <div class="w-100">
        <div class="chat-container h-100 w-100">
          <div class="chat-box-inner-part h-100">
            <div class="chatting-box app-email-chatting-box">
              <div class="p-9 py-3 border-bottom chat-meta-user">
                <ul class="list-unstyled mb-0 d-flex align-items-center">
                  <li class="fw-semibold text-dark text-uppercase  fs-2">TICKET # <?=sprintf('%04d',$ticket_id)?> Details</li>
                </ul>
              </div>
              <div class="position-relative">
                <div class="position-relative">
                  <div class="chat-box p-9">
                  <div id="progress_report"></div>
                  <form id="add-product" method="post">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="mb-4">
                          <input type="number" class="form-control" name="progress" min="0" max="100" value="<?=$ticket['ticket_progress']?>"  placeholder="Enter Category Name">
                          <small>Enter the progress in form of percentange</small>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex align-items-center justify-content-end gap-3">   
                          <input type="hidden" name="ticket_id" value="<?=$ticket_id?>">  
                          <?php if($ticket['ticket_status'] == 0){ ?>                                 
                          <button type="submit" name="update_progress" id="update_progress" class="btn btn-primary">
                            Update Progress
                          </button>  
                          <?php }else{
                            echo '<button type="submit" name="" id="update_progress" class="btn btn-primary" disabled>
                            Update Progress
                          </button> ';
                          } ?>                            
                        </div>
                      </div>
                    </div>
                  </form> 
                  <div id="show_ticket_details"></div> 
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
      <?php include('../../layout/tickets-admin.php'); ?>
      
    </div>
  </div>
</div>
<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    function getResponses(){
      let action = "show_responses";
      let id ="<?=$ticket_id?>";
      //alert(id);
      $.ajax({
          url:"get_tickets_data.php",
          method:"GET",
          data:{action:action, id:id},
          success:function(data){ 
              $('#show_responses').html(data);
          }
      });
    }

    function getTicketDetails(){
      let action = "show_ticket_details";
      let id ="<?=$ticket_id?>";
      //alert(id);
      $.ajax({
          url:"get_tickets_data.php",
          method:"GET",
          data:{action:action, id:id},
          success:function(data){ //alert(data);
              $('#show_ticket_details').html(data);
          }
      });
    }
    getResponses();
    getTicketDetails();
    //add ticket response
    //add-response
    $("#add-response").validate({
      rules: {
        response:{required:true}
      },
      messages: {
        response:{required:"Please enter your message"}
      },
      submitHandler: sendResponse  
    });    
    /* Handling form functionality */
    function sendResponse() {    
      var data = $("#add-response").serialize(); 
      //let id=document.getElementById("#id").value();
      //alert(id);       
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#response").fadeOut();
          $("#add_response").html(' Sending Message..');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> The message has been sent.</div>');
              $("#add_response").html('Send Message');
              $("#add-response")[0].reset();
            });
            $("#response").delay(6000).fadeOut(function(){});
            getResponses();
          }else if(response == 2) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, there was an error sending the message, please try again.</div>');
              $("#add_response").html('Send Message');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
        }
      });
      return false;
    } 
  });
  
</script>