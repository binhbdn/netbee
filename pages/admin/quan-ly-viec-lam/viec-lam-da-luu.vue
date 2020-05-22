<template>
  <div class="app-content content">
    <ListJobSaved />
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";
import ListJobSaved from "~/components/Custom/ListJobSaved";
import Vue from "vue";
import moment from "moment";
export default {
  layout: "admin",
  head: {
    title: "Danh sách việc làm đã lưu",
    script: [
      { src: "/app-assets/vendors/js/tables/datatable/pdfmake.min.js" },
      { src: "/app-assets/vendors/js/tables/datatable/vfs_fonts.js" }
    ]
  },
  components: {
    Multiselect,
    ListJobSaved
  },
  data() {
    return {
      jobs: [],
      selected: [],
      page: 1
    };
  },
};
</script>
<style scoped>
.pagination .page-item.active .page-link {
  background-color: #ffb701 !important;
}
.input_date input {
  /* max-height: 34px; */
  padding: 5px;
}
</style>