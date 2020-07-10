<template>
    <div class="container" style="padding-top:65px; position: relative">
        <div class="bk-auto" v-if="congty.nb_company != null && congty.nb_company.image_cover != null" role="img" :style="{ 'background-image': 'url(' + `/uploads/users/covers/${congty.nb_company.image_cover}` + ')' }"></div>
        <div class="bk-auto" v-if="congty.nb_company != null && congty.nb_company.image_cover == null" role="img" :style="{ 'background-image': 'url(' + `/assets/img/BgBanner.png` + ')' }"></div>
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body" v-if="detailCompany != null">
                    <div class="row p-1">
                        <div class="col-lg-2 d-flex align-items-center avt-company">
                            <img v-lazy="`/uploads/users/avatars/${detailCompany.avatar}`" :alt="`${detailCompany.avatar}`" width="100%">
                        </div>
                        <div class="col-lg-8 d-flex align-items-center">
                            <div class="company-job-title">
                                <h2 class="font-weight-bold text-uppercase"><span style="font-size: 16px;" class="company-name"  data-toggle="tooltip" data-placement="right" :title="`${detailCompany.name}`"> {{ detailCompany.name }} </span></h2>
                                <p><span class="font-weight-400"><i class="fad fa-map-marked-alt"></i> <span class="font-weight-600">Địa chỉ:</span> {{ detailCompany.address_detail ? detailCompany.address_detail: 'Đang cập nhật' }}</span></p>
                                <!--<p><span class="font-weight-400"><i class="fad fa-phone-office"></i> <span class="font-weight-600">Hotline:</span> {{ detailCompany.nb_company.company_hotline ? detailCompany.nb_company.company_hotline: 'Đang cập nhật' }}</span></p>
                                <p><span class="font-weight-400"><i class="fad fa-link"></i> <span class="font-weight-600">Website:</span> {{ detailCompany.nb_company.company_link ? detailCompany.nb_company.company_link: 'Đang cập nhật' }}</span></p>
                                <p><span class="font-weight-400"><i class="fad fa-link"></i> <span class="font-weight-600">Facebook:</span> {{ detailCompany.nb_company.company_link_fb ? detailCompany.nb_company.company_link_fb: 'Đang cập nhật' }}</span></p> -->
                                <p><span class="font-weight-400"><i class="fad fa-calendar-minus"></i> <span class="font-weight-600">Ngày thành lập:</span> {{ congty.birth_of_date ? ConvertDate(congty.birth_of_date): 'Đang cập nhật' }}</span></p>
                            </div>
                        </div>
                        <div class="col-lg-2 d-flex align-items-center verify-img">
                            <img v-if="detailCompany.nb_company.company_verify" v-lazy="`/assets/img/verify.png`" data-toggle="tooltip" data-placement="top" :title="'Đã xác thực'">
                            <img v-else v-lazy="`/assets/img/nonverify.png`"  data-toggle="tooltip" data-placement="top" :title="'Xác thực ngay'" @click="verifyModal()">
                        </div>
                        <div class="col-lg-2 ">
                            <div class="count-job" style="margin-top: 6px;">
                                <h1 style="font-size: 70px;color: #ffb701;">{{ countJob.length ? countJob.length : '0' }}</h1>
                                <h2>Việc làm</h2>
                            </div>
                            <div class="count-job" style="margin-top: 18px;">
                                <a v-if="!$auth.loggedIn"  data-toggle="modal" data-target="#loginModal" style="text-align: center;padding: 10px;">
                                    <!-- <p style="font-size: 15px;color: #ffb701;margin-top: 5px;margin-bottom: 3px;">{{followers}}</p> -->
                                    Theo dõi
                                </a>
                                <a v-else @click="followCompany()" style="text-align: center;padding: 10px;">
                                    <!-- <p style="font-size: 15px;color: #ffb701;margin-top: 5px;margin-bottom: 3px;">{{followers}}</p> -->
                                    {{ isFollow  ? 'Đang theo dõi' : 'Theo dõi'}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section v-if="detailCompany != null">
        <div class="row">
          <div class="col-lg-8 col-12 p-r-0">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row p-t-10">
                        <div class="col-12">
                            <div class="col-4 p-l-0">
                                <h5 class="font-weight-600 line-title">GIỚI THIỆU CÔNG TY</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p v-html="detailCompany.nb_company.company_about"></p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                            <div class="col-4 p-l-0">
                                <h5 class="font-weight-600 line-title">CHẾ ĐỘ ĐÃI NGỘ</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p v-html="congty.company_benefit"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-4 p-l-0">
                                <h5 class="font-weight-600 line-title">CƠ HỘI THĂNG TIẾN</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p v-html="congty.company_chance"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-4 p-l-0">
                                <h5 class="font-weight-600 line-title">CHÍNH SÁCH TUYỂN DỤNG</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p v-html="congty.company_policy"></p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
              </div>
            </div>
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">
                    Đơn hàng đang tuyển
                </h3>
                </div>
                <div class="card-content collapse show">
                <div class="card-body">
                    <JobsList1Col :DataList="arrayForCompany"></JobsList1Col>
                </div>
                </div>
            </div>
          </div>
          <div class="col-lg-4 col-12" v-if="detailCompany != null">
              <div class="card p-1">
                <div class="card-header pl-0">
                <h3 class="card-title">
                    Đánh giá tổng thể
                </h3>
                <div class="star-rating pt-1">
                      <star-rating 
                      :rating="detailCompany.rate" 
                      :increment="0.1"
                      :star-size="30"
                      :read-only="true"
                      ></star-rating>
                    </div>
                </div>
                <hr>
                <div class="view-more">
                    <a data-toggle="modal" :data-target="detailCompany.company_feedback.length >3 ? '#modal_feedback' : '#modal_no_feedback'">Xem tất cả đánh giá</a>
                </div>
            </div>
            <div class="card p-1">
                <div class="card-header pl-0">
                <h2 class="w-100">
                    Top đánh giá
                </h2>
                </div>
                <br>
                <div v-for="(item,index) in detailCompany.company_feedback" :key="index">
                <div class="row">
                    <div class="col-4">
                        <img v-lazy="item.avatar_feed != null && item.avatar_feed.startsWith('https') ? item.avatar_feed : `/uploads/users/avatars/${item.avatar_feed}`"
                        style="height:80px; width:80px; padding-top: 1px; padding-left: 20px; object-fit: cover; border-radius: 50%;">
                        
                    </div>
                    <div class="col-8">
                    <div class="star-rating">
                      <star-rating 
                      :rating="item.rate_feed" 
                      :increment="0.1"
                      :star-size="25"
                      :read-only="true"
                      ></star-rating>
                    </div>
                    <h6 class="text-left pt-1 pl-0">{{item.name_feed}} _ {{ ConvertDate(item.created_at) }}</h6>
                </div>
                <hr>
                </div>
                <div class="row pl-2">
                    <div class="view-more pt-1" >
                        <p class="style-loadmore" data-toggle="tooltip" data-placement="top" data-trigger="hover" :data-original-title="item.content_feed">{{item.content_feed}}</p>
                        <!-- <p><a @click="loadMore()">Xem thêm</a></p> -->
                    </div>
                    <!-- <div class="view-more pt-1" v-else>
                        <p :style="styleCollapse">{{item.content_feed}}</p>
                        <p><a @click="collapse()">Thu gọn</a></p>
                    </div> -->
                </div>
                <hr>
                </div>
                <div v-if="!$auth.loggedIn" class="col-sm-12 col-xl-12 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#loginModal">
                    <a style="font-size:16px" class="btn btn-warning w-100" data-toggle="tooltip" data-placement="top" :title="'Viết phản hồi'">Viết phản hồi</a>
                </div>
                <div v-else class="col-sm-12 col-xl-12 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#feedbackModal">
                    <a style="font-size:16px" class="btn btn-warning w-100" data-toggle="tooltip" data-placement="top" :title="'Viết phản hồi'">Viết phản hồi</a>
                </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Modal -->
        <div  class="modal fade text-left" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="col-md-12 col-lg-12 formlogin form-control" >
                    <h2 class="text-center mt-1" style="margin-bottom:15px">Vui lòng đăng nhập</h2>
                    <p class="text-center" style="margin-bottom:20px; font-size: 16px; "><a class="hover" href="dang-ky">Đăng ký tài khoản mới!</a>
                    </p>
                    <div class="form-group-1 input-login" v-on:keyup.enter="login" style="position:relative; padding-bottom:20px">
                        <ValidationObserver ref="observerLogin" v-slot="{ valid }">
                            <ValidationProvider name="Email" ref="email" rules="required|email" v-slot="{ errors }">
                                <div class="__email">
                                    <fieldset class="form-label-group form-group position-relative has-icon-left mb-0">
                                        <input type="text" class="form-control mb-0" id="email" placeholder="Email" v-model="userForm.email" style="margin-bottom:37px !important; margin-top:2px">
                                        <div class="form-control-position">
                                            <i class="far fa-envelope" style="color: rgba(34, 41, 47, 0.4)!important"></i>
                                        </div>
                                        <label for="email">Email</label>
                                        <ul style="color:red" class="overline text-left">
                                        <li v-for="(error, index) in errors" :key="index">
                                        <span style="left:2px; position:absolute;top:42%!important; font-size:13px"><i>{{ error }}</i></span>
                                        </li>
                                    </ul>
                                    </fieldset>
                                </div>
                            </ValidationProvider>
                        <div style="position: relative">
                            <ValidationProvider
                                name="Mật khẩu"
                                ref="password"
                                rules="required|customPassword"
                                v-slot="{ errors }"
                            >
                            <div class="__email">
                                <div style="text-align:right">
                                    <i  class="showpass">
                                        <i @click="showPassword()" :class="show ?'fa fa-eye':'fas fa-eye-slash'"></i>
                                    </i>
                                    
                                </div>
                                <fieldset class="form-label-group position-relative has-icon-left mb-0">
                                    <input class="form-control mb-0" id="password" :type="show ? 'password' : 'text'" placeholder="Mật khẩu" v-model="userForm.password" style="margin-bottom:0px !important; margin-top:2px">
                                    <div class="form-control-position">
                                        <i class="fas fa-lock" style="color: rgba(34, 41, 47, 0.4)!important"></i>
                                    </div>
                                    <label for="password">Mật khẩu</label>
                                    <ul style="color:red" class="overline text-left">
                                        <li v-for="(error, index) in errors" :key="index">
                                        <span style="top: 53%!important;left: 0px; font-size:15px;"><i>{{ error }}</i></span>
                                        </li>
                                    </ul>
                                    <p class="text-right mb-0 mt-2"><a href="/quen-mat-khau" class="remember hover" style="font-size: 15px;color:black!important;">Quên mật khẩu?</a></p>
                                </fieldset>
                            </div>
                            </ValidationProvider>
                            <div class="lopgin-c" style="padding-top:10px">
                                <button @click="login()" id="submit" class="submit btn" style="height:100%; line-height: unset; padding:10px!important">ĐĂNG NHẬP</button>
                            </div>
                            <div class="or-box">
                                <hr>
                                <span>Hoặc</span>
                            </div>
                            <div class="lopgin-c" style="position:relative">
                                <i class="fab fa-facebook" style="position: absolute; left: 106px; top: 10px; color: white; font-size: 18px; z-index:5"></i>
                                <a @click="loginfb()" class="btn btn-outline-info fb" style="padding: 10px!important" >Đăng nhập bằng
                                    Facebook</a> &nbsp;&nbsp;
                            </div>
                            <div class="lopgin-c" style="position:relative">
                                <img src="/assets/img/logo-google.png" style="height:15px;position: absolute; left: 106px; top: 11px; color: blue; font-size: 18px;">
                                <a @click="logingg()" class="btn btn-outline-info gg" style="padding: 10px!important">Đăng nhập bằng Google</a>
                            </div>
                        </div>
                        </ValidationObserver>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- end Modal login -->
        <!-- Modal feedback -->
        <div class="modal fade text-left" id="modal_feedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true" v-if="detailCompany != null">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="card p-1">
                <div class="card-header pl-0">
                <h2 class="w-100">
                    Tất cả đánh giá
                </h2>
                </div>
                <br>
                <div v-for="(item,index) in detailCompany.company_feedback" :key="index">
                <div class="row">
                    <div class="col-4">
                        <img v-lazy="item.avatar_feed != null && item.avatar_feed.startsWith('https') ? item.avatar_feed : `/uploads/users/avatars/${item.avatar_feed}`"
                        style="height:80px; width:80px; padding-top: 1px; padding-left: 20px; object-fit: cover; border-radius: 50%;">
                        
                    </div>
                    <div class="col-8">
                    <div class="star-rating">
                      <star-rating 
                      :rating="item.rate_feed" 
                      :increment="0.1"
                      :star-size="25"
                      :read-only="true"
                      ></star-rating>
                    </div>
                    <h6 class="text-left pt-1 pl-0">{{item.name_feed}} _ {{ ConvertDate(item.created_at) }}</h6>
                </div>
                <hr>
                </div>
                <div class="row pl-2">
                    <div class="view-more pt-1">
                        <p style="style-loadmore" data-toggle="tooltip"  data-placement="top" data-trigger="hover" :data-original-title="item.content_feed">{{item.content_feed}}</p>
                    </div>
                    
                </div>
                <hr>
                </div>
                <div v-if="!$auth.loggedIn" class="col-sm-12 col-xl-12 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#loginModal">
                    <a style="font-size:16px" class="btn btn-warning w-100" data-toggle="tooltip" data-placement="top" :title="'Viết phản hồi'" data-dismiss="modal">Viết phản hồi</a>
                </div>
                <div v-else class="col-sm-12 col-xl-12 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#feedbackModal">
                    <a style="font-size:16px" class="btn btn-warning w-100" data-toggle="tooltip" data-placement="top" data-dismiss="modal" >Viết phản hồi</a>
                </div>
            </div>
                </div>
            </div>
        </div>
        <!-- end Modal login -->
        <!-- Modal form feedback -->
        <div class="modal fade text-left" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="col-md-12 col-lg-12 formlogin form-control" >
                    <h2 class="text-center mt-1" style="margin-bottom:15px">Viết phản hồi</h2>
                    <div class="form-group-1 input-login" v-on:keyup.enter="login" style="position:relative; padding-bottom:20px">
                        <div class="star-rating pb-1">
                        <star-rating 
                            @rating-selected ="setRating"
                            :rating="4.3" 
                            :increment="0.1"
                            :star-size="30"
                        ></star-rating>
                        </div>
                        <ValidationObserver ref="observer" v-slot="{ valid }">
                        <div style="position: relative">
                            <ValidationProvider
                                name="content"
                                ref="content"
                                rules="required"
                                v-slot="{ errors }"
                            >
                            <div class="__email">
                                <fieldset class="form-label-group position-relative has-icon-left mb-0 pt-1">
                                    <textarea class="form-control mb-0" id="content" placeholder="Nội dung phản hồi" v-model="formFeedback.content" style="padding-left:10px;margin-bottom:0px !important; margin-top:2px"></textarea>
                                    <label style="font-size: 15px; padding-top:12px; color: black " for="content">Nội dung</label>
                                    <ul style="color:red" class="overline text-left">
                                        <li v-for="(error, index) in errors" :key="index">
                                        <span style="top: 53%!important;left: 0px; font-size:15px;"><i>{{ error }}</i></span>
                                        </li>
                                    </ul>
                                </fieldset>
                            </div>
                            </ValidationProvider>
                            <div class="lopgin-c" style="padding-top:20px">
                                <button @click="sendFeedback()" id="submit" class="submit btn" style="height:100%; line-height: unset; padding:10px!important">Gửi phản hồi</button>
                            </div>
                            
                        </div>
                        </ValidationObserver>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- end Modal Feedback -->
        <!-- modal thanh toán xác thực -->
        <div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="verify" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <section class="todo-form">
                        <form id="form-edit-todo" class="todo-input">
                            <div class="modal-header  bg-netbee white">
                                <h5 class="modal-title" id="verify">Xác thực tài khoản tuyển dụng - Gói 50,000đ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <fieldset>
                                    <div class="row">
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="MOMO">
                                            <input type="radio" id="MOMO" @click="payWithMomo()">
                                            <img src="/assets/img/bank/logo-momo.jfif" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="ABBank">
                                            <input type="radio"  id="ABB" value="ABB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_ABBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="ACB">
                                            <input type="radio" id="ACB" value="ACB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_ACB_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="AgriBank">
                                            <input type="radio" id="VARB" value="VARB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Agribank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="BacABank">
                                            <input type="radio" id="NASB" value="NASB" v-model="bank">
                                            <img src="/assets/img/bank/ic_BacaBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Techcombank">
                                            <input type="radio" id="TCB" value="TCB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Techcombank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="BIDV">
                                            <input type="radio" id="BIDV" value="BIDV" v-model="bank">
                                            <img src="/assets/img/bank/ic_BIDV_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="DongABank">
                                            <input type="radio" id="DAB" value="DAB" v-model="bank">
                                            <img src="/assets/img/bank/ic_dongabank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Eximbank">
                                            <input type="radio" id="EIB" value="EIB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Eximbank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="HDBank">
                                            <input type="radio" id="HDB" value="HDB" v-model="bank">
                                            <img src="/assets/img/bank/ic_HDBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="LienVietPostBank">
                                            <input type="radio" id="LPB" value="LPB" v-model="bank">
                                            <img src="/assets/img/bank/ic_Lienvietpost_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Maritime Bank">
                                            <input type="radio" id="MSB" value="MSB" v-model="bank">
                                            <img src="/assets/img/bank/ic_maritimeBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="MBBank">
                                            <input type="radio" id="MB" value="MB" v-model="bank">
                                            <img src="/assets/img/bank/ic_MBBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="OceanBank">
                                            <input type="radio" id="OJB" value="OJB" v-model="bank">
                                            <img src="/assets/img/bank/ic_oceanbank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Sacombank">
                                            <input type="radio" id="STB" value="STB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Sacombank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="VIB Bank">
                                            <input type="radio" id="VIB" value="VIB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_VIBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="VietcomBank">
                                            <input type="radio" id="VCB" value="VCB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Vietcombank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Vietinbank">
                                            <input type="radio" id="CTG" value="CTG" v-model="bank">
                                            <img src="/assets/img/bank/ic_Viettinban_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="VPBank">
                                            <input type="radio" id="VPB" value="VPB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_VPbank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Seabank">
                                            <input type="radio" id="SEAB" value="SEAB" v-model="bank">
                                            <img src="/assets/img/bank/ic_seabank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" @click="pay()" class="btn bg-netbee update-todo-item" data-dismiss="modal"><i class="feather icon-edit d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Thanh toán</span>
                                    </button>
                                </fieldset>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import JobsList1Col from '~/components/Jobs/JobsList1Col'
// import StarRating from 'vue-star-rating'
import {
  ValidationProvider,
  extend
} from "vee-validate/dist/vee-validate.full";
import { ValidationObserver } from "vee-validate/dist/vee-validate.full";



extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});
extend("email", {
  message: (field, values) => "Email không đúng định dạng"
});
var errorMessage =
  " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 số.";
