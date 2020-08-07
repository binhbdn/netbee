<template>
    <div class="row">
        <div class="col-md-12 col-5 text-center d-flex align-items-center highlights-news">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`" style="margin: auto;">
                <!-- <div class="text-center" :style="type == 1 ? 'height: 150px' : 'height: 110px'"> -->
                    <img style="object-fit: fill;max-width: 100%;" :alt="`${thuml}`" v-lazy="`/uploads/news/${thuml}`" v-if="type == 1" />
                    <img alt="img" v-lazy="`/uploads/news/${thuml}`" style="object-fit: fill;max-width: 100%;max-height: 100%;" v-if="type != 1" />
                <!-- </div> -->
            </a>
        </div>
        <div class="col-md-12 col-7 small-news">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`"><h2 class="NB_title text-black pt-1 el-3 font-weight-600" style="line-height: 1.4;">{{ title }}</h2></a>
            <p style="line-height: 1.5;margin-bottom: 5px;" class="el-3 mb-hide-div" v-if="type == 1">{{ short_content }}</p>
            <div class="small-news-time">
                <i class="fad fa-calendar-star"></i><span class="ml-1">{{ ConvertDate(created_at) }}</span>  
            </div> 
        </div>                             
    </div>
</template>
<script>
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
    display: block;
}
h4:hover{
    color: #ffb701;
}
.small-news{
    position: relative;
    min-height: 110px;
}
.small-news-time{
    position: absolute;
    bottom: 0;
}
/* @media(max-width: 767px){
    .highlights-news{
        max-width: 150px;
    }
}
@media(max-width: 575px){
    .highlights-news{
        max-width: 110px;
    }
} */
@media(max-width: 575px){
    .mb-hide-div{
        display: none;
    }
}
</style>