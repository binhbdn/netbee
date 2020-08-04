<template>
    <div>      
        <div class="content-wrapper" style="margin-top: 0px;padding-top: 0px;">    
            <!-- News filter start -->
            <div class="card" v-if="$auth.user.role == 4">
                <div class="card-header">
                    <h4 class="card-title">Tìm kiếm</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse" data-toggle="tooltip"  data-placement="top" :title="`Thu gọn tìm kiếm`"><i class="fa fa-chevron-down"></i></a></li>
                            <li><a @click="resetForm()" data-toggle="tooltip"  data-placement="top" :title="`Làm mới tìm kiếm`"><i class="fa fa-repeat users-data-filter"></i></a></li>
                            <!-- <li><a data-action="close" data-toggle="tooltip"  data-placement="top" :title="`Đóng tìm kiếm`"><i class="feather icon-x"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show pb-2">
                    <div class="card-body">
                        <div class="users-list-filter">
                            <form>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.search" id="filter-text-box" placeholder="Tìm kiếm...." />
                                    </div>
                                    <!-- <div class="col-12 col-sm-6 col-lg-3">
                                        <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.searchTitle" id="filter-text-box" placeholder="Tên tiêu đề..." />
                                    </div> -->
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <fieldset class="form-group">
                                            <multiselect @input="search()" v-model="cardSearch.searchCompany" :options="companylist" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn công ty" style="font-size:14px"></multiselect>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <fieldset class="form-group">
                                            <multiselect @input="search()" v-model="cardSearch.searchCategory" :options="categories" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn danh mục" style="font-size:14px"></multiselect>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <fieldset class="form-group">
                                            <multiselect @input="search()" v-model="cardSearch.searchStatus" :options="status" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn trạng thái"  style="font-size:14px"></multiselect>
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
                            <div class="card">
                                <div class="card-header col-12" style="padding-left:0px;padding-right: 0px;">
                                    <div class="col-xl-8 col-lg-7 col-md-5 col-sm-4 col-12 btn-add">
                                        <!-- <form action="/admin/tin-tuyen-dung/tao" method="" class="form-add">
                                            <button class="btn-add btn bg-netbee text-dark mx-auto"><i class="far fa-folder-plus"></i> Tạo tin tuyển dụng</button>
                                        </form> -->
                                        <nav style="font-size: 16px;" v-if="$auth.user.role == 4">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" v-on:click="StatusChange(1)" data-toggle="tab" href="#all" role="tab" aria-controls="nav-home" aria-selected="true">Tất cả</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" v-on:click="StatusChange(2)" data-toggle="tab" href="#chuapheduyet" role="tab" aria-controls="nav-profile" aria-selected="false">Chưa phê duyệt</a>
                                                <a class="nav-item nav-link" id="nav-contact-tab" v-on:click="StatusChange(3)" data-toggle="tab" href="#dapheduyet" role="tab" aria-controls="nav-contact" aria-selected="false">Đã phê duyệt</a>
                                                <a class="nav-item nav-link" id="nav-contact-tab" v-on:click="StatusChange(4)" data-toggle="tab" href="#tinan" role="tab" aria-controls="nav-contact" aria-selected="false">Tin ẩn</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" v-on:click="StatusChange(5)" data-toggle="tab" href="#tinhien" role="tab" aria-controls="nav-profile" aria-selected="false">Tin hiện</a>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="row col-xl-4 col-lg-5 col-md-7 col-sm-8 col-12 button-dropdown">
                                        <div class="action-btns col-6">
                                            <div class="btn-dropdown btn-dropdown-left" style="float: right">
                                                <div class="btn-group dropdown actions-dropodown">
                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Sắp xếp
                                                    </button>
                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                        <a class="dropdown-item" @click="sortAscendingID()"><i class="feather icon-trash-2"></i>ID tăng dần</a>
                                                        <a class="dropdown-item" @click="sortDecreaseID()"><i class="feather icon-clipboard"></i>ID giảm dần</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-btns col-6">
                                            <div class="btn-dropdown" style="float: right">
                                                <div class="btn-group dropdown actions-dropodown">
                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Hành động
                                                    </button>
                                                    <div class="dropdown-menu" style="left: -25px!important;">
                                                        <a class="dropdown-item" @click="deleteMultipleTinTuyenDung()"><i class="feather icon-trash-2"></i>Xóa</a>
                                                        <a class="dropdown-item" @click="changeMultipleStatusTinTuyenDung(1)"><i class="far fa-check-circle"></i>Kích hoạt</a>
                                                        <a class="dropdown-item" @click="changeMultipleStatusTinTuyenDung(0)"><i class="far fa-times-circle"></i>Bỏ kích hoạt</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body card-dashboard">
                                    
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active"  v-bind:id="idStatus" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="table-responsive list-data">
                                                <table class="table table-hover mb-0 zero-configuration">
                                                    <thead class="custom-header">
                                                        <tr>
                                                            <th class="width-id d-flex" style="width:5%;">
                                                                <li class="d-inline-block mr-1">
                                                                    <fieldset>
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <input type="checkbox" v-model="selectAll">
                                                                            <span class="vs-checkbox vs-checkbox-sm">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </fieldset>
                                                                </li>
                                                                ID</th>
                                                            <th class="title-style" style="width:40%;">Tiêu đề</th>
                                                            <th class="statistical-none" style="width:20%;">Thống kê</th>
                                                            <th class="date-none" style="width:17%">Ngày tạo</th>
                                                            <th class="status-none" style="width:15%;">Trạng thái</th>
                                                            <!-- <th style="width:10%;">Thể loại</th>
                                                            <th style="width:10%;">Loại tin</th> -->
                                                            <th class="manipulation-style" style="width:8%;">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody v-if="tinTuyenDung.length > 0">
                                                        <tr v-for="(item, index) in tinTuyenDung" :key="index">
                                                            <td class="mb-td" style="display: flex;padding-top: 35px;">
                                                                <li class="d-inline-block mr-1">
                                                                    <fieldset>
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <input type="checkbox" v-model="selected" :value="item.id">
                                                                            <span class="vs-checkbox vs-checkbox-sm">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </fieldset>
                                                                </li>
                                                                {{item.id}}</td>
                                                            <td class="text-left">
                                                                <a data-toggle="tooltip"  data-placement="top" :title="`Xem trước chi tiết tin`" :href="`/tin-tuyen-sinh/${item.id}/${ChangeToSlug(item.title)}`" target="_blank">{{item.title}} 
                                                                </a>
                                                                <p style="font-size: 12px" v-if="item.username != null">
                                                                    <a data-toggle="tooltip"  data-placement="top" :title="`Xem trước chi tiết công ty`" :href="`/cong-ty/${item.username}`" target="_blank"><i>{{item.namecompany}}</i></a>
                                                                </p>
                                                                <!-- <hr style="border-top: 1px dotted black;"><p class="text-center font-italic">{{item.name}}</p> -->
                                                            </td>
                                                            <td class="statistical-none">
                                                                <div class="row">
                                                                    <div class="col-6 pr-0 pl-0">
                                                                        <h3 class="text-center">{{(item.viewers)}}</h3>
                                                                        <p style="font-size:12px; text-align:center">Lượt xem</p>
                                                                    </div>
                                                                    <div class="col-6 pr-0 pl-0">
                                                                        <h3 class="text-center">{{(item.applyers)}}</h3>
                                                                        <p style="font-size:12px; text-align:center">Ứng tuyển</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="date-none">
                                                                {{ConvertDate(item.created_at)}}<br>
                                                                <span v-if="item.bonus && item.bonus != 0" style="color: red;">{{ FormatPrice(item.bonus) }} {{ item.currency }}</span>
                                                            </td>
                                                            <td v-if="item.status == 0" class="status-none">
                                                                <div class="chip-text"><i style="font-size: 20px;" class="fa fa-clock danger" data-toggle="tooltip"  data-placement="top" :title="`Chờ kích hoạt`"></i></div>
                                                            </td>
                                                            <td v-if="item.status == 1" class="status-none">
                                                                <div class="chip-text"><i style="font-size: 20px" class="far fa-check-circle success" data-toggle="tooltip"  data-placement="top" :title="`Đã kích hoạt`"></i></div>
                                                            </td>
                                                            <!-- <td style="white-space: nowrap;">
                                                                <span v-if="item.type == 1">Xuất khẩu lao động</span>
                                                                <span v-if="item.type == 2">Du học nh</span>
                                                                <span v-if="item.type == 3">Tu nghiệp sinh</span>
                                                            </td>
                                                            <td style="white-space: nowrap;">
                                                                <span v-if="item.highlight_job == 1">TIN NỔI BẬT</span>
                                                                <span v-if="item.highlight_job == 2">TIN VIP</span>
                                                                <span v-if="item.highlight_job == 0">TIN THƯỜNG</span>
                                                                <br>
                                                                <a v-if="!item.status" @click="selectPay = {id: item.id, highlight_job: item.highlight_job}" style="color: #2f80ed" data-toggle="modal" data-target="#reportModal" data-placement="right" :title="`Thanh toán để kích hoạt tin`">Thanh toán ngay</a>
                                                            </td> -->
                                                            <td>
                                                                <div class="action-btns">
                                                                    <div class="btn-dropdown ">
                                                                        <div class="btn-group dropdown actions-dropodown">
                                                                            <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light action-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <span class="text-none">Chọn thao tác</span>
                                                                            </button>
                                                                            <div class="dropdown-menu" style="left: -25px!important;">
                                                                                <a v-if="$auth.user.role == 4"  @click="changeStatus(item.id)" class="dropdown-item"> <i :class="item.status == 1 ? 'far fa-times-circle' : 'far fa-check-circle'"></i>{{ item.status == 1 ? 'Bỏ kích hoạt' : "Kích hoạt" }}</a>
                                                                                <a  @click="changePublic(item.id)" class="dropdown-item"><i :class="item.isPublic == 1 ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>{{ item.isPublic == 1 ? 'Ẩn tin' : 'Hiện tin' }}</a>
                                                                                <a :href="`/admin/tin-tuyen-dung/sua/${item.id}`" class="dropdown-item" style="margin-top:5px"><i class="far fa-edit"></i> Sửa</a>
                                                                                <a v-on:click="deleteNews(item.id)" class="dropdown-item" style="margin-top:5px"><i class="far fa-trash-alt"></i> Xóa</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p class="mb-0 text-center p-1 font-italic" v-if="tinTuyenDung.length == 0">Không có dữ liệu nào.</p>
                                            </div>
                                            <infinite-loading
                                                v-if="tinTuyenDung.length"
                                                spinner="bubbles"    
                                                ref="infiniteLoading"            
                                                @infinite="infiniteScroll" style="padding:8px; width:100%"
                                            >
                                                <div slot="no-more" style="font-size:15px; font-style: italic"></div>
                                                <div slot="no-results" style="font-size:15px; font-style: italic"></div>
                                            </infinite-loading>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editTodoTask" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <section class="todo-form">
                        <form id="form-edit-todo" class="todo-input">
                            <div class="modal-header  bg-netbee white">
                                <h5 class="modal-title" id="editTodoTask">Thông tin đơn hàng - Gói {{ selectPay.highlight_job == 0 ? 'TIN THƯỜNG' : selectPay.highlight_job == 1 ? 'TIN NỔI BẬT' : 'TIN VIP'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <fieldset class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn bg-netbee waves-effect waves-light" type="button"><i class="feather icon-search"></i></button>
                                        </div>
                                        <input type="text" class="form-control" id="discount" placeholder="Nhập mã giảm giá" v-model="discount">
                                        <div class="input-group-append">
                                            <button class="btn bg-netbee waves-effect waves-light" @click="checkDiscount()" type="button">Kiểm tra</button>
                                        </div>
                                    </div>
                                    <div id="valid-feedback" style="color: #28C76F"></div>
                                </fieldset>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="MOMO">
                                            <input type="radio" id="MOMO" @click="payWithMomo()">
                                            <img src="/assets/img/bank/logo-momo.jfif" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="ABBank">
                                            <input type="radio"  id="ABB" value="ABB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_ABBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="ACB">
                                            <input type="radio" id="ACB" value="ACB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_ACB_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="AgriBank">
                                            <input type="radio" id="VARB" value="VARB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Agribank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="BacABank">
                                            <input type="radio" id="NASB" value="NASB" v-model="bank">
                                            <img src="/assets/img/bank/ic_BacaBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Techcombank">
                                            <input type="radio" id="TCB" value="TCB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Techcombank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="BIDV">
                                            <input type="radio" id="BIDV" value="BIDV" v-model="bank">
                                            <img src="/assets/img/bank/ic_BIDV_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="DongABank">
                                            <input type="radio" id="DAB" value="DAB" v-model="bank">
                                            <img src="/assets/img/bank/ic_dongabank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Eximbank">
                                            <input type="radio" id="EIB" value="EIB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Eximbank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="HDBank">
                                            <input type="radio" id="HDB" value="HDB" v-model="bank">
                                            <img src="/assets/img/bank/ic_HDBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="LienVietPostBank">
                                            <input type="radio" id="LPB" value="LPB" v-model="bank">
                                            <img src="/assets/img/bank/ic_Lienvietpost_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Maritime Bank">
                                            <input type="radio" id="MSB" value="MSB" v-model="bank">
                                            <img src="/assets/img/bank/ic_maritimeBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="MBBank">
                                            <input type="radio" id="MB" value="MB" v-model="bank">
                                            <img src="/assets/img/bank/ic_MBBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="OceanBank">
                                            <input type="radio" id="OJB" value="OJB" v-model="bank">
                                            <img src="/assets/img/bank/ic_oceanbank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Sacombank">
                                            <input type="radio" id="STB" value="STB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Sacombank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="VIB Bank">
                                            <input type="radio" id="VIB" value="VIB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_VIBank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="VietcomBank">
                                            <input type="radio" id="VCB" value="VCB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_Vietcombank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Vietinbank">
                                            <input type="radio" id="CTG" value="CTG" v-model="bank">
                                            <img src="/assets/img/bank/ic_Viettinban_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="VPBank">
                                            <input type="radio" id="VPB" value="VPB" v-model="bank">
                                            <img src="/assets/img/bank/Ic_VPbank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                        <div class="col-3 d-flex justify-content-center m-b-10" data-toggle="tooltip" data-placement="top" title="Seabank">
                                            <input type="radio" id="SEAB" value="SEAB" v-model="bank">
                                            <img src="/assets/img/bank/ic_seabank_4@2x.png" style="width: 60px;height: 60px">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <button type="button" @click="pay()" class="btn bg-netbee update-todo-item" data-dismiss="modal"><i class="feather icon-edit d-block d-lg-none"></i>
                                        <span class="d-none d-lg-block">Thanh toán</span>
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


export default {
    name: 'IndexNews',
        layout: 'admin',
    head: {
        title: 'Quản lý tin tuyển dụng',
    },
    components: {
        Multiselect
    },
    data() {
        return {
            bank: '',
            selectPay: '',
            discount: '',
            tinTuyenDung: [],
            cardSearch: {
                search: "",
                searchStatus: "",
                // searchTitle: "",
                searchCategory: "",
                searchCompany: ""
            },
            categories: [
                {id: 1, name: 'Xuất khẩu lao động'},
                {id: 2, name: 'Du học'},
                {id: 3, name: 'Tu nghiệp sinh'}
            ],
            status: [
                {id: 1, name: 'Đã kích hoạt'},
                {id: 0, name: 'Chưa kích hoạt'},
            ],
            companylist: [],
            id: null,
            selected: [],
            page: 1,
            statusTabs: 1,
            idStatus: 'all'
        }
    },
    created() {
        this.search();             
    },
    mounted() {
        if(typeof this.$route.query.errorCode !== 'undefined' ) {
            if(this.$route.query.errorCode == 0) {
                this.$swal(
                    'Thành công!',
                    'Thanh toán thành công',
                    'success'
                )
            }else {
                this.$swal(
                    'Thất bại!',
                    'Thanh toán thất bại',
                    'error'
                ) 
            }
        }                        
    },
    methods: {
        StatusChange: function(status){
            this.statusTabs = status
            this.tinTuyenDung = []
            this.page = 1
            if(status == 1){
                this.idStatus = 'all'
            } else if(status == 2) {
                this.idStatus = 'chuapheduyet'
            } else if(status == 3) {
                this.idStatus = 'dapheduyet'
            } else if(status == 4) {
                this.idStatus = 'tinan'
            } else if(status == 5) {
                this.idStatus = 'tinhien'
            } 
            this.search()
        },
        listconpany(){
            this.$axios.$get(
            'tintuyendung/listcompany').then((response)=>{            
                this.companylist=response;                                           
        });
        },
        payWithMomo() {
            this.$axios.$post('/pricing_momo',{code: this.discount,idJob: this.selectPay.id}).then((response)=>{
                if(response.status == 200) {
                    if(response.data != null) {
                        window.location.href = response.data;
                    }else {
                        this.$swal(
                            'Thành công!',
                            'Thanh toán thành công',
                            'success'
                        )
                    }
                }else {
                    this.$swal(
                        'Lỗi!',
                        response.message,
                        'error'
                    )
                }
            });
        },
        checkDiscount() {
            this.$axios.$get('/checkDiscountCode?code='+this.discount).then((response)=>{
	            if(response.status == 200) {
                    var element = document.getElementById("discount");
                    var elementText = document.getElementById("valid-feedback");
                    element.classList.add("is-valid");
                    elementText.innerHTML += "Bạn được giảm "+response.data+"%"
                    
                }else {
                    var element = document.getElementById("discount");
                    element.classList.add("is-invalid");
                }
	        });
        },
        pay() {
            if(this.bank) {
                this.$axios.$post('/pricing_momo_bank',{code: this.discount,idJob: this.selectPay.id,bank: this.bank}).then((response)=>{
                    if(response.status == 200) {
                        if(response.data != null) {
                            window.location.href = response.data;
                        }else {
                            this.$swal(
                                'Thành công!',
                                'Thanh toán thành công',
                                'success'
                            )
                        }
                    }else {
                        this.$swal(
                            'Lỗi!',
                            response.message,
                            'error'
                        )
                    }
                });
            }else {
                this.$swal(
                    'Lỗi!',
                    'Bạn chưa chọn ngân hàng',
                    'error'
                )
            }

        },
        nameWithLang ({ name, id }) {
            return `${name}`
        },
        async changeStatus(index){
            try {
                    let response = await this.$axios.post('tintuyendung/changeStatusTinTuyenDung/',{
                    id: index
                });
                if(response.data.status == 200) {
                    this.$swal({
                        title: 'Thành công',
                        text: response.data.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        showLoaderOnConfirm: true
                    }).then(async (result) => {
                        if(result.value) {
                            this.$axios.get('sendActivationNews',{id: index}),
                            this.search(),         
                            location.reload()                                
                        }
                    }                          
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
                    'Lỗi bỏ kích hoạt!',
                    'error')
            }
                    
        },
        async deleteNews(id){
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
                        let response = await this.$axios.post('tintuyendung/deleteTinTuyenDung',{id: id});
                        // console.log(response)
                        if(response.data.status == 200) {
                            this.tinTuyenDung = this.tinTuyenDung.filter((e)=>e.id != id )
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
        sortAscendingID() {
            this.tinTuyenDung.sort((a, b) => a.id > b.id ? 1 : -1);
            },
        sortDecreaseID() {
            this.tinTuyenDung.sort((a, b) => a.id < b.id ? 1 : -1);
        },
        search(){
            this.listconpany()  
            this.$axios.$get(
            'tintuyendung/searchTinTuyenDung?searchCategory=' 
            + ((this.cardSearch.searchCategory.id)?this.cardSearch.searchCategory.id:'') 
            + '&searchStatus='+ ((this.cardSearch.searchStatus.id !=null)?this.cardSearch.searchStatus.id:'') 
            + '&search='+ ((this.cardSearch.search)?this.cardSearch.search:'')
            + '&searchCompany='+ ((this.cardSearch.searchCompany.id !=null)?this.cardSearch.searchCompany.id:'')
            + '&status='+this.statusTabs
            ).then((response)=>{     
                console.log(response)           
                this.tinTuyenDung=response.data;    
                                               
            }).catch(error => {
                console.log(error.response)
            });
        },
        async changeMultipleStatusTinTuyenDung(statusTinTuyenDung){
            try {
                this.$axios.$post('tintuyendung/changeMultipleStatusTinTuyenDung',{id:JSON.stringify(this.selected), status: statusTinTuyenDung}).then((res) => {
                if(JSON.stringify(this.selected).length == 2){
                    this.$swal({
                        title: 'Bạn chưa chọn tin!',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        this.search()
                        this.selected = []
                    })
                }
                else if(res.status == 200){
                    this.$swal({
                        title: 'Thành công',
                        text: res.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        this.search()
                        this.selected = []
                    })
                }
                else {
                this.$swal(
                    'Lỗi!',
                    res.message,
                    'error'
                    )
                }
                }
            );
            } catch (error) {
                this.$swal(
                    'Lỗi!',
                    'Lỗi bỏ kích hoạt!',
                    'error'
                )
            }
        },
        async deleteMultipleTinTuyenDung(){
            console.log(this.selected)
            if(JSON.stringify(this.selected).length == 2){
                this.$swal({
                    title: 'Lỗi',
                    icon: 'warning',
                    title: 'Bạn chưa chọn tin!'
                })
            }
            else{
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
                            let response = await this.$axios.post('tintuyendung/deleteMultipleTinTuyenDung',{id: JSON.stringify(this.selected)});
                            if(response.data.status == 200) {
                                this.search();
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
                        'Lỗi bỏ kích hoạt!',
                        'error'
                    )
                }
                }
            
        },
        async changePublic(index){
            try {
                    let response = await this.$axios.post('tintuyendung/changePublic',{
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
                        this.search(),
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
                    'Lỗi bỏ kích hoạt!',
                    'error')
            }
        },
        infiniteScroll($state) {
            setTimeout(() => {
                this.page++
                this.$axios
                .get(
            'tintuyendung/searchTinTuyenDung?searchCategory=' 
            + ((this.cardSearch.searchCategory.id)?this.cardSearch.searchCategory.id:'') 
            + '&searchStatus='+ ((this.cardSearch.searchStatus.id !=null)?this.cardSearch.searchStatus.id:'') 
            + '&search='+ ((this.cardSearch.search)?this.cardSearch.search:'')
            + '&searchCompany='+ ((this.cardSearch.searchCompany.id !=null)?this.cardSearch.searchCompany.id:'')
            + '&status='+this.statusTabs
            + '&page='+this.page
            )
                .then((response) => {
                    console.log(response)
                    if (response.data.data.length >= 1) {
                        response.data.data.forEach((item) => this.tinTuyenDung.push(item))
                        $state.loaded()
                    } else {
                        $state.complete()
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
            }, 500)
        },
        resetForm(){
                this.cardSearch.search = "",
                this.cardSearch.searchStatus = "",
                this.cardSearch.searchCompany = "",
                this.cardSearch.searchCategory = ""
        }
    },
    computed: {
        selectAll: {
            get() {
                if(this.tinTuyenDung && this.tinTuyenDung.length > 0) {
                    //A new array exists with at least with one item
                    let allChecked = true;

                    this.tinTuyenDung.forEach((item)=>{
                        if(!this.selected.includes(item.id)) {
                            allChecked = false; 
                            //  If even one is not included in array
                        }

                        //Breack out of loop if mismatch already found
                        if(!allChecked) return;
                    });
                    return allChecked;
                }
                return false
            },
            set(value) {
                const checked = [];
                if(value) {
                    this.tinTuyenDung.forEach((item) => {
                        checked.push(item.id);
                    });
                }
                this.selected = checked;
            }
        },
    }
}
</script>
<style scoped>
.nav.nav-tabs {
    margin-bottom: 0px;
    margin-left: 10px;
}
.nav-tabs {
    border-bottom: 1px solid #DAE1E7 !important;
    font-weight: 400;
}
.nav-tabs .nav-link:hover {
    border-color: #fff !important;
    border-bottom-color: #DAE1E7 !important;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd !important;
    border-bottom-color: transparent;
}
.nav-tabs .nav-link {
    border-radius: 0;
    padding: 10px;
}
.nav-tabs .nav-link.active{
    color: #4E5154;
    background-color: #fff;
    border-color: #DAE1E7 #DAE1E7 #F8F8F8 !important;
    border-top: 2px solid #ffb701 !important;
}
.nav-tabs>li {
    float: left;
    margin-bottom: -1px;
}
.nav>li {
    position: relative;
    display: block;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 10px 15px;
}
.nav-tabs>li>a {
    margin-right: 2px;
    line-height: 1.42857143;
    border-radius: 4px 4px 0 0;
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
    border-color: #ffb701 !important;
}

@media (max-width: 991px){
    .statistical-none, .date-none{
        display: none;
    }
    .mb-td{
        padding-top: 22px !important;
    }
}

@media (max-width: 575px){
    .btn-add{
        margin-right: 0;
        margin-bottom: 10px;
    }
    .form-add{
        text-align: center;
    }
    .status-none, .text-none{
        display: none;
    }
    .title-style{
        width: 0 !important;
    }
    .manipulation-style{
        vertical-align: top !important;
    }
    .action-dropdown{
        padding-left: 1rem !important;
    }
    .button-dropdown{
        margin: auto;
        padding-right: 0;
        padding-left: 0;
    }
    .btn-dropdown-left{
        float: left !important;
    }
}
</style>