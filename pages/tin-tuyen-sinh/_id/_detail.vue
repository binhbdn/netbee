<template>
    <div class="container">
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
                                <p><span class="font-weight-600">Mức lương: </span>{{ tintuc.salary_start }}{{ tintuc.currency }} ~ {{ tintuc.salary_end }}{{ tintuc.currency }}</p>
                                <p><span class="font-weight-600">Hạn nộp hồ sơ: </span>{{ ConvertDate(tintuc.expiration_date) }}</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row" style="border:#dee2e6 solid 1px;height: 100%">
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-right:#dee2e6 solid 1px;border-bottom:#dee2e6 solid 1px;">
                                    <a class="btn-netbee btn" data-toggle="tooltip" data-placement="top" title="Ứng tuyển ngay"><i class="fad fa-paper-plane fa-2x p-10"></i></a>
                                </div>
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-bottom:#dee2e6 solid 1px">
                                    <a class="btn btn-save" data-toggle="tooltip" data-placement="top" title="Lưu việc làm"><i class="fad fa-heart fa-2x p-10"></i></a>
                                </div>
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" style="border-right:#dee2e6 solid 1px">
                                    <a class="btn btn-fb" data-toggle="tooltip" data-placement="top" title="Chia sẻ lên Facebook"><i class="fab fa-facebook fa-2x p-10"></i></a>
                                </div>
                                <div class="col-sm-6 col-xl-6 d-flex justify-content-center align-items-center" >
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
                                <div class="col-lg-6">
                                    1
                                </div>
                                <div class="col-lg-6">
                                    2
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
    </div>
</template>
<script>
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate'
import JobsList1Col from '~/components/Jobs/JobsList1Col'
export default {
    components: {
        JobsList1ColNotCate,
        JobsList1Col
    },
    data() {
        return {
            arrayForCompany: []
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
    mounted() {
        this.$axios.$get(`getTinTuyenDungForCompany/${this.tintuc.id_created}?limit=5`).then((response)=>{
            this.arrayForCompany = response.data.tintuyendung
        });
    }
    // jsonld() {
    //     return {
    //         "@context": "http://schema.org/",
    //         "@type":"EmployerAggregateRating",
    //         "itemReviewed":{
    //             "@type":"Organization",
    //             "name": this.tintuc.title,
    //             "sameAs": 'https://netbee.vn'+this.$route.path
    //             },
    //         "ratingValue": "4",
    //         "bestRating": "5",
    //         "worstRating": "3",
    //         "ratingCount": "5"
    //     };
    // },
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
</style>