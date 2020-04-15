<template>
    <div class="ftco-section-parallax">
        <div class="d-flex " id="follow">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7">
                        <div class="register_form">
                            <div><h2 class="text">Đăng ký tư vấn</h2></div>
                            <p>Hãy để lại thông tin để nhận tư vấn từ netbee.</p>
                            <form id="app" @submit.prevent="submit" action="" method="post" novalidate="true">
                               
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <input  id="name"
                                         v-model.trim="$v.name.$model"
                                         :class="{ 'form-group--error': $v.name.$error,'form-group--error': $v.name.$invalid }"
                                         type="text"                                        
                                         placeholder="Nhập họ và tên" 
                                         class="form-control" 
                                         name="name" required>
                                          <div class="aaa">
                                             <span v-if="!$v.name.required")></span>
                                              <span v-if="!$v.name.minLength")> chiều dài không thỏa mãn </span>
                                         </div>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <input
                                        id="phone"
                                         v-model.number.lazy="$v.phone.$model"
                                        :class="{ 'form-group--error': $v.phone.$error }"
                                         type="text"                                        
                                         placeholder="Nhập số điện thoại"  
                                         class="form-control"
                                          name="phone" required >
                                           <div class="aaa">
                                             <span v-if="!$v.phone.required")></span>
                                             <span v-if="!$v.phone.minLength")> chiều dài quá ngắn </span>
                                             <span v-if="!$v.phone.maxLength")> chiều dài không thỏa mãn </span>
                                         </div>
                                        
                                    </div>
                                      <div class="form-group col-sm-12">
                                        <input   id="email"
                                         v-model.trim="$v.email.$model"
                                         :class="{ 'form-group--error': $v.email.$error,'form-group--error': $v.email.$invalid }"
                                         type="email"                                        
                                         placeholder="Nhập địa chỉ email" 
                                         class="form-control"                                       
                                         name="email" required>
                                          <div class="aaa">
                                             <span v-if="!$v.email.required")></span>
                                              <span v-if="!$v.email.isUnique")> Email không hợp lệ </span>
                                         </div>
                                    </div>                                  
                                     
                                    <div class="col-sm-12 text-center form-group">
                                        <button type="submit" class="btn btn-warning text-dark w-100">
                                            <i class="far fa-paper-plane"></i> Gửi {{submitStatus}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 text-center pt-4">
                        <img src="/assets/img/1256652.svg" height="280">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Vue from 'vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
import { required, minLength,maxLength,between} from 'vuelidate/lib/validators'

export default {
    name: '',
    data() {
    return {
      name: '',
      phone: '',
      email:'',
      submitStatus: null
    }
  },
  validations: {
    name: {
      required,
      minLength: minLength(4)
    },
     phone: {
      required,
      minLength: minLength(9),
      maxLength: minLength(11),
    
    
    },
     email: {
      required,
      isUnique(value){
          if(value==='') return true 
          var email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return new Promise((resolve)=>{
                setTimeout(() => {
                    resolve(email_regex.test(value))
                }, 350 + Math.random() *380);
            })
            }
    }

  },
   methods: {
    submit() {
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR'
      } else {
        this.submitStatus = 'PENDING'
       
      }
    }
  }
  
}

</script>
 
<style>
#follow{
    background-image: url("/assets/img/pattern_bg.png");
    background-position: center center;
    background-size: cover;
    background-color: #1e1e1e;
    height: 380px;
}

.register_form {
    color: #ececec;
    padding-top: 50px;
} 
.text{
    color: #fff;
}
</style>