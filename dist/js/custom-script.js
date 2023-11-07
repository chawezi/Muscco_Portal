
function fetchDI(){  
     $.ajax({  
          url:"get_daily_itinerary.php",  
          method:"POST",  
          success:function(data){  
               $('#daily_itinery').html(data);  
          }  
     });  
}

function fetchTravelAdvanceReport(){
  var action = "all";
  $.ajax({
    url:"get_travel_advance_report.php",
    method:"GET",
    data:{action:action},
    success:function(data){
      $('#show_travel_advance_report').html(data);
    }
  });
}

function fetchPettyCashReport(){
  var action = "all";
  $.ajax({
    url:"get_petty_cash_report.php",
    method:"GET",
    data:{action:action},
    success:function(data){
      $('#show_petty_cash_report').html(data);
    }
  });
}

function fetchAdvanceReport(){
  var action = "all";
  $.ajax({
    url:"get_advance_report.php",
    method:"GET",
    data:{action:action},
    success:function(data){
      $('#show_advance_request_report').html(data);
    }
  });
}

function fetchInvoiceReport(){
  var action = "all";
  $.ajax({
    url:"get_invoice_report.php",
    method:"GET",
    data:{action:action},
    success:function(data){
      $('#show_invoice_report').html(data);
    }
  });
}

function getFaqs(){
  var action = "all";
  $.ajax({
    url:"get_faqs.php",
    method:"GET",
    data:{action:action},
    success:function(data){
      $('#show_faqs').html(data);
    }
  });
}

function getProfile(){
  let action = "get_profile";
  //alert(action);
  $.ajax({
      url:"get_user_data.php",
      method:"GET",
      data:{action:action},
      success:function(data){ 
        //alert(data);
          var big_picture = '<img src="../../uploads/profiles/'+data+'" class="rounded-circle" width="130" height="130" alt="">';
          var small_picture = '<img src="../../uploads/profiles/'+data+'" class="rounded-circle" width="35" height="35" alt="">';
          $('#show_profile_picture').html(big_picture);
          $('#header_profile_picture').html(small_picture);
          $('#header_dropdown_picture').html(small_picture);
      }
  });
}

function getDepartments(){
  let action = "get_departments";
    $.ajax({
        url:"get_department_data.php",
        method:"GET",
        data:{action:action},
        success:function(data){ 
            $('#show_departments').html(data);
        }
    });
}

