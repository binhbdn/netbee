<template>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-9 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>tạo tin tuyển xuất khẩu lao động</h4>
                                </div>
                                <div class="card-body">
                                    <form-wizard color="#ffb701" error-color="red" @on-complete="onComplete">
                                        <tab-content :before-change="checkValidateStep1" title="Tổng quan">
                                            <ValidationObserver ref="step1" v-slot="{ valid1 }">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="title">
                                                                    Tiêu đề
                                                                </label>
                                                                <input type="text" class="form-control" v-model="data.title">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Địa điểm
                                                                </label>
                                                                <input type="text" class="form-control required" v-model="data.address">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Quốc gia
                                                                </label>
                                                                <multiselect :options="options" v-model="data.nation" :custom-label="nameWithLang" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Chọn quốc gia"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="ssdate" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Ngày hết hạn ứng tuyển
                                                                </label>
                                                                <!-- <datetime v-model="data.expiration_date" input-class="form-control"></datetime> -->
                                                                <input type="date" class="form-control" v-model="data.expiration_date">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                </div>
                                            </ValidationObserver>   
                                        </tab-content>
                                        <tab-content :before-change="checkValidateStep2" title="Chi tiết">
                                            <ValidationObserver ref="step2" v-slot="{ valid2 }">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Lộ trình
                                                                </label>
                                                                <textarea rows="3" class="form-control" v-model="data.description"></textarea>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }" >
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Yêu cầu
                                                                </label>
                                                                <textarea rows="3" class="form-control" v-model="data.request"></textarea>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Hồ sơ cần chuẩn bị
                                                                </label>
                                                                <textarea rows="3" class="form-control" v-model="data.cv_content"></textarea>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Quyền lợi
                                                                </label>
                                                                <textarea rows="3" class="form-control"  v-model="data.benefit"></textarea>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                        <tab-content :before-change="checkValidateStep3" title="Yêu cầu">
                                            <ValidationObserver ref="step3" v-slot="{ valid3 }">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">
                                                                Tuổi
                                                            </label>
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-6" style="padding-left:0px">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                                            <input type="number" class="form-control" v-model="data.age_start" placeholder="Từ">
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    <div class="col-6" style="padding-right: 0px">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                                            <input type="number" class="form-control" v-model="data.age_late" placeholder="Đến">
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">
                                                                Lương:
                                                            </label>
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-6" style="padding-left:0px">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                                            <input type="number" class="form-control" v-model="data.salary_start" placeholder="Từ">
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    <div class="col-6" style="padding-right: 0px">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                                            <input type="number" class="form-control" v-model="data.salary_end" placeholder="Đến">
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Số lượng tuyển
                                                                </label>
                                                                <input type="number" class="form-control" v-model="data.quantity">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Phí nhập cảnh
                                                                </label>
                                                                <input type="number" class="form-control required" v-model="data.subsidy">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                     <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Ngành nghề xin visa
                                                                </label>
                                                                <multiselect :options="optionsVisa" v-model="data.visa" :custom-label="nameWithVisa" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Chọn ngành nghê xin visa"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                     <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Hình thức làm việc
                                                                </label>
                                                                <multiselect :options="optionsFormWork" v-model="data.form_work" :custom-label="nameWithLang" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Chọn hình thức làm việc"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Loại tiền
                                                                </label>
                                                                <multiselect :options="money" v-model="data.currency" :searchable="false" :close-on-select="false" 
                                                                        :show-labels="false" placeholder="Chọn loại tiền"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Ngày bắt đầu nhận hồ sơ
                                                                </label>
                                                                <input type="date" class="form-control" v-model="data.date_start">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required|ssdate" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Ngày thi tuyển
                                                                </label>
                                                                <input type="date" class="form-control" v-model="data.date_test">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required|ssdate" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Ngày dự kiến nhập cảnh
                                                                </label>
                                                                <input type="date" class="form-control required" v-model="data.expected_date">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                        <tab-content title="Hoàn thành">
                                            <ValidationObserver ref="step4" v-slot="{ valid4 }">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <fieldset>
                                                            <div class="vs-checkbox-con vs-checkbox-warning">
                                                                <input type="checkbox" v-model="checked" :checked="checked">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">Bonus</span>
                                                            </div>
                                                        </fieldset>
                                                    </div>  
                                                    <div class="col-4">
                                                        <ValidationProvider rules="required" v-slot="{ errors }" v-if="checked">
                                                                <div class="form-group">
                                                                    <label for="firstName3">
                                                                        Thời gina bảo hành
                                                                    </label>
                                                                    <multiselect :options="guarantee" v-model="data.time_bonus" :custom-label="nameWithLang" :searchable="false" :close-on-select="false" 
                                                                        :show-labels="false" placeholder="Chọn thời gian bảo hành" :disabled="!checked"></multiselect>
                                                                    <span style="color: red">{{ errors[0] }}</span>
                                                                </div>
                                                            </ValidationProvider>
                                                    </div>
                                                    <div class="col-4">
                                                        <ValidationProvider rules="required" v-slot="{ errors }" v-if="checked">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Tiền bonus
                                                                </label>
                                                                <input type="number" class="form-control" v-model="data.bonus" :disabled="!checked">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-4" v-if="checked">
                                                        <div class="form-group">
                                                            <label for="firstName3">
                                                                Tiền bonus thực nhận
                                                            </label>
                                                            <input type="number" class="form-control" disabled :value=" data.time_bonus.id == 1 ? data.bonus : data.time_bonus.id == 2 ? data.bonus * 1.5 : data.bonus * 2">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 pl-0">
                                                        <div class="card option px-3 high" id="high" style="color: #000;">
                                                            <div class="custom-control custom-radio ml-2">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="defaultGroupExample2" value="1" v-model="data.highlight_job" :checked="data.highlight_job == 1">
                                                                <label class="custom-control-label"
                                                                    for="defaultGroupExample2">Tin
                                                                    nổi bật</label>
                                                            </div>
                                                            <p>- Được ưu tiên gợi ý</p>
                                                            <p>- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                            <p>- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                            <p>- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                            <p>- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card option px-3 normal" id="normal" style="color: #000;">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="defaultGroupExample1" value="0" v-model="data.highlight_job" :checked="data.highlight_job == 0">
                                                                <label class="custom-control-label"
                                                                    for="defaultGroupExample1">Tin
                                                                    thường</label>
                                                            </div>
                                                            <p>- Được ưu tiên gợi ý</p>
                                                            <p>- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                            <p>- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                            <p>- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                            <p>- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                    </form-wizard>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body p-2">
                                        <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                            <div class="avatar-content">
                                                <i class="feather icon-heart text-info font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700">Cập nhật thông tin</h2>
                                        <p class="mb-0 line-ellipsis">Cập nhật các thông tin, kỹ năng, học vấn, kinh nghiệm... mà bạn yêu cầu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

