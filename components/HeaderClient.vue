<template>
  <nav
    class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" 
    id="ftco-navbar" style="box-shadow: 0 1px 4px #887e7e !important;"
  >
    <div class="container">
      <a class="navbar-brandd" href="/">
        <div>
          <img
            v-lazy="`/assets/img/logo-full-2.png`"
            alt="logo netbee"
            height="50"
            width="130"
          />
        </div>
      </a>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item " style="padding-top:3px" :class="{active : this.$route.path == '/'}">
            <a href="/" class="nav-link header-nav-link">
              <div class="nav-icon">
                <i class="fa fa-home"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.home') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/tin-tuyen-sinh'}">
            <a href="/tin-tuyen-sinh" class="nav-link header-nav-link">
              <div class="nav-icon">
                <i class="fa fa-server"></i>
              </div>
              <div class="nav-title">
                Tin tuyển sinh
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/cong-ty'}">
            <a href="/cong-ty" class="nav-link header-nav-link" style="text-align: center">
              <div class="nav-icon">
                <i class="fa fa-building"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.company') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/ung-vien'}">
            <a href="/ung-vien" class="nav-link header-nav-link" style="text-align: center">
              <div class="nav-icon">
                <i class="fas fa-id-badge"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.candidates') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/tin-tuc'}">
            <a href="/tin-tuc" class="nav-link header-nav-link" >
              <div class="nav-icon">
                <i class="fa fa-table"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.news') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/ve-netbee'} " >
            <a href="/ve-netbee" class="nav-link header-nav-link">
              <div class="nav-icon">
                <i class="fa fa-id-card"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.about') }}
              </div>
            </a>
          </li>
          <li class="nav-item" style="padding-top:3px" :class="{active : this.$route.path == '/lien-he'} " >
            <a href="/lien-he" class="nav-link header-nav-link">
              <div class="nav-icon">
                <i class="fa fa-window-restore"></i>
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
            <a href="#" class="nav-link header-nav-link" style="padding-bottom: 0px; height: 100%; border:unset!important;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              <div class="nav-icon">
                <img src="/assets/img/iconfinder_Vietnam_flat_92420.png" width="22px" alt="netbee việt nam"/>
              </div>
              <div class="nav-title">
                {{ $t('nav.languages') }}
                <i class="fas fa-caret-down"></i>
              </div>
            </a>
            <div
              class="dropdown-menu sticky text-center"
              style="top: 102%!important;"
              aria-labelledby="navbarDropdown"
            >
              <div id="login-up"></div>
              <a class="dropdown-item" @click="changeLang('en')">
                <img
                  src="/assets/img/iconfinder_United-Kingdom.png"
                  width="25px"
                  alt="netbee united kingdom"
                />
              </a>
              <a class="dropdown-item" @click="changeLang('jp')">
                <img
                  src="/assets/img/iconfinder_Japan_92149.png"
                  width="25px"
                  alt="netbee japan"
                />
              </a>
              <a class="dropdown-item">
                <img
                  src="/assets/img/iconfinder_South-Korea_92351.png"
                  width="25px"
                  alt="netbee korea"
                />
              </a>
            </div>
          </li>
          <li class="nav-item cta mr-md-2 dropdown" v-if="!$auth.loggedIn">
            <a href="#" class="nav-link header-nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"  >
              <div class="nav-icon">
                <i class="fa fa-user-circle"></i>
              </div>
              <div class="nav-title">
                {{ $t('nav.become_partner.title') }}
                <i class="fas fa-caret-down"></i>
              </div>
            </a>
            <div class="dropdown-menu" style="top: 102%!important;top: 102%!important;border-radius: 9px;box-shadow: none;" aria-labelledby="navbarDropdown">
              <div id="login-up"></div>
              <a class="dropdown-item" href="/dang-ky/ung-vien">{{ $t('nav.become_partner.user') }}</a>
              <a class="dropdown-item" href="/dang-ky/nha-tuyen-dung">{{ $t('nav.become_partner.company') }}</a>
              <a class="dropdown-item" href="/dang-ky/chuyen-vien-tuyen-dung">{{ $t('nav.become_partner.hr') }}</a>
              <a class="dropdown-item" href="/dang-nhap">{{ $t('login') }}</a>
            </div>
          </li>
          <li class="nav-item cta mr-md-2 dropdown" v-else>
            <a href="#" class="nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="nav-icon">
                <img :alt="this.$auth.user.avatar" v-lazy="this.$auth.user.avatar != null && this.$auth.user.avatar.startsWith('https') ? this.$auth.user.avatar : `/uploads/users/avatars/${this.$auth.user.avatar}`">
              </div>
              <div class="nav-title">
                {{ $t('account') }} <i class="fas fa-caret-down" style="padding-left:2px"></i>
              </div>
            </a>
            <div class="dropdown-menu" style="top: 102%!important;" aria-labelledby="navbarDropdown">
              <div id="login-up"></div>
              <a class="dropdown-item overflow" href="/admin" v-if="this.$auth.user.nb_company">{{ this.$auth.user.nb_company.username }}</a>
              <a class="dropdown-item overflow" href="/admin" v-else>{{ this.$auth.user.name }}</a>
              <a class="dropdown-item" @click="logout()">{{ $t('logout') }}</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
import Vue from 'vue';
import i18n from '@/plugins/i18n';
import VueLocalStorage from 'vue-localstorage'

Vue.use(VueLocalStorage)

export default {
      methods: {
        async logout() {
          this.$auth.logout()
        },
        changeLang (lang) {
          this.$localStorage.set("lang", lang)
          this.$store.commit('SET_LANG', lang)
          this.$router.push({ path: `${this.$router.currentRoute.path}?lang=${lang}` })
        }
      }
}
</script>
<style scoped>
.overflow{
    max-width: 200px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
</style>