<template>
  <section class="section is-medium">
    <div class="container has-text-centered">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <br />
          <div class="w-100"></div>
          <div class="col-md-a">
            <p style="margin-right: 90px;">
              <span>Address:</span> Tầng 2 21-B6, Green Stars 234 Phạm Văn Đồng
            </p>
          </div>
          <div class="col-md-3" style="margin-right: -25px;">
            <p>
              <span>Phone:</span>
              <a href="tel:02462900388" class="lh" style="color: black;">02462900388</a>
            </p>
          </div>
          <div class="col-md-3">
            <p>
              <span>Email:</span>
              <a href="mailto:info@yoursite.com" class="lh" style="color: black;">info@netbee.vn</a>
            </p>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form
              action="#"
              class="bg-white p-5 contact-form"
              style=" width: 600px; padding-top:0px !important"
            >
              <h2 class="h3 NB_main_title" style="height: 34px;padding-top: 9px;">THông tin liên hệ</h2>

              <div class="form-group">
                <input type="text" class="form-control" placeholder="Họ và tên" />
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" />
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Tiêu đề" />
              </div>
              <div class="form-group">
                <textarea name id cols="30" rows="7" class="form-control" placeholder="Tin nhắn"></textarea>
              </div>
              <div class="form-group text-center">
                <input
                  type="submit"
                  value="Gửi cho Netbee"
                  class="btn btn-primary"
                  style="background-color: #ffc107 !important;"
                />
              </div>
            </form>
          </div>

          <div class="col-md-6 d-flex" style="padding:0px 0px 40px 40px;">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.494656172276!2d105.7778146153898!3d21.052896792328728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4b54698fad%3A0xdc6d73d2030fac0d!2sHachinet!5e0!3m2!1svi!2s!4v1580379940334!5m2!1svi!2s"
              width="570"
              height="570"
              frameborder="0"
              style="border:0;"
              allowfullscreen
            ></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  head: {
    title: "Contact",
    meta: [
      {
        hid: "description",
        name: "description",
        content: "Contact-Netbee"
      }
    ],
    noscript: [{ innerHTML: "Body No Scripts", body: true }],
    script: [
      { src: "/head.js" },
      // Supported since 1.0
      { src: "/body.js", body: true },
      { src: "/defer.js", defer: "" }
    ]
  }
};
</script>
<style>
.row.d-flex.mb-5.contact-info {
  color: black;
}
a.lh:hover {
  color: #ffb701 !important;
}
</style>