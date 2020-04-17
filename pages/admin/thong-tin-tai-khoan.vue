<template>
  <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
          <div class="content-header row">
              <div class="content-header-left col-md-9 col-12 mb-2">
                  <div class="row breadcrumbs-top">
                      <div class="col-12">
                          <h2 class="content-header-title float-left mb-0">Cài đặt tài khoản</h2>
                          <div class="breadcrumb-wrapper col-12">
                              <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="/">Trang chủ</a>
                                  </li>
                                  <li class="breadcrumb-item active"> Cài đặt tài khoản
                                  </li>
                              </ol>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="content-body">
              <!-- account setting page start -->
              <section id="page-account-settings">
                  <div class="row">
                      <!-- left menu section -->
                      <div class="col-md-3 mb-2 mb-md-0">
                          <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                              <li class="nav-item">
                                  <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                      <i class="feather icon-globe mr-50 font-medium-3"></i>
                                      Thông tin chung
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                      <i class="feather icon-lock mr-50 font-medium-3"></i>
                                      Thay đổi mật khẩu
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                      <i class="feather icon-info mr-50 font-medium-3"></i>
                                      Thông tin thêm
                                  </a>
                              </li>
                          </ul>
                      </div>
                      <!-- right content section -->
                      <div class="col-md-9">
                          <div class="card">
                              <div class="card-content">
                                  <div class="card-body p-t-15 p-b-15">
                                      <div class="tab-content">
                                          <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                              <div class="media">
                                                  <a href="javascript: void(0);">
                                                      <img src="/app-assets/images/portrait/small/avatar-s-12.jpg" class="rounded mr-75" alt="profile image" height="64" width="64">
                                                  </a>
                                                  <div class="media-body mt-75">
                                                      <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                          <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Cập nhật ảnh đại diện</label>
                                                          <input type="file" id="account-upload" hidden>
                                                          <button class="btn btn-sm btn-outline-warning ml-50">Reset</button>
                                                      </div>
                                                      <p class="text-muted ml-75 mt-50"><small>Cho phép JPG, GIF or PNG. Kích thước tối đa
                                                              800kB</small></p>
                                                  </div>
                                              </div>
                                              <hr>
                                              <form novalidate>
                                                  <div class="row">
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <div class="controls">
                                                                  <label for="account-username">Username</label>
                                                                  <input type="text" class="form-control" id="account-username" placeholder="Username" value="hermione007" required data-validation-required-message="This username field is required">
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <div class="controls">
                                                                  <label for="account-name">Name</label>
                                                                  <input type="text" class="form-control" id="account-name" placeholder="Name" value="Hermione Granger" required data-validation-required-message="This name field is required">
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <div class="controls">
                                                                  <label for="account-e-mail">E-mail</label>
                                                                  <input type="email" class="form-control" id="account-e-mail" placeholder="Email" value="granger007@hogward.com" required data-validation-required-message="This email field is required">
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                  <span aria-hidden="true">×</span>
                                                              </button>
                                                              <p class="mb-0">
                                                                  Your email is not confirmed. Please check your inbox.
                                                              </p>
                                                              <a href="javascript: void(0);">Resend confirmation</a>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <label for="account-company">Company</label>
                                                              <input type="text" class="form-control" id="account-company" placeholder="Company name">
                                                          </div>
                                                      </div>
                                                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                          <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                              changes</button>
                                                          <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                          <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                              <form method="POST">
                                                  <ValidationObserver ref="observer" v-slot="{ valid }">
                                                  <div class="row">
                                                      <div class="col-12">
                                                          <ValidationProvider
                                                                name="oldPassword"
                                                                ref="oldPassword"
                                                                rules="required"
                                                                v-slot="{ errors }"
                                                            >
                                                          <div class="form-group">
                                                              <div class="controls">
                                                                  <label for="account-old-password">Mật khẩu cũ</label>
                                                                  <input type="password" class="form-control" id="oldPassword" name="oldPassword" v-model="changePasswordForm.oldPassword" placeholder="Nhập vào mật khẩu cũ">
                                                                  <ul style="color:red" class="overline text-left">
                                                                    <li v-for="(error, index) in errors" :key="index">
                                                                    <span>{{ error }}</span>
                                                                    </li>
                                                                </ul>
                                                              </div>
                                                          </div>
                                                          </ValidationProvider>
                                                      </div>
                                                      <div class="col-12">
                                                          <ValidationProvider
                                                                name="newPassword"
                                                                ref="newPassword"
                                                                rules="required|customPassword|min:8"
                                                                v-slot="{ errors }"
                                                            >
                                                          <div class="form-group">
                                                              <div class="controls">
                                                                  <label for="account-new-password">Mật khẩu mới</label>
                                                                  <input type="password" class="form-control" id="account-new-password" name="newPassword" v-model="changePasswordForm.newPassword" placeholder="Nhập vào mật khẩu mới" >
                                                                  <ul style="color:red" class="overline text-left">
                                                                    <li v-for="(error, index) in errors" :key="index">
                                                                    <span>{{ error }}</span>
                                                                    </li>
                                                                </ul>
                                                              </div>
                                                          </div>
                                                          </ValidationProvider>
                                                      </div>
                                                      <div class="col-12">
                                                        <ValidationProvider
                                                            name="retypePassword"
                                                            ref="retypePassword"
                                                            rules="required|retypePassword:@newPassword"
                                                            v-slot="{ errors }"
                                                        >
                                                          <div class="form-group">
                                                              <div class="controls">
                                                                  <label for="account-retype-new-password">Nhập lại mật khẩu</label>
                                                                  <input type="password" class="form-control" name="retypePassword"  id="account-retype-new-password" v-model="changePasswordForm.retypePassword" placeholder="Nhập lại mật khẩu mới">
                                                                  <ul style="color:red" class="overline text-left">
                                                                    <li v-for="(error, index) in errors" :key="index">
                                                                    <span>{{ error }}</span>
                                                                    </li>
                                                                </ul>
                                                              </div>
                                                          </div>
                                                          </ValidationProvider>
                                                      </div>
                                                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                          <button type="submit" v-on:click="changePassword()" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Lưu thay đổi</button>
                                                          <button type="reset" class="btn btn-outline-warning">Hủy</button>
                                                      </div>
                                                  </div>
                                                   </ValidationObserver>
                                              </form>
                                          </div>
                                          <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                              <form novalidate>
                                                  <div class="row">
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <label for="accountTextarea">Bio</label>
                                                              <textarea class="form-control" id="accountTextarea" rows="3" placeholder="Your Bio data here..."></textarea>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <div class="controls">
                                                                  <label for="account-birth-date">Ngày sinh</label>
                                                                  <input type="text" class="form-control birthdate-picker" required placeholder="Ngày sinh" id="account-birth-date" data-validation-required-message="This birthdate field is required">
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <label for="accountSelect">Quốc gia</label>
                                                              <select class="form-control" id="accountSelect">
                                                                  <option>USA</option>
                                                                  <option>India</option>
                                                                  <option>Canada</option>
                                                              </select>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <div class="controls">
                                                                  <label for="account-phone">Số điện thoại</label>
                                                                  <input type="text" class="form-control" id="account-phone" required placeholder="Phone number" value="(+656) 254 2568" data-validation-required-message="This phone number field is required">
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="form-group">
                                                              <label for="account-website">Website</label>
                                                              <input type="text" class="form-control" id="account-website" placeholder="Website address">
                                                          </div>
                                                      </div>
                                                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                          <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Lưu thay đổi</button>
                                                          <button type="reset" class="btn btn-outline-warning">Hủy</button>
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
              </section>
          </div>
      </div>
  </div>
