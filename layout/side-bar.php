<?php $permission = array(); ?>
<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="text-nowrap logo-img">
        <img src="../../dist/images/logo.png" width="180" alt="" />
        <img src="../../dist/images/logo.png" class="light-logo" width="180" alt="" />
      </a>
      <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">


        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Menu</span>
        </li>
        <!-- =================== -->
        <!-- Dashboard -->
        <!-- =================== -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="dashboard.php" aria-expanded="false">
            <span>
              <i class="ti ti-layout-grid"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <?php if ($_SESSION['USR_TYP'] == 0) { ?>
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
              <span class="d-flex">
                <i class="ti ti-click"></i>
              </span>
              <span class="hide-menu">Online Applications</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="dashboard.php?page=my_leave_applications" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Leave</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a href="dashboard.php?page=my_advances" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Advance Requests</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=my_petty_cash" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Petty Cash Requisitions</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a href="dashboard.php?page=my_request_application" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Vehicle Request</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=travel_advance_request" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Travel Advance Request</span>
                </a>
              </li>
              
              <li class="sidebar-item">
                <a href="dashboard.php?page=request_liquidation" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Trip Liquidation</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
              <span class="d-flex">
                <i class="ti ti-users"></i>
              </span>
              <span class="hide-menu">Muscco Staff</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="dashboard.php?page=users_list" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Staff List</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=add_user" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Add Staff</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
              <span class="d-flex">
                <i class="ti ti-archive"></i>
              </span>
              <span class="hide-menu">Saccos</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="dashboard.php?page=sacco_list" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Sacco List</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=sacco_report" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Sacco Report</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=add_sacco" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Add Sacco</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
              <span class="d-flex">
                <i class="ti ti-user-star"></i>
              </span>
              <span class="hide-menu">DEs</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="dashboard.php?page=des_list" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Des List</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=add_de" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Add De</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="dashboard.php?page=invoice_list" aria-expanded="false">
              <span class="rounded-3">
                <i class="ti ti-file-invoice"></i>
              </span>
              <span class="hide-menu">Invoices</span>
            </a>
          </li>


          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="dashboard.php?page=bands_rates" aria-expanded="false">
              <span class="rounded-3">
                <i class="ti ti-settings"></i>
              </span>
              <span class="hide-menu">Admin Settings</span>
            </a>
          </li>
        <?php } elseif ($_SESSION['USR_TYP'] == 1) { ?>
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
              <span class="d-flex">
                <i class="ti ti-users"></i>
              </span>
              <span class="hide-menu">Staff Members</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="dashboard.php?page=users_list" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Staff List</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=add_user" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Add Staff</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="dashboard.php?page=settings" aria-expanded="false">
              <span class="rounded-3">
                <i class="ti ti-settings"></i>
              </span>
              <span class="hide-menu">Maintenance</span>
            </a>
          </li>
        <?php
        } elseif ($_SESSION['USR_TYP'] == 2) {  ?>
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
              <span class="d-flex">
                <i class="ti ti-click"></i>
              </span>
              <span class="hide-menu">Online Applications</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="dashboard.php?page=my_leave_applications" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Leave</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=my_advances" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Advance Requests</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=my_petty_cash" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Petty Cash Requisitions</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a href="dashboard.php?page=my_request_application" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Vehicle Request</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=travel_advance_request" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Travel Advance Request</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="dashboard.php?page=request_liquidation" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                  </div>
                  <span class="hide-menu">Trip Liquidation</span>
                </a>
              </li>
            </ul>
          </li>
          <?php
          if (!empty($user_access)) {
            
            foreach ($user_access as $user_a) {
              $permission[] = $user_a['permission_id'];
               if ($user_a['permission_id'] == 9) {
              ?>
                <li class="sidebar-item">
                  <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                    <span class="d-flex">
                      <i class="ti ti-file-dollar"></i>
                    </span>
                    <span class="hide-menu">Sacco Loans</span>
                  </a>
                  <ul aria-expanded="false" class="collapse first-level">                    
                    <li class="sidebar-item">
                      <a href="dashboard.php?page=sacco_loans" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                          <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Pending Applications</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a href="dashboard.php?page=approved_sacco_loans" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                          <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Approved Loans</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a href="dashboard.php?page=declined_sacco_loans" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                          <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Declined Loans</span>
                      </a>
                    </li>
                  </ul>
                </li>
              <?php
                  }
              if ($user_a['permission_id'] == 3) {
          ?>
                <li class="sidebar-item">
                  <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                    <span class="d-flex">
                      <i class="ti ti-file-invoice"></i>
                    </span>
                    <span class="hide-menu">Invoices</span>
                  </a>
                  <ul aria-expanded="false" class="collapse first-level">                    
                    <li class="sidebar-item">
                      <a href="dashboard.php?page=invoice_list" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                          <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Invoice List</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a href="dashboard.php?page=add_invoice" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                          <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Post Invoice</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a href="dashboard.php?page=invoice_reports" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                          <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Invoice Report</span>
                      </a>
                    </li>
                  </ul>
                </li>
          <?php
              } 
            }
            if(in_array(19, $permission)){ ?>
                <li class="sidebar-item">
                  <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                    <span class="d-flex">
                      <i class="ti ti-archive"></i>
                    </span>
                    <span class="hide-menu">Saccos</span>
                  </a>
                  <ul aria-expanded="false" class="collapse first-level">                    
                    <li class="sidebar-item">
                      <a href="dashboard.php?page=sacco_list" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                          <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Sacco Directory</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a href="dashboard.php?page=sacco_report" class="sidebar-link">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                          <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Sacco Report</span>
                      </a>
                    </li>
                  </ul>
                </li>
            <?php  
            }else{
              echo '<li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="dashboard.php?page=sacco_list" aria-expanded="false">
              <span class="rounded-3">
                <i class="ti ti-archive"></i>
              </span>
              <span class="hide-menu">Sacco Directory</span>
            </a>
          </li>
';
            }
          }
          ?>
          

          

        <?php } ?>
        <?php
        if ($_SESSION['USR_TYP'] == 3) {
          if (!empty($user_access)) {
            //print_r($user_access);
            foreach ($user_access as $user_a) {

              if ($user_a['permission_id'] == 3) {
        ?>
                <li class="sidebar-item">
                  <a class="sidebar-link sidebar-link" href="dashboard.php?page=invoice_list" aria-expanded="false">
                    <span class="rounded-3">
                      <i class="ti ti-file-invoice"></i>
                    </span>
                    <span class="hide-menu">Invoices</span>
                  </a>
                </li>
              <?php
              }
              if ($user_a['permission_id'] == 9) {
              ?>
                <li class="sidebar-item">
                  <a class="sidebar-link sidebar-link" href="dashboard.php?page=loan_list" aria-expanded="false">
                    <span class="rounded-3">
                      <i class="ti ti-currency-dollar"></i>
                    </span>
                    <span class="hide-menu">Loans</span>
                  </a>
                </li>
          <?php
              }
            }
          }
          ?>

        <?php } ?>


        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="dashboard.php?page=event_list" aria-expanded="false">
            <span class="rounded-3">
              <i class="ti ti-calendar"></i>
            </span>
            <span class="hide-menu">Events</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="dashboard.php?page=documents_list" aria-expanded="false">
            <span>
              <i class="ti ti-download"></i>
            </span>
            <span class="hide-menu">Document Repository</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="dashboard.php?page=discussions" aria-expanded="false">
            <span>
              <i class="ti ti-message-dots"></i>
            </span>
            <span class="hide-menu">Discussion Area </span>
          </a>
        </li>
        <?php if($_SESSION['USR_TYP'] != 4){ ?>
        <li class="sidebar-item">
          <a class="sidebar-link justify-content-between" href="dashboard.php?page=notifications" aria-expanded="false">

            <div class="d-flex align-items-center gap-3">
              <span class="d-flex">
                <i class="ti ti-bell-ringing"></i>
              </span>
              <span class="hide-menu">Notifications</span>
            </div>

          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link justify-content-between" href="dashboard.php?page=help_desk" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
              <span class="d-flex">
                <i class="ti ti-help"></i>
              </span>
              <span class="hide-menu">Help Desk</span>
            </div>
          </a>

        </li>
        <?php } ?>
        <li class="sidebar-item">
          <a class="sidebar-link" href="dashboard.php?page=faqs" aria-expanded="false">
            <span>
              <i class="ti ti-info-circle"></i>
            </span>
            <span class="hide-menu">FAQs</span>
          </a>
        </li>
        <?php
          if(in_array(16, $permission)){
            ?>
            <li class="sidebar-item">
              <a class="sidebar-link sidebar-link" href="dashboard.php?page=bands_rates" aria-expanded="false">
                <span class="rounded-3">
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Admin Settings</span>
              </a>
            </li>                  
          <?php } ?>
        <li class="sidebar-item">
          <a class="sidebar-link" href="dashboard.php?page=my_profile" aria-expanded="false">
            <span>
              <i class="ti ti-user-circle"></i>
            </span>
            <span class="hide-menu">My Profile</span>
          </a>
        </li>

    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!-- Sidebar End -->