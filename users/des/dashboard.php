<?php include_once('../../layout/header.php'); ?>
      <!-- Sidebar Start -->
      <?php include_once('../../layout/side-bar.php'); ?>
      <!-- Sidebar End -->

      <!-- Main wrapper -->
      <div class="body-wrapper">
        <!-- Header Start -->
        <?php include_once('../../layout/top-bar.php'); ?>
        <!-- Header End -->
        <div class="container-fluid note-has-grid">
          
          <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
          <?php if(is_file(__DIR__.'/'.$page.'.php')){include_once($page.'.php');}else{include('error-404.php');} ?> 
          <!-- container-fluid over -->

        </div>
      </div>
    </div>
<?php include_once('../../layout/footer.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    function getDocCategories(){
      $.ajax({
          url:"get_doc_data.php",
          method:"POST",
          success:function(data){  //alert(data);
              $('#show_doc_categories').html(data);
          }
      });
    }

    //petty cash requisition
    $("#petty-cash").validate({
      rules: {
        action:{required:true},
        subject:{required:true},
        sponsor:{required:true},
        amount:{required:true},
        reasons:{required:true}
      },
      messages: {
        action:"Please select the action",
        subject:"Please enter subject",
        sponsor:"Please enter sponsor",
        amount:"Please enter amount",
        reasons:"Please enter description",
      },
      submitHandler: pettyCash  
    });    
    /* Handling form functionality */
    function pettyCash() {    
      var data = $("#petty-cash").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#response").fadeOut();
          $("#petty_cash").html(' Posting Requisition...');
          $("#approve_petty").html(' Approving Requisition...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> Your petty cash requisition  has been posted successfuly.</div>');
              $("#petty_cash").html('Post Requisition');
              $("#petty-cash")[0].reset();
            });
            $("#response").delay(6000).fadeOut(function(){});
            //setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 2) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, there was an error posting the requisition, please try again</div>');
              $("#petty_cash").html('Post Requisition');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
          if(response == 3) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> The petty cash requisition  has been approved successfuly.</div>');
              $("#approve_petty").html('Approve Requisition');
              $("#petty-cash")[0].reset();
            });
            $("#response").delay(6000).fadeOut(function(){});
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 4) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, there was an error approving the requisition, please try again</div>');
              $("#approve_petty").html('Approve Requisition');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
        }
      });
      return false;
    }  

    //request an advance
    $("#request-advance").validate({
      rules: {
        action:{required:true},
        start:{required:true},
        end:{required:true},
        amount:{required:true},
        reasons:{required:true},
        comment:{required:true},
        paid_date:{required:true},
      },
      messages: {
        action:"Please select the action",
        start:"Please enter starting month of installment",
        end:"Please enter ending  month of installment",
        amount:"Please enter amount",
        reasons:"Please enter purpose of the requested advance",
        comment:"Please enter comments on status of previous advances",
        paid_date:"Please enter date of payment",
      },
      submitHandler: requestAdvance  
    });    
    /* Handling form functionality */
    function requestAdvance() {    
      var data = $("#request-advance").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#response").fadeOut();
          $("#request_advance").html(' Posting Request...');
          $("#verify_advance").html(' Verifying...');
          $("#check_advance").html(' Checking...');
          $("#approve_advance").html(' Approving...');
          $("#make_payment").html(' Posting...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> Your staff advance request has been posted successfuly.</div>');
              $("#request_advance").html('Advance Request');
              $("#request-advance")[0].reset();
            });
            $("#response").delay(6000).fadeOut(function(){});
            //setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 2) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, there was an error posting the staff advance request, please try again</div>');
              $("#request_advance").html('Advance Request');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
          if(response == 3) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-warning"> The repayment period can not be more than 3 months, please check your start and end dates.</div>');
              $("#request_advance").html('Advance Request');
            });
            $("#response").delay(6000).fadeOut(function(){});
            //setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 4) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, make sure the start and end dates are in order.</div>');
              $("#request_advance").html('Advance Request');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
          if(response == 5) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> The advance request has been verified successfuly.</div>');
              $("#verify_advance").html('Verify Advance');
              //request-advance
            });
            $("#response").delay(6000).fadeOut(function(){});
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 6) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, there was an error verifying the advance request, please try again.</div>');
              $("#verify_advance").html('Verify Advance');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
          if(response == 7) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> The advance request has been checked successfuly.</div>');
              $("#check_advance").html('Check Advance');
              //request-advance
            });
            $("#response").delay(6000).fadeOut(function(){});
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 8) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, there was an error checking the advance request, please try again.</div>');
              $("#check_advance").html('Check Advance');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }

          if(response == 9) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> The advance request has been approved successfuly.</div>');
              $("#approve_advance").html('Approve Advance');
              //request-advance
            });
            $("#response").delay(6000).fadeOut(function(){});
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 10) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, there was an error approving the advance request, please try again.</div>');
              $("#approve_advance").html('Approve Advance');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
          if(response == 11) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> The advance repayment has been recorded successfuly.</div>');
              $("#make_payment").html('Make Payment');
              //request-advance
            });
            $("#response").delay(6000).fadeOut(function(){});
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 12) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, there was an error recording the advance repayment, please try again.</div>');
              $("#make_payment").html('Make Payment');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
          else if(response == 13) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> Sorry, the remaining balance can not be less than zero, check the figures.</div>');
              $("#make_payment").html('Make Payment');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
        }
      });
      return false;
    } 

    //add invoice
    $("#add-invoice").validate({
      rules: {
        sacco:{required:true},
        description:{required:true},
        invoice_number:{required:true},
        amount:{required:true},
        amount_paid:{required:true},
        invoice:{required:true},
        category_name:{required:true},
        due_date:{required:true}
      },
      messages: {
        sacco:"Please select the owner of the invoice",
        description:"Please give the invoice a description.",
        invoice_number:"Please enter invoice number",
        invoice:"Please attach the scanned invoice",
        amount:"Please enter the amount on invoice",
        amount_paid:"Please enter the amount paid",
        category_name:"Please enter the category name",
        due_date:"Please enter due date",
      },
      submitHandler: addInvoice  
    });    
    /* Handling form functionality */
    function addInvoice() {    
      var formData = $("#add-invoice").submit(function () {
          return;
      });
      var formData = new FormData(formData[0]);       
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : formData,
        beforeSend: function(){ 
          $("#response").fadeOut();
          $("#add_invoice").html('Saving Invoice...');
          $("#add_category").html('Saving Category...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> An invoice has been saved successfuly.</div>');
              $("#add_invoice").html('Save Invoice');

            });
            setTimeout(' window.location.href = ""; ', 4000);
          } else if(response == 2) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> An error occoured saving the invoice, please try again.</div>');
              $("#add_invoice").html('Save Invoice');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
          else if(response == 3) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> There was an error uploading the invoice, please try again.</div>');
              $("#add_invoice").html('Save Invoice');
            });
            $("#response").delay(6000).fadeOut(function(){});
          }
          else if(response == 4) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-danger"> The file extension of the invoice attached is not supported, it must be pdf, doc, docx, jpg or jpeg.</div>');
              $("#add_invoice").html('Save Invoice');
            });
            $("#response").delay(10000).fadeOut(function(){});
          }
          else if(response == 6) {                 
            $("#response").fadeIn(1000, function(){            
              $("#response").html('<div class="alert alert-success"> An invoice has been updated successfuly.</div>');
              $("#add_invoice").html('Save Invoice');
            });
            setTimeout(' window.location.href = ""; ', 4000);
          }

          if(response == 7) {                 
            $("#response_cat").fadeIn(1000, function(){            
              $("#response_cat").html('<div class="alert alert-success"> A category has been added successfuly.</div>');
              $("#add_category").html('Add Category');
            });
            setTimeout(' window.location.href = ""; ', 4000);
          }
          if(response == 8) {                 
            $("#response_cat").fadeIn(1000, function(){            
              $("#response_cat").html('<div class="alert alert-success"> An invoice has been updated successfuly.</div>');
              $("#add_category").html('Add Category');
            });
            $("#response_cat").delay(10000).fadeOut(function(){});
          }


          getPendinginvoices();
        },
        contentType: false,
        processData: false,
        cache: false
      });
      return false;
    }

    //update invoice status
    $("#update-invoice").validate({
      rules: {
        status: {required: true},
        comment: {required: true},
        amount:{required:true}
      },
      messages: {
        status:{required: "Please select invoice status"},
        comment:{required: "Please enter invoice status comment"},
        amount:{required:"Please enter amount paid"}
      },
      submitHandler: updateInvoice  
    });    
    /* Handling form functionality */
    function updateInvoice() {    
      //var data = $("#update-invoice").serialize(); 
      var formData = $("#update-invoice").submit(function () {
          return;
      });
      var formData = new FormData(formData[0]);       
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : formData,
        beforeSend: function(){ 
          $("#update_response").fadeOut();
          $("#update_invoice").html(' Updating Invoice...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#update_response").fadeIn(1000, function(){            
              $("#update_response").html('<div class="alert alert-success"> Invoice details have been updated successfuly!</div>');
              $("#update_invoice").html('Update Invoice');
            });
            $("#update_response").delay(6000).fadeOut(function(){});
          } 
          else if(response == 3) {                 
            $("#update_response").fadeIn(1000, function(){            
              $("#update_response").html('<div class="alert alert-success"> Invoice status has been updated successfuly!</div>');
              $("#update_invoice").html('Update Invoice');
            });
            setTimeout(' window.location.href = ""; ', 4000);
          } 
          else if(response == 2) {                 
            $("#update_response").fadeIn(1000, function(){            
              $("#update_response").html('<div class="alert alert-danger"> Sorry, either there was an error or there is no new information to update!</div>');
              $("#update_invoice").html('Update Invoice');
            });
            $("#update_response").delay(6000).fadeOut(function(){});
          }
        },
        contentType: false,
        processData: false,
        cache: false
      });
      return false;
    } 

    //add event
    $("#add-event").validate({
      rules: {
        title:{required:true},
        venue:{required:true},
        description:{required:true},
        date_from:{required:true},
        access_rights:{required:true}
      },
      messages: {
        title:"Please enter event title",
        venue:"Please enter event venue",
        description:"Please enter event description",
        date_from:"Please enter start date",
        access_rights:"Please select authorised usergroup"
      },
      submitHandler: addEvent  
    });    
    /* Handling form functionality */
    function addEvent() {    
      //var data = $("#add-event").serialize(); 
      var formData = $("#add-event").submit(function () {
          return;
      });
      var formData = new FormData(formData[0]);         
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : formData,
        beforeSend: function(){ 
          $("#error").fadeOut();
          $("#add_event").html(' Adding Event...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> An event has been saved!</div>');
              $("#add_event").html('Add Event');
            });
            setTimeout(' window.location.href = ""; ', 4000);
          } else if(response == 2) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error adding the event, please try again!</div>');
              $("#add_event").html('Add Event');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 5) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> The event start date can not be a date in the past, please chack the dates.</div>');
              $("#add_event").html('Add Event');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 6) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> The event start date can not be a date in the future than the end date, please chack the dates.</div>');
              $("#add_event").html('Add Event');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
        },
        contentType: false,
        processData: false,
        cache: false
      });
      return false;
    }


    //leave types, FY, add leave days 
    $("#leave-type").validate({
      rules: {
        name:{required:true},
        leave:{required:true},
        days:{required:true},
        start_date:{required:true},
        end_date:{required:true},
        leave_days:{required:true}
      },
      messages: {
        name:{required:"Please enter the leave type"},
        leave:{required:"Please select leave type"},
        days:{required:"Please eneter leave days entitled"},
        start_date:{required:"Please select start of FY"},
        end_date:{required:"Please select end of FY"},
        leave_days:{required:"Please enter verified leave days"}
      },
      submitHandler: addLeave  
    });    
    /* Handling form functionality */
    function addLeave() {    
      var data = $("#leave-type").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#product_response").fadeOut();
          $("#add_leave").html(' Adding Leave Type...');
          $("#assign_leave").html(' Saving...');
          $("#add_fy").html(' Saving FY...');
          $("#update_status").html(' Updating Status...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#product_response").fadeIn(1000, function(){            
              $("#product_response").html('<div class="alert alert-success"> A new leave type has been saved successfuly.</div>');
              $("#add_leave").html('Add Leave');
              $("#leave-type")[0].reset();
            });
            $("#product_response").delay(6000).fadeOut(function(){});
            getLeave();
          }else if(response == 2) {                 
            $("#product_response").fadeIn(1000, function(){            
              $("#product_response").html('<div class="alert alert-danger"> Sorry, there was an error saving the leave type, please try again.</div>');
              $("#add_leave").html('Add Leave');
            });
            $("#product_response").delay(6000).fadeOut(function(){});
          }
          else if(response == 3) {                 
            $("#product_response").fadeIn(1000, function(){            
              $("#product_response").html('<div class="alert alert-success"> The employee entitlement has been saved successfuly.</div>');
              $("#assign_leave").html('Save Days');
              $("#leave-type")[0].reset();
            });
            $("#product_response").delay(6000).fadeOut(function(){});
            getDays();
          }
          else if(response == 4) {                 
            $("#product_response").fadeIn(1000, function(){            
              $("#product_response").html('<div class="alert alert-danger"> Sorry, there was an error saving the employee entitlement, please try again.</div>');
              $("#assign_leave").html('Save Days');
            });
            $("#product_response").delay(6000).fadeOut(function(){});
          }
          else if(response == 5) {                 
            $("#product_response").fadeIn(1000, function(){            
              $("#product_response").html('<div class="alert alert-success"> The financial year has been updated successfuly.</div>');
              $("#add_fy").html('Update FY');
              $("#leave-type")[0].reset();
            });
            $("#product_response").delay(6000).fadeOut(function(){});
            getFY();
          }
          else if(response == 6) {                 
            $("#product_response").fadeIn(1000, function(){            
              $("#product_response").html('<div class="alert alert-danger"> Sorry, there was an error updating the financial year, please try again.</div>');
              $("#add_fy").html('Update FY');
            });
            $("#product_response").delay(6000).fadeOut(function(){});
          }

          else if(response == 7) {                 
            $("#product_response").fadeIn(1000, function(){            
              $("#product_response").html('<div class="alert alert-success"> The leave application status has been updated successfuly.</div>');
            });
            setTimeout(' window.location.href = ""; ', 6000);
          }
          else if(response == 8) {                 
            $("#product_response").fadeIn(1000, function(){            
              $("#product_response").html('<div class="alert alert-danger"> Sorry, there was an error updating the leave application, please try again.</div>');
            });
            $("#product_response").delay(6000).fadeOut(function(){});
          }


        }
      });
      return false;
    } 

    //apply leave
    $("#apply-leave").validate({
      rules: {
        type:{required:true},
        leave_roaster:{required:true},
        leave_grant:{required:true},
        date_from:{required:true},
        date_to:{required:true}
      },
      messages: {
        type:{required:"Please select the leave type"},
        leave_roaster:{required:"Please select a response to the question"},
        leave_grant:{required:"Please select a response to the question"},
        date_from:{required:"Please select start of leave"},
        date_to:{required:"Please select end of leave"}
      },
      submitHandler: applyLeave  
    });    
    /* Handling form functionality */
    function applyLeave() {    
      var data = $("#apply-leave").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#error").fadeOut();
          $("#apply_leave").html(' Applying Leave...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> A new leave application has been posted successfuly.</div>');
              $("#apply_leave").html('Add Leave');
              $("#apply-leave")[0].reset();
            });
            $("#error").delay(6000).fadeOut(function(){});
            
          }else if(response == 2) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error posting the new leave application, please try to refresh and submit again.</div>');
              $("#apply_leave").html('Add Leave');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
        }
      });
      return false;
    } 

    $("#add-topic").validate({
      rules: {
        title:{required:true},
        description:{required:true},
        access_rights:{required:true}
      },
      messages: {
        title:{required:"Please enter the topic"},
        description:{required:"Please enter description of the topic"},
        access_rights:{required:"Please choose who can see and comment on your topic"}
      },
      submitHandler: addTopic  
    });    
    /* Handling form functionality */
    function addTopic() {    
      var data = $("#add-topic").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#topic_response").fadeOut();
          $("#add_topic").html(' Adding Topic...');
          $("#add_comment").html(' Commenting...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#topic_response").fadeIn(1000, function(){            
              $("#topic_response").html('<div class="alert alert-success"> A new topic has been posted.</div>');
              $("#add_topic").html('Add Topic');
              $("#add-topic")[0].reset();
            });
            $("#topic_response").delay(6000).fadeOut(function(){});
            getTopics();
            
          }else if(response == 2) {                 
            $("#topic_response").fadeIn(1000, function(){            
              $("#topic_response").html('<div class="alert alert-danger"> Sorry, there was an error posting the new topic , please try to refresh and submit again.</div>');
              $("#add_topic").html('Add Topic');
            });
            $("#topic_response").delay(6000).fadeOut(function(){});
          }
          else if(response == 3){
            $("#add-topic")[0].reset();
            $("#add_comment").html('Comment');
            getComments();
          }
          else if(response == 4) {                 
            $("#topic_response").fadeIn(1000, function(){            
              $("#topic_response").html('<div class="alert alert-danger"> Sorry, there was an error posting your comment, please try to refresh and submit again.</div>');
              $("#add_comment").html('Comment');
            });
            $("#topic_response").delay(6000).fadeOut(function(){});
          }
        }
      });
      return false;
    } 

    $("#add-ticket").validate({
      rules: {
        title:{required:true},
        product:{required:true},
        description:{required:true},
        priority:{required:true},
        category:{required:true}
      },
      messages: {
        title:"Please enter ticket title",
        product:"Please select the product with an issue",
        description:"Please enter event description",
        priority:"Please select ticket priority",
        category:"Please select ticket category"
      },
      submitHandler: addTicket  
    });    
    /* Handling form functionality */
    function addTicket() {    
      //var data = $("#add-event").serialize(); 
      var formData = $("#add-ticket").submit(function () {
          return;
      });
      var formData = new FormData(formData[0]);         
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : formData,
        beforeSend: function(){ 
          $("#error").fadeOut();
          $("#add_ticket").html('Adding Ticket...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> A new ticket has been submitted successfully!</div>');
              $("#add_ticket").html('Add Ticket');
              
            });
            $("#error").delay(6000).fadeOut(function(){});
            //$("#add-topic")[0].reset();
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 2) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error submitting the ticket, please try again!</div>');
              $("#add_ticket").html('Add Ticket');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
        },
        contentType: false,
        processData: false,
        cache: false
      });
      return false;
    }

    $("#vehicle-request").validate({
      rules: {
        driver:{required:true},
        destination:{required:true},
        date_from:{required:true},
        date_to:{required:true},
        activity:{required:true}
      },
      messages: {
        driver:"Please enter the name of the driver",
        destination:"Please enter the destination",
        date_from:"Please select departure date",
        date_to:"Please select arrival date",
        activity:"Please enter the name of the activity"
      },
      submitHandler: vehicleRequest  
    });    
    /* Handling form functionality */
    function vehicleRequest() {    
      //var data = $("#add-event").serialize(); 
      var formData = $("#vehicle-request").submit(function () {
          return;
      });
      var formData = new FormData(formData[0]);         
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : formData,
        beforeSend: function(){ 
          $("#error").fadeOut();
          $("#vehicle_request").html('Submitting Request...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> Your vehicle request has been submitted successfully!</div>');
              $("#vehicle_request").html('Submit Request');
              $("#vehicle-request")[0].reset();
            });
            $("#error").delay(6000).fadeOut(function(){});
            
            //setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 2) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error submitting the vehicle request, please try again!</div>');
              $("#vehicle_request").html('Submit Request');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
        },
        contentType: false,
        processData: false,
        cache: false
      });
      return false;
    }

    //assign vehicle
    $("#assign-vehicle").validate({
      rules: {
        reg_number:{required:true},
        mileage:{required:true},
        fuel:{required:true},
        dent:{required:true},
        clean:{required:true},
        tools:{required:true},
        spare:{required:true}
      },
      messages: {
        reg_number:"Please enter the RN of the assigned vehicle",
        mileage:"Please enter the opening mileage",
        fuel:"Please select fuel level",
        dent:"",
        clean:"",
        tools:"",
        spare:""
      },
      submitHandler: assignVehicle  
    });    
    /* Handling form functionality */
    function assignVehicle() {    
      var data = $("#assign-vehicle").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#assign_response").fadeOut();
          $("#assign_vehicle").html('Assigning Vehicle...');
          $("#receive_vehicle").html('Receiving Vehicle...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#assign_response").fadeIn(1000, function(){            
              $("#assign_response").html('<div class="alert alert-success"> A vehicle has been assigned successfully!</div>');
              $("#assign_vehicle").html('Assign Vehicle');
              $("#assign-vehicle")[0].reset();
            });
            $("#assign_response").delay(6000).fadeOut(function(){});
            
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 2) {                 
            $("#assign_response").fadeIn(1000, function(){            
              $("#assign_response").html('<div class="alert alert-danger"> Sorry, there was an error assigning the vehicle, please try again!</div>');
              $("#assign_vehicle").html('Assign Vehicle');
            });
            $("#assign_response").delay(6000).fadeOut(function(){});
          }
          if(response == 3) {                 
            $("#authorize_response").fadeIn(1000, function(){            
              $("#authorize_response").html('<div class="alert alert-success"> A vehicle has been authorised successfully!</div>');
              $("#authorize_vehicle").html('Assign Vehicle');
              $("#assign-vehicle")[0].reset();
            });
            $("#authorize_response").delay(6000).fadeOut(function(){});
            
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 4) {                 
            $("#authorize_response").fadeIn(1000, function(){            
              $("#authorize_response").html('<div class="alert alert-danger"> Sorry, there was an error authorizing the vehicle, please try again!</div>');
              $("#authorize_vehicle").html('Assign Vehicle');
            });
            $("#authorize_response").delay(6000).fadeOut(function(){});
          }
          if(response == 5) {                 
            $("#authorize_response").fadeIn(1000, function(){            
              $("#authorize_response").html('<div class="alert alert-success"> A vehicle has been received successfully!</div>');
              $("#receive_vehicle").html('Assign Vehicle');
              $("#assign-vehicle")[0].reset();
            });
            $("#authorize_response").delay(6000).fadeOut(function(){});
            
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 6) {                 
            $("#authorize_response").fadeIn(1000, function(){            
              $("#authorize_response").html('<div class="alert alert-danger"> Sorry, there was an error marking as received, please try again!</div>');
              $("#receive_vehicle").html('Assign Vehicle');
            });
            $("#authorize_response").delay(6000).fadeOut(function(){});
          }
        }
      });
      return false;
    }

    //add member
    $("#add-member").validate({
      rules: {
        password: {
          required: true,
          minlength: 8

        },
        re_password: {
          required: true,
          equalTo:"#password"
        },
        first_name: {required:true},
        last_name: {required:true},
        emp_number: {required:true},
        username: {required:true},
        position: {required:true},
        department: {required:true},

      },
      messages: {
        password:{
          required: "Please enter the password"
         },
        re_password: {
          required:"Please re enter the password",
          equalTo: "Please confirm the password entered"
        },
        first_name:"Please enter the first name",
        last_name:"Please enter the last name",
        username:"Please enter the username",
        emp_number:"Please enter the employment number",
        position:"Please select the position of the staff member",
        department:"Please select the department of the staff member",
      },
      submitHandler: addMember  
    });    
    /* Handling form functionality */
    function addMember() {    
      var data = $("#add-member").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#error").fadeOut();
          $("#save_member").html('Saving Member...');
          $("#update_member").html('Updating Details...');
        },
        success : function(response){  //alert(response);
          if(response == 1){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> You have updated your details successfuly!</div>');
              $("#save_member").html('Save');
              $("#update_member").html('Update Details');
            });
            //$("#add-member")[0].reset();
            $("#error").delay(6000).fadeOut(function(){});
          }else if(response == 2){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error updating your details or there is no new information to save!</div>');
              $("#save_member").html('Save');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 3){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error updating your details or there is no new information to save</div>');
              $("#update_member").html('Update Details');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }

          else if(response == 6){
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success"> DE details have been updated successfuly.</div>');
          $("#update_member").html('Update Details');
        });
        //$("#add-member")[0].reset();
        $("#error").delay(6000).fadeOut(function(){});
      }

      else if(response == 7) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error updating the DE\'s details, please try again.</div>');
              $("#update_member").html('Update Details');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          
        }
      });
      return false;
    } 
    /* end script */ 

    //add member
    $("#update-ge").validate({
      rules: {

      },
      messages: {
      },
      submitHandler: updateGE  
    });    
    /* Handling form functionality */
    function updateGE() {    
      var data = $("#update-ge").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#error").fadeOut();
          $("#save_member").html('Saving Member...');
          $("#update_member1").html('Updating Details...');
        },
        success : function(response){  //alert(response);
          if(response == 1){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> You have updated your details successfuly!</div>');
              $("#save_member").html('Save');
              $("#update_member").html('Update Details');
            });
            //$("#add-member")[0].reset();
            $("#error").delay(6000).fadeOut(function(){});
          }else if(response == 2){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error updating your details or there is no new information to save!</div>');
              $("#save_member").html('Save');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 3){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error updating your details or there is no new information to save</div>');
              $("#update_member").html('Update Details');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }

          else if(response == 6){
            $("#err").fadeIn(1000, function(){            
              $("#err").html('<div class="alert alert-success"> DE details have been updated successfuly.</div>');
              $("#update_member1").html('Update Details');
            });
            //$("#add-member")[0].reset();
            $("#err").delay(6000).fadeOut(function(){});
          }

          else if(response == 7) {                 
            $("#err").fadeIn(1000, function(){            
              $("#err").html('<div class="alert alert-danger"> Sorry, there was an err updating the DE\'s details, please try again.</div>');
              $("#update_member1").html('Update Details');
            });
            $("#err").delay(6000).fadeOut(function(){});
          }
          
        }
      });
      return false;
    } 
    /* end script */ 

    $("#change-username").validate({
      rules: {
        username:{required:true}
      },
      messages: {
        username:{required:"Please enter the new username"}
      },
      submitHandler: changeUsername  
    });    
    /* Handling form functionality */
    function changeUsername() {    
      var data = $("#change-username").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#username_response").fadeOut();
          $("#change_username").html(' Changing Username...');
        },
        success : function(response){ //alert(response);
          if(response == 5) {                 
            $("#username_response").fadeIn(1000, function(){            
              $("#username_response").html('<div class="alert alert-danger"> Sorry, the username entered is already in use, please choose a different username.</div>');
              $("#change_username").html('Change Username');
            });
            
            $("#username_response").delay(6000).fadeOut(function(){});
          }else if(response == 4) {                 
            $("#username_response").fadeIn(1000, function(){            
              $("#username_response").html('<div class="alert alert-danger"> Sorry, there was an error changing the username, please try again.</div>');
              $("#change_username").html('Change Username');
            });
            $("#username_response").delay(6000).fadeOut(function(){});
          }
          else if(response == 3) {                 
            $("#username_response").fadeIn(1000, function(){            
              $("#username_response").html('<div class="alert alert-success"> The username has been changed successfuly.</div>');
              $("#change_username").html('Change Username');
            });
            $("#username_response").delay(6000).fadeOut(function(){});
          }


        }
      });
      return false;
    } 

     //reset password
    $("#reset-password").validate({
      rules: {
        password: {
          required: true,
          minlength: 8
        },
        re_password: {
          required: true,
          equalTo:"#password"
        },
        old_password:{required:true},
        username:{required:true}
      },
      messages: {
        password:{
          required: "Please enter the new password"
        },
        re_password:{
          required: "Please re enter the new password to confirm"
        },
        username:{required:"Please enter the new username"},
        old_password:"Please enter your current password"
      },
      submitHandler: resetPassword  
    });    
    /* Handling form functionality */
    function resetPassword() {    
      var data = $("#reset-password").serialize();        
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : data,
        beforeSend: function(){ 
          $("#password_response").fadeOut();
          $("#reset").html(' Resetting Password...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#password_response").fadeIn(1000, function(){            
              $("#password_response").html('<div class="alert alert-success"> The password has been changed successfuly!</div>');
              $("#reset").html('Reset Password');          
            });
            $("#password_response").delay(6000).fadeOut(function(){});
                    
            
          } else if(response == 2) {                 
            $("#password_response").fadeIn(1000, function(){            
              $("#password_response").html('<div class="alert alert-danger"> Sorry, there was an error updating the password, please try again.</div>');
              $("#reset").html('Reset Password');
            });
            $("#password_response").delay(6000).fadeOut(function(){});
          }

          else if(response == 3) {                 
            $("#password_response").fadeIn(1000, function(){            
              $("#password_response").html('<div class="alert alert-danger"> The current password entered is incorrect.</div>');
              $("#reset").html('Reset Password');
            });
            $("#password_response").delay(6000).fadeOut(function(){});
          }
          else if(response == 4) {                 
            $("#password_response").fadeIn(1000, function(){            
              $("#password_response").html('<div class="alert alert-danger"> Make sure your password includes an uppercase & lowercase letter, a number,and one special character.</div>');
              $("#reset").html('Reset Password');
            });
            $("#password_response").delay(6000).fadeOut(function(){});
          }
        }
      });
      return false;
    } 

    //btn_ticket_delete
    $(document).on('click', '.btn_ticket_delete', function(){
       var id=$(this).data("id3");
       var file = $(this).data("file");

       if(confirm("Are you sure you want to delete this ticket?")){
           var action='ticket_delete';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, file:file, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-success" role="alert"> The selected ticket has been deleted.</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 6000);
                   }else{
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleteting the selected ticket, please try again!</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });


    //delete event
    $(document).on('click', '.btn_event_delete', function(){
       var id=$(this).data("id3");
       var file = $(this).data("file");

       if(confirm("Are you sure you want to delete this event?"))
       {
           var action='delete_event';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action, file:file},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-success" role="alert"> The selected event has been deleted successfully!</div>');
                       });
                       setTimeout(' window.location.href = ""; ', 4000);
                   }else{
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting the  selected event, please try again!</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });

    //cancel event
    $(document).on('click', '.btn_event_cancel', function(){
       var id=$(this).data("id3");


       if(confirm("Are you sure you want to cancel this event?"))
       {
           var action='cancel_event';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-success" role="alert"> The selected event has been marked as cancelled successfully!</div>');
                       });
                       setTimeout(' window.location.href = ""; ', 4000);
                   }else{
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error marking the  selected event as cancelled, please try again!</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });

    //complete event
    $(document).on('click', '.btn_event_complete', function(){
       var id=$(this).data("id3");


   if(confirm("Are you sure you want to mark this event as complete?"))
   {
       var action='complete_event';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-success" role="alert"> The selected event has been marked as complete successfully!</div>');
                   });
                   setTimeout(' window.location.href = ""; ', 4000);
               }else{
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error marking the  selected event as complete, please try again!</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
               }
           }
       });
   }
    });

    //add document
    $("#add-document").validate({
      rules: {
        category: {required: true},
        title: {required: true},
        file: {required: true},
        access_rights: {required: true},
      },
      messages: {
        category:{required: "Please select document category"},
        title:{required: "Please enter document title"},
        file:{required: "Please select a document to upload"},
        access_rights:{required: "Please select authorised usergroup"},
      },
      submitHandler: addDocument  
    });    
    /* Handling form functionality */
    function addDocument() {    
      //var data = $("#add-document").serialize(); 
      var formData = $("#add-document").submit(function () {
          return;
      });
      var formData = new FormData(formData[0]);       
      $.ajax({        
        type : 'POST',
        url  : '../../settings/sql-master.php',
        data : formData,
        beforeSend: function(){ 
          $("#error").fadeOut();
          $("#add_document").html(' Uploading Document...');
        },
        success : function(response){ //alert(response);
          if(response == 1) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> A document has been uploaded.</div>');
              $("#add_document").html('Upload Document');
            });
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 2) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error uploading the document, please try again.</div>');
              $("#add_document").html('Upload Document');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
        },
        contentType: false,
        processData: false,
        cache: false
      });
      return false;
    } 

    //delete documents
    $(document).on('click', '.delete_document', function(){
       var id=$(this).data("id3");
       var doc=$(this).data("doc");


       if(confirm("Are you sure you want to delete this document?"))
       {
           var action='delete_document';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action, doc:doc},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#doc_response").fadeIn(1000, function(){
                           $("#doc_response").html('<div class="alert alert-success" role="alert"> The selected document has been deleted !</div>');
                       });
                       setTimeout(' window.location.href = ""; ', 6000);
                   }else{
                       $("#doc_response").fadeIn(1000, function(){
                           $("#doc_response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting the  selected document!</div>');
                       });
                       $("#doc_response").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });

    //delete document category
    $(document).on('click', '.delete_category', function(){
       var id=$(this).data("id3");
       var doc=$(this).data("doc");


       if(confirm("Are you sure you want to delete this document category?"))
       {
           var action='delete_category';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action, doc:doc},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#category_msg").fadeIn(1000, function(){
                           $("#category_msg").html('<div class="alert alert-success" role="alert"> The selected category has been deleted !</div>');
                       });
                       $("#category_msg").delay(6000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 6000);
                   }else{
                       $("#category_msg").fadeIn(1000, function(){
                           $("#category_msg").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting the  selected category!</div>');
                       });
                       $("#category_msg").delay(6000).fadeOut(function(){});
                   }
                  getDocCategories();
               }
           });
       }
    });

    //delete_topic
    $(document).on('click', '.delete_topic', function(){
       var id=$(this).data("id3");


       if(confirm("Are you sure you want to delete this topic?"))
       {
           var action='delete_topic';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#topic_response").fadeIn(1000, function(){
                           $("#topic_response").html('<div class="alert alert-success" role="alert"> The selected topic has been deleted !</div>');
                       });
                       $("#topic_response").delay(6000).fadeOut(function(){});
                       //setTimeout(' window.location.href = ""; ', 6000);
                   }else{
                       $("#topic_response").fadeIn(1000, function(){
                           $("#topic_response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting the  selected topic!</div>');
                       });
                       $("#topic_response").delay(6000).fadeOut(function(){});
                   }
                  getTopics();
               }
           });
       }
    });

  });
  
  
</script>