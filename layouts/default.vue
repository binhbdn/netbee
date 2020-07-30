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
import HeaderClient from "~/components/HeaderClient";
import Follow from "~/components/Follow";
import FooterClient from "~/components/FooterClient";
import GroupIcon from "~/components/GroupIcon";
export default {
  components: {
    "Follow": () => ({
      component: new Promise(function (resolve, reject) {
          setTimeout(function () {
              resolve(
                Follow
              )
          }, 1000)
      }),
      delay: 1000,
      timeout: 1000
    }),
    "GroupIcon": () => ({
      component: new Promise(function (resolve, reject) {
          setTimeout(function () {
              resolve(
                GroupIcon
              )
          }, 1000)
      }),
      delay: 1000,
      timeout: 1000
    }),
    "HeaderClient": () => ({
      component: new Promise(function (resolve, reject) {
          setTimeout(function () {
              resolve(
                HeaderClient
              )
          }, 1000)
      }),
      delay: 1000,
      timeout: 1000
    }),
    //HeaderClient,
    //Follow,
    FooterClient,
    //GroupIcon
  },
  mounted() {
    this.$i18n.locale = window.localStorage.getItem('lang');
  }
};
</script>
