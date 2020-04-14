<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row"></div>
      <div class="content-body">
        <div class="col-xl-7 col-md-9 col-10 d-flex justify-content-center px-0">
          <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
              <div class="col-lg-6 d-lg-block d-none text-center align-self-center">
                <img src="/app-assets/images/pages/forgot-password.png" alt="branding logo" />
              </div>
              <div class="col-lg-6 col-12 p-0">
                <div class="card rounded-0 mb-0 px-2 py-1">
                  <div class="card-header pb-1">
                    <div class="card-title">
                      <h4 class="mb-0">Quên Mật Khẩu</h4>
                    </div>
                  </div>
                  <p
                    class="px-2 mb-0"
                  >Vui lòng nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn hướng dẫn về cách đặt lại mật khẩu của bạn.</p>
                  <div class="card-content">
                    <div class="card-body">
                      <form action="index.html">
                        <div class="form-label-group">
                          <input
                            type="email"
                            id="inputEmail"
                            class="form-control"
                            placeholder="Email"
                          />
                          <label for="inputEmail">Email</label>
                        </div>
                      </form>
                      <div class="float-md-left d-block mb-1">
                        <a
                          href="/dang-nhap"
                          class="btn btn-outline-primary btn-block px-75"
                        >Chuyển sang Login</a>
                      </div>
                      <div class="float-md-right d-block mb-1">
                        <a href="#" class="btn btn-primary btn-block px-75">Gửi Email</a>
                      </div>
                    </div>
                  </div>
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
export default {};
</script>
<style>
.app-content.content {
  margin: -80px -333px 47px 250px;
}
a.btn.btn-primary.btn-block.px-75 {
  background-color: #ffb701 !important;
  color: black;
  font-weight: 200;
}
a.btn.btn-outline-primary.btn-block.px-75 {
  color: black;
  border-color: #ffb701 !important;
}
input#inputEmail {
  border-color: #ffb701 !important;
}
</style>