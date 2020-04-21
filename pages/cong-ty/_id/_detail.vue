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
                                <img v-lazy="`/uploads/users/avatars/${congty.avatar}`" :alt="`${congty.avatar}`" width="100%">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="company-job-title">
                                <h2 class="font-weight-bold text-uppercase"><span class="company-name"  data-toggle="tooltip" data-placement="right" :title="`${congty.name}`"> {{ congty.name }} <i data-toggle="tooltip" data-placement="top" title="Công ty đã xác thực" class="fad fa-check btn-verify"></i></span></h2>
                                <p><span class="font-weight-600"><i class="fad fa-map-marked-alt"></i> Địa chỉ: {{ congty.address_detail ? congty.address_detail: 'Đang cập nhật' }}</span></p>
                                <p><span class="font-weight-600"><i class="fad fa-phone-office"></i> Hotline: {{ congty.company_hotline ? congty.company_hotline: 'Đang cập nhật' }}</span></p>
                                <p><span class="font-weight-600"><i class="fad fa-link"></i> Website: {{ congty.company_link ? congty.company_link: 'Đang cập nhật' }}</span></p>
                                <p><span class="font-weight-600"><i class="fad fa-calendar-minus"></i> Ngày thành lập: {{ congty.birth_of_date ? ConvertDate(congty.birth_of_date): 'Đang cập nhật' }}</span></p>
                            </div>
                        </div>
                        <div class="col-lg-2 count-job">
                            <h1 style="font-size: 70px;color: #ffb701;">{{ countJob ? countJob : '0' }}</h1>
                            <h2>Việc làm</h2>
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
                        <div class="col-12">
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
    </div>
</template>
<script>
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate'
export default {
    components: {
        JobsList1ColNotCate
    },
    data() {
        return {
            arrayForCompany: [],
            countJob: ''
        }
    },
    async asyncData({$axios, route}) {
        try {
            let detailRes = await $axios.$get(`getInfoCompanyById/${route.params.id}`)
            return {
                congty: detailRes.data[0],
            }
        } catch (error) {
            return {congty : []}

        }

    },
    head() {
        return {
            title: this.congty.name,
            meta: [
                { hid: 'description', name: 'description', content: this.congty.name },
                { hid: 'keywords', name: 'keywords', content: this.congty.name},
                { hid: 'og:url', name: 'og:url', content: 'https://netbee.vn'+this.$route.path},
                { hid: 'og:title', name: 'og:title', content: this.congty.name},
                { hid: 'og:description', name: 'og:description', content: this.congty.name},
                { hid: 'og:image', name: 'og:image', content: this.congty.avatar},
            ]
        }
    },
    mounted() {
        this.$axios.$get(`getTinTuyenDungForCompany/${this.congty.company_id}?limit=5`).then((response)=>{
            this.arrayForCompany = response.data.tintuyendung
            this.countJob = response.data.count
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