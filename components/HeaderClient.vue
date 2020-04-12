<template>
  <nav
    class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
    id="ftco-navbar"
  >
    <div class="container">
      <a class="navbar-brandd">
        <div>
          <img
            src="https://netbee.vn/site/assets/images/logo.png"
            alt="Smiley face"
            height="50"
            width="auto"
          />NetBee
        </div>
      </a>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active" style="padding-top:3px">
            <a href="/" class="nav-link header-nav-link">
              <i class="fa fa-home"></i>
              <br />Trang chủ
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px">
            <a href="/tin-tuyen-sinh" class="nav-link header-nav-link">
              <i class="fa fa-server"></i>
              <br />Tin tuyển sinh
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px">
            <a href class="nav-link header-nav-link">
              <i class="fa fa-table"></i>
              <br />Tin tức
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px">
            <a href="/ve-netbee" class="nav-link header-nav-link">
              <i class="fa fa-id-card"></i>
              <br />Về NetBee
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px">
            <a href="/lien-he" class="nav-link header-nav-link">
              <i class="fa fa-window-restore"></i>
              <br />Liên hệ
            </a>
          </li>

          <li class="nav-item cta mr-md-2 dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle header-nav-link"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="true"
            >
              <i class="fa fa-user-circle"></i>
              <br />Trở thành đối tác
            </a>
            <div
              class="dropdown-menu"
              style="top: 102%!important;top: 102%!important;border-radius: 9px;box-shadow: none;"
              aria-labelledby="navbarDropdown"
            >
              <div id="login-up"></div>
              <a class="dropdown-item" href="/dang-ky/ung-vien">Đăng kí ứng viên</a>
              <a class="dropdown-item" href="/dang-ky/nha-tuyen-dung">Đăng kí nhà tuyển dụng</a>
              <a class="dropdown-item" href="/dang-ky/chuyen-vien-tuyen-dung">Đăng kí chuyên viên tuyển sinh</a>
              <a class="dropdown-item" href="/dang-nhap">Đăng nhập</a>
            </div>
          </li>
          <li class="nav-item cta cta-colored mr-md-2">
            <a href="#" class="nav-link header-nav-link">
              <i class="fa fa-user-plus"></i>
              <br />Giới thiệu học sinh
            </a>
          </li>
          <!-- <li class="nav-item cta mr-md-2 dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <br />
            </a>
            <div
              class="dropdown-menu"
              style="top: 102%!important;"
              aria-labelledby="navbarDropdown"
            >
              <div id="login-up"></div>
              <a class="dropdown-item" href>Name</a>
              <a class="dropdown-item" href>Đăng xuất</a>
            </div>
          </li>-->
          <li class="nav-item cta dropdown">
            <a
              href="#"
              class="nav-link header-nav-link"
              style="padding-bottom: 0px; height: 100%"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                style="margin-left: 19px;margin-bottom: -2px;"
                src="https://netbee.vn/site/assets/images/iconfinder_Vietnam_flat_92420.png"
                width="25px"
              />
              <br />Ngôn ngữ
            </a>

            <div
              class="dropdown-menu sticky text-center"
              style="top: 102%!important;"
              aria-labelledby="navbarDropdown"
            >
              <div id="login-up"></div>
              <a class="dropdown-item">
                <img
                  src="https://netbee.vn/site/assets/images/iconfinder_United-Kingdom.png"
                  width="25px"
                />
              </a>
              <a class="dropdown-item">
                <img
                  src="https://netbee.vn/site/assets/images/iconfinder_Japan_92149.png"
                  width="25px"
                />
              </a>
              <a class="dropdown-item">
                <img
                  src="https://netbee.vn/site/assets/images/iconfinder_South-Korea_92351.png"
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
