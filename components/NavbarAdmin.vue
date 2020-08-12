<template>
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" style="background-color: #2f3b4c;" data-scroll-to-active="true">
        <div class="navbar-header d-flex" style="height: 90px">
            <ul class="nav navbar-nav" style="padding-top: 22px">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="far fa-bars fa-2x" style="color: #fff"></i></a></li>
            </ul>
            <ul class="nav navbar-nav" style="padding-left: 15px">
                <li class="nav-item mr-auto"  style="margin: auto; margin-top: -10px;">
                    <a class="navbar-brand" href="/">
                        <img src="/assets/img/logo-netbee-2-ncd.png" alt="Smiley face" height="60" width="130">
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="background-color: #2f3b4c;color: #fff;">
                <li><a  :class="[{'active' : $route.name == 'admin/'}, 'nav-item']" @click="$router.push('/admin')"><i class="fa fa-home"></i><span class="menu-title" data-i18n="Dashboard">Trang chủ</span></a>
                </li>
                <!-- <li class=" navigation-header"><span style="color: #fff;">Apps</span>
                </li> -->
                <li  v-if="$auth.user.role == 4"><a  href="#"><i class="far fa-copy"></i><span class="menu-title" data-i18n="Ecommerce">Bài viết</span></a>
                    <ul class="menu-content">
                        <li :class="[{'active' : ($route.name == 'admin-news')}, 'nav-item']"><a @click="$router.push('/admin/news')"  ><i class="fa fa-circle"></i><span class="menu-item" data-i18n="Shop">Danh sách</span></a>
                        </li>
                        <li :class="[{'active' : ($route.name == 'admin-news-create')}, 'nav-item']"><a @click="$router.push('/admin/news/create')" ><i class="fa fa-circle"></i><span class="menu-item" data-i18n="Details">Tạo bài viết mới</span></a>
                        </li>
                    </ul>
                </li>
                <!-- <li  v-if="$auth.user.role == 4"><a  href="#"><i class="far fa-copy"></i><span class="menu-title" data-i18n="Ecommerce">Tài liệu</span></a>
                    <ul class="menu-content">
                        <li :class="[{'active' : ($route.name == 'admin-tai-lieu')}, 'nav-item']"><a @click="$router.push('/admin/tai-lieu')"  ><i class="fa fa-circle"></i><span class="menu-item" data-i18n="Shop">Danh sách</span></a>
                        </li>
                        <li :class="[{'active' : ($route.name == 'admin-tai-lieu-create')}, 'nav-item']"><a @click="$router.push('/admin/tai-lieu/create')" ><i class="fa fa-circle"></i><span class="menu-item" data-i18n="Details">Tạo tài liệu mới</span></a>
                        </li>
                    </ul>
                </li> -->
                <li  v-if="$auth.user.role == 2 || $auth.user.role == 4"><a  href="#"><i class="fas fa-briefcase"></i><span class="menu-title" data-i18n="Ecommerce">Tin tuyển dụng</span></a>
                    <ul class="menu-content">
                        <li :class="[{'active' : ($route.name == 'admin-tin-tuyen-dung')}, 'nav-item']"><a @click="$router.push('/admin/tin-tuyen-dung')" ><i class="fa fa-circle"></i><span class="menu-item" data-i18n="Shop">Danh sách</span></a>
                        </li>
                        <li :class="[{'active' : ($route.name == 'admin-tin-tuyen-dung-tao')}, 'nav-item']"><a @click="$router.push('/admin/tin-tuyen-dung/tao')" ><i class="fa fa-circle"></i><span class="menu-item" data-i18n="Details">Tạo tin tuyển dụng</span></a>
                        </li>
                    </ul>
                </li> 
                <li ><a :class="[{'active' : $route.name == 'ho-so'}, 'nav-item']" @click="$router.push('/admin/ho-so')" v-if="$auth.user.role == 4 || $auth.user.role == 1 || $auth.user.role == 3"><i class="fad fa-folder-open"></i><span class="menu-title" data-i18n="User">Hồ sơ ứng tuyển</span></a>
                <li ><a :class="[{'active' : $route.name == 'quan-ly-ung-tuyen'}, 'nav-item']" @click="$router.push('/admin/quan-ly-ung-tuyen')" v-if="$auth.user.role == 4 || $auth.user.role == 2"><i class="fas fa-satellite-dish"></i><span class="menu-title" data-i18n="User">Quản lý ứng tuyển</span></a>                
                </li>
                <li ><a :class="[{'active' : $route.name == 'calendar'}, 'nav-item']" @click="$router.push('/admin/calendar')" ><i class="fa fa-calendar"></i><span class="menu-title" data-i18n="User">Lịch phỏng vấn</span></a>
                <!-- <li :class="[{'active' : $route.name == 'call'}, 'nav-item']"><a @click="$router.push('/admin/call')" ><i class="fa fa-phone-square"></i><span class="menu-title" data-i18n="User">Phỏng vấn trực tuyến</span></a> -->
                <li  v-if="$auth.user.role == 4"><a :class="[{'active' : $route.name == 'quang-cao'}, 'nav-item']" @click="$router.push('/admin/quang-cao')" ><i class="fa fa-camera-retro"></i><span class="menu-title" data-i18n="User">Quảng cáo</span></a>
                <li ><a :class="[{'active' : $route.name == 'quan-ly-ung-tuyen'}, 'nav-item']" @click="$router.push('/admin/quan-ly-ung-tuyen')" v-if="$auth.user.role == 3 || $auth.user.role == 1"><i class="fad fa-id-card-alt"></i><span class="menu-title" data-i18n="User"> Hồ sơ đã nộp</span></a>
                </li>

                <!-- <li :class="[{'active' : ($route.name == 'admin-quan-ly-viec-lam') || ($route.name == 'admin-quan-ly-viec-lam-viec-lam-da-luu')}, 'nav-item']"><a href="#" v-if="$auth.user.role == 3 || $auth.user.role == 1"><i class="fas fa-briefcase"></i><span class="menu-title" data-i18n="Ecommerce">Quản lý việc làm</span></a>
                    <ul class="menu-content">
                        <li><a href="/admin/quan-ly-viec-lam/viec-lam-da-luu"><i class="fad fa-save"></i><span class="menu-item" data-i18n="Details">Việc làm đã lưu</span></a>
                        </li>
                    </ul>
                </li> -->
                <li ><a :class="[{'active' : $route.name == 'admin-viec-lam-da-luu'}, 'nav-item']" @click="$router.push('/admin/quan-ly-viec-lam/viec-lam-da-luu')" v-if="$auth.user.role == 3 || $auth.user.role == 1"><i class="fad fa-save"></i><span class="menu-title" data-i18n="Details">Việc làm đã lưu</span></a>
                <li ><a :class="[{'active' : $route.name == 'friends'}, 'nav-item']" @click="$router.push('/admin/friends')" v-if="$auth.user.role == 3"><i class="fa fa-users"></i><span class="menu-title" data-i18n="User">Giới thiệu bạn bè</span></a>                
                </li>
                <li ><a :class="[{'active' : $route.name == 'thong-tin-tai-khoan'}, 'nav-item']" @click="$router.push('/admin/thong-tin-tai-khoan')"><i class="fa fa-user" ></i><span class="menu-title" data-i18n="User">Thông tin tài khoản</span></a>
                </li>
                <li  v-if="$auth.user.role == 4"><a><i class="fas fa-briefcase"></i><span class="menu-title" data-i18n="Ecommerce">Quản lý tài khoản</span></a>
                    <ul class="menu-content">
                        <li><a  @click="$router.push('/admin/quan-ly-tai-khoan/company')" :class="[{'active' : ($route.name == 'admin-quan-ly-tai-khoan-company')}, 'nav-item']"><i class="fa fa-circle"></i><span class="menu-item" data-i18n="User">Tài khoản NTD</span></a>
                        </li>
                        <li><a   @click="$router.push('/admin/quan-ly-tai-khoan/hr')" :class="[{'active' : ($route.name == 'admin-quan-ly-tai-khoan-hr')}, 'nav-item']"><i class="fa fa-circle"></i><span class="menu-item" data-i18n="Details">Tài khoản Hr</span></a>
                        </li>
                        <li><a  @click="$router.push('/admin/quan-ly-tai-khoan/ungvien')"  :class="[{'active' : ($route.name == 'admin-quan-ly-tai-khoan-ungvien')}, 'nav-item']"><i class="fa fa-circle"></i><span class="menu-item" data-i18n="Details">Tài khoản Ứng viên</span></a>
                        </li>
                    </ul>
                </li>
                <li ><a :class="[{'active' : $route.name == 'bonus'}, 'nav-item']" @click="$router.push('/admin/cai-dat/bonus')" v-if="$auth.user.role == 4"><i class="fa fa-cogs"></i><span class="menu-title" data-i18n="User">Cài đặt bonus</span></a>                
                </li>
                <li ><a :class="[{'active' : $route.name == 'notification'}, 'nav-item']" @click="$router.push('/admin/thong-bao')"><i class="fa fa-bell"></i><span class="menu-title" data-i18n="User">Thông báo</span></a>                
                </li>
            </ul>
        </div>
        <!--ring ring-->
        <div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon" style="left: -50px; bottom: 150px; position: fixed;">
            <div class="phonering-alo-ph-circle"></div>
            <div class="phonering-alo-ph-circle-fill"></div>
            <a href="tel:+842462900388"></a>
            <div class="phonering-alo-ph-img-circle">
            <a href="tel:+842462900388"></a>
            <a href="tel:+842462900388" class="pps-btn-img " title="Liên hệ">
            <img src="https://i.imgur.com/v8TniL3.png" alt="Liên hệ" width="50" onmouseover="this.src='https://i.imgur.com/v8TniL3.png';" onmouseout="this.src='https://i.imgur.com/v8TniL3.png';">
            </a>
            </div>
        </div>
        <a href="tel:+842462900388"></a>
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
<style scoped>
.phonering-alo-phone.phonering-alo-static {
    opacity:.6
}

