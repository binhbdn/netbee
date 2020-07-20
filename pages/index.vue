<template>

  <div>
    <!--section login-->
    <section class="ftco-section services-section card" style="background: #fff" v-if="!$auth.loggedIn">
      <div class="container">
        <div class="row">
          <a class="col-md-2 align-self-stretch ftco-animate pd-r-0" href="dang-ky" title="Đăng ký tài khoản">
            <div class="d_item v_block hover-ncd">
                <div class="icon text-center SB_bn_1">
                  <i class="fa fa-user-plus"></i>
                </div>
                <div class="media-body">
                  <h3 class="text-center" style="text-transform: uppercase;">{{$t('home.banner.registration')}}</h3>
                </div>
            </div>
          </a>
          <a class="col-md-2 align-self-stretch ftco-animate pd-r-0" href="dang-nhap" title="Đăng nhập">
            <div class="d_item v_block hover-ncd">
              <div class="icon text-center SB_bn_1">
                <i class="fa fa-lock"></i>
              </div>
              <div class="media-body">
                <h3 class="text-center" style="text-transform: uppercase;">{{$t('login')}}</h3>
              </div>
            </div>
          </a>
          <a class="col-md-5 align-self-stretch ftco-animate" href="/dang-ky/nha-tuyen-dung">
            <div class="d_item v_block hover-ncd">
              <div class="icon text-center SB_bn_1">
                <i class="fa fa-handshake"></i>
              </div>
              <div class="media-body">
                <h3 class="text-center" style="text-transform: uppercase;">{{$t('home.banner.up_job')}}</h3>
              </div>
            </div>
          </a>
          <a class="col-md-3  align-self-stretch ftco-animate pd-l-0" href="/dang-ky/chuyen-vien-tuyen-dung">
            <div class="d_item v_block hover-ncd">
              <div class="icon text-center SB_bn_1">
                <i class="fa fa-comments"></i>
              </div>
              <div class="media-body">
                <h3 class="text-center" style="text-transform: uppercase; margin-bottom: 2px;">{{$t('home.banner.introduce')}}
                </h3>
                <h3 class="text-center text-ds" style="font-size: 14px;">{{$t('home.banner.decs')}}</h3>
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>
    <!-- tin nổi bật -->
    <div class="container">
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <!-- Carousel Options start -->
                <section id="carousel-options">
                    <div class="row match-height">
                        <div class="col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                  <h2 class="card-title"><i class="fad fa-business-time"></i> {{$t('home.title.jobs_hot')}}</h2>
                                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>                                  
                                </div>
                                <div class="card-content" style="position:relative">
                                    <div class="card-body">
                                        <div id="carousel-interval" class="carousel slide" data-ride="carousel" :data-interval="(typeof(arrayJobHot3) !== 'undefined') ? 10000 : null">
                                            <ol class="carousel-indicators">
                                                <li v-if="typeof(arrayJobHot3) !== 'undefined'" data-target="#carousel-interval" data-slide-to="0" class="active"></li>
                                                <li v-if="typeof(arrayJobHot3) !== 'undefined'" data-target="#carousel-interval" data-slide-to="1"></li>
                                                <li v-if="typeof(arrayJobHot3) !== 'undefined'" data-target="#carousel-interval" data-slide-to="2"></li>
                                            </ol>
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <JobsList2Col :DataList="arrayJobHot"></JobsList2Col>
                                                </div>
                                                <div class="carousel-item">
                                                    <JobsList2Col :DataList="arrayJobHot2"></JobsList2Col>
                                                </div>
                                                <div class="carousel-item" v-if="typeof(arrayJobHot3) !== 'undefined'">
                                                    <JobsList2Col :DataList="arrayJobHot3"></JobsList2Col>
                                                </div>
                                            </div>
                                            <a v-if="typeof(arrayJobHot3) !== 'undefined'" class="carousel-control-prev" href="#carousel-interval" role="button" data-slide="prev">
                                                <button class="el-carousel__arrow el-carousel__arrow--left">
                                                  <i class="fas fa-angle-left"></i>
                                                </button>
                                            </a>
                                            <a v-if="typeof(arrayJobHot3) !== 'undefined'" class="carousel-control-next" href="#carousel-interval" role="button" data-slide="next">
                                                <button class="el-carousel__arrow el-carousel__arrow--right">
                                                  <i class="fas fa-angle-right"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-bottom">
                                  <a href="/tin-tuyen-sinh/tim-kiem?keyword=tin-noi-bat" class="btn border-netbee aa">{{$t('see_more')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Carousel Options end -->
            </div>
          </div>
        </div>
      </section>
    </div>
    <!--section Tại sao chon netbee-->
    <section class="ftco-section services-section card why" style="background: #fff; text-align:center">
      <div class="container">
        <h1 class="text-center NB_benefit" style="text-transform:uppercase;"> {{$t('home.advantages.title')}}</h1>
        <div class="col-md-12" style="padding: 0">
          <div class="row">
            <div class="col-md-3" style="text-align: center; margin: 0">
              <div class="col-md-12 ncd-border-style" style="padding: 0;">
                <div class="ncd-footer-content">
                  <div class="icon text-center SB_bn">
                    <img v-lazy="`/assets/img/anh1-ncd.jpg`" alt="netbee" class="img-ncd">
                  </div>
                  <div class="media-body benefit-item-icon" style="padding: 0 10px;">
                    <h3 class="text-center text-home">{{$t('home.advantages.net.title')}}</h3>
                    <p>{{$t('home.advantages.net.decs')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3" style="text-align: center; margin: 0">
              <div class="col-md-12 ncd-border-style" style="padding: 0;">
                <div class="ncd-footer-content">
                  <div class="icon text-center SB_bn">
                    <img v-lazy="`/assets/img/anh2-ncd.jpg`" alt="netbee" class="img-ncd">
                  </div>
                  <div class="media-body benefit-item-icon" style="padding: 0 10px;">
                    <h3 class="text-center text-home">{{$t('home.advantages.CTV.title')}}</h3>
                    <p>{{$t('home.advantages.CTV.decs')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3" style="text-align: center; margin: 0">
              <div class="col-md-12 ncd-border-style" style="padding: 0;">
                <div class="ncd-footer-content">
                  <div class="icon text-center SB_bn">
                    <img v-lazy="`/assets/img/anh3-ncd.jpg`" alt="netbee" class="img-ncd">
                  </div>
                  <div class="media-body benefit-item-icon" style="padding: 0 10px;">
                    <h3 class="text-center text-home">{{$t('home.advantages.profile.title')}}</h3>
                    <p>{{$t('home.advantages.profile.decs')}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3" style="text-align: center; margin: 0">
              <div class="col-md-12 ncd-border-style" style="padding: 0;">
                <div class="ncd-footer-content">
                  <div class="icon text-center SB_bn">
                    <img v-lazy="`/assets/img/anh4-ncd.jpg`" alt="netbee" class="img-ncd">
                  </div>
                  <div class="media-body benefit-item-icon" style="padding: 0 10px;">
                    <h3 class="text-center text-home">{{$t('home.advantages.partner.title')}}</h3>
                    <p>{{$t('home.advantages.partner.decs')}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="container">
      <!-- tin mới -->
      <section>
        <div class="row">
          <div class="col-lg-8 col-12 p-r-0" id="fullwidth">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title"><i class="fad fa-business-time"></i> {{$t('home.title.jobs_new')}}</h2>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>                
              </div>
              <div class="card-content collapse show" style="padding: 13px;padding-bottom: 0px !important;">
                <div>
                   <JobsList1Col :DataList="arrayJobNew" type=""></JobsList1Col>
                </div>              
              </div>
              <div class="main-bottom" style="padding: 15px 15px;">
                <a href="/tin-tuyen-sinh" class="btn border-netbee aa">{{$t('see_more')}}</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <ul class="nav nav-tabs nav-fill" style="margin: 0;" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill"
                    role="tab" aria-controls="home-fill" aria-selected="true" ><i class="fad fa-clipboard-list"></i> {{$t('home.field')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill"
                    role="tab" aria-controls="profile-fill" aria-selected="false"><i
                  class="fas fa-map-marker-check"></i> {{$t('home.area')}}</a>
              </li>
            </ul>
            <div class="card" style="box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.1);">
              <div class="card-content collapse show">
                <div class="card-body">
                  <section id="nav-filled">
                    <div class="row">
                      <div class="col-sm-12 p-0">
                        <div class="card overflow-hidden">
                          <div class="card-content">
                            <div class="card-body">
                              <!-- Nav tabs -->
                              <!-- Tab panes -->
                              <div class="tab-content pt-1">
                                <div class="tab-pane active list-item" id="home-fill" role="tabpanel"
                                      aria-labelledby="home-tab-fill">
                                  <ul class="nav flex-column">
                                    <li class="nav-item item" v-for="(item, index) in linhvuc" :key="index"><a :href="`tin-tuyen-sinh/tim-kiem?id_visa=${item.id}`"><i class="fa fa-hand-point-right"></i> {{item.profession}}</a></li>
                                  </ul>
                                </div>
                                <div class="tab-pane" id="profile-fill" role="tabpanel"
                                      aria-labelledby="profile-tab-fill">
                                  <ul class="nav flex-column">
                                    <li class="nav-item item" v-for="(item, index) in quocgia" :key="index"><a :href="`tin-tuyen-sinh/tim-kiem?nation_id=${item.id}`"><i class="fa fa-hand-point-right"></i> {{item.name}}</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
            <div class="card" style="box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.1);">
              <TagList :DataList="tag"></TagList>
            </div>
          </div>
        </div>
      </section>
    </div>
      <!-- banner quang cao -->
      <section class="banner-ncd ftco-section services-section card why">
        <div class="container">
          <div class="card-content collapse show">
            <div id="carousel-interval-new" class="carousel slide" data-ride="carousel" :data-interval="10000">
              <ol class="carousel-indicators">
                  <li data-target="#carousel-interval-new" v-for="(item,key) in listAdver" :key="key" :data-slide-to="key" :class="{'active': key == 0}"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item" :class="{'active': key == 0}" v-for="(item,key) in listAdver" :key="key">
                  <div class="swiper-slide swiper-slide-next">
                    <div class="spotlightBlock">
                      <div class="spotlightBlock__wrapper">
                        <div class="is-mobile is-centered">
                          <div class="spotlightBlock__inner">
                            <div class="columns spotlight-item is-vcentered">
                                <div class="column is-3 spotlightBlock__logo">
                                  <figure class="image is-inline-block">
                                    <img v-lazy="`/assets/img/test-banner.jpg`" style="width: 100%">
                                  </figure>
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
        </div>
      </section>
      <!-- tin tức -->
    <div class="container">
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title"><i class="fad fa-newspaper"></i> {{$t('home.title.news')}}</h2>                
              </div>
              <div class="card-content collapse show news">
                <div class="card-body">
                  <NewsList :DataList="tintuc"></NewsList>
                </div>
              </div>
              <div class="main-bottom m-r-bt-15">
                <a href="/tin-tuc" class="btn border-netbee">{{$t('see_more')}}</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
<script>
  import JobsList1Col from '~/components/Jobs/JobsList1Col'
  import JobsList2Col from '~/components/Jobs/JobsList2Col'
  import TagList from '~/components/TagList'
  import NewsList from '../components/News/NewsList'

  export default {
    data() {
        return {
            arrayJobNew: [],
            arrayJobNew2: [],
            tintuc: [],
            arrayJobHot: [],
            arrayJobHot2: [],
            arrayJobHot3: [],
            pageLoadingHot: 1,
            pageLoadingNew: 1,
            linhvuc: [],
            quocgia: [],
            tag:[],
            listVerifyCompany: [],
            listAdver: []
        }
    },
    components: {
      JobsList2Col,
      NewsList,
      JobsList1Col,
      TagList
    },
    methods: {
      fetch() {
        this.$axios.$get(`getTinTuyenDungNewCarousel?page=1`).then((ress) => {
          var myArray = ress.data.tintuyendung.data
          var index = 0;
          var arrayLength = myArray.length;
          var tempArray = [];
      
          for (index = 0; index < arrayLength; index += 10) {
              var myChunk = myArray.slice(index, index+10);
              tempArray.push(myChunk);
          }
          
          this.arrayJobNew = tempArray[0];
          this.arrayJobNew2 = tempArray[1];
        });
        this.$axios.$get(`getTinTuyenDungHotCarousel?page=1`).then((ress) => {
          var myArray = ress.data.tintuyendung.data
          var index = 0;
          var arrayLength = myArray.length;
          var tempArray = [];
      
          for (index = 0; index < arrayLength; index += 8) {
              var myChunk = myArray.slice(index, index+8);
              tempArray.push(myChunk);
          }
          
          this.arrayJobHot = tempArray[0];
          this.arrayJobHot2 = tempArray[1];
          this.arrayJobHot3 = tempArray[2];
          
        });

        this.$axios.$get(`getTinTucNew?limit=6`).then((ress) => {
          this.tintuc = ress.data.tintuc
        })
        this.$axios.$get(`getVisa`).then((ress) => {
          this.linhvuc = ress.data
        })
        this.$axios.$get(`getQuocGia`).then((ress) => {
          this.quocgia = ress.data
        })
        this.$axios.$get(`getTagAll`).then((ress) => {
          this.tag = ress          
        })
        this.$axios.get(`getListCompany?type=2&limit=5&perPage=0`).then((ress) => {
          this.listVerifyCompany = ress.data.data
        }) 
      },
      listAdvertisement :function() {
        try {
          this.$axios.get(`listAdvertisement`)
          .then(response => {                                                          
              this.listAdver = response.data.data
              console.log(this.listAdver)
          })
          .catch(error => {
              console.log(error.response)
          });
        } catch (error) {
            this.$swal(
                'Lỗi!',
                'Lỗi dữ liệu',
                'error'
            )
        }
      }
    },
    mounted() {
        this.fetch()
        this.listAdvertisement()                         
    }
  }
</script>
<style scoped>
  .main-bottom{
    text-align: right;
    padding-right: 15px;
  }
  @media (min-width: 1000px) {
    .jobs .card-body {
      max-height: 375px;
    }
  }
  .m-r-bt-15{
    margin-bottom: 15px; 
    margin-right: 15px;
  }
  .nav.nav-tabs .nav-item .nav-link.active:after{
    display: none;
  }
  #profile-tab-fill:hover{
    color: #ffb701;
  }
  #home-tab-fill:hover{
    color: #ffb701;
  }
  .nav.nav-tabs .nav-item .nav-link.active{
    background-color: #fff;
    border-top: 2px solid;
    font-weight: bold;
  }
  .text-home{
    text-transform:uppercase; 
    margin-bottom: 10px !important;
  }
  .ncd-border-style:hover{
    box-shadow: 1px 1px 5px 5px #cccbcb;
  }
  .ncd-border-style{
    box-shadow: 1px 1px 5px 5px #dfdfdf;
    background: #fff;
    border-radius: 3px;
    min-height: 250px;
  }
  .ncd-footer-content{
    padding: 0 0 15px;
  }
  .pd-l-0{
    padding-left: 0;
  }
  .pd-r-0{
    padding-right: 0;
  }
  .ftco-section {
    padding: 20px 0px 20px 0px;
    position: relative;
  }

  .NB_benefit {
    font-size: 24px;
    line-height: 28px;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .benefit-item-icon h3 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 0px;
    line-height: 16px;
  }

  .ftco-counter {
    background-color: white;
    box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.1);
  }

  .d_item.v_block {
    width: 100%;
    padding: 0px 5px;
    height: 120px;
    border-radius: 3px;
    box-shadow: 0 1px 1px #887e7e;
    -webkit-box-shadow: 0 2px 3px #ada5a5;
    -moz-box-shadow: 0px 3px 2px #000;
    box-shadow: 0 1px 4px #887e7e !important;
    -webkit-box-orient: 0 2px 3px #ada5a5 !important;
    -moz-box-shadow: 0px 3px 2px #000;
  }

  .services .icon {
    line-height: 1.3;
    position: relative;
  }

  .SB_bn {
    padding: 0 0 15px !important;
    color: #000 !important;
    font-size: 40px !important;
  }
  .SB_bn_1{
    color: #000 !important;
    font-size: 40px !important;
    margin: auto;
    padding: 5px;
  }
  .ftco-animate h3{
    font-size: 16px;
  }
  .hover-ncd:hover {
    background: #ffb701;
    cursor: pointer;
  }
 
  .why .d_item.v_block:hover{
    background-color: white!important ;
    color:black!important;
  }
  .why .d_item.v_block p:hover{
    color:black!important;
  }
  .why .d_item.v_block{
    height:auto;
    text-align:center;
    box-shadow: 0 1px 2px #887e7e !important;
  }

  .item{
    padding: 8px 0;
    border-bottom: 1px dotted #ddd;
  }

  .list-item{
    max-height: 400px;
    overflow-y: auto;
  }
  /* width */
  .list-item::-webkit-scrollbar {
    width: 3px;
  }

  /* Track */
  .list-item::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px rgba(128, 128, 128, 0.192);
    border-radius: 10px;
  }

  /* Handle */
  .list-item::-webkit-scrollbar-thumb {
    background: rgba(78, 78, 78, 0.507);
    border-radius: 10px;
  }

  /* Handle on hover */
  .list-item::-webkit-scrollbar-thumb:hover {
    background: rgba(78, 78, 78, 0.404);
  }
  .img-ncd{
    width: 100%; 
    border-radius: 3px;
  }
  @media(max-width: 1199px) {
    .ncd-border-style{
      min-height: 291px;
    }
  }
  @media(max-width: 991px) {
    .ncd-border-style{
      min-height: 295px;
    }
    .ncd-footer-content{
      padding-bottom: 5px;
    }
    .text-ds{
      display: none;
    }
  }
  @media(max-width: 767px) {
    .ncd-border-style{
      margin: 8px 0;
    }
    .pd-l-0{
      padding-left: 15px;
      margin-top: 10px;
    }
    .pd-r-0{
      padding-right: 15px;
      margin-bottom: 10px;
    }
    .text-ds{
      display: block;
    }
    .m-r-bt-15{
      margin-right: 0px;
    }
    .slide-job-body {
      padding-right: 0px;
      padding-left: 0px;
    }
  }
  @media(max-width: 320px) {
  .aa{
      padding: 6px;
  }
}
</style>
