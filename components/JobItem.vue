<template>
    <div class="card ecommerce-card border-job-item" style="height: 100px;margin-bottom: 15px;">
        <div class="card-content">
            <div class="remove-border-right" style="width: 60vh;padding: 5px 25px;" data-toggle="tooltip" data-placement="top" title="Đăng ký nhận bản tin du học sad ád ád ád ád ád ád ád sa fsdfsf sdfsdfs Cộng đồng chuyên viên tuyển sinh lớn nhất">
                <a class="item-vip-a" href="#">{{ title }}</a>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper" style="position: unset">
                    <div class="item-rating job-vip">
                        <i class="fas fa-star" style="color: yellow;position: absolute;right: 10px;top: -40px;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="item-img text-center">
                <a href="app-ecommerce-details.html">
                    <img src="/app-assets/images/pages/eCommerce/9.png" alt="img-placeholder" width="55" height="55">
                </a>
            </div>
            <div class="remove-border-right">
                <div class="item-name"  data-toggle="tooltip" data-placement="right" title="Công ty Hachinet">
                    <p class="item-company mb-0"><i class="fal fa-building"></i> <span class="company-name"> Hachinet</span></p>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="quantity-title mb-0"><i class="fal fa-location-arrow"></i> Nhật bản</p>
                    <p class="delivery-date mb-0"><i class="fad fa-calendar-star"></i> 22/02/2021</p>
                </div>
                <div class="item-quantity ">
                    <p class="delivery-date"><i class="far fa-funnel-dollar"></i> 1.000.000đ ~ 20.000.000d</p>
                </div>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper">
                    <div class="item-cost">
                        <h6 class="badge background-default badge-md">
                           Xuất khẩu lao động
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    head: {
        link: [
            { rel: 'stylesheet', href: '/app-assets/css/pages/app-ecommerce-shop.css' },
        ],
    },
    props: ['id','title']
}
</script>