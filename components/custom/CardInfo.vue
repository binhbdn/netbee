<template>
    <div class="row ecommerce-application">
        <div class="col-lg-12 col-12 list-view" v-for="(item, index) in DataList" :key="index">
            <div class="ecommerce-card border-job-item make-it-sl highlight" style="margin-bottom: 15px;">
                <div class="card-content h-100">
                    <div class="text-center p-1">
                        <a :href="`/tin-tuyen-sinh/${item.id}/${ChangeToSlug(item.fullname_profile)}`">
                            <img v-lazy="`/uploads/users/avatars/${item.avatar_profile}`" height="100%" :alt="`${item.avatar}`" style="object-fit: scale-down; max-height: 100%; max-width: 100%;">
                        </a>
                    </div>
                    <div class="p-1">
                        <div class="d-flex justify-content-between" style="padding: 5px 0px;">
                            <a class="item-vip-a" :href="`/tin-tuyen-sinh/${item.id}/${ChangeToSlug(item.fullname_profile)}`" data-toggle="tooltip" data-placement="top" :title="`${item.fullname_profile}`">[{{item.id}}] {{ item.fullname_profile }}</a>
                            <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Giới tính"><i class="far fa-user"></i> {{ item.maleFemale }}</p>
                        </div>
                        <div class="item-quantity d-flex">
                            <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="Địa chỉ"><i class="fad fa-location-arrow"></i> {{ item.address_profile }}</p>
                        </div>  
                        <div class="item-quantity d-flex">
                            <p class="text-length mb-0" data-toggle="tooltip" data-placement="top" :title="`${item.note_target_profile}`" color="#fc205c"><i class="fas fa-seedling"></i> {{ item.note_target_profile }}</p>
                        </div>
                        <div class="item-quantity d-flex">
                            <p class="mb-0" data-toggle="tooltip" data-placement="top" title="Ngày cập nhập" color="#fc205c"><i class="fas fa-calendar"></i> {{ item.updated_at }}</p>
                        </div>
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
    props: ['DataList']
}
</script>
<style scoped>
.text-length{
    width: 85%;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}

.ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid;
    grid-template-columns: 1fr 3fr 2fr;
}
.item-vip-a{
    font-weight: 600;
    font-size: 16px;
}

.border-DataList-item:hover{
    background-color: #ffb7012b;
}
</style>