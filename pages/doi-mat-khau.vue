<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper pb-2 mt-0" >
      <div class="content-body p-2">
        <div class="col-xl-7 col-md-9 col-10 d-flex justify-content-center px-0" style="margin: 20px auto">
          <div class="card bg-authentication rounded-0 mb-0 p-2" style="width: 700px">
            <div class="row mt-1 ml-1">
            <h4>Chọn mật khẩu mới</h4>
            </div>
            <hr>
            <p class="px-2 mb-2">Tạo mật khẩu mới có tối thiểu 8 ký tự. Mật khẩu mạnh là mật khẩu được kết hợp từ các ký tự, số và dấu câu.</p>
            <div class="row m-0">
              <div class="col-lg-8 d-lg-block d-none text-left align-self-center">
                <div class="card rounded-0 mb-0" style="margin-bottom: 8px">
                  
                  <div class="card-content">
                    <ValidationObserver ref="observer" v-slot="{ valid }">
                    <div class="card-body p-0">
                      <form >
                        <div class="form-label-group">
                          <ValidationProvider
                              name="password"
                              ref="password"
                              rules="required|customPassword"
                              v-slot="{ errors }"
                          >
                          <input
                            id="inputEmail"
                            name="password"
                            :type="show ? 'text' : 'password'"
                            class="form-control" style="margin-top: 5px"
                            placeholder="Mật khẩu mới"
                            v-model="password"
                          />
                          <ul style="color:red" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                            <span>{{ error }}</span>
                            </li>
                        </ul>
                        </ValidationProvider>
                        </div>
                      </form>
                    </div>
                    </ValidationObserver>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 d-lg-block d-none text-left align-self-center">
                <div class="card rounded-0 mb-0">
                  <div class="float-md-left d-block mb-1">
                <a style="background-color: rgb(228, 228, 228); border-color: #ccd0d5; color: #4b4f56;"
                    @click="showPassword()"
                    class="btn btn-outline-primary btn-block px-75"
                    ><i style="padding-right: 5px" :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>{{(show ? 'Ẩn' : 'Hiển thị')}}</a>
                </div>
                </div>
              </div>
              
            </div> 
            <hr>
            <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <div class="float-md-right d-block mb-1 mr-1">
                        <button  @click="changePassword()" class="btn btn-primary btn-block px-75" :class="{'not-allowed': ((emailRecoverPassword != '') ? flase : true)}" >Tiếp tục</button>
                      </div>
                <div class="float-md-left d-block mb-1">
                <a style="background-color: #f5f6f7; border-color: #ccd0d5; color: #4b4f56;"
                    href="/dang-nhap"
                    class="btn btn-outline-primary btn-block px-75"
                    >Hủy</a>
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
  message: (field, values) => "Vui lòng nhập mật khẩu.",
});

// create custom error message for custom rule
var errorMessage =
  " phải chứa ít nhất 8 ký tự";
// create custom rule
extend("customPassword", {
  message: field =>"Mật khẩu " + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s]/;
    var mustContainTheseChars = /^(?=.{8,})/;
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
          "phải chứa ít nhất 8 ký tự và không bao gồm ký tự đặc biệt.";
      }
      return false;
    }
  }
});
export default {
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data() {
    return {
      password: '',
      show: false
    }
  },
  methods: {
    changePassword(){
        const isValid = this.$refs.observer.validate();
        if(isValid){
            this.$axios.post('changePasswordForgot', {email: this.$route.query.email, password: this.password}).then(response => {
            if(response.data.status == 200){
                this.$swal('Thành công', response.data.message, 'success').then((result) =>{
                  this.$auth.login({ data: {email : this.$route.query.email, password: this.password} });
                  window.location.href = '/admin';
                })
                
            }
            else{
            'Lỗi',
            response.data.message,
            'warning'
            }
        })
        }
      
    },
    showPassword() {
        this.show = !this.show
    }
  },
  created(){
    console.log(this.$route.query.email)
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