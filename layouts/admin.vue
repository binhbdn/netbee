<template>
  <div>
    <HeaderAdmin/>
    <NavbarAdmin/>
    <nuxt/>
  </div>
</template>

<script>

  import NavbarAdmin from '../components/NavbarAdmin'
  import HeaderAdmin from '../components/HeaderAdmin'

  export default {
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
</style>
