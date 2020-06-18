<template>
<div class="row ecommerce-application">
    <div class="col-lg-6 col-12 list-view"  v-for="(item, index) in DataList" :key="index">
        <p>{{item.tag_name}}</p>
    </div>
</div>
</template>
<script>
export default {    
    props: ['DataList']
}
</script>
<style scoped>

</style>