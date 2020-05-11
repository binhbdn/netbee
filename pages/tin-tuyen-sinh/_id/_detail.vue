<template>
    <div class="container">
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row p-1">
                        <div class="col-lg-2 d-flex align-items-center">
                            <div class="avatar-company">
                                <img v-lazy="`/uploads/users/avatars/${tintuc.user.avatar}`" :alt="`${tintuc.user.avatar}`" width="100%">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="company-job-title">
                                <h1 class="font-weight-bold">{{ tintuc.title }}</h1>
                                <a :href="`/cong-ty/${tintuc.id_created}/${ChangeToSlug(tintuc.user.name)}`"><h4 class="font-weight-bold text-uppercase"><i class="fad fa-building"></i> <span class="company-name"  data-toggle="tooltip" data-placement="right" :title="`${tintuc.user.name}`"> {{ tintuc.user.name }} <i data-toggle="tooltip" data-placement="top" title="Công ty đã xác thực" class="fad fa-check btn-verify"></i></span></h4></a>
                                <p><span class="font-weight-600">Loại tin: </span><span class="badge background-default badge-md">{{ tintuc.type == 3 ? 'Tu nghiệp sinh' : tintuc.type == 2 ? 'Du học sinh' : 'Xuất khẩu lao động' }}</span></p>
                                <p><span class="font-weight-600">Địa điểm tuyển dụng: </span>{{ tintuc.nation.name }}</p>
                                <p><span class="font-weight-600" v-if="tintuc.type != 2">Mức lương: </span> <span class="font-weight-600" v-if="tintuc.type == 2">Học phí: </span> {{ FormatPrice(tintuc.salary_start) }}{{ tintuc.currency }} ~ {{ FormatPrice(tintuc.salary_end) }}{{ tintuc.currency }}</p>
                                <p><span class="font-weight-600">Hạn nộp hồ sơ: </span>{{ ConvertDate(tintuc.expiration_date) }}</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row" style="border:#dee2e6 solid 1px;height: 100%">
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-right:#dee2e6 solid 1px;border-bottom:#dee2e6 solid 1px;" data-toggle="modal" :data-target="!$auth.loggedIn?'#loginModal':'#ApplyModal'">
                                    <a class="btn-netbee btn" data-toggle="tooltip" data-placement="top" title="Nộp hồ sơ"><i class="fad fa-paper-plane fa-2x p-10"></i></a>
                                </div>
                                <div v-if="$auth.loggedIn" class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-bottom:#dee2e6 solid 1px">
                                    <a class="btn btn-save" @click="saveJob()" data-toggle="tooltip" data-placement="top" :title="!save ? 'Lưu việc làm' : 'Bỏ việc làm'"><i :class="{'fad fa-heart fa-2x p-10' : !save, 'fad fa-heart-broken fa-2x p-10' : save}"></i></a>
                                </div>
                                <div v-if="!$auth.loggedIn" class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-bottom:#dee2e6 solid 1px" data-toggle="modal" data-target="#loginModal">
                                    <a class="btn btn-save" data-toggle="tooltip" data-placement="top" :title="!save ? 'Lưu việc làm' : 'Bỏ việc làm'"><i :class="{'fad fa-heart fa-2x p-10' : !save, 'fad fa-heart-broken fa-2x p-10' : save}"></i></a>
                                </div>
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-right:#dee2e6 solid 1px">
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://netbee.vn/tin-tuyen-sinh/99/xuat-khau-lao-dong&amp;src=sdkpreparse" class="btn btn-fb" data-toggle="tooltip" data-placement="top" title="Chia sẻ lên Facebook"><i class="fab fa-facebook fa-2x p-10"></i></a>
                                </div>
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#reportModal" >
                                    <a class="btn btn-report" data-toggle="tooltip" data-placement="top" title="Thông báo lỗi"><i class="fad fa-exclamation-triangle fa-2x p-10"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="row">
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row p-t-10">
                        <div class="col-12">
                            <div class="col-12 p-l-0 p-t-5">
                                <h5 class="font-weight-600 line-title"><i class="fad fa-bell-plus"></i> THÔNG TIN TUYỂN DỤNG NHANH</h5>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="px-1">
                                        <p><span class="font-weight-600">Địa điểm:</span> {{ tintuc.workplace }}</p>
                                        <p v-if="tintuc.type == 2"><span class="font-weight-600">Trường:</span> {{ tintuc.school_name }}</p>
                                        <p><span class="font-weight-600">Tuổi:</span> {{ tintuc.age_start }} {{ tintuc.age_end? ' - '+tintuc.age_end+' tuổi' : ' tuổi trở lên' }}</p>
                                        <p v-if="tintuc.type != 2"><span class="font-weight-600">Lương:</span> {{ FormatPrice(tintuc.salary_start) }}{{ tintuc.currency }} ~ {{ FormatPrice(tintuc.salary_end) }}{{ tintuc.currency }}</p>
                                        <p v-if="tintuc.type == 2"><span class="font-weight-600">Học phí:</span> {{ FormatPrice(tintuc.salary_start) }}{{ tintuc.currency }} ~ {{ FormatPrice(tintuc.salary_end) }}{{ tintuc.currency }}</p>
                                        <p v-if="tintuc.type != 2"><span class="font-weight-600">Hình thức làm việc:</span> {{ tintuc.form_work == 1 ? 'Toàn thời gian' : tintuc.form_work == 2? 'Bán thời gian' : 'Vừa học vừa làm' }}</p>
                                        <p v-if="tintuc.time_bonus"><span class="font-weight-600">Bonus:</span> {{ tintuc.time_bonus == 1 ? tintuc.bonus : tintuc.time_bonus == 2 ? tintuc.bonus * 1.5 : tintuc.bonus * 3 }}{{ tintuc.currency }}</p>
                                        <p><span class="font-weight-600">Chi phí xuất cảnh:</span> {{ tintuc.subsidy }}{{ tintuc.currency }}</p>
                                        <p><span class="font-weight-600">Ngày bắt đầu nhận hồ sơ:</span> {{ ConvertDate(tintuc.date_start) }}</p>
                                        <p><span class="font-weight-600">Ngày dự kiến nhập cảnh:</span> {{ ConvertDate(tintuc.expected_date) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12 p-l-0">
                                <h5 class="font-weight-600 line-title"><i class="fad fa-bell-plus"></i> MÔ TẢ CÔNG VIỆC</h5>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="px-1" v-html="tintuc.description" style="white-space: pre-line;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12 p-l-0">
                                <h5 class="font-weight-600 line-title"><i class="fad fa-bell-plus"></i> YÊU CẦU</h5>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="px-1" v-html="tintuc.request" style="white-space: pre-line;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12 p-l-0">
                                <h5 class="font-weight-600 line-title"><i class="fad fa-bell-plus"></i> QUYỀN LỢI</h5>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="px-1" v-html="tintuc.benefit" style="white-space: pre-line;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12 p-l-0">
                                <h5 class="font-weight-600 line-title"><i class="fad fa-bell-plus"></i> HỒ SƠ CẦN CHUẨN BỊ</h5>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="px-1" v-html="tintuc.cv_content" style="white-space: pre-line;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pb-2">
                            <div class="col-12 p-l-0">
                                <h5 class="font-weight-600 line-title"><i class="fad fa-bell-plus"></i> CÁCH THỨC ỨNG TUYỂN</h5>
                                
                            </div>
                            <div class="row">
                                
                                <div class="col-lg-12">
                                    Ứng viên nộp hồ sơ trực tiếp tại văn phòng công ty hoặc nộp trực tuyến bằng cách bấm vào nút <b>Nộp hồ sơ</b>.<br>
                                    <div class="text-center">
                                        <div>
                                            <button class="btn  btn-warning w-75" style="width: 214px !important; color: #000; border-color: #ffb701 !important; background-color: #ffb701 !important;"><i class="fad fa-paper-plane"></i> Nộp hồ sơ</button>
                                        </div>
                                        <i>Hạn nộp hồ sơ: {{ConvertDate(tintuc.expiration_date)}}</i><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">
                    <i class="fad fa-business-time"></i> VIỆC LÀM CÙNG CÔNG TY
                </h4>
                </div>
                <div class="card-content collapse show">
                <div class="card-body">
                    <JobsList1ColNotCate :DataList="arrayForCompany"></JobsList1ColNotCate>
                </div>
                </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">
                    <i class="fad fa-business-time"></i> VIỆC LÀM TƯƠNG TỰ
                </h4>
                </div>
                <div class="card-content collapse show">
                <div class="card-body">
                    <JobsList1Col :DataList="tintuc.type == 1 ? arrayJobXKLD : tintuc.type == 2 ? arrayJobDHS : arrayJobTNS"></JobsList1Col>
                </div>
                </div>
            </div>
          </div>
        </div>
      </section>
        <!-- Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editTodoTask" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                <div class="modal-content">
                    <section class="todo-form">
                        <form id="form-edit-todo" class="todo-input">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTodoTask">Thông báo lỗi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"> 
                                <fieldset class="form-group">
                                    <textarea class="edit-todo-item-desc form-control" v-model="report" rows="3" placeholder="Nội dung..."></textarea>
                                </fieldset>
                            </div>
                            <div class="modal-footer">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" @click="reportJob()" class="btn bg-netbee update-todo-item" data-dismiss="modal"><i class="feather icon-edit d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Gửi</span></button>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="feather icon-x d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Cancel</span></button>
                                </fieldset>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <!-- Modal Login-->
        <!-- Modal -->
        <div class="modal fade text-left" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="col-md-12 col-lg-12 formlogin form-control" >
                    <h2 class="text-center mt-1" style="margin-bottom:15px">ĐĂNG NHẬP ỨNG VIÊN</h2>
                    <p class="text-center" style="margin-bottom:20px; font-size: 16px; "><a class="hover" href="dang-ky">Đăng ký tài khoản mới!</a>
                    </p>
                    <div class="form-group-1 input-login" v-on:keyup.enter="login" style="position:relative; padding-bottom:20px">
                        <ValidationObserver ref="observer" v-slot="{ valid }">
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
                                        <i class="feather icon-lock" style="color: rgba(34, 41, 47, 0.4)!important"></i>
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
                                <img src="../../../static/assets/img/logo-google.png" style="height:15px;position: absolute; left: 106px; top: 11px; color: blue; font-size: 18px;">
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
                <!-- modal apply -->

        <div class="modal fade text-left" id="ApplyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nộp hồ sơ ứng tuyển</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" style="float:left;">
                            <li class="nav-item">
                            <a class="nav-link active" id="v-pills-1-tab" data-toggle="tab" href="#v-pills-1"
                                role="tab" aria-controls="v-pills-1" aria-selected="true">Hồ sơ đính kèm</a>
                            </li>
                            <!-- <li class="nav-item">
                            <a class="nav-link" id="v-pills-2-tab" data-toggle="tab" href="#v-pills-2"
                                role="tab" aria-controls="v-pills-2" aria-selected="false">Danh sách hồ sơ</a>
                            </li> -->
                        </ul>
                        <div class="tab-content pt-1 tab-ct2 pl-2 pr-2" style="clear:both;">
                            <div class="tab-pane active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-11-tab">
                                <ValidationObserver ref="applyJob" v-slot="{ valid }">
                                    <div class="row">
                                        <div class="col-12">
                                            <ValidationProvider
                                            rules="required"
                                            v-slot="{ errors }">
                                                <div class="form-group">
                                                    <div class="form-field">
                                                        <div class="file-input"> 
                                                            <label for="file" v-if="file_cv.length == 0"><i class="fas fa-file-upload" style="color: #000000c7;"></i> Chọn file</label>
                                                            <label for="file" v-else><i class="fas fa-file-upload" style="color: #000000c7;"></i> {{file_cv[0].name}}</label>
                                                            <input type="file" id="file" @change="onInputChange" > 
                                                        </div>
                                                        <p class="text-center" style="font-size: 12px">Định dạng file: *.doc, *.docx, *.xls, *.xlsx, *.pdf, *.txt, *.rtf</p>
                                                        <span style="color: red">{{errors[0]}}</span>
                                                    </div>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        
                                        <div class="col-12">
                                            <ValidationProvider
                                            rules="required"
                                            v-slot="{ errors }">
                                                <div class="form-group">
                                                    <div class="form-field">
                                                        <label for="name">Họ tên</label>
                                                        <input type="text" id="name" class="form-control" v-model="name">
                                                        <span style="color: red">{{errors[0]}}</span>
                                                    </div>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-12">
                                            <ValidationProvider
                                            rules="required"
                                            v-slot="{ errors }">
                                                <div class="form-group">
                                                    <div class="form-field">
                                                        <label for="name">Số điện thoại</label>
                                                        <input type="text" id="name" class="form-control" v-model="phone">
                                                        <span style="color: red">{{errors[0]}}</span>
                                                    </div>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <!-- <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-field">
                                                    <label for="name">Ngành nghề dự định</label>
                                                    <multiselect v-model="value" :options="visa" :multiple="true" :custom-label="nameWithLang"
                                                        placeholder="Chọn ngành nghề" ></multiselect>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-field">
                                                    <label for="name">Quốc gia</label>
                                                    <Multiselect :options="nation" v-model="chooseNation" placeholder="Chọn quốc gia" :multiple="true"
                                                    :searchable="false" :custom-label="nameWithLang1"></Multiselect>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </ValidationObserver>
                            </div>
                            <div class="tab-pane" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-22-tab">
                                b
                            </div>
                        </div>
                        <div class="text-right mt-1">
                            <button type="button" class="btn btn-warning" @click="resetData">reset</button>
                            <button type="button" class="btn btn-warning" @click="applyJob">Ứng tuyển</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end modal apply -->

        <div id="fb-root"></div>
    </div>
</template>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=1459241224260897&autoLogAppEvents=1"></script>
<script>
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate'
import JobsList1Col from '~/components/Jobs/JobsList1Col'
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
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
    components: {
        JobsList1ColNotCate,
        JobsList1Col,
        ValidationProvider,
        ValidationObserver,
        Multiselect
    },
    data() {
        return {
            tintuc: [],
            arrayForCompany: [],
            save: false,
            report: '',
            userForm: {
                email: '',
                password: ''
            },
            file_cv: [],
            show: true,
            value: [],
            chooseNation: [],
            name: null,
            phone: null,
        }
    },
    async asyncData({$axios, route}) {
        let detailRes = await $axios.$get(`getDetailTinTuyenDung/${route.params.id}`)
        let getTinTuyenDungHot = await $axios.$get(`getTinTuyenDungHot?limit=10`)
        let getTinTuyenDungXKLD = await $axios.$get(`getTinTuyenDungNew?limit=5&type=1`)
        let getTinTuyenDungDHS = await $axios.$get(`getTinTuyenDungNew?limit=5&type=2`)
        let getTinTuyenDungTNS = await $axios.$get(`getTinTuyenDungNew?limit=5&type=3`)
        return {
            tintuc: detailRes.data,
            arrayJobHot: getTinTuyenDungHot.data.tintuyendung,
            arrayJobXKLD: getTinTuyenDungXKLD.data.tintuyendung,
            arrayJobDHS: getTinTuyenDungDHS.data.tintuyendung,
            arrayJobTNS: getTinTuyenDungTNS.data.tintuyendung,
            // visa: getvisa.data,
            // nation: getNation.data
        }
    },
    head() {
        return {
            title: this.tintuc.title,
            meta: [
                { hid: 'description', name: 'description', content: this.tintuc.title },
                { hid: 'keywords', name: 'keywords', content: this.tintuc.title},
                { hid: 'og:url', name: 'og:url', content: 'https://netbee.vn'+this.$route.path},
                { hid: 'og:title', name: 'og:title', content: this.tintuc.title},
                { hid: 'og:description', name: 'og:description', content: this.tintuc.title},
                { hid: 'og:image', name: 'og:image', content: this.tintuc.user.avatar},
            ]
        }
    },
    methods: {
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
            const isValid = await this.$refs.observer.validate();
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
        reportJob() {
            this.$axios.$post(`tintuyendung/report`,{id_job: this.tintuc.id,report: this.report}).then((response)=>{
                if(response.status == 200) {
                    this.$swal(
                    'Thành công!',
                        response.message,
                    'success'
                    );
                }else {
                    this.$swal(
                    'Lỗi!',
                        response.message,
                    'error'
                    );
                }
            }).catch((e) => {
                this.$swal(
                'Cảnh báo!',
                'Bạn cần đăng nhập để thực hiện chức năng này',
                'warning'
                );
            });
        },
        onInputChange(e){
            if(this.file_cv != null && this.file_cv.length > 0){
                this.file_cv = []
            }
            e.preventDefault();
            e.stopPropagation();
            const file = e.target.files[0]
            this.addfile(file)
        },
        addfile(file){
            console.log(file.type)
            // if( file.type == 'application/pdf' ){
            //     this.$swal(
            //             'Lỗi',
            //             'File không đúng định dạng',
            //             'error'
            //         )
            //     return;
            // }
            this.file_cv.push(file)
        },
        nameWithLang ({ profession, id }) {
            return `${profession}`
        },
        nameWithLang1 ({ name, id }) {
            return `${name}`
        },
        resetData(){
            this.file_cv = []
            this.name = ''
            this.phone = ''
            this.value = []
            this.chooseNation = []
        },
        async applyJob(){
            console.log(this.$route.params.id)
            var data = new FormData()
            data.append('file_cv', this.file_cv[0])
            data.append('name', this.name)
            data.append('phone', this.phone)
            data.append('job_id', this.$route.params.id)
            const isValid = await this.$refs.applyJob.validate();
            if(isValid) {
                this.$axios.post('userApplyJob',data).then(response => {
                    if(response.data.status == 200) {
                        this.$swal(
                            'Thành công',
                            response.data.message,
                            'success'
                        ).then( function (){
                                location.reload()
                            } )
                    }else{
                        this.$swal(
                            'Lỗi',
                            response.data.message,
                            'error'
                        )
                    }
                })
            }
  
        }
    },
    mounted() {
        this.$axios.$get(`getTinTuyenDungForCompany/${this.tintuc.id_created}?limit=5`).then((response)=>{
            this.arrayForCompany = response.data.tintuyendung
        });
        this.$axios.$get(`getDetailTinTuyenDung/${this.$route.params.id}`).then((response)=>{
            this.tintuc = response.data
        });
        if(this.$auth.loggedIn) {
            this.$axios.$post(`tintuyendung/postView`,{id_job: this.tintuc.id}).then((response)=>{});
            this.$axios.$get(`tintuyendung/getSave`,{id_job: this.tintuc.id}).then((response)=>{
                this.save = response.data
            });
        }
    }
}
</script>
<style scoped>
.line-title {
    border-bottom: 2px solid #ffb701;
    padding-bottom: 5px;
}
.avatar-company {
    width: 170px;
}
.btn-netbee {
    color: #ffb701 !important;
}
.btn-save {
    color: #55ce63 !important;
}
.btn-fb {
    color: #4267b2 !important;
}
.btn-report {
    color: #f62d51 !important;
}
.btn-netbee:hover {
    background: #ffb701 !important;
    color: #fff !important;
}
.btn-save:hover {
    background: #55ce63 !important;
    color: #fff !important;
}
.btn-fb:hover {
    background: #4267b2 !important;
    color: #fff !important;
}
.btn-report:hover {
    background: #f62d51 !important;
    color: #fff !important;
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
.title {
    font-weight: bold;
    color: #4e4d4d;
}

.modal-header{
    background-color: #ffb701;
    color: #000;
}

.modal-title{
    font-weight: 600;
}

.file-input label,
.file-input input{
    width: 100%;
    position: absolute;
    left: 11px;
    top: 7%;

    border-radius: 4px;
    margin-top: 7px;
    cursor: pointer;
}

.file-input input{
    opacity: 0;
    z-index: -2;
}

.file-input{
    width: auto;
    margin: auto;
    height: 35px;
    position: relative;
    background: #ffb701;
    text-align: center;
    border-radius: 10px;
}


</style>