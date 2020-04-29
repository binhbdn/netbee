<template>
  <div class="container">
    <section>
      <div class="row carousel-1">
        <div class="col-8 p-r-0">
          <div
            class="card-header d-flex justify-content-center align-items-center"
            style="background: #ffb701;padding: 5px"
          >
            <h4 class="card-title">CÁC CÔNG TY NỔI BẬT</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card-content">
                <div class="card-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                      <div
                        class="carousel-item"
                        :class="{'active' : indexCompanyHot == 0}"
                        v-for="(companyHot, indexCompanyHot) in arrayCompanyHot"
                        :key="indexCompanyHot"
                      >
                        <img
                          class="img-fluid"
                          v-lazy="`/uploads/users/avatars/${companyHot.avatar}`"
                          :alt="`${companyHot.avatar}`"
                        />
                        <div class="remove-border-rightt">
                          <div class="item-name">
                            <a
                              :href="`/cong-ty/${companyHot.company_id}/${ChangeToSlug(companyHot.name)}`"
                              class="item-company mb-0"
                            >
                              <h2>
                                <i class="fad fa-building"></i>
                                {{ companyHot.name }}
                              </h2>
                            </a>
                          </div>

                          <div class="item-quantity d-flex justify-content-between">
                            <p class="quantity-title mb-0">
                              <i class="fad fa-location-arrow"></i>
                              {{ companyHot.address_detail ? companyHot.address_detail : 'Đang cập nhật' }}
                            </p>
                          </div>
                          <div class="item-quantity d-flex justify-content-between">
                            <p class="delivery-date mb-0">
                              <i class="fad fa-calendar-star"></i>
                              {{ companyHot.birth_of_date ? ConvertDate(companyHot.birth_of_date) : 'Đang cập nhật' }}
                            </p>
                          </div>
                          <a
                            class="carousel-control-prev"
                            href="#carousel-example-generic"
                            role="button"
                            data-slide="prev"
                          >
                            <span
                              aria-hidden="true"
                              class="carousel-control-prev-icon"
                              style="background-color: yellow !important;"
                            ></span>
                          </a>
                          <a
                            class="carousel-control-next"
                            href="#carousel-example-generic"
                            role="button"
                            data-slide="next"
                          >
                            <span
                              aria-hidden="true"
                              class="carousel-control-next-icon"
                              style="background-color: yellow !important;"
                            ></span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-content collapse show">
              <div class="card-header">
                <h4>NHÀ TUYỂN DỤNG HÀNG ĐẦU</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div
                    class="col-4"
                    v-for="(companyHot, indexCompanyHot) in arrayCompanyHot"
                    :key="indexCompanyHot"
                  >
                    <a
                      :href="`/cong-ty/${companyHot.company_id}/${ChangeToSlug(companyHot.name)}`"
                      data-toggle="tooltip"
                      data-placement="top"
                      :title="`${companyHot.name}`"
                    >
                      <img
                        v-lazy="`/uploads/users/avatars/${companyHot.avatar}`"
                        :alt="`${companyHot.avatar}`"
                        width="100%"
                      />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="row">
        <div class="col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Các Công Ty Đang Tuyển Dụng</h4>
            </div>
            <div class="card-content collapse show">
              <div class="card-body scrollbar">
                <CompanyList1 :DataList="arrayCompanyNew"></CompanyList1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import CompanyList1 from "~/components/Company/CompanyList1";
export default {
  components: {
    CompanyList1
  },
  created() {
    console.log(this.arrayCompanyHot[0].name);
  },

  async asyncData({ $axios, route }) {
    let getCompanyHot = await $axios.$get(`getCompanyHot`);
    let getCompanyNew = await $axios.$get(`getCompanyNew?limit=0`);
    return {
      arrayCompanyHot: getCompanyHot.data,
      arrayCompanyNew: getCompanyNew.data
    };
  }
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
</style>