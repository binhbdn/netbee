<template>
    <div class="ecommerce-application">
        <div class="row px-1 pb-1">
            <div class="col-12 py-1 make-it-slow">
                <NewsItem2 :id="DataList[0].id" :title="DataList[0].title" :short_content="DataList[0].short_content" :created_at="DataList[0].created_at" :thuml="DataList[0].thuml"></NewsItem2>
            </div>
            <div class="col-3 mt-1 py-1 make-it-slow"  v-for="(item, index) in DataList.slice(1)" :key="index">
                <NewsItem1 :id="item.id" :title="item.title" :short_content="item.short_content" :created_at="item.created_at" :thuml="item.thuml"></NewsItem1>
            </div>
        </div>
    </div>
</template>
<script>
import NewsItem1 from '~/components/NewItempage1';
import NewsItem2 from '~/components/NewItempage2';
import Vue from 'vue';

export default {
    components: {
        NewsItem1,
        NewsItem2
    },
    props: ['DataList']
}
</script>
<style>

</style>