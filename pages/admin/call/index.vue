<template>    
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Danh sách lịch phỏng vấn</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a :href="`/admin/`">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a :href="`/admin/call`">Phỏng vấn trực tuyến</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Danh sách lịch phỏng vấn
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="News"> 
                    <div class="row" v-if="$auth.user.role == 4 || $auth.user.role == 2">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body card-dashboard">
                                    <div class="main-call">
                                        <br>
                                        <h2 class="content-header-title mb-0">Danh sách Phòng đã tạo</h2><br>                                     
                                        <p v-if="listCall.length == 0">Bạn chưa có phòng nào!</p>
                                        <div  v-if="listCall.length > 0" id="select">
                                            <div class="list-pv" v-for="(item,key) in listCall" :key="key">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h4 class="title-h4">【{{item.nbjob.id}}】<span>{{item.nbjob.title}}</span></h4>
                                                        <!-- <p class="title-p"><i class="fa fa-building"></i><span> {{item.name}}</span></p> -->
                                                        <p v-bind:class="{'title-span': new Date(item.apply.interview_schedules) != new Date(),'title-span-err': new Date(item.apply.interview_schedules) < new Date(),'title-span-succ': new Date(item.apply.interview_schedules).getDate() == new Date().getDate() && new Date(item.apply.interview_schedules).getMonth() == new Date().getMonth()}"><i class="fa fa-clock"></i><span> {{item.apply.interview_schedules}}</span></p>                            
                                                        <p class="title-pan">Phòng:<span> {{item.id_room}}</span></p>
                                                    </div>
                                                    <div class="col-md-4">                                                        
                                                         <div class="action-btns" style="margin-top: 20px;">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Chọn thao tác
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a  @click="join(item.id_room)"  class="dropdown-item"> <i class="far fa-edit"></i>Vào phòng</a>
                                                                        <a  @click="his(item.id_room)" class="dropdown-item" > <i class="far fa-times-circle"></i>lịch sử</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body card-dashboard">
                                    <div class="main-call">
                                        <br>
                                        <h2 class="content-header-title mb-0">Danh sách lịch phỏng vấn</h2><br>                                     
                                        <p v-if="listInterview.length == 0">Không có lịch phỏng vấn nào!</p>
                                        <div  v-if="listInterview.length > 0" id="select">
                                            <div class="list-pv" v-for="(item,key) in listInterview" :key="key">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <h4 class="title-h4">【{{item.idjob}}】<span>{{item.title}}</span></h4>
                                                        <p class="title-p"><i class="fa fa-building"></i><span> {{item.name}}</span></p>
                                                        <p v-bind:class="{'title-span': new Date(item.start) != new Date(),'title-span-err': new Date(item.start) < new Date(),'title-span-succ': new Date(item.start).getDate() == new Date().getDate() && new Date(item.start).getMonth() == new Date().getMonth()}"><i class="fa fa-clock"></i><span> {{item.start}}</span></p>                            
                                                        <p class="title-pan" v-if="item.status_call == 2">Phòng:<span> {{item.id_room}}</span></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                         <a v-if="item.status_call == 2" @click="join(item.id_room)" class="btn btn-bg-top bg-netbee" >Vào</a>
                                                         <button v-if="item.status_call == 1" class="btn btn-bg-top-tao bg-netbee-add" @click="add(item.id,item.id_room,item.idjob)">Tạo</button>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="$auth.user.role == 1 || $auth.user.role == 3">                        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body card-dashboard">
                                    <div class="main-call">
                                        <br>
                                        <h2 class="content-header-title mb-0">Danh sách lịch phỏng vấn</h2><br>                                     
                                        <p v-if="listInterview.length == 0">Không có lịch phỏng vấn nào!</p>
                                        <div  v-if="listInterview.length > 0" id="select">
                                            <div class="list-pv" v-for="(item,key) in listInterview" :key="key">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <h4 class="title-h4">【{{item.idjob}}】<span>{{item.title}}</span></h4>
                                                        <p class="title-p"><i class="fa fa-building"></i><span> {{item.name}}</span></p>
                                                        <p v-bind:class="{'title-span': new Date(item.start) != new Date(),'title-span-err': new Date(item.start) < new Date(),'title-span-succ': new Date(item.start).getDate() == new Date().getDate() && new Date(item.start).getMonth() == new Date().getMonth()}"><i class="fa fa-clock"></i><span> {{item.start}}</span></p>                            
                                                        <p class="title-pan" v-if="item.status_call == 2">Phòng:<span> {{item.id_room}}</span></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                         <a v-if="item.status_call == 2" @click="join(item.id_room)" class="btn btn-bg-top bg-netbee" >Vào</a>
                                                         <button v-if="item.status_call == 1" class="btn btn-bg-top-tao bg-netbee-add" @click="add(item.id,item.id_room,item.idjob)">Tạo</button>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal fade" id="HisCall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lịch sử truy cập</h5>    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                   
                    </div>
                    <div class="modal-body"> 
                        <p v-if="hisCall.length == 0">Không có lịch sử!</p>                                               
                        <p  style="margin-left: 110px;" v-for="(item,key) in hisCall" :key="key">【<b>{{item.user.id}}</b>】<b>{{item.user.name}}</b> <span v-if="item.action == 0">Tạo Phòng</span><span v-if="item.action == 1">Vào Phòng</span><span v-if="item.action == 2">Thoát Phòng</span> <b>{{item.id_room}}</b> vào thời gian <b>{{item.created_at}}</b></p>
                    </div>                  
                    </div>
                </div>
                </div>
        </div>
    </div>  
