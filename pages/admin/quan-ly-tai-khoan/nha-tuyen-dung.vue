<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Danh sách nhà tuyển dụng</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/">Quản lý tài khoản</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Danh sách nhà tuyển dụng
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- filter start -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tìm kiếm</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse" data-toggle="tooltip"  data-placement="top" :title="`Thu gọn tìm kiếm`"><i class="feather icon-chevron-down"></i></a></li>
                                    <li><a @click="resetForm()" data-toggle="tooltip"  data-placement="top" :title="`Làm mới tìm kiếm`"><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
                                    <li><a data-action="close" data-toggle="tooltip"  data-placement="top" :title="`Đóng tìm kiếm`"><i class="feather icon-x"></i></a></li>
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
                                                <fieldset class="form-group">
                                                    <multiselect @input="search()" :allow-empty="false" v-model="cardSearch.searchBlock" :options="block" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn tình trạng" style="font-size:14px"></multiselect>
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
                    <!-- filter end -->
            <div class="content-body">
                <section id="Ntd"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex">
                                    <div class="flex-grow-1 row input_date">
                                        <div class="input-group col-md-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text p-0 pl-1 pr-1">Từ</span>
                                            </div>
                                            <input type="date" class="ag-grid-filter form-control" v-model="cardSearch.searchFromDate" id="filter-text-box" placeholder="" />
                                        </div>
                                        <div class="input-group col-md-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text p-0 pl-1 pr-1">Đến</span>
                                            </div>
                                            <input type="date" class="ag-grid-filter form-control" v-model="cardSearch.searchToDate" id="filter-text-box" placeholder="" />
                                        </div>
                                        <div class="col-md-4">
                                            <button @click="searchDate()" class="btn-add btn bg-netbee text-dark"><i class="far fa-filter"></i> Lọc</button>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 d-flex justify-content-end">
                                        <div class="action-btns pr-2">
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
                                                        <a class="dropdown-item" @click="changeMultipleStatusNTD(1)"><i class="far fa-check-circle"></i>Kích hoạt</a>
                                                        <a class="dropdown-item" @click="changeMultipleStatusNTD(0)"><i class="far fa-times-circle"></i>Bỏ kích hoạt</a>
                                                    </div>
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
                                                    <th>Tên NTD</th>
                                                    <th style="width:14%;">Avatar</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Trạng thái</th>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="listNTD.length > 0">
                                                <tr v-for="(item, index) in listNTD" :key="index">
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
                                                    <td class="text-left"><a data-toggle="tooltip" :title=item.name data-placement="top" target="_blank">{{item.name}}</a></td>
                                                    <td>
                                                        <span><img v-lazy="item.avatar" style="object-fit: cover;" width="55" height="55"></span>
                                                    </td>
                                                    <td :title=item.created_at>{{ConvertDate(item.created_at)}}</td>
                                                    <td v-if="item.status == 0">
                                                        <div class="chip-text"><i style="font-size: 20px;" class="far fa-times-circle danger" data-toggle="tooltip"  data-placement="top" :title="`Chưa kích hoạt`"></i></div>
                                                    </td>
                                                    <td v-if="item.status == 1">
                                                        <div class="chip-text"><i style="font-size: 20px" class="far fa-check-circle success" data-toggle="tooltip"  data-placement="top" :title="`Đã kích hoạt`"></i></div>
                                                    </td>
                                                    <td class="text-left"><a data-toggle="tooltip"  data-placement="top" :title=item.email target="_blank">{{item.email}}</a></td>
                                                    <td class="text-left"><a data-toggle="tooltip"  data-placement="top" :title=item.phone target="_blank">{{item.phone}}</a></td>
                                                    <td class="text-left"><a data-toggle="tooltip"  data-placement="top" :title=item.address_detail target="_blank">{{item.address_detail}}</a></td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Chọn thao tác
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a v-if="$auth.user.role == 4"  v-on:click="changeStatus(item.id)" class="dropdown-item"> <i :class="item.status == 1 ? 'far fa-times-circle' : 'far fa-check-circle'"></i>{{ item.status == 1 ? 'Bỏ kích hoạt' : "Kích hoạt" }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="mb-0 text-center p-1 font-italic" v-if="listNTD.length == 0">Không có dữ liệu nào.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <infinite-loading
                                v-if="listNTD.length"
                                spinner="bubbles"
                                @infinite="infiniteScroll" style="padding:20px; width:100%"
                            >
                            <div slot="no-more" style="font-size:15px; font-style: italic">Hết</div>
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
    name: 'ListNTD',
        layout: 'admin',
    head: {
        title: 'Danh sách tài khoản nhà tuyển dụng',
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
            listNTD: [],
            cardSearch: {
                search: "",
                searchStatus: "",
                searchBlock: "",
                searchName: "",
                searchFromDate: "",
                searchToDate: ""
            },
            block: [
                {id: 0, name: 'Đang hoạt động'},
                {id: 1, name: 'Blocked'},
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
        
        changeStatus(id){
            this.$axios.$post('changeStatusNTD',{id: id}).then((response) => {
                if(response.status == 200) {
                    this.$swal(
                        'Thành công!',
                        response.message,
                        'success'
                        )
                    this.search()
                }
                else {
                    this.$swal(
                        'Lỗi!',
                        response.message,
                        'error'
                        )
                }
            }).catch((e) => {
                this.$swal(
                    'Lỗi!',
                    'Lỗi bỏ kích hoạt!',
                    'error'
                )
            })
            
        },
        searchDate(){
            return this.search();
        },
        search(){
            this.$axios.$get(
            'searchNTD?searchBlock=' 
            + ((this.cardSearch.searchBlock.id)?this.cardSearch.searchBlock.id:'') 
            + '&searchStatus='+ ((this.cardSearch.searchStatus.id !=null)?this.cardSearch.searchStatus.id:'') 
            + '&search='+ ((this.cardSearch.search)?this.cardSearch.search:'')
            + '&searchName='+ ((this.cardSearch.searchName)?this.cardSearch.searchName:'')
            + '&searchFromDate='+ ((this.cardSearch.searchFromDate)?this.cardSearch.searchFromDate:'')
            + '&searchToDate='+ ((this.cardSearch.searchToDate)?this.cardSearch.searchToDate:'')
            ).then((response)=>{
                 this.listNTD=response.data;
	        });
        },

        async changeMultipleStatusNTD(statusNTD){
            try {
                this.$axios.$post('changeMultipleStatusNTD',{id:JSON.stringify(this.selected), status: statusNTD}).then((res) => {
                if(JSON.stringify(this.selected).length == 2){
                    this.$swal({
                        title: 'Bạn chưa chọn nhà tuyển dụng!',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        this.search()
                        this.selected = []
                    })
                }
                else if(res.status == 200){
                    this.search()
                    this.$swal({
                        title: 'Thành công',
                        text: res.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        
                    }).then(() => {
                        console.log('ok')
                        
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
        sortAscendingID() {
            this.listNTD.sort((a, b) => a.id > b.id ? 1 : -1);
            },
        sortDecreaseID() {
            this.listNTD.sort((a, b) => a.id < b.id ? 1 : -1);
        },
        infiniteScroll($state) {
            setTimeout(() => {
                this.page++
                this.$axios
                .get(
            'searchNTD?searchBlock='
            + ((this.cardSearch.searchBlock.id)?this.cardSearch.searchBlock.id:'') 
            + '&searchStatus='+ ((this.cardSearch.searchStatus.id !=null)?this.cardSearch.searchStatus.id:'') 
            + '&search='+ ((this.cardSearch.search)?this.cardSearch.search:'')
            + '&searchName='+ ((this.cardSearch.searchName)?this.cardSearch.searchName:'')
            + '&searchFromDate='+ ((this.cardSearch.searchFromDate)?this.cardSearch.searchFromDate:'')
            + '&searchToDate='+ ((this.cardSearch.searchToDate)?this.cardSearch.searchToDate:'')
            + '&page='+this.page
            )
                .then((response) => {
                    if (response.data.data.length > 1) {
                        response.data.data.forEach((item) => this.listNTD.push(item))
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
                this.cardSearch.searchName = "",
                this.cardSearch.searchBlock = "",
                this.cardSearch.searchFromDate = "",
                this.cardSearch.searchToDate = ""
        }
    },
    computed: {
        selectAll: {
            get() {
                if (this.listNTD && this.listNTD.length > 0) { // A news array exists with at least one item
                let allChecked = true;

                this.listNTD.forEach((item) => {
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
                this.listNTD.forEach((item) => {
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
.input_date input{
    /* max-height: 34px; */
    padding: 5px;
}
</style>