<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <!-- News filter start -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tìm kiếm</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse" data-toggle="tooltip"  data-placement="top" :title="`Thu gọn tìm kiếm`"><i class="fa fa-chevron-down"></i></a></li>
                                    <li><a @click="resetForm()" data-toggle="tooltip"  data-placement="top" :title="`Làm mới tìm kiếm`"><i class="fa fa-repeat icon- users-data-filter"></i></a></li>
                                    <!-- <li><a data-action="close" data-toggle="tooltip"  data-placement="top" :title="`Đóng tìm kiếm`"><i class="feather icon-x"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show pb-2">
                            <div class="card-body">
                                <div class="users-list-filter">
                                    <form>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.search" id="filter-text-box" placeholder="Tìm kiếm...." />
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.searchTitle" id="filter-text-box" placeholder="Tên tiêu đề..." />
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <fieldset class="form-group">
                                                    <multiselect @input="search()" :allow-empty="false" v-model="cardSearch.searchCategory" :options="categories" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn danh mục" style="font-size:14px"></multiselect>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <fieldset class="form-group">
                                                    <multiselect @input="search()" :allow-empty="false" v-model="cardSearch.searchStatus" :options="status" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn trạng thái"  style="font-size:14px"></multiselect>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- News filter end -->
            <div class="content-body">
                <section id="News"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header col-12" style="padding-left:15px;">
                                    <form class="col-9" action="/admin/news/create" method="">
                                        <button class="btn-add btn bg-netbee text-dark "><i class="far fa-folder-plus"></i> Tạo bài viết mới</button>
                                    </form>
                                    <div class="action-btns">
                                        <div class="btn-dropdown ">
                                            <div class="btn-group dropdown actions-dropodown">
                                                <button type="button" class="btn btn-white px-2 py-75  waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Sắp xếp
                                                    <i class="fa fa-caret-down mr-0 ml-1"></i>
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
                                                <button type="button" class="btn btn-white px-2 py-75  waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Hành động
                                                    <i class="fa fa-caret-down mr-0 ml-1"></i>
                                                </button>
                                                <div class="dropdown-menu" style="left: -25px!important;">
                                                    <a class="dropdown-item" @click="deleteMultipleTinTuc()"><i class="feather icon-trash-2"></i>Xóa</a>
                                                    <a class="dropdown-item" @click="changeMultipleStatusTinTuc(1)"><i class="far fa-check-circle"></i>Kích hoạt</a>
                                                    <a class="dropdown-item" @click="changeMultipleStatusTinTuc(0)"><i class="far fa-times-circle"></i>Bỏ kích hoạt</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive list-data">
                                        <table class="table table-hover mb-0 zero-configuration">
                                            <thead class="custom-header">
                                                <tr>
                                                    <th class="width-id d-flex">
                                                        <li class="d-inline-block mr-1">
                                                            <fieldset>
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" v-model="selectAll">
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
                                                    <th style="width:14%;">Avatar</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Trạng thái</th>
                                                    <th>Thể loại</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="tinTuc.length > 0">
                                                <tr v-for="(item, indexTinTuc) in tinTuc" :key="indexTinTuc">
                                                    <td class="d-flex" style="padding-top:34px">
                                                        <li class="d-inline-block mr-1">
                                                            <fieldset>
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" v-model="selected" :value="item.id">
                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                        {{item.id}}</td>
                                                    <td class="text-left"><a data-toggle="tooltip"  data-placement="top" :title="`Xem trước chi tiết tin`" :href="`/tin-tuc/${item.id}/${ChangeToSlug(item.title)}`" target="_blank">{{item.title}}</a></td>
                                                    <td>
                                                        <span><img v-lazy="item.thuml != null && item.thuml.startsWith('https') ? item.thuml : `/uploads/news/${item.thuml}`" :alt="`${item.thuml}`" style="object-fit: cover;" width="55" height="55"></span>
                                                    </td>
                                                    <td>{{ConvertDate(item.created_at)}}</td>
                                                    <td v-if="item.status == 0">
                                                        <div class="chip-text"><i style="font-size: 20px;" class="fa fa-clock danger" data-toggle="tooltip"  data-placement="top" :title="`Chưa kích hoạt`"></i></div>
                                                    </td>
                                                    <td v-if="item.status == 1">
                                                        <div class="chip-text"><i style="font-size: 20px" class="far fa-check-circle success" data-toggle="tooltip"  data-placement="top" :title="`Đã kích hoạt`"></i></div>
                                                    </td>
                                                    <td style="white-space: nowrap;">
                                                        <span v-if="item.id_category == 1">Cẩm nang</span>
                                                        <span v-if="item.id_category == 2">Xuất khẩu lao động</span>
                                                        <span v-if="item.id_category == 3">Du học</span>
                                                    </td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75  waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a v-if="$auth.user.role == 4"  v-on:click="changeStatus(item.id)" class="dropdown-item"> <i :class="item.status == 1 ? 'far fa-times-circle' : 'far fa-check-circle'"></i>{{ item.status == 1 ? 'Bỏ kích hoạt' : "Kích hoạt" }}</a>
                                                                        <a :href="`/admin/news/edit/${item.id}`" class="dropdown-item" style="margin-top:5px"><i class="far fa-edit"></i> Sửa</a>
                                                                        <a v-on:click="deleteNews(item.id)" class="dropdown-item" style="margin-top:5px"><i class="far fa-trash-alt"></i> Xóa</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="mb-0 text-center p-1 font-italic" v-if="tinTuc.length == 0">Không có dữ liệu nào.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <infinite-loading
                                v-if="tinTuc.length"
                                spinner="bubbles"
                                @infinite="infiniteScroll" style="padding:20px; width:100%"
                            >
                            <div slot="no-more" style="font-size:15px; font-style: italic">Hết tin</div>
                            <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
                        </infinite-loading>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
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
        ]
    },
    components: {
        Multiselect,
    },
    data() {
        return {
            tinTuc: [],
            cardSearch: {
                search: "",
                searchStatus: "",
                searchTitle: "",
                searchCategory: ""
            },
            categories: [
                {id: 1, name: 'Xuất khẩu lao động'},
                {id: 2, name: 'Du học'},
                {id: 3, name: 'Tu nghiệp sinh'}
            ],
            status: [
                {id: 1, name: 'Đã kích hoạt'},
                {id: 0, name: 'Chưa kích hoạt'},
            ],
            id: null,
            selected: [],
            page: 1
        }
    },
    created() {
        this.search();
    },
    methods: {
        nameWithLang ({ name, id }) {
            return `${name}`
        },
        async changeStatus(id){
            try {
                    let response = await this.$axios.post('tintuc/changeStatusTinTuc',{
                    id: id
                });
                if(response.data.status == 200) {
                    this.$swal(
                        'Thành công!',
                        response.data.message,
                        'success'
                        )
                    this.search()
                    
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
        async deleteNews(id){
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
                        let response = await this.$axios.post('tintuc/deleteTinTuc',{id: id});
                        if(response.data.status == 200) {
                            this.$swal('Thành công', response.data.message, 'success');
                            this.tinTuc = this.tinTuc.filter((e)=>e.id !== id )
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
        sortAscendingID() {
            this.tinTuc.sort((a, b) => a.id > b.id ? 1 : -1);
            },
        sortDecreaseID() {
            this.tinTuc.sort((a, b) => a.id < b.id ? 1 : -1);
        },
        search(){
            this.$axios.$get(
            'tintuc/searchTinTuc?searchCategory=' 
            + ((this.cardSearch.searchCategory.id)?this.cardSearch.searchCategory.id:'') 
            + '&searchStatus='+ ((this.cardSearch.searchStatus.id !=null)?this.cardSearch.searchStatus.id:'') 
            + '&search='+ ((this.cardSearch.search)?this.cardSearch.search:'')
            + '&searchTitle='+ ((this.cardSearch.searchTitle)?this.cardSearch.searchTitle:'')
            ).then((response)=>{
	             this.tinTuc=response.data;
	        });
        },
        async changeMultipleStatusTinTuc(statusTinTuc){
            try {
                this.$axios.$post('tintuc/changeMultipleStatusTinTuc',{id:JSON.stringify(this.selected), status: statusTinTuc}).then((res) => {
                if(JSON.stringify(this.selected).length == 2){
                    this.$swal({
                        title: 'Bạn chưa chọn tin!',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        this.search()
                        this.selected = []
                    })
                        
                    
                }
                else if(res.status == 200){
                    this.$swal({
                        title: 'Thành công',
                        text: res.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        this.search()
                        this.selected = []
                    })
                }
                else {
                this.$swal(
                    'Lỗi!',
                    res.message,
                    'error'
                    )
                }
                }
            );
            } catch (error) {
                this.$swal(
                    'Lỗi!',
                    'Lỗi bỏ kích hoạt!',
                    'error'
                )
            }
        },
        async deleteMultipleTinTuc(){
            if(JSON.stringify(this.selected).length == 2){
                this.$swal({
                    title: 'Lỗi',
                    icon: 'warning',
                    title: 'Bạn chưa chọn tin!'
                })
            }
            else{
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
                            let response = await this.$axios.post('tintuc/deleteMultipleTinTuc',{id: JSON.stringify(this.selected)});
                            if(response.data.status == 200) {
                                this.search();
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
                        'Lỗi bỏ kích hoạt!',
                        'error'
                    )
                }
                }
            
        },
        async changePublic(index){
            try {
                    let response = await this.$axios.post('tintuyendung/changePublic',{
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
                        this.search(),
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
        infiniteScroll($state) {
            setTimeout(() => {
                this.page++
                this.$axios
                .get(
            'tintuc/searchTinTuc?searchCategory=' 
            + ((this.cardSearch.searchCategory.id)?this.cardSearch.searchCategory.id:'') 
            + '&searchStatus='+ ((this.cardSearch.searchStatus.id !=null)?this.cardSearch.searchStatus.id:'') 
            + '&search='+ ((this.cardSearch.search)?this.cardSearch.search:'')
            + '&searchTitle='+ ((this.cardSearch.searchTitle)?this.cardSearch.searchTitle:'')
            + '&page='+this.page
            )
                .then((response) => {
                    if (response.data.data.length > 1) {
                        response.data.data.forEach((item) => this.tinTuc.push(item))
                        $state.loaded()
                    } else {
                        $state.complete()
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
            }, 500)
        },
        resetForm(){
                this.cardSearch.search = "",
                this.cardSearch.searchStatus = "",
                this.cardSearch.searchTitle = "",
                this.cardSearch.searchCategory = ""
        }

    },
    computed: {
    selectAll: {
      get() {
        if (this.tinTuc && this.tinTuc.length > 0) { // A news array exists with at least one item
          let allChecked = true;

          this.tinTuc.forEach((item) => {
            if (!this.selected.includes(item.id)) {
              allChecked = false; // If even one is not included in array
            }
            
            // Break out of loop if mismatch already found
            if(!allChecked) return;
          });

          return allChecked;
        }

        return false;
      },
      set(value) {
        const checked = [];

        if (value) {
          this.tinTuc.forEach((item) => {
            checked.push(item.id);
          });
        }

        this.selected = checked;
      }
    },
  }
}
</script>
<style scoped>
.pagination .page-item.active .page-link{
    background-color: #ffb701 !important;
}
.btn.btn-white {
    border-radius: 5px !important;
}
.actions-dropodown {
    box-shadow: none !important;
}
</style>