.phonering-alo-phone.phonering-alo-hover,.phonering-alo-phone:hover {
    opacity:1
}

.phonering-alo-ph-circle {
    width:160px;
    height:160px;
    top:20px;
    left:20px;
    position:absolute;
    background-color:transparent;
    border-radius:100% !important;
    border:2px solid rgba(30,30,30,0.4);
    border:2px solid #bfebfc 9;
    opacity:.1;
    -webkit-animation:phonering-alo-circle-anim 1.2s infinite ease-in-out;
    animation:phonering-alo-circle-anim 1.2s infinite ease-in-out;
    transition:all .5s;
    -webkit-transform-origin:50% 50%;
    -ms-transform-origin:50% 50%;
    transform-origin:50% 50%
}

.phonering-alo-phone.phonering-alo-active .phonering-alo-ph-circle {
    -webkit-animation:phonering-alo-circle-anim 1.1s infinite ease-in-out!important;
    animation:phonering-alo-circle-anim 1.1s infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-static .phonering-alo-ph-circle {
    -webkit-animation:phonering-alo-circle-anim 2.2s infinite ease-in-out!important;
    animation:phonering-alo-circle-anim 2.2s infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-hover .phonering-alo-ph-circle,.phonering-alo-phone:hover .phonering-alo-ph-circle {
    border-color:#00aff2;
    opacity:.5
}

.phonering-alo-phone.phonering-alo-green.phonering-alo-hover .phonering-alo-ph-circle,.phonering-alo-phone.phonering-alo-green:hover .phonering-alo-ph-circle {
    border-color:#75eb50 ;
    border-color:#baf5a7;
    opacity:.5
}

.phonering-alo-phone.phonering-alo-green .phonering-alo-ph-circle {
    border-color:#f5e419 ;
    border-color:#faffba;
    opacity:.5
}

.phonering-alo-phone.phonering-alo-gray.phonering-alo-hover .phonering-alo-ph-circle,.phonering-alo-phone.phonering-alo-gray:hover .phonering-alo-ph-circle {
    border-color:#ccc;
    opacity:.5
}

.phonering-alo-phone.phonering-alo-gray .phonering-alo-ph-circle {
    border-color:#75eb50 ;
    opacity:.5
}

.phonering-alo-ph-circle-fill {
    width:100px;
    height:100px;
    top:50px;
    left:50px;
    position:absolute;
    background-color: #000;
    border-radius:100% !important;
    border:2px solid transparent;
    -webkit-animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    transition:all .5s;
    -webkit-transform-origin:50% 50%;
    -ms-transform-origin:50% 50%;
    transform-origin:50% 50%
}

.phonering-alo-phone.phonering-alo-active .phonering-alo-ph-circle-fill {
    -webkit-animation:phonering-alo-circle-fill-anim 1.7s infinite ease-in-out!important;
    animation:phonering-alo-circle-fill-anim 1.7s infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-static .phonering-alo-ph-circle-fill {
    -webkit-animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out!important;
    animation:phonering-alo-circle-fill-anim 2.3s infinite ease-in-out!important;
    opacity:0!important
}

.phonering-alo-phone.phonering-alo-hover .phonering-alo-ph-circle-fill,.phonering-alo-phone:hover .phonering-alo-ph-circle-fill {
    background-color:rgba(0,175,242,0.5);
    background-color:#00aff2 9;
    opacity:.75!important
}

.phonering-alo-phone.phonering-alo-green.phonering-alo-hover .phonering-alo-ph-circle-fill,.phonering-alo-phone.phonering-alo-green:hover .phonering-alo-ph-circle-fill {
    background-color:rgba(117,235,80,0.5);
    background-color:#baf5a7 9;
    opacity:.75!important
}

.phonering-alo-phone.phonering-alo-green .phonering-alo-ph-circle-fill {
    background-color:rgb(220 186 41);
    background-color:#e8faa6 9
}

.phonering-alo-phone.phonering-alo-gray.phonering-alo-hover .phonering-alo-ph-circle-fill,.phonering-alo-phone.phonering-alo-gray:hover .phonering-alo-ph-circle-fill {
    background-color:rgba(204,204,204,0.5);
    background-color:#ccc 9;
    opacity:.75!important
}

.phonering-alo-phone.phonering-alo-gray .phonering-alo-ph-circle-fill {
    background-color:rgba(117,235,80,0.5);
    opacity:.75!important
}

.phonering-alo-ph-img-circle {
    width:60px;
    height:60px;
    top:70px;
    left:70px;
    position:absolute;
    background:rgba(30,30,30,0.1) url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAAB/ElEQVR42uya7W3CMBCG31QM4A1aNggTlG6QbpBMkHYC1AloJ4BOABuEDcgGtBOETnD9c1ERCH/lwxeaV8oPFGP86Hy+DxMREW5Bd7gRjSDSNGn4/RiAOvm8C0ZCRD5PSkQVXSr1nK/xE3mcWimA1ZV3JYBZCIO4giQANoYxMwYS6+xKY4lT5dJPreWZY+uspqSCKPYN27GJVBDXheVSQe494ksiEWTuMXcu1dld9SARxDX1OAJ4lgjy4zDnFsC076A4adEiRwAZg4hOUSpNoCsBPDGM+HqkNGynYBCuILuWj+dgWysGsNe8nwL4GsrW0m2fxZBq9rW0rNcX5MOQ9eZD8JFahcG5g/iKT671alGAYQggpYWvpEPYWrU/HDTOfeRIX0q2SL3QN4tGhZJukVobQyXYWw7WtLDKDIuM+ZSzscyCE9PCy5IttCvnZNaeiGLNHKuz8ZVh/MXTVu/1xQKmIqLEAuJ0fNo3iG5B51oSkeKnsBi/4bG9gYB/lCytU5G9DryFW+3Gm+JLwU7ehbJrwTjq4DJU8bHcVbEV9dXXqqP6uqO5e2/QZRYJpqu2IUAA4B3tXvx8hgKp05QZW6dJqrLTNkB6vrRURLRwPHqtYgkC3cLWQAcDQGGKH13FER/NATzi786+BPDNjm1dMkfjn2pGkBHkf4D8DgBJDuDHx9BN+gAAAABJRU5ErkJggg==) no-repeat center center;
    border-radius:100% !important;
    border:2px solid transparent;
    -webkit-animation:phonering-alo-circle-img-anim 1s infinite ease-in-out;
    animation:phonering-alo-circle-img-anim 1s infinite ease-in-out;
    -webkit-transform-origin:50% 50%;
    -ms-transform-origin:50% 50%;
    transform-origin:50% 50%
}

.phonering-alo-phone.phonering-alo-active .phonering-alo-ph-img-circle {
    -webkit-animation:phonering-alo-circle-img-anim 1s infinite ease-in-out!important;
    animation:phonering-alo-circle-img-anim 1s infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-static .phonering-alo-ph-img-circle {
    -webkit-animation:phonering-alo-circle-img-anim 0 infinite ease-in-out!important;
    animation:phonering-alo-circle-img-anim 0 infinite ease-in-out!important
}

.phonering-alo-phone.phonering-alo-hover .phonering-alo-ph-img-circle,.phonering-alo-phone:hover .phonering-alo-ph-img-circle {
    background-color:#00aff2
}

.phonering-alo-phone.phonering-alo-green.phonering-alo-hover .phonering-alo-ph-img-circle,.phonering-alo-phone.phonering-alo-green:hover .phonering-alo-ph-img-circle {
    background-color:#75eb50;
    background-color:#75eb50 9
}

.phonering-alo-phone.phonering-alo-green .phonering-alo-ph-img-circle {
    background-color:#ffb701;
    background-color:#ffb701 9
}

.phonering-alo-phone.phonering-alo-gray.phonering-alo-hover .phonering-alo-ph-img-circle,.phonering-alo-phone.phonering-alo-gray:hover .phonering-alo-ph-img-circle {
    background-color:#ccc
}

.phonering-alo-phone.phonering-alo-gray .phonering-alo-ph-img-circle {
    background-color:#75eb50
}

@-webkit-keyframes phonering-alo-circle-anim {
    0% {
        -webkit-transform:rotate(0) scale(.5) skew(1deg);
        -webkit-opacity:.1
    }

    30% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
        -webkit-opacity:.5
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
        -webkit-opacity:.1
    }
}

@-webkit-keyframes phonering-alo-circle-fill-anim {
    0% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
        opacity:.2
    }

    100% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }
}

