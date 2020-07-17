<template>
<div class="row ecommerce-application">
    <div class="col-lg-12 col-12 list-view list-view-job-admin" v-for="(item, index) in DataList" :key="index">
        <JobItemAdmin :job="item" :settingBonus="DataBonus"/>
    </div>
</div>
</template>
<script>
import JobItemAdmin from '~/components/JobItemAdmin.vue';
export default {
    components: {
        JobItemAdmin
    },
    props: ['DataList', 'DataBonus']
}
</script>