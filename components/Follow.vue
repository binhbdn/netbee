<template>
    <div class="ftco-section-parallax">
        <div class="d-flex " id="follow">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7">
                        <div class="register_form">
                            <div><h2 class="text">Đăng ký tư vấn</h2></div>
                            <p>Hãy để lại thông tin để nhận tư vấn từ netbee.</p>
                           <form method="POST" class="appointment-form" id="appointment-form-2" style="margin-top:10px;">
                                    <ValidationObserver ref="observer" v-slot="{ valid }">
                                 <div class="roww"  style="width: 400px;">   
                                       <ValidationProvider 
                                          name="Họ và tên"
                                          ref="name"
                                          rules="required|max:20"
                                           v-slot="{ errors }"
                                           > 
                              <div class="form-group col-sm-12" style="height: 47px;">
                                        <input type="text"  class="form-control"  placeholder="Nhập họ tên"  name="name" v-model="dataForm.name">
                                               
                                            <ul style="color:#FFC107" class="overline">
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
                                      <div class="form-group col-sm-12" style="height: 47px;">                                     
                                       <input type="text" class="form-control" placeholder="Nhập số điện thoại"  name="phone" v-model="dataForm.phone">
                                              <ul style="color:#FFC107" class="overline text-left">
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
                                      <div class="form-group col-sm-12">
                                         <input type="email" class="form-control" placeholder="Nhập địa chỉ email"  name="email" v-model="dataForm.email">
                                               <ul style="color:#FFC107" class="overline text-left">
                                                   <li v-for="(error, index) in errors" :key="index">
                                                   <span>{{ error }}</span>
                                                  </li>
                                              </ul>
                                    </div>                                  
                                         </ValidationProvider>
                                    <div class="col-sm-12 text-center form-group">
                                        <div class="form-submit text-center" style="padding-bottom: 10px; margin-top:10px">
                                             <input @click="sendForm()" type="button" name="submit" id="submit" class="btn btn-outline-warning" style="font-weight: bold;" value="Gửi ngay" />
                                               </div>
                                    </div>
                              </div>
                             </ValidationObserver>  
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 text-center pt-4">
                        <img v-lazy="`/assets/img/1256652.svg`" height="280">
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
                if (result.value) {
                 window.location.href = '/';
                }
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