<template>
    <div style="padding-left:10px;padding-right:10px;" class="main-edu-cv">  
        <div class="icon-01-01 fieldset1" >  
            <button class="btn-cv-01 btn-cv-add" @click="add(edu.id_profile_user)">Thêm</button>
            <button class="btn-cv-01 btn-cv-delete" @click="deletee(edu.id)">Xóa</button>                                                                
        </div>             
        <div class="education-cv">
            <div class="row">
                <div class="col-md-8">
                    <textarea v-model="edu.name_education" @click="text()" class="main-text textarea" placeholder="VD: TRƯỜNG ĐẠI HỌC BÔN BA"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>                                                   
                </div>
                <div class="col-md-4" style="text-align: right; padding-left:0px;">
                    <div class="row">
                        <div class="col-md-6" style="padding:0;">
                            <span><textarea v-model="edu.from_datetime_education" @click="text()" style="margin-top:5px;font-size:12px;overflow:hidden;" class="main-text textarea" placeholder="VD: 2020/01/01"  @input="mixin_autoResize_resize" rows="1"></textarea></span>
                        </div>
                        <div class="col-md-6" style="padding-left:0px;">
                            <span><textarea v-model="edu.to_datetime_education" @click="text()" style="margin-top:5px;font-size:12px;overflow:hidden;" class="main-text textarea" placeholder="VD: 2020/01/01"  @input="mixin_autoResize_resize" rows="1"></textarea></span>
                        </div>
                    </div>                   
                </div>
            </div>                                
        </div>                  
        <div class="education-khoa">
            <textarea v-model="edu.learning_education" @click="text()" class="main-text textarea" placeholder="VD: KHOA CÔNG NGHỆ THÔNG TIN"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
        </div>                  
        <div class="education-cap">
            <textarea v-model="edu.business_education" @click="text()" class="main-text textarea" placeholder="VD: BẰNG CẤP KHÁ"  style="overflow:hidden;" @input="mixin_autoResize_resize" rows="1"></textarea>
        </div>                                                                                                              
    </div>
</template>
<script>

export default {
    name: 'EducationUser',
    props: {
        edu: Object
    }, 
    data() {
        return {
        }
    },
    methods: {
        mixin_autoResize_resize(event) {
            event.target.style.height = "auto";
            event.target.style.height = `${event.target.scrollHeight}px`;
        },
        text(){
                        
        },
        add(id){
            this.$emit("add",id);
        },
        deletee(id){
            this.$emit("deletee",id);  
        }
    },
    mounted() {
        
    }
}
</script>
<style>
</style>
