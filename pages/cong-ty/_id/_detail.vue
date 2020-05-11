<template>
    <div class="container" style="padding-top:100px">
        <div>
            <img style="width:100%; height:296px" src="https://images.careerbuilder.vn/employer_folders/lot2/123152/90115bannerjobstreet.png">
        </div>
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row p-1">
                        <div class="col-lg-2 d-flex align-items-center">
                            <div class="avatar-company">
                                <img v-lazy="`/uploads/users/avatars/${congty.avatar}`" :alt="`${congty.avatar}`" width="100%">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="company-job-title">
                                <h2 class="font-weight-bold text-uppercase"><span class="company-name"  data-toggle="tooltip" data-placement="right" :title="`${congty.name}`"> {{ congty.name }} <i data-toggle="tooltip" data-placement="top" title="Công ty đã xác thực" class="fad fa-check btn-verify"></i></span></h2>
                                <p><span class="font-weight-600"><i class="fad fa-map-marked-alt"></i> Địa chỉ: {{ congty.address_detail ? congty.address_detail: 'Đang cập nhật' }}</span></p>
                                <p><span class="font-weight-600"><i class="fad fa-phone-office"></i> Hotline: {{ congty.company_hotline ? congty.company_hotline: 'Đang cập nhật' }}</span></p>
                                <p><span class="font-weight-600"><i class="fad fa-link"></i> Website: {{ congty.company_link ? congty.company_link: 'Đang cập nhật' }}</span></p>
                                <p><span class="font-weight-600"><i class="fad fa-calendar-minus"></i> Ngày thành lập: {{ congty.birth_of_date ? ConvertDate(congty.birth_of_date): 'Đang cập nhật' }}</span></p>
                            </div>
                        </div>
                        <div class="col-lg-2 count-job">
                            <h1 style="font-size: 70px;color: #ffb701;">{{ countJob.length ? countJob.length : '0' }}</h1>
                            <h2>Việc làm</h2>
                        </div>
                        <div class="col-lg-2" style="padding-top:30px; padding-left: 10px">
                            <button class="btn btn-outline-secondary mt-2">Theo dõi công ty</button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="row">
          <div class="col-lg-8 col-12 p-r-0">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row p-t-10">
                        <div class="col-12">
                            <div class="col-4 p-l-0">
                                <h5 class="font-weight-600 line-title">GIỚI THIỆU CÔNG TY</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p v-html="congty.company_about"></p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                            <div class="col-4 p-l-0">
                                <h5 class="font-weight-600 line-title">CHẾ ĐỘ ĐÃI NGỘ</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p v-html="congty.company_benefit"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-4 p-l-0">
                                <h5 class="font-weight-600 line-title">CƠ HỘI THĂNG TIẾN</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p v-html="congty.company_chance"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-4 p-l-0">
                                <h5 class="font-weight-600 line-title">CHÍNH SÁCH TUYỂN DỤNG</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p v-html="congty.company_policy"></p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
              </div>
            </div>
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">
                    Công việc đang tuyển
                </h3>
                </div>
                <div class="card-content collapse show">
                <div class="card-body">
                    <JobsList1ColNotCate :DataList="arrayForCompany"></JobsList1ColNotCate>
                </div>
                </div>
            </div>
          </div>
          <div class="col-lg-4 col-12">
              <div class="card p-1">
                <div class="card-header pl-0">
                <h3 class="card-title">
                    Đánh giá tổng thể
                </h3>
                <div class="star-rating pt-1">
                      <star-rating 
                      :rating="5" 
                      :increment="0.1"
                      :star-size="30"
                      :read-only="true"
                      ></star-rating>
                    </div>
                </div>
                <hr>
                <div class="view-more">
                    <a href="/companies/lg-development-center-vietnam/review">Xem tất cả đánh giá</a>
                </div>
            </div>
            <div class="card p-1">
                <div class="card-header pl-0">
                <h3 class="card-title w-100">
                    Top đánh giá
                </h3>
                <br>
                <h5 class="w-100 mb-0 pt-1">
                    "Công ty tốt"
                </h5>
                <div class="star-rating pt-1">
                      <star-rating 
                      :rating="5" 
                      :increment="0.1"
                      :star-size="30"
                      :read-only="true"
                      ></star-rating>
                    </div>
                </div>
                <div class="view-more">
                    <p>
                    - Công việc ổn đinh, chủ yếu làm việc với khách hàng nước ngoài ( Mỹ, Đức, Hàn Trung)
                    - Sếp thoải mái, tâm lý
                    - Có budget ăn uống, chơi bời hoành tráng
                    - Nhiều event, team building
                    - Được tính lương OT theo luật, có voucher ăn tối nếu OT muộn
                    ...
                    </p>
                </div>
                <hr>
                <h5 class="w-100 mb-0 pt-1">
                    "Công ty tốt"
                </h5>
                <div class="star-rating pt-1">
                      <star-rating 
                      :rating="5" 
                      :increment="0.1"
                      :star-size="30"
                      :read-only="true"
                      ></star-rating>
                </div>
                <div class="view-more">
                    <p>
                    - Công việc ổn đinh, chủ yếu làm việc với khách hàng nước ngoài ( Mỹ, Đức, Hàn Trung)
                    - Sếp thoải mái, tâm lý
                    - Có budget ăn uống, chơi bời hoành tráng
                    - Nhiều event, team building
                    - Được tính lương OT theo luật, có voucher ăn tối nếu OT muộn
                    ...
                    </p>
                </div>
                <hr>
                <div v-if="!$auth.loggedIn" class="col-sm-12 col-xl-12 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#loginModal">
                    <a style="font-size:16px" class="btn btn-warning w-100" data-toggle="tooltip" data-placement="top" :title="'Viết phản hồi'">Viết phản hồi</a>
                </div>
                <div v-else class="col-sm-12 col-xl-12 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#feedbackModal">
                    <a style="font-size:16px" class="btn btn-warning w-100" data-toggle="tooltip" data-placement="top" :title="'Viết phản hồi'">Viết phản hồi</a>
                </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Modal -->
        <div class="modal fade text-left" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="col-md-12 col-lg-12 formlogin form-control" >
                    <h2 class="text-center mt-1" style="margin-bottom:15px">Vui lòng đăng nhập</h2>
                    <p class="text-center" style="margin-bottom:20px; font-size: 16px; "><a class="hover" href="dang-ky">Đăng ký tài khoản mới!</a>
                    </p>
                    <div class="form-group-1 input-login" v-on:keyup.enter="login" style="position:relative; padding-bottom:20px">
                        <ValidationObserver ref="observer" v-slot="{ valid }">
                            <ValidationProvider name="Email" ref="email" rules="required|email" v-slot="{ errors }">
                                <div class="__email">
                                    <fieldset class="form-label-group form-group position-relative has-icon-left mb-0">
                                        <input type="text" class="form-control mb-0" id="email" placeholder="Email" v-model="userForm.email" style="margin-bottom:37px !important; margin-top:2px">
                                        <div class="form-control-position">
                                            <i class="far fa-envelope" style="color: rgba(34, 41, 47, 0.4)!important"></i>
                                        </div>
                                        <label for="email">Email</label>
                                        <ul style="color:red" class="overline text-left">
                                        <li v-for="(error, index) in errors" :key="index">
                                        <span style="left:2px; position:absolute;top:42%!important; font-size:13px"><i>{{ error }}</i></span>
                                        </li>
                                    </ul>
                                    </fieldset>
                                </div>
                            </ValidationProvider>
                        <div style="position: relative">
                            <ValidationProvider
                                name="Mật khẩu"
                                ref="password"
                                rules="required|customPassword"
                                v-slot="{ errors }"
                            >
                            <div class="__email">
                                <div style="text-align:right">
                                    <i  class="showpass">
                                        <i @click="showPassword()" :class="show ?'fa fa-eye':'fas fa-eye-slash'"></i>
                                    </i>
                                    
                                </div>
                                <fieldset class="form-label-group position-relative has-icon-left mb-0">
                                    <input class="form-control mb-0" id="password" :type="show ? 'password' : 'text'" placeholder="Mật khẩu" v-model="userForm.password" style="margin-bottom:0px !important; margin-top:2px">
                                    <div class="form-control-position">
                                        <i class="fas fa-lock" style="color: rgba(34, 41, 47, 0.4)!important"></i>
                                    </div>
                                    <label for="password">Mật khẩu</label>
                                    <ul style="color:red" class="overline text-left">
                                        <li v-for="(error, index) in errors" :key="index">
                                        <span style="top: 53%!important;left: 0px; font-size:15px;"><i>{{ error }}</i></span>
                                        </li>
                                    </ul>
                                    <p class="text-right mb-0 mt-2"><a href="/quen-mat-khau" class="remember hover" style="font-size: 15px;color:black!important;">Quên mật khẩu?</a></p>
                                </fieldset>
                            </div>
                            </ValidationProvider>
                            <div class="lopgin-c" style="padding-top:10px">
                                <button @click="login()" id="submit" class="submit btn" style="height:100%; line-height: unset; padding:10px!important">ĐĂNG NHẬP</button>
                            </div>
                            <div class="or-box">
                                <hr>
                                <span>Hoặc</span>
                            </div>
                            <div class="lopgin-c" style="position:relative">
                                <i class="fab fa-facebook" style="position: absolute; left: 106px; top: 10px; color: white; font-size: 18px; z-index:5"></i>
                                <a @click="loginfb()" class="btn btn-outline-info fb" style="padding: 10px!important" >Đăng nhập bằng
                                    Facebook</a> &nbsp;&nbsp;
                            </div>
                            <div class="lopgin-c" style="position:relative">
                                <img src="../../../static/assets/img/logo-google.png" style="height:15px;position: absolute; left: 106px; top: 11px; color: blue; font-size: 18px;">
                                <a @click="logingg()" class="btn btn-outline-info gg" style="padding: 10px!important">Đăng nhập bằng Google</a>
                            </div>
                        </div>
                        </ValidationObserver>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- end Modal login -->
        <!-- Modal feedback -->
        <div class="modal fade text-left" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="col-md-12 col-lg-12 formlogin form-control" >
                    <h2 class="text-center mt-1" style="margin-bottom:15px">Viết phản hồi</h2>
                    <div class="form-group-1 input-login" v-on:keyup.enter="login" style="position:relative; padding-bottom:20px">
                        <div class="star-rating pb-1">
                        <star-rating 
                            :rating="4.3" 
                            :increment="0.1"
                            :star-size="30"
                        ></star-rating>
                        </div>
                        <ValidationObserver ref="observer" v-slot="{ valid }">
                        <div style="position: relative">
                            <ValidationProvider
                                name="content"
                                ref="content"
                                rules="required"
                                v-slot="{ errors }"
                            >
                            <div class="__email">
                                <fieldset class="form-label-group position-relative has-icon-left mb-0">
                                    <textarea class="form-control mb-0" id="content" placeholder="Nội dung phản hồi" v-model="userForm.content" style="padding-left:10px;margin-bottom:0px !important; margin-top:2px"></textarea>
                                    <label for="content">Nội dung</label>
                                    <ul style="color:red" class="overline text-left">
                                        <li v-for="(error, index) in errors" :key="index">
                                        <span style="top: 53%!important;left: 0px; font-size:15px;"><i>{{ error }}</i></span>
                                        </li>
                                    </ul>
                                </fieldset>
                            </div>
                            </ValidationProvider>
                            <div class="lopgin-c" style="padding-top:20px">
                                <button @click="sendFeedback()" id="submit" class="submit btn" style="height:100%; line-height: unset; padding:10px!important">Gửi phản hồi</button>
                            </div>
                            
                        </div>
                        </ValidationObserver>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- end Modal Feedback -->
    </div>
