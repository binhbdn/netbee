<template>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-9 col-12">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <form-wizard color="#ffb701" error-color="red" @on-complete="onComplete" back-button-text="Quay lại" next-button-text="Tiếp" finish-button-text="Hoàn tất" style="padding-top: 7px;">
                                        <tab-content :before-change="checkValidateStep1" title="Tổng quan">
                                            <ValidationObserver ref="step1" v-slot="{ valid1 }">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <ValidationProvider rules="required|max:150" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="title">
                                                                    Tiêu đề (<span style="color: red;">*</span>)
                                                                </label>
                                                                <input id="title" type="text" class="form-control" v-model="data.title">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12" v-if="data.type == 2">
                                                        <ValidationProvider rules="required|max:150" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="id-school-name">
                                                                    Tên trường (<span style="color: red;">*</span>)
                                                                </label>
                                                                <input id="id-school-name" type="text" class="form-control" v-model="data.school_name">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="id-address">
                                                                Địa điểm
                                                            </label>
                                                            <input id="id-address" type="text" class="form-control required" v-model="data.address">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <ValidationProvider rules="checkSelect" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="id-nation">
                                                                    Quốc gia (<span style="color: red;">*</span>)
                                                                </label>
                                                                <multiselect id="id-nation" :options="options" v-model="data.nation" :custom-label="nameWithLang" :allow-empty="false" :searchable="false" :show-labels="false" placeholder="Chọn quốc gia" label="id"></multiselect>
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
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="id-currency">
                                                                    Loại tiền (<span style="color: red;">*</span>)
                                                                </label>
                                                                <multiselect id="id-currency" :options="money" v-model="data.currency" :searchable="false" :allow-empty="false"
                                                                        :show-labels="false" placeholder="Chọn loại tiền"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="id-subsidy">
                                                                Phí xuất cảnh
                                                            </label>
                                                            <div class="input-group">
                                                                <input id="id-subsidy" type="txt" class="form-control required" v-model="data.subsidy" @input="data.subsidy = FormatPrice(data.subsidy)">
                                                                <div class="input-group-addon" style="padding: 9px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                                                    <p  aria-hidden="true" style="margin: 0px;">{{data.currency}}</p>
                                                                </div>
                                                            </div>                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="id-age-start">
                                                                Tuổi (<span style="color: red;">*</span>)
                                                            </label>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <ValidationProvider rules="required|customSoam" v-slot="{ errors }" name="confirmDigit">
                                                                            <input id="id-age-start" type="number" class="form-control" v-model="data.age_start" placeholder="Từ">
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <ValidationProvider rules="required|ssdigit:@confirmDigit|customSoam" v-slot="{ errors }">
                                                                            <input type="number" class="form-control" v-model="data.age_late" placeholder="Đến">
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="id-academicLevel">Trình độ học vấn</label>
                                                            <multiselect id="id-academicLevel" :options="levelEx" v-model="data.academicLevel" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false" placeholder="Chọn trình độ học vấn"></multiselect>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required|customSoam" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="id-quantity">
                                                                    Số lượng tuyển (<span style="color: red;">*</span>)
                                                                </label>
                                                                <input id="id-quantity" type="number" class="form-control" v-model="data.quantity">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-12" v-if="data.type != 2">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <ValidationProvider rules="required|customSoam" v-slot="{ errors }">
                                                                        <label for="id-height">Chiều cao [cm] (<span style="color: red;">*</span>)</label>
                                                                        <input id="id-height" type="number" class="form-control" v-model="data.height">
                                                                        <span style="color: red">{{ errors[0] }}</span>
                                                                    </ValidationProvider>
                                                                </div>
                                                                <div class="col-6">
                                                                    <ValidationProvider rules="required|customSoam" v-slot="{ errors }">
                                                                        <label for="id-weight">Cân nặng [kg] (<span style="color: red;">*</span>)</label>
                                                                        <input id="id-weight" type="number" class="form-control" v-model="data.weight">
                                                                        <span style="color: red">{{ errors[0] }}</span>
                                                                    </ValidationProvider>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" v-if="data.type != 2">         
                                                        <div class="form-group">
                                                            <label for="id-visa">
                                                                Ngành nghề xin visa
                                                            </label>
                                                            <multiselect id="id-visa" :options="optionsVisa" v-model="data.visa" :custom-label="nameWithVisa" :allow-empty="false" :searchable="false" :show-labels="false" placeholder="Chọn ngành nghê xin visa" label="id"></multiselect>
                                                        </div>   
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required|customSoam" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="id-time-contract" v-if="data.type == 2">Thời gian du học [năm] (<span style="color: red;">*</span>)</label>
                                                                <label for="id-time-contract" v-else>Thời hạn hợp đồng [năm] (<span style="color: red;">*</span>)</label>
                                                                <input id="id-time-contract" type="text" class="form-control required" v-model="data.time_contract">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                     <div class="col-sm-6" v-if="data.type != 2">
                                                        <ValidationProvider rules="checkSelect" v-slot="{ errors }" >
                                                            <div class="form-group">
                                                                <label for="id-work-form">
                                                                    Hình thức làm việc
                                                                </label>
                                                                <multiselect id="id-work-form" :options="optionsFormWork" v-model="data.work_form" :custom-label="nameWithLang" :allow-empty="false" :searchable="false" :show-labels="false" placeholder="Chọn hình thức làm việc" lable="id"></multiselect>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">  
                                                        <div class="form-group">
                                                            <label for="id-request-cmnd">Chứng minh thu nhập</label>
                                                            <multiselect id="id-request-cmnd" :options="cmndEx" v-model="data.request_cmnd" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false"></multiselect>
                                                        </div>                                     
                                                    </div>
                                                    <div class="col-12" v-if="data.type != 2">
                                                        <div class="form-group">
                                                            <label for="id-job-description">Mô tả công việc</label>
                                                            <textarea id="id-job-description" rows="3" class="form-control" v-model="data.job_description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="id-request">Yêu cầu thêm</label>
                                                            <textarea id="id-request" rows="3" class="form-control" v-model="data.request"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required|ssdate" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="id-expiration-date">
                                                                    Ngày hết hạn ứng tuyển
                                                                </label>
                                                                <!-- <datetime v-model="data.expiration_date" input-class="form-control"></datetime> -->
                                                                <input id="id-expiration-date" type="date" class="form-control" v-model="data.expiration_date">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="required" v-slot="{ errors }" name="confirmDateStart">
                                                            <div class="form-group">
                                                                <label for="id-date-start">
                                                                    Ngày bắt đầu nhận hồ sơ
                                                                </label>
                                                                <input id="id-date-start" type="date" class="form-control" v-model="data.date_start">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="ssdate|ssdate_start:@confirmDateStart" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="id-date-test">
                                                                    Ngày thi tuyển
                                                                </label>
                                                                <input id="id-date-test" type="date" class="form-control" v-model="data.date_test">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ValidationProvider rules="ssdate|ssdate_start:@confirmDateStart" v-slot="{ errors }">
                                                            <div class="form-group">
                                                                <label for="id-expected-date">
                                                                    Ngày dự kiến nhập cảnh
                                                                </label>
                                                                <input id="id-expected-date" type="date" class="form-control required" v-model="data.expected_date">
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-12" v-if="data.type == 2">
                                                        <div class="form-group">
                                                            <label for="id-route">Lộ trình</label>
                                                            <textarea id="id-route" rows="3" class="form-control" v-model="data.route"></textarea>
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
                                                            <label for="id-salary-start" v-show="data.type != 2">
                                                                Thu nhập hàng tháng (<span style="color: red;">*</span>)
                                                            </label>
                                                            <label for="id-salary-start" v-show="data.type == 2">
                                                                Học phí
                                                            </label>
                                                                <div class="row">
                                                                    <div class="col-sm-6" v-if="data.type != 2">
                                                                        <ValidationProvider rules="required" v-slot="{ errors }" name="confirmSalary">
                                                                            <div class="input-group">
                                                                                <input id="id-salary-start" type="txt" class="form-control" @input="data.salary_start = FormatPrice(data.salary_start)" v-model="data.salary_start" placeholder="Từ">
                                                                                <div class="input-group-addon" style="padding: 9px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                                                                    <p  aria-hidden="true" style="margin: 0px;">{{data.currency}}</p>
                                                                                </div>
                                                                            </div> 
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    <div class="col-sm-6 pt-xs-1" v-if="data.type != 2">
                                                                        <ValidationProvider rules="required|ssdigit:@confirmSalary" v-slot="{ errors }">
                                                                            <div class="input-group">
                                                                                <input type="txt" class="form-control" @input="data.salary_end = FormatPrice(data.salary_end)" v-model="data.salary_end" placeholder="Đến">
                                                                                <div class="input-group-addon" style="padding: 9px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                                                                    <p  aria-hidden="true" style="margin: 0px;">{{data.currency}}</p>
                                                                                </div>
                                                                            </div>                                                      
                                                                            <span style="color: red">{{ errors[0] }}</span>
                                                                        </ValidationProvider>
                                                                    </div>
                                                                    <div class="col-sm-6" v-if="data.type == 2">
                                                                        <div class="input-group">
                                                                            <input id="id-salary-start" type="txt" class="form-control" @input="data.salary_start = FormatPrice(data.salary_start)" v-model="data.salary_start">
                                                                            <div class="input-group-addon" style="padding: 9px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                                                                <p  aria-hidden="true" style="margin: 0px;">{{data.currency}}</p>
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                    <div class="col-sm-6" v-if="data.type == 2">
                                                                        <multiselect :options="salaryEx" v-model="data.salary_status" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false"></multiselect>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12" v-if="data.type != 2">
                                                        <div class="form-group">
                                                            <label for="id-startTimeLabor">Thời gian lao động</label>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input id="id-startTimeLabor" class="form-control" type="time" v-model="data.startTimeLabor"  min="01:00" max="23:00">
                                                                    </div>
                                                                    <div class="col-sm-6 pt-xs-1">
                                                                        <input class="form-control" type="time" v-model="data.endTimeLabor"  min="01:00" max="23:00">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                   <div class="col-sm-6" v-if="data.type != 2">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label for="id-insurrance">Bảo hiểm lao động</label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <input id="id-insurrance" class="form-check-input" type="checkbox" v-model="data.insurrance">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" v-if="data.type != 2">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label for="id-skin">Trang phục lao động</label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                     <input id="id-skin" class="form-check-input" type="checkbox" v-model="data.skin">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12" v-show="data.type == 2">
                                                        <div class="form-group">
                                                            <label for="id-dormitory">Ký túc xá</label>
                                                            <multiselect id="id-dormitory" :options="valueEx" v-model="data.dormitory" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false"></multiselect>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" v-show="data.type != 2">
                                                        <div class="form-group">
                                                            <label for="id-dormitory">Ký túc xá</label>
                                                            <multiselect id="id-dormitory" :options="valueEx" v-model="data.dormitory" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false"></multiselect>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" v-show="data.type != 2">
                                                        <div class="form-group">
                                                            <label for="id-meal">Bữa ăn</label>
                                                            <multiselect id="id-meal" :options="valueEx" v-model="data.meal" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false"></multiselect>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="id-allowance">Phụ cấp ngoài</label>
                                                            <textarea id="id-allowance" rows="3" class="form-control" v-model="data.allowance"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="id-benefits">Quyền lợi khác</label>
                                                            <textarea id="id-benefits" rows="3" class="form-control" v-model="data.benefits"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ValidationObserver>
                                        </tab-content>
                                        <tab-content title="Tiền thưởng" :before-change="checkValidateStep4">
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
                                                    <div class="col-sm-6" v-if="checked">
                                                        <div class="form-group">
                                                            <label for="id-time-bonus">
                                                                Thời gian thanh toán phí
                                                            </label>
                                                            <multiselect id="id-time-bonus" :options="guarantee" v-model="data.time_bonus" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :preselect-first="true"
                                                                :show-labels="false" placeholder="Thời gian thanh toán phí" :disabled="!checked"></multiselect>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" v-if="checked">  
                                                        <ValidationProvider rules="required|customSoam" v-slot="{ errors }" >
                                                            <div class="form-group">
                                                                <label for="id-bonus">
                                                                    Tiền thưởng (<span style="color: red;">*</span>)
                                                                </label>
                                                                <div class="input-group">
                                                                    <input id="id-bonus" type="txt"  class="form-control"  @input="data.bonus = FormatPrice(data.bonus)" v-model="data.bonus" :disabled="!checked">
                                                                    <div class="input-group-addon" style="padding: 9px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                                                                        <p  aria-hidden="true" style="margin: 0px;">{{data.currency}}</p>
                                                                    </div>
                                                                </div>
                                                                <span style="color: red">{{ errors[0] }}</span>
                                                            </div>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="id-promotion-code">Mã khuyễn mãi [Nếu có]</label>
                                                            <input id="id-promotion-code" type="text" class="form-control" v-model="data.promotion_code">
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
                                                                        <label class="btn bg-netbee" for="defaultGroupExample1">Miễn phí</label>
                                                                        <div class="divider divider-warning">
                                                                            <div class="divider-text trial">Tin thường</div>
                                                                        </div>
                                                                        <div>
                                                                            <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị ở box tin mới</p>
                                                                            <!-- <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Hiển thị thứ tự sau Tin VIP và tin nổi bật</p> -->
                                                                            <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Không có icon nổi bật</p>
                                                                            <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Không có chuyên viên hỗ trợ hotline</p>
                                                                            <p class="p-main"><i class="fas fa-check" style="font-size: 12px;"></i> Miễn phí tin đăng</p>
                                                                        </div>
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
                        <div class="col-lg-3 col-12 pl-lg-0">
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

