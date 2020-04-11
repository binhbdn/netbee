<template>
    <div class="ecommerce-application">
        <div class="row px-1 pb-1">
            <div class="col-12 py-1 make-it-slow">
                <NewsItem2 :id="DataList[0].id" :title="DataList[0].title" :content="DataList[0].content" :time="DataList[0].time"></NewsItem2>
            </div>
            <div class="col-3 mt-1 py-1 make-it-slow"  v-for="(item, index) in DataList" :key="index" v-if="item.id != 1">
                <NewsItem1 :id="item.id" :title="item.title" :content="item.content" :time="item.time" ></NewsItem1>
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
    props: ['DataList', 'type']
}
</script>
<style>

</style>