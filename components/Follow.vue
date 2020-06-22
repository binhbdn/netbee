<template>
  <div class="ftco-section-parallax">
    <div class="d-flex" id="follow" v-lazy:background-image="`/assets/img/hands-ncd.jpg`">
      <div style="background-color: #242222c9; width: 100%;">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 col-md-7">
              <div class="register_form">
                <div><h2 class="text">{{$t('follow.title')}}</h2></div>
                <p>{{$t('follow.decs')}}</p>
                <form class="appointment-form" id="appointment-form-2" style="margin-top:10px;">
                  <ValidationObserver ref="observer" v-slot="{ valid }">
                    <div style="width: 80%">   
                      <ValidationProvider name="Họ và tên" ref="name" rules="required" v-slot="{ errors }"> 
                        <div class="col-md-12 form-group" style="padding-left: 0;">
                          <input type="text" class="form-control"  :placeholder="$t('follow.name')"  name="name" v-model="dataForm.name">
                          <ul style="color:#FFC107;padding-left:15px;" class="overline">
                            <li v-for="(error, index) in errors" :key="index">
                              <span>{{ error }}</span>
                            </li>
                           </ul>                                         
                        </div>
                      </ValidationProvider>
                      <ValidationProvider rules="required|integer" ref="phone" name="Số điện thoại" v-slot="{ errors }">
                        <div class="col-md-12 form-group" style="padding-left: 0;">                                     
                          <input type="text" class="form-control" :placeholder="$t('follow.phone')"  name="phone" v-model="dataForm.phone">
                          <ul style="color:#FFC107;padding-left:15px;" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                              <span>{{ error }}</span>
                            </li>
                         </ul>                                        
                        </div>
                      </ValidationProvider>                                          
                      <ValidationProvider name="Email" ref="email" rules="required|email" v-slot="{ errors }">
                        <div class="col-md-12 form-group" style="padding-left: 0;">
                          <input type="email" class="form-control" :placeholder="$t('follow.email')"  name="email" v-model="dataForm.email">
                            <ul style="color:#FFC107;padding-left:15px;" class="overline text-left">
                              <li v-for="(error, index) in errors" :key="index">
                                <span>{{ error }}</span>
                              </li>
                            </ul>
                        </div>                                  
                      </ValidationProvider>
                      <div class="col-md-12 text-center form-group" style="padding-left: 0;">
                        <div class="form-submit text-center">
                          <button @click="sendForm()" class="btn bg-netbee" style="width: 100%;">Gửi ngay</button>
                        </div>
                      </div>
                    </div>
                  </ValidationObserver>  
                </form>
              </div>

            </div>
            <div class="col-lg-6 col-md-7">
              <img src="/assets/img/logo-netbee-2-ncd.png" alt="logo netbee" height="80" width="200">
              <div style="margin-left: 10px;">
                <h1 style="color: #ffb701; font-weight: bold;font-size: 21px;padding-top: 10px;">Cùng bạn trên con đường thành công !</h1>
                <h4 style="color: #fff;font-size: 16px;padding-top: 10px;"><i class="fa fa-check" style="margin-right: 5px;"></i> Đội ngũ tư vấn nhiệt tình</h4>
                <h4 style="color: #fff;font-size: 16px;padding-top: 6px;"><i class="fa fa-check" style="margin-right: 5px;"></i> Giải đáp mọi thắc mắc</h4>
                <h4 style="color: #fff;font-size: 16px;padding-top: 6px;"><i class="fa fa-check" style="margin-right: 5px;"></i> Hỗ trợ 24/24</h4>
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
extend("integer", {
  message: (field, values) => "Dữ liệu nhập vào phải là số"
});
extend("min", {
  message: (field, values) => "Dữ liệu nhập vào ít nhất" + `${values}`
});
extend("alpha", {
  message: (field, values) => "Dữ liệu nhập vào phải là chữ."
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
      dataForm: {
        name: "",
        phone: "",
        email: ""
      }
    };
  },
   computed: {},
   created() {},
   methods: {
    async sendForm() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        try {
            let response = await this.$axios.post('/saveEmail',{ 
                name: this.dataForm.name,
                phone: this.dataForm.phone,
                email: this.dataForm.email,
             });
            if(response.data.status == 200) {
              this.$swal({
                title: 'Gửi thành công',
                text: response.data.message,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then( async (result) => {
              })
            }else {
              this.$swal(
                'Lỗi!',
                response.data.message,
                'error'
              )
            }
        } catch (err) {
          this.$swal(
            'Lỗi!',
            'Gửi thất bại!',
            'error'
          )
        }
       
        requestAnimationFrame(() => {
          this.$refs.observer.reset();
        });
      }
    }
  }
}
</script>
 
<style>
#follow{
    background-position: center center;
    background-size: cover;
    background-color: #1e1e1e;
    height: auto;
}

.register_form {
    color: #ececec;
    padding:30px 0;
} 
.text{
    color: #fff;
}
</style>