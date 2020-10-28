<template>
    <div>
        <section class="ftco-section bg-white" style="background-color: #f6f6f6!important; padding-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 v-if="$route.path == '/tin-tuc/tin-moi'"><i class="fad fa-newspaper"></i> TIN MỚI</h4>
                                <h4 v-if="$route.path == '/tin-tuc/xuat-khau-lao-dong'"><i class="fad fa-newspaper"></i> Xuất khẩu lao động</h4>
                                <h4 v-if="$route.path == '/tin-tuc/du-hoc'"><i class="fad fa-newspaper"></i> Du học</h4>
                                <h4 v-if="$route.path == '/tin-tuc/cam-nang'"><i class="fad fa-newspaper"></i> Cẩm nang</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 make-it-slow py-1" v-for="(item, index) in arrayNew" :key="index">
                                            <NewItempage2 :id="item.id" :title="item.title" :short_content="item.short_content" :time="item.time" :type="1" :thuml="item.thuml" :created_at="item.updated_at"></NewItempage2>
                                        </div>
                                    </div>
                                    <infinite-loading
                                            v-if="arrayNew.length"
                                            spinner="bubbles"
                                            @infinite="infiniteScroll" style="padding:20px; width:100%"
                                        >
                                        <div slot="no-more" style="font-size:15px; font-style: italic">Hết tin</div>
                                        <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
                                    </infinite-loading>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-lg-0">
                        <div class="card">
                            <div class="card-header">
                                <h4>DANH MỤC</h4>
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
                        <!-- <div class="card">
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
                                    <JobsList1ColNotCate :DataList="arrayJobNew"></JobsList1ColNotCate>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
// import NewListPage1 from '~/components/News/NewListPage1';
// import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';
import NewItempage2 from '~/components/NewItempage2';

export default {
    components:{
        // NewListPage1,
        // JobsList1ColNotCate,
        NewItempage2
    },
    data() {
        return {
            arrayNew: [],
            getDanhMucTinTuc: [
                { id: 1, name: 'Xuất khẩu lao động'},
                { id: 2, name: 'Du học'},
                { id: 3, name: 'Cẩm nang'},
            ],
            arrayJobNew: [],
            page:1
        }
    },
     methods: {
        async fetch () {
            switch (this.$route.params.category) {
                case "tin-moi":
                    let arrayNew = await this.$axios.$get('getTinTucNewLoading?page='+this.page);
                    this.arrayNew = arrayNew.data.tintuc.data;
                    break;
                case "cam-nang":
                    let arrayCamNang = await this.$axios.$get('getTinTucNewLoading?category=1&page='+this.page);
                    this.arrayNew = arrayCamNang.data.tintuc.data;
                    break;
                case "du-hoc":
                    let arrayDuHoc = await this.$axios.$get('getTinTucNewLoading?category=3&page='+this.page);
                    this.arrayNew = arrayDuHoc.data.tintuc.data;
                    break;
                case "xuat-khau-lao-dong":
                    let arrayXKLD = await this.$axios.$get('getTinTucNewLoading?category=2&page='+this.page);
                    this.arrayNew = arrayXKLD.data.tintuc.data;
                    break;
                default:
                    let arrayNew1 = await this.$axios.$get('getTinTucNewLoading?page='+this.page);
                    this.arrayNew = arrayNew1.data.tintuc.data;
                    break;
            }
            let getTinTuyenDungNew = await this.$axios.$get(`getTinTuyenDungNew?limit=5&type=0`)
            this.arrayJobNew = getTinTuyenDungNew.data.tintuyendung
        },
        infiniteScroll($state) {
            console.log(this.$route.params.category);
            if(this.$route.params.category == 'tin-moi'){
                var $category = '';
            }
            else if(this.$route.params.category == 'cam-nang'){
                var $category = 3;
            }
            else if(this.$route.params.category == 'du-hoc'){
                let $category = 2;
            }
            else if(this.$route.params.category == 'xuat-khau-lao-dong'){
                let $category = 1;
            }
            setTimeout(() => {
                this.page++
                this.$axios
                .get('/getTinTucNewLoading?page='+ this.page + '&category=' + $category)
                .then((response) => {
                    console.log(response.data.data.tintuc.data)
                    if (response.data.data.tintuc.data.length > 1) {
                        response.data.data.tintuc.data.forEach((item) => this.arrayNew.push(item))
                        $state.loaded()
                    } else {
                        $state.complete()
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
            }, 500)
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
