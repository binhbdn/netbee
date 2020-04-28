<template>
    <div class="card border-job-item" style="border-radius: 5px">
        <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`" class="text-center" style="height: 220px">
            <img v-lazy="`/uploads/news/${thuml}`" :alt="`${thuml}`" style="max-height: 100%;width: 100%;height: 100%;object-fit: fill;">
        </a>
        <div class="px-2 p-t-15" style="height: 190px;">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`" 
            style="display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 45px;"><h4 class="title font-weight-600">{{ title }}</h4></a>
            <p class="el-3">{{ short_content }}</p>
            <p style="bottom: 0px;position: absolute;"><i class="fad fa-calendar-star"></i> {{ ConvertDate(created_at) }}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['id', 'title', 'short_content', 'created_at','thuml']
}
</script>
<style>
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
/* .title{
    height: 65px;
} */
</style>