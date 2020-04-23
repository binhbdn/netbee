<template>
    <div class="container" id="fb-root">
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row p-1">
                        <div class="col-lg-2 d-flex align-items-center">
                            <div class="avatar-company">
                                <img v-lazy="`/uploads/users/avatars/${tintuc.avatar}`" :alt="`${tintuc.avatar}`" width="100%">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="company-job-title">
                                <h1 class="font-weight-bold">{{ tintuc.title }}</h1>
                                <h4 class="font-weight-bold text-uppercase"><i class="fad fa-building"></i> <span class="company-name"  data-toggle="tooltip" data-placement="right" :title="`${tintuc.name}`"> {{ tintuc.name }} <i data-toggle="tooltip" data-placement="top" title="Công ty đã xác thực" class="fad fa-check btn-verify"></i></span></h4>
                                <p><span class="font-weight-600">Loại tin: </span><span class="badge background-default badge-md">{{ tintuc.type == 3 ? 'Tu nghiệp sinh' : tintuc.type == 2 ? 'Du học sinh' : 'Xuất khẩu lao động' }}</span></p>
                                <p><span class="font-weight-600">Địa điểm tuyển dụng: </span>{{ tintuc.nation_name }}</p>
                                <p><span class="font-weight-600" v-if="tintuc.type != 2">Mức lương: </span> <span class="font-weight-600" v-if="tintuc.type == 2">Học phí: </span> {{ FormatPrice(tintuc.salary_start) }}{{ tintuc.currency }} ~ {{ FormatPrice(tintuc.salary_end) }}{{ tintuc.currency }}</p>
                                <p><span class="font-weight-600">Hạn nộp hồ sơ: </span>{{ ConvertDate(tintuc.expiration_date) }}</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row" style="border:#dee2e6 solid 1px;height: 100%">
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-right:#dee2e6 solid 1px;border-bottom:#dee2e6 solid 1px;">
                                    <a class="btn-netbee btn" data-toggle="tooltip" data-placement="top" title="Nộp hồ sơ"><i class="fad fa-paper-plane fa-2x p-10"></i></a>
                                </div>
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-bottom:#dee2e6 solid 1px">
                                    <a class="btn btn-save" @click="saveJob()" data-toggle="tooltip" data-placement="top" :title="!save ? 'Lưu việc làm' : 'Bỏ việc làm'"><i :class="{'fad fa-heart fa-2x p-10' : !save, 'fad fa-heart-broken fa-2x p-10' : save}"></i></a>
                                </div>
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-right:#dee2e6 solid 1px">
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://netbee.vn/tin-tuyen-sinh/99/xuat-khau-lao-dong&amp;src=sdkpreparse" class="btn btn-fb" data-toggle="tooltip" data-placement="top" title="Chia sẻ lên Facebook"><i class="fab fa-facebook fa-2x p-10"></i></a>
                                </div>
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#reportModal" >
                                    <a class="btn btn-report" data-toggle="tooltip" data-placement="top" title="Thông báo lỗi"><i class="fad fa-exclamation-triangle fa-2x p-10"></i></a>
                                </div>
                            </div>
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
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row p-t-10">
                        <div class="col-12">
                            <div class="col-5 p-l-0">
                                <h5 class="font-weight-600 line-title">THÔNG TIN TUYỂN DỤNG NHANH</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="border-bottom mt-1 title">Mô tả công việc</h5>
                                    <p class="px-1" v-html="tintuc.description" style="white-space: pre-line;"></p>
                                </div>
                                <div class="col-lg-12">
                                    <h5 class="border-bottom mt-1 title" >Yêu cầu</h5>
                                    <p class="px-1" v-html="tintuc.request" style="white-space: pre-line;"></p>
                                </div>
                                <div class="col-lg-12">
                                    <h5 class="border-bottom mt-1 title">Quyền lợi</h5>
                                    <p class="px-1" v-html="tintuc.benefit" style="white-space: pre-line;"></p>
                                </div>
                                <div class="col-lg-12">
                                    <h5 class="border-bottom mt-1 title">Hồ sơ cần chuẩn bị</h5>
                                    <p class="px-1" v-html="tintuc.cv_content" style="white-space: pre-line;"></p>
                                </div>
                                <div class="col-xl-12">
                                    <h5 class="border-bottom mt-1 title">Thông tin thêm</h5>
                                    <div class="px-1">
                                        <p>Địa điểm: {{ tintuc.workplace }}</p>
                                        <p v-if="tintuc.type == 2">Trường: {{ tintuc.school_name }}</p>
                                        <p>Tuổi: {{ tintuc.age_start }} {{ tintuc.age_end? ' - '+tintuc.age_end+' tuổi' : ' tuổi trở lên' }}</p>
                                        <p v-if="tintuc.type != 2">Lương: {{ FormatPrice(tintuc.salary_start) }}{{ tintuc.currency }} ~ {{ FormatPrice(tintuc.salary_end) }}{{ tintuc.currency }}</p>
                                        <p v-if="tintuc.type == 2">Học phí: {{ FormatPrice(tintuc.salary_start) }}{{ tintuc.currency }} ~ {{ FormatPrice(tintuc.salary_end) }}{{ tintuc.currency }}</p>
                                        <p v-if="tintuc.type != 2">Hình thức làm việc: {{ tintuc.form_work == 1 ? 'Toàn thời gian' : tintuc.form_work == 2? 'Bán thời gian' : 'Vừa học vừa làm' }}</p>
                                        <p v-if="tintuc.time_bonus">Bonus: {{ tintuc.time_bonus == 1 ? tintuc.bonus : tintuc.time_bonus == 2 ? tintuc.bonus * 1.5 : tintuc.bonus * 3 }}{{ tintuc.currency }}</p>
                                        <p>Chi phí xuất cảnh: {{ tintuc.subsidy }}{{ tintuc.currency }}</p>
                                        <p>Ngày bắt đầu nhận hồ sơ: {{ formatDate(tintuc.date_start) }}</p>
                                        <p>Ngày dự kiến nhập cảnh: {{ formatDate(tintuc.expected_date) }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-12 pb-2">
                                    <h5 class="border-bottom mt-1 title">Cách thức ứng tuyển</h5>
                                    Ứng viên nộp hồ sơ trực tiếp tại văn phòng công ty hoặc nộp trực tuyến bằng cách bấm vào nút <b>Nộp hồ sơ</b>.<br>
                                    <div class="text-center">
                                        <div>
                                            <button class="btn  btn-warning w-75" style="width: 214px !important; color: #000; border-color: #ffb701 !important; background-color: #ffb701 !important;"><i class="fad fa-paper-plane"></i> Nộp hồ sơ</button>
                                        </div>
                                        <i>Hạn nộp hồ sơ: {{formatDate(tintuc.expiration_date)}}</i><br>
                                        <a href="#">Phản ánh tin tuyển dụng không chính xác</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">
                    <i class="fad fa-bullhorn"></i> VIỆC LÀM CÙNG CÔNG TY
                </h4>
                </div>
                <div class="card-content collapse show">
                <div class="card-body">
                    <JobsList1ColNotCate :DataList="arrayForCompany"></JobsList1ColNotCate>
                </div>
                </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">
                    <i class="fad fa-bullhorn"></i> VIỆC LÀM TƯƠNG TỰ
                </h4>
                </div>
                <div class="card-content collapse show">
                <div class="card-body">
                    <JobsList1Col :DataList="tintuc.type == 1 ? arrayJobXKLD : tintuc.type == 2 ? arrayJobDHS : arrayJobTNS"></JobsList1Col>
                </div>
                </div>
            </div>
          </div>
        </div>
      </section>
        <!-- Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editTodoTask" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                <div class="modal-content">
                    <section class="todo-form">
                        <form id="form-edit-todo" class="todo-input">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTodoTask">Thông báo lỗi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"> 
                                <fieldset class="form-group">
                                    <textarea class="edit-todo-item-desc form-control" v-model="report" rows="3" placeholder="Nội dung..."></textarea>
                                </fieldset>
                            </div>
                            <div class="modal-footer">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" @click="reportJob()" class="btn bg-netbee update-todo-item" data-dismiss="modal"><i class="feather icon-edit d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Gửi</span></button>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="feather icon-x d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Cancel</span></button>
                                </fieldset>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=1459241224260897&autoLogAppEvents=1"></script>
<script>
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate'
import JobsList1Col from '~/components/Jobs/JobsList1Col'
import moment from 'moment'
export default {
    components: {
        JobsList1ColNotCate,
        JobsList1Col
    },
    data() {
        return {
            arrayForCompany: [],
            save: false,
            report: ''
        }
    },
    async asyncData({$axios, route}) {
        let detailRes = await $axios.$get(`getDetailTinTuyenDung/${route.params.id}`)
        let getTinTuyenDungHot = await $axios.$get(`getTinTuyenDungHot?limit=10`)
        let getTinTuyenDungXKLD = await $axios.$get(`getTinTuyenDungNew?limit=5&type=1`)
        let getTinTuyenDungDHS = await $axios.$get(`getTinTuyenDungNew?limit=5&type=2`)
        let getTinTuyenDungTNS = await $axios.$get(`getTinTuyenDungNew?limit=5&type=3`)
        return {
            tintuc: detailRes.data[0],
            arrayJobHot: getTinTuyenDungHot.data.tintuyendung,
            arrayJobXKLD: getTinTuyenDungXKLD.data.tintuyendung,
            arrayJobDHS: getTinTuyenDungDHS.data.tintuyendung,
            arrayJobTNS: getTinTuyenDungTNS.data.tintuyendung,
        }
    },
    head() {
        return {
            title: this.tintuc.title,
            meta: [
                { hid: 'description', name: 'description', content: this.tintuc.title },
                { hid: 'keywords', name: 'keywords', content: this.tintuc.title},
                { hid: 'og:url', name: 'og:url', content: 'https://netbee.vn'+this.$route.path},
                { hid: 'og:title', name: 'og:title', content: this.tintuc.title},
                { hid: 'og:description', name: 'og:description', content: this.tintuc.title},
                { hid: 'og:image', name: 'og:image', content: this.tintuc.avatar},
            ]
        }
    },
    methods: {
        formatDate(value){
                if (value) {
                    // return moment(String(value)).format('MM/DD/YYYY');
                return (moment(String(value)).format('MM/DD/YYYY'));
                }
        },
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
        reportJob() {
            this.$axios.$post(`tintuyendung/report`,{id_job: this.tintuc.id,report: this.report}).then((response)=>{
                if(response.status == 200) {
                    this.$swal(
                    'Thành công!',
                        response.message,
                    'success'
                    );
                }else {
                    this.$swal(
                    'Lỗi!',
                        response.message,
                    'error'
                    );
                }
            }).catch((e) => {
                this.$swal(
                'Cảnh báo!',
                'Bạn cần đăng nhập để thực hiện chức năng này',
                'warning'
                );
            });
        }
    },
    mounted() {
        this.$axios.$get(`getTinTuyenDungForCompany/${this.tintuc.id_created}?limit=5`).then((response)=>{
            this.arrayForCompany = response.data.tintuyendung
        });
        if(this.$auth.loggedIn) {
            this.$axios.$post(`tintuyendung/postView`,{id_job: this.tintuc.id}).then((response)=>{});
            this.$axios.$get(`tintuyendung/getSave`,{id_job: this.tintuc.id}).then((response)=>{
                this.save = response.data
            });
        }
    }
}
</script>
<style scoped>
.line-title {
    border-bottom: 2px solid #ffb701;
    padding-bottom: 5px;
}
.avatar-company {
    width: 170px;
}
.btn-netbee {
    color: #ffb701 !important;
}
.btn-save {
    color: #55ce63 !important;
}
.btn-fb {
    color: #4267b2 !important;
}
.btn-report {
    color: #f62d51 !important;
}
.btn-netbee:hover {
    background: #ffb701 !important;
    color: #fff !important;
}
.btn-save:hover {
    background: #55ce63 !important;
    color: #fff !important;
}
.btn-fb:hover {
    background: #4267b2 !important;
    color: #fff !important;
}
.btn-report:hover {
    background: #f62d51 !important;
    color: #fff !important;
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
.title {
    font-weight: bold;
    color: #4e4d4d;
}
</style>