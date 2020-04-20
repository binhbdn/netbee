<template>
  <div style="height: 100%">
    <HeaderAdmin/>
    <NavbarAdmin/>
    <nuxt/>
  </div>
</template>

<script>

  import NavbarAdmin from '../components/NavbarAdmin'
  import HeaderAdmin from '../components/HeaderAdmin'

  export default {
    middleware: 'after_login',
    data() {
      return {

      }
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
