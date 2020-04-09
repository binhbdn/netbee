<template>
    <div class="card ecommerce-card border-job-item">
        <div class="card-content">
            <div class="item-img text-center">
                <a href="app-ecommerce-details.html">
                    <img src="/app-assets/images/pages/eCommerce/9.png" alt="img-placeholder" width="128" height="128">
                </a>
            </div>
            <div class="card-body remove-border-right">
                <div class="item-name">
                    <a href="#">Test</a>
                    <p class="item-company"><i class="fal fa-building"></i> <span class="company-name"> Hachinet</span></p>
                </div>
                <div class="item-quantity">
                    <p class="quantity-title"><i class="fal fa-location-arrow"></i> Nhật bản</p>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="delivery-date"><i class="far fa-funnel-dollar"></i> 1000$</p>
                    <p class="delivery-date"><i class="fad fa-calendar-star"></i> 22/02/2021</p>
                </div>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper">
                    <div class="item-rating">
                        <div class="badge badge-danger badge-md">
                            <i class="fal fa-medal"></i>
                        </div>
                    </div>
                    <div class="item-cost">
                        <h6 class="item-price">
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
}
</script>