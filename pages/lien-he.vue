<template>
  <section class="section is-medium">
    <div class="container has-text-centered">
        <div class="row p-b-15">
          <div class="order-md-last d-flex row">
            <div class="col-md-7 form-lienhe">
              <h2 class="h3 NB_main_title p-10">Thông tin liên hệ</h2>
                <div class="row d-flex mb-5 contact-info">
                  <div class="col-md-12">
                    <p>
                      Cám ơn bạn đã vào thăm trang Netbee.vn của chúng tôi, website tuyển dụng xuất khẩu lao động lớn nhất tại Việt Nam hiện nay. Bạn có thể liên hệ với chúng tôi theo một trong những cách sau:
                    </p>
                  </div>
                  <div class="col-md-12">
                    <p>
                      <span class="font-weight-600">Địa chỉ:</span> Tầng 2 21-B6, Green Stars 234 Phạm Văn Đồng
                    </p>
                  </div>
                  <div class="col-md-12">
                    <p>
                      <span class="font-weight-600">Hotline:</span>
                      <a href="tel:02462900388" class="lh" style="color: black;">02462900388</a>
                    </p>
                  </div>
                  <div class="col-md-12">
                    <p>
                      <span class="font-weight-600">Email:</span>
                      <a href="mailto:info@yoursite.com" class="lh" style="color: black;">info@netbee.vn</a>
                    </p>
                  </div>
                </div>
            </div>
            <div class="col-md-5">
              <a  href="https://www.google.com/maps/place/Hachinet/@21.052892,105.780003,15z/data=!4m5!3m4!1s0x0:0xdc6d73d2030fac0d!8m2!3d21.0528918!4d105.7800033?hl=vi" target="_blank">
                <img v-lazy = "`/assets/img/mapimg1.png`" style="max-width: 100%" alt="Smiley face">                        
              </a>
            </div>
          </div>
        </div>
    </div>
  </section>
</template>
<style scoped>
.form-lienhe {
  background-image: url('/assets/img/contact-page-banner.png');
  background-size: 230px 230px;
  background-repeat: no-repeat;
  background-position: right;
}
@media (max-width: 767px){
  .col-md-7{
    padding-top: 1rem;
    order: 2;
    border: 1px solid #fff;
  }
  .col-md-5{
    order: 1;
  }
  .section{
    padding: 0 1rem;
  }
}
</style>