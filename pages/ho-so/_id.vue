<template>
    <div class="app-content content">
         <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>           
        <div class="container" > 
            <!-- <section class="category p-b-15">
                <div class="container">
                    <div class="row d-flex">
                        <div class="col-md-6 pd-20 pl-0">
                            <a href="/"><i class="fa fa-home m-0"></i> Trang chủ </a>
                            <a href="/ung-vien"><i class="fa fa-caret-right"></i> Danh sách ứng viên</a>
                            <a><i class="fa fa-caret-right"></i> Chi tiết ứng viên</a>
                        </div>
                    </div>
                </div>
            </section>              -->
            <div class="main-cv">                 
                <div class="row">
                    <div class="col-md-10" style="background-color: #fff;box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);">                                
                        <div class="row" id="cv">
                            <div class="col-md-8">
                                <br>
                                <div class="title-h3-cv">       
                                    <p class="main-text textarea">{{info_frofile_user.fullname_profile}}</p>                                       
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
                                    <div class="target-ngan" >                                
                                        <div class="target-Short-term-cv" >
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>MỤC TIÊU CỦA BẠN</h6>
                                                </div>                                              
                                            </div>                        
                                        </div>
                                        <div class="target-company-cv">
                                            <p class="main-text textarea">{{info_frofile_user.title_target_profile}}</p>                                              
                                        </div>
                                        <div class="target-Short-term-note-cv">
                                            <p class="main-text textarea" >{{info_frofile_user.note_target_profile}}</p>                                               
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
                                                    <p class="main-text textarea">{{info_frofile_user.skill_communication_profile}}</p>                                                   
                                                </div>
                                            </div>            
                                        </div>
                                        <div class="Information">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <p>Tin học văn phòng(Word, Excel, Power Point):</p>
                                                </div>
                                                <div class="col-md-5">
                                                    <p class="main-text textarea">{{info_frofile_user.skill_information_profile}}</p>                                                                                                        
                                                </div>
                                            </div>                                            
                                        </div>     
                                        <div class="logic">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p>Tư duy logic:</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="main-text textarea">{{info_frofile_user.skill_logic_profile}}</p>                                                                                                       
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
                                                    <p class="main-text textarea">{{info_frofile_user.certificate_profile}}</p>                                                                                                         
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
                                            <p class="main-text textarea" style="margin-left: 20px;margin-top: 20px;">{{info_frofile_user.level_education}}</p>   
                                            <p class="main-text textarea" style="margin-left: 20px;">{{info_frofile_user.name_education}}</p>   
                                            <p class="main-text textarea" style="margin-left: 20px;">{{info_frofile_user.specialized_education}}</p>                                                                                          
                                        </div>                                                   
                                    </div>                                                                                                                                                                              
                                </div>  
                                <br>                              
                            </div>
                            <div class="col-md-4" style="background-color: #28bb9c;padding:0;">
                                <center>
                                    <div style="background-color: #029c7c;" class="img-cv">
                                        <div class="imgg">
                                            <label>
                                                <img v-lazy="`/uploads/users/avatars/${info_frofile_user.avatar_profile}`">
                                            </label>                                                                                                                          
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
                                                   <p class="main-text textarea" v-if="info_frofile_user.type == 1">Xuất khẩu lao động</p>     
                                                   <p class="main-text textarea" v-if="info_frofile_user.type == 2">Du học sinh</p>     
                                                   <p class="main-text textarea" v-if="info_frofile_user.type == 3">Tu nghiệp sinh</p>                                            
                                            </div>                            
                                        </div>                                             
                                    </div>                                
                                    <div class="briday-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea">{{ConvertDate(info_frofile_user.birthday_profile)}}</p>                                                
                                            </div>                            
                                        </div>                                             
                                    </div> 
                                    <div class="gioitinh-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-venus-mars"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea">{{info_frofile_user.maleFemale}}</p>                                                                                                
                                            </div>                            
                                        </div>                                             
                                    </div> 
                                    <div class="address-cv">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fa fa-location-arrow"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea">{{info_frofile_user.address_profile}}</p>                                                
                                            </div>                            
                                        </div>                                             
                                    </div>                                                                                       
                                    <div class="note-cv" style="margin-bottom: 16px;">
                                        <div class="row">
                                            <div class="col-md-2 icon-cv-profile">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <p class="main-text textarea">{{info_frofile_user.note_profile}}</p>                                                                                                   
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
    export default {
        name: 'GetCvProfileUser',        
        
        data(){
            return {               
                    info_frofile_user: {},                                                                                    
                }         
        },        
        components:{
           
        },
        
        methods: {                                                                                                                           
            fetchdata(){
                this.$axios.post('getProfileUserId',{'id': this.$route.params.id})
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
        }
    };
</script>
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
        margin-top: 20px;
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