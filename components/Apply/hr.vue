<template>
    <div class="content-wrapper">    
       
        <div class="content-body">
            <section id="News"> 
                <div class="row">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-content">
                                <table v-if="AllApply.length > 0" class="table table-hover mb-0 zero-configuration">
                                    <thead>
                                        <tr>
                                            <th style="width:5%;">ID</th>
                                            <th style="width:23%;">Tên công việc</th>
                                            <th style="width:15%;">Tên ứng viên</th>
                                            <th style="width:14%;" v-if="$auth.user.role == 3">Bonus</th>
                                            <th style="width:17%;">Nhà tuyển dụng</th>
                                            <th style="width:13%;">Trạng thái</th>
                                            <th style="width:13%;">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tab-table">
                                        <tr v-for="(item, index) in AllApply" :key="index">
                                            <td>{{item.id}}</td>
                                            <td v-if="item.job">
                                                <a data-toggle="tooltip"  data-placement="top" :title="`Xem trước chi tiết tin`" :href="`/tin-tuyen-sinh/${item.job.id}/${ChangeToSlug(item.job.title)}`" target="_blank">{{item.job.title}} 
                                                </a>
                                                <p>{{item.job_id}}</p>
                                            </td>
                                            <td><p>{{item.name}}</p></td>
                                            <td v-if="$auth.user.role == 3">
                                                <p style="color: #fc205c; margin-bottom: 0 !important;">{{item.bonus - (item.bonus* settingBonus.percent_bonus /100)}} {{ item.job.currency }}</p>
                                            </td>
                                            <td><p class="repon">{{item.user.name}}</p></td>
                                            <td>
                                                <p v-if="item.status == 1" data-toggle="tooltip" data-placement="top" title="Chờ admin xác thực" class="mb-0" style="padding-left: 28px"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></p>
                                                <p v-else-if="item.status == 2 && item.nb_paper == null">Chưa hoàn tất giấy tờ</p>
                                                <p v-else-if="item.nb_paper != null && item.status != 4 && item.status != 5 && item.status != 6">Đã hoàn tất giấy tờ ,Chờ admin xác thực giấy tờ</p>
                                                <p v-else-if="item.status== 4">Nhà tuyển dụng đã tư chối hồ sơ<br> Lý do: {{item.reason_for_rejection}}</p>
                                                <p v-else-if="item.status == 5">Chờ công ty duyệt</p>
                                                <p v-else-if="item.status == 6">Thời gian phỏng vấn<br> {{ item.interview_schedules }}</p>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    <div>
                                                        <a type="button" data-toggle="modal" data-target="#reportModal" @click="idRefuse = item.id" class="btn-repon btn btn-edit-fix-huy py-75 waves-effect waves-light">
                                                        <span data-toggle="tooltip"  data-placement="top" :title="`Hủy`">Hủy</span> 
                                                        </a>
                                                    </div>   
                                                    <div>
                                                        <a :href="`/admin/xac-thuc-ho-so/${item.id}`" type="button" v-if="item.status == 2 && item.nb_paper == null" data-toggle="tooltip"  data-placement="top" :title="`Thêm giấy tờ`" class="btn btn-edit-fix-add">Thêm giấy tờ</a>
                                                    </div>                                                                                                     
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="font-italic" v-else style="color: red;text-align: center;margin-top: 15px !important;">Không có kết quả phù hợp.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editTodoTask" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
               
                    <div class="modal-content">
                        <section class="todo-form">
                            <form id="form-edit-todo" class="todo-input">
                                 <ValidationObserver v-slot="{ invalid }">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTodoTask">Lý do hủy</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"> 
                                    <ValidationProvider rules="required" v-slot="{ errors }">
                                        <fieldset class="form-group">
                                            <textarea class="edit-todo-item-desc form-control" v-model="reason_for_rejection" rows="3" placeholder="Nội dung..."></textarea>
                                            <span style="color: red">{{ errors[0] }}</span>
                                        </fieldset>
                                    </ValidationProvider>
                                </div>
                                <div class="modal-footer">
                                    <fieldset class="form-group position-relative has-icon-left mb-0">
                                        <button type="button" @click="RefuseApply()" :disabled="invalid" class="btn bg-netbee update-todo-item" data-dismiss="modal"><i class="feather icon-edit d-block d-lg-none"></i>
                                            <span class="d-none d-lg-block">Gửi</span></button>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left mb-0">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="feather icon-x d-block d-lg-none"></i>
                                            <span class="d-none d-lg-block">Cancel</span></button>
                                    </fieldset>
                                </div>
                                </ValidationObserver>
                            </form>
                        </section>
                    </div>
                
            </div>
        </div>
    </div>
