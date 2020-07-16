<template>
    <div>
        <div class="content-wrapper">
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
                            <div class="">
                                <div class="card-body card-dashboard p-0">
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
    data () {
        return {
            cardSearch: {
                search: "",
                searchStatus: "",
                searchTitle: "",
                searchCategory: null
            },
            categories: [
                {id: 1, name: 'Xuất khẩu lao động'},
                {id: 2, name: 'Du học'},
                {id: 3, name: 'Tu nghiệp sinh'}
            ],
            status: [
                {id: 1, name: 'Đã kích hoạt'},
                {id: 0, name: 'Chưa kích hoạt'},
            ],
            tinTuyenDung: [],
            page: 1
        }
    },
    components:{
        Multiselect,
        JobsList3Col
    },

    methods:{
        async fetch(){
            let getTin = await this.$axios.$get('/tintuyendung/searchTinTuyenDung')
            this.tinTuyenDung = getTin.data
        },
        search(){
            this.$axios.$get(
            'tintuyendung/searchTinTuyenDung?searchCategory=' 
            + ((this.cardSearch.searchCategory != null && this.cardSearch.searchCategory.id != null)?this.cardSearch.searchCategory.id:'') 
            + ((this.cardSearch.searchStatus != null && this.cardSearch.searchStatus.id !=null)? '&searchStatus='+this.cardSearch.searchStatus.id:'') 
            + ((this.cardSearch.search)? '&search='+ this.cardSearch.search:'')
            + ((this.cardSearch.searchTitle)? '&searchTitle='+ this.cardSearch.searchTitle:'')
            ).then((response)=>{
                 this.tinTuyenDung=response.data;
                 this.page = 1;
	        });
        },
        nameWithLang ({ name, id }) {
            return `${name}`
        },
        infiniteScroll($state) {
            setTimeout(() => {
                this.page++
                this.$axios
                .get('/tintuyendung/searchTinTuyenDung?page='+ this.page
                + ((this.cardSearch.searchCategory != null && this.cardSearch.searchCategory.id != null)? '&searchCategory='+this.cardSearch.searchCategory.id:'') 
                + ((this.cardSearch.searchStatus != null && this.cardSearch.searchStatus.id !=null)? '&searchStatus='+this.cardSearch.searchStatus.id:'') 
                + ((this.cardSearch.search)? '&search='+ this.cardSearch.search:'')
                + ((this.cardSearch.searchTitle)? '&searchTitle='+ this.cardSearch.searchTitle:'')
                )
                .then((response) => {
                    if (response.data.data.length > 1) {
                        response.data.data.forEach((item) => this.tinTuyenDung.push(item))
                        $state.loaded()
                    } else {
                        $state.complete()
                    }
                })
                .catch((err) => {
                })
            }, 500)
        },
    },
    mounted () {
        this.fetch()
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
        },
    }
}
</script>

<style scoped>

</style>