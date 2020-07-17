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
                            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                            <li><a data-action=""><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
                            <li><a @click="closeSearch()"><i class="feather icon-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show pb-2">
                    <div class="card-body">
                        <div class="users-list-filter">
                            <form>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <input type="text" @keyup="search()" class="ag-grid-filter form-control mr-1 mb-sm-0" v-model="cardSearch.search" id="filter-text-box" placeholder="Tìm kiếm...." />
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <fieldset class="form-group">
                                            <multiselect @input="search()" v-model="cardSearch.searchCategory" :options="categories" :custom-label="nameWithLang" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Chọn danh mục" style="font-size:14px"></multiselect>
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
                                                <div class="ecommerce-card border-job-item make-it-sl" style="height:140px;margin-bottom: 15px;" :class="job.highlight_job ? 'highlight' : ''">
                                                    <div class="card-content h-100">
                                                        <div class="text-center p-1">
                                                            <a :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`">
                                                                <img v-lazy="job.user.avatar != null && job.user.avatar.startsWith('https') ? job.user.avatar : `/uploads/users/avatars/${job.user.avatar}`" height="100%" :alt="`${job.user.avatar}`" style="object-fit: scale-down; max-height: 85px; max-width: 100%;">
                                                            </a>
                                                        </div>
                                                        <div class="remove-border-right" style="width: 550px;">
                                                            <div class="remove-border-right" style="padding: 5px 0px;width: 550px;">
                                                                
                                                                <a class="item-vip-a" :href="`/tin-tuyen-sinh/${job.id}/${ChangeToSlug(job.title)}`" data-toggle="tooltip" data-placement="top" :title="`${job.title}`">[{{job.id}}] {{ job.title }}</a>
                                                            </div>
                                                            <div class="item-name">
                                                                <a :href="`/cong-ty/${job.user ? job.user.name : job.id_created}`" class="item-company mb-0"><i class="fad fa-building"></i> <span class="company-name" data-toggle="tooltip" data-placement="top" :title="`${job.user.name}`"> {{ job.user.name }}</span></a>
                                                            </div>
                                                            <div class="item-quantity d-flex justify-content-between">
                                                                <p class="quantity-title mb-0" data-toggle="tooltip" data-placement="top" title="địa điểm làm việc"><i class="fad fa-location-arrow"></i> {{ job.nation.name }}</p>
                                                                <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="hạn nộp hồ sơ"><i class="fad fa-calendar-star"></i> {{ ConvertDate(job.expiration_date) }}</p>
                                                            </div>
                                                            <div class="item-quantity d-flex justify-content-between">
                                                                <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Chi phí" :style="[job.highlight_job ? {'color': '#fc205c'} : '']"><label class="title">Chi phí: </label> {{ FormatPrice(job.subsidy) }} {{ job.currency }}</p>
                                                                <p class="delivery-date mb-0" data-toggle="tooltip" data-placement="top" title="Số lượng tuyển">
                                                                    <span class="badge border-netbee badge-sm" style="width: 100px">
                                                                        {{ job.type == 1 ? 'Xuất khẩu lao động' : job.type == 2 ? 'Du học' : 'Tu nghiệp sinh' }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            <div class="item-quantity ">
                                                                <p class="delivery-date" data-toggle="tooltip" data-placement="left" title="Số lượng tuyển" ><i class="fad fa-user-friends"></i> {{job.quantity}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="item-options text-center" >
                                                            <div class="item-wrapper mt-1">
                                                                <span class="item-hot" v-if="job.highlight_job == 2"><i class="fas fa-star" style="color: gold; "></i> Hot</span>
                                                                <div class="item-cost mt-1" v-if="job.bonus != 0 && job.bonus != null">
                                                                    <i class="m-0">TIỀN THƯỞNG</i>
                                                                    <h3>
                                                                        <span style="color: #fc205c">{{FormatPrice(job.bonus)}}{{ job.currency }} / <i class="fad fa-user-friends" title="1 người"></i> </span>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="close-area d-flex align-items-start justify-content-center">
                                                            <button type="button" class="close p-1" aria-label="Bỏ lưu" @click="deleteJobSaved(job.id)">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-center p-1 font-italic" v-if="jobs_saver.length == 0">Không có dữ liệu nào.</p>
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
                searchCategory: null
            },
            categories: [
                {id: 1, name: 'Xuất khẩu lao động'},
                {id: 2, name: 'Du học'},
                {id: 3, name: 'Tu nghiệp sinh'}
            ],
            jobs_saver: [],
            jobs: [],
            page: 1,
        }
    },
    components:{
        Multiselect,
    },
    created(){
        this.getJob();
        this.$bus.$on('showSearch', () => {
            document.getElementById('card').style.display = 'block';
        })
    },
    methods:{
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
            ).then((response)=>{
                 this.jobs_saver=response.data;
                 this.page = 1;
	        });
        },
        deleteJobSaved(id) {
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
.item-vip-a{
    font-weight: 600;
    font-size: 20px;
}
/* .item-vip-a:hover{
    color: #000 !important;
} */
.highlight{
    border-left: 2px solid #ffb701 !important;
}

.border-job-item:hover{
    /* background-color: #ffb7012b; */
}

.ecommerce-application .list-view .ecommerce-card .card-content {
    display: grid;
    grid-template-columns: 1fr 4fr 2fr 0.1fr;
}
.item-price .title {
    font-size: 14px;
}
.showSearch{
    position: fixed;
    top: 10px;
    right: 100px;
}
.list-inline{
    display: block;
}
@media (max-width: 767px){
    .card{
        display: none;
    }
}
@media (max-width: 575px){
    #filter-text-box{
        margin-bottom: 20px;
    }
    .content-wrapper{
        padding: 0 0 15px 0!important;
    }
}
</style>