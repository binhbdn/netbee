<template>
    <div class="app-content content">
        <adminApplyManage v-if="$auth.user.role == 4"></adminApplyManage>
        <hrApplyManage v-else-if="$auth.user.role == 3"></hrApplyManage>
        <companyApplyManage v-else></companyApplyManage>
    </div>
</template>
<script>
import adminApplyManage from '~/components/Apply/admin.vue';
import hrApplyManage from '~/components/Apply/hr.vue';
import companyApplyManage from '~/components/Apply/company.vue';

export default {
    name: 'IndexNews',
        layout: 'admin',
    head: {
        title: 'Quản lý tin tuyển dụng',
    },
    components: {
        adminApplyManage,
        hrApplyManage,
        companyApplyManage
    },
    data() {
        return {

        }
    },
}
</script>
<style scoped>
.pagination .page-item.active .page-link{
    background-color: #ffb701 !important;
}
</style>