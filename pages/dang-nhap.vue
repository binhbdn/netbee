<template>
    <div class="main" v-lazy:background-image="`/assets/img/dk-NTD.png`" style="background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-7 hident-mobile">
                    <div class="row text-center">
                        <div style="padding: 20px" class="col-xs-6 col-sm-3">
                            <div class=" round stat pricing-round">
                                <h4>+10K</h4>
                                <p class="pl-15 pr-15">HR Freelancer</p>
                            </div>
                        </div>
                        <div style="padding: 20px" class="col-xs-6 col-sm-3">
                            <div class="round stat pricing-round">
                                <h4>+500</h4>
                                <p class="pl-15 pr-15">Nhà tuyển dụng</p>
                            </div>
                        </div>
                        <div style="padding: 20px" class="col-xs-6 col-sm-3">
                            <div class="round stat pricing-round">
                                <h4>+1K</h4>
                                <p class="pl-15 pr-15">Việc làm <br></p>
                            </div>
                        </div>
                        <div style="padding: 20px" class="col-xs-6 col-sm-3">
                            <div class="round stat pricing-round">
                                <h4>+500</h4>
                                <p class="pl-15 pr-15">CV</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="text-align: center">
                            <div class="qr-code">
                                <img src="https://devwork.vn//public/images/devwork-mobile-qr.png" alt="Devwork" style="width: 300px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul style="margin-top: 50px;font-size: 15px;padding: 0px; list-style: none;">
                                <li><i class="fad fa-check-circle"></i> Tiếp cận 10K CTV tuyển dụng toàn quốc</li>
                                <li><i class="fad fa-check-circle"></i> Chỉ thanh toán khi ứng viên đóng tiền</li>
                                <li><i class="fad fa-check-circle"></i> Đơn giản và thân thiện người dùng</li>
                                <li><i class="fad fa-check-circle"></i> Tối ưu chi phí và nguồn lực</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="hotline">
                                <div class="well pricing-hotline"><a href="tel:02462900388" style="color: #000;margin-left: 55px;">Hotline
                                        hỗ trợ (024) 629 00 388</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-5 formlogin form-control" >
                    <h2 class="text-center mt-1" style="margin-bottom:15px">ĐĂNG NHẬP</h2>
                    <p class="text-center" style="margin-bottom:25px; font-size: 16px; "><a class="hover" href="dang-ky">Đăng ký tài khoản mới!</a>
                    </p>
                    <div class="form-group-1 input-login" v-on:keyup.enter="login">
                        <ValidationObserver ref="observer" v-slot="{ valid }">
                            <ValidationProvider name="Email" ref="email" rules="required|email" v-slot="{ errors }">
                                <div class="__email">
                                    <fieldset class="form-label-group form-group position-relative has-icon-left mb-0">
                                        <input type="text" class="form-control mb-0" id="email" placeholder="Email" v-model="userForm.email" style="margin-bottom:20px !important; margin-top:2px">
                                        <div class="form-control-position">
                                            <i class="far fa-envelope" style="color: rgba(34, 41, 47, 0.4)!important"></i>
                                        </div>
                                        <label for="email">Email</label>
                                        <ul style="color:red" class="overline text-left">
                                        <li v-for="(error, index) in errors" :key="index">
                                        <span style="left:0; padding-top: 14px;"><i>{{ error }}</i></span>
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
                                        <i @click="showPassword()" :class="show ?'fad fa-eye':'fas fa-eye-slash'"></i>
                                    </i>
                                    
                                </div>
                                <fieldset class="form-label-group position-relative has-icon-left mb-0">
                                    <input class="form-control mb-0" id="password" :type="show ? 'password' : 'text'" placeholder="Mật khẩu" v-model="userForm.password" style="margin-bottom:0px !important; margin-top:2px">
                                    <div class="form-control-position">
                                        <i class="fad fa-key" style="color: rgba(34, 41, 47, 0.4)!important"></i>
                                    </div>
                                    <label for="password">Mật khẩu</label>
                                    <ul style="color:red" class="overline text-left">
                                        <li v-for="(error, index) in errors" :key="index">
                                        <span style="top: 53%!important;left: 0px; font-size:15px;"><i>{{ error }}</i></span>
                                        </li>
                                    </ul>
                                    <p class="text-right mb-0"><a href="/quen-mat-khau" class="remember hover" style="font-size: 15px;color:black!important;">Quên mật khẩu?</a></p>
                                </fieldset>
                            </div>
                            </ValidationProvider>
                            <div class="lopgin-c" style="padding-top:10px">
                                <button @click="login()" id="submit" class="submit btn">ĐĂNG NHẬP</button>
                            </div>
                            <hr>
                            <div class="lopgin-c" style="position:relative">
                                <i class="fab fa-facebook" style="position: absolute; left: 106px; top: 9px; color: white; font-size: 18px; z-index:5"></i>
                                <a @click="loginfb()" class="btn btn-outline-info fb" style="">Đăng nhập bằng
                                    Facebook</a> &nbsp;&nbsp;
                            </div>
                            <div class="lopgin-c" style="position:relative">
                                <img src="assets/img/logo-google.png" style="height:15px;position: absolute; left: 106px; top: 11px; color: blue; font-size: 18px;">
                                <a @click="logingg()" class="btn btn-outline-info gg">Đăng nhập bằng Google</a>
                            </div>
                        </div>
                        </ValidationObserver>
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
    .col-md-5.col-lg-5.formlogin 
    {
        height: 460px;
        width: 300px !important;
    }
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

    .col-md-6 {
        height: 250px;
        width: 260px !important;
    }

    .well.pricing-hotline {
        margin-top: 25px;
        margin-right: 5px !important;
    }

    li {
        height: 50px;
    }
    .col-md-5.col-lg-5.formlogin {
    height: 460px;
    width: 300px !important;
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
    border-radius: 7px;
    background: #ffffff85;
}
.form-group-1 input {
    font-size: 15px !important;
    border-radius: 5px;
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

.col-md-6 {
    height: 250px;
    width: 260px !important;
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

</style>
