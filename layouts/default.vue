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
<script data-ad-client="ca-pub-5263650588670533" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
import HeaderClient from "~/components/HeaderClient";
import Follow from "~/components/Follow";
import FooterClient from "~/components/FooterClient";
import GroupIcon from "~/components/GroupIcon";
export default {
  components: {
    // "Follow": () => ({
    //   component: new Promise(function (resolve, reject) {
    //       setTimeout(function () {
    //           resolve(
    //             Follow
    //           )
    //       }, 1000)
    //   }),
    //   delay: 1000,
    //   timeout: 1000
    // }),
    // "GroupIcon": () => ({
    //   component: new Promise(function (resolve, reject) {
    //       setTimeout(function () {
    //           resolve(
    //             GroupIcon
    //           )
    //       }, 1000)
    //   }),
    //   delay: 1000,
    //   timeout: 1000
    // }),
    // "HeaderClient": () => ({
    //   component: new Promise(function (resolve, reject) {
    //       setTimeout(function () {
    //           resolve(
    //             HeaderClient
    //           )
    //       }, 100)
    //   }),
    //   delay: 100,
    //   timeout: 100
    // }),
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