@-webkit-keyframes phonering-alo-circle-img-anim {
    0% {
        -webkit-transform:rotate(0) scale(1) skew(1deg)
    }

    10% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg)
    }

    20% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg)
    }

    30% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg)
    }

    40% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg)
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg)
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg)
    }
}

@-webkit-keyframes fadeInRight {
    0% {
        opacity:0;
        -webkit-transform:translate3d(100%,0,0);
        -ms-transform:translate3d(100%,0,0);
        transform:translate3d(100%,0,0)
    }

    100% {
        opacity:1;
        -webkit-transform:none;
        -ms-transform:none;
        transform:none
    }
}

@keyframes fadeInRight {
    0% {
        opacity:0;
        -webkit-transform:translate3d(100%,0,0);
        -ms-transform:translate3d(100%,0,0);
        transform:translate3d(100%,0,0)
    }

    100% {
        opacity:1;
        -webkit-transform:none;
        -ms-transform:none;
        transform:none
    }
}

@-webkit-keyframes fadeOutRight {
    0% {
        opacity:1
    }

    100% {
        opacity:0;
        -webkit-transform:translate3d(100%,0,0);
        -ms-transform:translate3d(100%,0,0);
        transform:translate3d(100%,0,0)
    }
}

@keyframes fadeOutRight {
    0% {
        opacity:1
    }

    100% {
        opacity:0;
        -webkit-transform:translate3d(100%,0,0);
        -ms-transform:translate3d(100%,0,0);
        transform:translate3d(100%,0,0)
    }
}

