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
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-t-15 p-b-15">
                                        <div class="tab-content">
                                            <div class="card-header card-profile">
                                                <p class="card-header-title is-uppercase">Thông tin chung</p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                                <form method="post">
                                                    <ValidationObserver ref="InfoUser" v-slot="{ valid }">
                                                        <div class="row">
                                                            <div class="col-12 row p-0 mg mx-0">
                                                                <div class="col-lg-4 offset-lg-0 mb-lg-0 mx-lg-0 col-md-6 mx-md-auto mb-md-1 col-sm-4 media">
                                                                        <!-- <avatar-cropper
                                                                        @uploaded="handleUploaded"
                                                                        :labels="{submit:'Cắt',cancel:'Hủy'}"
                                                                        output-options="{width: 150, height: 150}"
                                                                        trigger="#account-upload"
                                                                        upload-url="http://127.0.0.1:8000/api/changeInfo" /> -->
                                                                        <a href="javascript: void(0);" style="position: relative" class="avatar-custom mx-auto">
                                                                        <img v-lazy="images[0]" class="rounded" alt="profile image" style="object-fit: cover; width: 150px; height: 150px;border: 1px solid; border-radius: 50% !important" v-if="images.length > 0">
                                                                        <img v-lazy="changeInfoUser.avatar != null && changeInfoUser.avatar.startsWith('https') ? changeInfoUser.avatar : `/uploads/users/avatars/${changeInfoUser.avatar}`" class="rounded" alt="profile image" style="object-fit: cover; height: 150px; width: 150px; border: 1px solid; border-radius: 50% !important" v-else>
                                                                        <div class="btn-change-avatar" style="position: absolute; bottom: 0; padding: 0; width: 100%">
                                                                            <label class="btn btn-sm mb-sm-0 cursor-pointer" for="account-upload" style="background-color: #000; height:75px; padding-top: 2rem; border-bottom-left-radius: 75px; border-bottom-right-radius: 75px; width: 100%; color: #ffffff; font-size: 14px">Đổi ảnh đại diện</label>
                                                                            <input type="file" id="account-upload" @change="onInputChange" hidden>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-lg-8 col-md-12 col-sm-8 pr-0 row">
                                                                    <div class="col-12">
                                                                        <ValidationProvider rules="required" ref="name" name="name" v-slot="{ errors }">
                                                                            <div class="form-group" style="margin-bottom: 0rem !important;">
                                                                                <div class="controls row">
                                                                                    <div class="col-sm-4 for-label pr-0">
                                                                                        <label v-if="$auth.user.role != 2" for="account-username">Họ tên</label>
                                                                                        <label v-if="$auth.user.role == 2" for="account-company">Email</label>
                                                                                    </div>
                                                                                    <div class="col-sm-8 pr-0 pl-50">
                                                                                        <input v-if="$auth.user.role == 2" type="text" class="form-control" v-model="changeInfoUser.email" readonly>
                                                                                        <input  v-if="$auth.user.role != 2" type="text" class="form-control" name="name" v-model="changeInfoUser.name">
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
                                                                        <div class="form-group" style="margin-bottom: 0rem !important;">
                                                                            <div class="controls row">
                                                                                <div class="col-sm-4 for-label pr-0">
                                                                                    <label v-if="$auth.user.role != 2" for="account-name">Ngày sinh</label>
                                                                                    <label v-if="$auth.user.role == 2" for="account-name">Ngày thành lập</label>
                                                                                </div>
                                                                                <div class="col-sm-8 pr-0 pl-50">
                                                                                    <input type="date" class="form-control" v-model="changeInfoUser.birth">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 number-phone">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                                            <div class="form-group" style="margin-bottom: 0rem !important">
                                                                                <div class="controls row">
                                                                                    <div class="col-sm-4 for-label pr-0">
                                                                                        <label for="account-e-mail">Số điện thoại</label>
                                                                                    </div>
                                                                                    <div class="col-sm-8 pr-0 pl-50">
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-12" style="margin-bottom: 0.5rem">
                                                                <div class="for-label pb-50">
                                                                    <label v-if="$auth.user.role == 2" for="account-username">Tên công ty</label>
                                                                    <label v-if="$auth.user.role != 2" for="account-company">Email</label>
                                                                </div>
                                                                <div>
                                                                    <input v-if="$auth.user.role == 2" type="text" class="form-control" name="name" v-model="changeInfoUser.name">
                                                                    <input v-if="$auth.user.role != 2" type="text" class="form-control" v-model="changeInfoUser.email" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-12" style="margin-bottom: 0.5rem">
                                                                <ValidationProvider rules="required" v-slot="{ errors }">
                                                                    <div class="for-label pb-50">
                                                                        <label for="account-company">Địa chỉ</label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="text" class="form-control" v-model="changeInfoUser.address">
                                                                        <ul style="color:red" class="overline">
                                                                            <li v-for="(error, index) in errors" :key="index">
                                                                            <span>{{ error }}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </ValidationProvider>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn bg-netbee float-right mb-1" style="margin-right: -12px" @click="actionInfoUser()">Cập nhật</button>
                                                        </div>
                                                    </ValidationObserver>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-8" v-if="$auth.user.role == 3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-t-15 p-b-15">
                                        <div class="tab-content">                                          
                                            <div>
                                                <div class="card-header card-profile">
                                                    <p class="card-header-title is-uppercase">Thông tin ngân hàng</p>
                                                </div>
                                                <div class="tab-pane fade active show" :class="{'active': classInfoMore, 'show': classInfoMore} " id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                    <form method="POST" v-on:keyup.enter = "changeBankHr">
                                                        <ValidationObserver ref="ChangeInfoBank" v-slot="{ inval }">
                                                            <div class="row">
                                                                <div class="form-group col-12" style="margin-bottom: 0rem !important;">
                                                                    <ValidationProvider rules="required|min:6"  v-slot="{ errors }">
                                                                            <div class="controls">
                                                                                <div class="for-label pb-50">
                                                                                    <label>Tên tài khoản</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="text" class="form-control" v-model="bankHr.name">
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
                                                            <div class="row">
                                                                <div class="form-group col-12" style="margin-bottom: 0rem !important;">
                                                                    <ValidationProvider rules="required|numeric"  v-slot="{ errors }">
                                                                            <div class="controls">
                                                                                <div class="for-label pb-50">
                                                                                    <label>Số tài khoản</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="text" class="form-control" v-model="bankHr.stk">
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
                                                            <div class="row">
                                                                <div class="form-group col-12" style="margin-bottom: 0rem !important;">
                                                                    <ValidationProvider rules="required|min:6"  v-slot="{ errors }">
                                                                            <div class="controls">
                                                                                <div class="for-label pb-50">
                                                                                    <label>Chi nhánh</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="text" class="form-control" v-model="bankHr.branch">
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
                                                            <div class="row">
                                                                <div class="form-group col-12" style="margin-bottom: 0rem !important;">
                                                                    <ValidationProvider rules="required|min:6"  v-slot="{ errors }">
                                                                            <div class="controls">
                                                                                <div class="for-label pb-50">
                                                                                    <label>Ngân hàng</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="text" class="form-control" v-model="bankHr.bankName">
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
                                                            <div class="col-12">
                                                                <button type="button" class="btn bg-netbee float-right mb-1" style="margin-right: -12px" v-bind:disabled="inval" v-on:click ="changeBankHr">Cập nhật</button>
                                                            </div>
                                                            <!-- <div class="col-10 d-flex justify-content-end">
                                                                <div class="field is-horizontal">
                                                                    <div class="field-body">
                                                                        <div class="field">
                                                                            <div class="control">
                                                                                <button type="button" class="btn bg-netbee mb-1 mb-sm-0" v-bind:disabled="inval" v-on:click ="changeBankHr">Cập nhật</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </ValidationObserver>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8" v-if="$auth.user.role == 2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-t-15 p-b-15">
                                        <div class="tab-content">                                          
                                            <div>
                                                <div class="card-header card-profile">
                                                    <p class="card-header-title is-uppercase">Thông tin công ty</p>
                                                </div>
                                                <div class="tab-pane fade active show" :class="{'active': classInfoMore, 'show': classInfoMore} " id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                    <form method="POST" v-on:keyup.enter = "changeInfoCompany">
                                                        <ValidationObserver ref="observerChangeInfoCompany" v-slot="{ valid }">
                                                            <div class="row">
                                                                <div class="col-12 row p-0 mg mx-0">
                                                                    <div class="col-lg-4 offset-lg-0 mb-lg-0 mx-lg-0 col-md-6 mx-md-auto mb-md-1 col-sm-4 media">
                                                                        <a href="javascript: void(0);" style="position: relative" class="avatar-custom mx-auto">
                                                                            <img v-lazy="imagesCover[0]" class="rounded" alt="profile image" style="object-fit: cover; width: 150px; height: 150px;border: 1px solid; border-radius: 50% !important" v-if="imagesCover.length > 0">
                                                                            <img v-lazy="changeInfoCompanyForm.imageCover != null && changeInfoCompanyForm.imageCover.startsWith('https') ? changeInfoCompanyForm.imageCover : `/uploads/users/covers/${changeInfoCompanyForm.imageCover}`" class="rounded" alt="profile image" style="object-fit: cover; height: 150px; width: 150px; border: 1px solid; border-radius: 50% !important" v-else>
                                                                            <div class="btn-change-avatar" style="position: absolute; bottom: 0; padding: 0; width: 100%">
                                                                                <label class="btn btn-sm mb-sm-0 cursor-pointer" for="account-upload-cover" style="background-color: #000; height:75px; padding-top: 2rem; border-bottom-left-radius: 75px; border-bottom-right-radius: 75px; width: 100%; color: #ffffff; font-size: 14px">Đổi ảnh đại diện</label>
                                                                                <input id="account-upload-cover" name="imageCoverInput" @change="onInputChangeCover" hidden>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-12 col-sm-8 pr-0 row">
                                                                        <div class="col-12">
                                                                            <ValidationProvider name="account-phone" ref="account-phone" rules="numeric" v-slot="{ errors }">
                                                                                <div class="form-group" style="margin-bottom: 0rem !important;">
                                                                                    <div class="controls row">
                                                                                        <div class="col-sm-4 for-label pr-0">
                                                                                            <label for="account-phone">Đường dây nóng</label>
                                                                                        </div>
                                                                                        <div class="col-sm-8 pr-0 pl-50">
                                                                                            <input type="text" class="form-control" name="name" v-model="changeInfoCompanyForm.companyHotline">
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
                                                                            <div class="form-group" style="margin-bottom: 0rem !important;">
                                                                                <div class="controls row">
                                                                                    <div class="col-sm-4 for-label pr-0">
                                                                                        <label for="account-phone">Mã số thuế</label>
                                                                                    </div>
                                                                                    <div class="col-sm-8 pr-0 pl-50">
                                                                                        <input type="text" class="form-control" id="account-phone" name="companyTax" v-model="changeInfoCompanyForm.companyTax" required placeholder="Tax">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 website-company">
                                                                            <ValidationProvider name="companyLink" ref="companyLink" rules="required" v-slot="{ errors }"> 
                                                                                <div class="form-group" style="margin-bottom: 0rem !important">
                                                                                    <div class="controls row">
                                                                                        <div class="col-sm-4 for-label pr-0">
                                                                                            <label for="account-website">Website chính thức</label>
                                                                                        </div>
                                                                                        <div class="col-sm-8 pr-0 pl-50">
                                                                                            <input type="text" class="form-control" id="account-website" name="companyLink" v-model="changeInfoCompanyForm.companyLink" placeholder="Địa chỉ website của công ty">
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
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-12" style="margin-bottom: 0.5rem">
                                                                    <ValidationProvider name="username" ref="username" rules="required|customUsername" v-slot="{ errors }">
                                                                        <div class="for-label pb-50">
                                                                            <label for="accountTextarea1">Username</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="text" class="form-control input-username" id="accountTextarea1" @keyup="checkUsernameCompany(changeInfoCompanyForm.username)" name="username" v-model="changeInfoCompanyForm.username" placeholder="Tên viết tắt duy nhất của công ty.">
                                                                            <i style="font-size:16px; top: 50px; position:absolute; top-13px; right: 20px" :class="checkUsername ? 'fas fa-check-circle success' : 'fas fa-times-circle danger'"></i>
                                                                        </div>
                                                                        <div class="description-username">
                                                                            <ul style="color:red" class="overline text-left">
                                                                                <li v-for="(error, index) in errors" :key="index">
                                                                                    <span>{{ error }}</span>
                                                                                </li>
                                                                            </ul>
                                                                            <a>Đường dẫn sẽ xuất hiện với: https://netbee.vn/cong-ty/{{changeInfoCompanyForm.username}}</a>
                                                                        </div>
                                                                    </ValidationProvider>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-12" style="margin-bottom: 0.5rem">
                                                                    <ValidationProvider name="companyAbout" ref="companyAbout" rules="required" v-slot="{ errors }">
                                                                        <div class="for-label pb-50">
                                                                            <label for="accountTextarea1">Giới thiệu</label>
                                                                        </div>
                                                                        <div>
                                                                            <textarea class="form-control" id="accountTextarea1" rows="4" name="companyAbout" v-model="changeInfoCompanyForm.companyAbout" placeholder="Thông tin cơ bản của công ty..."></textarea>
                                                                            <ul style="color:red" class="overline text-left">
                                                                                <li v-for="(error, index) in errors" :key="index">
                                                                                    <span>{{ error }}</span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </ValidationProvider>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-12" style="margin-bottom: 0.5rem">
                                                                    <div class="for-label pb-50">
                                                                        <label for="account-website">Facebook công ty:</label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="text" class="form-control" id="account-website" name="companyLinkFb" v-model="changeInfoCompanyForm.companyLinkFb" placeholder="Địa chỉ facebook của công ty">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-50">
                                                                <button type="button" class="btn bg-netbee float-right mb-1" style="margin-right: -12px" @click="changeInfoCompany()">Cập nhật</button>
                                                            </div>
                                                            <!-- <div class="col-12">
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
                                                            </div> -->
                                                        </ValidationObserver>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Vai trò trên trang -->
                        <div class="col-lg-8" v-if="$auth.user.role == 2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-t-15 p-b-15">
                                        <div class="tab-content">
                                            <div class="card-header card-profile">
                                                <p class="card-header-title is-uppercase">Vai trò trên trang</p>
                                            </div>
                                            <div class="col-12 p-0">
                                                <div class="col-12 p-0">
                                                    <div v-if="emailCompany.length < 5" class="row role">
                                                        <div class="col-sm-5 pr-sm-0">
                                                            <span>
                                                                <div class="for-label pb-50">
                                                                    <label for="account-company">Email</label>
                                                                </div> 
                                                            </span>
                                                            <div>
                                                                <input class="form-control" type="email" id="email" placeholder="Nhập email" v-model="email_company">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-7 pr-sm-0">
                                                            <span>
                                                                <div class="for-label pb-50">
                                                                    <label for="account-company">Phân quyền</label>
                                                                </div> 
                                                            </span>
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <multiselect :options="levelEmail" v-model="status" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false" placeholder="Phân quyền"></multiselect>
                                                                </div>
                                                                <div class="col-sm-4 p-sm-0 pt-1">
                                                                    <button class="btn bg-netbee col-md-12 pl-1 pr-1" @click="updateEmailCompany()">Thêm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <template v-if="emailCompany.length != 0">
                                                        <span>
                                                            <div class="for-label pb-50">
                                                                <label for="account-company">Vai trò</label>
                                                            </div> 
                                                        </span>
                                                        <table class="table table-hover mb-0 zero-configuration">
                                                            <thead class="custom-header" style="text-align: center;">
                                                                <tr>
                                                                    <th class="sx-none">STT</th>
                                                                    <th class="sm-email">Email</th>
                                                                    <th>Vai trò</th>
                                                                    <th>Thao tác</th>                               
                                                                </tr>
                                                            </thead>
                                                            <tbody style="text-align: center;">                                               
                                                                <tr v-for="(item, index) in emailCompany">
                                                                    <td class="p-50 sx-none">{{index + 1}}</td>
                                                                    <td class="p-50 sm-email">{{item.email_company}}</td>
                                                                    <td class="p-50">
                                                                        <div class="action-btns">
                                                                            <div class="btn-dropdown ">
                                                                                <div class="btn-group dropdown actions-dropodown">
                                                                                    <button type="button" class="btn btn-white px-1 py-75 waves-effect waves-light action-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <span v-if="item.status == 0" class="text-none">Chưa phân quyền</span>
                                                                                        <span v-if="item.status == 1" class="text-none"><i class="fa fa-check"></i> QTV</span>
                                                                                        <span v-if="item.status == 2" class="text-none"><i class="fa fa-check"></i> BTV</span>
                                                                                        <i class="fa fa-angle-down" style="margin-right:0px !important"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                                        <a v-if="item.status != 1" @click="updateStatus1(item.id)" class="dropdown-item"><i class="far fa-check-circle"></i> QTV</a>
                                                                                        <a v-if="item.status != 2" @click="updateStatus2(item.id)" class="dropdown-item"><i class="far fa-check-circle"></i> BTV</a> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-50">
                                                                        <button class="btn btn-sm p-1 btn-hover-del" @click="deletedEmailCompany(item.id)" data-toggle="tooltip" data-placement="top" title="Xóa" style="border: 1px solid;background: #e4e4e4;"><i class="fa fa-trash btn-hover-del"></i></button>
                                                                        <button id="edit" class="btn btn-sm p-1 btn-hover-edit" @click="suaEmailCompanyModal(item.id)" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" style="border: 1px solid;background: #e4e4e4;"><i class="fa fa-edit btn-hover-edit"></i></button>
                                                                        <div id="refuse_modal" class="modal fade" role="dialog">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h4 class="modal-title" id="exampleModalLabel1">Cập nhật email</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <span>
                                                                                            <div class="for-label pb-50">
                                                                                                <label for="account-company">Email</label>
                                                                                            </div> 
                                                                                        </span>
                                                                                        <input class="form-control" type="email" id="email" placeholder="Nhập email" v-model="email_company_edit">
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Đóng</button>
                                                                                    <button type="button" class="btn btn bg-netbee" @click="suaEmailCompany()">Cập nhật</button>
                                                                                  </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table> 
                                                    </template>
                                                    <div class="col-md-12" style="padding:0;">
                                                        <span>
                                                            <div class="for-label pb-50">
                                                                <label for="account-company">Ghi chú:</label>
                                                            </div> 
                                                        </span>
                                                         - Quản trị viên (QTV): có quyền đăng nhập như tài khoản công ty.<br>
                                                         - Biên tập viên (BTV): có quyền nhận thông báo từ hệ thống.<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End vai trò trên trang -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body p-t-15 p-b-15">
                                        <div class="tab-content">
                                            <div class="card-header card-profile">
                                                <p class="card-header-title1 is-uppercase">Đổi mật khẩu</p>
                                            </div>
                                            <div class="tab-pane fade active show" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form method="POST" v-on:keyup.enter="changePassword">
                                                    <ValidationObserver ref="observer" v-slot="{ valid }">
                                                        <div class="row">
                                                            <div class="form-group col-12" style="margin-bottom: 0rem !important;">
                                                                <ValidationProvider name="oldPassword" ref="oldPassword" rules="required" v-slot="{ errors }">
                                                                    <div class="controls">
                                                                        <div class="for-label pb-50">
                                                                            <label for="account-old-password">
                                                                            Mật khẩu cũ</label>
                                                                        </div>
                                                                        <div>
                                                                            <input  class="form-control" id="oldPassword" name="oldPassword"  :type="show ? 'text' : 'password'" v-model="changePasswordForm.oldPassword" placeholder="Nhập vào mật khẩu cũ">
                                                                             <div style="text-align: right;">
                                                                                <i class="showpass1">
                                                                                <i @click="showPassword()" :class="show ?'fas fa-eye-slash ':'fad fa-eye'"></i>
                                                                                </i>
                                                                            </div>
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
                                                        <div class="row">
                                                            <div class="form-group col-12" style="margin-bottom: 0rem !important;">
                                                                <ValidationProvider name="newPassword" ref="newPassword" rules="required|customPassword|min:8" v-slot="{ errors }">
                                                                        <div class="controls">
                                                                            <div class="for-label pb-50">
                                                                                <label for="account-new-password" >
                                                                                Mật khẩu mới</label>
                                                                            </div>
                                                                            <div>
                                                                                <input  class="form-control" id="account-new-password" :type="show1 ? 'text' : 'password'" name="newPassword" v-model="changePasswordForm.newPassword" placeholder="Nhập vào mật khẩu mới" >
                                                                                    <div style="text-align: right;">
                                                                                        <i class="showpass1">
                                                                                        <i @click="showPassword1()" :class="show1 ?'fas fa-eye-slash ':'fad fa-eye'"></i>
                                                                                        </i>
                                                                                    </div>
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
                                                        <div class="row">
                                                            <div class="form-group col-12" style="margin-bottom: 0rem !important;">
                                                                <ValidationProvider name="retypePassword" ref="retypePassword" rules="required|retypePassword:@newPassword" v-slot="{ errors }">
                                                                        <div class="controls">
                                                                            <div class="for-label pb-50">
                                                                                <label for="account-retype-new-password" >Nhập lại mật khẩu</label>
                                                                            </div>
                                                                            <div>
                                                                                <input  class="form-control" name="retypePassword" :type="show2 ? 'text' : 'password'" id="account-retype-new-password" v-model="changePasswordForm.retypePassword" placeholder="Nhập lại mật khẩu mới">
                                                                                <div style="text-align: right;">
                                                                                    <i class="showpass1">
                                                                                    <i @click="showPassword2()" :class="show2 ?'fas fa-eye-slash ':'fad fa-eye'"></i>
                                                                                    </i>
                                                                                </div>
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
                                                        <div class="col-12">
                                                            <button type="button" class="btn bg-netbee float-right mb-1" style="margin-right: -12px" @click="changePassword()">Cập nhật</button>
                                                        </div>
                                                    <!-- <div class="row"> -->
                                                        <!-- <div class="col-12">
                                                            <ValidationProvider
                                                                    name="oldPassword"
                                                                    ref="oldPassword"
                                                                    rules="required"
                                                                    v-slot="{ errors }"
                                                                >
                                                            <div class="form-group" style="margin-bottom: 0rem !important;">
                                                                <div class="controls row">
                                                                    <div class="col-sm-3 col-5 text-right for-label">
                                                                        <label for="account-old-password">Mật khẩu cũ</label>
                                                                    </div>
                                                                    <div class="col-7">
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
                                                            <div class="form-group" style="margin-bottom: 0rem !important;">
                                                                <div class="controls row">
                                                                    <div class="col-sm-3 col-5 text-right for-label">
                                                                    <label for="account-new-password">Mật khẩu mới</label>
                                                                    </div>
                                                                    <div class="col-7">
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
                                                            <div class="form-group" style="margin-bottom: 0rem !important;">
                                                                <div class="controls row">
                                                                    <div class="col-sm-3 col-5 text-right for-label">
                                                                        <label for="account-retype-new-password">Nhập lại mật khẩu</label>
                                                                    </div>
                                                                    <div class="col-7">
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
                                                        </div> -->
                                                        <!-- <div class="col-10 d-flex justify-content-end">
                                                            <div class="field is-horizontal">
                                                                <div class="field-body">
                                                                    <div class="field">
                                                                        <div class="control">
                                                                            <button type="button" class="btn bg-netbee mb-1 mb-sm-0" @click="changePassword()">Cập nhật</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
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
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
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
extend("numeric", {
  message: (field, values) => "Dữ liệu nhập vào phải là số.",
});
extend("integer", {
  message: (field, values) => "Dữ liệu nhập vào phải là số"
});
extend("min", {
  message: (field, values) => "Dữ liệu nhập vào ít nhất 6 ký tự",
});
var errorMessage =
  " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 ký tự in hoa, 1 số và 1 ký tự đặc biệt(#!@$%^*-)";
