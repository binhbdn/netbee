<template>
    <div class="row">
        <div class="col-5 text-center d-flex align-items-center">
            <a class="mx-auto" :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <img v-lazy="`/uploads/news/${thuml}`" :style="type != 1 ? 'max-height: 117px' : 'max-height: 190px'" style="max-width: 100%;object-fit: fill;">
            </a>
        </div>
        <div class="col-7 d-flex flex-column">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <h2 class="NB_title text-black el-3 font-weight-600" style="margin-bottom: 7px;line-height: 1.4;">{{ title }}</h2>
            </a>
            <p class="el-3 mb-hide-div" style="line-height: 1.5;margin-bottom: 5px;" v-if="type == 1 || type == 2">{{ short_content }}</p>
            <div class="small-news-time" style="position: absolute;bottom: 0;">
                <i class="fad fa-calendar-star"></i><span class="ml-1">{{ ConvertDate(created_at) }}</span>  
            </div>
        </div>
    </div>
</template>
<script>
export default {
     props: ['id', 'title', 'short_content', 'created_at','thuml', 'type']
}
</script>
<style >
.block-20 {
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    height: 150px;
    position: relative;
    display: block;
}
h4:hover{
    color: #ffb701;
}
.flex-column{
    height:180px;
}
@media(max-width: 575px){
    .pdt-none{
        margin-top: 0 !important;
    }
   
    .mb-hide-div{
        display: none;
    }
}
</style>