<template>
    <div>
        <div class="content-wrapper">
            <!-- tìm kiếm -->
            <div class="card" id="card">
                <div class="card-header">
                    <h4 class="card-title">Tìm kiếm</h4>
                    <!-- <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a> -->
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="fa fa-chevron-down"></i></a></li>
                            <li><a  v-on:click="restData()"><i class=" fa fa-repeat users-data-filter"></i></a></li>
                            <li><a @click="closeSearch()" class="show-mb" style="font-size: 18px">x</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show pb-2">
                    <div class="card-body">
                        <div class="users-list-filter">
                            <form>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0 input_placehoder" v-model="cardSearch.search" id="filter-text-box" placeholder="Từ khóa...." />
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <fieldset class="form-group">
                                            <multiselect @input="search()" v-model="cardSearch.searchCategory" :options="categories" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn danh mục" style="font-size:14px"></multiselect>
                                        </fieldset>
                                    </div>
                                    <!-- <div class="col-12 col-sm-6 col-lg-4">
                                        <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.searchTitle" id="filter-text-box" placeholder="Nhập tiêu đề..." />
                                    </div> -->
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <fieldset class="form-group">
                                            <multiselect @input="search()" v-model="cardSearch.searchAddress" :options="address" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn địa điểm"  style="font-size:14px"></multiselect>
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
                                        <div class="row ecommerce-application">
                                            <div class="col-lg-12 col-12 list-view" v-for="(job, index) in jobs_saver" :key="index">
                                                <div class="ecommerce-card border-job-item make-it-sl" style="margin-bottom: 15px;border-radius: 3px;background: #fff" :class="job.highlight_job ? 'highlight' : ''">
                                                    <div class="card-content h-100">
                                                        <div class="text-center card-avatar">
                                                            <a :href="`/admin/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                                                                <img v-lazy="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" height="100%" :alt="`${job.user.avatar}`">
                                                            </a>
                                                            <p class="delivery-date mb-0 cate-bottom-avt" data-toggle="tooltip" data-placement="top" title="Loại hình tuyển dụng">
                                                                <span class="badge border-netbee badge-sm" style="width: 100px" :class="job.highlight_job ? 'bg-netbee' : ''">
                                                                    {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học' : 'Tu nghiệp sinh' }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="remove-border-right" style="padding: 0.5rem">
                                                            <div class="hot" v-if="job.highlight_job == 2"><img src="/assets/img/hot.png"></div>
                                                            <a class="item-vip-a" :href="`/admin/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                                                            <div class="item-quantity row" id="company" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 3">
                                                                <div class="col-lg-5 col-sm-5">
                                                                    <a :href="`/cong-ty/${job.user ? job.username : '#'}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.username }}</span></a>
                                                                </div>
                                                                <div class="col-lg-4 col-sm-3 mb-block">
                                                                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="left" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="item-quantity row" id="company" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 1">
                                                                <div class="col-lg-5 col-sm-5">
                                                                    <a :href="`/cong-ty/${job.user ? job.username : '#'}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.username }}</span></a>
                                                                </div>
                                                                <div class="col-lg-4 col-sm-3">
                                                                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="left" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-4 mb-block">
                                                                    <i class="m-0">Tiền thưởng</i>
                                                                </div>
                                                            </div>
                                                            <div class="item-quantity row" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 3">
                                                                <div class="col-lg-5 col-sm-5">
                                                                    <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-map-marker-alt"></i> {{ job.nation.name }}</p>
                                                                </div>
                                                                <div class="col-lg-4 col-sm-3 pr-0 mb-block" id="date-deline">
                                                                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-clock"></i> {{ ConvertDate(job.expiration_date) }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="item-quantity row" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 1">
                                                                <div class="col-lg-5 col-sm-5">
                                                                    <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-map-marker-alt"></i> {{ job.nation.name }}</p>
                                                                </div>
                                                                <div class="col-lg-4 col-sm-3 pr-0" id="date-deline">
                                                                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-clock"></i> {{ ConvertDate(job.expiration_date) }}</p>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-4 pr-0 mb-block">
                                                                    <p class="mb-0" style="color: #fc205c">{{ FormatPriceBonus(job.bonus - (job.bonus * settingBonus.percent_bonus /100)) }} {{ job.currency }} / <i class="fad fa-user-friends" title="1 người"></i> </p>
                                                                </div>
                                                            </div>
                                                            <div class=" row" id="price">
                                                                <div class="col-lg-5 col-sm-5 pr-0">
                                                                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Chi phí" ><i class="fad fa-dollar-sign"></i> Chi phí: <span class="item-price" :style="[job.highlight_job ? {'color': '#fc205c'} : '']"> {{ FormatPrice(job.subsidy) }} {{ job.currency }}</span></p>
                                                                </div>
                                                                <div class="col-lg-4 col-sm-3 mb-block">
                                                                    <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Loại hình tuyển dụng">
                                                                        <span class="badge border-netbee badge-sm" style="width: 100px" :class="job.highlight_job ? 'bg-netbee' : ''">
                                                                            {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học' : 'Tu nghiệp sinh' }}
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="bonus-block" v-if="job.bonus != 0 && job.bonus != null && $auth.user.role != 1">
                                                                <i class="m-0">Tiền thưởng</i>
                                                                <h3 class="bonus">
                                                                    <p class="mb-0" style="color: #fc205c">{{ FormatPriceBonus(job.bonus - (job.bonus * settingBonus.percent_bonus /100)) }} {{ job.currency }} / <i class="fad fa-user-friends" title="1 người"></i> </p>
                                                                </h3>
                                                            </div>
                                                            <button type="button" class="close" aria-label="Bỏ lưu" @click="deleteJobSaved(job.id)">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-center p-1 font-italic" v-if="jobs_saver.length == 0" style="color: red;">Không có dữ liệu nào.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <infinite-loading
                v-if="jobs_saver.length"
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

export default {
    data () {
        return {
            cardSearch: {
                search: "",
                searchCategory: null,
                searchAddress: null,
            },
            categories: [
                {id: 1, name: 'Xuất khẩu lao động'},
                {id: 2, name: 'Du học'},
                {id: 3, name: 'Tu nghiệp sinh'}
            ],
            address: [
                {id: 1, name: 'Nhật Bản'},
                {id: 2, name: 'Hàn Quốc'},
                {id: 3, name: 'Trung Quốc'},
                {id: 4, name: 'Anh'},
                {id: 5, name: 'Mỹ'},
                {id: 6, name: 'Đức'},
                {id: 7, name: 'Canada'},
                {id: 8, name: 'Úc'},
            ],
            jobs_saver: [],
            jobs: [],
            page: 1,
            settingBonus: [],
        }
    },
    components:{
        Multiselect,
    },
    mounted () {
        this.fetch()
    },
    created(){
        this.getJob();
        this.$bus.$on('showSearch', () => {
            document.getElementById('card').style.display = 'block';
        })
        this.$axios
                .$get('/tintuyendung/getSettingBonus')
                .then((response) => {
                    this.settingBonus = response
                })
                .catch((err) => {
                })
    },
    methods:{
        restData: function() {
            this.cardSearch.search = ""
            this.cardSearch.searchCategory = null
            this.cardSearch.searchAddress = null
            this.fetch()
        },
        async fetch(){
            let getTin = await this.$axios.$get('/tintuyendung/searchTinTuyenDung')
            this.tinTuyenDung = getTin.data
        },
        getJob(){
            this.$axios.get("/quanlyvieclam/getSaveBySaver")
            .then(response => {
                this.jobs_saver = response.data.data;
            })
        },
        search(){
            this.$axios.$get(
            '/quanlyvieclam/getSaveBySaver?searchCategory=' 
            + ((this.cardSearch.searchCategory != null && this.cardSearch.searchCategory.id != null)?this.cardSearch.searchCategory.id:'')  
            + ((this.cardSearch.search)? '&search='+ this.cardSearch.search:'')
            + '&searchAddress='+ ((this.cardSearch.searchAddress != null && this.cardSearch.searchAddress.id != null)?this.cardSearch.searchAddress.id:'')
            ).then((response)=>{
                 this.jobs_saver=response.data;
                 this.page = 1;
	        });
        },
        deleteJobSaved(id) {
            this.$swal({
              title: 'Bỏ lưu',
              text: "Bạn chắc chắn muốn bỏ lưu việc làm này!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Đồng ý',
              cancelButtonText: 'Đóng'
            }).then((result) => {
                if (result.value) {
                    this.$axios.post('/quanlyvieclam/deleteJobSave?id=' + id).then((response)=>{
                        if(response.data.status == 200) {
                            this.$swal(
                            'Thành công!',
                                response.data.message,
                            'success'
                            );
                            this.getJob();
                        }else {
                            this.$swal(
                            'Lỗi!',
                                response.data.message,
                            'error'
                            );
                            this.getJob();
                        }
                    }).catch((e) => {
                        this.$swal(
                            Lỗi
                        );
                        this.getJob();
                    });
                }
            })
            
        },
        nameWithLang ({ name, id }) {
            return `${name}`
        },
        infiniteScroll($state) {
            setTimeout(() => {
                this.page++;
                this.$axios.get("/quanlyvieclam/getSaveBySaver")
                .then(response => {
                    //console.log(response);
                    if (response.data.length > 1) {
                    response.data.forEach(item => this.jobs.push(item));
                    $state.loaded();
                    } else {
                    $state.complete();
                    }
                })
                .catch(err => {
                    console.log(err);
                });
            }, 500);
        },
        closeSearch(){
            document.getElementById('card').style.display = 'none';
        },
    },
}
</script>

<style scoped>
@media (max-width: 575px){
    #filter-text-box{
        margin-bottom: 20px;
    }
    .content-wrapper{
        padding: 0 0 15px 0!important;
    }
}
.list-inline{
    display: block;
}
.show-mb{
    display: none;
}
@media (max-width: 767px){
    .card{
        display: none;
    }
    .show-mb{
        display: block;
    }
}
.showSearch{
    position: fixed;
    top: 10px;
    right: 100px;
}
.collapse:not(.show) {
    display: none !important;
}
.fa, .fas {
    font-family: 'Font Awesome 5 Pro';
    font-weight: 900;
}
.item-vip-a{
    font-size: 13px;
}
p {
    font-size: 13px;
}
/* .item-vip-a:hover{
    color: #000 !important;
} */
.highlight{
    border-left: 2px solid #ffb701 !important;
}

/* .border-job-item:hover{
    background-color: #ffb7012b;
} */

/* .ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid;
    grid-template-columns: 0.3fr 4fr 2fr;
} */
.card-content{
    display: flex !important;
}

.hot-mb{
    color: #fff;
    text-transform: uppercase;
    z-index: 2;
    font-size: 9px;
    border-radius: 2px;
    right: 10px;
    font-weight: 700;
}
.hot img {
    width: 2%;
    min-width: 35px;
    float: right;
    position: absolute;
    right: 0;
    top: 0;
}
.p-r-0{
    right: 0;
}
.card-avatar {
    margin: auto;
}
.card-avatar img{
    height: 60px;
    width: 60px;
    object-fit: scale-down;
}
.item-price .title {
    font-size: 14px;
}
.bonus-block{
    display: none;
}
.remove-border-right{
    width: 90%;
    position: relative;
}
.input_placehoder::placeholder{
  font-size: 14px;
  color: #adadad !important;
}

@media(max-width: 1199px){
    /* .remove-border-right{
        width: auto!important;
    } */
    .item-options{
        padding: 1rem 0;
    }
    .bonus{
        font-size: 1rem;
    }
}
/* @media(max-width: 991px) and (min-width: 768px){
    .remove-border-right{
        max-width: 330px !important;
    }
} */

/* @media(max-width: 767px) and (min-width: 576px){
    #company{
        height: 42px !important;
        position: relative;
    }
    .item-options{
        display: none;
    }
    .card-content{
        grid-template-columns: 1fr 4fr 0 !important;
    }
    .remove-border-right{
        width: auto !important;
        max-width: 500px !important;
    }
    .bonus-block{
        display: block;
        position: absolute;
        top: 58px;
        left: 420px;
    }
    .hot-mb{
        display: block;
    }
    .hot-mb img{
        right: 15px;
    }
} */

.cate-bottom-avt {
    display: none;
}
@media (max-width: 600px){
    .mb-block {
        display: block !important;
    }
    .bonus-block{
        display: none;
    }
}
@media only screen and (max-width: 575px) {
    .remove-border-right{
        overflow: hidden;
    }
    .bonus-block{
        display: block !important;
    }
    .mb-block{
        display: none !important;
    }
    #company {
        height: 42px !important;
        display: none;
    }
    .ecommerce-card {
        margin-bottom: 0 !important;
        border-radius: 0 !important;
    }
    .border-job-item {
        border: none;
        border-bottom: 1px solid #ececec !important;
    }
    .cate-bottom-avt {
        display: block;
    }
    #price div:last-child {
        display: none;
    }
    .card-avatar {
        padding-left: 20px;
    }
    .item-vip-a {
        width: 95%;
        overflow: hidden;
        white-space: unset;
    }
    p {
        font-size: 13px;
    }
    #date-deline {
        display: none;
    }
    /* .hot img{
        right: 14px;
    } */
}
</style>