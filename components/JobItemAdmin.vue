<template>
    <div class="ecommerce-card border-job-item make-it-sl" style="height:140px;margin-bottom: 15px;border-radius: 3px;background: #fff" :class="job.highlight_job ? 'highlight' : ''">
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
            <div class="text-center card-avatar p-1">
                <a :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img v-lazy="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" height="100%" :alt="`${job.user.avatar}`">
                </a>
            </div>
            <div class="remove-border-right" style="width: 550px;">
                <div class="remove-border-right" style="padding: 20px 0 0 0;width: 550px;">
                    <a class="item-vip-a" :href="`/admin/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                </div>
                <div class="item-quantity row" style="height: 21px">
                    <div class="col-9">
                        <a :href="`/cong-ty/${job.user ? job.user.name : job.id_created}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.user.name }}</span></a>
                    </div>
                    <div class="col-3">
                        <p class="delivery-date" data-toggle="tooltip" data-placement="left" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                </div>
                    </div>
                <div class="item-quantity row">
                    <div class="col-9">
                        <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fa fa-map-marker-alt"></i> {{ job.nation.name }}</p>
                    </div>
                    <div class="col-3">
                        <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fa fa-clock"></i> {{ ConvertDate(job.expiration_date) }}</p>
                    </div>
                </div>
                <div class="item-quantity row">
                    <div class="col-9">
                        <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="mức lương" >Chi phí: <span :style="[job.highlight_job ? {'color': '#fc205c'} : '']">{{ FormatPrice(job.salary_start) }}{{ job.currency }} ~ {{ FormatPrice(job.salary_end) }}{{ job.currency }}</span></p>
                    </div>
                    <div class="col-3">
                        <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Số lượng tuyển">
                            <span class="badge border-netbee badge-sm" style="width: 100px">
                                {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học sinh' : 'Tu nghiệp sinh' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="item-options text-center" style="padding: 2rem">
                <div class="hot" v-if="job.highlight_job == 2"><img src="/assets/img/hot.png"></div>
                <div class="item-wrapper mt-1">
                    <div class="item-cost mt-1" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 1">
                        <p class="m-0">TIỀN THƯỞNG</p>
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
.fa, .fas {
    font-family: 'Font Awesome 5 Pro';
    font-weight: 900;
}
.item-vip-a{
    font-weight: 600;
    font-size: 16px;
}
/* .item-vip-a:hover{
    color: #000 !important;
} */
.highlight{
    border-left: 2px solid #ffb701 !important;
}

.border-job-item:hover{
    /* background-color: #ffb7012b; */
}

.ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid;
    grid-template-columns: 1fr 4fr 2fr;
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
    width: 3%;
    float: right;
    position: absolute;
    right: 15px;
    top: 0;
}
.p-r-0 .hot img{
    right: 0;
}
.card-avatar {
    height: 85px;
    width: 85px;
}
.card-avatar img{
    object-fit: scale-down; 
}
</style>