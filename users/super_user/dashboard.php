<?php include_once('../../layout/header.php'); ?>
<?php
//checks if right users are in the right directory
  if($_SESSION['USR_TYP'] != 0 && $_SESSION['USR_TYP'] == 1){
    header('Location:../admin/dashboard.php');
  }elseif($_SESSION['USR_TYP'] != 0 && $_SESSION['USR_TYP'] == 2){
    header('Location:../staff/dashboard.php');
  }elseif($_SESSION['USR_TYP'] != 0 && $_SESSION['USR_TYP'] == 3){
    header('Location:../member/dashboard.php');
  }elseif($_SESSION['USR_TYP'] != 0 && $_SESSION['USR_TYP'] == 4){
    header('Location:../des/dashboard.php');
  }

?>
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

    
    function getLeave(){
      let action = "get_leave_types";
      $.ajax({
          url:"get_leave_data.php",
          method:"GET",
          data:{action:action},
          success:function(data){ 
              $('#show_leave_types').html(data);
          }
      });
    }
     
    
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
    function getSacco(){
      let action = "get_sacco";
      $.ajax({
          url:"get_sacco_data.php",
          method:"POST",
          data:{action:action},
          success:function(data){ 
              $('#show_all_saccos').html(data);
          }
      });
    }
    function getPendinginvoices(){
      let action = "get_pending_invoices";
      $.ajax({
          url:"get_invoices_data.php",
          method:"POST",
          data:{action:action},
          success:function(data){ 
              $('#show_pending_invoices').html(data);
          }
      });
    }
    function getProducts(){
      let action = "get_products";
      $.ajax({
          url:"get_tickets_data.php",
          method:"GET",
          data:{action:action},
          success:function(data){ 
              $('#show_ticket_products').html(data);
          }
      });
    }
    function getTicketCategories(){
      let action = "get_categories";
      $.ajax({
          url:"get_tickets_data.php",
          method:"GET",
          data:{action:action},
          success:function(data){ 
              $('#show_ticket_categories').html(data);
          }
      });
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
      amount:"Please enter amount that is less than 5,000",
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



$("#update-sacco").validate({
    rules: {
      name: {required: true},
      president: {required: true},
    },
    messages: {
      name:{required: "Please enter sacco name"},
      president:{required: "Please enter sacco president"},
    },
    submitHandler: updateSacco  
  });    
  /* Handling form functionality */
function updateSacco() {    
  var data = $("#update-sacco").serialize();        
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#sacco_response").fadeOut();
      $("#update_sacco").html(' Updating Sacco...');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
        $("#sacco_response").fadeIn(1000, function(){            
          $("#sacco_response").html('<div class="alert alert-success"> Sacco details have been updated successfuly!</div>');
          $("#update_sacco").html('Update Sacco');
        });
        $("#sacco_response").delay(6000).fadeOut(function(){});
      } else if(response == 2) {                 
        $("#sacco_response").fadeIn(1000, function(){            
          $("#sacco_response").html('<div class="alert alert-danger"> Sorry, either there was an error or there is no new information to update!</div>');
          $("#update_sacco").html('Update Sacco');
        });
        $("#sacco_response").delay(6000).fadeOut(function(){});
      }
    }
  });
  return false;
} 
/* end  script */

$("#update-assets").validate({
  rules: {
    name: {required: true},
    president: {required: true},
  },
  messages: {
    name:{required: "Please enter sacco name"},
    president:{required: "Please enter sacco president"},
  },
  submitHandler: updateAssets  
});    
/* Handling form functionality */
function updateAssets() {    
  var data = $("#update-assets").serialize();        
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#assets_response").fadeOut();
      $("#update_assets").html(' Updating Sacco...');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
        $("#assets_response").fadeIn(1000, function(){            
          $("#assets_response").html('<div class="alert alert-success"> Sacco details have been updated successfuly!</div>');
          $("#update_assets").html('Update Details');
        });
        $("#assets_response").delay(6000).fadeOut(function(){});
      } else if(response == 2) {                 
        $("#assets_response").fadeIn(1000, function(){            
          $("#assets_response").html('<div class="alert alert-danger"> Sorry, either there was an error or there is no new information to update!</div>');
          $("#update_assets").html('Update Details');
        });
        $("#assets_response").delay(6000).fadeOut(function(){});
      }
    }
  });
  return false;
} 

