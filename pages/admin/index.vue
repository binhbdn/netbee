<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div v-if="$auth.user.role == 2" >
            <div class="content-wrapper" style="padding-bottom: 0">
                <div class="content-body">
                    <!-- Dashboard Ecommerce Starts -->
                    <section id="dashboard-ecommerce">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <a href="/admin/tin-tuyen-dung">
                                    <div class="card" style="margin-bottom: 15px;">
                                        <div class="card-header d-flex flex-column align-items-start pb-0">
                                            <div class="avatar bg-rgba-primary p-50 m-0">
                                                <div class="avatar-content">
                                                    <i class="fa fa-user text-primary font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="text-bold-700 mt-1">{{CountCompany.length}}</h2>
                                            <p class="mb-0">Số tin tuyển dụng</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card" style="margin-bottom: 15px;">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-success p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="fa fa-credit-card text-success font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">{{sumview}}</h2>
                                        <p class="mb-0">Số lượt xem</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <a href="/admin/quan-ly-ung-tuyen">
                                    <div class="card" style="margin-bottom: 15px;">
                                        <div class="card-header d-flex flex-column align-items-start pb-0">
                                            <div class="avatar bg-rgba-danger p-50 m-0">
                                                <div class="avatar-content">
                                                    <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="text-bold-700 mt-1">{{sumapp}}</h2>
                                            <p class="mb-0">Số lượt ứng tuyển</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <a href="/admin/calendar">
                                    <div class="card" style="margin-bottom: 15px;">
                                        <div class="card-header d-flex flex-column align-items-start pb-0">
                                            <div class="avatar bg-rgba-warning p-50 m-0">
                                                <div class="avatar-content">
                                                    <i class="fa fa-internet-explorer text-warning font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="text-bold-700 mt-1">{{CountCall}}</h2>
                                            <p class="mb-0">Phỏng vấn online</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <DashboardNTD/>
        </div>
        <DashboardHr v-else-if="$auth.user.role == 3 || $auth.user.role == 1"/>
        <DashboardAdmin v-else/>
    </div>
</template>

<script>
import DashboardHr from '~/components/dashboard/hr'
import DashboardAdmin from '~/components/dashboard/admin'
import DashboardNTD from '~/components/dashboard/nhaTuyenDung'

import companyApplyManage from '~/components/Apply/company.vue'

export default {
     data() {
    return {
      datasets: [
        {
          data: [10, 20, 40],
          backgroundColor: ["#f36e60", "#ffdb3b", "#185190"],
          hoverBackgroundColor: ["#fbd2cd", "#fef5c9", "#d1e3f7"]
        }
      ],
      labels: ["Foo", "Bar", "Baz"],
      option: {},
      CountCompany: [],
      sumview:'',
      sumapp:'',
      CountCall:''
    };
  },
    name: 'Dashboard',
        layout: 'admin',
    head: {
        title: 'Home page 🚀',
        meta: [
        { hid: 'description', name: 'description', content: 'Home page description' }
        ],
        script: [

        ],

    },
    components:{
        DashboardHr,
        DashboardAdmin,
        companyApplyManage,
        DashboardNTD
    },
    methods: {
        dailogCompany: async function(){
            try {
                let dataInforCompany = await this.$axios.get('getInfoCompany');
                console.log(dataInforCompany)
                if(dataInforCompany.data.data == null){
                    this.$swal({
                    title: 'Bạn cần hoàn thiện hồ sơ để đăng tin',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false
                    }).then(async (result) => {
                        if(result.value) {
                            window.location.href = "/admin/thong-tin-tai-khoan"
                        }
                    })
                }
            }catch(error) {
                this.$swal(
                    'Cảnh báo',
                    'Bạn cần hoàn thiện hồ sơ để đăng tin',
                    'warning'
                )
            }            
        },
        CompanyDash: function(){
            try {
                this.$axios.get('getJobByRoleCompanyDash')
                .then(response => {  
                    this.CountCompany = response.data
                    this.sumview = this.CountCompany.reduce((acc, item) => acc + item.viewers, 0)
                    this.sumapp = this.CountCompany.reduce((acc, item) => acc + item.applyers, 0)
                })
                .catch(error => {
                    console.log(error.response)
                });
            }
            catch (error) {
                this.$swal(
                    'Lỗi!',
                    'Lỗi dữ liệu!',
                    'error')
            } 
        },
        CallDash: function(){
            try {
                this.$axios.get('CountCreateCall')
                .then(response => {  
                    this.CountCall = response.data
                })
                .catch(error => {
                    console.log(error.response)
                });
            }
            catch (error) {
                this.$swal(
                    'Lỗi!',
                    'Lỗi dữ liệu!',
                    'error')
            } 
        }
    },
    mounted(){
        if(this.$auth.user.role == 2){
            // this.dailogCompany()
            this.CompanyDash()
            this.CallDash()
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
</style>
