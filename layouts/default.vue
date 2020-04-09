<template>
  <div>
    <Header></Header>
    <nuxt />
    <Follow></Follow>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from "../components/Header";
import Follow from '../components/Follow';
import Footer from '../components/Footer';

export default {
  data() {
    return {};
  },
  components: {
    Header,
    Follow,
    Footer
  },
  mounted() {}
};
</script>

<style>
html {
  font-family: "Source Sans Pro", "Helvetica Neue", Arial, sans-serif;
}
</style>
