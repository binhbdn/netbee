<template>    
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            
            <div class="content-body" style="margin-top: 10px;margin-bottom: 9px;">
                <section id="News"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div style="margin:20px;">                                    
                                    <fullcalendar></fullcalendar>                                  
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
        name: 'Calendar',
        layout: 'admin',
       
        data(){
            return {
                
            }
        },        
        components:{
               
        },
        
        methods: {           
            fetchdata(){
                        
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