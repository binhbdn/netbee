<template>
    <div>
        <section class="ftco-section bg-white category" style="">
            <div class="container">
                <div class="row d-flex bg-white ">
                    <div class="col-md-6 pd-20">
                        <a href="#"><i class="fa fa-home pr-2"></i>Trang chủ</a>
                        <a href="#"><i class="fa fa-caret-right pr-2 pl-2"></i>Tin tức</a>
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section bg-white" style="background-color: #f6f6f6!important; padding-top: 15px;">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fas fa-newspaper"></i> TIN MỚI</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 make-it-slow py-1" v-for="(item, index) in arrayNew" :key="index">
                                            <NewItempage2 :id="item.id" :title="item.title" :content="item.content" :time="item.time" :type="1"></NewItempage2>
                                        </div>
                                    </div>
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
                                                    <a :href="`/tin-tuc/${ChangeToSlug(danhmuc.name_cate)}`">
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
                                <h4 class="card-title"><i class="fad fa-bullhorn"></i> Gọi ý việc làm  </h4>
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
import NewListPage1 from '~/components/News/NewListPage1';
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';
import NewItempage2 from '~/components/NewItempage2';

export default {
    components:{
        NewListPage1,
        JobsList1ColNotCate,
        NewItempage2
    },
    data() {
        return {
            arrayNew: [],
            getDanhMucTinTuc: [],
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
            console.log(this.$route.params.category)
            switch (this.$route.params.category) {
                case "tin-moi":
                    let arrayNew = await this.$axios.$get('getTinTucNew?limit=5');
                    this.arrayNew = arrayNew.data.tintuc;
                    break;
                case "cam-nang":
                    let arrayCamNang = await this.$axios.$get('getTinTucCate?category=1&limit=5');
                    this.arrayNew = arrayCamNang.data.tintuc;
                    break;
                case "du-hoc":
                    let arrayDuHoc = await this.$axios.$get('getTinTucCate?category=2&limit=5');
                    this.arrayNew = arrayDuHoc.data.tintuc;
                    break;
                case "xuat-khau-lao-dong":
                    let arrayXKLD = await this.$axios.$get('getTinTucCate?category=3&limit=5');
                    this.arrayNew = arrayXKLD.data.tintuc;
                    break;
                default:
                    let arrayNew1 = await this.$axios.$get('getTinTucNew?limit=5');
                    this.arrayNew = arrayNew1.data.tintuc;
                    break;
            }
            let getDanhMucTinTuc = await this.$axios.$get('getDanhMucTinTuc')
            this.getDanhMucTinTuc = getDanhMucTinTuc.data
        },
    },
    mounted() {
        this.fetch();
    },
    asyncData({$axios, route}) {
        switch (route.params.category) {
                case "tin-moi":
                    return {title: 'Tin tức mới về du học,tin tức mới về xuất khẩu lao động,tin tuyển dụng'}
                    break;
                case "cam-nang":
                    return {title: 'Tin tức cẩm nang du học,tin tức mới về xuất khẩu lao động,tin tuyển dụng'}
                    break;
                case "du-hoc":
                    return {title: 'Tin tức du học,tin tức mới về xuất khẩu lao động,tin tuyển dụng'}
                    break;
                case "xuat-khau-lao-dong":
                    return {title: 'Tin tức xuất khẩu lao động về du học,tin tức mới về xuất khẩu lao động,tin tuyển dụng'}
                    break;
                default:
                    return {title: 'Tin tức mới về du học,tin tức mới về xuất khẩu lao động,tin tuyển dụng'}
                    break;
            }
    },
    head() {
        const title = this.title
        return {
            title: title,
            meta: [
                { hid: 'description', name: 'description', content: title },
                { hid: 'keywords', name: 'keywords', content: title.replace(/ /g, ",")},
                { hid: 'og:url', name: 'og:url', content: 'https://netbee.vn'+this.$route.path},
                { hid: 'og:title', name: 'og:title', content: title},
                { hid: 'og:description', name: 'og:description', content: title},
            ]
        }

    },
}
</script>
<style>

</style>