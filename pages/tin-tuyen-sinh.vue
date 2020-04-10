<template>
  <div class="container">
    <!-- VIỆC LÀM MỚI -->
    <section>
      <div class="row">
        <div class="col-lg-8 col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><i class="fad fa-bullhorn"></i> VIỆC LÀM MỚI </h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                  <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1Col :DataList="arrayJob"></JobsList1Col>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><i class="fad fa-bullhorn"></i> VIỆC LÀM HOT NHẤT </h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                  <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1ColNotCate :DataList="arrayJob"></JobsList1ColNotCate>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- VIỆC LÀM mới -->
    <section>
      <div class="row">
        <div class="col-lg-4 col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><i class="fad fa-bullhorn"></i> XUẤT KHẨU LAO ĐỘNG </h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                  <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1ColNotCate :DataList="arrayJob"></JobsList1ColNotCate>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><i class="fad fa-bullhorn"></i> DU HỌC SINH  </h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                  <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1ColNotCate :DataList="arrayJob"></JobsList1ColNotCate>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><i class="fad fa-bullhorn"></i> TU NGHIỆP SINH </h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                  <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1ColNotCate :DataList="arrayJob"></JobsList1ColNotCate>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
  import JobsList1Col from '~/components/Jobs/JobsList1Col';
  import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';
  export default {
    head: {
      title: '123',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { hid: 'description', name: 'description', content: '1235' }
      ],
    },
    components: {
      JobsList1Col,
      JobsList1ColNotCate
    },
    data () {
      return {
        arrayJob: [
          {id: 1, title: 'chào cả nhà1'},
          {id: 2, title: 'chào cả nhà2'},
          {id: 3, title: 'chào cả nhà3'},
          {id: 4, title: 'chào cả nhà4'},
          {id: 5, title: 'chào cả nhà5'},
          {id: 6, title: 'chào cả nhà6'},
          {id: 6, title: 'chào cả nhà6'},
          {id: 6, title: 'chào cả nhà6'},
        ],
      }
    },
  }
</script>