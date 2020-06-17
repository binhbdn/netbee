<template>
    <section class="hero-wraps js-fullheight" v-lazy:background-image="`/assets/img/dk-NTD.png`" style="background-size: cover;">
    <div class="container">
        <div class="row ">
            <div class="col-7" style="padding:95px 15px;">
                <!-- <div style="font-size: 24px;">
                    <span style="margin-right: 190px;">Đăng tin tuyển dụng</span>
                    <span>Tìm kiếm ứng viên</span>
                </div> -->
                <div style="margin-top: 0px;">
                    <div class="round stat rounded-circle">
                        <h4 class="pt-4">+3000</h4>
                        <p>ứng viên</p>
                    </div>
                    <div class="round stat rounded-circle">
                        <h4 class="pt-4">+1000</h4>
                        <p>tin</p>
                    </div>
                    <div class="round stat rounded-circle">
                        <h4 class="pt-4">+4000</h4>
                        <p>CTV</p>
                    </div>
                    <div class="round stat rounded-circle">
                        <h4 class="pt-4">+500</h4>
                        <p>đối tác</p>
                    </div>
                </div>
                <div style="margin-top: 12em !important;    line-height: 40px;">
                    <ul>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> <b>+3,000 ứng viên tiếp cận thông tin tuyển dụng</b></li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> <b>Hơn 20 hồ sơ ứng tuyển cho 1 việc làm đăng tuyển tại Netbee</b></li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> <b>Tăng hiệu quả 4 - 5 lần so với các phương thức tuyển dụng khác</b></li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> <b>+2,000 lượt xem trung bình cho 1 việc làm</b></li>
                    </ul>
                </div>
            </div>
            <div class="col-5" style="padding:0px 15px; ">
                <div class="style-backrou">
                    <div class="text-center" style="background: #ffb701;padding:10px;margin-bottom:10px;">
                    <span style="color:#000; font-weight: bold;">ĐĂNG KÝ TÀI KHOẢN NHÀ TUYỂN DỤNG</span>
                    </div>
                    <span>Nếu đã có tài khoản, xin vui lòng đăng nhập <a href="../dang-nhap"><b>Tại đây</b></a></span>
                <form method="POST" class="appointment-form" id="appointment-form-2" style="margin-top:10px;" v-on:keyup.enter="signIn">
                        <ValidationObserver ref="observer" v-slot="{ valid }">
                        <ValidationProvider
                            name="name"
                            ref="name"
                            rules="required"
                            v-slot="{ errors }"
                        >   
                        <div class="form-group" style="margin-bottom:0px;">
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register"><span class="text-danger">(*)</span>Tên công ty</label>
                            <input type="text" class="form-control" name="name" v-model="userForm.name">
                            <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                <li v-for="(error, index) in errors" :key="index">
                                <span>{{ error }}</span>
                                </li>
                            </ul>
                        </div>
                        </ValidationProvider>
                        <ValidationProvider
                            name="email"
                            ref="email"
                            rules="required|email"
                            v-slot="{ errors }"
                        >
                        <div class="form-group" style="margin-bottom:0px;">
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register"><span class="text-danger">(*)</span>Email</label>
                            <input type="email" class="form-control" name="email" v-model="userForm.email">
                            <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                <li v-for="(error, index) in errors" :key="index">
                                <span>{{ error }}</span>
                                </li>
                            </ul>
                        </div>
                        </ValidationProvider>
                        <ValidationProvider
                            rules="required|integer"
                            ref="phone"
                            name="phone"
                            v-slot="{ errors }"
                        >
                            <div class="form-group" style="margin-bottom:0px;">
                                <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register"><span class="text-danger">(*)</span>Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" v-model="userForm.phone">
                                <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                <li v-for="(error, index) in errors" :key="index">
                                <span>{{ error }}</span>
                                </li>
                            </ul>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            name="password"
                            ref="password"
                            rules="required|customPassword"
                            v-slot="{ errors }"
                        >
                            <div class="form-group" style="margin-bottom:0px;">
                                <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register"><span class="text-danger">(*)</span>Mật khẩu</label>
                                <div class="input-group">                                
                                    <input :type="show ? 'password' : 'text'" class="form-control" name="password" v-model="userForm.password">
                                    <div class="input-group-addon" style="padding: 10px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                        <a @click="showPassword()">
                                            <i :class="show ?'fad fa-eye':'fas fa-eye-slash'" aria-hidden="true"></i>                                   
                                        </a>
                                    </div>
                                </div>
                                <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                    <li v-for="(error, index) in errors" :key="index">
                                    <span>{{ error }}</span>
                                    </li>
                                </ul>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            ref="confirm"
                            name="confirm"
                            rules="required|confirm:@password"
                            v-slot="{ errors }"
                        >
                            <div class="form-group" style="margin-bottom:0px;">
                                <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register"><span class="text-danger">(*)</span>Nhập lại mật khẩu</label>
                                <input :type="show ? 'password' : 'text'" class="form-control"  data-vv-rules="confirmed:password" v-model="userForm.password_confirmation" data-vv-as="password">
                                <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                    <li v-for="(error, index) in errors" :key="index">
                                    <span>{{ error }}</span>
                                    </li>
                                </ul>
                            </div>
                        </ValidationProvider>
                        <div class="form-check pl-0" style="margin-bottom:0px;">
                                <label for="agree-term" style="padding-bottom: 10px;" class="label-agree-term">Bằng việc nhấn nút đăng kí bạn đã đồng ý với <a href=""  class="term-service"><b>Thỏa thuận sử dụng</b></a> của Netbee.</label>
                            </div>
                        <div class="form-submit text-center" style="padding-bottom: 10px; margin-top:10px">
                            <button type="button" @click="signIn()" class="btn bg-netbee" style="font-weight: bold;width: 100%" >Đăng ký ngay</button>
                        </div>
                        </ValidationObserver>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</section>