// create custom rule
extend("customPassword", {
  message: field =>"Mật khẩu" + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s]/;
    var mustContainTheseChars = /^.{8,}$/;
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
          " phải chứa ít nhất 8 ký tự.";
      }
      return false;
    }
  }
});
extend("customUsername", {
  message: field =>"Username" + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s`;:á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|í|ì|ỉ|ĩ|ị|ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|ý|ỳ|ỷ|ỹ|ỵ|đ]/;
    var mustContainTheseChars = /^([a-z])([0-9])/;
    var containsForbiddenChars = notTheseChars.test(value);
    if (!containsForbiddenChars) {
      return true;
    } else {
      if (containsForbiddenChars) {
        errorMessage =
          ' không được chứa các ký tự đặc biệt hoặc khoảng trắng';
      }
      return false;
    }
  }
});
export default {
    name: 'Account',
    layout: 'admin',
    components: {
        Multiselect,
        ValidationProvider,
        ValidationObserver
    },
    data() {
            return {
                password: '',
                show: false,
                show1: false,
                show2: false,
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
                    companyLinkFb: "",
                    imageCover: ""
                },
                images: [],
                imagesCover: [],
                checkUsername: null,
                changeInfoUser: {
                    files: [],
                    email: this.$auth.user.email,
                    name: this.$auth.user.name,
                    birth: this.$auth.user.birth_of_date,
                    phone: this.$auth.user.phone,
                    address: this.$auth.user.address_detail,
                    avatar: this.$auth.user.avatar
                },
                classInfoCommon: true,
                classInfoMore: false,
                bankHr:{
                    name: '',
                    stk: '',
                    branch: '',
                    bankName: ''
                },
                emailCompany: [],
                email_company: ' ',
                status: '',
                levelEmail: [
                    {id: 1, name: 'Quản trị viên'},
                    {id: 2, name: 'Biên tập viên'}
                ],
                id_email:'',
                email_company_edit:'',
            };
        },
    methods: {
        // handleUploaded(resp) {
        //     this.changeInfoUser.avatar = resp.relative_url;
        // },
        nameWithLang ({ id, name }) {
            return `${name}`
        },
        showPassword() {
        this.show = !this.show
        },
        showPassword1() {
            this.show1 = !this.show1
        },
        showPassword2() {
            this.show2 = !this.show2
        },
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
            const isValid = await this.$refs.observerChangeInfoCompany.validate();
            var form = new FormData();
            if(isValid){
                form.append('company_about',this.changeInfoCompanyForm.companyAbout);
                form.append('username',this.changeInfoCompanyForm.username);
                form.append('company_hotline',this.changeInfoCompanyForm.companyHotline);
                form.append('company_tax',this.changeInfoCompanyForm.companyTax);
                // form.append('company_benefit',this.changeInfoCompanyForm.companyBenefit);
                // form.append('company_policy',this.changeInfoCompanyForm.companyPolicy);
                // form.append('company_chance',this.changeInfoCompanyForm.companyChance);
                form.append('company_link',this.changeInfoCompanyForm.companyLink);
                form.append('company_link_fb',this.changeInfoCompanyForm.companyLinkFb);
                if(this.changeInfoCompanyForm.files.length == 0){
                    form.append('image_cover',null);
                }else{
                    form.append('image_cover',this.changeInfoCompanyForm.files[0]);
                }
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
                    }
                })
                
                
                // reset validation
                // You should call it on the next frame
                requestAnimationFrame(() => {
                this.$refs.observer.reset();
                });
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
                this.changeInfoCompanyForm.companyLinkFb = dataInforCompany.data.data.company_link_fb;
                this.changeInfoCompanyForm.username = dataInforCompany.data.data.username;
                this.changeInfoCompanyForm.imageCover = dataInforCompany.data.data.image_cover;
            }
            let databankHr = await this.$axios.get('nganhang/getByIt')
            this.bankHr = databankHr.data

            this.$axios.$get('getEmailCompany').then((response) => {
                  this.emailCompany = response
                  console.log(this.emailCompany.length)
                })

            
        },
        updateMoreInfo(){
            this.classInfoCommon = false,
            this.classInfoMore = true
            console.log(this.classInfoMore)
            console.log(this.classInfoCommon)
        },
        changeBankHr: async function() {
            const isValid = await this.$refs.ChangeInfoBank.validate()
            var form = new FormData()
            if(isValid){
                form.append('name',this.bankHr.name)
                form.append('stk',this.bankHr.stk)
                form.append('branch',this.bankHr.branch)
                form.append('bankName',this.bankHr.bankName)

                this.$axios.post('nganhang/EditData',form).then((response) => {
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
                        }) .catch ((error)=> {
                            this.$swal(
                                'Lỗi!',
                                'Có lỗi xảy ra'+error,
                                'error'
                                )
                        })
                    }
                    else{
                        this.$swal(
                        'Lỗi!',
                        response.data.message,
                        'error'
                        )
                    }
                })
            }
        },
        updateEmailCompany(){
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!filter.test(this.email_company)){
                this.$swal(
                    'Lỗi',
                    'Email chưa đúng định dạng!',
                    'error'
                )
            }else{
                var form = new FormData();
                form.append('email_company',this.email_company);
                form.append('status',this.status.id);
                this.$axios.post('postEmailCompany',form).then((response)=>{
                    if(response.data.status == 200) {
                        this.$swal(
                            'Cập nhật thành công!',
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
            }
            
        },
        suaEmailCompanyModal(id){
            this.id_email = id;
            $("#refuse_modal").modal('show');
        },
        suaEmailCompany(){
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!filter.test(this.email_company_edit)){
                this.$swal(
                    'Lỗi',
                    'Email chưa đúng định dạng!',
                    'error'
                )
            }else{
                var form = new FormData();
                form.append('id',this.id_email);
                form.append('email_company',this.email_company_edit);
                this.$axios.post('suaEmailCompany',form).then((response)=>{
                    if(response.data.status == 200) {
                        this.$swal(
                            'Cập nhật thành công!',
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
            }
        },
        deletedEmailCompany(id){
            this.$swal({
              title: 'Xóa email',
              text: "Bạn có chắc chắn muốn xóa email này!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Đồng ý',
              CancelButtonText: 'Hủy bỏ',
            }).then((result) => {
              if (result.value) {
                var form = new FormData();
                form.append('id',id);
                this.$axios.post('postDeleteEmailCompany',form).then((response)=>{
                    if(response.data.status == 200) {
                        this.$swal(
                            'Xóa thành công!',
                            response.data.message,
                            'success'
                        ).then( function (){
                                window.location.reload();
                            } )
                    }else{
                        this.$swal(
                            'Lỗi nè',
                            response.data.message,
                            'error'
                        )
                    }
                })
              }
            })
        },
        updateStatus0(id){
            var form = new FormData();
            form.append('id',id);
            form.append('status',0);
            this.$axios.post('updateStatus0',form).then((response)=>{
                if(response.data.status == 200) {
                    this.$swal(
                        'Thành công!',
                        response.data.message,
                        'success'
                    ).then( function (){
                            window.location.reload();
                        } )
                }else{
                    this.$swal(
                        'Lỗi nè',
                        response.data.message,
                        'error'
                    )
                }
            })
        },
        updateStatus1(id){
            var form = new FormData();
            form.append('id',id);
            form.append('status',1);
            this.$axios.post('updateStatus1',form).then((response)=>{
                if(response.data.status == 200) {
                    this.$swal(
                        'Thành công!',
                        response.data.message,
                        'success'
                    ).then( function (){
                            window.location.reload();
                        } )
                }else{
                    this.$swal(
                        'Lỗi nè',
                        response.data.message,
                        'error'
                    )
                }
            })
        },
        updateStatus2(id){
            var form = new FormData();
            form.append('id',id);
            form.append('status',2);
            this.$axios.post('updateStatus2',form).then((response)=>{
                if(response.data.status == 200) {
                    this.$swal(
                        'Thành công!',
                        response.data.message,
                        'success'
                    ).then( function (){
                            window.location.reload();
                        } )
                }else{
                    this.$swal(
                        'Lỗi nè',
                        response.data.message,
                        'error'
                    )
                }
            })
        }
  },
  mounted() {
      this.fetch()
  },
  watch: {
      checkUsername: function(){
          
      }
  }
}
</script>
<style scoped>
/* .form-group{
    margin-bottom: 0.5rem;
} */

.card-header-title, .card-header-title1 {
    position: relative;
    border-bottom: 1px solid #eaeaea;
    padding-left: 0px !important;
    /* margin-left: 13px; */
}
.card-header-title:before {
    position: absolute;
    background: rgb(255, 183, 1);
    height: 2px;
    content: '';    
    left: 0;
    width: 130px;
    bottom: -2px;
    border-radius: 12px;
}
.card-header-title1:before {
    position: absolute;
    background: rgb(255, 183, 1);
    height: 2px;
    content: '';    
    left: 0;
    width: 100px;
    bottom: -2px;
    border-radius: 12px;
}
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
    /* border-bottom: 1px solid #eaeaea; */
    align-items: center;
    justify-content: space-between;
}
/* .card-profile {
    background: #eaeaea;
} */
.card-header .card-profile {
    padding-top: 0;
}
.card-header-title, .card-header-title1 {
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
.card-header-title, .card-header-title1{
    margin-bottom: 0;
}
.tab-content .card-header{
    padding: 5px 0 !important;
}
/* .content-wrapper{
    padding-bottom: 0 !important;
} */
.hotline{
    margin-bottom: 0;
}
.btn-change-avatar{
    opacity: 0 ;
}
.btn-change-avatar:hover{
    opacity: 0.8;
}
.number-phone, .website-company{
    padding-top: 18px
}
@media (max-width: 1199px){
    .table th{
        padding: 0.5rem
    }
}
@media (min-width: 576px){
    .role{
        width: 100%;
    }
}
@media (max-width: 991px){

    .mg{
        width: 102%;
    }
    
}
@media (max-width: 575px){
    .avatar-label{
        text-align: center !important;
    }
    .rounded{
        width: 84px;
        height: 84px;
    }
    /* .description-username{
        padding-left: 4rem;
    } */
    .avatar-custom{
        margin: auto;
    }
    .mg .for-label{
        margin-bottom: 0.5rem;
    }
    .mg .controls ul{
        margin-bottom: 0;
    }
    /* .for-label{
        padding: 10px 14px;
    } */
    .sx-none{
        max-width: 43px;
        padding-left: 0px !important;
    }
    .sm-email{
        max-width: 70px;
        padding-left: 0px !important;
    }
}
.showpass1 {
  width: 30px !important;
  position: absolute !important;
  top: 50px !important;
  right: 25px !important;
  color: #000 !important;
  z-index: 9 !important;
}
.fa-hover-i{
    color:#000 !important;
}
.btn-hover-del:hover{
    background-color: red !important;
    color: #fff !important;
}
.btn-hover-edit:hover{
    background-color: #ffb701 !important;
    color: #fff !important;
    border-color: #ffb701 !important;
}
</style>>

