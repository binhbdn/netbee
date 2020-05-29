<template>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-9 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form-wizard color="#ffb701" error-color="red" @on-complete="onComplete" back-button-text="Quay lại" next-button-text="Tiếp" finish-button-text="Hoàn tất">
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
                                                    <div class="col-12" v-if="$auth.user.role == 4">
                                                        <ValidationProvider rules="checkSelect" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Đăng hộ
                                                                </label>
                                                                <multiselect :options="companies" v-model="data.company" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false" placeholder="Chọn công ty"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Tên trường
                                                                </label>
                                                                <input type="text" class="form-control" v-model="data.school_name">
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
                                                        <ValidationProvider rules="checkSelect" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Quốc gia
                                                                </label>
                                                                <multiselect :options="nations" :custom-label="nameWithLang" v-model="data.nation"  :searchable="false" :allow-empty="false" :show-labels="false" placeholder="Chọn quốc gia"></multiselect>
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
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Loại tiền
                                                                </label>
                                                                <multiselect :options="money" v-model="data.currency" :searchable="false" 
                                                                       :allow-empty="false" :show-labels="false" placeholder="Chọn loại tiền"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }" name="confirmDateStart">
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Ngày bắt đầu nhận hồ sơ
                                                                </label>
                                                                <input type="date" class="form-control" v-model="data.date_start">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">
                                                                Tuổi
                                                            </label>
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-6" style="padding-left:0px">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }" name="confirmDigit">
                                                                            <input type="number" class="form-control" v-model="data.age_start" placeholder="Từ">
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    <div class="col-6" style="padding-right: 0px">
                                                                        <ValidationProvider rules="required|ssdigit:@confirmDigit" v-slot="{ errors }">
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
                                                                Học phí:
                                                            </label>
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-6" style="padding-left:0px">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }" name="confirmSalary">
                                                                            <input type="txt" class="form-control" @input="data.salary_start = FormatPrice(data.salary_start)" v-model="data.salary_start" placeholder="Từ">
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    <div class="col-6" style="padding-right: 0px">
                                                                        <ValidationProvider rules="required|ssdigit:@confirmSalary" v-slot="{ errors }">
                                                                            <input type="txt" @input="data.salary_end = FormatPrice(data.salary_end)" class="form-control" v-model="data.salary_end" placeholder="Đến">
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
                                                                <input type="txt" class="form-control required" @input="data.subsidy = FormatPrice(data.subsidy)" v-model="data.subsidy">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>

                                                    <div class="col-6">
                                                        <ValidationProvider rules="required|ssdate|ssdate_start:@confirmDateStart" v-slot="{ errors }">
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
                                                        <ValidationProvider rules="required|ssdate|ssdate_start:@confirmDateStart" v-slot="{ errors }">
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
                                                    <div class="col-6" v-if="checked">
                                                        <ValidationProvider rules="checkSelect" v-slot="{ errors }" >
                                                                <div class="form-group">
                                                                    <label for="firstName3">
                                                                        Thời gian thanh toán phí
                                                                    </label>
                                                                    <multiselect :options="guarantee" v-model="data.time_bonus" :custom-label="nameWithLang" :searchable="false" 
                                                                        :allow-empty="false" :show-labels="false" placeholder="Thời gian thanh toán phí" :disabled="!checked"></multiselect>
                                                                    <span style="color: red">{{ errors[0] }}</span>
                                                                </div>
                                                            </ValidationProvider>
                                                    </div>
                                                    <div class="col-6" v-if="checked">
                                                        <ValidationProvider rules="required" v-slot="{ errors }" >
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Tiền thưởng
                                                                </label>
                                                                <input type="txt" class="form-control" v-model="data.bonus" :disabled="!checked">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <!-- <div class="col-4" v-if="checked">
                                                        <div class="form-group">
                                                            <label for="firstName3">
                                                                Tổng tiền thưởng
                                                            </label>
                                                            <input type="number" class="form-control" disabled :value=" data.time_bonus.id == 1 ? data.bonus : data.time_bonus.id == 2 ? data.bonus * 1.5 : data.bonus * 2">
                                                        </div>
                                                    </div> -->
                                                    <div class="col-lg-4 col-md-6 col-sm-12" id="goi1">
                                                        <div class="card border-netbee text-center bg-transparent" style="height: 100%">
                                                            <div class="card-content">
                                                                <div class="card-body p-t-10">
                                                                    <label for="defaultGroupExample0" class="btn bg-netbee">TIN NỔI BẬT</label>
                                                                     <input type="radio" class="custom-control-input"
                                                                    id="defaultGroupExample0" value="1" v-model="data.highlight_job" :checked="data.highlight_job == 1">
                                                                    <i class="far fa-check fa-2x" v-if="data.highlight_job == 1" style="color: green"></i>
                                                                    <div class="divider divider-default">
                                                                        <div class="divider-text">Tin thường</div>
                                                                    </div>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12" id="goi2">
                                                        <div class="card border-netbee text-center bg-transparent" style="height: 100%">
                                                            <div class="card-content">
                                                                <div class="card-body p-t-10">
                                                                    <label for="defaultGroupExample1" class="btn bg-netbee">TIN THƯỜNG</label>
                                                                    <input type="radio" class="custom-control-input"
                                                                    id="defaultGroupExample1" value="0" v-model="data.highlight_job" :checked="data.highlight_job == 0">
                                                                    <i class="far fa-check fa-2x" v-if="data.highlight_job == 0" style="color: green"></i>
                                                                    <div class="divider divider-warning">
                                                                        <div class="divider-text"><img src="/assets/img/tinnoibat.jpg" style="height: 25px;"></div>
                                                                    </div>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12" id="goi3">
                                                        <div class="card border-netbee text-center bg-transparent" style="height: 100%">
                                                            <div class="card-content">
                                                                <div class="card-body p-t-10">
                                                                    <label for="defaultGroupExample2" class="btn bg-netbee">TIN VIP</label>
                                                                    <input type="radio" class="custom-control-input"
                                                                    id="defaultGroupExample2" value="2" v-model="data.highlight_job" :checked="data.highlight_job == 2">
                                                                    <i class="far fa-check fa-2x" v-if="data.highlight_job == 2" style="color: green"></i>
                                                                    <div class="divider divider-danger">
                                                                        <div class="divider-text"><img src="/assets/img/tinvip.jpg"></div>
                                                                    </div>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                    <p class="font-weight-600">- Được tiếp cận với + 3000 chuyên viên tuyển sinh</p>
                                                                </div>
                                                            </div>
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
                                        <div class="text-center">
                                            <img src="../../../../static/assets/img/logo.png" width="70px">
                                            <p class="__title">Quy trình tuyển dụng tại Netbee</p>
                                        </div>
                                        <div>
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

