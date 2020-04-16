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
                                    <img v-lazy="`https://netbee.vn/storage/news/banner/2020-04-09 18:06:301299608613Nhật Bản (1).png`" width="100%">
                                    <p v-html="tintuc.content"></p>
                                    <div class="mb-2">
                                        <span>Từ khóa:</span>
                                        <a href="#" class="tagnews">Nhật Bản</a>
                                        <a href="#" class="tagnews">Tin tức Nhật Bản</a>
                                    </div>
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
                                <div class="card-body scrollbar">
                                    <div class="row">
                                        <div class="col-12 make-it-slow pt-1" v-for="(item, index) in arrayNew" :key="index">
                                            <NewItempage2 :id="2" :title="item.title" :content="item.content" :time="item.time" :type="2"></NewItempage2>
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
                            <hr>
                            <div class="card-content collapse show">
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" v-lazy="`https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=500768507540632&autoLogAppEvents=1`"></script>
                                <div class="card-body scrollbar" style="height:300px;">
                                    <div class="fb-comments" style="height:200px; width:100%" data-width="1076" data-href="https://www.facebook.com/NetBeevn-107178937322342" data-numposts="10"></div>
                                </div>
                            </div>
                    </div>
                </div>
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
    data() {
        return {
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
    asyncData({$axios, route}) {
        return $axios.$get(`getDetailTinTuc/${route.params.id}`).then((res) => {
            return {tintuc: res.data}
        })
    },
    head() {
        return {
            title: this.tintuc.title,
            meta: [
                { hid: 'description', name: 'description', content: this.tintuc.short_content },
                { hid: 'keywords', name: 'keywords', content: title.replace(/ /g, ",")},
                { hid: 'og:url', name: 'og:url', content: 'https://netbee.vn'+route.path},
                { hid: 'og:title', name: 'og:title', content: this.tintuc.title},
                { hid: 'og:description', name: 'og:description', content: this.tintuc.short_content},
                { hid: 'og:image', name: 'og:image', content: this.tintuc.thuml},
            ]
        }

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