function getDB(){
let action = "get_db";
$.ajax({
  url:"get_department_data.php",
  method:"GET",
  data:{action:action},
  success:function(data){ //alert(data);
      $('#show_db').html(data);
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

function getBranches(){
  let action = "get_branches";
  $.ajax({
      url:"get_department_data.php",
      method:"GET",
      data:{action:action},
      success:function(data){ 
          $('#show_branches').html(data);
      }
  });
}
function getDocCategories(){
  let action = 'get_categories';
  $.ajax({
      url:"get_doc_data.php",
      method:"GET",
      data:{action:action},
      success:function(data){  //alert(data);
          $('#show_doc_categories').html(data);
      }
  });
}

function getDocs(){
  let action = 'get_docs';
  $.ajax({
      url:"get_doc_data.php",
      method:"GET",
      data:{action:action},
      success:function(data){  //alert(data);
          $('#show_docs').html(data);
      }
  });
}

function getBranchForm(){
  let action = 'get_form';
  $.ajax({
      url:"get_department_data.php",
      method:"GET",
      data:{action:action},
      success:function(data){ 
          $('#branch_form').html(data);
      }
  });
}

getBranchForm();
getDB();
getDocs();
getDocCategories();
getPositions();
getBranches();
getFaqs(); 
fetchDI();
fetchTravelAdvanceReport();
fetchPettyCashReport();
fetchAdvanceReport();
getDepartments();
fetchInvoiceReport();
getProfile();


$("#daily-itinery").validate({
      rules: {
        date:{required:true},
        from:{required:true},
        to:{required:true},
        title:{required:true}
      },
      messages: {
        date:"Please enter the date",
        from:"Please enter departure place",
        to:"Please enter destination",
        title:"Pleese enter backup title"
      },
      submitHandler: addItinery  
});    
  /* Handling form functionality */
function addItinery() {    
  var data = $("#daily-itinery").serialize();         
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#error").fadeOut();
      $("#add_btn").html('Adding..');
      $("#add_db").html('Saving..');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
        $("#add_btn").html('Add');
          $("#daily-itinery")[0].reset();
      } else if(response == 2) {                 
        $("#itinerary_response").fadeIn(1000, function(){            
          $("#itinerary_response").html('<div class="alert alert-danger"> Sorry, there was an error saving!</div>');
          $("#add_btn").html('Add');
        });
        $("#itinerary_response").delay(6000).fadeOut(function(){});
      }else if(response == 3) {                 
        $("#itinerary_response").fadeIn(1000, function(){            
          $("#itinerary_response").html('<div class="alert alert-success"> A backup has been saved successfully</div>');
          $("#add_db").html('Add');
          $("#daily-itinery")[0].reset();
        });
        $("#itinerary_response").delay(6000).fadeOut(function(){});
        getDB();

      }
      else if(response == 4) {                 
        $("#itinerary_response").fadeIn(1000, function(){            
          $("#itinerary_response").html('<div class="alert alert-danger"> Sorry, there was error an error taking the backup, please try again!</div>');
          $("#add_db").html('Add');
          $("#daily-itinery")[0].reset();
        });
        $("#itinerary_response").delay(6000).fadeOut(function(){});
        getDB();
        
      }



      fetchDI();
    }
  });
  return false;
}      

$("#add-branch").validate({
      rules: {
        branch:{required:true}
      },
      messages: {
        branch:"Please enter branch name"
      },
      submitHandler: addBranch  
});    
  /* Handling form functionality */
function addBranch() {    
  var data = $("#add-branch").serialize();         
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#branch_error").fadeOut();
      $("#add_branch").html('Adding Branch..');
      $("#update_branch").html('Updating..');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
       $("#branch_error").fadeIn(1000, function(){            
          $("#branch_error").html('<div class="alert alert-success"> A branch has been saved successfully!</div>');
          $("#add_branch").html('Add');
        });
        $("#branch_error").delay(6000).fadeOut(function(){});
        $("#add-branch")[0].reset();
      } else if(response == 2) {                 
        $("#branch_error").fadeIn(1000, function(){            
          $("#branch_error").html('<div class="alert alert-danger"> Sorry, there was an error saving the branch, please try again</div>');
          $("#add_branch").html('Add');
        });
        $("#branch_error").delay(6000).fadeOut(function(){});
      }
      if(response == 3) {                 
       $("#branch_error").fadeIn(1000, function(){            
          $("#branch_error").html('<div class="alert alert-success"> A branch has been updated successfully!</div>');
          $("#update_branch").html('Update');
        });
        $("#branch_error").delay(6000).fadeOut(function(){});
      } else if(response == 4) {                 
        $("#branch_error").fadeIn(1000, function(){            
          $("#branch_error").html('<div class="alert alert-danger"> There is nothing to update, please edit first.</div>');
          $("#update_branch").html('Update');
        });
        $("#branch_error").delay(6000).fadeOut(function(){});
      }
      getBranches();
    }
  });
  return false;
}  

$("#manage-departments").validate({
      rules: {
        department:{required:true}
      },
      messages: {
        department:"Please enter department name"
      },
      submitHandler: addDepartment  
});    
  /* Handling form functionality */