$("#update-membership").validate({
  rules: {
  },
  messages: {
  },
  submitHandler: updateMembership  
});    
/* Handling form functionality */
function updateMembership() {    
  var data = $("#update-membership").serialize();        
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#member_response").fadeOut();
      $("#update_member").html(' Updating Sacco...');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
        $("#member_response").fadeIn(1000, function(){            
          $("#member_response").html('<div class="alert alert-success"> Sacco details have been updated successfuly!</div>');
          $("#update_member").html('Update Details');
        });
        $("#member_response").delay(6000).fadeOut(function(){});
      } else if(response == 2) {                 
        $("#member_response").fadeIn(1000, function(){            
          $("#member_response").html('<div class="alert alert-danger"> Sorry, either there was an error or there is no new information to update!</div>');
          $("#update_member").html('Update Details');
        });
        $("#member_response").delay(6000).fadeOut(function(){});
      }
    }
  });
  return false;
}



//update invoice status
$("#update-invoice").validate({
  rules: {
    status: {required: true},
    comment: {required: true},
  },
  messages: {
    status:{required: "Please select invoice status"},
    comment:{required: "Please enter invoice status comment"},
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


//update asset event
$("#update-assets").validate({
  rules: {
    name: {required: true},
    president: {required: true},
  },
  messages: {
    name:{required: "Please enter sacco name"},
    president:{required: "Please enter sacco president"},
  },
  submitHandler: updateAssets  
});    
/* Handling form functionality */
function updateAssets() {    
  var data = $("#update-assets").serialize();        
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#assets_response").fadeOut();
      $("#update_assets").html(' Updating Sacco...');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
        $("#assets_response").fadeIn(1000, function(){            
          $("#assets_response").html('<div class="alert alert-success"> Sacco details have been updated successfuly!</div>');
          $("#update_assets").html('Update Details');
        });
        $("#assets_response").delay(6000).fadeOut(function(){});
      } else if(response == 2) {                 
        $("#assets_response").fadeIn(1000, function(){            
          $("#assets_response").html('<div class="alert alert-danger"> Sorry, either there was an error or there is no new information to update!</div>');
          $("#update_assets").html('Update Details');
        });
        $("#assets_response").delay(6000).fadeOut(function(){});
      }
    }
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
      $("#add_event").html(' Saving Event...');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success"> An event has been saved!</div>');
          $("#add_event").html('Save Event');
        });
        $("#error").delay(6000).fadeOut(function(){});
        setTimeout(' window.location.href = ""; ', 6000);
      } else if(response == 2) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, there was an error saving the event, please try again!</div>');
          $("#add_event").html('Save Event');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }
      else if(response == 3) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, there was an error adding the event attachment, please check if the attached file is valid</div>');
          $("#add_event").html('Save Event');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }
      else if(response == 4) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> The attached file is invalid, make sure it is of type pdf, docx, .doc, .jpeg, .jpg, .png </div>');
          $("#add_event").html('Save Event');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }
      else if(response == 5) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> The event start date can not be a date in the past, please chack the dates.</div>');
              $("#add_event").html('Save Event');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 6) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> The event start date can not be a date in the future than the end date, please chack the dates.</div>');
              $("#add_event").html('Save Event');
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
        $("#password_response").fadeIn(500, function(){            
          $("#password_response").html('<div class="alert alert-success"> The password has been changed successfuly!</div>');
          $("#reset").html('Reset Password');          
        });
        $("#password_response").delay(6000).fadeOut(function(){});
        setTimeout(' window.location.href = ""; ', 6000);
        $("#reset-password")[0].reset();        
        
      } else if(response == 2) {                 
        $("#password_response").fadeIn(500, function(){            
          $("#password_response").html('<div class="alert alert-danger"> Sorry, there was an error updating the password, please try again.</div>');
          $("#reset").html('Reset Password');
        });
        $("#password_response").delay(6000).fadeOut(function(){});
      }

      else if(response == 3) {                 
        $("#password_response").fadeIn(500, function(){            
          $("#password_response").html('<div class="alert alert-danger"> The current password entered is incorrect.</div>');
          $("#reset").html('Reset Password');
        });
        $("#password_response").delay(6000).fadeOut(function(){});
      }
      else if(response == 4) {                 
            $("#password_response").fadeIn(500, function(){            
              $("#password_response").html('<div class="alert alert-danger"> Make sure your password includes an uppercase & lowercase letter, a number,and one special character</div>');
              $("#reset").html('Reset Password');
            });
            $("#password_response").delay(6000).fadeOut(function(){});
          }
    }
  });
  return false;
} 

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

