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
  head: {
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/assets/img/logo.png' },
            { rel: 'stylesheet', href: '/app-assets/css/bootstrap.css', defer: true },
            { rel: 'stylesheet', href: '/app-assets/css/bootstrap-extended.css', defer: true },
            { rel: 'stylesheet', href: '/app-assets/css/components.css', defer: true },
            { rel: 'stylesheet', href: '/assets/css/style.css', defer: true },
            { rel: 'stylesheet', href: '/assets/css/custom-client.css', defer: true },
            { rel: 'stylesheet', href: '/assets/css/bootstrap-custom.css', defer: true },
            { rel: 'stylesheet', href: '/assets/css/header.css', defer: true },
            { rel: 'stylesheet', href: '/assets/fontawesome-pro/css/all.css', defer: true },
            { rel: 'stylesheet', href: '/app-assets/fonts/font-awesome/css/font-awesome.min.css', defer: true },

        ],
        script: [
            { hid: 'stripe', src: '/app-assets/vendors/js/vendors.min.js', defer: true },
            { hid: 'stripe', src: '/app-assets/js/core/app-menu.js', defer: true },
            { hid: 'stripe', src: '/app-assets/js/core/app.js', defer: true },
            { hid: 'stripe', src: '/app-assets/js/scripts/components.js', defer: true },
        ]
    },
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
