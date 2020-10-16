<template>
  <div  class="hero-wrap js-fullheight m-b-15"  v-lazy:background-image="'/assets/img/banner-danh-01aa.jpg'"  style="position: relative;background-position: center; " >
    <div class="section-intro" :class="show ? 'section-intro-active' : ''">
      <vue-particles color="#dedede"
        :particleOpacity="0.9"
        :particlesNumber="130" class="parti">
      </vue-particles>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-xl-12 ftco-animate mb-5 pb-5 container" data-scrollax=" properties: { translateY: '70%' }">
            <p class="mb-4 mt-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"></p>
            <div class="ftco-search container pl-0 pr-0">
              <div class="row">
                <div class="card-content col-md-12 pl-0 pr-0" style="padding-top: 70px!important">
                  <div class="card-body search ">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" style="float:left;">
                      <li class="nav-item">
                        <a class="nav-link active" href="/tin-tuc"  id="v-pills-33-tab" style="font-weight: 400 !important;">{{ $t('banner.news.tab') }}</a>
                      </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content pt-1 tab-ct2 pl-2 pr-2" style="clear:both;padding-left: 15px !important;padding-right: 15px !important;">
                      <div v-bind:class="{'active': $route.name != 'cong-ty' && $route.name != 'tim-cong-ty' && $route.name != 'ung-vien' && $route.name != 'tim-ung-vien' && $route.name != 'tim-viec-lam'}" class="tab-pane">
                        <form action="#" class="search-job" onsubmit="return false;">
                          <div class="row">
                            <div class="col-md-10">
                              <div class="form-group" style="height: 74%;margin-bottom: 15px;">
                                <div class="form-field" style="height: 100%;">
                                  <div class="icon" style="left:23px !important; top: 19px!important;"><i class="fas fa-briefcase"></i></div>
                                  <input style="height: 100%;" type="text" class="form-control input_placehoder" :placeholder="$t('banner.news.key')" name="keyword" v-model="keyNews" @change="searchNews">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-2" style="padding-left: 2px;" id="pd15">
                              <div class="form-group" style="margin-bottom: 15px;">
                                <div class="form-field">
                                  <input type="button" :value="$t('banner.search')" class="col-md-12 btn bg-netbee" @click="searchNews">
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
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
import Vue from 'vue'
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import VueParticles from 'vue-particles'
Vue.use(VueParticles)
export default {
   name: 'Header',
    data () {
      return {
        keyNews: '',
        show: false
      }
    },
    components:{
      Multiselect,
    },
    methods: {
      searchNews(){
        window.location.href = '/tin-tuc/tim-kiem?keyword='
        +(this.keyNews != '' ? this.ChangeToSlug(this.keyNews).replace(/\-/gi, '%20') : "")
        +'&nation='
      },
    }
}
</script>
<style>
  .particles-js-canvas-el{
    height: 300px !important;
  }
