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
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/">Phỏng vấn trực tuyến</a>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body card-dashboard">
                                    <div class="main-call">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body card-dashboard">
                                    <div class="main-call">
                                        
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
        name: 'CallIndex',
        layout: 'admin',
       
        data(){
            return {
                listInterview:[]
            }
        },        
        components:{
                     
        },
        
        methods: {            
             fetchdata(){
                 this.$axios.get('lichphongvan/getInterview')
                .then(response => {                                                          
                    this.listInterview = response.data;
                    console.log(this.listInterview);  
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
<style>
.main-call{
    height: 600px;
}
</style>