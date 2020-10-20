<template>
  <nav
    class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" 
    id="ftco-navbar" style="box-shadow: 0 1px 4px #887e7e !important;"
  >
    <div class="container">
      <a class="navbar-brandd" href="/">
        <div>
          <img
            v-lazy="`/assets/img/logo-full-2.jpg`"
            alt="logo netbee"
            height="50"
            width="130"
          />
        </div>
      </a>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item " style="padding-top:3px" :class="{active : this.$route.path == '/'}">
            <a href="/" class="nav-link header-nav-link"  data-placement="top" :title="$t('nav.home')">
              <div class="nav-icon">
                <i class="fad fa-home"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.home') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/tin-tuyen-sinh'}">
            <a href="/tin-tuyen-sinh" class="nav-link header-nav-link"  data-placement="top" :title="$t('nav.admission')">
              <div class="nav-icon">
                <i class="fad fa-server"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.admission') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/cong-ty'}">
            <a href="/cong-ty" class="nav-link header-nav-link" style="text-align: center"  data-placement="top" :title="$t('nav.company')">
              <div class="nav-icon">
                <i class="fad fa-building"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.company') }}
              </div>
            </a>
          </li>
          <!-- <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/ung-vien'}">
            <a href="/ung-vien" class="nav-link header-nav-link" style="text-align: center">
              <div class="nav-icon">
                <i class="fas fa-id-badge"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.candidates') }}
              </div>
            </a>
          </li> -->
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/tin-tuc'}">
            <a href="/tin-tuc" class="nav-link header-nav-link"  data-placement="top" :title="$t('nav.news')">
              <div class="nav-icon">
                <i class="fad fa-table"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.news') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/ve-netbee'} " >
            <a href="/ve-netbee" class="nav-link header-nav-link"  data-placement="top" :title="$t('nav.about')">
              <div class="nav-icon">
                <i class="fad fa-id-card"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.about') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/lien-he'} " >
            <a href="/lien-he" class="nav-link header-nav-link"  data-placement="top" :title="$t('nav.contact')">
              <div class="nav-icon">
                <i class="fad fa-phone-office"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.contact') }}
              </div>
            </a>
          </li>
          <!-- <li class="nav-item cta cta-colored mr-md-2">
            <a href="#" class="nav-link header-nav-link">
              <i class="fa fa-user-plus"></i>
              <br />Giới thiệu học sinh
            </a>
          </li> -->
          <li class="nav-item cta dropdown">
            <a href="#" class="nav-link header-nav-link" style="padding-bottom: 0px; height: 100%; border:unset!important;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-placement="top" :title="$t('nav.languages')">
              <div class="nav-icon">
                <img v-if="$i18n.locale == 'vi'" src="/assets/img/iconfinder_Vietnam_flat_92420.png" width="22px" alt="netbee việt nam"/>
                <img v-else-if="$i18n.locale == 'en'" src="/assets/img/iconfinder_United-Kingdom.png" width="22px" alt="netbee united kingdom"/>
                <img v-else-if="$i18n.locale == 'jp'" src="/assets/img/iconfinder_Japan_92149.png" width="22px" alt="netbee japan"/>
                <img v-else src="/assets/img/iconfinder_Vietnam_flat_92420.png" width="22px" alt="netbee việt nam"/>
              </div>
              <div class="nav-title">
                {{ $t('nav.languages') }}
                <i class="fas fa-caret-down"></i>
              </div>
            </a>
            <div
              class="dropdown-menu sticky text-center"
              aria-labelledby="navbarDropdown"
            >
              <div id="login-up"></div>
              <a class="dropdown-item" @click="changeLang('vi')"  title="Việt Nam" data-placement="top">
                <img
                  src="/assets/img/iconfinder_Vietnam_flat_92420.png"
                  width="25px"
                  alt="netbee việt nam"
                />
              </a>
              <a class="dropdown-item" @click="changeLang('en')"  title="English" data-placement="top">
                <img
                  src="/assets/img/iconfinder_United-Kingdom.png"
                  width="25px"
                  alt="netbee united kingdom"
                />
              </a>
              <a class="dropdown-item" @click="changeLang('jp')"  title="Japan" data-placement="top">
                <img
                  src="/assets/img/iconfinder_Japan_92149.png"
                  width="25px"
                  alt="netbee japan"
                />
              </a>
              
            </div>
          </li>
          <li class="nav-item cta mr-md-2 dropdown" v-if="!$auth.loggedIn">
            <a href="#" class="nav-link header-nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" :title="$t('nav.become_partner.title')">
              <div class="nav-icon">
                <i class="fa fa-user-circle"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.become_partner.title') }}
                <i class="fas fa-caret-down"></i>
              </div>
            </a>
            <div class="dropdown-menu" style="top: 102%!important;top: 102%!important;border-radius: 9px;box-shadow: none;width: max-content;" aria-labelledby="navbarDropdown">
              <div id="login-up"></div>
              <a class="dropdown-item" href="/dang-ky/ung-vien">{{ $t('nav.become_partner.user') }}</a>
              <a class="dropdown-item" href="/dang-ky/nha-tuyen-dung">{{ $t('nav.become_partner.company') }}</a>
              <a class="dropdown-item" href="/dang-ky/chuyen-vien-tuyen-dung">{{ $t('nav.become_partner.hr') }}</a>
              <a class="dropdown-item" href="/dang-nhap">{{ $t('login') }}</a>
            </div>
          </li>
          <li class="nav-item cta mr-md-2 dropdown" v-else>
            <a href="#" class="nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" :title="$t('account')">
              <div class="nav-icon">
                <img :alt="this.$auth.user.avatar" v-lazy="this.$auth.user.avatar != null && this.$auth.user.avatar.startsWith('https') ? this.$auth.user.avatar : `/uploads/users/avatars/${this.$auth.user.avatar}`">
              </div>
              <div class="nav-title">
                {{ $t('account') }} <i class="fas fa-caret-down" style="padding-left:2px"></i>
              </div>
            </a>
            <div class="dropdown-menu" style="top: 102%!important; width: max-content;" aria-labelledby="navbarDropdown">
              <div id="login-up"></div>
              <a class="dropdown-item overflow" href="/admin" v-if="this.$auth.user.nb_company">{{ this.$auth.user.nb_company.username }}</a>
              <a class="dropdown-item overflow" href="/admin" v-else>{{ this.$auth.user.name }}</a>
              <a class="dropdown-item" @click="logout()">{{ $t('logout') }}</a>
            </div>
          </li>
          
          <li class="dropdown dropdown-notification nav-item" v-if="$auth.loggedIn"  :title="$t('account')">
            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" style="width: 25px; margin:auto; margin-top: 20px;" data-placement="top" :title="$t('notification')">
              <i class="fa fa-bell" style="color:#000 !important;font-size: 17px;padding:0px;margin-right:0px;"></i>
              <span class="badge badge-pill badge-danger badge-up" style="background-color: #EA5455;right: -0.3rem;top: -0.7rem;" v-if="countNoti>0">{{ countNoti }}</span>
            </a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" >
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header m-0">
                            <h3 class="h3-size">{{ countNoti }}</h3><span class="notification-title">Thông báo mới</span>
                        </div>
                    </li>
                    <li class="scrollable-container media-list scrollbar" style="height: 400px;">
                      <a :style="notification.status_notification ? '' : 'background: #e0e0e0'" class="d-flex justify-content-between border-bot" @click="updateStatus(notification.id_notification)" :href="`${notification.url}`" v-for="(notification,indexNotification) in notifications" :key="indexNotification">
                        <div class="media d-flex align-items-start">
                          <div class="media-left">
                              <img src="/assets/img/logo.png" width="60">
                          </div>
                          <div class="media-body">
                              <p style="font-size: 13px;color: #626262;margin-bottom: 0px;" >{{ notification.content }}</p>
                              <p style="font-size: 13px;color: #626262;margin-bottom: 0px;">{{formatDate(notification.created_at)}}</p>
                          </div>
                        </div>
                      </a>
                  </li>
                  <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" :class="[{'active' : $route.name == 'notification'}, 'nav-item']" @click="$router.push('/admin/thong-bao')">Xem tất cả</a></li>
              </ul>
          </li>
         
        </ul>
      </div>
    </div>
    <div class="icon-menu">
      <input id="menu-toggle" type="checkbox" @click="changeMenu()"/>
      <div class='menu-button-container' for="menu-toggle">
          <div class='menu-button'></div>
      </div>
    </div>
  </nav>
