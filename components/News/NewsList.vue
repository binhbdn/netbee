<template>
<div class="row ecommerce-application">
    <div class="col-lg-3 col-12 list-view" v-for="(item, index) in DataList" :key="index" :class="{'p-r-0': index != DataList.length-1}">
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