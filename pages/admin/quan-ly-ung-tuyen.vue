<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <adminApplyManage v-if="$auth.user.role == 4"></adminApplyManage>
        <hrApplyManage v-if="$auth.user.role == 3"></hrApplyManage>
        <!-- <infinite-loading
                v-if="tinTuyenDung.length"
                spinner="bubbles"
                @infinite="infiniteScroll" style="padding:20px; width:100%"
            >
            <div slot="no-more" style="font-size:15px; font-style: italic">Hết tin</div>
            <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
        </infinite-loading> -->
    </div>
</template>
<script>
import adminApplyManage from '~/components/Apply/admin.vue';
import hrApplyManage from '~/components/Apply/hr.vue';

export default {
    name: 'IndexNews',
        layout: 'admin',
    head: {
        title: 'Quản lý tin tuyển dụng',
    },
    components: {
        adminApplyManage,
        hrApplyManage
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