//add ticket product
$("#add-product").validate({
  rules: {
    product:{required:true},
    product_name:{required:true},
    category_name:{required:true}
  },
  messages: {
    product:{required:"Please enter the the product"},
    product_name:{required:"Please enter the product name"},
    category_name:{required:"Please enter the category name"}
  },
  submitHandler: addProduct  
});    
/* Handling form functionality */
function addProduct() {    
  var data = $("#add-product").serialize();  
  //alert(data);      
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#product_response").fadeOut();
      $("#add_product").html(' Adding Product...');
      $("#add_category").html(' Adding Category...');
      $("#update_progress").html('Updating...');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
        $("#product_response").fadeIn(1000, function(){            
          $("#product_response").html('<div class="alert alert-success"> The product has been saved successfuly.</div>');
          $("#add_product").html('Add Product');
          $("#add-product")[0].reset();
        });
        $("#product_response").delay(6000).fadeOut(function(){});
        getProducts();
      }else if(response == 2) {                 
        $("#product_response").fadeIn(1000, function(){            
          $("#product_response").html('<div class="alert alert-danger"> Sorry, there was an error saving the product, please try again.</div>');
          $("#add_product").html('Add Product');
        });
        $("#product_response").delay(6000).fadeOut(function(){});
      }
      else if(response == 3) {                 
        $("#product_response").fadeIn(1000, function(){            
          $("#product_response").html('<div class="alert alert-success"> The category has been saved successfuly.</div>');
          $("#add_category").html('Add Category');
          $("#add-product")[0].reset();
        });
        $("#product_response").delay(6000).fadeOut(function(){});
        getTicketCategories();
      }
      else if(response == 4) {                 
        $("#product_response").fadeIn(1000, function(){            
          $("#product_response").html('<div class="alert alert-danger"> Sorry, there was an error saving the category, please try again.</div>');
          $("#add_category").html('Add Category');
        });
        $("#product_response").delay(6000).fadeOut(function(){});

      }
      else if(response == 5) {                 
        $("#progress_report").fadeIn(1000, function(){            
          $("#progress_report").html('<div class="alert alert-success"> The progress has been updated successfuly.</div>');
          $("#update_progress").html('Update Progress');
        });
        $("#progress_report").delay(6000).fadeOut(function(){});
        setTimeout(' window.location.href = ""; ', 4000);
      }
      else if(response == 6) {                 
        $("#progress_report").fadeIn(1000, function(){            
          $("#progress_report").html('<div class="alert alert-danger"> Please enter the progress.</div>');
          $("#update_progress").html('Add Category');
        });
        $("#progress_report").delay(6000).fadeOut(function(){});
      }


    }
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
        date_to:{required:true},
        reasons:{required:true}
      },
      messages: {
        type:{required:"Please select the leave type"},
        leave_roaster:{required:"Please select a response to the question"},
        leave_grant:{required:"Please select a response to the question"},
        date_from:{required:"Please select start of leave"},
        date_to:{required:"Please select end of leave"},
        reasons:{required:"Please enter your reasons"}
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
            $("#error").fadeIn(500, function(){            
              $("#error").html('<div class="alert alert-success"> A new leave application has been posted successfuly.</div>');
              $("#apply_leave").html('Add Leave');
              $("#apply-leave")[0].reset();
            });
            $("#error").delay(6000).fadeOut(function(){});
            
          }else if(response == 2) {                 
            $("#error").fadeIn(500, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error posting the new leave application, please try to refresh and submit again.</div>');
              $("#apply_leave").html('Add Leave');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 3) {                 
            $("#error").fadeIn(500, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, make sure the date from and date to selected are from the future not from the past.</div>');
              $("#apply_leave").html('Add Leave');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 4) {                 
            $("#error").fadeIn(500, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, it seems the selected dates are falling under a weekend or during a public calender, please crosscheck your calender.</div>');
              $("#apply_leave").html('Add Leave');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 5) {                 
            $("#error").fadeIn(500, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, the selected start dates is in the future than the end date, please check the dates and put them in a correct order.</div>');
              $("#apply_leave").html('Add Leave');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }

          else if(response == 6) {                 
            $("#error").fadeIn(500, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, You don\'t have any leave days allocated for this leave type, check with your HR to update your leave days.</div>');
              $("#apply_leave").html('Add Leave');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }

          else if(response == 7) {                 
            $("#error").fadeIn(500, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, Your leave days remaining are less than the leave days you have applied, please check your remaining days correctly..</div>');
              $("#apply_leave").html('Add Leave');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }

        }
      });
      return false;
    } 
  

  $("#vehicle-request").validate({
      rules: {
        driver:{required:true},
        to:{required:true},
        date_from:{required:true},
        date_to:{required:true},
        activity:{required:true},
        from:{required:true},
        pillar:{required:true},
        purpose:{required:true},
        logistics:{required:true},
        nights:{required:true}
      },
      messages: {
        driver:"Please enter the name of the driver",
        to:"Please enter the destination",
        from:"Please enter departure place",
        date_from:"Please select departure date",
        date_to:"Please select arrival date",
        activity:"Please enter the name of the activity",
        pillar:"Please select the pillar/activity",
        purpose:"Please enter the purpose of your trip",
        logistics:"Please select the logistics",
        nights:"Please enter number of nights"
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
          if(response == 3) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-success"> Your travel advance requestt has been submitted successfully!</div>');
              $("#vehicle_request").html('Submit Request');
              $("#vehicle-request")[0].reset();
            });
            $("#error").delay(6000).fadeOut(function(){});
            
            setTimeout(' window.location.href = "dashboard.php?page=travel_advance_request"; ', 6000);
          } else if(response == 4) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there was an error submitting your travel advance request, please try again!</div>');
              $("#vehicle_request").html('Submit Request');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }else if(response == 5) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Sorry, there are no Daily Itinerary records, please add them first </div>');
              $("#vehicle_request").html('Submit Request');
            });
            $("#error").delay(6000).fadeOut(function(){});
          }
          else if(response == 6) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Make sure that whenever you add mileage you must select fuel type </div>');
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
        spare:{required:true},
        action:{required:true}
      },
      messages: {
        reg_number:"Please enter the RN of the assigned vehicle",
        mileage:"Please enter the opening mileage",
        fuel:"Please select fuel level",
        dent:"",
        clean:"",
        tools:"",
        spare:"",
        action:"Please select action."
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
          $("#check_request").html('Checking...');
          $("#approve_request").html('Approving...');
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
          if(response == 7) {                 
            $("#authorize_response").fadeIn(1000, function(){            
              $("#authorize_response").html('<div class="alert alert-success"> A travel advance request has been marked as checked successfully!</div>');
              $("#check_request").html('Check');
              $("#assign-vehicle")[0].reset();
            });
            $("#authorize_response").delay(6000).fadeOut(function(){});
            
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 8) {                 
            $("#authorize_response").fadeIn(1000, function(){            
              $("#authorize_response").html('<div class="alert alert-danger"> Sorry, there was an error marking as checked, please try again!</div>');
              $("#check_request").html('Check');
            });
            $("#authorize_response").delay(6000).fadeOut(function(){});
          }

          if(response == 9) {                 
            $("#authorize_response").fadeIn(1000, function(){            
              $("#authorize_response").html('<div class="alert alert-success"> A travel advance request has been marked as approved successfully!</div>');
              $("#approve_request").html('Approve');
              $("#assign-vehicle")[0].reset();
            });
            $("#authorize_response").delay(6000).fadeOut(function(){});
            
            setTimeout(' window.location.href = ""; ', 6000);
          } else if(response == 10) {                 
            $("#authorize_response").fadeIn(1000, function(){            
              $("#authorize_response").html('<div class="alert alert-danger"> Sorry, there was an error marking as approved, please try again!</div>');
              $("#approve_request").html('Approve');
            });
            $("#authorize_response").delay(6000).fadeOut(function(){});
          }
        }
      });
      return false;
    }


