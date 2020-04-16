<template>
  <div class="hero-wrap js-fullheight m-b-15" :style="{'background-image':'url('+backgroundUrl+');'}" style="position: relative; height: 100%" data-stellar-background-ratio="0.5">
    <div class="section-intro">
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-xl-12 ftco-animate mb-5 pb-5 container" data-scrollax=" properties: { translateY: '70%' }">
            <p class="mb-4 mt-5 " data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"></p>
            <div class="ftco-search container pl-0 pr-0">
              <div class="row">
                <div class="card-content col-md-12 pl-0 pr-0" style="padding-top: 70px!important">
                  <div class="card-body search ">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" style="float:left;">
                      <li class="nav-item">
                        <a class="nav-link active" id="v-pills-11-tab" data-toggle="tab" href="#v-pills-11"
                           role="tab" aria-controls="v-pills-11" aria-selected="true">Tìm trường học</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="v-pills-22-tab" data-toggle="tab" href="#v-pills-22"
                           role="tab" aria-controls="v-pills-22" aria-selected="false">Tìm ứng viên</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill"
                           role="tab" aria-controls="profile-fill" aria-selected="false">Săn học bổng</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="v-pills-33-tab" data-toggle="tab" href="#v-pills-33"
                           role="tab" aria-controls="v-pills-33" aria-selected="false">Tìm việc làm</a>
                      </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content pt-1 tab-ct2 pl-2 pr-2" style="clear:both;">
                      <div class="tab-pane active" id="v-pills-11" role="tabpanel"
                           aria-labelledby="v-pills-11-tab">
                        <form action="" class="search-job">
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="icon" style="left:23px !important;top: 19px!important;"><i class="fas fa-briefcase"></i></div>
                                  <input type="text" class="form-control" placeholder="Từ khóa" name="keyword" value="">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="select-wrap">
                                    <div class="icon" style="right: 10px !important"><span class="ion-ios-arrow-down"></span></div>
                                    <div class="icon" style="left:10px !important"><i class="fas fa-map-marked-alt"></i></div>
                                    <select name="" id="" class="form-control">
                                      <option disabled selected>Chọn quốc gia</option>
                                      <option value="">name</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <input type="submit" value="Tìm ngay" class="form-control btn btn-primary">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12 d-none" id="detail_search" style="padding-left: 15px; padding-top: 10px;">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-graduation-cap"></i></div>
                                        <select name="" id="" class="form-control" >
                                          <option disabled selected>Trình độ học vấn</option>
                                          <option value="Cấp 3">Cấp 3</option>
                                          <option value="Cao Đẳng">Cao đẳng</option>
                                          <option value="Đại học">Đại học</option>
                                          <option value="Sau đại học">Sau đại học</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-credit-card"></i></div>
                                        <select name="" id="" class="form-control">
                                          <option disabled selected>Mức lương</option>

                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-tags"></i></div>
                                        <select name="" id="" class="form-control" >
                                          <option disabled selected>Tay nghề</option>

                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-transgender-alt"></i></div>
                                        <select name="" id="" class="form-control">
                                          <option disabled selected>Giới tính</option>
                                          <option value="1">Nam</option>
                                          <option value="2">Nữ</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="v-pills-22" role="tabpanel"
                           aria-labelledby="v-pills-22-tab">
                        <form action="#" class="search-job">
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="icon" style="left:23px !important;top: 19px!important;"><i class="fas fa-briefcase"></i></div>
                                  <input type="text" class="form-control" placeholder="Từ khóa" name="keyword" value="">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="select-wrap">
                                    <div class="icon" style="right: 10px !important"><span class="ion-ios-arrow-down"></span></div>
                                    <div class="icon" style="left:10px !important"><span class="fa fa-folder-open"></span></div>
                                    <select name="cate_id" id="" class="form-control">
                                      <option disabled selected>Loại hình</option>
                                      <option value="1">Du học</option>
                                      <option value="3">Tu nghiệp sinh</option>
                                      <option value="2">Lao động</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="select-wrap">
                                    <div class="icon" style="right: 10px !important"><span class="ion-ios-arrow-down"></span></div>
                                    <div class="icon" style="left:10px !important"><i class="fas fa-map-marked-alt"></i></div>
                                    <select name="" id="" class="form-control">
                                      <option disabled selected>Chọn quốc gia</option>
                                      <option value="">name</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <input type="submit" value="Tìm ngay" class="form-control btn btn-primary" style="width: 95%;">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 advanced_search_box" id="advanced_search_box ">
                              <a href="javascript:void();" id="advanced_search" class="pb-1"> <b>Tìm kiếm nâng cao</b> </a>
                            </div>
                            <div class="col-md-12 d-none" id="detail_search" style="padding-left: 15px; padding-top: 10px;">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-graduation-cap"></i></div>
                                        <select name="" id="" class="form-control" >
                                          <option disabled selected>Trình độ học vấn</option>
                                          <option value="Cấp 3">Cấp 3</option>
                                          <option value="Cao Đẳng">Cao đẳng</option>
                                          <option value="Đại học">Đại học</option>
                                          <option value="Sau đại học">Sau đại học</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-credit-card"></i></div>
                                        <select name="" id="" class="form-control">
                                          <option disabled selected>Mức lương</option>

                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-tags"></i></div>
                                        <select name="" id="" class="form-control" >
                                          <option disabled selected>Tay nghề</option>

                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-transgender-alt"></i></div>
                                        <select name="" id="" class="form-control">
                                          <option disabled selected>Giới tính</option>
                                          <option value="1">Nam</option>
                                          <option value="2">Nữ</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="v-pills-33" role="tabpanel"
                           aria-labelledby="v-pills-33-tab">
                        <form action="#" class="search-job">
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="icon" style="left:23px !important; top: 19px!important;"><i class="fas fa-briefcase"></i></div>
                                  <input type="text" class="form-control" placeholder="Tiêu đề công việc, vị trí, địa điểm làm việc..." name="keyword" value="">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="select-wrap">
                                    <div class="icon" style="right: 10px !important"><span class="ion-ios-arrow-down"></span></div>
                                    <div class="icon" style="left:10px !important"><span class="fa fa-folder-open"></span></div>
                                    <select name="cate_id" id="" class="form-control">
                                      <option disabled selected>Tất cả ngành nghề</option>
                                      <option value="1" >Du học</option>
                                      <option value="3">Tu nghiệp sinh</option>
                                      <option value="2">Lao động</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="select-wrap">
                                    <div class="icon" style="right: 10px !important"><span class="ion-ios-arrow-down"></span></div>
                                    <div class="icon" style="left:10px !important"><i class="fas fa-map-marked-alt"></i></div>
                                    <select name="" id="" class="form-control fas fa-location-arrow" style="font-weight:400;    font-family: inherit;">
                                      <option disabled selected>Tất cả địa điểm</option>
                                      <option value="">name</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="form-field">
                                  <input type="submit" value="Tìm ngay" class="form-control btn btn-primary" style="width: 95%;">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 advanced_search_box" id="advanced_search_box">
                              <a href="javascript:void();" id="advanced_search"> <b>Tìm kiếm nâng cao</b> </a>
                            </div>
                            <div class="col-md-12 d-none" id="detail_search" style="padding-left: 15px; padding-top: 10px;">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-graduation-cap"></i></div>
                                        <select name="" id="" class="form-control" >
                                          <option disabled selected>Trình độ học vấn</option>
                                          <option value="Cấp 3">Cấp 3</option>
                                          <option value="Cao Đẳng">Cao đẳng</option>
                                          <option value="Đại học">Đại học</option>
                                          <option value="Sau đại học">Sau đại học</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-credit-card"></i></div>
                                        <select name="" id="" class="form-control">
                                          <option disabled selected>Mức lương</option>

                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-tags"></i></div>
                                        <select name="" id="" class="form-control" >
                                          <option disabled selected>Tay nghề</option>

                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-field">
                                      <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <div class="icon" style="left:10px !important"><i class="fa fa-transgender-alt"></i></div>
                                        <select name="" id="" class="form-control">
                                          <option disabled selected>Giới tính</option>
                                          <option value="1">Nam</option>
                                          <option value="2">Nữ</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
      data() {
         return { backgroundUrl:require('~/static/assets/img/bg_2.jpg') }
        },
  }
