<template>
    <div class="ecommerce-application">
        <div class="row px-1 pb-1">
            <div class="col-md-12 py-1 make-it-slow" style="border: 1px solid hsla(0, 0%, 80%, .8);">
                <NewsItem2 :id="DataList[0].id" :title="DataList[0].title" :short_content="DataList[0].short_content" :created_at="DataList[0].updated_at" :thuml="DataList[0].thuml" :type=1></NewsItem2>
            </div>
            <div class="col-md-12" style="border-left: 1px solid hsla(0, 0%, 80%, .8); margin-top: 14px;">
                <div class="row">
                    <div class="col-md-3 mt-1 py-1 make-it-slow" style="border: 1px solid hsla(0, 0%, 80%, .8); border-left: 0; margin: 0 !important"  v-for="(item, index) in DataList.slice(1)" :key="index">
                        <div class="item-new">
                            <NewsItem1 :id="item.id" :title="item.title" :short_content="item.short_content" :created_at="item.updated_at" :thuml="item.thuml"></NewsItem1>
                        </div>                
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