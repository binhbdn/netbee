<template>
    <div class="content-wrapper">
        <div class="content-body">
            <section> 
                <div class="row">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table table-hover mb-0 zero-configuration" v-if="AllApply.length > 0">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;">ID</th>
                                                <th style="width:20%;">Tên công việc</th>
                                                <th style="width:20%;">Tên ứng viên</th>
                                                <th style="width:20%;">Trạng thái</th>
                                                <th style="width:10%;">Bonus</th>                                            
                                                <th style="width:10%;">Thời gian nộp</th>
                                                <th style="width:15%;">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tab-table" >
                                            <tr v-for="(item, index) in AllApply" :key="index">
                                                <td>
                                                    {{item.id}}                                                    
                                                </td>                                                
                                                <td>
                                                    <p style="margin-bottom: 0px;" v-if="item.job">{{item.job.title}}</p>                                                
                                                    <span style="font-size: 12px;" v-if="item.cv_id != null"><i>Hồ sơ online</i></span>
                                                    <span style="font-size: 12px;" v-if="item.cv_file != null"><i>Hồ sơ đính kèm</i></span>
                                                </td>
                                                <td>{{item.name}}</td>
                                                <td>
                                                    <a v-if="item.cv_id != null" target="_blank" :href="`/admin/ho-so/xem-ho-so/${item.cv_id}`" style="text-decoration: underline;">Xem hồ sơ</a>
                                                    <a v-if="item.cv_file != null" target="_blank" @click="dowloadfile(item.cv_file)" style="text-decoration: underline;">Xem hồ sơ</a>
                                                    <a v-if="item.nb_paper != null" @click="showFile(item.id)" style="text-decoration: underline;">Xem giấy tờ đính kèm</a>
                                                    <p v-if="item.status == 6">Thời gian phỏng vấn<br> {{ item.interview_schedules }}</p>
                                                    <p v-else-if="item.status == 5 && item.nb_paper == null">Đợi giấy tờ đính kèm</p>
                                                </td>
                                                <td>
                                                    <span v-if="item.time_bonus != null && item.bonus != null && item.bonus > 0" style="color: #fc205c">
                                                        {{item.time_bonus == 1 ? item.bonus : item.time_bonus == 2 ? item.bonus * 1.5 : item.bonus * 2}}{{ item.currency }} / <i class="fad fa-user-friends" title="1 người"></i>
                                                    </span>
                                                    <span v-else>Không bonus</span>
                                                </td>                                                
                                                <td>{{ConvertDate(item.created_at)}}</td>
                                                <td>
                                                    <div class="action-btns">
                                                        <div>
                                                            <button type="button" data-toggle="modal" data-target="#reportModal" @click="idRefuse = item.id" class="btn btn-danger py-75 waves-effect waves-light"  style="width: 100%;">
                                                            Hủy
                                                            </button>
                                                        </div>  
                                                        <div>
                                                            <button type="button" data-toggle="modal" data-target="#chooseCalendarModal" @click="idRefuse = item.id" class="btn btn-info py-75 waves-effect waves-light" v-if="item.status == 5 && item.nb_paper != null" style="width: 100%;margin-top: 5px;">
                                                            Chọn lịch PV
                                                            </button>
                                                        </div>                                                                                                              
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>                                        
                                    </table>
                                    <div v-if="AllApply.length == 0">
                                        <p style="padding-top:10px;text-align: center;font-style: italic;">Không có hồ sơ ứng tuyển.</p>
                                    </div>                                    
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
                                <datetime v-model="chooseCalendar" type="datetime" input-class="form-control" :minute-step="15" :phrases="{ok: 'Tiếp tục', cancel: 'Thoát'}"></datetime> 
                            </div>
                            <div class="modal-footer">                                
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="feather icon-x d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Hủy</span>
                                    </button>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" @click="addCalendar()" class="btn bg-netbee update-todo-item" data-dismiss="modal"><i class="feather icon-edit d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Gửi</span></button>
                                </fieldset>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <!-- add new sidebar starts -->
        <div class="add-new-data-sidebar">
            <div class="overlay-bg"></div>
            <div class="add-new-data">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">Giấy tờ đính kèm</h4>
                    </div>
                    <div class="hide-data-sidebar" @click="closeShowFile()">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body m-t-15">
                                <ul class="activity-timeline timeline-left list-unstyled">
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">CMND mặt trước</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.front_id_card}`" class="font-small-3">
                                                <img :src="`/uploads/apply/files/${paper.front_id_card}`" alt="" width="70px" height="70px">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">CMND mặt sau</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.back_id_card}`" class="font-small-3">
                                                <img :src="`/uploads/apply/files/${paper.back_id_card}`" alt="" width="70px" height="70px">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Ảnh chân dung</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.card_photo}`" class="font-small-3">
                                                <img :src="`/uploads/apply/files/${paper.card_photo}`" alt="" width="70px" height="70px">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Bằng tốt nghiệp</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.high_school_diploma}`" class="font-small-3">
                                                <img :src="`/uploads/apply/files/${paper.high_school_diploma}`" alt="" width="70px" height="70px">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Giấy khai sinh</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.birth_certificate}`" class="font-small-3">
                                                <img :src="`/uploads/apply/files/${paper.birth_certificate}`" alt="" width="70px" height="70px">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Sơ yếu lí lịch</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.curriculum_vitae}`" class="font-small-3">
                                                <img :src="`/uploads/apply/files/${paper.curriculum_vitae}`" alt="" width="70px" height="70px">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Giấy khám sức khỏe</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.health_certification}`" class="font-small-3">
                                                <img :src="`/uploads/apply/files/${paper.health_certification}`" alt="" width="70px" height="70px">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Hộ chiếu</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.passport}`" class="font-small-3">
                                                <img :src="`/uploads/apply/files/${paper.passport}`" alt="" width="70px" height="70px">
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="cancel-data-btn" @click="closeShowFile()">
                        <button class="btn btn-outline-danger">Đóng</button>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- add new sidebar ends -->
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
     name: 'QLUTCompany',
        layout: 'admin',
    data() {
        return {
            paper: [],
            calendarSuggests: [
                {'key': 1, 'value': moment(moment().add(1, 'days')).locale("vi").format('DD MM YYYY hh:mm:ss') },
                {'key': 2, 'value': moment(moment().add(2, 'days')).locale("vi").format('DD MM YYYY hh:mm:ss') },
                {'key': 3, 'value': moment(moment().add(3, 'days')).locale("vi").format('DD MM YYYY hh:mm:ss') }
            ],
            reason_for_rejection: '',
            idRefuse: '',
            chooseCalendar: '',
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
    methods: {
        dowloadfile(file){
            this.$axios.$post('apply/getDowloadFile',{filename: file}).then((response)=>{                
	        });
        },
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
        // getAllApply(){
        //     this.$axios.$get('apply/getAllApply').then((response)=>{
        //         this.AllApply=response.data;
        //         console.log(response);
	    //     });
        // },
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
            let b = (this.chooseCalendar).split(" ");
            let c = new Date(b[2]+'-'+b[1]+'-'+b[0]+' '+b[3]);
            // if(b.isValid()){
            //     a = moment(this.chooseCalendar).locale("vi").format('llll')
            // } else {
            //     a = this.chooseCalendar
            // }
            this.$axios.$post(`apply/ChooseCalendar/${this.idRefuse}`,{interview_schedules: c}).then((response) =>{
                this.$swal('Thành công', response.message, 'success');
                //location.reload()
            })
        },
        showFile(id) {
            var a = document.querySelector('.overlay-bg');
            a.classList.add("show");
            var b = document.querySelector('.add-new-data');
            b.classList.add("show");
            this.$axios.$get(`apply/getPaperApply/${id}`).then((res) => {
                this.paper = res.data
            })
        },
        closeShowFile() {
            var a = document.querySelector('.overlay-bg');
            a.classList.remove("show");
            var b = document.querySelector('.add-new-data');
            b.classList.remove("show");
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
    mounted(){
        this.fetch();
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
    .add-new-data{
    width: 28.57rem;
    max-width: 90vw;
    height: 100vh;
    height: calc(var(--vh, 1vh) * 100);
    background: #FFFFFF;
    position: fixed;
    left: auto;
    right: 0;
    top: 0;
    z-index: 1033;
    box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.05);
    -webkit-transform: translateX(100%);
    -ms-transform: translateX(100%);
    transform: translateX(100%);
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
    overflow: hidden;
    }
    .show {
        transform: translateX(0%);
    }
    .data-items {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        height: calc(100% - 11rem);
        position: relative;
    }
    .overlay-bg.show {
        opacity: 1;
        display: block;
    }
    .overlay-bg {
        background: rgba(0, 0, 0, 0.2);
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        display: none;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        opacity: 0;
        z-index: 1032;
    }
</style>