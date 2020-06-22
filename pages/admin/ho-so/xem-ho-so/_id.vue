<template>
    <div class="app-content content">
         <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <br><br><br><br>        
        <div class="container" >   
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0" style="padding-right: 15px;">Danh sách hồ sơ ứng tuyển</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/">Hồ sơ ứng tuyển</a>
                                    </li>
                                    <li class="breadcrumb-item active" v-if="status == 0"> Chi tiết hồ sơ ứng tuyển
                                    </li>
                                    <li class="breadcrumb-item active" v-if="status == 1"> Cập nhật hồ sơ ứng tuyển
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-cv">                 
                <div class="row">
                    <div class="col-md-10" style="background-color: #fff;box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);">                                
                        <div class="row" id="cv">
                            <div class="col-md-8">
                                <br>
                                <div class="title-h3-cv">       
                                    <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.fullname_profile}}</p>   
                                    <textarea  v-if="status == 1" v-model="info_frofile_user.fullname_profile" class="main-text textarea" placeholder="VD: NGUYỄN VĂN A"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>                                                              
                                </div>
                                
                                <br>
                                <div class="target-main-cv">
                                    <div class="target-cv">
                                        <div class="row">
                                            <div class="col-md-6" >
                                                <h5>MỤC TIÊU NGHỀ NGHIỆP</h5>
                                            </div>
                                        </div>                                                                        
                                    </div>
                                    <div v-bind:class="{'target-ngan': status == 0, 'target-ngan1': status == 1}" >                                
                                        <div class="target-Short-term-cv" >
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>MỤC TIÊU CỦA BẠN</h6>
                                                </div>                                              
                                            </div>                        
                                        </div>
                                        <div class="target-company-cv">
                                            <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.title_target_profile}}</p>  
                                            <textarea v-if="status == 1" v-model="info_frofile_user.title_target_profile"  class="main-text textarea" placeholder="VD: NHÂN VIÊN XUẤT KHẨU LAO ĐỘNG TẠI CÔNG TY HACHINET"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>                                          
                                        </div>
                                        <div class="target-Short-term-note-cv">
                                            <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.note_target_profile}}</p>   
                                            <textarea v-if="status == 1" v-model="info_frofile_user.note_target_profile" class="main-text textarea" placeholder="VD: Mong muốn làm việc trong một môi trường năng động, vui vẻ, thỏa sức đưa ra các ý tưởng, sự sáng tạo và đặc biệt là được theo đuổi ngành nghề yêu thích của mình. Đưa bản thân vào một môi trường làm việc có kỷ luật, nâng cao tinh thần trách nhiệm và khả năng chịu áp lực, giải quyết vấn đề một cách sáng tạo và hiệu quả ở một vị trí đầy thách thức."  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="5"></textarea>                                                 
                                        </div>
                                    </div>                                  
                                </div>
                                <div v-bind:class="{'skill-cv': status == 0, 'skill-cv1': status == 1}">
                                    <!--Học vấn-->
                                    <div class="skill-mn-cv" style="padding-left:10px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5>KỸ NĂNG</h5>
                                            </div>
                                            
                                        </div>                                                   
                                    </div>                                    
                                    <div style="padding-left:10px;padding-right:10px;" class="main-skill-cv">                                                                                                                           
                                        <div class="communication">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <p>Giao tiếp:</p>
                                                </div>
                                                <div class="col-md-10">
                                                    <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.skill_communication_profile}}</p>
                                                    <textarea v-if="status == 1" v-model="info_frofile_user.skill_communication_profile" class="main-text textarea" placeholder="VD: Tốt"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>                                                       
                                                </div>
                                            </div>            
                                        </div>
                                        <div class="Information">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <p>Tin học văn phòng(Word, Excel, Power Point):</p>
                                                </div>
                                                <div class="col-md-5">
                                                    <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.skill_information_profile}}</p>                                                     
                                                    <textarea v-if="status == 1" v-model="info_frofile_user.skill_information_profile"  class="main-text textarea" placeholder="VD: Tốt"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                                </div>
                                            </div>                                            
                                        </div>     
                                        <div class="logic">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p>Tư duy logic:</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.skill_logic_profile}}</p>                                                    
                                                    <textarea v-if="status == 1" v-model="info_frofile_user.skill_logic_profile"  class="main-text textarea" placeholder="VD: Tốt"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                                </div>
                                            </div>                                            
                                        </div>                                                                                                                                                
                                    </div>
                                </div> 
                                <div class="skill-cv">
                                    <!--Học vấn-->
                                    <div class="skill-mn-cv" style="padding-left:10px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5>CHỨNG CHỈ</h5>
                                            </div>
                                            
                                        </div>                                                   
                                    </div>                                    
                                    <div style="padding-left:10px;padding-right:10px;" class="main-skill-cv">                                                                                                                           
                                        <div class="communication">
                                            <div class="row">                                             
                                                <div class="col-md-12">
                                                    <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.certificate_profile}}</p>                                                     
                                                    <textarea v-if="status == 1" v-model="info_frofile_user.certificate_profile"  class="main-text textarea" placeholder="VD: - MS Office Khóa học (2018)"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                                </div>
                                            </div>            
                                        </div>                                                                                                                                                                                      
                                    </div>
                                </div> 
                                <div v-bind:class="{'edu-cv': status == 0, 'edu-cv1': status == 1}">
                                    <!--Học vấn-->
                                    <div class="education-cv" style="padding-left:10px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5>HỌC VẤN</h5>
                                            </div>
                                            <p class="main-text textarea" v-if="status == 0" style="margin-left: 20px;margin-top: 20px;">{{info_frofile_user.level_education}}</p>   
                                            <p class="main-text textarea" v-if="status == 0" style="margin-left: 20px;">{{info_frofile_user.name_education}}</p>   
                                            <p class="main-text textarea" v-if="status == 0" style="margin-left: 20px;">{{info_frofile_user.specialized_education}}</p>                                              
                                             <textarea  v-if="status == 1" v-model="info_frofile_user.level_education" class="main-text textarea" placeholder="VD: 12/12"  style="overflow:hidden;margin: 0 15px;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                            <textarea  v-if="status == 1" v-model="info_frofile_user.name_education" class="main-text textarea" placeholder="VD: ĐẠI HỌC ABC"  style="overflow:hidden;margin: 0 15px;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                            <textarea  v-if="status == 1" v-model="info_frofile_user.specialized_education" class="main-text textarea" placeholder="VD: Chuyên ngành CNTT"  style="overflow:hidden;margin: 0 15px;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                        </div>                                                   
                                    </div>                                                                                                                                                                              
                                </div>                                
                            </div>
                            <div class="col-md-4" style="background-color: #28bb9c;padding:0;">
                                <center>
                                    <div style="background-color: #029c7c;" class="img-cv">
                                        <div class="imgg" v-if="status == 0">
                                            <label>
                                                <img v-lazy="`/uploads/users/avatars/${info_frofile_user.avatar_profile}`">
                                            </label>                                                                                                                          
                                        </div>     
                                        <div class="imgg" v-if="status == 1">
                                            <label for="files">
                                                <img v-lazy="images[0]"  v-if="images.length > 0">
                                                <img v-lazy="`/uploads/users/avatars/${info_frofile_user.avatar_profile}`" v-else>
                                            </label>
                                            <input type="file" id="files" class="hidden"  @change="previewFiles" multiple>                                          
                                        </div>  
                                    </div>                        
                                </center>     
                                <br> 
                                <div style="padding-left:25px;padding-right: 10px;"> 
                                    <div class="briday-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-book"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea" v-if="status == 0 && info_frofile_user.type == 1" >Xuất khẩu lao động</p>
                                                <p class="main-text textarea" v-if="status == 0 && info_frofile_user.type == 2" >Du học sinh</p>
                                                <p class="main-text textarea" v-if="status == 0 && info_frofile_user.type == 3" >Tu nghiệp sinh</p>                                                                                                   
                                                <select class="main-select" v-if="status == 1" v-model="info_frofile_user.type">
                                                    <option disabled value="">Chọn Hình thức</option>
                                                    <option value="1">Xuất khẩu lao động</option>
                                                    <option value="2">Du học sinh</option>
                                                    <option value="3">Tu nghiệp sinh</option>
                                                </select>  
                                            </div>                            
                                        </div>                                             
                                    </div>                                
                                    <div class="briday-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea" v-if="status == 0" >{{ConvertDate(info_frofile_user.birthday_profile)}}</p>                                                   
                                                <input v-if="status == 1" v-model="info_frofile_user.birthday_profile" type="date" class="main-text textarea" placeholder="VD: 0000/00/00"  style="overflow:hidden;"/>
                                            </div>                            
                                        </div>                                             
                                    </div> 
                                    <div class="gioitinh-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-venus-mars"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.maleFemale}}</p> 
                                                <div class="radio-MaleFemale" v-if="status == 1">
                                                    <input v-model="info_frofile_user.maleFemale" type="radio" id="Nam" value="Nam"/>
                                                    <label for="Nam">Nam</label>
                                                    <input v-model="info_frofile_user.maleFemale" type="radio" id="Nu" value="Nữ" style="margin-left: 20px;" />
                                                    <label for="Nu">Nữ</label>
                                                </div>                                                 
                                            </div>                            
                                        </div>                                             
                                    </div> 
                                    <div class="address-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-location-arrow"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.address_profile}}</p>
                                                <textarea v-if="status == 1" v-model="info_frofile_user.address_profile" class="main-text textarea" placeholder="VD: 234 Phạm Văn Đồng, Cổ Nhuế, Từ Liêm, thành phố Hà Nội."  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="3"></textarea>                                                   
                                            </div>                            
                                        </div>                                             
                                    </div>                 
                                    <div class="phone-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.phone_profile}}</p>   
                                                <input v-if="status == 1" v-model="info_frofile_user.phone_profile"  class="main-text textarea" placeholder="VD: +84 985372***"  style="overflow:hidden;">                                                 
                                            </div>                            
                                        </div>                                             
                                    </div>
                                    <div class="email-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <!-- <textarea class="hovertexta main-text textarea" v-model="info_frofile_user.email_profile" v-if="status == 0" style="overflow:hidden;"  rows="2" disabled></textarea> -->
                                                <p class="hovertexta main-text textarea" v-if="status == 0" style="overflow:hidden;" >{{info_frofile_user.email_profile}}</p>
                                                <textarea v-if="status == 1" v-model="info_frofile_user.email_profile" class="main-text textarea" placeholder="VD: netbee@gmail.com"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="2"></textarea>
                                            </div>                            
                                        </div>                           
                                    </div>                                   
                                    <div class="note-cv" style="margin-bottom: 16px;">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea" v-if="status == 0">{{info_frofile_user.note_profile}}</p>                                                   
                                                <textarea v-if="status == 1" v-model="info_frofile_user.note_profile" class="main-text textarea" placeholder="VD: Áp dụng những kinh nghiệm về kỹ năng làm việc nhóm và sự hiểu biết của bản thân, mang đến nhiều giá trị cho khách hàng. Từ đó Công ty tăng số lượng khách hàng."  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="7"></textarea>
                                            </div>                            
                                        </div>                         
                                    </div>
                                    <div id="kc"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div id="pdf"></div> 
                <br>                
                <button  v-if="status == 1" class="btn btn-add bg-netbee"  @click="update">Cập nhật</button>                               
                <button class="btn btn-add bg-netbee" v-if="status == 1" @click="canle()">Hủy</button>  
                <div v-if="$auth.user.role == 4 || $auth.user.role == 3 || $auth.user.role == 1">
                    <button class="btn btn-add bg-netbee" v-if="status == 0" @click="statust()">Sửa hồ sơ</button>                
                </div>
                <button class="btn btn-add bg-netbee" v-if="status == 0" @click="dowload()">Xuất PDF</button>               
            </div>   
        </div>  
        <br>
                                          
    </div>
