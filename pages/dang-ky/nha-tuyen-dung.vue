<template>
    <section class="hero-wraps js-fullheight" style="margin-top:100px">
    <div class="container">
        <div class="row ">
            <div class="col-7" style="padding:0px 15px;">
                <div style="font-size: 24px;">
                    <span style="margin-right: 190px;">Đăng tin tuyển dụng</span>
                    <span>Tìm kiếm ứng viên</span>
                </div>
                <div style="margin-top: 3.5rem">
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
                <div style="margin-top: 16em !important;    line-height: 40px;">
                    <ul>
                        <li>+3,000 ứng viên tiếp cận thông tin tuyển dụng</li>
                        <li>Hơn 20 hồ sơ ứng tuyển cho 1 việc làm đăng tuyển tại Netbee</li>
                        <li>Tăng hiệu quả 4 - 5 lần so với các phương thức tuyển dụng khác</li>
                        <li>+2,000 lượt xem trung bình cho 1 việc làm</li>
                    </ul>
                </div>
            </div>
            <div class="col-5" style="padding:0px 15px; ">
                <div class="text-center" style="background: #ffb701;padding:10px;margin-bottom:10px;">
                    <span style="color:#000; font-weight: bold;">ĐĂNG KÝ TÀI KHOẢN NHÀ TUYỂN DỤNG</span>
                </div>
                <span>Nếu đã có tài khoản, xin vui lòng đăng nhập <a href="#">Tại đây</a></span>
               <form method="POST" class="appointment-form" id="appointment-form-2" style="margin-top:10px;">
                    <ValidationObserver ref="observer" v-slot="{ valid }">
                     <ValidationProvider
                        name="Họ và tên"
                        ref="name"
                        rules="required|alpha|max:20"
                        v-slot="{ errors }"
                    >   
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Tên công ty</label>
                        <input type="text" class="form-control" name="name" v-model="name">
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
                        rules="required|email|max:20"
                        v-slot="{ errors }"
                    >
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Email</label>
                        <input type="email" class="form-control" name="email" v-model="email">
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
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" v-model="phone">
                            <ul style="color:red" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                            <span>{{ error }}</span>
                            </li>
                        </ul>
                        </div>
                    </ValidationProvider>
                    <ValidationProvider
                        name="Mật khẩu"
                        ref="password"
                        rules="required|customPassword|min:8"
                        v-slot="{ errors }"
                    >
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Mật khẩu</label>
                            <input type="password" class="form-control" name="password" v-model="password">
                            <ul style="color:red" class="overline text-left">
                                <li v-for="(error, index) in errors" :key="index">
                                <span>{{ error }}</span>
                                </li>
                            </ul>
                        </div>
                    </ValidationProvider>
                    <ValidationProvider
                        name="Nhập lại mật khẩu"
                        ref="password_confirmation"
                        rules="required|"
                        v-slot="{ errors }"
                    >
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="password_confirmation" v-model="password_confirmation" data-vv-as="password">
                            <ul style="color:red" class="overline text-left">
                                <li v-for="(error, index) in errors" :key="index">
                                <span>{{ error }}</span>
                                </li>
                            </ul>
                        </div>
                    </ValidationProvider>
                    <ValidationProvider
                        rules = "required"
                        name = "Đồng ý"
                        ref="agree-term"
                    >
                        <div class="form-check" style="margin-bottom:0px;">
                            <input disabled type="checkbox"  name="agree-term" id="agree-term" class="agree-term" v-model="checkbox"/>
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>Tôi đồng ý với các  <a href="" class="term-service text-dark">điều khoản</a></label>
                        </div>
                    </ValidationProvider>
                    <div class="form-submit text-center" style="padding-bottom: 10px; margin-top:10px">
                        <input @click="signIn()" type="button" name="submit" id="submit" class="btn btn-outline-warning" style="font-weight: bold;" value="Đăng ký ngay" />
                    </div>
                    </ValidationObserver>
                </form>
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
  message: (field, values) => `${field}` + " không được để trống.",
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

// create custom error message for custom rule
var errorMessage =
  " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 ký tự in hoa, 1 số và 1 ký tự đặc biệt(#!@$%^*-)";
// create custom rule
extend("customPassword", {
  message: field =>`${field}` + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s]/;
    var mustContainTheseChars = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#!@$%^*-]).{8,}$/;
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
          " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 ký tự in hoa, 1 số và 1 ký tự đặc biệt(#!@$%^*-)";
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
      name: "",
      email: "",
      phone: "",
      password: "",
      password_confirmation: "",
      checkbox: true
    };
  },
  computed: {},
  created() {},
  methods: {
    async signIn() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        console.log("is valid");
        console.log(this.name + " signed in with password " + this.password);
        // reset fields
        this.name = "";
        this.password = "";
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
        height: 750px !important;
        position: inherit;
        margin-top: 40px;
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
        background-color: #ffb701;
        float: left;
        margin-right: 12px;
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
</style>
    