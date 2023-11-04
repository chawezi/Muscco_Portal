<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Discussion Area</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page">Discussions</li>
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
      <div class="col-md-12 single-note-item all-category note-social">
        <div class="card card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Discussion Topics</h5>
              <p class="card-subtitle mb-0">Topics posted for discussions, to add your comment click on view button</p>
            </div>
            <div>
              <div class="btn-group mb-2">
                <a href="dashboard.php?page=add_topic" class="btn btn-primary">
                  Add New Topic
                </a>
                
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="zero_config" class="table search-table align-middle dataTable">
            <thead class="header-item">
              <th>
                #
              </th>
              <th>Topic</th>
              <th>Posted By</th>
              <th>Date</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php
                $topics = $con->getRows('discussions a, muscco_members b', array('where'=>'a.posted_by=b.muscco_member_id','order_by'=>'a.date_posted desc'));
                if(!empty($topics)){
                  $i=0;
                  foreach($topics as $note){ 
                    $i++;
              ?>
                    <tr class="search-items">
                      <td>
                        <?=$i?>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <div class="user-meta-info">
                              <h6 class="user-name mb-0" data-name=""><?=$note['topic']?></h6>
                              <span class="usr-email-addr"><?=$note['description']?></span>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="usr-email-addr"><?=ucwords($note['first_name']).' '.ucwords($note['last_name'])?></span>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <div class="user-meta-info">
                              <h6 class="user-name mb-0" data-name=""><?=$con->shortDate($note['date_posted'])?></h6>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
                            <a href="dashboard.php?page=open_topic&topic_id=<?=$note['topic_id']?>"  class="btn btn-primary btn-sm">
                              Comments
                            </a>
                          </div>
                          
                        </div>
                      </td>
                    </tr>
              <?php }
                }
              ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
