<template >
  <div class="ftco-search container">
    <div class="row">
      <div class="card-content col-md-12" style="padding-top: 100px">
        <div class="card-body search pl-0">
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
                          <select name="" id="" class="form-control" style="color: #d9d9d9 !important;">
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
                              <select name="" id="" class="form-control" style="color: #d9d9d9 !important;" >
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
                          <select name="cate_id" id="" class="form-control" style="color: #d9d9d9 !important;">
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
                          <select name="" id="" class="form-control fas fa-location-arrow">
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

