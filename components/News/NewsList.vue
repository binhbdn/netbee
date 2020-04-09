<template>
<div class="row ecommerce-application">
    <div class="col-lg-3 col-12 list-view" v-for="(item, index) in DataList" :key="index">
        <NewsItem :id="item.id" :title="item.title" :content="item.content" :time="item.time"/>
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