</template>

<script>                   
    export default {
        name: 'CallIndex',
        layout: 'admin',
       
        data(){
            return {
                listInterview:[],
                listCall:[],
                hisCall:[]
            }
        },        
        components:{
                     
        },
        
        methods: {  
            his($id_room){
                this.$axios.post('lichphongvan/getHisCall',{                  
                    id_room: $id_room,
                }).then(response => {                                                                 
                    this.hisCall = response.data;  
                    $('#HisCall').modal('show');                   
                 })
                 .catch(error => {
                    console.log(error.response);
                }); 
            },
            join($id_room){
                this.$axios.post('lichphongvan/insertHisCall',{                  
                    id_room: $id_room,                 
                    action: 1,
                }).then(response => {                                                           
                    if(response.data.status == 200) {                       
                        window.location.href = '/admin/call/phong/'+ $id_room;                        
                    }else{
                        this.$swal(
                            'Lỗi',
                            response.data.message,
                            'error'
                        )
                        if(response.data.status == 400){                            
                            $('input').addClass('your-class');
                            $('textarea').addClass('your-class');                         
                        }                        
                    }
                 })
                 .catch(error => {
                    console.log(error.response);
                });  
            },
            add($id,$id_room,$idjob){                                                                                                                            
                this.$axios.post('lichphongvan/insertAddCall',{
                    id_applies: $id,
                    id_room: $id_room,
                    idjob: $idjob,
                    action: 0,
                }).then(response => {                                                           
                    if(response.data.status == 200) {
                        this.$swal(
                            'Tạo mới thành công',
                            response.data.message,
                            'success'
                            ).then( function (){
                            window.location.href = '/admin/call/phong/'+ $id_room;
                            } )
                    }else{
                        this.$swal(
                            'Lỗi',
                            response.data.message,
                            'error'
                        )
                        if(response.data.status == 400){                            
                            $('input').addClass('your-class');
                            $('textarea').addClass('your-class');                         
                        }                        
                    }
                 })
                 .catch(error => {
                    console.log(error.response);
                });                
            },           
             fetchdata(){
                 this.$axios.get('lichphongvan/fullCalendar')
                .then(response => {                                                                 
                    this.listInterview = response.data;                     
                 })
                 .catch(error => {
                    console.log(error.response);
                });       
             },
             fetchdataCall(){
                 this.$axios.get('lichphongvan/getCreateCall')
                .then(response => {     
                    console.log(response);                                        
                    this.listCall = response.data;
                    console.log(this.listCall);  
                 })
                 .catch(error => {
                    console.log(error.response);
                });       
             }
        },        
        mounted() {             
            this.fetchdata();
            if(this.$auth.user.role == 2 || this.$auth.user.role == 4){
                this.fetchdataCall();
            }            
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
<style>
.main-call{
    height: 600px;
}
.list-pv{
    box-shadow: 0 0px 10px 0 rgba(0, 0, 0, 0.1);
    border: 1px solid #fff;
    margin: 10px;   
}
.list-pv:hover{
    box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.1); 
    border: 1px solid rgba(0, 0, 0, 0.1);   
    transition: 0.3s;
}
#select {
    overflow-x: hidden;
    overflow-y: scroll;     
    width: 100%;
    height: 500px;    
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
#select::-webkit-scrollbar-track {
    border: 1px solid #fff;
    padding: 2px 0;
    background-color: #fff;
}

#select::-webkit-scrollbar {
    width: 10px;
}

#select::-webkit-scrollbar-thumb {
    border-radius: 10px;   
    background-color: #D6DCE1;
    border: 1px solid #D6DCE1;
}
.title-h4{
    font-size: 16px;
    padding-top: 12px;
}
.title-p,.title-span,.title-pan{
    padding-left: 10px;
    margin-bottom: 2px;
}
.title-span-err {
    padding-left: 10px;
    margin-bottom: 2px;
    color: red;
}
.title-span-succ{
    padding-left: 10px;
    margin-bottom: 2px;
    color: forestgreen;
}
.bg-netbee-add{
    background-color: limegreen;
}
.bg-netbee-add:hover{
    color: #fff;
}
.btn-bg-top{
    margin-top: 30%;
}
.btn-bg-top-tao{
    margin-top: 20%;
}

</style>