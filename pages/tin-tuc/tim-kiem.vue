// binhbdn: copy từ tim-cong-ty.vue và sửa
<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 p-0">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <i class="fad fa-bullhorn"></i> DANH SÁCH TIN TỨC
                            </h6>
                            <span v-if="countNews!=0" style="color: red;">Có {{countNews}} kết quả tìm kiếm</span>
                            <span class="font-italic" v-else style="color: red;">Không có kết quả phù hợp.</span>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <SearchedNewsList :DataList="arrayFoundNews"></SearchedNewsList>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pl-lg-1 p-0">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <i class="fad fa-newspaper"></i> DANH MỤC
                            </h6>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div  class=" p-2 bg-white col-12" id="cate-1" style="border-bottom: 1px solid #ddd;" v-for="(danhmuc, indexDanhMuc) in getDanhMucTinTuc" :key="indexDanhMuc">
                                        <div class="col-12">
                                            <div class="job-post-item-header d-flex align-items-center">
                                                <a :href="`/tin-tuc/${ChangeToSlug(danhmuc.name)}`">
                                                    <h2 class="text-black h6 NB_title" style="margin: 0 !important;"><i class="fa fa-arrow-right"></i> {{ danhmuc.name }}</h2>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card introduce">
                        <div class="card-header">
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fnetbee.vn%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1459241224260897" width="100%" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import SearchedNewsList from "~/components/News/SearchedNewsList";

export default {
    layout: 'news',
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
    components: {
        SearchedNewsList
    },
    data () {
        return{
            newsSearch: {
            Keyword: '',
            Title: '',
            Category: ''
            },
            countNews: 0,
            getDanhMucTinTuc: [
                { id: 1, name: 'Xuất khẩu lao động'},
                { id: 2, name: 'Du học'},
                { id: 3, name: 'Cẩm nang'},
            ],
            arrayFoundNews: []
        }
    },
    methods:{
        fetch(){
            this.$axios.$get('searchTinTuc?searchCategory='
            + ((this.newsSearch.Category.id) ? this.newsSearch.Category.id : '')
            // + '&searchStatus=1'
            + '&search='+ ((this.newsSearch.Keyword) ? this.ChangeToSlug(this.newsSearch.Keyword).replace(/\-/gi, '%20') : '')
            + '&searchTitle='+ ((this.newsSearch.Title) ? this.ChangeToSlug(this.newsSearch.Title).replace(/\-/gi, '%20') : '')
            ).then((response)=>{
                this.arrayFoundNews = response.data
                this.countNews = response.data.length
                // console.log(this.arrayFoundNews);
            })
        }
    },
    mounted(){
        this.fetch()
    }
}
</script>