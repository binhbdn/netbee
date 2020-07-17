<template>
  <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
      <div class="navbar-wrapper">
          <div class="navbar-container content">
              <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                            <ul class="nav navbar-nav">
                                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                            </ul>
                            <ul class="nav navbar-nav bookmark-icons" v-if="$auth.user.role == 2 || $auth.user.role == 4">
                                <li class="nav-item d-none d-md-block">
                                    <a class="btn bg-netbee" href="/admin/tin-tuyen-dung/tao" data-toggle="tooltip" data-placement="top" title="Tạo tin tuyển dụng">
                                        <span style="font-size:1rem">Tạo tin tuyển dụng</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav bookmark-icons" v-if="$auth.user.role == 3 || $auth.user.role == 1">
                                <li class="nav-item d-none d-md-block">
                                    <a class="btn bg-netbee" href="/admin/ho-so/tao-ho-so" data-toggle="tooltip" data-placement="top" title="Tạo tin tuyển dụng">
                                        <span style="font-size:1rem">Tạo hồ sơ</span>
                                    </a>
                                </li>
                            </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li v-if="($auth.user.role == 3 || $auth.user.role == 1) && ($route.name == 'admin' || $route.name == 'admin-quan-ly-viec-lam-viec-lam-da-luu') " class="dropdown nav-item search-icon">
                            <a class="nav-link" href="#" data-toggle="dropdown" @click="showSearch()">
                                <i class="fa fa-search" style="font-size: 18px"></i>
                            </a>
                        </li>
                        <li class="dropdown dropdown-language nav-item">
                            <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img v-if="$i18n.locale == 'vi'"  src="/assets/img/iconfinder_Vietnam_flat_92420.png" width="25px" alt="netbee việt nam"/>
                                <img v-else-if="$i18n.locale == 'en'"  src="/assets/img/iconfinder_United-Kingdom.png" width="25px" alt="netbee united kingdom"/>
                                <img v-else-if="$i18n.locale == 'jp'"  src="/assets/img/iconfinder_Japan_92149.png" width="25px" alt="netbee japan"/>
                                <img v-else  src="/assets/img/iconfinder_Vietnam_flat_92420.png" width="25px" alt="netbee việt nam"/>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                                <a class="dropdown-item" @click="changeLang('vi')">
                                    <img
                                    src="/assets/img/iconfinder_Vietnam_flat_92420.png"
                                    width="25px"
                                    alt="netbee việt nam"
                                    /> Việt Nam
                                </a>
                                <a class="dropdown-item" @click="changeLang('en')">
                                    <img
                                    src="/assets/img/iconfinder_United-Kingdom.png"
                                    width="25px"
                                    alt="netbee united kingdom" 
                                    /> English
                                </a>
                                <a class="dropdown-item" @click="changeLang('jp')">
                                    <img
                                    src="/assets/img/iconfinder_Japan_92149.png"
                                    width="25px"
                                    alt="netbee japan"
                                    /> Japan
                                </a>
                            </div>
                      </li>
                      <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-danger badge-up" v-if="countNoti>0">{{ countNoti }}</span></a>
                          <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header m-0">
                                        <h3 class="h3-size">{{ countNoti }}</h3><span class="notification-title">Thông báo mới</span>
                                    </div>
                                </li>
                                
                                <li class="scrollable-container media-list scrollbar">
                                    <a :style="notification.status_notification ? '' : 'background: #e0e0e0'" class="d-flex justify-content-between border-bot" @click="updateStatus(notification.id_notification)" :href="`${notification.url}`" v-for="(notification,indexNotification) in notifications" :key="indexNotification">
                                      <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <img src="/assets/img/logo.png" width="60">
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 13px;color: #626262;margin-bottom: 0px;" >{{ notification.content }}</p>
                                            <p style="font-size: 13px;color: #626262;margin-bottom: 0px;">{{notification.created_at}}</p>
                                        </div>
                                        
                                      </div>
                                    </a>
                                        <infinite-loading
                                            v-if="notifications.length"
                                            spinner="bubbles"
                                            @infinite="infiniteScroll" style=" width:100%"
                                        >
                                        <div slot="no-more" style="font-size:15px; font-style: italic;display: none;"></div>    
                                        <div slot="no-results" style="font-size:15px; font-style: italic"></div>
                                    </infinite-loading>
                                </li>
                                
                                <li class="dropdown-menu-footer" @click="updateStatusAll()"><a class="dropdown-item p-1 text-center">Xem tất cả</a></li>
                          </ul>
                          
                      </li>
                      <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name text-bold-600" v-if="$auth.user.nb_company">{{ $auth.user.nb_company.username }}</span>
                                <span class="user-name text-bold-600" v-else>{{ $auth.user.name }}</span>
                                <span class="user-status">
                                    {{ $auth.user.role == 4 ? 'Admin' : $auth.user.role == 1 ? 'Ứng viên' : $auth.user.role == 2 ? 'Nhà tuyển dụng' : 'Chuyên viên tuyển sinh'}}
                                </span>
                            </div>
                            <span>
                                <img class="round" v-lazy="this.$auth.user.avatar != null && this.$auth.user.avatar.startsWith('https') ? this.$auth.user.avatar : `/uploads/users/avatars/${this.$auth.user.avatar}`" alt="avatar" height="40" width="40" style="object-fit: cover;">
                            </span>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="/admin/thong-tin-tai-khoan"><i class="feather icon-user"></i> Trang cá nhân</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item" @click="logout()"><i class="feather icon-power"></i> Đăng xuất</a>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </nav>
