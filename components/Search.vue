<template >
  <div class="ftco-search container">
    <div class="row">
      <div class="col-md-12 nav-link-wrap">
        <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a href="" class="nav-link mr-md-1 p-0 active"  id="v-pills-1-tab" data-toggle="pill" role="tab" aria-controls="v-pills-1" aria-selected="true">Tìm trường học</a>
          <a class="nav-link mr-md-1 mr-1 p-0"   href="" >Tìm kiếm ứng viên</a>
          <a class="nav-link mr-md-1" id="v-pills-2-tab" data-toggle="pill"  href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Săn học bổng</a>
          <a class="nav-link mr-md-1" id="v-pills-3-tab" data-toggle="pill"  href="#tim-kiem-viec-lam" role="tab" aria-controls="v-pills-3" aria-selected="false">Tìm kiếm việc làm</a>
        </div>
<!--        khi click tab1 cos id="v-pill-1-tab" thì truy cập đến thuộc tính aria-labelledby = "id" -->
<!--        Khi click vào thì trong cái tab-content chỉ có cái ý hoạt động thôi-->
      </div>
      <div class="col-md-12 tab-wrap">
        <div class="tab-content p-4" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
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
                          <option disabled selected>--Chọn quốc gia--</option>
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
          <div class="tab-pane fade" id="v-pills-2"  role="tabpanel" aria-labelledby="v-pills-2-tab">
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
                        <div class="icon" style="left:10px !important"><span class="icon-map-marker"></span></div>
                        <select name="" id="" class="form-control">
                          <option disabled selected>--Chọn quốc gia--</option>
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
          <div class="tab-pane fade" id="tim-kiem-viec-lam" role="tabpanel" aria-labelledby="v-pills-3-tab">
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
                        <select name="" id="" class="form-control fas fa-location-arrow">
                          <option disabled selected>-- Tất cả địa điểm--</option>
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
</template>
<script>

  export default {
    name: 'Header',
    data () {
      return {
      }
    }
  }
</script>

