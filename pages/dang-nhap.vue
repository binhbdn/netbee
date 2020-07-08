<template>
    <div class="main" v-lazy:background-image="`/assets/img/login-netbee-6.jpg`" style="background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row text-center circle-box">
                        <div class="col-xs-6 col-sm-3 pd-20-lg">
                            <div class=" round stat pricing-round">
                                <h4>+10K</h4>
                                <p class="pl-15 pr-15">HR Freelancer</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 pd-20-lg">
                            <div class="round stat pricing-round">
                                <h4>+500</h4>
                                <p class="pl-15 pr-15">Nhà tuyển dụng</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 pd-20-lg">
                            <div class="round stat pricing-round">
                                <h4>+1K</h4>
                                <p class="pl-15 pr-15">Việc làm <br></p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 pd-20-lg">
                            <div class="round stat pricing-round">
                                <h4>+500</h4>
                                <p class="pl-15 pr-15">CV</p>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 14px">
                        <div class="col-md-5">
                            <div class="qr-code">
                                <img src="https://devwork.vn//public/images/devwork-mobile-qr.png" alt="Devwork" class="w-img-qr">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <ul class="ul-text-lg">
                                <li><i class="fad fa-check-circle"></i> Tiếp cận 10K CTV tuyển dụng toàn quốc</li>
                                <li><i class="fad fa-check-circle"></i> Chỉ thanh toán khi ứng viên đóng tiền</li>
                                <li><i class="fad fa-check-circle"></i> Đơn giản và thân thiện người dùng</li>
                                <li><i class="fad fa-check-circle"></i> Tối ưu chi phí và nguồn lực</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="hotline">
                            <a href="tel:02462900388">
                                Hotline hỗ trợ (024) 629 00 388
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="col-md-12 formlogin">
                        <h3 class="text-center" style="margin-bottom: 25px; font-weight: bold;">ĐĂNG NHẬP</h3>
                        <div class="form-group-1 input-login" v-on:keyup.enter="login">
                            <ValidationObserver ref="observer" v-slot="{ valid }">
                                <ValidationProvider name="Email" ref="email" rules="required|email" v-slot="{ errors }">
                                    <div class="__email">
                                        <fieldset class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control mb-0" id="email" placeholder="Email" v-model="userForm.email" style="margin-bottom: 0!important;">
                                            <div class="form-control-position" style="top: 4px;">
                                                <i class="far fa-envelope" style="color: rgba(34, 41, 47, 0.4)!important"></i>
                                            </div>
                                            <!-- <label for="email">Email</label> -->
                                            <p v-for="(error, index) in errors" :key="index" class="login-error">{{ error }}</p>
                                        </fieldset>
                                    </div>
                                </ValidationProvider>
                            <div style="position: relative">
                                <ValidationProvider name="Mật khẩu" ref="password" rules="required|customPassword" v-slot="{ errors }">
                                <div class="__email">
                                    <div style="text-align:right">
                                        <i  class="showpass">
                                            <i @click="showPassword()" :class="show ?'fad fa-eye':'fas fa-eye-slash'" style="top: -4px;"></i>
                                        </i>
                                    </div>
                                    <fieldset class="form-label-group position-relative has-icon-left">
                                        <input class="form-control mb-0" id="password" :type="show ? 'password' : 'text'" placeholder="Mật khẩu" v-model="userForm.password" style="margin-bottom: 0 !important;">
                                        <div class="form-control-position" style="top: 4px;">
                                            <i class="fad fa-key" style="color: rgba(34, 41, 47, 0.4)!important;"></i>
                                        </div>
                                        <!-- <label for="password">Mật khẩu</label> -->
                                        <p v-for="(error, index) in errors" :key="index" class="login-error">{{ error }}</p>
                                    </fieldset>
                                </div>
                                </ValidationProvider>
                                <div class="lopgin-c">
                                    <button @click="login()" id="submit" class="btn btn-warning">Đăng nhập</button>
                                </div>
                                <hr>
                                <a @click="loginfb()" class="btn btn-outline-info fb col-md-12" >
                                    <i class="fab fa-facebook login-gg-fa"></i> Đăng nhập bằng Facebook
                                </a>
                                <a @click="logingg()" class="btn btn-outline-info gg col-md-12" style="margin-top: 15px;">
                                    <img class="login-gg-fa" src="assets/img/logo-google.png"> Đăng nhập bằng Google
                                </a>
                                <p class="text-center" style="margin-top: 10px; margin-bottom: 0;"><a href="/quen-mat-khau">Quên mật khẩu ?</a></p>
                            </div>
                            </ValidationObserver>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 formlogin">
                        <p class="text-center" style="margin: 0;">
                            Bạn chưa có tài khoản?<a class="hover-link" href="dang-ky"> Đăng ký tài khoản mới!</a>
                        </p>
                        
                    </div>
                </div>
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

extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});
extend("email", {
  message: (field, values) => "Email không đúng định dạng"
});
var errorMessage =
  " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 số";
