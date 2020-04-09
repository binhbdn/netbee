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
                                        <h4 class="card-title"><i class="fad fa-bullhorn"></i> TIN NỔI BẬT </h4>
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
                    <section id="profile-info">
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title"><i class="fad fa-bullhorn"></i> TIN MỚI </h4>
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
                                            <JobsList1Col :DataList="arrayJob"></JobsList1Col>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <section id="nav-filled">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card overflow-hidden">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <!-- Nav tabs -->
                                                                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="true"><i class="fad fa-align-center"></i> LĨNH VỰC</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false"><i class="fas fa-map-marker-check"></i> KHU VỰC</a>
                                                                        </li>
                                                                    </ul>
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-content pt-1">
                                                                        <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
                                                                            <ul class="nav flex-column">
                                                                                <li class="nav-item"><i class="fad fa-location-arrow"></i> 1</li>
                                                                                <li class="nav-item"><i class="fad fa-location-arrow"></i> 1</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
                                                                           <ul class="nav flex-column">
                                                                                <li class="nav-item"><i class="fad fa-location-arrow"></i> 2</li>
                                                                                <li class="nav-item"><i class="fad fa-location-arrow"></i> 2</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
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
                        </div>
                    </section>
              </div>
          </div>
      </div>
  </div>
</template>
<script>
import JobsList1Col from '~/components/Jobs/JobsList1Col';
import JobsList2Col from '~/components/Jobs/JobsList2Col';
export default {
    components: {
        JobsList2Col,
        JobsList1Col
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