</template>
<script>
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate'
import StarRating from 'vue-star-rating'
import {
  ValidationProvider,
  extend
} from "vee-validate/dist/vee-validate.full";
import { ValidationObserver } from "vee-validate/dist/vee-validate.full";



extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});
extend("email", {
  message: (field, values) => "Email không đúng định dạng"
});
var errorMessage =
  " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 số.";
// create custom rule
extend("customPassword", {
  message: field =>"Mật khẩu" + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s]/;
    var mustContainTheseChars = /^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
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
          " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 số.";
      }
      return false;
    }
  }
});
export default {
    layout: 'no_banner',
    components: {
        JobsList1ColNotCate,StarRating,
        ValidationProvider,
        ValidationObserver,
    },
    data() {
        return {
            arrayForCompany: [],
            countJob: '',
            userForm: {
                email: '',
                password: '',
                content: ''
            },
            show: true,
        }
    },
    methods: {
        saveJob() {
            this.$axios.$post(`tintuyendung/postSave`,{id_job: this.tintuc.id}).then((response)=>{
                if(response.status == 200) {
                    this.$swal(
                    'Thành công!',
                        response.message,
                    'success'
                    );
                    this.save = response.data
                }else {
                    this.$swal(
                    'Lỗi!',
                        response.message,
                    'error'
                    );
                    this.save = response.data
                }
            }).catch((e) => {
                this.$swal(
                'Cảnh báo!',
                'Bạn cần đăng nhập để thực hiện chức năng này',
                'warning'
                );
            });
        },
        async login() {
            const isValid = await this.$refs.observer.validate();
            if(isValid){
            try {
                    let response = await this.$auth.loginWith('local',{ data: this.userForm });
                    window.location.reload();
            } catch (err) {
                this.$swal(
                        'Lỗi!',
                        'Tài khoản hoặc mật khẩu không đúng!',
                        'error'
                    )
                }
            }
        },
        showPassword(){
            this.show = !this.show;
        },
        loginfb() {
            this.$auth.loginWith('facebook')
        },
        logingg() {
            this.$auth.loginWith('google')
        },
        sendFeedback(){
            console.log(1);
        }
    },  
    async asyncData (context) {
        try {
        let detailRes = await context.app.$axios.$get(`getInfoCompanyById/${context.app.router.currentRoute.params.id}`)
        context.seo({
                name: detailRes.data[0].name,
                title: detailRes.data[0].name,
                keywords: detailRes.data[0].name.replace(/ /g, ","),
                description: detailRes.data[0].company_about,
                openGraph: {
                    title: detailRes.data[0].name,
                    url: `https://netbee.vn${context.app.router.currentRoute.path}`,
                    description: detailRes.data[0].company_about,
                    image: `https://netbee.vn/uploads/users/avatars${detailRes.data[0].avatar}`
				}
            })
        return { congty: detailRes.data[0] }
        }catch (er) {
            return {congty : []}
        }
    },
    mounted() {
        this.$axios.$get(`getTinTuyenDungForCompany/${this.congty.company_id}?limit=5`).then((response)=>{
            this.arrayForCompany = response.data.tintuyendung
            this.countJob = response.data.count
        });
    },
    jsonld() {
        return {
            "@context": "http://schema.org/",
            "@type":"EmployerAggregateRating",
            "itemReviewed":{
                "@type":"Organization",
                "name": this.congty.name,
                "sameAs": 'https://netbee.vn'+this.$route.path
                },
            "ratingValue": "4",
            "bestRating": "5",
            "worstRating": "3",
            "ratingCount": "5"
        };
    },
}
</script>
<style scoped>
.line-title {
    border-bottom: 2px solid #ffb701;
    padding-bottom: 5px;
}
.view-more a {
    color: #57595B !important;
    font-size: 15px;
    text-decoration: none;
    display: inline-block;
    border-bottom: 1px dotted;
}
.col-lg-2 button{
    width:100%; padding: 16px; font-size:16px;
}
.col-lg-2 .btn-outline-secondary:hover {
    border-color: #EA2635;
    -webkit-transform: scale(1.01);
    transform: scale(1.01);
    color: #EA2635;
    background-color: #fff;
}
.avatar-company {
    width: 170px;
}
.count-job {
    border: 1px solid;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
}
.btn-verify {
    color: #4267b2 !important;
    padding: 5px;
}
.btn-verify:hover {
    background: #4267b2 !important;
    color: #fff !important;
    padding: 5px;
    border-radius: 50%;
}
</style>