// create custom rule
extend("customPassword", {
  message: field =>"Mật khẩu" + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s]/;
    var mustContainTheseChars = /^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
    var containsForbiddenChars = notTheseChars.test(value);
    var containsRequiredChars = mustContainTheseChars.test(value);
    if (containsRequiredChars && !containsForbiddenChars) {
      return true;
    } else {
      if (containsForbiddenChars) {
        errorMessage =
          ' không được chứa các ký tự: " ' + " ' ? & / < > hoặc khoảng trắng";
      } else {
        errorMessage =
          " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 số.";
      }
      return false;
    }
  }
});
export default {
    layout: 'no_banner',
    components: {
        JobsList1Col,
        ValidationProvider,
        ValidationObserver,
    },
    data() {
        return {
            arrayForCompany: [],
            countJob: '',
            userForm: {
                email: '',
                password: '',
                content: ''
            },
            styleLoadMore: {
                overflow: 'hidden',
                textOverflow: 'ellipsis',
                display: '-webkit-box', 
                lineHeight: '18px', 
                fontSize: '16px',
                maxHeight: '54px',
                webkitLineClamp: '3',
                webkitBoxOrient: 'vertical',
                paddingRight: '5px'
            },
            styleCollapse: {
                display: '-webkit-box', 
                lineHeight: '18px', 
                webkitBoxOrient: 'vertical',
                paddingRight: '5px',
                fontSize: '16px',
            },
            show: true,
            detailCompany: null,
            loadMoreBtn: true,
            formFeedback: {
                rating: 5,
                content: ''
            },
            isFollow: false,
            followers: 0,
            bank: '',
        }
    },
    async asyncData (context) {
      
        try {  
        let detailRes = await context.app.$axios.$get(`getDetailCompanyById/${context.app.router.currentRoute.params.congty}`)      
        context.seo({
                name: detailRes.data.name,
                title: detailRes.data.name,
                keywords: detailRes.data.name.replace(/ /g, ","),
                description: detailRes.data.nb_company.company_about,
                openGraph: {
                    title: detailRes.data.name,
                    url: `https://netbee.vn${context.app.router.currentRoute.path}`,
                    description: detailRes.data.nb_company.company_about,
                    image: `https://netbee.vn/uploads/users/avatars/${detailRes.data.avatar}`
				}
            })        
        return { congty: detailRes.data }
        }catch (er) {
            return {congty : []}
        }        
    },
    methods: {
        payWithMomo() {
            this.$axios.$post('/pricing_momo_verify',{url: this.$route.fullPath}).then((response)=>{
                if(response.status == 200) {
                    if(response.data != null) {
                        window.location.href = response.data;
                    }else {
                        this.$swal(
                            'Thành công!',
                            'Thanh toán thành công',
                            'success'
                        )
                    }
                }else {
                    this.$swal(
                        'Lỗi!',
                        response.message,
                        'error'
                    )
                }
            });
        },
        pay() {
            if(this.bank) {
                this.$axios.$post('/pricing_momo_bank',{code: this.discount,idJob: this.selectPay.id,bank: this.bank}).then((response)=>{
                    if(response.status == 200) {
                        if(response.data != null) {
                            window.location.href = response.data;
                        }else {
                            this.$swal(
                                'Thành công!',
                                'Thanh toán thành công',
                                'success'
                            )
                        }
                    }else {
                        this.$swal(
                            'Lỗi!',
                            response.message,
                            'error'
                        )
                    }
                });
            }else {
                this.$swal(
                    'Lỗi!',
                    'Bạn chưa chọn ngân hàng',
                    'error'
                )
            }

        },
        verifyModal() {
            if(this.$auth.loggedIn && this.$auth.user.id == this.detailCompany.id) {
                $('#verify').modal(); 
            }
        },
        saveJob() {
            this.$axios.$post(`tintuyendung/postSave`,{id_job: this.tintuc.id}).then((response)=>{
                if(response.status == 200) {
                    this.$swal(
                    'Thành công!',
                        response.message,
                    'success'
                    );
                    this.save = response.data
                }else {
                    this.$swal(
                    'Lỗi!',
                        response.message,
                    'error'
                    );
                    this.save = response.data
                }
            }).catch((e) => {
                this.$swal(
                'Cảnh báo!',
                'Bạn cần đăng nhập để thực hiện chức năng này',
                'warning'
                );
            });
        },
        async login() {
            const isValid = await this.$refs.observerLogin.validate();
            if(isValid){
            try {
                    let response = await this.$auth.loginWith('local',{ data: this.userForm });
                    window.location.reload();
            } catch (err) {
                this.$swal(
                        'Lỗi!',
                        'Tài khoản hoặc mật khẩu không đúng!',
                        'error'
                    )
                }
            }
        },
        showPassword(){
            this.show = !this.show;
        },
        loginfb() {
            this.$auth.loginWith('facebook')
        },
        logingg() {
            this.$auth.loginWith('google')
        },
        sendFeedback(){
            var form = new FormData();
            form.append('rate_feed',this.formFeedback.rating);
            form.append('company_id',this.detailCompany.id);
            form.append('content_feed',this.formFeedback.content);
            form.append('name_feed',this.$auth.user.name);
            form.append('email_feed',this.$auth.user.email);
            form.append('user_id',this.$auth.user.id);
            form.append('avatar_feed',this.$auth.user.avatar);
            this.$axios.post('postCompanyFeedback',form).then((response)=>{
                if(response.data.status == 200) {
                    this.$swal(
                        'Chờ xét duyệt!',
                        response.data.message,
                        'success'
                    ).then( function (){
                            window.location.reload();
                        } )
                }else{
                    this.$swal(
                        'Lỗi',
                        response.data.message,
                        'error'
                    )
                }
            })
        },
        followCompany(){
            this.isFollow = !this.isFollow;
            if(this.isFollow == true){
                this.followers = this.followers + 1;
            }
            else{
                this.followers  = this.followers - 1;
            }
                var form = new FormData();
                form.append('user_id',this.$auth.user.id);
                form.append('company_id',this.detailCompany.id);
                form.append('is_follow',this.isFollow);
                
                this.$axios.post('followCompany',form).then(response => {
                    if(response.data.status == 200){
                    }
                })
        },
        loadMore(){
            this.loadMoreBtn = false
        },
        collapse(){
            this.loadMoreBtn = true
        },
        setRating: function(rating){
            this.formFeedback.rating= rating;
        }
    },      
    mounted() {
        if(typeof this.$route.query.errorCode !== 'undefined' ) {
            if(this.$route.query.errorCode == 0) {
                this.$swal(
                    'Thành công!',
                    'Thanh toán thành công',
                    'success'
                )
            }else {
                this.$swal(
                    'Thất bại!',
                    'Thanh toán thất bại',
                    'error'
                ) 
            }
        }
        this.$axios.$get(`getTinTuyenDungForCompany/${this.$route.params.congty}?limit=5`).then((response)=>{
            this.arrayForCompany = response.data.tintuyendung
            this.countJob = response.data.count
        });
        this.$axios.$get(`getDetailCompanyById/${this.$route.params.congty}`).then((response)=>{
            this.detailCompany = response.data;
        });
        if(this.$auth.loggedIn){
            this.$axios.get('checkFollow?user_id=' + this.$auth.user.id + '&username='+ this.$route.params.congty).then(response => {
            if(response.data.status == 200){
                this.isFollow = true;
            }
        });
        }
        this.$axios.get('countFollow?username='+ this.$route.params.congty).then(response => {
            if(response.data.status == 200){
                this.followers = response.data.data;
            }
        });
    },
    jsonld() {
        return {
            "@context": "http://schema.org/",
            "@type":"EmployerAggregateRating",
            "itemReviewed":{
                "@type":"Organization",
                "name": this.congty.name,
                "sameAs": 'https://netbee.vn'+this.$route.path
                },
            "ratingValue": "4",
            "bestRating": "5",
            "worstRating": "3",
            "ratingCount": "5"
        };
    },
}
</script>
<style scoped>
.line-title {
    border-bottom: 2px solid #ffb701;
    padding-bottom: 5px;
}
.view-more a {
    color: #57595B !important;
    font-size: 15px;
    text-decoration: none;
    display: inline-block;
    border-bottom: 1px dotted;
}
.col-lg-2 button{
    width:100%; padding: 16px; font-size:16px;
}
.btn-hover-netbee:hover {
    background: #ffb701;
    -webkit-transform: scale(1.01);
    transform: scale(1.01);
    color: #fff;
}
.btn-hover-netbee {
    border: 1px solid #ffb701;
    color: #000;
}
.avatar-company {
    width: 170px;
}
.count-job {
    border: 1px solid;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
}
.btn-verify {
    color: #4267b2 !important;
    padding: 5px;
}
.btn-verify:hover {
    background: #4267b2 !important;
    color: #fff !important;
    padding: 5px;
    border-radius: 50%;
}
.style-loadmore {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    line-height: 18px;
    font-size: 15px;
    max-height: 90px;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    padding-right: 10px
}
.style-collapse {
    line-height: 18px;
    font-size: 16px;
    padding-right: 5px
}
.form-label-group textarea:not(:active):not(:placeholder-shown)~label {
    color: rgba(34, 41, 47, 0.4) !important;
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    opacity: 1;
}
.bk-auto{
    width: 100%;
    height: 326px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 100px;
  height: 100px;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  background: #ffb701;
}
.modal .modal-footer {
    border-color: #ffb701 !important;
}
.avt-company {
    position: absolute;
    top: -100px;
    background: #fff;
    border: 1px solid #c1c1c1;
    width: 150px;
    height: 150px;
}
.verify-img img{
    width: 100%;
}
@media screen and (max-width: 480px) {
    .avt-company {
        position: unset;
    }
    .verify-img {
        position: absolute;
        justify-content: flex-end;
        right: 10px;
        align-items: center;
    }
    .verify-img img {
        width: 100px;
    }
}
</style>