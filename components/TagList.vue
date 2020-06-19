<template>
<div class="row ecommerce-application">
    <div class="col-md-12 list-view">
      <div class="card-content collapse show">
        <div class="card-body" style="text-align: center; padding: 10px">
          	<h5 style="margin:10px 0;"><i class="fa fa-key"></i> TỐP TỪ KHÓA</h5>
          	<a href="/tin-tuyen-sinh/tim-kiem?keyword=&type=1">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Xuất khẩu lao động
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?keyword=&type=2">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Du học sinh
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?keyword=&type=3">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Tu nghiệp sinh
	          </span>
	        </a>
	        <a v-for="(item, index) in DataList" :key="index" :href="`/tin-tuyen-sinh/tim-kiem?keyword=${item.tag_name}`" style="margin:0 3px;">
              <span class="badge border-netbee badge-sm" style="width: 100px">
                {{item.tag_name}}
              </span>
            </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?nation_id=1">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Nhật Bản
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?nation_id=2">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Hàn Quốc
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?nation_id=3">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Trung Quốc
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?nation_id=4">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Anh
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?nation_id=5">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Mỹ
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?nation_id=6">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Đức
	          </span>
	        </a>

	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=9">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Ngư nghiệp
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=8">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Công nghiệp vật liệu
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=7">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Hàng không
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=6">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Nông nghiệp
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=2">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Điện - điện tử
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=5">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Đóng tàu, hàng hải
	          </span>
	        </a>

	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=10">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Dịch vụ ăn uống
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=11">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Vệ sinh các tòa nhà
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=12">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Chế tạo máy
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=13">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Khách sạn
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=14">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Sửa chữa ô tô
	          </span>
	        </a>
	        <a href="/tin-tuyen-sinh/tim-kiem?id_visa=16">
	          <span class="badge border-netbee badge-sm" style="width: 100px">
	            Hộ lý
	          </span>
	        </a>
        </div>
      </div>
    </div>
</div>
</template>
<script>
export default {    
    props: ['DataList']
}
</script>
<style scoped>

</style>