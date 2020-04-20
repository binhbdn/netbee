<template>
    <div class="card ecommerce-card border-job-item" style="height: 100px;margin-bottom: 15px;">
        <div class="card-content">
            <div class="remove-border-right" style="width: 60vh;padding: 5px 25px;">
                <a class="item-vip-a" :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">{{ job.title }}</a>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper" style="position: unset">
                    <div class="item-rating job-vip" v-if="job.highlight_job">
                        <i class="fas fa-star" style="color: yellow;position: absolute;right: 2px;top: -30px;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div style="margin: 0 auto;">
                <a :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img v-lazy="`/uploads/users/avatars/${job.avatar}`" :alt="`${job.avatar}`" width="55" height="55">
                </a>
            </div>
            <div class="remove-border-right">
                <div class="item-name">
                    <p class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.name}`"> {{ job.name }}</span></p>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="quantity-title mb-0"><i class="fad fa-location-arrow"></i> {{ job.nation_name }}</p>
                    <p class="delivery-date mb-0"><i class="fad fa-calendar-star"></i> {{ job.expiration_date }}</p>
                </div>
                <div class="item-quantity ">
                    <p class="delivery-date" :style="[job.highlight_job ? {'color': '#fc205c'} : '']"><i class="fad fa-funnel-dollar"></i> {{ job.salary_start }}{{ job.currency }} ~ {{ job.salary_end }}{{ job.currency }}</p>
                </div>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper">
                    <div class="item-cost">
                        <h6 class="badge background-default badge-sm">
                           {{ job.type == 1 ? 'xuất khẩu lao động' : job.type == 2 ? 'du học sinh' : 'tu nghiệp sinh' }}
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
    props: ['job']
}
</script>