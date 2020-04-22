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
        <div class="card-content" style="grid-template-columns: 3fr 6fr 1fr;">
            <div style="margin: 0 auto;">
                <a :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img v-lazy="`/uploads/users/avatars/${job.avatar}`" :alt="`${job.avatar}`" width="55" height="55">
                </a>
            </div>
            <div class="remove-border-right">
                <div class="item-name">
                    <a :href="`/cong-ty/${job.id_created}/${ChangeToSlug(job.name)}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name"  data-toggle="tooltip" data-placement="right" :title="`${job.name}`"> {{ job.name }}</span></a>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-location-arrow"></i> {{ job.nation_name }}</p>
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-calendar-star"></i> {{ ConvertDate(job.expiration_date) }}</p>
                </div>
                <div class="item-quantity ">
                    <p class="delivery-date" data-toggle="tooltip" data-placement="top" title="mức lương" :style="['font-size: 13px',job.highlight_job ? {'color': '#fc205c'} : '']"><i class="fad fa-funnel-dollar"></i> {{ FormatPrice(job.salary_start) }}{{ job.currency }} ~ {{ FormatPrice(job.salary_end) }}{{ job.currency }}</p>
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