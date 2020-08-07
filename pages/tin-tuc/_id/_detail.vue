<template>
    <div>
        <section class="bg-white" style="background-color: #f6f6f6!important;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 content-left">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="font-weight-600">{{ tintuc.title }}</h2><br>
                                <span>
                                    <i class="fad fa-user-tag m-r-5"></i>{{ tintuc.user.name }}
                                    <i class="fa fa-calendar mr-1"></i>{{ ConvertDate(tintuc.updated_at) }}
                                </span>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <img v-lazy="`/uploads/news/${tintuc.thuml}`" width="100%" class="m-b-15" :alt="`${tintuc.thuml}`">
                                    <p style="text-align:justify" v-html="tintuc.content"></p>
                                    <iframe v-lazy="`https://www.facebook.com/plugins/share_button.php?href=https://netbee.vn${this.$route.path}&layout=button&size=small&appId=1459241224260897&width=76&height=20`" width="76" height="30" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-0">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Bài đọc mới nhất </h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 make-it-slow" v-for="(item, index) in tintucs" :key="index">
                                            <NewItempage2 :id="item.id" :title="item.title" :thuml="item.thuml" :type="2"></NewItempage2>
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
                                <div class="card-body scrollbar">
                                    <JobsList1ColNotCate :DataList="arrayJobNew"></JobsList1ColNotCate>
                                </div>
                            </div>
                        </div> -->
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
                <div class="row mb-2">
                    <div class="card" style="width:100%; margin: 0 14px">
                        <div class="card-header">
                                <h4 class="card-title"><i class="fa fa-briefcase" style="padding-right:4px;"></i>Bình luận</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div id="fb-root"></div>
                                <div class="fb-comments" data-numposts="5" data-colorscheme="light" data-width="280px"></div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v8.0&appId=1459241224260897&autoLogAppEvents=1" nonce="ZKQOY7f8"></script>
<script>
import NewListPage1 from '~/components/News/NewListPage1';
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';
import NewItempage2 from '~/components/NewItempage2nodate';
import NewsList from '~/components/News/NewsList'

export default {
    components:{
        NewListPage1,
        JobsList1ColNotCate,
        NewItempage2,
        NewsList
    },
    data () {
        return {
            tintuc: {},
            tintucs: [],
            arrayJobNew: []
        }
    },
    async asyncData (context) {
        let detailRes = await context.app.$axios.$get(`getDetailTinTuc/${context.app.router.currentRoute.params.id}`)
        context.seo({
                name: detailRes.data.title,
                title: detailRes.data.title,
                keywords: detailRes.data.title.replace(/ /g, ","),
                description: detailRes.data.short_content,
                openGraph: {
                    title: detailRes.data.title,
                    url: `https://netbee.vn${context.app.router.currentRoute.path}`,
                    description: detailRes.data.short_content,
                    image: `https://netbee.vn/uploads/news/${detailRes.data.thuml}`
				}
            })
        return { tintuc: detailRes.data }
    },
    mounted() {
        this.$axios.$get(`getTinTucNew?limit=5`).then((res) => {
            this.tintucs = res.data.tintuc
        })
        this.$axios.$get(`getTinTuyenDungNew?limit=10&type=0`).then((res) => {
            this.arrayJobNew = res.data.tintuyendung;
        })
        if (window.FB) {
            window.FB.init({
                appId      : '1459241224260897',
                status     : true,
                xfbml      : true,
                version    : 'v3.3'
            })
        }
    },
    jsonld() {
        return {
            "@context": "http://schema.org/",
            "@type":"EmployerAggregateRating",
            "itemReviewed":{
                "@type":"Organization",
                "name": this.tintuc.title,
                "sameAs": 'https://netbee.vn'+this.$route.path
                },
            "ratingValue": "4",
            "bestRating": "5",
            "worstRating": "3",
            "ratingCount": "5"
        };
    },
}
</script>
<style>
.tagnews {
    background: rgba(196, 196, 196, 0.5);
    padding: 5px;
    border-radius: 4px;
    margin-right: 10px;
    font-size: 12px;
    color: #000;
}
.scrollbar {
    overflow: scroll;
    height: 500px;
    overflow-x: hidden;
}
p img{
    width: 100% !important;
    object-fit: scale-down;
}
@media (max-width: 1199px){
    .introduce{
        display: none;
    }
}
@media (max-width: 991px){
    .content-left{
        padding: 0;
    }
}
@media (max-width: 575px){
    h2{
        font-size: 1.25rem;
    }
}
</style>