</template>

<script>
import { ValidationProvider, extend } from 'vee-validate/dist/vee-validate.full';
import { ValidationObserver } from "vee-validate/dist/vee-validate.full";

extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});

export default {
   components: {
        ValidationProvider,
        ValidationObserver
    },
    data() {
        return {
            reason_for_rejection: '',
            idRefuse: '',
            AllApply: [],
            cardSearch: {
                search: "",
                searchStatus: "",
                searchTitle: "",
                searchCategory: ""
            },
            categories: [
                {id: 1, name: 'Ứng viên'},
                {id: 2, name: 'Chuyên viên tuyển sinh'},
            ],
            id: null,
            pageAll: 1,
            active: 1,
            settingBonus: []
        }
    },
    mounted () {
        this.$axios
                .$get('/tintuyendung/getSettingBonus')
                .then((response) => {
                    this.settingBonus = response
                })
                .catch((err) => {
                })
    },
    created() {
        this.fetch();
    },
    methods: {
        nameWithLang ({ name, id }) {
            return `${name}`
        },
        fetch() {
            this.$axios.$get('apply/getAllApply').then((response)=>{
                this.AllApply=response.data;
	        });
        },
        RefuseApply(){
            try{ 
                this.$axios.$post(`apply/RefuseApply/${this.idRefuse}`,{reason_for_rejection: this.reason_for_rejection}).then((response)=>{
                    if(response.status == 200){
                        this.$swal('Thành công', response.message, 'success');
                        location.reload()
                    }else{
                        this.$swal(
                            'Lỗi!',
                            response.message,
                            'error'
                        )
                    }
                });
            } catch (error) {
                this.$swal(
                    'Lỗi!',
                    'Lỗi xóa!',
                    'error')
            }
        },
        // search(){
        //     this.$axios.$get(
        //     'tintuyendung/searchTinTuyenDung?searchCategory=' 
        //     + ((this.cardSearch.searchCategory.id)?this.cardSearch.searchCategory.id:'') 
        //     + '&searchStatus='+ ((this.cardSearch.searchStatus.id !=null)?this.cardSearch.searchStatus.id:'') 
        //     + '&search='+ ((this.cardSearch.search)?this.cardSearch.search:'')
        //     + '&searchTitle='+ ((this.cardSearch.searchTitle)?this.cardSearch.searchTitle:'')
        //     ).then((response)=>{
	    //          this.tinTuyenDung=response.data;
	    //     });
        // },
        // infiniteScroll($state) {
        //     setTimeout(() => {
        //         this.pageAll++
        //         this.$axios
        //         .get('apply/getAllApply'+ '?page='+this.pageAll)
        //         .then((response) => {
        //             console.log(this.AllApply)
        //             console.log(response.data.data)
        //             if (response.data.data.data.length > 1) {
                        
        //                 response.data.data.data.forEach((item) => this.AllApply.push(item))
        //                 $state.loaded()
        //             } else {
        //                 $state.complete()
        //             }
        //             console.log(this.AllApply)
        //         })
        //         .catch((err) => {

        //         })
        //     }, 500)
        // },
        // resetForm(){
        //         this.cardSearch.search = "",
        //         this.cardSearch.searchStatus = "",
        //         this.cardSearch.searchTitle = "",
        //         this.cardSearch.searchCategory = ""
        // }
    },
    computed: {
    }
}
</script>
<style scoped>
    .btn-edit-fix-add, .btn-edit-fix-huy{
        border: 1px solid rgb(255, 183, 1);
        color: #000;
        
    }
    .btn-edit-fix-add{
        padding: 10px;
        margin-top: 5px;
        color: #626262;
    }

    .btn-edit-fix-add:hover{
        background:  rgb(255, 183, 1);
        
    }
    .btn-edit-fix-huy:hover{
        color: #fff !important;
        background: #E42728;
        border: 1px solid #E42728;
    }
    .fa-exclamation-circle{
        font-size: 20px;
        color: #ffb701;
    }  
    @media (max-width: 600px) {
    .table th {
        font-size: 13px;
        padding-left: 0.4rem;
        padding-right: 0;
    }
    .table td{
        padding: 1rem;
        padding-left: 0.4rem;
        padding-right: 0;
    }
    .tab-table p, a {
    word-break:break-all;
    }
      .btn-repon{
    padding: 0.5rem 1rem !important;
    font-size: 0.9rem !important;
      }     
    }
</style>