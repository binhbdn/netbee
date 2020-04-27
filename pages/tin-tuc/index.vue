<template>
    <div>
        <section class="category p-b-15">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-md-6 pd-20">
                        <a href="/"><i class="fa fa-home"></i> Trang chủ </a>
                        <a href="/tin-tuc"><i class="fa fa-caret-right"></i> Tin tức</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white" style="background-color: #f6f6f6!important;">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <div class="card" v-if="tintucNew.length > 0">
                            <div class="card-header">
                                <h4><i class="fas fa-newspaper"></i> Tin mới</h4>
                                <a href="/tin-tuc/tin-moi" class="btn bg-netbee">Xem thêm</a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <NewListPage1 :DataList="tintucNew"></NewListPage1>
                                </div>
                            </div>
                        </div>
                        <div class="card" v-if="tintucCamNang.length > 0">
                            <div class="card-header">
                                <h4><i class="fas fa-newspaper"></i> Cẩm nang</h4>
                                <a href="/tin-tuc/cam-nang" class="btn bg-netbee">Xem thêm</a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <NewListPage1 :DataList="tintucCamNang"></NewListPage1>
                                </div>
                            </div>
                        </div>
                        <div class="card" v-if="tintucDuHoc.length > 0">
                            <div class="card-header">
                                <h4><i class="fas fa-newspaper"></i> Du học</h4>
                                <a href="/tin-tuc/du-hoc" class="btn bg-netbee">Xem thêm</a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <NewListPage1 :DataList="tintucDuHoc"></NewListPage1>
                                </div>
                            </div>
                        </div>
                        <div class="card" v-if="tintucXKLD.length > 0">
                            <div class="card-header">
                                <h4><i class="fas fa-newspaper"></i> Xuất khẩu lao động</h4>
                                <a href="/tin-tuc/xuat-khau-lao-dong" class="btn bg-netbee">Xem thêm</a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <NewListPage2 :DataList="tintucXKLD"></NewListPage2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="card">
                            <div class="card-header">
                                <h4>Danh mục</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div  class=" p-2 bg-white col-12" id="cate-1" style="border-bottom: 1px solid #ddd;" v-for="(danhmuc, indexDanhMuc) in getDanhMucTinTuc" :key="indexDanhMuc">
                                            <div class="col-12">
                                                <div class="job-post-item-header d-flex align-items-center">
                                                    <a :href="`/tin-tuc/${ChangeToSlug(danhmuc.name)}`">
                                                        <h2 class="mr-3 text-black h6 NB_title" ><i class="fa fa-arrow-right"></i>{{ danhmuc.name }}</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><i class="fad fa-bullhorn"></i> Gợi ý việc làm  </h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <JobsList1ColNotCate :DataList="arrayJobNew" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import NewListPage1 from '~/components/News/NewListPage1';
import NewListPage2 from '~/components/News/NewListPage2';
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';

export default {
    head: {
        title: 'Tin tức du học,Tuyển du học sinh,tin du học,tin xuất khẩu lao động,Tin tu nghiệp sinh,cẩm nang du học',
        meta: [
            { hid: 'description', name: 'description', content: 'Tin tức du học,Tuyển du học sinh,tin du học,tin xuất khẩu lao động,Tin tu nghiệp sinh,cẩm nang du học' },
            { hid: 'keywords', name: 'keywords', content: 'Tin tức du học,Tuyển du học sinh,tin du học,tin xuất khẩu lao động,cẩm nang du học'.replace(/ /g, ",")},
            { hid: 'og:url', name: 'og:url', content: 'https://netbee.vn/tin-tuc'},
            { hid: 'og:title', name: 'og:title', content: 'Tin tức du học,Tuyển du học sinh,tin du học,tin xuất khẩu lao động,Tin tu nghiệp sinh,cẩm nang du học'},
            { hid: 'og:description', name: 'og:description', content: 'Tin tức du học,Tuyển du học sinh,tin du học,tin xuất khẩu lao động,Tin tu nghiệp sinh,cẩm nang du học'},
        ]
    },
    components:{
        NewListPage1,
        NewListPage2,
        JobsList1ColNotCate
    },
    data() {
        return {
            tintucNew: [],
            tintucCamNang: [],
            tintucDuHoc: [],
            tintucXKLD: [],
            getDanhMucTinTuc: [
                { id: 1, name: 'Xuất khẩu lao động'},
                { id: 2, name: 'Du học'},
                { id: 3, name: 'Cẩm nang'},
            ],
            arrayJobNew: [],
        }
    },
    methods: {
        async fetch () {
            let getTinTucNew = await this.$axios.$get('getTinTucNew?limit=5')
            let tintucCamNang = await this.$axios.$get('getTinTucCate?category=1&limit=5')
            let tintucDuHoc = await this.$axios.$get('getTinTucCate?category=2&limit=5')
            let tintucXKLD = await this.$axios.$get('getTinTucCate?category=3&limit=5')
            let getTinTuyenDungNew = await this.$axios.$get(`getTinTuyenDungNew?limit=5&type=0`)
            this.tintucNew = getTinTucNew.data.tintuc,
            this.tintucCamNang = tintucCamNang.data.tintuc,
            this.tintucDuHoc = tintucDuHoc.data.tintuc,
            this.tintucXKLD = tintucXKLD.data.tintuc,
            this.arrayJobNew = getTinTuyenDungNew.data.tintuyendung
        },
    },
    mounted() {
        this.fetch();
    }
}
</script>
<style>

</style>