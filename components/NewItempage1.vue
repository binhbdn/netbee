<template>
    <div>
        <a href="#">
            <div :style="id == 1 ? 'height: 250px' : 'height: 120px'">
                <img style="width: 100%;" alt="img" src="/app-assets/images/pages/content-img-3.jpg" v-if="id == 1" />
                <img alt="img" src="/app-assets/images/pages/content-img-2.jpg" width="147" height="100" v-if="id != 1" />
            </div>
        </a>
        <a href="#"><h2 class="NB_title text-black pt-1 el-3">{{title}}</h2></a>
        <i class="fa fa-calendar"></i><span class="ml-1">{{time}}</span>  
        <p style="height: 100px;" class="el-3" v-if="id == 1">{{content}}</p>                                  
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