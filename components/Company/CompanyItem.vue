<template>
    <div class="card ecommerce-card border-job-item" style="height: 133px;margin-bottom: 15px;">
        <div class="card-content">
            <div class="remove-border-right" style="width: 60vh;padding: 5px 25px;">
                <a class="item-vip-a" :href="`/cong-ty/${company.username ? company.username : company.id}`" data-toggle="tooltip" data-placement="top" :title="`${company.name}`">{{ company.name }}</a>
            </div>
        </div>
        <div class="card-content">
            <div style="margin: auto;">
                <a :href="`/cong-ty/${company.username ? company.username : company.id}`">
                    <img v-lazy="`/uploads/users/avatars/${company.avatar}`" :alt="`${company.avatar}`" width="100" height="100">
                </a>
            </div>
            <div class="remove-border-right">
                <div class="item-quantity ">
                    <p class="delivery-date" style="overflow: hidden;text-overflow: ellipsis;height: 80px;" v-html="company.company_about"></p>
                </div>
            </div>
            <div class="item-options text-center">
                <div class="item-quantity">
                    <p class="delivery-date"><i class="fad fa-phone-office"></i> {{ company.company_hotline ? company.company_hotline : '' }}</p>
                    <p class="delivery-date"><i class="fad fa-map-marked-alt"></i> {{ company.address_detail ? company.address_detail : '' }}</p>
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
    props: ['company']
}
</script>