</script>
<style scoped>
  .ftco-search .nav-pills .nav-link.active, .ftco-search .nav-pills .nav-link:hover {
    color: #ffb701!important;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
  }
  .ftco-search .nav-pills .nav-link {
    padding: 10px 30px !important;
    margin-bottom: 0;
    color: #000!important;
    border-radius: 0;
    font-size: 16px;
    font-weight: 400;
    font-weight: 700;
    position: relative;
    display: inline-block;
    border: 1px solid transparent;
    background: #ffb701;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
  #v-pills-tabContent {
    background: rgba(255, 255, 255, 0.1);
    margin-top: 0px;
    margin-bottom: 20px;
  }
  .tab-content>.active {
    display: block;
  }
  .ftco-search .tab-content {
    background: #fff;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    border-top-left-radius: 0px;
    margin-top: -9px;
    color: #fff;
  }
  .p-4 {
    padding: 1.5rem !important;
  }
  .nav.nav-pills {
    margin-bottom: 0;
  }
  .ftco-search .nav-pills .nav-link {
    padding: 10px 15px!important;
  }
  .mr-md-1, .mx-md-1 {
    margin-right: 0.25rem !important;
  }
  .search-job .form-group .form-control.btn.btn-primary {
    background: #ffb701 !important;
  }
  .search-job .form-group .form-control.btn {
    padding: 0 !important;
    font-size: 16px;
    color: #000 !important;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    border-radius: 5px;
  }
  .btn.btn-primary {
    background: #ffb701 !important;
    border: 1px solid #ffb701 !important;
    color: #fff !important;
  }
  .search-job .form-group .select-wrap {
    position: relative;
  }
  .search-job .form-group .icon {
    position: absolute;
    top: 51%;
    right: 10px;
    width: 20px;
    font-size: 16px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    color: #d9d9d9;
  }
  .search-job .form-group .form-control {
    padding-right: 30px;
    padding-left: 35px;
    display: block;
    width: 100%;
    font-size: 13px;
    border: 1px solid #d9d9d9;
    color: rgba(0, 0, 0, 0.7) !important;
    background: transparent !important;
  }
  .ftco-search .search-job .form-group .form-control {
    background: #fff !important;
  }
  .advanced_search_box {
    margin-top: 7px;
    text-align: right;
    color: white!important;
    margin-bottom: 10px;
  }
  .advanced_search_box a{
    color: white!important;
  }
  .search ul{
    margin-bottom: 0;
  }
  .search ul li a{
     padding: 10px 30px !important;
     margin-bottom: 0;
     color: #000!important;
     font-size: 16px!important;
     font-weight: 400;
     font-weight: 600!important;
     position: relative;
     height: 98%;
     display: inline-block;
     border: 1px solid transparent;
     background: #ffb701;
     border-top-left-radius: 5px!important;
     border-top-right-radius: 5px!important;
     margin-right: 5px;
   }
  .search ul li a.active{
    color: #ffb701!important;
  }
  .search ul li a:hover{
    color: #ffb701!important;
  }
  .advanced_search_box a{
    color: white!important;
  }
  .ftco-search .tab-ct2 {
    background: rgba(255, 255, 255, 0.1)!important;
    border-radius: 3px;
    border-top-left-radius: 0;
    margin-top: -9px;
    color: #fff!important;
  }
  .nav.nav-tabs .nav-item .nav-link.active:after {
    content: unset!important;
  }
  .nav.nav-tabs .nav-item .nav-link.active{
    background: hsla(0,0%,100%,.1)!important;
  }
  .nav.nav-tabs .nav-item .nav-link:hover {
    background: hsla(0,0%,100%,.1)!important;
  }
  .search ul li a i {
    padding-right: 3px;
  }
  .no-gutters {
    margin-right: 0;
    margin-left: 0;
    height: 300px !important;
  }
  .hero-wrap, .img, .blog-img, .user-img {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
  }
  .section-intro:before {
    content: "";
    left: 0;
    width: 100%;
    height: 100%;
    display: inline-block;
    background-color: rgba(42, 46, 50, 0.8);
    position: absolute;
  }
  .ftco-search .nav-pills .nav-link.active, .ftco-search .nav-pills .nav-link:hover {
    color: #ffb701;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
  }
</style>
