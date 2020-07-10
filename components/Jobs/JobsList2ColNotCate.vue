<template>
<div class="row ecommerce-application">
    <div class="col-lg-12 col-12 list-view" v-for="(item, index) in DataList" :key="index">
        <JobItemNotCate :job="item" :type="type"/>
    </div>
</div>
</template>
<script>
import JobItemNotCate from '~/components/JobItemNotCate1.vue';
export default {
    components: {
        JobItemNotCate
    },
    props: ['DataList', 'type']
}
</script>