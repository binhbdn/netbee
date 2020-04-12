<template>
    <div class="card ecommerce-card border-job-item">
        <a href="#" class="text-center pt-1 px-1" style="height: 240px">
            <img src="/app-assets/images/pages/500.png" width="100%" alt="img-placeholder">
        </a>
        <div class="px-2">
            <a href="#"><h4>{{title}}</h4></a>
            <p style="height: 100px;" class="el-3">{{content}}</p>
            <p><i class="fad fa-calendar-star"></i> {{time}}</p>
        </div>
    </div>
</template>
<script>

export default {
    props: ['id', 'title', 'content', 'time']
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
</style>