function addDepartment() {    
  var data = $("#manage-departments").serialize();         
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#branch_error").fadeOut();
      $("#manage_department").html('Adding Branch..');
      $("#update_branch").html('Updating..');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
       $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success"> A department has been saved successfully!</div>');
          $("#manage_department").html('Save Department');
        });
        $("#error").delay(6000).fadeOut(function(){});
        $("#manage-departments")[0].reset();
      } else if(response == 2) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, there was an error saving the department, please try again</div>');
          $("#manage_department").html('Add');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }
      if(response == 3) {                 
       $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success"> A department has been updated successfully!</div>');
          $("#update_department").html('Update');
        });
        $("#error").delay(6000).fadeOut(function(){});
      } else if(response == 4) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> There is nothing to update, please edit first.</div>');
          $("#update_department").html('Update');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }
      getDepartments();
    }
  });
  return false;
}   

$("#add-statement").validate({
      rules: {
        statement:{required:true}
      },
      messages: {
        statement:"Please enter your personal statement."
      },
      submitHandler: addStatement  
});    
  /* Handling form functionality */
function addStatement() {    
  var data = $("#add-statement").serialize();         
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : data,
    beforeSend: function(){ 
      $("#state_error").fadeOut();
      $("#add_statement").html('Saving Statement..');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
       $("#state_error").fadeIn(1000, function(){            
          $("#state_error").html('<div class="alert alert-success"> Your personal statement has been saved successfully!</div>');
          $("#add_statement").html('Update Statement');
        });
        $("#state_error").delay(6000).fadeOut(function(){});
        setTimeout(' window.location.href = ""; ', 6000);
      } else if(response == 2) {                 
        $("#state_error").fadeIn(1000, function(){            
          $("#state_error").html('<div class="alert alert-danger"> Sorry, there was an error saving the statement, please try again</div>');
          $("#add_statement").html('Update Statement');
        });
        $("#state_error").delay(6000).fadeOut(function(){});
      }
    }
  });
  return false;
}  