//delete staff
$(document).on('click', '.delete_staff', function(){
   var id=$(this).data("id3");


   if(confirm("Are you sure you want to delete this member?"))
   {
       var action='remove_staff';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#response").fadeIn(1000, function(){
                       $("#response").html('<div class="alert alert-success" role="alert"> The selected member has been deleted successfully!</div>');
                   });
                   $("#response").delay(6000).fadeOut(function(){});
               }else{
                   $("#response").fadeIn(1000, function(){
                       $("#response").html('<div class="alert alert-warning" role="alert"> There was an error deleting the  selected member!</div>');
                   });
                   $("#response").delay(6000).fadeOut(function(){});
               }
              getUsers();
           }
       });
   }
});

//delete sacco
$(document).on('click', '.delete_sacco', function(){
   var id=$(this).data("id3");


   if(confirm("Are you sure you want to delete this Sacco? Note that all the information associated with this sacco will be deleted."))
   {
       var action='remove_sacco';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#response").fadeIn(1000, function(){
                       $("#response").html('<div class="alert alert-success" role="alert"> The selected sacco together with its associated data has been deleted successfully!</div>');
                   });
                   $("#response").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = "dashboard.php?page=sacco_list"; ', 6000);
               }else{
                   $("#response").fadeIn(1000, function(){
                       $("#response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting the  selected sacco!</div>');
                   });
                   $("#response").delay(6000).fadeOut(function(){});
               }
              getSacco();
           }
       });
   }
});

