<div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">FAQ</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-muted" href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item" aria-current="page">FAQ</li>
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
          <div class="row justify-content-center">
            <div class="col-lg-8">
            <div class="text-center mb-7">
              <h3 class="fw-semibold">Frequently asked questions</h3>
              <p class="fw-normal mb-0 fs-4">Get to know more about Muscco products and services</p>
            </div>
            <div class="accordion accordion-flush mb-5 card position-relative overflow-hidden" id="accordionFlushExample">
              <?php 
                $faqs = $con->getRows('faqs', array('order_by'=>'faq_id'));
                if(!empty($faqs)){
                  foreach ($faqs as $faq) { ?>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne<?=$faq['faq_id']?>">
                        <button class="accordion-button collapsed fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?=$faq['faq_id']?>" aria-expanded="false" aria-controls="flush-collapseOne<?=$faq['faq_id']?>">
                          <?=$faq['question']?>
                        </button>
                      </h2>
                      <div id="flush-collapseOne<?=$faq['faq_id']?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne<?=$faq['faq_id']?>" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body fw-normal">
                          <?=$faq['answer']?>
                        </div>
                      </div>
                    </div>
                <?php  }
                }
              ?>
            </div>
            </div>
          </div>
          <div class="card bg-light-info rounded-2">
            <div class="card-body text-center">
              
              <h3 class="fw-semibold">Still have questions</h3>
              <p class="fw-normal mb-4 fs-4">Can't find the answer your're looking for? Please contact our helpdesk team.</p>
              <a href="dashboard.php?page=add_ticket" class="btn btn-primary mb-8">Contact Helpdesk</a>
            </div>
          </div>