</template>

<script>
import {
  ValidationProvider,
  extend
} from "vee-validate/dist/vee-validate.full";
import { ValidationObserver } from "vee-validate/dist/vee-validate.full";
extend('retypePassword', {
  params: ['target'],
  validate(value,{target}) {
    return value === target;
  },
  message: 'Mật khẩu nhập vào không khớp'
})
extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});
var errorMessage =
  " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 ký tự in hoa, 1 số và 1 ký tự đặc biệt(#!@$%^*-)";
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
    name: 'Account',
    layout: 'admin',
    components: {
        ValidationProvider,
        ValidationObserver
    },
    head: {
        title: 'Home page 🚀',
        script: [
        { src: '/app-assets/js/scripts/pages/account-setting.js' },
        ]     
        },
    data() {
            return {
            changePasswordForm: {
                oldPassword: "",
                newPassword: "",
                retypePassword: ""
            }
            };
        },
    methods: {
        async changePassword() {
            const isValid = await this.$refs.observer.validate();
            if(isValid){
                try {
                let response = await this.$axios.post('changePassword', {
                    password_old: this.changePasswordForm.oldPassword,
                    password_new: this.changePasswordForm.newPassword,
                    password_new_confirm: this.changePasswordForm.retypePassword,
                });
                if(response.data.status == 200){
                    this.$swal({
                    titile: 'Thành công',
                    text: response.data.message,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    }).then( async (result) => {
                    if (result.value) {
                        this.$auth.logout();
                        window.location.href = "/dang-nhap"

                        }
                    })
                }
                else{
                    this.$swal(
                    'Lỗi!',
                    response.data.message,
                    'error'
                    )
                }
                } catch (error) {
                'Lỗi',
                'Đăng nhập thất bại',
                'Error'
                }
            }
    }
  }
}
</script>
<style scoped>
    ul{
        list-style: none;
        padding-left: 5px;
        padding-top: 5px;
    }
    ul li span{
        font-style: italic;
    }
</style>>