</template>
<script>
import Vue from 'vue';
import i18n from '@/plugins/i18n';
import VueLocalStorage from 'vue-localstorage'
import moment from 'moment'

Vue.use(VueLocalStorage)

export default {
  data () {
    return {
        notifications: [],
        countNoti: 0,
        page:1
    }
  },
  methods: {
    formatDate: function(date){
                return moment(String(date)).format('MM-DD-YYYY hh:mm:ss');
             },
    changeMenu() {
      if(document.getElementById("menu-toggle").checked) {
        document.getElementById("ftco-nav").style.display = " block"
      } else {
        document.getElementById("ftco-nav").style.display = " none"
      }
    },
    revertTime: function(time) {
        return moment(time).fromNow(true);
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
    async logout() {
      this.$auth.logout()
    },
    changeLang (lang) {
      this.$localStorage.set("lang", lang)
      this.$store.commit('SET_LANG', lang)
      this.$router.push({ path: `${this.$router.currentRoute.path}?lang=${lang}`})
      console.log(this.$i18n.locale)
    }
  },
  mounted() {
    console.log(this.$i18n.locale)
      this.$axios.$get('getNotification?page='+this.page).then((response) => {
          this.notifications = response.data.notifications.data,
          this.countNoti = response.data.countNotRead
      })
      
  }
}
</script>
<style>
  .ps--active-x>.ps__rail-x, .ps--active-y>.ps__rail-y {
    display: none !important;
  }
</style>
<style scoped>
.ftco-navbar-light .navbar-nav>.nav-item>.nav-link-label:hover {
  border-bottom: 4px solid #fff !important;
}
.dropdown-menu-footer {
  background-color: #ABB2B9;
  color: #000 !important;
}
.dropdown-menu-footer a {
  color: #000 !important;
}
.overflow{
    max-width: 200px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}

.icon-menu {
  opacity: 0;
}
#menu-toggle {
  width: 100%;
  height: 100%;
  opacity: 0;
}
.menu-button::before {
  content: '';
  margin-top: -8px;
}
.menu-button::after {
  content: '';
  margin-top: 8px;
}
.menu-button, .menu-button::before, .menu-button::after {
  display: block;
  background-color: #674C28;
  position: absolute;
  height: 4px;
  width: 30px;
  transition: transform 400ms cubic-bezier(0.23, 1, 0.32, 1);
  border-radius: 2px;
}

