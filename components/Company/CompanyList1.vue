<template>
<div class="row ecommerce-application">
    <div class="col-lg-12 col-12 list-view" v-for="(item, index) in DataList" :key="index">
        <CompanyItem :id="item.id" :title="item.title"/>
    </div>
</div>
</template>
<script>
import CompanyItem from '~/components/Company/CompanyItem.vue';
export default {
    components: {
        CompanyItem
    },
    props: ['DataList']
}
</script>