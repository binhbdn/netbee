<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Danh sách tin tức</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/">Bài viết</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Danh sách bài viết
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="News"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <form action="" method="">
                                        <button class="btn btn-warning text-dark"><i class="far fa-folder-plus"></i> Tạo bài viết mới</button>
                                    </form>
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Tiêu đề</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Trạng thái</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in tinTuc" :key="index">
                                                    <td>{{item.id}}</td>
                                                    <td>{{item.title}}</td>
                                                    <td>{{item.created_at}}</td>
                                                    <td style="white-space: nowrap;">

                                                        <span class="success" v-if="item.status == 1"><i class="fas fa-circle" style="font-size: 7px"></i> Đã kích hoạt</span>
                                                        <span class="danger" v-else><i class="fas fa-circle" style="font-size: 7px"></i> Chưa kích hoạt</span>
                                                    </td>
                                                    <td style="width: 27%;">
                                                        <button class="btn px-1" style="width: 110px" :class="item.status == 1 ? 'btn-outline-danger' : 'btn-outline-warning'">{{ item.status == 1 ? 'Bỏ kích hoạt' : 'Kích hoạt' }}</button>
                                                        <button class="btn btn-outline-warning"><i class="far fa-edit"></i> Sửa</button>
                                                        <button class="btn btn-outline-danger"><i class="far fa-trash-alt"></i> Xóa</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'IndexNews',
        layout: 'admin',
    head: {
        title: 'Quản lý tin tức',
        meta: [
        { hid: 'description', name: 'description', content: 'Home page description' }
        ],
        noscript: [
        { innerHTML: 'Body No Scripts', body: true }
        ],
        link: [
            { rel: 'stylesheet', href: '/app-assets/vendors/css/tables/datatable/datatables.min.css' },
        ],
        script: [
            { src: '/head.js' },
            // Supported since 1.0
            { src: '/body.js', body: true },
            { src: '/defer.js', defer: '' },
            { src: '/app-assets/vendors/js/tables/datatable/pdfmake.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/vfs_fonts.js' },
            { src: '/app-assets/vendors/js/tables/datatable/datatables.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/buttons.html5.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/buttons.print.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js' },
            //datatable
            { src: '/app-assets/js/scripts/datatables/datatable.js' },
        ]
    },
    data() {
        return {
            tinTuc: [],
        }
    },
    created() {
        this.fetch();
    },
    methods: {
        fetch() {
            this.$axios.$get('tintuc/getTinTuc').then((response)=>{
	             this.tinTuc=response.data;
	            });

        }
    },
    
}
</script>
<style scoped>
.pagination .page-item.active .page-link{
    background-color: #ffb701 !important;
}
.btn {
    padding: 7px!important;
}
</style>