</template>
<script>
import {
  ValidationProvider,
  extend
} from "vee-validate/dist/vee-validate.full";
import { ValidationObserver } from "vee-validate/dist/vee-validate.full";
// can customize default error messages
extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});
extend("email", {
  message: (field, values) => "Email không đúng định dạng"
});
extend("integer", {
  message: (field, values) => "Dữ liệu nhập vào phải là số"
});
// extend("min", {
//   params: ['target'],
//   validate(value, {target}){
//       return value === target
//   },
//   message: 'Giá trị nhỏ nhất phải là {target}'
// });
extend("alpha", {
  message: (field, values) => "Dữ liệu nhập vào phải là chữ."
});
extend("confirm", {
    params: ['target'],
    validate(value, { target }) {
        return value === target;
    },
    message: 'Mật khẩu nhập lại không khớp'
});

// create custom error message for custom rule
var errorMessage =
  " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 ký tự in hoa, 1 số và 1 ký tự đặc biệt(#!@$%^*-)";
// create custom rule
extend("customPassword", {
  message: field =>`Mật khẩu` + errorMessage,
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
          " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 số";
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
    ValidationObserver
  },
  data() {
    return {
      userForm: {
            name: "",
            email: "",
            phone: "",
            password: "",
            password_confirmation: "",
            role: 2
      },
      show: true,     
    };
  },
  computed: {},
  created() {},
  methods: {
    showPassword(){
      this.show = !this.show
    },
    async signIn() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        try {
            let response = await this.$axios.post('register',{
                email: this.userForm.email,
                password: this.userForm.password,
                name: this.userForm.name,
                phone: this.userForm.phone,
                role: this.userForm.role,              
            })
            if(response.data.status == 200){
                this.$swal({
                    title: 'Thành công',
                    text: response.data.message,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(async (result) => {
                    if (result.value) {
                        window.location.href = '/dang-ky/xac-thuc?username=' + this.userForm.name + '&email=' + this.userForm.email;
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
            this.$swal(
                'Lỗi',
                'Đăng ký thất bại',
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
  }
}
</script>
<style scoped>
.style-backrou{
  border-radius: 7px;
    background: hsla(0,0%,100%,.52157);
    margin-top: 50px;
    margin-bottom: 50px;
    padding: 25px;
}
.hero-wrap {
        width: 100%;
        height: 80px !important;
        position: inherit;
        background-color: #ffb701 !important;
    }
    .no-gutters {
        margin-right: 0;
        margin-left: 0;
        height: 80px !important;
    }
    .bg-dark.ftco-navbar-light.ftco_navbar.navbar.navbar-dark.navbar-expand-lg{
        top: 0;
    }
    .nav-link.dropdown-toggle{
        border: 1px solid #fff !important;
        border-radius: 3px !important;
        padding-top: 7px !important;
        padding-bottom: 7px !important;
        padding-left: 20px !important;
        padding-right: 20px !important;
    }
    .list{
        line-height: 40px;
        font-size: 20px;
    }
    .btn-outline-warning:hover {
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
    }
    label span{
        padding-right: 3px;
        font-size: 14px;
    }
    label{
        font-size: 15px;
    }
    ul{
        list-style: none;
        padding-left: 5px;
        padding-top: 5px;
    }
    .hero-wraps {
        width: 100%;
        /* height: 750px !important; */
        position: inherit;
        margin-top: 66px;
    }
    .bg-dark.ftco-navbar-light.ftco_navbar.navbar.navbar-dark.navbar-expand-lg{
        top: 0;
    }
    .nav-link.dropdown-toggle{
        border: 1px solid #fff !important;
        border-radius: 3px !important;
        padding-top: 7px !important;
        padding-bottom: 7px !important;
        padding-left: 20px !important;
        padding-right: 20px !important;
    }
    .round.stat{
        width: 23%;
        height: 145px;
        text-align: center;
        background-color: #fff!important;
        background-color: #ffb701;
        border: 3px solid #ffb701;
        color: #000;    
        float: left;
        margin-right: 12px;
    }
    .pricing-round {
        background-color: #fff!important;
    }
    .round.stat h4 {
        font-size: 25px !important;
    font-weight: 600;
    }

    .round.stat p {
        font-size: 16px !important;
    }
    p{
        color: #000;
    }
    .btn-outline-warning:hover {
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
    }
    label span{
        padding-right: 3px;
        font-size: 14px;
    }
    label{
        font-size: 15px;
    }
    ul li span{
      font-style: italic;
    }
</style>
    