//add document
$("#add-document").validate({
  rules: {
    category: {required: true},
    title: {required: true},
    file: {required: true},
    access_rights: {required: true},
    question:{required:true},
    answer:{required:true}
  },
  messages: {
    category:{required: "Please select document category"},
    title:{required: "Please enter document title"},
    file:{required: "Please select a document to upload"},
    access_rights:{required: "Please select authorised usergroup"},
    question:{required:"Please enter the question"},
    answer:{required:"Please enter the answer to the question."}
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
      $("#add_document").html('Uploading Document...');
      $("#add_faq").html('Saving FAQ...');
    },
    success : function(response){ //alert(response);
      if(response == 1) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success"> A document has been uploaded.</div>');
          $("#add_document").html('Upload Document');
        });
        $("#error").delay(6000).fadeOut(function(){});
        $("#add-document")[0].reset();
        //setTimeout(' window.location.href = ""; ', 6000);
      } else if(response == 2) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, there was an error uploading the document, please try again.</div>');
          $("#add_document").html('Upload Document');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }
      else if(response == 3) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success">A question and an answer has been posted.</div>');
          $("#add_faq").html('Add FAQs');
          $("#add-document")[0].reset();
        });
        $("#error").delay(6000).fadeOut(function(){});
        getFaqs();
        //setTimeout(' window.location.href = ""; ', 4000);
      }
      else if(response == 5) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success">A faq has been updated successfuly.</div>');
          $("#add_faq").html('Save FAQ');
          $("#add-document")[0].reset();
        });
        $("#error").delay(6000).fadeOut(function(){});
        getFaqs();
        //setTimeout(' window.location.href = "dashboard.php?page=faqs"; ', 4000);
      }
      else if(response == 4) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-warning">Sorry, there was an error saving a FAQ.</div>');
          $("#add_faq").html('Save FAQ');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }
      getDocs();
      getDocCategories();
    },
    contentType: false,
    processData: false,
    cache: false
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
  //var data = $("#add-invoice").serialize(); 
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
          $("#response").html('<div class="alert alert-success"> An invoice has been saved.</div>');
          $("#add_invoice").html('Save Invoice');
        });
        $("#add-invoice")[0].reset();
        setTimeout(' window.location.href = ""; ', 4000);
        $("#response").delay(6000).fadeOut(function(){});
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
        $("#response_cat").delay(10000).fadeOut(function(){});
        $("#add-invoice")[0].reset();
        getDocCategories();
        //setTimeout(' window.location.href = ""; ', 4000);
      }
      if(response == 8) {                 
        $("#response_cat").fadeIn(1000, function(){            
          $("#response_cat").html('<div class="alert alert-success"> Sorry, there was an error adding a category.</div>');
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

$("#add-ticket").validate({
      rules: {
        title:{required:true},
        product:{required:true},
        description:{required:true},
        priority:{required:true},
        category:{required:true},
        band_title:{required:true},
        acc_ceiling:{required:true},
        lumpsum:{required:true},
        meals_acc:{required:true},
        without_meals_acc:{required:true},
        withmeals_acc:{required:true},
      },
      messages: {
        title:"Please enter ticket title",
        product:"Please select the product with an issue",
        description:"Please enter event description",
        priority:"Please select ticket priority",
        category:"Please select ticket category",
        band_title:"Please enter band title",
        acc_ceiling:"Please enter maximum accomodation ceiling",
        lumpsum:"Please enter lumpsum rate",
        meals_acc:"Please enter rate for accomodation with meals",
        without_meals_acc:"Please enter rate for without accomodation and meals",
        withmeals_acc:"Please enter rate for without accomodation and meals provided"
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
      $("#add_band").html('Adding Band...');
      $("#update_band").html('Updating Band...');
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
      if(response == 3) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success"> A new band has been saved successfully!</div>');
          $("#add_band").html('Add Band');
          
        });
        $("#error").delay(6000).fadeOut(function(){});
        $("#add-ticket")[0].reset();
        //setTimeout(' window.location.href = ""; ', 6000);
      } else if(response == 4) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, there was an error saving the band, please try again!</div>');
          $("#add_band").html('Add Band');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }

      if(response == 5) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-success"> A selected band has been updated successfully!</div>');
          $("#update_band").html('Update Band');
          
        });
        $("#error").delay(6000).fadeOut(function(){});
        //$("#add-ticket")[0].reset();
        //setTimeout(' window.location.href = ""; ', 6000);
      } else if(response == 6) {                 
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, there was an error updating the band, please try again!</div>');
          $("#update_band").html('Update Band');
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

//btn_delete_band
$(document).on('click', '.btn_delete_band', function(){
   var id=$(this).data("id3");


   if(confirm("Are you sure you want to delete this band?"))
   {
       var action='delete_band';
       $.ajax({
           url:"../../settings/sql-master.php",
           method:"GET",
           data:{id:id, action:action},
           dataType:"text",
           success:function(data){ //alert(data);
               if(data == 1){
                   $("#error").fadeIn(1000, function(){
                       $("#error").html('<div class="alert alert-success" role="alert"> The selected band has been deleted !</div>');
                   });
                   $("#error").delay(6000).fadeOut(function(){});
                   setTimeout(' window.location.href = ""; ', 6000);
               }else{
                   $("#error").fadeIn(1000, function(){
                       $("#error").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting the  selected band!</div>');
                   });
                   $("#error").delay(6000).fadeOut(function(){});
               }
           }
       });
   }
});
//travel advance today
$(document).on('click', '.advanced_today', function(){      
      //var action='advanced_today';
      var action = "advanced_today";
      $.ajax({
        url:"get_travel_advance_report.php",
        method:"GET",
        data:{action:action},
        success:function(data){
          $('#show_travel_advance_report').html(data);
        }
      });
    
});

//week
$(document).on('click', '.advanced_week', function(){      
      //var action='advanced_today';
      var action = "advanced_week";
      $.ajax({
        url:"get_travel_advance_report.php",
        method:"GET",
        data:{action:action},
        success:function(data){
          $('#show_travel_advance_report').html(data);
        }
      });
    
});

//advanced_month
$(document).on('click', '.advanced_month', function(){      
      //var action='advanced_today';
      var action = "advanced_month";
      $.ajax({
        url:"get_travel_advance_report.php",
        method:"GET",
        data:{action:action},
        success:function(data){
          $('#show_travel_advance_report').html(data);
        }
      });
    
});

//advanced_year
$(document).on('click', '.advanced_year', function(){      
      //var action='advanced_today';
      var action = "advanced_year";
      $.ajax({
        url:"get_travel_advance_report.php",
        method:"GET",
        data:{action:action},
        success:function(data){
          $('#show_travel_advance_report').html(data);
        }
      });
    
});

//advance request reports
//today
$(document).on('click', '.advancerequest_today', function(){      
      //var action='advanced_today';

      var action = "advanced_today";
      $.ajax({
        url:"get_advance_report.php",
        method:"GET",
        data:{action:action},
        success:function(data){ //alert(data);
          $('#show_advance_request_report').html(data);
        }
      });
    
});

//week
$(document).on('click', '.advancerequest_week', function(){      
      //var action='advanced_today';
      var action = "advanced_week";
      $.ajax({
        url:"get_advance_report.php",
        method:"GET",
        data:{action:action},
        success:function(data){
          $('#show_advance_request_report').html(data);
        }
      });
    
});

    //advanced_month
    $(document).on('click', '.advancerequest_month', function(){      
          //var action='advanced_today';
          var action = "advanced_month";
          $.ajax({
            url:"get_advance_report.php",
            method:"GET",
            data:{action:action},
            success:function(data){
              $('#show_advance_request_report').html(data);
            }
          });
        
    });

    //advanced_year
    $(document).on('click', '.advancerequest_year', function(){      
          //var action='advanced_today';
          var action = "advanced_year";
          $.ajax({
            url:"get_advance_report.php",
            method:"GET",
            data:{action:action},
            success:function(data){
              $('#show_advance_request_report').html(data);
            }
          });
        
    });


    //petty cash
    $(document).on('click', '.pettycash_today', function(){      
          //var action='pettycash_today';
          var action = "pettycash_today";
          $.ajax({
            url:"get_petty_cash_report.php",
            method:"GET",
            data:{action:action},
            success:function(data){
              $('#show_petty_cash_report').html(data);
            }
          });
        
    });

    $(document).on('click', '.pettycash_week', function(){      
          //var action='pettycash_today';
          var action = "pettycash_week";
          $.ajax({
            url:"get_petty_cash_report.php",
            method:"GET",
            data:{action:action},
            success:function(data){
              $('#show_petty_cash_report').html(data);
            }
          });
        
    });

    $(document).on('click', '.pettycash_month', function(){      
          //var action='pettycash_month';
          var action = "pettycash_month";
          $.ajax({
            url:"get_petty_cash_report.php",
            method:"GET",
            data:{action:action},
            success:function(data){
              $('#show_petty_cash_report').html(data);
            }
          });
        
    });

    $(document).on('click', '.pettycash_year', function(){      
          //var action='pettycash_year';
          var action = "pettycash_year";
          $.ajax({
            url:"get_petty_cash_report.php",
            method:"GET",
            data:{action:action},
            success:function(data){
              $('#show_petty_cash_report').html(data);
            }
          });
        
    });

    //invoices today
    $(document).on('click', '.invoice_today', function(){      
          //var action='pettycash_today';
          var action = "invoice_today";
          $.ajax({
            url:"get_invoice_report.php",
            method:"GET",
            data:{action:action},
            success:function(data){
              $('#show_invoice_report').html(data);
            }
          });
        
    });

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

    //delete department
    $(document).on('click', '.delete_branch', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete this branch?"))
       {
           var action='delete_branch';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#branch_error").fadeIn(1000, function(){
                           $("#branch_error").html('<div class="alert alert-success" role="alert"> The selected branch has been deleted successfuly.</div>');
                       });
                       $("#branch_error").delay(6000).fadeOut(function(){});
                   }else{
                       $("#branch_error").fadeIn(1000, function(){
                           $("#branch_error").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting that branch, please try again!</div>');
                       });
                       $("#branch_error").delay(6000).fadeOut(function(){});
                   }
                   getBranches();
               }
           });
       }
    });

    //delete notifications
    $(document).on('click', '.btn_delete_notification', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete this notification?"))
       {
           var action='delete_notification';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#error").fadeIn(1000, function(){
                           $("#error").html('<div class="alert alert-success" role="alert"> The selected notification has been deleted successfuly.</div>');
                       });
                       $("#error").delay(6000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 4000);
                   }else{
                       $("#error").fadeIn(1000, function(){
                           $("#error").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleting that notification, please try again!</div>');
                       });
                       $("#error").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });

    $(document).on('click', '.delete_DI', function(){
       var id=$(this).data("id3");


       if(confirm("Are you sure you want to delete this?"))
       {
           var action='delete_DI';
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
                  fetchDI();
               }
           });
       }
    });

      $(document).on('click', '.btn_delete_advance_request', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete the selected travel advance requestt?")){
           var action='delete_travel_advance_request';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-success" role="alert"> The selected request has been deleted.</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 6000);
                   }else{
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleteting the selected request, please try again!</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });

    $(document).on('click', '.btn_delete_pettycash', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete the selected request?")){
           var action='btn_pettycash';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-success" role="alert"> The selected petty cash requisition has been deleted.</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 6000);
                   }else{
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleteting the selected requisition, please try again!</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });

    $(document).on('click', '.btn_delete_leave', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete the selected leave request?")){
           var action='btn_delete_leave';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-success" role="alert"> The selected leave request has been deleted successfully.</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 6000);
                   }else{
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleteting the selected request, please try again!</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });

     $(document).on('click', '.btn_delete_advance', function(){
       var id=$(this).data("id3");

       if(confirm("Are you sure you want to delete the selected request?")){
           var action='btn_delete_advance';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-success" role="alert"> The selected advance request has been deleted successfully.</div>');
                       });
                       $("#err").delay(5000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 5000);
                   }else{
                       $("#err").fadeIn(1000, function(){
                           $("#err").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleteting the selected request, please try again!</div>');
                       });
                       $("#err").delay(6000).fadeOut(function(){});
                   }
               }
           });
       }
    });

    $(document).on('click', '.delete_backups', function(){
       var id=$(this).data("id3");
       var file = $(this).data("file");

       if(confirm("Are you sure you want to delete the selected databse backup?")){
           var action='delete_backup';
           $.ajax({
               url:"../../settings/sql-master.php",
               method:"GET",
               data:{id:id, file:file, action:action},
               dataType:"text",
               success:function(data){ //alert(data);
                   if(data == 1){
                       $("#error").fadeIn(1000, function(){
                           $("#error").html('<div class="alert alert-success" role="alert"> The selected db backup has been deleted successfully.</div>');
                       });
                       $("#error").delay(5000).fadeOut(function(){});
                       setTimeout(' window.location.href = ""; ', 5000);
                   }else{
                       $("#error").fadeIn(1000, function(){
                           $("#error").html('<div class="alert alert-warning" role="alert"> Sorry, there was an error deleteting the selected db backup, please try again!</div>');
                       });
                       $("#error").delay(6000).fadeOut(function(){});
                   }
                   getDB();
               }
           });
       }
    });