@-webkit-keyframes phonering-alo-circle-anim {
    0% {
        -webkit-transform:rotate(0) scale(.5) skew(1deg);
                transform:rotate(0) scale(.5) skew(1deg);
        opacity:.1
    }

    30% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.5
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg);
        opacity:.1
    }
}

@keyframes phonering-alo-circle-anim {
    0% {
        -webkit-transform:rotate(0) scale(.5) skew(1deg);
                transform:rotate(0) scale(.5) skew(1deg);
        opacity:.1
    }

    30% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.5
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg);
        opacity:.1
    }
}

@-webkit-keyframes phonering-alo-circle-fill-anim {
    0% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg);
        opacity:.2
    }

    100% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }
}

@keyframes phonering-alo-circle-fill-anim {
    0% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg);
        opacity:.2
    }

    100% {
        -webkit-transform:rotate(0) scale(.7) skew(1deg);
                transform:rotate(0) scale(.7) skew(1deg);
        opacity:.2
    }
}

@-webkit-keyframes phonering-alo-circle-img-anim {
    0% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }

    10% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg);
                transform:rotate(-25deg) scale(1) skew(1deg)
    }

    20% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg);
                transform:rotate(25deg) scale(1) skew(1deg)
    }

    30% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg);
                transform:rotate(-25deg) scale(1) skew(1deg)
    }

    40% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg);
                transform:rotate(25deg) scale(1) skew(1deg)
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }
}

