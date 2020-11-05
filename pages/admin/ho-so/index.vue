<template>    
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-body">
                <section id="News"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header col-12" style="padding-left:15px;">
                                    <h2><i class="fa fa-list" aria-hidden="true"></i> <strong>Danh sách hồ sơ</strong></h2>
                                    <small style="color:red;">Tổng số hồ sơ: {{ listProfileUser.length }}</small>                                  
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <nav style="margin-bottom: 20px;font-size: 16px;">
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link" @click="ChangeTab(1)" data-toggle="tab" href="#dapheduyet" role="tab" aria-selected="false">Đã phê duyệt</a>
                                                    <a class="nav-item nav-link active" @click="ChangeTab(0)" data-toggle="tab" href="#chuapheduyet" role="tab" aria-selected="false">Chờ phê duyệt</a>
                                                    <a class="nav-item nav-link" @click="ChangeTab(2)" data-toggle="tab" href="#all" role="tab" aria-selected="true">Tất cả</a>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="table-responsive list-data">
                                        <table v-if="listProfileUser.length > 0" class="table table-hover mb-0 zero-configuration">
                                            <thead class="custom-header">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Họ tên</th>
                                                    <th>Ngày sinh</th>                                                   
                                                    <th>Email</th>                                               
                                                    <th>Trạng thái</th>  
                                                    <th>Ngày tạo</th>  
                                                    <th>Hành động</th>                                               
                                                </tr>
                                            </thead>
                                            <tbody v-for="(item,key) in listProfileUser" :key="key">                                               
                                                <tr v-if="(activeTab == 2)|(item.status == activeTab)">
                                                    <td>{{item.id}}</td>
                                                    <td class="text-left">{{item.fullname_profile}}</td>
                                                    <td class="txdate">{{ConvertDate(item.birthday_profile)}}</td>                                                    
                                                    <td class="emai-text-left" id="">{{item.email_profile}}</td>                                                   
                                                    <td v-if="item.status == 0">
                                                        <div class=""><i style="font-size: 18px;" class="far fa-clock danger" data-toggle="tooltip"  data-placement="top" :title="`Chưa kích hoạt`"></i></div>
                                                    </td>
                                                    <td v-else>
                                                        <div class="chip-text"><i style="font-size: 18px" class="far fa-check-circle success" data-toggle="tooltip"  data-placement="top" :title="`Đã kích hoạt`"></i></div>
                                                    </td>
                                                    <td>{{ConvertDate(item.created_at)}}</td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-h mr-0 hover-yellow"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a v-if="$auth.user.role == 4"  @click="changeStatus(item.id)" class="dropdown-item"> <i :class="item.status == 1 ? 'far fa-times-circle' : 'far fa-check-circle'"></i>{{ item.status == 1 ? 'Bỏ kích hoạt' : "Kích hoạt" }}</a>
                                                                        <a :href="`/admin/ho-so/xem-ho-so/${item.id}`" class="dropdown-item"> <i class="far fa-edit"></i>Xem chi tiết</a>
                                                                        <a @click="deleted(item.id)" class="dropdown-item" > <i class="far fa-times-circle"></i>Xóa</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p v-else class="mb-0 text-center p-1 font-italic" style="color: red;">Không có kết quả phù hợp.</p>
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
        head: {
            title: 'Quản lý hồ sơ',
        },
        data(){
            return {
                listProfileUser:[],
                activeTab: 0,
            }
        },        
        components:{
                     
        },
        
        methods: {
            ChangeTab: function(newTabOrder){
                this.activeTab = newTabOrder
            },
            async changeStatus(index){
                try {
                        let response = await this.$axios.post('hoso/changeStatus',{
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
                            this.fetchdata(),
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
                        'Lỗi kích hoạt!',
                        'error')
                }
                        
            },
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
                    // console.log(this.listProfileUser);  
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
    i.fa.fa-ellipsis-h.mr-0.hover-yellow:hover {
        color: #ffb701 !important;
    }
    .nav-tabs {
        border-bottom: 1px solid #DAE1E7 !important;
    }
    .nav-tabs .nav-link:hover {
        border-color: #fff !important;
        border-bottom-color: #DAE1E7 !important;
    }
    .nav-tabs .nav-link {
        border-radius: 0;
        padding: 10px;
    }
    .nav-tabs .nav-link.active{
        background-color: #fff;
        border-color: #DAE1E7 #DAE1E7 #F8F8F8 !important;
        border-top: 2px solid #ffb701 !important;
    }
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
    .table{
        color:#000;
    }
    .table td{
        padding: 0.5rem 1rem;
    }
    .btn.btn-white {
        border-radius: 5px !important;
    }
    .actions-dropodown {
        box-shadow: none !important;
    }
     .emai-text-left{
         text-align: left;
     }
    @media (max-width: 1199.98px){
        .table-responsive {
            overflow-x: scroll;
        }
        .table-responsive .table {
            width: 865px ;
        }
    }
    @media (min-width: 376px)and (max-width: 440px ){
         .emai-text-left{
             
         word-break: break-all;
         display: -webkit-box;
        width: 160px;
        }
    }
    @media (max-width: 375px){
         .emai-text-left{
             
         word-break: break-all;
         display: -webkit-box;
        width: 95px;
        }
        .txdate{
        word-break: break-all;
        }
    }
    
</style>