// create custom rule
extend("customPassword", {
  message: field =>"Mật khẩu" + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s]/;
    var mustContainTheseChars = /^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
    var containsForbiddenChars = notTheseChars.test(value);
    var containsRequiredChars = mustContainTheseChars.test(value);
    if (!containsForbiddenChars) {
      return true;
    } else {
      if (containsForbiddenChars) {
        errorMessage =
          'không được chứa các ký tự: " ' + " ' ? & / < > hoặc khoảng trắng";
      }
      return false;
    }
  }
});
export default {
    middleware: 'guest',
    layout: 'no_banner',
    components: {
    ValidationProvider,
    ValidationObserver,
  },
    data() {
        return {
            userForm: {
                email: '',
                password: ''
            },
            show: true,
            backgroundUrl: require('~/static/assets/img/body-bg.jpg')
        }
    },
    methods: {
        async login() {
            const isValid = await this.$refs.observer.validate();
            if(isValid){
            try {
                    let response = await this.$auth.loginWith('local',{ data: this.userForm });
                    window.location.href = '/admin';
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
        }
    },
    mounted() {
        console.log(this.$route.fullPath == '/dang-nhap?success');
        if(this.$route.fullPath == '/dang-nhap?success'){
            this.$swal(
                        'Chúc mừng!',
                        'Kích hoạt tài khoản thành công!',
                        'success'
                    )
                }
        }
}
</script>
<style scoped>

    .form-label-group>input:not(:focus):not(:placeholder-shown)~label, .form-label-group textarea:not(:focus):not(:placeholder-shown)~label{
        color:black!important;
        font-size: 14px;
    }
    .form-label-group>input:focus:not(:placeholder-shown)~label, .form-label-group>input:not(:active):not(:placeholder-shown)~label, .form-label-group textarea:focus:not(:placeholder-shown)~label, .form-label-group textarea:not(:active):not(:placeholder-shown)~label {
        color: black!important;
        font-size: 14px;
    }
    form#appointment-form {
        padding-bottom: 13px !important;
        padding-top: 10px !important;
    }

    .well.pricing-hotline {
        margin-top: 25px;
        margin-right: 5px !important;
    }

    li {
        height: 50px;
    }

form#appointment-form {
    padding-bottom: 13px !important;
    padding-top: 10px !important;
}
.main {
    padding: 130px 0;
    position: relative;
}
.col-sm-3 {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
}
.round.stat {
    width: 115px;
    height: 115px;
    margin: auto;
    display: inline-block;
    border-radius: 50%;
    margin: 0 12px;
    color: #000;
    text-align: center;
    background-color: #fff;
    vertical-align: top;
    border: 3px solid #ffb701;
}
.pricing-round {
    background-color: #FFF!important;
    border: 3px solid #ffb701;
    font-size: 11px !important;
}
.round.stat p {
    font-size: 16px;
}
.round.stat h4 {
    font-size: 25px;
    font-weight: 600;
    margin-top: 20px;
    padding-bottom: 0;
    margin-bottom: 3px;
}
.formlogin {
    border-radius: 3px;
    background: rgba(255, 255, 255, 0.86);
    padding-top: 20px;
    padding-bottom: 20px;
}
.form-group-1 input {
    font-size: 15px !important;
    border-radius: 3px;
}
input.input {
    padding-left: 48px;
    padding-right: 20px;
}
input, select {
    width: 100%;
    display: block;
    border: none;
    border-bottom: 2px solid #ebebeb;
    padding: 5px 0;
    color: #222 !important;
    margin-bottom: 31px !important;
    font-family: "Work Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
}
.__email span {
    position: absolute;
    top: 48%;
    transform: translateY(-50%);
    color: #000;
    left: 14px;
    font-size: 21px;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
#submit {
    color: #000;
    display: inline-block;
    margin: 0px !important;
    width: 100% !important;
    font-size: 15px !important;
    padding-top: 6px !important;
    padding-bottom: 6px !important;
}
.submit {
    width: auto;
    background: #ffb701;
    color: #fff;
    padding: 16px 17px;
    font-size: 13px;
    border: none;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -o-border-radius: 5px;
    -ms-border-radius: 5px;
    cursor: pointer;
    box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
    -moz-box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
    -webkit-box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
    -o-box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
    -ms-box-shadow: 0px 1px 15px 0px rgba(73, 102, 177, 0.7);
}
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
}

ul {
    background: 0 0;
    z-index: 9;
}
ul li {
    padding: 3px 0px;
    z-index: 2;
    color: #000;
    font-weight: 600;
}
.fa-check-circle {
    color: #000;
    font-weight: 700;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.login-error {
    color: #ff4a4a;
    margin: 0;
    font-size: 13px;
}
.login-gg-fa{
    width: 15px;
    height: 15px;
    margin-right: -26px;
    margin-left: 8px;
    margin-top: 2px;
    float: left;
    font-size: 16.5px;
}
.hover-link{
    color: #ffb701;
}
.hover-link:hover{
    color: #ac7b00 !important;
}
.hotline{
    border: 1px solid #1e1e1e;
    border-radius: 3px;
    padding: 15px;
    text-align: center;
    font-size: 18px;
    background: #ffffffb8;
    margin-top: 15px;
}
.w-img-qr{
    width: 300px;
}
.ul-text-lg{
    margin-top: 50px;
    font-size: 16px;
    padding: 0px; 
    list-style: none;
}
.pd-20-lg{
    padding: 20px;
}
.circle-box .pd-20-lg:last-child {
    padding-right: 0px!important;
}
.form-control:focus {
    border-color: #fff;
}
input:focus {
    border: none !important;
}
@media(max-width: 1199px) {
    .w-img-qr{
        width: 240px;
    }
    .ul-text-lg{
        margin-top: 30px;
    }
}
@media(max-width: 991px) {
    .container{
       display: contents;
    }
}
@media(max-width: 768px) {
    .pd-20-lg{
       display: none;
    }
}
</style>
