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
                                                                     
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive list-data">
                                        <table class="table table-hover mb-0 zero-configuration">
                                            <thead class="custom-header">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Phần trăm Bonus</th>                          
                                                    <th>Ngày tạo</th>  
                                                    <th>Ngày cập nhật</th>  
                                                    <th>Hành động</th>                 
                                                </tr>
                                            </thead>
                                            <tbody >                                               
                                                <tr>
                                                    <td>{{settingBonus.id}}</td>
                                                    <td>{{settingBonus.percent_bonus}} %</td>
                                                    <td>{{settingBonus.created_at}}</td>
                                                    <td>{{settingBonus.updated_at}}</td>
                                                    <td>
                                                        <div data-toggle="tooltip"  data-placement="top" :title="`Cập nhật bonus`">
                                                    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
														  	Cập nhật bonus
														</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cập nhật bonus -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Cập nhật phần trăm bonus</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	Nhập % bonus
					        <input class="form-control" type="number" id="percent_bonus" placeholder="Nhập % bonus" v-model="percent_bonus" min="1" max="2">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					        <button class="btn bg-netbee" data-toggle="tooltip"  data-placement="top" :title="`Cập nhật`" @click="updateBonus()">Cập nhật</button>
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
        name: 'bonus',
        layout: 'admin',
        middleware: 'blockUsers',
        data(){
            return {
                settingBonus: [],
                percent_bonus: ' ',
            }
        },        
        components:{
                     
        },
        
        methods: {              
            fetch() {
            	this.$axios.$get('/tintuyendung/getSettingBonus').then((response) => {
		          this.settingBonus = response
		        })
            },
            updateBonus(){
            	var form = new FormData();
	            form.append('percent_bonus',this.percent_bonus);
	            console.log(this.percent_bonus)
            	this.$axios.post('/tintuyendung/postSettingBonus',form).then((response)=>{
	                if(response.data.status == 200) {
	                    this.$swal(
	                        'Cập nhật thành công!',
	                        response.data.message,
	                        'success'
	                    ).then( function (){
	                            window.location.reload();
	                        } )
	                }else{
	                    this.$swal(
	                        'Lỗi',
	                        response.data.message,
	                        'error'
	                    )
	                }
	            })
            }
        },        
        mounted() {             
            this.fetch()
        }
    };
</script>
<style scoped>
    .btn-primary {
    border-color: #ffb701 !important;
    background-color: #ffb701 !important;
    color: #000 !important;
    }
    .btn-secondary:hover{
    background-color: #ffb701 !important;
    }
</style>