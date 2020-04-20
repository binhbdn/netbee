<template>
<div class="row ecommerce-application">
    <div class="col-lg-12 col-12 list-view" v-for="(item, index) in DataList" :key="index">
        <JobItem :job="item"/>
    </div>
</div>
</template>
<script>
import JobItem from '~/components/JobItem.vue';
export default {
    components: {
        JobItem
    },
    props: ['DataList']
}
</script>