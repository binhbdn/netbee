<template>
    <div class="main" style="background-image: url('https://www.netbee.vn/site/assets/images/body-bg.jpg')">
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
                            <ul class=" " style="margin-top: 50px;font-size: 15px;padding: 0px; list-style: none;">
                                <li><i class="fa fa-check-circle"></i> Tiếp cận 10K CTV tuyển dụng toàn quốc</li>
                                <li><i class="fa fa-check-circle"></i> Chỉ thanh toán khi ứng viên đóng tiền</li>
                                <li><i class="fa fa-check-circle"></i> Đơn giản và thân thiện người dùng</li>
                                <li><i class="fa fa-check-circle"></i> Tối ưu chi phí và nguồn lực</li>
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
                <div class="col-md-5 col-lg-5 formlogin">
                    <h2 class="text-center" style="margin-bottom:15px">ĐĂNG NHẬP</h2>
                    <p class="text-center" style="margin-bottom:25px; font-size: 14px; "><a class="hover" style="color:black!important" href="">Đăng ký tài khoản mới!</a>
                    </p>
                    <div class="form-group-1">
                        <div class="__email">
                            <span class="fa fa-user-circle" style="top:25%!important; z-index:2; left:24px;"></span>
                            <input type="email" name="email" id="email" class="border-radius input" placeholder="Email" v-model="userForm.email" />
                        </div>
                        <div style="position: relative">
                            <div class="__email">
                                <span class="fa fa-lock" style="top:7%!important; z-index:2; left:11px;"></span>
                                <input style="margin-bottom:15px!important" type="password" name="password" id="password" placeholder="Mật khẩu" class="border-radius input" v-model="userForm.password" />
                                <div style="text-align:right">
                                    <i onclick="passwordF()" class="showpass">
                                        <i class="fa fa-eye" style="top:7%!important; z-index:2; left:11px;"></i>
                                    </i>
                                    <a href="" class="remember hover" style="color:black!important;">Quên mật khẩu</a>
                                </div>
                            </div>
                            <div class="form-submit" style="padding-top:10px">
                                <button @click="login()" id="submit" class="submit">ĐĂNG NHẬP</button>
                            </div>
                            <hr>
                            <div class="lopgin-c">
                                <a href="redirect/facebook" class="btn btn-outline-info fb" style="">Đăng nhập bằng
                                    Facebook</a> &nbsp;&nbsp;
                            </div>
                            <div class="lopgin-c">
                                <a href="redirect/google" class="btn btn-outline-info gg">Đăng nhập bằng Google</a>
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
    middleware: 'guest',
    layout: 'no_banner',
    data() {
        return {
            userForm: {
                email: '',
                password: ''
            }
        }
    },
    methods: {

            async login() {
            try {
                let response = await this.$auth.loginWith('local',{ data: this.userForm });
                // window.location.href = '/';
            } catch (err) {
                 this.$swal(
                        'Lỗi!',
                        'Tài khoản hoặc mật khẩu không đúng!',
                        'error'
                    )
            }
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
.fb {
    text-decoration: none !important;
    color: #fff !important;
    border: 1px solid !important;
    border-radius: 3px !important;
    padding: 8px !important;
    background: #286090 !important;
    font-size: 15px !important;
}
.gg {
    text-decoration: none !important;
    color: #fff !important;
    border: 1px solid !important;
    border-radius: 3px !important;
    padding: 8px !important;
    background: red !important;
    font-size: 15px !important;
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
    color: #999;
}
ul li:not(.init) {
    color: #fff;
    /* padding: 5px 10px; */
}
.fa-check-circle {
    color: #ffb701;
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
.lopgin-c a {
    width: 100% !important;
}
.btn.btn-outline-info {
    border: none !important;
}
.fb:hover {
    background: #fff !important;
    color: #286090 !important;
}
.gg:hover {
    background-color: #fff !important;
    color: red !important;
}
.showpass {
    width: 30px;
    position: absolute;
    top: 7px;
    right: 12px;
    color: #000;
}
</style>