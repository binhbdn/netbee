<template>

  <div>
    <navbar></navbar>
    <nuxt/>

</div>

</template>

<script>
  import Navbar from '../components/Navbar'

  export default {
    data() {
      return {
     
      }
    },
    components: {
      Navbar
    },
    mounted() {

    }
  }
</script>

<style>
  html {
    font-family: "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;
  }
</style>
