<template>
    <div class="p-1" >
        <div class="uploader"
            @dragenter="OnDragEnter"
            @dragleave="OnDragLeave"
            @dragover.prevent
            @drop="OnDrop"
            :class="{ dragging: isDragging }">
            <div v-show="!images.length && thuml == null">
                <i class="fa fa-cloud-upload" style="color: #ffb701;"></i>
                <div class="file-input">
                    <label :for="`file${type}`">Chọn ảnh</label>
                    <input type="file" :id="`file${type}`" @change="onInputChange"> 
                </div>
            </div>

            <div class="images-preview" v-show="images.length || thuml != null">
                <div class="img-wrapper">
                    <img :src="images[0]" class="imgFixed" v-if="images.length > 0">
                    <img :src="`/uploads/news/${thuml}`" class="imgFixed" v-else>
                </div>
                <div class="file-input">
                    <label :for="`file${type}`">Đổi ảnh</label>
                    <input type="file" :id="`file${type}`" @change="onInputChange"> 
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data:() => ({
        isDragging : false,
        DragCount: 0,
        images: [],
    }),
    props: ['files', 'thuml','type'],
    methods:{
        fetch(files){

        },
        OnDragEnter(e){
            e.preventDefault();

            this.DragCount++;
            this.isDragging = true;
        },
        OnDragLeave(e){
            e.preventDefault();

            this.DragCount--;

            if(this.DragCount <= 0)
                this.isDragging = false;
        },
        OnDrop(e){
            console.log(e);
        },
        onInputChange(e){
            if(this.images.length > 0){
                this.$delete(this.images, 0)
            }
            console.log(this.thuml)
            e.preventDefault();
            e.stopPropagation();
            this.isDragging = false;
            const files = e.target.files;
            if(files.length >0)
                this.addImage(files[0]);

        },
        addImage(file){
            if( !file.type.match('image.*') ){
                this.$swal(
                        'Lỗi',
                        'File không đúng định dạng',
                        'error'
                    )
                return;
            }
            if(this.files.length >0)
                this.$delete(this.files, 0)

            this.files.push(file);

            const img = new Image();
            const reader = new FileReader();

            reader.onload = (e) => this.images.push(e.target.result);

            reader.readAsDataURL(file);
        }
    }, mounted() {

    }
}
</script>
<style scoped>
.uploader {
    width: 100%;
    color: #000;
    padding: 40px 15px;
    text-align: center;
    border: 2px dashed #ffb701;
    font-size: 20px;
    position: relative;
    background: #F8F8F8; 
    border-radius: 8px;
}  

.dragging{
    background: #fff;
    color: #ffb701;
    border: 2px dashed #ffb701;
}

.dragging .file-input label{
    background: #ffb701 !important;
    color: #000 !important;
}

.uploader i {
        font-size: 85px;
    }

.uploader .file-input{
    width: 200px;
    margin: auto;
    height: 68px;
    position: relative;
}
.uploader .file-input label,
.uploader .file-input input{
    background-color: #fff;
    color: #000;
    width: 100%;
    position: absolute;
    left: 0;
    top: 0;
    padding: 10px;
    border-radius: 4px;
    margin-top: 7px;
    cursor: pointer;
}
.uploader .file-input input{
    opacity: 0;
    z-index: -2;
}
.imgFixed {
    height: 240px;
    width: 450px;
}
@media only screen and (max-width: 1800px) {
    .imgFixed {
        height: 180px;
        width: 245px;
    }
}
</style>