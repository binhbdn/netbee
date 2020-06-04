<template>
  <div class="container">
    <!-- VIỆC LÀM MỚI -->
    <section>
      <div class="row">
        <div class="col-lg-4 col-12 pr-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><i class="fas fa-briefcase"></i> TÌM KIẾM NÂNG CAO</h4>
            </div>
            <div class="card-content show">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <Multiselect v-model="maleFemale" :options="sex" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn giới tính" ></Multiselect>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <Multiselect v-model="birthday_year" :options="getYears" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn năm sinh" ></Multiselect>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <Multiselect v-model="level_education" :options="level" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn trình độ" ></Multiselect>
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
                <i class="fad fa-business-time"></i> {{$t('job.title.new')}}
              </h4>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
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
      listCvs: [],
      maleFemale: '',
      level_education: '',
      address_profile: '',
      birthday_year: '',
      years: [],
      sex: [
        'Nam', 
        'Nữ'
      ],
      level: [
        'Đại học',
        'Cao đẳng',
        'Trung cấp',
        '12/12',
        'Thấp hơn'
      ],
    }
  },
  components: {
    JobsList1Col,
    JobsList1ColNotCate, Multiselect
  },
  async asyncData({$axios, route}) {
    let getTinTuyenDungNew = await $axios.$get(`getTinTuyenDungNew?limit=20&type=0`)
    let getTinTuyenDungXKLD = await $axios.$get(`getTinTuyenDungNew?limit=20&type=1`)
    let getTinTuyenDungDHS = await $axios.$get(`getTinTuyenDungNew?limit=20&type=2`)
    let getTinTuyenDungTNS = await $axios.$get(`getTinTuyenDungNew?limit=20&type=3`)
    let getTinTuyenDungHot = await $axios.$get(`getTinTuyenDungHot?limit=10`)
    let searchCvs = await $axios.$get('searchCvs?search='
      +(route.query.keyword != null ? route.query.keyword : '')
    )
    return {
        arrayJobNew: getTinTuyenDungNew.data.tintuyendung,
        arrayJobXKLD: getTinTuyenDungXKLD.data.tintuyendung,
        arrayJobDHS: getTinTuyenDungDHS.data.tintuyendung,
        arrayJobTNS: getTinTuyenDungTNS.data.tintuyendung,
        arrayJobHot: getTinTuyenDungHot.data.tintuyendung,
        arrayCvs: searchCvs.data
    }
  },
  computed: {
    getYears(){
      let yearStart = 1970;
      let yearEnd = 2020;
      let years = Array(yearEnd-yearStart+1)
        .fill()
        .map(() => yearStart++);
      return years;
    },
  },

  methods: {
    nameWithLang ({ name, id }) {
      return `${name}`
    },
    async search() {
      let getCvs = await this.$axios.$get('searchCvs?search='
        +(this.level_education != '' ? '&searchLevel=' + this.level_education : '')
        +(this.birthday_year != '' ? '&birthday_year=' + this.birthday_year : '')
        +(this.maleFemale != '' ? '&maleFemale=' + this.maleFemale : '')
      )
      this.arrayCvs = getCvs.data;
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