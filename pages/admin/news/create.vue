<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row m-b-10 p-b-10">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="row pb-2">
                                    <ValidationObserver v-slot="{ invalid }">
                                        <form class="w-100 px-2" method="post">
                                            <div class="row">
                                                <div class="col-12" id="hegimg">
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">Ảnh tiêu đề</label>
                                                        <ImgUploader :files="files"></ImgUploader>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12" id="hegtitle">
                                                    <ValidationProvider rules="required" v-slot="{ errors }">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Tiêu đề</label>
                                                            <input type="text" class="form-control" id="basicInput" placeholder="Tiêu đề" v-model="dataNews.title">
                                                            <span style="color: red">{{ errors[0] }}</span>
                                                        </fieldset>
                                                    </ValidationProvider>
                                                </div>
                                                <div class="col-12">
                                                    <ValidationProvider rules="required" v-slot="{ errors }">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Nội dung</label>
                                                            <vue-editor useCustomImageHandler @image-added="handleImageAdded" v-model="dataNews.content" style="overfollow: scroll">

                                                            </vue-editor>
                                                            <span style="color: red">{{ errors[0] }}</span>
                                                        </fieldset>
                                                    </ValidationProvider>
                                                </div>
                                                <div class="col-12">
                                                    <ValidationProvider rules="required" v-slot="{ errors }">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Nội dung mô tả ngắn</label>
                                                            <textarea rows="3" class="form-control" v-model="dataNews.short_content"></textarea>
                                                            <span style="color: red">{{ errors[0] }}</span>
                                                        </fieldset>
                                                    </ValidationProvider>
                                                </div>
                                                <div class="col-12">
                                                    <ValidationProvider rules="required" v-slot="{ errors }">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Danh mục tin</label>
                                                            <multiselect v-model="dataNews.id_category" :options="options" :custom-label="nameWithLang" :searchable="false" :allow-empty="false" :show-labels="false" placeholder="Chọn danh mục"></multiselect>
                                                            <span style="color: red">{{ errors[0] }}</span>
                                                        </fieldset>
                                                    </ValidationProvider>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <button type="submit" class="btn btn-warning" :disabled="invalid" @click="upload">Tạo tin</button>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </ValidationObserver>
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
import axios from 'axios';
import ImgUploader from '~/components/ImgUploader';
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import { ValidationProvider, extend } from 'vee-validate/dist/vee-validate.full';
import { ValidationObserver } from "vee-validate/dist/vee-validate.full";

let VueEditor
if (process.client) {
    VueEditor = require('vue2-editor').VueEditor
    Vue.use(VueEditor);
}

extend("required", {
  message: (field, values) => "Dữ liệu nhập vào không được để trống.",
});


export default {
    components: {
        VueEditor,
        ImgUploader,
        Multiselect,
        ValidationProvider,
        ValidationObserver
    },
    name: 'create',
    layout: 'admin',
    data() {
        return{
            files: [],
            response: {
                status: 400,
                message: ''
            },
            dataNews: {
                thuml: [],
                title: '',
                content: '',
                short_content: '',
                id_category: null,
            },
            options: [
                {id: 1, name: 'Cẩm nang'},
                {id: 2, name: 'Xuất khẩu lao động'},
                {id: 3, name: 'Du học'}
            ], id: null
        }
    },
    methods:{
        // handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {        
        //     var formData = new FormData();
        //     formData.append("image", file);        
        //     this.$axios.post('tintuc/createTinTucImg',formData)
        //         .then(result => {
        //         let url = result.data.url;
        //         Editor.insertEmbed(cursorLocation, "image", url);
        //         resetUploader();
        //         })
        //         .catch(err => {
        //         console.log(err);
        //         });
        //     },
        handleImageAdded(file, Editor, cursorLocation) {
            const CLIENT_ID = '993793b1d8d3e2e'
            var formData = new FormData();
            formData.append('image', file)
            axios({
                url: 'https://api.imgur.com/3/image',
                method: 'POST',
                headers:{
                'Authorization': 'Client-ID ' + CLIENT_ID
                },
                data: formData
            })
            .then((result) => {             
                let url = result.data.data.link
                Editor.insertEmbed(cursorLocation, 'image', url);
            })
            .catch((err) => {
                console.log(err);
            })
            },
        nameWithLang ({ name, id }) {
            return `${id} - [${name}]`
        },
        upload(e){
            e.preventDefault();
            var form = new FormData();
            this.id = this.dataNews.id_category.id
            form.append('thuml' , this.files[0])
            form.append('title' , this.dataNews.title)
            form.append('content' , this.dataNews.content)
            form.append('short_content' , this.dataNews.short_content,)
            form.append('id_category' , this.id )
                                              
            this.$axios.post('tintuc/createTinTuc',form)
            .then(response => {
                if(response.data.status == 200) {
                    this.$swal(
                        'Thành công',
                        response.data.message,
                        'success'
                    ).then( function (){
                            window.location.href = '/admin/news';
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
    mounted(){
        $(document).ready(function() {
            $(window).scroll(function(event) {
                var pos_body = $('html,body').scrollTop();     
                var hegimg =  $('#hegimg').height();                            
                var hegtitle =  $('#hegtitle').height();                         
                var hh = hegimg + hegtitle + 100; 
                if(pos_body > hh){
                    $('.ql-toolbar').addClass('fixedmenu');
                    var wid =  $('.quillWrapper').width();                        
                    document.getElementsByClassName("fixedmenu")[0].style.width = wid + "px";                                          
                }
                else {
                    $('.ql-toolbar').removeClass('fixedmenu');
                }                   
            });              
        });
    }
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

  .multiselect__option--highlight {
    background: #ffb701;
    color: #000;
}
html body .content .content-wrapper {
    margin-top: 62px;
    padding: 15px 15px 50px 15px;
}
</style>