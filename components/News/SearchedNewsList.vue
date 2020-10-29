<template>
    <div class="ecommerce-application">
        <div class="row px-1 pb-1">
            <div class="col-md-12 py-1 make-it-slow" style="border: 1px solid hsla(0, 0%, 80%, .8);" v-for="(item, index) in DataList" :key="index">
                <SearchedNewsItem :id="item.id" :title="item.title" :short_content="item.short_content" :created_at="item.updated_at" :thuml="item.thuml" />
            </div>
        </div>
    </div>
</template>
<script>
import SearchedNewsItem from '~/components/SearchedNewsItem';
import Vue from 'vue';

export default {
    components: {
        SearchedNewsItem
    },
    props: ['DataList']
}
</script>