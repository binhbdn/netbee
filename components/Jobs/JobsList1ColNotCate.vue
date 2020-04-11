<template>
<div class="row ecommerce-application">
    <div class="col-lg-12 col-12 list-view" v-for="(item, index) in DataList" :key="index">
        <JobItemNotCate :id="item.id" :title="item.title"/>
    </div>
</div>
</template>
<script>
import JobItemNotCate from '~/components/JobItemNotCate.vue';
export default {
    components: {
        JobItemNotCate
    },
    props: ['DataList']
}
</script>