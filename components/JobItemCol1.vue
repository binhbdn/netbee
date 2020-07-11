<template>
    <div class="ecommerce-card border-job-item make-it-sl" style="margin-bottom: 15px; border-radius: 3px;" :class="job.highlight_job ? 'highlight' : ''">
        <div class="card-content h-100">
            <div class="text-center card-avatar p-1">
                <a :href="`/${type}tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img v-lazy="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" height="100%" :alt="`${job.user.avatar}`">
                </a>
            </div>
            <div class="remove-border-right" style="margin: auto; width: 100%;">
                <a class="item-vip-a" :href="`/${type}tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" style="max-width:100%;" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                <div class="item-name">
                    <a :href="`/cong-ty/${job.nb_company ? job.nb_company.username : '#'}`" class="item-company mb-0"><i class="fa fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.nb_company ? job.nb_company.username : job.user.name }}</span></a>
                </div>
                <div class="item-quantity d-flex justify-content-between">
                    <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fa fa-map-marker-alt"></i> {{ job.nation.name }}</p>
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fa fa-clock"></i> {{ ConvertDate(job.expiration_date) }}</p>
                </div>
                <div class="item-price d-flex justify-content-between">
                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="chi phí"><label class="title">Chi phí: </label> <span :style="[job.highlight_job ? {'color': '#fc205c'} : '']">{{ FormatPrice(job.subsidy) }} {{ job.currency }}</span></p>
                </div>
            </div>
            <div class="item-options text-center mt-1" >
                <div class="hot" v-if="job.highlight_job == 2"><img src="/assets/img/hot.png"></div>
                <div class="item-wrapper" style="margin-top: -5px;">
                    <a class="delivery-date mb-0 mt-1 badge border-netbee badge-sm" style="width: 100px" :href="job.type == 1 ? `/${type}tin-tuyen-sinh/tim-kiem?keyword=&type=1` : job.type == 2 ? `/${type}tin-tuyen-sinh/tim-kiem?keyword=&type=2` : `/${type}tin-tuyen-sinh/tim-kiem?keyword=&type=3`">
                        {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học sinh' : 'Tu nghiệp sinh' }}
                    </a>
                    <p class="delivery-date mg-top-5" data-toggle="tooltip" data-placement="top" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
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
    props: ['job', 'type']
}
</script>
<style scoped>
.item-vip-a{
    max-width: 250px;
    font-weight: 500;
    font-size: 14px;
}

.highlight{
    border-left: 2px solid #ffb701 !important;
}

.border-job-item:hover{
    /* background-color: #ffb7012b; */
}
.ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid;
    grid-template-columns: 0.7fr 3fr 2fr;
}
.exam-jobs .card-content{
    grid-template-columns: 0.26fr 3fr 2fr !important;
}
.mg-top-5{
    margin-top: 5px;
    margin-bottom: 0px;
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
    width: 5%;
    float: right;
    position: absolute;
    right: 15px;
    top: 0;
}
.card-avatar {
    margin: auto;
}
.card-avatar img {
    object-fit: scale-down;
    height: 60px; 
    width: 60px;
}
.item-price .title {
    font-size: 14px;
}
.remove-border-right {
    padding: 10px 10px 10px 0px;
}
@media(max-width: 768px) {
    .item-vip-a{
        white-space: nowrap; 
        max-width: 250px !important; 
        overflow: hidden;
        text-overflow: ellipsis; 
    }
    .item-options {
        display: none;
    }
}
@media(max-width: 376px) {
    .item-vip-a{
        max-width: 200px !important;
    }
}
</style>