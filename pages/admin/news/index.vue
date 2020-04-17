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
                                    <li class="breadcrumb-item active" @click = "formatDate('2020-01-15 07:11:58')"> Danh sách bài viết
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
                                    <form action="/admin/news/create" method="">
                                        <button class="btn-add btn btn-warning text-dark "><i class="far fa-folder-plus"></i> Tạo bài viết mới</button>
                                    </form>
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 zero-configuration">
                                            <thead class="custom-header">
                                                <tr>
                                                    <th class="width-id">ID</th>
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
                                                    <td>{{formatDate(item.created_at)}}</td>
                                                    <td style="white-space: nowrap;">

                                                        <span class="success" v-if="item.status == 1"><i class="fas fa-circle" style="font-size: 7px"></i> Đã kích hoạt</span>
                                                        <span class="danger" v-else><i class="fas fa-circle" style="font-size: 7px"></i> Chưa kích hoạt</span>
                                                    </td>
                                                    <td style="width: 27%;">
                                                        <button  @click="changeStatus(item.id)" class="btn-action btn px-1" style="width: 110px" :class="item.status == 1 ? 'btn-outline-danger' : 'btn-outline-warning'">{{ item.status == 1 ? 'Bỏ kích hoạt' : 'Kích hoạt' }}</button>
                                                        <a :href="`/admin/news/edit/${item.id}`" class="btn-action btn btn-outline-warning"><i class="far fa-edit"></i> Sửa</a>
                                                        <button v-on:click="deleteNews(item.id)" class="btn-action btn btn-outline-danger"><i class="far fa-trash-alt"></i> Xóa</button>
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
import Vue from 'vue'
import moment from 'moment'
export default {
    name: 'IndexNews',
        layout: 'admin',
    head: {
        title: 'Quản lý tin tức',
        script: [
            { src: '/app-assets/vendors/js/tables/datatable/pdfmake.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/vfs_fonts.js' },
            { src: '/app-assets/vendors/js/tables/datatable/datatables.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/buttons.html5.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/buttons.print.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js' },
            { src: '/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js' },
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

        },
        async changeStatus(index){
            try {
                    let response = await this.$axios.post('tintuc/changeStatusTinTuc',{
                    id: index
                });
                if(response.data.status == 200) {
                    this.$swal({
                        title: 'Thành công',
                        text: response.data.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then( 
                        this.fetch(),
                    )
                }
                else {
                this.$swal(
                    'Lỗi!',
                    response.data.message,
                    'error'
                    )
                }
            } catch (error) {
                this.$swal(
                    'Lỗi!',
                    'Lỗi bỏ kích hoạt!',
                    'error')
            }
                    
        },
        async deleteNews(index){
                try {
                    this.$swal({
                    title: 'Bạn có chắc chắn?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa!',
                    cancelButtonText: 'Hủy!',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                    }).then(async (result) => {
                    if(result.value) {
                        let response = await this.$axios.post('tintuc/deleteTinTuc',{id: index});
                        if(response.data.status == 200) {
                            this.fetch();
                            this.$swal('Thành công', response.data.message, 'success');
                        }
                        else {
                            this.$swal(
                                'Lỗi!',
                                response.data.message,
                                'error'
                                )
                            }
                    } else {
                        this.$swal('Hủy', 'Tin được giữ lại', 'info')
                    }
                    })
                } catch (error) {
                    this.$swal(
                        'Lỗi!',
                        'Lỗi xóa!',
                        'error')
                }
        },
        formatDate(value){
                if (value) {
                    // return moment(String(value)).format('MM/DD/YYYY');
                return (moment(String(value)).format('MM/DD/YYYY'));
                }
        },
        
    },
    
}
</script>
<style scoped>
.pagination .page-item.active .page-link{
    background-color: #ffb701 !important;
}
</style>