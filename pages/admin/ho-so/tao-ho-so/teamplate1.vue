<template>
    <div class="app-content content">
         <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <br><br><br><br>
        <div class="container" >   
            <div class="main-cv">     
                <div class="row">
                    <div class="col-md-10" style="background-color: #fff;">                                
                        <div class="row">
                            <div class="col-md-8">
                                <div class="title-h2-cv">
                                    <h2>RESUME</h2>
                                </div>
                                <hr>
                                <div class="title-h3-cv">                                    
                                    <textarea @click="text()" class="main-text textarea" placeholder="VD: NGUYỄN VĂN A"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
                                </div>
                                <div class="title-h4-cv">
                                    <h4>NHÂN VIÊN XUẤT KHẨU LAO ĐỘNG</h4>
                                </div>
                                <br><br>
                                <div class="target-main-cv">
                                    <div class="target-cv">
                                        <div class="row">
                                            <div class="col-md-6" >
                                                <h5>MỤC TIÊU NGHỀ NGHIỆP</h5>
                                            </div>
                                        </div>                                                                        
                                    </div>
                                    <div class="target-ngan">                                
                                        <div class="target-Short-term-cv" >
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>MỤC TIÊU CỦA BẠN</h6>
                                                </div>
                                                <div class="col-md-6" style="text-align: right;">
                                                    <span>12/10/1997</span>
                                                    <span> - </span>
                                                    <span>12/10/1997</span>
                                                </div>
                                            </div>                        
                                        </div>
                                        <div class="target-company-cv">
                                            <textarea @click="text()" class="main-text textarea" placeholder="VD: NHÂN VIÊN XUẤT KHẨU LAO ĐỘNG TẠI CÔNG TY PROVIP123"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>                                    
                                        </div>
                                        <div class="target-Short-term-note-cv">
                                            <textarea @click="text()" class="main-text textarea" placeholder="VD: Mong muốn làm việc trong một môi trường năng động, vui vẻ, thỏa sức đưa ra các ý tưởng, sự sáng tạo và đặc biệt là được theo đuổi ngành nghề yêu thích của mình. Đưa bản thân vào một môi trường làm việc có kỷ luật, nâng cao tinh thần trách nhiệm và khả năng chịu áp lực, giải quyết vấn đề một cách sáng tạo và hiệu quả ở một vị trí đầy thách thức."  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="5"></textarea>        
                                        </div>
                                    </div>                                  
                                </div>
                                <div class="skill-cv">
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
                                                  <textarea @click="text()" class="main-text textarea" placeholder="VD: Tốt"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                                </div>
                                            </div>            
                                        </div>
                                        <div class="Information">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <p>Tin học văn phòng(Word, Excel, Power Point):</p>
                                                </div>
                                                <div class="col-md-5">
                                                  <textarea @click="text()" class="main-text textarea" placeholder="VD: Tốt"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                                </div>
                                            </div>                                            
                                        </div>     
                                        <div class="logic">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p>Tư duy logic:</p>
                                                </div>
                                                <div class="col-md-9">
                                                  <textarea @click="text()" class="main-text textarea" placeholder="VD: Tốt"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>  
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
                                                  <textarea @click="text()" class="main-text textarea" placeholder="VD: - MS Office Khóa học (2018)"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>  
                                                </div>
                                            </div>            
                                        </div>                                                                                                                                                                                      
                                    </div>
                                </div> 
                                <div class="edu-cv">
                                    <!--Học vấn-->
                                    <div class="education-cv" style="padding-left:10px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5>HỌC VẤN</h5>
                                            </div>
                                            
                                        </div>                                                   
                                    </div>                                    
                                    <div style="padding-left:10px;padding-right:10px;" class="main-edu-cv">  
                                        <div class="icon-01-01 fieldset1" >  
                                            <button class="btn-cv-01 btn-cv-add">Thêm</button>
                                            <button class="btn-cv-01 btn-cv-delete">Xóa</button>                                                                
                                        </div>                                           
                                        <div class="education-cv">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <textarea @click="text()" class="main-text textarea" placeholder="VD: TRƯỜNG ĐẠI HỌC BÔN BA"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>                                                   
                                                </div>
                                                <div class="col-md-4" style="text-align: right;">
                                                    <span>12/10/1997</span>
                                                        <span> - </span>
                                                    <span>12/10/1997</span>
                                                </div>
                                            </div>                                
                                        </div>                  
                                        <div class="education-khoa">
                                            <textarea @click="text()" class="main-text textarea" placeholder="VD: KHOA CÔNG NGHỆ THÔNG TIN"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
                                        </div>                  
                                        <div class="education-cap">
                                            <textarea @click="text()" class="main-text textarea" placeholder="VD: BẰNG CẤP KHÁ"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
                                        </div>                                                                                             
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-4" style="background-color: #28bb9c;padding:0;">
                                <center>
                                    <div style="background-color: #029c7c;" class="img-cv">
                                        <img src="https://www.topcv.vn/upload/images/avatars/no_avatar.jpg">
                                    </div>                        
                                </center>     
                                <br> 
                                <div style="padding-left:25px;padding-right: 10px;">                                
                                    <div class="briday-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea @click="text()" class="main-text textarea" placeholder="VD: 12/10/1997"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
                                            </div>                            
                                        </div>                                             
                                    </div> 
                                    <div class="gioitinh-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-venus-mars"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea @click="text()" class="main-text textarea" placeholder="VD: Nam/Nữ"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
                                            </div>                            
                                        </div>                                             
                                    </div> 
                                    <div class="address-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-location-arrow"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea @click="text()" class="main-text textarea" placeholder="VD: Ngõ 2, đường Bạch Liêu, phường Trường Thi, thành phố Vinh."  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="3"></textarea>
                                            </div>                            
                                        </div>                                             
                                    </div>                 
                                    <div class="phone-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea @click="text()" class="main-text textarea" placeholder="VD: +84 985372698"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>                                
                                            </div>                            
                                        </div>                                             
                                    </div>
                                    <div class="email-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea @click="text()" class="main-text textarea" placeholder="VD: leuleu@gmail.com"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
                                            </div>                            
                                        </div>                           
                                    </div>
                                    <div class="Cmnd-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-address-card"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea @click="text()" class="main-text textarea" placeholder="VD: 173721***"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
                                            </div>                            
                                        </div>                           
                                    </div>
                                    <div class="note-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea @click="text()" class="main-text textarea" placeholder="VD: Chà, thực ra thì mình không giỏi nấu ăn lắm. Chắc các bạn không tin đâu, nhưng mình suýt nữa đã làm cháy cái tạp dề yêu thích nhất của mẹ mình trong lúc cố rán mấy quả trứng. Mong là vẫn có một số bạn trong lớp nấu tử tế hơn mình."  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="7"></textarea>
                                            </div>                            
                                        </div>                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>  
        <br>
    </div>
