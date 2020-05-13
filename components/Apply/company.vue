<template>
    <div class="content-wrapper">    
        <!-- News filter start -->
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
                                    <div class="col-12 col-sm-4 col-lg-4">
                                        <input type="text"  class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.search" id="filter-text-box" placeholder="Tìm kiếm...." />
                                    </div>
                                    <div class="col-12 col-sm-4 col-lg-4">
                                        <input type="text"  class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.searchTitle" id="filter-text-box" placeholder="Tên công ty..." />
                                    </div>
                                    <div class="col-12 col-sm-4 col-lg-4">
                                        <fieldset class="form-group">
                                            <multiselect v-model="cardSearch.searchCategory" :options="categories" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn danh mục" style="font-size:14px"></multiselect>
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
            <section> 
                <div class="row">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table table-hover mb-0 zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên công việc</th>
                                                <th>Tên ứng viên</th>
                                                <th>Trạng thái</th>
                                                <th>Bonus</th>
                                                <th>Nhà tuyển dụng</th>
                                                <th>Thời gian nộp</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tab-table">
                                            <tr v-for="(item, index) in AllApply" :key="index">
                                                <td>{{item.id}}</td>
                                                <td>{{item.job.title}}</td>
                                                <td>{{item.name}}</td>
                                                <td>
                                                    <p v-if="item.status == 5">Chưa duyệt</p>
                                                    <p v-if="item.status == 6">Thời gian phỏng vấn<br> {{ item.interview_schedules }}</p>
                                                </td>
                                                <td>
                                                    <span v-if="item.time_bonus != null && item.bonus != null && item.bonus > 0" style="color: #fc205c">
                                                        {{item.time_bonus == 1 ? item.bonus : item.time_bonus == 2 ? item.bonus * 1.5 : item.bonus * 2}}{{ item.currency }} / <i class="fad fa-user-friends" title="1 người"></i>
                                                    </span>
                                                    <span v-else>Không bonus</span>
                                                </td>
                                                <td>{{item.user.name}}</td>
                                                <td>{{ConvertDate(item.created_at)}}</td>
                                                <td>
                                                    <div class="action-btns">
                                                        <button type="button" data-toggle="modal" data-target="#reportModal" @click="idRefuse = item.id" class="btn btn-danger py-75 waves-effect waves-light" >
                                                            Hủy
                                                        </button>
                                                        <button type="button" data-toggle="modal" data-target="#chooseCalendarModal" @click="idRefuse = item.id" class="btn btn-info py-75 waves-effect waves-light" v-if="item.status == 5">
                                                            Chọn lịch PV
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <infinite-loading
                                        v-if="ApplyWait.length"
                                        spinner="bubbles"
                                        @infinite="infiniteScroll" style="padding:20px; width:100%"
                                    >
                                        <div slot="no-more" style="font-size:15px; font-style: italic">Hết tin</div>
                                        <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
                                    </infinite-loading> -->
                                </div>
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
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTodoTask">Từ chối</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"> 
                                <fieldset class="form-group">
                                    <textarea class="edit-todo-item-desc form-control" v-model="reason_for_rejection" rows="3" placeholder="Nội dung..."></textarea>
                                </fieldset>
                            </div>
                            <div class="modal-footer">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" @click="RefuseApply()" class="btn bg-netbee update-todo-item" data-dismiss="modal"><i class="feather icon-edit d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Gửi</span></button>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="feather icon-x d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Cancel</span>
                                    </button>
                                </fieldset>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <!-- Modal choose calendar -->
        <div class="modal fade" id="chooseCalendarModal" tabindex="-1" role="dialog" aria-labelledby="editTodoTask" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                <div class="modal-content">
                    <section class="todo-form">
                        <form id="form-edit-todo" class="todo-input">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTodoTask">Chọn lịch phỏng vấn</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"> 
                                <fieldset v-for="calendarSuggest in calendarSuggests" :key="calendarSuggest.id">
                                    <div class="vs-radio-con vs-radio-success">
                                        <input type="radio" name="radiocolor" :value="calendarSuggest.value" v-model="chooseCalendar">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="">{{ calendarSuggest.value }}</span>
                                    </div>
                                </fieldset>
                                <datetime v-model="chooseCalendar" type="datetime" input-class="form-control" :minute-step="15" :phrases="{ok: 'Tiếp tục', cancel: 'Thoát'}" value-zone="Asia/Ho_Chi_Minh"></datetime> 
                            </div>
                            <div class="modal-footer">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" @click="addCalendar()" class="btn bg-netbee update-todo-item" data-dismiss="modal"><i class="feather icon-edit d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Gửi</span></button>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="feather icon-x d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Cancel</span>
                                    </button>
                                </fieldset>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import Vue from 'vue'
import moment from 'moment'
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'

export default {
    data() {
        return {
            calendarSuggests: [
                {'key': 1, 'value': moment(moment().add(1, 'days')).locale("vi").format('llll') },
                {'key': 2, 'value': moment(moment().add(2, 'days')).locale("vi").format('llll') },
                {'key': 3, 'value': moment(moment().add(3, 'days')).locale("vi").format('llll') }
            ],
            reason_for_rejection: '',
            idRefuse: '',
            chooseCalendar: {},
            ApplyWait: [],
            ApplyApproved: [],
            ApplyRefuse: [],
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
        }
    },
    components: {
        Datetime
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
        getApplyApproved(){
            this.$axios.$get('apply/getApplyApproved').then((response)=>{
                this.ApplyApproved=response.data;
	        });
        },
        getRefuseApply(){
            this.$axios.$get('apply/getRefuseApply').then((response)=>{
                this.ApplyRefuse=response.data;
	        });
        },
        getAllApply(){
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
        addCalendar() {
            console.log(this.idRefuse)
            let a =''
            let b = moment(this.chooseCalendar)
            if(b.isValid()){
                a = moment(this.chooseCalendar).locale("vi").format('llll')
            } else {
                a = this.chooseCalendar
            }
            this.$axios.$post(`apply/ChooseCalendar/${this.idRefuse}`,{interview_schedules: a}).then((response) =>{
                this.$swal('Thành công', response.message, 'success');
                location.reload()
            })
        }
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
    .tab-table{
        height: 630px;
        overflow: auto;
    }
    .tab-table::-webkit-scrollbar {
        width: 3px;
    }

    .tab-table::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px rgba(128, 128, 128, 0.192);
        border-radius: 10px;
    }

    .tab-table::-webkit-scrollbar-thumb {
        background: rgba(78, 78, 78, 0.507);
        border-radius: 10px;
    }

    .tab-table::-webkit-scrollbar-thumb:hover {
        background: rgba(78, 78, 78, 0.404);
    }
</style>