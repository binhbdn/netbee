<template>
<!--  <Header/>-->
  <div class="main mt-5" :style="{'background-image':'url('+backgroundUrl+');'}">

    <div class="container" style="padding-top:40px">
      <div class="row">
        <div class="col-12 formlogin re">
          <a href="/dang-ky/chuyen-vien-tuyen-dung">
            <div class="row">
              <div class="col-4">
                <span class="circle danger" style="margin: 0 auto;"><i class="fa fa-list-alt" style="color:white"></i></span>
              </div>
              <div class="col-8">
                <h4 class="" style="color: #f61100;">Đăng ký chuyên viên tuyển sinh</h4>
                <p class="box-register_text"><i class="fa fa-check-circle"></i>&nbsp;Tiếp cận hàng triệu ứng viên hoàn toàn miễn phí</p>
                <p class="box-register_text"><i class="fa fa-check-circle"></i>&nbsp;Ứng tuyển nhanh chóng, dễ dàng</p>
                <p class="box-register_text"><i class="fa fa-check-circle"></i>&nbsp;Nhận bản tin công việc phù hợp định kỳ</p>
                <p class="box-register_text"><i class="fa fa-check-circle"></i>&nbsp;Nâng cao cơ hội tìm ứng viên</p>
                <p style="width: 100%;height: 46px;"><button class="btn btn-danger"><span>Đăng ký chuyên viên tuyển sinh</span></button></p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 formlogin re">
          <a href="/dang-ky/nha-tuyen-dung">
            <div class="row">
              <div class="col-8" style="text-align: right">
                <h4 class="rgs-between register-company-text" style="color: #038600;">Đăng ký nhà tuyển dụng</h4>
                <p class="box-register_text">+ 3,000 ứng viên tiếp cận thông tin tuyển dụng&nbsp;<i class="fa fa-check-circle"></i></p>
                <p class="box-register_text">Hơn 20 hồ sơ ứng tuyển cho 1 việc làm đăng tuyển tại Netbee&nbsp;<i class="fa fa-check-circle"></i></p>
                <p class="box-register_text">Tăng hiệu quả 4 - 5 lần so với các phương thức tuyển dụng khác&nbsp;<i class="fa fa-check-circle"></i></p>
                <p class="box-register_text">+ 2,000 lượt xem trung bình cho 1 việc làm&nbsp;<i class="fa fa-check-circle"></i></p>
                <p style="width: 100%;height: 46px;"><button class="btn btn-success register-company pull-right"><span>Đăng ký nhà tuyển dụng</span></button></p>
              </div>
              <div class="col-4">
                <span class="circle register-company" style="margin: 0 auto;"><i class="fa fa-list-alt" style="color:white"></i></span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 formlogin re">
          <a href="/dang-ky/ung-vien">
            <div class="row">
              <div class="col-4">
                <span class="circle uv" style="margin: 0 auto;"><i class="fa fa-list-alt" style="color:white"></i></span>
              </div>
              <div class="col-8">
                <h4 class="ulc" style="color: #9200ac;">Đăng ký ứng viên</h4>
                <p class="box-register_text"><i class="fa fa-check-circle"></i> Tiếp cận hàng triệu công việc hoàn toàn miễn phí</p>
                <p class="box-register_text"><i class="fa fa-check-circle"></i> Ứng tuyển nhanh chóng, dễ dàng</p>
                <p class="box-register_text"><i class="fa fa-check-circle"></i> Nhận bản tin công việc phù hợp định kỳ</p>
                <p class="box-register_text"><i class="fa fa-check-circle"></i> Nâng cao cơ hội tìm việc với chương trình ứng viên năng động</p>
                <p style="width: 100%;height: 46px;"><button class="btn btn-success ul uv" style="background-color: #9c27b0!important"><span>Đăng ký ứng viên</span></button></p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

  </div>
<!--  <FooterCliet/>-->
</template>
<script>
  import Header from '../../components/HeaderAdmin'
  import FooterClient from '../../components/FooterClient'
  export default {
    middleware: 'guest',
    layout: 'no_banner',
    components: {Header, FooterClient},
    data() {
         return { backgroundUrl:require('~/static/assets/img/body-bg.jpg') }
        },
  }
</script>
<style scoped>
  .col-12 {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 10px;
    padding-left: 10px;
  }
  .re {
    margin-bottom: 36px;
    padding: 20px;
    border: 4px solid #eee;
  }
  .re a {
    text-decoration: none;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
    color: #ffb701;
  }
  a:hover, a:focus {
    text-decoration: none;
    color: #ffb701;
    outline: none !important;
  }
  .formlogin {
    border-radius: 7px;
    background: #ffffff85;
  }
  .circle {
    display: block;
    background: #9c27b0;
    color: #fff;
    width: 120px;
    height: 120px;
    border-radius: 120px;
    font-size: 60px;
    line-height: 120px;
    text-align: center;
    margin: 0 auto !important;
    margin-left: 20px;
    -webkit-transition: all .15s ease-in-out;
    transition: all .15s ease-in-out;
  }
  .formlogin p{
    color: #000;
  }
  .formlogin i{
    color: #ffb701;
  }
  .danger {
    background: #f44336 !important;
    color: #fff;
  }
  .register-company {
      background: #0b8408;
      color: #fff;
  }
  .uv {
    background: #9c27b0;
    color: #fff;
}
h4{
  font-size: 27px;
  font-weight: 600;
}
.btn{
  color: #000;
}
.btn:hover{
  color: #fff;
}

@media screen and (max-width: 767px) {
  .formlogin {
    padding: 10px;
  }
  .circle {
    width: 100px;
    height: 100px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
}
</style>

