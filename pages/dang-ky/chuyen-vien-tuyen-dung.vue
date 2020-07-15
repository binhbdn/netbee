<template>
  <div>
      <section class="hero-wraps js-fullheight section-1" v-lazy:background-image="`/assets/img/dk-NTD.png`" style="background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 content-right">
                    <h3 style="color:black;"><b>Đăng ký chuyên viên tuyển sinh</b></h3>
                    <ul class="list">
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Tiếp cận đơn tuyển sinh trên toàn quốc hàng giờ.</li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Làm việc ở bất kỳ đâu với Laptop hoặc điện thoại.</li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Nhận tiền thưởng ngay lập tức khi giới thiệu thành công</li>
                        <li style="font-size: 15px;color:black;"><i class="fad fa-check-circle"></i> Hoàn toàn bảo mật thông tin cá nhân</li>
                    </ul>
                    <div class="col-md-9" style="padding: 0">
                      <div class="hotline">
                        <a href="tel:02462900388">
                              Hotline hỗ trợ (024) 629 00 388
                        </a>
                      </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12 content-left">
                  <div class="style-backrou">
                      <div class="text-center" style="background: #ffb701;padding:10px; margin-bottom:10px;">
                        <span style="color:#000; font-weight: bold;">ĐĂNG KÝ CHUYÊN VIÊN TUYỂN SINH</span>
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
      <section class="section-2">
        <div class="container">
          <div class="row mb-responsive">
              <div class="col-md-8 content-left">
                <h1>Tặng 1.000.000đ phí tạo tài khoản.</h1>
                <p>Miễn phí phí tạo tài khoản và phí duy trì tài khoản đến 31/08/2020.</p>
                <p><i class="fa fa-check-circle"></i> Không áp lực KPI</p>
                <p><i class="fa fa-check-circle"></i> Làm việc tại nhà chống Corona</p>
                <p><i class="fa fa-check-circle"></i> Cơ hội nhận hoa hồng lên tới 40 triệu đồng.</p>
              </div>
              <div class="col-md-4 content-right">
                <img class="img" v-lazy = "`/assets/img/dk-CTV.png`" alt="Tuyển dụng NetBee">
              </div>
          </div>
        </div>
      </section>
      <section class="section-3">
        <div class="container">
          <h2>VÌ SAO NÊN ĐĂNG KÝ CỘNG TÁC VIÊN TUYỂN SINH TRÊN NETBEE.VN?</h2>
          <div class="row mb-responsive">
              <div class="col-md-7 content-left">
                <div class="title">
                  <div  class="img-item">
                    <span>
                      <img class="img img-icon" v-lazy = "`/assets/img/dk-CTV-07.png`">
                    </span>
                  </div>
                  <div class="text-item">
                    <p class="content-1">Bảo mật thông tin cá nhân</p>
                  </div>
                </div>
                <div class="description">
                  <ul class="ul">
                    <li>
                      <div>
                        <h5 class="content-text">Bảo mật</h5>
                        <p class="content-2">Tài khoản và thông tin của bạn hoàn toàn bí mật</p>
                      </div>
                    </li>
                    <li>
                      <div>
                        <h5 class="content-text">Cập nhật liên tục</h5>
                        <p class="content-2">Các đơn hàng của các công ty được cập nhật đăng ký liên tục.</p>
                      </div>
                    </li>
                    <li>
                        <div>
                          <h5 class="content-text">Thanh toán</h5>
                          <p class="content-2">Thanh toán qua tài khoản ngân hàng cá nhân</p>
                        </div>
                    </li>
                    <li>
                        <div>
                          <h5 class="content-text">Người bạn đồng hành tin cậy</h5>
                          <p class="content-2">Kết nối an toàn và minh bạch.</p>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-5 content-right">
                <img class="img" v-lazy = "`/assets/img/dk-CTV-02.png`" alt="Tuyển dụng NetBee">
              </div>
          </div>
        </div>
      </section>
      <section class="section-4">
        <div class="container">
          <div class="row mb-responsive">
              <div class="col-md-6 content-right">
                <img class="img" v-lazy = "`/assets/img/dk-CTV-03.png`" alt="Tuyển dụng NetBee">
              </div>
              <div class="col-md-6 content-left">
                <div class="title">
                  <div class="img-item">
                    <span>
                      <img class="img img-icon" v-lazy = "`/assets/img/dk-CTV-08.png`">
                    </span>
                  </div>
                  <div class="text-item">
                    <p class="content-1">Nguồn khách hàng đa dạng</p>
                  </div>
                </div>
                <div class="description">
                  <ul class="ul">
                    <li>
                      <div>
                        <h5 class="content-text">Khách hàng đa dạng</h5>
                        <p class="content-2">Netbee.vn là đối tác tin cậy của hơn 100 công ty Du học,XKLD trên toàn quốc có giấy phép uy tion của bộ thương binh và xã hội.</p>
                      </div>
                    </li>
                    <li>
                      <div>
                        <h5 class="content-text">Nhiều lựa chọn</h5>
                        <p class="content-2">Sẽ là các lựa chọn tối ưu phù hợp nhất với từng cá nhân ứng viên, khi phù hợp với chi phí và văn hóa cũng như mong muốn của người đi.</p>
                      </div>
                    </li>
                    <li>
                        <div>
                          <h5 class="content-text">Tối ưu chi phí</h5>
                          <p class="content-2">Netbee.vn đưa công nghệ là giải pháp để kết nối nhanh nhất là cầu nối cho trường học,doanh nghiệp và CTV.</p>
                        </div>
                      </li>
                  </ul>
                </div>
              </div>
          </div>
        </div>
      </section>
      <section class="section-5">
        <div class="container" v-lazy:background-image="`/assets/img/hachinet-03-02.png`">
          <div class="row mb-responsive">
              <div class="col-md-6 content-left">
                <div class="title"> 
                  <div class="img-item">
                    <span>
                      <img class="img img-icon" v-lazy = "`/assets/img/dk-CTV-09.png`">
                    </span>
                  </div>
                  <div class="text-item">
                    <p class="content-1">Chủ động thời gian làm việc</p>
                  </div>
                </div>
                <div class="descripton">
                  <ul class="ul">
                    <li>
                      <div>
                        <h5 class="content-text">Chủ động</h5>
                        <p class="content-2">Bạn có thể làm việc ở mọi lúc và mọi nơi</p>
                      </div>
                    </li>
                    <li>
                        <div>
                          <h5 class="content-text">Thoải mái</h5>
                          <p class="content-2">Không cần văn phòng và không cần máy tính</p>
                        </div>
                      </li>
                      <li>
                          <div>
                            <h5 class="content-text">Nguồn ứng viên tiềm năng</h5>
                            <p class="content-2">Bạn có thể làm việc dựa trên số ứng viên mà bạn khai thác được</p>
                          </div>
                        </li>
                    <li>
                      <div>
                        <h5 class="content-text">Tiện lợi</h5>
                        <p class="content-2">Không áp lực doanh số và luôn tiện lợi</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 content-right">
                <img class="img" v-lazy = "`/assets/img/dk-CTV-04.png`"  alt="Tuyển dụng NetBee">
              </div>
          </div>
        </div>
      </section>
      <section class="section-6">
        <div class="container">
          <div class="row mb-responsive">
              <div class="col-md-5 content-right">
                <img class="img" v-lazy = "`/assets/img/dk-CTV-05.png`" alt="Tuyển dụng NetBee">
              </div>
              <div class="col-md-7 content-left">
                <div class="title">
                  <div class="img-item">
                    <span>
                      <img class="img img-icon" v-lazy = "`/assets/img/dk-CTV-10.png`">
                    </span>
                  </div>
                  <div class="text-item">
                    <p class="content-1">Minh bạch trong thanh toán và thu nhập</p>
                  </div>
                </div>
                <div class="description">
                  <ul class="ul">
                    <li>
                      <div>
                        <h5 class="content-text">Nhanh chóng</h5>
                        <p class="content-2">Khi ứng viên pv thành công có COE , bạn có thể yêu cầu khách hàng xác nhận đơn hàng , và bạn sẽ được thanh toán ngay lập tức.</p>
                      </div>
                    </li>
                    <li>
                      <div>
                        <h5 class="content-text">Minh bạch</h5>
                        <p class="content-2">Mọi thanh toán đều ghi lại lịch sử và minh bạch quản lý để bạn có thể nắm bắt thông tin chính xác</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
          </div>
        </div>
      </section>
      <section class="section-7">
        <div class="container" v-lazy:background-image="`/assets/img/hachinet-03-02.png`">
          <h2>CÁC BƯỚC ĐĂNG KÝ CỘNG TÁC VIÊN TRÊN NETBEE.VN?</h2>
          <div class="row mb-responsive">
              <div class="col-md-6 content-left">
                <ul>
                  <li>
                    <div style="float: left;">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </div>
                    <div class="inline-block">
                      <h3>Đăng ký CTV Tuyển sinh</h3>
                      <p>Truy cập trang đăng ký CTV</p>
                    </div>
                  </li>
                  <li>
                    <div style="float: left;">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </div>
                    <div class="inline-block">
                      <h3>Điền thông tin</h3>
                      <p>Điền thông tin cá nhân</p>
                    </div>
                  </li>
                  <li>
                    <div style="float: left;">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </div>
                    <div class="inline-block">
                      <h3>Xác nhận qua email</h3>
                      <p>Truy cập mail xác nhận tài khoản</p>
                    </div>
                  </li>
                </ul>
                <a href="#" type="button" class="btn btn-default register">ĐĂNG KÝ NGAY</a>
              </div>
              <div class="col-md-6 content-right">
                <img class="img" v-lazy = "`/assets/img/dk-CTV-06.png`" alt="Tuyển dụng NetBee">
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

