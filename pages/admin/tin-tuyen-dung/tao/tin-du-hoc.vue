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
                                                                <label for="title">Tiêu đề</label>
                                                                <input type="text" class="form-control" v-model="data.title" placeholder="Tuyển du học trường Tokyo kỳ bay tháng 10/2020">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12" v-if="$auth.user.role == 4">
                                                        <ValidationProvider rules="checkSelect" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Đăng hộ</label>
                                                                <multiselect :options="companies" v-model="data.company" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false" placeholder="Chọn công ty"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Tên trường</label>
                                                                <input type="text" class="form-control" v-model="data.school_name" placeholder="Đại học Tokyo">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Địa điểm</label>
                                                                <input type="text" class="form-control" v-model="data.address" placeholder="Tokyo">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="checkSelect" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Quốc gia</label>
                                                                <multiselect :options="nations" :custom-label="nameWithLang" v-model="data.nation"  :searchable="false" :allow-empty="false" :show-labels="false" placeholder="Chọn quốc gia"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                
                                                </div>
                                            </ValidationObserver>   
                                        </tab-content>
                                        <tab-content :before-change="checkValidateStep2" title="Yêu cầu">
                                            <ValidationObserver ref="step2" v-slot="{ valid2 }">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Loại tiền</label>
                                                                <multiselect :options="money" v-model="data.currency" :searchable="false" 
                                                                       :allow-empty="false" :show-labels="false" placeholder="Chọn loại tiền"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">                       
                                                        <div class="form-group">
                                                            <label for="firstName3">Phí xuất cảnh</label>
                                                            <div class="input-group">
                                                                <input type="txt" class="form-control required" @input="data.subsidy = FormatPrice(data.subsidy)" v-model="data.subsidy">
                                                                <div class="input-group-addon" style="padding: 9px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                                                    <p  aria-hidden="true" style="margin: 0px;">{{data.currency}}</p>
                                                                </div>
                                                            </div>                                                             
                                                        </div>                        
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="firstName3">Tuổi</label>
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
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="firstName3">Trình độ học vấn</label>
                                                            <multiselect :options="levelEx" v-model="data.academicLevel" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false" placeholder="Chọn trình độ học vấn"></multiselect>
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                    <div class="col-4">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Số lượng tuyển</label>
                                                                <input type="number" class="form-control" v-model="data.quantity">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-4">  
                                                        <div class="form-group">
                                                            <label for="firstName3">Chứng minh thu nhập</label>
                                                            <multiselect :options="cmndEx" v-model="data.request_cmnd" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false"></multiselect>
                                                        </div>                                     
                                                    </div>
                                                    <div class="col-4">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Thời gian du học (năm)</label>
                                                                <input type="text" class="form-control required" v-model="data.time_contract">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">Yêu cầu thêm</label>
                                                            <textarea rows="3" class="form-control" v-model="data.request" placeholder="Đại học yêu cầu có 1,5 năm kinh nghiệm.
