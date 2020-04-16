<template>
    <div class="card ecommerce-card border-job-item">
        <a href="#" class="text-center pt-1 px-1" style="height: 240px">
            <img :src="`/uploads/news/${thuml}`" width="100%" alt="img-placeholder">
        </a>
        <div class="px-2">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`" ><h4 class="title">{{ title }}</h4></a>
            <p style="height: 100px;" class="el-3">{{ short_content }}</p>
            <p><i class="fad fa-calendar-star"></i> {{ created_at | formatDate }}</p>
        </div>
    </div>
</template>
<script>
import moment from 'moment'
import Vue from "vue";

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('DD/MM/YYYY')
  }
})

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
.title{
    height: 65px;
}
</style>