</template>
<script>
import moment from 'moment'
import i18n from '@/plugins/i18n'
export default {
  name: 'Header',
  data () {
    return {
        notifications: [],
        countNoti: 0,
        page:1
    }
  },
  methods:  {
        changeLang(lang) {
            this.$localStorage.set("lang", lang)
            this.$store.commit('SET_LANG', lang)
            this.$router.push({ path: `${this.$router.currentRoute.path}?lang=${lang}` })
        },
        async logout() {
            this.$auth.logout();
            window.location.href = '/';
        },
        revertTime(time) {
            return moment(time).fromNow(true);
        },
        updateStatus(id) {
            this.$axios.$post('readNotification',{id_notification: id}).then((response) => {
            })
        },
        updateStatusAll() {
            this.$axios.$post('readNotificationAll').then((response) => {
                this.countNoti = 0;
                window.location.href = '/admin/thong-bao'
            })
        },
        infiniteScroll: function($state) {
            setTimeout(() => {
                this.page++
                this.$axios
                .get('/getNotification?page='+ this.page)
                .then((response) => {
                    if (response.data.data.notifications.data.length > 1) {
                        response.data.data.notifications.data.forEach((item) => this.notifications.push(item))
                        $state.loaded()
                    } else {
                        $state.complete()
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
            }, 500)
        },
        showSearch(){
            this.$bus.$emit('showSearch');
        }
    },
    mounted() {
        this.$axios.$get('getNotification?page='+this.page).then((response) => {
            this.notifications = response.data.notifications.data,
            this.countNoti = response.data.countNotRead
        })
        
    },
}
</script>
<style scoped>
.h3-size {
    font-size: 23px;
}
.notification-text {
    font-size: 1rem !important;
}
.border-bot {
    border: 1px solid rgba(128, 128, 128, 0.192);
}
.scrollable-container::-webkit-scrollbar {
  display: none;
}
.dropdown-notification .dropdown-menu-header {
    background-color: #FFB701 !important;
}
.dropdown-notification .dropdown-menu.dropdown-menu-right::before {
    background: #FFB701 !important;
    border-color: #FFB701 !important;
}
.header-navbar .navbar-container ul.nav li i.ficon:hover {
    color: #FFB701 !important;
}
.dropdown-notification .notification-title {
    color: #000 !important;
}
.search-icon{
    display: none;
}
@media (max-width: 991px) and (min-width: 768px) {
    .bookmark-wrapper{
        margin-top: 11px;
    }
}
@media (max-width: 767px){
    .search-icon{
        display: block;
    }
}
</style>