//update profile picture
//add member
$("#add-picture").validate({
  rules: {
    file:{required:true}
  },
  messages: {
    file:"Please select a profile picture to upload"
  },
  submitHandler: addPicture  
});    

/* Handling form functionality */
function addPicture() {    
  //var data = $("#add-picture").serialize();
  var formData = $("#add-picture").submit(function () {
      return;
  });
  var formData = new FormData(formData[0]);        
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : formData,
    beforeSend: function(){ 
      $("#error").fadeOut();
      $("#update_profile").html('Uploading Picture...');
    },
    success : function(response){ //alert(response);
      //upload profile picture success
      if(response == 1) {                 
        $("#msg").fadeIn(1000, function(){            
          $("#msg").html('<div class="alert alert-success">Your profile picture has been updated successfuly!</div>');
          $("#save_member").html('Save');
          $("#update_profile").html('Upload Picture');
        });
        $("#add-picture")[0].reset();
        $("#msg").delay(6000).fadeOut(function(){});
        getProfile();
      }
      else if(response == 2) {                 
        $("#msg").fadeIn(1000, function(){            
          $("#msg").html('<div class="alert alert-danger"> Sorry, there was an error updating your profile picture, please try again.</div>');
          $("#update_profile").html('Upload Picture');
        });
        $("#msg").delay(6000).fadeOut(function(){});
      }
      else if(response == 3) {                 
            $("#msg").fadeIn(1000, function(){            
              $("#msg").html('<div class="alert alert-danger"> Sorry, the picture selected is invalid, it should be of type JPG, JPEG, GIF or PNG.</div>');
              $("#update_profile").html('Upload Picture');
            });
            $("#msg").delay(6000).fadeOut(function(){});
      }
    },
    contentType: false,
    processData: false,
    cache: false
  });
  return false;
} 
/* end script */ 

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
    branch:{required:true},
    dos:{required:true},
    dob:{required:true},
    band:{required:true}
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
    department:"Please select the departmen",
    branch:"Please select branch",
    dos:"Please enter start date",
    dob:"Please enter date of birth",
    band:"Please select staff's band",
  },
  submitHandler: addMember  
});    

