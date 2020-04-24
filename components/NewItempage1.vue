<template>
    <div>
        <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
            <div class="text-center" :style="type == 1 ? 'height: 250px' : 'height: 120px'">
                <img style="width: 100%; max-height: 250px" :alt="`${thuml}`" v-lazy="`/uploads/news/${thuml}`" v-if="type == 1" />
                <img alt="img" v-lazy="`/uploads/news/${thuml}`" style="max-height: 100px; max-width: 100%;" v-if="type != 1" />
            </div>
        </a>
        <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`"><h2 class="NB_title text-black pt-1 el-3">{{ title }}</h2></a>
         
        <p style="height: 100px;" class="el-3" v-if="type == 1">{{ short_content }}</p>  
        <i class="fad fa-calendar-star"></i><span class="ml-1">{{ created_at | formatDate }}</span>                                 
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
    props: ['id', 'title', 'short_content', 'created_at','thuml', 'type'],
    

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