<template>
    <div class="ecommerce-application">
        <div class="row px-1 pb-1">
            <div class="col-5 py-1 make-it-slow">
                <div style="height: 305px;">
                    <NewsItem1 :id="DataList[0].id" :title="DataList[0].title" :short_content="DataList[0].short_content" :created_at="DataList[0].updated_at" :thuml="DataList[0].thuml" :type=1></NewsItem1>
                </div>                
            </div>
            <div class="col-7">
                <div class="row px-1">
                    <div class="col-12 make-it-slow py-1" v-for="(item, index) in DataList.slice(1)" :key="index">
                        <NewsItem2 :id="item.id" :title="item.title" :short_content="item.short_content" :created_at="item.updated_at" :thuml="item.thuml"></NewsItem2>
                    </div>
                </div>
                
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