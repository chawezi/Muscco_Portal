 <header class="app-header"> 
          <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                  <i class="ti ti-menu-2"></i>
                </a>
              </li>
            </ul>
            <ul class="navbar-nav quick-links d-none d-lg-flex">
              <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="dashboard.php?page=discussions">Discussion Area</a>
              </li>
              <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="dashboard.php?page=event_list">Events</a>
              </li>
              <li class="nav-item dropdown-hover d-none d-lg-block">
                <a class="nav-link" href="dashboard.php?page=faqs">FAQs</a>
              </li>
            </ul>
            <div class="d-block d-lg-none">
              <img src="../../dist/images/logo.png" class="dark-logo" width="180" alt="" />
              <img src="../../dist/images/logo.png" class="light-logo"  width="180" alt="" />
            </div>
            <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
              </span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="d-flex align-items-center justify-content-between">
                <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                  <i class="ti ti-align-justified fs-7"></i>
                </a>
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                  <li class="nav-item">
                    <a class="nav-link notify-badge nav-icon-hover" href="dashboard.php?page=my_profile" title="My Profile" >
                        <i class="ti ti-user-cog"></i>                 
                    </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="../../sign-out.php" title="Logout" id="drop2" >
                      <i class="ti ti-logout"></i>
                    </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="../../lock_account.php?url=<?=$url?>" title="Lock Account" id="drop2" >
                      <i class="ti ti-lock"></i>
                    </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="d-flex align-items-center">
                        <div class="user-profile-img">
                          <div id="header_profile_picture"></div>
                        </div>
                      </div>
                    </a>
                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                      <div class="profile-dropdown position-relative" data-simplebar>
                        <div class="py-3 px-7 pb-0">
                          <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                        </div>
                        <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                          <div id="header_dropdown_picture"></div>
                          <div class="ms-3">

                            <h5 class="mb-1 fs-3"><?=ucwords($my_info['first_name']).' '.ucwords($my_info['last_name'])?></h5>
                            <span class="mb-1 d-block text-dark"><?=$position?></span>
                            <p class="mb-0 d-flex text-dark align-items-center gap-2">
                              <i class="ti ti-mail fs-4"></i> <?=$my_info['email_address']?>
                            </p>
                          </div>
                        </div>
                        <div class="message-body">
                          <a href="dashboard.php?page=my_profile" class="py-8 px-7 mt-8 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                              <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg" alt="" width="24" height="24">
                            </span>
                            <div class="w-75 d-inline-block v-middle ps-3">
                              <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                              <span class="d-block text-dark">Account Settings</span>
                            </div>
                          </a>
                          <a href="dashboard.php?page=notifications" class="py-8 px-7 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                              <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-inbox.svg" alt="" width="24" height="24">
                            </span>
                            <div class="w-75 d-inline-block v-middle ps-3">
                              <h6 class="mb-1 bg-hover-primary fw-semibold">My Inbox</h6>
                              <span class="d-block text-dark">Messages & Emails</span>
                            </div>
                          </a>
                        </div>
                        <div class="d-grid py-4 px-7 pt-8">
                          <a href="../../sign-out.php" class="btn btn-outline-primary">Log Out</a>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </header>