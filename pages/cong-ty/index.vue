<template>
  <div class="container">
    <section>
      <!-- <div class="row"> -->
          <!-- <div class="col-8">
          <h1>Công ty CNTT tốt nhất Việt Nam 2020</h1>
          <p style="font-size: 16px">
Các nhân viên đã lên tiếng! Dưới đây là Top 15 công ty CNTT tốt nhất Việt Nam 2020 hoạt động dựa trên hơn 11.000 đánh giá được gửi bởi những người làm CNTT.</p>
        </div>
        <div class="col-4"> -->
          <!-- <img style="width: 250px" src="https://itviec.com/assets/2020_best_company_badge-f38d668d87ad0f4a24e39be359afe7d821fb44625a710cd440fd88cfc7d11d4c.svg"> -->
        <!-- </div> -->
      <!-- </div>
      <div class="row" style="padding:0 14px">
        <p style="font-size: 16px">Dựa trên phản hồi của nhân viên Việt Nam từ 1/1/19 đến 12/12/19</p>
      </div> -->
    </section>
    <section class="list-company" style="background-color:#fff; padding: 15px">
      <div class="list-company-item" v-for="(companyInfo,index) in companyInfos" :key="`companyInfo-${index}`">
        <div class="row">
          <div class="col-12">
            <a :href="`/cong-ty/${companyInfo.username ? companyInfo.username : '#'}`"><h4>#{{companyInfo.id}} {{companyInfo.user.name}}.</h4>
            </a>
            </div>  
        </div>
        <div class="row">
          <div class="col-3">
            <a :href="`/cong-ty/${companyInfo.username ? companyInfo.username : '#'}`">
            <div style="border: 1px solid #ddd; padding: 5px"><img src="https://netbee.vn/_nuxt/img/377bc00.png"></div>
            </a>
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
            <p><i class="fas fa-quote-left"></i> {{companyInfo.company_about}}</p>
            </div> 
            <!-- <div class="row text-right">
              <p style="width:100%; padding-right: 20px">
                <span class="action-link"><a href="">Xem công việc</a></span>|
                <span class="action-link"><a href="">Xem phản hồi</a></span></p>
          </div> -->
          </div>  
             
      </div> 
      </div>
    </section>
  </div>
</template>
<script>
import CompanyList1 from "~/components/Company/CompanyList1";
import StarRating from 'vue-star-rating'
export default {
  data() {
    return {
      rating:3,
      companyInfos: []
    }
  },
  components: {
    CompanyList1,StarRating
  },
  created() {
    this.fetch();
  },
  methods: {
    async fetch(){
      let companyInfos = await this.$axios.get('getListCompany?page=1');
      this.companyInfos = companyInfos.data.data.data;
      console.log(this.companyInfos);
    }
  },
};
</script>
<style>
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
.col-md-8 {
  margin-left: 235px;
}
img.img-fluid {
  width: 423px;
  height: 288px;
  margin-bottom: 14px;
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
  margin-bottom: -4px;
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
    border-bottom: 1px dotted #ea2635;
    color: #EA2635;
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
.list-company-item p{
  font-size: 15px;
}
</style>
