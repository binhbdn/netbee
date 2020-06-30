<template>    
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Danh sách quảng cáo</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Danh sách quảng cáo
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
                                    <button class="btn-add btn bg-netbee text-dark " v-on:click="openModalCreate()"><i class="far fa-folder-plus"></i> Tạo quảng cáo</button>                                 
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive list-data">
                                        <table class="table table-hover mb-0 zero-configuration">
                                            <thead class="custom-header">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tên quảng cáo</th>
                                                    <th>Hình ảnh</th>                                                    
                                                    <th>Trạng thái</th>  
                                                    <th>Ngày tạo</th>  
                                                    <th>Hành động</th>                                               
                                                </tr>
                                            </thead>
                                            <tbody v-if="listAdvertisement.length > 0">                                               
                                                <tr v-for="(item,key) in listAdvertisement" :key="key">
                                                    <td>{{item.id}}</td>
                                                    <td>{{item.name}}</td>
                                                    <td>
                                                        <span><img v-lazy="item.thuml != null && item.thuml.startsWith('https') ? item.thuml : `/uploads/news/${item.thuml}`" :alt="`${item.thuml}`" style="object-fit: cover;" width="55" height="55"></span>
                                                    </td>                                                  
                                                    <td v-if="item.status == 0">
                                                        <div class="chip-text"><i style="font-size: 20px;" class="far fa-times-circle danger" data-toggle="tooltip"  data-placement="top" :title="`Chưa kích hoạt`"></i></div>
                                                    </td>
                                                    <td v-if="item.status == 1">
                                                        <div class="chip-text"><i style="font-size: 20px" class="far fa-check-circle success" data-toggle="tooltip"  data-placement="top" :title="`Đã kích hoạt`"></i></div>
                                                    </td>
                                                    <td>{{ConvertDate(item.created_at)}}</td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Chọn thao tác
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a v-on:click="changeStatus(item.id)" class="dropdown-item"> <i :class="item.status == 1 ? 'far fa-times-circle' : 'far fa-check-circle'"></i>{{ item.status == 1 ? 'Bỏ kích hoạt' : "Kích hoạt" }}</a>
                                                                        <a v-on:click="updateId(item.id)" class="dropdown-item"> <i class="far fa-edit"></i>Sửa</a>
                                                                        <a v-on:click="deleted(item.id)" class="dropdown-item" > <i class="far fa-times-circle"></i>Xóa</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="mb-0 text-center p-1 font-italic" v-if="listAdvertisement.length == 0">Không có dữ liệu nào.</p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="modal fade" id="create_insert" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-netbee">
                                <h4 class="modal-title text-dark">Tạo quảng cáo</h4>
                                <button type="button" class="close ma-0" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-dark">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modal_body">
                                <ValidationObserver v-slot="{ invalid }">
                                    <form class="w-100 px-2" method="post">
                                        <div class="row">
                                            <div class="col-12" id="hegimg">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Ảnh quảng cáo</label>
                                                    <ImgUploader :files="files"></ImgUploader>
                                                </fieldset>
                                            </div>
                                            <div class="col-12" id="hegtitle">
                                                <ValidationProvider rules="required" v-slot="{ errors }">
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">Tên quảng cáo</label>
                                                        <input type="text" class="form-control" id="basicInput" placeholder="Tên quảng cáo" v-model="insertAdvertisement.name">
                                                        <span style="color: red">{{ errors[0] }}</span>
                                                    </fieldset>
                                                </ValidationProvider>
                                            </div>
                                            <div class="col-12 text-right">
                                                <button type="submit" class="btn btn-warning" v-bind:disabled="invalid" v-on:click="upload">Tạo</button>
                                            </div>
                                        </div>
                                    </form>
                                </ValidationObserver>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="create_update" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-netbee">
                                <h4 class="modal-title text-dark">Cập nhật quảng cáo</h4>
                                <button type="button" class="close ma-0" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-dark">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modal_body">
                                <ValidationObserver v-slot="{ inval }">
                                    <form class="w-100 px-2" method="post">
                                        <div class="row">
                                            <div class="col-12" id="hegimg">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Ảnh quảng cáo</label>
                                                    <ImgUploader :files="filesUp" :thuml="updateAdvertisement.picture"></ImgUploader>
                                                </fieldset>
                                            </div>
                                            <div class="col-12" id="hegtitle">
                                                <ValidationProvider rules="required" v-slot="{ errors }">
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">Tên quảng cáo</label>
                                                        <input type="text" class="form-control" id="basicInput" placeholder="Tên quảng cáo" v-model="updateAdvertisement.name">
                                                        <span style="color: red">{{ errors[0] }}</span>
                                                    </fieldset>
                                                </ValidationProvider>
                                            </div>
                                            <div class="col-12 text-right">
                                                <button type="submit" class="btn btn-warning" v-bind:disabled="inval" v-on:click="uploadUp">Tạo</button>
                                            </div>
                                        </div>
                                    </form>
                                </ValidationObserver>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</template>