</template>

<script>           
    var Vue = require('vue');
    
    export default {
        name: 'Teamplate1',
        layout: 'admin',
        
        data(){
            return {
                
            }
        },        
        components:{
                     
        },
        
        methods: {
             mixin_autoResize_resize(event) {
                event.target.style.height = "auto";
                event.target.style.height = `${event.target.scrollHeight}px`;
            },
            text(){
                            
            }
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
   .title-h3-cv .main-text{
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
   .target-company-cv .main-text{
       font-size: 17px;
        font-weight: 500;
        width: 100%;
        border-color: #fff;
   }
   .communication .main-text, .Information .main-text, .logic .main-text{
       width: 100%;
        border-color: #fff;
   }
   .target-Short-term-note-cv .main-text {
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
    .education-cv .main-text {
        font-size: 17px;
        font-weight: 500;
        width: 100%;
        border-color: #fff;
    }

    .skill-mn-cv .main-text {
        font-size: 17px;
        font-weight: 500;
        width: 100%;
        border-color: #fff;
    }
    .education-khoa .main-text {        
        font-size: 13px;
        width: 100%;
        border-color: #fff;
    }
    .education-cap .main-text {
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
    .img-cv img {
        width: 70%;
        margin-top: 50px;
        margin-bottom: 50px;
        border-radius: 50%;
    }    
    .briday-cv ,.gioitinh-cv, .Cmnd-cv,.address-cv, .phone-cv, .email-cv, .note-cv {
        color: #fff;
        margin-top: 10px;
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
    .briday-cv  .main-text,.gioitinh-cv .main-text,.Cmnd-cv .main-text,.address-cv .main-text, .phone-cv .main-text, .email-cv .main-text, .note-cv .main-text {
        font-size: 17px;
        padding-top: 5px;
        width: 100%;
        border-color: #28bb9c;
        background-color: #28bb9c;
        color: #fff;
    }    
    .briday-cv  textarea::placeholder,.gioitinh-cv textarea::placeholder,.Cmnd-cv .main-text::placeholder,.address-cv textarea::placeholder, .phone-cv textarea::placeholder, .email-cv textarea::placeholder, .note-cv textarea::placeholder {
        color:#fff !important;

    }  
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
        border: 1px solid #029c7c;
    }
   
    .main-skill-cv:hover {
         border: 1px solid #029c7c;
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
</style>
<style scoped>
    textarea:focus{              
        border: #4B6A78 1px dotted !important;
    }            
</style>