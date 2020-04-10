<template>
  <div class="container">
    <!-- VIỆC LÀM HẤP DẪN -->
    <section>
      <div class="row">
        <div class="col-lg-12 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><i class="fad fa-bullhorn"></i> VIỆC LÀM HẤP DẪN </h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                  <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                  <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body" style="padding-bottom: 5px;">
                <JobsList2Col :DataList="arrayJob"></JobsList2Col>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {

}
</script>