<script>           
    var Vue = require('vue');
    import ImgUploader from '~/components/ImgUploader';
    import { ValidationObserver } from "vee-validate/dist/vee-validate.full";
    import {ValidationProvider, extend} from "vee-validate/dist/vee-validate.full";
    extend("required", {
        message: (field, values) => "Dữ liệu nhập vào không được để trống.",
    });
    extend("image", {
        message: (field, values) => "Định dạng ảnh không phù hợp.",
    });
    export default {
        name: 'Advertisement',
        layout: 'admin',
       
        data(){
            return {
                filesUp: [null],
                files: [],
                listAdvertisement:[],
                insertAdvertisement:{
                    id:'',
                    name:'',
                    picture: []
                },
                updateAdvertisement:{
                    name:'',
                    picture: ''
                },
            }
        },        
        components:{
            ImgUploader,
            ValidationObserver,
            ValidationProvider
        },
        
        methods: {
            updateId :function(id) {
                try {
                    this.$axios.post('advertisement/getIdAdvertisement',{id :id})
                    .then(response => {   
                        if(response.data.status == 200) {                                                       
                            this.updateAdvertisement = response.data.data
                            $('#create_update').modal();
                        } else {
                            this.$swal(
                                'Lỗi',
                                response.data.message,
                                'error'
                            )
                        }
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
                } catch (error) {
                    this.$swal(
                        'Lỗi!',
                        'Lỗi dữ liệu',
                        'error'
                    )
                }
            },
            changeStatus :function(id){
                try {
                    this.$axios.post('advertisement/changeStatus',{id: id})
                    .then( response => {
                        if(response.data.status == 200) {
                            this.$swal(
                                'Thành công',
                                response.data.message,
                                'success'
                            ).then( function (){
                                window.location.reload()
                            } )
                        }else{
                            this.$swal(
                                'Lỗi',
                                response.data.message,
                                'error'
                            )
                        }
                    }).catch(error => {
                        console.log(error.response)
                    });
                }  
                catch(error) {
                    this.$swal(
                        'lỗi!',
                        'lỗi dữ liệu',
                        'error'
                    )
                } 
            },
            deleted :function(id){
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
                            this.$axios.post('advertisement/deleted',{id: id})
                            .then( response => {
                                if(response.data.status == 200) {
                                    this.$swal(
                                        'Thành công',
                                        response.data.message,
                                        'success'
                                    ).then( function (){
                                        window.location.reload()
                                    } )
                                }else{
                                    this.$swal(
                                        'Lỗi',
                                        response.data.message,
                                        'error'
                                    )
                                }
                            }).catch(error => {
                                console.log(error.response)
                            });
                        } else {
                            this.$swal('Hủy', 'Quảng cáo được giữ lại', 'info')
                        }
                    })
                } catch(error) {
                    this.$swal(
                        'Lỗi',
                        'Lỗi dữ liệu',
                        'error'
                    )
                }
            },
            uploadUp :function(e){
                try {
                    e.preventDefault()
                    var form = new FormData();
                    if(this.filesUp[0]){
                        form.append('picture' , this.filesUp[0])
                    }
                    form.append('id' , this.updateAdvertisement.id)
                    form.append('name' , this.updateAdvertisement.name)
                                                    
                    this.$axios.post('advertisement/updateAdvertisement',form)
                    .then(response => {
                        if(response.data.status == 200) {
                            this.$swal(
                                'Thành công',
                                response.data.message,
                                'success'
                            ).then( function (){
                                window.location.reload()
                            } )
                        }else{
                            this.$swal(
                                'Lỗi',
                                response.data.message,
                                'error'
                            )
                        }
                    }).catch(error => {
                        console.log(error.response)
                    });
                }
                catch(error){
                    this.$swal(
                        'Lỗi!',
                        'Lỗi dữ liệu!',
                        'error')
                }
            },
            upload :function(e){
                try {
                    e.preventDefault()
                    var form = new FormData();
                    form.append('picture' , this.files[0])
                    form.append('name' , this.insertAdvertisement.name)
                                                    
                    this.$axios.post('advertisement/insertAdvertisement',form)
                    .then(response => {
                        if(response.data.status == 200) {
                            this.$swal(
                                'Thành công',
                                response.data.message,
                                'success'
                            ).then( function (){
                                window.location.reload()
                            } )
                        }else{
                            this.$swal(
                                'Lỗi',
                                response.data.message,
                                'error'
                            )
                        }
                    }).catch(error => {
                        console.log(error.response)
                    });
                }
                catch(error){
                    this.$swal(
                        'Lỗi!',
                        'Lỗi dữ liệu!',
                        'error')
                }
            },
            openModalCreate :function(){
                $('#create_insert').modal();
            },
            fetchdata :function(){
                try {
                    this.$axios.get('advertisement/getAdvertisement')
                    .then(response => {                                                          
                        this.listAdvertisement = response.data.data
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
                }
                catch (error) {
                    this.$swal(
                        'Lỗi!',
                        'Lỗi dữ liệu!',
                        'error')
                }            
             }
        },        
        mounted() {             
            this.fetchdata()
        }
    };
</script>
<style scoped>
    
</style>