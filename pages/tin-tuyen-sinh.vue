<template>
  <div class="container">
    <!-- VIỆC LÀM MỚI -->
    <div class="banner-tt">
      <div class="litss">
        <div class="img-logoo">
          <img id="hmt" src="/app-assets/images/logo/homt.png" alt="branding logo" />
        </div>
        <div class="float-lerft-a">
          <h3 style="display: contents;">Gửi tôi việc tương tự</h3>
          <a href="#follow" class="btn btn-outline-primary">Nhận thông báo</a>
        </div>
        <!-- <div class="float-right-a">
          <span style=" margin-right: 14px; color: BLACK; font-size: 17px;">Sắp xếp theo</span>
          <select id="cars" name="cars">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div> -->
      </div>
    </div>
    <section>
      <div class="row">
        <div class="col-lg-8 col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                <i class="fad fa-bullhorn"></i> VIỆC LÀM MỚI
              </h4>
              <a class="heading-elements-toggle">
                <i class="fa fa-ellipsis-v font-medium-3"></i>
              </a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li>
                    <a data-action="expand">
                      <i class="feather icon-maximize"></i>
                    </a>
                  </li>
                  <li>
                    <a data-action="close">
                      <i class="feather icon-x"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1Col :DataList="arrayJobNew"></JobsList1Col>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                <i class="fad fa-bullhorn"></i> VIỆC LÀM HOT NHẤT
              </h4>
              <a class="heading-elements-toggle">
                <i class="fa fa-ellipsis-v font-medium-3"></i>
              </a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li>
                    <a data-action="expand">
                      <i class="feather icon-maximize"></i>
                    </a>
                  </li>
                  <li>
                    <a data-action="close">
                      <i class="feather icon-x"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1ColNotCate :DataList="arrayJobNew"></JobsList1ColNotCate>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- VIỆC LÀM mới -->
    <section>
      <div class="row">
        <div class="col-lg-4 col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                <i class="fad fa-bullhorn"></i> XUẤT KHẨU LAO ĐỘNG
              </h4>
              <a class="heading-elements-toggle">
                <i class="fa fa-ellipsis-v font-medium-3"></i>
              </a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li>
                    <a data-action="expand">
                      <i class="feather icon-maximize"></i>
                    </a>
                  </li>
                  <li>
                    <a data-action="close">
                      <i class="feather icon-x"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1ColNotCate :DataList="arrayJobXKLD"></JobsList1ColNotCate>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                <i class="fad fa-bullhorn"></i> DU HỌC SINH
              </h4>
              <a class="heading-elements-toggle">
                <i class="fa fa-ellipsis-v font-medium-3"></i>
              </a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li>
                    <a data-action="expand">
                      <i class="feather icon-maximize"></i>
                    </a>
                  </li>
                  <li>
                    <a data-action="close">
                      <i class="feather icon-x"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1ColNotCate :DataList="arrayJobDHS"></JobsList1ColNotCate>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                <i class="fad fa-bullhorn"></i> TU NGHIỆP SINH
              </h4>
              <a class="heading-elements-toggle">
                <i class="fa fa-ellipsis-v font-medium-3"></i>
              </a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li>
                    <a data-action="expand">
                      <i class="feather icon-maximize"></i>
                    </a>
                  </li>
                  <li>
                    <a data-action="close">
                      <i class="feather icon-x"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <JobsList1ColNotCate :DataList="arrayJobTNS"></JobsList1ColNotCate>
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
export default {
  head: {
    title: "Tin tuyển sinh mới nhất,tin tuyển dụng du học,tin xuất khẩu lao động mới nhất",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "Tin tuyển sinh mới nhất,tin tuyển dụng du học,tin xuất khẩu lao động mới nhất" }
    ]
  },
  components: {
    JobsList1Col,
    JobsList1ColNotCate
  },
  async asyncData({$axios, route}) {
    let getTinTuyenDungNew = await $axios.$get(`getTinTuyenDungNew?limit=20&type=0`)
    let getTinTuyenDungXKLD = await $axios.$get(`getTinTuyenDungNew?limit=20&type=1`)
    let getTinTuyenDungDHS = await $axios.$get(`getTinTuyenDungNew?limit=20&type=2`)
    let getTinTuyenDungTNS = await $axios.$get(`getTinTuyenDungNew?limit=20&type=3`)
    return {
        arrayJobNew: getTinTuyenDungNew.data.tintuyendung,
        arrayJobXKLD: getTinTuyenDungXKLD.data.tintuyendung,
        arrayJobDHS: getTinTuyenDungDHS.data.tintuyendung,
        arrayJobTNS: getTinTuyenDungTNS.data.tintuyendung,
    }
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