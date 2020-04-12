<template>
    <div class="row">
        <div class="col-5" :style="id != 1 ? 'height: 117px' : ''">
            <a href="/tin-tuc/detail_news" >
                <img src="/app-assets/images/pages/card-img-overlay.jpg"  width="100%" >
            </a>
        </div>
        <div class="col-7">
            <a href="/tin-tuc/detail_news">
                <h2 class="NB_title text-black el-3">{{title}}</h2>
            </a>
            <i class="fa fa-calendar"></i><span class="ml-1">{{time}}</span>
            <p style="height: 100px;" class="el-3" v-if="id == 1 || type == 1">{{content}}</p>
        </div>
    </div>
</template>
<script>

export default {
    props: ['id', 'title', 'content', 'time', 'type'],
    data: ({
    })
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

</style>