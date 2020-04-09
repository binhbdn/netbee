<template>
  <div>
    <Header></Header>
    <Banner></Banner>
<!--    <Search></Search>-->
    <nuxt />
    <Follow></Follow>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from '../components/Header'
import Follow from '../components/Follow'
import Footer from '../components/Footer'
import Banner from '../components/Banner'
import Search from '../components/Search'

export default {
  data() {
    return {};
  },
  components: {
    Banner,
    Header,
    Follow,
    Footer,
    Search
  },
  mounted() {}
};
</script>

<style>
html {
  font-family: "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;
}
</style>
