<template>
    <div class="ecommerce-card border-job-item make-it-sl" style="margin-bottom: 15px; border-radius: 3px;" :class="job.highlight_job ? 'highlight' : ''">
        <div class="card-content h-100">
            <div class="text-center card-avatar p-1">
                <a :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img v-lazy="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" :alt="`${job.user.avatar}`">
                </a>
                <a class="delivery-date mb-0 badge border-netbee badge-sm" style="width: 100px;margin-top: 6px;" :href="job.type == 1 ? '/tin-tuyen-sinh/tim-kiem?keyword=&type=1' : job.type == 2 ? '/tin-tuyen-sinh/tim-kiem?keyword=&type=2' : '/tin-tuyen-sinh/tim-kiem?keyword=&type=3'">
                    {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học' : 'Tu nghiệp sinh' }}
                </a>
            </div>
            <div class="remove-border-right">
                <div class="remove-border-right title-job-hv" style="padding: 5px 0 0 0;">
                    
                    <a class="item-vip-a el-1" :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                </div>
                <div class="item-name">
                    <a :href="`/cong-ty/${job.nb_company ? job.nb_company.username : '#'}`" class="item-company mb-0"><i class="fa fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.nb_company ? job.nb_company.username : job.user.name }}</span></a>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-map-marker-alt"></i> {{ job.nation.name }}</p>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-clock"></i> {{ ConvertDate(job.expiration_date) }}</p>
                </div>
                <div class="d-flex justify-content-between" style="overflow: hidden">
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Chi phí" ><i class="fad fa-dollar-sign" style="color: #000"></i><label class="title">Chi phí: </label> <span :style="[job.highlight_job ? {'color': '#fc205c'} : '']" class="item-price">{{ FormatPrice(job.subsidy) }} {{ job.currency }}</span></p>
                    <!-- <p class="delivery-date m-0" data-toggle="tooltip" data-placement="top" title="Số lượng tuyển"><i class="fad fa-user-friends"></i> {{job.quantity}}</p> -->
                </div>
                <div class="hot" v-if="job.highlight_job == 2" data-toggle="tooltip" data-placement="top" title="Được tài trợ"><img src="/assets/img/hot.png"></div>
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
    font-weight: 500;
    font-size: 14px;
}
/* .item-vip-a:hover{
    color: #000 !important;
} */
.highlight{
    border-left: 4px solid #ffb701 !important;
}

.border-job-item:hover{
    /* background-color: #ffb7012b; */
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
.hot{
    color: #fff;
    text-transform: uppercase;
    z-index: 2;
    font-size: 9px;
    border-radius: 2px;
    right: 10px;
    font-weight: 700;
}
.hot img {
    width: 8%;
    float: right;
    position: absolute;
    right: 15px;
    top: 0;
}
.item-price .title {
    font-size: 14px;
}
.card-avatar {
    margin: auto;
}
.card-avatar img {
    object-fit: scale-down;
    height: 60px; 
    width: 60px;
}
@media (max-width: 575px){
    .card-avatar{
        padding: 0.5rem !important;
    }
    .remove-border-right{
        padding-left: 0;
    }
}
</style>