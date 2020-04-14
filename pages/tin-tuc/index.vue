<template>
    <div>
        <section class="bg-white category p-1 m-b-15">
            <div class="container">
                <div class="row d-flex bg-white ">
                    <div class="col-md-6 pd-20">
                        <a href="/"><i class="fa fa-home pr-2"></i>Trang chủ</a>
                        <a href="/tin-tuc"><i class="fa fa-caret-right pr-2 pl-2"></i>Tin tức</a>
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
                                <a href="/tin-tuc/tin-moi"><i class="fad fa-plus"></i> Xem thêm</a>
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
                                <a href="/tin-tuc/category"><i class="fad fa-plus"></i> Xem thêm</a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <NewListPage2 :DataList="tintucCamNang"></NewListPage2>
                                </div>
                            </div>
                        </div>
                        <div class="card" v-if="tintucDuHoc.length > 0">
                            <div class="card-header">
                                <h4><i class="fas fa-newspaper"></i> Du học</h4>
                                <a href="/tin-tuc/category"><i class="fad fa-plus"></i> Xem thêm</a>
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
                                <a href="/tin-tuc/category"><i class="fad fa-plus"></i> Xem thêm</a>
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
                                                    <a href="#">
                                                        <h2 class="mr-3 text-black h6 NB_title" ><i class="fa fa-arrow-right"></i>{{ danhmuc.name_cate }}</h2>
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
                                <div class="card-body scrollbar">
                                    <JobsList1ColNotCate :DataList="arrayJob"></JobsList1ColNotCate>
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
import NewListPage1 from '../../components/News/NewListPage1';
import NewListPage2 from '../../components/News/NewListPage2';
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';

export default {
    components:{
        NewListPage1,
        NewListPage2,
        JobsList1ColNotCate
    },
    async  asyncData ({ $axios, error }) {
        let getTinTucNew = await $axios.$get('getTinTucNew?limit=5')
        let tintucCamNang = await $axios.$get('getTinTucCate?category=1&limit=5')
        let tintucDuHoc = await $axios.$get('getTinTucCate?category=2&limit=5')
        let tintucXKLD = await $axios.$get('getTinTucCate?category=3&limit=5')
        let getDanhMucTinTuc = await $axios.$get('getDanhMucTinTuc')
        return {
        tintucNew: getTinTucNew.data.tintuc,
        tintucCamNang: tintucCamNang.data.tintuc,
        tintucDuHoc: tintucDuHoc.data.tintuc,
        tintucXKLD: tintucXKLD.data.tintuc,
        getDanhMucTinTuc: getDanhMucTinTuc.data
        }

    },
    data() {
        return {
            tintucNew: [],
            tintucCamNang: [],
            tintucDuHoc: [],
            tintucXKLD: [],
            getDanhMucTinTuc: [],
            arrayNew: [
                {
                    id: 1,
                    title: 'Điều kiện đưa người lao động đi thực tập kỹ năng tại Nhật Bản',
                    content: 'Content tin tức 1,hfiakh,vdjailh jdiosa dnsa cbsha cnsaj,vndajk vnad sậu vbajc xajbvdk chiabc adkhbsa chahbf ajk vcsaigdbsuia cqawgdbhsa cwhajfb hsajnmbduiakf dsv à afakjfhnuwjkfb fkahnfujkmsb av',
                    time: '09/04/2020'
                },
                {id: 2, title: 'Tư vấn các thủ tục cần thiết để đi Xuất khẩu lao động Nhật Bản', content: 'Content tin tức 2', time: '09/04/2020'},
                {id: 3, title: 'Nhật Bản tạm ngừng nhập cảnh lao động Việt Nam do dịch nCoV', content: 'Content tin tức 3', time: '09/04/2020'},
                {id: 4, title: 'Mức lương thu nhập đi xuất khẩu lao động Nhật Bản 2020', content: 'Content tin tức 4', time: '09/04/2020'},
                {id: 5, title: 'Hành trang du học - Những điều kiện cơ bản cần biết khi có ý định du học', content: 'Content tin tức 5', time: '09/04/2020'},
            ],
            arrayJob: [
                {id: 1, title: 'chào cả nhà1'},
                {id: 2, title: 'chào cả nhà2'},
                {id: 3, title: 'chào cả nhà3'},
                {id: 4, title: 'chào cả nhà4'},
                {id: 5, title: 'chào cả nhà5'},
                {id: 6, title: 'chào cả nhà6'},
                {id: 6, title: 'chào cả nhà6'},
                {id: 6, title: 'chào cả nhà6'},
            ],
        }
    },
    methods: {
        async fetch () {
            let getTinTucNew = await this.$axios.$get('getTinTucNew?limit=5')
            let tintucCamNang = await this.$axios.$get('getTinTucCate?category=1&limit=5')
            let tintucDuHoc = await this.$axios.$get('getTinTucCate?category=2&limit=5')
            let tintucXKLD = await this.$axios.$get('getTinTucCate?category=3&limit=5')
            let getDanhMucTinTuc = await this.$axios.$get('getDanhMucTinTuc')
            this.tintucNew = getTinTucNew.data.tintuc,
            this.tintucCamNang = tintucCamNang.data.tintuc,
            this.tintucDuHoc = tintucDuHoc.data.tintuc,
            this.tintucXKLD = tintucXKLD.data.tintuc,
            this.getDanhMucTinTuc = getDanhMucTinTuc.data
        },
    },
    mounted() {
        this.fetch();
    }
}
</script>
<style>

</style>