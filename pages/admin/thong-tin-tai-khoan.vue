<template>
  <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
          <div class="content-body">
              <!-- account setting page start -->
              <section id="page-account-settings">
                  <div class="row">
                      <!-- right content section -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-t-15 p-b-15">
                                        <div class="tab-content">
                                            <div class="card-header card-profile">
                                                <p class="card-header-title is-uppercase">Thông tin chung</p>
                                                <div class="field is-horizontal">
                                                    <div class="field-body">
                                                        <div class="field">
                                                        <div class="control"><button type="button" class="btn bg-netbee mr-sm-1 mb-1 mb-sm-0" @click="actionInfoUser()">Cập nhật</button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                                <form method="post">
                                                    <ValidationObserver ref="InfoUser" v-slot="{ valid }">
                                                        <div class="row">
                                                            <div class="col-3 text-right for-label">
                                                                <label for="account-username">Ảnh đại diện</label>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="media">
                                                                    <a href="javascript: void(0);">
                                                                        <img v-lazy="images[0]" class="rounded mr-75" alt="profile image" height="64" width="64" style="object-fit: cover;" v-if="images.length > 0">
                                                                        <img v-lazy="changeInfoUser.avatar != null && changeInfoUser.avatar.startsWith('https') ? changeInfoUser.avatar : `/uploads/users/avatars/${changeInfoUser.avatar}`" class="rounded mr-75" alt="profile image" height="64" width="64" style="object-fit: cover;" v-else>
                                                                    </a>
                                                                    <div class="media-body mt-75">
                                                                        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                            <label class="btn btn-sm bg-netbee ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload" >Đổi ảnh đại diện</label>
                                                                            <input type="file" id="account-upload" @change="onInputChange" hidden>
                                                                            <button type="button" class="btn btn-sm btn-outline-warning ml-50" @click="resetImg">Reset</button>
                                                                        </div>
                                                                        <p class="text-muted ml-75 mt-50"><small>Cho phép JPG, GIF or PNG.</small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <ValidationProvider rules="required" ref="name" name="name" v-slot="{ errors }">
                                                                    <div class="form-group">
                                                                        <div class="controls row">
                                                                            <div class="col-3 text-right for-label">
                                                                                <label v-if="$auth.user.role != 2" for="account-username">Họ tên</label>
                                                                                <label v-if="$auth.user.role == 2" for="account-username">Tên công ty</label>
                                                                            </div>
                                                                            <div class="col-9">
                                                                                <input type="text" class="form-control" name="name" v-model="changeInfoUser.name">
                                                                                <ul style="color:red" class="overline text-left">
                                                                                    <li v-for="(error, index) in errors" :key="index">
                                                                                    <span>{{ error }}</span>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </ValidationProvider>
                                                            </div>
                                                            <div class="col-12">
                                                                <ValidationProvider rules="required" v-slot="{ errors }">
                                                                    <div class="form-group">
                                                                        <div class="controls row">
                                                                            <div class="col-3 text-right for-label">
                                                                                <label v-if="$auth.user.role != 2" for="account-name">Ngày sinh</label>
                                                                                <label v-if="$auth.user.role == 2" for="account-name">Ngày thành lập</label>
                                                                            </div>
                                                                            <div class="col-9">
                                                                            <input type="date" class="form-control" v-model="changeInfoUser.birth">
                                                                            <ul style="color:red" class="overline text-left">
                                                                                <li v-for="(error, index) in errors" :key="index">
                                                                                <span>{{ error }}</span>
                                                                                </li>
                                                                            </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </ValidationProvider>
                                                            </div>
                                                            <div class="col-12">
                                                                <ValidationProvider rules="required" v-slot="{ errors }">
                                                                    <div class="form-group">
                                                                        <div class="controls row" >
                                                                            <div class="col-3 for-label text-right">
                                                                                <label for="account-e-mail">Số điện thoại</label>
                                                                            </div>
                                                                            <div class="col-9">
                                                                                <input type="number" class="form-control" v-model="changeInfoUser.phone">
                                                                                <ul style="color:red" class="overline text-left">
                                                                                    <li v-for="(error, index) in errors" :key="index">
                                                                                    <span>{{ error }}</span>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </ValidationProvider>
                                                            </div>
                                                            <div class="col-12">
                                                                <ValidationProvider rules="required" v-slot="{ errors }">
                                                                    <div class="form-group row">
                                                                            <div class="col-3 for-label text-right">
                                                                                <label for="account-company">Địa chỉ</label>
                                                                            </div>
                                                                            <div class="col-9">
                                                                                <input type="text" class="form-control" v-model="changeInfoUser.address">
                                                                                <ul style="color:red" class="overline text-left">
                                                                                        <li v-for="(error, index) in errors" :key="index">
                                                                                        <span>{{ error }}</span>
                                                                                        </li>
                                                                                    </ul>
                                                                            </div>
                                                                    </div>
                                                                </ValidationProvider>
                                                            </div>
                                                        </div>
                                                    </ValidationObserver>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-t-15 p-b-15">
                                        <div class="tab-content">                                          
                                            <div v-if="$auth.user.role == 2">
                                                <div class="card-header card-profile">
                                                    <p class="card-header-title is-uppercase">Thông tin công ty</p>
                                                    <div class="field is-horizontal">
                                                        <div class="field-body">
                                                            <div class="field">
                                                            <div class="control"><button type="button" class="btn bg-netbee mr-sm-1 mb-1 mb-sm-0" @click="changeInfoCompany()">Cập nhật</button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade active show" :class="{'active': classInfoMore, 'show': classInfoMore} " id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                    <form method="POST" v-on:keyup.enter = "changeInfoCompany">
                                                        <ValidationObserver ref="observerChangeInfoCompany" v-slot="{ valid }">
                                                                <div class="row">
                                                                    <div class="col-3 text-right for-label">
                                                                        <label>Ảnh bìa công ty</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <div class="media pl-1">
                                                                        <a href="javascript: void(0);">
                                                                            <img v-lazy="imagesCover[0]" class="rounded mr-75" alt="profile image" height="64" width="64" style="object-fit: cover;" v-if="imagesCover.length > 0">
                                                                            <img v-lazy="changeInfoCompanyForm.imageCover != null && changeInfoCompanyForm.imageCover.startsWith('https') ? changeInfoCompanyForm.imageCover : `/uploads/users/covers/${changeInfoCompanyForm.imageCover}`" class="rounded mr-75" alt="cover image" height="64" width="64" style="object-fit: cover;" v-else>
                                                                        </a>
                                                                        <div class="media-body mt-75">
                                                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                                <label class="btn btn-sm bg-netbee ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload-cover" >Đổi ảnh bìa</label>
                                                                                <input type="file" id="account-upload-cover" name="imageCoverInput" @change="onInputChangeCover" hidden>
                                                                                <button type="button" class="btn btn-sm btn-outline-warning ml-50" @click="resetImgCover">Reset</button>
                                                                            </div>
                                                                            <p class="text-muted ml-75 mt-50"><small>Cho phép JPG, GIF or PNG. Kích thước đề xuất: 1120 x 296</small></p>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            <div class="col-12">
                                                                <ValidationProvider
                                                                    name="username"
                                                                    ref="username"
                                                                    rules="required|customUsername"
                                                                    v-slot="{ errors }"
                                                                > 
                                                                <div class="form-group row">
                                                                    <div class="col-3 text-right for-label">
                                                                        <label for="accountTextarea1">Username</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <div class="form-control d-flex p-0" style="border-radius: 0">
                                                                            <input style="border:none; color: #5F5F5F; padding-left: 7px!important;" type="text" class="col-11 input-username" id="accountTextarea1" @keyup="checkUsernameCompany(changeInfoCompanyForm.username)" name="username" v-model="changeInfoCompanyForm.username" placeholder="Biệt danh hoặc tên viết tắt duy nhất của công ty.">
                                                                            <div class="col-1 text-center">
                                                                                <i style="font-size:16px; padding-top: 10px" :class="checkUsername ? 'fas fa-check-circle success' : 'fas fa-times-circle danger'"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3"></div>
                                                                    <div class="col-9">
                                                                        <ul style="color:red" class="overline text-left">
                                                                                <li v-for="(error, index) in errors" :key="index">
                                                                                <span>{{ error }}</span>
                                                                                </li>
                                                                    </ul>
                                                                        <a>Đường dẫn sẽ xuất hiện với: https://netbee.vn/cong-ty/{{changeInfoCompanyForm.username}}</a>
                                                                    </div>
                                                                </div>
                                                            </ValidationProvider>
                                                            </div>
                                                            <div class="col-12">
                                                                <ValidationProvider
                                                                    name="companyAbout"
                                                                    ref="companyAbout"
                                                                    rules="required"
                                                                    v-slot="{ errors }"
                                                                > 
                                                                <div class="form-group row">
                                                                    <div class="col-3 text-right for-label">
                                                                        <label for="accountTextarea1">Giới thiệu</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <textarea class="form-control" id="accountTextarea1" rows="4" name="companyAbout" v-model="changeInfoCompanyForm.companyAbout" placeholder="Thông tin cơ bản của công ty..."></textarea>
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
                                                                    name="companyAbout"
                                                                    ref="companyAbout"
                                                                    rules="required|integer"
                                                                    v-slot="{ errors }"
                                                                > 
                                                                <div class="form-group">
                                                                    <div class="controls row">
                                                                        <div class="col-3 text-right for-label">
                                                                        <label for="account-phone">Đường dây nóng</label>
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <input type="text" class="form-control" id="company-hotline" name="companyHotline" v-model="changeInfoCompanyForm.companyHotline"  required placeholder="Hotline">
                                                                                <ul style="color:red" class="overline text-left">
                                                                                    <li v-for="(error, index) in errors" :key="index">
                                                                                    <span>{{ error }}</span>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                </ValidationProvider>
                                                            </div>
                                                            <div class="col-12">
                                                                <ValidationProvider
                                                                    name="companyTax"
                                                                    ref="companyTax"
                                                                    rules="required|integer"
                                                                    v-slot="{ errors }"
                                                                > 
                                                                <div class="form-group">
                                                                    <div class="controls row">
                                                                        <div class="col-3 text-right for-label">
                                                                            <label for="account-phone">Mã số thuế</label>
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <input type="text" class="form-control" id="account-phone" name="companyTax" v-model="changeInfoCompanyForm.companyTax" required placeholder="Tax">
                                                                            <ul style="color:red" class="overline text-left">
                                                                                <li v-for="(error, index) in errors" :key="index">
                                                                                <span>{{ error }}</span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </ValidationProvider>
                                                            </div>
                                                            <div class="col-12">
                                                                <ValidationProvider
                                                                    name="companyBenefit"
                                                                    ref="companyBenefit"
                                                                    rules="required"
                                                                    v-slot="{ errors }"
                                                                > 
                                                                <div class="form-group row">
                                                                    <div class="col-3 text-right for-label">
                                                                    <label for="accountTextarea2">Lợi ích</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                    <textarea class="form-control" id="accountTextarea2" rows="3" name="companyBenefit" v-model="changeInfoCompanyForm.companyBenefit" placeholder="Lợi ích khi ứng viên ứng tuyển vào công ty."></textarea>
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
                                                                    name="companyPolicy"
                                                                    ref="companyPolicy"
                                                                    rules="required"
                                                                    v-slot="{ errors }"
                                                                > 
                                                                <div class="form-group row">
                                                                    <div class="col-3 text-right for-label">
                                                                    <label for="accountTextarea3">Chính sách</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                    <textarea class="form-control" id="accountTextarea3" rows="3" name="companyPolicy" v-model="changeInfoCompanyForm.companyPolicy" placeholder="Chính sách tuyển dụng, đãi ngộ của công ty."></textarea>
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
                                                                    name="companyChance"
                                                                    ref="companyChance"
                                                                    rules="required"
                                                                    v-slot="{ errors }"
                                                                > 
                                                                <div class="form-group row">
                                                                    <div class="col-3 text-right for-label">
                                                                    <label for="accountTextarea4">Cơ hội</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                    <textarea class="form-control" id="accountTextarea4" rows="3" name="companyChance" v-model="changeInfoCompanyForm.companyChance" placeholder="Cơ hội khi ứng viên ứng tuyển vào công ty."></textarea>
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
                                                                    name="companyLink"
                                                                    ref="companyLink"
                                                                    rules="required"
                                                                    v-slot="{ errors }"
                                                                > 
                                                                <div class="form-group row">
                                                                    <div class="col-3 text-right for-label">
                                                                    <label for="account-website">Website chính thức</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                    <input type="text" class="form-control" id="account-website" name="companyLink" v-model="changeInfoCompanyForm.companyLink" placeholder="Địa chỉ website của công ty">
                                                                        <ul style="color:red" class="overline text-left">
                                                                            <li v-for="(error, index) in errors" :key="index">
                                                                            <span>{{ error }}</span>
                                                                            </li>
                                                                        </ul>
                                                                        </div>
                                                                </div>
                                                                </ValidationProvider>
                                                            </div>
                                                        </ValidationObserver>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-t-15 p-b-15">
                                        <div class="tab-content">
                                            <div class="card-header card-profile">
                                                <p class="card-header-title is-uppercase">Đổi mật khẩu</p>
                                                <div class="field is-horizontal">
                                                    <div class="field-body">
                                                        <div class="field">
                                                        <div class="control"><button type="button" class="btn bg-netbee mr-sm-1 mb-1 mb-sm-0" @click="changePassword()">Cập nhật</button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade active show" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form method="POST" v-on:keyup.enter="changePassword">
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
                                                                <div class="controls row">
                                                                    <div class="col-3 text-right for-label">
                                                                        <label for="account-old-password">Mật khẩu cũ</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" v-model="changePasswordForm.oldPassword" placeholder="Nhập vào mật khẩu cũ">
                                                                    <ul style="color:red" class="overline text-left">
                                                                        <li v-for="(error, index) in errors" :key="index">
                                                                        <span>{{ error }}</span>
                                                                        </li>
                                                                    </ul>
                                                                    </div>
                                                                    
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
                                                                <div class="controls row">
                                                                    <div class="col-3 text-right for-label">
                                                                    <label for="account-new-password">Mật khẩu mới</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <input type="password" class="form-control" id="account-new-password" name="newPassword" v-model="changePasswordForm.newPassword" placeholder="Nhập vào mật khẩu mới" >
                                                                            <ul style="color:red" class="overline text-left">
                                                                                <li v-for="(error, index) in errors" :key="index">
                                                                                <span>{{ error }}</span>
                                                                                </li>
                                                                            </ul>
                                                                    </div>
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
                                                                <div class="controls row">
                                                                    <div class="col-3 text-right for-label">
                                                                        <label for="account-retype-new-password">Nhập lại mật khẩu</label>
                                                                    </div>
                                                                    <div class="col-9">
                                                                            <input type="password" class="form-control" name="retypePassword"  id="account-retype-new-password" v-model="changePasswordForm.retypePassword" placeholder="Nhập lại mật khẩu mới">
                                                                            <ul style="color:red" class="overline text-left">
                                                                                <li v-for="(error, index) in errors" :key="index">
                                                                                <span>{{ error }}</span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            </ValidationProvider>
                                                        </div>
                                                    </div>
                                                    </ValidationObserver>
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
extend("integer", {
  message: (field, values) => "Dữ liệu nhập vào phải là số"
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
extend("customUsername", {
  message: field =>"Username" + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s]/;
    var mustContainTheseChars = /^(?=.*?[a-z])(?=.*?[0-9])/;
    var containsForbiddenChars = notTheseChars.test(value);
    if (!containsForbiddenChars) {
      return true;
    } else {
      if (containsForbiddenChars) {
        errorMessage =
          ' không được chứa các ký tự đặc biệt: " ' + " ' ? & / < > hoặc khoảng trắng";
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
    data() {
            return {
                changePasswordForm: {
                    oldPassword: "",
                    newPassword: "",
                    retypePassword: ""
                },
                changeInfoCompanyForm: {
                    files: [],
                    username: "",
                    companyAbout: "",
                    companyHotline: "",
                    companyTax: "",
                    companyBenefit: "",
                    companyPolicy: "",
                    companyChance: "",
                    companyLink: "",
                    imageCover: ""
                },
                images: [],
                imagesCover: [],
                checkUsername: null,
                changeInfoUser: {
                    files: [],
                    name: this.$auth.user.name,
                    birth: this.$auth.user.birth_of_date,
                    phone: this.$auth.user.phone,
                    address: this.$auth.user.address_detail,
                    avatar: this.$auth.user.avatar
                },
                classInfoCommon: true,
                classInfoMore: false
            };
        },
    methods: {
        //update avatar
        onInputChange(e){
            if(this.images.length > 0){
                this.$delete(this.images, 0)
            }
            e.preventDefault();
            e.stopPropagation();
            this.isDragging = false;
            const files = e.target.files;
            if(files.length >0)
                this.addImage(files[0]);

        },
        onInputChangeCover(e){
            if(this.imagesCover.length > 0){
                this.$delete(this.imagesCover, 0)
            }
            e.preventDefault();
            e.stopPropagation();
            this.isDragging = false;
            const files = e.target.files;
            if(files.length >0){
                this.addImageCover(files[0]);
            }
                

        },
        addImage(file){
            if( !file.type.match('image.*') ){
                this.$swal(
                        'Lỗi',
                        'File không đúng định dạng',
                        'error'
                    )
                return;
            }
            if(this.changeInfoUser.files.length >0)
                this.$delete(this.changeInfoUser.files, 0)

            this.changeInfoUser.files.push(file);

            const img = new Image();
            const reader = new FileReader();

            reader.onload = (e) => this.images.push(e.target.result);

            reader.readAsDataURL(file);
        },
        addImageCover(file){
            if( !file.type.match('image.*') ){
                this.$swal(
                        'Lỗi',
                        'File không đúng định dạng',
                        'error'
                    )
                return;
            }
            if(this.changeInfoCompanyForm.files.length >0)
                this.$delete(this.changeInfoCompanyForm.files, 0)
            this.changeInfoCompanyForm.files.push(file);

            const img = new Image();
            const reader = new FileReader();

            reader.onload = (e) => this.imagesCover.push(e.target.result);

            reader.readAsDataURL(file);
        },

        resetImg(){
            this.$delete(this.changeInfoUser.files, 0)
            this.$delete(this.images, 0)
        },
        resetImgCover(){
            this.$delete(this.changeInfoCompanyForm.files, 0)
            this.$delete(this.images, 0)
        },

        //change Info User
        async actionInfoUser(){
            var form = new FormData();
            const isValid = await this.$refs.InfoUser.validate();
            if(isValid){
                form.append('avatar' , this.changeInfoUser.files[0])
                form.append('name' , this.changeInfoUser.name)
                form.append('phone' , this.changeInfoUser.phone)
                form.append('birth_of_date' , this.changeInfoUser.birth)
                form.append('address_detail' , this.changeInfoUser.address)
                let $this = this;
                let role = this.$auth.user.role;
                this.$axios.post('changeInfo',form).then(response => {
                    if(response.data.status == 200) {
                        this.$swal(
                            'Thành công',
                            response.data.message,
                            'success',
                        ).then(function(response){
                            if(role == 2){
                                $this.classInfoCommon = false;
                                $this.classInfoMore = true;
                            }
                            else{
                                window.location.reload();
                            }
                        })
                    }else{
                        this.$swal(
                            'Lỗi',
                            response.data.message,
                            'error'
                        )
                    }
                })
                
            }
        },
        
        
        //change password
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
                 // reset validation
                // You should call it on the next frame
                requestAnimationFrame(() => {
                this.$refs.observer.reset();
                });
            }
        },
        async changeInfoCompany() {
            console.log(this.changeInfoCompanyForm.files[0])
            if(this.changeInfoCompanyForm.files.length == 0) {
                this.$swal(
                    'Lỗi!',
                    'Chưa chọn ảnh bìa',
                    'error'
                    )
            }else {
                const isValid = await this.$refs.observerChangeInfoCompany.validate();
                var form = new FormData();
                if(isValid){
                    form.append('company_about',this.changeInfoCompanyForm.companyAbout);
                    form.append('username',this.changeInfoCompanyForm.username);
                    form.append('company_hotline',this.changeInfoCompanyForm.companyHotline);
                    form.append('company_tax',this.changeInfoCompanyForm.companyTax);
                    form.append('company_benefit',this.changeInfoCompanyForm.companyBenefit);
                    form.append('company_policy',this.changeInfoCompanyForm.companyPolicy);
                    form.append('company_chance',this.changeInfoCompanyForm.companyChance);
                    form.append('company_link',this.changeInfoCompanyForm.companyLink);
                    form.append('image_cover',this.changeInfoCompanyForm.files[0]);

                    console.log(form)
                    try {
                        this.$axios.post('changeInfoCompany',form).then((response) => {
                            if(response.data.status == 200){
                                this.$swal({
                                titile: 'Thành công',
                                text: response.data.message,
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                }).then( async (result) => {
                                if (result.value) {
                                        window.location.href = "/admin";
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
                        }).catch ((error)=> {
                                this.$swal(
                                    'Lỗi!',
                                    'Có lỗi xảy ra'+error,
                                    'error'
                                    )
                            })
                    } catch (error) {
                        this.$swal(
                            'Lỗi!',
                            'Có lỗi xảy ra'+error,
                            'error'
                            )
                    }
                    // reset validation
                    // You should call it on the next frame
                    requestAnimationFrame(() => {
                    this.$refs.observer.reset();
                    });
                }
            }
        },
        checkUsernameCompany($username){
            this.$axios.get('checkUsernameCompany?username=' + $username).then(response=> {
                if(response.data.status == 200){
                    this.checkUsername = true
                }
                else if(response.data.status == 400){
                    this.checkUsername = false
                }
            })
        },
        async fetch() {
            let dataInforCompany = await this.$axios.get('getInfoCompany');
            if(dataInforCompany.data.data !== null){
                this.changeInfoCompanyForm.companyAbout = dataInforCompany.data.data.company_about;
                this.changeInfoCompanyForm.companyHotline = dataInforCompany.data.data.company_hotline;
                this.changeInfoCompanyForm.companyTax = dataInforCompany.data.data.company_tax;
                this.changeInfoCompanyForm.companyBenefit = dataInforCompany.data.data.company_benefit;
                this.changeInfoCompanyForm.companyPolicy = dataInforCompany.data.data.company_policy;
                this.changeInfoCompanyForm.companyChance = dataInforCompany.data.data.company_chance;
                this.changeInfoCompanyForm.companyLink = dataInforCompany.data.data.company_link;
                this.changeInfoCompanyForm.username = dataInforCompany.data.data.username;
                this.changeInfoCompanyForm.imageCover = dataInforCompany.data.data.image_cover;
            }
            
        },
        updateMoreInfo(){
            this.classInfoCommon = false,
            this.classInfoMore = true
            console.log(this.classInfoMore)
            console.log(this.classInfoCommon)
        }
  },
  mounted() {
      this.fetch();
      console.log(this.classInfoMore)
            console.log(this.classInfoCommon)
  },
  watch: {
      checkUsername: function(){
          
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
.col-11:focus {
    outline: unset;
    border: none;
    outline-color: unset;
    outline-style: unset;
    outline-width: unset;
    
}
.input-username:focus{
    border: unset!important;
    color: #5F5F5F;
    padding-left: 10px!important;
}
.col-11 input{
    color: #5F5F5F;
}
.card-header {
    border-bottom: 1px solid #eaeaea;
    align-items: center;
    justify-content: space-between;
}
.card-profile {
    background: #eaeaea;
}
.card-header .card-profile {
    padding-top: 0;
}
.card-header-title {
    align-items: center;
    color: #363636;
    display: flex;
    flex-grow: 1;
    font-weight: 700;
    padding: 0.75rem 1rem;
}
.is-uppercase {
    text-transform: uppercase !important;
}
.field.is-horizontal {
    display: flex;
}
.field-body {
    display: flex;
    flex-basis: 0;
    flex-grow: 5;
    flex-shrink: 1;
}
.button.is-primary {
    background-color: #ffd000;
    border-color: transparent;
    color: rgba(0, 0, 0, 0.7);
}
.card-header .button {
    margin-right: 1rem;
}
.btn .bg-netbee{
    margin-bottom: 10px!important;
}
.for-label{
    padding-top: 10px;
}
.for-label label{
    font-weight: 600;
}
.card-header-title{
    margin-bottom: 0;
}
.tab-content .card-header{
    padding: 5px 0 !important;
}
</style>>

