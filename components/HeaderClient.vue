<template>
  <nav
    class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
    id="ftco-navbar"
  >
    <div class="container">
      <a class="navbar-brandd" href="/">
        <div>
          <img
            src="../static/assets/img/logo-full-2.png"
            alt=""
            height="50"
            width="130"
          />
        </div>
      </a>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item " style="padding-top:3px" :class="{active : this.$route.path == '/'}">
            <a href="/" class="nav-link header-nav-link">
              <i class="fa fa-home"></i>
              <br />Trang chủ
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/tin-tuyen-sinh'}">
            <a href="/tin-tuyen-sinh" class="nav-link header-nav-link">
              <i class="fa fa-server"></i>
              <br />Tin tuyển sinh
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/cong-ty'}">
            <a href="/cong-ty" class="nav-link header-nav-link" style="text-align: center">
              <i class="fa fa-building" style="font-size: 21px"></i>
              <br />Công ty
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/tin-tuc'}">
            <a href="/tin-tuc" class="nav-link header-nav-link" >
              <i class="fa fa-table" style="font-size"></i>
              <br />Tin tức
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/ve-netbee'} " >
            <a href="/ve-netbee" class="nav-link header-nav-link">
              <i class="fa fa-id-card"></i>
              <br />Về NetBee
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/lien-he'} " >
            <a href="/lien-he" class="nav-link header-nav-link">
              <i class="fa fa-window-restore"></i>
              <br />Liên hệ
            </a>
          </li>
          
          <li class="nav-item cta mr-md-2 dropdown" v-if="!$auth.loggedIn">
            <a href="#" class="nav-link header-nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"  >
              <i class="fa fa-user-circle"></i>
              <br />Trở thành đối tác
              <i class="fas fa-caret-down" style="padding-left:2px"></i>
            </a>
            <div class="dropdown-menu" style="top: 102%!important;top: 102%!important;border-radius: 9px;box-shadow: none;" aria-labelledby="navbarDropdown">
              <div id="login-up"></div>
              <a class="dropdown-item" href="/dang-ky/ung-vien">Đăng kí ứng viên</a>
              <a class="dropdown-item" href="/dang-ky/nha-tuyen-dung">Đăng kí nhà tuyển dụng</a>
              <a class="dropdown-item" href="/dang-ky/chuyen-vien-tuyen-dung">Đăng kí chuyên viên tuyển sinh</a>
              <a class="dropdown-item" href="/dang-nhap">Đăng nhập</a>
            </div>
          </li>
          <li class="nav-item cta mr-md-2 dropdown" v-else>
            <img v-lazy="this.$auth.user.avatar != null && this.$auth.user.avatar.startsWith('https') ? this.$auth.user.avatar : `/uploads/users/avatars/${this.$auth.user.avatar}`"
            style="height:30px; width:30px; position: absolute; left:41px;padding-top: 1px; object-fit: cover; border-radius: 50%;">
            <a href="#" class="nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-top: 15px;">
              <br />Tài khoản
              <i class="fas fa-caret-down" style="padding-left:2px"></i>
            </a>
            <div class="dropdown-menu" style="top: 102%!important;" aria-labelledby="navbarDropdown">
              <div id="login-up"></div>
              <a class="dropdown-item" href="/admin">{{ this.$auth.user.name }}</a>
              <a class="dropdown-item" @click="logout()">Đăng xuất</a>
            </div>
          </li>
          <!-- <li class="nav-item cta cta-colored mr-md-2">
            <a href="#" class="nav-link header-nav-link">
              <i class="fa fa-user-plus"></i>
              <br />Giới thiệu học sinh
            </a>
          </li> -->
          <li class="nav-item cta dropdown">
            <a href="#" class="nav-link header-nav-link" style="padding-bottom: 0px; height: 100%; border:unset!important;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img style="margin-left: 19px;margin-bottom: -2px;" src="/assets/img/iconfinder_Vietnam_flat_92420.png" width="25px"/>
              <br />Ngôn ngữ
              <i class="fas fa-caret-down" style="padding-left:2px"></i>
            </a>
            <div
              class="dropdown-menu sticky text-center"
              style="top: 102%!important;"
              aria-labelledby="navbarDropdown"
            >
              <div id="login-up"></div>
              <a class="dropdown-item">
                <img
                  src="/assets/img/iconfinder_United-Kingdom.png"
                  width="25px"
                />
              </a>
              <a class="dropdown-item">
                <img
                  src="/assets/img/iconfinder_Japan_92149.png"
                  width="25px"
                />
              </a>
              <a class="dropdown-item">
                <img
                  src="/assets/img/iconfinder_South-Korea_92351.png"
                  width="25px"
                />
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
      methods: {
      async logout() {
        this.$auth.logout()
      }
    },
}
</script>