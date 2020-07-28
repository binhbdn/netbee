<template>
  <div>
    <HeaderClient />
    <div class style="width: 100%;">
      <Banner />
      <nuxt />
    </div>
    <Follow />
    <FooterClient />
    <GroupIcon />
  </div>
</template>
<script>
import HeaderClient from "../components/HeaderClient";
import Follow from "../components/Follow";
import FooterClient from "../components/FooterClient";
import GroupIcon from "../components/GroupIcon";
export default {
  components: {
    HeaderClient,
    Follow,
    FooterClient,
    GroupIcon
  },
  mounted() {
    this.$i18n.locale = window.localStorage.getItem('lang');
  }
};
</script>
