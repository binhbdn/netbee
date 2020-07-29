<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper pb-2 mt-0" >
      <div class="content-body p-2">
        <div class="col-xl-7 col-md-9 col-10 d-flex justify-content-center px-0" style="margin: 20px auto">
          <div class="card bg-authentication rounded-0 mb-0 p-2" style="width: 700px">
            <div class="row mt-1 ml-1">
            <h4>Nhập mã bảo mật</h4>
            </div>
            <hr>
            <p
                    class="px-2 mb-2"
                  >
                  Vui lòng kiểm tra mã trong email của bạn. Mã này gồm 6 số.
            <div class="row m-0">
              <div class="col-lg-6 d-lg-block d-none text-left align-self-center">
                <div class="card rounded-0 mb-0">
                  
                  <div class="card-content">
                    <ValidationObserver ref="observer" v-slot="{ valid }">
                    <div class="card-body p-0">
                      <form >
                        <div class="form-label-group">
                          <ValidationProvider
                              name="codeRecover"
                              ref="codeRecover"
                              rules="required"
                              v-slot="{ errors }"
                          >
                          <input
                            type="text"
                            id="inputEmail"
                            name="codeRecover"
                            class="form-control" style="margin-top: 5px"
                            placeholder="Nhập mã"
                            v-model="recoverCode"
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
              <div class="col-lg-6 col-12 p-0">
                <div class="card rounded-0 mb-0 px-2 py-1">
                  <h6>
                  Chúng tôi đã gửi cho bạn mã đến:</h6>
                  <div class="card-content">
                    <p>{{$route.query.email}}</p>
                  </div>
                </div>
              </div>
            </div> 
            <hr>
            <div class="row">
              <div class="col-6 d-flex justify-content-start">
                <a class="color:#464646" @click="resentPasscode()">Bạn chưa có mã?</a> 
              </div>
            <div class="col-6 d-flex justify-content-end">
                <div class="float-md-right d-block mb-1 mr-1">
                        <button  @click="recoverPassword" class="btn btn-primary btn-block px-75 hover-black-white" :class="{'not-allowed': ((emailRecoverPassword != '') ? flase : true)}" >Tiếp tục</button>
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
  message: (field, values) => "Vui lòng nhập mã.",
});
export default {
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data() {
    return {
      recoverCode: ""
    }
  },
  methods: {
    recoverPassword(){
      this.$axios.get('checkRecoverCode?email=' + this.$route.query.email + '&code=' +this.recoverCode).then(response => {
        if(response.data.status == 200){
          window.location.href = "doi-mat-khau?email=" + this.$route.query.email + '&code=' +this.recoverCode
        }
        else{
          this.$swal('Lỗi',response.data.message, 'warning')
        }
      })
    },
    resentPasscode(){
      this.$axios.get('recoverPassword?email='+ this.$route.query.email).then(response => {
        try {
          if(response.data.status == 200){
            this.$swal('Thành công', response.data.message, 'success')
          }
          else{
            this.$swal('Lỗi', response.data.message, 'warning')
          }
        } catch (Exception) {
          this.$swal('Lỗi', response.data.message, 'error')
        }
      })
    }
  },

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
.hover-black-white{
  color:#000 !important;
}
.hover-black-white:hover{
  color:#fff !important;
}
</style>