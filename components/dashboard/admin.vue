<template>
        <div class="content-wrapper" >
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fa fa-user-circle-o text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ countPageView }}</h2>
                                    <p class="mb-0">Lượt truy cập</p>                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a href="/admin/quan-ly-tai-khoan?role=3">
                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-success p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="fa fa-credit-card-alt text-success font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">{{ countUserHr }}</h2>
                                        <p class="mb-0">Số lượng HR</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a href="/admin/quan-ly-tai-khoan?role=2">
                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-danger p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">{{ countUserCompany }}</h2>
                                        <p class="mb-0">Số lượng công ty</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a href="/admin/quan-ly-tai-khoan?role=1">
                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="fa fa-users text-warning font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">{{ countUserUser }}</h2>
                                        <p class="mb-0">Số lượng ứng viên</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a href="/admin/tin-tuyen-dung">
                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="fa fa-newspaper-o text-success font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">{{ countJob }}</h2>
                                        <p class="mb-0">Số lượng tin</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a href="/admin/ho-so">
                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="fa fa-sign-in text-info font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">{{ countUserUT }}</h2>
                                        <p class="mb-0">Số lượng ứng tuyển</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Tổng lượt truy cập</h3>
                                    <div class="action-btns">
                                        <div class="btn-dropdown ">
                                            <div class="btn-group dropdown actions-dropodown">
                                                <button type="button" class="btn btn-white px-2 py-75 waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Lọc
                                                    <i class="fa fa-caret-down mr-0 ml-1"></i>
                                                </button>
                                                <div class="dropdown-menu" style="left: -25px!important;">
                                                    <a class="dropdown-item" @click="sortChartLine(7)"><i class="feather icon-clipboard"></i> 1 tuần trước </a>
                                                    <a class="dropdown-item" @click="sortChartLine(14)"><i class="feather icon-clipboard"></i> 2 tuần trước </a>
                                                    <a class="dropdown-item" @click="sortChartLine(30)"><i class="feather icon-clipboard"></i>1 tháng trước</a>
                                                    <a class="dropdown-item" @click="sortChartLine(365)"><i class="feather icon-clipboard"></i>1 năm trước</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <chartjs-line
                                    :backgroundcolor="bgColor"
                                    :beginzero="beginZero"
                                    :bind="true"
                                    :bordercolor="borderColor"
                                    :data="data[radio]"
                                    :datalabel="dataLabel"
                                    :labels="labels[radio]"
                                />
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Nguồn truy cập</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row mb-25" v-for="(referrer,indexReferrer) in fetchTopReferrers" :key="indexReferrer">
                                            <div class="browser-info col-10">
                                                <p class="mb-25">{{ referrer.url }}</p>
                                            </div>
                                            <div class="stastics-info text-right text-success col-2 pl-0">
                                                <span>{{ referrer.pageViews }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Lượng truy cập</h3>
                                </div>
                                <chartjs-doughnut
                                    :bind="true"
                                    :datasets="datasetsfetchTopBrowsers"
                                    :labels="labelsfetchTopBrowsers"
                                    :option="option"
                                />
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-3 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Quốc gia</h3>
                                </div>
                                <chartjs-doughnut
                                    :bind="true"
                                    :datasets="datasetsfetchTopCountry"
                                    :labels="labelsfetchTopCountry"
                                    :option="option"
                                />
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->
            </div>
        </div>
</template>
<script>
import moment from 'moment'
export default {
    data() {
        return {
            countPageView: '',
            countUserHr: '',
            countUserCompany: '',
            countUserUser: '',
            countJob: '',
            countUserUT: '',
            browsers: [],
            fetchTopReferrers: [],
            option: {},
            datasetsfetchTopBrowsers: [
                {
                    data: [10, 20],
                    backgroundColor: ["#f36e60", "#ffdb3b"],
                    hoverBackgroundColor: ["#fbd2cd", "#fef5c9"]
                }
            ],
            labelsfetchTopBrowsers: ["1", "2"],
            datasetsfetchTopCountry: [
                {
                    data: [10, 20],
                    backgroundColor: ["#f36e60", "#ffdb3b"],
                    hoverBackgroundColor: ["#fbd2cd", "#fef5c9"]
                }
            ],
            labelsfetchTopCountry: ["1", "2"],

            bgColor: "#ffb701",
            beginZero: true,
            borderColor: "#ffb701",
            data: {
                week: [12, 14, 16, 18, 11, 13, 15]
            },
            dataLabel: "Số lượng",
            labels: {
                week: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
            },
            radio: "week"
        };
    },
    methods: {
        sortChartLine(day) {
            this.$axios.$get('getAnalytic?day='+day).then((res) => {
                this.data.week = res.fetchTotalVisitorsAndPageViews.map(item => item.pageViews)
                this.labels.week = res.fetchTotalVisitorsAndPageViews.map(item => item.date.date)
            })
        }
    },
    mounted() {
        this.$axios.$get('getAnalytic').then((res) => {
            this.datasetsfetchTopBrowsers[0].data = res.fetchTopBrowsers.rows.map(item => item[1])
            this.labelsfetchTopBrowsers = res.fetchTopBrowsers.rows.map(item => item[0])
            this.datasetsfetchTopCountry[0].data = res.fetchTopCountry.rows.map(item => item[1])
            this.labelsfetchTopCountry = res.fetchTopCountry.rows.map(item => item[0])
            this.fetchTopReferrers = res.fetchTopReferrers
            this.data.week = res.fetchTotalVisitorsAndPageViews.map(item => item.pageViews)
            this.labels.week = res.fetchTotalVisitorsAndPageViews.map(item => moment(String(item.date.date)).format('DD/MM/YYYY'))
            this.countPageView = res.countPageView.rows[0][0]
            this.countUserHr = res.countUserHr.data
            this.countUserCompany = res.countUserCompany.data
            this.countUserUser = res.countUserUser.data
            this.countJob = res.countJob
            this.countUserUT = res.countUserUT
        })
    }
}
</script>
<style>
@media (max-width: 991px){
    #dashboard-ecommerce .col-lg-3, #dashboard-ecommerce .col-lg-8, #dashboard-ecommerce .col-lg-7{
        padding-right: 14px;
    }
}
</style>
