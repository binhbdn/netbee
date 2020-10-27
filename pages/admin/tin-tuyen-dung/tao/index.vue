z<template>
    <div class="app-content content">
        <div class="content-wrapper container" style="padding-top:19px">
            <div class="content-body content-on">
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12 pl-0">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body p-2 pb-3">
                                        <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                                            <div class="avatar-content">
                                                <i class="fa fa-comments text-warning font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2>Chọn loại tin</h2>
                                        <p class="mb-0 line-ellipsis">Chọn 1 trong những mẫu tin phù hợp với yêu cầu của bạn miễn phí</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 pdleft">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body p-2 pb-3">
                                        <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                            <div class="avatar-content">
                                                <i class="fa fa-heart text-info font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2>Cập nhật thông tin</h2>
                                        <p class="mb-0 line-ellipsis">Cập nhật các thông tin, kỹ năng, học vấn, kinh nghiệm... mà bạn yêu cầu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 pr-0">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body p-2 pb-3">
                                        <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                                            <div class="avatar-content">
                                                <i class="fa fa-registered text-success font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2>Đăng và nhận ứng viên</h2>
                                        <p class="mb-0 line-ellipsis">Cập nhât thông tin ứng tuyển thường xuyên qua email, sms ...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="content-body content-below">
                <section id="News"> 
                    <div class="row">
                        <div class="col-12 p-r-0 p-l-0">
                            <div class="card">
                                <div class="card-header" style="margin: auto;">
                                    <h3>CÁC LOẠI TIN ĐĂNG</h3>
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body p-3">
                                                        <h2>Tin Du Học</h2>
                                                        <a href="/admin/tin-tuyen-dung/tao/tin-du-hoc" data-toggle="tooltip"  data-placement="top" :title="`ĐĂNG TUYỂN NGAY`" class="btn waves-effect waves-light">ĐĂNG TUYỂN NGAY</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body p-3">
                                                        <h2>Tin Xuất Khẩu</h2>
                                                        <a href="/admin/tin-tuyen-dung/tao/tin-xkld" data-toggle="tooltip"  data-placement="top" :title="`ĐĂNG TUYỂN NGAY`" class="btn waves-effect waves-light">ĐĂNG TUYỂN NGAY</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body p-3">
                                                        <h2>Tu Nghiệp Sinh</h2>
                                                        <a href="/admin/tin-tuyen-dung/tao/tin-tu-nghiep-sinh" data-toggle="tooltip"  data-placement="top" :title="`ĐĂNG TUYỂN NGAY`" class="btn waves-effect waves-light">ĐĂNG TUYỂN NGAY</a>
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
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CreateIndexJob',
    layout: 'admin',
    middleware: 'verify_company',
    head: {
        title: 'Home page 🚀',
        script: [

        ]
    },
    data () {
        return {

        }
    },

    methods:{
        async dailogCompany(){
            try {
                let dataInforCompany = await this.$axios.get('getInfoCompany');
                console.log(dataInforCompany)
                if(dataInforCompany.data.data == null){
                    this.$swal({
                    title: 'Bạn cần hoàn thiện hồ sơ để đăng tin',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                    }).then(async (result) => {
                        if(result.value) {
                            window.location.href = "/admin/thong-tin-tai-khoan"
                        }
                    })
                }else {
                    if(this.$auth.user.status == 0){
                        this.$swal({
                            title: 'Bạn cần phải vào mail kích hoạt tài khoản để đăng tin',
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false
                        }).then(async (result) => {
                        if(result.value) {
                            window.location.href = "/admin"
                        }
                    })
                    }
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
    mounted () {
        if(this.$auth.user.role == 2){
            this.dailogCompany();
        }
    }
  
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
.pdleft{
    padding-right: 7px ;
    padding-left: 7px;
}
.bg-gradient-success{
    background: #ec36d6;
    background-image: -webkit-linear-gradient(60deg, #28C76F, rgba(40, 199, 111, 0.5));
}
.card-dashboard .card{
    border: 1px solid #000;
    border-radius: 10px;
}
.waves-effect{
    background-color: #ffb701;
    color: #000;
}
.waves-effect:hover{
    color: #ffffff;
}
@media (max-width: 1199px){
    .content-on{
        display: none;
    }
}
</style>
