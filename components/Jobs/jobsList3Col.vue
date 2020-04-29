<template>
<div class="row ecommerce-application">
    <div class="col-lg-12 col-12 list-view" v-for="(item, index) in DataList" :key="index">
        <JobItemAdmin :job="item"/>
    </div>
</div>
</template>
<script>
import JobItemAdmin from '~/components/JobItemAdmin.vue';
export default {
    components: {
        JobItemAdmin
    },
    props: ['DataList']
}
</script>