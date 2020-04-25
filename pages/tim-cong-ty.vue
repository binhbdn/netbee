<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h6>KẾT QUẢ TÌM KIẾM</h6>
                        </div>
                        <div class="card-body">
                            <CompanyList1 :DataList="arrayCompanyNew"></CompanyList1>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>CÔNG TY HÀNG ĐẦU</h6>
                        </div>
                        <div class="card-body">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height: 300px">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" v-for="(companyHot, indexCompanyHot) in arrayCompanyHot" :key="indexCompanyHot" :data-slide-to="indexCompanyHot" :class="{'active' : indexCompanyHot == 0}"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item text-center" :class="{'active' : indexCompanyHot == 0}" v-for="(companyHot, indexCompanyHot) in arrayCompanyHot" :key="indexCompanyHot">
                                        <img class="img-fluid" v-lazy="`/uploads/users/avatars/${companyHot.avatar}`" :alt="`${companyHot.avatar}`" style="object-fit: cover" />
                                        <div class="remove-border-rightt">
                                            <div class="item-name">
                                                <a :href="`/cong-ty/${companyHot.company_id}/${ChangeToSlug(companyHot.name)}`" class="item-company mb-0"> 
                                                    <h3> {{ companyHot.name }}</h3>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import CompanyList1 from "~/components/Company/CompanyList1";

export default {
    components: {
        CompanyList1
    },
    data () {
        return{
            arrayCompanyNew: []
        }
    },
    async asyncData({$axios, route}) {
        let getCompanyHot = await $axios.$get(`getCompanyHot`)
        return {
            arrayCompanyHot: getCompanyHot.data,
        }
    },
    methods:{
        fetch(){
            this.$axios.$get('searchCompany?keyword='+this.$route.query.keyword)
            .then(response => {
                this.arrayCompanyNew = response.data
            })
        }
    },
    mounted(){
        this.fetch()
    }
}
</script>
<style>
.carousel-indicators .active{
    background-color: #ffb701;
}

.carousel-indicators li{
    background-color: #d8cccc;
}
</style>