//delete document 
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
                   $("#error").fadeIn(1000, function(){
                       $("#error").html('<div class="alert alert-success" role="alert"> The selected document has been deleted !</div>');
                   });
                   $("#error").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 6000);
               }else{
                   $("#error").fadeIn(1000, function(){
                       $("#error").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting the  selected document!</div>');
                   });
                   $("#error").delay(6000).fadeOut(function(){});
               }
              getSacco();
           }
       });
   }
});

//delete document category
$(document).on('click', '.delete_category', function(){
   var id=$(this).data("id3");
   var doc=$(this).data("doc");


   if(confirm("Are you sure you want to delete this category?"))
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
                   $("#err").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = "dashboard.php?page=event_list"; ', 6000);
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
                   $("#err").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 6000);
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
                   $("#err").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 6000);
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

//deactivate_account 
$(document).on('click', '.deactivate_account', function(){
   var id=$(this).data("id3");


   if(confirm("Are you sure you want to deactivate this account?"))
   {
       var action='deactivate_account';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-success" role="alert"> The selected member account has been deactivated successfully!</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 6000);
               }else{
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deactivating the account, please try again!</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
               }
           }
       });
   }
});

//reactivate_account 
$(document).on('click', '.reactivate_account', function(){
   var id=$(this).data("id3");


   if(confirm("Are you sure you want to re-activate this account?"))
   {
       var action='reactivate_account';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-success" role="alert"> The selected member account has been re-activated successfully, please update the accounts password!</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 6000);
               }else{
                   $("#err").fadeIn(1000, function(){
                       $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error re-activating the account, please try again!</div>');
                   });
                   $("#err").delay(6000).fadeOut(function(){});
               }
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

//delete produc
$(document).on('click', '.delete_product', function(){
   var id=$(this).data("id3");

   if(confirm("Are you sure you want to delete this product?"))
   {
       var action='delete_product';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#product_response").fadeIn(1000, function(){
                       $("#product_response").html('<div class="alert alert-success" role="alert"> The selected product has been deleted successfuly.</div>');
                   });
                   $("#product_response").delay(6000).fadeOut(function(){});
               }else{
                   $("#product_response").fadeIn(1000, function(){
                       $("#product_response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting that product, please try again!</div>');
                   });
                   $("#product_response").delay(6000).fadeOut(function(){});
               }
               getProducts();
           }
       });
   }
});

