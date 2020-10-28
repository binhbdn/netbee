<template>

    <div  class="hero-wrap js-fullheight m-b-15"  v-lazy:background-image="'/assets/img/banner-danh-01aa.jpg'"  style="position: relative;background-position: center; " >

    <div class="section-intro" :class="show ? 'section-intro-active' : ''">
      <vue-particles color="#dedede"
        :particleOpacity="0.9"
        :particlesNumber="130" class="parti"></vue-particles>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-xl-12 ftco-animate mb-5 pb-5 container" data-scrollax=" properties: { translateY: '70%' }">
            <p class="mb-4 mt-5 " data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"></p>
            <div class="ftco-search container pl-0 pr-0">
              <div class="row">
                <div class="card-content col-md-12 pl-0 pr-0" style="padding-top: 70px!important">

                  <div class="card-body search ">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" style="float:left;">
                      <li class="nav-item">
                        <a class="nav-link" href="/" :class="{'active': $route.name != 'cong-ty' && $route.name != 'tim-cong-ty' && $route.name != 'ung-vien' && $route.name != 'tin-tuyen-sinh' && $route.name != 'tim-viec-lam'}" id="v-pills-33-tab" style="font-weight: 400 !important;">{{ $t('banner.jobs.tab') }}</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" :class="{'active': $route.name == 'tin-tuyen-sinh'}" id="profile-tab-fill" data-toggle="tab" href="#profile-fill"
                           role="tab" aria-controls="profile-fill" aria-selected="false" style="font-weight: 400 !important;">Săn học bổng</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/cong-ty" :class="{'active': $route.name == 'cong-ty' || $route.name == 'tim-cong-ty'}" id="v-pills-11-tab" style="font-weight: 400 !important;">{{$t('banner.company.tab')}}</a>
                      </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content pt-1 tab-ct2 pl-2 pr-2" style="clear:both;padding-left: 15px !important;padding-right: 15px !important;">
                      <div v-bind:class="{'active': $route.name != 'cong-ty' && $route.name != 'tim-cong-ty' && $route.name != 'ung-vien' && $route.name != 'tim-ung-vien' && $route.name != 'tim-viec-lam'}" class="tab-pane">
                        <form action="#" class="search-job" onsubmit="return false;">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group" style="height: 74%;margin-bottom: 15px;">
                                <div class="form-field" style="height: 100%;">
                                  <div class="icon" style="left:23px !important; top: 19px!important;"><i class="fas fa-briefcase"></i></div>
                                  <input style="height: 100%;" type="text" class="form-control input_placehoder" :placeholder="$t('banner.jobs.key')" name="keyword" v-model="keyJobs" @change="searchJobs">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3" style="padding-left: 2px;" id="pd15">
                              <div class="form-group" style="margin-bottom: 15px;">
                                <Multiselect :options="jobs" v-model="type_job" :custom-label="nameWithLang" :placeholder="$t('banner.jobs.career')" :show-labels="false" :searchable="false">
                                </Multiselect>
                              </div>
                            </div>
                            <div class="col-md-3" style="padding-left: 2px;" id="pd15">
                              <div class="form-group" style="margin-bottom: 15px;">
                                <Multiselect :options="nation" v-model="chooseNation" :custom-label="nameWithLang" :placeholder="$t('banner.nation')" :show-labels="false" :searchable="false">
                                </Multiselect>
                              </div>
                            </div>
                            <div class="col-md-2" style="padding-left: 2px;" id="pd15">
                              <div class="form-group" style="margin-bottom: 15px;">
                                <div class="form-field">
                                  <input type="button" :value="$t('banner.search')" class="col-md-12 btn bg-netbee" @click="searchJobs">
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div v-bind:class="{active : this.$route.path == '/cong-ty' || this.$route.path == '/tim-cong-ty'}" class="tab-pane">
                        <form action="" class="search-job" onsubmit="return false;">
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group" style="height: 74%;margin-bottom: 15px;">
                                <div class="form-field" style="height: 100%;">
                                  <div class="icon" style="left:23px !important;top: 19px!important;"><i class="fas fa-briefcase"></i></div>
                                  <input style="height: 100%;" type="text" class="form-control input_placehoder" :placeholder="$t('banner.company.key')" name="keyword" value="" v-model="keysearch" @change="searchCompany">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4 aa">
                              <div class="form-group" style="margin-bottom: 15px;">
                                <Multiselect :options="nation" v-model="chooseNation" :custom-label="nameWithLang" :placeholder="$t('banner.nation')" :show-labels="false" :searchable="false">
                                </Multiselect>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group" style="margin-bottom: 15px;">
                                <div class="form-field">
                                  <input type="button" :value="$t('banner.search')" class="form-control btn btn-primary" @click="searchCompany">
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
        keysearch: '',
        keyJobs: '',
        keyCvs: '',
        type_job: '',
        chooseNation: '',

        nation: [],
        money: ['$', 'VND', '€', '¥', '₩'],
        jobs: [
          {id: 1, name: 'Xuất khẩu lao động'},
          {id: 2, name: 'Du học'},
          {id: 3, name: 'Tu nghiệp sinh'}
        ],
        searchLevel: '',
        searchAddress: '',
        level: [
          'Đại học',
          'Cao đẳng',
          'Trung cấp',
          '12/12',
          'Thấp hơn'
        ],
        address: [
          'TP. Hà Nội',
          'Nghệ An',
          'TP. Hồ Chí Minh',
          'Vinh',
        ],
        add_location: [],
        show: false
      }
    },
    components:{
      Multiselect,
    },
    methods: {
      async fetch (route) {
        let res = await this.$axios.$get(`getQuocGia`)
        this.nation = res.data
      },
      nameWithLang ({ name, id }) {
            return `${name}`
        },
        nameWithLang1 ({ profession, id }) {
            return `${profession}`
        },
      searchCompany(e){
        window.location.href = '/tim-cong-ty?keyword=' + this.keysearch + '&nation=' +(this.chooseNation != '' ? '&nation_id='+this.chooseNation.id : '');
      },
      nameWithLang ({ name, id }) {
        return `${name}`
      },
      searchJobs(){
        window.location.href = '/tin-tuyen-sinh/tim-kiem?keyword='
        +(this.keyJobs != '' ? this.ChangeToSlug(this.keyJobs).replace(/\-/gi, '%20') : "")
        +(this.type_job != '' ? '&type='+this.type_job.id : '')
        +(this.chooseNation != '' ? '&nation_id='+this.chooseNation.id : '')
      },
      searchCvs(){
        window.location.href = '/ung-vien?keyword='
        +(this.keyCvs != '' ? this.ChangeToSlug(this.keyCvs) : "")
        +(this.searchLevel != '' ? '&searchLevel='+this.level : '')
        +(this.searchAddress != '' ? '&searchAddress='+this.address : '')
      }
    },
    mounted(){
      if (localStorage.keysearch) {
        this.keysearch = localStorage.keysearch;
      }
      if (localStorage.keyJobs) {
        this.keyJobs = localStorage.keyJobs;
      }
      this.fetch()
    },
    watch: {
      keysearch(newName) {
        localStorage.keysearch = newName;
      },
      keyJobs(newName) {
        localStorage.keyJobs = newName;
      },
    }
}
</script>
<style>
  .particles-js-canvas-el{
  height: 300px !important;
}
</style>
<style scoped>
  .search-footer {
    margin-top: -10px;
  }
  .text-advance-search {
    cursor: pointer;
    color: white;
  }
  .parti{
        max-height: 0px;
        position: relative;
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
  .search-job .form-group .form-control.btn {
    padding: 0 !important;
    font-size: 16px;
    color: #000 !important;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    border-radius: 5px;
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
  .search ul li a i {
    padding-right: 3px;
  }
  .no-gutters {
    margin-right: 0;
    margin-left: 0;
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
  .section-intro-active{
    height: 450px;
    transition: opacity .75s;
  }

  .aa {
    padding-left: 2px;
    padding-right: 2px;
  }
@media(max-width: 320px) {
  .aa {
    padding-left: 13px;
    padding-right: 13px;
  }
}
@media(max-width: 767px) {
  .aa {
    padding-left: 13px;
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
}
.input_placehoder::placeholder{
  font-size: 14px;
  color: #adadad !important;
}
</style>