function addMember() {    
  //var data = $("#add-member").serialize();
  var formData = $("#add-member").submit(function () {
      return;
  });
  var formData = new FormData(formData[0]);      
  $.ajax({        
    type : 'POST',
    url  : '../../settings/sql-master.php',
    data : formData,
    beforeSend: function(){ 
      $("#error").fadeOut();
      $("#save_member").html('Saving Member...');
      $("#update_member").html('Updating Details...');
    },
    success : function(response){ //alert(response);
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
          $("#error").html('<div class="alert alert-success"> The DE details has been saved successfuly!</div>');
          $("#save_member").html('Save');
        });
        $("#add-member")[0].reset();
        $("#error").delay(6000).fadeOut(function(){});
      }
      else if(response == 4){
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, there was an error saving the DE, please try again.</div>');
          $("#save_member").html('Save');
        });
        //$("#add-member")[0].reset();
        $("#error").delay(6000).fadeOut(function(){});
      }
      else if(response == 5) {                 
            $("#error").fadeIn(1000, function(){            
              $("#error").html('<div class="alert alert-danger"> Make sure the password includes an uppercase & lowercase letter, a number,and one special character.</div>');
              $("#save_member").html('Save');
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

      else if(response == 8) {                 
            $("#msg").fadeIn(1000, function(){            
              $("#msg").html('<div class="alert alert-danger"> Sorry, the picture selected is invalid, it should be of type JPG, JPEG, GIF or PNG.</div>');
              $("#update_profile").html('Upload Picture');
            });
            $("#msg").delay(6000).fadeOut(function(){});
      }else if(response == 9){
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, there is no new information to save!</div>');
          $("#save_member").html('Save');
        });
        $("#error").delay(6000).fadeOut(function(){});
      }else if(response == 10){
        $("#error").fadeIn(1000, function(){            
          $("#error").html('<div class="alert alert-danger"> Sorry, the entered username is already in use, choose a different one!</div>');
          $("#save_member").html('Save');
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
/* end script */ 


     

