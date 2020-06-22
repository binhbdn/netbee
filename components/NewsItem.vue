<template>
    <!-- <div class="card border-job-item" style="border-radius: 5px">
        <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`" class="text-center" style="height: 150px">
            <img :src="`/uploads/news/${thuml}`" :alt="`${thuml}`" style="max-height: 100%;width: 100%;height: 100%;object-fit: fill;">
        </a>
        <div class="px-2 p-t-15" style="">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`" class="blog-new">
                <h4 class="title font-weight-600">{{ title }}</h4>
            </a>
            <p class="el-3">{{ short_content }}</p>
            <p style="margin-bottom: 12px;"><i class="fad fa-calendar-star"></i> {{ ConvertDate(created_at) }}</p>
        </div>
    </div> -->
    <div class="card border-job-item" style="border-radius: 3px;">
        <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`" class="text-center" style="height: 200px">
            <img :src="`/uploads/news/${thuml}`" :alt="`${thuml}`" class="img-new">
        </a>
        <div class="col-md-12" style="text-align: center;">
            <img src="/assets/img/logo.png" alt="logo netbee" width="60" style="margin-top: -30px; text-align: center;">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`" class="blog-new">
                <h4 class="title font-weight-600" style="text-align: center;">{{ title }}</h4>
            </a>
            <div class="col-md-12"><p class="line1a"></p></div>
            <p class="el-3" style="text-align: justify;">{{ short_content }}</p>
            <p style="margin-bottom: 12px; float: right;"><i class="fad fa-calendar-star"></i> {{ ConvertDate(created_at) }}</p>
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
.el-3 {
    margin-bottom: 5px;
    line-height: 20px !important;
}
.blog-new{
    display: -webkit-box;-webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 45px;
}
.img-new{
    max-height: 100%; 
    width: 100%; 
    height: 100%; 
    object-fit: fill;
    border-radius: 3px;
}
.line1a{
    width: 180px;
    border-top: 2px solid #FFB701;
    transform: rotate(-0.22deg);
    margin: auto;
    margin-top: 4px;
    margin-bottom: 8px;
}
@media(max-width: 991px) {
    .blog-new {
        height: auto;
    }
}
@media(max-width: 414px) {
    .blog-new {
        height: 45px !important;
    }
}
/* .title{
    height: 65px;
} */
</style>