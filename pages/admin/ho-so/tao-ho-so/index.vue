<template>
    <div class="app-content content">
         <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <br><br><br><br>
        <div class="col-12">  
            <section id="page-account-settings">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="col-md-12">
                                    <ValidationObserver v-slot="{ invalid }">
                                        <div style="padding: 15 5px; margin: 15px 5px 5px;border-radius: 3px;">
                                            <div class="row" style="padding: 10px;">
                                                <div class="col-md-12 h4_title">
                                                    <h4>TẠO HỒ SƠ ỨNG TUYỂN</h4>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <center>
                                                                <div style="background-color: #fff;" class="img-cv">
                                                                    Hình ảnh đại diện
                                                                    <div class="imgg">
                                                                        <label for="files">                 
                                                                            <img v-lazy="images[0]" v-if="images.length > 0">
                                                                            <img v-lazy="img" v-else>
                                                                        </label>
                                                                        <input type="file" id="files" class="hidden" @change="previewFiles" multiple>                                          
                                                                    </div>                   
                                                                </div>
                                                            </center>
                                                        </div>
                                                        <div class="col-md-8 pl-md-1 p-50">
                                                            <ValidationProvider 
                                                           name="Họ và tên"
                                                            ref="name"
                                                            rules="required|min:5"
                                                            v-slot="{ errors }"
                                                            >
                                                                <fieldset class="form-group">
                                                                    <label class="title-label" for="basicInput">Họ và tên (<span style="color: red; font-size: 20px;">*</span>)</label>
                                                                    <input type="text" class="form-control" name="name" v-model="info_frofile_user.fullname_profile">
                                                                    <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                                                        <li v-for="(error, index) in errors" :key="index">
                                                                        <span>{{ error }}</span>
                                                                        </li>
                                                                    </ul>
                                                                </fieldset> 
                                                            </ValidationProvider>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <ValidationProvider rules="required" v-slot="{ errors }">
                                                                        <fieldset class="form-group">
                                                                            <label class="title-label" for="basicInput">Ngày sinh (<span style="color: red; font-size: 20px;">*</span>)</label>
                                                                            <input type="date" class="form-control" v-model="info_frofile_user.birthday_profile"/>
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </fieldset> 
                                                                    </ValidationProvider> 
                                                                </div>
                                                                <div class="col-md-6">
                                                                     <label class="title-label" style="margin-top: 5px;margin-bottom: 5px;">Giới tính</label>
                                                                    <div class="radio-MaleFemale">
                                                                        <input v-model="info_frofile_user.maleFemale" type="radio" id="Nam" value="Nam"/>
                                                                        <label for="Nam" style="color: #000;">Nam</label>
                                                                        <input v-model="info_frofile_user.maleFemale" type="radio" id="Nu" value="Nữ" style="margin-left: 20px;" />
                                                                        <label for="Nu" style="color: #000;">Nữ</label>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                     <ValidationProvider
                                                        rules="required|integer|length:10"
                                                        ref="phone"
                                                        name="Số điện thoại"
                                                        v-slot="{ errors }"
                                                    >
                                                    <fieldset class="form-group">
                                                        <label class="title-label" for="basicInput">Số điện thoại (<span style="color: red; font-size: 20px;">*</span>)</label>
                                                        <input type="number" v-model="info_frofile_user.phone_profile" name="phone" class="form-control"> 
                                                        <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                                            <li v-for="(error, index) in errors" :key="index">
                                                            <span>{{ error }}</span>
                                                            </li>
                                                        </ul>
                                                    </fieldset>
                                                     </ValidationProvider>
                                                </div>
                                                 
                                                <div class="col-md-6">
                                                    <ValidationProvider
                                                   name="Email"
                                                    ref="email"
                                                    rules="required|email"
                                                    v-slot="{ errors }"
                                                    >
                                                    <fieldset class="form-group">
                                                        <label class="title-label" for="basicInput">Email (<span style="color: red; font-size: 20px;">*</span>)</label>
                                                        <input type="email" name="email" class="form-control" v-model="info_frofile_user.email_profile">
                                                       <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                                            <li v-for="(error, index) in errors" :key="index">
                                                            <span>{{ error }}</span>
                                                            </li>
                                                        </ul>
                                                    </fieldset> 
                                                    </ValidationProvider>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <ValidationProvider 
                                                    rules="required|min:5"
                                                    name="Địa chỉ"
                                                    ref="add"
                                                    v-slot="{ errors }"
                                                    >
                                                        <fieldset class="form-group">
                                                            <label class="title-label" for="basicInput">Địa chỉ (<span style="color: red; font-size: 20px;">*</span>)</label>
                                                            <textarea v-model="info_frofile_user.address_profile" name="add" class="form-control" style="overflow:hidden;" rows="2"></textarea>
                                                             <ul style="color:red;margin-bottom: 3px;" class="overline text-left">
                                                            <li v-for="(error, index) in errors" :key="index">
                                                            <span>{{ error }}</span>
                                                            </li>
                                                        </ul>
                                                        </fieldset> 
                                                    </ValidationProvider> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <ValidationProvider rules="required" v-slot="{ errors }">
                                                        <fieldset class="form-group">
                                                            <label class="title-label" for="basicInput">Học vấn (<span style="color: red; font-size: 20px;">*</span>)</label>
                                                            <multiselect :options="educationEx" v-model="name_education" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false"></multiselect>
                                                            <span style="color: red">{{ errors[0] }}</span>
                                                        </fieldset> 
                                                    </ValidationProvider> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="title-label" for="basicInput">Link Facebook</label>
                                                    <input v-model="info_frofile_user.link_facebook" class="form-control" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="title-label" for="basicInput">Hình thức</label>
                                                    <select class="form-control" v-model="info_frofile_user.type">
                                                        <option value="" disabled selected  style="display: none;">Chọn hình thức</option>
                                                        <option value="1">Xuất khẩu lao động</option>
                                                        <option value="2">Du học</option>
                                                        <option value="3">Tu nghiệp sinh</option>
                                                    </select>    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- hết -->
                                        <div class="col-md-12" style="text-align: right;">
                                            <button class="btn btn-add bg-netbee" style="margin-top: 15px" :disabled="invalid"  v-on:click="insert">Tạo hồ sơ</button>
                                        </div>
                                    </ValidationObserver>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
        </div>  
        <br>                                    
    </div>