.border-bot {
    border: 1px solid rgba(128, 128, 128, 0.192);
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
.dropdown-menu-right{
  width: 400px;
}
@media (max-width: 991px){
  .icon-menu {
    position: absolute;
    right: 10px;
    top: 5px;
    width: 55px;
    height: 55px;
    border: 1px solid #674C28;
    opacity: 1;
  }
  .menu-button-container {
    position: absolute;
    top: 25px;
    right: 40px;
  }
  #ftco-nav > ul {
    display: grid;
    grid-template-columns: 33% 33% 33%;
  }
  #ftco-nav > ul > li:nth-child(10) {
    display: none;
  }
  #menu-toggle:checked+.menu-button-container .menu-button::before {
    margin-top: 0px;
    transform: rotate(405deg);
  }
  #menu-toggle:checked+.menu-button-container .menu-button::after {
    margin-top: 0px;
    transform: rotate(-405deg);
  }
  #menu-toggle:checked+.menu-button-container .menu-button {
    background: rgba(255, 255, 255, 0);
  }
  .dropdown-menu-right {
    position: absolute;
    left: -85px;
    width: 280px;
  }
  .dropdown .dropdown-menu::before {
    left: 14.2rem;
  }
}
@media (max-width: 767px){
  .dropdown-menu-right{
    left: -115px;
  }
}
@media (max-width: 575px){
  .dropdown-menu-right{
    width: 220px;
  }
  .dropdown .dropdown-menu::before {
    left: 12.2rem;
  }
  .dropdown .dropdown-menu .dropdown-item{
    padding: 0.714rem 1.428rem;
    overflow: auto;
    white-space: pre-wrap;
    width: 170px;
  }
}
.ftco-navbar-light {
  z-index: 10 !important;
}

</style>