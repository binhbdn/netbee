<template>
  <div class="container">
    <section>
        <!-- <h1 class="text-center" style="margin-bottom: 15px">Nhà tuyển dụng nổi bật</h1> -->
      <div class="row">
          <div class="col-8">
          <div class="card">
              <!-- Carousel Options start -->
                <section id="carousel-options">
                    <div class="row match-height">
                        <div class="col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header mb-0">
                                    <h4 style="text-transform: uppercase">công ty đã kiểm duyệt</h4>
                                </div>
                                    <div class="card-content collapse show" style="padding: 13px; position:relative">
                                  <div id="carousel-interval-new" class="carousel slide" data-ride="carousel" :data-interval="10000">
                                      <ol class="carousel-indicators">
                                          <li data-target="#carousel-interval-new" v-for="(companyInfo,index) in listVerifyCompany" :key="index" :data-slide-to="index" :class="{'active': index == 0}"></li>
                                      </ol>
                                      <div class="carousel-inner" role="listbox">
                                          <div class="carousel-item" :class="{'active': index == 0}" v-for="(companyInfo,index) in listVerifyCompany" :key="index">
                                              <div class="swiper-slide swiper-slide-next">
                                        <div class="spotlightBlock">
                                            <div class="spotlightBlock__background" v-if="companyInfo.image_cover != null" role="img" :aria-label="`${companyInfo.user.name} tuyển dụng - Tìm việc mới nhất, lương thưởng hấp dẫn.`" :style="{ 'background-image': 'url(' + `/uploads/users/covers/${companyInfo.image_cover}` + ')' }"></div>
                                            <div class="spotlightBlock__background" v-else role="img" :aria-label="`${companyInfo.user.name} tuyển dụng - Tìm việc mới nhất, lương thưởng hấp dẫn.`" :style="{ 'background-image': 'url(' + `/assets/img/cover-netbee.jpg` + ')' }"></div>
                                            <div class="spotlightBlock__wrapper">
                                              <div class="is-mobile is-centered">
                                                  <div class="spotlightBlock__inner">
                                                    <div class="columns spotlight-item is-vcentered">
                                                        <div class="column is-3 spotlightBlock__logo">
                                                          <figure class="image is-inline-block">
                                                            <img v-if="companyInfo.user.avatar != null" v-lazy="`/uploads/users/avatars/${companyInfo.user.avatar}`" :alt="`${companyInfo.user.name} tuyển dụng - Tìm việc mới nhất, lương thưởng hấp dẫn.`">
                                                            <img v-else v-lazy = "`assets/img/logo.png`"></figure>
                                                        </div>
                                                        <div class="column is-8 spotlightBlock__content-wrapper">
                                                          <div class="spotlightBlock__title">
                                                              <h3>{{companyInfo.user.name}}</h3>
                                                          </div>
                                                          <!-- <div class="spotlightBlock__message ellipsis">#ThriveOnChange #DigitalTransformation</div> -->
                                                          <div class="spotlightBlock__content">
                                                              <div class="clamp-lines ">
                                                                <div style="text-align: left" id="clamped-content-spotlight-description-4" aria-hidden="true">{{companyInfo.company_about}}</div>
                                                              </div>
                                                          </div>
                                                          <div class="spotlightBlock__cta"><a :href="`/cong-ty/${companyInfo.username}`" target="_blank" class="button button_secondary is-outlined">Xem thêm</a></div>
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                      </div>
                                      </div>
                                      <a class="carousel-control-prev" href="#carousel-interval-new" style="position: absolute; top: 101%; left: 37%;" role="button" data-slide="prev">
                                          <button class="el-carousel__arrow el-carousel__arrow--left">
                                            <i class="fas fa-angle-left"></i>
                                          </button>
                                      </a>
                                      <a class="carousel-control-next" href="#carousel-interval-new" style="position: absolute;top: 38%; right: 36%;" role="button" data-slide="next">
                                          <button class="el-carousel__arrow el-carousel__arrow--right">
                                            <i class="fas fa-angle-right"></i>
                                          </button>
                                      </a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Carousel Options end -->
            </div>
        </div>
        <div class="col-4" style="padding-left: 4px;">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-transform: uppercase">Công ty mới</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-6 user-latest-img" v-for="(companyInfo,index) in listNewCompany" :key="index">
                            <a :href="`cong-ty/${companyInfo.username}`">
                              <img v-if="companyInfo.user.avatar != null" v-lazy="`/uploads/users/avatars/${companyInfo.user.avatar}`" class="img-fluid mb-1 rounded-sm" alt="avtar img holder">
                              <img v-else v-lazy="`assets/img/logo.png`" class="img-fluid mb-1 rounded-sm" :alt="`avatar - ${companyInfo.user.name}`">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="row" style="padding:0 14px">
        <p style="font-size: 18px">Dựa trên phản hồi của nhân viên Việt Nam từ 1/1/19 đến 12/12/19</p>
      </div>
    </section>
    <section class="list-company" style="background-color:#fff; padding: 15px">
      <div class="list-company-item" v-for="(companyInfo,index) in listAllCompany" :key="index">
        <div class="row" >
          <div class="col-12" v-if="companyInfo.nb_company != null">
            <a :href="`/cong-ty/${companyInfo.nb_company.username ? companyInfo.nb_company.username : '#'}`"><h4>#{{companyInfo.id}} {{companyInfo.name}}.</h4>
            </a>
        
          </div> 
          <div class="col-12" v-else>
            <a><h4>#{{companyInfo.id}} {{companyInfo.name}}.</h4>
            </a>
          </div>  
        </div>
        <div class="row">
          <div class="col-3">
            <div class="content-box">
              <div v-if="companyInfo.nb_company != null" class="company-logo text-center" title="" data-original-title="JOIN US ON MISSION INCREDIBLE">
                <a data-controller="utm-tracking" :href="`/cong-ty/${companyInfo.nb_company.username ? companyInfo.nb_company.username : '#'}`" rel="nofollow" target="_blank">
                  <img v-if="companyInfo.avatar != null" class=" ls-is-cached lazyloaded" v-lazy="companyInfo.avatar.startsWith('https') ? companyInfo.avatar :`/uploads/users/avatars/${companyInfo.avatar}`">
                  <img v-else class=" ls-is-cached lazyloaded" v-lazy="`https://netbee.vn/_nuxt/img/377bc00.png`">
                </a>
              </div>
              <div v-else class="company-logo text-center" title="" data-original-title="JOIN US ON MISSION INCREDIBLE">
                <a data-controller="utm-tracking" rel="nofollow" target="_blank">
                  <img v-if="companyInfo.avatar != null" class=" ls-is-cached lazyloaded" v-lazy="companyInfo.avatar.startsWith('https') ? companyInfo.avatar :`/uploads/users/avatars/${companyInfo.avatar}`">
                  <img v-else class=" ls-is-cached lazyloaded" v-lazy="`https://netbee.vn/_nuxt/img/377bc00.png`">
                </a>
              </div>
            </div>
          </div>
          <div class="col-9">
            <div class="row">
              <div class="col-6">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="star-rating">
                      <star-rating
                      :rating="companyInfo.rate"
                      :increment="0.1"
                      :star-size="30"
                      :read-only="true"
                      ></star-rating>
                    </div>
                  </div>
                </div>
              </div>  
              <div class="col-6">
              </div>  
            </div> 
            <div class="row">
            <div class="review_headline">
              <p v-if="companyInfo.nb_company != null">
                <i style="margin-right: 5px" class="fas fa-quote-left"></i>{{companyInfo.nb_company.company_about}}
              </p>
              <p v-else>
                <i style="margin-right: 5px" class="fas fa-quote-left"></i> Đang cập nhật
              </p>
            </div>
            </div> 
            <div class="row text-right" v-if="companyInfo.nb_company != null">
              <p style="width:100%; padding-right: 30px; font-size: 18px">
                <span class="action-link"><a :href="`/cong-ty/${companyInfo.nb_company.username ? companyInfo.nb_company.username : '#'}`" class="btn btn-bg-edit">Xem chi tiết</a></span>
              </p>
            </div>
            
          </div>  
      </div> 
      </div>
      <infinite-loading
                v-if="listAllCompany.length"
                spinner="bubbles"    
                ref="infiniteLoading" 
                @infinite="infiniteScroll" style="padding:20px; width:100%"
            >        
            <div slot="no-more" style="font-size:15px; font-style: italic;display: none;">Hết</div>    
            <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
        </infinite-loading>
    </section>
  </div>