extend("ssdate_start", {
    params: ['target'],
    message: field => "Phải lớn hơn ngày nhận hồ sơ",
    validate: (value, { target }) => {
        var date = moment(value)
        let date_start = moment(target)
        if(date_start.isBefore(date)){
            return true
        }else{
            return false
        }
    }
})

extend("ssdigit", {
    params: ['target'],
    message: (field) => `Không được nhỏ hơn`,
    validate: (value, { target }) => {
        var max = parseFloat(value.split(',').join(''))
        let min = parseFloat(target.split(',').join(''))
        if(max > min){
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
    name: 'CreateIndexJob',
    layout: 'admin',
    data () {
        return {
            nations: [],
            data: {
                title: '',
                school_name: '',
                company_name: '',
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
                currency: null,
                date_start: '',
                date_test: '',
                expected_date: '',
                time_bonus: {id: 0, name: ''},
                bonus: null,
                highlight_job: 1
            },
            checked: true,
            guarantee: [
                {id: 1, name: 'Ngay sau khi bay'},
                {id: 2, name: 'Sau khi bay 30 ngày *1,5'},
                {id: 3, name: 'Sau khi bay 60 ngày *2'}
            ],
            money: ['$', 'VND', '€', '¥', '₩'],
            companies:[]
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
            let res = await this.$axios.$get(`getQuocGia`)
            this.nations = res.data
            let company = await this.$axios.$get(`user/2/getChoose`)
            this.companies = company
        },
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
                if(this.data.company != null)
                {
                    form.append('id_created' , this.data.company.id)
                }
                form.append('title' , this.data.title)
                form.append('school_name' , this.data.school_name)
                form.append('company_name' , this.data.company_name)
                form.append('address' , this.data.address)
                form.append('nation_id' , this.data.nation.id)
                form.append('expiration_date' , this.data.expiration_date)
                form.append('description' , this.data.description)
                form.append('request' , this.data.request)
                form.append('cv_content' , this.data.cv_content)
                form.append('salary_start' , this.data.salary_start.split(',').join(''))
                form.append('salary_end' , this.data.salary_end.split(',').join(''))
                form.append('benefit' , this.data.benefit)
                form.append('age_start' , this.data.age_start)
                form.append('age_late' , this.data.age_late)
                form.append('quantity' , this.data.quantity)
                form.append('subsidy' , this.data.subsidy.split(',').join(''))
                form.append('currency' , this.data.currency)
                form.append('date_start' , this.data.date_start)
                form.append('date_test' , this.data.date_test)
                form.append('expected_date' , this.data.expected_date)
                if(this.checked){
                    form.append('time_bonus' , this.data.time_bonus.id)
                    form.append('bonus' , this.data.bonus)
                }else{
                    form.append('time_bonus' , 0)
                    form.append('bonus' , 0)
                }
                form.append('highlight_job' , this.data.highlight_job)
                form.append('type' , 2)
                this.$axios.post('tintuyendung/createTinTuyen',form)
                .then(response => {
                    if(response.data.status == 200) {
                        this.$swal(
                            'Thành công',
                            response.data.message,
                            'success'
                        ).then( function (){
                            window.location.href = '/admin/tin-tuyen-dung';
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
</style>