@keyframes phonering-alo-circle-img-anim {
    0% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }

    10% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg);
                transform:rotate(-25deg) scale(1) skew(1deg)
    }

    20% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg);
                transform:rotate(25deg) scale(1) skew(1deg)
    }

    30% {
        -webkit-transform:rotate(-25deg) scale(1) skew(1deg);
                transform:rotate(-25deg) scale(1) skew(1deg)
    }

    40% {
        -webkit-transform:rotate(25deg) scale(1) skew(1deg);
                transform:rotate(25deg) scale(1) skew(1deg)
    }

    50% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }

    100% {
        -webkit-transform:rotate(0) scale(1) skew(1deg);
                transform:rotate(0) scale(1) skew(1deg)
    }
}
.main-menu.menu-light .navigation li a{
    color: #fff !important;
}
.main-menu.menu-light .navigation > li > ul {
    background-color: #2f3b4c;
}
.main-menu.menu-light .navigation > li.open > a{
    background: rgb(47, 59, 76);
}
.main-menu.menu-light .navigation > li.active > a {
    background: rgb(47, 59, 76);
    border-bottom: 2px solid #ffb701 !important;
    box-shadow: none !important;
    border-radius: 0 !important;
}
.main-menu.menu-light .navigation > li .active {
     background: rgb(47, 59, 76);
    border-bottom:2px solid  #ffb701 !important;
    box-shadow: none !important;
    border-radius: 0 !important;
}
</style>