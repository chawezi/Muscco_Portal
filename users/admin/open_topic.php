<?php
  $topic_id = '';
  if(isset($_GET['topic_id'])){
    $topic_id = $_GET['topic_id'];
  }
  $topic = $con->getRows('discussions a, muscco_members b', array('where'=>'a.posted_by=b.muscco_member_id and a.topic_id="'.$topic_id.'"', 'return_type'=>'single'));

?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Discussion Area</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Topic Details</li>
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
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-none border">
          <div class="card-body">
            <h4 class="fw-semibold mb-3"><?=$topic['topic']?></h4>
            <p><?=$topic['description']?></p>
            <ul class="list-unstyled mb-0">
              <li class="d-flex align-items-center gap-3 mb-4">
                <i class="ti ti-user-circle text-dark fs-6"></i>
                <h6 class="fs-4 fw-semibold mb-0"><?=ucwords($topic['first_name']).' '.ucwords($topic['last_name'])?></h6>
              </li>
              <li class="d-flex align-items-center gap-3 mb-4">
                <i class="ti ti-calendar text-dark fs-6"></i>
                <h6 class="fs-4 fw-semibold mb-0"><?=$topic['date_posted']?></h6>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body border-bottom ">
            <div class="position-relative overflow-hidden">
              <div class="position-relative" style="height: calc(100vh - 428px)" data-simplebar>
                <div id="show_comments"></div>
              </div>
              
            </div>
          </div>
          <form id="add-topic">
            <div id="topic_response"></div>
          <div class="d-flex align-items-center gap-3 p-3">
            <img src="../../dist/images/profile/user-1.jpg" alt="" class="rounded-circle" width="33" height="33">
            
              <input type="text" class="form-control py-8" name="comment" id="exampleInputtext" aria-describedby="textHelp" placeholder="Share your thoughts">
              <input type="hidden" name="topic_id" value="<?=$topic_id?>">
              <button type="submit" class="btn btn-primary" name="add_comment" id="add_comment">Comment</button>
                       
          </div>
          </form> 
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  function getComments(){
    let action = "get_comments";
    let id = "<?=$topic_id?>";
  $.ajax({
      url:"get_topics_data.php",
      method:"GET",
      data:{action:action, id:id},
      success:function(data){ //alert(data);
          $('#show_comments').html(data);
      }
  });
  }
  getComments();
</script>