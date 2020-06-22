<template>
<div class="row ecommerce-application m-r-w-0">
    <div class="col-lg-4 col-12 list-view" v-for="(item, index) in DataList" :key="index">
        <NewsItem :id="item.id" :title="item.title" :short_content="item.short_content" :created_at="item.updated_at" :thuml="item.thuml" />
    </div>
</div>
</template>
<script>
import NewsItem from '~/components/NewsItem';
export default {
    components: {
        NewsItem
    },
    props: ['DataList']
}
</script>
<style type="text/css">
.m-r-w-0{
	margin: 0 ;
}
@media(max-width: 767px) {
    .m-r-w-0{
    	margin: 0 -15px;
    }
}
</style>