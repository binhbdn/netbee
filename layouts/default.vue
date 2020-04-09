<template>

  <div>
    <navbar></navbar>
    <nuxt/>
    <Follow></Follow>

</div>

</template>

<script>
  import Navbar from '../components/Navbar'
  import Follow from '../components/Follow'

  export default {
    data() {
      return {
     
      }
    },
    components: {
      Navbar,
      Follow
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
