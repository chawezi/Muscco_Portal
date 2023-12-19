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
    function getResponses(id){
      let action = "show_responses";
      $.ajax({
          url:"get_tickets_data.php",
          method:"GET",
          data:{action:action, id:id},
          success:function(data){ 
              $('#show_responses').html(data);
          }
      });
    }
    function getPositions(){
      let action = "get_positions";
      $.ajax({
          url:"get_department_data.php",
          method:"GET",
          data:{action:action},
          success:function(data){ 
              $('#show_positions').html(data);
          }
      });
    }

    //apply loan
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
        success : function(response){  alert(response);
          if(response == 1){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> The staff member details has been saved successfuly!</div>');
              $("#save_member").html('Save');
              $("#update_member").html('Update Details');
            });
            $("#add-member")[0].reset();
            $("#error").delay(6000).fadeOut(function(){});
          }else if(response == 2){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error saving the staff member!</div>');
              $("#save_member").html('Save');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 3){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error saving the staff details or there is no new information to save!</div>');
              $("#update_member").html('Update Details');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }

          else if(response == 4){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> Your details has been updated successfuly!</div>');
              $("#update_member").html('Update Details');
            });
            $("#error").delay(6000).fadeOut(function(){});
            setTimeout(' window.location.href = ""; ', 6000);
          }
          else if(response == 5){
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there is no new information to update!</div>');
              $("#update_member").html('Update Details');
            });
            $("#error").delay(6000).fadeOut(function(){});
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
            setTimeout(' window.location.href = ""; ', 6000);
                    
            
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

    //add event
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

    $("#manage-departments").validate({
    rules: {
      department: {required: true}
    },
    messages: {
      department:{required: "Please enter department name"}
    },
    submitHandler: manageDepartment  
  });    
  /* Handling form functionality */
  function manageDepartment() {    
    var data = $("#manage-departments").serialize();        
    $.ajax({        
      type : 'POST',
      url  : '../../settings/sql-master.php',
      data : data,
      beforeSend: function(){ 
        $("#error").fadeOut();
        $("#manage_department").html(' Saving...');
      },
      success : function(response){ 
        if(response == 1) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success"> Department has been saved!</div>');
          $("#manage_department").html('Submit');
        });
        $("#manage-departments")[0].reset();
        $("#error").delay(6000).fadeOut(function(){});
      }
      getDepartments();
      }
    });
    return false;
  } 

    //delete_position
    $(document).on('click', '.delete_position', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete this position?"))
       {
           var action='delete_position';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#positions_response").fadeIn(1000, function(){
                           $("#positions_response").html('<div class="alert alert-success" role="alert"> The selected position has been deleted successfuly.</div>');
                       });
                       $("#positions_response").delay(6000).fadeOut(function(){});
                       //setTimeout(' window.location.href = ""; ', 4000);

                   }else{
                       $("#positions_response").fadeIn(1000, function(){
                           $("#positions_response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting that positions, please try again!</div>');
                       });
                       $("#positions_response").delay(6000).fadeOut(function(){});
                   }
                   getPositions();
               }
           });
       }
    });

    //delete department
    $(document).on('click', '.delete_department', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete this department?"))
       {
           var action='delete_department';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#department_response").fadeIn(1000, function(){
                           $("#department_response").html('<div class="alert alert-success" role="alert"> The selected department has been deleted successfuly.</div>');
                       });
                       $("#department_response").delay(6000).fadeOut(function(){});
                   }else{
                       $("#department_response").fadeIn(1000, function(){
                           $("#department_response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting that dep, please try again!</div>');
                       });
                       $("#department_response").delay(6000).fadeOut(function(){});
                   }
                   getDepartments();
               }
           });
       }
    });

    //grant_access rights to  a member
$(document).on('click', '.grant_access', function(){
   var id=$(this).data("id3");
   var member = $(this).data("member");

   if(confirm("Are you sure you want to grant this permision to this member?"))
   {
       var action='grant_access';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, member:member, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-success" role="alert"> The member has been granted the selected permision.</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 4000);
               }else if(data == 2){
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error granting that permision, please try again!</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
               }else if(data == 3){
                $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, that permision has already been granted.</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
               }
               getUserAccess();
           }
       });
   }
});

//revoke_access rights to  a member
$(document).on('click', '.revoke_permision', function(){
   var id=$(this).data("id3");
   var pem=$(this).data("id4");
   var member = $(this).data("member");

   if(confirm("Are you sure you want to revoke this permision from this member?"))
   {
       var action='revoke_permision';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, member:member, pem:pem, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-success" role="alert"> The selected permision has been revoked from the selected member.</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 4000);
               }else{
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error revoking that permision, please try again!</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
               }
               getUserAccess();
           }
       });
   }
});
    
  });
</script>