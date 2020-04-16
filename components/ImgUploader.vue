<template>
    <div class="p-1" style="background: #ffb701; border-radius: 10px;">
        <div class="uploader"
            @dragenter="OnDragEnter"
            @dragleave="OnDragLeave"
            @dragover.prevent
            @drop="OnDrop"
            :class="{ dragging: isDragging }">
            <div v-show="!images.length">
                <i class="fa fa-cloud-upload" style="color: #000000c7;"></i>
                <div class="file-input">
                    <label for="file">Chọn ảnh</label>
                    <input type="file" id="file" @change="onInputChange"> 
                </div>
            </div>

            <div class="images-preview" v-show="images.length">
                <div class="img-wrapper" v-for="(item, index) in images" :key="index">
                    <img :src="item" width="100%">
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
        images: []
    }),
    props: ['files'],
    methods:{
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

            e.preventDefault();
            e.stopPropagation();

            this.isDragging = false;
            const files = e.target.files;
            
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

            this.files.push(file);

            const img = new Image();
            const reader = new FileReader();

            reader.onload = (e) => this.images.push(e.target.result);

            reader.readAsDataURL(file);
        }
    }
}
</script>
<style scoped>
.uploader {
    width: 100%;
    color: #000;
    padding: 40px 15px;
    text-align: center;
    border-radius: 10px;
    border: 3px dashed #000;
    font-size: 20px;
    position: relative;
}  

.dragging{
    background: #fff;
    color: #ffb701;
    border: 3px dashed #ffb701;
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
    color: #ffb701;
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

</style>