</template>

<script>      
    import Multiselect from 'vue-multiselect'
    import 'vue-multiselect/dist/vue-multiselect.min.css'
    import { ValidationObserver } from "vee-validate/dist/vee-validate.full";
    import {ValidationProvider, extend} from "vee-validate/dist/vee-validate.full";   
    // can customize default error messages
    extend("required", {
    message: (field, values) => "Dữ liệu nhập vào không được để trống.",
    });
    extend("email", {
    message: (field, values) => "Email không đúng định dạng"
    });
    extend("integer", {
    message: (field, values) => "Dữ liệu nhập vào phải là chữ số"
    });
    extend("min", {
    message: (field, values) => "Dữ liệu nhập vào ít nhất 5 ký tự"
    });
    extend("alpha", {
    message: (field, values) => "Dữ liệu nhập vào phải là chữ."
    });
     extend("length", {
    message: (field, values) => "Số điện thoại phải có 10 chữ số."
    });

    export default {        
        name: 'Teamplate1',
        layout: 'admin',
        
        data(){
            return {               
                    info_frofile_user: {
                        id_user:'',
                        fullname_profile:'',
                        birthday_profile:'',
                        type:'',
                        maleFemale:'',
                        avatar_profile:'',
                        address_profile:'',
                        phone_profile:'',
                        email_profile:'',
                        link_facebook:'',
                        name_education:''
                    },  
                    img:'https://www.topcv.vn/upload/images/avatars/no_avatar.jpg', 
                    fileImg:[], 
                    images: [],  
                    name_education:{id: 1, name: 'Trung học phổ thông'},
                    educationEx: [
                        {id: 1, name: 'Trung học phổ thông'},
                        {id: 2, name: 'Cao đẳng'},
                        {id: 3, name: 'Đại học'},
                        {id: 4, name: 'Trên đại học'}
                    ]
                }         
        },        
        components:{
            ValidationObserver,
            ValidationProvider,
            Multiselect
        },
        
        methods: {
            nameWithLang ({ name, id }) {
                return `${name}`
            },
            previewFiles(e) {                
                if(this.images.length > 0){
                this.$delete(this.images, 0)
                }                                     
                e.preventDefault();
                e.stopPropagation();
                this.isDragging = false;      
                const files = e.target.files;
                if(files.length >0)
                    this.addImage(files[0]);
            },
            addImage(file){
                if( !file.type.match('image.*') ){
                    this.$swal(
                            'Lỗi',
                            'File không đúng định dạng',
                            'error'
                        )
                    return;
                }
                if(this.fileImg.length >0)
                    this.$delete(this.fileImg, 0)

                this.fileImg.push(file);

                const img = new Image();
                const reader = new FileReader();

                reader.onload = (e) => this.images.push(e.target.result);

                reader.readAsDataURL(file);
            },
             mixin_autoResize_resize(event) {
                event.target.style.height = "auto";
                event.target.style.height = `${event.target.scrollHeight}px`;
            },
            text(){
                            
            },                                      
            insert(e, route){                         
                e.preventDefault();                
                var form = new FormData();                             
                form.append('avatar_profile' , this.fileImg[0])
                form.append('id_user' , this.info_frofile_user.id_user)
                form.append('fullname_profile' , this.info_frofile_user.fullname_profile)
                form.append('birthday_profile' , this.info_frofile_user.birthday_profile)
                form.append('type' , this.info_frofile_user.type)
                form.append('maleFemale' , this.info_frofile_user.maleFemale)
                form.append('address_profile' , this.info_frofile_user.address_profile)
                form.append('phone_profile' , this.info_frofile_user.phone_profile)
                form.append('email_profile' , this.info_frofile_user.email_profile)
                form.append('link_facebook' , this.info_frofile_user.link_facebook)                   
                form.append('name_education' , this.name_education.id)             
                this.$axios.post('hoso/insertProfileUser',form)
                .then(response => {                                                           
                    if(response.data.status == 200) {
                        this.$swal(
                            'Tạo mới thành công',
                            response.data.message,
                            'success'
                            ).then( function (){
                            window.location.href = '/admin/ho-so';
                            } )
                    }else{
                        this.$swal(
                            'Lỗi',
                            response.data.message,
                            'error'
                        )
                        if(response.data.status == 400){                            
                            $('input').addClass('your-class');
                            $('textarea').addClass('your-class');
                            // $('label').addClass('clor-class');
                        }                        
                    }
                 })
                 .catch(error => {
                    console.log(error.response);
                });                
            },           
        },               
        mounted() {                           
            this.$nextTick(() => {
                this.$el.setAttribute("style", "height",
                `${this.$el.scrollHeight}px`);      
            });                                
        }
    };
