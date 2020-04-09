<template>
  <div class="container">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
          <div class="content-body">
              <div id="user-profile">
                    <section id="profile-info">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">TIN NỔI BẬT </h4>
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
                                        <div class="card-body">
                                            <JobsList2Col :DataList="arrayJob"></JobsList2Col>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
              </div>
          </div>
      </div>
  </div>
</template>
<script>
import JobsList2Col from '~/components/Jobs/JobsList2Col';
export default {
    components: {
        JobsList2Col
    },
    data() {
        return {
            arrayJob: [
                {id: 1, title : 'chào cả nhà1'},
                {id: 2, title : 'chào cả nhà2'},
                {id: 3, title : 'chào cả nhà3'},
                {id: 4, title : 'chào cả nhà4'},
            ]
        }
    },
}
</script>