<template>
    <div class="card ecommerce-card border-job-item" style="padding:10px;">
        <div class="row card-content d-flex">
            <div class="card-content col-4 col-sm-3 col-lg-2">
                <a :href="`/cong-ty/${company.username ? company.username : '#'}`">
                    <img v-lazy="`/uploads/users/avatars/${company.user.avatar}`" :alt="`${company.user.avatar}`" width="100" height="100">
                </a>
            </div>
            <div class="item-quantity col-8 col-sm-5 col-lg-7">
                <div class="card-content px-1 pt-1">
                    <strong><a class="item-vip-a" :href="`/cong-ty/${company.username ? company.username : '#'}`" data-toggle="tooltip" data-placement="top" :title="`${company.name}`">{{ company.user.name }}</a></strong>
                </div>
                <p class="delivery-date px-1" v-html="company.company_about"></p>
            </div>
            <div class="item-quantity col-12 col-sm-4 col-lg-3">
                <p class="delivery-date pt-1"><i class="fad fa-phone-office"></i> {{ company.company_hotline ? company.company_hotline : '' }}</p>
                <p class="delivery-date"><i class="fad fa-map-marked-alt"></i> {{ company.user.address_detail ? company.user.address_detail : '' }}</p>
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
    props: ['company']
}
</script>