</template>
<script>
import CompanyList1 from "~/components/Company/CompanyList1";
import StarRating from 'vue-star-rating'
import JobsList1Col from '~/components/Jobs/JobsList1Col'
import JobsList2Col from '~/components/Jobs/JobsList2Col'
import NewsList from '~/components/News/NewsList'
export default {
  data() {
    return {
      rating:3,
      listAllCompany: [],
      listVerifyCompany: [],
      listNewCompany: [],
      page: 1
      
    }
  },
  components: {
    CompanyList1,StarRating,
    JobsList2Col,
      NewsList,
      JobsList1Col
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch: async function(){
      let getAllCompany = await this.$axios.get('getListCompanyUser?perPage=3');
      this.listAllCompany = getAllCompany.data.data.data;
      let getVerifyCompany = await this.$axios.get('getListCompany?type=2&limit=5&perPage=0');
      this.listVerifyCompany = getVerifyCompany.data.data;
      let getNewCompany = await this.$axios.get('getListCompany?type=1&limit=9&perPage=0');
      this.listNewCompany = getNewCompany.data.data;
    },
    infiniteScroll($state) {
            setTimeout(() => {
                this.page++
                this.$axios
                .get('getListCompanyUser?perPage=3'+ '&page='+this.page)
                 .then((response) => {
                    if (response.data.data.data.length >= 1) {
                        response.data.data.data.forEach((item) => this.listAllCompany.push(item))
                        $state.loaded()
                    } else {
                        $state.complete()
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
            }, 500)
            }        
                
  },
};
</script>
<style>
img.img-fluid {
    width: 423px;
    height: 88px;
    margin-bottom: 14px;
    object-fit: contain;
}
.card-title {
  margin-bottom: 6px !important;
  margin-top: 10px !important;
}
span.carousel-control-prev-icon {
  margin-left: auto !important;
  margin-top: 280px;
}
span.carousel-control-prev-icon :hover {
  color: #ffc107;
}

a.carousel-control-next {
  margin-right: 1px !important;
  margin-top: 280px;
}
span.carousel-control-prev-icon {
  margin-left: auto !important;
}
.row.carousel-1 {
  height: 490px;
}

.col-lg-8.col-12.p-r-0 {
  margin-left: 232px;
}
.col-12 h4{
    font-weight: 500;
    margin-left: 15px;
    color: #353535;
    line-height: 35.2px;
    font-size: 22px;
    margin-top: 20px;
    margin-bottom: 20px;
    font-family: "Roboto", sans-serif;
}
.col-md-8 {
  margin-left: 235px;
}
.remove-border-rightt {
  position: initial;
  display: inline-block;
  margin-left: 90px;
  margin-bottom: 13px;
}
.NB_main_titlee {
  background-color: #ffc107;
  padding: 5px;
  border-radius: 3px;
  margin-bottom: 17px;
}
span.carousel-control-prev-icon {
  margin-left: -199px;
}
a.carousel-control-next {
  margin-right: -101px;
}
ol.carousel-indicators {
  margin-bottom: 8px;
  margin-left: 43%;
  margin-right: 43%;
}
 tbody tr {
    background-color: #FFFFFF;
    box-shadow: rgba(0, 0, 0, 0.05) 0 4px 20px 0;
    cursor: pointer;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    border-radius: 0.5rem;
}
 tbody tr:hover {
    -webkit-transform: translateY(-4px);
    -ms-transform: translateY(-4px);
    transform: translateY(-4px);
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.action-link a {
    /* border-bottom: 1px dotted #ea2635;
    color: #EA2635; */
    text-decoration: none;
}
.list-company .list-company-item:nth-child(odd) {
    background: #f9f9f9;
}
.list-company .list-company-item:hover {
    background: white;
    border-color: transparent;
    box-shadow: 0 0 5px 1px #bcbcbc;
}
.list-company .list-company-item {
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
    padding: 10px;
    margin-bottom: -2px;
    border-top: 1px solid #e7e7e7;
    position: relative;
}
.swiper-slide {
    flex-shrink: 0;
    width: 100%;
    height: 100%;
    position: relative;
    transition-property: transform;
}
.spotlightBlock {
    position: relative;
    padding-bottom: 20px;
}
.spotlightBlock__background {
    background-size: cover !important;
    background-position: center !important;
    width: auto;
    height: 300px;
    border-radius: 4px;
    box-shadow: 0 0 4px 0 rgba(0,0,0,0.25);
}
.spotlightBlock__wrapper {
    width: 80%;
    margin-top: -100px;
    margin-left: auto;
    margin-right: auto;
}
.spotlightBlock__inner {
    background-color: white;
    padding: 16px 14px;
    border-radius: 5px;
    box-shadow: 0 0 4px 0 rgba(0,0,0,0.25);
    text-align: center;
}
.columns.is-vcentered {
    align-items: center;
}
.columns:last-child {
    margin-bottom: -.75rem;
}
.column.is-3, .column.is-3-tablet {
    flex: none;
    width: 25%;
}
.column {
    display: block;
    flex-basis: 0;
    flex-grow: 1;
    flex-shrink: 1;
    padding: .75rem;
    min-width: 0;
}
.column.is-8, .column.is-8-tablet {
    flex: none;
    width: 66.66667%;
}
.columns:not(.is-desktop) {
    display: flex;
}
.is-inline-block {
    display: inline-block !important;
}
.spotlightBlock__logo .image img {
    border-radius: 4px;
    height: 70%;
    width: 100%;
    /* box-shadow: 0 0 4px 0 rgba(0,0,0,0.25); */
}
.image img {
    display: block;
    height: auto;
    width: 100%;
}
.spotlightBlock__title {
    opacity: 0.8;
    color: #333333;
    font-size: 24px;
    line-height: 24px;
    margin-bottom: 5px;
}
.spotlightBlock__message {
    color: #00B9F2;
    font-size: 16px;
    font-style: italic;
    font-weight: 300;
    line-height: 21px;
}
.button.button_secondary:hover {
    background-color: #F7941D;
    color: white;
}
.spotlightBlock__content {
    margin: 20px 0;
    height: 5.25rem;
    overflow: hidden;
    color: #555555;
    font-size: 14px;
    font-weight: 300;
    line-height: 18px;
}
.spotlightBlock__cta {
    text-align: right;
}
.spotlightBlock__cta a.button_secondary:hover {
    background-color: #d97b08;
}
.spotlightBlock__cta a.button_secondary {
    color: #ff9900;
    background-color: #fff;
    transition: background-color 0.3s;
    padding: .5rem 2rem;
}
.button:active, .button.is-active {
    border-color: #4a4a4a;
    color: #363636;
}
/* img {
    height: auto;
    max-width: 100%;
} */
.button.button_secondary {
    border: 1px solid #F7941D;
    color: #F7941D;
    border-radius: 4px;
}
.content-box {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.company-logo {
    margin: 1em auto;
    width: 168px;
    height: 168px;
    line-height: 152px;
    background-color: #fff;
    padding: 5px;
    border-radius: 2px;
    border: 1px solid #d2d2d2;
}
.company-logo img {
    max-height: 152px;
    max-width: 100%;
}
  .review_headline p {
    font-size: 16px;
    color: #7f7f7f;
    line-height: 30px;
    height: 120px;
    margin-top: 3px;
    margin-bottom: 0;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.vue-star-rating-rating-text {
    font-size: 25px;
}
.user-latest-img:hover {
    -webkit-transform: translateY(-4px) scale(1.2);
    -ms-transform: translateY(-4px) scale(1.2);
    transform: translateY(-4px) scale(1.2);
    z-index: auto;
}
.clamped-content-spotlight-description-4{
  font-size: 16px;
    color: #7f7f7f;
    line-height: 30px;
    height: 120px;
    margin-top: 3px;
    margin-bottom: 0;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.list-company-item h4{
  margin-top: 0;
  margin-bottom: 0;
}
.col-3 {
    max-width: 21%;
}
.btn-bg-edit {
  color: #000;
  border: 1px solid #ffc107;
}
.btn-bg-edit:hover {
  background:#ffc107 ;
}
</style>
