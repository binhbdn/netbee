<template>
    <div class="ecommerce-card border-job-item make-it-sl" style="margin-bottom: 15px; border-radius: 3px;" :class="job.highlight_job ? 'highlight' : ''">
        <div class="card-content h-100">
            <div class="text-center card-avatar p-1">
                <a :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                    <img v-lazy="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" height="100%" :alt="`${job.user.avatar}`">
                </a>
                <p class="delivery-date mb-0 cate-bottom-avt" data-toggle="tooltip" data-placement="top" title="Loại hình tuyển dụng">
                    <span class="badge border-netbee badge-sm" style="width: 100px" :class="job.highlight_job ? 'bg-netbee' : ''">
                        {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học' : 'Tu nghiệp sinh' }}
                    </span>
                </p>
            </div>
            <div class="remove-border-right" style="margin: auto; width: 100%;">
                <div class="hot" v-if="job.highlight_job == 2"><img src="/assets/img/hot.png"></div>
                <a class="item-vip-a" :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                <div class="item-name row">
                    <div class="col-sm-7">
                        <a :href="`/cong-ty/${job.nb_company ? job.nb_company.username : '#'}`" class="item-company item-vip-a mb-0" style="font-weight: 400 !important;font-size: 14px !important;"><i class="fa fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.nb_company ? job.nb_company.username : job.user.name }}</span></a>
                    </div>
                    <div class="col-sm-5 mb-none">
                        <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                    </div>
                </div>
                <div class="item-quantity row">
                    <p class="quantity-title mb-0 col-sm-7" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-map-marker-alt"></i> {{ job.nation.name }}</p>
                    <p class="delivery-date mb-0 col-sm-5" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-clock"></i> {{ ConvertDate(job.expiration_date) }}</p>
                </div>
                <div class="mb-none">                  
                    <p class="delivery-date mg-b" data-toggle="tooltip" data-placement="top" title="chi phí" :style="[job.highlight_job ? {'color': '#fc205c'} : '']"><i class="fad fa-dollar-sign" style="color: #000"></i><span class="title"> Chi phí: </span><span class="item-price"> {{ FormatPrice(job.subsidy) }} {{ job.currency }} </span></p>                                                                                 
                </div>        
            </div>
            <!-- <div class="item-options text-center mt-1 mb-1" >
                <div class="hot" v-if="job.highlight_job == 2" data-toggle="tooltip" data-placement="top" title="Được tài trợ"><img src="/assets/img/hot.png"></div>
                <div class="item-wrapper" style="margin-top: -5px;">
                    <a class="delivery-date mb-0 mt-1 badge border-netbee badge-sm" style="width: 100px" :href="job.type == 1 ? '/tin-tuyen-sinh/tim-kiem?keyword=&type=1' : job.type == 2 ? '/tin-tuyen-sinh/tim-kiem?keyword=&type=2' : '/tin-tuyen-sinh/tim-kiem?keyword=&type=3'">
                        {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học' : 'Tu nghiệp sinh' }}
                    </a>
                     <p class="delivery-date mg-top-5" data-toggle="tooltip" data-placement="top" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                </div>
            </div> -->
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
    max-width: 350px;
    font-size: 13px;
}
p {
    font-size: 13px;
}
.item-name .item-vip-a:hover{
    color: #ffb701 !important;
}
.highlight{
    border-left: 2px solid #ffb701 !important;
}
.mg-b{
    margin-bottom: 0px;
}
.border-job-item{
    /* background-color: #ffb7012b; */
    margin-bottom: 0px;
}
/* .ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid;
    grid-template-columns: 1fr 3fr 1fr;
} */
.card-content{
    display: flex !important;
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
    width: 8%;
    float: right;
    position: absolute;
    right: 15px;
    top: 0;
}
.p-r-0 .hot img{
    right: 0;
}
.card-avatar {
    margin: auto;
}
.card-avatar img {
    object-fit: scale-down;
    width: 60px;
    height: 60px;
}
.item-price .title {
    font-size: 14px;
}
.remove-border-right{
    width: 90%;
}
@media (max-width: 1199px) and (min-width: 992px){
    .item-vip-a{
        max-width: 285px;
    }
}

@media(max-width: 991px) {
    .p-r-0 .hot img{
        right: 15px;
    }
    .item-vip-a{
        max-width: 500px;
    }
}
@media(max-width: 767px) {
    .item-vip-a{
        max-width: 400px;
        overflow: hidden;
        white-space: unset;
    }
    .p-r-0 .hot img{
        right: 15px;
    }
    .item-options div:last-child {
        display: none;
    }
    .remove-border-right {
        padding: 10px 10px 10px 0px;
    }
}
@media (max-width: 600px){
    .mb-none{
        display: block !important;
    }
}
/* 
@media(max-width: 320px) {
  .border-netbee{
      padding: 6px;
  }
  .card-avatar{
      width: 0px;
      padding: 4px !important;
  }
} */
</style>