section{
  padding-top: 70px
}
.hero-wraps{
  padding-top: 0;
}
h1{
  line-height: 1.4;
  font-size: 2.75rem;
  font-weight: 700
}
h2{
  text-align: center;
  font-size: 2.5rem;
  font-weight: 700;
  padding-bottom: 50px
}
.content-1{
  line-height: 40px;
  margin: 15px;
  font-size: 30px;
  color: #5c5c3d;
}
.content-text{
  color: #000;
  font-size: 18px;
}
.ul{
  list-style-type: disc;
  padding-top: 0.5rem;
  padding-left: 1.5rem;
  clear: both;
}
.img{
  max-width: 100%;
}
.content-left .title div{
  float: left;
}
.content-left .title .img-item{
  width: 80px;
  color: #FFB701
}
.content-left .title .text-item{
  width: calc(100% - 80px);
}
.hotline{
  border: 1px solid #1e1e1e;
  border-radius: 3px;
  padding: 15px;
  text-align: center;
  font-size: 18px;
  background: hsla(0,0%,100%,.72157);
  margin-top: 15px;
}
.section-1 .content-left{
  padding: 0px 15px;
}
.section-1 .content-left p:first-child{
  padding: 0 0 1em 0;
  font-size: 24px;
}
.section-1 .content-right{
  padding: 50px 15px;
}
.section-2 .content-left p{
  padding: 5px 0;
  font-size: 18px;
  line-height: 1.4
}
.section-4 .content-right .img{
  padding-top: 25px;
}
.section-6 .title .text-item .content-1{
  margin: 0 15px;
}
.section-7 .content-left ul li{
  margin-bottom: 15px;
}
.section-7 .content-left ul li div:first-child{
  float: left;
}
.section-7 .content-left ul li .inline-block{
  display: inline-block;
}
.section-7 h3{
  font-size: 1.5rem;
  font-weight: 700;
}
.section-7 .content-left{
  padding-left: 3rem;
}
.section-7{
  padding-bottom: 100px;
}
.section-7 .register{
    background: #FFB701;
    color: #000;
}
.section-7 .register:hover{
    color: #ffffff;
}
.section-7 .inline-block p{
  font-size: 18px;
}
.section-7 .content-right .img, .section-6 .content-right .img{
  padding-top: 0;
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
  padding-right: 10px;
}
.glyphicon::before{
  content: "\270f";
}
@media (max-width: 1199px){
  section{
    padding-top: 50px;
  }
  .content-1{
    line-height: 25px;
    font-size: 25px;
    margin: 10px;
  }
  .content-left .title .img-item{
  width: 60px;
  }
  h1{
    line-height: 1.4;
    font-size: 2rem;
    font-weight: 700
  }
  .section-4 .content-right .img{
    padding-top: 15px;
  }
  .section-7 .content-right .img{
    padding-top: 0px
  }
  .section-7 .inline-block h3{
    font-size: 18px
  }
  .section-7 .inline-block p{
    font-size: 16px;
  }
  .section-7 .content-left ul li{
  margin-bottom: 10px;
}
  h2{
    font-size: 2rem;
  }
}

@media (max-width: 991px){
  .section-6 .content-1{
    margin: 0 10px;
  }
}
@media (max-width: 767px){
  section{
    padding-top: 30px;
  }
  .content-left{
    order: 1;
  }
  .content-right{
    order: 2;
  }
  h2{
    padding-bottom: 20px;
    font-size: 1.75rem
  }
  .content-1{
    line-height: 22px;
    font-size: 22px;
    margin: 5px;
  }
  .section-1 .content-left{
    padding: 20px 15px;
    line-height: 20px;
  }
  .section-1 .content-left ul{
    line-height: 25px;
  }
  .section-1 .style-backrou{
    margin: 0;
  }
  .section-1 .content-left p:first-child{
    padding: 0 0 0.5rem 0;
    font-size: 20px;
  }
  .section-1 .content-left h1{
    font-size: 1.75rem;
  }
  .section-1 .content-right{
    padding: 20px 15px;
  }
  .section-2 .content-left p{
    padding: 0;
  }
  .section-7 .content-left{
    padding-left: 2rem;
    padding-bottom: 30px;
  }
  .section-7 .register{
    display: block;
    margin: auto;
    text-align: center;
  }
  section:last-child{
    padding-bottom: 50px;
  }
}
</style>