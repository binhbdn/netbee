<template>
    <div class="app-content content m-b-10">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="overlay-image-chat-cards">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card  text-white">
                                <img v-lazy="`/uploads/apply/files/${paper.front_id_card}`" class="card-img">
                                <div class="card-img-overlay overlay-black d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-white">CMND mặt trước</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card  text-white">
                                <img v-lazy="`/uploads/apply/files/${paper.back_id_card}`" class="card-img">
                                <div class="card-img-overlay overlay-black d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-white">CMND mặt sau</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="card  text-white">
                                <img v-lazy="`/uploads/apply/files/${paper.high_school_diploma}`" class="card-img">
                                <div class="card-img-overlay overlay-black d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-white">Bằng tốt nghiệp</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card  text-white">
                                <img v-lazy="`/uploads/apply/files/${paper.card_photo}`" class="card-img">
                                <div class="card-img-overlay overlay-black d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-white">Ảnh chân dung</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card  text-white">
                                <img v-lazy="`/uploads/apply/files/${paper.birth_certificate}`" class="card-img">
                                <div class="card-img-overlay overlay-black d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-white">Giấy khai sinh</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card  text-white">
                                <img v-lazy="`/uploads/apply/files/${paper.curriculum_vitae}`" class="card-img">
                                <div class="card-img-overlay overlay-black d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-white">Sơ yếu lý lịch</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card text-white">
                                <img v-lazy="`/uploads/apply/files/${paper.health_certification}`" class="card-img">
                                <div class="card-img-overlay overlay-black d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-white">Giấy khám sức khỏe</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card text-white">
                                <img v-lazy="`/uploads/apply/files/${paper.passport}`" class="card-img">
                                <div class="card-img-overlay overlay-black d-flex flex-column justify-content-between" style="max-height: 100%;">
                                    <h5 class="card-title text-white">Hộ chiếu</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button v-if="paper.status == 5" @click="approve()" class="btn bg-netbee">Duyệt giấy tờ</button>
                </section>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Verify',
    layout: 'admin',
    async asyncData({$axios, route}) {
        let getPaper = await $axios.$get(`apply/getPaperApply/${route.params.id}`)
        return {
            paper: getPaper.data
        }
    },
    methods: {
        approve() {
            this.$axios.$post(`apply/ApprovedApplyHoSoDinhKem/${this.$route.params.id}`).then((response) => {
                if(response.status == 200){
                    this.$swal(
                        'Thành công',
                        response.message,
                        'success'
                    ).then( function (){
                        location.href = '/admin/quan-ly-ung-tuyen'
                    } )
                }
            })
        }
    },
}
</script>