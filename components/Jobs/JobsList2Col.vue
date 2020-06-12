<template>
<div class="row ecommerce-application">
    <div class="col-lg-6 col-12 list-view" v-for="(item, index) in DataList" :key="index" :class="{'p-r-0': index % 2 == 0}">
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
<style scoped>
@media(max-width: 768px) {
    .p-r-0{
        padding-right: 14px !important;
    }
}
@media(max-width: 320px) {
  .p-r-0{
      padding-right: 14px !important;
  }
}
</style>