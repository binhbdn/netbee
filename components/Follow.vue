<template>
    <div class="ftco-section-parallax">
        <div class="d-flex " id="follow">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7">
                        <div class="register_form">
                            <div><h2 class="text">Đăng ký tư vấn</h2></div>
                            <p>Hãy để lại thông tin để nhận tư vấn từ netbee.</p>
                            <form action="" method="">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" placeholder="Nhập họ và tên" class="form-control" name="name" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="text" placeholder="Nhập số điện thoại" class="form-control" name="phone" required>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <input type="email" placeholder="Nhập địa chỉ email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-sm-12 text-center form-group">
                                        <button class="btn btn-warning text-dark w-100">
                                            <i class="far fa-paper-plane"></i> Gửi
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 text-center pt-4">
                        <img src="/assets/img/1256652.svg" height="280">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'News',
}
</script>
<style>
#follow{
    background-image: url("/assets/img/pattern_bg.png");
    background-position: center center;
    background-size: cover;
    background-color: #1e1e1e;
    height: 380px;
}

.register_form {
    color: #ececec;
    padding-top: 50px;
} 
.text{
    color: #fff;
}
</style>