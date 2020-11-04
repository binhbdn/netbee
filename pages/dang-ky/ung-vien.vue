<template>
    <section class="hero-wraps js-fullheight" style="background-size: cover;" v-lazy:background-image="`/assets/img/dk-NTD.png`">
    <div class="container">
        <div class="row ">
            <div class="col-md-7 col-sm-12 content-left  pt-4">
                <h3 style="color:black;"><b>Đăng ký ứng viên</b></h3>
                <ul class="list">
                    <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Tiếp cận hàng triệu công việc hoàn toàn miễn phí</li>
                    <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Ứng tuyển nhanh chóng, dễ dàng</li>
                    <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Nhận bản tin công việc phù hợp định kỳ</li>
                    <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Nâng cao cơ hội tìm việc với chương trình ứng viên năng động</li>
                </ul>
                <div class="col-md-9" style="padding: 0">
                      <div class="hotline">
                        <a href="tel:02462900388">
                              Hotline hỗ trợ (024) 629 00 388
                        </a>
                      </div>
                    </div>
            </div>      
                        <div class="col-md-5 col-sm-12 content-right" style="padding:0px 15px;">
              <div class="style-backrou">
                <div class="text-center" style="background: #ffb701;padding:10px; margin-bottom:10px;">
                    <span style="color:#000; font-weight: bold;">ĐĂNG KÝ ỨNG VIÊN</span>
                </div>
               <form method="POST" class="appointment-form" id="appointment-form-2" style="margin-top:10px;" v-on:keyup.enter="signIn">
                    <ValidationObserver ref="observer" v-slot="{ valid }">
                     <ValidationProvider
                        name="Họ và tên"
                        ref="name"
                        rules="required"
                        v-slot="{ errors }"
                    >   
                    <div class="form-group" style="margin-bottom:0px;">
                        <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Họ & Tên (<span style="color: red;">*</span>)</label>
                        <input type="text" class="form-control" name="name" v-model="userForm.name">
                        <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
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
                        <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Email (<span style="color: red;">*</span>)</label>
                        <input type="email" class="form-control" name="email" v-model="userForm.email">
                        <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                            <span>{{ error }}</span>
                            </li>
                        </ul>
                    </div>
                    </ValidationProvider>
                    <ValidationProvider
                        rules="required|integer|length:10"
                        ref="phone"
                        name="Số điện thoại"
                        v-slot="{ errors }"
                    >
                        <div class="form-group" style="margin-bottom:0px;">
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Số điện thoại (<span style="color: red;">*</span>)</label>
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
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Mật khẩu (<span style="color: red;">*</span>)</label>
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
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Nhập lại mật khẩu (<span style="color: red;">*</span>)</label>
                            <input :type="show ? 'password' : 'text'" class="form-control"  data-vv-rules="confirmed:password" v-model="userForm.password_confirmation" data-vv-as="password">                             
                            <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
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
                    <hr>
                        <a @click="loginfb()" class="btn btn-outline-info fb col-md-12 mt-1" >
                            <i class="fab fa-facebook login-gg-fa"></i> Đăng nhập bằng Facebook
                        </a>
                        <a @click="logingg()" class="btn btn-outline-info gg col-md-12 mb-1" style="margin-top: 15px;">
                            <img class="login-gg-fa" src="/assets/img/logo-google.png"> Đăng nhập bằng Google
                        </a>
                    <span>Nếu đã có tài khoản, xin vui lòng đăng nhập <a href="../dang-nhap"><b>Tại đây</b></a></span>
                </form>
              </div>                           
            </div>      
        </div>
        <!-- ma gioi thieu -->
        <div class="modal fade" id="introduce" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mã giới thiệu của bạn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input id="introduceValue" placeholder="Mời nhập mã" type="text" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <a @click="ktintroduce()" class="btn bg-netbee">Đăng ký</a>
              </div>
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
extend("length", {
  message: (field, values) => "Số điện thoại phải gồm 10 chữ số"
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
      statust: 0, 
      introduce_code: "",
    };
  },
  computed: {},
  created() {},
  methods: {
    introduce(){   
      $('#introduce').modal()
      $("#introduce").modal('show')
    },
     loginfb() {
        this.$auth.loginWith('facebook')
    },
    logingg() {
        this.$auth.loginWith('google')
    },
    showPassword(){
      this.show = !this.show
    },
    async ktintroduce() {
      var valueIntro = document.getElementById('introduceValue').value      
      this.introduce_code = valueIntro      
      let response = await this.$axios.post('ktintroduce', {
             introduce_code: this.introduce_code
      });
      if(response.data.status == 200){
        window.location.href = "/dang-ky/ung_vien/"+this.introduce_code
      }else{
        this.$swal(
          'Lỗi!',
          response.data.message,
          'error'
        )
      }
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
            statust: this.statust        
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
  }
}
</script>
<style scoped>
.hotline{
  border: 1px solid #1e1e1e;
  border-radius: 3px;
  padding: 15px;
  text-align: center;
  font-size: 18px;
  background: hsla(0,0%,100%,.72157);
  margin-top: 15px;
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
.gg {
    padding: 12px !important;
}
.fb {
    padding: 12px !important;
}
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
    .content-left{
      padding-top: 90px !important;
    }
    @media (max-width: 767px){
      .style-backrou{
        margin-top: 20px;
        margin-bottom: 20px;
      }
      .content-right{
        order: 1;
      }
      .content-left{
        order: 2;
        padding-top: 30px !important;
      }
    }
</style>