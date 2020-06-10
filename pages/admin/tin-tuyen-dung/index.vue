<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div style="margin-top: 62px;padding-top: 15px;">
            <TinTuyenDung/>
        </div>        
    </div>
</template>
<script>
import TinTuyenDung from '~/components/TinTuyenDung'

export default {
    name: 'IndexNews',
        layout: 'admin',
    head: {
        title: 'Quản lý tin tuyển dụng',
    },
    components: {
       TinTuyenDung
    },
    data() {
        return {
            
        }
    },
    created() {
           
    },
    mounted() {
                 
    },
    methods: {
       
    },
    computed: {
        
    }
}
</script>
<style scoped>
.pagination .page-item.active .page-link{
    background-color: #ffb701 !important;
}
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 100px;
  height: 100px;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  background: #ffb701;
}
.modal .modal-footer {
    border-color: #ffb701 !important;
}
</style>