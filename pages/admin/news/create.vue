<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Danh sách tin tức</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/">Bài viết</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Tạo bài viết mới
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="row pb-2">
                                    <form class="w-100 px-2" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-12">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Ảnh tiêu đề</label>
                                                    <div class="dropbox">
                                                        <input type="file"  class="input-file">
                                                        <p>
                                                            Drag your file(s) here to begin<br> or click to browse
                                                        </p>
                                                        <p>
                                                            Uploading files...
                                                        </p>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Tiêu đề</label>
                                                    <input type="text" class="form-control" id="basicInput" placeholder="Tiêu đề">
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Nội dung</label>
                                                    <vue-editor></vue-editor>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Nội dung mô tả ngắn</label>
                                                    <textarea rows="3" class="form-control"></textarea>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Từ khóa</label>
                                                    <input type="text" class="form-control" id="basicInput" placeholder="Từ khóa">
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Từ khóa</label>
                                                    <select class="form-control select2">
                                                        <option>Cẩm nang</option>
                                                        <option>Xuất khẩu lao động</option>
                                                        <option>Du học</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 text-right">
                                                <button type="submit" class="btn btn-warning">Tạo tin</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Vue from "vue";

let VueEditor
if (process.client) {
    VueEditor = require('vue2-editor').VueEditor
    Vue.use(VueEditor);
}




export default {
    components: {
        VueEditor
    },
    name: 'create',
        layout: 'admin',
    //     data() {
    //         return {
    //             uploadedFiles: [],
    //             uploadError: null,
    //             currentStatus: null,
    //             uploadFieldName: 'photos'
    //         };
    //     },
    //     computed: {
    //   isInitial() {
    //     return this.currentStatus === STATUS_INITIAL;
    //   },
    //   isSaving() {
    //     return this.currentStatus === STATUS_SAVING;
    //   },
    //   isSuccess() {
    //     return this.currentStatus === STATUS_SUCCESS;
    //   },
    //   isFailed() {
    //     return this.currentStatus === STATUS_FAILED;
    //   }
    // },
    // methods: {
    //     reset() {
    //         // reset form to initial state
    //         this.currentStatus = STATUS_INITIAL;
    //         this.uploadedFiles = [];
    //         this.uploadError = null;
    //     },
    //     save(formData) {
    //         debugger
    //         // upload data to the server
    //         this.currentStatus = STATUS_SAVING;

    //         upload(formData)
    //         .then(x => {
    //             this.uploadedFiles = [].concat(x);
    //             this.currentStatus = STATUS_SUCCESS;
    //         })
    //         .catch(err => {
    //             this.uploadError = err.response;
    //             this.currentStatus = STATUS_FAILED;
    //         });
    //     },
    //     filesChange(fieldName, fileList) {
    //         // handle file changes
    //         const formData = new FormData();
    //         if (!fileList.length) return;

    //         // append the files to FormData
    //         Array
    //         .from(Array(fileList.length).keys())
    //         .map(x => {
    //             formData.append(fieldName, fileList[x], fileList[x].name);
    //         });

    //         // save it
    //         this.save(formData);
    //     }
    //     },
    //     mounted() {
    //         this.reset();
    //     },
    
}
</script>
<style scoped>
.dropbox {
    outline: 2px dashed grey; /* the dash box */
    outline-offset: -10px;
    background: lightcyan;
    color: dimgray;
    padding: 10px 10px;
    min-height: 200px; /* minimum height */
    position: relative;
    cursor: pointer;
    width: 200px;
  }

  .input-file {
    opacity: 0; /* invisible but it's there! */
    width: 100%;
    height: 200px;
    position: absolute;
    cursor: pointer;
  }

  .dropbox:hover {
    background: lightblue; /* when mouse over to the drop zone, change color */
  }

  .dropbox p {
    font-size: 1.2em;
    text-align: center;
    padding: 50px 0;
  }
</style>