<template>
    <div>
        <section class="bg-white category p-1 m-b-15">
            <div class="container">
                <div class="row d-flex bg-white ">
                    <div class="col-md-6 pd-20">
                        <a href="#"><i class="fa fa-home pr-2"></i>Trang chủ</a>
                        <a href="#"><i class="fa fa-caret-right pr-2 pl-2"></i>Tin tức</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white" style="background-color: #f6f6f6!important;">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h2>{{ tintuc.title }}</h2>
                                <span><i class="fa fa-calendar mr-1"></i>{{ tintuc.created_at }}</span>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <img v-lazy="`/uploads/news/${tintuc.thuml}`" width="100%" class="m-b-15" :alt="`${tintuc.thuml}`">
                                    <p v-html="tintuc.content"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
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
                                        <div class="col-12 make-it-slow pt-1" v-for="(item, index) in tintucs" :key="index">
                                            <NewItempage2 :id="item.id" :title="item.title" :content="item.content" :created_at="item.created_at" :short_content="item.short_content" :thuml="item.thuml" :type="2"></NewItempage2>
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
                                    <JobsList1ColNotCate :DataList="arrayJobNew"></JobsList1ColNotCate>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mb-2">
                    <div class="card" style="width:100%; margin: 0 14px">
                        <div class="card-header">
                                <h4 class="card-title"><i class="fa fa-briefcase" style="padding-right:4px;"></i>Bình luận</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content collapse show">
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" v-lazy="`https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=500768507540632&autoLogAppEvents=1`"></script>
                                <div class="card-body scrollbar" style="height:300px;">
                                    <div class="fb-comments" style="height:200px; width:100%" data-width="1076" data-href="https://www.facebook.com/NetBeevn-107178937322342" data-numposts="10"></div>
                                </div>
                            </div>
                    </div>
                </div> -->
            </div>
        </section>
    </div>
</template>
<script async defer crossorigin="anonymous" v-lazy="`https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=500768507540632&autoLogAppEvents=1`">
</script>
<script>
import NewListPage1 from '~/components/News/NewListPage1';
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';
import NewItempage2 from '~/components/NewItempage2';
import NewsList from '~/components/News/NewsList'

export default {
    components:{
        NewListPage1,
        JobsList1ColNotCate,
        NewItempage2, 
        NewsList
    },
    async asyncData({$axios, route}) {
        let detailRes = await $axios.$get(`getDetailTinTuc/${route.params.id}`)
        let tinRes = await $axios.$get('getTinTucNew?limit=5')
        let getTinTuyenDungNew = await $axios.$get(`getTinTuyenDungNew?limit=10&type=0`)
        return {
            tintuc: detailRes.data,
            tintucs: tinRes.data.tintuc,
            arrayJobNew: getTinTuyenDungNew.data.tintuyendung
        }
    },
    head() {
        return {
            title: this.tintuc.title,
            meta: [
                { hid: 'description', name: 'description', content: this.tintuc.short_content },
                { hid: 'keywords', name: 'keywords', content: this.tintuc.title.replace(/ /g, ",")},
                { hid: 'og:url', name: 'og:url', content: 'https://netbee.vn'+this.$route.path},
                { hid: 'og:title', name: 'og:title', content: this.tintuc.title},
                { hid: 'og:description', name: 'og:description', content: this.tintuc.short_content},
                { hid: 'og:image', name: 'og:image', content: this.tintuc.thuml},
            ]
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
    width: 100%;
}
</style>