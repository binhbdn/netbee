<template>
  <div style="height: 100%">
    <HeaderAdmin/>
    <NavbarAdmin/>
    <nuxt/>
  </div>
</template>

<script>

  import NavbarAdmin from '~/components/NavbarAdmin'
  import HeaderAdmin from '~/components/HeaderAdmin'

  export default {
    middleware: 'after_login',
    head: {
        meta: [
          { hid: 'robots', name: 'robots', content: 'noindex' },
        ],
      link: [
        { rel: 'stylesheet', href: '/app-assets/vendors/css/vendors.min.css'},
        { rel: 'stylesheet', href: '/app-assets/vendors/css/extensions/tether-theme-arrows.css' },
        { rel: 'stylesheet', href: '/app-assets/vendors/css/extensions/tether.min.css' },
        // Binh Bui: colors.css này có lẽ là không dùng đến
        { rel: 'stylesheet', href: '/app-assets/css/colors.css'},
        { rel: 'stylesheet', href: '/app-assets/css/themes/dark-layout.css'},
        { rel: 'stylesheet', href: '/app-assets/css/core/menu/menu-types/vertical-menu.css'},
        { rel: 'stylesheet', href: '/app-assets/css/core/colors/palette-gradient.css'},
        { rel: 'stylesheet', href: '/app-assets/css/plugins/forms/validation/form-validation.css'},
        { rel: 'stylesheet', href: '/app-assets/css/pages/dashboard-analytics.css'},
        { rel: 'stylesheet', href: '/assets/css/custom-admin.css'},
      ],
    },
    components: {
      NavbarAdmin,
      HeaderAdmin,
    },
  }
</script>
<style>
  html {
    font-family: "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;
  } 
  #__nuxt{
    height: 100% !important;
  }
  #__layout{
    height: 100% !important;
  }
  #fb-root {
    display: none !important;
  }
</style>
