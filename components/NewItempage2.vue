<template>
    <div class="row">
        <div class="col-5" :style="type != 1 ? 'height: 117px' : ''">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <img :src="`~/static/uploads/news/${thuml}`"  width="100%" >
            </a>
        </div>
        <div class="col-7">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <h2 class="NB_title text-black el-3">{{ title }}</h2>
            </a>
            <p style="height: 100px;" class="el-3" v-if="type == 1">{{ short_content }}</p>
            <i class="fad fa-calendar-star"></i><span class="ml-1">{{ created_at | formatDate }}</span>
            
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

</style>