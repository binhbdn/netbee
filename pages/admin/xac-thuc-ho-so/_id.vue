<template>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="dashboard-ecommerce" v-if="paper == null">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <form-wizard class="for" color="#FFB701" error-color="red" @on-complete="onComplete" back-button-text="Quay lại" next-button-text="Tiếp" finish-button-text="Hoàn tất">
                                        <tab-content :before-change="checkValidateStep1" icon="fas fa-check">
                                            <ValidationObserver ref="step1" v-slot="{ valid1 }">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="title">
                                                                    <h3>Ảnh CMND/Căn cước mặt trước</h3>
                                                                </label>
                                                                <ImgUploaderPaper :files="data.front_id_card" v-model="data.front_id_card" :type="1"></ImgUploaderPaper>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    <h3>Ảnh CMND/Căn cước mặt sau</h3>
                                                                </label>
                                                                <ImgUploaderPaper :files="data.back_id_card" v-model="data.back_id_card" :type="2"></ImgUploaderPaper>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                </div>
                                            </ValidationObserver>   
                                        </tab-content>
                                        <tab-content :before-change="checkValidateStep2" icon="fas fa-check">
                                            <ValidationObserver ref="step2" v-slot="{ valid2 }">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    <h3>Ảnh thẻ chân dung (3x4)</h3>
                                                                </label>
                                                                <ImgUploaderPaper :files="data.card_photo" v-model="data.card_photo"  :type="3"></ImgUploaderPaper>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="firstName3">
                                                                <h3>Hộ chiếu</h3>
                                                            </label>
                                                            <ImgUploaderPaper :files="data.passport" v-model="data.passport" :type="4"></ImgUploaderPaper>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                        <tab-content :before-change="checkValidateStep3" icon="fas fa-check">
                                            <ValidationObserver ref="step3" v-slot="{ valid3 }">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    <h3>Giấy khai sinh</h3>
                                                                </label>
                                                                <ImgUploaderPaper :files="data.birth_certificate" v-model="data.birth_certificate" :type="5"></ImgUploaderPaper>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="firstName3">
                                                                <h3>Sơ yếu lý lịch</h3>
                                                            </label>
                                                            <ImgUploaderPaper :files="data.curriculum_vitae" v-model="data.curriculum_vitae" :type="6"></ImgUploaderPaper>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                        <tab-content icon="fas fa-check">
                                            <ValidationObserver ref="step4" v-slot="{ valid4 }">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    <h3>Giấy khám sức khỏe</h3>
                                                                </label>
                                                                <ImgUploaderPaper :files="data.health_certification" v-model="data.health_certification" :type="7"></ImgUploaderPaper>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="firstName3">
                                                                <h3>Bằng tốt nghiệp</h3>
                                                            </label>
                                                            <ImgUploaderPaper :files="data.high_school_diploma" v-model="data.high_school_diploma" :type="8"></ImgUploaderPaper>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                    </form-wizard>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 pl-lg-0">
                            <div class="card text-center bg-netbee">
                                <div class="card-content">
                                    <div class="card-body p-2">
                                        <div class="text-center">
                                            <img src="/assets/img/logo.png" width="70px">
                                            <p class="__title">Quy trình tuyển dụng tại Netbee</p>
                                        </div>
                                        <div class="text-left">
                                            <p>1. Tạo tin tuyển dụng</p>
                                            <p>2. Chờ admin xét duyệt tin(Thông báo qua email)</p>
                                            <p>3. Nhận hồ sơ giới thiệu từ chuyên viên tuyển sinh(Thông báo khi có lượt ứng tuyển)</p>
                                            <p>4. Xét duyệt hồ sơ và book lịch phỏng vấn(Lượt ứng tuyển chỉ trong trạng thái chờ tối đa 3 ngày)</p>
                                            <p>5. Xác nhận thanh toán phần bonus giới thiệu cho Chuyên viên tuyển sinh</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section v-else>
                    <h1>Giấy tờ của bạn đã được gửi đi <i class="fas fa-check success"></i> </h1>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
//global registration
import Vue from 'vue'
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import { ValidationProvider, extend } from 'vee-validate/dist/vee-validate.full';
import { ValidationObserver } from "vee-validate/dist/vee-validate.full";
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
import moment from 'moment'
import ImgUploaderPaper from '~/components/ImgUploaderPaper';

Vue.use(VueFormWizard)
Vue.use(Datetime)

extend("ssdate", {
    message: field => "Ngày dự kiến phải lớn hơn ngày hiện tại",
    validate: value => {
        var date = moment(value)
        if(moment(Date.now()).isBefore(date)){
            return true
        }else{
            return false
        }
    }
})

var errorMessage
extend('checkSelect', {
    message: field => errorMessage,
    validate: value => {
        if(value.id == null || value.id == 0) {
            errorMessage = "Dữ liệu không được bỏ trống"
            return false
        } else return true
    }
})