//delete ticket category
$(document).on('click', '.delete_ticket_category', function(){
   var id=$(this).data("id3");

   if(confirm("Are you sure you want to delete this category?"))
   {
       var action='delete_ticket_category';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#product_response").fadeIn(1000, function(){
                       $("#product_response").html('<div class="alert alert-success" role="alert"> The selected category has been deleted successfuly.</div>');
                   });
                   $("#product_response").delay(6000).fadeOut(function(){});
               }else{
                   $("#product_response").fadeIn(1000, function(){
                       $("#product_response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting that category, please try again!</div>');
                   });
                   $("#product_response").delay(6000).fadeOut(function(){});
               }
               getTicketCategories();
           }
       });
   }
});


//delete department
$(document).on('click', '.btn_faq_delete', function(){
   var id=$(this).data("id3");

   if(confirm("Are you sure you want to delete this FAQ?"))
   {
       var action='faq_delete';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#faqs_response").fadeIn(1000, function(){
                       $("#faqs_response").html('<div class="alert alert-success" role="alert"> The selected faq has been deleted successfuly.</div>');
                   });
                   $("#faqs_response").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 4000);

               }else{
                   $("#faqs_response").fadeIn(1000, function(){
                       $("#faqs_response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting that faq, please try again!</div>');
                   });
                   $("#faqs_response").delay(6000).fadeOut(function(){});
               }
               //getDepartments();
           }
       });
   }
});



//delete leave type
$(document).on('click', '.delete_leave_type', function(){
   var id=$(this).data("id3");

   if(confirm("Are you sure you want to delete this leave type?"))
   {
       var action='delete_leave_type';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#product_response").fadeIn(1000, function(){
                       $("#product_response").html('<div class="alert alert-success" role="alert"> The selected leave type has been deleted successfuly.</div>');
                   });
                   $("#product_response").delay(6000).fadeOut(function(){});
                   //setTimeout(' window.location.href = ""; ', 4000);

               }else{
                   $("#product_response").fadeIn(1000, function(){
                       $("#product_response").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting that leave type, please try again!</div>');
                   });
                   $("#product_response").delay(6000).fadeOut(function(){});
               }
               getLeave();
           }
       });
   }
});

//delete ticket
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

    $(document).on('click', '.delete_de', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete the selected DE?")){
           var action='delete_de';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-success" role="alert"> The selected DE has been deleted successfully.</div>');
                       });
                       $("#err").delay(5000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 5000);
                   }else{
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleteting the selected DE, please try again!</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });


});


  
</script>