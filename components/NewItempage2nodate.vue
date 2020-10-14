<template>
    <div class="row">
        <!-- <div class="col-5 text-center d-flex align-items-center" style="margin:auto">
            <a class="mx-auto" :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <img v-lazy="`/uploads/news/${thuml}`" :style="type != 1 ? 'max-height: 117px' : 'max-height: 190px'" style="max-width: 100%;object-fit: fill;">
            </a>
        </div> -->
        <div class="col-10 d-flex flex-column new-item-right" style="margin:auto;border-top: 1px solid rgb(221, 221, 221);border-bottom: 1px solid rgb(221, 221, 221);">
            <a :href="`/tin-tuc/${id}/${ChangeToSlug(title)}`">
                <h2 class="NB_title text-black el-3 font-weight-600 p-t-5" style="margin-bottom: 7px;line-height: 1.4;">{{ title }}</h2>
            </a>
        </div>
    </div>
</template>
<script>
export default {
     props: ['id', 'title', 'short_content', 'created_at','thuml', 'type']
}
</script>
<style >
.new-item-right{
    height: 90px !important;
}
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