<template>
    <section class="hero-wraps js-fullheight" style="background-size: cover;" v-lazy:background-image="`/assets/img/dk-NTD.png`">
    <div class="container">
        <div class="row ">
            <div class="col-7 pt-4" style="padding-top: 90px !important;">
                <h3 style="color:black;"><b>Đăng ký ứng viên</b></h3>
                <ul class="list">
                    <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Tiếp cận hàng triệu công việc hoàn toàn miễn phí</li>
                    <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Ứng tuyển nhanh chóng, dễ dàng</li>
                    <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Nhận bản tin công việc phù hợp định kỳ</li>
                    <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Nâng cao cơ hội tìm việc với chương trình ứng viên năng động</li>
                </ul>
            </div>
            <div class="col-5" style="padding:0px 15px;">
              <div class="style-backrou">
                <div class="text-center" style="background: #ffb701;padding:10px; margin-bottom:10px;">
                    <span style="color:#000; font-weight: bold;">ĐĂNG KÝ TÀI KHOẢN ỨNG VIÊN</span>
                </div>
                <span>Nếu đã có tài khoản, xin vui lòng đăng nhập <a href="../../dang-nhap"><b>Tại đây</b></a></span>
               <form method="POST" class="appointment-form" id="appointment-form-2" style="margin-top:10px;" v-on:keyup.enter="signIn">
                    <ValidationObserver ref="observer" v-slot="{ valid }">
                     <ValidationProvider
                        name="Họ và tên"
                        ref="name"
                        rules="required"
                        v-slot="{ errors }"
                    >   
                    <div class="form-group" style="margin-bottom:0px;">
                        <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Họ & Tên (<span style="color: red; font-size: 20px;">*</span>)</label>
                        <input type="text" class="form-control" name="name" v-model="userForm.name">
                        <ul style="color:red" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                            <span>{{ error }}</span>
                            </li>
                        </ul>
                    </div>
                    </ValidationProvider>
                    <ValidationProvider
                        name="Email"
                        ref="email"
                        rules="required|email"
                        v-slot="{ errors }"
                    >
                    <div class="form-group" style="margin-bottom:0px;">
                        <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Email (<span style="color: red; font-size: 20px;">*</span>)</label>
                        <input type="email" class="form-control" name="email" v-model="userForm.email">
                        <ul style="color:red" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                            <span>{{ error }}</span>
                            </li>
                        </ul>
                    </div>
                    </ValidationProvider>
                    <ValidationProvider
                        rules="required|integer"
                        ref="phone"
                        name="Số điện thoại"
                        v-slot="{ errors }"
                    >
                        <div class="form-group" style="margin-bottom:0px;">
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Số điện thoại (<span style="color: red; font-size: 20px;">*</span>)</label>
                            <input type="number" class="form-control" name="phone" v-model="userForm.phone">
                            <ul style="color:red" class="overline text-left">
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
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Mật khẩu (<span style="color: red; font-size: 20px;">*</span>)</label>
                            <div class="input-group">
                              <input :type="show ? 'password' : 'text'" class="form-control" name="password" v-model="userForm.password">
                              <div class="input-group-addon" style="padding: 10px;">
                                  <a @click="showPassword()">
                                    <i :class="show ?'fad fa-eye':'fas fa-eye-slash'" aria-hidden="true"></i>                                   
                                  </a>
                              </div>
                            </div>                            
                            <ul style="color:red" class="overline text-left">
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
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Nhập lại mật khẩu (<span style="color: red; font-size: 20px;">*</span>)</label>
                            <input :type="show ? 'password' : 'text'" class="form-control"  data-vv-rules="confirmed:password" v-model="userForm.password_confirmation" data-vv-as="password">                             
                            <ul style="color:red" class="overline text-left">
                                <li v-for="(error, index) in errors" :key="index">
                                <span>{{ error }}</span>
                                </li>
                            </ul>
                        </div>
                    </ValidationProvider>
                        <div class="form-check pl-0" style="margin-bottom:0px;">
                            <label for="agree-term" style="padding-bottom: 10px;" class="label-agree-term">Bằng việc nhấn nút đăng ký bạn đã đồng ý với <a href=""  class="term-service"><b>Thỏa thuận sử dụng</b></a> của Netbee.</label>
                        </div>
                    <div class="form-submit text-center" style="padding-bottom: 10px; margin-top:10px">
                        <button type="button" @click="signIn()" class="btn bg-netbee" style="font-weight: bold;width: 100%">Đăng ký ngay</button>
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
extend("min", {
  message: (field, values) => "Dữ liệu nhập vào ít nhất" + `${values}`
});
extend("alpha", {
  message: (field, values) => "Dữ liệu nhập vào phải là chữ."
});
extend('confirm', {
  params: ['target'],
  validate(value, { target }) {
    return value === target;
  },
  message: 'Mật khẩu nhập lại không khớp'
});

// create custom error message for custom rule
var errorMessage =
  " phải chứa ít nhất 8 ký tự";
// create custom rule
extend("customPassword", {
  // message: field =>`${field}` + errorMessage,
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
          " phải chứa ít nhất 8 ký tự";
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
        role: 1,        
      },
      show: true,
      statust: 1,
      introduceOk:''
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
          let response = await this.$axios.post('register', {
            email: this.userForm.email,
            password: this.userForm.password,
            name: this.userForm.name,
            phone: this.userForm.phone,
            role: this.userForm.role,
            statust: this.statust,
            introduceOk: this.introduceOk
          });
          if(response.data.status == 200){
            this.$swal({
              titile: 'Thành công',
              text: response.data.message,
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK',
            }).then( async (result) => {
              let response = await this.$auth.loginWith('local',{ data: this.userForm });
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
    }
  },
   mounted() {   
       this.introduceOk = this.$route.params.introduce       
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
    .hero-wraps {
        width: 100%;
        /* height: 700px !important; */
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
    ul li span{
      font-style: italic;
    }
</style>