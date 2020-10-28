<template>
  <div  class="hero-wrap js-fullheight m-b-15"  v-lazy:background-image="'/assets/img/banner-danh-01aa.jpg'"  style="position: relative;background-position: center; " >
    <div class="section-intro">
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
                    <ul class="nav nav-tabs nav-fill" role="tablist" style="float:left;">
                      <li class="nav-item">
                        <a class="nav-link active" href="/tin-tuc"  id="v-pills-33-tab" style="font-weight: 400 !important;">{{ $t('banner.news.tab') }}</a>
                      </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content pt-1 tab-ct2 pl-2 pr-2" style="clear:both;padding-left: 15px !important;padding-right: 15px !important;">
                      <div class="tab-pane active">
                        <form action="#" class="search-job" onsubmit="return false;">
                          <div class="row">
                            <div class="col-md-3 col-lg-4 pr-md-0">
                              <div class="form-group">
                                <div class="h-100">
                                  <div class="icon"><i class="fas fa-briefcase"></i></div>
                                  <input class="form-control input_placehoder h-100" type="text" :placeholder="$t('banner.news.key')" v-model="newsSearch.Keyword" @change="searchNews">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 pr-md-0">
                              <div class="form-group">
                                <div class="h-100">
                                  <div class="icon"><i class="fas fa-briefcase"></i></div>
                                  <input class="form-control input_placehoder h-100" type="text" :placeholder="$t('banner.news.title')" v-model="newsSearch.Title" @change="searchNews">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 pr-md-0">
                              <div class="form-group">
                                <div class="h-100">
                                  <Multiselect :options="categories" :custom-label="nameWithLang" :placeholder="$t('banner.news.category')" :show-labels="false" :searchable="false" :close-on-select="true" :allow-empty="false" v-model="newsSearch.Category" @change="searchNews">
                                  </Multiselect>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                              <div class="form-group">
                                <div class="h-100">
                                  <input class="btn bg-netbee w-100 h-100" type="button" :value="$t('banner.search')"  @click="searchNews">
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
      newsSearch: {
        Keyword: '',
        Title: '',
        Category: ''
      },
      categories: [
        {id: 1, name: 'Cẩm nang'},
        {id: 2, name: 'Xuất khẩu lao động'},
        {id: 3, name: 'Du học'}
      ]
    }
  },
  components:{
    Multiselect,
  },
  methods: {
    nameWithLang ({ id, name }) {
      return `${name}`
    },
    searchNews(){
      window.location.href = '/tin-tuc/tim-kiem?searchCategory='
      + ((this.newsSearch.Category.id) ? this.newsSearch.Category.id : '')
      + '&searchStatus=1'
      + '&search='+ ((this.newsSearch.Keyword) ? this.ChangeToSlug(this.newsSearch.Keyword).replace(/\-/gi, '%20') : '')
      + '&searchTitle='+ ((this.newsSearch.Title) ? this.ChangeToSlug(this.newsSearch.Title).replace(/\-/gi, '%20') : '')
    }
  }
}
</script>
<style>
  .particles-js-canvas-el{
  height: 300px !important;
}
</style>
<style scoped>/* binhbdn: Copy từ Banner.vue. Ngày 27/10/20 đã lọc và xóa các class không dùng đến */
  .parti{
        max-height: 0px;
        position: relative;
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
  .search-job .form-group {
    height: 74%;
    margin-bottom: 15px;
  }
  .search-job .form-group .icon {
    position: absolute;
    top: 19px;
    left:25px;
    width: 20px;
    font-size: 16px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    color: #d9d9d9;
  }
  .search-job .form-group .form-control {
    padding-left: 35px;
    width: 100%;
    border: 1px solid #d9d9d9;
    color: rgba(0, 0, 0, 0.7);
    background: #fff;
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
  .no-gutters {
    /* margin-right: 0; */
    /* margin-left: 0; */
    height: 300px !important;
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
  @media(max-width: 767px) {
    .nav-item{
      padding: 1px;
    }
    .nav-item a{
      width: 100%;
    }
    .no-gutters{
      height: auto !important;
    }
    .pb-5{
      padding-bottom: 0px !important;
    }
    .nav-fill{
      width: 100%;
    }
  }
  .input_placehoder::placeholder{
    font-size: 14px;
    color: #adadad !important;
  }
</style>