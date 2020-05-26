<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper pb-2 mt-0" >
      <div class="content-header row"></div>
      <div class="content-body">
        <div class="col-xl-7 col-md-9 col-10 d-flex justify-content-center px-0" style="margin: 20px auto">
          <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
              <div class="col-lg-6 d-lg-block d-none text-center align-self-center">
                <img src="/app-assets/images/pages/forgot-password.png" alt="branding logo" />
              </div>
              <div class="col-lg-6 col-12 p-0">
                <div class="card rounded-0 mb-0 px-2 py-1">
                  <div class="card-header pb-1">
                    <div class="card-title">
                      <h4 class="mb-0">Quên Mật Khẩu</h4>
                    </div>
                  </div>
                  <p
                    class="px-2 mb-2"
                  >
                  Bạn quên mật khẩu? Đừng lo lắng! Cung cấp cho chúng tôi email được sử dụng để đăng ký tài khoản Netbee của bạn. 
                  <br/>Chúng tôi sẽ gửi cho bạn một liên kết để thiết lập lại mật khẩu của bạn.</p>
                  <div class="card-content">
                    <ValidationObserver ref="observer" v-slot="{ valid }">
                    <div class="card-body">
                      <form >
                        <div class="form-label-group">
                          <ValidationProvider
                              name="Email"
                              ref="email"
                              rules="required|email"
                              v-slot="{ errors }"
                          >
                          <input
                            type="email"
                            id="inputEmail"
                            class="form-control" style="margin-top: 5px"
                            placeholder="Email"
                            v-model="emailRecoverPassword"
                          />
                          <ul style="color:red" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                            <span>{{ error }}</span>
                            </li>
                        </ul>
                        </ValidationProvider>
                          <label style="color:black; font-size:15px; margin-bottom: 10px" for="inputEmail">Email</label>
                        </div>
                      </form>
                      <div class="float-md-left d-block mb-1">
                        <a
                          href="/dang-nhap"
                          class="btn btn-outline-primary btn-block px-75"
                        >Chuyển sang Login</a>
                      </div>
                      <div class="float-md-right d-block mb-1">
                        <button  @click="recoverPassword" class="btn btn-primary btn-block px-75" :class="{'not-allowed': ((emailRecoverPassword != '') ? flase : true)}" >Gửi Email</button>
                      </div>
                    </div>
                    </ValidationObserver>
                  </div>
                </div>
              </div>
            </div>
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
// can customize default error messages
extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});
extend("email", {
  message: (field, values) => "Email không đúng định dạng"
});
export default {
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data() {
    return {
      emailRecoverPassword: ""
    }
  },
  methods: {
    recoverPassword(){
      this.$axios.get('recoverPassword?email='+ this.emailRecoverPassword).then(response => {
        try {
          if(response.data.status == 200){
            window.location.href = 'nhap-ma-khoi-phuc?email='+ this.emailRecoverPassword;
          }
          else{
            this.$swal('Lỗi',response.data.message, 'warning')
          }
        } catch (Exception) {
          this.$swal('Lỗi', response.data.message, 'error')
        }
      })
    }
  }
};
</script>
<style>
.app-content.content {
  margin: -80px -333px 47px 250px;
}
a.btn.btn-primary.btn-block.px-75 {
  background-color: #ffb701 !important;
  color: black;
  font-weight: 200;
}
a.btn.btn-outline-primary.btn-block.px-75 {
  color: black;
  border-color: #ffb701 !important;
}
input#inputEmail {
  border-color: #ffb701 !important;
}
 .form-label-group>input:not(:active):not(:placeholder-shown)~label {
    color: rgba(34, 41, 47, 0.4) !important;
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    opacity: 1;
}
.form-label-group>input:not(:placeholder-shown)~label{
    padding: 0 10px 0 0;
    font-size: 0.7rem;
    top: -20px;
    left: 3px;
}
.btn-outline-primary:not(:disabled):not(.disabled):active{
    color: #FFFFFF;
    background-color: #ffb701;
    border-color: #ffb701;
}
.btn-outline-primary:hover {
    color: #FFFFFF;
    background-color: #ffb701;
    border-color: #ffb701;
}
ul{
        list-style: none;
        padding-left: 5px;
        padding-top: 5px;
}
ul li span{
  font-style: italic;
}
.not-allowed{
  opacity: 0.5;
}
.not-allowed:hover{
  cursor: not-allowed;
}
.btn-primary.disabled, .btn-primary:disabled {
    color: #FFFFFF;
    background-color: #ffb701 !important;
    border-color: #ffb701;
    opacity: 0.7;
}
.btn-primary {
    color: #FFFFFF;
    background-color: #ffb701 !important;
    border-color: #ffb701;
}
.app-content.content {
    margin: unset;
}
</style>