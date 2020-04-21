<template>
    <div class="card ecommerce-card border-job-item" style="height: 100px;margin-bottom: 15px;">
        <div class="card-content">
            <div class="remove-border-right" style="width: 60vh;padding: 5px 25px;">
                <a class="item-vip-a" href="#" data-toggle="tooltip" data-placement="top" title="">{{ title }}</a>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper" style="position: unset">
                    <div class="item-rating job-vip">
                        <i class="fas fa-star" style="color: yellow;position: absolute;right: 2px;top: -30px;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div style="margin: 0 auto;">
                <a href="app-ecommerce-details.html">
                    <img v-lazy="`/app-assets/images/pages/eCommerce/9.png`" alt="img-placeholder" width="55" height="55">
                </a>
            </div>
            <div class="remove-border-right">
                <div class="item-name">
                    <p class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" title="Công ty Hachinet"> Hachinet</span></p>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="quantity-title mb-0"><i class="fad fa-location-arrow"></i> Nhật bản</p>
                    <p class="delivery-date mb-0"><i class="fad fa-calendar-star"></i> 22/02/2021</p>
                </div>
                <div class="item-quantity ">
                    <p class="delivery-date"><i class="fad fa-funnel-dollar"></i> IT-phần mềm</p>
                </div>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper">
                    <div class="item-cost">
                        <h6 class="badge background-default badge-sm">
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