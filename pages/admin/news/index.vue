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
            <!-- users filter start -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tìm kiếm</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                    <li><a data-action=""><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show pb-2">
                            <div class="card-body">
                                <div class="users-list-filter">
                                    <form>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <input type="text" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.search" id="filter-text-box" placeholder="Tìm kiếm...." />
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <input type="text" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.searchTitle" id="filter-text-box" placeholder="Tên tiêu đề..." />
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <fieldset class="form-group">
                                                    <select class="form-control" id="users-list-role">
                                                        <option value="">Trạng thái</option>
                                                        <option value="user">Đã kích hoạt</option>
                                                        <option value="staff">Chưa kích hoạt</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <fieldset class="form-group">
                                                    <select class="form-control" id="users-list-role">
                                                        <option value="">Thể loại</option>
                                                        <option value="user">Du học sinh</option>
                                                        <option value="staff">Tu nghiệp sinh</option>
                                                        <option value="staff">Xuất khẩu lao động</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users filter end -->
            <div class="content-body">
                <section id="News"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header col-12" style="padding-left:15px;">
                                    <form class="col-9" action="/admin/news/create" method="">
                                        <button class="btn-add btn btn-warning text-dark "><i class="far fa-folder-plus"></i> Tạo bài viết mới</button>
                                    </form>
                                    <div class="action-btns">
                                        <div class="btn-dropdown ">
                                            <div class="btn-group dropdown actions-dropodown">
                                                <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Sắp xếp
                                                </button>
                                                <div class="dropdown-menu" style="left: -25px!important;">
                                                    <a class="dropdown-item" @click="sortAscendingID()"><i class="feather icon-trash-2"></i>ID tăng dần</a>
                                                    <a class="dropdown-item" @click="sortDecreaseID()"><i class="feather icon-clipboard"></i>ID giảm dần</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action-btns">
                                        <div class="btn-dropdown ">
                                            <div class="btn-group dropdown actions-dropodown">
                                                <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Hành động
                                                </button>
                                                <div class="dropdown-menu" style="left: -25px!important;">
                                                    <a class="dropdown-item" ><i class="feather icon-trash-2"></i>Xóa</a>
                                                    <a class="dropdown-item" ><i class="feather icon-clipboard"></i>Kích hoạt</a>
                                                    <a class="dropdown-item" href="#"><i class="feather icon-printer"></i>Bỏ kích hoạt</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 zero-configuration">
                                            <thead class="custom-header">
                                                <tr>
                                                    <th class="width-id d-flex">
                                                        <li class="d-inline-block mr-1">
                                                            <fieldset>
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="false">
                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                        ID</th>
                                                    <th>Tiêu đề</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Trạng thái</th>
                                                    <th>Thể loại</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in filteredList" :key="index">
                                                    <td>
                                                        <li class="d-inline-block mr-1">
                                                            <fieldset>
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="false">
                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                        {{item.id}}</td>
                                                    <td>{{item.title}}</td>
                                                    <td>{{formatDate(item.created_at)}}</td>
                                                    <td style="white-space: nowrap;">
                                                        <span class="success" v-if="item.status == 1"><i class="fas fa-circle" style="font-size: 7px"></i> Đã kích hoạt</span>
                                                        <span class="danger" v-else><i class="fas fa-circle" style="font-size: 7px"></i> Chưa kích hoạt</span>
                                                    </td>
                                                    <td style="white-space: nowrap;">
                                                        <span v-if="item.id_category == 1">Xuất khẩu lao động</span>
                                                        <span v-if="item.id_category == 2">Du học sinh</span>
                                                        <span v-if="item.id_category == 3">Tu nghiệp sinh</span>
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
            cardSearch: {
                search: "",
                searchID: "",
                searchTitle: "",
                searchCategory: ""
            }
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
        sortAscendingID() {
            this.tinTuc.sort((a, b) => a.id > b.id ? 1 : -1);
            },
        sortDecreaseID() {
            this.tinTuc.sort((a, b) => a.id < b.id ? 1 : -1);
        },
        actived() {
            sort((a, b) => a.status > b.status ? 1 : -1);
        },
        notActived() {
            this.tinTuc.filter(item => {
                return item.status.includes('0');
            })
        },
        
    },
    computed: {
    filteredList() {
      if(this.cardSearch.search){
          return this.tinTuc.filter(item => {
                return item.title.toLowerCase().includes(this.cardSearch.search.toLowerCase())
      })
      }
      else if(this.cardSearch.searchID){
          return this.tinTuc.filter(item => {
                return item.id.includes(this.cardSearch.searchID)
      })
      }
      else if(this.cardSearch.searchTitle){
          return this.tinTuc.filter(item => {
                return item.title.toLowerCase().includes(this.cardSearch.searchTitle.toLowerCase())
      })
      }
      else if(this.cardSearch.searchCategory){
          return this.tinTuc.filter(item => {
                return item.id_category.toLowerCase().includes(this.cardSearch.searchCategory.toLowerCase())
      })
      }
      return this.tinTuc;
    }
  }
    
}
</script>
<style scoped>
.pagination .page-item.active .page-link{
    background-color: #ffb701 !important;
}
</style>