Có xác nhận thời gian công tác : công ty và bảo hiểm."></textarea>
                                                        </div>
                                                    </div>
                                                     <div class="col-6">
                                                        <ValidationProvider rules="ssdate" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Ngày hết hạn ứng tuyển</label>
                                                                <!-- <datetime v-model="data.expiration_date" input-class="form-control"></datetime> -->
                                                                <input type="date" class="form-control" v-model="data.expiration_date">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }" name="confirmDateStart">
                                                            <div class="form-group">
                                                                <label for="firstName3">Ngày bắt đầu nhận hồ sơ</label>
                                                                <input type="date" class="form-control" v-model="data.date_start">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="ssdate|ssdate_start:@confirmDateStart" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Ngày thi tuyển</label>
                                                                <input type="date" class="form-control" v-model="data.date_test"> 
                                                                <span style="color: red">{{ errors[0] }}</span>                                    
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <ValidationProvider rules="ssdate|ssdate_start:@confirmDateStart" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="firstName3">Ngày dự kiến nhập cảnh</label>
                                                                <input type="date" class="form-control required" v-model="data.expected_date">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">Lộ trình</label>
                                                            <textarea rows="3" class="form-control" v-model="data.route"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                        <tab-content :before-change="checkValidateStep3" title="Quyền lợi">
                                            <ValidationObserver ref="step3" v-slot="{ valid3 }">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">Học phí</label>
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-6" style="padding-left:0px">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }" name="confirmSalary">
                                                                            <div class="input-group">
                                                                                <input type="txt" class="form-control" @input="data.salary_start = FormatPrice(data.salary_start)" v-model="data.salary_start">
                                                                                <div class="input-group-addon" style="padding: 9px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                                                                    <p  aria-hidden="true" style="margin: 0px;">{{data.currency}}</p>
                                                                                </div>
                                                                            </div>                                                                       
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    <div class="col-6" style="padding-right: 0px">                                       
                                                                        <multiselect :options="salaryEx" v-model="data.salary_status" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false"></multiselect>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">Ký túc xá</label>
                                                            <multiselect :options="valueEx" v-model="data.dormitory" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false" ></multiselect>
                                                        </div>
                                                    </div>
                    
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">Phụ cấp ngoài</label>
                                                            <textarea rows="3" class="form-control" v-model="data.allowance" placeholder="Miễn phí ký túc xá"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstName3">Quyền lợi khác</label>
                                                            <textarea rows="3" class="form-control" v-model="data.benefits" placeholder="Giới thiệu việc làm thêm"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                        <tab-content title="Tiền thưởng">
                                            <ValidationObserver ref="step4" v-slot="{ valid4 }">
                                                <div class="row">
                                                    <!-- <div class="col-12">
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
                                                    </div>   -->
                                                    <div class="col-6" v-if="checked">
                                                        <ValidationProvider rules="checkSelect" v-slot="{ errors }" >
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Thời gian thanh toán phí
                                                                </label>
                                                                <multiselect :options="guarantee" v-model="data.time_bonus" :custom-label="nameWithLang" :searchable="false" :preselect-first="true"
                                                                    :allow-empty="false" :show-labels="false" placeholder="Thời gian thanh toán phí" :disabled="!checked"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6 mb-3" v-if="checked">
                                                        <ValidationProvider rules="required" v-slot="{ errors }" >
                                                            <div class="form-group">
                                                                <label for="firstName3">
                                                                    Tiền thưởng
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="txt" @input="data.bonus = FormatPrice(data.bonus)" class="form-control" v-model="data.bonus" :disabled="!checked">
                                                                    <div class="input-group-addon" style="padding: 9px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                                                        <p  aria-hidden="true" style="margin: 0px;">{{data.currency}}</p>
                                                                    </div>
                                                                </div> 
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="firstName3">Mã khuyễn mãi (Nếu có)</label>
                                                            <input type="text" class="form-control" v-model="data.promotion_code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                        <tab-content title="Hoàn thành">
                                            <ValidationObserver ref="step5" v-slot="{ valid5 }">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 col-sm-12" id="goi2">
                                                        <div class="card border-netbee text-center bg-transparent border-hove" style="height: 100%">
                                                            <div class="card-content">
                                                                <div class="card-body p-t-30">
                                                                    <label for="defaultGroupExample1" class="btn bg-netbee">Miễn phí</label>
                                                        
                                                                   
                                                                    <div class="divider divider-warning">
                                                                        <div class="divider-text trial">Tin thường</div>
                                                                    </div>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị ở box tin mới</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị thứ tự sau Tin VIP và tin nổi bật</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Không có icon nổi bật</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Không có chuyên viên hỗ trợ hotline</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Miễn phí tin đăng</p>
                                                                    <input type="radio" class="form-check-input bot"
                                                                    id="defaultGroupExample1" value="0" v-model="data.highlight_job" :checked="data.highlight_job == 0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12" id="goi1">
                                                        <div class="card border-netbee text-center bg-transparent border-hove"  style="height: 100%">
                                                            <div class="card-content">
                                                                <div class="card-body p-t-30">
                                                                    <label for="defaultGroupExample0" class="btn bg-netbee">1,000,000 VND</label>
                                                                    
                                                                    
                                                                    <div class="divider divider-default">
                                                                        <div class="divider-text trial">Tin nổi bật</div>
                                                                    </div>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị ở box đầu tiên của trang chủ</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hỗ trợ đăng tin và thông báo khi có ứng viên ứng tuyển</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị đầu tiên ở trang hiển thị tin của chuyên viên tuyển dụng</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Chuyên viên hỗ trợ hotline 24/7</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> 1,000,000 VND/ Tin</p>
                                                                    <input type="radio" class="form-check-input bot"
                                                                    id="defaultGroupExample0" value="1" v-model="data.highlight_job" :checked="data.highlight_job == 1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4 col-md-6 col-sm-12" id="goi3">
                                                        <div class="card border-netbee text-center bg-transparent brilliant" style="height: 100%;border: 1px solid #ffc108 !important;">
                                                            <div class="card-content">
                                                                <div class="card-body p-t-30">
                                                                    <label for="defaultGroupExample2" class="btn bg-netbee">1,500,000 VND</label>
                                                                    
                                                                   
                                                                    <div class="divider divider-danger">
                                                                        <div class="divider-text trial">Tin vip</div>
                                                                    </div>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị ở box nổi bật của trang chủ</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị icon màu đỏ ở góc phải tin gây nổi bật</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Chi tiết tin hiển thị là tin đã xác thực</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hỗ trợ đăng tin và thông báo khi có ứng viên ứng tuyển</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị đầu tiên ở trang hiển thị tin của chuyên viên tuyển dụng</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Chuyên viên hỗ trợ hotline 24/7</p>
                                                                    <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> 1,500,000 VND/ Tin</p>
                                                                    <input type="radio" class="form-check-input bot"
                                                                    id="defaultGroupExample2" value="2" v-model="data.highlight_job" :checked="data.highlight_job == 2">
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
                        <div class="col-lg-3 col-sm-6 col-12" style="padding-left: 3px;">
                            <div class="card text-center">
                                <div class="card-content" style="background-color: #FFB701 !important;">
                                    <div class="card-body p-2">
                                        <div class="text-center">
                                            <img src="../../../../static/assets/img/logo.png" width="70px">
                                            <p class="__title">Quy trình tuyển dụng tại Netbee</p>
                                        </div>
                                        <div style="text-align: left;">
                                            <p>1. Tạo tin tuyển dụng</p>
                                            <p>2. Chờ admin xét duyệt tin (Thông báo qua email)</p>
                                            <p>3. Nhận hồ sơ giới thiệu từ chuyên viên tuyển sinh (Thông báo khi có lượt ứng tuyển)</p>
                                            <p>4. Xét duyệt hồ sơ và book lịch phỏng vấn (Lượt ứng tuyển chỉ trong trạng thái chờ tối đa 3 ngày)</p>
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
                age_start: '18',
                age_late: '30',
                quantity:'',
                salary_start: '',
                salary_status: {id: 1, name: '/ 1 Năm'},
                subsidy: '',
                currency: 'VND',
                date_start: '',
                date_test: '',
                expected_date: '',
                time_bonus: {id: 3, name: 'Ngay sau khi cọc'},
                bonus: null,
                highlight_job: 0,
                time_contract: 3,
                height:'',
                weight:'',
                academicLevel: {id: 1, name: 'Trung học phổ thông'},
                insurrance:'',
                skin:'',
                dormitory:{id: 1, name: 'Công ty chuẩn bị'},
                meal:{id: 1, name: 'Công ty chuẩn bị'},
                startTimeLabor:'',
                endTimeLabor:'',
                allowance:'',
                benefits:'',
                request:'',
                route:'',
                request_cmnd:{id: 3, name: 'Không'},
                promotion_code:''
            },
            checked: true,
            guarantee: [
                {id: 3, name: 'Ngay sau khi cọc'},
                {id: 5, name: 'Ngay sau khi có COE'},
                {id: 1, name: 'Ngay sau khi bay'},
                {id: 2, name: 'Sau khi bay 30 ngày'},
                {id: 4, name: 'Hoàn tất nhập cảnh'}
            ],
            money: ['$', 'VND', '€', '¥', '₩'],
            companies:[],
            levelEx: [
                {id: 1, name: 'Trung học phổ thông'},
                {id: 2, name: 'Cao đẳng'},
                {id: 3, name: 'Đại học'},
                {id: 4, name: 'Trên đại học'},
                {id: 5, name: 'Sau đại học'},
                {id: 6, name: 'Không yêu cầu'}
            ],
            valueEx: [
                {id: 1, name: 'Công ty chuẩn bị'},
                {id: 2, name: 'Ứng viên tự chuẩn bị'},
            ],
            salaryEx: [
                {id: 1, name: '/ 1 Năm'},
                {id: 2, name: '/ 6 Tháng'},
                {id: 3, name: '/ 1 Tháng'},
                {id: 4, name: '/ 1 Kỳ'}
            ],
            cmndEx: [
                {id: 1, name: 'Để trống'},
                {id: 2, name: 'Có'},
                {id: 3, name: 'Không'}
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
            this.data.expiration_date = moment(Date.now()).add(3, 'M').format("YYYY-MM-DD"); 
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
            console.log(this.data.salary_status.id)
            let isValid = await this.$refs.step5.validate();
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
                form.append('salary_start' , this.data.salary_start.split(',').join(''))
                form.append('age_start' , this.data.age_start)
                form.append('age_late' , this.data.age_late)
                form.append('quantity' , this.data.quantity)
                form.append('subsidy' , this.data.subsidy.split(',').join(''))
                form.append('currency' , this.data.currency)
                form.append('date_start' , this.data.date_start)
                form.append('date_test' , this.data.date_test)
                form.append('expected_date' , this.data.expected_date)
                form.append('time_contract' , this.data.time_contract)
                if(this.checked){
                    form.append('time_bonus' , this.data.time_bonus.id)
                    form.append('bonus' , this.data.bonus)
                }else{
                    form.append('time_bonus' , 0)
                    form.append('bonus' , 0)
                }
                form.append('highlight_job' , this.data.highlight_job)
                form.append('type' , 2)
                form.append('height' , this.data.height)
                form.append('weight' , this.data.weight)
                form.append('academicLevel' , this.data.academicLevel.id)
                if(this.data.insurrance == true){
                    form.append('insurrance' , 1)
                }else {
                     form.append('insurrance' , 0)
                }
                if(this.data.skin == true){
                    form.append('skin' , 1)
                }else {
                    form.append('skin' , 0)
                }
                form.append('dormitory' , this.data.dormitory.id)
                form.append('meal' , this.data.meal)
                form.append('startTimeLabor' , this.data.startTimeLabor)
                form.append('endTimeLabor' , this.data.endTimeLabor)
                form.append('allowance' , this.data.allowance)
                form.append('benefits' , this.data.benefits)
                form.append('request' , this.data.request)
                form.append('route' , this.data.route)
                form.append('salary_status' , this.data.salary_status.id)
                form.append('request_cmnd' , this.data.request_cmnd.id)
                form.append('promotion_code' , this.data.promotion_code)
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
                }).catch(error => {
                        console.log(error.response)
                    });
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
input::placeholder ,  textarea::placeholder{
  color: #d0d2d6 !important;
}
#goi1 .border-netbee:hover ,#goi2 .border-netbee:hover,#goi3 .border-netbee:hover{
    box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.1) !important;;
    background-color: #fff !important;
    border: 1px solid #FFB701;
}
.border-netbee{
    border: 1px solid hsla(0, 0%, 80%, .8)!important;
}
.p-main{
    text-align: left;
    font-weight: 400;
}
.vue-form-wizard .wizard-btn {
    font-weight: 400;
}
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
.form-group label {
    font-weight: 700;
    padding-bottom: 4px;
}
.form-control {
    font-size: 15px;
}
.multiselect__single {
    font-size: 15px !important;
}
.multiselect__tags {
    padding: 8px 40px 8px 8px;
}
.wizard-icon-circle:focus {
    outline: none;
}
.form-group label::after {
    content: ":";
}
.brilliant::before {
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 64px 64px 0 0;
    border-color: #ffc108 transparent transparent transparent;
    position: absolute;
    left: 0;
    top: 0;
    content: "";
}
.brilliant::after {
    color: #fff;
    position: absolute;
    left: 9px;
    top: 3px;
    font-size: 1.4rem;
}
.brilliant::after {
    font-family: "FontAwesome";
    content: "\f00c";
}
.trial {
    font-size: .9rem;
    font-weight: 600;
    padding: 2px 21px 2px 21px;
    color: #ffc108;
    border: 1px solid #e4e4e4;
    border-radius: 15px;
    background-color: white;
}
.wizard-tab-content {
    padding-left: 4px !important;
    padding-right: 4px !important;
}
.border-netbee {
    border: 1px solid #e4e4e4 !important;
}

.border-hove:hover {
    border: 1px solid #e4e4e4 !important;
}

.bot {
    position: absolute;
    bottom: 12px;
    font-size: 20px;
}
</style>
