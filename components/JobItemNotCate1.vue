<template>
    <div class="ecommerce-card border-job-item make-it-sl" style="margin-bottom: 15px;border-radius: 3px;" :class="job.highlight_job ? 'highlight' : ''">
        <div class="card-content h-100">
            <div class="text-center p-1">
                <a :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img :src="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" height="100%" :alt="`${job.user.avatar}`" style="object-fit: scale-down; max-height: 100px; max-width: 100%;">
                </a>
            </div>
            <div class="remove-border-right" style="width: 195px">
                <div class="remove-border-right" style="padding: 5px 0px;">
                    
                    <a class="item-vip-a el-1" :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                </div>
                <div class="item-name">
                    <a :href="`/cong-ty/${job.nb_company ? job.nb_company.username : '#'}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.user.name }}</span></a>
                </div>
                <!-- <div class="item-quantity d-flex justify-content-between">
                    <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-location-arrow"></i> {{ job.nation.name }}</p>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-calendar-star"></i> {{ ConvertDate(job.expiration_date) }}</p>
                </div> -->
                <div class="item-quantity d-flex justify-content-between">
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="mức lương" :style="[job.highlight_job ? {'color': '#fc205c'} : '']"><i class="fad fa-funnel-dollar"></i> {{ FormatPrice(job.salary_start) }}{{ job.currency }} ~ {{ FormatPrice(job.salary_end) }}{{ job.currency }}</p>
                    <!-- <p class="delivery-date m-0" data-toggle="tooltip" data-placement="top" title="Số lượng tuyển"><i class="fad fa-user-friends"></i> {{job.quantity}}</p> -->
                </div>
                <div class="item-quantity mb-1">
                    
                    <span class="item-hot mr-1" style="font-size: 1rem; float: left"  v-if="job.highlight_job == 2"><i class="fas fa-star" style="color: gold;"></i> Hot</span>
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="">
                        <a :href="job.type == 1 ? '/tin-tuyen-sinh/tim-kiem?keyword=&type=1' : job.type == 2 ? '/tin-tuyen-sinh/tim-kiem?keyword=&type=2' : '/tin-tuyen-sinh/tim-kiem?keyword=&type=3'">
                            <span class="badge border-netbee badge-sm" style="width: 100px">
                                {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học sinh' : 'Tu nghiệp sinh' }}
                            </span>
                        </a>
                    </p>
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
<style scoped>
.item-vip-a{
    font-weight: 600;
    font-size: 16px;
}
.highlight{
    border-left: 2px solid #ffb701 !important;
}

.border-job-item:hover{
    background-color: #ffb7012b;
}

.ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid !important;
    grid-template-columns: 2fr 3fr !important;
}

.el-1{
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 30px;
    white-space: normal;
}
</style>