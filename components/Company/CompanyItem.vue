<template>
    <div class="card border-job-item p-1">
        <div class="row">
            <div class="col-4 col-sm-3 col-lg-2">
                <a :href="`/cong-ty/${company.username ? company.username : '#'}`">
                    <img v-lazy="`/uploads/users/avatars/${company.user.avatar}`" :alt="`${company.user.avatar}`" width="85">
                </a>
            </div>
            <div class="col-8 col-sm-9 col-lg-10 pl-0 pr-2">
                <div>
                    <strong><a class="item-vip-a" :href="`/cong-ty/${company.username ? company.username : '#'}`" :title="`${company.user.name.toUpperCase() }`">{{ company.user.name.toUpperCase() }}</a></strong>
                </div>
                <p class="text-justify" v-html="company.company_about" style="margin-bottom: 10px;"></p>
                <p class="text-justify mb-0"><i class="fad fa-map-marker-alt"></i> {{ company.user.address_detail ? company.user.address_detail : '' }}</p>
            </div>
            <!-- 
            <div class="item-quantity col-12 col-sm-4 col-lg-3">
                <p class="delivery-date pt-1"><i class="fad fa-phone-office"></i> {{ company.company_hotline ? company.company_hotline : '' }}</p>
                <p class="delivery-date"><i class="fad fa-map-marked-alt"></i> {{ company.user.address_detail ? company.user.address_detail : '' }}</p>
            </div>
            -->
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
<style scoped>
a>img {
    position: absolute;
    margin: 0;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
p.text-justify {
    max-height: 4.5rem;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}
p.mb-0 {
    white-space: nowrap;
}
</style>