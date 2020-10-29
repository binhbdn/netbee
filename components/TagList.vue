<template>
<div class="row ecommerce-application">
    <div class="col-md-12 list-view">
      <div class="card-content collapse show">
        <div class="card-body" style="text-align: center; padding: 10px">
          	<h5 style="margin:10px 0;"><i class="fa fa-key"></i> TOP TỪ KHÓA</h5>
			<a href="/tin-tuyen-sinh/xuat-khau-lao-dong?keyword=&type=1" style="margin:0 2px;">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Xuất khẩu lao động
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/du-hoc?keyword=&type=2">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Du học
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tu-nghiep-sinh?keyword=&type=3" style="margin:0 2px;">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Tu nghiệp sinh
	          </span>
	        </a>
	        <a v-for="(item, key) in DataList" :key="key" :href="`/tin-tuyen-sinh/${ChangeToSlug(item.tag_name)}?keyword=${ChangeToSlug(item.tag_name).replace(/\-/gi, '%20')}`" style="margin:0 3px;">
              <span class="badge border-netbee badge-sm" style="width: 100px">
                {{item.tag_name}}
              </span>
            </a>
	        <a v-for="(item, key) in listNation" :key="key" :href="`/tin-tuyen-sinh/${ChangeToSlug(item.name)}?nation_id=${item.id}`" style="margin:0 3px;">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            {{item.name}}
	          </span>
	        </a>
	        <!-- <a v-for="(item, key) in listVisa" :key="key" :href="`/tin-tuyen-sinh/tim-kiem?id_visa=${item.id}`" style="margin:0 3px;">
	          <span class="badge border-netbee badge-sm text-ove" style="width: 100px">
	            {{item.profession}}
	          </span>
	        </a> -->
        </div>
      </div>
    </div>
</div>
</template>
<script>
export default {  
	name: 'topTuKhoa',  
	props: ['DataList'],
	data(){
		return {
			listNation:[],
			listVisa:[]
		}
	},        
	components:{

	},
	methods: {
		fetchdataNa :function() {
			try {
				this.$axios.get('getTopNation')
				.then(response => {                                                          
					this.listNation = response.data.data
				})
				.catch(error => {
					console.log(error.response)
				});
			}
			catch (error) {
				this.$swal(
					'Lỗi!',
					'Lỗi dữ liệu!',
					'error'
				)
			}
		},
		fetchdataVi :function() {
			try {
				this.$axios.get('getTopVisa')
				.then(response => {                                                          
					this.listVisa = response.data.data
				})
				.catch(error => {
					console.log(error.response)
				});
			}
			catch (error) {
				this.$swal(
					'Lỗi!',
					'Lỗi dữ liệu!',
					'error'
				)
			}
		},
	},
	mounted() {             
		this.fetchdataNa()
		this.fetchdataVi()
	}
}
</script>
<style scoped>
	.text-ove{
		width: 40px; 
		overflow: hidden;
		text-overflow: ellipsis; 
	}
</style>
