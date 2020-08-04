<template>
    <div class="card ecommerce-card border-job-item" style="padding:10px;">
        <div class="card-content col-sm-12" style="display:flex;">
            <div class="card-content col-sm-2" style="margin:auto;">
                <a :href="`/cong-ty/${company.username ? company.username : '#'}`">
                    <img v-lazy="`/uploads/users/avatars/${company.user.avatar}`" :alt="`${company.user.avatar}`" width="100" height="100">
                </a>
            </div>
            <div class="item-quantity col-sm-7" style="margin:auto;">
                <div class="card-content col-sm-12">
                    <strong><a class="item-vip-a" :href="`/cong-ty/${company.username ? company.username : '#'}`" data-toggle="tooltip" data-placement="top" :title="`${company.name}`">{{ company.user.name }}</a></strong>
                </div>
                <p class="delivery-date" style="overflow: hidden;text-overflow: ellipsis;height: 81px;padding: 15px;padding-top:0px;text-align:justify;margin-bottom: 0px !important; margin:auto;margin-bottom: 4px !important;" v-html="company.company_about"></p>
            </div>
            <div class="item-quantity col-sm-3" style="margin:auto;">
                <p class="delivery-date"><i class="fad fa-phone-office"></i> {{ company.company_hotline ? company.company_hotline : '' }}</p>
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