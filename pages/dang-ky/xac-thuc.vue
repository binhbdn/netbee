<template>
    <div class="netbee">
        <div class="container my-3">
            <div class="row">
                <div class="d-flex justify-content-center py-4 col-12">
                <div class="logo logo--medium text-center"><a href="/" class="router-link-active"><img style="height: 95%; width: 30%" src="/assets/img/logo_no_bg.png" alt="Netbee Logo" class="logo-image"></a></div>
                </div>
            </div>
            <div class="row">
                <div class="mx-auto col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="el-card is-always-shadow">
                    <!---->
                    <div class="el-card__body">
                        <h1 class="card-title text-center">
                            Kích hoạt tài khoản Netbee
                        </h1>
                        <p class="card-subtitle mt-2">
                            Chào mừng bạn đến với <strong>nền tảng tuyển dụng Netbee</strong>!
                            Tham gia với chúng tôi để tìm được việc làm ưng ý và thông tin hữu ích cần thiết cho bạn.
                        </p>
                        <div role="alert" class="el-alert my-4 pt-4 el-alert--success">
                            <!---->
                            <div class="el-alert__content">
                            <!---->
                            <div class="el-alert__description">
                            <div>
                                <p>
                                    Chào mừng <strong>{{$route.query.username}}</strong>,
                                    tài khoản của bạn đã được <strong>đăng kí thành công</strong>.
                                    Chúng tôi đã gửi cho bạn 1 đường dẫn kích hoạt tài khoản tới <strong>{{$route.query.email}}</strong>.
                                    Vui lòng kiểm tra hộp thư đến của bạn để hoàn tất đăng kí.
                                </p>
                                <p>
                                    Nếu bạn không nhận được email kích hoạt từ chúng tôi, vui lòng nhấn vào 
                                    <a @click="resentActivationEmail()" class=""><strong>gửi lại</strong></a>
                                    email kích hoạt.
                                </p>
                            </div>
                            </div><!----><i class="el-alert__closebtn el-icon-close" style="display: none;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    layout: 'no_layout',
    methods: {
        resentActivationEmail(){
            this.$axios.get('resentActivationEmail',this.$route.query.email).then(response=> {
                if(response.data.status == 200){
                    this.$swal('Thành công',response.data.message, 'success')
                }
            })
        }
    }
}
</script>>

<style scoped>
.el-alert--success {
    background-color: #f0f9eb!important;
    color: #67c23a;
}
.el-alert {
    width: 100%;
    padding: 8px 16px;
    margin: 0;
    box-sizing: border-box;
    border-radius: 4px;
    position: relative;
    background-color: #fff;
    overflow: hidden;
    opacity: 1;
    display: flex;
    align-items: center;
    transition: opacity .2s;
}
.el-card.is-always-shadow, .el-card.is-hover-shadow:focus, .el-card.is-hover-shadow:hover {
    box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
}
.el-card {
    border-radius: 4px;
    border: 1px solid #ebeef5;
    background-color: #fff;
    overflow: hidden;
    color: #303133;
    transition: .3s;
}
.el-card__body {
    padding: 20px;
}
.pt-4, .py-4 {
    padding-top: 1rem!important;
}
.mt-4, .my-4 {
    margin-top: 1rem!important;
}
.pb-4, .py-4 {
    padding-bottom: 1rem!important;
}
a {
    color: #007bff;
    text-decoration: none;
    background-color: initial;
}
html {
    background-color: #fff;
}
.justify-content-center {
    justify-content: center!important;
}
.d-flex {
    display: flex!important;
}
.netbee{
    background-color: #F8F8F8;
}
</style>