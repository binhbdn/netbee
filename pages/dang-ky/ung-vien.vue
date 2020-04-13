<template>
    <section class="hero-wraps js-fullheight" style="margin-top:100px">
    <div class="container">
        <div class="row ">
            <div class="col-7 pt-4" style="padding:0px 15px;">
                <h3>Đăng kí ứng viên</h3>
                <ul class="list">
                    <li>Tiếp cận hàng triệu công việc hoàn toàn miễn phí</li>
                    <li>Ứng tuyển nhanh chóng, dễ dàng</li>
                    <li>Nhận bản tin công việc phù hợp định kỳ</li>
                    <li>Nâng cao cơ hội tìm việc với chương trình ứng viên năng động</li>
                </ul>
            </div>
            <div class="col-5" style="padding:0px 15px;">
                <div class="text-center" style="background: #ffb701;padding:10px; margin-bottom:10px;">
                    <span style="color:#000; font-weight: bold;">ĐĂNG KÝ TÀI KHOẢN ỨNG VIÊN</span>
                </div>
                <span>Nếu đã có tài khoản, xin vui lòng đăng nhập <a href="">Tại đây</a></span>
                <form method="POST" class="appointment-form" id="appointment-form" style="margin-top:10px;">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Họ & Tên</label>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Email</label>
                        <input type="email" class="form-control" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Mật khẩu</label>
                        <input type="password" class="form-control" name="password" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="password_confirmation" >
                    </div>
                    <div class="form-check" style="margin-bottom:0px;">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>Tôi đồng ý với các  <a href="" class="term-service text-dark">điều khoản</a></label>
                    </div>
                    <div class="form-submit text-center" style="padding-bottom: 10px;margin-top:10px;">
                        <input type="button" name="submit" id="submit" class="btn btn-outline-warning" style="font-weight: bold;" value="Đăng ký ngay"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</template>
<script>
export default {
    middleware: 'guest',
    layout: 'no_banner',
}
</script>
<style scoped>
.hero-wrap {
        width: 100%;
        height: 80px !important;
        position: inherit;
        background-color: #ffb701 !important;
    }
    .no-gutters {
        margin-right: 0;
        margin-left: 0;
        height: 80px !important;
    }
    .hero-wraps {
        width: 100%;
        height: 600px !important;
        position: inherit;
        margin-top: 40px;
    }
    .bg-dark.ftco-navbar-light.ftco_navbar.navbar.navbar-dark.navbar-expand-lg{
        top: 0;
    }
    .nav-link.dropdown-toggle{
        border: 1px solid #fff !important;
        border-radius: 3px !important;
        padding-top: 7px !important;
        padding-bottom: 7px !important;
        padding-left: 20px !important;
        padding-right: 20px !important;
    }
    .list{
        line-height: 40px;
        font-size: 20px;
    }
    .btn-outline-warning:hover {
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
    }
    label span{
        padding-right: 3px;
        font-size: 14px;
    }
    label{
        font-size: 15px;
    }
</style>