// extend("numeric", {
//     message: (field, values) => "Dữ liệu nhập vào phải là chữ số nguyên dương"
// });
extend("max", {
    message: (field, values) => "Dữ liệu nhập vào không được quá 150 kí tự"
});
extend("customSoam", {
  message: field =>"Dữ liệu nhập vào phải là chữ số nguyên dương",
  validate: value => {
    var notTheseChars = /["'?&/<>-\s]/;
    var mustContainTheseChars = /^(?=.*?[0-9])/;
    var containsForbiddenChars = notTheseChars.test(value);
    if (!containsForbiddenChars) {
      if(parseInt(value)==0) {return false};
      return true;
    } else {
      return false;
    }
  }
})

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

extend("ssdigit", {
    params: ['target'],
    message: (field) => `Không được nhỏ hơn`,
    validate: (value, { target }) => {
        var max = parseInt(JSON.stringify(value).replace(/,|"/gi, ''))
        let min = parseInt(JSON.stringify(target).replace(/,|"/gi, ''))
        if(max >= min){
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
            options: [],
            data: {
                title: '',
                address: '',
                school_name: '',
                nation: {id: null, name: ''},
                expiration_date: '',
                age_start: '18',
                age_late: '35',
                quantity:'',
                salary_start: '',
                salary_end: '',
                salary_status: {id: 1, name: '/ 1 Năm'},
                subsidy: '',
                currency: 'VND',
                date_start: '',
                date_test: '',
                expected_date: '',
                time_bonus: {id: 3, name: 'Ngay sau khi cọc'},
                bonus: null,
                highlight_job: 2,
                visa: '',
                work_form: '',
                type: '',
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
                job_description:'',
                time_contract:'',
                route:'',
                request_cmnd:{id: 1, name: 'Để trống'},
                promotion_code:''
            },
            checked: true,
            guarantee: [
                {id: 3, name: 'Ngay sau khi cọc'},
                {id: 5, name: 'Ngay sau khi có COE'},
                {id: 1, name: 'Ngay sau khi bay'},
                {id: 4, name: 'Hoàn tất nhập cảnh'},
                {id: 2, name: 'Sau khi bay 30 ngày'}
            ],
            money: ['$', 'VND', '€', '¥', '₩'],
            optionsVisa: [],
            optionsFormWork: [
                {id: 1, name: 'Toàn thời gian'},
                {id: 2, name: 'Bán thời gian'},
                {id: 3, name: 'Vừa học vừa làm'}
            ],
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
                {id: 2, name: 'Ứng viên tự chuẩn bị'}
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
            ],
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
            // this.data.expiration_date = moment(Date.now()).add(30, 'days').format("YYYY-MM-DD"); 
            this.data.date_start = moment(Date.now()).format("YYYY-MM-DD"); 
            let res = await this.$axios.$get(`getQuocGia`)
            this.options = res.data
            let visa = await this.$axios.$get(`getVisa`)
            this.optionsVisa = visa.data
            let job = await this.$axios.$get(`tintuyendung/getDetailTinTuyen/${this.$route.params.id}`)
            this.data.title = job.data.title
            this.data.school_name = job.data.school_name
            this.data.address = job.data.workplace
            for (let indexQuocgia = 0; indexQuocgia < res.data.length; indexQuocgia++) {
                if(job.data.nation_id == indexQuocgia+1){
                    this.data.nation = res.data[indexQuocgia]
                }  
            }
            this.data.expiration_date = job.data.expiration_date
            this.data.request = job.data.request
            this.data.route = job.data.route
            this.data.job_description = job.data.job_description
            this.data.height = job.data.height
            this.data.weight = job.data.weight
            if(job.data.academicLevel ==  1){
                this.data.academicLevel = {id: 1, name: 'Trung học phổ thông'}
            }else if(job.data.academicLevel ==  2){
                this.data.academicLevel = {id: 2, name: 'Cao đẳng'}
            }else if(job.data.academicLevel ==  3){
                this.data.academicLevel = {id: 3, name: 'Đại học'}
            }else if(job.data.academicLevel ==  4){
                this.data.academicLevel = {id: 4, name: 'Trên đại học'}
            } else if(job.data.academicLevel ==  5){
                this.data.academicLevel = {id: 5, name: 'Sau đại học'}
            } else if(job.data.academicLevel ==  6){
                this.data.academicLevel = {id: 6, name: 'Không yêu cầu'}
            }
            this.data.insurrance = job.data.insurrance 
            this.data.skin = job.data.skin
            if(job.data.dormitory == 1){
                this.data.dormitory = {id: 1, name: 'Công ty chuẩn bị'}
            }else if(job.data.dormitory == 2){
                this.data.dormitory = {id: 2, name: 'Ứng viên tự chuẩn bị'}
            }
            if(job.data.meal == 1){
                this.data.meal = {id: 1, name: 'Công ty chuẩn bị'}
            }else if(job.data.meal == 2){
                this.data.meal = {id: 2, name: 'Ứng viên tự chuẩn bị'}
            }
            this.data.startTimeLabor = job.data.startTimeLabor
            this.data.endTimeLabor = job.data.endTimeLabor
            this.data.allowance = job.data.allowance
            this.data.benefits = job.data.benefits
            this.data.time_contract = job.data.time_contract
            if(job.data.salary_status ==  1){
                this.data.salary_status = {id: 1, name: '/ 1 Năm'}
            }else if(job.data.salary_status ==  2){
                this.data.salary_status = {id: 2, name: '/ 6 Tháng'}
            }else if(job.data.salary_status ==  3){
                this.data.salary_status = {id: 3, name: '/ 1 Tháng'}
            }else if(job.data.salary_status ==  4){
                this.data.salary_status = {id: 4, name: '/ 1 Kỳ'}
            }
            if(job.data.request_cmnd ==  1){
                this.data.request_cmnd = {id: 1, name: 'Để trống'}
            }else if(job.data.request_cmnd ==  2){
                this.data.request_cmnd = {id: 2, name: 'Có'}
            }else if(job.data.request_cmnd ==  3){
                this.data.request_cmnd = {id: 3, name: 'Không'}
            }
            this.data.date_start = job.data.date_start
            this.data.quantity = job.data.quantity
            this.data.salary_start = job.data.salary_start ? this.FormatPrice(job.data.salary_start) : ''
            this.data.salary_end = job.data.salary_end ? this.FormatPrice(job.data.salary_end) : ''
            this.data.subsidy = job.data.subsidy ? this.FormatPrice(job.data.subsidy) : ''
            for (let indexVisa = 0; indexVisa < visa.data.length; indexVisa++) {
                if(job.data.id_visa == indexVisa+1){
                    this.data.visa = visa.data[indexVisa]
                }  
            }
            if(job.data.work_form == 1){
                this.data.work_form = {id: 1, name: 'Toàn thời gian'}
            }else if(job.data.work_form == 2){
                this.data.work_form = {id: 2, name: 'Bán thời gian'}
            } else {
                this.data.work_form = {id: 3, name: 'Vừa học vừa làm'}
            }
            this.data.currency = job.data.currency
            this.data.date_test = job.data.date_test
            this.data.expected_date = job.data.expected_date
            this.data.age_start = job.data.age_start
            this.data.age_late = job.data.age_late 
            this.data.promotion_code = job.data.promotion_code
            if(job.data.time_bonus == 1){
                this.data.time_bonus = {id: 1, name: 'Ngay sau khi bay'}
            }else if(job.data.time_bonus == 2){
                this.data.time_bonus = {id: 2, name: 'Sau khi bay 30 ngày'}
            } else if(job.data.time_bonus == 3) {
                this.data.time_bonus = {id: 3, name: 'Ngay sau khi cọc'}
            } else if(job.data.time_bonus == 4) {
                this.data.time_bonus = {id: 4, name: 'Hoàn tất nhập cảnh'}
            }else if(job.data.time_bonus == 5) {
                this.data.time_bonus = {id: 5, name: 'Ngay sau khi có COE'}
            }
            job.data.bonus == 0 ? this.data.bonus = null : this.data.bonus = job.data.bonus
            if(job.data.bonus){
                this.checked = true
            }
            this.data.highlight_job = job.data.highlight_job
            this.data.type = job.data.type

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
        async checkValidateStep4(){
            let isValid = await this.$refs.step4.validate();
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
            // console.log(this.data.startTimeLabor)
            let isValid = await this.$refs.step5.validate();
            var form = new FormData();
            if(isValid){
                form.append('title' , this.data.title)
                form.append('school_name' , this.data.school_name)
                form.append('address' , this.data.address)
                form.append('nation_id' , this.data.nation.id)
                form.append('expiration_date' , this.data.expiration_date)
                form.append('salary_start' , this.data.salary_start.split(',').join(''))
                form.append('salary_end' , this.data.salary_end.split(',').join(''))
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
                    form.append('bonus' , this.data.bonus.split(',').join(''))
                }else{
                    form.append('time_bonus' , 0)
                    form.append('bonus' , 0)
                }
                form.append('highlight_job' , this.data.highlight_job)
                form.append('id_visa' , this.data.visa.id)
                form.append('work_form' , this.data.work_form.id)
                form.append('type' , this.data.type)
                form.append('id' , this.$route.params.id)
                form.append('height' , this.data.height)
                form.append('weight' , this.data.weight)
                form.append('academicLevel' , this.data.academicLevel.id)
                form.append('time_contract' , this.data.time_contract)
                if(this.data.insurrance == true){
                    form.append('insurrance' , 1)
                }else {
                     form.append('insurrance' , 0)
                }
                if(this.data.skin == true){
                    form.append('skin' , 1)
                }else {
                    form.append('skin' , this.data.skin)
                }
                form.append('dormitory' , this.data.dormitory.id)
                form.append('meal' , this.data.meal.id)
                form.append('startTimeLabor' , this.data.startTimeLabor)
                form.append('endTimeLabor' , this.data.endTimeLabor)
                form.append('allowance' , this.data.allowance)
                form.append('benefits' , this.data.benefits)
                form.append('request' , this.data.request)
                form.append('route' , this.data.route)
                form.append('salary_status' , this.data.salary_status.id)
                form.append('job_description' , this.data.job_description),
                form.append('request_cmnd' , this.data.request_cmnd.id)
                form.append('promotion_code' , this.data.promotion_code)
                this.$axios.post('tintuyendung/updateTinTuyen',form)
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
                }).catch((e) => {
                    this.$swal(
                            'Lỗi',
                            e,
                            'error'
                        )
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
input[type=radio]:checked{
    background: #ffb701;
    border-radius: 15px;
    border: 4px solid #ffb701;
}
.bot {
    position: absolute;
    bottom: 7px;
    width: 20px;
    height: 20px;
    background-color: #000;
}
button.wizard-btn:hover {
    color: #fff !important;
}
.wizard-btn {
    font-weight: 500 !important;
}
.p-main{
    text-align: left;
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
    position: absolute;
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
.border-netbee:hover {
    background-color: #fff !important;
    box-shadow: 0 1px 4px #887e7e!important;
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
    color: #000;
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
.vue-form-wizard .wizard-card-footer {
    padding: 0 3px !important;
}
</style>
