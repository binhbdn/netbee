<template>
<div class="row ecommerce-application">
    <div class="col-lg-12 col-12 list-view list-view-job-admin" v-for="(item, index) in DataList" :key="index">
        <JobItem :job="item" :type="type"/>
    </div>
</div>
</template>
<script>
import JobItem from '~/components/JobItemCol1.vue';
export default {
    components: {
        JobItem
    },
    props: ['DataList', 'type']
}
</script>