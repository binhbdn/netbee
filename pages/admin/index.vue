<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper" v-if="$auth.user.role == 2 || $auth.user.role == 4">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-users text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">92.6k</h2>
                                    <p class="mb-0">Subscribers Gained</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-success p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-credit-card text-success font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">97.5k</h2>
                                    <p class="mb-0">Revenue Generated</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">36%</h2>
                                    <p class="mb-0">Quarterly Sales</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-package text-warning font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">97.5K</h2>
                                    <p class="mb-0">Orders Received</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->
            </div>
        </div>
        <div class="content-wrapper" v-else>
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Trang chủ</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tìm kiếm -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tìm kiếm</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                            <li><a data-action=""><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show pb-2">
                    <div class="card-body">
                        <div class="users-list-filter">
                            <form>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.search" id="filter-text-box" placeholder="Tìm kiếm...." />
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.searchTitle" id="filter-text-box" placeholder="Tên tiêu đề..." />
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <fieldset class="form-group">
                                            <multiselect @input="search()" v-model="cardSearch.searchCategory" :options="categories" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn danh mục" style="font-size:14px"></multiselect>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <fieldset class="form-group">
                                            <multiselect @input="search()" v-model="cardSearch.searchStatus" :options="status" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn trạng thái"  style="font-size:14px"></multiselect>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-body ">
                <section id="News"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body card-dashboard mt-2">
                                    <div class="table-responsive list-data">
                                        <JobsList3Col :DataList="tinTuyenDung"></JobsList3Col>
                                        <p class="mb-0 text-center p-1 font-italic" v-if="tinTuyenDung.length == 0">Không có dữ liệu nào.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <infinite-loading
                v-if="tinTuyenDung.length"
                spinner="bubbles"
                @infinite="infiniteScroll" style="padding:20px; width:100%"
            >
            <div slot="no-more" style="font-size:15px; font-style: italic">Hết tin</div>
            <div slot="no-results" style="font-size:15px; font-style: italic">Không còn kết quả.</div>
        </infinite-loading>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import JobsList3Col from '~/components/Jobs/JobsList3Col'


export default {
    name: 'Dashboard',
        layout: 'admin',
    head: {
        title: 'Home page 🚀',
        meta: [
        { hid: 'description', name: 'description', content: 'Home page description' }
        ],
        noscript: [
        { innerHTML: 'Body No Scripts', body: true }
        ],
        script: [
        { src: '/head.js' },
        // Supported since 1.0
        { src: '/body.js', body: true },
        { src: '/defer.js', defer: '' }
        ]
    },
    data () {
        return {
            cardSearch: {
                search: "",
                searchStatus: "",
                searchTitle: "",
                searchCategory: ""
            },
            categories: [
                {id: 1, name: 'Xuất khẩu lao động'},
                {id: 2, name: 'Du học sinh'},
                {id: 3, name: 'Tu nghiệp sinh'}
            ],
            status: [
                {id: 1, name: 'Đã kích hoạt'},
                {id: 0, name: 'Chưa kích hoạt'},
            ],
            selected: [],
            page: 1
        }
    },

    components:{
        Multiselect,
        JobsList3Col
    },

    async asyncData({$axios, route, page}) {
        let getTin = await $axios.$get('/tintuyendung/getTinTuyenDung')
        return {
            tinTuyenDung: getTin.data.data
        }
    },

    methods:{
        search(){
            this.$axios.$get(
            'tintuyendung/searchTinTuyenDung?searchCategory=' 
            + ((this.cardSearch.searchCategory.id)?this.cardSearch.searchCategory.id:'') 
            + '&searchStatus='+ ((this.cardSearch.searchStatus.id !=null)?this.cardSearch.searchStatus.id:'') 
            + '&search='+ ((this.cardSearch.search)?this.cardSearch.search:'')
            + '&searchTitle='+ ((this.cardSearch.searchTitle)?this.cardSearch.searchTitle:'')
            ).then((response)=>{
	             this.tinTuyenDung=response.data;
	        });
        },
        nameWithLang ({ name, id }) {
            return `${name}`
        },
        infiniteScroll($state) {
            setTimeout(() => {
                this.page++
                this.$axios
                .get('/tintuyendung/getTinTuyenDung?page='+ this.page)
                .then((response) => {
                    console.log(response.data.data.data.length)
                    if (response.data.data.data.length > 1) {
                        response.data.data.data.forEach((item) => this.tinTuyenDung.push(item))
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
    mounted () {
    
    },

    computed: {
        selectAll: {
            get() {
                if(this.tinTuyenDung && this.tinTuyenDung.length > 0) {
                    //A new array exists with at least with one item
                    let allChecked = true;

                    this.tinTuyenDung.forEach((item)=>{
                        if(!this.selected.includes(item.id)) {
                            allChecked = false; 
                            //  If even one is not included in array
                        }

                        //Breack out of loop if mismatch already found
                        if(!allChecked) return;
                    });
                    return allChecked;
                }
                return false
            },
            set(value) {
                const checked = [];
                if(value) {
                    this.tinTuyenDung.forEach((item) => {
                        checked.push(item.id);
                    });
                }
                this.selected = checked;
            }
        },
    }
  
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
</style>
