
    <!--  Mobilenavbar -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
      <nav class="sidebar-nav scroll-sidebar">
        <div class="offcanvas-header justify-content-between">
          <img src="../../dist/images/icon.png" alt="" class="img-fluid">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body profile-dropdown mobile-navbar" data-simplebar=""  data-simplebar>
          <ul id="sidebarnav">
            <li class="sidebar-item">
              <a class="sidebar-link" href="dashboard.php?page=discussions" aria-expanded="false">
                <span>
                  <i class="ti ti-message-dots"></i>
                </span>
                <span class="hide-menu">Discussion Area</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="dashboard.php?page=event_list" aria-expanded="false">
                <span>
                  <i class="ti ti-calendar"></i>
                </span>
                <span class="hide-menu">Events</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="dashboard.php?page=faqs" aria-expanded="false">
                <span>
                  <i class="ti ti-mail"></i>
                </span>
                <span class="hide-menu">FAQs</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <!-- Import Js Files -->
    <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- core files -->
    <script src="../../dist/js/app.min.js"></script>
    <script src="../../dist/js/app.init.js"></script>
    <script src="../../dist/js/app-style-switcher.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    <script src="../../dist/js/custom.js"></script>
    <!-- current page js files -->    
    <script src="../../dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="../../dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../dist/js/dashboard5.js"></script>

    <!-- ---------------------------------------------- -->
    <script src="../../dist/js/apps/notes.js"></script>
    <script src="../../dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../dist/js/datatable/datatable-basic.init.js"></script>    
    <script src="../../dist/js/validation.min.js"></script>

    <script src="../../dist/js/custom-scripts.js"></script>
    
    <script src="../../dist/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="../../dist/libs/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../../dist/js/forms/form-wizard.js"></script>

    
    <script src="../../dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="../../dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../dist/js/dashboard.js"></script>
    <script src="../../dist/js/custom-script.js"></script>

    

    <script type="text/javascript">
      $(document).ready(function(){
        let warningTimeout = 50;
        let warningTimerID;
        let counterDisplay = document.getElementById('numCount');
        logoutUrl = "https://sacco.terrence-aluda.com/sacco/eng-edtest.html";

        function startTimer() {
          // window.setTimeout returns an ID that can be used to start and stop the timer
          warningTimerID = window.setTimeout(idleLogout, warningTimeout);
          animate(counterDisplay, 5, 0, warningTimeout);
        }
          //function for resetting the timer
        function resetTimer() {
          window.clearTimeout(warningTimerID);
          startTimer();
        }

        // Logout the user.
        function idleLogout() {
          window.location = logoutUrl;
        }

        function startCountdown() {
          document.addEventListener("mousemove", resetTimer);
          document.addEventListener("mousedown", resetTimer);
          document.addEventListener("keypress", resetTimer);
          document.addEventListener("touchmove", resetTimer);
          document.addEventListener("onscroll", resetTimer);
          document.addEventListener("wheel", resetTimer);
          startTimer();
        }
     //the animating function
        function animate(obj, initVal, lastVal, duration) {

          let startTime = null;

          //get the current timestamp and assign it to the currentTime variable

          let currentTime = Date.now();

          //pass the current timestamp to the step function

          const step = (currentTime ) => {

          //if the start time is null, assign the current time to startTime

              if (!startTime) {
              startTime = currentTime ;
              }

          //calculate the value to be used in calculating the number to be displayed

              const progress = Math.min((currentTime  - startTime) / duration, 1);

          //calculate what is to be displayed using the value gotten above

              displayValue = Math.floor(progress * (lastVal - initVal) + initVal);
              obj.innerHTML = displayValue;

          //checking to make sure the counter does not exceed the last value(lastVal)

              if (progress < 1) {
                  window.requestAnimationFrame(step);
              }else{
                  window.cancelAnimationFrame(window.requestAnimationFrame(step));
              }
          };

          //start animating
          window.requestAnimationFrame(step);
      }
      });
      //total_budget
      
      function sum()
      {

         var find_acco = 0;
         var days = document.getElementById('nights').value;
         var other_nights = document.getElementById('other_nights').value;
         var rate = document.getElementById('rate_night').value;
         var another_rate = document.getElementById('own_rate').value;
         var fuel = document.getElementById('total_fuel').value;
         var meal = document.getElementById('meal').value;
         var tollgate = document.getElementById('tollgate').value;

         if(other_nights != ''){
          find_acco = parseInt(other_nights) * parseInt(another_rate);
         }
         

         var sum = (parseInt(days) * parseInt(rate)) + parseFloat(meal) + find_acco;
         document.getElementById('total_allowance').value = sum;

         var total = 0;
         if(fuel == ''){
          fuel = 0;
         }
         
         if(tollgate == ''){
          tollgate =0;
         }
         total = parseFloat(sum) + parseFloat(fuel) + parseFloat(tollgate);
         document.getElementById('total_budget').value = total;
      }
      $('#nights').keyup(function() {
        sum();
      });
      $('#other_nights').keyup(function() {
        sum();
      });
      $('#mileage').keyup(function() {
        sum();
      });
      $('#tollgate').keyup(function() {
        sum();
      });
      sum();
    
      var x = document.getElementById("another_days");
      var another_rate = document.getElementById("another_rate");
      var days_acc_msg = document.getElementById("days_acc_msg");
      var rate_msg = document.getElementById("rate_msg");
      x.style.display = "none";
      another_rate.style.display = "none";
      days_acc_msg.style.display = "none";
      rate_msg.style.display = "none";
       $(function($) {
      var list_select_id = 'logistics'; //second select list ID
      var list_target_id = 'rate_night';
      var own_rate = 'own_rate';
      var initial_target_html = '<option value="">Select Logistics...</option>'; //Initial prompt for target select
      $('#'+list_select_id).change(function(e) {
        //Grab the chosen value on first select list change
        var selectvalue = $(this).val();

        if (selectvalue != ""){
            //alert(selectvalue);            
            if (selectvalue == 4) {
              x.style.display = "block";
              another_rate.style.display = "block";
              days_acc_msg.style.display = "inline";            
              rate_msg.style.display = "inline";
            } else {
              x.style.display = "none";
              another_rate.style.display = "none";
              days_acc_msg.style.display = "none";
              rate_msg.style.display = "none";
              //$("#days_acc_msg")[0].reset();
              document.getElementById('other_nights').value = '';
            }

            $.ajax({
                url: 'get_rates_data.php?action=rates&svalue='+selectvalue,
                success: function(output) {
                  // Check if the response is an object (JSON)
                  if (typeof output === 'object') {
                    // You can access individual values like this:
                    var value1 = output.value1;
                    var value2 = output.value2;

                    $('#'+list_target_id).val(value1);
                    $('#'+own_rate).val(value2);
                  } else {
                    $('#'+list_target_id).val(output);
                  }
                  sum();                  
              },
              error: function (xhr, ajaxOptions, thrownError) {
              //alert(xhr.status + " "+ thrownError);
            }});
        
          }else{
            alert('Select Logistics');
          }
        });
    });

    $(function($) {
      var list_select_id = 'fuel'; //second select list ID
      var list_target_id = 'total_fuel';
      //var mile = $('#mileage').val();
      //alert(mile);
      var initial_target_html = '<option value="">Select Logistics...</option>'; //Initial prompt for target select
      $('#'+list_select_id).change(function(e) {
        sum();
        //Grab the chosen value on first select list change
        var selectvalue = $(this).val();

        if (selectvalue != ""){
            //alert(selectvalue);
            $.ajax({
                url: 'get_rates_data.php?action=fuel&svalue='+selectvalue,
                success: function(output) {
                  //sum();
                  var miles = document.getElementById('mileage').value;
                  var sums = output * (miles/10);
                  $('#'+list_target_id).val(sums);
                  sum();
                  //document.getElementById('rate_night').value = output;
              },
              error: function (xhr, ajaxOptions, thrownError) {
              //alert(xhr.status + " "+ thrownError);
            }});
        
          }else{
            alert('You have deselected the fuel');
          }
        });
    });

    $(document).ready(function(){
      

      //generate reports
    $("#advancereport-custom").validate({
    rules:
    {
      date_from:{required:true},
      date_to:{required:true},
      officer:{required:true}       
     },
     messages:
     {
       date_from:"Please select date from",
       date_to:"Please select date to",
       officer: "please select the officer"
     },
     submitHandler: generateReports
    });  
    /* validation */

    /* add measurement submit */
    function generateReports()
    {   
      var data = $("#advancereport-custom").serialize(); 
      //alert('sup'); 
        
      $.ajax({
        
      type : 'GET',
      url  : 'get_advance_report.php',
      data : data,
      beforeSend: function()
      { 
        $("#error").fadeOut();
        $("#generate_report").html('Generating...');
      },
      success :  function(response)
        {    //alert(response);
        $('#show_advance_request_report').html(response);
        $("#generate_report").html('Generate');

        }
      });
        return false;
    }

        //generate reports
        $("#pettycash-custom").validate({
        rules:
        {
          date_from:{required:true},
          date_to:{required:true},
          section:{required:true}       
         },
         messages:
         {
           date_from:"Please select date from",
           date_to:"Please select date to",
           section: "please select the section"
         },
         submitHandler: generatePettyCashReport
        });  
        /* validation */

        /* add measurement submit */
        function generatePettyCashReport()
        {   
          var data = $("#pettycash-custom").serialize(); 
          //alert('sup'); 
            
          $.ajax({
            
          type : 'GET',
          url  : 'get_petty_cash_report.php',
          data : data,
          beforeSend: function()
          { 
            $("#error").fadeOut();
            $("#generate_report").html('Generating...');
          },
          success :  function(response)
            {    //alert(response);
            $('#show_petty_cash_report').html(response);
            $("#generate_report").html('Generate');

            }
          });
            return false;
        }
    });


    </script> 

  </body>

</html>