<template>
    <div class="row ecommerce-application">
        <div class="col-lg-12 col-12 list-view" v-for="(item, index) in DataList" :key="index">
            <div class="ecommerce-card border-job-item make-it-sl highlight" style="margin-bottom: 15px;">
                <div class="main-uv">                
                    <div class="row">
                        <div class="col-md-2">
                            <a :href="`/ho-so/${item.id}`">
                                <div class="setImg">
                                    <img :src="`/uploads/users/avatars/${item.avatar_profile}`" :alt="`${item.avatar}`">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <a class="item-vip-a" :href="`/ho-so/${item.id}`" data-toggle="tooltip" data-placement="top" :title="`${item.fullname_profile}`">[{{item.id}}] {{ item.fullname_profile }}</a>
                            <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="Địa chỉ"><i class="fad fa-location-arrow"></i> {{ item.address_profile }}</p>
                            <p class="text-length mb-0" data-toggle="tooltip" data-placement="top" :title="`${item.note_target_profile}`" color="#fc205c"><i class="fas fa-seedling"></i> {{ item.note_target_profile }}</p>
                            <p class="mb-0" data-toggle="tooltip" data-placement="top" title="Ngày cập nhập" color="#fc205c"><i class="fas fa-calendar"></i> {{ item.updated_at }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="p-main-uv" data-toggle="tooltip" data-placement="top" title="Giới tính"><i class="fas fa-venus-mars"></i>&nbsp;{{ item.maleFemale }}</p>
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
.main-uv{
    padding: 15px;
}
.p-main-uv{
    text-align: center;
    padding-top: 40%;
}
.text-length{
    width: 100%;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}

.ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid;
    grid-template-columns: 1fr 3fr 2fr!important;
}
.item-vip-a{
    font-weight: 400;
    font-size: 15px;
}

.border-DataList-item:hover{
    background-color: #ffb7012b;
}
.setImg{
    height: 92px;
    width: 90px;
    position: relative;
}
.setImg img {
    object-fit:cover;
    height: 92px;
    width: 90px;
}
</style>