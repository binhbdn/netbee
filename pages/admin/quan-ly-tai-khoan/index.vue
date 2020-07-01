<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <!-- filter start -->
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tìm kiếm</h4>
          <a class="heading-elements-toggle">
            <i class="fa fa-ellipsis-v font-medium-3"></i>
          </a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li>
                <a
                  data-action="collapse"
                  data-toggle="tooltip"
                  data-placement="top"
                  :title="`Thu gọn tìm kiếm`"
                >
                  <i class="feather icon-chevron-down"></i>
                </a>
              </li>
              <li>
                <a
                  @click="resetForm()"
                  data-toggle="tooltip"
                  data-placement="top"
                  :title="`Làm mới tìm kiếm`"
                >
                  <i class="feather icon-rotate-cw users-data-filter"></i>
                </a>
              </li>
              <li>
                <a
                  data-action="close"
                  data-toggle="tooltip"
                  data-placement="top"
                  :title="`Đóng tìm kiếm`"
                >
                  <i class="feather icon-x"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="card-content collapse show pb-2">
          <div class="card-body">
            <div class="users-list-filter">
              <form>
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-4">
                    <input
                      type="text"
                      @keyup="search()"
                      class="ag-grid-filter form-control mr-1 mb-sm-0"
                      v-model="cardSearch.search"
                      id="filter-text-box"
                      placeholder="Tìm kiếm...."
                    />
                  </div>
                  <div class="col-12 col-sm-6 col-lg-4">
                    <fieldset class="form-group">
                      <multiselect
                        @input="search()"
                        :allow-empty="false"
                        v-model="cardSearch.searchBlock"
                        :options="block"
                        :custom-label="nameWithLang"
                        :searchable="false"
                        :close-on-select="true"
                        :show-labels="false"
                        placeholder="Chọn tình trạng"
                        style="font-size:14px"
                      ></multiselect>
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-4">
                    <fieldset class="form-group">
                      <multiselect
                        @input="search()"
                        :allow-empty="false"
                        v-model="cardSearch.searchStatus"
                        :options="status"
                        :custom-label="nameWithLang"
                        :searchable="false"
                        :close-on-select="true"
                        :show-labels="false"
                        placeholder="Chọn trạng thái"
                        style="font-size:14px"
                      ></multiselect>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- filter end -->
      <div class="content-body">
        <section>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header d-flex">
                  <div class="flex-grow-2 pr-2">
                      <button class="btn-add btn bg-netbee text-dark " @click="openModalCreate()"><i class="far fa-folder-plus"></i> Tạo tài khoản</button>
                  </div>
                  <div class="flex-grow-1 row input_date">
                    <div class="input-group col-md-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text p-0 pl-1 pr-1">Từ</span>
                      </div>
                      <input
                        type="date"
                        class="ag-grid-filter form-control"
                        v-model="cardSearch.searchFromDate"
                        id="filter-text-box"
                        placeholder
                      />
                    </div>
                    <div class="input-group col-md-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text p-0 pl-1 pr-1">Đến</span>
                      </div>
                      <input
                        type="date"
                        class="ag-grid-filter form-control"
                        v-model="cardSearch.searchToDate"
                        id="filter-text-box"
                        placeholder
                      />
                    </div>
                    <div class="col-md-4">
                      <button @click="searchDate()" class="btn-add btn bg-netbee text-dark">
                        <i class="far fa-filter"></i> Lọc
                      </button>
                    </div>
                  </div>
                  <div class="flex-grow-1 d-flex justify-content-end">
                    <div class="action-btns pr-2">
                      <div class="btn-dropdown">
                        <div class="btn-group dropdown actions-dropodown">
                          <button
                            type="button"
                            class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >Sắp xếp</button>
                          <div class="dropdown-menu" style="left: -25px!important;">
                            <a class="dropdown-item" @click="sortAscendingID()">
                              <i class="feather icon-trash-2"></i>ID tăng dần
                            </a>
                            <a class="dropdown-item" @click="sortDecreaseID()">
                              <i class="feather icon-clipboard"></i>ID giảm dần
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="action-btns">
                      <div class="btn-dropdown">
                        <div class="btn-group dropdown actions-dropodown">
                          <button
                            type="button"
                            class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >Hành động</button>
                          <div class="dropdown-menu" style="left: -25px!important;">
                            <a class="dropdown-item" @click="blockMultipleUser()">
                              <i class="far fa-lock"></i>Block
                            </a>
                            <a class="dropdown-item" @click="changeMultipleStatus(1)">
                              <i class="far fa-check-circle"></i>Kích hoạt
                            </a>
                            <a class="dropdown-item" @click="changeMultipleStatus(0)">
                              <i class="far fa-times-circle"></i>Bỏ kích hoạt
                            </a>
                            <a class="dropdown-item" @click="exportUser()">
                              <i class="far fa-file-excel"></i> Xuất Excel
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body card-dashboard">
                  <div class="table-responsive list-data">
                    <table class="table table-hover mb-0 zero-configuration">
                      <thead class="custom-header">
                        <tr>
                          <th class="width-id d-flex">
                            <li class="d-inline-block mr-1">
                              <fieldset>
                                <div class="vs-checkbox-con vs-checkbox-primary">
                                  <input type="checkbox" v-model="selectAll" />
                                  <span class="vs-checkbox vs-checkbox-sm">
                                    <span class="vs-checkbox--check">
                                      <i class="vs-icon feather icon-check"></i>
                                    </span>
                                  </span>
                                </div>
                              </fieldset>
                            </li>
                            ID
                          </th>
                          <th>Tên</th>
                          <th style="width:14%;">Avatar</th>
                          <th>Ngày tạo</th>
                          <th>Trạng thái</th>
                          <th style="width:100px;">Email</th>
                          <th>Số điện thoại</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody v-if="users.length > 0">
                        <tr v-for="(item, index) in users" :key="index">
                          <td class="d-flex" style="padding-top:34px" >
                            <li class="d-inline-block mr-1">
                              <fieldset>
                                <div class="vs-checkbox-con vs-checkbox-primary">
                                  <input type="checkbox" v-model="selected" :value="item.id" />
                                  <span class="vs-checkbox vs-checkbox-sm">
                                    <span class="vs-checkbox--check">
                                      <i class="vs-icon feather icon-check"></i>
                                    </span>
                                  </span>
                                </div>
                              </fieldset>
                            </li>
                            {{item.id}}
                          </td>
                          <td class="text-left">
                            <a
                              class="highlight"
                              @click="openModal(index)"
                              data-toggle="tooltip"
                              :title="item.name"
                              data-placement="top"
                              target="_blank"
                            >{{item.name}}</a>
                          </td>
                          <td>
                            <span>
                              <img
                                v-lazy="`/uploads/users/avatars/${item.avatar}`"
                                style="object-fit: cover;"
                                width="55"
                                height="55"
                              />
                            </span>
                          </td>
                          <td :title="item.created_at">{{ConvertDate(item.created_at)}}</td>
                          <td v-if="item.status == 0">
                            <div class="chip-text">
                              <i
                                style="font-size: 20px;"
                                class="fa fa-clock danger"
                                data-toggle="tooltip"
                                data-placement="top"
                                :title="`Chưa kích hoạt`"
                              ></i>
                            </div>
                          </td>
                          <td v-if="item.status == 1">
                            <div class="chip-text">
                              <i
                                style="font-size: 20px"
                                class="far fa-check-circle success"
                                data-toggle="tooltip"
                                data-placement="top"
                                :title="`Đã kích hoạt`"
                              ></i>
                            </div>
                          </td>
                          <td class="text-left" style="width: 100px; height: 100px">
                            <a style="line-height: 1.5em; height: 3em; overflow: hidden; width: 100px;"
                              data-toggle="tooltip"
                              data-placement="top"
                              :title="item.email"
                              target="_blank"
                            >{{item.email}}</a>
                          </td>
                          <td class="text-left">
                            <a
                              data-toggle="tooltip"
                              data-placement="top"
                              :title="item.phone"
                              target="_blank"
                            >{{item.phone}}</a>
                          </td>
                          <td>
                            <div class="action-btns">
                              <div class="btn-dropdown">
                                <div class="btn-group dropdown actions-dropodown">
                                  <button
                                    type="button"
                                    class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                  >Chọn thao tác</button>
                                  <div class="dropdown-menu" style="left: -25px!important;">
                                    <a
                                      v-if="$auth.user.role == 4"
                                      v-on:click="changeStatus(item.id)"
                                      class="dropdown-item"
                                    >
                                      <i
                                        :class="item.status == 1 ? 'far fa-times-circle' : 'far fa-check-circle'"
                                      ></i>
                                      {{ item.status == 1 ? 'Bỏ kích hoạt' : "Kích hoạt" }}
                                    </a>
                                    <a
                                      v-on:click="blockUser(item.id)"
                                      class="dropdown-item"
                                      style="margin-top:5px"
                                    >
                                      <i class="far fa-lock"></i> Block
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <div class="modal fade" id="detail_user" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header bg-netbee">
                                    <h4 class="modal-title text-dark">Chi tiết thông tin tài khoản</h4>
                                    <button type="button" class="close ma-0" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true" class="text-dark">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body" id="modal_body">
                                    <div class="position-absolute" id="overlay_update">
                                      <div class="spinner-grow text-warning position-absolute update-loading" role="status">
                                        <span class="sr-only"></span>
                                      </div>
                                    </div>
                                    <div>
                                      <div class="row">
                                        <div class="col-lg-4" >
                                          <img
                                            v-lazy="`/uploads/users/avatars/${userDetail.avatar}`"
                                            style="object-fit: cover; width: 226px; height: 226px;"
                                          />
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="row modal-item">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>ID</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8">
                                                    <span>{{userDetail.id}}</span>
                                                </div>
                                            </div>
                                            <div class="row modal-item has-update">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>Name</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8 d-flex">
                                                    <div class="d-flex" v-if="elementUpdate.name">
                                                      <span>{{userDetail.name}}</span>
                                                      <i class="fa fa-pencil is-show-edit" @click="showEditBox('name')"></i>
                                                    </div>
                                                    <div class="edit-box" v-if="!elementUpdate.name">
                                                      <input type="text" v-model="userDetail.name">
                                                      <button class="btn-success fa fa-save" @click="actionUpdate()"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row modal-item">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8">
                                                    <span>{{userDetail.email}}</span>
                                                </div>
                                            </div>
                                            <div class="row modal-item">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>Ngày tạo</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8">
                                                    <span>{{ConvertDate(userDetail.created_at)}}</span>
                                                </div>
                                            </div>
                                            <div class="row modal-item">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>Ngày cập nhật</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8">
                                                    <span>{{ConvertDate(userDetail.updated_at)}}</span>
                                                </div>
                                            </div>
                                            <div class="row modal-item">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>Trạng thái</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8">
                                                    <span>{{userDetail.status ? 'Đã kích hoạt' : 'Chưa kích hoạt'}}</span>
                                                </div>
                                            </div>
                                            <div class="row modal-item has-update">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>Số điện thoại</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8 d-flex">
                                                    <div class="d-flex" v-if="elementUpdate.phone">
                                                      <span>{{userDetail.phone}}</span>
                                                      <i class="fa fa-pencil is-show-edit" @click="showEditBox('phone')"></i>
                                                    </div>
                                                    <div class="edit-box" v-if="!elementUpdate.phone">
                                                      <input type="text" v-model="userDetail.phone">
                                                      <button class="fa fa-save btn-success" @click="actionUpdate()"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row modal-item has-update">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>Địa chỉ</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8 d-flex">
                                                    <div class="d-flex" v-if="elementUpdate.address_detail">
                                                      <span>{{userDetail.address_detail}}</span>
                                                      <i class="fa fa-pencil is-show-edit" @click="showEditBox('address_detail')"></i>
                                                    </div>
                                                    <div class="edit-box" v-if="!elementUpdate.address_detail">
                                                      <input type="text" v-model="userDetail.address_detail">
                                                      <button class="btn-success fa fa-save" @click="actionUpdate()"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row modal-item has-update">
                                                <div class="col-sm-4 col-lg-4">
                                                    <label>Ngày sinh</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-8 d-flex">
                                                    <div class="d-flex" v-if="elementUpdate.birth_of_date">
                                                      <span>{{ConvertDate(userDetail.birth_of_date)}}</span>
                                                      <i class="fa fa-pencil is-show-edit" @click="showEditBox('birth_of_date')"></i>
                                                    </div>
                                                    <div class="edit-box" v-if="!elementUpdate.birth_of_date">
                                                      <input type="date" v-model="userDetail.birth_of_date">
                                                      <button class="btn-success fa fa-save" @click="actionUpdate()"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="message_update"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn bg-netbee" data-dismiss="modal">Đóng</button>
                                  </div>
                                </div>
                              </div>
                          </div>

                          <div class="modal fade" id="create_user" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header bg-netbee">
                                    <h4 class="modal-title text-dark">Tạo tài khoản</h4>
                                    <button type="button" class="close ma-0" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true" class="text-dark">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body" id="modal_body">
                                    <form method="POST" class="appointment-form" id="appointment-form-2" style="margin-top:10px;" v-on:keyup.enter="signIn">
                                      <ValidationObserver ref="observer" v-slot="{ valid }">
                                        <ValidationProvider
                                          name="name"
                                          ref="name"
                                          rules="required"
                                          v-slot="{ errors }"
                                        >   
                                          <div class="form-group">
                                              <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Họ & Tên</label>
                                              <input type="text" class="form-control" name="name" v-model="userForm.name">
                                              <ul style="color:red" class="overline text-left">
                                                <li v-for="(error, index) in errors" :key="index">
                                                  <span>{{ error }}</span>
                                                </li>
                                              </ul>
                                          </div>
                                        </ValidationProvider>
                                        <ValidationProvider
                                          name="email"
                                          ref="email"
                                          rules="required|email"
                                          v-slot="{ errors }"
                                        >
                                          <div class="form-group">
                                              <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Email</label>
                                              <input type="email" class="form-control" name="email" v-model="userForm.email">
                                              <ul style="color:red" class="overline text-left">
                                                <li v-for="(error, index) in errors" :key="index">
                                                  <span>{{ error }}</span>
                                                </li>
                                              </ul>
                                          </div>
                                        </ValidationProvider>
                                        <ValidationProvider
                                          rules="required|integer"
                                          ref="phone"
                                          name="phone"
                                          v-slot="{ errors }"
                                        >
                                          <div class="form-group">
                                            <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Số điện thoại</label>
                                            <input type="text" class="form-control" name="phone" v-model="userForm.phone">
                                            <ul style="color:red" class="overline text-left">
                                              <li v-for="(error, index) in errors" :key="index">
                                                <span>{{ error }}</span>
                                              </li>
                                            </ul>
                                          </div>
                                        </ValidationProvider>
                                        <ValidationProvider
                                          name="password"
                                          ref="password"
                                          rules="required|customPassword|min:8"
                                          v-slot="{ errors }"
                                        >
                                          <div class="form-group">
                                              <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Mật khẩu</label>
                                              <input type="password" class="form-control" name="password" v-model="userForm.password">
                                              <ul style="color:red" class="overline text-left">
                                                <li v-for="(error, index) in errors" :key="index">
                                                  <span>{{ error }}</span>
                                                </li>
                                              </ul>
                                          </div>
                                        </ValidationProvider>
                                        <ValidationProvider
                                          name="password_confirmation"
                                          ref="password_confirmation"
                                          rules="required|password_confirmation:@password"
                                          v-slot="{ errors }"
                                        >
                                          <div class="form-group">
                                              <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Nhập lại mật khẩu</label>
                                              <input type="password" class="form-control" name="password_confirmation" v-model="userForm.password_confirmation" data-vv-as="password">
                                              <ul style="color:red" class="overline text-left">
                                                  <li v-for="(error, index) in errors" :key="index">
                                                  <span>{{ error }}</span>
                                                  </li>
                                              </ul>
                                          </div>
                                        </ValidationProvider>
                                        <div class="form-submit text-center" style="padding-bottom: 10px; margin-top:10px">
                                            <button type="button" @click="createUser()" class="btn bg-netbee" style="font-weight: bold;width: 100%">Tạo</button>
                                        </div>
                                      </ValidationObserver>
                                  </form>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </tr>
                      </tbody>
                    </table>
                    <p class="mb-0 text-center p-1 font-italic" v-if="users.length == 0" >Không có dữ liệu nào.</p>
                  </div>
                </div>
              </div>
            </div>
            <infinite-loading
              v-if="users.length"
              spinner="bubbles"
              @infinite="infiniteScroll"
              style="padding:20px; width:100%"
            >
              <div slot="no-more" style="font-size:15px; font-style: italic">Hết</div>
              <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
            </infinite-loading>
          </div>
        </section>
      </div>
      <!-- modal create user -->
      <div class="modal fade" id="create_user" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-netbee">
                <h4 class="modal-title text-dark">Tạo tài khoản</h4>
                <button type="button" class="close ma-0" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="modal_body">
                <form method="POST" class="appointment-form" id="appointment-form-2" style="margin-top:10px;" v-on:keyup.enter="signIn">
                  <ValidationObserver ref="observer" v-slot="{ valid }">
                    <ValidationProvider
                      name="name"
                      ref="name"
                      rules="required"
                      v-slot="{ errors }"
                    >   
                      <div class="form-group">
                          <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Họ & Tên</label>
                          <input type="text" class="form-control" name="name" v-model="userForm.name">
                          <ul style="color:red" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                              <span>{{ error }}</span>
                            </li>
                          </ul>
                      </div>
                    </ValidationProvider>
                    <ValidationProvider
                      name="email"
                      ref="email"
                      rules="required|email"
                      v-slot="{ errors }"
                    >
                      <div class="form-group">
                          <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Email</label>
                          <input type="email" class="form-control" name="email" v-model="userForm.email">
                          <ul style="color:red" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                              <span>{{ error }}</span>
                            </li>
                          </ul>
                      </div>
                    </ValidationProvider>
                    <ValidationProvider
                      rules="required|integer"
                      ref="phone"
                      name="phone"
                      v-slot="{ errors }"
                    >
                      <div class="form-group">
                        <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" v-model="userForm.phone">
                        <ul style="color:red" class="overline text-left">
                          <li v-for="(error, index) in errors" :key="index">
                            <span>{{ error }}</span>
                          </li>
                        </ul>
                      </div>
                    </ValidationProvider>
                    <ValidationProvider
                      name="password"
                      ref="password"
                      rules="required|customPassword|min:8"
                      v-slot="{ errors }"
                    >
                      <div class="form-group">
                          <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Mật khẩu</label>
                          <input type="password" class="form-control" name="password" v-model="userForm.password">
                          <ul style="color:red" class="overline text-left">
                            <li v-for="(error, index) in errors" :key="index">
                              <span>{{ error }}</span>
                            </li>
                          </ul>
                      </div>
                    </ValidationProvider>
                    <ValidationProvider
                      name="password_confirmation"
                      ref="password_confirmation"
                      rules="required|password_confirmation:@password"
                      v-slot="{ errors }"
                    >
                      <div class="form-group">
                          <label for="exampleInputEmail1" class="text-register"><span class="text-danger">(*)</span>Nhập lại mật khẩu</label>
                          <input type="password" class="form-control" name="password_confirmation" v-model="userForm.password_confirmation" data-vv-as="password">
                          <ul style="color:red" class="overline text-left">
                              <li v-for="(error, index) in errors" :key="index">
                              <span>{{ error }}</span>
                              </li>
                          </ul>
                      </div>
                    </ValidationProvider>
                    <div class="form-submit text-center" style="padding-bottom: 10px; margin-top:10px">
                        <button type="button" @click="createUser()" class="btn bg-netbee" style="font-weight: bold;width: 100%">Tạo</button>
                    </div>
                  </ValidationObserver>
              </form>
              </div>
            </div>
          </div>
      </div>
      <!-- end modal create user -->
    </div>
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";
import Vue from "vue";
import moment from "moment";
import { ValidationObserver } from "vee-validate/dist/vee-validate.full";
import {ValidationProvider, extend} from "vee-validate/dist/vee-validate.full";

