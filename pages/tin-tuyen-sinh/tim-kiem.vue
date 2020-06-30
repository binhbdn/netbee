<template>
  <div class="container">
    <!-- VIỆC LÀM MỚI -->
    <!-- <div class="banner-tt">
      <div class="litss">
        <div class="img-logoo">
          <img id="hmt" src="/app-assets/images/logo/homt.png" alt="branding logo" />
        </div>
        <div class="float-lerft-a">
          <h3 style="display: contents;">Gửi tôi việc tương tự</h3>
          <a href="#follow" class="btn btn-outline-primary">Nhận thông báo</a>
        </div>
        <div class="float-right-a">
          <span style=" margin-right: 14px; color: BLACK; font-size: 17px;">Sắp xếp theo</span>
          <select id="cars" name="cars">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
      </div>
    </div> -->
    <section>
      <div class="row">
        <div class="col-lg-4 col-12" style="padding-right: 4px;">
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
                      <Multiselect :options="visa" v-model="chooseVisa" placeholder="Chọn lĩnh vực" :show-labels="false" :searchable="false" :custom-label="nameWithLang1"></Multiselect>
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
                        <input type="button" value="Tìm ngay" class="form-control btn btn-warning text-dark" style="background-color: #ffb701 !important; border-color: #ffb701 !important" @click="search">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                <i class="fad fa-bullhorn"></i> DANH SÁCH ĐƠN HÀNG
              </h4>
            </div>
            <div class="card-content collapse show">
              <div class="card-body ">
                <JobsList1Col :DataList="arrayJobNew"></JobsList1Col>
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
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
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
    }
  },
  components: {
    JobsList1Col,
    JobsList1ColNotCate,
    Multiselect
  },
  async asyncData({$axios, route}) {
    let getTinTuyenDungNew = await $axios.$get('searchJobs?keyword='
                                                +(route.query.keyword != null ? route.query.keyword : '')
                                                +(route.query.type != null ? '&type='+ route.query.type : '')
                                                +(route.query.nation_id != null ? '&nation_id='+route.query.nation_id : '')
                                                +(route.query.id_visa != null ?  '&id_visa='+route.query.id_visa : ''))
    let getVisa = await $axios.$get(`getVisa`)
    return {
        arrayJobNew: getTinTuyenDungNew.data,
        visa: getVisa.data
    }
  },
  methods: {
    nameWithLang ({ name, id }) {
            return `${name}`
        },
    nameWithLang1 ({ profession, id }) {
            return `${profession}`
        },
    async search() {
      this.arrayJobNew = []
      console.log(this.work_form.length)
      let getTinTuyenDungNew = await this.$axios.$get('searchJobs?currency='+(this.currency == '' || this.currency == null ? '' : this.currency)
                                                  +(this.chooseWork != '' && this.chooseWork != null ? '&work_form='+this.chooseWork.id : '')
                                                  +(this.salary_start != '' ? '&salary_start='+this.salary_start : '')
                                                  +(this.salary_end != '' ? '&salary_end='+this.salary_end : '')
                                                  +(this.chooseVisa != '' && this.chooseVisa != null ? '&id_visa='+this.chooseVisa.id : ''))
      this.arrayJobNew = getTinTuyenDungNew.data
    }
  },
  mounted(){

  }
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