// extend('checkage', {
//     message: field => errorMessage,
//     validate: value => {
//         if(value < '18') {
//             errorMessage = "Tuổi không được nhỏ hơn 18"
//             return false
//         } else if(value > '60') {
//             errorMessage = "Tuổi không được lớn hơn 60"
//             return false
//         }else return true
//     }
// })

export default {
    name: 'CreateIndexJob',
    layout: 'admin',
    head: {
        title: 'Home page 🚀',
        link: [
            { rel: 'stylesheet', href: '/app-assets/css/plugins/forms/wizard.css' },
        ],
        script: [
            { src: '/app-assets/js/scripts/forms/wizard-steps.js'}
        ]
    },
    data () {
        return {
            options: [],
            data: {
                title: '',
                address: '',
                nation: {id: null, name: ''},
                expiration_date: '',
                description: '',
                request: '',
                cv_content: '',
                benefit: '',
                age_start: null,
                age_late: null,
                quantity:'',
                salary_start: '',
                salary_end: '',
                subsidy: '',
                currency: '',
                date_start: '',
                date_test: '',
                expected_date: '',
                time_bonus: {id: 0, name: ''},
                bonus: 0,
                highlight_job: 1,
                visa: {id: null, profession: ''},
                form_work: {id: null, name: ''}
            },
            checked: false,
            guarantee: [
                {id: 1, name: '30 ngày *1'},
                {id: 2, name: 'Hoàn tất nhập cảnh *1,5'},
                {id: 3, name: 'Sau nhập cảnh 30 ngày *2'}
            ],
            money: ['$', 'VND', '€', '¥', '₩'],
            optionsVisa: [],
            optionsFormWork: [
                {id: 1, name: 'Toàn thời gian'},
                {id: 2, name: 'Ban thời gian'},
                {id: 3, name: 'Vừa học vừa làm'}
            ]
        }
    },
    components:{
        Multiselect,
        ValidationProvider,
        ValidationObserver,
        Datetime
    },
    methods:{
        async fetch (route) {
            this.data.expiration_date = moment(Date.now()).add(30, 'days').format("YYYY-MM-DD"); 
            this.data.date_start = moment(Date.now()).format("YYYY-MM-DD"); 
            let res = await this.$axios.$get(`tintuyendung/getQuocGia`)
            this.options = res.data
            let visa = await this.$axios.$get(`tintuyendung/getVisa`)
            this.optionsVisa = visa.data
            console.log(this.optionsVisa)
        },
        nameWithLang ({ name, id }) {
            return `${name}`
        },
        nameWithVisa ({ profession, id }) {
            return `${profession}`
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
                form.append('title' , this.data.title)
                form.append('school_name' , this.data.school_name)
                form.append('company_name' , this.data.company_name)
                form.append('address' , this.data.address)
                form.append('nation' , this.data.nation.id)
                form.append('expiration_date' , this.data.expiration_date)
                form.append('description' , this.data.description)
                form.append('request' , this.data.request)
                form.append('cv_content' , this.data.cv_content)
                form.append('salary_start' , this.data.salary_start)
                form.append('salary_end' , this.data.salary_end)
                form.append('benefit' , this.data.benefit)
                form.append('age_start' , this.data.age_start)
                form.append('age_late' , this.data.age_late)
                form.append('quantity' , this.data.quantity)
                form.append('subsidy' , this.data.subsidy)
                form.append('currency' , this.data.currency)
                form.append('date_start' , this.data.date_start)
                form.append('date_test' , this.data.date_test)
                form.append('expected_date' , this.data.expected_date)
                form.append('time_bonus' , this.data.time_bonus.id)
                form.append('bonus' , this.data.bonus)
                form.append('highlight_job' , this.data.highlight_job)
                form.append('visa' , this.data.visa.id)
                form.append('form_work' , this.data.form_work.id)
                form.append('type' , 1)
                console.log(this.data)
                this.$axios.post('tintuyendung/createTinTuyen',form)
                .then(response => {
                    if(response.data.status == 200) {
                        this.$swal(
                            'Thành công',
                            response.data.message,
                            'success'
                        ).then( function (){
                            window.location.href = '/admin';
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
        this.fetch()
    }
  
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
.vue-form-wizard.md .wizard-navigation .wizard-progress-with-circle {
    position: relative;
    top: 25px;
    height: 3px;
}

.vue-form-wizard.md .wizard-icon-circle {
    width: 40px;
    height: 40px;
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
</style>
