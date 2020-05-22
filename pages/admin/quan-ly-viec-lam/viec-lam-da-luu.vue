<template>
  <div class="app-content content">
    <ListJobSaved />
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";
import ListJobSaved from "~/components/Custom/ListJobSaved";
import Vue from "vue";
import moment from "moment";
export default {
  layout: "admin",
  head: {
    title: "Danh sách việc làm đã lưu",
  },
  components: {
    Multiselect,
    ListJobSaved
  },
  data() {
    return {

    };
  },
};
</script>