</style>
<style scoped>/* binhbdn: Copy từ Banner.vue Chưa lọc những class không được dùng */
  .search-footer {
    margin-top: -10px;
  }
  .text-advance-search {
    cursor: pointer;
    color: white;
  }
  .title-p-main{
    font-size: 15.5px;
    color: white !important;
    margin-bottom: 5px;
    padding-bottom: 6px;
    font-weight: bold;
  }
  .parti{
        max-height: 0px;
        position: relative;
  }
  .ftco-search .nav-pills .nav-link.active, .ftco-search .nav-pills .nav-link:hover {
    color: #ffb701!important;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
  }
  .ftco-search .nav-pills .nav-link {
    padding: 10px 30px !important;
    margin-bottom: 0;
    color: #000!important;
    border-radius: 0;
    font-size: 16px;
    font-weight: 400;
    font-weight: 700;
    position: relative;
    display: inline-block;
    border: 1px solid transparent;
    background: #ffb701;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
  #v-pills-tabContent {
    background: rgba(255, 255, 255, 0.1);
    margin-top: 0px;
    margin-bottom: 20px;
  }
  .tab-content>.active {
    display: block;
  }
  .ftco-search .tab-content {
    background: #fff;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    border-top-left-radius: 0px;
    margin-top: -9px;
    color: #fff;
  }
  .p-4 {
    padding: 1.5rem !important;
  }
  .nav.nav-pills {
    margin-bottom: 0;
  }
  .ftco-search .nav-pills .nav-link {
    padding: 10px 15px!important;
  }
  .mr-md-1, .mx-md-1 {
    margin-right: 0.25rem !important;
  }
  .search-job .form-group .form-control.btn.btn-primary {
    background: #ffb701 !important;
  }
  .search-job .form-group .form-control.btn {
    padding: 0 !important;
    font-size: 16px;
    color: #000 !important;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    border-radius: 5px;
  }
  .btn.btn-primary {
    background: #ffb701 !important;
    border: 1px solid #ffb701 !important;
    color: #fff !important;
  }
  .search-job .form-group .select-wrap {
    position: relative;
  }
  .search-job .form-group .icon {
    position: absolute;
    top: 51%;
    right: 10px;
    width: 20px;
    font-size: 16px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    color: #d9d9d9;
  }
  .search-job .form-group .form-control {
    padding-right: 30px;
    padding-left: 35px;
    display: block;
    width: 100%;
    font-size: 13px;
    border: 1px solid #d9d9d9;
    color: rgba(0, 0, 0, 0.7) !important;
    background: transparent !important;
  }
  .ftco-search .search-job .form-group .form-control {
    background: #fff !important;
  }
  .advanced_search_box {
    margin-top: 7px;
    text-align: right;
    color: white!important;
    margin-bottom: 10px;
  }
  .advanced_search_box a{
    color: white!important;
  }
  .search ul{
    margin-bottom: 0;
  }
  .search ul li a{
     padding: 10px 30px !important;
     margin-bottom: 0;
     color: #000!important;
     font-size: 16px!important;
     font-weight: 400;
     font-weight: 600!important;
     position: relative;
     height: 98%;
     display: inline-block;
     border: 1px solid transparent;
     background: #fff;
     border-top-left-radius: 5px!important;
     border-top-right-radius: 5px!important;
     margin-right: 5px;
   }
  .search ul li a.active{
    color: #ffb701!important;
  }
  .search ul li a:hover{
    color: #ffb701!important;
  }
  .advanced_search_box a{
    color: white!important;
  }
  .ftco-search .tab-ct2 {
    background: hsla(0, 0%, 3%, 0.28)!important;
    border-radius: 3px;
    border-top-left-radius: 0;
    margin-top: -9px;
    color: #fff!important;
  }
  .nav.nav-tabs .nav-item .nav-link.active:after {
    content: unset!important;
  }
  .nav.nav-tabs .nav-item .nav-link.active{
    background: hsla(0, 0%, 3%, 0.28)!important;
  }
  .nav.nav-tabs .nav-item .nav-link:hover {
    background: hsla(0, 0%, 3%, 0.28)!important;
  }
  .search ul li a i {
    padding-right: 3px;
  }
  .no-gutters {
    margin-right: 0;
    margin-left: 0;
    height: 300px !important;
  }
  .hero-wrap, .img, .blog-img, .user-img {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
  }
  .section-intro:before {
    content: "";
    left: 0;
    width: 100%;
    height: 100%;
    display: inline-block;
    background-color: rgba(42, 46, 50, 0.8);
    position: absolute;
    opacity: 0.6;
  }
  .ftco-search .nav-pills .nav-link.active, .ftco-search .nav-pills .nav-link:hover {
    color: #ffb701;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
  }
  .section-intro-active{
    height: 450px;
    transition: opacity .75s;
  }
  .slide-fade-enter-active {
    transition: all .3s ease;
  }
  .slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  }
  .slide-fade-enter, .slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
  }
  .multiselect__option--highlight {
    background: #ffb701;
    color: #000;
  }
  .multiselect,
  .multiselect__input,
  .multiselect__single {
    font-size: 12px !important;
  }
  .multiselect__select:before {
    top: 54%;
  }
  .aa {
    padding-left: 2px;
    padding-right: 2px;
  }
  .bb {
    padding-left: 2px;
    padding-right: 2px;
  }
  .cc {
    padding-right: 2px;
  }
  @media(max-width: 320px) {
    .aa {
      padding-left: 13px;
      padding-right: 13px;
    }
    .bb {
      padding-left: 13px;
      padding-right: 13px;
    }
    .cc {
      padding-right: 13px;
    }
  }
  @media(max-width: 767px) {
    .aa {
      padding-left: 13px;
      padding-right: 13px;
    }
    .bb {
      padding-left: 13px;
      padding-right: 13px;
    }
    .cc{
      padding-right: 13px;
    }
    .nav-item{
      padding: 1px;
    }
    .nav-item a{
      width: 100%;
    }
    .no-gutters{
      height: auto !important;
    }
    #pd15{
      padding-left: 13px !important;
    }
    .pb-5{
      padding-bottom: 0px !important;
    }
    .nav-fill{
      width: 100%;
    }
    .title-p-main{
      font-size: 14px
    }
  }
  .input_placehoder::placeholder{
    font-size: 14px;
    color: #adadad !important;
  }
  .search-job .form-group .form-control.btn.btn-primary:hover {
    color: #fff !important;
  }
</style>
