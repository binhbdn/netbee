<template>
    <div class="row">
        <div class="col-5 text-center d-flex align-items-center">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <img v-lazy="`/uploads/news/${thuml}`" :style="type != 1 ? 'max-height: 117px' : 'max-height: 190px'" style="max-width: 100%;width: 100%;object-fit: fill;">
            </a>
        </div>
        <div class="col-7 position-relative">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <h2 class="NB_title text-black el-3 font-weight-600">{{ title }}</h2>
            </a>
            <p style="height: 97px;" class="el-3" v-if="type == 1 || type == 2">{{ short_content }}</p>
            <div class="position-absolute" style="bottom: 10px">
                <i class="fad fa-calendar-star"></i><span class="ml-1">{{ ConvertDate(created_at) }}</span>
            </div>
            
        </div>
    </div>
</template>
<script>
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