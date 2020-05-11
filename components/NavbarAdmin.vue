<template>
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="/">
                        <div>
                          <img src="/assets/img/logo-full.png" alt="Smiley face" height="40" width="150">
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li :class="[{'active' : this.$route.name == 'admin'}, 'nav-item']"><a @click="$router.push('/admin')"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                </li>
                <li class=" navigation-header"><span>Apps</span>
                </li>
                <li :class="[{'active' : (this.$route.name == 'admin-news') || (this.$route.name == 'admin-news-create')}, 'nav-item']" v-if="$auth.user.role == 4"><a href="#"><i class="far fa-copy"></i><span class="menu-title" data-i18n="Ecommerce">Bài viết</span></a>
                    <ul class="menu-content">
                        <li><a href="/admin/news"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Danh sách</span></a>
                        </li>
                        <li><a href="/admin/news/create"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Tạo bài viết mới</span></a>
                        </li>
                    </ul>
                </li>
                <li :class="[{'active' : (this.$route.name == 'admin-tin-tuyen-dung-danh-sach') || (this.$route.name == 'admin-tin-tuyen-dung-tao')}, 'nav-item']" v-if="$auth.user.role == 2 || $auth.user.role == 4"><a href="#"><i class="fas fa-briefcase"></i><span class="menu-title" data-i18n="Ecommerce">Tin tuyển dụng</span></a>
                    <ul class="menu-content">
                        <li><a href="/admin/tin-tuyen-dung"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Danh sách</span></a>
                        </li>
                        <li><a href="/admin/tin-tuyen-dung/tao"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Tạo tin tuyển dụng</span></a>
                        </li>
                    </ul>
                </li> 
                <li :class="[{'active' : this.$route.name == 'quan-ly-ung-tuyen'}, 'nav-item']"><a @click="$router.push('/admin/quan-ly-ung-tuyen')" v-if="$auth.user.role == 4"><i class="fad fa-folder-open"></i><span class="menu-title" data-i18n="User">Quản lý ứng tuyển</span></a>
                </li>
                <li :class="[{'active' : this.$route.name == 'quan-ly-ung-tuyen'}, 'nav-item']"><a @click="$router.push('/admin/quan-ly-ung-tuyen')" v-if="$auth.user.role == 3"><i class="fad fa-id-card-alt"></i><span class="menu-title" data-i18n="User"> Việc làm đã ứng tuyển</span></a>
                </li>
                <li :class="[{'active' : this.$route.name == 'admin-thong-tin-tai-khoan'}, 'nav-item']"><a @click="$router.push('/admin/thong-tin-tai-khoan')"><i class="feather icon-user" ></i><span class="menu-title" data-i18n="User">Thông tin tài khoản</span></a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
  name: 'Navbar',
  data()  {
    return {

    }
  },
  mounted() {
      
  }
}
</script>