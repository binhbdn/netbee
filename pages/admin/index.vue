<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div v-if="$auth.user.role == 2" >
            <div class="content-wrapper">
                <div class="content-body">
                    <!-- Dashboard Ecommerce Starts -->
                    <section id="dashboard-ecommerce">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-users text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">234</h2>
                                        <p class="mb-0">Số tin tuyển dụng</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-success p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-credit-card text-success font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">56</h2>
                                        <p class="mb-0">Số lượt xem</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-danger p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">45</h2>
                                        <p class="mb-0">Số lượt ứng tuyển</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-header d-flex flex-column align-items-start pb-0">
                                        <div class="avatar bg-rgba-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-package text-warning font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-bold-700 mt-1">34</h2>
                                        <p class="mb-0">Phỏng vấn online</p>
                                    </div>
                                </div>
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
      option: {}
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
        async dailogCompany(){
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
        }
    },
    mounted(){
        // if(this.$auth.user.role == 2){
        //     this.dailogCompany();
        // }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
</style>
