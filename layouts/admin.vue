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
      link: [
        { rel: 'stylesheet', href: '/app-assets/vendors/css/vendors.min.css' , defer: true},
        { rel: 'stylesheet', href: '/app-assets/vendors/css/extensions/tether-theme-arrows.css' },
        { rel: 'stylesheet', href: '/app-assets/vendors/css/extensions/tether.min.css' },
        { rel: 'stylesheet', href: '/app-assets/css/colors.css', defer: true },
        { rel: 'stylesheet', href: '/app-assets/css/themes/dark-layout.css' , defer: true},
        { rel: 'stylesheet', href: '/app-assets/css/core/menu/menu-types/vertical-menu.css', defer: true },
        { rel: 'stylesheet', href: '/app-assets/css/core/colors/palette-gradient.css', defer: true },
        { rel: 'stylesheet', href: '/app-assets/css/plugins/forms/validation/form-validation.css', defer: true },
        { rel: 'stylesheet', href: '/app-assets/css/pages/dashboard-analytics.css' , defer: true},
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
</style>
