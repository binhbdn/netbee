<template>
  <div v-if="!loading" class="container">
    <!-- VIỆC LÀM MỚI -->
    <section>
      <div class="row">  
        <div class="col-lg-4 col-12 pr-0" style="padding-right: 4px;">
            <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                <i class="fad fa-bullhorn"></i> TÌM KIẾM NÂNG CAO
              </h4>
            </div>
            <div class="card-content show">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <Multiselect :options="money" v-model="currency" placeholder="Chọn loại tiền" :show-labels="false" :searchable="false" name="money"></Multiselect>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="form-field">
                        <div class="select-wrap">
                          <input name="salary_start" v-model="salary_start" type="text" class="form-control" placeholder="Mức lương tối thiểu....">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="form-field">
                        <div class="select-wrap">
                          <input name="salary_end" v-model="salary_end" type="text" class="form-control" placeholder="Mức lương tối đa....">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <Multiselect :options="visa" v-model="chooseVisa" placeholder="Chọn lĩnh vực" :show-labels="false"  :custom-label="nameWithLang1"></Multiselect>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <Multiselect :options="work_form" v-model="chooseWork" :custom-label="nameWithLang" placeholder="Hình thức làm việc" :show-labels="false" :searchable="false"></Multiselect>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="form-field">
                        <input type="button" value="Tìm ngay" class="form-control col-md-12 btn bg-netbee" @click="search">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>      
        <div class="col-lg-8 col-12 p-r-0 p-l-0-mb">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                <i class="fad fa-business-time"></i> DANH SÁCH ĐƠN HÀNG
              </h4>
            </div>
            <div class="card-content collapse show">
              <div class="card-body">
                <JobsList1Col :DataList="arrayJobNew" type=""></JobsList1Col>
                <!-- <infinite-loading
                    v-if="arrayJobNew.length"
                    spinner="bubbles"    
                    ref="infiniteLoading" 
                    @infinite="infiniteScroll" style="padding:20px; width:100%"
                >        
                  <div slot="no-more" style="font-size:15px; font-style: italic;">Không còn kết quả.</div>    
                  <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
                </infinite-loading> -->
              </div>            
            </div>
          </div>
        </div>        
      </div>
    </section>
  </div>
</template>
<script>
import JobsList1Col from "~/components/Jobs/JobsList1Col";
import JobsList1ColNotCate from "~/components/Jobs/JobsList1ColNotCate";
import Multiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.min.css';
export default {
  head: {
    title: "Tin tuyển sinh mới nhất,tin tuyển dụng du học,tin xuất khẩu lao động mới nhất",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "Tin tuyển sinh mới nhất,tin tuyển dụng du học,tin xuất khẩu lao động mới nhất" }
    ]
  },
    data() {
    return{    
      loading: true,  
      currency: '',
      chooseWork: '',
      chooseVisa: '',
      salary_start: '',
      salary_end: '',

      money: ['$', 'VND', '€', '¥', '₩'],
      work_form: [
        {id: 1, name: 'Toàn thời gian'},
        {id: 2, name: 'Bán thời gian'},
        {id: 3, name: 'Vừa học vừa làm'}
      ],
      // page: 1
    }
  },
  created () {
        this.$nextTick(function () {
           this.loading = false
       })
     },
  components: {
    JobsList1Col,
    JobsList1ColNotCate, Multiselect
  },
  async asyncData({$axios, route}) {
    let getTinTuyenDungNew = await $axios.$get('getTinTuyenDungNewPage?perPage=20')
    let getTinTuyenDungXKLD = await $axios.$get(`getTinTuyenDungNew?limit=20&type=1`)
    let getTinTuyenDungDHS = await $axios.$get(`getTinTuyenDungNew?limit=20&type=2`)
    let getTinTuyenDungTNS = await $axios.$get(`getTinTuyenDungNew?limit=20&type=3`)
    let getTinTuyenDungHot = await $axios.$get(`getTinTuyenDungHot?limit=10`)
    let searchCvs = await $axios.$get('searchCvs?search='
      +(route.query.keyword != null ? route.query.keyword : '')
    )
    let getVisa = await $axios.$get(`getVisa`)

    return {
        arrayJobNew: getTinTuyenDungNew.data.tintuyendung,
        arrayJobXKLD: getTinTuyenDungXKLD.data.tintuyendung,
        arrayJobDHS: getTinTuyenDungDHS.data.tintuyendung,
        arrayJobTNS: getTinTuyenDungTNS.data.tintuyendung,
        arrayJobHot: getTinTuyenDungHot.data.tintuyendung,
        arrayCvs: searchCvs.data,
        visa: getVisa.data
    }
  },
  computed: {
    
  },

  methods: {
    // infiniteScroll($state) {     
    //   setTimeout(() => {
    //       this.page++
    //       this.$axios
    //       .get('getTinTuyenDungNewPage?perPage=6'+ '&page='+this.page)
    //         .then((response) => {            
    //           if (response.data.data.tintuyendung.length > 1) {
    //               response.data.data.tintuyendung.forEach((item) => this.arrayJobNew.push(item))
    //               $state.loaded()
    //           } else {
    //               $state.complete()
    //           }
    //       })
    //       .catch((err) => {
    //           console.log(err)
    //       })
    //   }, 500)
    //   },   
    nameWithLang ({ name, id }) {
            return `${name}`
        },
    nameWithLang1 ({ profession, id }) {
            return `${profession}`
        },
    async search() {
      this.arrayJobNew = []   
      let getTinTuyenDungNew = await this.$axios.$get('searchJobs?currency='+(this.currency == '' || this.currency == null ? '' : this.currency)
                                                  +(this.chooseWork != '' && this.chooseWork != null ? '&work_form='+this.chooseWork.id : '')
                                                  +(this.salary_start != '' ? '&salary_start='+this.salary_start : '')
                                                  +(this.salary_end != '' ? '&salary_end='+this.salary_end : '')
                                                  +(this.chooseVisa != '' && this.chooseVisa != null ? '&id_visa='+this.chooseVisa.id : ''))
      this.arrayJobNew = getTinTuyenDungNew.data
    },
  },
};
</script>
<style >
.banner-tt {
  background-color: white;
  height: 64px;
  margin-top: 15px;
  margin-bottom: 15px;
}
.float-right-a {
  float: right;
  padding: 17px 23px;
}
select#cars {
  width: 136px;
  height: 30px;
  border-color: #ffb701;
  border-radius: 6px;
}
.float-lerft-a {
  float: left;
  padding: 15px;
  margin-left: 50px;
}
img#hmt {
  width: auto;
  height: 53px;
  position: absolute;
  padding: 4px;
  margin: 5px;
}
a.btn.btn-outline-primary {
  height: 32px;
}
a.btn.btn-outline-primary {
  height: 32px;
  margin-left: 8px;
  color: black;
  border-color: #ffb701;
  background-color: #ffb701;
  padding: 8px 8px;
}
a.btn.btn-outline-primary :active {
  background-color: #ffb701 !important;
  border-color: #ffb701;
}
select#cars :focus {
  border-color: #ffb701 !important;
  border-radius: 6px !important;
}
</style>