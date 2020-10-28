<template>
    <div class="row">
        <div class="col-sm-5 text-center d-flex align-items-center">
            <a class="mx-auto" :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <img v-lazy="`/uploads/news/${thuml}`">
            </a>
        </div>
        <div class="col-sm-7 d-flex flex-column newpage">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <h2 class="NB_title text-black el-3 font-weight-600">{{ title }}</h2>
            </a>
            <div class="small-news-time">
                <p class="el-3 mb-hide-div">{{ short_content }}</p>
                <i class="fad fa-user"></i><span class="mr-2">&nbsp;&nbsp;Admin</span>
                <i class="fad fa-calendar"></i><span>&nbsp;&nbsp;{{ ConvertDate(created_at) }}</span>  
            </div>
        </div>
    </div>
</template>
<script>
export default {
     props: ['id', 'title', 'short_content', 'created_at','thuml']
}
</script>
<style scoped>
a>img {
    object-fit: fill;
    max-width: 100%;
    max-height: 190px;
}
.newpage{
    top: 5px;
}
.flex-column{
    height:180px;
}
.NB_title.text-black.el-3.font-weight-600 {
    line-height: 1.4;
    margin-bottom: 7px;
}
.mb-hide-div {
    line-height: 1.5;
    margin-bottom: 5px;
}
.small-news-time {
    margin-bottom: 12px;
    color: #444;
}
@media(max-width: 575px){
    .mb-hide-div{
        display: -webkit-box;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
}
</style>