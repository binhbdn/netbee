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
                                <h4><i class="fas fa-newspaper"></i> Tin mới</h4>
                                <a data-action="collapse"><i class="feather icon-chevron-down"></i></a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <NewListPage1 :DataList="arrayNew"></NewListPage1>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fas fa-newspaper"></i> Tin tức</h4>
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
                                        <div  class=" p-2 bg-white col-12" id="cate-1" style="border-bottom: 1px solid #ddd;">
                                            <div class="col-12">
                                                <div class="job-post-item-header d-flex align-items-center">
                                                    <a href="#">
                                                        <h2 class="mr-3 text-black h6 NB_title" ><i class="fa fa-arrow-right"></i>Tuyển lập trình viên PHP</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div  class=" p-2 bg-white col-12" id="cate-1" style="border-bottom: 1px solid #ddd;">
                                            <div class="col-12">
                                                <div class="job-post-item-header d-flex align-items-center">
                                                    <a href="#">
                                                        <h2 class="mr-3 text-black h6 NB_title" ><i class="fa fa-arrow-right"></i>Tuyển lập trình viên PHP</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div  class=" p-2 bg-white col-12" id="cate-1" style="border-bottom: 1px solid #ddd;">
                                            <div class="col-12">
                                                <div class="job-post-item-header d-flex align-items-center">
                                                    <a href="#">
                                                        <h2 class="mr-3 text-black h6 NB_title" ><i class="fa fa-arrow-right"></i>Tuyển lập trình viên PHP</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div  class=" p-2 bg-white col-12" id="cate-1" style="border-bottom: 1px solid #ddd;">
                                            <div class="col-12">
                                                <div class="job-post-item-header d-flex align-items-center">
                                                    <a href="#">
                                                        <h2 class="mr-3 text-black h6 NB_title" ><i class="fa fa-arrow-right"></i>Tuyển lập trình viên PHP</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div  class=" p-2 bg-white col-12" id="cate-1" style="border-bottom: 1px solid #ddd;">
                                            <div class="col-12">
                                                <div class="job-post-item-header d-flex align-items-center">
                                                    <a href="#">
                                                        <h2 class="mr-3 text-black h6 NB_title" ><i class="fa fa-arrow-right"></i>Tuyển lập trình viên PHP</h2>
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
import NewListPage1 from '../../components/News/NewListPage1';
import JobsList1ColNotCate from '~/components/Jobs/JobsList1ColNotCate';
import NewItempage2 from '../../components/NewItempage2';

export default {
    components:{
        NewListPage1,
        JobsList1ColNotCate,
        NewItempage2
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
    }  
}
</script>
<style>

</style>