<template>    
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Danh sách hồ sơ ứng tuyển</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/">Hồ sơ ứng tuyển</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Danh sách hồ sơ ứng tuyển
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
                                <div class="card-header col-12" style="padding-left:15px;">
                                    <form class="col-9" action="/admin/ho-so/tao-ho-so" method="">
                                        <button class="btn-add btn bg-netbee text-dark "><i class="far fa-folder-plus"></i> Tạo hồ sơ ứng tuyển</button>
                                    </form>                                  
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive list-data">
                                        <table class="table table-hover mb-0 zero-configuration">
                                            <thead class="custom-header">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Họ tên</th>
                                                    <th>Ngày sinh</th>                                                   
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Ngày tạo</th>    
                                                    <th>Hành động</th>                                               
                                                </tr>
                                            </thead>
                                            <tbody v-if="listProfileUser.length > 0">                                               
                                                <tr v-for="(item,key) in listProfileUser" :key="key">
                                                    <td>{{item.id}}</td>
                                                    <td>{{item.fullname_profile}}</td>
                                                    <td>{{item.birthday_profile}}</td>                                                    
                                                    <td>{{item.email_profile}}</td>
                                                    <td>{{item.phone_profile}}</td>
                                                    <td>{{item.created_at}}</td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Chọn thao tác
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a :href="`/admin/ho-so/sua-ho-so/${item.id}`" class="dropdown-item"> <i class="far fa-edit"></i>Xem chi tiết</a>
                                                                        <a @click="deleted(item.id)" class="dropdown-item" > <i class="far fa-times-circle"></i>Xóa</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="mb-0 text-center p-1 font-italic" v-if="listProfileUser.length == 0">Không có dữ liệu nào.</p>
                                        <br>
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
    var Vue = require('vue');
    
    export default {
        name: 'CvIndex',
        layout: 'admin',
       
        data(){
            return {
                listProfileUser:[],
            }
        },        
        components:{
                     
        },
        
        methods: {
            async deleted(id){
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
                        let response = await this.$axios.post('hoso/deleteProfileUser',{id: id});
                        if(response.data.status == 200) {
                            this.listProfileUser = this.listProfileUser.filter((e)=>e.id !== id )
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
             fetchdata(){
                 this.$axios.get('hoso/listProfileUser')
                .then(response => {                                                          
                    this.listProfileUser = response.data;
                    console.log(this.listProfileUser);  
                 })
                 .catch(error => {
                    console.log(error.response);
                });             
             }
        },        
        mounted() {             
            this.fetchdata();
        }
    };
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
        border-color: rgb(179, 229, 252) !important;
    }
</style>