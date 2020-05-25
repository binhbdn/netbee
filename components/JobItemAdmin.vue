<template>
    <div class="ecommerce-card border-job-item make-it-sl" style="height:140px;margin-bottom: 15px;" :class="job.highlight_job ? 'highlight' : ''">
        <!-- <div class="card-content">
            <div class="remove-border-right" style="width: 60vh;padding: 5px 25px;">
                <a class="item-vip-a" :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">{{ job.title }}</a>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper" style="position: unset">
                    <div class="item-rating job-vip" v-if="job.highlight_job == 2">
                        <i class="fas fa-star" style="color: yellow;position: absolute;right: 2px;top: -30px;"></i>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="card-content h-100">
            <div class="text-center p-1">
                <a :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img v-lazy="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" height="100%" :alt="`${job.user.avatar}`" style="object-fit: scale-down; max-height: 100%; max-width: 100%;">
                </a>
            </div>
            <div class="remove-border-right" style="width: 550px;">
                <div class="remove-border-right" style="padding: 5px 0px;width: 550px;">
                    
                    <a class="item-vip-a" :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                </div>
                <div class="item-name">
                    <a :href="`/cong-ty/${job.user ? job.user.name : job.id_created}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.user.name }}</span></a>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-location-arrow"></i> {{ job.nation.name }}</p>
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-calendar-star"></i> {{ ConvertDate(job.expiration_date) }}</p>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="mức lương" :style="[job.highlight_job ? {'color': '#fc205c'} : '']"><i class="fad fa-funnel-dollar"></i> {{ FormatPrice(job.salary_start) }}{{ job.currency }} ~ {{ FormatPrice(job.salary_end) }}{{ job.currency }}</p>
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Số lượng tuyển">
                        <span class="badge background-default badge-sm" style="width: 100px">
                            {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học sinh' : 'Tu nghiệp sinh' }}
                        </span>
                    </p>
                </div>
                <div class="item-quantity ">
                    <p class="delivery-date" data-toggle="tooltip" data-placement="left" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                </div>
            </div>
            <div class="item-options text-center" >
                <div class="item-wrapper mt-1">
                    <span class="item-hot" v-if="job.highlight_job == 2"><i class="fas fa-star" style="color: gold; "></i> Hot</span>
                    <div class="item-cost mt-1" v-if="job.bonus != 0 && job.bonus != null">
                        <p class="m-0">Tiền thưởng</p>
                        <h3>
                            <span style="color: #fc205c">{{FormatPrice(job.bonus)}}{{ job.currency }} / <i class="fad fa-user-friends" title="1 người"></i> </span>
                        </h3>
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
    props: ['job'],
}
</script>
<style scoped>
.item-vip-a{
    font-weight: 600;
    font-size: 20px;
}
.highlight{
    border-left: 4px solid #ffb701 !important;
}

.border-job-item:hover{
    background-color: #ffb7012b;
}

.ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid;
    grid-template-columns: 1fr 4fr 2fr;
}

</style>