<template>
  <div>
    <div class="col-md-8">
      <div class="card">
       <div class="col-md-12 reset-paddingg" style="padding-left: 0px">
                <h1 class="NB_main_titlee">
                   Các Công Ty Tuyển Dụng Nổi Bật
                </h1>
            </div>
        <div class="card-content">
          <div class="card-body">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img
                    class="img-fluid"
                    src="app-assets/images/banner/banner-2.jpg"
                    alt="First slide"
                  />
                  <div class="remove-border-rightt">
                    <div class="item-name">
                      <p class="item-company mb-0">
                                             
                        <h2> <i class="fad fa-building"></i>  Hachinet</h2>
                      </p>
                    </div>
                     <div class="item-quantity">
                      <p class="delivery-date" style=""  >
                           IT-phần mềm
                      </p>
                    </div>
                    <div class="item-quantity d-flex justify-content-between">
                      <p class="quantity-title mb-0">
                        <i class="fad fa-location-arrow"></i> Nhật bản
                      </p>
                     
                    </div>
                     <div class="item-quantity d-flex justify-content-between">
                      
                      <p class="delivery-date mb-0">
                        <i class="fad fa-calendar-star"></i> 22/02/2021
                      </p>
                    </div>
                   
                  </div>
                </div>
                <div class="carousel-item">
                  <img
                    class="img-fluid"
                    src="app-assets/images/banner/banner-3.jpg"
                    alt="Second slide"
                  />
                  <div class="remove-border-rightt">
                    <!-- item-slide -->
                    <div class="item-name">
                      <p class="item-company mb-0">
                                             
                        <h2> <i class="fad fa-building"></i>  Hachinet</h2>
                      </p>
                    </div>
                     <div class="item-quantity">
                      <p class="delivery-date" style=""  >
                           IT-phần mềm
                      </p>
                    </div>
                    <div class="item-quantity d-flex justify-content-between">
                      <p class="quantity-title mb-0">
                        <i class="fad fa-location-arrow"></i> Nhật bản
                      </p>
                     
                    </div>
                     <div class="item-quantity d-flex justify-content-between">
                      
                      <p class="delivery-date mb-0">
                        <i class="fad fa-calendar-star"></i> 22/02/2021
                      </p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <img
                    class="img-fluid"
                    src="app-assets/images/banner/banner-1.jpg"
                    alt="Third slide"
                  />
                  <div class="remove-border-rightt">
                    <div class="item-name">
                      <p class="item-company mb-0">
                                             
                        <h2> <i class="fad fa-building"></i>  Hachinet</h2>
                      </p>
                    </div>
                     <div class="item-quantity">
                      <p class="delivery-date" style=""  >
                           IT-phần mềm
                      </p>
                    </div>
                    <div class="item-quantity d-flex justify-content-between">
                      <p class="quantity-title mb-0">
                        <i class="fad fa-location-arrow"></i> Nhật bản
                      </p>
                     
                    </div>
                     <div class="item-quantity d-flex justify-content-between">
                      
                      <p class="delivery-date mb-0">
                        <i class="fad fa-calendar-star"></i> 22/02/2021
                      </p>
                    </div>
                  </div>
                   <!-- end item-slide -->
                </div>
              </div>
              <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section>
      <div class="row">
        <div class="col-lg-8 col-12 p-r-0">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Các Công Ty Đang Tuyển Dụng</h4>
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
                <CompanyList1 :DataList="arrayCompa"></CompanyList1>
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

  data() {
    return {
      arrayCompa: [
        { id: 1, title: "Tên cty 1" },
        { id: 2, title: "Tên cty 2" },
        { id: 3, title: "Tên cty 3" },
        { id: 4, title: "Tên cty 4" },
        { id: 5, title: "Tên cty 5" },
        { id: 6, title: "Tên cty 6" }
      ]
    };
  }
};
</script>
<style>
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
    margin-left: 48px;
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