export default {
    name: 'Verify',
    layout: 'admin',
    data () {
        return {
            paper: null,
            data: {
                'front_id_card': [],
                'back_id_card': [],
                'health_certification': [],
                'high_school_diploma': [],
                'passport': [],
                'birth_certificate': [],
                'curriculum_vitae': [],
                'card_photo': [],
                'apply_id' : this.$route.params.id
            },
        }
    },
    components:{
        Multiselect,
        ValidationProvider,
        ValidationObserver,
        Datetime,
        ImgUploaderPaper
    },
    methods:{
        nameWithLang ({ name, id }) {
            return `${name}`
        },
        async checkValidateStep1(){
            let isValid = await this.$refs.step1.validate();
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    if(isValid){
                        resolve(true)
                    } else {
                        reject()
                    }
                }, 100)
            })
        },

        async checkValidateStep2(){
            let isValid = await this.$refs.step2.validate();
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    if(isValid){
                        resolve(true)
                    } else {
                        reject()
                    }
                }, 100)
            })
        },

        async checkValidateStep3(){
            let isValid = await this.$refs.step3.validate();
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    if(isValid){
                        resolve(true)
                    } else {
                        reject()
                    }
                }, 100)
            })
        },

        async onComplete() {
            let isValid = await this.$refs.step4.validate();
            var form = new FormData();
            if(isValid){
                form.append('front_id_card' , this.data.front_id_card[0])
                form.append('back_id_card' , this.data.back_id_card[0])
                form.append('health_certification' , this.data.health_certification[0])
                form.append('high_school_diploma' , this.data.high_school_diploma[0])
                form.append('passport' , this.data.passport[0])
                form.append('birth_certificate' , this.data.birth_certificate[0])
                form.append('curriculum_vitae' , this.data.curriculum_vitae[0])
                form.append('card_photo' , this.data.card_photo[0])
                form.append('apply_id' , this.data.apply_id)
                this.$axios.post('apply/PostPaperApply',form)
                .then(response => {
                    if(response.data.status == 200) {
                        this.$swal(
                            'Thành công',
                            response.data.message,
                            'success'
                        ).then( function (){
                            window.location.href = '/admin/quan-ly-ung-tuyen';
                        } )
                    }else{
                        this.$swal(
                            'Lỗi',
                            response.data.message,
                            'error'
                        )
                    }
                })
            }
        }
    },
    mounted () {
        this.$axios.$get('apply/getPaperApply/'+this.$route.params.id).then((res) => {
            this.paper = res.data
        });
    }
}
</script>

<style>
.vue-form-wizard.md .wizard-navigation .wizard-progress-with-circle {
    position: relative;
    top: 25px !important;
    height: 3px;
}

.vue-form-wizard.md .wizard-icon-circle {
    width: 40px !important;
    height: 40px !important;
    font-size: 24px;
} 

.wizard-header{
    display: none;
}

.vdatetime-popup__header{
    background: #ffb701;
}

.vdatetime-calendar__month__day--selected > span > span, .vdatetime-calendar__month__day--selected:hover > span > span{
    background: #ffb701;
}

.vdatetime-popup__actions__button{
    color: #ffb701;
}

.vdatetime-month-picker__item--selected{
    color: #ffb701;
}

.vdatetime-year-picker__item--selected{
    color: #ffb701;
}

.multiselect,
.multiselect__input,
.multiselect__single {
    font-size: 14px;
}

.vs-checkbox-con .vs-checkbox{
    border-width: 1px;
}

.option:hover {
    background-color: #ffc108 !important;
}

.high {
    background-color: #ffc108;
}

.normal {
    background-color: #ffc10842;
}

.custom-control-label::after {
    width: 1.5rem;
    height: 1.5rem;
    top: -1px;
    left: -24px;
}

.vue-form-wizard .wizard-nav-pills>li.active>a .wizard-icon, .vue-form-wizard .wizard-nav-pills>li.active>a:focus .wizard-icon, .vue-form-wizard .wizard-nav-pills>li.active>a:hover .wizard-icon{
    color: #000000ab;
}

.wizard-btn{
    color: #000 !important;
}

.multiselect__option--highlight {
    background: #ffb701;
    color: #000;
}
.detail-active {
    display: none;
    position: relative;
    border-radius: 5px;
}
.detail-active p{
    font-weight: 600;
}
.detail-active::before {
    content: '';
    position: absolute;
    top: 0;
    width: 0.75rem;
    right: 15px;
    height: 0.75rem;
    display: block;
    background: #ffc108;
    transform: rotate(45deg) translate(-7px);
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    border-left: 1px solid rgba(0, 0, 0, 0.1);
    z-index: 10;
    box-sizing: border-box;
}
#goi1:hover .detail-active{
display: block;
}
#goi2:hover .detail-active{
display: block;
}
#goi3:hover .detail-active{
display: block;
}
.uploader .file-input{
    width: auto !important;
}
.wizard-card-footer{
    padding: 0 !important;
}
@media (max-width: 1199px){
    h3{
        font-size: 1.25rem;
    }
}
</style>
