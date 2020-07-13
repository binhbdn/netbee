<template>
  <div>
      <section class="hero-wraps js-fullheight" v-lazy:background-image="`/assets/img/dk-NTD.png`" style="background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12" style="padding:100px 15px;">
                    <h3 style="color:black;"><b>Đăng ký chuyên viên tuyển sinh</b></h3>
                    <ul class="list">
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Tiếp cận đơn hàng trên toàn quốc hàng giờ</li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Tiếp cận tất cả các đơn hàng một cách đơn giản</li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Nhận tiền thưởng ngay lập tức khi giới thiệu thành công</li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Hoàn toàn bảo mật thông tin cá nhân</li>
                    </ul>
                </div>
                <div class="col-md-5 col-sm-12" style="padding:0px 15px;">
                  <div class="style-backrou">
                      <div class="text-center" style="background: #ffb701;padding:10px; margin-bottom:10px;">
                        <span style="color:#000; font-weight: bold;">ĐĂNG KÝ TÀI KHOẢN CHUYÊN VIÊN TUYỂN SINH</span>
                    </div>
                    <form method="POST" class="appointment-form" id="appointment-form-2" style="margin-top:10px;" v-on:keyup.enter="signIn">
                        <ValidationObserver ref="observer" v-slot="{ valid }">
                        <ValidationProvider
                            name="name"
                            ref="name"
                            rules="required"
                            v-slot="{ errors }"
                        >   
                        <div class="form-group" style="margin-bottom:0px;">
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register"><span class="text-danger">(*)</span>Họ & Tên</label>
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
                            rules="required|customPassword|min:8"
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
                            name="password_confirmation"
                            ref="password_confirmation"
                            rules="required|password_confirmation:@password"
                            v-slot="{ errors }"
                        >
                            <div class="form-group" style="margin-bottom:0px;">
                                <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register"><span class="text-danger">(*)</span>Nhập lại mật khẩu</label>
                                <input :type="show ? 'password' : 'text'" class="form-control" name="password_confirmation" v-model="userForm.password_confirmation" data-vv-as="password">
                                <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                    <li v-for="(error, index) in errors" :key="index">
                                    <span>{{ error }}</span>
                                    </li>
                                </ul>
                            </div>
                        </ValidationProvider>
                        <div class="form-group intro-code" style="margin-bottom:0px;">
                            <label for="exampleInputEmail1" style="margin-bottom: 5px;" class="text-register">Nhập mã giới thiệu (Nếu có)</label>
                            <input type="text" class="form-control" name="password_confirmation" v-model="userForm.intro_code" data-vv-as="password">
                        </div>
                        <!-- <div class="mb-1">
                          <span>Nếu bạn có mã giới thiệu, xin vui lòng đăng ký <a @click="introduce()"><b>Tại đây</b></a></span>
                        </div> -->
                        <div class="form-check pl-0 pt-1" style="margin-bottom:0px;">
                                <label for="agree-term" style="padding-bottom: 10px;" class="label-agree-term">Bằng việc nhấn nút đăng ký bạn đã đồng ý với <a href="" class="term-service"><b>Thỏa thuận sử dụng</b></a> của Netbee.</label>
                            </div>
                        <div class="form-submit text-center" style="padding-bottom: 10px; margin-top:10px">
                            <button type="button" @click="signIn()" class="btn bg-netbee" style="font-weight: bold;width: 100%">Đăng ký ngay</button>
                        </div>
                        </ValidationObserver>
                        <span>Nếu đã có tài khoản, xin vui lòng đăng nhập <a href="../dang-nhap"><b>Tại đây</b></a></span>
                    </form>
                  </div>               
                </div>
            </div>
        </div>
      </section>
      <section class="section">
        <div class="container">
          <div class="row">
              <div class="col-md-7">
                <h1 style="padding-bottom: 1rem; line-height: 1.4; font-size: 2.75rem; font-weight: 700">NetBee tặng ngay 1.000.000đ Phí Đăng ký tài khoản HR Freelance ngay trong tháng 7.</h1>
                <p style="padding: 0 0 1em 0;  font-size: 24px; line-height: 1.4;">Đăng ký ngay! tiếp cận 2000 jobs từ 800 công ty Công nghệ thông tin toàn quốc.</p>
                <p style="padding: 5px 0; font-size: 18px; line-height: 1.4;"><i class="fa fa-check-circle"></i> Không áp lực KPI</p>
                <p style="padding: 5px 0; font-size: 18px; line-height: 1.4;"><i class="fa fa-check-circle"></i> Làm việc tại nhà chống Corona</p>
                <p style="padding: 5px 0; font-size: 18px; line-height: 1.4;"><i class="fa fa-check-circle"></i> Cơ hội nhận Bonus tới 40 triệu đồng/ứng viên giới thiệu thành công.</p>
              </div>
              <div class="col-md-5">
                <img style="max-width: 100%" v-lazy = "`/assets/img/dk-CTV.png`" alt="Tuyển dụng NetBee">
              </div>
          </div>
        </div>
      </section>
      <section class="section">
        <div class="container">
          <h2 style="text-align: center; font-size: 2.5rem">VÌ SAO NÊN ĐĂNG KÝ HR FREELANCER TRÊN NETBEE.VN?</h2>
          <div class="row" style="padding-top: 80px">
              <div class="col-md-6">
                <div style="float: left;width: 80px;color: #FFB701">
                      <span class="img-item">
                      <img style="max-width: 100%" v-lazy = "`/assets/img/dk-CTV-07.png`">
                      </span>
                    </div>
                    <div class="text-item" style="float: left;width: calc(100% - 80px)">
                      <p class="content-1" style="line-height: 40px; margin: 20px;">Tiếp cận nặc danh </p>
                    </div>
                <ul class="ul" style="margin-top:6rem;">
                  <li>
                    <div>
                      <h5 class="content-text" style="color: #FFB701; font-size: 18px">Bảo mật</h5>
                      <p class="content-2">Tài khoản và thông tin của bạn hoàn toàn bí mật</p>
                    </div>
                  </li>
                  <li>
                    <div>
                      <h5 class="content-text" style="color: #FFB701; font-size: 18px">Người giới thiệu ẩn danh</h5>
                      <p class="content-2">Hashtag có thể được dùng để tìm kiếm dễ dàng hơn với từng chủ đề nhất định</p>
                    </div>
                  </li>
                  <li>
                      <div>
                        <h5 class="content-text" style="color: #FFB701; font-size: 18px">Thanh toán</h5>
                        <p class="content-2">Thanh toán qua tài khoản ngân hàng cá nhân</p>
                      </div>
                    </li>
                    <li>
                        <div>
                          <h5 class="content-text" style="color: #FFB701">Người bạn đồng hành tin cậy</h5>
                          <p class="content-2">Luôn luôn bên cạnh và thấu hiểu HR</p>
                        </div>
                      </li>
                </ul>
              </div>
              <div class="col-md-6">
                <img style="max-width: 100%; padding-top: 30px;" v-lazy = "`/assets/img/dk-CTV-02.png`" alt="Tuyển dụng NetBee">
              </div>
          </div>
        </div>
      </section>
      <section class="section">
        <div class="container">
          <div class="row">
              <div class="col-md-6">
                <img style="max-width: 100%; padding-top: 30px;" v-lazy = "`/assets/img/dk-CTV-03.png`" alt="Tuyển dụng NetBee">
              </div>
              <div class="col-md-6">
                <div style="float: left;width: 80px;color: #FFB701;padding-bottom: 30px;">
                  <span class="img-item">
                  <img  v-lazy = "`/assets/img/dk-CTV-08.png`" style="max-width: 100%">
                  </span>
                </div>
                <div class="text-item" style="float: left;width: calc(100% - 80px)">
                  <p class="content-1" style="line-height: 55px; margin: 15px;">Nguồn khách hàng đa dạng</p>
                </div>
                <ul class="ul" style="clear: both">
                  <li>
                    <div>
                      <h5 class="content-text" style="color: #FFB701; font-size: 18px">Khách hàng đa dạng</h5>
                      <p class="content-2">Với một nguồn khách hàng đa dạng khiến cho HR có thể thường xuyên thấy số lượng việc được cập nhật liên tục và thường xuyên</p>
                    </div>
                  </li>
                  <li>
                    <div>
                      <h5 class="content-text" style="color: #FFB701; font-size: 18px">Tối ưu CV</h5>
                      <p class="content-2">Tối ưu các CV mà HR đã khai thác được cho nhiều vị trí ở nhiều công ty</p>
                    </div>
                  </li>
                  <li>
                      <div>
                        <h5 class="content-text" style="color: #FFB701 font-size: 18px;">Cân bằng bonus</h5>
                        <p class="content-2">Luôn có sự so sánh mức bonus cũng như môi trường làm việc của Ứng viên</p>
                      </div>
                    </li>
                </ul>
              </div>
          </div>
        </div>
      </section>
      <section class="section">
        <div class="container" v-lazy:background-image="`/assets/img/hachinet-03-02.png`">
          <div class="row">
              <div class="col-md-6">
                <div style="float: left;width: 80px;color: #FFB701">
                  <span class="img-item">
                    <img  v-lazy = "`/assets/img/dk-CTV-09.png`" style="max-width: 100%">
                  </span>
                </div>
                <div class="text-item" style="float: left;width: calc(100% - 80px)">
                  <p class="content-1" style="margin: 15px;">Chủ động thời gian làm việc</p>
                </div>
                <ul class="ul" style="margin-top:6rem;">
                  <li>
                    <div>
                      <h5 class="content-text">Chủ động</h5>
                      <p class="content-2">Bạn có thể làm việc ở mọi lúc và mọi nơi</p>
                    </div>
                  </li>
                  <li>
                      <div>
                        <h5 class="content-text" style="color: #FFB701; font-size: 18px">Thoải mái</h5>
                        <p class="content-2">Không cần văn phòng và không cần máy tính</p>
                      </div>
                    </li>
                    <li>
                        <div>
                          <h5 class="content-text" style="color: #FFB701; font-size: 18px">Nguồn ứng viên tiềm năng</h5>
                          <p class="content-2">Bạn có thể làm việc dựa trên số ứng viên mà bạn khai thác được</p>
                        </div>
                      </li>
                  <li>
                    <div>
                      <h5 class="content-text" style="color: #FFB701;">Tiện lợi</h5>
                      <p class="content-2">Hoàn toàn không có KPI và luôn tiện lợi</p>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="col-md-6">
                <img style="max-width: 100%; padding-top: 20px;" v-lazy = "`/assets/img/dk-CTV-04.png`"  alt="Tuyển dụng NetBee">
              </div>
          </div>
        </div>
      </section>
      <section class="section">
        <div class="container">
          <div class="row">
              <div class="col-md-6">
                <img style="max-width: 100%; padding-top: 10px;" v-lazy = "`/assets/img/dk-CTV-05.png`" alt="Tuyển dụng NetBee">
              </div>
              <div class="col-md-6">
                <div style="float: left;width: 80px;color: #FFB701">
                      <span class="img-item">
                      <img v-lazy = "`/assets/img/dk-CTV-10.png`" style="max-width: 100%">
                      </span>
                    </div>
                    <div class="text-item" style="float: left;width: calc(100% - 80px)">
                <p class="content-1" style="line-height: 40px; margin-left: 15px">Minh bạch trong thanh toán và thu nhập của tất cả HR</p>
                    </div>
                <ul class="ul">
                  <li>
                    <div>
                      <h5 class="content-text" style="color: #FFB701">Rõ ràng</h5>
                      <p class="content-2">Khi ứng viên pv thành công và đi làm sau 5 ngày , bạn có thể yêu cầu khách hàng xác nhận đơn hàng , và bạn sẽ được thanh toán ngay lập tức.</p>
                    </div>
                  </li>
                  <li>
                    <div>
                      <h5 class="content-text" style="color: #FFB701;">Minh bạch</h5>
                      <p class="content-2">Mọi thanh toán đều ghi lại lịch sử và minh bạch quản lý để bạn có thể nắm bắt thông tin chính xác</p>
                    </div>
                  </li>
                </ul>
              </div>
          </div>
        </div>
      </section>
      <section class="section">
        <div class="container" v-lazy:background-image="`/assets/img/hachinet-03-02.png`">
          <h2 style="text-align: center; font-size: 2.5rem; font-weight: 700">CÁC BƯỚC ĐĂNG KÝ HR FREELANCER TRÊN NETBEE.VN?</h2>
          <div class="row" style="padding-top: 40px">
              <div class="col-md-6">
                <ul>
                  <li style="list-style-type: none; margin-bottom: 15px;">
                    <div style="float: left;">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </div>
                    <div style="display: inline-block;margin-left: 10px;">
                      <h3>Đăng ký HR</h3>
                      <p style="font-size: 20px;">Truy cập trang đăng ký HR</p>
                    </div>
                  </li>
                  <li style="list-style-type: none; margin-bottom: 15px;">
                    <div style="float: left;">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </div>
                    <div style="display: inline-block;margin-left: 10px;">
                      <h3>Điền thông tin</h3>
                      <p style="font-size: 20px;">Điền thông tin đầy đủ</p>
                    </div>
                  </li>
                  <li style="list-style-type: none;">
                    <div style="float: left;">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </div>
                    <div style="display: inline-block;margin-left: 10px;">
                      <h3>Check mail</h3>
                      <p style="font-size: 20px;">Truy cập mail xác nhận tài khoản</p>
                    </div>
                  </li>
                </ul>
                <a href="#regregion" type="button" class="btn btn-default register" style="margin-left: 40px; background: linear-gradient(to right, #e68a00 0%, #FFB701 100%);">ĐĂNG KÝ NGAY</a>
              </div>
              <div class="col-md-6">
                <img style="max-width: 100%; padding-top: 30px;" v-lazy = "`/assets/img/dk-CTV-06.png`" alt="Tuyển dụng NetBee">
              </div>
          </div>
        </div>
      </section>
  </div>
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
extend('password_confirmation', {
  params: ['target'],
  validate(value,{target}) {
    return value === target;
  },
  message: 'Mật khẩu nhập vào không khớp'
});

// create custom error message for custom rule
var errorMessage =
  " phải chứa ít nhất 8 ký tự";
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
        intro_code: "",
        role: 3
     },
     show: true,
     statust: 0
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
    },
    async checkbox(){
      this.checkbox = !this.checkbox;
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
    .intro-code input {
      /* width: 50%; */
    }

    .section{
      padding-top: 100px
    }
    .content-1{
      font-size: 30px;
      color: #5c5c3d;
    }
    .content-text{
      color: #FFB701;
      font-size: 18px;
    }
    .ul{
      list-style-type: disc;
      padding-left: 3rem
    }
    .glyphicon{
      position: relative;
      top: 1px;
      display: inline-block;
      font-family: 'Glyphicons Halflings';
      font-style: normal;
      font-weight: 400;
      line-height: 1;
      -webkit-font-smoothing: antialiased;
    }
    .section:last-child{
      padding-bottom: 100px;
    }
</style>