</template>

<script>                
    let html2canvas = null
    let JsPDF = null
    if (process.browser) {
    html2canvas = require('html2canvas')    
    JsPDF = require('jspdf')
    }    
    export default {
        name: 'EditProfileUser',
        layout: 'admin',
        
        data(){
            return {               
                    info_frofile_user: {
                        id:'',
                        id_user:'',
                        fullname_profile:'',
                        birthday_profile:'',
                        type:'',
                        maleFemale:'',
                        avatar_profile:'',
                        address_profile:'',
                        phone_profile:'',
                        email_profile:'',
                        note_profile:'',
                        title_target_profile:'',
                        note_target_profile:'',
                        skill_communication_profile:'',
                        skill_information_profile:'',
                        skill_logic_profile:'',
                        certificate_profile:'',
                        level_education:'',
                        name_education:'',
                        specialized_education:'',
                    },                      
                    fileImg:[], 
                    status: 0,  
                    images: [],                 
                           
                }         
        },        
        components:{
           
        },
        
        methods: {            
            async update(e, route){
                e.preventDefault();                
                var form = new FormData();                             
                form.append('avatar_profile' , this.fileImg[0])
                form.append('id', this.info_frofile_user.id)
                form.append('id_user' , this.info_frofile_user.id_user)
                form.append('fullname_profile' , this.info_frofile_user.fullname_profile)
                form.append('birthday_profile' , this.info_frofile_user.birthday_profile)
                form.append('type' , this.info_frofile_user.type)
                form.append('maleFemale' , this.info_frofile_user.maleFemale)
                form.append('address_profile' , this.info_frofile_user.address_profile)
                form.append('phone_profile' , this.info_frofile_user.phone_profile)
                form.append('email_profile' , this.info_frofile_user.email_profile)                            
                form.append('note_profile' , this.info_frofile_user.note_profile)
                form.append('title_target_profile' , this.info_frofile_user.title_target_profile)
                form.append('note_target_profile' , this.info_frofile_user.note_target_profile)
                form.append('skill_communication_profile' , this.info_frofile_user.skill_communication_profile)
                form.append('skill_information_profile' , this.info_frofile_user.skill_information_profile)
                form.append('skill_logic_profile' , this.info_frofile_user.skill_logic_profile)
                form.append('certificate_profile' , this.info_frofile_user.certificate_profile)
                form.append('level_education' , this.info_frofile_user.level_education)
                form.append('name_education' , this.info_frofile_user.name_education)
                form.append('specialized_education' , this.info_frofile_user.specialized_education)                
                this.$axios.post('hoso/updateProfileUser',form)
                .then(response => {   
                    console.log(response);                                     
                    if(response.data.status == 200) {
                        this.$swal(
                            'Cập nhật thành công',
                            response.data.message,
                            'success'
                            ).then( function (){
                             window.location.reload();
                            } )
                    }else{
                        this.$swal(
                            'Lỗi',
                            response.data.message,
                            'error'
                        )
                    }
                 })
                 .catch(error => {
                    console.log(error.response);
                });                                     
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
            canle(){                
                 this.$swal({
                    title: 'Bạn có chắc chắn?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Quay lại!',
                    cancelButtonText: 'Hủy!',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                    }).then(async (result) => {
                        if(result.value) {
                            window.location.reload();      
                        }
                    })                
            },
            statust(){
                this.status = 1;
            },
            dowload(){  
                this.$swal({
                    title: 'Bạn có chắc chắn?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xuất Pdf!',
                    cancelButtonText: 'Hủy!',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                    }).then(async (result) => {
                        if(result.value) {
                            document.getElementById('kc').innerHTML = '<div class="heg"></div>'
                            html2canvas(document.querySelector('#cv'), {scrollX : 0,scrollY : -scrollY,logging: true, letterRendering: true, allowTaint: false, useCORS: true, scale: 1920*2/window.innerWidth}).then(canvas => {                                
                                document.getElementById('pdf').appendChild(canvas)                             
                                const imgData = canvas.toDataURL('image/jpeg')  
                                let img = canvas.toDataURL('image/jpeg') 
                                let pdf = new JsPDF('p','px','a4')
                               const imgProps= pdf.getImageProperties(imgData)
                                var width = pdf.internal.pageSize.getWidth()
                                var height = pdf.internal.pageSize.getHeight()                                
                                console.log(width);
                                console.log(height);
                                pdf.addImage(img, 'JPEG', 0, 0,width, height) 
                                pdf.save('profile_users.pdf')
                                document.getElementById('pdf').innerHTML = ''                                
                            })      
                            document.getElementById('kc').innerHTML = ''
                        }
                    })                                                                               
            },  
            fetchdata(){
                this.$axios.post('hoso/getProfileUserId',{'id': this.$route.params.id})
                .then(response => {                    
                    this.info_frofile_user = response.data;
                    console.log(this.info_frofile_user);
                 })
                 .catch(error => {
                    console.log(error.response);
                });
      
             }
        },               
        mounted() {      
            this.fetchdata();            
            this.$nextTick(() => {
                this.$el.setAttribute("style", "height",
                `${this.$el.scrollHeight}px`);      
            });
          
        }
    };
</script>
<style scoped>
textarea:hover, input:hover {
     border: 1px dotted #4B6A78;
}
.hovertexta:hover {
    border: 1px dotted #28bb9c;
}
</style>
<style> 
    .heg {
        height: 500px;
    }
    .target-main-cv:hover {
        border: 1px solid #FFF;
    }
   
    .main-skill-cv:hover {
         border: 1px solid #fff;
    }
    .target-ngan1:hover {
        border: 1px solid #029c7c;
    }
    .target-ngan1 {
        border: 1px solid #fff;
    }
    .main-edu-cv:hover .icon-01-01{        
       visibility: visible;
    }
    .main-edu-cv:hover {
        border: 1px solid #029c7c;
    }
    .edu-cv1:hover {
        border: 1px solid #029c7c;
    }
    .edu-cv1 {
        border: 1px solid #fff;
    }
    .skill-cv1:hover {
        border: 1px solid #029c7c;
    }
    .skill-cv1 {
        border: 1px solid #fff;
    }
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
    .img-cv .imgg img {
        width: 238px;
        height: 238px;       
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
    .briday-cv  input::placeholder,.gioitinh-cv input::placeholder,.address-cv textarea::placeholder, .phone-cv input::placeholder, .email-cv input::placeholder, .note-cv textarea::placeholder {
        color:crimson !important;

    }  
    textarea::placeholder{
        color:crimson !important;
    }
    input::placeholder{
        color:crimson !important;
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
  
  
    .target-main-cv {
        border: 1px solid #fff;
    }
   
    .main-skill-cv {
         border: 1px solid #fff;
    }
    .target-ngan {
        padding-left: 10px;
        border: 1px solid #fff;
    }
 
    .main-edu-cv .icon-01-01{        
       visibility: hidden;
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