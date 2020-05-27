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
            <section id="News"> 
                <div class="row">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <!-- <li class="nav-item">
                                            <a class="nav-link  active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true" @click="fetch">Chờ duyệt</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false" @click="getApplyApproved">Đã duyệt</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" aria-controls="about" role="tab" aria-selected="false" @click="getRefuseApply">Từ chối</a>
                                        </li> -->
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" aria-controls="about" role="tab" aria-selected="false">Đã tuyển</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" aria-controls="about" role="tab" aria-selected="true" @click="getAllApply">Tất cả</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ">
                                        <!-- <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                                            <table class="table table-hover mb-0 zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Tên công việc</th>
                                                        <th>Tên ứng viên</th>
                                                        <th>Nhà tuyển dụng</th>
                                                        <th>Thời gian nộp</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tr v-for="(item, index) in ApplyWait" :key="index">
                                                    <td>{{item.id}}</td>
                                                    <td>{{item.title}}</td>
                                                    <td>{{item.name}}</td>
                                                    <td>{{item.name_company}}</td>
                                                    <td>{{ConvertDate(item.created_at)}}</td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Chọn thao tác
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a class="dropdown-item" style="margin-top:5px" @click="ApprovedApply(item.id)"><i class="far fa-check-circle"></i> Duyệt</a>
                                                                        <a class="dropdown-item" style="margin-top:5px" data-toggle="modal" data-target="#reportModal" @click="idRefuse = item.id" ><i class="far fa-times-circle"></i> Từ chối</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <infinite-loading
                                                v-if="ApplyWait.length"
                                                spinner="bubbles"
                                                @infinite="infiniteScroll" style="padding:20px; width:100%"
                                            >
                                                <div slot="no-more" style="font-size:15px; font-style: italic">Hết tin</div>
                                                <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
                                            </infinite-loading>
                                        </div> -->
                                        <!-- <div class="tab-pane " id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                            <table class="table table-hover mb-0 zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Tên công việc</th>
                                                        <th>Tên ứng viên</th>
                                                        <th>Nhà tuyển dụng</th>
                                                        <th>Thời gian nộp</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tr v-for="(item, index) in ApplyApproved" :key="index">
                                                    <td>{{item.id}}</td>
                                                    <td>{{item.title}}</td>
                                                    <td>{{item.name}}</td>
                                                    <td>{{item.name_company}}</td>
                                                    <td>{{ConvertDate(item.created_at)}}</td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Chọn thao tác
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a class="dropdown-item" style="margin-top:5px" data-toggle="modal" data-target="#reportModal" @click="idRefuse = item.id"><i class="far fa-times-circle"></i> Từ chối</a>
                                                                        <a class="dropdown-item" style="margin-top:5px" @click="HideApply(item.id)" v-if="item.isPublic == 1"><i class="fad fa-eye-slash"></i> Ẩn</a>
                                                                        <a class="dropdown-item" style="margin-top:5px" @click="ShowApply(item.id)" v-if="item.isPublic == 0"><i class="fad fa-eye"></i> Hiện</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div> -->
                                        <!-- <div class="tab-pane" id="about" aria-labelledby="about-tab" role="tabpanel">
                                            <table class="table table-hover mb-0 zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Tên công việc</th>
                                                        <th>Tên ứng viên</th>
                                                        <th>Nhà tuyển dụng</th>
                                                        <th>Thời gian nộp</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tr v-for="(item, index) in ApplyRefuse" :key="index">
                                                    <td>{{item.id}}</td>
                                                    <td>{{item.title}}</td>
                                                    <td>{{item.name}}</td>
                                                    <td>{{item.name_company}}</td>
                                                    <td>{{ConvertDate(item.created_at)}}</td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Chọn thao tác
                                                                    </button>
                                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                                        <a class="dropdown-item" style="margin-top:5px" @click="ApprovedApply(item.id)"><i class="far fa-check-circle"></i> Duyệt lại</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div> -->
                                        <div class="tab-pane active" id="all" aria-labelledby="all-tab" role="tabpanel">
                                            <table class="table table-hover mb-0 zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Tên công việc</th>
                                                        <th>Tên ứng viên</th>
                                                        <th>Trạng thái</th>
                                                        <th>Nhà tuyển dụng</th>
                                                        <th>Bonus</th>
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
                                                            <a v-if="item.cv_id != null" target="_blank" :href="`/admin/ho-so/xem-ho-so/${item.cv_id}`" style="text-decoration: underline;">Xem hồ sơ</a>
                                                            <a v-if="item.nb_paper != null" @click="showFile(item.id)" style="text-decoration: underline;">Xem giấy tờ đính kèm</a>
                                                            <p v-if="item.status == 1">Chưa duyệt</p>
                                                            <p v-else-if="item.status == 2 && item.nb_paper == null">Đã duyệt hồ sơ</p>
                                                            <p v-else-if="item.status == 5">Đã duyệt hồ sơ đính kèm</p>
                                                            <p v-else-if="item.status == 6">Thời gian phỏng vấn<br> {{ item.interview_schedules }}</p>
                                                        </td>
                                                        <td>{{item.user.name}}</td>
                                                        <td>
                                                            <span v-if="item.time_bonus != null && item.bonus != null && item.bonus > 0" style="color: #fc205c">
                                                                {{item.time_bonus == 1 ? item.bonus : item.time_bonus == 2 ? item.bonus * 1.5 : item.bonus * 2}}{{ item.currency }} / <i class="fad fa-user-friends" title="1 người"></i>
                                                            </span>
                                                            <span v-else>Không bonus</span>
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
                                                                            <a class="dropdown-item" style="margin-top:5px" @click="ApprovedApply(item.id)" v-if="item.status == 1"><i class="far fa-check-circle"></i> Duyệt</a>
                                                                            <a class="dropdown-item" style="margin-top:5px" data-toggle="modal" data-target="#reportModal" @click="idRefuse = item.id" v-if="item.status != 4"><i class="far fa-times-circle"></i> Từ chối</a>
                                                                            <a class="dropdown-item" style="margin-top:5px" @click="HideApply(item.id)" v-if="item.status == 2 && item.isPublic == 1"><i class="fad fa-eye-slash"></i> Ẩn</a>
                                                                            <a class="dropdown-item" style="margin-top:5px" @click="ShowApply(item.id)" v-if="item.status == 2 && item.isPublic == 0"><i class="fad fa-eye"></i> Hiện</a>
                                                                            <a class="dropdown-item" style="margin-top:5px" @click="ApprovedApplyHoSo(item.id)" v-if="item.status == 2 && item.nb_paper != null"><i class="fad fa-eye"></i> Duyệt hồ sơ đính kèm</a>
                                                                            <a class="dropdown-item" style="margin-top:5px" @click="ApprovedApply(item.id)" v-if="item.status == 4"><i class="far fa-check-circle"></i> Duyệt lại</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- <infinite-loading
                                                v-if="AllApply.length"
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
                                        <span class="d-none d-lg-block">Cancel</span></button>
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
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.front_id_card}`" class="font-small-3">Xem trước</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">CMND mặt sau</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.back_id_card}`" class="font-small-3">Xem trước</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Ảnh chân dung</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.card_photo}`" class="font-small-3">Xem trước</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Bằng tốt nghiệp</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.high_school_diploma}`" class="font-small-3">Xem trước</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Giấy khai sinh</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.birth_certificate}`" class="font-small-3">Xem trước</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Sơ yếu lí lịch</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.curriculum_vitae}`" class="font-small-3">Xem trước</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Giấy khám sức khỏe</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.health_certification}`" class="font-small-3">Xem trước</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-icon bg-netbee">
                                            <i class="feather icon-check font-medium-2 align-middle"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <p class="font-weight-bold mb-0">Hộ chiếu</p>
                                            <a target="_blank" :href="`/uploads/apply/files/${paper.passport}`" class="font-small-3">Xem trước</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <!-- <div class="add-data-btn">
                        <button v-if="paper.status == 5" @click="approve()" class="btn bg-netbee">Duyệt giấy tờ</button>
                    </div> -->
                    <div class="cancel-data-btn" @click="closeShowFile()">
                        <button class="btn btn-outline-danger">Đóng</button>
                    </div>
                </div>
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

export default {
    data() {
        return {
            paper: [],
            reason_for_rejection: '',
            idRefuse: '',
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
    created() {
        this.getAllApply();
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
        getApplyWait(){
            this.$axios.$get('apply/getApplyWait').then((response)=>{
                this.ApplyWait=response.data;
	        });
        },
        ApprovedApply(id){
            this.$axios.$get(`apply/ApproveApply/${id}`).then((response)=>{
                if(response.status == 200){
                    this.$swal(
                        'Thành công',
                        response.message,
                        'success'
                    ).then( function (){
                        location.reload()
                    } )
                }
	        });
        },
        RefuseApply(id){
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
        HideApply(id){
            this.$axios.$get(`apply/HideApply/${id}`).then((response)=>{
                if(response.status == 200){
                    this.$swal(
                        'Thành công',
                        response.message,
                        'success'
                    ).then( function (){
                        location.reload()
                    } )
                }
	        });
        },
        ShowApply(id){
            this.$axios.$get(`apply/ShowApply/${id}`).then((response)=>{
                if(response.status == 200){
                    this.$swal(
                        'Thành công',
                        response.message,
                        'success'
                    ).then( function (){
                        location.reload()
                    } )
                }
	        });
        },
        ApprovedApplyHoSo(id){
            this.$axios.$post(`apply/ApprovedApplyHoSo/${id}`).then((response)=>{
                if(response.status == 200){
                    this.$swal(
                        'Thành công',
                        response.message,
                        'success'
                    ).then( function (){
                        location.reload()
                    } )
                }
	        });
        },
        showFile(id) {
            var a = document.querySelector('.overlay-bg');
            a.classList.add("showFile");
            var b = document.querySelector('.add-new-data');
            b.classList.add("showFile");
            this.$axios.$get(`apply/getPaperApply/${id}`).then((res) => {
                this.paper = res.data
            })
        },
        closeShowFile() {
            var a = document.querySelector('.overlay-bg');
            a.classList.remove("showFile");
            var b = document.querySelector('.add-new-data');
            b.classList.remove("showFile");
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
    .showFile {
        transform: translateX(0%);
    }
    .data-items {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        height: calc(100% - 11rem);
        position: relative;
    }
    .overlay-bg.showFile {
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