// can customize default error messages
extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});
extend("email", {
  message: (field, values) => "Email không đúng định dạng"
});
extend("integer", {
  message: (field, values) => "Dữ liệu nhập vào phải là số"
});
extend("min", {
  message: (field, values) => "Dữ liệu nhập vào ít nhất" + `${values}`
});
extend("alpha", {
  message: (field, values) => "Dữ liệu nhập vào phải là chữ."
});
extend('password_confirmation', {
  params: ['target'],
  validate(value,{target}) {
    return value === target;
  },
  message: 'Mật khẩu nhập vào không khớp'
});

// create custom error message for custom rule
var errorMessage =
  " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 ký tự in hoa, 1 số và 1 ký tự đặc biệt(#!@$%^*-)";
// create custom rule
extend("customPassword", {
  message: field =>"Mật khẩu" + errorMessage,
  validate: value => {
    var notTheseChars = /["'?&/<>\s]/;
    var mustContainTheseChars = /^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
    var containsForbiddenChars = notTheseChars.test(value);
    var containsRequiredChars = mustContainTheseChars.test(value);
    if (containsRequiredChars && !containsForbiddenChars) {
      return true;
    } else {
      if (containsForbiddenChars) {
        errorMessage =
          ' không được chứa các ký tự: " ' + " ' ? & / < > hoặc khoảng trắng";
      } else {
        errorMessage =
          " phải chứa ít nhất 8 ký tự, 1 ký tự in thường, 1 số.";
      }
      return false;
    }
  }
});
export default {
  name: "users",
  layout: "admin",
  head: {
    title: "Danh sách tài khoản",
    script: [
      { src: "/app-assets/vendors/js/tables/datatable/pdfmake.min.js" },
      { src: "/app-assets/vendors/js/tables/datatable/vfs_fonts.js" }
    ]
  },
  components: {
    Multiselect,
    ValidationProvider,
    ValidationObserver
  },
  data() {
    return {
      elementUpdate: this.defaultValue(),
      userDetail: [],
      userRole: 0,
      users: [],
      cardSearch: {
        search: "",
        searchStatus: "",
        searchBlock: "",
        searchName: "",
        searchFromDate: "",
        searchToDate: ""
      },
      userForm: {
        name: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: "",
        role: ""
      },
      block: [
        { id: 0, name: "Đang hoạt động" },
        { id: 1, name: "Blocked" }
      ],
      status: [
        { id: 1, name: "Đã kích hoạt" },
        { id: 0, name: "Chưa kích hoạt" }
      ],
      id: null,
      selected: [],
      page: 1
    };
  },
  created() {
    this.search();
  },
  mounted() {
      let role = this.$route.query.role;
      let titles = [
        'Danh sách ứng viên',
        'Danh sách NTD',
        'Danh sách HR',
      ];
      $('.title-page').text(titles[+role - 1]);
  },
  methods: {
    async createUser() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        try {
          let response = await this.$axios.post("user/" + this.userRole + "/create", {
            email: this.userForm.email,
            password: this.userForm.password,
            name: this.userForm.name,
            phone: this.userForm.phone,
            role: this.$route.query.role
          });
          if(response.data.status == 200){
            this.$swal({
              titile: 'Tạo tài khoản thành công',
              text: response.data.message,
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK',
            }).then( function (){
                window.location.reload();
            })
          }
          else{
            this.$swal(
              'Lỗi!',
              response.data.message,
              'error'
            )
          }
        } catch (error) {
          'Lỗi',
          'Error'
        }
        requestAnimationFrame(() => {
          this.$refs.observer.reset();
        });
      }
    },

    actionUpdate() {
      $('#overlay_update').show();
      let className = 'text-danger';
      this.$axios
        .$post("user/" + this.userRole + "/update", this.userDetail)
        .then(response => {
          if (response.status == 200) {
            this.elementUpdate = this.defaultValue();
            className = 'text-success';
          }
          $('#message_update').attr('class', className).show().text(response.message).fadeOut(4500);
          $('#overlay_update').hide();
        })
        .catch(e => {
          this.$swal("Lỗi!", "Lỗi bỏ kích hoạt!", "error");
          $('#overlay_update').hide();
        });

    },
    showEditBox(key) {
      this.elementUpdate = this.defaultValue();
      this.elementUpdate[key] = !this.elementUpdate[key];
    },
    nameWithLang({ name, id }) {
      return `${name}`;
    },
    changeStatus(id) {
      this.$axios
        .$post("user/" + this.userRole + "/changeStatus", { id: id })
        .then(response => {
          if (response.status == 200) {
            this.$swal("Thành công!", response.message, "success");
            this.search();
          } else {
            this.$swal("Lỗi!", response.message, "error");
          }
        })
        .catch(e => {
          this.$swal("Lỗi!", "Lỗi bỏ kích hoạt!", "error");
        });
    },
    searchDate() {
      return this.search();
    },
    search() {
      this.userRole = this.$route.query.role;
      this.$axios
        .$get(
          "user/" + this.userRole +
            "/search?searchBlock=" +
            (this.cardSearch.searchBlock.id != null
              ? this.cardSearch.searchBlock.id
              : "") +
            "&searchStatus=" +
            (this.cardSearch.searchStatus.id != null
              ? this.cardSearch.searchStatus.id
              : "") +
            "&search=" +
            (this.cardSearch.search ? this.cardSearch.search : "") +
            "&searchName=" +
            (this.cardSearch.searchName ? this.cardSearch.searchName : "") +
            "&searchFromDate=" +
            (this.cardSearch.searchFromDate
              ? this.cardSearch.searchFromDate
              : "") +
            "&searchToDate=" +
            (this.cardSearch.searchToDate ? this.cardSearch.searchToDate : "")
        )
        .then(response => {
          this.users = response.data;
        });
    },
    async changeMultipleStatus(status) {
      try {
        this.$axios
          .$post("user/" + this.userRole + "/changeMultipleStatus", {
            id: JSON.stringify(this.selected),
            status: status
          })
          .then(res => {
            if (JSON.stringify(this.selected).length == 2) {
              this.$swal({
                title: "Bạn chưa chọn tài khoản!",
                icon: "warning",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
              }).then(() => {
                this.search();
                this.selected = [];
              });
            } else if (res.status == 200) {
              this.search();
              this.$swal({
                title: "Thành công",
                text: res.message,
                icon: "success",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
              }).then(() => {
                console.log("ok");

                this.selected = [];
              });
            } else {
              this.$swal("Lỗi!", res.message, "error");
            }
          });
      } catch (error) {
        this.$swal("Lỗi!", "Lỗi bỏ kích hoạt!", "error");
      }
    },
    sortAscendingID() {
      this.users.sort((a, b) => (a.id > b.id ? 1 : -1));
    },
    sortDecreaseID() {
      this.users.sort((a, b) => (a.id < b.id ? 1 : -1));
    },
    infiniteScroll($state) {
      setTimeout(() => {
        this.page++;
        this.$axios
          .get(
            "user/" +
              this.userRole +
              "/search?searchBlock=" +
              (this.cardSearch.searchBlock.id
                ? this.cardSearch.searchBlock.id
                : "") +
              "&searchStatus=" +
              (this.cardSearch.searchStatus.id != null
                ? this.cardSearch.searchStatus.id
                : "") +
              "&search=" +
              (this.cardSearch.search ? this.cardSearch.search : "") +
              "&searchName=" +
              (this.cardSearch.searchName ? this.cardSearch.searchName : "") +
              "&searchFromDate=" +
              (this.cardSearch.searchFromDate
                ? this.cardSearch.searchFromDate
                : "") +
              "&searchToDate=" +
              (this.cardSearch.searchToDate
                ? this.cardSearch.searchToDate
                : "") +
              "&page=" +
              this.page
          )
          .then(response => {
            if (response.data.data.length > 1) {
              response.data.data.forEach(item => this.users.push(item));
              $state.loaded();
            } else {
              $state.complete();
            }
          })
          .catch(err => {
            console.log(err);
          });
      }, 500);
    },

    async blockUser(id) {
      this.$axios
        .$post("user/" + this.userRole + "/blockUser", { id: id })
        .then(response => {
          if (response.status == 200) {
            this.$swal("Block thành công!", response.message, "success");
            this.search();
          } else {
            this.$swal("Lỗi!", response.message, "error");
          }
        })
        .catch(e => {
          this.$swal("Lỗi!", "Block thất bại!", "error");
        });
    },

    async blockMultipleUser() {
      try {
        this.$axios
          .$post("user/" + this.userRole + "/blockMultipleUser", {
            id: JSON.stringify(this.selected)
          })
          .then(res => {
            if (JSON.stringify(this.selected).length == 2) {
              this.$swal({
                title: "Bạn chưa chọn tài khoản!",
                icon: "warning",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
              }).then(() => {
                this.search();
                this.selected = [];
              });
            } else if (res.status == 200) {
              this.search();
              this.$swal({
                title: "Thành công",
                text: res.message,
                icon: "success",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
              }).then(() => {
                console.log("ok");

                this.selected = [];
              });
            } else {
              this.$swal("Lỗi!", res.message, "error");
            }
          });
      } catch (error) {
        this.$swal("Lỗi!", "Lỗi!", "error");
      }
    },
    resetForm() {
      (this.cardSearch.search = ""),
        (this.cardSearch.searchStatus = ""),
        (this.cardSearch.searchName = ""),
        (this.cardSearch.searchBlock = ""),
        (this.cardSearch.searchFromDate = ""),
        (this.cardSearch.searchToDate = "");
    },
    openModal(key) {
      $('#overlay_update').hide();
      this.elementUpdate = this.defaultValue();
      this.userDetail = this.users[key];
      $('#detail_user').modal();
    },
    openModalCreate(){
      $('#create_user').modal();
    },
    defaultValue() {
      return {
        name: true,
        phone: true,
        address_detail: true,
        birth_of_date: true
      }
    },
    exportUser(){
      if(this.selected.length == 0){
        this.$swal('Cảnh báo' , 'Vui lòng chọn bản ghi cần xuất', 'warning');
      }
      else{
        window.location.href = "https://netbee.vn/api/usersExport?id=" + this.selected;
      }
    }
  },
  computed: {
    selectAll: {
      get() {
        if (this.users.length > 0) {
          // A news array exists with at least one item
          let allChecked = true;

          this.users.forEach(item => {
            if (!this.selected.includes(item.id)) {
              allChecked = false; // If even one is not included in array
            }

            // Break out of loop if mismatch already found
            if (!allChecked) return;
          });

          return allChecked;
        }
        return false;
      },
      set(value) {
        const checked = [];

        if (value) {
          this.users.forEach(item => {
            checked.push(item.id);
          });
        }

        this.selected = checked;
      }
    }
  }
};
</script>
<style scoped>
.pagination .page-item.active .page-link {
  background-color: #ffb701 !important;
}
.input_date input {
  /* max-height: 34px; */
  padding: 5px;
}
.close{
  margin: -0.5rem 0;
}
.modal-body label{
  font-weight: bold;
}
.modal-item{
  margin-bottom: 5px;
}
.modal-item:hover{
  background-color: rgba(34, 41, 47, 0.075);
}
label span{
    padding-right: 3px;
    font-size: 14px;
}
label{
    font-size: 15px;
}
ul{
    list-style: none;
    padding-left: 5px;
    padding-top: 5px;
}
ul li span{
  font-style: italic;
}
</style>
