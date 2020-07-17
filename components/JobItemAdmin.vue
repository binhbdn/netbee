<template>
    <div class="ecommerce-card border-job-item make-it-sl" style="margin-bottom: 15px;border-radius: 3px;background: #fff" :class="job.highlight_job ? 'highlight' : ''">
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
            <div class="text-center card-avatar">
                <a :href="`/admin/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img v-lazy="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" height="100%" :alt="`${job.user.avatar}`">
                </a>
                <p class="delivery-date mb-0 cate-bottom-avt" data-toggle="tooltip" data-placement="top" title="Loại hình tuyển dụng">
                    <span class="badge border-netbee badge-sm" style="width: 100px" :class="job.highlight_job ? 'bg-netbee' : ''">
                        {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học' : 'Tu nghiệp sinh' }}
                    </span>
                </p>
            </div>
            <div class="remove-border-right" style="width: 620px; padding: 0.5rem">
                <div class="hot-mb" v-if="job.highlight_job == 2"><img src="/assets/img/hot.png"></div>
                    <a class="item-vip-a" :href="`/admin/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                <div class="item-quantity row" id="company" style="height: 21px" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 3">
                    <div class="col-md-7 col-12">
                        <a :href="`/cong-ty/${job.user ? job.user.name : job.id_created}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.nb_company.username }}</span></a>
                    </div>
                    <div class="col-md-5 col-12">
                        <p class="delivery-date" data-toggle="tooltip" data-placement="left" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                    </div>
                </div>
                <div class="item-quantity row" id="company" style="height: 21px" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 1">
                    <div class="col-md-7 col-12">
                        <a :href="`/cong-ty/${job.user ? job.user.name : job.id_created}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.nb_company.username }}</span></a>
                    </div>
                    <div class="col-md-5 col-12">
                        <p class="delivery-date" data-toggle="tooltip" data-placement="left" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                    </div>
                </div>
                <div class="item-quantity row">
                    <div class="col-md-7 col-12">
                        <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-map-marker-alt"></i> {{ job.nation.name }}</p>
                    </div>
                    <div class="col-md-5 col-12" id="date-deline">
                        <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-clock"></i> {{ ConvertDate(job.expiration_date) }}</p>
                    </div>
                </div>
                <div class=" row" id="price">
                    <div class="col-md-7 col-12 pr-0">
                        <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Chi phí" ><i class="fad fa-dollar-sign"></i> Chi phí: <span class="item-price" :style="[job.highlight_job ? {'color': '#fc205c'} : '']"> {{ FormatPrice(job.subsidy) }} {{ job.currency }}</span></p>
                    </div>
                    <div class="col-md-5 col-12">
                        <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Loại hình tuyển dụng">
                            <span class="badge border-netbee badge-sm" style="width: 100px" :class="job.highlight_job ? 'bg-netbee' : ''">
                                {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học' : 'Tu nghiệp sinh' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="bonus-block">
                    <i class="m-0">Tiền thưởng</i>
                    <h3 class="bonus">
                        <p style="color: #fc205c">{{FormatPrice(job.bonus)}}{{ job.currency }} / <i class="fad fa-user-friends" title="1 người"></i> </p>
                    </h3>
                </div>
            </div>
            <div class="item-options text-center" style="padding: 1rem">
                <div class="hot" v-if="job.highlight_job == 2" data-toggle="tooltip" data-placement="top" title="Được tài trợ"><img src="/assets/img/hot.png"></div>
                <div class="item-wrapper mt-1">
                    <div class="item-cost mt-1" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 1">
                        <i class="m-0">Tiền thưởng</i>
                        <h3 class="bonus">
                            <p style="color: #fc205c">{{formatPriceBonus(job.bonus - (job.bonus * settingBonus.percent_bonus /100))}}{{ job.currency }} / <i class="fad fa-user-friends" title="1 người"></i> </p>
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
    props: ['job', 'settingBonus'],
}
</script>
<style scoped>
.fa, .fas {
    font-family: 'Font Awesome 5 Pro';
    font-weight: 900;
}
.item-vip-a{
    font-size: 13px;
}
p {
    font-size: 13px;
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
    grid-template-columns: 0.3fr 4fr 2fr;
}

.hot, .hot-mb{
    color: #fff;
    text-transform: uppercase;
    z-index: 2;
    font-size: 9px;
    border-radius: 2px;
    right: 10px;
    font-weight: 700;
}
.hot img, .hot-mb img {
    width: 2%;
    min-width: 35px;
    float: right;
    position: absolute;
    right: 14px;
    top: 0;
}
.p-r-0 .hot img{
    right: 0;
}
.card-avatar {
    margin: auto;
}
.card-avatar img{
    height: 60px;
    width: 60px;
    object-fit: scale-down;
}
.item-price .title {
    font-size: 14px;
}
.bonus-block, .hot-mb{
    display: none;
}

@media(max-width: 1199px){
    .remove-border-right{

        width: auto!important;
    }
    .item-options{
        padding: 1rem 0;
    }
    .bonus{
        font-size: 1rem;
    }
}
@media(max-width: 991px) and (min-width: 768px){
    .remove-border-right{
        max-width: 330px !important;
    }
}

@media(max-width: 767px) and (min-width: 576px){
    #company{
        height: 42px !important;
        position: relative;
    }
    .item-options{
        display: none;
    }
    .card-content{
        grid-template-columns: 1fr 4fr 0 !important;
    }
    .remove-border-right{
        width: auto !important;
        max-width: 500px !important;
    }
    .bonus-block{
        display: block;
        position: absolute;
        top: 58px;
        left: 420px;
    }
    .hot-mb{
        display: block;
    }
    .hot-mb img{
        right: 15px;
    }
}

.cate-bottom-avt {
    display: none;
}
@media only screen and (max-width: 575px) {
    .remove-border-right{
        overflow: hidden;
    }
    .bonus-block{
        display: block;
    }
    .hot-mb{
        display: none;
    }
    #company {
        height: 42px !important;
        display: none;
    }
    .ecommerce-card {
        margin-bottom: 0 !important;
        border-radius: 0 !important;
    }
    .border-job-item {
        border: none;
        border-bottom: 1px solid #ececec !important;
    }
    .cate-bottom-avt {
        display: block;
    }
    #price div:last-child {
        display: none;
    }
    .card-avatar {
        padding-left: 20px;
    }
    .item-vip-a {
        overflow: hidden;
        white-space: unset;
    }
    p {
        font-size: 13px;
    }
    #date-deline {
        display: none;
    }
}
</style>