</script>
<style>
    .h4_title {
        position: relative;
        border-bottom: 1px solid #eaeaea;
        padding-left: 0px !important;
        margin-left: 13px;
       
        margin-bottom: 17px;
       padding-right: 0px;
    }
    .h4_title:before {
        position: absolute;
        background: rgb(255, 183, 1);
        height: 2px;
        content: '';    
        left: 0;
        width: 220px;
        bottom: -2px;
        border-radius: 12px;
    }
    .title-label {
        margin-bottom: 10px;
    }
    .your-class::-webkit-input-placeholder {
        color: crimson !important;
    }
    /* .clor-class{
        color: crimson !important;
    } */
   .title-h2-cv h2{
       margin-top: 20px;
        font-size: 34px;
        font-weight: 600;
   }   
   hr {
       width: 50%;
        text-align: left;
        margin-left: 0;
        border-top: 2px solid rgba(34, 41, 47, 0.1);
   }
   .title-h3-cv .main-text ,.title-h3-cv .a{
       margin-top: 20px;
        font-size: 30px;
        font-weight: 600;
        width: 100%;
        border-color: #fff;
   }

   .title-h4-cv h4{
        margin-top: 16px;
        font-size: 21px;
        font-weight: 550;
   }
   .target-cv h5 {
       font-size: 20px;
       font-weight: 550;
       padding-left: 10px;     
   }
   .education-cv h5 {
       font-size: 20px;
       font-weight: 550;
           margin-bottom: 5px;
           margin-top: 24px;
   }
   .skill-mn-cv h5 {
       font-size: 20px;
       font-weight: 550;
           margin-bottom: 5px;
           margin-top: 24px;
   }
   .target-Short-term-cv h6{
       font-size: 17px;
        font-weight: 600;
   }
   .target-Short-term-cv {
       margin-top: 20px;
   }
   .target-company-cv .main-text ,.target-company-cv .a{
       font-size: 17px;
        font-weight: 500;
        width: 100%;
        border-color: #fff;
   }
  
   .communication .main-text, .Information .main-text, .logic .main-text ,.communication .a, .Information .a, .logic .a{
       width: 100%;
        border-color: #fff;
   }
  
   .target-Short-term-note-cv .main-text , .target-Short-term-note-cv .a{
        margin-top: 15px;
        font-size: 15px;
        width: 100%;
        border-color: #fff;
   }

   .communication {
       margin-top: 20px;
   }
    .main-cv {
        padding-left: 20px;
    }
    .education-cv .main-text, .education-cv .a {
        font-size: 17px;
        font-weight: 500;
        width: 100%;
        border-color: #fff;
    }


    .skill-mn-cv .main-text, .skill-mn-cv .a {
        font-size: 17px;
        font-weight: 500;
        width: 100%;
        border-color: #fff;
    }
    
    .education-khoa .main-text, .education-khoa .a {        
        font-size: 13px;
        width: 100%;
        border-color: #fff;
    }

    .education-cap .main-text ,.education-cap .a{
        font-size: 13px;        
        width: 100%;
        border-color: #fff;
    }
    .main-text:hover {
        border-color: #4B6A78;
        border-style: dotted;
    }    
    textarea:focus{              
       border: #4B6A78 1px dotted !important;
       outline-offset: 0px !important;
        outline: none !important;
    } 
    input:focus{              
       border: #4B6A78 1px dotted !important;
       outline-offset: 0px !important;
        outline: none !important;
    } 
    .img-cv {
        padding: 30px;
    }
    /* .img-cv .imgg{
        position: relative;
    }
    .img-cv .imgg label{
        position: absolute; 
        z-index: auto;
        bottom: 0%;
        left: 0%;
    } */
    .img-cv .imgg img {
        /*width: 238px;*/
        /*height: 238px;*/
        width: 40%;
        border-radius: 50%;
    }    
    .briday-cv ,.gioitinh-cv, .Cmnd-cv,.address-cv, .phone-cv, .email-cv, .note-cv {
        color: #fff;
        margin-top: 15px;
    }
    .icon-cv-profile {
        text-align: center;
    }
    .icon-cv-profile i {
        text-align: center;
        background-color: #029c7c;
        color: #fff;
        padding: 10px;
        border-radius: 50%;
        margin-left: 5px;
    }
    .briday-cv  .main-text,.gioitinh-cv .main-text,.Cmnd-cv .main-text, .phone-cv .main-text, .email-cv .main-text{
        border: 1px dotted #28bb9c;
        background-color: #28bb9c;
        font-size: 17px;
        padding-top: 5px;
        width: 100%;
        color: #fff;
    }
    .address-cv .main-text, .note-cv .main-text ,.briday-cv  .a,.gioitinh-cv .a,.address-cv .a, .phone-cv .a, .email-cv .a, .note-cv .a{
        font-size: 17px;
        padding-top: 5px;
        width: 100%;
        border-color: #28bb9c;
        background-color: #28bb9c;
        color: #fff;
    }    
    /* .briday-cv  input::placeholder,.gioitinh-cv input::placeholder,.address-cv textarea::placeholder, .phone-cv input::placeholder, .email-cv input::placeholder, .note-cv textarea::placeholder {
        color:#000 !important;

    }   */
    /* textarea::placeholder{
        color:crimson !important;
    }
    input::placeholder{
        color:crimson !important;
    } */
    /* textarea::placeholder{
        color:#000 !important;
    }
    input::placeholder{
        color:#000 !important;
    } */
    .briday-cv  .main-text:hover,.address-cv .main-text:hover,.gioitinh-cv .main-text:hover,.Cmnd-cv .main-text:hover, .phone-cv .main-text:hover, .email-cv .main-text:hover, .note-cv .main-text:hover {
        border-color: #4B6A78;
        border-style: dotted;
    }
    .edu-cv {
        border: 1px solid #fff;
    }
    .skill-cv {
        border: 1px solid #fff;
    }
    .main-edu-cv {
        border: 1px solid #fff;
         position: relative;
         padding: 10px;
    }
    .target-dai {
        padding-left: 10px;
        border: 1px solid #fff;
    }
    .target-dai:hover {
        border: 1px solid #029c7c;
    }
    .target-main-cv {
        border: 1px solid #fff;
    }
    .target-main-cv:hover {
        border: 1px solid #FFF;
    }
   
    .main-skill-cv:hover {
         border: 1px solid #fff;
    }
    .main-skill-cv {
         border: 1px solid #fff;
    }
    .target-ngan {
        padding-left: 10px;
        border: 1px solid #fff;
    }
    .target-ngan:hover {
        border: 1px solid #029c7c;
    }
    .main-edu-cv:hover .icon-01-01{        
       visibility: visible;
    }
    .main-edu-cv .icon-01-01{        
       visibility: hidden;
    } 
    .main-edu-cv:hover {
        border: 1px solid #029c7c;
    }
    .edu-cv:hover {
        border: 1px solid #029c7c;
    }
    .skill-cv:hover {
        border: 1px solid #029c7c;
    }
    .fieldset1{
        position: absolute;
        background: #cfcfcf;
        z-index: auto;
        height: 35px;
        width: 103px;
        text-align: center;        
        top: -36px;
        right: -1px;
        text-shadow: none;        
        border-radius: 4px 4px 0 0;      
    }
    .btn-cv-01{
        /* border: 1px solid #2f3b4c ; */
        margin-top: 3px;
        padding: 5px;         
        background-color: #fff;
        color: #545E6C;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.25;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;    
        border-radius:5px;
    }
    .btn-cv-add{ 
        border: 1px solid #0ba25e ;          
        background-color: #0ba25e;
        color: #fff;
    }
    .btn-cv-delete{ 
        border: 1px solid red ;           
        background-color: red;
        color: #fff;
    }
    .radio-MaleFemale {
        margin-top: 6px;
    }
    .radio-MaleFemale  label{
        font-size: 15px;
        color: #fff;
    }
    .main-select{        
        font-size: 15px;
        margin-top: 0px;  
        background-color: #FFB701 !important;     
        height: 31px;
        border-radius: 10px;
    }
</style>
<style scoped>
    textarea:focus{              
        border: #4B6A78 1px dotted !important;
    }   
    input:focus{              
        border: #4B6A78 1px dotted !important;
    }         
</style>